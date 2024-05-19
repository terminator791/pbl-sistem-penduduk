<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendidikan - Cetak</title>
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

        th,
        td {
            text-align: center;
        }

        /* Styling untuk kop surat */
        .letterhead {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Memusatkan secara horizontal */
            padding: 20px;
            position: relative;
            /* Menjadikan posisi relatif untuk menempatkan garis */
            text-align: center;
            /* Memastikan teks terpusat */
        }

        .letterhead h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .letterhead img {
            width: 170px;
            /* Ukuran default */
            height: auto;
            /* Lebar akan menyesuaikan proporsi */
            margin-right: 20px;
            /* Margin untuk memberi jarak antara logo dan teks */
        }

        /* Styling untuk tempat tanda tangan */
        .signature {
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            /* Memusatkan secara horizontal ke kanan */
            padding: 20px;
            position: absolute;
            bottom: 0;
            right: 0;
        }
    </style>
</head>

<body onload="window.print()">
    <!-- Kop Surat -->
    <div class="letterhead">
        <img src="{{ asset('storage/logo_hitam_mepet.png') }}" alt="Logo" class="logo">
        <div>
            <h1>Data Pendidikan</h1>
            <p><strong>Pemerintah Kota Semarang</strong></p>
            <p>Jl. Pandanaran No. XX, Semarang, Telp: (024) XXXXXXX</p>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendidikan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->nama_jalan }}, RT {{ $p->id_rt }}, RW {{ $p->id_rw }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tempat Tanda Tangan -->
    <div class="signature">
        <p id="tanggal">{{ date("Y-m-d") }}</p>
        <p id="nama">{{ Auth::user()->username }}</p>
    </div>

</body>
<script>
        // Panggil fungsi fillSignature() saat dokumen selesai dimuat
        window.onload = fillSignature;

        // Fungsi untuk mengisi tempat, tanggal, dan tahun secara otomatis
        function fillSignature() {
            // Memanggil fungsi window.print() setelah mengisi tanda tangan
            window.print();
        }
    </script>

</html>
