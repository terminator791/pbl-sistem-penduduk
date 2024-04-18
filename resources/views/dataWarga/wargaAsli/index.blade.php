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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
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
            <a href="{{ route('wargaAsli.print') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-print"></i>
                Cetak
            </a>

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
                    <tbody>
                        @foreach ($penduduk as $p)
                        <tr class="{{ $p->status_penghuni == 'meninggal' ? 'fade-row' : '' }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->NIK }}</td>
                            <td>{{ $p->nama }}</td>

                            <td>{{ $p->nama_jalan }} , RT: {{ $p->id_rt }} , RW: {{ $p->id_rw }}</td>

                            <td>
                                <!-- Tombol Toggle Edit -->
                                <a href="{{ route('wargaAsli.edit', $p->id) }}" class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">
                                    <i class="bi bi-pencil-fill text-white"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <a href="#" class="btn btn-sm btn-danger toggle-delete" onclick="confirmDelete({{ $p->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </a>

                                <!-- Tombol Toggle Detail -->
                                <a href="#" class="btn btn-sm btn-primary toggle-detail" data-toggle="modal">
                                    <i class="bi bi-eye-fill"></i>
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
    <a href="{{ route('wargaAsli.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data" data-toggle="modal" data-target="#tambahDataModal">
        <i class="bi bi-plus-lg"></i>
    </a>
</div>

<!-- End Floating Toggle -->

<style>
    /* Aturan CSS */
    .fade-row {
        opacity: 0.5;
        /* Sesuaikan dengan tingkat opasitas yang diinginkan */
        transition: opacity 0.3s ease;
        /* Animasi perubahan opasitas */
    }

    .fade-row:hover {
        opacity: 1;
        /* Opasitas kembali ke normal saat dihover */
    }

    .fade-row td {
        text-decoration: line-through;
    }
</style>
@endsection

@section('scripts')
{{-- --}}

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
        text: '{{ session('
        success ') }}',
        icon: 'success',
        showConfirmButton: false,
        timer: 3000
    });
</script>

@endif
@endsection