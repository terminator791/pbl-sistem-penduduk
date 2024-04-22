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
                            <form class="form" method="POST" 
                                action="{{ route('wargaAsli.update', ['id' => $penduduk->id]) }}"  data-parsley-validate enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Kolom 1 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="NIK" class="form-label"><strong>NIK</strong></label>
                                            <input type="text" id="NIK" class="form-control" placeholder="NIK"
                                                name="NIK" data-parsley-required="true" value="{{ $penduduk->NIK }}" />
                                        </div>
                                    </div>
                                    <!-- Kolom 2 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="jenis_kelamin" class="form-label"><strong>Jenis
                                                    Kelamin</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                    <option disabled>Pilih Jenis Kelamin</option>
                                                    <option value="pria"
                                                        {{ $penduduk->jenis_kelamin == 'pria' ? 'selected' : '' }}>Laki-laki
                                                    </option>
                                                    <option value="wanita"
                                                        {{ $penduduk->jenis_kelamin == 'wanita' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 3 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama" class="form-label"><strong>Nama</strong></label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama"
                                                name="nama" data-parsley-required="true" value="{{ $penduduk->nama }}" />
                                        </div>
                                    </div>
                                    <!-- Kolom 4 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="agama" class="form-label"><strong>Agama</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="agama" name="agama">
                                                    <option disabled selected>Pilih Agama</option>
                                                    <option value="islam"
                                                        {{ $penduduk->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                                    <option value="katolik"
                                                        {{ $penduduk->agama == 'katolik' ? 'selected' : '' }}>Katholik
                                                    </option>
                                                    <option value="kristen"
                                                        {{ $penduduk->agama == 'kristen' ? 'selected' : '' }}>Kristen
                                                    </option>
                                                    <option value="hindhu"
                                                        {{ $penduduk->agama == 'hindhu' ? 'selected' : '' }}>Hindu</option>
                                                    <option value="Budha"
                                                        {{ $penduduk->agama == 'Budha' ? 'selected' : '' }}>Buddha</option>
                                                    <option value="konghucu"
                                                        {{ $penduduk->agama == 'konghucu' ? 'selected' : '' }}>Konghuchu
                                                    </option>
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
                                                placeholder="Tempat Lahir" name="tempat_lahir" data-parsley-required="true"
                                                value="{{ $penduduk->tempat_lahir }}" />
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
                                                        <option value="{{ $pendidikan->id }}"
                                                            {{ $penduduk->id_pendidikan == $pendidikan->id ? 'selected' : '' }}>
                                                            {{ $pendidikan->jenis_pendidikan }}
                                                        </option>
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
                                                name="tanggal_lahir" value="{{ $penduduk->tanggal_lahir }}">
                                        </div>
                                    </div>
                                    <!-- Kolom 8 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="id_pekerjaan"
                                                class="form-label"><strong>Pekerjaan</strong></label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_pekerjaan" name="id_pekerjaan">
                                                    <option disabled selected>Pilih Pekerjaan</option>
                                                    @foreach ($list_pekerjaan as $pekerjaan)
                                                        <option value="{{ $pekerjaan->id }}"
                                                            {{ $penduduk->id_pekerjaan == $pekerjaan->id ? 'selected' : '' }}>
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
                                                        <option value="{{ $keluarga->id }}"
                                                            {{ $penduduk->id_keluarga == $keluarga->id ? 'selected' : '' }}>
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
                                                        <option value="{{ $perkawinan->id }}"
                                                            {{ $penduduk->id_status_perkawinan == $perkawinan->id ? 'selected' : '' }}>
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

                                                    <option value="tetap"
                                                        {{ $penduduk->status_penghuni == 'tetap' ? 'selected' : '' }}>Tetap
                                                    </option>
                                                    <option value="pindah"
                                                        {{ $penduduk->status_penghuni == 'pindah' ? 'selected' : '' }}>
                                                        Pindah</option>
                                                    <option value="meninggal"
                                                        {{ $penduduk->status_penghuni == 'meninggal' ? 'selected' : '' }}>
                                                        Meninggal</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <!-- Kolom 12 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_jalan" class="form-label"><strong>Nama Jalan</strong></label>
                                            <input type="text" id="nama_jalan" class="form-control"
                                                placeholder="Alamat Rumah" name="nama_jalan" data-parsley-required="true"
                                                value="{{ $penduduk->nama_jalan }}" />
                                        </div>
                                    </div>
                                    <!-- Kolom 13 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="rt-dropdown" class="form-label"><strong>RT / RW</strong></label>
                                            <div class="d-flex">
                                                <select id="id_rt" class="form-select me-2" name="id_rt"
                                                    data-parsley-required="true">
                                                    <option disabled selected>Pilih RT</option>
                                                    @foreach ($list_RT as $RT)
                                                        <option value="{{ $RT->id }}"
                                                            {{ $penduduk->id_rt == $RT->id ? 'selected' : '' }}>
                                                            {{ $RT->nama_rt }}</option>
                                                        <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                                <select id="id_rw" class="form-select" name="id_rw"
                                                    data-parsley-required="true">
                                                    <option visabled selected>Pilih RW</option>
                                                    @foreach ($list_RW as $RW)
                                                        <option value="{{ $RW->id }}"
                                                            {{ $penduduk->id_rw == $RW->id ? 'selected' : '' }}>
                                                            {{ $RW->nama_rw }}</option>
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
                                                placeholder="Nomor HP" name="no_hp" data-parsley-required="true"
                                                value="{{ $penduduk->no_hp }}" />
                                        </div>
                                    </div>
                                    <!-- Kolom 15 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="email" class="form-label"><strong>Email</strong></label>
                                            <input type="text" id="email" class="form-control"
                                                placeholder="Email" name="email" data-parsley-required="true"
                                                value="{{ $penduduk->email }}" />
                                        </div>
                                    </div>
                                    <!-- Kolom 16 -->
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="foto_ktp" class="form-label"><strong>File KTP</strong></label>
                                            <input type="file" id="foto_ktp" name="foto_ktp" class="basic-filepond form-control">
                                        </div>
                                        <div>
                                            <label for="current_foto_ktp" class="form-label"><strong>Foto KTP saat ini:</strong></label><br>
                                            @if ($penduduk->foto_ktp)
                                                <img src="{{ asset('storage/' . $penduduk->foto_ktp) }}" alt="Foto KTP">
                                            @else
                                                <span>Tidak ada foto KTP tersimpan.</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1"><strong>Submit</strong></button>
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
        // document.addEventListener("DOMContentLoaded", function() {
        //     var birthdateInput = document.getElementById("birthdate");
        //     birthdateInput.addEventListener("change", function() {
        //         var selectedDate = new Date(birthdateInput.value);
        //         var formattedDate = selectedDate.getDate() + "/" + (selectedDate.getMonth() + 1) + "/" +
        //             selectedDate.getFullYear();
        //         birthdateInput.value = formattedDate;
        //     });
        // });

        document.addEventListener("DOMContentLoaded", function() {
            var resetButton = document.querySelector('button[type="reset"]');
            resetButton.addEventListener('click', function() {
                resetForm();
            });
        });

        function resetForm() {
            var form = document.querySelector('form');
            form.reset();
        }
    </script>
@endsection
