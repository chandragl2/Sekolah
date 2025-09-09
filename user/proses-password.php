<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $CurPass = trim(htmlspecialchars($_POST['CurPass']));
    $NewPass = trim(htmlspecialchars($_POST['NewPass']));
    $ConfPass = trim(htmlspecialchars($_POST['ConfPass']));

    $username = $_SESSION['ssUser'];
    $queryUser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    $data = mysqli_fetch_array($queryUser);

    if ($NewPass !== $ConfPass) {
        header("location:password.php?msg=err1");
        exit;
    }

    if (!password_verify($CurPass, $data['password'])) {
        header("location:password.php?msg=err2");
        exit;
    } else {
        $pass = password_hash($NewPass, PASSWORD_DEFAULT);
        $update = mysqli_query($koneksi, "UPDATE tbl_user SET password = '$pass' WHERE username = '$username'");

        if ($update) {
            header("location:password.php?msg=updated");
        } else {
            header("location:password.php?msg=err3"); // Menambahkan pesan kesalahan jika update gagal
        }
        exit;
    }
}
