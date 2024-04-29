<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Warga - Cetak</title>
    <!-- Include Bootstrap CSS jika diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Aturan CSS */
        .fade-row {
            opacity: 0.5;
            /* Sesuaikan dengan tingkat opasitas yang diinginkan */
            transition: opacity 0.3s ease;
            /* Animasi perubahan opasitas */
        }

        .fade-row:hover {
            opacity: 1;
            /* Opasitas kembali ke normal saat dihover */
        }

        .fade-row td {
            text-decoration: line-through;
        }
        th,td {
                text-align: center;
        }
    </style>
</head>
<body>
<div class="card-body">
    <h2>Data Warga Asli</h2><br>
    <div class="table-responsive">
        <table class="table table-hover" id="table3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="wargaData">
                <!-- Data Warga akan dimasukkan di sini -->
            </tbody>
        </table>
    </div>
</div>

<!-- Include Bootstrap JS jika diperlukan -->
<!-- <script src="path/to/bootstrap.js"></script> -->
<script>
    // Fungsi untuk mendapatkan data warga menggunakan HTTP Request
    function getData() {
        fetch('{{ route("wargaAsli.fetchAll") }}')
        .then(response => response.json())
        .then(data => {
            // Memasukkan data ke dalam tabel
            const tableBody = document.getElementById('wargaData');
            data.forEach((warga, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${warga.NIK}</td>
                        <td>${warga.nama}</td>
                        <td>${warga.nama_jalan}, RT ${warga.id_rt}, RW ${warga.id_rw}</td>
                        <td>${warga.status_penghuni}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error:', error));
    }

    // Panggil fungsi getData saat halaman dimuat
    getData();
</script>
</body>
</html>
