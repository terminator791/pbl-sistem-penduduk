@extends('layouts.default-ui')

@section('heading')
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
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
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
    {{-- Start Table --}}
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Warga Pendatang</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" data-parsley-validate>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="NIK" class="form-label">NIK</label>
                                            <input type="text" id="NIK" class="form-control" placeholder="NIK"
                                                name="NIK" data-parsley-required="true" value="{{ $penduduk->NIK }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" id="nama" class="form-control" placeholder="Nama"
                                                name="nama" data-parsley-required="true" value="{{ $penduduk->nama }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama_kos" class="form-label">Kos</label>
                                            <input type="text" id="nama_kos" class="form-control" name="nama_kos"
                                                placeholder="Nama Kos" data-parsley-required="true"
                                                value="{{ $penduduk->nama_jalan }}" /> {{-- gANTI GET NAMA KOS --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <a href='{{ route('wargaPendatang') }}' type="submit"
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
    {{--  --}}
@endsection
