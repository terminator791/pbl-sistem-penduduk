<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sosial - Cetak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Tambahkan CSS jika diperlukan -->
    <style>
        /* Aturan CSS*/
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

        .letterhead hr {
            position: absolute; /* Mengatur posisi absolut untuk garis */
            bottom: 0; /* Menempatkan garis di bagian bawah */
            left: 0; /* Mulai dari tepi kiri */
            width: 100%; /* Memenuhi lebar kontainer */
            border: 1px solid black; /* Membuat garis */
            margin: 0; /* Menghilangkan margin */
        }

        /* Styling untuk tempat tanda tangan */
        .signature {
            position: absolute;
            bottom: 0; /* Posisikan di bagian bawah */
            right: 0; /* Posisikan di pojok kanan */
            margin-bottom: 30px; /* Jarak antara tanda tangan dan nama bertanda tangan */
            margin-right: 50px;
        }

        /* Penyesuaian jarak antara teks "Pemerintah Kota Semarang" dan alamat */
        .letterhead div {
            margin-left: 20px; /* Atur margin kiri */
        }

        /* Penyesuaian jarak antara tanggal dan nama yang bertanda tangan */
        .signature p {
            margin-bottom: 90px; /* Jarak antara elemen dalam div signature */
        }
    </style>
</head>

<body>
    <!-- Informasi Pemerintah Kota Semarang -->
    <div class="letterhead">
        <img src="{{ asset('storage/logo_hitam_mepet.png') }}" alt="Logo" class="logo">
        <div>
            <h1>Data Sosial - Cetak</h1>
            <p><strong>Pemerintah Kota Semarang</strong><br>
                Alamat: Jl. Pandanaran No. XX, Semarang<br>
                Telp: (024) XXXXXXX
            </p>
            <!-- Garis di bawah alamat -->
            <hr>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-hover" id="table3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Bantuan</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sosial as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->bantuan->jenis_bantuan }}</td>
                <td>{{ $p->nama_jalan }}, RT {{ $p->id_rt }}, RW {{ $p->id_rw }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tempat Tanda Tangan -->
    <div class="signature">
        <p id="tanggal">{{ date("Y-m-d") }}</p>
        <p id="nama"><span id="nama_pengguna">{{ $nama_pengguna }}</span></p>
    </div>

    <!-- Skrip JavaScript untuk mengatur tanggal dan pencetakan -->
    <script>
        // Panggil fungsi fillSignature() saat dokumen selesai dimuat
        window.onload = fillSignature;

        // Fungsi untuk mengisi tempat, tanggal, dan tahun secara otomatis
        function fillSignature() {
            const today = new Date();
            document.getElementById('tanggal').textContent = getFormattedDate(today);
            document.getElementById('nama').textContent = document.getElementById('nama_pengguna').textContent;

            // Memanggil fungsi window.print() setelah mengisi tanda tangan
            window.print();
        }

        // Fungsi untuk mendapatkan format tanggal yang sesuai (dd mmmm yyyy)
        function getFormattedDate(date) {
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
        }
    </script>
</body>
</html>
