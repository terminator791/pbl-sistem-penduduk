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
                <h3>Daftar Ketua RT</h3>
                <p class="text-subtitle text-muted">
                    Ketua RT
                </p>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <span class="fw-@if($loop->first)bold @endif">RT {{ $rt }}</span>
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
                                        <th>Status</th>
                                        <th>Foto Ketua</th>
                                        @if(Auth::user()->level != 'RT')
                                        <th>Aksi</th>
                                        @endif
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
                                                            <td class="{{ Auth::user()->level != 'RT' ? 'edit-tanggal-dilantik' : '' }}" data-id="{{ $ketua->id }}" tanggalDilantik-data="{{ $ketua->tanggal_dilantik }}">{{ $ketua->tanggal_dilantik }}</td>
                                                            <td class="{{ $ketua->tanggal_diberhentikan !== null && Auth::user()->level != 'RT' ? 'edit-tanggal-Diberhentikan' : '' }}" data-id="{{ $ketua->id }}" tanggalDiberhentikan-data="{{ $ketua->tanggal_diberhentikan }}">{{ $ketua->tanggal_diberhentikan ? $ketua->tanggal_diberhentikan : 'Petahana' }}</td>
                                                            <td>
                                                                @php
                                                                    $badgeColor = '';
                                                                    if ($ketua->tanggal_diberhentikan) {
                                                                        $badgeColor = 'danger';
                                                                    } else if ($ketua->tanggal_diberhentikan == null) {
                                                                        $badgeColor = 'success';
                                                                    }
                                                                @endphp
                                                                <span class="badge bg-{{ $badgeColor }}">
                                                                    {{ $ketua->tanggal_diberhentikan == null ? 'Aktif' : 'NonAktif' }}
                                                                </span>
                                                            </td>
                                                            <td style="width: 175px; height: 200px; text-align: center;" class="{{ Auth::user()->level != 'RT' ? 'edit-foto' : '' }}" data-id="{{ $ketua->id }}" foto-data="{{ $ketua->foto_ketua_rt }}">
                                                                @if($ketua->foto_ketua_rt)
                                                                    <img src="/storage/{{ $ketua->foto_ketua_rt }}" alt="Foto Ketua RT" style="max-width: 100%; max-height: 100%; width: 100%; height: 100%;">
                                                                @else
                                                                    <span>Tidak ada foto ketua RT</span>
                                                                @endif
                                                            </td>
                                                            @if(Auth::user()->level != 'RT')
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
                                                            @endif

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
    @if(Auth::user()->level != 'RT')
<div class="text mt-3">
    <p>HARAP DIPERHATIKAN! </p>
    <p>Klik  <span  class="btn btn-sm btn-primary"><i class="bi bi-exclamation-triangle text-white"></span></i> untuk memberhentikan ketua rt yang sedang menjabat</p>
    <p>Klik kolom tanggal dilantik/foto ketua untuk mengganti/mengupdate data</p>
</div>
@endif


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


<!-- Edit Tanggal Masuk Modal -->
<div class="modal fade" id="editTanggalDilantikModal" tabindex="-1" aria-labelledby="editTanggalDilantikModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTanggalDilantikModalLabel">Edit Tanggal Dilantik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditTanggalDilantik">
                    <div class="mb-3">
                        <label for="tanggalDilantikInput" class="form-label">Tanggal Dilantik</label>
                        <input type="date" class="form-control" id="tanggalDilantikInput" name="tanggal_dilantik">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveTanggalDilantikBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tanggal Masuk Modal -->
<div class="modal fade" id="editTanggalDiberhentikanModal" tabindex="-1" aria-labelledby="editTanggalDiberhentikanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTanggalDiberhentikanModalLabel">Edit Tanggal Diberhentikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditTanggalDiberhentikan">
                    <div class="mb-3">
                        <label for="tanggalDiberhentikanInput" class="form-label">Tanggal Diberhentikan</label>
                        <input type="date" class="form-control" id="tanggalDiberhentikanInput" name="tanggal_diberhentikan">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveTanggalDiberhentikanBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Foto Modal -->
<div class="modal fade" id="editFotoModal" tabindex="-1" aria-labelledby="editFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFotoModalLabel">Edit Foto Ketua RT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditFoto" enctype="multipart/form-data">
                    <div class="mb-3">
                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <label for="fotoKetuaInput" class="form-label">Pilih Foto</label>
                        <input type="file" class="form-control" id="fotoKetuaInput" name="foto_ketua">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveFotoBtn">Simpan</button>
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
    // Ambil input teks yang  pengguna
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
    // Periksa apakah input tanggal diberhentikan kosong
    if (confirmInput === "") {
        // Tampilkan toast
        showToast("Tanggal harus diisi!");
        // Hentikan pengiriman form
        return;
    }
    // Lakukan operasi penyimpanan tanggal masuk ke server (misalnya melalui Ajax)
    window.location.href = "{{ url('toggle_tanggal_RT') }}/" + id + "?tanggal_diberhentikan=" + confirmInput;
    $('#ConfirmationModal').modal('hide');
}


// Event handler untuk kolom tanggal yang di-klik
$('.edit-tanggal-dilantik').click(function() {
            var id = $(this).data('id');
            var tanggalDilantik = $(this).attr('tanggalDilantik-data'); // Ambil deskripsi dari atribut deskripsi-data
            $('#tanggalDilantikInput').val(tanggalDilantik); // Set nilai deskripsi ke dalam textarea
            $('#editTanggalDilantikModal').modal('show');
            // Set URL edit sesuai dengan id yang dipilih
            $('#saveTanggalDilantikBtn').attr('onclick', 'saveTanggalDilantik('+id+')');
        });

// Function untuk menyimpan tanggal dilantik yang diubah
function saveTanggalDilantik(id) {
    var tanggalDilantik = $('#tanggalDilantikInput').val();
    // Periksa apakah input tanggal dilantik kosong
    if (tanggalDilantik === "") {
        showToast("Tanggal harus diisi!");
        // Hentikan pengiriman form
        return;
    }
    // Lakukan operasi penyimpanan tanggal masuk ke server (misalnya melalui Ajax)
    window.location.href = "{{ url('/update-data-ketua') }}/" + id + "?tanggal_dilantik=" + tanggalDilantik;
    $('#editTanggalDilantikModal').modal('hide');
}



// Event handler untuk kolom tanggal yang di-klik
$('.edit-tanggal-Diberhentikan').click(function() {
            var id = $(this).data('id');
            var tanggalDiberhentikan = $(this).attr('tanggalDiberhentikan-data'); // Ambil deskripsi dari atribut deskripsi-data
            $('#tanggalDiberhentikanInput').val(tanggalDiberhentikan); // Set nilai deskripsi ke dalam textarea
            $('#editTanggalDiberhentikanModal').modal('show');
            // Set URL edit sesuai dengan id yang dipilih
            $('#saveTanggalDiberhentikanBtn').attr('onclick', 'saveTanggalDiberhentikan('+id+')');
        });

// Function untuk menyimpan tanggal diberhentikan yang diubah
function saveTanggalDiberhentikan(id) {
    var tanggalDiberhentikan = $('#tanggalDiberhentikanInput').val();
    // Periksa apakah input tanggal diberhentikan kosong
    if (tanggalDiberhentikan === "") {
        showToast("Tanggal harus diisi!");
        // Hentikan pengiriman form
        return;
    }
    // Lakukan operasi penyimpanan tanggal masuk ke server (misalnya melalui Ajax)
    window.location.href = "{{ url('/update-data-ketua') }}/" + id + "?tanggal_diberhentikan=" + tanggalDiberhentikan;
    $('#editTanggalDiberhentikanModal').modal('hide');
}

$(document).ready(function() {
    // Add CSRF token to every AJAX request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.edit-foto').click(function() {
        var id = $(this).data('id');
        $('#editFotoModal').data('id', id).modal('show');
    });

    $('#saveFotoBtn').click(function() {
        saveFoto($('#editFotoModal').data('id'));
    });

    // Check for flash message on page load
    @if(session()->has('message'))
        showToast("{{ session('message') }}");
    @endif
});

function saveFoto(id) {
    var formData = new FormData($('#formEditFoto')[0]);
    formData.append('id', id);

    $.ajax({
        url: "{{ url('/update-foto-ketua') }}/" + id,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#editFotoModal').modal('hide');
            location.reload(); // Reload the page to reflect changes
        },
        error: function(xhr) {
            showToast('Error: ' + xhr.responseText);
        }
    });
}

function showToast(message) {
    Toastify({
        text: message,
        duration: 2000, // Duration in milliseconds
        position: "center",
        style: {
        background: "#28a745"
    },
        close: true // Show close button
    }).showToast();
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
