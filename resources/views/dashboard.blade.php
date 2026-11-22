@extends('layouts.app')

@section('title', 'SIMS Dashboard')
@section('page-heading', 'Dashboard')

@section('content')

<style>
/* ================================
   FALLING SNOW
================================ */
.snowflake {
    position: fixed;
    top: -20px;
    z-index: 999;
    color: #bdeaff;
    pointer-events: none;
    animation: snowFall linear infinite;
    opacity: 0.8;
}

@keyframes snowFall {
    0% {
        transform: translateY(-20px) rotate(0deg);
        opacity: 0;
    }

    10% {
        opacity: 0.9;
    }

    100% {
        transform: translateY(110vh) rotate(360deg);
        opacity: 0;
    }
}

/* ================================
   NEW YEAR COUNTDOWN CARD
================================ */
.new-year-countdown {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 210px;
    background: linear-gradient(135deg, #b91c1c, #e33434);
    color: white;
    border-radius: 18px;
    padding: 14px;
    box-shadow: 0 8px 25px rgba(0,0,0,.35);
    z-index: 1050;
    border: 2px solid rgba(255,255,255,.25);
}

/* BOUNCE TWICE */
@keyframes countdownBounce2x {
    0%, 100% {
        transform: translateY(0);
    }

    10% {
        transform: translateY(-18px);
    }

    20% {
        transform: translateY(0);
    }

    30% {
        transform: translateY(-18px);
    }

    40% {
        transform: translateY(0);
    }
}

.bounce-countdown {
    animation: countdownBounce2x 4s ease-in-out infinite;
}

.countdown-close {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #343a40;
    color: white;
    border: 2px solid white;
    font-weight: bold;
    cursor: pointer;
    z-index: 2;
}

.countdown-title {
    font-size: 11px;
    font-weight: 800;
    text-align: center;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.countdown-items {
    display: flex;
    justify-content: center;
    gap: 5px;
}

.countdown-box {
    background: rgba(255,255,255,.15);
    border-radius: 8px;
    flex: 1;
    text-align: center;
    padding: 7px 3px;
}

.countdown-number {
    font-size: 22px;
    font-weight: 800;
    line-height: 1;
}

.countdown-label {
    font-size: 9px;
    margin-top: 5px;
}

/* RESPONSIVE */
@media (max-width: 576px) {
    .new-year-countdown {
        width: 190px;
        right: 12px;
        bottom: 12px;
    }
}

/* REDUCED MOTION */
@media (prefers-reduced-motion: reduce) {
    .snowflake,
    .bounce-countdown {
        animation: none !important;
    }
}
</style>

<div class="container-fluid">

    <!-- WELCOME -->
    <div class="mb-4">
        <h3>Welcome, {{ Auth::user()->name }}!</h3>

        <p class="text-muted">
            Student Information Management System
        </p>
    </div>

    <!-- STATISTICS -->
    <div class="row g-4">

        <!-- STUDENTS -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Students</h6>
                            <h2>{{ $totalStudents }}</h2>
                        </div>
                        <i class="bi bi-people fs-1"></i>
                    </div>
                    <small>Registered Students</small>
                </div>
            </div>
        </div>

        <!-- SUBJECTS -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Subjects</h6>
                            <h2>{{ $totalSubjects }}</h2>
                        </div>
                        <i class="bi bi-book fs-1"></i>
                    </div>
                    <small>Available Subjects</small>
                </div>
            </div>
        </div>

        <!-- ENROLLMENTS -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card bg-warning text-dark">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Enrollments</h6>
                            <h2>{{ $totalEnrollments }}</h2>
                        </div>
                        <i class="bi bi-journal-check fs-1"></i>
                    </div>
                    <small>Student Subject Records</small>
                </div>
            </div>
        </div>

        <!-- USERS -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card bg-dark text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>System Users</h6>
                            <h2>{{ $totalUsers }}</h2>
                        </div>
                        <i class="bi bi-person-lock fs-1"></i>
                    </div>
                    <small>Registered Accounts</small>
                </div>
            </div>
        </div>

    </div>

    <!-- SYSTEM SUMMARY & QUICK ACCESS -->
    <div class="row mt-4">

        <!-- SYSTEM SUMMARY -->
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-body">

                    <h5 class="card-title">
                        <i class="bi bi-info-circle text-primary"></i>
                        System Summary
                    </h5>

                    <p class="text-muted">
                        The Student Information Management System is designed
                        to manage student profiles, academic subjects,
                        and enrollment records.
                    </p>

                    <hr>

                    <div class="row text-center">

                        <div class="col-md-4">
                            <i class="bi bi-people fs-2 text-primary"></i>
                            <p>Student Management</p>
                        </div>

                        <div class="col-md-4">
                            <i class="bi bi-book fs-2 text-success"></i>
                            <p>Subject Management</p>
                        </div>

                        <div class="col-md-4">
                            <i class="bi bi-journal-check fs-2 text-warning"></i>
                            <p>Enrollment Management</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- QUICK ACCESS -->
        <div class="col-lg-4">
            <div class="card stat-card">
                <div class="card-body">

                    <h5 class="card-title">Quick Access</h5>

                    <div class="d-grid gap-2">

                        <a href="{{ route('students.create') }}"
                           class="btn btn-outline-primary">
                            <i class="bi bi-person-plus"></i>
                            Add Student
                        </a>

                        <a href="{{ route('subjects.create') }}"
                           class="btn btn-outline-success">
                            <i class="bi bi-book"></i>
                            Add Subject
                        </a>

                        <a href="{{ route('enrollments.create') }}"
                           class="btn btn-outline-warning">
                            <i class="bi bi-journal-plus"></i>
                            Create Enrollment
                        </a>

                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- ==================================
     FALLING SNOW
================================== -->
<div id="snow-container"></div>

<!-- ==================================
     NEW YEAR 2027 COUNTDOWN
================================== -->
<div class="new-year-countdown bounce-countdown"
     id="newYearCountdown">

    <button class="countdown-close"
            onclick="closeCountdown()"
            title="Close">
        ×
    </button>

    <div class="countdown-title">
        🎉 NEW YEAR COUNTDOWN 🎉
    </div>

    <div class="countdown-items">

        <div class="countdown-box">
            <div class="countdown-number" id="ny-days">00</div>
            <div class="countdown-label">Days</div>
        </div>

        <div class="countdown-box">
            <div class="countdown-number" id="ny-hours">00</div>
            <div class="countdown-label">Hrs</div>
        </div>

        <div class="countdown-box">
            <div class="countdown-number" id="ny-minutes">00</div>
            <div class="countdown-label">Mins</div>
        </div>

        <div class="countdown-box">
            <div class="countdown-number" id="ny-seconds">00</div>
            <div class="countdown-label">Secs</div>
        </div>

    </div>

</div>

<script>
/* ==================================
   NEW YEAR COUNTDOWN
================================== */
function updateNewYearCountdown() {

    const targetDate = new Date("January 1, 2027 00:00:00").getTime();
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance <= 0) {
        document.getElementById("ny-days").textContent = "00";
        document.getElementById("ny-hours").textContent = "00";
        document.getElementById("ny-minutes").textContent = "00";
        document.getElementById("ny-seconds").textContent = "00";
        return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("ny-days").textContent = String(days).padStart(2, "0");
    document.getElementById("ny-hours").textContent = String(hours).padStart(2, "0");
    document.getElementById("ny-minutes").textContent = String(minutes).padStart(2, "0");
    document.getElementById("ny-seconds").textContent = String(seconds).padStart(2, "0");
}

updateNewYearCountdown();
setInterval(updateNewYearCountdown, 1000);

/* ==================================
   CLOSE COUNTDOWN
================================== */
function closeCountdown() {
    document.getElementById("newYearCountdown").style.display = "none";
}

/* ==================================
   FALLING SNOW EFFECT
================================== */
const snowContainer = document.getElementById("snow-container");

function createSnowflake() {

    const snow = document.createElement("div");

    snow.className = "snowflake";
    snow.innerHTML = "❄";

    snow.style.left = Math.random() * 100 + "vw";
    snow.style.fontSize = (Math.random() * 12 + 8) + "px";
    snow.style.animationDuration = (Math.random() * 5 + 5) + "s";
    snow.style.opacity = Math.random();

    snowContainer.appendChild(snow);

    setTimeout(() => {
        snow.remove();
    }, 10000);
}

setInterval(createSnowflake, 300);
</script>

@endsection
