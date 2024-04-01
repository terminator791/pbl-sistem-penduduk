<!-- resources/views/warga/index.blade.php -->

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Penduduk</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tempat Lahir</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Pekerjaan</th>
                                    <th scope="col">Status Penghuni</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penduduk as $p)
                                    <tr>
                                        <td>{{ $p->NIK }}</td>
                                        <td>{{ $p->nama }}</td>
                                        <td>{{ $p->jenis_kelamin }}</td>
                                        <td>{{ $p->tempat_lahir }}</td>
                                        <td>{{ $p->tanggal_lahir }}</td>
                                        <td>{{ $p->agama }}</td>
                                        <td>{{ $p->pekerjaan->jenis_pekerjaan }}</td>
                                        <td>{{ $p->status_penghuni }}</td>
                                        <td>{{ $p->no_hp }}</td>
                                        <td>{{ $p->email }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Data Warga - Menu: {{ $menu }}</div>
                    <div class="card-body">
                        <h1>Daftar RT Penduduk</h1>
                        <!-- Your content goes here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
