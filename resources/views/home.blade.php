@extends('layouts.default-ui')

@section('heading')
    <h3>Beranda</h3>
@endsection

@section('content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12 col-lg-6 col-md-12"> 
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start align-items-center">
                                    <div class="stats-icon purple mb-2">
                                        <i class="bi-people-fill"></i>
                                    </div>
                                    <div class="mr-2">
                                        <a href="{{ route('wargaAsli') }}" class="text-decoration-none">
                                            <h6 class="text-muted font-semibold" style="margin: 0 auto;">Data Warga</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12"> 
                    <div class="card"> 
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start align-items-center"> 
                                    <div class="stats-icon blue mb-2">
                                        <i class="bi-journal-richtext"></i>
                                    </div>
                                    <div class="mr-2"> 
                                        <a href="{{ route('kesehatan') }}" class="text-decoration-none">
                                            <h6 class="text-muted font-semibold" style="margin: 0 auto;">Data Umum</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start align-items-center">
                                    <div class="stats-icon green mb-2">
                                        <i class="bi-house-fill"></i>
                                    </div>
                                    <div class="mr-2">
                                        <a href="{{ route('dataKos') }}" class="text-decoration-none">
                                            <h6 class="text-muted font-semibold" style="margin: 0 auto;">Data Kos</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start align-items-center">
                                    <div class="stats-icon red mb-2 mr-2"> 
                                        <i class="bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted font-semibold">Profil</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">John Duck</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
                <div class="card-header">
                    <h4>Recent Messages</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('dist/assets/compiled/jpg/4.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Hank Schrader</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('dist/assets/compiled/jpg/5.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Dean Winchester</h5>
                            <h6 class="text-muted mb-0">@imdean</h6>
                        </div>
                    </div>
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{ asset('dist/assets/compiled/jpg/1.jpg') }}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">John Dodol</h5>
                            <h6 class="text-muted mb-0">@dodoljohn</h6>
                        </div>
                    </div>
                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Start
                            Conversation</button>
                    </div>
                </div>
            </div> --}}
            <div class="card">
                <div class="card-header">
                    <h4>Visitors Profile</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div> -->
        </div>
    </section>
@endsection
