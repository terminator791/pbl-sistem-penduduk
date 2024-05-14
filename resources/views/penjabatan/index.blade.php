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
                                        <th>Aksi</th>
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
                                                            <td>
                                                                @if($ketua->tanggal_diberhentikan == null)
                                                                <button class="btn btn-sm btn-primary toggle-edit" data-id="{{ $ketua->id_penjabatan }}" data-toggle="modal" data-target="#ConfirmationModal">
                                                                    <i class="bi bi-exclamation-triangle text-white"></i>
                                                                </button>
                                                                @endif
                                                                <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $ketua->id_penjabatan }}" data-toggle="modal" data-target="#deleteConfirmationModal">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
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


    <div class="modal fade" id="ConfirmationModal" tabindex="-1" aria-labelledby="ConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ConfirmationModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Masukkan <strong>tanggal diberhentikan</strong> di bawah ini:</p>
                <input type="date" class="form-control" name="tanggal_berhenti" id="confirmTanggal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="ConfirmedBtn">Konfirmasi</button>
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
        window.location.href = "{{ url('delete_ketua') }}/" + id;
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

$(document).ready(function() {
        // Event handler untuk tombol toggle-edit
        $('.toggle-edit').click(function() {
            // Ambil id dari data yang akan dihapus
            var id = $(this).data('id');
            // Tampilkan modal konfirmasi
            $('#ConfirmationModal').modal('show');
            // Set URL hapus sesuai dengan id yang dipilih
            $('#ConfirmedBtn').attr('onclick', 'toggle_status('+id+')');
        });
    });

    // Function untuk memberhanetikan ketua rt
    function toggle_status(id) {
    var confirmInput = document.getElementById('confirmTanggal').value;
    // Lakukan operasi penyimpanan tanggal masuk ke server (misalnya melalui Ajax)
    window.location.href = "{{ url('toggle_tanggal_RT') }}/" + id + "?tanggal_diberhentikan=" + confirmInput;
    
    $('#ConfirmationModal').modal('hide');
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