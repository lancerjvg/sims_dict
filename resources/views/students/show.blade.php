@extends('layouts.app')

@section('page-heading', 'Student Profile')

@section('content')

@php
    $year = (int) $student->year_level;

    $yearSuffix = match ($year) {
        1 => 'st',
        2 => 'nd',
        3 => 'rd',
        default => 'th',
    };

    $fullName = trim(
        $student->first_name . ' ' .
        ($student->middle_name ? $student->middle_name . ' ' : '') .
        $student->last_name
    );

    $photoUrl = $student->photo
        ? asset('storage/' . $student->photo)
        : null;
@endphp

<div class="container-fluid px-3 px-md-4 pb-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1 profile-title">
                <i class="bi bi-person-badge-fill me-2"></i>
                Student Profile
            </h3>

            <p class="text-muted mb-0">
                Student information, academic details, and enrollment records.
            </p>
        </div>

        <a href="{{ route('students.index') }}"
           class="btn btn-outline-secondary rounded-3 px-3">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Students
        </a>

    </div>

    <!-- PROFILE HEADER CARD -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

        <div class="profile-cover">
            <div class="profile-cover-content">
                <h4 class="profile-cover-title mb-1">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    Student Profile
                </h4>
                <p class="profile-cover-subtitle mb-0">
                    Student information, academic details, and enrollment records.
                </p>
            </div>
        </div>

        <div class="card-body px-3 px-md-4 pb-4">

            <div class="row align-items-end g-3 profile-header-row">

                <!-- PHOTO -->
                <div class="col-md-auto text-center text-md-start">

                    <div class="profile-photo-container mx-auto mx-md-0">

                        @if($photoUrl)
                            <img src="{{ $photoUrl }}"
                                 alt="{{ $fullName }}"
                                 class="profile-photo"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">

                            <div class="profile-photo-placeholder"
                                 style="display:none;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        @else
                            <div class="profile-photo-placeholder">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        @endif

                    </div>

                </div>

                <!-- NAME AND INFO -->
                <div class="col">

                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">

                        <h3 class="fw-bold mb-0 profile-name">
                            {{ $fullName }}
                        </h3>

                        <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Registered
                        </span>

                    </div>

                    <div class="text-muted mb-3">
                        <i class="bi bi-card-heading me-1"></i>
                        Student No.
                        <strong class="text-dark">
                            {{ $student->student_number }}
                        </strong>
                    </div>

                    <div class="d-flex flex-wrap gap-2">

                        <span class="profile-badge">
                            <i class="bi bi-mortarboard-fill me-1"></i>
                            {{ $student->course }}
                        </span>

                        <span class="profile-badge">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $year }}{{ $yearSuffix }} Year
                        </span>

                        @if($student->gender)
                            <span class="profile-badge">
                                <i class="bi bi-person-fill me-1"></i>
                                {{ $student->gender }}
                            </span>
                        @endif

                    </div>

                </div>

                <!-- ACTIONS -->
                <div class="col-md-auto">

                    <div class="d-flex flex-wrap gap-2 justify-content-center">

                        <a href="{{ route('students.edit', $student->id) }}"
                           class="btn btn-indigo rounded-3 px-3">
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit Profile
                        </a>

                        <form action="{{ route('students.destroy', $student->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this student?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-outline-danger rounded-3 px-3">
                                <i class="bi bi-trash me-1"></i>
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- PERSONAL INFORMATION -->
    <div class="row g-4 mb-4">

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-bottom p-3">
                    <h5 class="fw-bold mb-0 profile-section-title">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        Personal Information
                    </h5>
                </div>

                <div class="card-body p-3 p-md-4">

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <small class="text-muted">First Name</small>
                            <div class="fw-semibold">
                                {{ $student->first_name ?: '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <small class="text-muted">Middle Name</small>
                            <div class="fw-semibold">
                                {{ $student->middle_name ?: '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                            <small class="text-muted">Last Name</small>
                            <div class="fw-semibold">
                                {{ $student->last_name ?: '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-gender-ambiguous"></i>
                        </div>
                        <div>
                            <small class="text-muted">Gender</small>
                            <div class="fw-semibold">
                                {{ $student->gender ?: '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-calendar-heart"></i>
                        </div>
                        <div>
                            <small class="text-muted">Birth Date</small>
                            <div class="fw-semibold">
                                @if($student->birth_date)
                                    {{ \Carbon\Carbon::parse($student->birth_date)->format('F d, Y') }}
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($student->birth_date)
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <div>
                                <small class="text-muted">Age</small>
                                <div class="fw-semibold">
                                    {{ \Carbon\Carbon::parse($student->birth_date)->age }} years old
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>

        </div>

        <!-- CONTACT INFORMATION -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-bottom p-3">
                    <h5 class="fw-bold mb-0 profile-section-title">
                        <i class="bi bi-telephone-fill me-2"></i>
                        Contact Information
                    </h5>
                </div>

                <div class="card-body p-3 p-md-4">

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted">Email Address</small>
                            <div class="fw-semibold text-break">
                                @if($student->email)
                                    <a href="mailto:{{ $student->email }}"
                                       class="profile-link">
                                        {{ $student->email }}
                                    </a>
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-phone-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted">Contact Number</small>
                            <div class="fw-semibold">
                                @if($student->contact_number)
                                    <a href="tel:{{ $student->contact_number }}"
                                       class="profile-link">
                                        {{ $student->contact_number }}
                                    </a>
                                @else
                                    —
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted">Address</small>
                            <div class="fw-semibold">
                                {{ $student->address ?: '—' }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                        <div>
                            <small class="text-muted">Course</small>
                            <div class="fw-semibold">
                                {{ $student->course ?: '—' }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="bi bi-calendar3"></i>
                        </div>
                        <div>
                            <small class="text-muted">Year Level</small>
                            <div class="fw-semibold">
                                {{ $year }}{{ $yearSuffix }} Year
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ENROLLMENT SECTION -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

        <div class="card-header bg-white border-bottom p-3 p-md-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>
                    <h5 class="fw-bold mb-1 profile-section-title">
                        <i class="bi bi-journal-bookmark-fill me-2"></i>
                        Enrollment Records
                    </h5>

                    <small class="text-muted">
                        Subjects currently associated with this student
                    </small>
                </div>

                <span class="badge rounded-pill bg-indigo-subtle text-indigo px-3 py-2">
                    {{ $student->enrollments->count() }} Enrollment(s)
                </span>

            </div>

        </div>

        <div class="card-body p-0">

            @if($student->enrollments->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Subject</th>
                                <th>Subject Details</th>
                                <th class="text-end pe-4">Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($student->enrollments as $index => $enrollment)

                                @php
                                    $subject = $enrollment->subject;
                                @endphp

                                <tr>

                                    <td class="ps-4 text-muted">
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        <div class="fw-semibold">
                                            @if($subject)
                                                {{ $subject->name ?? $subject->subject_name ?? $subject->subject_code ?? 'Subject' }}
                                            @else
                                                Subject
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <small class="text-muted">
                                            @if($subject)
                                                {{ $subject->subject_code ?? $subject->code ?? '—' }}
                                            @else
                                                —
                                            @endif
                                        </small>
                                    </td>

                                    <td class="text-end pe-4">
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Enrolled
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5 px-3">

                    <div class="empty-enrollment-icon mb-3">
                        <i class="bi bi-journal-x"></i>
                    </div>

                    <h6 class="fw-bold mb-1">No Enrollment Records</h6>

                    <p class="text-muted small mb-0">
                        No subjects have been enrolled for this student yet.
                    </p>

                </div>

            @endif

        </div>

    </div>

    <!-- RECORD INFORMATION -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-3 p-md-4">

            <div class="d-flex flex-wrap gap-4">

                <div>
                    <small class="text-muted d-block">Record Created</small>
                    <strong>
                        @if($student->created_at)
                            {{ $student->created_at->format('M d, Y h:i A') }}
                        @else
                            —
                        @endif
                    </strong>
                </div>

                <div>
                    <small class="text-muted d-block">Last Updated</small>
                    <strong>
                        @if($student->updated_at)
                            {{ $student->updated_at->format('M d, Y h:i A') }}
                        @else
                            —
                        @endif
                    </strong>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')

<style>
    .profile-title {
        color: #312e81;
    }

    .profile-cover {
        height: 115px;
        background: linear-gradient(135deg, #4338ca, #6366f1, #818cf8);
        display: flex;
        align-items: center;
        padding: 0 1.5rem;
    }


    .profile-cover-content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .profile-cover-title {
        color: #fff;
        font-weight: 700;
        letter-spacing: .3px;
    }

    .profile-cover-subtitle {
        color: rgba(255, 255, 255, .95);
        font-size: .875rem;
    }

    .profile-header-row {
        margin-top: -55px;
    }

    .profile-photo-container {
        width: 145px;
        height: 145px;
        border-radius: 50%;
        border: 5px solid #fff;
        background: #eef2ff;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(49,46,129,.18);
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .profile-photo-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
        background: #eef2ff;
    }

    .profile-photo-placeholder i {
        font-size: 85px;
    }

    .profile-name {
        color: #312e81;
    }

    .profile-badge {
        display: inline-flex;
        align-items: center;
        background: #eef2ff;
        color: #4338ca;
        border: 1px solid #e0e7ff;
        border-radius: 50px;
        padding: 7px 12px;
        font-size: 13px;
        font-weight: 600;
    }

    .profile-section-title {
        color: #312e81;
    }

    .btn-indigo {
        background: #4f46e5;
        color: #fff;
        border: 1px solid #4f46e5;
    }

    .btn-indigo:hover {
        background: #4338ca;
        color: #fff;
    }

    .bg-indigo-subtle {
        background: #eef2ff;
    }

    .text-indigo {
        color: #4338ca;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 12px 0;
    }

    .info-item + .info-item {
        border-top: 1px solid #f1f3f8;
    }

    .info-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #4f46e5;
        font-size: 16px;
    }

    .profile-link {
        color: #4338ca;
        text-decoration: none;
    }

    .profile-link:hover {
        text-decoration: underline;
    }

    .empty-enrollment-icon {
        width: 65px;
        height: 65px;
        background: #eef2ff;
        color: #6366f1;
        border-radius: 18px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    @media(max-width:767px) {
        .profile-cover {
            height: 90px;
        }

        .profile-header-row {
            margin-top: -45px;
        }

        .profile-photo-container {
            width: 125px;
            height: 125px;
        }

        .profile-name {
            font-size: 1.25rem;
        }
    }
</style>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endpush
