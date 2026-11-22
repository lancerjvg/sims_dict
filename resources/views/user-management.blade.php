@extends('layouts.app')

@section('title', 'User Management')
@section('page-heading', 'User Management')

@section('content')

<style>
        :root {
            --bg: #0f172a;
            --card: #111827;
            --card-light: #1e293b;
            --border: #263449;
            --text: #f1f5f9;
            --muted: #94a3b8;
            --primary: #6366f1;
            --primary-light: #818cf8;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        * {
            box-sizing: border-box;
        }

        .page-container {
            padding: 30px;
            max-width: 1600px;
            margin: auto;
        }

        /* HEADER */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 14px;
        }

        .btn-add-user {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 11px 18px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
        }

        .btn-add-user:hover {
            background: var(--primary-light);
            color: white;
            transform: translateY(-1px);
        }

        /* STATISTICS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 22px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: .2s;
        }

        .stat-card:hover {
            border-color: #475569;
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .stat-icon.total {
            background: rgba(99, 102, 241, .15);
            color: #818cf8;
        }

        .stat-icon.active {
            background: rgba(34, 197, 94, .15);
            color: #22c55e;
        }

        .stat-icon.inactive {
            background: rgba(239, 68, 68, .15);
            color: #ef4444;
        }

        .stat-label {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
        }

        /* MAIN CARD */

        .main-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title {
            font-size: 17px;
            font-weight: 600;
            margin: 0;
        }

        /* SEARCH */

        .search-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-input {
            background: #0f172a;
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 9px;
            padding: 10px 14px;
            min-width: 260px;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .15);
        }

        .search-input::placeholder {
            color: #64748b;
        }

        .btn-search {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 10px 16px;
            font-weight: 600;
        }

        .btn-search:hover {
            background: var(--primary-light);
        }

        .btn-clear {
            color: var(--muted);
            text-decoration: none;
            padding: 10px 12px;
            display: inline-flex;
            align-items: center;
        }

        .btn-clear:hover {
            color: white;
        }

        /* TABLE */

        .table-responsive {
            overflow-x: auto;
        }

        .user-table {
            width: 100%;
            margin: 0;
            color: var(--text);
            border-collapse: collapse;
            min-width: 900px;
        }

        .user-table thead th {
            background: #172235;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .user-table tbody td {
            padding: 16px 20px;
            border-bottom: 1px solid #1e293b;
            vertical-align: middle;
        }

        .user-table tbody tr {
            transition: .15s;
        }

        .user-table tbody tr:hover {
            background: rgba(30, 41, 59, .45);
        }

        .user-table tbody tr:last-child td {
            border-bottom: none;
        }

        .user-id {
            color: var(--muted);
            font-size: 13px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .user-email {
            color: var(--muted);
            font-size: 12px;
        }

        /* BADGES */

        .role-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(99, 102, 241, .15);
            color: #a5b4fc;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: rgba(34, 197, 94, .12);
            color: #4ade80;
        }

        .status-inactive {
            background: rgba(239, 68, 68, .12);
            color: #f87171;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        /* ACTION BUTTONS */

        .actions-container {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-edit,
        .btn-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: .2s;
            white-space: nowrap;
        }

        .btn-edit {
            color: #a5b4fc;
            background: rgba(99, 102, 241, .12);
            border-color: rgba(99, 102, 241, .25);
        }

        .btn-edit:hover {
            background: rgba(99, 102, 241, .25);
            color: #c7d2fe;
        }

        .btn-deactivate {
            color: #f87171;
            background: rgba(239, 68, 68, .1);
            border-color: rgba(239, 68, 68, .25);
        }

        .btn-deactivate:hover {
            background: rgba(239, 68, 68, .2);
            color: #fca5a5;
        }

        .btn-activate {
            color: #4ade80;
            background: rgba(34, 197, 94, .1);
            border-color: rgba(34, 197, 94, .25);
        }

        .btn-activate:hover {
            background: rgba(34, 197, 94, .2);
            color: #86efac;
        }

        /* EMPTY STATE */

        .empty-state {
            text-align: center;
            padding: 60px 20px !important;
        }

        .empty-icon {
            font-size: 45px;
            color: #475569;
            margin-bottom: 15px;
        }

        .empty-title {
            font-weight: 600;
            font-size: 17px;
            margin-bottom: 5px;
        }

        .empty-text {
            color: var(--muted);
            font-size: 14px;
        }

        /* PAGINATION */

        .pagination-container {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            color: var(--muted);
            font-size: 13px;
        }

        .pagination {
            margin: 0;
        }

        .page-link {
            background: #111827;
            border-color: var(--border);
            color: #cbd5e1;
        }

        .page-link:hover {
            background: #1e293b;
            border-color: #475569;
            color: white;
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .page-item.disabled .page-link {
            background: #111827;
            border-color: var(--border);
            color: #475569;
        }

        /* SWEETALERT2 DARK THEME */

        .sims-swal-popup {
            border: 1px solid #263449 !important;
            border-radius: 18px !important;
        }

        .sims-swal-title {
            color: #f1f5f9 !important;
        }

        /* RESPONSIVE */

        @media (max-width: 768px) {
            .page-container {
                padding: 15px;
            }

            .page-title {
                font-size: 23px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .stat-card {
                padding: 17px;
            }

            .card-header-custom {
                padding: 17px;
            }

            .search-form {
                width: 100%;
            }

            .search-input {
                min-width: 0;
                width: 100%;
                flex: 1;
            }

            .pagination-container {
                padding: 17px;
            }
        }
    </style>

<div class="page-container">

    <!-- PAGE HEADER -->
    <div class="page-header">

        <div>
            <h1 class="page-title">
                <i class="bi bi-people-fill text-primary me-2"></i>
                User Management
            </h1>

            <div class="page-subtitle">
                Manage system users, roles, and account status.
            </div>
        </div>

        <a href="{{ route('user-registration') }}" class="btn-add-user">
            <i class="bi bi-person-plus-fill me-2"></i>
            Add New User
        </a>

    </div>

    <!-- STATISTICS -->
    <div class="stats-grid">

        <!-- TOTAL USERS -->
        <div class="stat-card">

            <div class="stat-icon total">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>

        </div>

        <!-- ACTIVE USERS -->
        <div class="stat-card">

            <div class="stat-icon active">
                <i class="bi bi-person-check-fill"></i>
            </div>

            <div>
                <div class="stat-label">Active Users</div>
                <div class="stat-value">{{ $activeUsers }}</div>
            </div>

        </div>

        <!-- INACTIVE USERS -->
        <div class="stat-card">

            <div class="stat-icon inactive">
                <i class="bi bi-person-x-fill"></i>
            </div>

            <div>
                <div class="stat-label">Inactive Users</div>
                <div class="stat-value">{{ $inactiveUsers }}</div>
            </div>

        </div>

    </div>

    <!-- USER MANAGEMENT CARD -->
    <div class="main-card">

        <!-- CARD HEADER -->
        <div class="card-header-custom">

            <h5 class="section-title">
                <i class="bi bi-list-ul me-2 text-primary"></i>
                Registered Users
            </h5>

            <!-- SEARCH -->
            <form method="GET"
                  action="{{ route('user-management.index') }}"
                  class="search-form">

                <input type="text"
                       name="search"
                       class="search-input"
                       value="{{ $search ?? '' }}"
                       placeholder="Search name, email, role, status...">

                <button type="submit" class="btn-search">
                    <i class="bi bi-search me-1"></i>
                    Search
                </button>

                @if(!empty($search))
                    <a href="{{ route('user-management.index') }}"
                       class="btn-clear"
                       title="Clear Search">
                        <i class="bi bi-x-circle me-1"></i>
                        Clear
                    </a>
                @endif

            </form>

        </div>

        <!-- TABLE -->
        <div class="table-responsive">

            <table class="user-table">

                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>User Information</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Date Registered</th>
                        <th style="min-width: 220px;">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $user)

                        <tr>

                            <!-- ID -->
                            <td>
                                <span class="user-id">#{{ $user->id }}</span>
                            </td>

                            <!-- USER -->
                            <td>
                                <div class="user-info">

                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>

                                        <div class="user-email">
                                            {{ $user->email }}
                                        </div>
                                    </div>

                                </div>
                            </td>

                            <!-- ROLE -->
                            <td>
                                <span class="role-badge">
                                    {{ $user->role ?? 'Staff' }}
                                </span>
                            </td>

                            <!-- STATUS -->
                            <td>

                                @if(($user->status ?? 'Active') === 'Active')

                                    <span class="status-badge status-active">
                                        <span class="status-dot"></span>
                                        Active
                                    </span>

                                @else

                                    <span class="status-badge status-inactive">
                                        <span class="status-dot"></span>
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <!-- DATE REGISTERED -->
                            <td>
                                <span class="user-id">
                                    {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                </span>
                            </td>

                            <!-- ACTIONS -->
                            <td>

                                <div class="actions-container">

                                    <!-- EDIT -->
                                    <a href="{{ route('user-management.edit', $user->id) }}"
                                       class="btn-edit"
                                       title="Edit User">

                                        <i class="bi bi-pencil-square"></i>
                                        Edit

                                    </a>

                                    <!-- ACTIVATE / DEACTIVATE -->
                                    <form method="POST"
                                          action="{{ route('user-management.toggle-status', $user->id) }}"
                                          class="status-toggle-form"
                                          data-user-name="{{ $user->name }}"
                                          data-current-status="{{ $user->status ?? 'Active' }}">

                                        @csrf
                                        @method('PATCH')

                                        @if(($user->status ?? 'Active') === 'Active')

                                            <button type="submit"
                                                    class="btn-status btn-deactivate"
                                                    title="Deactivate Account">

                                                <i class="bi bi-person-x"></i>
                                                Deactivate

                                            </button>

                                        @else

                                            <button type="submit"
                                                    class="btn-status btn-activate"
                                                    title="Activate Account">

                                                <i class="bi bi-person-check"></i>
                                                Activate

                                            </button>

                                        @endif

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <!-- EMPTY STATE -->
                        <tr>
                            <td colspan="6" class="empty-state">

                                <div class="empty-icon">
                                    <i class="bi bi-person-slash"></i>
                                </div>

                                <div class="empty-title">
                                    No users found
                                </div>

                                <div class="empty-text">
                                    @if(!empty($search))
                                        No users matched your search.
                                    @else
                                        No registered users available.
                                    @endif
                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        @if($users->hasPages() || $users->total() > 0)

            <div class="pagination-container">

                <div class="pagination-info">
                    Showing
                    <strong>{{ $users->firstItem() ?? 0 }}</strong>
                    to
                    <strong>{{ $users->lastItem() ?? 0 }}</strong>
                    of
                    <strong>{{ $users->total() }}</strong>
                    users
                </div>

                <div>
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>

            </div>

        @endif

    </div>

</div>

<!-- SWEETALERT2: ACTIVATE / DEACTIVATE -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.status-toggle-form').forEach(function(form) {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            const userName = form.dataset.userName;
            const currentStatus = form.dataset.currentStatus;

            const isDeactivating = currentStatus === 'Active';

            Swal.fire({

                title: isDeactivating
                    ? 'Deactivate Account?'
                    : 'Activate Account?',

                html: isDeactivating
                    ? `Are you sure you want to deactivate <strong>${userName}</strong>?`
                    : `Are you sure you want to activate <strong>${userName}</strong>?`,

                icon: isDeactivating ? 'warning' : 'question',

                showCancelButton: true,

                confirmButtonText: isDeactivating
                    ? '<i class="bi bi-person-x me-1"></i> Yes, Deactivate'
                    : '<i class="bi bi-person-check me-1"></i> Yes, Activate',

                cancelButtonText: '<i class="bi bi-x-lg me-1"></i> Cancel',

                confirmButtonColor: isDeactivating
                    ? '#dc3545'
                    : '#198754',

                cancelButtonColor: '#475569',

                reverseButtons: true,

                background: '#111827',
                color: '#f1f5f9',

                customClass: {
                    popup: 'sims-swal-popup',
                    title: 'sims-swal-title'
                },

                buttonsStyling: true,

                focusCancel: true

            }).then(function(result) {

                if (result.isConfirmed) {

                    // Submit the Laravel form after confirmation
                    form.submit();

                }

            });

        });

    });

});
</script>

<!-- SWEETALERT2: LARAVEL SUCCESS MESSAGE -->
@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({

        icon: 'success',

        title: 'Success!',

        text: @json(session('success')),

        confirmButtonText: 'OK',

        confirmButtonColor: '#6366f1',

        background: '#111827',
        color: '#f1f5f9',

        customClass: {
            popup: 'sims-swal-popup',
            title: 'sims-swal-title'
        }

    });

});
</script>
@endif

@endsection
