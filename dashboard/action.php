<?php
include("../connection.php");
session_start();

date_default_timezone_set("Asia/Jakarta"); //set waktu sesuai wilayah

$user_id = $_SESSION['user_id'];
$tanggal = date('Y-m-d');
$time = date('H:i:s');

$check_absen = "SELECT * FROM absensi WHERE user_id='$user_id' AND tanggal='$tanggal'";
$check = $db->query($check_absen);

if ($check->num_rows> 0) {
    //Jika user sudah absen di hari ini
    header("location:index.php?message=Anda telah Clock In hari ini!");
}else {
    //Jika user belum absen di hari ini, maka user bisa absen
    $sql = "INSERT INTO absensi (`id`, `user_id`, `tanggal`, `jam_masuk`, `jam_keluar`)
    VALUES (NULL, '$user_id', '$tanggal', '$time', NULL)";

    $result = $db->query($sql);

    if ($result === TRUE) {
        header("location:index.php?message=Terima kasih telah Clock In hari ini!");
    } else {
        header("location:index.php?message=Clock In anda gagal, coba lagi!");
    }
}


?>