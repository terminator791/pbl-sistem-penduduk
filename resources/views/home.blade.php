@extends('layouts.default-ui')

@section('heading')
    @if (Auth::user()->level == 'admin')
        <h3 class="text-center">Selamat Datang {{ Auth::user()->level }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13</p>
    @elseif (Auth::user()->level == 'RW')
        <h3 class="text-center">Selamat Datang Ketua {{ Auth::user()->level }}, {{ $roles->nama }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13</p>
    @elseif(Auth::user()->level == 'RT')
        <h3 class="text-center">Selamat Datang Ketua {{ Auth::user()->level }}, {{ $roles->nama }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13 RT {{ $roles->id_rt }}</p>
    @endif
@endsection

@section('content')
    <style>
        /* Gradient Background */
        body {
            /* background: linear-gradient(to right, #3498db, #8a4baf); */
        }

        /* Font Popping */
        .card-title {
            font-size: 1.2rem; /* Sesuaikan ukuran font judul */
            transition: font-size 0.3s ease-in-out; /* Animasi ukuran font */
        }

        .card-title:hover {
            font-size: 1.3rem; /* Ukuran font saat hover */
        }

        .icon-box {
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            color: #fff;
            font-size: 36px;
            margin: 0 auto;
            transition: transform 0.3s ease-in-out;
        }

        .icon-box:hover {
            transform: scale(1.1);
        }

        .bg-purple { background-color: #8a4baf; }
        .bg-blue { background-color: #3498db; }
        .bg-green { background-color: #2ecc71; }
        .bg-red { background-color: #e74c3c; }

        .card {
            border-radius: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Additional Styling */
        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .card-columns {
            column-count: 2;
        }
    </style>

    <section class="row justify-content-center">
        <div class="col-lg-6 mb-4">
            <div class="card text-center shadow-lg">
                <div class="card-body">
                    <a href="{{ route('wargaAsli') }}" class="text-decoration-none">
                        <div class="icon-box bg-purple mb-4">
                            <i class="bi-people-fill"></i>
                        </div>
                        <h5 class="card-title text-muted mb-3">Data Warga</h5>
                    </a>
                    <p class="card-text">Temukan data mengenai warga di sini.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card text-center shadow-lg">
                <div class="card-body">
                    <a href="{{ route('kesehatan') }}" class="text-decoration-none">
                        <div class="icon-box bg-blue mb-4">
                            <i class="bi-journal-richtext"></i>
                        </div>
                        <h5 class="card-title text-muted mb-3">Data Umum</h5>
                    </a>
                    <p class="card-text">Lihat informasi umum terkini di sini.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card text-center shadow-lg">
                <div class="card-body">
                    <a href="{{ route('dataKos') }}" class="text-decoration-none">
                        <div class="icon-box bg-green mb-4">
                            <i class="bi-house-fill"></i>
                        </div>
                        <h5 class="card-title text-muted mb-3">Data Kos</h5>
                    </a>
                    <p class="card-text">Dapatkan informasi tentang data kos di sini.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card text-center shadow-lg">
                <div class="card-body">
                <a href="{{ route('profile') }}" class="text-decoration-none">
                    <div class="icon-box bg-red mb-4">
                        <i class="bi-person-fill"></i>
                    </div>
                    <h5 class="card-title text-muted mb-3">Profil</h5>
                    <p class="card-text">Lihat dan ubah profil Anda di sini.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
