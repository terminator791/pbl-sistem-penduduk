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
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
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
                            <form class="form" data-parsley-validate>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">NIK</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="NIK" name="fname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Jenis Kelamin</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                                    <option>Perempuan</option>
                                                    <option>Laki-laki</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Nama</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Nama" name="lname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Agama</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Agama</option>
                                                    <option>Islam</option>
                                                    <option>Katholik</option>
                                                    <option>Kristen</option>
                                                    <option>Hindu</option>
                                                    <option>Buddha</option>
                                                    <option>Konghuchu</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Tempat Lahir</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Tempat Lahir" name="fname-column"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Pendidikan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Pendidikan</option>
                                                    <option>SD</option>
                                                    <option>SLTP/SMP</option>
                                                    <option>SLTA/SMA/SMK/MA</option>
                                                    <option>S1</option>
                                                    <option>S2</option>
                                                    <option>S3</option>
                                                    <option>D1</option>
                                                    <option>D2</option>
                                                    <option>D3</option>
                                                    <option>D4</option>
                                                    <option>Tidak Sekolah</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Pekerjaan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option>Pilih Pekerjaan</option>
                                                    <option>Mengurus Rumah Tangga</option>
                                                    <option>Pelajar/Mahasiswa</option>
                                                    <option>Belum/Tidak Bekerja</option>
                                                    <option>Pensiunan</option>
                                                    <option>Pegawai Negeri Sipil</option>
                                                    <option>Tentara Nasional Indonesia</option>
                                                    <option>Perdagangan</option>
                                                    <option>Petani/Pekebun</option>
                                                    <option>Peternak</option>
                                                    <option>Nelayan/Perikanan</option>
                                                    <option>Industri</option>
                                                    <option>Konstruksi</option>
                                                    <option>Transportasi</option>
                                                    <option>Karyawan Swasta</option>
                                                    <option>Karyawan Honorer</option>
                                                    <option>Buruh Harian Lepas</option>
                                                    <option>Buruh Tani/Perkebunan</option>
                                                    <option>Buruh Nelayan/Perikanan</option>
                                                    <option>Buruh Peternakan</option>
                                                    <option>Pembantu Rumah Tangga</option>
                                                    <option>Tukang Cukur</option>
                                                    <option>Tukang Listrik</option>
                                                    <option>Tukang Batu</option>
                                                    <option>Tukang Kayu</option>
                                                    <option>Tukang Sol Sepatu</option>
                                                    <option>Tukang Las/Pandai Besi</option>
                                                    <option>Tukang Jahit</option>
                                                    <option>Tukang Gigi</option>
                                                    <option>Penata Rias</option>
                                                    <option>Penata Busana</option>
                                                    <option>Penata Rambut</option>
                                                    <option>Mekanik</option>
                                                    <option>Seniman</option>
                                                    <option>Tabib</option>
                                                    <option>Paraji</option>
                                                    <option>Perancang Busana</option>
                                                    <option>Penterjemah</option>
                                                    <option>Imam Mesjid</option>
                                                    <option>Pendeta</option>
                                                    <option>Pastor</option>
                                                    <option>Wartawan</option>
                                                    <option>Ustadz/Mubaligh</option>
                                                    <option>Juru Masak</option>
                                                    <option>Promotor Acara</option>
                                                    <option>Anggota DPR-RI</option>
                                                    <option>Anggota DPD</option>
                                                    <option>Anggota BPK</option>
                                                    <option>Presiden</option>
                                                    <option>Wakil Presiden</option>
                                                    <option>Anggota Mahkamah Konstitusi</option>
                                                    <option>Anggota Kabinet/Kementerian</option>
                                                    <option>Duta Besar</option>
                                                    <option>Gubernur</option>
                                                    <option>Wakil Gubernur</option>
                                                    <option>Bupati</option>
                                                    <option>Wakil Bupati</option>
                                                    <option>Walikota</option>
                                                    <option>Wakil Walikota</option>
                                                    <option>Anggota DPRD Provinsi</option>
                                                    <option>Anggota DPRD Kabupaten/Kota</option>
                                                    <option>Dosen</option>
                                                    <option>Guru</option>
                                                    <option>Pilot</option>
                                                    <option>Pengacara</option>
                                                    <option>Notaris</option>
                                                    <option>Arsitek</option>
                                                    <option>Akuntan</option>
                                                    <option>Konsultan</option>
                                                    <option>Dokter</option>
                                                    <option>Bidan</option>
                                                    <option>Perawat</option>
                                                    <option>Apoteker</option>
                                                    <option>Psikiater/Psikolog</option>
                                                    <option>Penyiar Televisi</option>
                                                    <option>Penyiar Radio</option>
                                                    <option>Pelaut</option>
                                                    <option>Peneliti</option>
                                                    <option>Sopir</option>
                                                    <option>Pialang</option>
                                                    <option>Paranormal</option>
                                                    <option>Kepala Desa</option>
                                                    <option>Biarawati</option>
                                                    <option>Wiraswasta</option>
                                                    <option>Lain-lain</option>
                                                    <option>Polri</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Status Hubungan
                                                Keluarga</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Hubungan Keluarga</option>
                                                    <option>Kepala keluarga</option>
                                                    <option>Ibu</option>
                                                    <option>Anak</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Status Perkawinan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Status Perkawinan</option>
                                                    <option>Kawin</option>
                                                    <option>Belum Kawin</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Status Tinggal</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Status Tinggal</option>
                                                    <option>Kos</option>
                                                    <option>Kontrak</option>
                                                    <option>Tetap</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Nama Jalan</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Alamat Rumah" name="fname-column"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="rt-dropdown" class="form-label">RT / RW</label>
                                            <div class="d-flex">
                                                <select id="rt-dropdown" class="form-select me-2"
                                                    data-parsley-required="true">
                                                    <option value="">Pilih RT</option>
                                                    <option value="rt1">RT 01</option>
                                                    <option value="rt2">RT 02</option>
                                                </select>
                                                <select id="rw-dropdown" class="form-select"
                                                    data-parsley-required="true">
                                                    <option value="">Pilih RW</option>
                                                    <option value="rw1">RW 01</option>
                                                    <option value="rw2">RW 02</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Nomor HP</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Nomor HP" name="fname-column"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Email</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Email" name="fname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">File KTP</label>
                                            <input type="file" class="basic-filepond form-control">
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <a href='{{ route('wargaAsli') }}' type="submit"
                                                class="btn btn-primary me-1 mb-1">
                                                Submit
                                            </a>
                                            <a type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                Reset
                                            </a>
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
        document.addEventListener("DOMContentLoaded", function() {
            var birthdateInput = document.getElementById("birthdate");
            birthdateInput.addEventListener("change", function() {
                var selectedDate = new Date(birthdateInput.value);
                var formattedDate = selectedDate.getDate() + "/" + (selectedDate.getMonth() + 1) + "/" +
                    selectedDate.getFullYear();
                birthdateInput.value = formattedDate;
            });
        });
    </script>
@endsection
