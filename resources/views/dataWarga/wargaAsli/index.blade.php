@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Warga</h3>
                <p class="text-subtitle text-muted">
                    Rekap data warga asli
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Warga
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Warga Asli</li>
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
                    Rekap Data Warga Asli RT
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
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach($penduduk as $p)
                        <tbody>
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->NIK }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nama_jalan }}</td>
                                <td>
                                    <!-- Tombol Toggle Edit -->
                                    <a href="{{ route('wargaAsli.update') }}" class="btn btn-sm btn-warning toggle-edit"
                                        data-toggle="modal">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <a href="{{ route('wargaAsli.delete') }}" class="btn btn-sm btn-danger toggle-delete"
                                        data-toggle="modal">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                               
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>

    </section>
    {{-- End Table --}}

    <!-- Floating Toggle -->
    <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('wargaAsli.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data"
            data-toggle="modal" data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <!-- End Floating Toggle -->
@endsection

@section('scripts')
    {{--  --}}
@endsection
