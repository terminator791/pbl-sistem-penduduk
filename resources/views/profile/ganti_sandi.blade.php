@extends('layouts.default-ui')

@section('heading')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            @if (Auth::user()->level == 'admin')
                    <h3>Ganti Kata Sandi Admin</h3>
                @elseif (Auth::user()->level == 'RW')
                    <h3>Ganti Kata Sandi RW 13 ,  {{ $username }}</h3>
                @elseif(Auth::user()->level == 'RT')
                    <h3>Ganti Kata Sandi {{ $username }}</h3>
                @elseif(Auth::user()->level == 'pemilik_kos')
                    <h3>Ganti Kata Sandi pemilik kos  {{ $username }}</h3>
                @endif
                <p class="text-subtitle text-muted">
                    Ganti Kata Sandi
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Ganti Kata Sandi
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- Start Table --}}
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ganti Kata Sandi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('profile.ganti_sandi') }}" data-parsley-validate enctype="multipart/form-data" id="password-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group" style="position: relative;">
                                            <label for="last-name-column" class="form-label">Kata sandi Lama</label>
                                            <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Kata Sandi Lama"  style="padding-left:30px;">
                                            <span toggle="#password_lama" class="bi bi-eye-fill field-icon toggle-password" style="position: absolute; left: 8px; top: 53%; cursor: pointer;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <div class="form-group" style="position: relative;">
    <label for="last-name-column" class="form-label">Kata sandi Baru</label>
    <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Kata Sandi Baru"  style="padding-left:30px;">
    <span toggle="#password_baru" class="bi bi-eye-fill field-icon toggle-password" style="position: absolute; left: 8px; top: 53%; cursor: pointer;"></span>
    <label for="password_baru" class="invalid-feedback" style="display: none; position: absolute; top: 53%; left: 150px;"></label>

</div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1"><strong>Perbarui</strong></button>
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
        $(".toggle-password").click(function() {
            $(this).toggleClass("bi-eye bi-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $("#password_baru").on('input', function() {
    var password_baru = $(this).val();
    var errorLabel = $("label[for='password_baru']");

    if (password_baru.length < 6) {
        // Jika password kurang dari 6 karakter, tampilkan pesan kesalahan di sebelah kanan input
        errorLabel.text("Password harus minimal 6 karakter");
        errorLabel.css({"display": "inline-block", "color": "red", "font-size": "0.85rem"});
        $(this).addClass("is-invalid");
    } else {
        // Sembunyikan pesan kesalahan jika password sudah memenuhi syarat
        errorLabel.hide();
        $(this).removeClass("is-invalid");
    }
});

$("#password-form").submit(function(event) {
    var password_lama = $("#password_lama").val();
    var password_baru = $("#password_baru").val();

    // Validasi password lama
    if (password_lama === "") {
        event.preventDefault();
        var errorLabel = $("label[for='password_lama']");
        errorLabel.text("Password Lama harus diisi");
        errorLabel.css({"display": "inline-block", "color": "red", "font-size": "0.85rem"});
        $("#password_lama").addClass("is-invalid");
    }

    // Validasi password baru
    if (password_baru.length < 6) {
        event.preventDefault();
        var errorLabel = $("label[for='password_baru']");
        errorLabel.text("Password harus minimal 6 karakter");
        errorLabel.css({"display": "inline-block", "color": "red", "font-size": "0.85rem"});
        $("#password_baru").addClass("is-invalid");
    }
});




        

        // $("#password_lama").on('input', function() {
        //     var password_lama = $(this).val();
        //     var password_asli = "{{$password}}"; // Password dari database
        //     if (password_lama === password_asli) {
        //         $(this).removeClass("is-invalid").addClass("is-valid");
        //         $(".valid-feedback").show();
        //         $(".invalid-feedback").hide();
        //     } else {
        //         $(this).removeClass("is-valid").addClass("is-invalid");
        //         $(".valid-feedback").hide();
        //         $(".invalid-feedback").show();
        //     }
        // });
    </script>

@if ($errors->has('password_lama'))
<script>
        Toastify({
            text: "{{ $errors->first('password_lama') }}",
            duration: 8000,
            position: 'center',
            backgroundColor: 'red'
        }).showToast();
        </script>
@endif

@if(session('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 8000,
            position: 'center',
            backgroundColor: 'red'
        }).showToast();
        </script>
    @endif
@endsection
