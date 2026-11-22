
@extends('layouts.app')

@section('title', 'SIMS Dashboard')
@section('page-heading', 'Dashboard')

@section('content')

<div class="container-fluid dashboard-page">

    <!-- GLOBAL NEW YEAR SNOW ANIMATION -->
    <div id="newYearSnowLayer" class="new-year-snow-layer" aria-hidden="true"></div>

    <!-- WELCOME -->
    <div class="mb-4">
        <h3 class="fw-semibold">Welcome, {{ Auth::user()->name }}!</h3>
        <p class="text-muted mb-0">Student Information Management System</p>
    </div>


    <!-- FLOATING NEW YEAR 2027 COUNTDOWN -->
    <div id="newYearCountdown" class="new-year-countdown">
        <div class="countdown-particles" id="countdownParticles"></div>
        <button type="button" class="countdown-close" onclick="closeNewYearCountdown()" title="Close countdown" aria-label="Close countdown">&times;</button>
        <div class="countdown-content text-center">
            <div class="countdown-badge"><i class="bi bi-stars me-1"></i> NEW YEAR 2027 COUNTDOWN</div>
            <h2 class="countdown-title"><span>2027</span></h2>
            <div class="countdown-timer">
                <div class="countdown-unit"><div class="countdown-number" id="countdownDays">00</div><div class="countdown-label">DAYS</div></div>
                <div class="countdown-unit"><div class="countdown-number" id="countdownHours">00</div><div class="countdown-label">HOURS</div></div>
                <div class="countdown-unit"><div class="countdown-number" id="countdownMinutes">00</div><div class="countdown-label">MIN</div></div>
                <div class="countdown-unit"><div class="countdown-number" id="countdownSeconds">00</div><div class="countdown-label">SEC</div></div>
            </div>
            <div class="countdown-footer">January 1, 2027</div>
        </div>
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


/* GLOBAL FALLING SNOW - WINDOW EFFECT */
.new-year-snow-layer { position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: 1070; }
.new-year-snowflake { position: absolute; top: -30px; color: #8fd7ff; text-shadow: 0 0 5px rgba(90,190,255,.35); opacity: 0; animation: windowSnowFall linear infinite; user-select: none; }
@keyframes windowSnowFall {
    0% { transform: translate3d(0,-30px,0) rotate(0deg); opacity: 0; }
    10% { opacity: .8; }
    90% { opacity: .65; }
    100% { transform: translate3d(var(--snow-drift,30px),110vh,0) rotate(360deg); opacity: 0; }
}
@media (prefers-reduced-motion: reduce) { .new-year-snowflake, .countdown-unit, .new-year-countdown::before { animation-duration: 20s !important; } }

/* FLOATING NEW YEAR 2027 COUNTDOWN */
.new-year-countdown {
    position: fixed;
    right: 22px;
    bottom: 22px;
    z-index: 1080;
    width: 290px;
    min-height: 245px;
    overflow: hidden;
    border-radius: 20px;
    background: linear-gradient(145deg, #7f1d1d, #dc2626 55%, #991b1b);
    border: 1px solid rgba(255,255,255,.22);
    box-shadow: 0 18px 45px rgba(30, 20, 30, .32);
    color: #fff;
    isolation: isolate;
}
.new-year-countdown::before {
    content: ""; position: absolute; inset: -45%;
    background: radial-gradient(circle at 20% 30%, rgba(255,215,0,.22), transparent 32%), radial-gradient(circle at 80% 70%, rgba(255,255,255,.12), transparent 35%);
    animation: countdownGlow 8s ease-in-out infinite alternate; z-index: -1;
}
.countdown-content { position: relative; z-index: 2; padding: 22px 16px 16px; }
.countdown-badge { display: inline-block; padding: 5px 11px; border: 1px solid rgba(255,255,255,.35); border-radius: 50px; background: rgba(255,255,255,.12); font-size: 10px; font-weight: 800; letter-spacing: 1.5px; margin-bottom: 7px; }
.countdown-title { font-size: 27px; font-weight: 900; letter-spacing: 1px; margin-bottom: 14px; color: #fff; }
.countdown-title span { color: #ffd166; text-shadow: 0 0 18px rgba(255,209,102,.4); }
.countdown-timer { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 8px; }
.countdown-unit { min-width: 0; padding: 10px 8px; border-radius: 12px; background: rgba(255,255,255,.13); border: 1px solid rgba(255,255,255,.18); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); animation: countdownBounce 3s ease-in-out infinite; }
.countdown-unit:nth-child(2) { animation-delay: .2s; }
.countdown-unit:nth-child(3) { animation-delay: .4s; }
.countdown-unit:nth-child(4) { animation-delay: .6s; }
.countdown-number { font-size: 26px; line-height: 1.1; font-weight: 900; color: #fff; font-variant-numeric: tabular-nums; }
.countdown-label { font-size: 9px; font-weight: 700; letter-spacing: 1.2px; color: #ffd166; margin-top: 5px; }
.countdown-footer { margin-top: 12px; font-size: 10px; font-weight: 600; color: rgba(255,255,255,.8); }
.countdown-close { position: absolute; top: 7px; right: 8px; z-index: 10; width: 27px; height: 27px; border: none; border-radius: 50%; background: rgba(255,255,255,.15); color: #fff; font-size: 21px; line-height: 1; cursor: pointer; transition: all .25s ease; }
.countdown-close:hover { background: rgba(255,255,255,.3); transform: rotate(90deg); }
.countdown-particles { position: absolute; inset: 0; overflow: hidden; pointer-events: none; z-index: 1; }
.countdown-particle { position: absolute; top: -30px; animation-name: countdownFall; animation-timing-function: linear; animation-iteration-count: infinite; opacity: 0; }
.countdown-particle.gold { color: #ffd166; } .countdown-particle.white { color: #fff; } .countdown-particle.red { color: #ffb4b4; } .countdown-particle.spark { text-shadow: 0 0 8px currentColor; }
@keyframes countdownFall { 0% { transform: translateY(-30px) rotate(0deg); opacity: 0; } 10% { opacity: .9; } 90% { opacity: .7; } 100% { transform: translateY(260px) rotate(720deg); opacity: 0; } }
@keyframes countdownBounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }
@keyframes countdownGlow { from { transform: rotate(0deg) scale(1); } to { transform: rotate(8deg) scale(1.08); } }
@media (max-width: 576px) {
    .new-year-countdown { right: 12px; bottom: 12px; width: min(260px, calc(100vw - 24px)); min-height: 0; }
    .countdown-content { padding: 18px 13px 12px; }
    .countdown-number { font-size: 23px; }
}
@media (max-height: 520px) {
    .new-year-countdown { bottom: 10px; right: 10px; width: 250px; }
    .countdown-content { padding: 14px 12px 10px; }
    .countdown-title { margin-bottom: 8px; }
    .countdown-unit { padding: 7px 5px; }
}

/* COMPACT FLOATING COUNTDOWN - screenshot-sized */
.new-year-countdown {
    width: 210px !important;
    min-height: 0 !important;
    right: 18px !important;
    bottom: 18px !important;
    border-radius: 14px !important;
}
.countdown-content { padding: 12px 10px 9px !important; }
.countdown-badge { display: block !important; font-size: 9px !important; letter-spacing: .8px !important; margin: 0 8px 8px 0 !important; padding: 0 0 7px !important; border: 0 !important; border-bottom: 1px solid rgba(255,255,255,.25) !important; border-radius: 0 !important; background: transparent !important; text-align: left !important; }
.countdown-title { display: none !important; }
.countdown-timer { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; gap: 4px !important; }
.countdown-unit { padding: 6px 3px !important; border-radius: 8px !important; }
.countdown-number { font-size: 17px !important; }
.countdown-label { font-size: 7px !important; letter-spacing: .3px !important; margin-top: 3px !important; }
.countdown-footer { display: none !important; }
.countdown-close { top: -1px !important; right: -1px !important; width: 23px !important; height: 23px !important; font-size: 17px !important; }
@media (max-width: 576px) {
    .new-year-countdown { width: 210px !important; right: 10px !important; bottom: 10px !important; }
    .countdown-content { padding: 12px 10px 9px !important; }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const targetDate = new Date('January 1, 2027 00:00:00').getTime();
    const daysEl = document.getElementById('countdownDays');
    const hoursEl = document.getElementById('countdownHours');
    const minutesEl = document.getElementById('countdownMinutes');
    const secondsEl = document.getElementById('countdownSeconds');
    const card = document.getElementById('newYearCountdown');
    const particles = document.getElementById('countdownParticles');
    const snowLayer = document.getElementById('newYearSnowLayer');
    if (snowLayer) {
        const snowSymbols = ['❄', '❅', '❆'];
        for (let i = 0; i < 42; i++) {
            const flake = document.createElement('span');
            flake.className = 'new-year-snowflake';
            flake.textContent = snowSymbols[Math.floor(Math.random() * snowSymbols.length)];
            flake.style.left = Math.random() * 100 + '%';
            flake.style.fontSize = (Math.random() * 10 + 8) + 'px';
            flake.style.animationDuration = (Math.random() * 8 + 7) + 's';
            flake.style.animationDelay = (Math.random() * 10) + 's';
            flake.style.setProperty('--snow-drift', (Math.random() * 100 - 50) + 'px');
            snowLayer.appendChild(flake);
        }
    }
    if (!card || !particles || !daysEl || !hoursEl || !minutesEl || !secondsEl) return;

    function updateCountdown() {
        const distance = targetDate - Date.now();
        if (distance <= 0) {
            daysEl.textContent = hoursEl.textContent = minutesEl.textContent = secondsEl.textContent = '00';
            const title = card.querySelector('.countdown-title');
            const subtitle = card.querySelector('.countdown-subtitle');
            if (title) title.innerHTML = 'Happy New <span>Year 2027!</span>';
            if (subtitle) subtitle.textContent = 'Welcome to a brand new year!';
            clearInterval(timer);
            return;
        }
        daysEl.textContent = String(Math.floor(distance / 86400000)).padStart(2, '0');
        hoursEl.textContent = String(Math.floor(distance / 3600000 % 24)).padStart(2, '0');
        minutesEl.textContent = String(Math.floor(distance / 60000 % 60)).padStart(2, '0');
        secondsEl.textContent = String(Math.floor(distance / 1000 % 60)).padStart(2, '0');
    }
    updateCountdown();
    const timer = setInterval(updateCountdown, 1000);

    const symbols = ['✦', '✧', '★', '❋', '●'];
    const colors = ['gold', 'white', 'red', 'gold', 'spark'];
    for (let i = 0; i < 45; i++) {
        const particle = document.createElement('span');
        particle.className = 'countdown-particle ' + colors[Math.floor(Math.random() * colors.length)];
        particle.textContent = symbols[Math.floor(Math.random() * symbols.length)];
        particle.style.left = Math.random() * 100 + '%';
        particle.style.fontSize = (Math.random() * 12 + 10) + 'px';
        particle.style.animationDuration = (Math.random() * 5 + 4) + 's';
        particle.style.animationDelay = (Math.random() * 5) + 's';
        particles.appendChild(particle);
    }
});

window.closeNewYearCountdown = function () {
    const card = document.getElementById('newYearCountdown');
    if (!card) return;
    card.style.transition = 'all 0.5s ease';
    card.style.opacity = '0';
    card.style.transform = 'translateY(-20px)';
    setTimeout(function () { card.style.display = 'none'; }, 500);
};
</script>
@endpush
