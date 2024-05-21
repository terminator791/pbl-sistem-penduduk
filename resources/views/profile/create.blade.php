@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Pengurus</h3>
                <p class="text-subtitle text-muted">
                    Rekap data Pengurus
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tambah Pengurus
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    {{-- Start Table --}}
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Pengurus</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('profile.store') }}" data-parsley-validate enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mandatory">
                                            <label for="nama" class="form-label">Nama :</label>
                                                <select name="nama" id="nama" class="form-select choices">
                                                    @foreach ($list_penduduk as $penduduk)
                                                    <option value="{{ $penduduk->NIK }}">{{ $penduduk->nama }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group mandatory">
                                            <label for="last-name-column" class="form-label">NIK</label>
                                            <input type="text" id="NIK_penduduk" class="form-control"
                                                   placeholder="NIK_penduduk" value="{{$penduduk->NIK}}" name="NIK_penduduk" data-parsley-required="true" readOnly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group mandatory">
                                            <label for="country-floating" class="form-label">Username</label>
                                            <input type="text" id="username" class="form-control"
                                                   name="username" placeholder="username"  data-parsley-required="true" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RT' ||  Auth::user()->level == 'RW')
                                        <div class="form-group mandatory">
                                            <label for="tanggal_dilantik" class="form-label">Tanggal Mulai Menjabat</label>
                                            <input type="date" id="tanggal_dilantik" class="form-control"
                                                    name="tanggal_dilantik" class="form-control" data-parsley-required="true">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="level" class="form-label">Jabatan</label>
                                                <select id="level" class="form-control" name="level">
                                                    @if(Auth::user()->level == 'admin')
                                                    <option>RW</option>
                                                    @endif
                                                    @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RW')
                                                    <option>RT</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12" id="rtSelectWrapper">
                                            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'RW')
                                            <div class="form-group mandatory">
                                                <label for="rt" class="form-label">RT</label>
                                                <select name="id_rt" id="id_rt" class="form-select choices">
                                                    @foreach ($list_RT as $rt)
                                                        <option value="{{ $rt->id }}">{{ $rt->nama_rt }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                @endif
                                        </div>

                                        <div class="col-md-12 col-12">
                                    <div class="form-group">
                                            <label for="foto_ketua" class="form-label"><strong>Foto Ketua</strong></label>
                                            <input type="file" id="foto_ketua" name="foto_ketua" class="basic-filepond form-control">
                                    </div>
                                </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1"><strong>Tambah</strong></button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End Table --}}
@endsection

@section('scripts')
    <script>
        document.getElementById('nama').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var nik = selectedOption.value; // Get the value of the selected option
            document.getElementById('NIK_penduduk').value = nik; // Set the value of NIK input field
        });


        // Definisikan fungsi untuk menangani visibilitas dan disable elemen RT
        function handleRTVisibilityAndDisable() {
            var selectedOption = document.getElementById('level').value;
            var rtSelectWrapper = document.getElementById('rtSelectWrapper'); // Ambil elemen wrapper
            var rtSelect = document.getElementById('id_rt'); // Ambil elemen RT select

            if (selectedOption === 'RW') { // Jika RW dipilih
                rtSelectWrapper.style.display = 'none'; // Sembunyikan elemen RT
                rtSelect.disabled = true; // Disable elemen RT
            } else { // Jika selain RW dipilih
                rtSelectWrapper.style.display = 'block'; // Tampilkan kembali elemen RT
                rtSelect.disabled = false; // Enable elemen RT
            }
        }

        // Panggil fungsi saat halaman pertama kali dimuat
        handleRTVisibilityAndDisable();

        // Tambahkan event listener pada dropdown level/jabatan
        document.getElementById('level').addEventListener('change', function() {
            handleRTVisibilityAndDisable(); // Panggil fungsi saat ada perubahan pada dropdown
        });
    </script>

@if(session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 4000,
            position: 'center',
            backgroundColor: 'green'
        }).showToast();
        </script>
    @endif

    @if(session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 4000,
            position: 'center',
            backgroundColor: 'red'
        }).showToast();
        </script>
    @endif
@endsection