@extends('layouts.default-ui')

@section('heading')
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div id="user-info" style="position: absolute; top: 20px; right: 20px; display: flex; align-items: center; background-color: #435ebe; padding: 5px 10px; border-radius: 10px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
        <i class="fas fa-user" style="margin-right: 5px; font-size: 18px; color: white;"></i>
        <p style="margin: 0; font-size: 14px; color: white;">{{ Auth::user()->level }}, {{ Auth::user()->username }}</p>
</div>

<br>
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data kejadian Admin</h3>
                <p class="text-subtitle text-muted">Rekap data Kejadian</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Kejadian</li>
                    </ol>
                    <p class="text-muted mt-2 order-md-2">Kec.Candisari, Kel.Tegalsari, RW 13 , RT 6</p>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Data Warga')

@section('content')
@php
$icons = [
    'fi fi-sr-house-flood',
    'fi fi-sr-heat',
    'fi fi-sr-house-chimney-crack',
    'fi fi-sr-volcano',
    'fi fi-sr-house-tsunami',
    'fi fi fi-sr-thunderstorm',
    // tambahkan lebih banyak ikon sesuai kebutuhan
];
@endphp

    <ul class="nav nav-pills mb-2">
        @foreach($list_jenis_kejadian as $jenis_kejadian)
        @php
        $icon = $icons[$loop->index % count($icons)]; // Menggunakan modulus untuk mengulang jika ikon lebih sedikit dari penyakit
        @endphp
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $jenis_kejadian->jenis_kejadian }}-tab"
                   data-bs-toggle="tab" href="#{{ $jenis_kejadian->jenis_kejadian }}" role="tab"
                   aria-controls="{{ $jenis_kejadian->jenis_kejadian }}"
                   aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                   data-jenis_kejadian-id="{{ $jenis_kejadian->id }}">
                    <i class="{{ $icon }}"></i>
                    <span class="{{ $loop->first ? 'fw-bold' : '' }}">{{ $jenis_kejadian->jenis_kejadian }}</span>
                </a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($list_jenis_kejadian as $jenis_kejadian)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                 id="{{ $jenis_kejadian->jenis_kejadian }}"
                 role="tabpanel" aria-labelledby="{{ $jenis_kejadian->jenis_kejadian }}-tab">
                <section class="section">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Rekap Data - {{ $jenis_kejadian->jenis_kejadian }}</h5>
                            <a href="{{ route('kejadian.print', $jenis_kejadian) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-print"></i> Cetak - {{ $jenis_kejadian->jenis_kejadian }}
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
                                        <th>Bukti</th>
                                        <th>Deskripsi</th>
                                        <th>Pelapor</th>
                                        <th>Status</th>
                                        @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RT')
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($kejadian as $p)
    @if ($p->jenis_kejadian == $jenis_kejadian->id)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->tanggal_kejadian }}</td>
            <td>{{ $p->tempat_kejadian }}</td>
            <td>
                @if($p->foto_kejadian)
                    <img src="{{ asset('storage/' . $p->foto_kejadian) }}" alt="Bukti" width="100">
                @else
                    Tidak ada bukti
                @endif
            </td>
            <td>{{ $p->deskripsi_kejadian }}</td>
            <td>{{ $p->penduduk->nama }}</td>
            <td>
                @if ($p->status)
                    <span class="badge bg-warning">Proses</span>
                @else
                    <span class="badge bg-success">Selesai</span>
                @endif
            </td>
            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RT')
                <td>
                    <a href="{{ route('kejadian.toggle_status', $p->id) }}" class="btn btn-sm
@if($p->status)
                        btn-secondary
@else
                        btn-primary
@endif">
                        <i class="bi bi-check text-white"></i>
                    </a>
                    <a href="{{ route('kejadian.delete', $p->id) }}" class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
            @endif
        </tr>
    @endif
@empty
    <tr>
        <td colspan="8" class="text-center">Tidak ada data kejadian.</td>
    </tr>
@endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
    @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RT')

    <div class="text mt-3">
    <p>HARAP DIPERHATIKAN! </p>
    <p>Klik  <span  class="btn btn-sm btn-primary"><i class="bi bi-check text-white"></span></i> untuk mengganti status menjadi <span class="badge bg-success">Selesai</span> atau <span class="badge bg-warning">Proses</span>.</p>
</div>
        <!-- Floating Toggle -->
        <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
            <button type="button" class="btn btn-primary rounded-pill btn-lg toggle-data" data-bs-toggle="modal"
                    data-bs-target="#tambahDataModal">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>

        <!-- Modal Tambah Data kejadian -->
        <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data kejadian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('kejadian.store') }}"  id="tambahDataForm" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_jenis_kejadian" class="form-label">Kejadian:</label>
                                <select name="id_jenis_kejadian" id="id_jenis_kejadian" class="form-select">
                                    @foreach($list_jenis_kejadian as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->jenis_kejadian }}</option>
                                    @endforeach
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
                                <label for="foto_kejadian" class="form-label"><strong>Bukti Kejadian</strong></label>
                                <input type="file" id="foto_kejadian" name="foto_kejadian"
                                       class="basic-filepond form-control">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi_kejadian" class="form-label">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi_kejadian"
                                          name="deskripsi_kejadian"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="NIK_penduduk" class="form-label">Pelapor :</label>
                                <select name="NIK_penduduk" id="NIK_penduduk" class="form-select choices">
                                    @foreach ($list_penduduk as $penduduk)
                                        <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah Kejadian</button>
                            </div>
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
            // Save the active jenis_kejadian tab ID in local storage
            function saveActiveJenisKejadianId(jenisKejadianId) {
                localStorage.setItem("activeJenisKejadianId", jenisKejadianId);
            }

            // Retrieve the active jenis_kejadian tab ID from local storage
            function getSavedActiveJenisKejadianId() {
                return localStorage.getItem("activeJenisKejadianId");
            }

            // Initialize the active tab based on saved ID
            var activeJenisKejadianId = getSavedActiveJenisKejadianId();
            if (activeJenisKejadianId) {
                $(".nav-link[data-jenis_kejadian-id=\"" + activeJenisKejadianId + "\"]").tab("show");
            }

            // Set initial jenis_kejadian for the modal dropdown
            var initialjenis_kejadian = $(".nav-link.active").data("jenis_kejadian-id");
            var namajenis_kejadian = $(".nav-link.active").text().trim();
            $("#id_jenis_kejadian").html("<option value=\"" + initialjenis_kejadian + "\" selected>" + namajenis_kejadian + "</option>");

            // Handle tab click to update active jenis_kejadian
            $(".nav-link").on("click", function() {
                $(".nav-link span").removeClass("fw-bold");
                $(this).find("span").addClass("fw-bold");

                var jenis_kejadianId = $(this).data("jenis_kejadian-id");
                var namajenis_kejadian = $(this).text().trim();
                $("#id_jenis_kejadian").html("<option value=\"" + jenis_kejadianId + "\" selected>" + namajenis_kejadian + "</option>");

                saveActiveJenisKejadianId(jenis_kejadianId);
            });

            $(".choices").choices();
        });

        // Function to handle form submission
    $(document).ready(function() {
        $('#tambahDataForm').submit(function(event) {
            // Cek apakah tanggal_terdampak tidak diisi
            if ($('#tanggal_kejadian').val() === '') {
                // Tampilkan toast
                showToast("Tanggal tanggal kejadian harus diisi!");
                // Hentikan pengiriman form
                event.preventDefault();
            }
        });
    });
        function showToast(message) {
        Toastify({
            text: message,
            duration: 2000, // Duration in milliseconds (3 seconds in this example)
            close: true // Show close button or not
        }).showToast();
    }

        
    </script>

@if ($errors->any())
    <script>
        Swal.fire({
                title: 'Error!',
                @foreach ($errors->all() as $error)
                    text: '{{ $error }}',
                @endforeach
                icon: 'error',
                showConfirmButton: true,
            });
    </script>
@endif

@endsection
