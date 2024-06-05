@extends('layouts.default-ui')

@section('heading')
    <div id="user-info" style="position: absolute; top: 20px; right: 20px; display: flex; align-items: center; background-color: #435ebe; padding: 5px 15px; border-radius: 10px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
        <i class="fas fa-user" style="font-size: 18px; color: white; margin-right: 5px;"></i>
        <p style="margin: 0; font-size: 14px; color: white; margin-left: 5px;">{{ Auth::user()->level }}, {{ Auth::user()->username }}</p>
    </div>
    @if (Auth::user()->level == 'admin')
        <h3 class="text-center">Selamat Datang {{ Auth::user()->level }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13</p>
    @elseif (Auth::user()->level == 'RW')
        <h3 class="text-center">Selamat Datang Ketua {{ Auth::user()->level }}, {{ $nama_pengguna }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13</p>
    @elseif(Auth::user()->level == 'RT')
        <h3 class="text-center">Selamat Datang Ketua {{ Auth::user()->level }}, {{ $nama_pengguna }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13 RT {{ $roles->id_rt }}</p>
    @elseif(Auth::user()->level == 'pemilik_kos')
    &nbsp;&nbsp;&nbsp;
        <h3 class="text-center">Selamat Datang , {{ $nama_pengguna }} di Dasbor Pemilik Kos Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13</p>
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
        #scrollToBottomBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .fade-out {
        animation: fadeOut 0.5s forwards;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

    /* Carousel styling */
    .carousel-container {
            margin-top: -20px;
        }

        .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-item .item-container {
            display: inline-block;
            text-align: center;
            margin: 0 10px;
        }

        .carousel-item img {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 5px;
        }

        .carousel-caption-custom {
            font-size: 0.875rem;
            margin: 0;
        }

        /* Username Styling */
        #username {
            text-align: right;
            margin-top: 10px;
        }

        .carousel-item .item-container p {
            margin: 2px 0;
        }

        .carousel-item .item-container h5 {
            margin: 5px 0 2px;
        }
        
    </style>
       
<button id="scrollToBottomBtn">↓</button>


@if (Auth::user()->level == 'pemilik_kos')
<section class="row justify-content-center">
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
</section>
@endif

@if (Auth::user()->level == 'admin' || Auth::user()->level == 'RW' || Auth::user()->level == 'RT')
&nbsp;&nbsp;&nbsp;
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
                    </a>
                    <p class="card-text">Lihat dan ubah profil Anda di sini.</p>
                </div>
            </div>
        </div>
        &nbsp;&nbsp;&nbsp;
    </section>

    &nbsp;&nbsp;&nbsp;
    <h3 style="margin-bottom: 50px;" class="text-center">Daftar Ketua RT</h3>

    <!-- Carousel for Ketua RT -->
    <div id="carouselKetuaRT" class="carousel slide carousel-container" data-bs-ride="carousel">
        <div style="margin-bottom: 50px;" class="carousel-inner text-center">
            <!-- Items -->
            <div class="carousel-item active">
            @foreach($list_ketua_rt as $index => $ketuaRT)
                <div class="item-container">
                    @if($ketuaRT->foto_ketua_rt != null)
                        <img src="{{ asset('storage/' . $ketuaRT->foto_ketua_rt) }}" alt="Ketua RT {{ $ketuaRT->rt }}">
                    @else
                        <p class="carousel-caption-custom">Tidak ada foto</p>
                    @endif
                    <h5 class="carousel-caption-custom">Ketua RT {{ sprintf('%02d', $ketuaRT->id_rt) }}</h5>
                    <p class="carousel-caption-custom">Dilantik pada {{ date('Y', strtotime($ketuaRT->tanggal_dilantik)) }}</p>
                    <p class="carousel-caption-custom">{{ $ketuaRT->nama_ketua_rt }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    &nbsp;&nbsp;&nbsp;
    <h3 class="text-center">Statistik Data Umum</h3>

    <!-- Chart Section -->
<div class="row justify-content-center mt-5">

<!-- <div class="col-lg-10 mb-4">
        <div class="card text-center shadow-lg">
            <div class="card-body">
                @if (Auth::user()->level == 'admin')
                    <h5 class="card-title text-muted mb-3">Seluruh Penduduk</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">Penduduk RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">Penduduk RT {{ $id_rt }}</h5>
                @endif
                <div class="form-group">
                    <label for="Select">Select:</label>
                    <select class="form-control" id="Select1">
                            <option value="">Agama</option>
                            <option value="">Pendidikan</option>
                            <option value="">Status Penghuni</option>
                    </select>
                </div>
                <canvas id="pendudukChart"></canvas>
            </div>
        </div>
    </div> -->



    
    <div class="col-lg-6 mb-4">
        <div class="card text-center shadow-lg">
            <div class="card-body">
                @if (Auth::user()->level == 'admin')
                    <h5 class="card-title text-muted mb-3">Pendidikan Seluruh Penduduk</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">Pendidikan Penduduk RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">Pendidikan Penduduk RT {{ $id_rt }}</h5>
                @endif
                
                <canvas id="educationalChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card text-center shadow-lg">
            <div class="card-body">
                @if (Auth::user()->level == 'admin')
                    <h5 class="card-title text-muted mb-3">Bantuan Seluruh Penduduk</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">Bantuan Penduduk RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">Bantuan Penduduk RT {{ $id_rt }}</h5>
                @endif
                
                <canvas id="sosialChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card text-center shadow-lg">
            <div class="card-body">
                @if (Auth::user()->level == 'admin')
                    <h5 class="card-title text-muted mb-3">kesehatan Seluruh Penduduk</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">kesehatan Penduduk RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">kesehatan Penduduk RT {{ $id_rt }}, RW {{ $id_rw }}</h5>
                @endif
                <div class="form-group">
                    <label for="yearSelect2">Select Year:</label>
                    <select class="form-control" id="yearSelect2">
                        @foreach ($years_kesehatan as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                
                <canvas id="kesehatanChart"></canvas>
            </div>
        </div>
    </div>


    <div class="col-lg-6 mb-4">
        <div class="card text-center shadow-lg">
            <div class="card-body">
                @if (Auth::user()->level == 'admin')
                    <h5 class="card-title text-muted mb-3">Bencana</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">Bencana RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">Bencana RT {{ $id_rt }}, RW {{ $id_rw }}</h5>
                @endif
                <div class="form-group">
                    <label for="yearSelect3">Select Year:</label>
                    <select class="form-control" id="yearSelect3">
                        @foreach ($years_kejadian as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                
                <canvas id="kejadianChart"></canvas>
            </div>
        </div>
    </div>

@if (Auth::user()->level == 'admin' || Auth::user()->level == 'RW')
    &nbsp;&nbsp;&nbsp;
    <h3 class="text-center">Statistik Data Kos</h3>

    <div class="col-lg-8 mb-4">
    &nbsp;&nbsp;&nbsp;
        <div class="card text-center shadow-lg">
            <div class="card-body">
                @if (Auth::user()->level == 'admin')
                    <h5 class="card-title text-muted mb-3">kos Seluruh Penduduk</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">kos Penduduk RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">kos Penduduk RT {{ $id_rt }}</h5>
                @endif
                <div class="form-group">
                    <label for="yearSelect">Select Year:</label>
                    <select class="form-control" id="yearSelect">
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <canvas id="kosChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endif

    
</div>
    <!-- Include Chart.js Library -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    var labels = {!! json_encode($allAgamas) !!};
    var data = {!! json_encode($agamaCounts) !!};
    var data2 = {!! json_encode($agamaCounts2) !!};
    var maxpenduduk = {!! json_encode($maxpenduduk) !!};

    var ctx = document.getElementById('pendudukChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Warga Asli',
                    data: data,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // red
                    borderColor: 'rgba(255, 99, 132, 1)', // red
                    borderWidth: 1
                },
                {
                    label: 'Warga Pendatang',
                    data: data2,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // green
                    borderColor: 'rgba(75, 192, 192, 1)', // green
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max : maxpenduduk
                }
            }
        }
    });
});


    document.addEventListener('DOMContentLoaded', function() {
        var labels = {!! json_encode($labels_pendidikan) !!};
        var data = {!! json_encode($data_pendidikan) !!};
        var maxpenduduk = {!! json_encode($maxpenduduk) !!};

        var ctx = document.getElementById('educationalChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var maxValue_kesehatan = {!! json_encode($maxValue_kesehatan) !!};
    var ctx = document.getElementById('kesehatanChart').getContext('2d');
    var kesehatanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [],
                backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max : maxValue_kesehatan,
                }
            }
        }
    });

    function loadKesehatanData(year) {
        fetch('{{ route("chart.fetchKesehatanData") }}?year=' + year)
            .then(response => response.json())
            .then(data => {
                kesehatanChart.data.labels = data.labels;
                kesehatanChart.data.datasets[0].data = data.data;
                kesehatanChart.update();
            });
    }

    // Load data kesehatan dengan tahun default saat halaman dimuat
    var defaultYear = document.getElementById('yearSelect2').value;
    loadKesehatanData(defaultYear);

    document.getElementById('yearSelect2').addEventListener('change', function() {
        var selectedYear = this.value;
        loadKesehatanData(selectedYear);
    });
});


    document.addEventListener('DOMContentLoaded', function() {
        var labels = {!! json_encode($labels_sosial) !!};
        var data = {!! json_encode($data_sosial) !!};

        var ctx = document.getElementById('sosialChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var maxValue_kejadian = {!! json_encode($maxValue_kejadian) !!};
        var labels = {!! json_encode($labels_kejadian) !!};
        var data = {!! json_encode($data_kejadian) !!};

        var ctx = document.getElementById('kejadianChart').getContext('2d');
        var kejadianChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Jumlah laporan',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max : maxValue_kejadian,
                    }
                }
            }
        });

        function loadKejadianData(year) {
        fetch('{{ route("chart.fetchKejadianData") }}?year=' + year)
            .then(response => response.json())
            .then(data => {
                kejadianChart.data.labels = data.labels;
                kejadianChart.data.datasets[0].data = data.data;
                kejadianChart.update();
            });
    }

    // Load data kesehatan dengan tahun default saat halaman dimuat
    var defaultYear = document.getElementById('yearSelect3').value;
    loadKejadianData(defaultYear);

    document.getElementById('yearSelect3').addEventListener('change', function() {
        var selectedYear = this.value;
        loadKejadianData(selectedYear);
    });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('kosChart').getContext('2d');
    var maxValue = {!! json_encode($maxValue) !!};
    var kosChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                label: 'Jumlah Penghuni',
                data: [],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            
        ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: maxValue
                }
            }
        }
    });

    function loadChartData(year) {
        fetch('{{ route("chart.fetchData") }}?year=' + year)
            .then(response => response.json())
            .then(data => {
                kosChart.data.labels = data.labels;
                kosChart.data.datasets[0].data = data.data;
                kosChart.update();
            });
    }

    // Load chart data with default year on page load
    var defaultYear = document.getElementById('yearSelect').value;
    loadChartData(defaultYear);

    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;
        loadChartData(selectedYear);
    });
});
</script>

<script>
        const scrollToBottomBtn = document.getElementById('scrollToBottomBtn');

        // Fungsi untuk mengatur visibilitas tombol
        function toggleScrollButton() {
            if (window.scrollY === 0) {
                scrollToBottomBtn.style.display = 'block';
            } else {
                scrollToBottomBtn.style.display = 'none';
            }
        }

        // Event listener untuk tombol scroll
        scrollToBottomBtn.addEventListener('click', function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        });

        // Event listener untuk scroll halaman
        window.addEventListener('scroll', toggleScrollButton);

        // Panggil fungsi toggleScrollButton untuk set awal
        toggleScrollButton();

        
    </script>

@if ($errors->any())
    <script>
        Swal.fire({
                title: 'Error!',
                @foreach ($errors->all() as $error)
                    text: '{{ $error }}',
                @endforeach
                icon: 'error',
                showConfirmButton: true,
            });
    </script>
@endif

@endif

@endsection