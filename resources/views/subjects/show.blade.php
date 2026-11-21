
@extends('layouts.app')

@section('title', 'Subject Details')

@section('page-heading')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <div class="text-muted small mb-1">
            Academic Management / Subjects / Details
        </div>
        <h2 class="fw-bold mb-1">Subject Details</h2>
        <p class="text-muted mb-0">
            View subject information and enrollment records.
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('subjects.index') }}" class="btn btn-light border">
            <i class="bi bi-arrow-left me-1"></i> Back to Subjects
        </a>

        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-1"></i> Edit Subject
        </a>
    </div>
</div>
@endsection

@section('content')

@php
    $enrollmentCount = $subject->enrollments->count();
    $activeCount = $subject->enrollments->where('status', 'Active')->count();
    $inactiveCount = $enrollmentCount - $activeCount;
@endphp

{{-- ================= SUBJECT PROFILE HEADER ================= --}}
<div class="subject-details-hero mb-4">

    <div class="subject-hero-left">

        <div class="subject-hero-icon">
            <i class="bi bi-journal-bookmark-fill"></i>
        </div>

        <div class="subject-hero-information">

            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                <span class="subject-details-code">
                    {{ $subject->subject_code }}
                </span>

                <span class="subject-details-status">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Subject Registered
                </span>
            </div>

            <h2 class="subject-hero-title">
                {{ $subject->subject_name }}
            </h2>

            <p class="subject-hero-subtitle mb-0">
                Academic subject profile and enrollment information
            </p>

        </div>

    </div>

    <div class="subject-hero-right">

        <div class="hero-units-label">
            Academic Units
        </div>

        <div class="hero-units-value">
            {{ $subject->units }}
            <span>{{ $subject->units > 1 ? 'Units' : 'Unit' }}</span>
        </div>

    </div>

</div>


{{-- ================= STATISTICS ================= --}}
<div class="row g-3 mb-4">

    {{-- TOTAL ENROLLMENTS --}}
    <div class="col-md-4">
        <div class="subject-detail-stat-card">

            <div class="subject-detail-stat-icon purple">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>
                <div class="subject-detail-stat-label">
                    Total Enrollments
                </div>

                <div class="subject-detail-stat-value">
                    {{ $enrollmentCount }}
                </div>

                <small class="text-muted">
                    Students enrolled in this subject
                </small>
            </div>

        </div>
    </div>


    {{-- ACTIVE --}}
    <div class="col-md-4">
        <div class="subject-detail-stat-card">

            <div class="subject-detail-stat-icon green">
                <i class="bi bi-person-check-fill"></i>
            </div>

            <div>
                <div class="subject-detail-stat-label">
                    Active Enrollments
                </div>

                <div class="subject-detail-stat-value">
                    {{ $activeCount }}
                </div>

                <small class="text-muted">
                    Currently active students
                </small>
            </div>

        </div>
    </div>


    {{-- OTHER STATUSES --}}
    <div class="col-md-4">
        <div class="subject-detail-stat-card">

            <div class="subject-detail-stat-icon orange">
                <i class="bi bi-person-dash-fill"></i>
            </div>

            <div>
                <div class="subject-detail-stat-label">
                    Other Statuses
                </div>

                <div class="subject-detail-stat-value">
                    {{ $inactiveCount }}
                </div>

                <small class="text-muted">
                    Inactive or other enrollment statuses
                </small>
            </div>

        </div>
    </div>

</div>


{{-- ================= SUBJECT INFORMATION ================= --}}
<div class="row g-4 mb-4">

    {{-- MAIN INFORMATION --}}
    <div class="col-lg-8">

        <div class="premium-card subject-detail-card h-100">

            <div class="subject-detail-card-header">

                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>
                        Subject Information
                    </h5>

                    <p class="text-muted small mb-0">
                        General information about this academic subject.
                    </p>
                </div>

            </div>


            <div class="subject-detail-body">

                {{-- SUBJECT CODE --}}
                <div class="subject-information-item">

                    <div class="subject-information-label">
                        <i class="bi bi-upc-scan"></i>
                        Subject Code
                    </div>

                    <div class="subject-information-value">
                        <span class="subject-code-large">
                            {{ $subject->subject_code }}
                        </span>
                    </div>

                </div>


                {{-- SUBJECT NAME --}}
                <div class="subject-information-item">

                    <div class="subject-information-label">
                        <i class="bi bi-book"></i>
                        Subject Name
                    </div>

                    <div class="subject-information-value">
                        {{ $subject->subject_name }}
                    </div>

                </div>


                {{-- UNITS --}}
                <div class="subject-information-item">

                    <div class="subject-information-label">
                        <i class="bi bi-calculator"></i>
                        Academic Units
                    </div>

                    <div class="subject-information-value">
                        <span class="detail-units-badge">
                            {{ $subject->units }}
                            {{ $subject->units > 1 ? 'Units' : 'Unit' }}
                        </span>
                    </div>

                </div>


                {{-- SUBJECT ID --}}
                <div class="subject-information-item">

                    <div class="subject-information-label">
                        <i class="bi bi-hash"></i>
                        Record ID
                    </div>

                    <div class="subject-information-value">
                        #{{ $subject->id }}
                    </div>

                </div>


                {{-- DESCRIPTION --}}
                <div class="subject-description-panel">

                    <div class="subject-information-label mb-3">
                        <i class="bi bi-card-text"></i>
                        Subject Description
                    </div>

                    @if($subject->description)

                        <p class="subject-full-description mb-0">
                            {{ $subject->description }}
                        </p>

                    @else

                        <div class="subject-no-description">
                            <i class="bi bi-info-circle me-1"></i>
                            No subject description has been provided.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- RECORD INFORMATION --}}
    <div class="col-lg-4">

        <div class="premium-card subject-record-card h-100">

            <div class="subject-detail-card-header">

                <div>
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Record Information
                    </h5>

                    <p class="text-muted small mb-0">
                        Subject record timestamps
                    </p>
                </div>

            </div>


            <div class="subject-record-body">

                {{-- CREATED --}}
                <div class="subject-timeline-item">

                    <div class="subject-timeline-icon created">
                        <i class="bi bi-plus-circle"></i>
                    </div>

                    <div class="subject-timeline-content">
                        <div class="subject-timeline-label">
                            Created
                        </div>

                        <div class="subject-timeline-value">
                            {{ $subject->created_at?->format('M d, Y') ?? 'N/A' }}
                        </div>

                        <small class="text-muted">
                            {{ $subject->created_at?->format('h:i A') ?? '' }}
                        </small>
                    </div>

                </div>


                {{-- UPDATED --}}
                <div class="subject-timeline-item">

                    <div class="subject-timeline-icon updated">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div class="subject-timeline-content">
                        <div class="subject-timeline-label">
                            Last Updated
                        </div>

                        <div class="subject-timeline-value">
                            {{ $subject->updated_at?->format('M d, Y') ?? 'N/A' }}
                        </div>

                        <small class="text-muted">
                            {{ $subject->updated_at?->format('h:i A') ?? '' }}
                        </small>
                    </div>

                </div>

            </div>


            {{-- QUICK ACTIONS --}}
            <div class="subject-quick-actions">

                <a href="{{ route('subjects.edit', $subject) }}"
                   class="btn btn-primary w-100">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Subject Information
                </a>

                <a href="{{ route('subjects.index') }}"
                   class="btn btn-outline-secondary w-100">
                    <i class="bi bi-list-ul me-2"></i>
                    View Subject Directory
                </a>

            </div>

        </div>

    </div>

</div>


{{-- ================= ENROLLMENT TABLE ================= --}}
<div class="premium-card subject-enrollment-card">

    <div class="subject-detail-card-header">

        <div>
            <h5 class="fw-bold mb-1">
                <i class="bi bi-people-fill text-primary me-2"></i>
                Enrolled Students
            </h5>

            <p class="text-muted small mb-0">
                Students currently recorded under this subject.
            </p>
        </div>

        <span class="badge rounded-pill bg-light text-dark border">
            {{ $enrollmentCount }} Records
        </span>

    </div>


    <div class="table-responsive">

        <table class="table premium-table align-middle mb-0">

            <thead>
                <tr>
                    <th style="width:150px;">Student Number</th>
                    <th>Student Information</th>
                    <th>School Year</th>
                    <th>Semester</th>
                    <th>Enrollment Date</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>


            <tbody>

                @forelse($subject->enrollments as $enrollment)

                    <tr>

                        {{-- STUDENT NUMBER --}}
                        <td>
                            @if($enrollment->student)
                                <span class="student-number-badge">
                                    {{ $enrollment->student->student_number }}
                                </span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>


                        {{-- STUDENT INFORMATION --}}
                        <td>

                            @if($enrollment->student)

                                <div class="enrolled-student-name">
                                    {{ $enrollment->student->last_name }},
                                    {{ $enrollment->student->first_name }}
                                    {{ $enrollment->student->middle_name }}
                                </div>

                                <div class="small text-muted">
                                    {{ $enrollment->student->course }}
                                </div>

                            @else

                                <span class="text-muted fst-italic">
                                    Student record unavailable
                                </span>

                            @endif

                        </td>


                        {{-- SCHOOL YEAR --}}
                        <td>
                            <span class="school-year-badge">
                                {{ $enrollment->school_year }}
                            </span>
                        </td>


                        {{-- SEMESTER --}}
                        <td>
                            {{ $enrollment->semester }}
                        </td>


                        {{-- DATE --}}
                        <td>
                            {{ $enrollment->enrollment_date?->format('M d, Y') ?? 'N/A' }}
                        </td>


                        {{-- STATUS --}}
                        <td class="text-center">

                            @if($enrollment->status == 'Active')

                                <span class="enrollment-status active">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Active
                                </span>

                            @else

                                <span class="enrollment-status inactive">
                                    {{ $enrollment->status }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6">

                            <div class="subject-enrollment-empty">

                                <div class="enrollment-empty-icon">
                                    <i class="bi bi-people"></i>
                                </div>

                                <h6 class="fw-bold mb-1">
                                    No Enrolled Students
                                </h6>

                                <p class="text-muted small mb-0">
                                    There are currently no enrollment records for this subject.
                                </p>

                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- TABLE FOOTER --}}
    <div class="subject-enrollment-footer">

        <div class="text-muted small">
            <i class="bi bi-database me-1"></i>
            Showing {{ $enrollmentCount }} enrollment record(s)
        </div>

    </div>

</div>


{{-- ================= DELETE SUBJECT ================= --}}
<div class="subject-danger-zone mt-4">

    <div class="subject-danger-zone-content">

        <div class="danger-zone-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

        <div>
            <h6 class="fw-bold mb-1">Delete Subject</h6>

            <p class="text-muted small mb-0">
                Permanently remove this subject from the academic records.
                Subjects with existing enrollments cannot be deleted.
            </p>
        </div>

    </div>

    <form action="{{ route('subjects.destroy', $subject) }}"
          method="POST"
          class="delete-subject-form-details">

        @csrf
        @method('DELETE')

        <button type="button"
                class="btn btn-outline-danger btn-delete-subject-details"
                data-subject-code="{{ $subject->subject_code }}"
                data-subject-name="{{ $subject->subject_name }}">
            <i class="bi bi-trash me-1"></i>
            Delete Subject
        </button>

    </form>

</div>

@endsection


{{-- ================= PREMIUM STYLES ================= --}}
@push('styles')
<style>

/* ================= HERO ================= */

.subject-details-hero {
    background: linear-gradient(135deg, #ffffff 0%, #f7f8ff 100%);
    border: 1px solid #e6eaf3;
    border-radius: 20px;
    padding: 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    box-shadow: 0 5px 20px rgba(15,23,42,.04);
}

.subject-hero-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

.subject-hero-icon {
    width: 76px;
    height: 76px;
    min-width: 76px;
    border-radius: 22px;
    background: linear-gradient(135deg, #6366f1, #818cf8);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    box-shadow: 0 8px 20px rgba(99,102,241,.2);
}

.subject-details-code {
    background: #eef2ff;
    color: #4f46e5;
    padding: 7px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .5px;
}

.subject-details-status {
    background: #ecfdf3;
    color: #15803d;
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
}

.subject-hero-title {
    color: #172033;
    font-size: 26px;
    font-weight: 800;
    margin-bottom: 5px;
}

.subject-hero-subtitle {
    color: #64748b;
    font-size: 13px;
}

.subject-hero-right {
    background: #f0f4ff;
    border: 1px solid #e0e7ff;
    padding: 18px 24px;
    border-radius: 16px;
    min-width: 160px;
    text-align: center;
}

.hero-units-label {
    color: #64748b;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 5px;
}

.hero-units-value {
    color: #4f46e5;
    font-size: 30px;
    font-weight: 800;
}

.hero-units-value span {
    font-size: 14px;
    font-weight: 600;
}


/* ================= STAT CARDS ================= */

.subject-detail-stat-card {
    background: #fff;
    border: 1px solid #e9edf5;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    height: 100%;
    box-shadow: 0 4px 14px rgba(15,23,42,.03);
}

.subject-detail-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    font-size: 21px;
}

.subject-detail-stat-icon.purple {
    background: #eeebff;
    color: #635bdb;
}

.subject-detail-stat-icon.green {
    background: #ecfdf3;
    color: #16a34a;
}

.subject-detail-stat-icon.orange {
    background: #fff2e5;
    color: #f59e0b;
}

.subject-detail-stat-label {
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 4px;
}

.subject-detail-stat-value {
    color: #172033;
    font-size: 24px;
    font-weight: 800;
    line-height: 1.2;
}


/* ================= CARDS ================= */

.subject-detail-card,
.subject-record-card,
.subject-enrollment-card {
    background: #fff;
    border: 1px solid #e8edf5;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(15,23,42,.04);
}

.subject-detail-card-header,
.subject-detail-card .subject-detail-card-header,
.subject-record-card .subject-detail-card-header,
.subject-enrollment-card .subject-detail-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 22px 24px;
    border-bottom: 1px solid #edf0f5;
}

.subject-detail-body {
    padding: 24px;
}


/* ================= INFORMATION ITEMS ================= */

.subject-information-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 17px 0;
    border-bottom: 1px solid #f0f2f6;
}

.subject-information-item:last-of-type {
    border-bottom: none;
}

.subject-information-label {
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
}

.subject-information-label i {
    color: #6366f1;
    width: 20px;
    display: inline-block;
    margin-right: 6px;
}

.subject-information-value {
    color: #172033;
    font-size: 14px;
    font-weight: 700;
    text-align: right;
}

.subject-code-large {
    display: inline-block;
    padding: 8px 12px;
    border-radius: 9px;
    background: #eef2ff;
    color: #4f46e5;
    font-size: 13px;
    font-weight: 800;
}

.detail-units-badge {
    background: #ecfdf3;
    color: #15803d;
    border-radius: 20px;
    padding: 7px 13px;
    font-size: 12px;
    font-weight: 800;
}


/* ================= DESCRIPTION ================= */

.subject-description-panel {
    margin-top: 20px;
    background: #f8fafc;
    border: 1px solid #edf0f5;
    border-radius: 14px;
    padding: 20px;
}

.subject-full-description {
    color: #475569;
    font-size: 14px;
    line-height: 1.8;
    white-space: pre-line;
}

.subject-no-description {
    color: #94a3b8;
    font-size: 13px;
    font-style: italic;
}


/* ================= RECORD TIMELINE ================= */

.subject-record-body {
    padding: 24px;
}

.subject-timeline-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding-bottom: 26px;
    position: relative;
}

.subject-timeline-item:last-child {
    padding-bottom: 0;
}

.subject-timeline-item:not(:last-child)::after {
    content: "";
    position: absolute;
    left: 18px;
    top: 42px;
    bottom: 4px;
    width: 2px;
    background: #e9edf5;
}

.subject-timeline-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
}

.subject-timeline-icon.created {
    background: #ecfdf3;
    color: #16a34a;
}

.subject-timeline-icon.updated {
    background: #eef2ff;
    color: #6366f1;
}

.subject-timeline-label {
    color: #64748b;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 4px;
}

.subject-timeline-value {
    color: #172033;
    font-size: 14px;
    font-weight: 700;
}

.subject-quick-actions {
    padding: 20px 24px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    border-top: 1px solid #edf0f5;
}


/* ================= ENROLLMENT TABLE ================= */

.subject-enrollment-card .premium-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding: 15px 18px;
    white-space: nowrap;
    border-bottom: 1px solid #e9edf5;
}

.subject-enrollment-card .premium-table tbody td {
    padding: 16px 18px;
    border-bottom: 1px solid #f0f2f6;
}

.subject-enrollment-card .premium-table tbody tr:hover {
    background: #fafbff;
}

.student-number-badge {
    background: #eef2ff;
    color: #4f46e5;
    padding: 6px 9px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 800;
    white-space: nowrap;
}

.enrolled-student-name {
    color: #172033;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 3px;
}

.school-year-badge {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
    padding: 6px 9px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.enrollment-status {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.enrollment-status.active {
    background: #ecfdf3;
    color: #15803d;
}

.enrollment-status.inactive {
    background: #f1f5f9;
    color: #64748b;
}


/* ================= EMPTY ENROLLMENT ================= */

.subject-enrollment-empty {
    text-align: center;
    padding: 45px 20px;
}

.enrollment-empty-icon {
    width: 58px;
    height: 58px;
    border-radius: 17px;
    background: #f1f5f9;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin: 0 auto 14px;
}

.subject-enrollment-footer {
    padding: 16px 24px;
    background: #fafbfe;
    border-top: 1px solid #edf0f5;
}


/* ================= DANGER ZONE ================= */

.subject-danger-zone {
    border: 1px solid #fee2e2;
    background: #fffafa;
    border-radius: 16px;
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.subject-danger-zone-content {
    display: flex;
    align-items: center;
    gap: 14px;
}

.danger-zone-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    border-radius: 12px;
    background: #fee2e2;
    color: #dc2626;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}


/* ================= RESPONSIVE ================= */

@media (max-width: 991px) {

    .subject-details-hero {
        align-items: flex-start;
    }

}

@media (max-width: 768px) {

    .subject-details-hero {
        flex-direction: column;
        padding: 20px;
    }

    .subject-hero-left {
        align-items: flex-start;
        gap: 14px;
    }

    .subject-hero-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;
        font-size: 24px;
        border-radius: 16px;
    }

    .subject-hero-title {
        font-size: 21px;
    }

    .subject-hero-right {
        width: 100%;
    }

    .subject-detail-body {
        padding: 18px;
    }

    .subject-information-item {
        align-items: flex-start;
        flex-direction: column;
        gap: 8px;
    }

    .subject-information-value {
        text-align: left;
    }

    .subject-danger-zone {
        align-items: flex-start;
        flex-direction: column;
    }

    .subject-danger-zone form {
        width: 100%;
    }

    .subject-danger-zone button {
        width: 100%;
    }

}

</style>
@endpush


{{-- ================= SCRIPTS ================= --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // DELETE SUBJECT CONFIRMATION
    // ==========================================
    document.addEventListener('click', function (event) {

        const deleteButton = event.target.closest(
            '.btn-delete-subject-details'
        );

        if (!deleteButton) return;

        const form = deleteButton.closest(
            '.delete-subject-form-details'
        );

        if (!form) return;

        const subjectCode = deleteButton.dataset.subjectCode || '';
        const subjectName = deleteButton.dataset.subjectName || '';

        // Fallback if SIMSAlert is unavailable
        if (typeof SIMSAlert === 'undefined') {

            if (confirm(
                'Delete ' + subjectCode + ' - ' + subjectName + '?'
            )) {
                form.submit();
            }

            return;
        }

        SIMSAlert.confirmDelete({
            title: 'Delete Subject?',
            text: 'You are about to delete ' + subjectCode +
                  ' - ' + subjectName + '.',
            confirmText: 'Yes, Delete',
            cancelText: 'Cancel',
            confirmColor: '#dc3545',
            cancelColor: '#64748b'
        }).then(function (result) {

            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Deleting Subject...',
                    text: 'Please wait.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                form.submit();
            }

        });

    });

});
</script>
@endpush
