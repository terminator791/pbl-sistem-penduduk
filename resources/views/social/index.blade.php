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
    @foreach($list_bantuan as $nama_bantuan)
    <li class="nav-item">
        <a class="nav-link @if($loop->first) active @endif" 
                id="{{ str_replace(' ', '-', $nama_bantuan->jenis_bantuan) }}-tab" 
                data-bs-toggle="tab" 
                href="#{{ str_replace(' ', '-', $nama_bantuan->jenis_bantuan) }}" 
                ole="tab" aria-controls="{{ $nama_bantuan->jenis_bantuan }}" 
                aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                data-jenis_bantuan-id="{{ $nama_bantuan->id }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-@if($loop->first)bold @endif">{{ $nama_bantuan->jenis_bantuan }}</span>
        </a>
    </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($list_bantuan as $nama_bantuan)
    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ str_replace(' ', '-', $nama_bantuan->jenis_bantuan) }}" role="tabpanel" aria-labelledby="{{ $nama_bantuan->jenis_bantuan }}-tab">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        Rekap Data - {{ $nama_bantuan->jenis_bantuan }}
                    </h5>
                    <a href="{{ route('kesehatan.print', $nama_bantuan) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-print"></i>
                        Cetak - {{ $nama_bantuan->nama_bantuan }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_{{ $nama_bantuan->nama_bantuan }}">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bantuan as $p)
                                    @if($p->jenis_bantuan->id == $nama_bantuan->id)
                                        @foreach($list_penduduk as $penduduk)
                                            @if($penduduk->NIK == $p->NIK_penduduk)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $penduduk->nama }}</td>
                                                <td>{{ $penduduk->nama_jalan }} , RT {{ $penduduk->id_rt }} , RW {{ $penduduk->id_rw }}</td>
                                                <td>
                                                    <a href="{{ route('kesehatan.delete', $penduduk->id) }}" class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
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

<!-- Modal Tambah Data Bantuan -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Bantuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('sosial.store') }}">
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
                        <label for="id_bantuan" class="form-label">Bantuan :</label>
                        <select name="id_bantuan" id="id_bantuan" class="form-select"> 
                            
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

        var activeJenisBantuanId = getSavedActiveJenisBantuanId();

    if (activeJenisBantuanId) {
        $('.nav-link[data-jenis_bantuan-id="' + activeJenisBantuanId + '"]').tab('show');
    }

    function saveActiveJenisBantuanId(jenisBantuanId) {
        localStorage.setItem('activeJenisBantuanId', jenisBantuanId);
        var url = new URL(window.location.href);
        url.searchParams.set('jenis_bantuan_id', jenisBantuanId);
        window.history.pushState({}, '', url);
    }

    function getSavedActiveJenisBantuanId() {
        return localStorage.getItem('activeJenisBantuanId');
    }

        var initialBantuan = $('.nav-link.active').data('bantuan-id'); // Mengambil data penyakit-id dari elemen nav-link aktif
        var namaBantuan = $('.nav-link.active').text().trim();
        $('#id_bantuan').html('<option value="' + initialBantuan + '">' + namaBantuan + '</option>');

        $('.nav-link').on('click', function() {
            $('.nav-link span').removeClass('fw-bold');
            $(this).find('span').addClass('fw-bold');
            // Memperbarui pilihan pada dropdown "Penyakit"
            var bantuanId = $(this).data('jenis_bantuan-id'); // Mengambil data penyakit-id dari elemen nav-link yang di-klik
            var namaBantuan = $(this).text().trim();
            
            $('#id_bantuan').html('<option value="' + bantuanId + '">' + namaBantuan + '</option>');

            var jenisBantuanId = $(this).data('jenis_bantuan-id');
            saveActiveJenisBantuanId(jenisBantuanId);
        });

        $('.print-button').on('click', function() {
            window.print();
        });
    });
</script>
@endsection