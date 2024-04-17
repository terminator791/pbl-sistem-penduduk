<form method="POST" action="{{ route('bantuan.store') }}">
    @csrf
    <div>
        <label for="jenis_bantuan">Jenis Bantuan:</label>
        <input type="text" name="jenis_bantuan" id="jenis_bantuan" required>
    </div>
    <div>
        <label for="NIK_penduduk">Penduduk:</label>
        <select name="NIK_penduduk" id="NIK_penduduk">
            @foreach ($list_penduduk as $penduduk)
                <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
            @endforeach
        </select>
    </div>
    <!-- Add other fields as needed -->

    <button type="submit">Submit</button>
</form>
