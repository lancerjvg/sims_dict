@extends('layouts.app')
@section('page-heading', 'Add Enrollment')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-4">
        <h2 class="fw-bold text-indigo-title">Add Enrollment</h2>
        <p class="text-muted mb-0">Enroll one student in multiple subjects for a selected school term.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-circle me-1"></i>Please review the enrollment form.</div>
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif


    <form method="POST" action="{{ route('enrollments.store') }}" id="multiEnrollmentForm">
        @csrf
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
            <div class="card-header text-white p-3 p-md-4 enrollment-gradient">
                <h5 class="fw-bold mb-0"><i class="bi bi-clipboard2-check me-2"></i>Enrollment Information</h5>
                <small class="opacity-75">Select student, school term, then check all subjects to enroll.</small>
            </div>
            <div class="card-body p-3 p-md-4">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">Student <span class="text-danger">*</span></label>
                        <select name="student_id" id="student_id" class="form-select rounded-3" required>
                            <option value="">Choose Student</option>
                            @foreach($students as $s)
                                <option value="{{ $s->id }}" @selected(old('student_id')==$s->id)>
                                    {{ $s->student_number }} - {{ $s->last_name }}, {{ $s->first_name }} {{ $s->middle_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">School Year <span class="text-danger">*</span></label>
                        <input name="school_year" id="school_year" class="form-control rounded-3" placeholder="e.g. 2026-2027" value="{{ old('school_year') }}" required>
                        @error('school_year')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Semester <span class="text-danger">*</span></label>
                        <select name="semester" id="semester" class="form-select rounded-3" required>
                            <option value="">Select Semester</option>
                            <option value="1st Semester" @selected(old('semester')==='1st Semester')>1st Semester</option>
                            <option value="2nd Semester" @selected(old('semester')==='2nd Semester')>2nd Semester</option>
                            <option value="Summer" @selected(old('semester')==='Summer')>Summer</option>
                        </select>
                        @error('semester')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Enrollment Date <span class="text-danger">*</span></label>
                        <input type="date" name="enrollment_date" class="form-control rounded-3" value="{{ old('enrollment_date', date('Y-m-d')) }}" required>
                        @error('enrollment_date')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Enrollment Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select rounded-3" required>
                            <option value="Active" @selected(old('status','Active')==='Active')>Active</option>
                            <option value="Inactive" @selected(old('status')==='Inactive')>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-3 p-md-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold mb-1 text-indigo-title"><i class="bi bi-journal-check me-2"></i>Select Subjects</h5>
                        <small class="text-muted">Check multiple subjects to save them together.</small>
                    </div>
                    <div class="selected-counter"><span id="selectedCount">0</span> selected</div>
                </div>
            </div>
            <div class="card-body p-3 p-md-4">
                <div class="row g-2 align-items-center mb-3">
                    <div class="col-md">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                            <input type="search" id="subjectSearch" class="form-control border-start-0" placeholder="Search subject code or name..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-auto d-flex gap-2">
                        <button type="button" id="selectAllSubjects" class="btn btn-outline-primary rounded-3 btn-sm">Select Visible</button>
                        <button type="button" id="clearSubjects" class="btn btn-light border rounded-3 btn-sm">Clear</button>
                    </div>
                </div>
                @error('subject_ids')<div class="alert alert-danger py-2 rounded-3">{{ $message }}</div>@enderror
                @error('subject_ids.*')<div class="alert alert-danger py-2 rounded-3">{{ $message }}</div>@enderror
                <div class="table-responsive subject-list-border rounded-3">
                    <table class="table align-middle table-hover mb-0" id="subjectsTable">
                        <thead class="table-light"><tr><th style="width:55px" class="text-center">Select</th><th style="width:150px">Subject Code</th><th>Subject Name</th></tr></thead>
                        <tbody>
                        @forelse($subjects as $sub)
                            @php
                                $code = $sub->subject_code ?? $sub->code ?? '';
                                $name = $sub->subject_name ?? $sub->name ?? 'Subject';
                                $subjectLabel = trim($code . ' ' . $name);
                            @endphp
                            <tr class="subject-row" data-search="{{ strtolower($subjectLabel) }}">
                                <td class="text-center"><input class="form-check-input subject-checkbox" type="checkbox" name="subject_ids[]" value="{{ $sub->id }}" @checked(in_array($sub->id, (array)old('subject_ids', []))) aria-label="Select {{ $subjectLabel }}"></td>
                                <td><span class="subject-code-pill">{{ $code ?: '—' }}</span></td>
                                <td class="fw-medium">{{ $name }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center text-muted py-4">No subjects are available.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
                    <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Subjects are saved under the selected school year and semester.</small>
                    <div class="d-flex gap-2"><a href="{{ route('enrollments.index') }}" class="btn btn-light border rounded-3">Cancel</a><button type="submit" class="btn btn-indigo-enroll rounded-3 px-4" id="saveEnrollmentBtn"><i class="bi bi-check2-circle me-1"></i>Save Selected Subjects</button></div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .text-indigo-title{color:#312e81}.enrollment-gradient{background:linear-gradient(135deg,#4338ca,#6366f1)}
    .btn-indigo-enroll{background:#4f46e5;color:#fff;border:1px solid #4f46e5}.btn-indigo-enroll:hover{background:#4338ca;color:#fff}
    .selected-counter{background:#eef2ff;color:#4338ca;border:1px solid #e0e7ff;border-radius:50px;padding:8px 14px;font-weight:700;font-size:.9rem}
    .subject-list-border{border:1px solid #e5e7eb}.subject-code-pill{display:inline-block;background:#eef2ff;color:#4338ca;border:1px solid #e0e7ff;border-radius:8px;padding:5px 9px;font-weight:700;font-size:.82rem}
    #subjectsTable thead th{font-size:.82rem;color:#64748b;text-transform:uppercase;letter-spacing:.04em}#subjectsTable tbody tr{cursor:pointer}#subjectsTable .subject-checkbox{width:1.1rem;height:1.1rem;cursor:pointer}
    @media(max-width:576px){.subject-code-pill{font-size:.75rem}}
</style>
@endpush

@push('scripts')
<script>
 document.addEventListener('DOMContentLoaded', function () {
    const boxes = Array.from(document.querySelectorAll('.subject-checkbox'));
    const counter = document.getElementById('selectedCount');
    const search = document.getElementById('subjectSearch');
    const rows = Array.from(document.querySelectorAll('.subject-row'));
    function updateCount(){ counter.textContent = boxes.filter(box => box.checked).length; }
    boxes.forEach(box => box.addEventListener('change', updateCount));
    rows.forEach(row => row.addEventListener('click', function(e){
        if (e.target.closest('input')) return;
        const box = row.querySelector('.subject-checkbox');
        if (box) { box.checked = !box.checked; box.dispatchEvent(new Event('change')); }
    }));
    search.addEventListener('input', function(){
        const term = this.value.toLowerCase().trim();
        rows.forEach(row => row.style.display = row.dataset.search.includes(term) ? '' : 'none');
    });
    document.getElementById('selectAllSubjects').addEventListener('click', function(){
        rows.filter(row => row.style.display !== 'none').forEach(row => { const box = row.querySelector('.subject-checkbox'); if (box) box.checked = true; }); updateCount();
    });
    document.getElementById('clearSubjects').addEventListener('click', function(){ boxes.forEach(box => box.checked = false); updateCount(); });
    document.getElementById('multiEnrollmentForm').addEventListener('submit', function(e){
        if (!boxes.some(box => box.checked)) { e.preventDefault(); alert('Please select at least one subject before saving.'); }
    });
    updateCount();
 });
</script>
@endpush
