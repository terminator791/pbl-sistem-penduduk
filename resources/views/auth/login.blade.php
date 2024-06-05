<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Data Penduduk</title>
    <link rel="stylesheet" href="{{ asset('public/dist/assets/compiled/css/login.css') }}">
    @include('includes.style')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* background: url('{{ asset("storage/background.jpg") }}') no-repeat center center fixed; */
            background-size: cover;
            color: #333;
            
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            outline-color: blue 9px;
            /* outline-style: outset 5px #007bff;
            outline-style: 500px #007bff ; */

            
        }
        #auth-left {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .auth-logo {
            width: 250px;
            margin-bottom: 20px;
        }
        .auth-title {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-control {
            height: 60px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 20px rgba(0, 123, 255, 0.25);
        }
        .form-control-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 18px;
            color: #6c757d;
        }
        .form-group.position-relative {
            position: relative;
        }
        .btn {
            width: 100%;
            height: 45px;
            border-radius: 8px;
            font-size: 16px;
        }
        .block {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<script src="{{ asset('dist/assets/static/js/initTheme.js') }}"></script>
<div class="container">
    <div class="col-lg-5 d-none d-lg-block">
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

                <!-- Role Selection -->
                <div class="form-group position-relative mb-4 text-center">
                    <select class="form-control form-control-xl" name="level">
                        <option value="admin" selected>Admin</option>
                        <option value="RW">RW</option>
                        <option value="RT">RT</option>
                        <option value="pemilik_kos">Pemilik Kos</option>
                    </select>
                </div>

                <!-- Remember Me -->
                <!-- <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                               name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
                    </label>
                </div> -->

                <div class="flex items-center justify-end mt-2">
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('includes.script')
</body>

</html>

@if(session('warning'))
<script>
    Toastify({
        text: "{{ session('warning') }}",
        duration: 6000,
        position: 'center',
        backgroundColor: 'red'
    }).showToast();
</script>
@endif

@if ($errors->has('NIK_penduduk'))
<script>
    Toastify({
        text: "{{ $errors->first('NIK_penduduk') }}",
        duration: 6000,
        position: 'center',
        backgroundColor: 'red'
    }).showToast();
</script>
@endif
