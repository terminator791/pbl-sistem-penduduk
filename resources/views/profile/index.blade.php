@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                 @if (Auth::user()->level == 'admin')
                    <h3>Profile Admin</h3>
                @elseif (Auth::user()->level == 'RW')
                    <h3>Profile RW 13, {{$username}}</h3>
                @elseif(Auth::user()->level == 'RT')
                    <h3>Profile RW 13 RT {{ $id_rt}}, {{$username}}</h3>
                @elseif(Auth::user()->level == 'pemilik_kos')
                    <h3>Profile {{$username}}</h3>
                @endif
                <p class="text-subtitle text-muted">
                    Kec.Candisari, Kel.Tegalsari, RW 13
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
                            <form class="form" method="POST" action="{{ route('profile.update') }}" data-parsley-validate enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mandatory">
                                            <label for="first-name-column" class="form-label">NIK</label>
                                            <input type="text" id="NIK_penduduk" class="form-control"
                                                   placeholder="NIK" value="{{ $NIK }}" name="NIK_penduduk" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group ">
                                            <label for="last-name-column" class="form-label">Nama</label>
                                            <input type="text" id="nama" class="form-control"
                                                   placeholder="nama" value="{{$nama}}" name="nama" data-parsley-required="true" disabled/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">User Name</label>
                                            <input type="text" id="username" class="form-control"
                                                   name="username" placeholder="RT" value="{{$username}}" data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RT' ||  Auth::user()->level == 'RW')
                                        <div class="form-group mandatory">
                                            <label for="tanggal_dilantik" class="form-label" name="tanggal_dilantik" value="04/11/2000">Tanggal Mulai Menjabat</label>
                                            <input type="date" id="tanggal_dilantik" class="form-control"
                                                    name="tanggal_dilantik" data-parsley-required="true" />
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RW')
                                            <div class="form-group ">
                                                <label for="country-floating" class="form-label">No Hp</label>
                                                <input type="text" id="no_hp" class="form-control"
                                                    name="country-floating" placeholder="no_hp" value="{{$no_hp}}" data-parsley-required="true" disabled/>
                                            </div>
                                                @endif
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group ">
                                                <label for="country-floating" class="form-label">Email</label>
                                                <input type="text" id="email" class="form-control"
                                                    name="country-floating" placeholder="email" value="{{$email}}" data-parsley-required="true" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RW')
                                            <div class="form-group mandatory">
                                                    <label for="rt" class="form-label">RT</label>
                                                    <input type="text" id="Nama" class="form-control"
                                                    placeholder="Nama" value="{{$id_rt}}" name="lname-column" data-parsley-required="true" disabled/>
                                            </div>
                                                @endif
                                        </div>
                                        <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">Role</label>
                                            <input type="text" id="level" class="form-control" name="level" placeholder="email"
                                                value="{{ ($jabatan == 'RT' || $jabatan == 'RW') ? 'Ketua ' . $jabatan : $jabatan }}"
                                                data-parsley-required="true" readOnly />
                                        </div>


                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1"><strong>Update Profil</strong></button>
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
   

    @if(session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 4000,
            position: 'center',
            backgroundColor: 'green'
        }).showToast();
        </script>
    @endif

    @if(session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 4000,
            position: 'center',
            backgroundColor: 'red'
        }).showToast();
        </script>
    @endif

        
@endsection
