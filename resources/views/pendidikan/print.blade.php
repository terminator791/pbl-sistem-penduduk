<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendidikan - Cetak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Tambahkan CSS jika diperlukan -->
    <style>
        .fade-row {
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }

        .fade-row:hover {
            opacity: 1;
        }

        .fade-row td {
            text-decoration: line-through;
        }

        th, td {
            text-align: center;
            vertical-align: middle;
        }

        .letterhead {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .letterhead h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .letterhead img {
            width: 170px;
            height: auto;
            margin-right: 20px;
        }

        .signature {
            position: absolute;
            bottom: 0;
            right: 0;
            margin-bottom: 30px;
            margin-right: 50px;
            text-align: right;
        }

        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
            padding: .75rem;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        .signature p {
            margin-bottom: 90px;
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
    @if (Auth::user()->level == "admin")
    <div class="signature">
        <p id="tanggal">{{ date("Y-m-d") }}</p>
        <p id="nama">Admin</p>
    </div>
    @elseif (Auth::user()->level == "RT" || Auth::user()->level == "RW")
    <div class="signature">
        <p id="tanggal">{{ date("Y-m-d") }}</p>
        <p id="nama">{{ $penduduk->nama }}</p>
    </div>
    @endif

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