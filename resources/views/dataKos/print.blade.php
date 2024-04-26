<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kos - Cetak</title>
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
        }
    </style>
</head>

<body onload="window.print()">
    <h1>Data Kos - Cetak</h1>
    <br>
    <table class="table table-hover" id="table3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kos</th>
                <th>Alamat Kos</th>
                <th>Status</th>
                <th>Jumlah Penghuni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_kos as $kos)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kos->nama_kos }}</td>
                <td>{{ $kos->alamat_kos }}</td>
                <td>
                    @if($kos->status)
                    <span class="badge bg-success">Aktif</span>
                    @else
                    <span class="badge bg-danger">Non Aktif</span>
                    @endif
                </td>
                <td>{{ $kos->jumlah_penghuni }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>