<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Warga</title>
</head>
<body>
    <h1>Daftar Warga</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Status Perkawinan</th>
                <th>Alamat</th>
                <th>Status Penghuni</th>
                <th>No. HP</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warga as $person)
            <tr>
                <td>{{ $person['id'] }}</td>
                <td>{{ $person['NIK'] }}</td>
                <td>{{ $person['nama'] }}</td>
                <td>{{ $person['jenis_kelamin'] }}</td>
                <td>{{ $person['tempat_lahir'] }}</td>
                <td>{{ $person['tanggal_lahir'] }}</td>
                <td>{{ $person['agama'] }}</td>
                <td>{{ $person['pekerjaan']['jenis_pekerjaan'] }}</td>
                <td>{{ $person['id_status_perkawinan'] }}</td>
                <td>{{ $person['nama_jalan'] }}</td>
                <td>{{ $person['status_penghuni'] }}</td>
                <td>{{ $person['no_hp'] }}</td>
                <td>{{ $person['email'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
