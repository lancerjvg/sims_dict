@extends('layouts.app')

@section('title', 'Edit User')
@section('page-heading', 'Edit User Account')

@section('content')



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User | SIMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .container-custom {
            max-width: 850px;
            margin: 50px auto;
            padding: 20px;
        }

        .edit-card {
            background: #111827;
            border: 1px solid #263247;
            border-radius: 18px;
            overflow: hidden;
        }

        .header {
            padding: 28px;
            background: linear-gradient(135deg, #172554, #111827);
            border-bottom: 1px solid #263247;
        }

        .header-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: linear-gradient(135deg, #818cf8, #4f46e5);
            color: white;
            font-size: 22px;
        }

        .body-custom {
            padding: 30px;
        }

        .section-label {
            color: #a5b4fc;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .form-label {
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            background: #0b1120 !important;
            border: 1px solid #334155 !important;
            color: #f1f5f9 !important;
            border-radius: 10px !important;
            min-height: 48px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99,102,241,.12) !important;
        }

        .form-select option {
            background: #111827;
            color: white;
        }

        .role-info,
        .password-info {
            padding: 15px;
            background: #0b1120;
            border: 1px solid #263247;
            border-radius: 10px;
            color: #94a3b8;
            font-size: 12px;
        }

        /* PASSWORD INPUT */
        .password-group {
            position: relative;
        }

        .password-group .form-control {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 13px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 17px;
            z-index: 5;
        }

        .password-toggle:hover {
            color: #a5b4fc;
        }

        .password-info {
            border-color: rgba(99,102,241,.25);
        }

        .btn-save {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border: none;
            color: white;
            border-radius: 10px;
            padding: 11px 20px;
            font-weight: 600;
        }

        .btn-save:hover {
            color: white;
            background: #4338ca;
        }

        .btn-back {
            background: #1e293b;
            border: 1px solid #334155;
            color: #cbd5e1;
            border-radius: 10px;
            padding: 11px 20px;
            text-decoration: none;
        }

        .btn-back:hover {
            color: white;
            background: #334155;
        }

        @media(max-width:576px) {
            .container-custom {
                margin: 20px auto;
                padding: 12px;
            }

            .body-custom {
                padding: 20px;
            }

            .buttons {
                flex-direction: column-reverse;
            }

            .buttons .btn,
            .buttons a {
                width: 100%;
                text-align: center;
            }
        }
    </style>


<div class="container-custom">

    <div class="edit-card">

        <!-- HEADER -->
        <div class="header">
            <div class="d-flex align-items-center gap-3">
                <div class="header-icon">
                    <i class="bi bi-person-gear"></i>
                </div>

                <div>
                    <h3 class="text-white fw-bold mb-1">Edit User Account</h3>
                    <div class="text-secondary small">
                        Update user information and role assignment
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM BODY -->
        <div class="body-custom">

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please correct the following:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('user-management.update', $user->id) }}">

                @csrf
                @method('PUT')

                <!-- USER INFORMATION -->
                <div class="section-label">
                    <i class="bi bi-person-circle me-2"></i>
                    User Information
                </div>

                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name</label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $user->name) }}"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>

                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $user->email) }}"
                               required>
                    </div>

                </div>

                <!-- PASSWORD SETTINGS -->
                <div class="section-label">
                    <i class="bi bi-key-fill me-2"></i>
                    Password Settings
                </div>

                <div class="row g-3 mb-3">

                    <!-- NEW PASSWORD -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">
                            New Password
                        </label>

                        <div class="password-group">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control"
                                   autocomplete="new-password"
                                   placeholder="Enter new password">

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password', this)"
                                    title="Show/Hide Password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">
                            Confirm New Password
                        </label>

                        <div class="password-group">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   autocomplete="new-password"
                                   placeholder="Confirm new password">

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password_confirmation', this)"
                                    title="Show/Hide Password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- PASSWORD INFORMATION -->
                <div class="password-info mb-4">
                    <i class="bi bi-info-circle me-2 text-primary"></i>
                    Leave both password fields blank if you don't want to change
                    the user's current password. A new password must be at least
                    8 characters and must match the confirmation field.
                </div>

                <!-- ROLE ASSIGNMENT -->
                <div class="section-label">
                    <i class="bi bi-shield-lock me-2"></i>
                    Role Assignment
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">User Role</label>

                    <select id="role" name="role" class="form-select" required>

                        @foreach($roles as $role)
                            <option value="{{ $role }}"
                                {{ old('role', $user->role ?? 'Staff') == $role ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="role-info mb-4">
                    <i class="bi bi-info-circle me-2 text-primary"></i>
                    The assigned role determines the user's designation within
                    the SIMS Academic Portal. Role-based access permissions
                    will be implemented in the authorization phase.
                </div>

                <!-- BUTTONS -->
                <div class="buttons d-flex justify-content-end gap-2">

                    <a href="{{ route('user-management.index') }}"
                       class="btn-back">
                        <i class="bi bi-arrow-left me-1"></i>
                        Cancel
                    </a>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-save me-2"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- PASSWORD VISIBILITY TOGGLE -->
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>

@endsection
