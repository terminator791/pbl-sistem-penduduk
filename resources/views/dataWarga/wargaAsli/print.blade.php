<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga Asli - Cetak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS jika diperlukan -->
    <style>
        /* Aturan CSS */
        .fade-row {
            opacity: 0.5;
            /* Sesuaikan dengan tingkat opasitas yang diinginkan */
            transition: opacity 0.3s ease;
            /* Animasi perubahan opasitas */
        }

        .fade-row:hover {
            opacity: 1;
            /* Opasitas kembali ke normal saat dihover */
        }

        .fade-row td {
            text-decoration: line-through;
        }

        th, td {
            text-align: center;
            vertical-align: middle; /* Posisi teks secara vertikal di tengah */
        }

        /* Styling untuk kop surat */
        .letterhead {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Memusatkan secara horizontal */
            padding: 20px;
            position: relative; /* Menjadikan posisi relatif untuk menempatkan garis */
            text-align: center; /* Memastikan teks terpusat */
        }

        .letterhead h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .letterhead img {
            width: 170px; /* Ukuran default */
            height: auto; /* Lebar akan menyesuaikan proporsi */
            margin-right: 20px; /* Margin untuk memberi jarak antara logo dan teks */
        }

        /* Styling untuk tabel */
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6; /* Warna garis */
            padding: .75rem; /* Padding sel */
        }

        /* Pewarnaan tiap baris tabel */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Warna latar belakang bergantian */
        }

        /* Efek shadow pada tiap baris tabel */
        .table tbody tr:hover {
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Shadow ketika dihover */
        }
        
        .signature {
            position: relative;
            bottom: 0;
            right: 0;
            margin-bottom: 30px; /* Jarak antara tanda tangan dan nama bertanda tangan */
            margin-right: 50px;
            text-align: right; /* Memastikan teks terletak di kanan */
        }
        /* Penyesuaian jarak antara tanggal dan nama yang bertanda tangan */
        .signature p {
            margin-bottom: 90px; /* Jarak antara elemen dalam div signature */
        }
    </style>
</head>
<body onload="window.print()">
    <!-- Kop Surat -->
    <div class="card-body">
        <!-- Sesuaikan dengan desain kop surat yang diinginkan -->
        <div class="letterhead">
            <div>
                <img src="{{ asset('storage/logo_hitam_mepet.png') }}" alt="Logo" class="logo">
            </div>
            <h1>Data Warga Asli</h1>
            <div>
                <strong>Pemerintah Kota Semarang</strong>
                <p>Jl. Pandanaran No. XX, Semarang, Telp: (024) XXXXXXX</p>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-hover table-bordered table-striped" id="table3">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Status</th> <!-- Penambahan kolom status -->
                <!-- Tambahkan kolom lain jika diperlukan -->
            </tr>
        </thead>
        <tbody>
            @foreach($penduduk as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->NIK }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->nama_jalan }} , RT {{ $p->id_rt }} , RW {{ $p->id_rw }}</td>
                <td>{{ $p->status_penghuni }}</td> <!-- Penambahan data status -->
                <!-- Tambahkan kolom lain jika diperlukan -->
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        
        <p>{{ date("Y-m-d") }}</p>
        <!-- Ganti ini dengan gambar tanda tangan jika diperlukan -->
        <p id="nama"><span id="nama_pengguna">{{ $nama_pengguna }}</span></p>
    </div>
    <script>
        // Panggil fungsi fillSignature() saat dokumen selesai dimuat
        window.onload = fillSignature;

        // Fungsi untuk mengisi tempat, tanggal, dan tahun secara otomatis
        function fillSignature() {
            // Memanggil fungsi window.print() setelah mengisi tanda tangan
            window.print();
        }
    </script>
</body>
</html>