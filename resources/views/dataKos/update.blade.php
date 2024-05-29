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
                <h3>Data Kos</h3>
                <p class="text-subtitle text-muted">
                    Rekap data kos
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dataKos') }}">Data Kos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Update Data Kos
                        </li>
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

{{-- Start Form --}}
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Data Kos </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{ route('dataKos.update' , ['id' => $data_kos->id]) }}" data-parsley-validate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label for="nama_kos" class="form-label">Nama Kos</label>
                                        <input type="text" id="nama_kos" class="form-control" placeholder="Nama kos" name="nama_kos" value="{{ $data_kos->nama_kos ?? '' }}" data-parsley-required="true" />
                                    </div>
                                    <div class="form-group d-flex align-items-center">
                                        <input type="checkbox" id="enable-dropdown" class="form-check-input me-2" disabled> 
                                        <label for="enable-dropdown" class="form-label mb-0">Pemilik merupakan warga asli?</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group" id="nik-dropdown-container" style="display: none;" >
                                        <label for="NIK_pemilik_kos_asli" class="form-label">Pemilik kos</label>
                                        <select id="NIK_pemilik_kos_asli" name="NIK_pemilik_kos_asli" class="form-select" >
                                            @foreach ($list_penduduk as $penduduk)
                                                <option   value="{{ $penduduk->NIK }}" {{ $penduduk->NIK == $data_kos->NIK_pemilik_kos ? 'selected' : '' }} data-id-rt="{{ $penduduk->id_rt }}" data-no-hp="{{ $penduduk->no_hp }}" data-email="{{ $penduduk->email }}">{{ $penduduk->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label for="pemilik_kos" class="form-label">Pemilik</label>
                                        <input type="text" id="pemilik_kos" class="form-control" placeholder="Pemilik" name="pemilik_kos" value="{{ $data_kos->pemilik_kos ?? '' }}" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label for="NIK_pemilik_kos" class="form-label">NIK pemilik kos</label>
                                        <input type="text" id="NIK_pemilik_kos" class="form-control" placeholder="NIK_pemilik_kos" name="NIK_pemilik_kos"  value="{{ $data_kos->NIK_pemilik_kos ?? '' }}" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="alamat_kos" class="form-label">Alamat Kos</label>
                                        <input type="text" id="alamat_kos" class="form-control" name="alamat_kos" placeholder="Alamat kos" value="{{ $data_kos->alamat_kos ?? '' }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                        <label for="id_rt" class="form-label">RT</label>
                                        <div class="d-flex">
                                            <select id="id_rt" class="form-select me-2" name="id_rt" data-parsley-required="true" >
                                                <option disabled selected>Pilih RT</option>
                                                @foreach ($list_RT as $RT)
                                                    <option value="{{ $RT->id }}" {{ $RT->id == $data_kos->id_rt ? 'selected' : '' }}>{{ $RT->nama_rt }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="no_hp_pemilik" class="form-label">No HP Pemilik</label>
                                        <input type="text" id="no_hp_pemilik" class="form-control" placeholder="No HP Pemilik" name="no_hp_pemilik" value="{{ $data_kos->no_hp_pemilik ?? '' }}"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email_pemilik" class="form-label">Email pemilik</label>
                                        <input type="text" id="email_pemilik" class="form-control" placeholder="Email pemilik" name="email_pemilik" value="{{ $data_kos->email_pemilik ?? '' }}"/>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mandatory">
                                            <label for="foto_kos" class="form-label"><strong>foto KOS</strong></label>
                                            <input type="file" id="foto_kos" name="foto_kos" class="basic-filepond form-control">
                                        </div>
                                        <div >
                                            <label for="current_foto_kos" class="form-label"><strong>Foto KOS saat ini:</strong></label><br>
                                            @if ($data_kos->foto_kos)
                                                <img  style="width: 400px; height: 200px; text-align: center;" src="{{ asset('storage/' . $data_kos->foto_kos) }}" alt="Foto KOS">
                                            @else
                                                <span>Tidak ada foto KOS tersimpan.</span>
                                            @endif
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
{{-- End Form --}}
@endsection

@section('scripts')
{{-- JavaScript --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var checkbox = document.getElementById('enable-dropdown');
    var dropdownContainer = document.getElementById('nik-dropdown-container');
    var dropdown = document.getElementById('NIK_pemilik_kos_asli');
    var nikInput = document.getElementById('NIK_pemilik_kos');
    var pemilik = document.getElementById('pemilik_kos');
    var idRtInput = document.getElementById('id_rt');
    var noHpPemilikInput = document.getElementById('no_hp_pemilik');
    var emailPemilikInput = document.getElementById('email_pemilik');

    if ("{{ $pemilik_kos_asli }}") {
            checkbox.disabled;
            checkbox.checked = true;
            dropdownContainer.style.display = 'block';
            dropdown.setAttribute('disabled', 'true');
            nikInput.removeAttribute('required');
            nikInput.removeAttribute('data-parsley-required');
            pemilik.removeAttribute('required');
            pemilik.removeAttribute('data-parsley-required');
            nikInput.disabled = true;
            pemilik.disabled = true;
            dropdown.disabled = true;

            // Mendapatkan nilai id_rt, nomor HP, dan email dari dropdown NIK_pemilik_kos_asli yang dipilih
            var selectedOption = dropdown.options[dropdown.selectedIndex];
            var idRtAsli = selectedOption.getAttribute('data-id-rt');
            var noHpPemilik = selectedOption.getAttribute('data-no-hp');
            var emailPemilik = selectedOption.getAttribute('data-email');

            // idRtInput.value = idRtAsli;
            // noHpPemilikInput.value = noHpPemilik;
            // emailPemilikInput.value = emailPemilik;
    } else {
        dropdownContainer.style.display = 'none';
            dropdown.removeAttribute('required');
            dropdown.disabled = true;
            nikInput.disabled = true;
            pemilik.disabled = true;
            
    }

    checkbox.addEventListener('change', function() {
        if (this.checked) {
           
            dropdownContainer.style.display = 'block';
            dropdown.setAttribute('disabled', 'true');
            nikInput.removeAttribute('required');
            nikInput.removeAttribute('data-parsley-required');
            pemilik.removeAttribute('required');
            pemilik.removeAttribute('data-parsley-required');
            nikInput.disabled = true;
            pemilik.disabled = true;
            dropdown.disabled = true;

            // Mendapatkan nilai id_rt, nomor HP, dan email dari dropdown NIK_pemilik_kos_asli yang dipilih
            var selectedOption = dropdown.options[dropdown.selectedIndex];
            var idRtAsli = selectedOption.getAttribute('data-id-rt');
            var noHpPemilik = selectedOption.getAttribute('data-no-hp');
            var emailPemilik = selectedOption.getAttribute('data-email');

            // idRtInput.value = idRtAsli;
            // noHpPemilikInput.value = noHpPemilik;
            // emailPemilikInput.value = emailPemilik;
        } else {
            dropdownContainer.style.display = 'none';
            dropdown.removeAttribute('required');
            dropdown.disabled = true;
            
            nikInput.disabled = true;
            pemilik.disabled = true;
            
        }
    });

    // Menangani perubahan pada dropdown NIK_pemilik_kos_asli
    dropdown.addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var idRtAsli = selectedOption.getAttribute('data-id-rt');
        var noHpPemilik = selectedOption.getAttribute('data-no-hp');
        var emailPemilik = selectedOption.getAttribute('data-email');

        idRtInput.value = idRtAsli;
        noHpPemilikInput.value = noHpPemilik;
        emailPemilikInput.value = emailPemilik;
    });
});


</script>
@endsection