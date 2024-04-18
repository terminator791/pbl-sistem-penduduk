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
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Warga Asli</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('wargaAsli.store') }}"
                                data-parsley-validate>
                                @csrf
                                <div class="row">
                                    <!-- Kolom 1 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="NIK" class="form-label"><strong>NIK</strong></label>
                                            <input type="text" id="NIK" class="form-control" placeholder="NIK"
                                                name="NIK" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <!-- Kolom 2 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="jenis_kelamin" class="form-label"><strong>Jenis
                                                    Kelamin</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                                    <option value="wanita">Perempuan</option>
                                                    <option value="pria">Laki-laki</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 3 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama" class="form-label"><strong>Nama</strong></label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama"
                                                name="nama" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <!-- Kolom 4 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="agama" class="form-label"><strong>Agama</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="agama" name="agama">
                                                    <option disabled selected>Pilih Agama</option>
                                                    <option value="islam">Islam</option>
                                                    <option value="katolik">Katholik</option>
                                                    <option value="kristen">Kristen</option>
                                                    <option value="hindhu">Hindu</option>
                                                    <option value="Budha">Buddha</option>
                                                    <option value="konghucu">Konghuchu</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 5 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="tempat_lahir" class="form-label"><strong>Tempat
                                                    Lahir</strong></label>
                                            <input type="text" id="tempat_lahir" class="form-control"
                                                placeholder="Tempat Lahir" name="tempat_lahir"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <!-- Kolom 6 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_pendidikan"
                                                class="form-label"><strong>Pendidikan</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_pendidikan" name="id_pendidikan">
                                                    <option disabled selected>Pilih Pendidikan</option>
                                                    @foreach ($list_pendidikan as $pendidikan)
                                                        <option value="{{ $pendidikan->id }}">
                                                            {{ $pendidikan->jenis_pendidikan }}</option>
                                                        <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 7 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="tanggal_lahir" class="form-label"><strong>Tanggal
                                                    Lahir</strong></label>
                                            <input type="date" id="tanggal_lahir" class="form-control"
                                                name="tanggal_lahir">
                                        </div>
                                    </div>
                                    <!-- Kolom 8 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_pekerjaan" class="form-label"><strong>Pekerjaan</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_pekerjaan" name="id_pekerjaan">
                                                    <option disabled selected>Pilih Pekerjaan</option>
                                                    @foreach ($list_pekerjaan as $pekerjaan)
                                                        <option value="{{ $pekerjaan->id }}">
                                                            {{ $pekerjaan->jenis_pekerjaan }}</option>
                                                        <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 9 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_keluarga" class="form-label"><strong>Status Hubungan
                                                    Keluarga</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_keluarga" name="id_keluarga">
                                                    <option disabled selected>Pilih Hubungan Keluarga</option>
                                                    @foreach ($list_keluarga as $keluarga)
                                                        <option value="{{ $keluarga->id }}">
                                                            {{ $keluarga->status_keluarga }}</option>
                                                        <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 10 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_status_perkawinan" class="form-label"><strong>Status
                                                    Perkawinan</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_status_perkawinan"
                                                    name="id_status_perkawinan">
                                                    <option disabled selected>Pilih Status Perkawinan</option>
                                                    @foreach ($list_perkawinan as $perkawinan)
                                                        <option value="{{ $perkawinan->id }}">
                                                            {{ $perkawinan->status_perkawinan }}</option>
                                                        <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 11 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="status_penghuni" class="form-label"><strong>Status
                                                    Tinggal</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="status_penghuni" name="status_penghuni">
                                                    <option disabled selected>Pilih Status Tinggal</option>
                                                    <option value="tetap">Tetap</option>
                                                    <option value="pindah">Pindah</option>
                                                    <option value="meninggal">Meninggal</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 12 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_jalan" class="form-label"><strong>Nama Jalan</strong></label>
                                            <input type="text" id="nama_jalan" class="form-control"
                                                placeholder="Alamat Rumah" name="nama_jalan"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <!-- Kolom 13 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_rt" class="form-label"><strong>RT / RW</strong></label>
                                            <div class="d-flex">
                                                <select id="id_rt" class="form-select me-2" name="id_rt"
                                                    data-parsley-required="true">
                                                    <option disabled selected>Pilih RT</option>
                                                    @foreach ($list_RT as $RT)
                                                        <option value="{{ $RT->id }}">{{ $RT->nama_rt }}</option>
                                                        <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                                <select id="id_rw" class="form-select" name="id_rw"
                                                    data-parsley-required="true">
                                                    <option disabled selected>Pilih RW</option>
                                                    @foreach ($list_RW as $RW)
                                                        <option value="{{ $RW->id }}">{{ $RW->nama_rw }}</option>
                                                        <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Kolom 14 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="no_hp" class="form-label"><strong>Nomor HP</strong></label>
                                            <input type="text" id="no_hp" class="form-control"
                                                placeholder="Nomor HP" name="no_hp" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <!-- Kolom 15 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="email" class="form-label"><strong>Email</strong></label>
                                            <input type="text" id="email" class="form-control"
                                                placeholder="Email" name="email" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <!-- Kolom 16 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="foto_ktp" class="form-label"><strong>File KTP</strong></label>
                                            <input type="file" id="foto_ktp" name="foto_ktp"
                                                class="basic-filepond form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="button" onclick="tambah_warga()" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Table --}}
@endsection

@section('scripts')
<script>
    function tambah_warga() {
        // Mendapatkan referensi ke elemen formulir
        const form = document.querySelector('.form');

        // Membuat objek FormData dari formulir
        const formData = new FormData(form);

        // Mengirimkan permintaan POST ke API menggunakan fetch API
        fetch("{{ route('wargaAsli.store') }}", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('API Post gagal');
            }
            // Jika sukses, lakukan redirect atau tindakan lainnya
            alert('Data berhasil ditambahkan');
            // Redirect ke halaman lain, jika perlu
            window.location.href = "{{ route('wargaAsli') }}";
        })
        .catch(error => {
            console.error(error);
            alert('Terjadi kesalahan saat mengirim data.');
        });
    }
</script>

@endsection