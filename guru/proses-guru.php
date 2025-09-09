<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";

if (!isset($_POST['Simpan'])) {
    $nip    = htmlspecialchars($_POST['nip']);
    $nama   = htmlspecialchars($_POST['nama']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $agama  = $_POST['agama'];
    $alamat = htmlspecialchars($_POST['alamat']);
    $foto = htmlspecialchars($_FILES['image']['name']);

    $cekNip = mysqli_query($koneksi, "SELECT nip FROM tbl_dosen WHERE nip = '$nip'");
    if (mysqli_num_rows($cekNip) > 0) {
        header('location:add-guru.php?msg=cancel');
        return;
    }

    if ($foto != null) {
        $url = "add-guru.php";
        $foto = uploadimg($url);
    } else {
        $foto = 'Salinan default';
    }

    mysqli_query($koneksi, "INSERT INTO tbl_dosen (nip, nama, alamat, telepon, agama, foto) VALUES ('$nip', '$nama', '$alamat', '$telepon', '$agama', '$foto')");

    header("location:add-guru.php?msg=added");
    return;
}
