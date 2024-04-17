<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Cetak</title>
    <!-- Include Bootstrap CSS jika diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
<body onload="window.print()"> <!-- Panggil window.print() saat halaman dimuat -->
<div class="card-body">
<h2>Data Warga Asli</h2><br>
            <div class="table-responsive">
                <table class="table table-hover" id="table3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penduduk as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->NIK }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->nama_jalan }} , RT {{ $p->id_rt }} , RW {{ $p->id_rw }}</td>
                            <td>{{ $p->status_penghuni }}</td>

                            <td>
                        <!-- Tidak ada tombol cetak -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Include Bootstrap JS jika diperlukan -->
    <!-- <script src="path/to/bootstrap.js"></script> -->
</body>
</html>
