<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    /**
     * Display the list of subjects.
     */
    public function index(Request $request)
    {
        $query = Subject::query();

        // ==========================================
        // SEARCH SUBJECT
        // ==========================================
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('subject_code', 'like', "%{$search}%")
                  ->orWhere('subject_name', 'like', "%{$search}%");
            });
        }

        // ==========================================
        // FILTER BY UNITS
        // ==========================================
        if ($request->filled('units')) {
            $query->where('units', $request->units);
        }

        // ==========================================
        // SORT BY SUBJECT INFORMATION
        // A-Z or Z-A
        // ==========================================
        $sort = $request->get('sort', 'subject_name');

        $direction = strtolower($request->get('direction', 'asc'));

        // Allow only valid sorting columns
        $allowedSorts = [
            'subject_name',
            'subject_code',
            'units',
        ];

        // Allow only valid sorting direction
        $allowedDirections = [
            'asc',
            'desc',
        ];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'subject_name';
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'asc';
        }

        $query->orderBy($sort, $direction);

        // Secondary sorting for consistent results
        if ($sort !== 'subject_code') {
            $query->orderBy('subject_code', 'asc');
        }

        // ==========================================
        // PAGINATION
        // ==========================================
        $subjects = $query->paginate(10)->withQueryString();

        // ==========================================
        // RETURN VIEW
        // ==========================================
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new subject.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created subject.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_code' => [
                'required',
                'string',
                'max:30',
                'unique:subjects,subject_code',
            ],
            'subject_name' => [
                'required',
                'string',
                'max:150',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'units' => [
                'required',
                'integer',
                'min:1',
                'max:10',
            ],
        ]);

        Subject::create($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject successfully added.');
    }

    /**
     * Display the specified subject.
     */
    public function show(Subject $subject)
    {
        $subject->load('enrollments.student');

        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified subject.
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified subject.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'subject_code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('subjects', 'subject_code')
                    ->ignore($subject->id),
            ],
            'subject_name' => [
                'required',
                'string',
                'max:150',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'units' => [
                'required',
                'integer',
                'min:1',
                'max:10',
            ],
        ]);

        $subject->update($validated);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject successfully updated.');
    }

    /**
     * Remove the specified subject.
     */
    public function destroy(Subject $subject)
    {
        // Check if subject has existing enrollments
        if ($subject->enrollments()->exists()) {
            return redirect()
                ->route('subjects.index')
                ->with('error', 'Cannot delete this subject because it has existing enrollments.');
        }

        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject successfully deleted.');
    }
}
