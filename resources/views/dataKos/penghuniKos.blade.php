@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Penghuni Kos</h3>
                <p class="text-subtitle text-muted">
                    Rekap data penghuni kos
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Penghuni Kos
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Warga Penghuni Kos</li>
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
                    Rekap Data Warga Penghuni Kos
                </h5>
                {{-- <a href="{{ route('#') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-print"></i>
                    Cetak
                </a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penghuni as $p)
                                <tr>
                                    <td>{{  1 }}</td>
                                    <td>{{ $p->NIK }}</td>
                                    <td>{{ $p->penduduk->nama }}</td>
                                    <td>{{ $p->penduduk->tempat_lahir }}</td>
                                    <td>{{ date('d F Y', strtotime($p->tanggal_masuk)) }}</td>
                                    <td>{{ date('d F Y', strtotime($p->tanggal_keluar)) }}</td>
                                    <td>
                                        <!-- Tombol Toggle Edit -->
                                        <a href="{{ route('dataKos.penghuniKos.edit', $kos->id) }}"
                                            class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <a href="{{ route('dataKos.penghuniKos.delete', $kos->id) }}"
                                            class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
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
    {{-- <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('wargaAsli.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data"
            data-toggle="modal" data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div> --}}

    <!-- End Floating Toggle -->
@endsection

@section('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete route with the correct id
                    window.location.href = "{{ url('/wargaAsli/hapus-data-warga-asli') }}/" + id;
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
@endsection
