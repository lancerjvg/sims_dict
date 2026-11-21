
@extends('layouts.app')

@section('title', 'Subject Management')

@section('page-heading')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <div class="text-muted small mb-1">Academic Management / Subjects</div>
        <h2 class="fw-bold mb-1">Subject Management</h2>
        <p class="text-muted mb-0">
            Manage academic subjects, course descriptions, and units.
        </p>
    </div>

    <a href="{{ route('subjects.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add New Subject
    </a>
</div>
@endsection

@section('content')

{{-- STATISTICS --}}
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="subject-stat-card">
            <div class="subject-stat-icon purple">
                <i class="bi bi-book-fill"></i>
            </div>
            <div>
                <div class="subject-stat-label">Total Subjects</div>
                <div class="subject-stat-value">{{ $subjects->total() }}</div>
                <small class="text-muted">Matching subject records</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="subject-stat-card">
            <div class="subject-stat-icon blue">
                <i class="bi bi-list-ul"></i>
            </div>
            <div>
                <div class="subject-stat-label">Showing Records</div>
                <div class="subject-stat-value">{{ $subjects->count() }}</div>
                <small class="text-muted">Records on this page</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="subject-stat-card">
            <div class="subject-stat-icon orange">
                <i class="bi bi-funnel-fill"></i>
            </div>
            <div>
                <div class="subject-stat-label">Current Filter</div>
                <div class="subject-stat-value filter-value">
                    @if(request('search'))
                Search Active
            @elseif(request('units'))
                {{ request('units') }} Units
            @else
                All Subjects
            @endif
                </div>
                <small class="text-muted">Directory filter status</small>
            </div>
        </div>
    </div>

</div>


{{-- SUBJECT DIRECTORY --}}
<div class="premium-card subject-directory-card">

    {{-- HEADER --}}
    <div class="subject-card-header">
        <div>
            <h5 class="fw-bold mb-1">
                <i class="bi bi-journal-bookmark-fill text-primary me-2"></i>
                Subject Directory
            </h5>
            <p class="text-muted small mb-0">
                Search, filter, sort, and manage academic subjects.
            </p>
        </div>

        <span class="badge rounded-pill bg-light text-dark border">
            {{ $subjects->total() }} Records
        </span>
    </div>


    {{-- SEARCH & FILTER --}}
    <div class="subject-toolbar">

        <form action="{{ route('subjects.index') }}"
              method="GET"
              id="subjectSearchForm">

            <div class="row g-3 align-items-start">

                {{-- SEARCH SUBJECT --}}
                <div class="col-lg-6 col-md-12">

                    <label class="form-label fw-semibold control-label">
                        Search Subject
                    </label>

                    <div class="input-group search-input-group">

                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>

                        <input type="text"
                               name="search"
                               id="subjectSearchInput"
                               class="form-control"
                               placeholder="Type subject code or subject name..."
                               value="{{ request('search') }}"
                               autocomplete="off">

                        @if(request('search'))
                            <a href="{{ route('subjects.index', request()->except(['search', 'page'])) }}"
                               class="btn btn-outline-secondary"
                               title="Clear Search">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif

                    </div>

                    <small class="search-helper text-muted">
                        <i class="bi bi-lightning-charge-fill text-warning"></i>
                        Automatic search after 2 characters
                    </small>

                    <div id="subjectSearchStatus" class="small mt-1"></div>

                </div>


                {{-- FILTER BY UNITS --}}
                <div class="col-lg-3 col-md-6">

                    <label class="form-label fw-semibold control-label">
                        Filter by Units
                    </label>

                    <select name="units"
                            id="subjectUnitsFilter"
                            class="form-select">

                        <option value="">All Units</option>

                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}"
                                {{ request('units') == $i ? 'selected' : '' }}>
                                {{ $i }} Unit{{ $i > 1 ? 's' : '' }}
                            </option>
                        @endfor

                    </select>

                </div>


                {{-- SORT SUBJECT INFORMATION --}}
                <div class="col-lg-3 col-md-6">

                    <label class="form-label fw-semibold control-label">
                        Sort Subject Information
                    </label>

                    <select name="direction"
                            id="subjectSortFilter"
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

                    <input type="hidden" name="sort" value="subject_name">

                </div>

            </div>

        </form>

    </div>


    {{-- SUBJECT TABLE --}}
    <div class="table-responsive subject-table-wrapper">

        <table class="table premium-table align-middle mb-0">

            <thead>
                <tr>
                    <th style="width:160px;">Subject Code</th>
                    <th>Subject Information</th>
                    <th style="width:110px;" class="text-center">Units</th>
                    <th style="width:150px;" class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($subjects as $subject)

                    <tr>

                        {{-- SUBJECT CODE --}}
                        <td>
                            <span class="subject-code-badge">
                                {{ $subject->subject_code }}
                            </span>
                        </td>


                        {{-- SUBJECT INFORMATION --}}
                        <td>
                            <div class="d-flex align-items-start gap-3">

                                <div class="subject-info-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>

                                <div class="subject-info-content">

                                    <div class="subject-name">
                                        {{ $subject->subject_name }}
                                    </div>

                                    <div class="subject-id text-muted small">
                                        Subject ID: #{{ $subject->id }}
                                    </div>

                                    @if($subject->description)
                                        <div class="subject-description text-muted">
                                            {{ \Illuminate\Support\Str::limit($subject->description, 75) }}
                                        </div>
                                    @else
                                        <div class="subject-description text-muted fst-italic">
                                            No description available
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </td>


                        {{-- UNITS --}}
                        <td class="text-center">
                            <span class="units-badge">
                                {{ $subject->units }}
                                {{ $subject->units > 1 ? 'Units' : 'Unit' }}
                            </span>
                        </td>


                        {{-- ACTIONS --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                {{-- VIEW --}}
                                <a href="{{ route('subjects.show', $subject) }}"
                                   class="btn btn-outline-primary subject-action-btn"
                                   title="View Subject">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('subjects.edit', $subject) }}"
                                   class="btn btn-outline-warning subject-action-btn"
                                   title="Edit Subject">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('subjects.destroy', $subject) }}"
                                      method="POST"
                                      class="d-inline delete-subject-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                            class="btn btn-outline-danger subject-action-btn btn-delete-subject"
                                            title="Delete Subject"
                                            data-subject-code="{{ $subject->subject_code }}"
                                            data-subject-name="{{ $subject->subject_name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    {{-- EMPTY STATE --}}
                    <tr>
                        <td colspan="4">
                            <div class="subject-empty-state">

                                <div class="subject-empty-icon">
                                    <i class="bi bi-search"></i>
                                </div>

                                <h5 class="fw-bold mb-2">No Subjects Found</h5>

                                <p class="text-muted mb-3">
                                    No subjects match your search or filter criteria.
                                </p>

                                <a href="{{ route('subjects.index') }}"
                                   class="btn btn-outline-primary btn-sm">
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


    {{-- PAGINATION --}}
    @if($subjects->total() > 0)

        <div class="subject-pagination-footer">

            <div class="pagination-info text-muted small">
                Showing
                <strong>{{ $subjects->firstItem() }}</strong>
                to
                <strong>{{ $subjects->lastItem() }}</strong>
                of
                <strong>{{ $subjects->total() }}</strong>
                subjects
            </div>

            <div>
                {{ $subjects->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>

    @endif

</div>

@endsection


{{-- STYLES --}}
@push('styles')
<style>

/* ================= STAT CARDS ================= */

.subject-stat-card {
    background: #ffffff;
    border: 1px solid #e9edf5;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    height: 100%;
    box-shadow: 0 4px 14px rgba(15,23,42,.03);
}

.subject-stat-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    font-size: 21px;
}

.subject-stat-icon.purple {
    background: #eeebff;
    color: #635bdb;
}

.subject-stat-icon.blue {
    background: #e7f2ff;
    color: #2563eb;
}

.subject-stat-icon.orange {
    background: #fff2e5;
    color: #f59e0b;
}

.subject-stat-label {
    color: #64748b;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 4px;
}

.subject-stat-value {
    color: #172033;
    font-size: 24px;
    font-weight: 800;
    line-height: 1.2;
}

.subject-stat-value.filter-value {
    font-size: 18px;
}


/* ================= DIRECTORY CARD ================= */

.subject-directory-card {
    background: #fff;
    border: 1px solid #e8edf5;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(15,23,42,.04);
}

.subject-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 24px;
    gap: 15px;
    border-bottom: 1px solid #edf0f5;
}


/* ================= TOOLBAR ALIGNMENT ================= */

.subject-toolbar {
    padding: 22px 24px;
    background: #fafbfe;
    border-bottom: 1px solid #edf0f5;
}

/* Align all three controls at the same top position */
.subject-toolbar .row {
    align-items: flex-start !important;
}

.subject-toolbar .form-label {
    display: block;
    margin-bottom: 8px;
    min-height: 20px;
    font-size: 13px;
    color: #344054;
}

/* Search and Select controls */
.subject-toolbar .form-control,
.subject-toolbar .form-select,
.subject-toolbar .input-group,
.subject-toolbar .input-group-text {
    min-height: 43px;
}

.subject-toolbar .form-control,
.subject-toolbar .form-select {
    border-color: #e0e6ef;
}

.subject-toolbar .form-control:focus,
.subject-toolbar .form-select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,.12);
}

.subject-toolbar .input-group-text {
    background: #fff;
    color: #64748b;
    border-color: #e0e6ef;
}

/* Helper text stays BELOW the Search input.
   It will not affect alignment of the other controls. */
.subject-toolbar .search-helper {
    display: block;
    margin-top: 5px;
    line-height: 18px;
}

#subjectSearchStatus {
    color: #64748b;
    min-height: 18px;
}


/* ================= TABLE ================= */

.subject-table-wrapper {
    min-height: 250px;
}

.subject-table-wrapper table {
    min-width: 750px;
}

.subject-table-wrapper .premium-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .6px;
    padding: 15px 18px;
    border-bottom: 1px solid #e9edf5;
    white-space: nowrap;
}

.subject-table-wrapper .premium-table tbody td {
    padding: 17px 18px;
    border-bottom: 1px solid #f0f2f6;
}

.subject-table-wrapper .premium-table tbody tr:hover {
    background: #fafbff;
}


/* ================= SUBJECT INFORMATION ================= */

.subject-code-badge {
    display: inline-block;
    padding: 7px 11px;
    border-radius: 8px;
    background: #eef2ff;
    color: #4f46e5;
    font-size: 12px;
    font-weight: 800;
    white-space: nowrap;
}

.subject-info-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 12px;
    background: #f0f4ff;
    color: #6366f1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
}

.subject-name {
    color: #172033;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 3px;
}

.subject-id {
    font-size: 11px;
    margin-bottom: 4px;
}

.subject-description {
    font-size: 12px;
    line-height: 1.5;
    max-width: 450px;
}


/* ================= UNITS ================= */

.units-badge {
    display: inline-block;
    min-width: 65px;
    padding: 7px 10px;
    border-radius: 20px;
    background: #ecfdf3;
    color: #15803d;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}


/* ================= ACTION BUTTONS ================= */

.subject-action-btn {
    width: 34px;
    height: 34px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
}


/* ================= EMPTY STATE ================= */

.subject-empty-state {
    padding: 55px 20px;
    text-align: center;
}

.subject-empty-icon {
    width: 64px;
    height: 64px;
    border-radius: 18px;
    background: #f1f5f9;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin: 0 auto 16px;
}


/* ================= PAGINATION ================= */

.subject-pagination-footer {
    padding: 18px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    border-top: 1px solid #edf0f5;
}

.subject-pagination-footer .pagination {
    margin-bottom: 0;
}


/* ================= RESPONSIVE ================= */

@media (max-width: 768px) {

    .subject-card-header {
        padding: 18px;
        align-items: flex-start;
    }

    .subject-toolbar {
        padding: 18px;
    }

    .subject-pagination-footer {
        padding: 18px;
        flex-direction: column;
        align-items: flex-start;
    }

}

</style>
@endpush


{{-- SCRIPTS --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput  = document.getElementById('subjectSearchInput');
    const searchForm   = document.getElementById('subjectSearchForm');
    const unitsFilter  = document.getElementById('subjectUnitsFilter');
    const sortFilter  = document.getElementById('subjectSortFilter');
    const searchStatus = document.getElementById('subjectSearchStatus');

    let searchTimer = null;


    // ==========================================
    // RESTORE SEARCH FOCUS AFTER PAGE RELOAD
    // ==========================================
    if (searchInput) {

        const searchValue = searchInput.value.trim();

        if (searchValue.length >= 2) {

            searchInput.focus();

            const cursorPosition = searchInput.value.length;

            searchInput.setSelectionRange(
                cursorPosition,
                cursorPosition
            );
        }
    }


    // ==========================================
    // AUTO SEARCH AFTER 2 CHARACTERS
    // ==========================================
    if (searchInput && searchForm) {

        searchInput.addEventListener('input', function () {

            clearTimeout(searchTimer);

            const searchValue = this.value.trim();

            // One character: wait for next character
            if (searchValue.length === 1) {

                if (searchStatus) {
                    searchStatus.textContent =
                        'Type at least 2 characters to search.';
                }

                return;
            }


            // Empty: return all subjects
            if (searchValue.length === 0) {

                if (searchStatus) {
                    searchStatus.textContent = 'Loading all subjects...';
                }

                searchTimer = setTimeout(function () {
                    searchForm.submit();
                }, 500);

                return;
            }


            // 2 or more characters: auto search
            if (searchValue.length >= 2) {

                if (searchStatus) {
                    searchStatus.innerHTML =
                        '<i class="bi bi-arrow-repeat"></i> Searching...';
                }

                searchTimer = setTimeout(function () {
                    searchForm.submit();
                }, 500);
            }

        });

    }


    // ==========================================
    // AUTO FILTER BY UNITS
    // ==========================================
    if (unitsFilter && searchForm) {

        unitsFilter.addEventListener('change', function () {
            searchForm.submit();
        });
    }


    // ==========================================
    // AUTO SORT SUBJECT INFORMATION
    // ==========================================
    if (sortFilter && searchForm) {

        sortFilter.addEventListener('change', function () {
            searchForm.submit();
        });
    }


    // ==========================================
    // DELETE SUBJECT CONFIRMATION
    // SIMSAlert is defined globally in app.blade.php
    // ==========================================
    document.addEventListener('click', function (event) {

        const deleteButton = event.target.closest('.btn-delete-subject');

        if (!deleteButton) return;

        const form = deleteButton.closest('.delete-subject-form');

        if (!form) return;

        const subjectCode = deleteButton.dataset.subjectCode || '';
        const subjectName = deleteButton.dataset.subjectName || '';

        if (typeof SIMSAlert === 'undefined') {

            if (confirm('Delete ' + subjectCode + ' - ' + subjectName + '?')) {
                form.submit();
            }

            return;
        }


        SIMSAlert.confirmDelete({
            title: 'Delete Subject?',
            text: 'You are about to delete ' + subjectCode + ' - ' + subjectName + '.',
            confirmText: 'Yes, Delete',
            cancelText: 'Cancel',
            confirmColor: '#dc3545',
            cancelColor: '#64748b'
        }).then(function (result) {

            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Deleting Subject...',
                    text: 'Please wait.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: function () {
                        Swal.showLoading();
                    }
                });

                form.submit();
            }

        });

    });

});
</script>
@endpush
