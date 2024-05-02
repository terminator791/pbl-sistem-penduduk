<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kependudukan</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @include('includes.style')

</head>

<style type="text/css">
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
    }
    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        font: 14px arial;
    }
</style>

<body>
    {{-- Preloader --}}
<div class="preloader">
    <div class="loading">
        <img src="{{ asset('storage/loading.gif') }}" width="100">
        <p>Harap Tunggu</p>
    </div>
</div>

    <script src="{{ asset('dist/assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="card bg-primary text-center">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center mt-2">
                                <div class="logo ">
                                    <h5 style="color: white; ">Sistem Kependudukan</h5>
                                    <img src="{{ asset('storage/logo_putih_mepet.png') }}" style="width: 200px; height: auto;">
                                </div>
                    {{-- dark mode --}}
                    <div class="theme-toggle d-flex gap-2 align-items-center justify-content-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        aria-hidden="true" role="img" class="iconify iconify--system-uicons"
                                        width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                        <g fill="none" fill-rule="evenodd" stroke="white" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                                opacity=".3"></path>
                                            <g transform="translate(-210 -1)">
                                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                        <div class="form-check form-switch fs-6">
                            <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                            <label class="form-check-label"></label>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                        class="iconify iconify--mdi" width="20" height="20"
                                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                        <path fill="white"
                                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                        </path>
                                    </svg>
                    </div>
                </div>
            </div>
            {{-- hide toggle sidebar --}}
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    {{-- include sidebar --}}
    @include('includes.sidebar')
</div>

        </div>
        <div id="main" class="background-light">
            <style>
                /* Pagination Style */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5rem 0.75rem;
    margin-left: 2px;
    font-size: 0.875rem;
    color: #6c757d;
    border: 1px solid #dee2e6;
    background-color: transparent; /* Ubah latar belakang menjadi transparan */
    transition: background-color 0.3s, color 0.3s; /* Tambahkan efek transisi */
    border-radius: 0.25rem; /* Tambahkan sedikit border-radius */
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #f0f0f0; /* Ubah latar belakang saat hover */
    color: #333; /* Ubah warna teks saat hover */
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    color: #6c757d;
    background-color: transparent;
    cursor: not-allowed;
    border-color: #dee2e6;
}

.dataTables_wrapper .dataTables_paginate .ellipsis {
    padding: 0.5rem 0.75rem;
    margin-left: 2px;
    font-size: 0.875rem;
    color: #6c757d;
    border: 1px solid #dee2e6;
    background-color: transparent;
}

.dataTables_wrapper .dataTables_paginate .pagination {
    margin-top: 1rem;
}

/* Responsive Styling */
@media screen and (max-width: 768px) {
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-size: 0.75rem; /* Kurangi ukuran font saat layar kecil */
        padding: 0.25rem 0.5rem; /* Sesuaikan padding */
        margin-left: 0; /* Hilangkan margin kiri */
    }
}

/* Search Input Style */
.dataTables_filter input {
    border: 1px solid #ccc; /* Border color */
    border-radius: 5px; /* Rounded corners */
    padding: 4px 8px; /* Padding */
    width: 100px; /* Width of the input */
    margin-bottom: 10px; /* Margin bottom for spacing */
    font-size: 14px; /* Font size */
    outline: none; /* Remove outline */
}

.dataTables_filter input:focus {
    border-color: #007bff; /* Border color on focus */
    box-shadow: 0 0 25px rgba(0, 123, 255, 0.5); /* Box shadow on focus */
}

/* table.dataTable tbody th,
    table.dataTable tbody td {
        text-align: center;
    } */
    table.dataTable thead th,
    table.dataTable tfoot th {
        text-align: center;
    }
                .background-light {
                    background-color: #D5E3F0; /* Warna biru muda untuk light mode */
                }

                .background-dark {
                    background-color: purple-violet; /* Warna purple-violet untuk dark mode */
                }

                                /* Custom Modal Styles */
                .modal-content {
                    border-radius: 20px; /* Mengatur border-radius untuk modal */
                    box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1); /* Menambahkan shadow */
                    background-color: #fff; /* Mengatur warna latar belakang modal */
                }

                .modal-header {
                    background-color: #f0f4f7; /* Mengatur warna latar belakang header modal */
                    border-top-left-radius: 20px; /* Mengatur border-radius atas kiri */
                    border-top-right-radius: 20px; /* Mengatur border-radius atas kanan */
                }

                .modal-title {
                    font-weight: bold; /* Mengatur ketebalan font judul modal */
                }

                .modal-body {
                    color: #444; /* Mengatur warna teks konten modal */
                }

                .btn-close {
                    color: #999; /* Mengatur warna ikon close modal */
                    font-size: 1.5rem; /* Mengatur ukuran font ikon close */
                    opacity: 0.7; /* Mengatur kecerahan ikon close */
                }

                .btn-close:hover {
                    color: #666; /* Mengubah warna ikon close saat dihover */
                    opacity: 1; /* Meningkatkan kecerahan ikon close saat dihover */
                }

            </style>

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            {{-- tittle header --}}
            <div class="page-heading">
                @yield('heading')
            </div>

            <div class="page-content">
                @yield('content')
            </div>

            {{-- include footer --}}
            @include('includes.footer')
        </div>
    </div>

    {{-- include script --}}
    @include('includes.script')
    @yield('scripts')

    <script>
    const toggleDarkMode = document.getElementById('toggle-dark');
    const mainContent = document.getElementById('main');

    // Fungsi untuk mengatur mode berdasarkan preferensi yang disimpan
    function setMode() {
        const savedMode = localStorage.getItem('mode');
        if (savedMode === 'dark') {
            enableDarkMode();
        } else {
            enableLightMode();
        }
    }

    // Fungsi untuk mengaktifkan mode gelap
    function enableDarkMode() {
        mainContent.classList.remove('background-light');
        mainContent.classList.add('background-dark');
        toggleDarkMode.checked = true;
    }

    // Fungsi untuk mengaktifkan mode terang
    function enableLightMode() {
        mainContent.classList.remove('background-dark');
        mainContent.classList.add('background-light');
        toggleDarkMode.checked = false;
    }

    // Memanggil fungsi untuk mengatur mode saat halaman dimuat
    setMode();

    // Mendengarkan perubahan pada toggle mode gelap
    toggleDarkMode.addEventListener('change', function () {
        if (toggleDarkMode.checked) {
            enableDarkMode();
            localStorage.setItem('mode', 'dark'); // Menyimpan preferensi mode
        } else {
            enableLightMode();
            localStorage.setItem('mode', 'light'); // Menyimpan preferensi mode
        }
    });
</script>

</body>

</html>

<script>
    $(document).ready(function(){
        $(".preloader").fadeOut();
    })
</script>

