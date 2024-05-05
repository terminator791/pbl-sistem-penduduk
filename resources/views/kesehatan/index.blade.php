@extends('layouts.default-ui')

@section('heading')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Kesehatan</h3>
            <p class="text-subtitle text-muted">
                Rekap data Kesehatan
            </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Data Kesehatan
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
    @foreach($list_penyakit as $penyakit)
    <li class="nav-item">
        <a class="nav-link @if($loop->first) active @endif" id="{{ $penyakit->nama_penyakit }}-tab" data-bs-toggle="tab" href="#{{ $penyakit->nama_penyakit }}" role="tab" aria-controls="{{ $penyakit->nama_penyakit }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-penyakit-id="{{ $penyakit->id }}">
            <i class="fa-solid fa-hospital-user fa-lg" class="font-medium-3 me-50"></i>
            <span class="fw-@if($loop->first)bold @endif">{{ $penyakit->nama_penyakit }}</span>
        </a>
    </li>
    @endforeach
</ul>

<div class="tab-content">
    @foreach($list_penyakit as $penyakit)
    <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $penyakit->nama_penyakit }}" role="tabpanel" aria-labelledby="{{ $penyakit->nama_penyakit }}-tab">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        Rekap Data - {{ $penyakit->nama_penyakit }}
                    </h5>
                    <a href="{{ route('kesehatan.print', $penyakit) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-print"></i>
                        Cetak - {{ $penyakit->nama_penyakit }}
                    </a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_{{ $penyakit->nama_penyakit }}">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Tgl Terdampak</th>
                                    <th>Status</th>
                                    @if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'RT' )
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            @php
                                $nomor_iterasi = 1;
                            @endphp
                        @if(Auth::check() && Auth::user()->level == 'RT' )
                            <tbody>
                            @foreach($penyakit->kesehatan as $p)
                                @if($p->penduduk->id_rt == $id_rt)
                                <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->penduduk->nama }}</td>
                                        <td>{{ $p->penduduk->nama_jalan }}, RT {{ $p->penduduk->id_rt }}, RW {{ $p->penduduk->id_rw }}</td>
                                        <td>{{ $p->tanggal_terdampak }}</td>
                                        <td>
                                        @php
                                            $badgeColor = '';
                                            if ($p->status === 'sakit') {
                                                $badgeColor = 'danger';
                                            } else if ($p->status === 'sembuh') {
                                                $badgeColor = 'success';
                                            } else if ($p->status === 'meninggal') {
                                                $badgeColor = 'secondary';
                                            } 
                                        @endphp
                                        <span class="badge bg-{{ $badgeColor }}">{{ $p->status }}</span>
                                        </td>
                                        <td>
                                        @if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'RT' )
                                        <button  class="btn btn-sm btn-warning toggle-edit" data-id="{{ $p->id }}" data-status="{{ $p->status }}">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </button>
                                        </td>
                                        <!-- <td>
                                            <a href="{{ route('kesehatan.delete', $p->id) }}" class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td> -->
                                    </tr>
                                @endif
                                    @php
                                        $nomor_iterasi++;
                                    @endphp
                                @endif
                            @endforeach
                            </tbody>
                        @endif

                        @if(Auth::check() && Auth::user()->level == 'admin' )
                            <tbody>
                            @foreach($penyakit->kesehatan as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->penduduk->nama }}</td>
                                        <td>{{ $p->penduduk->nama_jalan }}, RT {{ $p->penduduk->id_rt }}, RW {{ $p->penduduk->id_rw }}</td>
                                        <td>{{ $p->tanggal_terdampak }}</td>
                                        <td>
                                        @php
                                            $badgeColor = '';
                                            if ($p->status === 'sakit') {
                                                $badgeColor = 'danger';
                                            } else if ($p->status === 'sembuh') {
                                                $badgeColor = 'success';
                                            } else if ($p->status === 'meninggal') {
                                                $badgeColor = 'secondary';
                                            } 
                                        @endphp
                                        <span class="badge bg-{{ $badgeColor }}">{{ $p->status }}</span>
                                        </td>
                                        <td>
                                        @if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'RT' )
                                        <button  class="btn btn-sm btn-warning toggle-edit" data-id="{{ $p->id }}" data-status="{{ $p->status }}">
                                            <i class="bi bi-pencil-fill text-white"></i>
                                        </button>
                                        <!-- <a href="{{ route('kesehatan.delete', $p->id) }}" class="btn btn-sm btn-danger toggle-delete" data-toggle="modal">
                                                <i class="bi bi-trash-fill"></i>
                                            </a> -->
                                            <button class="btn btn-sm btn-danger toggle-delete" data-id="{{ $p->id }}" data-toggle="modal" data-target="#deleteConfirmationModal">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        @endif

                        
                        @php
                            $nomor_iterasi_rw = 1;
                        @endphp
                        @if(Auth::check() && Auth::user()->level == 'RW' )
                            <tbody>
                            @foreach($penyakit->kesehatan as $p)
                                @if($p->penduduk->id_rw == $id_rw)
                                    <tr>
                                        <td>{{ $nomor_iterasi_rw }}</td>
                                        <td>{{ $p->penduduk->nama }}</td>
                                        <td>{{ $p->penduduk->nama_jalan }}, RT {{ $p->penduduk->id_rt }}, RW {{ $p->penduduk->id_rw }}</td>
                                        <td>{{ $p->tanggal_terdampak }}</td>
                                        <td>
                                        @php
                                            $badgeColor = '';
                                            if ($p->status === 'sakit') {
                                                $badgeColor = 'danger';
                                            } else if ($p->status === 'sembuh') {
                                                $badgeColor = 'success';
                                            } else if ($p->status === 'meninggal') {
                                                $badgeColor = 'secondary';
                                            } 
                                        @endphp
                                        <span class="badge bg-{{ $badgeColor }}">{{ $p->status }}</span>
                                        </td>
                                    </tr>
                                    @php
                                        $nomor_iterasi_rw++;
                                    @endphp
                                @endif
                            @endforeach
                            </tbody>
                        @endif

                        </table>
                    </div>
                </div>
                
            </div>
        </section>
    </div>
    
    @endforeach
</div>
@if(Auth::check() && Auth::user()->level == 'admin' ||  Auth::user()->level == 'RT' )
<div class="text mt-3">
    <p>HARAP DIPERHATIKAN! </p>
    <p>Klik sekali untuk mengganti status menjadi <span class="badge bg-success">sembuh</span> atau <span class="badge bg-danger">sakit</span>.</p>
    <p>Klik lama untuk mengganti status menjadi <span class="badge bg-secondary">meninggal</span>.</p>
    </div>

<!-- Floating Toggle -->
<div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
    <button type="button" class="btn btn-primary rounded-pill btn-lg toggle-data" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
        <i class="bi bi-plus-lg"></i>
    </button>
</div>

<!-- Modal Tambah Data Kesehatan -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Kesehatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('kesehatan.store') }}" id="tambahDataForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="NIK_penduduk" class="form-label">Penduduk :</label>
                        <select name="NIK_penduduk" id="NIK_penduduk" class="form-select choices">
                            @foreach ($list_penduduk as $penduduk)
                            <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_terdampak" class="form-label">Tanggal Terdampak:</label>
                        <input type="date" class="form-control" id="tanggal_terdampak" name="tanggal_terdampak">
                    </div>
                    <div class="mb-3">
                        <label for="id_penyakit" class="form-label">Penyakit :</label>
                        <select name="id_penyakit" id="id_penyakit" class="form-select">
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Penduduk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif


<!-- Modal untuk konfirmasi perubahan status -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><span style="color: red;">PERINGATAN</span> PERUBAHAN STATUS</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <p>Apakah Anda yakin akan mengganti status menjadi 'meninggal'? Penduduk yang sudah meninggal <span style="color: red;">tidak bisa diubah</span> kembali.</p>
            </div>
            <div class="modal-footer">
                <button id="cancelButton" type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button id="confirmButton" type="button" class="btn btn-danger">Ya</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk peringatan jika status sudah 'meninggal' -->
<div id="warningModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Peringatan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Penduduk ini sudah meninggal dan statusnya tidak bisa diubah. Silakan hubungi admin untuk bantuan lebih lanjut.</p>
            </div>
            <div class="modal-footer">
                <button id="cancelButton2" type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Status berhasil diubah.',
            showConfirmButton: false,
            timer: 700 // Adjust the time as needed
        });

        setTimeout(function() {
            window.location.href = "{{ url('kesehatan/hapus-kesehatan') }}/" + id;
            }, 850);

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
    $(document).ready( function () {
        
        // Loop through each table with an ID starting with "table_"
        $('table[id^="table_"]').each(function() {
            $(this).DataTable(); // Initialize DataTable for the current table
        });
    });
    
    var pressTimer;

    $('.toggle-edit').mousedown(function(event) {
        var button = $(this);
        var status = button.data('status');

        if (status === 'meninggal') {
            $('#warningModal').modal('show'); // Show warning modal if status is 'meninggal'
            
        } else {
            if (!pressTimer) {
            pressTimer = window.setTimeout(function() {
                // Handle long press action here
                $('#confirmModal').modal('show'); // Show modal
                
                // Set data attribute for the button to retrieve later
                $('#confirmButton').data('id', button.data('id'));
                
                pressTimer = null; // Reset timer
            }, 1000); // Waktu long press (dalam milidetik)

            // Function to handle single click
    $('.toggle-edit').click(function(event) {
        var button = $(this);
        var id = button.data('id'); // Get the ID of the health record
        
        // Send an AJAX request without long_press parameter
        $.get('/toggle-status-kesehatan/' + id, function(data) {
            // Optional: Perform actions after the request is completed
    // Redirect to a specific route with success message
    setTimeout(function() {
                window.location.href = "{{ route('kesehatan') }}";
            }, 1000);

    Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Status berhasil diubah.',
            showConfirmButton: false,
            timer: 800 // Adjust the time as needed
        });

    // Toastify({
    //         text: "Status berhasil diubah",
    //         duration: 500, // Duration in milliseconds (3 seconds in this example)
    //         close: true // Show close button or not
    //     }).showToast();

        });
        console.log("Button clicked");
    });
    
    // Function to handle confirm button click
    $('#confirmButton').click(function(event) {
        var id = $(this).data('id'); // Get the ID of the health record
        
        // Send AJAX request with long_press parameter
        $.get('/toggle-status-kesehatan/' + id + '?long_press=true', function(data) {
            // Redirect to a specific route with success message
    setTimeout(function() {
                window.location.href = "{{ route('kesehatan') }}";
            }, 1000);

    Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Status berhasil diubah.',
            showConfirmButton: false,
            timer: 800 // Adjust the time as needed
        });
            
        });
        
        with('success', 'berhasil mengganti status!');
        $('#confirmModal').modal('hide'); // Hide modal
    });
        }
            
        }
        
    }).mouseup(function() {
        // Hapus timer saat tombol dilepas
        clearTimeout(pressTimer);
        pressTimer = null; // Reset timer
    });

    

    // Function to handle cancel button click
    $('#cancelButton').click(function(event) {
        $('#confirmModal').modal('hide'); // Hide modal
    });
    $('#cancelButton2').click(function(event) {
        $('#warningModal').modal('hide'); // Hide modal
    });

</script>


<script>
    // Script jQuery
    $(document).ready(function() {
        
         // Fungsi untuk menyimpan ID tab aktif ke dalam localStorage
         
    function simpanTabAktif(tabId) {
        localStorage.setItem('tabAktif', tabId);
    }

    // Fungsi untuk memulihkan tab aktif dari localStorage
    function pulihkanTabAktif() {
        var tabAktif = localStorage.getItem('tabAktif');
        if (tabAktif) {
            $('.nav-link[data-penyakit-id="' + tabAktif + '"]').tab('show');
        }
    }

    pulihkanTabAktif();

        // Inisialisasi nilai penyakit pada load halaman pertama kali
        var initialPenyakit = $('.nav-link.active').data('penyakit-id'); // Mengambil data penyakit-id dari elemen nav-link aktif
        var namaPenyakit = $('.nav-link.active').text().trim();
        $('#id_penyakit').html('<option value="' + initialPenyakit + '" selected>' + namaPenyakit + '</option>');

        $('.nav-link').on('click', function() {
            $('.nav-link span').removeClass('fw-bold');
            $(this).find('span').addClass('fw-bold');

            // Memperbarui pilihan pada dropdown "Penyakit"
            var penyakitId = $(this).data('penyakit-id'); // Mengambil data penyakit-id dari elemen nav-link yang di-klik
            var namaPenyakit = $(this).text().trim();
            $('#id_penyakit').html('<option value="' + penyakitId + '" selected>' + namaPenyakit + '</option>');
            // Simpan ID tab aktif ke dalam localStorage saat tab diubah
        simpanTabAktif(penyakitId);
        });

        $('.print-button').on('click', function() {
            window.print();
        });
    });
    $(document).ready(function(){
            $('.choices').choices();
        });

        
    
</script>


<script>
    // Function to show toast
    function showToast(message) {
        Toastify({
            text: message,
            duration: 2000, // Duration in milliseconds (3 seconds in this example)
            close: true // Show close button or not
        }).showToast();
    }

    // Function to handle form submission
    $(document).ready(function() {
        $('#tambahDataForm').submit(function(event) {
            // Cek apakah tanggal_terdampak tidak diisi
            if ($('#tanggal_terdampak').val() === '') {
                // Tampilkan toast
                showToast("Tanggal terdampak harus diisi!");
                // Hentikan pengiriman form
                event.preventDefault();
            }
        });
    });


</script>



@endsection