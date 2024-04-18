<form method="POST" action="{{ route('kesehatan.add') }}">
    @csrf
    <div>
        <label for="NIK_penduduk">Penduduk :</label>
        <select name="NIK_penduduk" id="NIK_penduduk">
        @foreach ($list_penduduk as $penduduk)
        <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
        @endforeach
        </select>
    </div>
    <div>
        <label for="tanggal_terdampak">Tanggal Terdampak:</label>
        <input type="date" name="tanggal_terdampak" id="tanggal_terdampak">
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
    <!-- Lanjutkan dengan input untuk data-data lainnya sesuai kebutuhan -->

    <button type="submit">Tambah Penduduk</button>
</form>
