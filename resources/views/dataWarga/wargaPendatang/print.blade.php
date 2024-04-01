<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Cetak</title>
    <!-- Include Bootstrap CSS jika diperlukan -->
    <!-- <link rel="stylesheet" href="path/to/bootstrap.css"> -->
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
    </style>
</head>
<body onload="window.print()"> <!-- Panggil window.print() saat halaman dimuat -->
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
                <tr class="{{ $p->status_penghuni == 'meninggal' ? 'fade-row' : '' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->NIK }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->nama_jalan }} , RT: {{ $p->id_rt }} , RW: {{ $p->id_rw }}</td>
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
