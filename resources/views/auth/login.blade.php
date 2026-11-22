
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lancer Technology Institute | SIMS</title>

    <!-- BROWSER FAVICON -->
    <link rel="icon" type="image/png" href="{{ asset('images/lancer-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/lancer-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/lancer-logo.png') }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100vh;
            min-height: 100vh;
            padding: 10px;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(120deg, #4840d1, #5b55e8, #7655ef);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* MAIN CONTAINER */
        .login-wrapper {
            width: 100%;
            height: calc(100vh - 20px);
            max-width: 1600px;
            max-height: 950px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(25, 15, 90, 0.25);
        }

        /* LEFT BRAND PANEL */
        .brand-panel {
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, #4840d1, #6756eb, #8739e9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 30px;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            top: -180px;
            right: -180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }

        .brand-panel::after {
            content: "";
            position: absolute;
            width: 380px;
            height: 380px;
            bottom: -230px;
            left: -170px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .brand-content {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 2;
            text-align: center;
        }

        /* LOGO */
        .brand-logo {
            width: 210px;
            height: 210px;
            display: block;
            margin: 0 auto 14px;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 8px 15px rgba(0,0,0,0.12));
        }

        /* SCHOOL INFORMATION */
        .school-name {
            margin: 8px 0 10px;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: 1px;
            line-height: 1.4;
        }

        .school-tagline {
            font-size: 11px;
            font-weight: 600;
            line-height: 1.7;
            color: #e9e7ff;
            margin-bottom: 10px;
        }

        .school-description {
            max-width: 460px;
            margin: 0 auto 12px;
            font-size: 10px;
            line-height: 1.75;
            color: rgba(255,255,255,0.86);
        }

        .school-motto {
            font-size: 11px;
            font-weight: 700;
            font-style: italic;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .school-year {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 3px;
            color: #ddd6fe;
        }

        /* SIMS TITLE */
        .sims-section {
            margin-top: 17px;
            padding-top: 14px;
            border-top: 1px solid rgba(255,255,255,0.20);
        }

        .welcome-label {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 3px;
            color: #dcd8ff;
            margin-bottom: 10px;
        }

        .sims-title {
            font-size: clamp(27px, 2.8vw, 39px);
            font-weight: 800;
            line-height: 1.10;
            letter-spacing: -1px;
            margin-bottom: 12px;
        }

        /* TITLE COLORS */
        .title-green {
            color: #39e879;
        }

        .title-white {
            color: #ffffff;
        }

        .title-red {
            color: #ff4b5e;
        }

        .sims-description {
            max-width: 460px;
            margin: 0 auto 14px;
            font-size: 10px;
            line-height: 1.7;
            color: rgba(255,255,255,0.88);
        }

        /* FEATURES */
        .feature-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px;
            margin-bottom: 15px;
        }

        .feature-item {
            padding: 7px 10px;
            border-radius: 30px;
            border: 1px solid rgba(255,255,255,0.25);
            background: rgba(255,255,255,0.10);
            color: white;
            font-size: 9px;
            font-weight: 600;
        }

        .brand-footer {
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.60);
        }

        /* RIGHT LOGIN PANEL */
        .login-panel {
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 50px;
        }

        .login-content {
            width: 100%;
            max-width: 400px;
        }

        .login-greeting {
            font-size: 10px;
            font-weight: 800;
            color: #6366f1;
            margin-bottom: 8px;
        }

        .login-title {
            font-size: 28px;
            font-weight: 800;
            color: #1e1b4b;
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-size: 11px;
            color: #94a3b8;
            margin-bottom: 28px;
        }

        /* STATUS AND ERRORS */
        .status-alert {
            padding: 12px 14px;
            border-radius: 9px;
            background: #eef2ff;
            border: 1px solid #c7d2fe;
            color: #4338ca;
            font-size: 11px;
            margin-bottom: 18px;
        }

        .error-alert {
            padding: 12px 14px;
            border-radius: 9px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            font-size: 11px;
            margin-bottom: 18px;
        }

        .error-alert ul {
            padding-left: 18px;
            margin-top: 5px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 17px;
        }

        .form-label {
            display: block;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            height: 43px;
            padding: 0 13px;
            border: 1px solid #dbe3ef;
            border-radius: 9px;
            background: #f8fafc;
            color: #1e293b;
            font-family: inherit;
            font-size: 11px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control::placeholder {
            color: #b8c7dc;
        }

        .form-control:focus {
            border-color: #6366f1;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.10);
        }

        /* REMEMBER / FORGOT */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin: 2px 0 21px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 10px;
            color: #64748b;
            cursor: pointer;
        }

        .remember-label input {
            accent-color: #6366f1;
        }

        .forgot-link {
            color: #6366f1;
            text-decoration: none;
            font-size: 10px;
            font-weight: 600;
        }

        .forgot-link:hover {
            color: #4338ca;
        }

        /* LOGIN BUTTON */
        .login-button {
            width: 100%;
            height: 46px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            color: white;
            font-family: inherit;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(99,102,241,0.22);
            transition: all 0.25s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(99,102,241,0.30);
        }

        .login-footer {
            margin-top: 24px;
            text-align: center;
            color: #94a3b8;
            font-size: 9px;
        }

        .login-footer strong {
            color: #6366f1;
        }

        /* SHORT DESKTOP SCREENS */
        @media (min-width: 761px) and (max-height: 850px) {

            .brand-panel {
                padding: 10px 25px;
            }

            .brand-logo {
                width: 175px;
                height: 175px;
                margin-bottom: 10px;
            }

            .school-name {
                font-size: 17px;
                margin: 5px 0 7px;
            }

            .school-tagline {
                font-size: 10px;
                margin-bottom: 7px;
            }

            .school-description {
                font-size: 9px;
                line-height: 1.55;
                margin-bottom: 8px;
            }

            .school-motto {
                font-size: 10px;
                margin-bottom: 5px;
            }

            .school-year {
                font-size: 8px;
            }

            .sims-section {
                margin-top: 12px;
                padding-top: 10px;
            }

            .welcome-label {
                margin-bottom: 7px;
            }

            .sims-title {
                font-size: 31px;
                margin-bottom: 8px;
                line-height: 1.12;
            }

            .sims-description {
                font-size: 9px;
                line-height: 1.55;
                margin-bottom: 9px;
            }

            .feature-list {
                margin-bottom: 9px;
                gap: 5px;
            }

            .feature-item {
                padding: 6px 8px;
                font-size: 8px;
            }

            .brand-footer {
                font-size: 8px;
            }

            .login-panel {
                padding: 20px 35px;
            }

            .login-title {
                font-size: 25px;
            }

            .login-subtitle {
                margin-bottom: 22px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-control {
                height: 41px;
            }

            .form-options {
                margin-bottom: 18px;
            }

            .login-button {
                height: 44px;
            }

            .login-footer {
                margin-top: 20px;
            }
        }

        /* TABLET AND MOBILE */
        @media (max-width: 760px) {

            body {
                height: auto;
                min-height: 100vh;
                padding: 12px;
                overflow-y: auto;
                display: block;
            }

            .login-wrapper {
                height: auto;
                min-height: auto;
                max-height: none;
                grid-template-columns: 1fr;
                border-radius: 17px;
            }

            .brand-panel {
                padding: 28px 20px;
            }

            .brand-content {
                max-width: 500px;
            }

            .brand-logo {
                width: 180px;
                height: 180px;
                margin-bottom: 15px;
            }

            .school-name {
                font-size: 17px;
            }

            .school-tagline {
                font-size: 11px;
            }

            .school-description {
                font-size: 10px;
            }

            .sims-section {
                margin-top: 20px;
                padding-top: 15px;
            }

            .sims-title {
                font-size: 34px;
            }

            .login-panel {
                padding: 30px 22px;
            }

            .login-title {
                font-size: 26px;
            }
        }

        /* SMALL MOBILE */
        @media (max-width: 380px) {

            .brand-panel {
                padding: 24px 15px;
            }

            .brand-logo {
                width: 145px;
                height: 145px;
            }

            .school-name {
                font-size: 15px;
            }

            .sims-title {
                font-size: 29px;
            }

            .login-panel {
                padding: 25px 18px;
            }
        }

    </style>
</head>

<body>

    <main class="login-wrapper">

        <!-- LEFT PANEL -->
        <section class="brand-panel">

            <div class="brand-content">

                <!-- LANCER LOGO -->
                <div class="brand-logo">
                    <img
                        src="{{ asset('images/lancer-logo.png') }}"
                        alt="Lancer Technology Institute Logo"
                    >
                </div>

                <!-- SCHOOL INFORMATION -->
                <h2 class="school-name">
                    LANCER TECHNOLOGY INSTITUTE
                </h2>

                <p class="school-tagline">
                    Empowering learners through technology, innovation, and education.
                </p>

                <p class="school-description">
                    We are committed to developing skilled, responsible, and future-ready
                    individuals through modern learning, digital technology, and
                    continuous improvement.
                </p>

                <p class="school-motto">
                    Learn. Innovate. Excel.
                </p>

                <p class="school-year">
                    ESTABLISHED - 2026
                </p>

                <!-- SIMS INFORMATION -->
                <div class="sims-section">

                    <div class="welcome-label">
                        WELCOME TO
                    </div>

                    <h1 class="sims-title">
                        <span class="title-green">Student Information</span><br>
                        <span class="title-white">Management</span><br>
                        <span class="title-red">System</span>
                    </h1>

                    <p class="sims-description">
                        A smarter and more organized way to manage students,
                        courses, subjects, enrollment, and academic records.
                    </p>

                    <!-- FEATURES -->
                    <div class="feature-list">
                        <span class="feature-item">Student Management</span>
                        <span class="feature-item">Course Management</span>
                        <span class="feature-item">Enrollment</span>
                    </div>

                    <div class="brand-footer">
                        LANCER TECHNOLOGY INSTITUTE • SIMS
                    </div>

                </div>

            </div>

        </section>

        <!-- RIGHT LOGIN PANEL -->
        <section class="login-panel">

            <div class="login-content">

                <div class="login-greeting">
                    HELLO THERE!
                </div>

                <h1 class="login-title">
                    Welcome Back
                </h1>

                <p class="login-subtitle">
                    Sign in to access your SIMS account.
                </p>

                <!-- SESSION STATUS -->
                @if (session('status'))
                    <div class="status-alert">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- VALIDATION ERRORS -->
                @if ($errors->any())
                    <div class="error-alert">
                        <strong>Login failed.</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- LOGIN FORM -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            EMAIL ADDRESS
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            required
                            autofocus
                            autocomplete="username"
                        >
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            PASSWORD
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                    </div>

                    <!-- REMEMBER ME / FORGOT PASSWORD -->
                    <div class="form-options">

                        <label class="remember-label" for="remember_me">
                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                            >
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                class="forgot-link"
                            >
                                Forgot Password?
                            </a>
                        @endif

                    </div>

                    <!-- SIGN IN BUTTON -->
                    <button type="submit" class="login-button">
                        SIGN IN TO SIMS
                    </button>

                </form>

                <!-- FOOTER -->
                <div class="login-footer">
                    Powered by
                    <strong>Lancer Technology Institute SIMS</strong>
                </div>

            </div>

        </section>

    </main>

</body>
</html>
