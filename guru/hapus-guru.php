<?php

session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("Location:../auth/login.php");
    exit();
}


require_once "../config.php";

$id = $_GET["id"];
$foto = $_GET["foto"];

mysqli_query($koneksi, "DELETE FROM tbl_dosen WHERE id = '$id'");
if ($foto != 'Salinan default.png') {
    unlink('../asset/image/' . $foto);
}



header("location:guru.php?msg=deleted");
