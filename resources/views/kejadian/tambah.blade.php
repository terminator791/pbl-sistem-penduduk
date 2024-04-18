<form method="POST" action="{{ route('kejadian.add') }}">
    @csrf
    <div>
        <label for="jenis_kejadian" class="form-label">Kejadian:</label>
        <select name="jenis_kejadian" id="jenis_kejadian" class="form-select">
    </div>
    <div>
        <label for="tanggal_kejadian" class="form-label">Tanggal:</label>
        <input type="date" class="form-control" id="tanggal_kejadian" name="tanggal_kejadian">
    </div>
    <div>
        <label for="tempat_kejadian" class="form-label">Tempat:</label>
        <input type="text" class="form-control" id="tempat_kejadian" name="tempat_kejadian">
    </div>
    <div>
        <label for="deskripsi_kejadian" class="form-label">Deskripsi:</label>
        <textarea class="form-control" id="deskripsi_kejadian" name="deskripsi_kejadian"></textarea>
    </div>
    <div>
        <label for="id_penyakit">Penyakit :</label>
        <select name="id_penyakit" id="id_penyakit">
            @foreach ($list_penyakit as $penyakit)
            <option value="{{ $penyakit->id }}">{{ $penyakit->nama_penyakit }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="NIK_penduduk">Pelapor </label>
        <select name="NIK_penduduk" id="NIK_penduduk">
            @foreach ($list_penduduk as $penduduk)
            <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Tambah Penduduk</button>
</form>