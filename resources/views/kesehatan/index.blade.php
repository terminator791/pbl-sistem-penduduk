@extends('layouts.default-ui')

@section('heading')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Kesehatan</h3>
            <p class="text-subtitle text-muted">
                Rekap data Kesehatan
            </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Data Kesehatan
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
    @foreach($list_penyakit as $penyakit)
    <li class="nav-item">
        <a class="nav-link @if($loop->first) active @endif" id="{{ $penyakit->nama_penyakit }}-tab" data-bs-toggle="tab" href="#{{ $penyakit->nama_penyakit }}" role="tab" aria-controls="{{ $penyakit->nama_penyakit }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-penyakit-id="{{ $penyakit->id }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-@if($loop->first)bold @endif">{{ $penyakit->nama_penyakit }}</span>
        </a>
    </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($list_penyakit as $penyakit)
    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $penyakit->nama_penyakit }}" role="tabpanel" aria-labelledby="{{ $penyakit->nama_penyakit }}-tab">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        Rekap Data - {{ $penyakit->nama_penyakit }}
                    </h5>
                    <a href="{{ route('kesehatan.print', $penyakit) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-print"></i>
                        Cetak - {{ $penyakit->nama_penyakit }}
                    </a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_{{ $penyakit->nama_penyakit }}">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penyakit->kesehatan as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->penduduk->nama }}</td>
                                    <td>{{ $p->penduduk->alamat }}</td>
                                    <td>
                                        <a href="{{ route('kesehatan.delete', $p->id) }}" class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
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

<!-- Modal Tambah Data Kesehatan -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Kesehatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('kesehatan.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="NIK_penduduk" class="form-label">Penduduk :</label>
                        <select name="NIK_penduduk" id="NIK_penduduk" class="form-select">
                            @foreach ($list_penduduk as $penduduk)
                            <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_terdampak" class="form-label">Tanggal Terdampak:</label>
                        <input type="date" class="form-control" id="tanggal_terdampak" name="tanggal_terdampak">
                    </div>
                    <div class="mb-3">
                        <label for="id_penyakit" class="form-label">Penyakit :</label>
                        <select name="id_penyakit" id="id_penyakit" class="form-select">
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Penduduk</button>
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
        // Inisialisasi nilai penyakit pada load halaman pertama kali
        var initialPenyakit = $('.nav-link.active').data('penyakit-id'); // Mengambil data penyakit-id dari elemen nav-link aktif
        var namaPenyakit = $('.nav-link.active').text().trim();
        $('#id_penyakit').html('<option value="' + initialPenyakit + '" selected>' + namaPenyakit + '</option>');

        $('.nav-link').on('click', function() {
            $('.nav-link span').removeClass('fw-bold');
            $(this).find('span').addClass('fw-bold');

            // Memperbarui pilihan pada dropdown "Penyakit"
            var penyakitId = $(this).data('penyakit-id'); // Mengambil data penyakit-id dari elemen nav-link yang di-klik
            var namaPenyakit = $(this).text().trim();
            $('#id_penyakit').html('<option value="' + penyakitId + '" selected>' + namaPenyakit + '</option>');
        });

        $('.print-button').on('click', function() {
            window.print();
        });
    });
</script>
@endsection