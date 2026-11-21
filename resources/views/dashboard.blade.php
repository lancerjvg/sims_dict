
@extends('layouts.app')

@section('title', 'SIMS Dashboard')

@section('page-heading', 'Dashboard')

@section('content')

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
                            <h2>0</h2>
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
                            <h2>0</h2>
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
                            <h2>0</h2>
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
                            <h2>1</h2>
                        </div>

                        <i class="bi bi-person-lock fs-1"></i>
                    </div>

                    <small>Registered Accounts</small>

                </div>
            </div>

        </div>

    </div>

    <!-- SYSTEM SUMMARY -->
    <div class="row mt-4">

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

                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-person-plus"></i>
                            Add Student
                        </a>

                        <a href="#" class="btn btn-outline-success">
                            <i class="bi bi-book"></i>
                            Add Subject
                        </a>

                        <a href="#" class="btn btn-outline-warning">
                            <i class="bi bi-journal-plus"></i>
                            Create Enrollment
                        </a>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
