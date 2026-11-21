@extends('layouts.app')

@section('title', 'Edit Course')
@section('page-heading', 'Course Management')

@section('content')
<div class="container-fluid py-3 course-edit-page">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="text-muted small mb-1"><i class="bi bi-mortarboard me-1"></i> Academic Setup / Course Management</div>
            <h2 class="fw-bold mb-1">Edit Course</h2>
            <p class="text-muted mb-0">Update the details for this course.</p>
        </div>
        <a href="{{ route('courses.index') }}" class="btn btn-light border rounded-3 px-3">
            <i class="bi bi-arrow-left me-2"></i>Back to Courses
        </a>
    </div>


    <div class="row">
        <div class="col-12 col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden course-edit-card">
                <div class="course-edit-header p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="course-edit-icon"><i class="bi bi-pencil-square"></i></div>
                        <div>
                            <h5 class="fw-bold mb-1">Course Information</h5>
                            <p class="mb-0 small text-white-50">Edit course code, course name, and description.</p>
                        </div>
                    </div>
                </div>


                <div class="card-body p-4 p-lg-5">
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 mb-4">
                            <div class="fw-semibold mb-2"><i class="bi bi-exclamation-circle me-2"></i>Please correct the following:</div>
                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('courses.update', $course) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Course Code -->
                        <div class="mb-4">
                            <label for="course_code" class="form-label fw-semibold">Course Code <span class="text-danger">*</span></label>
                            <div class="input-group course-edit-input-group">
                                <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                                <input type="text"
                                       id="course_code"
                                       name="course_code"
                                       class="form-control @error('course_code') is-invalid @enderror"
                                       value="{{ old('course_code', $course->course_code) }}"
                                       maxlength="4"
                                       minlength="4"
                                       pattern="[A-Za-z]{4}"
                                       title="Course Code must be exactly 4 letters."
                                       oninput="this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '').slice(0,4)"
                                       placeholder="e.g. BSCS"
                                       required>
                            </div>
                            @error('course_code')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                            <div class="form-text">Exactly 4 uppercase letters.</div>
                        </div>


                        <!-- Course Name -->
                        <div class="mb-4">
                            <label for="course_name" class="form-label fw-semibold">Course Information / Course Name <span class="text-danger">*</span></label>
                            <div class="input-group course-edit-input-group">
                                <span class="input-group-text"><i class="bi bi-book"></i></span>
                                <input type="text"
                                       id="course_name"
                                       name="course_name"
                                       class="form-control @error('course_name') is-invalid @enderror"
                                       value="{{ old('course_name', $course->course_name) }}"
                                       maxlength="255"
                                       placeholder="Enter complete course name"
                                       required>
                            </div>
                            @error('course_name')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>


                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description <span class="text-muted fw-normal">(Optional)</span></label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      class="form-control course-edit-textarea @error('description') is-invalid @enderror"
                                      placeholder="Enter course description...">{{ old('description', $course->description) }}</textarea>
                            @error('description')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        </div>


                        <!-- Status Display -->
                        <div class="course-edit-status-box rounded-3 p-3 mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-info-circle-fill text-primary"></i>
                                <div>
                                    <div class="fw-semibold small">Current Course Status</div>
                                    <span class="badge rounded-pill {{ $course->is_active ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} mt-1">
                                        {{ $course->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-muted small mt-2">To activate or deactivate this course, use the status action in Course Management.</div>
                        </div>


                        <!-- Buttons -->
                        <div class="d-flex flex-wrap justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('courses.index') }}" class="btn btn-light border rounded-3 px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4">
                                <i class="bi bi-check-circle me-2"></i>Update Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .course-edit-page { color: #1f2937; }
    .course-edit-card { background: #fff; }
    .course-edit-header { background: linear-gradient(135deg, #4338ca, #6366f1); color: #fff; }
    .course-edit-icon {
        width: 52px; height: 52px; display: flex; align-items: center; justify-content: center;
        background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2);
        border-radius: 15px; font-size: 23px;
    }
    .course-edit-input-group .input-group-text {
        background: #f8fafc; border-color: #e2e8f0; color: #6366f1;
        min-width: 45px; justify-content: center;
    }
    .course-edit-input-group .form-control { min-height: 48px; border-color: #e2e8f0; }
    .course-edit-input-group .form-control:focus, .course-edit-textarea:focus {
        border-color: #818cf8; box-shadow: 0 0 0 .2rem rgba(99,102,241,.12);
    }
    .course-edit-textarea { border-color: #e2e8f0; resize: vertical; }
    .course-edit-status-box { background: #eef2ff; border: 1px solid #e0e7ff; }
    @media (max-width: 576px) {
        .course-edit-page .card-body { padding: 1.25rem !important; }
        .course-edit-page h2 { font-size: 1.5rem; }
    }
</style>
@endpush
