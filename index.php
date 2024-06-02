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

        // memasukkan array data mahasiswa yang baru, ke daftar mahasiswa sebelumnya
        array_push($daftarMahasiswa, $dataMahasiswa);

        // mengubah array data mahasiswa ke json format
        $dataYangInginDitulisKeFile = json_encode($daftarMahasiswa, JSON_PRETTY_PRINT);

        // tulis ke file data ke json
        file_put_contents($fileDataMahasiswa, $dataYangInginDitulisKeFile);

        // redirect ke halaman index.php
        header("Location: index.php");
        exit();
    }


    function hitungNilai($nilai) {
        if ($nilai >= 91 && $nilai <= 100) {
            return "A";
        } else if ($nilai >= 81 && $nilai <= 90) {
            return "B";
        } else if ($nilai >= 71 && $nilai <= 80) {
            return "C";
        } else if ($nilai >= 61 && $nilai <= 70) {
            return "D";
        } else if ($nilai >= 0 && $nilai <= 60) {
            return "E";
        } else {
            return "Nilai tidak valid";
        }
    }
    
    function kelulusan($nilai) {
        if ($nilai >= 71 && $nilai <= 100) {
            return "Lulus";
        } else if ($nilai >= 0 && $nilai <= 70) {
            return "Tidak Lulus";
        } else {
            return "Nilai tidak valid";
        }
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
            <h4>Form Mahasiswa</h4>
        </div>
        <div class="container text-left mt-3">
            <div class="row justify-content-around">
                <div class="col-4">
                    <!-- NIM -->
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" name="nim" id="nim" class="form-control">
                    <!-- Nama -->
                    <label for="nama" class="form-label mt-3">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                    <!-- Jenis Kelamin -->
                    <label for="jenisKelamin" class="form-label mt-3">Jenis Kelamin</label>
                    <select name="jenisKelamin" id="jenisKelamin" class="form-select">
                        <?php
                        foreach($daftarJenisKelamin as $kelamin) {
                            echo "<option value='$kelamin'> $kelamin </option>";
                        }
                        ?>
                    </select>
                    <!-- Tempat Lahir -->
                    <label for="tempat-lahir" class="form-label mt-3">Tempat Lahir</label>
                    <input type="text" name="tempat-lahir" id="tempat-lahir" class="form-control">
                    <!-- Tanggal Lahir -->
                    <label for="tanggal-lahir" class="form-label mt-3">Tanggal Lahir</label>
                    <div class="row">
                        <div class="col">
                            <select name="tanggal" id="tanggal" class="form-select" required>
                                <option value="">Tanggal</option>
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <select name="bulan" id="bulan" class="form-select" required>
                                <option value="">Bulan</option>
                                <?php
                                $bulan = [
                                    1 => "Januari",
                                    2 => "Februari",
                                    3 => "Maret",
                                    4 => "April",
                                    5 => "Mei",
                                    6 => "Juni",
                                    7 => "Juli",
                                    8 => "Agustus",
                                    9 => "September",
                                    10 => "Oktober",
                                    11 => "November",
                                    12 => "Desember"
                                ];
                                foreach ($bulan as $num => $name) {
                                    echo "<option value='$num'>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <select name="tahun" id="tahun" class="form-select" required>
                                <option value="">Tahun</option>
                                <?php
                                $currentYear = date("Y");
                                for ($i = $currentYear; $i >= 1900; $i--) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- Agama -->
                    <label for="agama" class="form-label mt-3">Agama</label>
                    <select name="agama" id="agama" class="form-select">
                        <?php
                        foreach($daftarAgama as $agama) {
                            echo "<option value='$agama'> $agama </option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-4">
                    <!-- Alamat -->
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control">
                    <!-- No Telepon -->
                    <label for="no-telepon" class="form-label">No. Telepon</label>
                    <input type="text" name="no-telepon" id="no-telepon" class="form-control">
                    <!-- email -->
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                    <!-- Jurusan -->
                    <label for="jurusan" class="form-label mt-3">Jurusan</label>
                    <select name="jurusan" id="jurusan" class="form-select">
                        <?php
                        foreach($daftarJurusan as $jurusan) {
                            echo "<option value='$jurusan'> $jurusan </option>";
                        }
                        ?>
                    </select>
                    <!-- Matakuliah -->
                    <label for="mataKuliah" class="form-label mt-3">Matakuliah</label>
                    <select name="mataKuliah" id="mataKuliah" class="form-select">
                        <?php
                        foreach($daftarMatakuliah as $mataKuliah) {
                            echo "<option value='$mataKuliah'> $mataKuliah </option>";
                        }
                        ?>
                    </select>
                    <!-- Nilai -->
                    <label for="nilai" class="form-labe mt-3">Nilai</label>
                    <input type="text" name="nilai" id="nilai" class="form-control">
                    <!-- Button Simpan -->
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col align-self-center">
                    <button type="submit" class="btn btn-primary mt-3 custom-button" name="btn-simpan" id="btn-simpan">Simpan</button>
                </div>
            </div>
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