@extends('layouts.app')

@section('page-heading', 'Student Management')

@section('content')

<div class="container-fluid px-3 px-md-4 pb-4">

    <!-- ================= PAGE HEADER ================= -->
    <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1 directory-title">
                Student Management
            </h2>

            <h5 class="fw-semibold text-secondary mb-1">
                Manage student profiles, academic records, and information.
            </h5>

            <small class="text-muted">
                Student Information Management System
            </small>
        </div>

        <a href="{{ route('students.create') }}"
           class="btn btn-indigo rounded-3 px-3 py-2">

            <i class="bi bi-person-plus-fill me-1"></i>
            Add New Student
        </a>

    </div>

    <!-- ================= STATISTICS ================= -->
    <div class="row g-3 mb-4">

        <!-- TOTAL STUDENTS -->
        <div class="col-md-4">
            <div class="stat-card h-100">

                <div class="stat-icon stat-purple">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div>
                    <small class="stat-label">Total Students</small>

                    <h3 class="fw-bold mb-1">
                        {{ $students->total() }}
                    </h3>

                    <small class="text-muted">
                        Matching student records
                    </small>
                </div>

            </div>
        </div>

        <!-- SHOWING RECORDS -->
        <div class="col-md-4">
            <div class="stat-card h-100">

                <div class="stat-icon stat-blue">
                    <i class="bi bi-list-ul"></i>
                </div>

                <div>
                    <small class="stat-label">Showing Records</small>

                    <h3 class="fw-bold mb-1">
                        {{ $students->count() }}
                    </h3>

                    <small class="text-muted">
                        Records on this page
                    </small>
                </div>

            </div>
        </div>

        <!-- CURRENT FILTER -->
        <div class="col-md-4">
            <div class="stat-card h-100">

                <div class="stat-icon stat-orange">
                    <i class="bi bi-funnel-fill"></i>
                </div>

                <div>
                    <small class="stat-label">Current Filter</small>

                    <h5 class="fw-bold mb-1">
                        {{ request('course') ?: 'All Students' }}
                    </h5>

                    <small class="text-muted">
                        Directory filter status
                    </small>
                </div>

            </div>
        </div>

    </div>

    <!-- ================= STUDENT DIRECTORY ================= -->
    <div class="card directory-card border-0 shadow-sm rounded-4 overflow-hidden">

        <!-- DIRECTORY HEADER -->
        <div class="card-header bg-white border-bottom px-3 px-md-4 py-3">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>
                    <h5 class="fw-bold mb-1 directory-section-title">
                        <i class="bi bi-person-vcard-fill text-primary me-2"></i>
                        Student Directory
                    </h5>

                    <small class="text-muted">
                        Search, filter, sort, and manage student records.
                    </small>
                </div>

                <span class="badge rounded-pill bg-light text-dark border">
                    {{ $students->total() }} Records
                </span>

            </div>

        </div>

        <!-- ================= FILTERS ================= -->
        <div class="directory-filter-area px-3 px-md-4 py-4">

            <form action="{{ route('students.index') }}"
                  method="GET"
                  id="studentFilterForm">

                <input type="hidden" name="sort" value="last_name">

                <input type="hidden"
                       name="direction"
                       id="sortDirection"
                       value="{{ request('direction', 'asc') }}">

                <div class="row g-3">

                    <!-- SEARCH -->
                    <div class="col-lg-6">

                        <label for="studentSearch"
                               class="form-label fw-semibold small">
                            Search Student
                        </label>

                        <div class="input-group search-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input type="text"
                                   name="search"
                                   id="studentSearch"
                                   class="form-control"
                                   value="{{ request('search') }}"
                                   placeholder="Student number, name, or course..."
                                   autocomplete="off">

                            @if(request('search'))
                                <a href="{{ route('students.index', array_filter([
                                    'course' => request('course'),
                                    'sort' => 'last_name',
                                    'direction' => request('direction', 'asc')
                                ])) }}"
                                   class="btn btn-outline-secondary"
                                   title="Clear search">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif

                        </div>

                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-lightning-fill text-warning me-1"></i>
                            Automatic search after 2 characters
                        </small>

                    </div>

                    <!-- COURSE FILTER -->
                    <div class="col-lg-3">

                        <label for="courseFilter"
                               class="form-label fw-semibold small">
                            Filter by Course
                        </label>

                        <select name="course"
                                id="courseFilter"
                                class="form-select">

                            <option value="">All Courses</option>

                            @foreach($courses as $course)
                                <option value="{{ $course }}"
                                    {{ request('course') == $course ? 'selected' : '' }}>
                                    {{ $course }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- SORT -->
                    <div class="col-lg-3">

                        <label for="sortFilter"
                               class="form-label fw-semibold small">
                            Sort Student Information
                        </label>

                        <select id="sortFilter"
                                class="form-select">

                            <option value="asc"
                                {{ request('direction', 'asc') == 'asc' ? 'selected' : '' }}>
                                A - Z
                            </option>

                            <option value="desc"
                                {{ request('direction') == 'desc' ? 'selected' : '' }}>
                                Z - A
                            </option>

                        </select>

                    </div>

                </div>

            </form>

        </div>

        <!-- ================= TABLE ================= -->
        <div class="table-responsive directory-table-wrapper">

            <table class="table directory-table align-middle mb-0">

                <thead>
                    <tr>
                        <th class="student-number-column">STUDENT NUMBER</th>
                        <th>STUDENT INFORMATION</th>
                        <th>COURSE</th>
                        <th class="text-center">YEAR LEVEL</th>
                        <th class="text-center actions-column">ACTIONS</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($students as $student)

                        @php
                            $year = (int) $student->year_level;

                            $suffix = match($year) {
                                1 => 'st',
                                2 => 'nd',
                                3 => 'rd',
                                default => 'th',
                            };

                            $studentName = trim(
                                $student->last_name . ', ' .
                                $student->first_name . ' ' .
                                ($student->middle_name ?? '')
                            );
                        @endphp

                        <tr>

                            <!-- STUDENT NUMBER -->
                            <td>

                                <span class="student-number-badge">
                                    {{ $student->student_number }}
                                </span>

                            </td>

                            <!-- STUDENT INFORMATION + PHOTO -->
                            <td>

                                <div class="d-flex align-items-center gap-3 student-info-cell">

                                    <!-- PHOTO -->
                                    <div class="student-avatar">

                                        @if($student->photo)
                                            <img src="{{ asset('storage/' . $student->photo) }}"
                                                 alt="{{ $studentName }}"
                                                 loading="lazy"
                                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">

                                            <div class="student-avatar-placeholder"
                                                 style="display:none;">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        @else
                                            <div class="student-avatar-placeholder">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        @endif

                                    </div>

                                    <!-- NAME / EMAIL -->
                                    <div class="student-text">

                                        <a href="{{ route('students.show', $student->id) }}"
                                           class="student-name-link">

                                            {{ $studentName }}

                                        </a>

                                        <small class="student-id-text d-block">
                                            Student ID: #{{ $student->id }}
                                        </small>

                                        @if($student->email)
                                            <small class="student-email d-block mt-1">
                                                <i class="bi bi-envelope me-1"></i>
                                                {{ $student->email }}
                                            </small>
                                        @endif

                                    </div>

                                </div>

                            </td>

                            <!-- COURSE -->
                            <td>

                                <span class="course-badge">
                                    {{ $student->course }}
                                </span>

                            </td>

                            <!-- YEAR LEVEL -->
                            <td class="text-center">

                                <span class="year-badge">
                                    {{ $year }}{{ $suffix }} Year
                                </span>

                            </td>

                            <!-- ACTIONS -->
                            <td>

                                <div class="d-flex justify-content-center align-items-center gap-2">

                                    <!-- VIEW -->
                                    <a href="{{ route('students.show', $student->id) }}"
                                       class="btn btn-action btn-view"
                                       title="View Student">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- EDIT -->
                                    <a href="{{ route('students.edit', $student->id) }}"
                                       class="btn btn-action btn-edit"
                                       title="Edit Student">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('students.destroy', $student->id) }}"
                                          method="POST"
                                          class="delete-student-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-action btn-delete"
                                                title="Delete Student">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <!-- EMPTY STATE -->
                        <tr>
                            <td colspan="5">

                                <div class="empty-state py-5 text-center">

                                    <div class="empty-state-icon mb-3">
                                        <i class="bi bi-people"></i>
                                    </div>

                                    <h5 class="fw-bold mb-1">
                                        No Students Found
                                    </h5>

                                    <p class="text-muted mb-3">
                                        No student records match your search or filter.
                                    </p>

                                    <a href="{{ route('students.index') }}"
                                       class="btn btn-outline-primary rounded-3">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                                        Clear Filters
                                    </a>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- ================= PAGINATION ================= -->
        <div class="directory-footer px-3 px-md-4 py-3">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <small class="text-muted">

                    @if($students->total() > 0)
                        Showing {{ $students->firstItem() }} to
                        {{ $students->lastItem() }} of
                        {{ $students->total() }} students
                    @else
                        Showing 0 students
                    @endif

                </small>

                <div>
                    {{ $students->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')

<style>
    /* ================= GENERAL ================= */
    .directory-title {
        color: #111827;
        font-size: 1.8rem;
    }

    .directory-section-title {
        color: #111827;
    }

    .btn-indigo {
        background: #6366f1;
        color: #fff;
        border: 1px solid #6366f1;
    }

    .btn-indigo:hover {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
    }

    /* ================= STAT CARDS ================= */
    .stat-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 18px;
        padding: 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 4px 12px rgba(15,23,42,.035);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .stat-purple {
        color: #635bdb;
        background: #f0edff;
    }

    .stat-blue {
        color: #2563eb;
        background: #e8f1ff;
    }

    .stat-orange {
        color: #f59e0b;
        background: #fff3e5;
    }

    .stat-label {
        color: #64748b;
        display: block;
        margin-bottom: 2px;
    }

    /* ================= DIRECTORY CARD ================= */
    .directory-card {
        border: 1px solid #e7edf5 !important;
    }

    .directory-filter-area {
        background: #f8faff;
        border-bottom: 1px solid #e7edf5;
    }

    .search-group .input-group-text {
        border-color: #dbe3ef;
        color: #64748b;
    }

    .search-group .form-control {
        border-color: #dbe3ef;
        min-height: 44px;
    }

    .search-group .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 .15rem rgba(99,102,241,.12);
    }

    .directory-filter-area .form-select {
        min-height: 44px;
        border-color: #dbe3ef;
    }

    /* ================= TABLE ================= */
    .directory-table {
        min-width: 1050px;
    }

    .directory-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .45px;
        padding: 16px 18px;
        border-bottom: 1px solid #e5eaf2;
        white-space: nowrap;
    }

    .directory-table tbody td {
        padding: 16px 18px;
        border-bottom: 1px solid #e9eef5;
    }

    .directory-table tbody tr:hover {
        background: #fafbff;
    }

    .student-number-column {
        width: 160px;
    }

    .actions-column {
        width: 150px;
    }

    /* ================= PHOTO ================= */
    .student-avatar {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 14px;
        overflow: hidden;
        background: #eef2ff;
        border: 1px solid #e0e7ff;
    }

    .student-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .student-avatar-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #6366f1;
        font-size: 21px;
    }

    .student-name-link {
        color: #111827;
        font-weight: 700;
        text-decoration: none;
        font-size: 14px;
    }

    .student-name-link:hover {
        color: #4f46e5;
    }

    .student-id-text {
        font-size: 11px;
        color: #64748b;
    }

    .student-email {
        color: #64748b;
        font-size: 12px;
    }

    /* ================= BADGES ================= */
    .student-number-badge {
        display: inline-block;
        padding: 8px 12px;
        background: #eef2ff;
        color: #4f46e5;
        border-radius: 9px;
        font-weight: 700;
        font-size: 12px;
        white-space: nowrap;
    }

    .course-badge {
        display: inline-block;
        background: #f1f5f9;
        color: #334155;
        padding: 8px 10px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        max-width: 160px;
        white-space: normal;
        line-height: 1.4;
    }

    .year-badge {
        display: inline-block;
        background: #ecfdf5;
        color: #059669;
        padding: 7px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* ================= ACTION BUTTONS ================= */
    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        background: #fff;
    }

    .btn-view {
        border: 1px solid #3b82f6;
        color: #2563eb;
    }

    .btn-view:hover {
        background: #eff6ff;
    }

    .btn-edit {
        border: 1px solid #f59e0b;
        color: #d97706;
    }

    .btn-edit:hover {
        background: #fffbeb;
    }

    .btn-delete {
        border: 1px solid #ef4444;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #fef2f2;
    }

    .delete-student-form {
        margin: 0;
    }

    /* ================= EMPTY STATE ================= */
    .empty-state-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: #eef2ff;
        color: #6366f1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin: auto;
    }

    /* ================= FOOTER ================= */
    .directory-footer {
        background: #fff;
    }

    .directory-footer .pagination {
        margin-bottom: 0;
    }

    /* ================= RESPONSIVE ================= */
    @media(max-width:767px) {

        .directory-title {
            font-size: 1.5rem;
        }

        .stat-card {
            padding: 17px;
        }

        .directory-footer > div {
            flex-direction: column;
            align-items: flex-start !important;
        }

    }
</style>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endpush

@push('scripts')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('studentFilterForm');
    const searchInput = document.getElementById('studentSearch');
    const courseFilter = document.getElementById('courseFilter');
    const sortFilter = document.getElementById('sortFilter');
    const directionInput = document.getElementById('sortDirection');

    let searchTimer = null;

    // ================= SEARCH =================
    searchInput.addEventListener('input', function () {

        clearTimeout(searchTimer);

        const value = this.value.trim();

        // Auto search after 2 characters
        if (value.length >= 2) {
            searchTimer = setTimeout(function () {
                form.submit();
            }, 500);
        }

        // Reset directory when search is cleared
        if (value.length === 0) {
            searchTimer = setTimeout(function () {
                form.submit();
            }, 300);
        }

    });

    // ================= COURSE FILTER =================
    courseFilter.addEventListener('change', function () {
        form.submit();
    });

    // ================= SORT =================
    sortFilter.addEventListener('change', function () {

        directionInput.value = this.value;

        form.submit();
    });

    // ================= SWEETALERT DELETE CONFIRMATION =================
    document.querySelectorAll('.delete-student-form').forEach(function (deleteForm) {

        deleteForm.addEventListener('submit', function (e) {
            e.preventDefault();

            if (typeof Swal === 'undefined') {
                // Fallback if SweetAlert2 CDN is unavailable
                if (confirm('Are you sure you want to delete this student record?')) {
                    deleteForm.submit();
                }
                return;
            }

            Swal.fire({
                title: 'Delete Student?',
                text: 'Are you sure you want to delete this student record? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
                focusCancel: true
            }).then(function (result) {
                if (result.isConfirmed) {
                    deleteForm.submit();
                }
            });
        });
    });

});
</script>

@endpush
