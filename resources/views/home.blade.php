@extends('layouts.default-ui')

@section('heading')
    @if (Auth::user()->level == 'admin')
        <h3 class="text-center">Selamat Datang {{ Auth::user()->level }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13</p>
    @elseif (Auth::user()->level == 'RW')
        <h3 class="text-center">Selamat Datang Ketua {{ Auth::user()->level }}, {{ Auth::user()->level }} di Dasbor Tegalsari</h3>
        <p class="text-center text-subtitle text-muted">Kec.Candisari, Kel.Tegalsari, RW 13</p>
    @elseif(Auth::user()->level == 'RT')
        <h3 class="text-center">Selamat Datang Ketua {{ Auth::user()->level }}, {{ Auth::user()->username }} di Dasbor Tegalsari</h3>
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
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Chart Section -->
<div class="row justify-content-center mt-5">
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
                    <h5 class="card-title text-muted mb-3">kesehatan Seluruh Penduduk</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">kesehatan Penduduk RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">kesehatan Penduduk RT {{ $id_rt }}</h5>
                @endif
                
                <canvas id="kesehatanChart"></canvas>
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
                    <h5 class="card-title text-muted mb-3">Bantuan Seluruh Penduduk</h5>
                @elseif (Auth::user()->level == 'RW')
                    <h5 class="card-title text-muted mb-3">Bantuan Penduduk RW {{ $id_rw }}</h5>
                @elseif(Auth::user()->level == 'RT')
                    <h5 class="card-title text-muted mb-3">Bantuan Penduduk RT {{ $id_rt }}</h5>
                @endif
                
                <canvas id="kejadianChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
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
    <!-- Include Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var labels = {!! json_encode($labels_pendidikan) !!};
        var data = {!! json_encode($data_pendidikan) !!};

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
                        beginAtZero: true
                    }
                }
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var labels = {!! json_encode($labels_kesehatan) !!};
        var data = {!! json_encode($data_kesehatan) !!};

        var ctx = document.getElementById('kesehatanChart').getContext('2d');
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
        var labels = {!! json_encode($labels_kejadian) !!};
        var data = {!! json_encode($data_kejadian) !!};

        var ctx = document.getElementById('kejadianChart').getContext('2d');
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
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('kosChart').getContext('2d');
    var kosChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
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

    document.getElementById('yearSelect').addEventListener('change', function() {
        var selectedYear = this.value;
        fetch('{{ route("chart.fetchData") }}?year=' + selectedYear)
            .then(response => response.json())
            .then(data => {
                kosChart.data.labels = data.labels;
                kosChart.data.datasets[0].data = data.data;
                kosChart.update();
            });
    });
});

</script>
@endsection
