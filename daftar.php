<?php
    // Daftar Jenis Kelamin
    $daftarJenisKelamin = ["Laki-Laki", "Perempuan"];
    // Daftar Agama
    $daftarAgama = ["Islam", "Kristen", "Katolik", "Hindu", "Buddha", "Konghuchu"];
    // Daftar Jurusan
    $daftarJurusan = ["Teknik Elektro", "Teknik Metalurgi", "Teknik Mesin", "Teknik Sipil", "Teknik Kimia", "Teknik Industri"];
    // Matakuliah
    $daftarMatakuliah = ["Dasar Teknik Elektro", "Dasar Teknik Metalurgi", "Dasar Teknik Mesin", "Dasar Teknik Sipil", "Dasar Teknik Kimia", "Dasar Teknik Industri", "Matematika Teknik", "Ekonomi Teknik", "Kalkulus", "Motor Listrik", "Metodologi Penelitian"];

    // mengambil data file json
    $fileDataMahasiswa = "data/data_mahasiswa.json";
    $isiDataMahasiswa = file_get_contents($fileDataMahasiswa);

    $daftarMahasiswa = array();
    // mengubah data mahasiswa menjadi ke array associative
    $daftarMahasiswa = json_decode($isiDataMahasiswa, true);

    if(isset($_POST['btn-simpan'])) { // jika btn-simpan di klik

        // get data dari post
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $tempatLahir = $_POST['tempat-lahir'];
        $tanggal = $_POST['tanggal'];
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $tanggalLahir = sprintf('%02d-%02d-%04d', $tanggal, $bulan, $tahun);
        $agama = $_POST['agama'];
        $alamat = $_POST['alamat'];
        $noTelepon = $_POST['no-telepon'];
        $email = $_POST['email'];
        $jurusan = $_POST['jurusan'];
        $mataKuliah = $_POST['mataKuliah'];
        $nilai = $_POST['nilai'];
        $nilaiMutu = hitungNilai($nilai);
        $lulus = kelulusan($nilai);
        
        // data mahasiswa yang diinput ke dalam array
        $dataMahasiswa = array(
            "nim" => $nim,
            "nama" => $nama,
            "jenisKelamin" => $jenisKelamin,
            "tempatLahir" => $tempatLahir,
            "tanggalLahir" => $tanggalLahir,
            "agama" => $agama,
            "alamat" => $alamat,
            "noTelepon" => $noTelepon,
            "email" => $email,
            "jurusan" => $jurusan,
            "mataKuliah" => $mataKuliah,
            "nilai" => $nilai,
            "nilaiMutu" => $nilaiMutu,
            "lulus" => $lulus
        );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Akhir VSGA</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="index.php">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-border" style="background-color: #0058f2;">
            <div class="container-fluid">
                <a class="navbar-brand">
                    <img src="img/untirta.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top">
                    <p class="par-1 mt-3">Tugas Akhir VSGA G5 - JWD C</p>
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav m-1">
                        <button type="button" class="btn btn-outline-warning custom-color btn-custom-size">
                            <a class="nav-link active" aria-current="page" href="index.php">Form Mahasiswa</a>
                        </button>
                    </div>
                    <div class="navbar-nav m-1">
                        <button type="button" class="btn btn-outline-warning custom-color btn-custom-size">
                            <a class="nav-link active" aria-current="page" href="daftar.php">Daftar Mahasiswa</a>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        
        <!-- Content -->
        <div class="title-content p-2 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3">
            <h4>Daftar Mahasiswa</h4>
        </div>
        <br>
        <div class="container" style="min-height: 500px;">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <td>NIM</td>
                        <td>Nama</td>
                        <td>Jurusan</td>
                        <td>Jenis Kelamin</td>
                        <td>Nilai</td>
                        <td>Mata Kuliah</td>
                        <td>NH</td>
                        <td>KET</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($daftarMahasiswa as $mahasiswa) {
                            echo "<tr>";
                            echo "<td>". $mahasiswa['nim']. "</td>";
                            echo "<td>". $mahasiswa['nama']. "</td>";
                            echo "<td>". $mahasiswa['jenisKelamin']. "</td>";
                            echo "<td>". $mahasiswa['jurusan']. "</td>";
                            echo "<td>". $mahasiswa['mataKuliah']. "</td>";
                            echo "<td>". $mahasiswa['nilai']. "</td>";
                            echo "<td>". $mahasiswa['nilaiMutu']. "</td>";
                            echo "<td>". $mahasiswa['lulus']. "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
    <!-- End Content -->

    <!-- Footer -->
    <div class="title-content p-2 mt-5 text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-3 custom-footer">
        <p>Create by Muhammad Satriyo Yuwono</p>
    </div>
    <!-- End Footer -->

    <!-- Call JS -->
    <script src="js/bootstrap.js"></script>
    <!-- End Call JS -->
</body>
</html>