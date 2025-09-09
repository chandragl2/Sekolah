<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";
$title = "Tambah Siswa - Universitas Nurtanio";
require_once "../template/header.php";
require_once "../template/navbar.php";
require_once "../template/sidebar.php";

$queryNis = mysqli_query($koneksi, "SELECT max(nis) as maxnis FROM tbl_siswa");
$data = mysqli_fetch_array($queryNis);
$maxnis = $data["maxnis"];

$noUrut = (int) substr($maxnis, 3, 3);
$noUrut++;

$maxnis = "NIS" . sprintf("%03s", $noUrut);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="../siswa/siswa.php">Siswa</a></li>
                <li class="breadcrumb-item active">Tambah Siswa</li>
            </ol>
            <form action="proses-siswa.php" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-plus">
                        </i>Tambah Siswa</span>
                    <button type="submit" name="simpan" class="btn btn-primary float-end"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i
                            class="fa-solid fa-xmark"></i> Reset</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3 row">
                                <label for="nis" class="col-sm-2 col-form-label">Nis</label>
                                <label for="nis" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                    <input type="text" name="nis" readonly class="form-control-plaintext border-bottom ps-2" id="nis"
                                        value="<?= $maxnis ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <label for="Nis" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                    <input type="text" name="nama" required class="form-control border-0 border-bottom ps-2" id="Nis">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                                <label for="Nis" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                    <select name="kelas" id="kelas" class="form-select border-0 border-bottom" required>
                                        <option selected>--Pilih Kelas--</option>
                                        <option value="1">Semester 1</option>
                                        <option value="2">Semester 2</option>
                                        <option value="3">Semester 3</option>
                                        <option value="4">Semester 4</option>
                                        <option value="5">Semester 5</option>
                                        <option value="6">Semester 6</option>
                                        <option value="7">Semester 7</option>
                                        <option value="8">Semester 8</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <label for="Nis" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                    <select name="jurusan" id="jurusan" class="form-select border-0 border-bottom" required>
                                        <option selected>--Pilih Jurusan--</option>
                                        <option value="Teknik">Teknik</option>
                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                        <option value="Ekonomi">Ekonomi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <label for="Nis" class="col-sm-1 col-form-label">:</label>
                                <div class="col-sm-9" style="margin-left: -50px;">
                                    <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="alamat siswa"
                                    class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center px-5">
                            <img src="../asset/image/salinan default.png" alt="" class="mb-3" width="40%">
                            <input type="file" name="image" class="form-control form-control-sm">
                            <small class="text-secondary">Pilih foto PNG, JPG atau JPEG dengan ukuran maximal 1 MB</small>
                            <div><small class="text-secondary width = height"></small></div>
                        </div>
                    </div>
                    </div>
                </div>
                </form>
            </div>
    </main>


<?php
require_once "../template/footer.php";
?>