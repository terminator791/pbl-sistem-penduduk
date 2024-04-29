<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Data Penduduk</title>
    <link rel="stylesheet" href="{{asset('public/dist/assets/compiled/css/login.css')}}">
    @include('includes.style')
</head>

<body>
<script src="{{ asset('dist/assets/static/js/initTheme.js') }}"></script>
<div class="container">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <img src="{{ asset('storage/logo_hitam_mepet.png') }}" class="auth-logo" alt="logo">
                <h1 class="auth-title">Silakan Login</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group position-relative has-icon-left mb-4 text-center">
                        <input type="text" class="form-control form-control-xl" name="NIK_penduduk"
                               placeholder="Nomor Induk Kependudukan (NIK)">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group position-relative has-icon-left mb-4 text-center">
                        <input type="password" class="form-control form-control-xl" name="password"
                               placeholder="Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                   name="remember">
                            <span
                                class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-2">
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <!-- <div id="auth-right">
                <img src="{{ asset('storage/logo_polines.jpg') }}" class="gambar-kanan" alt="logo">
            </div> -->
        </div>
    </div>
</div>
@include('includes.script')
</body>
</html>
