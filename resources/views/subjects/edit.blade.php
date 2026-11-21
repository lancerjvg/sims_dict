
@extends('layouts.app')

@section('title', 'Edit Subject')
@section('page-heading', 'Edit Subject')

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

                <a href="{{ route('subjects.show', $subject) }}"
                   class="text-decoration-none text-muted small">
                    {{ $subject->subject_code }}
                </a>

                <i class="bi bi-chevron-right small text-muted"></i>

                <span class="small text-primary fw-semibold">
                    Edit Subject
                </span>
            </div>

            <h3 class="fw-bold mb-1" style="color:#101828;">
                Edit Subject
            </h3>

            <p class="text-muted mb-0">
                Update the academic subject information and details.
            </p>
        </div>

        <a href="{{ route('subjects.show', $subject) }}"
           class="btn btn-light border rounded-3 px-4 py-2">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Subject
        </a>

    </div>


    {{-- MAIN CONTENT --}}
    <div class="row g-4">

        {{-- EDIT FORM --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- CARD HEADER --}}
                <div class="p-4 border-bottom bg-white">

                    <div class="d-flex align-items-center gap-3">

                        <div class="edit-subject-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                Subject Information
                            </h5>

                            <p class="text-muted small mb-0">
                                Modify the subject details below.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- FORM BODY --}}
                <div class="card-body p-4">

                    <form action="{{ route('subjects.update', $subject) }}"
                          method="POST">

                        @csrf
                        @method('PUT')


                        {{-- SUBJECT CODE --}}
                        <div class="mb-4">

                            <label for="subject_code"
                                   class="form-label fw-semibold">
                                Subject Code
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group edit-premium-input">

                                <span class="input-group-text">
                                    <i class="bi bi-upc-scan"></i>
                                </span>

                                <input type="text"
                                       name="subject_code"
                                       id="subject_code"
                                       class="form-control @error('subject_code') is-invalid @enderror"
                                       value="{{ old('subject_code', $subject->subject_code) }}"
                                       maxlength="30"
                                       placeholder="e.g. CS101"
                                       required>

                                @error('subject_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Subject code must be unique.
                            </div>

                        </div>


                        {{-- SUBJECT NAME --}}
                        <div class="mb-4">

                            <label for="subject_name"
                                   class="form-label fw-semibold">
                                Subject Name
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group edit-premium-input">

                                <span class="input-group-text">
                                    <i class="bi bi-journal-text"></i>
                                </span>

                                <input type="text"
                                       name="subject_name"
                                       id="subject_name"
                                       class="form-control @error('subject_name') is-invalid @enderror"
                                       value="{{ old('subject_name', $subject->subject_name) }}"
                                       maxlength="150"
                                       placeholder="Enter subject name"
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

                            <div class="input-group edit-premium-input">

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
                                            {{ old('units', $subject->units) == $unit ? 'selected' : '' }}>
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
                                      class="form-control edit-premium-textarea @error('description') is-invalid @enderror"
                                      placeholder="Enter subject description...">{{ old('description', $subject->description) }}</textarea>

                            @error('description')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Provide a summary or additional information about the subject.
                            </div>

                        </div>


                        {{-- FORM FOOTER --}}
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 pt-3 border-top">

                            <div class="text-muted small">
                                <i class="bi bi-shield-check me-1"></i>
                                Changes will be saved to the database.
                            </div>

                            <div class="d-flex gap-2">

                                <a href="{{ route('subjects.show', $subject) }}"
                                   class="btn btn-light border rounded-3 px-4 py-2">
                                    Cancel
                                </a>

                                <button type="submit"
                                        class="btn btn-primary edit-premium-save-btn px-4 py-2">

                                    <i class="bi bi-check-circle me-2"></i>
                                    Save Changes

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- RIGHT PANEL --}}
        <div class="col-lg-4">

            {{-- SUBJECT PROFILE --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="edit-subject-icon mb-3">
                        <i class="bi bi-book-half"></i>
                    </div>

                    <h5 class="fw-bold mb-1">
                        {{ $subject->subject_name }}
                    </h5>

                    <div class="text-muted small mb-3">
                        Subject Code: {{ $subject->subject_code }}
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-3">

                        <div>
                            <div class="text-muted small mb-1">
                                Academic Units
                            </div>

                            <h4 class="fw-bold mb-0 text-primary">
                                {{ $subject->units }}
                                <span class="fs-6 fw-normal">Units</span>
                            </h4>
                        </div>

                        <div class="subject-unit-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>

                    </div>


                    <div class="subject-meta-item">

                        <span class="text-muted small">
                            <i class="bi bi-calendar-plus me-2"></i>
                            Created
                        </span>

                        <span class="fw-semibold small">
                            {{ $subject->created_at?->format('M d, Y') ?? 'N/A' }}
                        </span>

                    </div>

                    <div class="subject-meta-item mt-3">

                        <span class="text-muted small">
                            <i class="bi bi-clock-history me-2"></i>
                            Last Updated
                        </span>

                        <span class="fw-semibold small">
                            {{ $subject->updated_at?->format('M d, Y') ?? 'N/A' }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- EDIT GUIDE --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <div class="edit-guide-icon mb-3">
                        <i class="bi bi-lightbulb"></i>
                    </div>

                    <h6 class="fw-bold mb-2">
                        Editing Guidelines
                    </h6>

                    <p class="text-muted small mb-3">
                        Please review the following before saving your changes.
                    </p>

                    <ul class="edit-guide-list small text-muted mb-0">

                        <li>
                            Verify the subject code and ensure it remains unique.
                        </li>

                        <li>
                            Use the official subject name.
                        </li>

                        <li>
                            Confirm the correct academic units.
                        </li>

                        <li>
                            Review the description before saving.

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

    .edit-subject-icon {
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

    .edit-premium-input {
        border-radius: 12px;
        overflow: hidden;
    }

    .edit-premium-input .input-group-text {
        background: #F8FAFC;
        border: 1px solid #E4E7EC;
        border-right: 0;
        color: #667085;
        padding: 0 15px;
    }

    .edit-premium-input .form-control,
    .edit-premium-input .form-select {
        min-height: 48px;
        border: 1px solid #E4E7EC;
        border-left: 0;
        box-shadow: none;
    }

    .edit-premium-input .form-control:focus,
    .edit-premium-input .form-select:focus {
        border-color: #6366F1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
    }

    .edit-premium-textarea {
        border: 1px solid #E4E7EC;
        border-radius: 12px;
        resize: vertical;
        box-shadow: none;
    }

    .edit-premium-textarea:focus {
        border-color: #6366F1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
    }

    .edit-premium-save-btn {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        border: none;
        border-radius: 12px;
        font-weight: 600;
        transition: all .25s ease;
    }

    .edit-premium-save-btn:hover {
        background: linear-gradient(135deg, #4F46E5, #4338CA);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, .25);
    }

    .subject-unit-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #E0E7FF;
        color: #4F46E5;
        border-radius: 12px;
        font-size: 18px;
    }

    .subject-meta-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .edit-guide-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #FFF7E6;
        color: #F59E0B;
        border-radius: 13px;
        font-size: 20px;
    }

    .edit-guide-list {
        padding-left: 18px;
    }

    .edit-guide-list li {
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .edit-guide-list li:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {

        .edit-premium-save-btn {
            min-height: 44px;
        }

    }

</style>

@endpush
