
<div class="sims-sidebar">

    <!-- BRAND -->
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <div class="brand-info">
            <div class="brand-title">SIMS Academic</div>
            <div class="brand-title">Portal</div>
            <small>Student Information System</small>
        </div>
    </div>

    <!-- MAIN MENU -->
    <div class="sidebar-section-label">MAIN MENU</div>

    <nav class="sidebar-nav">

        <!-- Dashboard -->
        <a href="{{ url('/dashboard') }}"
           class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-columns-gap"></i>
            <span>Dashboard</span>
        </a>

        <!-- Students -->
        <a href="{{ url('/students') }}"
           class="sidebar-link {{ request()->is('students*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Students</span>
        </a>

        <!-- Subjects -->
        <a href="{{ url('/subjects') }}"
           class="sidebar-link {{ request()->is('subjects*') ? 'active' : '' }}">
            <i class="bi bi-book-fill"></i>
            <span>Subjects</span>
        </a>

        <!-- Enrollments -->
        <a href="{{ url('/enrollments') }}"
           class="sidebar-link {{ request()->is('enrollments*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check-fill"></i>
            <span>Enrollments</span>
        </a>

        <!-- Reports -->
        <a href="{{ url('/reports') }}"
           class="sidebar-link {{ request()->is('reports*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-fill"></i>
            <span>Reports</span>
        </a>
 
    </nav>

    <!-- SYSTEM -->
    <div class="sidebar-section-label system-label">SYSTEM</div>

    <nav class="sidebar-nav">

        <!-- Settings -->
        <a href="{{ url('/settings') }}"
           class="sidebar-link {{ request()->is('settings*') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i>
            <span>Settings</span>
        </a>

        <!-- Course Management -->
        <a href="{{ route('courses.index') }}"
           class="sidebar-link sidebar-sub-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
            <i class="bi bi-mortarboard-fill"></i>
            <span>Course Management</span>
        </a>
 
        <!-- AI ENGINEERING PORTFOLIO -->
        <a href="{{ route('portfolio') }}"
           class="sidebar-link portfolio-menu-link {{ request()->routeIs('portfolio') ? 'active' : '' }}">
            <i class="bi bi-cpu"></i>
            <span>AI Engineering Portfolio</span>
        </a>

    </nav>

</div>

<style>
    .sims-sidebar {
        width: 260px;
        min-height: 100vh;
        background: #111827;
        color: #cbd5e1;
        border-right: 1px solid #1e293b;
        font-family: inherit;
    }

    /* BRAND */
    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 35px 22px 27px;
        border-bottom: 1px solid #263247;
    }

    .brand-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 21px;
        background: linear-gradient(135deg, #818cf8, #4f46e5);
        box-shadow: 0 6px 20px rgba(79, 70, 229, .35);
    }

    .brand-info {
        line-height: 1.3;
    }

    .brand-title {
        font-size: 16px;
        font-weight: 700;
        color: #f8fafc;
    }

    .brand-info small {
        display: block;
        margin-top: 5px;
        color: #94a3b8;
        font-size: 11px;
        letter-spacing: .2px;
    }

    /* SECTION LABEL */
    .sidebar-section-label {
        padding: 24px 22px 13px;
        font-size: 10px;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 1.4px;
    }

    .system-label {
        margin-top: 10px;
    }

    /* NAVIGATION */
    .sidebar-nav {
        padding: 0 12px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 14px;
        min-height: 56px;
        padding: 12px 14px;
        margin-bottom: 4px;
        border-radius: 10px;
        text-decoration: none;
        color: #aebbd0;
        font-size: 14px;
        font-weight: 500;
        transition: all .2s ease;
    }

    .sidebar-link i {
        width: 20px;
        text-align: center;
        font-size: 17px;
        color: #8da3c2;
    }

    /* HOVER */
    .sidebar-link:hover {
        background: #1e293b;
        color: #ffffff;
        transform: translateX(2px);
    }

    .sidebar-link:hover i {
        color: #a5b4fc;
    }

    /* ACTIVE MENU */
    .sidebar-link.active {
        background: linear-gradient(
            90deg,
            rgba(79, 70, 229, .20),
            rgba(79, 70, 229, .07)
        );
        color: #a5b4fc;
        border-left: 3px solid #6366f1;
        padding-left: 11px;
    }

    .sidebar-link.active i {
        color: #818cf8;
    }

    /* SETTINGS SUBMENU */
    .sidebar-link.sidebar-sub-link {
        min-height: 48px;
        margin-left: 16px;
        width: calc(100% - 16px);
        padding-left: 12px;
        font-size: 13px;
        border-radius: 10px;
    }

    .sidebar-link.sidebar-sub-link i {
        font-size: 16px;
    }

    .sidebar-link.sidebar-sub-link.active {
        padding-left: 9px;
    }

    /* AI PORTFOLIO MENU */
    .portfolio-menu-link i {
        color: #a78bfa;
    }

    .portfolio-menu-link:hover {
        background: linear-gradient(
            90deg,
            rgba(139, 92, 246, .16),
            rgba(56, 189, 248, .06)
        );
    }

    .portfolio-menu-link.active {
        background: linear-gradient(
            90deg,
            rgba(139, 92, 246, .22),
            rgba(56, 189, 248, .08)
        );
        color: #c4b5fd;
        border-left: 3px solid #a78bfa;
        padding-left: 11px;
    }

    .portfolio-menu-link.active i {
        color: #c4b5fd;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .sims-sidebar {
            width: 100%;
            min-height: auto;
        }
    }
</style>
