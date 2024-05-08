@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Ketua RT</h3>
                <p class="text-subtitle text-muted">
                    Ketua RT
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Daftar Ketua RT
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Data Warga')

@section('content')
    @if(Auth::user()->level == 'RW' || Auth::user()->level == 'admin')
        <ul class="nav nav-pills mb-2">
            @foreach($id_rt as $rt)
                <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" id="{{ $rt }}-tab" data-bs-toggle="tab" href="#{{ $rt }}" role="tab" aria-controls="{{ $rt }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-penyakit-id="{{ $rt }}">
                        <i class="bi bi-building-fill"></i>
                        <span class="fw-@if($loop->first)bold @endif">{{ $rt }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="tab-content">
        @foreach($id_rt as $rt)
            @php
                $counter = 1;
            @endphp
            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $rt }}" role="tabpanel" aria-labelledby="{{ $rt }}-tab">
                <section class="section">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                Daftar Ketua RT 0{{ $rt }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="table-{{ $rt }}">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tanggal Dilantik</th>
                                        <th>Tanggal Selesai Menjabat</th>
                                        <th>Foto Ketua</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_ketua as $ketua)
                                            @if($ketua->id_rt == $rt)
                                                @foreach($nama_ketua as $data_nama)
                                                    @if($ketua->NIK_ketua_rt == $data_nama->NIK)
                                                        <tr>
                                                            <td>{{ $counter++ }}</td>
                                                            <td>{{$ketua->NIK_ketua_rt}}</td>
                                                            <td>{{$data_nama->nama }}</td>
                                                            <td>{{$ketua->tanggal_dilantik}}</td>
                                                            <td>{{ $ketua->tanggal_diberhentikan ? $ketua->tanggal_diberhentikan : 'Petahana' }}</td>
                                                            <td style="width: 175px; height: 200px; text-align: center;">
                                                                @if($ketua->foto_ketua_rt)
                                                                    <img src="/storage/{{ $ketua->foto_ketua_rt }}" alt="Foto Ketua RT" style="max-width: 100%; max-height: 100%; width: 100%; height: 100%;">
                                                                @else
                                                                    <span>Tidak ada foto ketua RT</span>
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
@endsection
