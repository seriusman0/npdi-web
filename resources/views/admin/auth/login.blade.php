<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NPDI Back Office</title>

    <link rel="shortcut icon" href="{{ asset('assets/icon/favicon-32x32.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/extensions/bootstrap-icons/font/bootstrap-icons.css') }}">
</head>
<body>
    <script src="{{ asset('mazer/static/js/initTheme.js') }}"></script>

    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/logo/logo.png') }}" alt="NPDI Logo" style="height: 40px; width: auto;">
                        </a>
                    </div>

                    <h1 class="auth-title">Log in</h1>
                    <p class="auth-subtitle mb-5">Masuk ke panel admin NPDI.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.login.store') }}" method="POST">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="email"
                                name="email"
                                class="form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="Email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input
                                type="password"
                                name="password"
                                class="form-control form-control-xl"
                                placeholder="Password"
                                required
                                autocomplete="current-password"
                            >
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-check form-check-lg d-flex align-items-end mb-4">
                            <input
                                class="form-check-input me-2"
                                type="checkbox"
                                name="remember"
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label class="form-check-label text-gray-700" for="remember">Ingat saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3 w-100">
                            Log in
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('mazer/compiled/js/app.js') }}"></script>
</body>
</html>
