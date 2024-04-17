@extends('layouts.default-ui')

@section('heading')
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
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data Kos
                        </li>
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
                        <h4 class="card-title">Tambah Data Bangunan Kos</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('dataKos.store') }}" data-parsley-validate>
                            @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">Nama Kos</label>
                                            <input type="text" id="nama_kos" class="form-control"
                                                placeholder="Nama kos" name="nama_kos" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Pemilik</label>
                                            <input type="text" id="pemilik_kos" class="form-control"
                                                placeholder="Pemilik" name="pemilik_kos" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="city-column" class="form-label">Jumlah Penghuni</label>
                                            <input type="text" id="jumlah_penghuni" class="form-control"
                                                placeholder="Jumlah penghuni" name="jumlah_penghuni" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">Alamat Kos</label>
                                            <input type="text" id="alamat_kos" class="form-control"
                                                name="alamat_kos" placeholder="Alamat kos"
                                                data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="rt-dropdown" class="form-label">RT</label>
                                            <div class="d-flex">
                                                <select id="id_rt" class="form-select me-2" name="id_rt"
                                                    data-parsley-required="true">
                                                    <option disabled selected>Pilih RT</option>
                                                    @foreach ($list_RT as $RT)
                                                        <option value="{{ $RT->id }}">{{ $RT->nama_rt }}</option> <!-- Use actual database values -->
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="city-column" class="form-label">No HP Pemilik</label>
                                            <input type="text" id="no_hp_pemilik" class="form-control"
                                                placeholder="No HP Pemilik" name="no_hp_pemilik" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="city-column" class="form-label">Email pemilik</label>
                                            <input type="text" id="email_pemilik" class="form-control"
                                                placeholder="Email pemilik" name="email_pemilik"/>
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
    {{--  --}}
@endsection
