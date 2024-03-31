@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pendidikan</h3>
                <p class="text-subtitle text-muted">
                    Kelengkapan data warga putus sekolah
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Umum
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pendidikan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <section class="section">
    {{--  Tabel Pendidikan Start      --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title float-start">Warga Putus Sekolah</h4>
            <button class="btn btn-sm btn-outline-primary mx-4 float-end" id="filter">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
                </svg>
            </button>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="sd" data-bs-toggle="tab" href="{{route('pendidikan')}}?pendidikan=sd" role="tab"
                       aria-controls="home" aria-selected="true">Tamat SD/Sederajat</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="smp" data-bs-toggle="tab" href="#smp" role="tab"
                       aria-controls="profile" aria-selected="false">Tamat SMP/Sederajat</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="sma" data-bs-toggle="tab" href="#sma" role="tab"
                       aria-controls="contact" aria-selected="false">Tamat SMA/Sederajat</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="d3" data-bs-toggle="tab" href="#d3" role="tab"
                       aria-controls="contact" aria-selected="false">Tamat D3</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="s1" data-bs-toggle="tab" href="#s1" role="tab"
                       aria-controls="contact" aria-selected="false">Tamat S1/D4</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="s2" data-bs-toggle="tab" href="#s2" role="tab"
                       aria-controls="contact" aria-selected="false">Tamat S2</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="s3" data-bs-toggle="tab" href="#s3" role="tab"
                       aria-controls="contact" aria-selected="false">Tamat S3</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-sm mt-2 mb-2" onclick="window.print()">
                <i class="fas fa-print"></i>
                Cetak
            </button>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="sd" role="tabpanel" aria-labelledby="sd-tab">
                    <table class="table table-hover" id="tab-sd">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        @foreach($penduduk  as $p)
                            <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="smp" role="tabpanel" aria-labelledby="smp-tab">
                    <table class="table table-hover" id="tab-smp">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        @foreach($penduduk as $p)
                            <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="sma" role="tabpanel" aria-labelledby="sma-tab">
                    <table class="table table-hover" id="tab-sma">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        @foreach($penduduk as $p)
                            <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="d3" role="tabpanel" aria-labelledby="d3-tab">
                    <table class="table table-hover" id="tab-d3">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        @foreach($penduduk as $p)
                            <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="s1" role="tabpanel" aria-labelledby="s1-tab">
                    <table class="table table-hover" id="tab-s1">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        @foreach($penduduk as $p)
                            <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="s2" role="tabpanel" aria-labelledby="s2-tab">
                    <table class="table table-hover" id="tab-s2">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        @foreach($penduduk as $p)
                            <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="s3" role="tabpanel" aria-labelledby="s3-tab">
                    <table class="table table-hover" id="tab-s3">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                        </thead>
                        @foreach($penduduk as $p)
                            <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    </section>
    {{--  Tabel Pendidikan END  --}}

    <!-- Floating Toggle -->
    <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('wargaAsli.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data"
           data-toggle="modal" data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
    <!-- End Floating Toggle -->
@endsection
