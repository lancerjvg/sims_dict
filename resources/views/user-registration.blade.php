@extends('layouts.app')

@section('title', 'User Registration')
@section('page-heading', 'User Registration')

@section('content')

<style>
        :root {
            --bg: #0b1120;
            --card: #111827;
            --card-light: #172033;
            --border: #263247;
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --text: #e2e8f0;
            --muted: #94a3b8;
            --success: #22c55e;
            --danger: #f87171;
        }

        * {
            box-sizing: border-box;
        }
        /* PAGE */
        .registration-wrapper {
            width: 100%;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 20px;
        }

        /* CARD */
        .registration-card {
            width: 100%;
            max-width: 760px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0,0,0,.40);
        }

        /* HEADER */
        .registration-header {
            padding: 30px 35px;
            background: linear-gradient(135deg, #172554, #111827);
            border-bottom: 1px solid var(--border);
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .header-icon {
            width: 58px;
            height: 58px;
            min-width: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background: linear-gradient(135deg, #818cf8, #4f46e5);
            color: white;
            font-size: 25px;
            box-shadow: 0 8px 25px rgba(79,70,229,.30);
        }

        .header-title h2 {
            margin: 0;
            font-size: 25px;
            font-weight: 700;
            color: #f8fafc;
        }

        .header-title p {
            margin: 6px 0 0;
            font-size: 13px;
            color: var(--muted);
        }

        /* BODY */
        .registration-body {
            padding: 35px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #a5b4fc;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            margin-bottom: 22px;
        }

        .section-title i {
            font-size: 16px;
        }

        /* FORM */
        .form-label {
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            min-height: 48px;
            background: #0b1120;
            border: 1px solid #334155;
            color: #f1f5f9;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            transition: .2s ease;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .form-control:focus {
            background: #0b1120;
            color: #f8fafc;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99,102,241,.15);
        }

        .form-control.is-invalid {
            border-color: var(--danger);
        }

        /* PASSWORD */
        .password-group {
            position: relative;
        }

        .password-group .form-control {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            font-size: 17px;
            z-index: 5;
        }

        .password-toggle:hover {
            color: #a5b4fc;
        }

        /* ERROR */
        .invalid-feedback {
            display: block;
            color: #f87171;
            font-size: 12px;
            margin-top: 6px;
        }

        /* ALERT */
        .success-alert {
            background: rgba(34,197,94,.10);
            border: 1px solid rgba(34,197,94,.25);
            color: #86efac;
            border-radius: 12px;
            padding: 15px 17px;
        }

        .error-alert {
            background: rgba(248,113,113,.08);
            border: 1px solid rgba(248,113,113,.20);
            color: #fca5a5;
            border-radius: 12px;
            padding: 15px 17px;
        }

        /* PASSWORD INFO */
        .password-info {
            margin-top: 10px;
            color: #64748b;
            font-size: 12px;
        }

        /* BUTTONS */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 12px;
        }

        .btn-clear {
            min-height: 46px;
            padding: 11px 20px;
            background: #1e293b;
            border: 1px solid #334155;
            color: #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .btn-clear:hover {
            background: #334155;
            color: #ffffff;
        }

        .btn-register {
            min-height: 46px;
            padding: 11px 22px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border: none;
            color: #ffffff;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
            box-shadow: 0 5px 15px rgba(79,70,229,.20);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-register:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        /* FOOTER */
        .registration-footer {
            padding: 20px 35px;
            border-top: 1px solid var(--border);
            color: #64748b;
            font-size: 12px;
            text-align: center;
            background: rgba(255,255,255,.01);
        }

        /* RESPONSIVE */
        @media (max-width: 576px) {
            .registration-wrapper {
                padding: 15px;
            }

            .registration-header {
                padding: 23px;
            }

            .registration-body {
                padding: 23px;
            }

            .registration-footer {
                padding: 18px;
            }

            .header-icon {
                width: 48px;
                height: 48px;
                min-width: 48px;
                font-size: 21px;
                border-radius: 14px;
            }

            .header-title h2 {
                font-size: 21px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions button {
                width: 100%;
            }
        }
    </style>


<div class="registration-wrapper">

    <div class="registration-card">

        <!-- HEADER -->
        <div class="registration-header">
            <div class="header-content">

                <div class="header-icon">
                    <i class="bi bi-person-plus-fill"></i>
                </div>

                <div class="header-title">
                    <h2>User Registration</h2>
                    <p>Create a new SIMS Academic Portal account</p>
                </div>

            </div>
        </div>

        <!-- FORM BODY -->
        <div class="registration-body">

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="success-alert mb-4">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- GENERAL ERRORS -->
            @if($errors->any())
                <div class="error-alert mb-4">
                    <div class="fw-bold mb-2">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Please correct the following:
                    </div>

                    <ul class="mb-0 ps-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('user-registration.store') }}"
                  id="registrationForm">

                @csrf

                <!-- ACCOUNT INFORMATION -->
                <div class="section-title">
                    <i class="bi bi-person-circle"></i>
                    Account Information
                </div>

                <div class="row g-3 mb-4">

                    <!-- FULL NAME -->
                    <div class="col-12">
                        <label for="name" class="form-label">
                            Full Name
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter full name"
                               value="{{ old('name') }}"
                               autocomplete="name"
                               required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="col-12">
                        <label for="email" class="form-label">
                            Email Address
                        </label>

                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Enter email address"
                               value="{{ old('email') }}"
                               autocomplete="email"
                               required>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- SECURITY -->
                <div class="section-title">
                    <i class="bi bi-shield-lock"></i>
                    Security Information
                </div>

                <div class="row g-3 mb-4">

                    <!-- PASSWORD -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <div class="password-group">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Create password"
                                   autocomplete="new-password"
                                   required>

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password', 'passwordIcon')"
                                    aria-label="Toggle password visibility">
                                <i class="bi bi-eye" id="passwordIcon"></i>
                            </button>
                        </div>

                        <div class="password-info">
                            <i class="bi bi-info-circle me-1"></i>
                            Minimum of 8 characters.
                        </div>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password
                        </label>

                        <div class="password-group">
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Confirm password"
                                   autocomplete="new-password"
                                   required>

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')"
                                    aria-label="Toggle confirm password visibility">
                                <i class="bi bi-eye" id="confirmPasswordIcon"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="form-actions">

                    <button type="reset" class="btn btn-clear">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Clear Form
                    </button>

                    <button type="submit" class="btn btn-register" id="registerButton">
                        <i class="bi bi-person-plus-fill me-2"></i>
                        Register User
                    </button>

                </div>

            </form>

        </div>

        <!-- FOOTER -->
        <div class="registration-footer">
            <i class="bi bi-mortarboard-fill me-1"></i>
            SIMS Academic Portal
            <span class="mx-2">|</span>
            User Account Registration
        </div>

    </div>

</div>

<!-- PASSWORD TOGGLE -->
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }

    // Prevent accidental double submission
    document.getElementById("registrationForm").addEventListener("submit", function () {
        const button = document.getElementById("registerButton");

        button.disabled = true;
        button.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Processing...';
    });
</script>

@endsection
