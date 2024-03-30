@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kos</h3>
                <p class="text-subtitle text-muted">
                    Rekap data kos
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Kos
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- Start Table --}}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Rekap Data Bangunan Kos
                </h5>
                <button class="btn btn-primary btn-sm" onclick="window.print()">
                    <i class="fas fa-print"></i>
                    Cetak
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="text-align: center;">Nama Kos</th>
                                <th style="text-align: center;">Pemilik</th>
                                <th style="text-align: center;">Jumlah Penghuni</th>
                                <th style="text-align: center;">Alamat Kos</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        @foreach($data_kos as $kos)
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td style="text-align: center;">{{ $kos->nama_kos }}</td>
                                <td style="text-align: center;">{{ $kos->pemilik_kos }}</td>
                                <td style="text-align: center;">{{ $kos->jumlah_penghuni }}</td>
                                <td style="text-align: center;">{{ $kos->alamat_kos }}</td>
                                <td style="text-align: center;">
                                    @if($kos->status)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Non Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Toggle Edit -->
                                    <a href="{{ route('dataKos.edit', $kos->id) }}" class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </a>

                                        
                                    <!-- Tombol Hapus -->
                                    <a href="{{ route('dataKos.delete', $kos->id) }}" class="btn btn-sm btn-danger toggle-delete"
                                        data-toggle="modal">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>

    </section>
    {{-- End Table --}}

    <!-- Floating Toggle -->
    <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('dataKos.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data"
            data-toggle="modal" data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <!-- End Floating Toggle -->
@endsection

@section('scripts')
    {{--  --}}
@endsection
