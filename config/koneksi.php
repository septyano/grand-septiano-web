<?php
// Gunakan variabel ini untuk mempermudah penggantian
$host     = "sql105.infinityfree.com";
$user     = "if0_41055842";
$pass     = "ISI_PASSWORD_KAMU_DISINI"; // Jangan biarkan kosong jika di hosting
$database = "if0_41055842_db_hotel";

$koneksi = mysqli_connect($host, $user, $pass, $database);

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
}
?>