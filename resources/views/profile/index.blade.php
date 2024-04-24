@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Profile</h3>
                <p class="text-subtitle text-muted">
                    Kec.Tembalang,Kel.Pedalangan.RT.12 RW.05
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Profile
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
                        <h4 class="card-title">Profile</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" data-parsley-validate>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">NIK</label>
                                            <input type="text" id="NIK" class="form-control"
                                                   placeholder="NIK" name="fname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">Nama</label>
                                            <input type="text" id="Nama" class="form-control"
                                                   placeholder="Nama" name="lname-column" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">User Name</label>
                                            <input type="text" id="Username" class="form-control"
                                                   name="country-floating" placeholder="User Name" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RT' ||  Auth::user()->level == 'RW')
                                        <div class="form-group mandatory">
                                            <label for="tanggal-menjabat" class="form-label">Tanggal Mulai Menjabat</label>
                                            <input type="date" id="tanggal-menjabat" class="form-control"
                                                    name="tanggal-menjabat" class="form-control">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RW')
                                        <div class="form-group mandatory">
                                                <label for="rt" class="form-label">RT</label>
                                                <select class="form-control" id="level">
                                                    @foreach()
                                                    <option>--</option>
                                                    //ini diisi oleh daftar rt yang ada
                                                    @endforeach
                                                </select>      
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="level" class="form-label">Jabatan</label>
                                                <select class="form-control" id="level">
                                                    @if(Auth::user()->level == 'admin')
                                                    <option>RW</option>
                                                    @endif
                                                    @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RW')
                                                    <option>RT</option>
                                                    @endif
                                                    @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RT')
                                                    <option>Pemilik Kos</option>                               
                                                    @endif   
                                                </select>      
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <a href='{{ route('profile.create') }}' type="submit"
                                               class="btn btn-primary me-1 mb-1">
                                                Tambah Pengurus
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
