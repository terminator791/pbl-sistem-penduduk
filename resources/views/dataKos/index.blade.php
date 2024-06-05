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
                @if (Auth::user()->level == 'admin')
                    <h3>Data Kos Admin</h3>
                @elseif (Auth::user()->level == 'RW')
                    <h3>Data Kos RW 13, {{ $username}}</h3>
                @elseif(Auth::user()->level == 'RT')
                    <h3>Data Kos RW 13  RT {{ $id_rt}}, {{ $username}}</h3>
                @elseif(Auth::user()->level == 'pemilik_kos')
                    <h3>Data Kos {{ $username }}</h3>
                @endif
                <p class="text-subtitle text-muted">
                    Rekap data kos
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">                
                    <!-- <h2>{{ Auth::user()->level }}, {{ Auth::user()->username }}</h2> -->
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
                                @if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'pemilik_kos' || Auth::user()->level == 'RT')
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
                                    <td class="direct2" style="text-align: center;" title ="Klik untuk melihat detail penghuni kos">{{ $jumlah_penghuni[$kos->id] }}</td>
                                    <td class="direct">{{ $kos->alamat_kos }}</td>
                                    <td class="direct">
                                        @if ($kos->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                    <a href="{{ route('dataKos.toggle_status', $kos->id) }}"
                                        class="btn btn-sm
                                                @if($kos->status)
                                                    btn-secondary
                                                @else
                                                    btn-primary

                                                @endif">
                                            <i class="bi bi-exclamation-triangle text-white" title ="Klik untuk mengaktifkan dan Nonaktifkan kos"></i>
                                        </a>
                                        <!-- Tombol Toggle Edit -->
                                        <a href="{{ route('dataKos.edit', $kos->id) }}"
                                            class="btn btn-sm btn-warning toggle-edit" >
                                            <i class="bi bi-pencil-fill text-white" title ="Klik untuk mengedit kos"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <!-- <a href="#" class="btn btn-sm btn-danger toggle-delete"
                                            onclick="confirmDelete(event, {{ $kos->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </a> -->
                                        <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $kos->id }}" data-toggle="modal" data-target="#deleteConfirmationModal" title ="Klik untuk menghapus kos">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                        <a href="#" class="btn btn-sm btn-info toggle-detail"  title ="Klik untuk melihat info kos"
                                            onclick="showDetailModal('{{ $kos->nama_kos }}', '{{ $kos->pemilik_kos }}', '{{ $jumlah_penghuni[$kos->id] }}', '{{ $kos->alamat_kos }}', '{{ $kos->no_hp_pemilik }}', '{{ $kos->email_pemilik }}', '{{ $kos->foto_kos }}',)">
                                            <i class="bi bi-eye-fill text-white"></i>
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
                                    <td class="direct2" style="text-align: center;" title ="Klik Untuk melihat detail penghuni kos">{{ $jumlah_penghuni[$kos->id] }}</td>
                                    <td class="direct">{{ $kos->alamat_kos }}</td>
                                    <td class="direct" title ="Untuk melihat status kos">
                                        @if ($kos->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                    @if(Auth::check() && Auth::user()->level == 'admin')
                                    <td>
                                    <a href="{{ route('dataKos.toggle_status', $kos->id) }}" title ="Klik untuk mengaktifkan dan Nonaktifkan kos"
                                        class="btn btn-sm
                                                @if($kos->status)
                                                    btn-secondary
                                                @else
                                                    btn-primary

                                                @endif">
                                            <i class="bi bi-exclamation-triangle text-white"></i>
                                        </a>
                                        <!-- Tombol Toggle Edit -->
                                        <a href="{{ route('dataKos.edit', $kos->id) }}"
                                            class="btn btn-sm btn-warning toggle-edit" title ="edit kos">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <!-- <a href="#" class="btn btn-sm btn-danger toggle-delete"
                                            onclick="confirmDelete(event, {{ $kos->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </a> -->
                                        <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $kos->id }}" data-toggle="modal" data-target="#deleteConfirmationModal" title ="Klik untuk menghapus kos">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                        <a href="#" class="btn btn-sm btn-info toggle-detail" title ="klik untuk melihat info kos"
                                            onclick="showDetailModal('{{ $kos->nama_kos }}', '{{ $kos->pemilik_kos }}', '{{ $jumlah_penghuni[$kos->id] }}', '{{ $kos->alamat_kos }}', '{{ $kos->no_hp_pemilik }}', '{{ $kos->email_pemilik }}', '{{ $kos->foto_kos }}',)">
                                            <i class="bi bi-eye-fill text-white"></i>
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
                                    <td class="direct2" style="text-align: center;" title ="Klik untuk melihat detail penghuni kos">{{ $jumlah_penghuni[$kos->id] }}</td>
                                    <td class="direct">{{ $kos->alamat_kos }}</td>
                                    <td class="direct">
                                        @if ($kos->status)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                    <a href="{{ route('dataKos.toggle_status', $kos->id) }}" title ="Klik untuk mengaktifkan dan Nonaktifkan kos"
                                        class="btn btn-sm
                                                @if($kos->status)
                                                    btn-secondary
                                                @else
                                                    btn-primary

                                                @endif">
                                            <i class="bi bi-exclamation-triangle text-white"></i>
                                        </a>
                                        <!-- Tombol Toggle Edit -->
                                        <a href="{{ route('dataKos.edit', $kos->id) }}" title ="Klik untuk mengedit data kos"
                                            class="btn btn-sm btn-warning toggle-edit">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <!-- <a href="#" class="btn btn-sm btn-danger toggle-delete"
                                            onclick="confirmDelete(event, {{ $kos->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </a> -->
                                        <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $kos->id }}" data-toggle="modal" data-target="#deleteConfirmationModal" title ="Klik untuk menhapus kos">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>

                                        <a href="#" class="btn btn-sm btn-info toggle-detail"  title ="Klik untuk melihat info kos"
                                            onclick="showDetailModal('{{ $kos->nama_kos }}', '{{ $kos->pemilik_kos }}', '{{ $jumlah_penghuni[$kos->id] }}', '{{ $kos->alamat_kos }}', '{{ $kos->no_hp_pemilik }}', '{{ $kos->email_pemilik }}', '{{ $kos->foto_kos }}',)">
                                            <i class="bi bi-eye-fill text-white"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

<div class="text mt-3">
    @if(Auth::user()->level != 'RW')
    <p>HARAP DIPERHATIKAN! </p>
    <p>Klik  <span  class="btn btn-sm btn-primary"><i class="bi bi-exclamation-triangle text-white"></span></i> untuk mengganti status menjadi <span class="badge bg-success">Aktif</span> atau <span class="badge bg-danger">NonAktif</span>.</p>
    <p>Klik  <span  class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill text-white"></span></i> untuk mengedit informasi kos</p>
    <p>Klik  <span  class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></span></i> untuk menghapus kos</p>
    <p>Klik  <span  class="btn btn-sm btn-info"><i class="bi bi-eye-fill text-white"></span></i> untuk menampilkan informasi kos</p>
    <p>Klik angka pada kolom jumlah penghuni untuk melihat data penghuni kos</p>
    @endif
</div>


    </section>
    {{-- End Table --}}
    @if(Auth::user()->level != 'RW')
    <!-- Floating Toggle -->
    <div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('dataKos.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data" data-toggle="modal" title ="tambah kos"
            data-target="#tambahDataModal">
            <i class="bi bi-plus-lg"></i>
        </a>
    </div>
    @endif
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Kos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
            </div>
        </div>
    </div>
</div>


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

    <!-- End Floating Toggle -->
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
    });

    // Function untuk menghapus data
function deleteData(id) {
    // Ambil input teks yang dimasukkan pengguna
    var confirmInput = document.getElementById('confirmInput').value.trim();

    // Periksa apakah input teks sesuai dengan yang diharapkan
    if (confirmInput.toLowerCase() === 'konfirmasi') {
        // Redirect to the delete route with the correct id
        window.location.href = "{{ route('dataKos.delete', '') }}/" + id;
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

</script>

    <script>
function showDetailModal(nama_kos, pemilik_kos, jumlah_penghuni, alamat_kos, no_hp_pemilik, email_pemilik, foto_kos) {
    var modalContent = document.getElementById('modalContent');
    var fotoKosHTML = '';

    if (foto_kos) {
        fotoKosHTML = `
            <div style="text-align: center; width: 300px; height: 200px;">
                <img src="/storage/${foto_kos}" alt="Foto KOS" style="max-width: 100%; max-height: 100%; width: auto; height: auto;">
            </div>
        `;
    } else {
        fotoKosHTML = `<span>Tidak ada foto kos</span>`;
    }

    modalContent.innerHTML = `
        <p><strong>Nama Kos:</strong> ${nama_kos}</p>
        <p><strong>Pemilik Kos:</strong> ${pemilik_kos}</p>
        <p><strong>Jumlah Penghuni:</strong> ${jumlah_penghuni}</p>
        <p><strong>Alamat Kos:</strong> ${alamat_kos}</p>
        <p><strong>Kontak:</strong> ${no_hp_pemilik}</p>
        <p><strong>Email:</strong> ${email_pemilik}</p>
        <div style="width: 175px; height: 220px; text-align: center;">
            <strong>Foto KOS:</strong><br>
            ${fotoKosHTML}
        </div>
    `;
    $('#detailModal').modal('show');
}



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

    
    @if(session('warning'))
    <script>
        Toastify({
            text: "{{ session('warning') }}",
            duration: 8000,
            position: 'center',
            backgroundColor: '#FFCC00'
        }).showToast();
        </script>
    @endif

    @if ($errors->any())
    <script>
        Swal.fire({
                title: 'Error!',
                @foreach ($errors->all() as $error)
                    text: '{{ $error }}',
                @endforeach
                icon: 'error',
                showConfirmButton: true,
            });
    </script>
@endif


@endsection
