<form method="POST" action="{{ route('penduduk') }}">
    @csrf
    <div>
        <label for="NIK">NIK:</label>
        <input type="text" name="NIK" id="NIK">
    </div>
    <div>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama">
    </div>
    <div>
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin">
            <option value="pria">Laki-laki</option>
            <option value="wanita">Perempuan</option>
        </select>
    </div>
    <div>
        <label for="tempat_lahir">Tempat Lahir:</label>
        <input type="text" name="tempat_lahir" id="tempat_lahir">
    </div>
    <div>
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir">
    </div>
    <div>
        <label for="agama">Agama:</label>
        <input type="text" name="agama" id="agama">
    </div>
    <div>
        <label for="id_pendidikan">Pendidikan :</label>
        <select name="id_pendidikan" id="id_pendidikan">
        @foreach ($list_pendidikan as $pendidikan)
                <option value="{{ $pendidikan->id }}">{{ $pendidikan->jenis_pendidikan }}</option> <!-- Use actual database values -->
            @endforeach
        </select>
    </div>
    <div>
        <label for="id_pekerjaan">Pekerjaan :</label>
        <select name="id_pekerjaan" id="id_pekerjaan">
        @foreach ($list_pekerjaan as $pekerjaan)
                <option value="{{ $pekerjaan->id }}">{{ $pekerjaan->jenis_pekerjaan }}</option> <!-- Use actual database values -->
            @endforeach
        </select>
    </div>
    <div>
        <label for="id_status_perkawinan">Status Perkawinan :</label>
        <select name="id_status_perkawinan" id="id_status_perkawinan">
        @foreach ($list_perkawinan as $perkawinan)
                <option value="{{ $perkawinan->id }}">{{ $perkawinan->status_perkawinan }}</option> <!-- Use actual database values -->
            @endforeach
        </select>
    </div>
    <div>
        <label for="id_rt">RT :</label>
        <select name="id_rt" id="id_rt">
        @foreach ($list_RT as $RT)
                <option value="{{ $RT->id }}">{{ $RT->nama_rt }}</option> <!-- Use actual database values -->
            @endforeach
        </select>
    </div>
    <div>
        <label for="id_rw">RW :</label>
        <select name="id_rw" id="id_rw">
        @foreach ($list_RW as $RW)
                <option value="{{ $RW->id }}">{{ $RW->nama_rw }}</option> <!-- Use actual database values -->
            @endforeach
        </select>
    </div>
    <div>
        <label for="id_keluarga">Keluarga :</label>
        <select name="id_keluarga" id="id_keluarga">
        @foreach ($list_keluarga as $keluarga)
                <option value="{{ $keluarga->id }}">{{ $keluarga->status_keluarga }}</option> <!-- Use actual database values -->
            @endforeach
        </select>
    </div>
    <div>
        <label for="nama_jalan">Nama Jalan :</label>
        <input type="text" name="nama_jalan" id="nama_jalan">
    </div>
    <div>
        <label for="status_penghuni">Status Penghuni :</label>
        <select name="status_penghuni" id="status_penghuni">
            <option value="hidup">Hidup</option>
            <option value="mati">Mati</option>
        </select>
    </div>
    <div>
        <label for="no_hp">Nomor HP :</label>
        <input type="text" name="no_hp" id="no_hp">
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="text" name="email" id="email">
    </div>

    <!-- Lanjutkan dengan input untuk data-data lainnya sesuai kebutuhan -->

    <button type="submit">Tambah Penduduk</button>
</form>
