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
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Rekap Data Bangunan Kos
                </h5>
                <a href="{{ route('dataKos.print') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-print"></i>
                    Cetak
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kos</th>
                                <th>Pemilik</th>
                                <th>Jumlah Penghuni</th>
                                <th>Alamat Kos</th>
                                <th>Status</th>
                                @if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'pemilik_kos')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @if(Auth::check() && Auth::user()->level == 'pemilik_kos')
                            @foreach ($data_kos_pemilik as $kos)
                                <tr id="row_{{ $kos->id }}">
                                    <td class="direct">{{ $loop->iteration }}</td>
                                    <td class="direct">{{ $kos->nama_kos }}</td>
                                    <td class="direct">{{ $kos->pemilik_kos }}</td>
                                    <td class="direct2" style="text-align: center;">{{ $jumlah_penghuni[$kos->id] }}</td>
                                    <td class="direct">{{ $kos->alamat_kos }}</td>
                                    <td class="direct">
                                        @if ($kos->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol Toggle Edit -->
                                        <a href="{{ route('dataKos.edit', $kos->id) }}"
                                            class="btn btn-sm btn-warning toggle-edit">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <a href="#" class="btn btn-sm btn-danger toggle-delete"
                                            onclick="confirmDelete(event, {{ $kos->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @elseif(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'RW')
                            @foreach ($data_kos as $kos)
                                <tr id="row_{{ $kos->id }}">
                                    <td class="direct">{{ $loop->iteration }}</td>
                                    <td class="direct">{{ $kos->nama_kos }}</td>
                                    <td class="direct">{{ $kos->pemilik_kos }}</td>
                                    <td class="direct2" style="text-align: center;">{{ $jumlah_penghuni[$kos->id] }}</td>
                                    <td class="direct">{{ $kos->alamat_kos }}</td>
                                    <td class="direct">
                                        @if ($kos->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                    @if(Auth::check() && Auth::user()->level == 'admin')
                                    <td>
                                        <!-- Tombol Toggle Edit -->
                                        <a href="{{ route('dataKos.edit', $kos->id) }}"
                                            class="btn btn-sm btn-warning toggle-edit">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <a href="#" class="btn btn-sm btn-danger toggle-delete"
                                            onclick="confirmDelete(event, {{ $kos->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        @elseif(Auth::check() && Auth::user()->level == 'RT')
                            @foreach ($data_kos_RT as $kos)
                                <tr id="row_{{ $kos->id }}">
                                    <td class="direct">{{ $loop->iteration }}</td>
                                    <td class="direct">{{ $kos->nama_kos }}</td>
                                    <td class="direct">{{ $kos->pemilik_kos }}</td>
                                    <td class="direct2" style="text-align: center;">{{ $jumlah_penghuni[$kos->id] }}</td>
                                    <td class="direct">{{ $kos->alamat_kos }}</td>
                                    <td class="direct">
                                        @if ($kos->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>

    </section>
    {{-- End Table --}}

    <!-- Floating Toggle -->
    <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('dataKos.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data" data-toggle="modal"
            data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>

    <!-- End Floating Toggle -->
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan semua elemen baris tabel
            var directElements = document.querySelectorAll(".direct2");

            // Menambahkan event listener untuk setiap baris tabel
            directElements.forEach(function(element) {
                element.addEventListener("click", function(event) {
                    // Mendapatkan elemen baris (tr) terdekat dari elemen dengan kelas "direct"
                    var row = event.target.closest("tr");
                    // Mengecek apakah event terjadi pada tombol delete atau tombol edit
                    var target = event.target;
                    // Mendapatkan id baris
                    var id = row.getAttribute("id").split("_")[1];
                    // Membuat URL dengan menggunakan id baris
                    var url = "{{ route('dataKos.penghuniKos', ['id' => ':id']) }}".replace(
                        ':id', id);
                    // Mengarahkan pengguna ke halaman "penghuni" dengan menyediakan nilai untuk parameter "id"
                    window.location.href = url;
                })
            });
        });
    </script>

    <script>
        function confirmDelete(event, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah Anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete route with the correct id
                    window.location.href = "{{ url('/dataKos/hapus-kos') }}/" + id;
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
@endsection
