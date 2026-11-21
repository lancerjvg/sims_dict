<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class EnrollmentController extends Controller
{
    private function subjectUnits($subject): int
    {
        foreach (['units', 'unit', 'credit_units', 'credits'] as $column) {
            if (isset($subject->{$column})) return (int) $subject->{$column};
        }
        return 0;
    }


    private function groupQuery($studentId, $schoolYear, $semester)
    {
        return Enrollment::with(['student', 'subject'])
            ->where('student_id', $studentId)
            ->where('school_year', $schoolYear)
            ->where('semester', $semester);
    }


    public function index(Request $request)
    {
        $query = Enrollment::with(['student', 'subject']);
        if ($request->filled('school_year')) $query->where('school_year', $request->school_year);
        if ($request->filled('semester')) $query->where('semester', $request->semester);
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('course')) $query->whereHas('student', fn($q) => $q->where('course', $request->course));
        if ($request->filled('search')) {
            $term = trim($request->search);
            $query->where(function($q) use ($term) {
                $q->whereHas('student', function($sq) use ($term) {
                    foreach (['student_number','first_name','middle_name','last_name'] as $col) $sq->orWhere($col, 'like', "%{$term}%");
                })->orWhereHas('subject', function($sq) use ($term) {
                    $cols = array_intersect(['subject_code','subject_name','code','name'], Schema::getColumnListing('subjects'));
                    foreach ($cols as $col) $sq->orWhere($col, 'like', "%{$term}%");
                });
            });
        }
        $rows = $query->latest()->get();
        $groups = $rows->groupBy(fn($e) => $e->student_id.'|'.$e->school_year.'|'.$e->semester)->map(function($items) {
            $first = $items->first();
            $first->group_subjects = $items;
            $first->group_subject_count = $items->count();
            $first->group_total_units = $items->sum(fn($e) => $this->subjectUnits($e->subject));
            $first->group_enrolled_date = $items->min('enrollment_date');
            $first->group_status = $items->contains(fn($e) => $e->status === 'Active') ? 'Active' : 'Inactive';
            return $first;
        })->values();
        $total = Enrollment::count(); $active = Enrollment::where('status','Active')->count(); $inactive = Enrollment::where('status','Inactive')->count();
        $page = LengthAwarePaginator::resolveCurrentPage(); $perPage = 10;
        $filtered = new LengthAwarePaginator($groups->forPage($page,$perPage), $groups->count(), $perPage, $page, ['path'=>request()->url(),'query'=>request()->query()]);
        $courses = Student::whereNotNull('course')->where('course','<>','')->distinct()->orderBy('course')->pluck('course');
        $schoolYears = Enrollment::whereNotNull('school_year')->distinct()->orderByDesc('school_year')->pluck('school_year');
        return view('enrollments.index', compact('filtered','total','active','inactive','courses','schoolYears'));
    }


    public function create()
    {
        $students = Student::orderBy('last_name')->orderBy('first_name')->get();
        $subjectColumns = Schema::getColumnListing('subjects');
        $sortSubjectColumn = in_array('subject_code',$subjectColumns) ? 'subject_code' : (in_array('subject_name',$subjectColumns) ? 'subject_name' : 'id');
        $subjects = Subject::orderBy($sortSubjectColumn)->get();
        return view('enrollments.create', compact('students','subjects'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'=>['required','exists:students,id'], 'subject_ids'=>['required','array','min:1'],
            'subject_ids.*'=>['required','integer','distinct','exists:subjects,id'],
            'school_year'=>['required','string','max:20'],'semester'=>['required','string','max:30'],
            'enrollment_date'=>['required','date'],'status'=>['required',Rule::in(['Active','Inactive'])],
        ]);
        $subjectIds = array_values(array_unique($validated['subject_ids']));
        $existing = Enrollment::where('student_id',$validated['student_id'])->where('school_year',$validated['school_year'])->where('semester',$validated['semester'])->whereIn('subject_id',$subjectIds)->pluck('subject_id')->map(fn($v)=>(int)$v)->all();
        $insert = array_values(array_diff($subjectIds,$existing));
        if (!$insert) return back()->withInput()->withErrors(['subject_ids'=>'All selected subjects are already enrolled for this student in the selected school year and semester.']);
        DB::transaction(function() use ($validated,$insert) { foreach($insert as $sid) Enrollment::create(['student_id'=>$validated['student_id'],'subject_id'=>$sid,'school_year'=>$validated['school_year'],'semester'=>$validated['semester'],'enrollment_date'=>$validated['enrollment_date'],'status'=>$validated['status']]); });
        return redirect()->route('enrollments.index')->with('success','Successfully enrolled in '.count($insert).' subject(s).');
    }


    public function groupShow(Request $request)
    {
        $request->validate(['student_id'=>'required','school_year'=>'required','semester'=>'required']);
        $items=$this->groupQuery($request->student_id,$request->school_year,$request->semester)->get();
        abort_if($items->isEmpty(),404);
        $student=$items->first()->student;
        $totalUnits=$items->sum(fn($e)=>$this->subjectUnits($e->subject));
        return view('enrollments.show',compact('items','student','totalUnits'));
    }

  public function groupEdit(Request $request)
{
    $request->validate([
        'student_id' => 'required',
        'school_year' => 'required',
        'semester' => 'required',
    ]);

    $items = $this->groupQuery(
        $request->student_id,
        $request->school_year,
        $request->semester
    )->get();

    abort_if($items->isEmpty(), 404);

    $student = $items->first()->student;

    $selected = $items->pluck('subject_id')
        ->map(fn($v) => (int) $v)
        ->all();

    $subjectColumns = Schema::getColumnListing('subjects');

    $sort = in_array('subject_code', $subjectColumns)
        ? 'subject_code'
        : (in_array('subject_name', $subjectColumns)
            ? 'subject_name'
            : 'id');

    $subjects = Subject::orderBy($sort)->get();

    return view('enrollments.group-edit', compact(
        'items',
        'student',
        'selected',
        'subjects'
    ));
}

    public function groupUpdate(Request $request)
    {
        $validated=$request->validate(['student_id'=>'required|exists:students,id','subject_ids'=>'required|array|min:1','subject_ids.*'=>'required|integer|distinct|exists:subjects,id','school_year'=>'required|string|max:20','semester'=>'required|string|max:30','enrollment_date'=>'required|date','status'=>['required',Rule::in(['Active','Inactive'])]]);
        $ids=array_values(array_unique($validated['subject_ids']));
        DB::transaction(function() use($validated,$ids) {
            $old=$this->groupQuery($validated['student_id'],$validated['school_year'],$validated['semester'])->get();
            $oldIds=$old->pluck('subject_id')->map(fn($v)=>(int)$v)->all();
            $remove=array_values(array_diff($oldIds,$ids)); $add=array_values(array_diff($ids,$oldIds));
            if($remove) Enrollment::where('student_id',$validated['student_id'])->where('school_year',$validated['school_year'])->where('semester',$validated['semester'])->whereIn('subject_id',$remove)->delete();
            foreach($old->whereIn('subject_id',$ids) as $e) $e->update(['enrollment_date'=>$validated['enrollment_date'],'status'=>$validated['status']]);
            foreach($add as $sid) Enrollment::create(['student_id'=>$validated['student_id'],'subject_id'=>$sid,'school_year'=>$validated['school_year'],'semester'=>$validated['semester'],'enrollment_date'=>$validated['enrollment_date'],'status'=>$validated['status']]);
        });
        return redirect()->route('enrollments.index')->with('success','Enrollment group updated successfully.');
    }

    public function groupDestroy(Request $request)
    {
        $request->validate(['student_id'=>'required','school_year'=>'required','semester'=>'required']);
        $count=$this->groupQuery($request->student_id,$request->school_year,$request->semester)->delete();
        return redirect()->route('enrollments.index')->with('success',"Deleted enrollment group ({$count} subject record(s)).");
    }

    // Keep resource routes compatible with the previous single-subject edit/delete endpoints.
    public function edit(Enrollment $enrollment) { return redirect()->route('enrollments.groupEdit',['student_id'=>$enrollment->student_id,'school_year'=>$enrollment->school_year,'semester'=>$enrollment->semester]); }
    public function update(Request $request, Enrollment $enrollment) { return redirect()->route('enrollments.groupEdit',['student_id'=>$enrollment->student_id,'school_year'=>$enrollment->school_year,'semester'=>$enrollment->semester]); }
    public function destroy(Enrollment $enrollment) { return $this->groupDestroy(new Request(['student_id'=>$enrollment->student_id,'school_year'=>$enrollment->school_year,'semester'=>$enrollment->semester])); }
}
