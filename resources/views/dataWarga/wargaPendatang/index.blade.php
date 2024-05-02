@extends('layouts.default-ui')

@section('heading')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Data Warga</h3>
            <p class="text-subtitle text-muted">
                Rekap data warga Pendatang
            </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Data Warga
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Warga Pendatang</li>
                </ol>
                <p class="text-muted mt-2 order-md-2">Kec.Candisari, Kel.Tegalsari, RW 13 , RT {{ $id_rt }}</p>
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
                Rekap Data Warga Pendatang RT {{ $id_rt }}
            </h5>
            <a href="{{ route('wargaPendatang.print') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-print"></i>
                Cetak
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table3">
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
                </table>
            </div>
        </div>

    </div>

</section>
{{-- End Table --}}
@if(Auth::user()->level == 'admin' ||Auth::user()->level == 'RT')
<!-- Floating Toggle -->
<div class="btn-float" style="position: fixed; bottom: 30px; right: 30px; z-index: 1031;">
    <a href="{{ route('wargaPendatang.create') }}" class="btn btn-primary rounded-pill btn-lg toggle-data" data-toggle="modal" data-target="#tambahDataModal">
        <i class="bi bi-plus-lg"></i>
    </a>
</div>

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

<!-- End Floating Toggle -->
@endif
@endsection

@section('scripts')
{{-- --}}

{{-- JavaScript untuk memuat data warga dari backend --}}
<script>
window.onload = function() {
    fetchAllData();
}

$(document).ready(function () {
    var i = 1; // Inisialisasi variabel i di sini
    $('#table3').DataTable({
        processing: false,
        serverSide: false,
        ajax: "/wargaPendatang/fetchAll",
        columns: [
            {data: 'i', name: 'i', render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1; // Memberikan nomor urut sesuai dengan halaman
            }},
            {data: 'NIK', name: 'NIK'},
            {data: 'nama', name: 'nama'},
            {data: 'nama_jalan', render: function(data, type, row) {
                return `RT: ${row.id_rt}, RW: ${row.id_rw}, ${data}`;
            }, name: 'nama_jalan'},
            {data: 'status_penghuni', name: 'status_penghuni', render: function(data, type, row) {
                let badgeColor;
                if (data === 'kos') {
                    badgeColor = 'primary';
                } else if (data === 'kontrak') {
                    badgeColor = 'success';
                }
                return `<span class="badge bg-${badgeColor}">${data}</span>`;
            }},
            @if (Auth::user()->level == 'admin' || Auth::user()->level == 'RT')
                {data: 'action', name: 'action', orderable: false, searchable: false}
            @endif
        ],
        "initComplete": function(settings, json) {
            i = this.api().page.info().start; // Mengambil nomor halaman saat ini
        }
    });
    
});



    // Perbarui event listener untuk tombol "toggle-detail"
    document.addEventListener('click', function(event) {
            if (event.target.classList.contains('toggle-detail')) {
                const wargaId = event.target.getAttribute('data-id'); // Ambil ID warga yang diklik
                showWargaDetail(wargaId); // Panggil fungsi untuk menampilkan detail warga
                $('#detailModal').modal('show'); // Tampilkan modal
            }
        });

        function showWargaDetail(id) {
            fetch(`/api/v1/wargaAsli/fetchOne/${id}`)  // Menggunakan URL endpoint langsung, tanpa menggunakan Blade templating
                .then(response => response.json())
                .then(warga => {
                    // Mengisi konten modal dengan informasi warga
                    const modalBody = document.getElementById('modalContent');
                    modalBody.innerHTML = `
                    <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> ${warga.nama}</p>
                            <p><strong>NIK:</strong> ${warga.NIK}</p>
                            <p><strong>Alamat:</strong> ${warga.nama_jalan}, RT: ${warga.id_rt}, RW: ${warga.id_rw}</p>
                            <p><strong>Status:</strong> ${warga.status_penghuni}</p>
                            <p><strong>Pendidikan Terakhir:</strong> ${warga.id_pendidikan}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Agama:</strong> ${warga.agama}</p>
                            <p><strong>Status Perkawinan:</strong> ${warga.id_status_perkawinan}</p>
                            <p><strong>Pekerjaan:</strong> ${warga.id_pekerjaan}</p>
                            <p><strong>No Hp:</strong> ${warga.no_hp}</p>
                            <p><strong>Email:</strong> ${warga.email}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <label for="current_foto_ktp" class="form-label"><strong>Foto KTP :</strong></label><br>
                            ${warga.foto_ktp ? `<img src="{{ asset('storage') }}/${warga.foto_ktp}" alt="Foto KTP" style="max-width: 100%; max-height: 200px;">` : `<span>Tidak ada foto KTP tersimpan.</span>`}
                        </div>
                    </div>
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
                window.location.href = "{{ url('/wargaPendatang/hapus-data-warga-asli') }}/" + id;
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
