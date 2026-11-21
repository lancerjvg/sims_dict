@extends('layouts.app')

@section('title', 'Add New Subject')
@section('page-heading', 'Add New Subject')

@section('content')

<div class="container-fluid px-0">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="{{ route('subjects.index') }}"
                   class="text-decoration-none text-muted small">
                    Subject Management
                </a>

                <i class="bi bi-chevron-right small text-muted"></i>

                <span class="small text-primary fw-semibold">
                    Add New Subject
                </span>
            </div>

            <h3 class="fw-bold mb-1" style="color:#101828;">
                Add New Subject
            </h3>

            <p class="text-muted mb-0">
                Create and manage academic subjects in your institution.
            </p>
        </div>

        <a href="{{ route('subjects.index') }}"
           class="btn btn-light border rounded-3 px-4 py-2">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Subjects
        </a>
    </div>


    {{-- MAIN CONTENT --}}
    <div class="row g-4">

        {{-- FORM COLUMN --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- CARD HEADER --}}
                <div class="p-4 border-bottom bg-white">

                    <div class="d-flex align-items-center gap-3">

                        <div class="subject-form-icon">
                            <i class="bi bi-book-half"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                Subject Information
                            </h5>

                            <p class="text-muted small mb-0">
                                Enter the required details for the new subject.
                            </p>
                        </div>

                    </div>
                </div>


                {{-- FORM --}}
                <div class="card-body p-4">

                    <form action="{{ route('subjects.store') }}"
                          method="POST">

                        @csrf

                        {{-- SUBJECT CODE --}}
                        <div class="mb-4">

                            <label for="subject_code"
                                   class="form-label fw-semibold">
                                Subject Code
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group premium-input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-upc-scan"></i>
                                </span>

                                <input type="text"
                                       name="subject_code"
                                       id="subject_code"
                                       class="form-control @error('subject_code') is-invalid @enderror"
                                       placeholder="e.g. CS101"
                                       value="{{ old('subject_code') }}"
                                       maxlength="30"
                                       required>

                                @error('subject_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Use a unique code for every subject.
                            </div>

                        </div>


                        {{-- SUBJECT NAME --}}
                        <div class="mb-4">

                            <label for="subject_name"
                                   class="form-label fw-semibold">
                                Subject Name
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group premium-input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-journal-text"></i>
                                </span>

                                <input type="text"
                                       name="subject_name"
                                       id="subject_name"
                                       class="form-control @error('subject_name') is-invalid @enderror"
                                       placeholder="Enter subject name"
                                       value="{{ old('subject_name') }}"
                                       maxlength="150"
                                       required>

                                @error('subject_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- UNITS --}}
                        <div class="mb-4">

                            <label for="units"
                                   class="form-label fw-semibold">
                                Academic Units
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group premium-input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-calculator"></i>
                                </span>

                                <select name="units"
                                        id="units"
                                        class="form-select @error('units') is-invalid @enderror"
                                        required>

                                    <option value="">Select units</option>

                                    @for($unit = 1; $unit <= 10; $unit++)
                                        <option value="{{ $unit }}"
                                            {{ old('units', 3) == $unit ? 'selected' : '' }}>
                                            {{ $unit }} {{ $unit == 1 ? 'Unit' : 'Units' }}
                                        </option>
                                    @endfor

                                </select>

                                @error('units')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-text">
                                Specify the academic credit units assigned to this subject.
                            </div>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="mb-4">

                            <label for="description"
                                   class="form-label fw-semibold">
                                Subject Description
                            </label>

                            <textarea name="description"
                                      id="description"
                                      rows="5"
                                      class="form-control premium-textarea @error('description') is-invalid @enderror"
                                      placeholder="Provide a brief description, learning objectives, or subject details...">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Optional. Provide additional information about this subject.
                            </div>

                        </div>


                        {{-- FORM FOOTER --}}
                        <div class="d-flex flex-wrap justify-content-end gap-2 pt-3 border-top">

                            <a href="{{ route('subjects.index') }}"
                               class="btn btn-light border rounded-3 px-4 py-2">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary premium-save-btn px-4 py-2">

                                <i class="bi bi-check-circle me-2"></i>
                                Save Subject

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- RIGHT SIDE GUIDE --}}
        <div class="col-lg-4">

            {{-- SUBJECT GUIDE --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="guide-header-icon mb-3">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <h5 class="fw-bold mb-2">
                        Subject Registration Guide
                    </h5>

                    <p class="text-muted small mb-4">
                        Follow these guidelines when creating a new subject.
                    </p>


                    <div class="guide-item d-flex gap-3 mb-4">

                        <div class="guide-number">
                            01
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1">
                                Unique Subject Code
                            </h6>

                            <p class="small text-muted mb-0">
                                Use a unique code such as CS101, IT102, or GE101.
                            </p>
                        </div>

                    </div>


                    <div class="guide-item d-flex gap-3 mb-4">

                        <div class="guide-number">
                            02
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1">
                                Accurate Subject Name
                            </h6>

                            <p class="small text-muted mb-0">
                                Use the official subject title from the approved curriculum.
                            </p>
                        </div>

                    </div>


                    <div class="guide-item d-flex gap-3 mb-4">

                        <div class="guide-number">
                            03
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1">
                                Correct Units
                            </h6>

                            <p class="small text-muted mb-0">
                                Verify the correct number of academic units assigned to the subject.
                            </p>
                        </div>

                    </div>


                    <div class="guide-item d-flex gap-3">

                        <div class="guide-number">
                            04
                        </div>

                        <div>
                            <h6 class="fw-semibold mb-1">
                                Complete Description
                            </h6>

                            <p class="small text-muted mb-0">
                                Add relevant subject information to help users understand its content.
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- QUICK INFO CARD --}}
            <div class="card border-0 rounded-4 subject-tip-card">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">

                        <div class="subject-tip-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <div>
                            <h6 class="fw-bold mb-2">
                                Data Integrity
                            </h6>

                            <p class="small mb-0 text-muted">
                                Subject codes must be unique. Existing subjects cannot have duplicate subject codes.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

    .subject-form-icon {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #EEF2FF, #E0E7FF);
        color: #6366F1;
        border-radius: 16px;
        font-size: 24px;
    }

    .premium-input-group {
        border-radius: 12px;
        overflow: hidden;
    }

    .premium-input-group .input-group-text {
        background: #F8FAFC;
        border: 1px solid #E4E7EC;
        color: #667085;
        padding-left: 15px;
        padding-right: 15px;
    }

    .premium-input-group .form-control,
    .premium-input-group .form-select {
        min-height: 48px;
        border: 1px solid #E4E7EC;
        box-shadow: none;
    }

    .premium-input-group .form-control:focus,
    .premium-input-group .form-select:focus {
        border-color: #6366F1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
    }

    .premium-input-group .input-group-text:first-child {
        border-right: 0;
    }

    .premium-input-group .form-control,
    .premium-input-group .form-select {
        border-left: 0;
    }

    .premium-textarea {
        border: 1px solid #E4E7EC;
        border-radius: 12px;
        resize: vertical;
        box-shadow: none;
    }

    .premium-textarea:focus {
        border-color: #6366F1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
    }

    .premium-save-btn {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        border: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all .25s ease;
    }

    .premium-save-btn:hover {
        background: linear-gradient(135deg, #4F46E5, #4338CA);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, .25);
    }

    .guide-header-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #FFF7E6;
        color: #F59E0B;
        font-size: 21px;
    }

    .guide-number {
        min-width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #EEF2FF;
        color: #6366F1;
        font-size: 12px;
        font-weight: 700;
    }

    .guide-item h6 {
        font-size: 14px;
    }

    .subject-tip-card {
        background: linear-gradient(135deg, #F8FAFF, #EEF2FF);
        border: 1px solid #E0E7FF !important;
    }

    .subject-tip-icon {
        width: 42px;
        height: 42px;
        min-width: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #DDE5FF;
        color: #4F46E5;
        font-size: 19px;
    }

    @media (max-width: 768px) {

        .premium-save-btn,
        .card-body .btn {
            min-height: 44px;
        }

    }

</style>

@endpush
