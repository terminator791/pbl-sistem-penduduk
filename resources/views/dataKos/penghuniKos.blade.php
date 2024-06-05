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
                <h3>Data Penghuni Kos</h3>
                <p class="text-subtitle text-muted">
                    Rekap data penghuni kos
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dataKos') }}">Data Kos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Warga Penghuni Kos</li>
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
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Rekap Data Warga Penghuni Kos {{ $kos->nama_kos }}
                </h5>
                {{-- <a href="{{ route('#') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-print"></i>
                    Cetak
                </a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                @if(Auth::user()->level != 'RW')
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penghuni as $p)
                                
                                <tr>
                                    <td>{{  $loop->iteration }}</td>
                                    <td>{{ $p->penduduk->nama }}</td>
                                    <td>{{ $p->penduduk->tempat_lahir }}</td>
                                    <td class="{{ Auth::user()->level != 'RW' ? 'edit-tanggal-masuk' : '' }}" data-id="{{ $p->id }}" tanggalMasuk-data="{{ $p->tanggal_masuk }}">
                                        {{ date('d F Y', strtotime($p->tanggal_masuk)) }}
                                    </td>
                                    <td class="{{ Auth::user()->level != 'RW' ? 'edit-tanggal-keluar' : '' }}" data-id="{{ $p->id }}" tanggal-data="{{ $p->tanggal_keluar }}">
                                        {{ $p->tanggal_keluar ? date('d F Y', strtotime($p->tanggal_keluar)) : null }}
                                    </td>
                                    <td class="{{ Auth::user()->level != 'RW' ? 'edit-deskripsi' : '' }}" data-id="{{ $p->id }}" deskripsi-data="{{ $p->deskripsi }}">
                                        {{ $p->deskripsi }}
                                    </td>
                                    <td>
                                        @php
                                            $badgeColor = '';
                                            if ($p->tanggal_keluar) {
                                                $badgeColor = 'danger';
                                            } else if ($p->tanggal_keluar == null) {
                                                $badgeColor = 'success';
                                            }
                                        @endphp
                                        <span class="badge bg-{{ $badgeColor }}">
                                            {{ ($p->tanggal_keluar == null) ? 'penghuni aktif' : 'keluar' }}
                                        </span>
                                    </td>

                                    @if(Auth::user()->level != 'RW')
                                    <td>
                                        <!-- Tombol Toggle Edit -->
                                        <!-- <a href="{{ route('dataKos.penghuniKos.edit', $kos->id) }}"
                                            class="btn btn-sm btn-warning toggle-edit" data-toggle="modal">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </a> -->
                                        <!-- Tombol Hapus -->
                                        <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $p->id }}" data-toggle="modal" data-target="#deleteConfirmationModal">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
@if(Auth::user()->level != 'RW')
<div class="text mt-3">  
    <p>HARAP DIPERHATIKAN! </p>
    <p>Klik kolom yang ingin diganti untuk mengganti/mengupdate data</p>   
    <p>Klik  <span  class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></span></i> untuk menghapus penghuni kos</p>
</div>
@endif

    </section>
    {{-- End Table --}}

    <!-- Floating Toggle -->
    {{-- <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('wargaAsli.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data"
            data-toggle="modal" data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div> --}}

    <!-- End Floating Toggle -->

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <p>Untuk mengkonfirmasi, masukkan kata <strong>konfirmasi</strong> di bawah ini:</p>
                <input type="text" class="form-control" id="confirmInput">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="deleteConfirmedBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tanggal Masuk Modal -->
<div class="modal fade" id="editTanggalMasukModal" tabindex="-1" aria-labelledby="editTanggalMasukModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTanggalMasukModalLabel">Edit Tanggal Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditTanggalMasuk">
                    <div class="mb-3">
                        <label for="tanggalMasukInput" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggalMasukInput" name="tanggal_masuk">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveTanggalMasukBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Tanggal Keluar Modal -->
<div class="modal fade" id="editTanggalKeluarModal" tabindex="-1" aria-labelledby="editTanggalKeluarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTanggalKeluarModalLabel">Edit Tanggal Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditTanggalKeluar">
                        <div class="mb-3">
                            <label for="tanggalKeluarInput" class="form-label">Tanggal Keluar</label>
                            <input type="date" class="form-control" id="tanggalKeluarInput" name="tanggal_keluar">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveTanggalKeluarBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

<!-- Edit Deskripsi Modal -->
<div class="modal fade" id="editDeskripsiModal" tabindex="-1" aria-labelledby="editDeskripsiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDeskripsiModalLabel">Edit Deskripsi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditDeskripsi">
                        <div class="mb-3">
                            <label for="deskripsiInput" name="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsiInput" rows="3" name="deskripsi" ></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveDeskripsiBtn">Simpan</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Event handler untuk tombol toggle-delete
        $('.toggle-delete').click(function() {
            // Ambil id dari data yang akan dihapus
            var id = $(this).data('id');
            // Tampilkan modal konfirmasi
            $('#deleteConfirmationModal').modal('show');
            // Set URL hapus sesuai dengan id yang dipilih
            $('#deleteConfirmedBtn').attr('onclick', 'deleteData('+id+')');
        });

        // Event handler untuk kolom tanggal keluar yang di-klik
        $('.edit-tanggal-keluar').click(function() {
            var id = $(this).data('id');
            $('#editTanggalKeluarModal').modal('show');
            // Set URL edit sesuai dengan id yang dipilih
            $('#saveTanggalKeluarBtn').attr('onclick', 'saveTanggalKeluar('+id+')');
        });
        // Event handler untuk kolom tanggal yang di-klik
        $('.edit-tanggal-keluar').click(function() {
            var id = $(this).data('id');
            var tanggal = $(this).attr('tanggal-data'); // Ambil deskripsi dari atribut deskripsi-data
            $('#tanggalKeluarInput').val(tanggal); // Set nilai deskripsi ke dalam textarea
            $('#editTanggalKeluarModal').modal('show');
            // Set URL edit sesuai dengan id yang dipilih
            $('#saveTanggalKeluarBtn').attr('onclick', 'saveTanggalKeluar('+id+')');
        });

        // Event handler untuk kolom deskripsi yang di-klik
        $('.edit-deskripsi').click(function() {
            var id = $(this).data('id');
            $('#editDeskripsiModal').modal('show');
            // Set URL edit sesuai dengan id yang dipilih
            $('#saveDeskripsiBtn').attr('onclick', 'saveDeskripsi('+id+')');
        });
    });

            // Event handler untuk kolom deskripsi yang di-klik
        $('.edit-deskripsi').click(function() {
            var id = $(this).data('id');
            var deskripsi = $(this).attr('deskripsi-data'); // Ambil deskripsi dari atribut deskripsi-data
            $('#deskripsiInput').val(deskripsi); // Set nilai deskripsi ke dalam textarea
            $('#editDeskripsiModal').modal('show');
            // Set URL edit sesuai dengan id yang dipilih
            $('#saveDeskripsiBtn').attr('onclick', 'saveDeskripsi('+id+')');
        });


    // Function untuk menghapus data
function deleteData(id) {
    // Ambil input teks yang dimasukkan pengguna
    var confirmInput = document.getElementById('confirmInput').value.trim();

    // Periksa apakah input teks sesuai dengan yang diharapkan
    if (confirmInput.toLowerCase() === 'konfirmasi') {
        // Redirect to the delete route with the correct id
        window.location.href = "{{ url('dataKos/penghuni-kos/edit-delete-penghuni') }}/" + id;
    } else {
        Toastify({
            text: "kata yang dimasukkan salah",
            duration: 1000, 
            position: "center",
            style: {
        background: "#ff3300"
    },
            close: true 
        }).showToast();
    }
}

 // Function untuk menyimpan tanggal keluar yang diubah
 function saveTanggalKeluar(id) {
        var tanggalKeluar = $('#tanggalKeluarInput').val();
        // Lakukan operasi penyimpanan tanggal keluar ke server (misalnya melalui Ajax)
        window.location.href = "{{ url('dataKos/penghuni-kos/update-data-penghuni') }}/" + id + "?tanggal_keluar=" + tanggalKeluar;
        
        $('#editTanggalKeluarModal').modal('hide');
    }

// Function untuk menyimpan deskripsi yang diubah
function saveDeskripsi(id) {
        var deskripsi = $('#deskripsiInput').val();
        // Lakukan operasi penyimpanan deskripsi ke server (misalnya melalui Ajax)
        window.location.href = "{{ url('dataKos/penghuni-kos/update-data-penghuni') }}/" + id + "?deskripsi=" + deskripsi;
        $('#editDeskripsiModal').modal('hide');
    }




// Event handler untuk kolom tanggal yang di-klik
$('.edit-tanggal-masuk').click(function() {
            var id = $(this).data('id');
            var tanggalMasuk = $(this).attr('tanggalMasuk-data'); // Ambil deskripsi dari atribut deskripsi-data
            $('#tanggalMasukInput').val(tanggalMasuk); // Set nilai deskripsi ke dalam textarea
            $('#editTanggalMasukModal').modal('show');
            // Set URL edit sesuai dengan id yang dipilih
            $('#saveTanggalMasukBtn').attr('onclick', 'saveTanggalMasuk('+id+')');
        });

// Function untuk menyimpan tanggal masuk yang diubah
function saveTanggalMasuk(id) {
    var tanggalMasuk = $('#tanggalMasukInput').val();
    // Lakukan operasi penyimpanan tanggal masuk ke server (misalnya melalui Ajax)
    window.location.href = "{{ url('dataKos/penghuni-kos/update-data-penghuni') }}/" + id + "?tanggal_masuk=" + tanggalMasuk;
    
    $('#editTanggalMasukModal').modal('hide');
}


</script>


    <script>
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
                    // Redirect to the delete route with the correct id
                    window.location.href = "{{ url('/wargaAsli/hapus-data-warga-asli') }}/" + id;
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
