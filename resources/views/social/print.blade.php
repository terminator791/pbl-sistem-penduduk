<!-- resources/views/kesehatan/print.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kesehatan - Cetak</title>
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
        th,td {
                text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
    <h1>Data Kesehatan - {{ $bantuan->nama_bantuan }}</h1> <br>
    <table class="table table-hover" id="table3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bantuan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->penduduk->nama }}</td>
                <td>{{ $p->penduduk -> nama_jalan }} , RT {{ $p->penduduk->id_rt }} , RW {{ $p->penduduk->id_rw }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>