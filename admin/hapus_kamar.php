<?php 
include '../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data berdasarkan ID
mysqli_query($koneksi, "DELETE FROM kamar WHERE id_kamar='$id'");

// Alihkan kembali ke halaman kamar.php
header("location:kamar.php");
?>