@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Semua User</h3>
                <p class="text-subtitle text-muted">User</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Semua User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Data Warga')

@section('content')

<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.3.0/uicons-regular-straight/css/uicons-regular-straight.css'>

<ul class="nav nav-pills mb-2">
    @foreach($uniqueLevels as $level)
        <li class="nav-item">
            <a class="nav-link @if($loop->first) active @endif" id="{{ $level }}-tab" data-bs-toggle="tab" href="#{{ $level }}" role="tab" aria-controls="{{ $level }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" users-id="{{ $level }}">
                <i class="bi bi-building-fill"></i>
                <span class="fw-@if($loop->first)bold @endif">{{ $level }}</span>
            </a>
        </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($uniqueLevels as $level)
        <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $level }}" role="tabpanel" aria-labelledby="{{ $level }}-tab">
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Daftar User {{ $level }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-{{ $level }}">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>NIK</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(${"list_users_$level"} as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->NIK_penduduk }}</td>
                                            <td>
                                                <span class="badge bg-{{ $user->status_akun == true ? 'success' : 'secondary' }}">{{ $user->status_akun == true ? 'Aktif' : 'Nonaktif' }}</span>
                                            </td>
                                            <td>
                                                @if(!($user->username == 'admin' && $user->level == 'admin'))
                                                <a href="#" onclick="confirmDelete(event, {{ $user->id }})" class="btn btn-sm @if($user->status_akun) btn-secondary @else btn-primary @endif" title="Ubah Status">
                                                    <i class="bi bi-exclamation-triangle text-white"></i>
                                                </a>

                                                <button class="btn btn-sm btn-success toggle-change-password" style="background-color: darkgrey;" data-id="{{ $user->id }}" data-toggle="modal" data-target="#changePasswordModal" title="Ganti Kata Sandi">
                                                    <i class="bi fi-rs-key text-white"></i>
                                                </button>

                                                <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteConfirmationModal" title="Hapus Akun">
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
            </section>
        </div>
    @endforeach
</div>

<style>
    .keterangan-button {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .keterangan-button p {
        margin: 0;
    }

    .keterangan-button .btn-container {
        display: flex;
        gap: 10px;
    }
</style>
<p>KETERANGAN TOMBOL: </p>
<div class="keterangan-button">
    
    <p class="text-muted">
        Untuk mengganti status akun:
    </p>
    <div class="btn-container">
        <a href="#" class="btn btn-sm btn-primary" title="Ubah Status">
            <i class="bi bi-exclamation-triangle text-white"></i>
        </a>
    </div>
    <p class="text-muted">
        Untuk mengganti kata sandi:
    </p>
    <div class="btn-container">
        <button class="btn btn-sm btn-success" style="background-color: darkgrey;">
            <i class="bi fi-rs-key text-white"></i>
        </button>
    </div>
    <p class="text-muted">
        Untuk menghapus akun:
    </p>
    <div class="btn-container">
        <button class="btn btn-sm btn-danger">
            <i class="bi bi-trash-fill"></i>
        </button>
    </div>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;





<!-- Floating Toggle -->
<div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
    <a href="{{ route('profile.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data" data-toggle="modal" data-target="#tambahDataModal">
        <i class="bi bi-plus-lg"></i>
    </a>
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

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="changePasswordForm" method="POST" action="{{ url('change_password') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Ganti Kata Sandi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Kata Sandi Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                    <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ganti Kata Sandi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Fungsi untuk menampilkan atau menyembunyikan teks password
    $(document).on('click', '#togglePassword', function() {
        var passwordField = $('#new_password');
        var fieldType = passwordField.attr('type');
        if (fieldType === 'password') {
            passwordField.attr('type', 'text');
            $(this).html('<i class="bi bi-eye-slash"></i>');
        } else {
            passwordField.attr('type', 'password');
            $(this).html('<i class="bi bi-eye"></i>');
        }
    });

    // Fungsi untuk menampilkan atau menyembunyikan teks password
    $(document).on('click', '#togglePassword2', function() {
        var passwordField = $('#confirm_password');
        var fieldType = passwordField.attr('type');
        if (fieldType === 'password') {
            passwordField.attr('type', 'text');
            $(this).html('<i class="bi bi-eye-slash"></i>');
        } else {
            passwordField.attr('type', 'password');
            $(this).html('<i class="bi bi-eye"></i>');
        }
    });
</script>

<script>
$(document).ready(function() {
    // Event handler untuk tombol toggle-change-password
    $('.toggle-change-password').click(function() {
        // Ambil id user yang akan diubah kata sandinya
        var id = $(this).data('id');
        // Set nilai input hidden di dalam modal
        $('#user_id').val(id);
        // Tampilkan modal
        $('#changePasswordModal').modal('show');
    });

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
        window.location.href = "{{ url('delete_akun') }}/" + id;
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

// Fungsi untuk konfirmasi hapus
function confirmDelete(event, id) {
    event.preventDefault(); // Menghentikan aksi default dari link
    Swal.fire({
        title: 'Konfirmasi Status',
        text: "Apakah Anda yakin ingin Mengubah status data ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Konfirmasi',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke route delete dengan id yang sesuai
            window.location.href = "{{ url('/toggle-status-user') }}/" + id;
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
