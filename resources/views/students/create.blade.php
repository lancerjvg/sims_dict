@extends('layouts.app')

@section('page-heading', 'Add New Student')

@section('content')

<div class="container-fluid px-3 px-md-4 pb-4">

    <!-- HEADER -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1 text-indigo">
                <i class="bi bi-person-plus-fill me-2"></i>Add New Student
            </h3>
            <p class="text-muted mb-0">Register a new student in the system.</p>
        </div>

        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Students
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <div class="card-header text-white p-4 border-0"
             style="background:linear-gradient(135deg,#4338ca,#6366f1);">
            <h5 class="fw-bold mb-1">
                <i class="bi bi-person-vcard me-2"></i>Student Information
            </h5>
            <small>Complete the student information below.</small>
        </div>

        <div class="card-body p-3 p-md-4">

            <!-- ERRORS -->
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <strong><i class="bi bi-exclamation-triangle me-1"></i>Please check the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="studentCreateForm">

                @csrf

                <!-- ================= PHOTO UPLOAD ================= -->
                <div class="photo-card mb-4 p-3 p-md-4">
                    <div class="row align-items-center g-3">

                        <div class="col-md-auto text-center">
                            <div class="photo-circle mx-auto">

                                <img id="photoPreview"
                                     src=""
                                     alt="Student photo"
                                     style="display:none;">

                                <div id="photoPlaceholder">
                                    <i class="bi bi-person-fill"></i>
                                    <span>PROFILE PHOTO</span>
                                </div>

                            </div>
                        </div>

                        <div class="col text-center text-md-start">

                            <h5 class="fw-bold mb-1">Student Profile Photo</h5>

                            <p class="text-muted small mb-3">
                                Upload a profile picture for this student.
                                <br>JPG or PNG format • Maximum 2MB
                            </p>

                            <!-- FILE INPUT -->
                            <input type="file"
                                   name="photo"
                                   id="photo"
                                   accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                                   class="d-none">

                            <button type="button"
                                    id="choosePhotoBtn"
                                    class="btn btn-indigo rounded-3 px-4">
                                <i class="bi bi-camera-fill me-1"></i>
                                Choose Photo
                            </button>

                            <button type="button"
                                    id="removePhotoBtn"
                                    class="btn btn-outline-danger rounded-3 ms-1"
                                    style="display:none;">
                                <i class="bi bi-trash me-1"></i> Remove
                            </button>

                            <div id="photoMessage" class="small mt-2"></div>

                        </div>
                    </div>
                </div>

                <hr class="mb-4">

                <!-- STUDENT NUMBER -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Student Number</label>
                    <div class="form-control bg-light rounded-3 text-muted">
                        <i class="bi bi-magic me-1"></i>
                        Auto-generated upon saving
                    </div>
                    <small class="text-muted">Format: YYYY-0001</small>
                </div>

                <!-- NAME -->
                <div class="row g-3 mb-3">

                    <div class="col-md-4">
                        <label for="first_name" class="form-label fw-semibold">
                            First Name <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="first_name"
                               id="first_name"
                               class="form-control rounded-3 @error('first_name') is-invalid @enderror"
                               value="{{ old('first_name') }}"
                               placeholder="First name"
                               required>
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="middle_name" class="form-label fw-semibold">Middle Name</label>
                        <input type="text"
                               name="middle_name"
                               id="middle_name"
                               class="form-control rounded-3"
                               value="{{ old('middle_name') }}"
                               placeholder="Middle name">
                    </div>

                    <div class="col-md-4">
                        <label for="last_name" class="form-label fw-semibold">
                            Last Name <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="last_name"
                               id="last_name"
                               class="form-control rounded-3 @error('last_name') is-invalid @enderror"
                               value="{{ old('last_name') }}"
                               placeholder="Last name"
                               required>
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- PERSONAL INFORMATION -->
                <div class="row g-3 mb-3">

                    <div class="col-md-4">
                        <label for="gender" class="form-label fw-semibold">Gender</label>
                        <select name="gender" id="gender" class="form-select rounded-3">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="birth_date" class="form-label fw-semibold">Birth Date</label>
                        <input type="date"
                               name="birth_date"
                               id="birth_date"
                               class="form-control rounded-3"
                               value="{{ old('birth_date') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="age" class="form-label fw-semibold">Age</label>
                        <input type="text"
                               id="age"
                               class="form-control rounded-3 bg-light"
                               readonly
                               placeholder="Auto calculated">
                    </div>

                </div>

                <!-- CONTACT -->
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control rounded-3 @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="student@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="contact_number" class="form-label fw-semibold">Contact Number</label>
                        <input type="text"
                               name="contact_number"
                               id="contact_number"
                               class="form-control rounded-3"
                               value="{{ old('contact_number') }}"
                               placeholder="09XXXXXXXXX">
                    </div>

                </div>

                <!-- ADDRESS -->
                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Address</label>
                    <textarea name="address"
                              id="address"
                              rows="3"
                              class="form-control rounded-3"
                              placeholder="Complete address">{{ old('address') }}</textarea>
                </div>

                <!-- COURSE / YEAR -->
                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label for="course" class="form-label fw-semibold">
                            Course <span class="text-danger">*</span>
                        </label>
                        <select name="course"
                                id="course"
                                class="form-select rounded-3 @error('course') is-invalid @enderror"
                                required>
                            <option value="">-- Select Course --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->course_name }}"
                                    {{ old('course') == $course->course_name ? 'selected' : '' }}>
                                    {{ $course->course_code }} - {{ $course->course_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="year_level" class="form-label fw-semibold">
                            Year Level <span class="text-danger">*</span>
                        </label>
                        <select name="year_level"
                                id="year_level"
                                class="form-select rounded-3"
                                required>
                            <option value="">Select Year Level</option>

                            @foreach(range(1, 6) as $year)
                                <option value="{{ $year }}"
                                    {{ old('year_level') == $year ? 'selected' : '' }}>
                                    {{ $year }}{{ $year == 1 ? 'st' : ($year == 2 ? 'nd' : ($year == 3 ? 'rd' : 'th')) }} Year
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="border-top pt-3 d-flex justify-content-end flex-wrap gap-2">

                    <a href="{{ route('students.index') }}"
                       class="btn btn-light border rounded-3 px-4">
                        Cancel
                    </a>

                    <button type="reset"
                            id="resetFormBtn"
                            class="btn btn-outline-secondary rounded-3 px-4">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>

                    <button type="submit"
                            id="saveStudentBtn"
                            class="btn btn-indigo rounded-3 px-4">
                        <i class="bi bi-check-circle-fill me-1"></i> Save Student
                    </button>

                </div>

            </form>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
    .text-indigo {
        color: #4338ca;
    }

    .btn-indigo {
        background: #4f46e5;
        color: white;
        border: 1px solid #4f46e5;
    }

    .btn-indigo:hover {
        background: #4338ca;
        color: white;
    }

    .photo-card {
        background: linear-gradient(135deg, #eef2ff, #f8faff);
        border: 1px solid #e0e7ff;
        border-radius: 18px;
    }

    .photo-circle {
        width: 155px;
        height: 155px;
        border-radius: 50%;
        overflow: hidden;
        background: #e0e7ff;
        border: 5px solid white;
        box-shadow: 0 4px 15px rgba(79,70,229,.18);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .photo-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #photoPlaceholder {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: #6366f1;
    }

    #photoPlaceholder i {
        font-size: 70px;
        line-height: 1;
    }

    #photoPlaceholder span {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        margin-top: 5px;
    }

    #studentCreateForm .form-control,
    #studentCreateForm .form-select {
        min-height: 44px;
        border-color: #dbe1ea;
    }

    #studentCreateForm .form-control:focus,
    #studentCreateForm .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 .2rem rgba(99,102,241,.12);
    }

    @media(max-width:767px) {
        .photo-card {
            padding: 18px !important;
        }
    }
</style>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= PHOTO UPLOAD =================

    const photoInput       = document.getElementById('photo');
    const photoPreview     = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const choosePhotoBtn  = document.getElementById('choosePhotoBtn');
    const removePhotoBtn  = document.getElementById('removePhotoBtn');
    const photoMessage    = document.getElementById('photoMessage');

    choosePhotoBtn.addEventListener('click', function () {
        photoInput.click();
    });

    photoInput.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        // Max 2MB
        if (file.size > 2 * 1024 * 1024) {
            alert('Photo must not exceed 2MB.');
            this.value = '';
            resetPhoto();
            return;
        }

        // JPG / PNG only
        if (!['image/jpeg', 'image/png'].includes(file.type)) {
            alert('Please upload JPG or PNG image only.');
            this.value = '';
            resetPhoto();
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            photoPreview.src = e.target.result;
            photoPreview.style.display = 'block';

            photoPlaceholder.style.display = 'none';
            removePhotoBtn.style.display = 'inline-block';

            photoMessage.innerHTML =
                '<span class="text-success">' +
                '<i class="bi bi-check-circle-fill me-1"></i>' +
                'Photo ready for upload' +
                '</span>';
        };

        reader.readAsDataURL(file);
    });

    // REMOVE PHOTO
    removePhotoBtn.addEventListener('click', function () {
        photoInput.value = '';
        resetPhoto();
    });

    function resetPhoto() {
        photoPreview.src = '';
        photoPreview.style.display = 'none';

        photoPlaceholder.style.display = 'flex';
        removePhotoBtn.style.display = 'none';

        photoMessage.innerHTML = '';
    }

    // ================= AUTO AGE =================

    const birthDate = document.getElementById('birth_date');
    const ageField  = document.getElementById('age');

    function calculateAge() {

        if (!birthDate.value) {
            ageField.value = '';
            return;
        }

        const dob = new Date(birthDate.value + 'T00:00:00');
        const today = new Date();

        let age = today.getFullYear() - dob.getFullYear();

        const monthDiff = today.getMonth() - dob.getMonth();

        if (monthDiff < 0 ||
            (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        ageField.value = age >= 0 ? age + ' years old' : '';
    }

    birthDate.addEventListener('change', calculateAge);
    calculateAge();

    // ================= RESET =================

    document.getElementById('resetFormBtn').addEventListener('click', function () {
        setTimeout(function () {
            resetPhoto();
            calculateAge();
        }, 50);
    });

    // ================= SUBMIT =================

    document.getElementById('studentCreateForm').addEventListener('submit', function () {

        const btn = document.getElementById('saveStudentBtn');

        btn.disabled = true;

        btn.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2"></span>' +
            'Saving Student...';
    });

});
</script>
@endpush
