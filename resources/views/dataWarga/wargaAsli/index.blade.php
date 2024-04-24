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
            <div class="col-12 col-md-6 order-md-8 order-last">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Warga</li>
                        <li class="breadcrumb-item active" aria-current="page">Warga Asli</li>
                    </ol>
                    <p class="text-muted mt-2 order-md-2">Kec.Candisari, Kel.Tegalsari, RW 13 , RT 6</p>
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
                    Rekap Data Warga Asli RT
                </h5>    
                    <a href="{{ route('wargaAsli.print') }}" class="btn btn-primary btn-sm">
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
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            @if(Auth::user()->level == 'admin' ||Auth::user()->level == 'RT')
                            <th>Aksi</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </section>
    {{-- End Table --}}
    @if(Auth::user()->level == 'admin' ||Auth::user()->level == 'RT')
        <!-- Floating Toggle -->
    <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('wargaAsli.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data" data-toggle="modal" data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
    <!-- End Floating Toggle -->
    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Warga</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"  id="modalContent">
                    <!-- Konten modal -->
                    <!-- Anda dapat menambahkan konten modal di sini -->
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('scripts')
    {{-- JavaScript untuk memuat data warga dari backend --}}
    <script>

        window.onload = function() {
            fetchAllData();

            $(document).ready(function() {
                $('#table3').DataTable();
            });
        }

        function fetchAllData() {
            fetch('{{ route("wargaAsli.fetchAll") }}')
                .then(response => response.json())
                .then(data => {
                    // Ambil tabel

                    const tableBody = document.querySelector("#table3 tbody");

                    // Bersihkan tabel
                    tableBody.innerHTML = '';

                    // Perulangan untuk setiap data warga
                    data.forEach((penduduk, index) => {
                        // Menentukan warna badge berdasarkan status penghuni
                        let badgeColor;
                        if (penduduk.status_penghuni === 'meninggal') {
                            badgeColor = 'danger';
                        } else if (penduduk.status_penghuni === 'tetap') {
                            badgeColor = 'success';
                        } else if (penduduk.status_penghuni === 'pindah') {
                            badgeColor = 'secondary';
                        }

                        // Buat baris baru untuk setiap data warga
                        const newRow = `
                    <tr class="${penduduk.status_penghuni == 'meninggal' ? 'fade-row' : ''}">
                        <td>${index + 1}</td>
                        <td>${penduduk.NIK}</td>
                        <td>${penduduk.nama}</td>
                        <td>${penduduk.nama_jalan} , RT: ${penduduk.id_rt} , RW: ${penduduk.id_rw}</td>
                        <td>
                            <span class="badge bg-${badgeColor}">${penduduk.status_penghuni}</span>
                        </td>
                        <td>
                        @if(Auth::user()->level == 'admin' ||Auth::user()->level == 'RT')
                            <a href="{{ route('wargaAsli.edit', '') }}/${penduduk.id}" class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">
                                <i class="bi bi-pencil-fill text-white"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger toggle-delete" onclick="confirmDelete(${penduduk.id})">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-primary toggle-detail" onclick="showWargaDetail(${penduduk.id})" data-id="${penduduk.id}">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            @endif

                        </td>

                    </tr>
                `;
                        // Masukkan baris baru ke dalam tabel
                        tableBody.innerHTML += newRow;
                        
                    });

                    
                    
                })

                .catch(error => console.error('Error:', error));
        }

    
        // Perbarui event listener untuk tombol "toggle-detail"
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('toggle-detail')) {
                const wargaId = event.target.getAttribute('data-id'); // Ambil ID warga yang diklik
                showWargaDetail(wargaId); // Panggil fungsi untuk menampilkan detail warga
                $('#detailModal').modal('show'); // Tampilkan modal
            }
        });

        function showWargaDetail(id) {
            fetch(`/api/v1/wargaPendatang/fetchOne/${id}`)  // Menggunakan URL endpoint langsung, tanpa menggunakan Blade templating
                .then(response => response.json())
                .then(warga => {
                    // Mengisi konten modal dengan informasi warga
                    const modalBody = document.getElementById('modalContent');
                    modalBody.innerHTML = `
                <p>Nama: ${warga.nama}</p>
                <p>NIK: ${warga.NIK}</p>
                <p>Alamat: ${warga.nama_jalan}, RT: ${warga.id_rt}, RW: ${warga.id_rw}</p>
                <p>Status: ${warga.status_penghuni}</p>
                <p>Agama: ${warga.agama}</p>
                <p>No Hp: ${warga.no_hp}</p>
                <p>Email: ${warga.email}</p>
                <div style="text-align: center;">
                    <label for="current_foto_ktp" class="form-label"><strong>Foto KTP saat ini:</strong></label><br>
                    ${warga.foto_ktp ? `<img src="{{ asset('storage') }}/${warga.foto_ktp}" alt="Foto KTP">` : `<span>Tidak ada foto KTP tersimpan.</span>`}
                </div> 
            `;
                    $('#detailModal').modal('show'); // Tampilkan modal setelah mendapatkan data warga
                })
                .catch(error => console.error('Error:', error));
        }


        // Fungsi untuk konfirmasi hapus
        function confirmDelete(id) {
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
                    // Redirect ke route delete dengan id yang sesuai
                    window.location.href = "{{ url('/wargaAsli/hapus-data-warga-asli') }}/" + id;
                }
            });
        }
        // Menambahkan fungsi untuk menutup modal saat tombol "Tutup" diklik
        document.addEventListener('DOMContentLoaded', function() {
            const closeButton = document.querySelector('.btn-close');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    closeModal();
                });
            }
            
        });

        // Fungsi untuk menutup modal
        function closeModal() {
            $('#detailModal').modal('hide');
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
