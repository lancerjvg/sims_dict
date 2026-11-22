
@extends('layouts.app')

@section('title', 'SIMS Dashboard')
@section('page-heading', 'Dashboard')

@section('content')

<div class="container-fluid dashboard-page">

    <!-- WELCOME -->
    <div class="mb-4">
        <h3 class="fw-semibold">Welcome, {{ Auth::user()->name }}!</h3>
        <p class="text-muted mb-0">Student Information Management System</p>
    </div>

    <!-- STATISTICS -->
    <div class="row g-4 mb-4">

        <!-- TOTAL STUDENTS -->
        <div class="col-md-6 col-xl-3">
            <div class="card dashboard-stat bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Total Students</div>
                            <h2 class="stat-number">{{ $totalStudents }}</h2>
                        </div>
                        <i class="bi bi-people stat-icon"></i>
                    </div>
                    <small>Registered Students</small>
                </div>
            </div>
        </div>

        <!-- TOTAL SUBJECTS -->
        <div class="col-md-6 col-xl-3">
            <div class="card dashboard-stat bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Total Subjects</div>
                            <h2 class="stat-number">{{ $totalSubjects }}</h2>
                        </div>
                        <i class="bi bi-book stat-icon"></i>
                    </div>
                    <small>Available Subjects</small>
                </div>
            </div>
        </div>

        <!-- TOTAL ENROLLMENTS -->
        <div class="col-md-6 col-xl-3">
            <div class="card dashboard-stat bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Total Enrollments</div>
                            <h2 class="stat-number">{{ $totalEnrollments }}</h2>
                        </div>
                        <i class="bi bi-journal-check stat-icon"></i>
                    </div>
                    <small>Student Subject Records</small>
                </div>
            </div>
        </div>

        <!-- SYSTEM USERS -->
        <div class="col-md-6 col-xl-3">
            <div class="card dashboard-stat bg-dark text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">System Users</div>
                            <h2 class="stat-number">{{ $totalUsers }}</h2>
                        </div>
                        <i class="bi bi-person-lock stat-icon"></i>
                    </div>
                    <small>Registered Accounts</small>
                </div>
            </div>
        </div>

    </div>

    <!-- COURSE DISTRIBUTION & ENROLLMENT STATUS -->
    <div class="row g-4 mb-4">

        <!-- STUDENTS BY COURSE -->
        <div class="col-lg-7">

            <div class="card dashboard-card h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div>
                            <h5 class="fw-semibold mb-1">
                                <i class="bi bi-bar-chart-fill text-primary me-2"></i>
                                Students by Course
                            </h5>
                            <p class="text-muted small mb-0">
                                Distribution across registered courses
                            </p>
                        </div>

                        <a href="{{ route('students.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            View Students
                        </a>
                    </div>

                    @php
                        $maxCourseStudents = $studentsByCourse->max('total_students') ?? 0;

                        $courseColors = [
                            ['#2563eb', '#60a5fa'],
                            ['#059669', '#34d399'],
                            ['#f59e0b', '#fbbf24'],
                            ['#8b5cf6', '#c084fc'],
                            ['#ec4899', '#f472b6'],
                            ['#06b6d4', '#67e8f9'],
                            ['#f97316', '#fb923c'],
                            ['#14b8a6', '#5eead4'],
                            ['#6366f1', '#818cf8'],
                            ['#ef4444', '#f87171'],
                        ];
                    @endphp

                    <div class="course-distribution mt-4">

                        @forelse($studentsByCourse as $courseIndex => $course)

                            @php
                                $percentage = $totalStudents > 0
                                    ? ($course->total_students / $totalStudents) * 100
                                    : 0;

                                $barWidth = $maxCourseStudents > 0
                                    ? ($course->total_students / $maxCourseStudents) * 100
                                    : 0;

                                $color = $courseColors[$courseIndex % count($courseColors)];
                            @endphp

                            <div class="course-item mb-4">

                                <div class="d-flex justify-content-between align-items-center mb-2 gap-2">

                                    <div class="course-name fw-medium">
                                        {{ $course->course }}
                                    </div>

                                    <span class="course-count-badge"
                                          style="--course-color: {{ $color[0] }};">
                                        {{ $course->total_students }}
                                        {{ $course->total_students == 1 ? 'student' : 'students' }}
                                    </span>

                                </div>

                                <!-- COURSE PROGRESS BAR -->
                                <div class="course-progress-track">
                                    <div class="course-progress-fill"
                                         style="width: {{ $barWidth }}%;
                                                background: linear-gradient(90deg, {{ $color[0] }}, {{ $color[1] }});">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-2">
                                    <small class="text-muted">Course share</small>
                                    <small class="course-percentage fw-semibold">
                                        {{ number_format($percentage, 1) }}%
                                    </small>
                                </div>

                            </div>

                        @empty

                            <div class="text-center py-5">
                                <i class="bi bi-bar-chart-line text-muted fs-1"></i>
                                <p class="text-muted mt-2">
                                    No student course data available.
                                </p>
                            </div>

                        @endforelse

                    </div>

                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-lg-5">

            <!-- ENROLLMENT STATUS -->
            <div class="card dashboard-card mb-4">

                <div class="card-body p-4">

                    <div class="mb-3">
                        <h5 class="fw-semibold mb-1">
                            <i class="bi bi-clipboard-check text-primary me-2"></i>
                            Enrollment Status
                        </h5>

                        <p class="text-muted small mb-0">
                            Current enrollment records by status
                        </p>
                    </div>

                    <!-- ACTIVE -->
                    <div class="d-flex align-items-center justify-content-between py-4 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-dot bg-success"></span>
                            <span class="fw-medium">Active</span>
                        </div>

                        <span class="fw-semibold">{{ $activeEnrollments }}</span>
                    </div>

                    <!-- INACTIVE -->
                    <div class="d-flex align-items-center justify-content-between py-4 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-dot bg-secondary"></span>
                            <span class="fw-medium">Inactive</span>
                        </div>

                        <span class="fw-semibold">{{ $inactiveEnrollments }}</span>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('enrollments.index') }}"
                           class="btn btn-outline-primary">
                            <i class="bi bi-list-check me-1"></i>
                            Manage Enrollments
                        </a>
                    </div>

                </div>
            </div>

            <!-- STUDENT GENDER DISTRIBUTION -->
            @php
                $maleStudents = $maleStudents ?? 0;
                $femaleStudents = $femaleStudents ?? 0;

                $genderTotal = $maleStudents + $femaleStudents;

                $malePercentage = $genderTotal > 0
                    ? ($maleStudents / $genderTotal) * 100
                    : 0;

                $femalePercentage = $genderTotal > 0
                    ? ($femaleStudents / $genderTotal) * 100
                    : 0;

                $maleDegree = $malePercentage * 3.6;
            @endphp

            <div class="card dashboard-card gender-card">

                <div class="card-body p-4">

                    <div class="mb-3">
                        <h5 class="fw-semibold mb-1">
                            <i class="bi bi-pie-chart-fill text-primary me-2"></i>
                            Student Gender Distribution
                        </h5>

                        <p class="text-muted small mb-0">
                            Male and female student population
                        </p>
                    </div>

                    @if($genderTotal > 0)

                        <!-- PIE CHART -->
                        <div class="gender-chart-wrapper">

                            <div class="gender-pie-chart"
                                 style="background:
                                    conic-gradient(
                                        #2563eb 0deg {{ $maleDegree }}deg,
                                        #ec4899 {{ $maleDegree }}deg 360deg
                                    );">

                                <div class="gender-pie-center">
                                    <strong>{{ $genderTotal }}</strong>
                                    <small>Students</small>
                                </div>

                            </div>

                        </div>

                        <!-- LEGEND -->
                        <div class="gender-legend mt-4">

                            <!-- MALE -->
                            <div class="gender-legend-item">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="gender-color-dot male-color"></span>
                                    <span class="fw-medium">Male</span>
                                </div>

                                <div class="text-end">
                                    <div class="fw-semibold">
                                        {{ $maleStudents }}
                                    </div>
                                    <small class="text-muted">
                                        {{ number_format($malePercentage, 1) }}%
                                    </small>
                                </div>

                            </div>

                            <!-- FEMALE -->
                            <div class="gender-legend-item">

                                <div class="d-flex align-items-center gap-2">
                                    <span class="gender-color-dot female-color"></span>
                                    <span class="fw-medium">Female</span>
                                </div>

                                <div class="text-end">
                                    <div class="fw-semibold">
                                        {{ $femaleStudents }}
                                    </div>
                                    <small class="text-muted">
                                        {{ number_format($femalePercentage, 1) }}%
                                    </small>
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="text-center py-5">

                            <i class="bi bi-pie-chart text-muted gender-empty-icon"></i>

                            <p class="text-muted mt-3 mb-0">
                                No gender data available.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

    <!-- RECENT ENROLLMENTS -->
    <div class="card dashboard-card mb-4">

        <div class="card-header bg-white border-bottom py-3 px-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="fw-semibold mb-1">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Recent Enrollments
                    </h5>

                    <p class="text-muted small mb-0">
                        Latest enrollment activity
                    </p>
                </div>

                <a href="{{ route('enrollments.index') }}"
                   class="btn btn-sm btn-outline-secondary">
                    View All
                </a>

            </div>

        </div>

        <div class="table-responsive">

            <table class="table dashboard-table align-middle mb-0">

                <thead>
                    <tr>
                        <th>STUDENT</th>
                        <th>SCHOOL YEAR</th>
                        <th>SEMESTER</th>
                        <th>TOTAL UNITS</th>
                        <th>TOTAL SUBJECTS</th>
                        <th>ENROLLED DATE</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentEnrollments as $enrollment)

                        <tr>

                            <td>
                                <div class="fw-semibold">
                                    {{ $enrollment->first_name }}
                                    {{ $enrollment->middle_name }}
                                    {{ $enrollment->last_name }}
                                </div>

                                <small class="text-muted">
                                    {{ $enrollment->student_number }}
                                </small>
                            </td>

                            <td>{{ $enrollment->school_year }}</td>
                            <td>{{ $enrollment->semester }}</td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $enrollment->total_units }} Units
                                </span>
                            </td>

                            <td>
                                <span class="fw-semibold text-primary">
                                    {{ $enrollment->total_subjects }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($enrollment->enrolled_date)->format('M d, Y') }}
                            </td>

                            <td>
                                @if(strtolower($enrollment->status) == 'active')
                                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                                        Active
                                    </span>
                                @else
                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary px-3 py-2">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                No recent enrollments available.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- UPCOMING SCHOOL EVENTS -->
    <div class="card dashboard-card mb-4">

        <div class="card-header bg-white border-bottom py-3 px-4">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="fw-semibold mb-1">
                        <i class="bi bi-calendar-event text-primary me-2"></i>
                        Upcoming School Events
                    </h5>

                    <p class="text-muted small mb-0">
                        Campus activities and important dates
                    </p>
                </div>

                <a href="#" class="btn btn-sm btn-outline-secondary">
                    View Calendar
                </a>

            </div>

        </div>

        <div class="card-body p-4">

            <div class="text-center py-3">
                <i class="bi bi-calendar2-check fs-1 text-muted"></i>

                <p class="text-muted mt-2 mb-0">
                    No upcoming school events have been posted.
                </p>
            </div>

        </div>

    </div>

    <!-- QUICK ACCESS -->
    <div class="card dashboard-card mb-4">

        <div class="card-body p-4">

            <h5 class="fw-semibold mb-3">
                <i class="bi bi-lightning-charge text-warning me-2"></i>
                Quick Access
            </h5>

            <div class="row g-3">

                <div class="col-md-4">
                    <a href="{{ route('students.create') }}"
                       class="btn btn-outline-primary w-100 py-3">
                        <i class="bi bi-person-plus me-2"></i>
                        Add Student
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('subjects.create') }}"
                       class="btn btn-outline-success w-100 py-3">
                        <i class="bi bi-book me-2"></i>
                        Add Subject
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('enrollments.create') }}"
                       class="btn btn-outline-warning w-100 py-3">
                        <i class="bi bi-journal-plus me-2"></i>
                        Create Enrollment
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')
<style>

.dashboard-page {
    padding-bottom: 25px;
}

/* DASHBOARD CARDS */
.dashboard-card {
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
    overflow: hidden;
    background: #ffffff;
}

.dashboard-stat {
    border: none;
    border-radius: 16px;
    min-height: 150px;
    box-shadow: 0 5px 15px rgba(15, 23, 42, 0.06);
}

.dashboard-stat .card-body {
    padding: 24px;
}

.stat-label {
    font-size: 14px;
    font-weight: 600;
    opacity: 1;
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    margin: 8px 0;
}

.stat-icon {
    font-size: 42px;
    opacity: 0.9;
}

.dashboard-stat small {
    opacity: 0.95;
}

/* COURSE DISTRIBUTION */
.course-item {
    padding-bottom: 2px;
}

.course-name {
    font-size: 14px;
    color: #1e293b;
}

.course-count-badge {
    font-size: 11px;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 50px;
    color: var(--course-color);
    background: color-mix(in srgb, var(--course-color) 15%, white);
    white-space: nowrap;
}

.course-progress-track {
    height: 14px;
    width: 100%;
    background: #edf1f5;
    border-radius: 50px;
    overflow: hidden;
}

.course-progress-fill {
    height: 100%;
    border-radius: 50px;
    transition: width 0.8s ease;
}

.course-percentage {
    color: #334155;
    font-size: 13px;
}

/* ENROLLMENT STATUS */
.status-dot {
    width: 13px;
    height: 13px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
}

/* GENDER DISTRIBUTION */
.gender-chart-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px 0 5px;
}

.gender-pie-chart {
    width: 210px;
    height: 210px;
    border-radius: 50%;
    position: relative;
    box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
    transition: transform 0.3s ease;
}

.gender-pie-chart:hover {
    transform: scale(1.04);
}

.gender-pie-center {
    position: absolute;
    width: 125px;
    height: 125px;
    border-radius: 50%;
    background: #ffffff;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: inset 0 0 0 1px #e2e8f0;
}

.gender-pie-center strong {
    font-size: 30px;
    color: #0f172a;
    font-weight: 700;
    line-height: 1.2;
}

.gender-pie-center small {
    color: #64748b;
    font-size: 12px;
}

.gender-legend {
    border-top: 1px solid #e2e8f0;
    padding-top: 12px;
}

.gender-legend-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 13px 4px;
    border-bottom: 1px solid #edf1f5;
}

.gender-legend-item:last-child {
    border-bottom: none;
}

.gender-color-dot {
    width: 13px;
    height: 13px;
    display: inline-block;
    border-radius: 50%;
    flex-shrink: 0;
}

.male-color {
    background: #2563eb;
}

.female-color {
    background: #ec4899;
}

.gender-empty-icon {
    font-size: 45px;
}

/* TABLE */
.dashboard-table {
    min-width: 850px;
}

.dashboard-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.4px;
    white-space: nowrap;
    padding: 14px 18px;
    border-bottom: 1px solid #e2e8f0;
}

.dashboard-table tbody td {
    padding: 15px 18px;
    border-bottom: 1px solid #e9eef5;
    font-size: 14px;
}

.dashboard-table tbody tr:hover {
    background: #f8fafc;
}

.dashboard-table tbody tr:last-child td {
    border-bottom: none;
}

/* RESPONSIVE */
@media (max-width: 768px) {

    .dashboard-stat {
        min-height: 130px;
    }

    .dashboard-stat .card-body {
        padding: 18px;
    }

    .stat-number {
        font-size: 28px;
    }

    .dashboard-card .card-body {
        padding: 20px !important;
    }

    .course-progress-track {
        height: 12px;
    }

    .gender-pie-chart {
        width: 180px;
        height: 180px;
    }

    .gender-pie-center {
        width: 110px;
        height: 110px;
    }

}

/* STAT CARD LABEL CONTRAST FIX */
.dashboard-stat .stat-label {
    font-size: 14px;
    font-weight: 700;
    opacity: 1 !important;
    color: inherit !important;
}
.dashboard-stat.bg-primary .stat-label,
.dashboard-stat.bg-success .stat-label,
.dashboard-stat.bg-dark .stat-label {
    color: #ffffff !important;
}
.dashboard-stat.bg-warning .stat-label {
    color: #212529 !important;
}
.dashboard-stat .stat-number {
    color: inherit !important;
}
.dashboard-stat.bg-warning .stat-number {
    color: #212529 !important;
}
.dashboard-stat.bg-primary small,
.dashboard-stat.bg-success small,
.dashboard-stat.bg-dark small {
    color: #ffffff !important;
}
.dashboard-stat.bg-warning small {
    color: #212529 !important;
}

</style>
@endpush
