@extends('layouts.app')

@section('title', 'Course Management')
@section('page-heading', 'Course Management')

@section('content')
<div class="course-page">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="text-muted small mb-1"><i class="bi bi-mortarboard me-1"></i> Academic Setup</div>
            <h2 class="fw-bold mb-1">Course Management</h2>
            <p class="text-muted mb-0">Manage offered courses and their availability.</p>
        </div>
        <a href="{{ route('courses.create') }}" class="btn btn-primary rounded-3 px-3">
            <i class="bi bi-plus-lg me-2"></i>Add Course
        </a>
    </div>


    <!-- Statistics -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="course-stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div><div class="stat-label">Total Courses</div><div class="stat-number">{{ $totalCourses ?? 0 }}</div></div>
                    <div class="course-stat-icon icon-indigo"><i class="bi bi-journal-bookmark-fill"></i></div>
                </div>
                <div class="stat-foot">All courses in the catalog</div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="course-stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div><div class="stat-label">Active Courses</div><div class="stat-number">{{ $activeCourses ?? 0 }}</div></div>
                    <div class="course-stat-icon icon-green"><i class="bi bi-check-circle-fill"></i></div>
                </div>
                <div class="stat-foot">Available for student registration</div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="course-stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div><div class="stat-label">Inactive Courses</div><div class="stat-number">{{ $inactiveCourses ?? 0 }}</div></div>
                    <div class="course-stat-icon icon-amber"><i class="bi bi-pause-circle-fill"></i></div>
                </div>
                <div class="stat-foot">Currently unavailable for registration</div>
            </div>
        </div>
    </div>


    <!-- Course List -->
    <div class="card course-list-card border-0 shadow-sm">
        <div class="card-body p-3 p-lg-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h5 class="fw-bold mb-1">Course Information</h5>
                    <div class="text-muted small">Courses are arranged alphabetically by course information (A–Z).</div>
                </div>
                <div class="text-muted small">{{ $courses->total() }} record(s)</div>
            </div>


            <!-- Search and Filter -->
            <form method="GET" action="{{ route('courses.index') }}" id="courseFilterForm" class="course-toolbar mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-md">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search text-primary"></i></span>
                            <input type="search" name="search" id="courseSearch" class="form-control" value="{{ $search ?? request('search') }}" placeholder="Search course code, information, or description..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <select name="status" id="courseStatus" class="form-select">
                            <option value="all" {{ ($status ?? request('status', 'all')) === 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="active" {{ ($status ?? request('status')) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ ($status ?? request('status')) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-3"><i class="bi bi-search me-1"></i>Search</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-light border rounded-3" title="Clear filters"><i class="bi bi-arrow-counterclockwise"></i></a>
                    </div>
                </div>
            </form>


            <!-- Table -->
            <div class="table-responsive course-table-wrap">
                <table class="table premium-table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 150px;">Course Code</th>
                            <th>Course Information</th>
                            <th>Description</th>
                            <th style="width: 120px;">Status</th>
                            <th class="text-end" style="width: 170px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td><span class="course-code-badge">{{ $course->course_code }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="course-row-icon"><i class="bi bi-mortarboard-fill"></i></div>
                                        <div class="fw-semibold text-dark">{{ $course->course_name }}</div>
                                    </div>
                                </td>
                                <td><span class="text-muted course-description">{{ $course->description ?: '—' }}</span></td>
                                <td>
                                    @if($course->is_active)
                                        <span class="course-status status-active"><i class="bi bi-check-circle-fill me-1"></i>Active</span>
                                    @else
                                        <span class="course-status status-inactive"><i class="bi bi-pause-circle-fill me-1"></i>Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-light border course-action-btn" title="Edit Course">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </a>
                                        <form action="{{ route('courses.toggleStatus', $course) }}" method="POST" class="toggle-course-form"
                                              data-course-name="{{ $course->course_name }}" data-current-status="{{ $course->is_active ? 'active' : 'inactive' }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-light border course-action-btn" title="{{ $course->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="bi {{ $course->is_active ? 'bi-pause-circle text-warning' : 'bi-play-circle text-success' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="delete-course-form" data-course-name="{{ $course->course_name }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border course-action-btn" title="Delete Course">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="course-empty-icon mb-3"><i class="bi bi-journal-x"></i></div>
                                    <div class="fw-semibold text-dark">No courses found</div>
                                    <div class="text-muted small">Try changing your search or filter, or add a new course.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <!-- Pagination -->
            @if($courses->hasPages())
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-3">
                    <div class="text-muted small">Showing {{ $courses->firstItem() }}–{{ $courses->lastItem() }} of {{ $courses->total() }} courses</div>
                    <div>{{ $courses->links('pagination::bootstrap-5') }}</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .course-page { color: #101828; }
    .course-stat-card { background: #fff; border: 1px solid #EAECF0; border-radius: 17px; padding: 20px; height: 100%; box-shadow: 0 3px 12px rgba(16,24,40,.035); }
    .stat-label { color: #667085; font-size: 12px; font-weight: 600; }
    .stat-number { color: #101828; font-size: 27px; font-weight: 800; margin-top: 5px; }
    .stat-foot { color: #98A2B3; font-size: 11px; margin-top: 12px; }
    .course-stat-icon { width: 45px; height: 45px; border-radius: 13px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .icon-indigo { color: #4F46E5; background: #EEF2FF; }
    .icon-green { color: #16A34A; background: #ECFDF3; }
    .icon-amber { color: #D97706; background: #FFFAEB; }
    .course-list-card { border-radius: 18px; background: #fff; }
    .course-toolbar { background: #F9FAFB; border: 1px solid #EAECF0; border-radius: 13px; padding: 13px; }
    .course-toolbar .form-control, .course-toolbar .form-select, .course-toolbar .input-group-text { min-height: 43px; border-color: #E4E7EC; }
    .course-code-badge { display: inline-block; background: #EEF2FF; color: #4F46E5; border: 1px solid #E0E7FF; border-radius: 8px; padding: 6px 10px; font-size: 12px; font-weight: 700; letter-spacing: .4px; }
    .course-row-icon { width: 35px; height: 35px; border-radius: 10px; background: #F4F3FF; color: #6366F1; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .course-description { display: block; max-width: 280px; white-space: normal; font-size: 12px; }
    .course-status { display: inline-block; padding: 6px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; white-space: nowrap; }
    .status-active { background: #ECFDF3; color: #027A48; }
    .status-inactive { background: #FFF7ED; color: #C2410C; }
    .course-action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 9px; }
    .course-action-btn:hover { background: #F3F4F6; transform: translateY(-1px); }
    .course-empty-icon { font-size: 34px; color: #98A2B3; }
    @media (max-width: 575.98px) { .course-stat-card { padding: 16px; } .course-description { min-width: 180px; } }
</style>
@endpush

@push('scripts')
<script>
    // Subject-style search: auto-submit after 2+ characters, debounce, restore focus/caret.
    (() => {
        const searchInput = document.getElementById('courseSearch');
        const filterForm = document.getElementById('courseFilterForm');
        if (!searchInput || !filterForm) return;

        let searchTimer;
        const currentSearch = searchInput.value.trim();
        const restoreFocus = sessionStorage.getItem('courseSearchRestoreFocus') === '1';
        sessionStorage.removeItem('courseSearchRestoreFocus');

        if (restoreFocus && currentSearch.length >= 2) {
            searchInput.focus();
            searchInput.setSelectionRange(currentSearch.length, currentSearch.length);
        }

        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimer);
            const value = this.value.trim();
            if (value.length >= 2) {
                searchTimer = setTimeout(() => {
                    sessionStorage.setItem('courseSearchRestoreFocus', '1');
                    filterForm.submit();
                }, 500);
            } else if (value.length === 0) {
                searchTimer = setTimeout(() => {
                    sessionStorage.setItem('courseSearchRestoreFocus', '1');
                    filterForm.submit();
                }, 500);
            }
        });

        // Status changes submit immediately and retain the search query.
        const statusSelect = document.getElementById('courseStatus');
        if (statusSelect) {
            statusSelect.addEventListener('change', () => filterForm.submit());
        }
    })();


    // Status confirmation (Activate / Deactivate)
    document.querySelectorAll('.toggle-course-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const courseName = this.dataset.courseName;
            const isActive = this.dataset.currentStatus === 'active';

            Swal.fire({
                title: isActive ? 'Deactivate Course?' : 'Activate Course?',
                html: isActive
                    ? `Are you sure you want to deactivate <strong>${courseName}</strong>?`
                    : `Are you sure you want to activate <strong>${courseName}</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: isActive ? '<i class="bi bi-pause-circle me-1"></i> Yes, Deactivate' : '<i class="bi bi-play-circle me-1"></i> Yes, Activate',
                cancelButtonText: 'Cancel',
                confirmButtonColor: isActive ? '#F59E0B' : '#6366F1',
                cancelButtonColor: '#64748B',
                reverseButtons: true,
                focusCancel: true,
                customClass: { popup: 'premium-swal-popup', confirmButton: 'premium-swal-confirm', cancelButton: 'premium-swal-cancel' }
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // Delete confirmation
    document.querySelectorAll('.delete-course-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const courseName = this.dataset.courseName;
            Swal.fire({
                title: 'Delete Course?',
                html: `You are about to permanently delete <strong>${courseName}</strong>. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<i class="bi bi-trash me-1"></i> Yes, Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#64748B',
                reverseButtons: true,
                focusCancel: true,
                customClass: { popup: 'premium-swal-popup', confirmButton: 'premium-swal-confirm', cancelButton: 'premium-swal-cancel' }
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endpush
