@extends('layouts.default-ui')

@section('heading')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Sosial</h3>
            <p class="text-subtitle text-muted">Rekap data Sosial</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Sosial</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('title', 'Data Warga')

@section('content')
<ul class="nav nav-pills mb-2">
    @foreach($list_bantuan as $bantuan)
    <li class="nav-item">
        <a class="nav-link @if($loop->first) active @endif" id="{{ $bantuan->jenis_bantuan }}-tab" data-bs-toggle="tab" href="#{{ $bantuan->jenis_bantuan }}" role="tab" aria-controls="{{ $bantuan->jenis_bantuan }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-bantuan-id="{{ $bantuan->id }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-bold">{{ $bantuan->jenis_bantuan }}</span>
        </a>
    </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($list_bantuan as $bantuan)
    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $bantuan->jenis_bantuan }}" role="tabpanel" aria-labelledby="{{ $bantuan->jenis_bantuan }}-tab">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Rekap Data - {{ $bantuan->jenis_bantuan }}</h5>
                    <a href="{{ route('bantuan.print', $bantuan) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-print"></i>
                        Cetak - {{ $bantuan->jenis_bantuan }}
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_{{ $bantuan->jenis_bantuan }}">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bantuan->penduduk as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->nama_jalan }} , RT {{ $p->id_rt }} , RW {{ $p->id_rw }}</td>
                                    @if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'RT' )
                                    <td>
                                        <a href="{{ route('bantuan.delete', $p->id) }}" class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                    @endif
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
@if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'RT' )
<!-- Floating Toggle -->
<div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
    <button type="button" class="btn btn-primary rounded-pill btn-lg toggle-data" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
        <i class="bi bi-plus-lg"></i>
    </button>
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Sosial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('bantuan.store') }}">
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
                        <label for="id_bantuan" class="form-label">Jenis Bantuan :</label>
                        <select name="id_bantuan" id="id_bantuan" class="form-select"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Status Sosial</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Update the drop-down for the initially selected tab
        updateDropdown($('.nav-link.active').data('bantuan-id'));

        $('.nav-link').on('click', function() {
            var bantuanId = $(this).data('bantuan-id');
            updateDropdown(bantuanId);
        });

        function updateDropdown(bantuanId) {
            var selectedBantuan = $('.nav-link[data-bantuan-id="' + bantuanId + '"]').text().trim();
            $('#id_bantuan').html('<option value="' + bantuanId + '">' + selectedBantuan + '</option>');
        }
    });
</script>
@endsection
