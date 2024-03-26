<form action="{{ route('pendidikan') }}">
    @csrf
    <div>
        <label for="jenis_pendidikan">Pendidikan : </label>
        <input type="text" name="jenis_pendidikan" id="jenis_pendidikan">
    </div>
    <div>
    <!-- Lanjutkan dengan input untuk data-data lainnya sesuai kebutuhan -->

    <button type="submit">Tambah Penduduk</button>
</form>
