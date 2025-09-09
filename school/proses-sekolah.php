<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

// jika tombol simpan ditekan

if (isset($_POST['simpan'])) {
    // ambil value yang diposting

    $id     = $_POST['id'];
    $nama   = trim(htmlspecialchars($_POST['nama']));
    $email  = trim(htmlspecialchars($_POST['Email']));
    $status = $_POST['status'];
    $akreditasi = $_POST['akreditasi'];
    $alamat = trim(htmlspecialchars($_POST['alamat']));
    $visimisi = trim(htmlspecialchars($_POST['visimisi']));
    $gambar = trim(htmlspecialchars($_POST['gambar']));

    // cek apakah gambar user 
    if ($_FILES['image']['error'] === 4) {
        $gbrSekolah = $gbr;
    } else {
        $url = 'profile-sekolah.php';
        $gbrSekolah = uploadimg($url);
        @unlink('../asset/image/' . $gbr);
    }

    // update data

    mysqli_query($koneksi, "UPDATE tbl_sekolah SET 
                            nama  = '$nama',
                            email = '$email',
                            status = '$status',
                            akreditasi = '$akreditasi',
                            alamat = '$alamat',
                            visimisi = '$visimisi',
                            gambar = '$gbrSekolah'
                            WHERE id = $id
                            ");
    header("location:profile-sekolah.php?msg=updated");
    return;
}
