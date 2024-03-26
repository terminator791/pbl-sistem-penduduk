<!-- resources/views/warga/index.blade.php -->

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Kesehatan</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kesehatan as $p)
                                    <tr>
                                        <td>{{ $p->id }}</td>
                                        <td>{{ $p->penduduk->nama }}</td>
                                        <td>{{ $p->jenis_penyakit->nama_penyakit }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>