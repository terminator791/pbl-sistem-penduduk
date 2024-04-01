<!-- resources/views/kesehatan/print.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kesehatan - Cetak</title>
    <!-- Tambahkan CSS jika diperlukan -->
</head>

<body onload="window.print()">
    <h1>Data Kesehatan - {{ $penyakit->nama_penyakit }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kesehatan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->penduduk->nama }}</td>
                <td>{{ $p->penduduk->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>