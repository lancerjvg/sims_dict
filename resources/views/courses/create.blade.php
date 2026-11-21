@extends('layouts.app')
@section('page-heading', 'Course Management - Add')

@section('content')
<div class="container-fluid py-4 course-create-page">

    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <div class="text-muted small mb-1">
                <i class="bi bi-mortarboard me-1"></i>
                Course Management
            </div>
            <h2 class="fw-bold mb-1">Add New Course</h2>
            <p class="text-muted mb-0">Create a new course offering in the system.</p>
        </div>

        <a href="{{ route('courses.index') }}" class="btn btn-light border rounded-3 px-3">
            <i class="bi bi-arrow-left me-2"></i>Back to Courses
        </a>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-xl-8 col-lg-10">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <!-- Card Header -->
                <div class="course-card-header p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="course-icon-box">
                            <i class="bi bi-journal-plus"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">Course Information</h5>
                            <p class="mb-0 small text-white-50">
                                Fill in the required details below.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="card-body p-4 p-lg-5">

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <div class="fw-bold mb-2">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                Please check the following errors:
                            </div>

                            <ul class="mb-0 ps-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf

                        <!-- Course Code -->
                        <div class="mb-4">
                            <label for="course_code" class="form-label fw-semibold">
                                Course Code <span class="text-danger">*</span>
                            </label>

                            <div class="input-group course-input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-upc-scan"></i>
                                </span>

                                <input
                                    type="text"
                                    id="course_code"
                                    name="course_code"
                                    class="form-control @error('course_code') is-invalid @enderror"
                                    value="{{ old('course_code') }}"
                                    placeholder="e.g. BSCS, BSIT, BSED"
                                    maxlength="20"
                                    required
                                >
                            </div>

                            @error('course_code')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                Unique code or abbreviation for the course.
                            </div>
                        </div>

                        <!-- Course Name -->
                        <div class="mb-4">
                            <label for="course_name" class="form-label fw-semibold">
                                Course Name <span class="text-danger">*</span>
                            </label>

                            <div class="input-group course-input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-book"></i>
                                </span>

                                <input
                                    type="text"
                                    id="course_name"
                                    name="course_name"
                                    class="form-control @error('course_name') is-invalid @enderror"
                                    value="{{ old('course_name') }}"
                                    placeholder="e.g. Bachelor of Science in Computer Science"
                                    required
                                >
                            </div>

                            @error('course_name')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                Enter the official complete name of the course.
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                Description
                                <span class="text-muted fw-normal">(Optional)</span>
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="form-control course-textarea @error('description') is-invalid @enderror"
                                placeholder="Enter additional information about this course..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Info -->
                        <div class="course-info-box rounded-3 p-3 mb-4">
                            <div class="d-flex gap-2">
                                <i class="bi bi-info-circle-fill text-primary mt-1"></i>
                                <div>
                                    <div class="fw-semibold small">Course Registration Information</div>
                                    <div class="text-muted small">
                                        Newly created courses will be marked as Active and
                                        will be available for student registration.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex flex-wrap justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('courses.index') }}"
                               class="btn btn-light border px-4 rounded-3">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-indigo px-4 rounded-3">
                                <i class="bi bi-check-circle me-2"></i>
                                Save Course
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
    .course-create-page {
        color: #1f2937;
    }

    .course-card-header {
        background: linear-gradient(135deg, #4338ca, #6366f1);
        color: #ffffff;
    }

    .course-icon-box {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 15px;
        font-size: 23px;
    }

    .course-input-group .input-group-text {
        background: #f8fafc;
        border-color: #e2e8f0;
        color: #6366f1;
        min-width: 45px;
        justify-content: center;
    }

    .course-input-group .form-control {
        min-height: 48px;
        border-color: #e2e8f0;
    }

    .course-input-group .form-control:focus,
    .course-textarea:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 .2rem rgba(99,102,241,.12);
    }

    .course-textarea {
        border-color: #e2e8f0;
        resize: vertical;
    }

    .course-info-box {
        background: #eef2ff;
        border: 1px solid #e0e7ff;
    }

    .btn-indigo {
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
        min-height: 43px;
        font-weight: 600;
    }

    .btn-indigo:hover {
        background: #4338ca;
        border-color: #4338ca;
        color: white;
    }

    .course-create-page .card {
        background: #ffffff;
    }

    .course-create-page .form-label {
        color: #374151;
    }

    @media (max-width: 576px) {
        .course-create-page .card-body {
            padding: 1.25rem !important;
        }

        .course-create-page h2 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush
