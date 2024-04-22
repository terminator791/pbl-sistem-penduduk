@extends('layouts.default-ui')

@section('heading')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data kejadian</h3>
            <p class="text-subtitle text-muted">
                Rekap data Kejadian
            </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Data Kejadian
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection


@section('title', 'Data Warga')

@section('content')
<ul class="nav nav-pills mb-2">
    @foreach($list_jenis_kejadian as $jenis_kejadian)
    <li class="nav-item">
        <a class="nav-link @if($loop->first) active @endif" id="{{ $jenis_kejadian->jenis_kejadian }}-tab" data-bs-toggle="tab" href="#{{ $jenis_kejadian->jenis_kejadian }}" role="tab" aria-controls="{{ $jenis_kejadian->jenis_kejadian }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-jenis_kejadian-id="{{ $jenis_kejadian->id }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-@if($loop->first)bold @endif">{{ $jenis_kejadian->jenis_kejadian }}</span>
        </a>
    </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($list_jenis_kejadian as $jenis_kejadian)
    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $jenis_kejadian->jenis_kejadian }}" role="tabpanel" aria-labelledby="{{ $jenis_kejadian->jenis_kejadian }}-tab">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        Rekap Data - {{ $jenis_kejadian->jenis_kejadian }}
                    </h5>
                    <a href="{{ route('kejadian.print', $jenis_kejadian) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-print"></i>
                        Cetak - {{ $jenis_kejadian->jenis_kejadian }}
                    </a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_{{ $jenis_kejadian->jenis_kejadian }}">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Tempat</th>
                                    <th>Deskripsi</th>
                                    <th>Pelapor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jenis_kejadian->kejadian as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->tanggal_kejadian }}</td>
                                    <td>{{ $p->tempat_kejadian }}</td>
                                    <td>{{ $p->deskripsi_kejadian }}</td>
                                    <td>{{ $p->penduduk->nama }}</td>

                                    <td>
                                        <a href="{{ route('kejadian.delete', $p->id) }}" class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
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
    </div>
    @endforeach
</div>

<!-- Floating Toggle -->
<div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
    <button type="button" class="btn btn-primary rounded-pill btn-lg toggle-data" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
        <i class="bi bi-plus-lg"></i>
    </button>
</div>

<!-- Modal Tambah Data kejadian -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data kejadian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('kejadian.store') }}">
                @csrf
                <div class="modal-body">
                <div class="mb-3">
                        <label for="id_jenis_kejadian" class="form-label">Kejadian:</label>
                        <select name="id_jenis_kejadian" id="id_jenis_kejadian" class="form-select">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kejadian" class="form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian">
                    </div>
                    <div class="mb-3">
                        <label for="tempat_kejadian" class="form-label">Tempat:</label>
                        <input type="text" class="form-control" id="tempat_kejadian" name="tempat_kejadian">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_kejadian" class="form-label">Deskripsi:</label>
                        <textarea class="form-control" id="deskripsi_kejadian" name="deskripsi_kejadian"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="NIK_penduduk" class="form-label">Pelapor :</label>
                        <select name="NIK_penduduk" id="NIK_penduduk" class="form-select">
                            @foreach ($list_penduduk as $penduduk)
                            <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah Kejadian</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Script jQuery
    $(document).ready(function() {
        // Fungsi untuk menyimpan id jenis kejadian ke local storage
    function saveActiveJenisKejadianId(jenisKejadianId) {
        localStorage.setItem('activeJenisKejadianId', jenisKejadianId);
    }

    // Fungsi untuk mendapatkan id jenis kejadian terakhir yang diakses dari local storage
    function getSavedActiveJenisKejadianId() {
        return localStorage.getItem('activeJenisKejadianId');
    }

    // Inisialisasi tab aktif
    var activeJenisKejadianId = getSavedActiveJenisKejadianId(); // Mendapatkan id jenis kejadian terakhir yang diakses dari local storage
    if (activeJenisKejadianId) {
        $('.nav-link[data-jenis_kejadian-id="' + activeJenisKejadianId + '"]').tab('show'); // Menampilkan tab dengan id jenis kejadian terakhir yang diakses
    }

        // Inisialisasi nilai jenis_kejadian pada load halaman pertama kali
        var initialjenis_kejadian = $('.nav-link.active').data('jenis_kejadian-id'); // Mengambil data jenis_kejadian-id dari elemen nav-link aktif
        var namajenis_kejadian = $('.nav-link.active').text().trim();
        $('#id_jenis_kejadian').html('<option value="' + initialjenis_kejadian + '" selected>' + namajenis_kejadian + '</option>');

        $('.nav-link').on('click', function() {
            $('.nav-link span').removeClass('fw-bold');
            $(this).find('span').addClass('fw-bold');

            // Memperbarui pilihan pada dropdown "jenis_kejadian"
            var jenis_kejadianId = $(this).data('jenis_kejadian-id'); // Mengambil data jenis_kejadian-id dari elemen nav-link yang di-klik
            var namajenis_kejadian = $(this).text().trim();
            $('#id_jenis_kejadian').html('<option value="' + jenis_kejadianId + '" selected>' + namajenis_kejadian + '</option>');
            var jenisKejadianId = $(this).data('jenis_kejadian-id');
        saveActiveJenisKejadianId(jenisKejadianId); // Menyimpan id jenis kejadian ke local storage setiap kali tab diubah
        });

        $('.print-button').on('click', function() {
            window.print();
        });
    });
</script>
@endsection