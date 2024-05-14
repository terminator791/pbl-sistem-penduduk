@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Semua User</h3>
                <p class="text-subtitle text-muted">
                User
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Daftar Semua User
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('title', 'Data Warga')

@section('content')
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
                        <h5 class="card-title mb-0">
                            Daftar User {{ $level }}
                        </h5>
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
                                                @if($user->level != 'admin')
                                                <a href="{{ route('profile.toggle_status', $user->id) }}"
                                                    class="btn btn-sm
                                                            @if($user->status_akun)
                                                                btn-secondary
                                                            @else
                                                                btn-primary

                                                            @endif">
                                                        <i class="bi bi-exclamation-triangle text-white"></i>
                                                </a>
                                                @endif

                                                <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteConfirmationModal">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </td>
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


<!-- Floating Toggle -->
<div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
        <a href="{{ route('profile.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data" data-toggle="modal"
            data-target="#tambahDataModal">
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