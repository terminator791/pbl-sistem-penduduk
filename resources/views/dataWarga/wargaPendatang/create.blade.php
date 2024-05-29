@extends('layouts.default-ui')

@section('heading')
<div id="user-info" style="position: absolute; top: 20px; right: 20px; display: flex; align-items: center; background-color: #435ebe; padding: 5px 10px; border-radius: 10px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
        <i class="fas fa-user" style="margin-right: 5px; font-size: 18px; color: white;"></i>
        <p style="margin: 0; font-size: 14px; color: white;">{{ Auth::user()->level }}, {{ Auth::user()->username }}</p>
</div>

<br>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Warga</h3>
                <p class="text-subtitle text-muted">
                    Rekap data warga pendatang
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Warga
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Warga Pendatang</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    {{-- Start Table --}}
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Warga Pendatang</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('wargaPendatang.store') }}" id="tambahDataForm" data-parsley-validate enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">NIK</label>
                                            <input type="text" id="NIK" class="form-control"
                                                placeholder="NIK" name="NIK" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Jenis Kelamin</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin" data-parsley-required="true">
                                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                                    <option value="wanita">Perempuan</option>
                                                    <option value="pria">Laki-laki</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Nama</label>
                                            <input type="text" id="nama" class="form-control"
                                                placeholder="Nama" name="nama" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group ">
                                            <label for="last-name-column" class="form-label">Agama</label>
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
                                    <div class="col-md-6 col-12">
                                        <div class="form-group ">
                                            <label for="first-name-column" class="form-label">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" class="form-control"
                                                placeholder="Tempat Lahir" name="tempat_lahir"
                                                />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Pendidikan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_pendidikan" name="id_pendidikan">
                                                    <option disabled selected>Pilih Pendidikan</option>
                                                    @foreach ($list_pendidikan as $pendidikan)
                                                        <option value="{{ $pendidikan->id }}">{{ $pendidikan->jenis_pendidikan }}</option> <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating" class="form-label">Tanggal Lahir</label>
                                            <input type="date" id="tanggal_lahir" class="form-control" name="tanggal_lahir">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Pekerjaan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select select2" id="id_pekerjaan" name="id_pekerjaan">
                                                    <option disabled selected>Pilih Pekerjaan</option>
                                                    @foreach ($list_pekerjaan as $pekerjaan)
                                                        <option value="{{ $pekerjaan->id }}">{{ $pekerjaan->jenis_pekerjaan }}</option> <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Status Hubungan
                                                Keluarga</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_keluarga" name="id_keluarga">
                                                    <option disabled selected>Pilih Hubungan Keluarga</option>
                                                    @foreach ($list_keluarga as $keluarga)
                                                        <option value="{{ $keluarga->id }}">{{ $keluarga->status_keluarga }}</option> <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Status Perkawinan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_status_perkawinan" name="id_status_perkawinan">
                                                    <option disabled selected>Pilih Status Perkawinan</option>
                                                        @foreach ($list_perkawinan as $perkawinan)
                                                            <option value="{{ $perkawinan->id }}">{{ $perkawinan->status_perkawinan }}</option> <!-- Use actual database values -->
                                                        @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Status Tinggal</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="status_penghuni" name="status_penghuni" data-parsley-required="true">
                                                    <option disabled selected>Pilih Status Tinggal</option>
                                                    <option value="kos">Kos</option>
                                                    <option value="kontrak">Kontrak</option>
                
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column" class="form-label">Nama Kos/Kontrak</label>
                                            <fieldset class="form-group">
                                                <select class="form-select" id="id_kos" name="id_kos">
                                                    <option disabled selected>Nama Kos/Kontrak</option>
                                                        @foreach ($list_kos as $kos)
                                                    
                                                            <option value="{{ $kos->id }}">{{ $kos->nama_kos }}</option> <!-- Use actual database values -->
                                                        @endforeach
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">Tanggal Masuk</label>
                                            <input type="date" id="tanggal_masuk" class="form-control" name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating" class="form-label">Tanggal Keluar</label>
                                            <input type="date" id="tanggal_keluar" class="form-control" name="tanggal_keluar">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="rt-dropdown" class="form-label">RT / RW</label>
                                            <div class="d-flex">
                                                <select id="id_rt" class="form-select me-2" name="id_rt"
                                                    data-parsley-required="true">
                                                    <option disabled selected>Pilih RT</option>
                                                    @foreach ($list_RT as $RT)
                                                        <option value="{{ $RT->id }}" @if (Auth::user()->level =="RT")
                                                         selected
                                                        @endif>{{ $RT->nama_rt }}</option> <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                                <select id="id_rw" class="form-select" name="id_rw"
                                                    data-parsley-required="true">
                                                    <option disabled selected>Pilih RW</option>
                                                    @foreach ($list_RW as $RW)
                                                        <option value="{{ $RW->id }}" @if (Auth::user()->level =="RT" || Auth::user()->level =="RW")
                                                         selected
                                                        @endif>{{ $RW->nama_rw }}</option> <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group ">
                                            <label for="first-name-column" class="form-label">Nomor HP</label>
                                            <input type="text" id="no_hp" class="form-control"
                                                placeholder="Nomor HP" name="no_hp"
                                                 />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column" class="form-label">Email</label>
                                            <input type="text" id="email" class="form-control"
                                                placeholder="Email" name="email" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column" class="form-label">File KTP</label>
                                            <input type="file"  id="foto_ktp" name="foto_ktp" class="basic-filepond form-control">
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
        $(document).ready(function () {
    // Ketika nilai pada form id_kos berubah
    $('#id_kos').on('change', function() {
        // Jika nilai id_kos tidak kosong
        if ($(this).val()) {
            // Aktifkan input tanggal_masuk dan buat wajib diisi
            $('#tanggal_masuk').prop('required', true).removeAttr('disabled');
        } else {
            // Jika nilai id_kos kosong, nonaktifkan input tanggal_masuk dan hapus kewajiban
            $('#tanggal_masuk').prop('required', false).attr('disabled', 'disabled').val('');
        }
    });
  
});

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
                window.location.href = "{{ route('wargaPendatang.create') }}";
            });
        });

        function resetForm() {
            var form = document.querySelector('form');
            form.reset();
        }
        $(document).ready(function(){
            $('.select2').select2();
        });
    </script>
@endsection
