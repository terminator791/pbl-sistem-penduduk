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
                                                placeholder="NIK" name="fname-column" data-parsley-required="true"
                                                value="1234567890123456" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Jenis Kelamin</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                                    <option selected>Laki-laki</option>
                                                    <option>Perempuan</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Nama</label>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="Nama" name="lname-column" data-parsley-required="true"
                                                value="John Doe" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Agama</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Agama</option>
                                                    <option selected>Islam</option>
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
                                                placeholder="Tempat Lahir" name="fname-column" data-parsley-required="true"
                                                value="Jakarta" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Pendidikan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option disabled selected>Pilih Pendidikan</option>
                                                    <option selected>SD</option>
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
                                            <input type="date" class="form-control" value="1990-01-01">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Pekerjaan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="basicSelect">
                                                    <option selected>Mengurus Rumah Tangga</option>
                                                    <option>Pelajar/Mahasiswa</option>
                                                    <!-- Other options -->
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
                                                    <option selected>Kepala keluarga</option>
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
                                                    <option selected>Kawin</option>
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
                                                    <option selected>Kos</option>
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
                                                data-parsley-required="true" value="Jalan Raya" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="rt-dropdown" class="form-label">RT / RW</label>
                                            <div class="d-flex">
                                                <select id="rt-dropdown" class="form-select me-2"
                                                    data-parsley-required="true">
                                                    <option value="rt1">RT 01</option>
                                                    <option value="rt2">RT 02</option>
                                                </select>
                                                <select id="rw-dropdown" class="form-select"
                                                    data-parsley-required="true">
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
                                                placeholder="Nomor HP" name="fname-column" data-parsley-required="true"
                                                value="081234567890" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Email</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="Email" name="fname-column" data-parsley-required="true"
                                                value="example@example.com" />
                                        </div>
                                    </div>
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
