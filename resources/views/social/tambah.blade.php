<form method="POST" action="{{ route('bantuan.add') }}">
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
        <label for="id_bantuan">Bantuan :</label>
        <select name="id_bantuan" id="id_bantuan">
        @foreach ($list_bantuan as $bantuan)
        <option value="{{ $bantuan->id }}">{{ $bantuan->bantuan }}</option>
        @endforeach
        </select>
    </div>
    <div>
    <!-- Lanjutkan dengan input untuk data-data lainnya sesuai kebutuhan -->

    <button type="submit">Tambah Penduduk</button>
</form>
