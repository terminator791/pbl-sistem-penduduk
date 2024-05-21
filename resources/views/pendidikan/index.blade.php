@extends('layouts.default-ui')

@section('heading')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
                @if (Auth::user()->level == 'admin')
                    <h3>Data Pendidikan Admin</h3>
                @elseif (Auth::user()->level == 'RW')
                    <h3>Data Pendidikan RW 13</h3>
                @elseif(Auth::user()->level == 'RT')
                    <h3>Data Pendidikan RW 13  RT {{ $id_rt}}</h3>
                @endif
            <p class="text-subtitle text-muted">
                Rekap data Pendidikan
            </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Data Pendidikan
                    </li>
                </ol>
                <p class="text-muted mt-2 order-md-2">Kec.Candisari, Kel.Tegalsari, RW 13</p>
            </nav>
        </div>
    </div>
</div>
@endsection
@section('title', 'Data Warga')

@section('content')
<ul class="nav nav-pills mb-2">
    @foreach($pendidikan as $pendidik)
    <li class="nav-item">
        <a class="nav-link @if($loop->first) active @endif" id="{{ $pendidik->jenis_pendidikan }}-tab" data-bs-toggle="tab" href="#{{ $pendidik->jenis_pendidikan }}" role="tab" aria-controls="{{ $pendidik->jenis_pendidikan }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-penyakit-id="{{ $pendidik->id }}">
            <i class="fa-solid fa-user-graduate fa-lg" class="font-medium-3 me-50"></i>
            <span class="fw-@if($loop->first)bold @endif">{{ $pendidik->jenis_pendidikan }}</span>
        </a>
    </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($pendidikan as $pendidik)
    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $pendidik->jenis_pendidikan }}" role="tabpanel" aria-labelledby="{{ $pendidik->jenis_pendidikan }}-tab">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        Rekap Data - {{ $pendidik->jenis_pendidikan }}
                    </h5>
                    <a href="{{ route('pendidikan.print', $pendidik) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-print"></i>
                        Cetak - {{ $pendidik->jenis_pendidikan }}
                    </a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="dataTable table table-hover"style="width:100%" id="table_{{ $pendidik->jenis_pendidikan }}">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                        @if(Auth::check() && Auth::user()->level == 'admin' )
                            <tbody>
                                @foreach($pendidik->penduduk as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->nama_jalan }} , RT {{ $p->id_rt }} , RW {{ $p->rw->nama_rw }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif

                        @php
                            $nomor_iterasi_rw = 1;
                        @endphp
                        @if(Auth::check() && Auth::user()->level == 'RW' )
                            <tbody>
                                @foreach($pendidik->penduduk as $p)
                                    @if($p->id_rw == $id_rw)
                                    <tr>
                                        <td>{{ $nomor_iterasi_rw }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->nama_jalan }} , RT {{ $p->id_rt }} , RW {{ $p->rw->nama_rw }}</td>
                                    </tr>
                                    @php
                                        $nomor_iterasi_rw++;
                                    @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        @endif


                        @php
                            $nomor_iterasi_rt = 1;
                        @endphp
                        @if(Auth::check() && Auth::user()->level == 'RT' )
                            <tbody>
                                @foreach($pendidik->penduduk as $p)
                                    @if($p->id_rt == $id_rt)
                                    <tr>
                                        <td>{{ $nomor_iterasi_rt }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->nama_jalan }} , RT {{ $p->id_rt }} , RW {{ $p->rw->nama_rw }}</td>
                                    </tr>
                                    @php
                                        $nomor_iterasi_rt++;
                                    @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        @endif

                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
    @endforeach
</div>
@if(Auth::user()->level == 'admin' ||Auth::user()->level == 'RT')

<!-- Floating Toggle -->
<div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
    <button type="button" class="btn btn-primary rounded-pill btn-lg toggle-data" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
        <i class="bi bi-pencil-fill"></i>
    </button>
</div>

<!-- Modal Tambah Data Pendidikan -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="form-tambah-pendidikan" action="{{ route('pendidikan.store', '') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="NIK_penduduk" class="form-label">Penduduk :</label>
                        <select name="NIK_penduduk" id="NIK_penduduk" class="form-select choices">
                            @foreach ($list_penduduk as $penduduk)
                            <option value="{{ $penduduk->id }}">{{ $penduduk->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_pendidikan" class="form-label">Pendidikan Terakhir :</label>
                        <select name="id_pendidikan" id="id_pendidikan" class="form-select">
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
@endif

@endsection

@section('scripts')
<script>
    // Script jQuery
   // Script jQuery
$(document).ready(function () {
    // Loop through each table with an ID starting with "table_"
    $('table[id^="table_"]').each(function () {
        $(this).DataTable({ // Initialize DataTable for the current table

        });
    });
});


    $(document).ready(function() {
        // Fungsi untuk menyimpan id jenis pendidikan ke local storage
    function saveActiveJenisPendidikanId(jenisPendidikanId) {
        localStorage.setItem('activeJenisPendidikanId', jenisPendidikanId);
    }

    // Fungsi untuk mendapatkan id jenis pendidikan terakhir yang diakses dari local storage
    function getSavedActiveJenisPendidikanId() {
        return localStorage.getItem('activeJenisPendidikanId');
    }

    // Inisialisasi tab aktif
    var activeJenisPendidikanId = getSavedActiveJenisPendidikanId(); // Mendapatkan id jenis pendidikan terakhir yang diakses dari local storage
    if (activeJenisPendidikanId) {
        $('.nav-link[data-penyakit-id="' + activeJenisPendidikanId + '"]').tab('show'); // Menampilkan tab dengan id jenis pendidikan terakhir yang diakses
    }

        // Inisialisasi nilai penyakit pada load halaman pertama kali
        var initialPenyakit = $('.nav-link.active').data('penyakit-id'); // Mengambil data penyakit-id dari elemen nav-link aktif
        var namaPenyakit = $('.nav-link.active').text().trim();
        $('#id_pendidikan').html('<option value="' + initialPenyakit + '" selected>' + namaPenyakit + '</option>');

        $('.nav-link').on('click', function() {
            $('.nav-link span').removeClass('fw-bold');
            $(this).find('span').addClass('fw-bold');

            // Memperbarui pilihan pada dropdown "Penyakit"
            var penyakitId = $(this).data('penyakit-id'); // Mengambil data penyakit-id dari elemen nav-link yang di-klik
            var namaPenyakit = $(this).text().trim();
            $('#id_pendidikan').html('<option value="' + penyakitId + '" selected>' + namaPenyakit + '</option>');

            var jenisPendidikanId = $(this).data('penyakit-id');
        saveActiveJenisPendidikanId(jenisPendidikanId); // Menyimpan id jenis pendidikan ke local storage setiap kali tab diubah
        });

        $('#NIK_penduduk').on('change', function() {
            // Dapatkan nilai NIK_penduduk yang dipilih
            var selectedNIK = $(this).val();
            // Perbarui action atribut formulir dengan NIK yang dipilih
            $('#form-tambah-pendidikan').attr('action', '{{ route('pendidikan.store', '') }}/' + selectedNIK);
        });

        $('.print-button').on('click', function() {
            window.print();
        });
    });
    $(document).ready(function(){
            $('.choices').choices();
        });

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

