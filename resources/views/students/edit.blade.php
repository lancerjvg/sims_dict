@extends('layouts.app')

@section('page-heading', 'Edit Student')

@section('content')

<div class="container-fluid px-3 px-md-4 pb-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1 edit-page-title">Edit Student</h2>
            <h5 class="text-secondary fw-semibold mb-1">
                Update student profile and academic information.
            </h5>
            <small class="text-muted">Student Information Management System</small>
        </div>

        <a href="{{ route('students.index') }}"
           class="btn btn-outline-secondary rounded-3 px-3 py-2">
            <i class="bi bi-arrow-left me-1"></i>
            Back to Students
        </a>

    </div>

    <!-- MAIN FORM CARD -->
    <div class="edit-student-wrapper">

        <form action="{{ route('students.update', $student->id) }}"
              method="POST"
              enctype="multipart/form-data"
              id="editStudentForm">

            @csrf
            @method('PUT')

            <!-- ================= STUDENT PROFILE HEADER ================= -->
            <div class="edit-section edit-profile-header">

                <div class="row align-items-center g-3">

                    <div class="col">

                        <div class="section-heading mb-0">

                            <div class="section-icon">
                                <i class="bi bi-person-gear"></i>
                            </div>

                            <div>
                                <h4 class="mb-1 fw-bold">Student Profile</h4>
                                <p class="text-muted mb-0">
                                    Modify the student's personal and academic information.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-auto">

                        <div class="student-number-panel">

                            <small class="fw-bold text-muted">
                                <i class="bi bi-hash me-1"></i>
                                STUDENT NUMBER
                            </small>

                            <h5 class="fw-bold mb-1 student-number-value">
                                {{ $student->student_number }}
                            </h5>

                            <small class="text-muted">
                                Student number cannot be changed here.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ================= PHOTO + PERSONAL INFORMATION ================= -->
            <div class="edit-section">

                <div class="section-heading">

                    <div class="section-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>

                    <div>
                        <h4 class="mb-1 fw-bold">Personal Information</h4>
                        <p class="text-muted mb-0">
                            Basic information and identity details of the student.
                        </p>
                    </div>

                </div>

                <!-- PHOTO UPLOAD -->
                <div class="photo-upload-area mb-4">

                    <div class="row align-items-center g-4">

                        <div class="col-md-auto">

                            <div class="photo-preview-wrapper">

                                <img id="photoPreview"
                                     src="{{ $student->photo ? asset('storage/' . $student->photo) : '' }}"
                                     alt="Student Photo"
                                     class="{{ $student->photo ? '' : 'd-none' }}">

                                <div id="photoPlaceholder"
                                     class="photo-placeholder {{ $student->photo ? 'd-none' : '' }}">
                                    <i class="bi bi-person-fill"></i>
                                </div>

                            </div>

                        </div>

                        <div class="col">

                            <h6 class="fw-bold mb-1">Student Photo</h6>

                            <p class="text-muted small mb-3">
                                Upload or change the student's profile picture.
                                JPG or PNG, maximum 2MB.
                            </p>

                            <div class="d-flex flex-wrap gap-2">

                                <label for="photo"
                                       class="btn btn-indigo rounded-3 px-3 mb-0">

                                    <i class="bi bi-camera-fill me-1"></i>
                                    Change Photo

                                </label>

                                <button type="button"
                                        id="removePhotoBtn"
                                        class="btn btn-outline-danger rounded-3 px-3"
                                        {{ $student->photo ? '' : 'disabled' }}>

                                    <i class="bi bi-trash me-1"></i>
                                    Remove Photo

                                </button>

                            </div>

                            <input type="file"
                                   name="photo"
                                   id="photo"
                                   class="d-none"
                                   accept=".jpg,.jpeg,.png,image/jpeg,image/png">

                            <input type="hidden"
                                   name="remove_photo"
                                   id="remove_photo"
                                   value="0">

                            <div id="photoMessage"
                                 class="small mt-2 text-muted">
                                @if($student->photo)
                                    Existing photo is currently displayed.
                                @else
                                    No profile photo uploaded.
                                @endif
                            </div>

                        </div>

                    </div>

                </div>

                <!-- PERSONAL DETAILS -->
                <div class="row g-3">

                    <!-- FIRST NAME -->
                    <div class="col-md-4">

                        <label for="first_name" class="form-label">
                            First Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="first_name"
                               id="first_name"
                               class="form-control"
                               value="{{ old('first_name', $student->first_name) }}"
                               required>

                        @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- MIDDLE NAME -->
                    <div class="col-md-4">

                        <label for="middle_name" class="form-label">
                            Middle Name
                        </label>

                        <input type="text"
                               name="middle_name"
                               id="middle_name"
                               class="form-control"
                               value="{{ old('middle_name', $student->middle_name) }}">

                        @error('middle_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- LAST NAME -->
                    <div class="col-md-4">

                        <label for="last_name" class="form-label">
                            Last Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="last_name"
                               id="last_name"
                               class="form-control"
                               value="{{ old('last_name', $student->last_name) }}"
                               required>

                        @error('last_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- GENDER -->
                    <div class="col-md-4">

                        <label for="gender" class="form-label">
                            Gender
                        </label>

                        <select name="gender"
                                id="gender"
                                class="form-select">

                            <option value="">Select Gender</option>

                            <option value="Male"
                                {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Female"
                                {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>

                        </select>

                    </div>

                    <!-- BIRTH DATE -->
                    <div class="col-md-4">

                        <label for="birth_date" class="form-label">
                            Date of Birth
                        </label>

                        <input type="date"
                               name="birth_date"
                               id="birth_date"
                               class="form-control"
                               value="{{ old('birth_date', $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') : '') }}">

                    </div>

                    <!-- AGE -->
                    <div class="col-md-4">

                        <label for="age" class="form-label">
                            Age
                        </label>

                        <input type="text"
                               id="age"
                               class="form-control"
                               readonly
                               placeholder="Automatically calculated">

                    </div>

                </div>

            </div>

            <!-- ================= CONTACT INFORMATION ================= -->
            <div class="edit-section">

                <div class="section-heading">

                    <div class="section-icon">
                        <i class="bi bi-envelope-at"></i>
                    </div>

                    <div>
                        <h4 class="mb-1 fw-bold">Contact Information</h4>
                        <p class="text-muted mb-0">
                            Student contact details and residential address.
                        </p>
                    </div>

                </div>

                <div class="row g-3">

                    <!-- EMAIL -->
                    <div class="col-md-6">

                        <label for="email" class="form-label">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control"
                               value="{{ old('email', $student->email) }}"
                               placeholder="example@email.com">

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- CONTACT NUMBER -->
                    <div class="col-md-6">

                        <label for="contact_number" class="form-label">
                            Contact Number
                        </label>

                        <input type="text"
                               name="contact_number"
                               id="contact_number"
                               class="form-control"
                               value="{{ old('contact_number', $student->contact_number) }}"
                               placeholder="09XXXXXXXXX">

                        @error('contact_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- ADDRESS -->
                    <div class="col-12">

                        <label for="address" class="form-label">
                            Complete Address
                        </label>

                        <textarea name="address"
                                  id="address"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Enter complete address">{{ old('address', $student->address) }}</textarea>

                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

            </div>

            <!-- ================= ACADEMIC INFORMATION ================= -->
            <div class="edit-section">

                <div class="section-heading">

                    <div class="section-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                    <div>
                        <h4 class="mb-1 fw-bold">Academic Information</h4>
                        <p class="text-muted mb-0">
                            Student course and current academic year level.
                        </p>
                    </div>

                </div>

                <div class="row g-3">

                    <!-- COURSE -->
                    <div class="col-md-8">

                        <label for="course" class="form-label">
                            Course <span class="text-danger">*</span>
                        </label>

                        <select name="course"
                                id="course"
                                class="form-select"
                                required>
                            <option value="">-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->course_name }}"
                                    {{ old('course', $student->course) == $course->course_name ? 'selected' : '' }}>
                                    {{ $course->course_code }} - {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('course')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- YEAR LEVEL -->
                    <div class="col-md-4">

                        <label for="year_level" class="form-label">
                            Year Level <span class="text-danger">*</span>
                        </label>

                        <select name="year_level"
                                id="year_level"
                                class="form-select"
                                required>

                            <option value="">Select Year Level</option>

                            @for($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}"
                                    {{ (string)old('year_level', $student->year_level) === (string)$i ? 'selected' : '' }}>
                                    {{ $i }}{{ match($i) { 1 => 'st', 2 => 'nd', 3 => 'rd', default => 'th' } }} Year
                                </option>
                            @endfor

                        </select>

                        @error('year_level')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

            </div>

            <!-- ================= FORM FOOTER ================= -->
            <div class="edit-form-footer">

                <a href="{{ route('students.show', $student->id) }}"
                   class="btn btn-light border rounded-3 px-4 py-2">
                    <i class="bi bi-x-lg me-1"></i>
                    Cancel
                </a>

                <button type="submit"
                        class="btn btn-indigo rounded-3 px-4 py-2"
                        id="saveStudentBtn">

                    <i class="bi bi-check2-circle me-1"></i>
                    Update Student

                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('styles')

<style>
    /* ================= PAGE ================= */
    .edit-page-title {
        color: #111827;
        font-size: 1.8rem;
    }

    .edit-student-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #e5eaf2;
        border-radius: 22px;
        box-shadow: 0 8px 28px rgba(15,23,42,.05);
        overflow: hidden;
    }

    .edit-section {
        padding: 28px;
        border-bottom: 1px solid #e8edf5;
    }

    .edit-profile-header {
        background: linear-gradient(135deg, #4338ca 0%, #6366f1 100%);
    }

    /* Blue header styling to match Add Student and Student Profile */
    .edit-profile-header .section-heading h4 {
        color: #ffffff;
    }

    .edit-profile-header .section-heading p {
        color: rgba(255, 255, 255, 0.88) !important;
    }

    .edit-profile-header .section-icon {
        background: rgba(255, 255, 255, 0.16);
        color: #ffffff;
    }

    /* ================= SECTION HEADING ================= */
    .section-heading {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 28px;
    }

    .section-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #6366f1;
        font-size: 20px;
    }

    .section-heading h4 {
        color: #111827;
        font-size: 20px;
    }

    /* ================= STUDENT NUMBER ================= */
    .student-number-panel {
        padding: 16px 20px;
        background: #f8faff;
        border: 1px dashed #c7d2fe;
        border-radius: 16px;
        min-width: 230px;
    }

    .student-number-value {
        color: #4f46e5;
        margin-top: 5px;
    }

    /* ================= PHOTO ================= */
    .photo-upload-area {
        padding: 20px;
        border: 1px solid #e5eaf2;
        background: #f8fafc;
        border-radius: 18px;
    }

    .photo-preview-wrapper {
        width: 150px;
        height: 150px;
        border: 4px solid white;
        border-radius: 22px;
        overflow: hidden;
        background: #eef2ff;
        box-shadow: 0 4px 18px rgba(79,70,229,.12);
    }

    .photo-preview-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #6366f1;
    }

    .photo-placeholder i {
        font-size: 80px;
    }

    /* ================= INPUTS ================= */
    .edit-student-wrapper .form-label {
        font-weight: 600;
        font-size: 13px;
        color: #374151;
        margin-bottom: 8px;
    }

    .edit-student-wrapper .form-control,
    .edit-student-wrapper .form-select {
        min-height: 46px;
        border: 1px solid #dbe3ef;
        border-radius: 11px;
        padding: 10px 13px;
        font-size: 14px;
    }

    .edit-student-wrapper textarea.form-control {
        min-height: 110px;
    }

    .edit-student-wrapper .form-control:focus,
    .edit-student-wrapper .form-select:focus {
        border-color: #818cf8;
        box-shadow: 0 0 0 .2rem rgba(99,102,241,.10);
    }

    /* ================= BUTTONS ================= */
    .btn-indigo {
        background: #6366f1;
        color: #fff;
        border: 1px solid #6366f1;
    }

    .btn-indigo:hover {
        background: #4f46e5;
        color: #fff;
        border-color: #4f46e5;
    }

    /* ================= FOOTER ================= */
    .edit-form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 22px 28px;
        background: #f8fafc;
    }

    /* ================= RESPONSIVE ================= */
    @media(max-width:767px) {

        .edit-page-title {
            font-size: 1.5rem;
        }

        .edit-section {
            padding: 20px;
        }

        .edit-form-footer {
            padding: 18px 20px;
            flex-direction: column-reverse;
        }

        .edit-form-footer .btn {
            width: 100%;
        }

        .student-number-panel {
            width: 100%;
        }

        .photo-upload-area {
            padding: 16px;
        }

        .photo-preview-wrapper {
            width: 130px;
            height: 130px;
        }

    }
</style>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endpush

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= PHOTO PREVIEW =================
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const removePhotoBtn = document.getElementById('removePhotoBtn');
    const removePhotoInput = document.getElementById('remove_photo');
    const photoMessage = document.getElementById('photoMessage');

    let originalPhotoSrc = photoPreview.src;
    let hadOriginalPhoto = !photoPreview.classList.contains('d-none');

    photoInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/png'];

        if (!allowedTypes.includes(file.type)) {
            alert('Please select a JPG or PNG image.');
            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Image size must not exceed 2MB.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            photoPreview.src = e.target.result;
            photoPreview.classList.remove('d-none');

            photoPlaceholder.classList.add('d-none');

            removePhotoInput.value = '0';

            removePhotoBtn.disabled = false;

            photoMessage.textContent = 'New photo selected.';

        };

        reader.readAsDataURL(file);

    });

    // ================= REMOVE PHOTO =================
    removePhotoBtn.addEventListener('click', function () {

        photoInput.value = '';

        photoPreview.src = '';
        photoPreview.classList.add('d-none');

        photoPlaceholder.classList.remove('d-none');

        removePhotoInput.value = '1';

        removePhotoBtn.disabled = true;

        photoMessage.textContent = 'Photo will be removed when you save the student.';

    });

    // ================= AGE CALCULATION =================
    const birthDateInput = document.getElementById('birth_date');
    const ageInput = document.getElementById('age');

    function calculateAge() {

        const birthDateValue = birthDateInput.value;

        if (!birthDateValue) {
            ageInput.value = '';
            return;
        }

        const birthDate = new Date(birthDateValue);
        const today = new Date();

        let age = today.getFullYear() - birthDate.getFullYear();

        const monthDifference = today.getMonth() - birthDate.getMonth();

        if (
            monthDifference < 0 ||
            (monthDifference === 0 && today.getDate() < birthDate.getDate())
        ) {
            age--;
        }

        ageInput.value = age + ' years old';

    }

    birthDateInput.addEventListener('change', calculateAge);

    calculateAge();

    // ================= SUBMIT =================
    document.getElementById('editStudentForm').addEventListener('submit', function () {

        const saveButton = document.getElementById('saveStudentBtn');

        saveButton.disabled = true;
        saveButton.innerHTML = '<i class="bi bi-arrow-repeat me-1"></i> Updating...';

    });

});
</script>

@endpush
