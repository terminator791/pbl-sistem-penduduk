<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kejadian - Cetak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            justify-content: center; /* Memusatkan secara horizontal */
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

        /* Styling untuk tempat tanda tangan */
        .signature {
            position: absolute;
            bottom: 0;
            right: 0;
            margin-bottom: 20px;
            margin-right: 50px;
            text-align: right; /* Memastikan teks terletak di kanan */
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
    </style>
</head>

<body>
<!-- Kop Surat -->
<div class="container-fluid"> <!-- Tambahkan class container-fluid di sini -->
    <div class="letterhead">
        <img src="{{ asset('storage/logo_hitam_mepet.png') }}" alt="Logo" class="logo">
        <div>
            <h1>Data Kejadian - {{ $jenis_kejadian->jenis_kejadian }}</h1>
            <p><strong>Pemerintah Kota Semarang</strong></p>
            <p>Jl. Pandanaran No. XX, Semarang, Telp: (024) XXXXXXX</p>
        </div>
    </div>
</div>

<!-- Tabel Data -->
<div class="container-fluid"> <!-- Tambahkan class container-fluid di sini -->
    <table class="table table-hover table-bordered table-striped" id="table3">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Tempat</th>
            <th>Deskripsi</th>
            <th>Pelapor</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kejadian as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->tanggal_kejadian }}</td>
                <td>{{ $p->tempat_kejadian }}</td>
                <td>{{ $p->deskripsi_kejadian }}</td>
                <td>{{ $p->penduduk->nama }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Tempat Tanda Tangan -->
<div class="container-fluid"> <!-- Tambahkan class container-fluid di sini -->
    <div class="signature">
        <p>Semarang, 5 Mei 2024</p>
        <p>Tanda Tangan:</p>
        <!-- Ganti ini dengan gambar tanda tangan jika diperlukan -->
        <p>Nama yang Bertanda Tangan</p>
    </div>
</div>

<!-- Skrip JavaScript untuk mengatur tanggal dan pencetakan -->
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
