<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Lancer Technology Institute')</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- Bootstrap 5.3.8 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">

    {{-- SweetAlert2 --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"
          rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #101828;
            --sidebar-hover: #1D2939;
            --sidebar-active: #6366F1;
            --primary: #6366F1;
            --primary-dark: #4F46E5;
            --page-bg: #F4F7FB;
            --card-bg: #FFFFFF;
            --text-main: #101828;
            --text-muted: #667085;
            --border-color: #EAECF0;
            --sidebar-width: 265px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--page-bg);
            color: var(--text-main);
            margin: 0;
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .app-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #FFFFFF;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform .25s ease;
        }

        .sidebar-brand {
            padding: 25px 22px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #818CF8, #4F46E5);
            color: white;
            font-size: 23px;
            box-shadow: 0 6px 18px rgba(99,102,241,.3);
        }

        .brand-title {
            color: white;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: -.3px;
        }

        .brand-subtitle {
            color: #98A2B3;
            font-size: 11px;
            margin-top: 3px;
        }

        .brand-address {
            color: #98A2B3;
            font-size: 9px;
            line-height: 1.35;
            margin-top: 5px;
            max-width: 165px;
        }

        .sidebar-content {
            padding: 22px 14px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-label {
            color: #667085;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 0 12px;
            margin-bottom: 12px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            color: #98A2B3;
            border-radius: 11px;
            font-weight: 500;
            transition: all .2s ease;
        }

        .sidebar-nav a i {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        .sidebar-nav a:hover {
            background: var(--sidebar-hover);
            color: #FFFFFF;
        }

        .sidebar-nav a.active {
            background: linear-gradient(135deg, #6366F1, #4F46E5);
            color: #FFFFFF;
            box-shadow: 0 5px 15px rgba(79,70,229,.25);
        }

        /* COURSE MANAGEMENT SUBMENU UNDER SETTINGS */
        .sidebar-nav a.sidebar-sub-link {
            margin-left: 16px;
            width: calc(100% - 16px);
            padding-left: 12px;
            font-size: 13px;
            border-radius: 10px;
        }

        .sidebar-nav a.sidebar-sub-link i {
            font-size: 16px;
        }


        .sidebar-footer {
            padding: 17px 20px;
            border-top: 1px solid rgba(255,255,255,.08);
            color: #98A2B3;
            font-size: 11px;
        }

        /* =========================
           MAIN AREA
        ========================= */

        .app-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================= */

        .app-topbar {
            height: 76px;
            position: sticky;
            top: 0;
            z-index: 1020;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .topbar-title {
            font-weight: 700;
            font-size: 18px;
            color: #101828;
        }

        .topbar-subtitle {
            font-size: 12px;
            color: #98A2B3;
            margin-top: 3px;
        }

        .topbar-icon-btn {
            width: 40px;
            height: 40px;
            border: 1px solid var(--border-color);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FFFFFF;
            color: #667085;
            transition: .2s ease;
        }

        .topbar-icon-btn:hover {
            background: #F9FAFB;
            color: var(--primary);
            border-color: #C7D2FE;
        }

        .profile-avatar {
            width: 39px;
            height: 39px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #EEF2FF;
            color: #4F46E5;
            font-weight: 700;
        }

        /* =========================
           CONTENT
        ========================= */

        .app-content {
            padding: 28px 30px;
        }

        .premium-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 18px;
            box-shadow: 0 3px 12px rgba(16,24,40,.035);
        }

        .content-heading {
            font-weight: 700;
            color: var(--text-main);
        }

        /* =========================
           STAT CARDS
        ========================= */

        .stat-card {
            background: #FFFFFF;
            border: 1px solid #EAECF0;
            border-radius: 17px;
            padding: 21px;
            height: 100%;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(16,24,40,.06);
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .stat-label {
            color: #667085;
            font-size: 12px;
            font-weight: 500;
        }

        .stat-value {
            color: #101828;
            font-size: 26px;
            font-weight: 800;
            margin-top: 7px;
        }

        .stat-note {
            color: #98A2B3;
            font-size: 11px;
            margin-top: 5px;
        }

        /* =========================
           TABLES
        ========================= */

        .premium-table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .premium-table thead th {
            background: #F9FAFB;
            color: #667085;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 15px 18px;
            border-bottom: 1px solid #EAECF0;
            white-space: nowrap;
        }

        .premium-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #F2F4F7;
            color: #344054;
            vertical-align: middle;
        }

        .premium-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .premium-table tbody tr:hover {
            background: #FAFBFF;
        }

        /* =========================
           PREMIUM BUTTONS
        ========================= */

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn {
            font-weight: 500;
        }

        /* =========================
           ALERTS
        ========================= */

        .alert {
            border-radius: 12px;
            border: 0;
        }

        /* =========================
           SUBJECT PAGE ADDITIONS
        ========================= */

        .subject-action-btn {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: all .2s ease;
        }

        .subject-action-btn:hover {
            transform: translateY(-2px);
        }

        .subject-toolbar {
            background: #F9FAFB;
            border: 1px solid #EAECF0;
            padding: 14px;
            border-radius: 12px;
        }

        .premium-table tbody td {
            vertical-align: middle;
        }

        .premium-card .table-responsive {
            border-radius: 0;
        }

        /* =========================
           SWEETALERT2 PREMIUM
        ========================= */

        .premium-swal-popup {
            border-radius: 22px !important;
            padding: 28px !important;
            font-family: 'Inter', sans-serif !important;
        }

        .premium-swal-confirm,
        .premium-swal-cancel {
            border-radius: 10px !important;
            padding: 11px 22px !important;
            font-weight: 600 !important;
            font-family: 'Inter', sans-serif !important;
        }

        .swal2-title {
            font-size: 21px !important;
            font-weight: 700 !important;
            color: #101828 !important;
        }

        .swal2-html-container {
            font-size: 14px !important;
            color: #667085 !important;
        }

        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            gap: 5px;
            margin-bottom: 0;
            flex-wrap: wrap;
        }

        .pagination .page-link {
            border: 1px solid #E4E7EC;
            border-radius: 9px !important;
            padding: 8px 13px;
            color: #475467;
            background: #FFFFFF;
            font-size: 13px;
            font-weight: 500;
            box-shadow: none !important;
            transition: all .2s ease;
        }

        .pagination .page-link:hover {
            background: #EEF2FF;
            border-color: #C7D2FE;
            color: #4F46E5;
        }

        .pagination .page-item.active .page-link {
            background: #6366F1;
            border-color: #6366F1;
            color: #FFFFFF;
        }

        .pagination .page-item.disabled .page-link {
            background: #F9FAFB;
            color: #98A2B3;
            border-color: #EAECF0;
        }

        /* =========================
           MOBILE
        ========================= */

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(16,24,40,.55);
            z-index: 1035;
        }

        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 991.98px) {

            .app-sidebar {
                transform: translateX(-100%);
            }

            .app-sidebar.show {
                transform: translateX(0);
            }

            .app-main {
                margin-left: 0;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .app-topbar {
                padding: 0 18px;
                height: 68px;
            }

            .app-content {
                padding: 22px 18px;
            }

        }

        @media (max-width: 575.98px) {

            .app-content {
                padding: 18px 12px;
            }

            .topbar-title {
                font-size: 15px;
            }

            .premium-table thead th,
            .premium-table tbody td {
                padding: 12px;
            }

        }

        /* FIX: SIMS PAGE HEADER OVERLAPPING */
.page-header,
.page-heading,
.content-header {
    position: relative !important;
    top: auto !important;
    margin-top: 0 !important;
    padding-top: 20px !important;
    overflow: visible !important;
    height: auto !important;
    min-height: auto !important;
    z-index: 2;
}

.student-create-heading {
    position: relative !important;
    top: auto !important;
    margin-top: 0 !important;
    padding-top: 0 !important;
    overflow: visible !important;
}

/* Prevent page title from being clipped */
.student-create-heading-left h1 {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    line-height: 1.3 !important;
    margin-top: 0 !important;
}

/* Avoid duplicate breadcrumb spacing */
.student-create-heading-left small {
    display: none !important;
}

/* Main content spacing */
main,
.main-content,
.content-wrapper {
    overflow: visible !important;
}

    
        /* =====================================================
           MINIMAL STUDENT CREATE HEADER FIX
           Keep the original SIMS layout; only let the topbar expand
           when the Add New Student heading is rendered inside it.
        ===================================================== */
        .app-topbar:has(.student-create-heading) {
            height: auto !important;
            min-height: 76px;
            align-items: flex-start !important;
            padding-top: 20px !important;
            padding-bottom: 20px !important;
            overflow: visible !important;
        }
        .app-topbar:has(.student-create-heading) .student-create-heading {
            position: relative !important;
            top: auto !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
            width: 100%;
        }
        .app-topbar:has(.student-create-heading) .student-create-heading-left h1 {
            margin-top: 0 !important;
            line-height: 1.35 !important;
        }
        @media (max-width: 767.98px) {
            .app-topbar:has(.student-create-heading) {
                height: auto !important;
                padding-top: 16px !important;
                padding-bottom: 16px !important;
            }
        }
</style>

    @stack('styles')
</head>

<body>

    {{-- =========================
         SIDEBAR
    ========================== --}}
    <aside class="app-sidebar" id="appSidebar">

        {{-- BRAND --}}
        <div class="sidebar-brand">

            <div class="d-flex align-items-center gap-3">

                <div class="brand-logo">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>

                <div>
                    <div class="brand-title">
                        Lancer Technology Institute
                    </div>

                    <div class="brand-subtitle">
                        Student Information System
                    </div>
                    <div class="brand-address">
                        Prk. Millionaire, Tandag City, Surigao del Sur
                    </div>
                </div>

            </div>

        </div>


        {{-- NAVIGATION --}}
        <div class="sidebar-content">

            <div class="sidebar-label">
                Main Menu
            </div>

            <nav class="sidebar-nav">

                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>

                </a>


                <a href="{{ route('students.index') }}"
                   class="{{ request()->routeIs('students.*') ? 'active' : '' }}">

                    <i class="bi bi-people-fill"></i>
                    <span>Students</span>

                </a>


                <a href="{{ route('subjects.index') }}"
                   class="{{ request()->routeIs('subjects.*') ? 'active' : '' }}">

                    <i class="bi bi-book-fill"></i>
                    <span>Subjects</span>

                </a>


                <a href="{{ route('enrollments.index') }}"
                   class="{{ request()->routeIs('enrollments.*') ? 'active' : '' }}">

                    <i class="bi bi-clipboard2-check-fill"></i>
                    <span>Enrollments</span>

                </a>


                <a href="#"
                   class="">

                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Reports</span>

                </a>

            </nav>


            <div class="sidebar-label mt-4">
                System
            </div>

            <nav class="sidebar-nav">

                <a href="#">
                    <i class="bi bi-gear-fill"></i>
                    <span>Settings</span>
                </a>

                {{-- COURSE MANAGEMENT (SUBMENU UNDER SETTINGS) --}}
                <a href="{{ route('courses.index') }}"
                   class="sidebar-sub-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>Course Management</span>
                </a>

            </nav>

        </div>


        {{-- SIDEBAR FOOTER --}}
        <div class="sidebar-footer">

            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-shield-check"></i>
                <span>Lancer Technology Institute</span>
            </div>

            <div class="mt-2">
                © {{ date('Y') }} Lancer Technology Institute
            </div>

        </div>

    </aside>


    {{-- MOBILE OVERLAY --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>


    {{-- =========================
         MAIN CONTENT
    ========================== --}}
    <div class="app-main">


        {{-- TOPBAR --}}
        <header class="app-topbar">

            <div class="d-flex align-items-center gap-3">

                {{-- MOBILE MENU --}}
                <button type="button"
                        class="topbar-icon-btn mobile-menu-btn"
                        id="mobileMenuBtn">

                    <i class="bi bi-list fs-5"></i>

                </button>


                <div>
                    <div class="topbar-title">
                        @yield('page-heading', 'Dashboard')
                    </div>

                    <div class="topbar-subtitle">
                        Student Information Management System
                    </div>
                </div>

            </div>


            {{-- TOPBAR RIGHT --}}
            <div class="d-flex align-items-center gap-3">


                {{-- NOTIFICATION PLACEHOLDER --}}
                <button type="button"
                        class="topbar-icon-btn"
                        title="Notifications">

                    <i class="bi bi-bell"></i>

                </button>


                {{-- USER DROPDOWN --}}
                <div class="dropdown">

                    <button class="btn p-0 border-0 bg-transparent dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">

                        <div class="d-flex align-items-center gap-2">

                            <div class="profile-avatar">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>

                            <div class="text-start d-none d-sm-block">

                                <div class="fw-semibold small text-dark">
                                    {{ auth()->user()->name ?? 'User' }}
                                </div>

                                <div class="text-muted" style="font-size:11px;">
                                    Administrator
                                </div>

                            </div>

                        </div>

                    </button>


                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 mt-2">

                        <li>
                            <button type="button" class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#userProfileModal">
                                <i class="bi bi-person-circle me-2 text-primary"></i> My Profile
                            </button>
                        </li>

                        <li>
                            <button type="button" class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#userProfileModal" data-bs-dismiss="dropdown">
                                <i class="bi bi-key me-2 text-primary"></i> Change Password
                            </button>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger py-2">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>

                    </ul>

                </div>

            </div>

        </header>

        {{-- USER PROFILE + PASSWORD MODAL --}}
        <div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4 overflow-hidden">
                    <div class="modal-header text-white border-0" style="background:linear-gradient(135deg,#6366F1,#4F46E5);">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                <i class="bi bi-person-fill fs-4"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold mb-0" id="userProfileModalLabel">My Profile</h5>
                                <small class="opacity-75">Account information and password settings</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <h6 class="fw-bold mb-3"><i class="bi bi-person-vcard me-2 text-primary"></i>Profile Information</h6>
                        <div class="bg-light rounded-3 p-3 mb-4">
                            <div class="mb-2"><small class="text-muted d-block">Name</small><span class="fw-semibold">{{ auth()->user()->name ?? '—' }}</span></div>
                            <div><small class="text-muted d-block">Email Address</small><span class="fw-semibold">{{ auth()->user()->email ?? '—' }}</span></div>
                        </div>
                        <h6 class="fw-bold mb-3"><i class="bi bi-shield-lock me-2 text-primary"></i>Change Password</h6>
                        <form method="POST" action="{{ route('profile.password.update') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control rounded-3" id="current_password" name="current_password" autocomplete="current-password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control rounded-3" id="new_password" name="password" autocomplete="new-password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control rounded-3" id="new_password_confirmation" name="password_confirmation" autocomplete="new-password" required>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-3 w-100"><i class="bi bi-check2-circle me-1"></i> Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- PAGE CONTENT --}}
        <main class="app-content">


            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4"
                     role="alert">

                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close">
                    </button>

                </div>

            @endif


            {{-- ERROR MESSAGE --}}
            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4"
                     role="alert">

                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    {{ session('error') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close">
                    </button>

                </div>

            @endif


            {{-- VALIDATION ERRORS --}}
            @if($errors->any())

                <div class="alert alert-danger shadow-sm mb-4">

                    <div class="fw-semibold mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Please check the following:
                    </div>

                    <ul class="mb-0 ps-4">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            @yield('content')

        </main>

    </div>


    {{-- =========================
         JAVASCRIPT
    ========================== --}}

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- GLOBAL PREMIUM SWEETALERT HELPERS --}}
    <script>

        /**
         * Global SIMS SweetAlert theme
         */
        window.SIMSAlert = {

            confirmDelete: function(options = {}) {

                return Swal.fire({

                    title: options.title || 'Are you sure?',
                    text: options.text || 'This record will be permanently deleted.',
                    icon: 'warning',

                    showCancelButton: true,
                    confirmButtonText: options.confirmText || '<i class="bi bi-trash me-1"></i> Yes, Delete It!',
                    cancelButtonText: options.cancelText || 'Cancel',

                    confirmButtonColor: options.confirmColor || '#EF4444',
                    cancelButtonColor: options.cancelColor || '#64748B',

                    reverseButtons: true,
                    focusCancel: true,

                    customClass: {
                        popup: 'premium-swal-popup',
                        confirmButton: 'premium-swal-confirm',
                        cancelButton: 'premium-swal-cancel'
                    }

                });

            },

            success: function(title, text = '') {

                return Swal.fire({

                    title: title,
                    text: text,
                    icon: 'success',

                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6366F1',

                    customClass: {
                        popup: 'premium-swal-popup',
                        confirmButton: 'premium-swal-confirm'
                    }

                });

            },

            error: function(title, text = '') {

                return Swal.fire({

                    title: title,
                    text: text,
                    icon: 'error',

                    confirmButtonText: 'OK',
                    confirmButtonColor: '#6366F1',

                    customClass: {
                        popup: 'premium-swal-popup',
                        confirmButton: 'premium-swal-confirm'
                    }

                });

            }

        };


        /**
         * MOBILE SIDEBAR
         */
        const sidebar = document.getElementById('appSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuBtn = document.getElementById('mobileMenuBtn');

        function openSidebar() {
            sidebar?.classList.add('show');
            overlay?.classList.add('show');
        }

        function closeSidebar() {
            sidebar?.classList.remove('show');
            overlay?.classList.remove('show');
        }

        menuBtn?.addEventListener('click', openSidebar);
        overlay?.addEventListener('click', closeSidebar);

        document.querySelectorAll('#appSidebar a').forEach(link => {
            link.addEventListener('click', closeSidebar);
        });


        /**
         * AUTO DISMISS SUCCESS ALERT
         */
        document.querySelectorAll('.alert-success').forEach(alert => {

            setTimeout(() => {

                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();

            }, 5000);

        });

    </script>


    {{-- PAGE SPECIFIC JAVASCRIPT --}}
    @stack('scripts')

</body>
</html>
