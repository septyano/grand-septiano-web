<?php 
include '../config/koneksi.php'; // Keluar folder admin dulu baru masuk ke config

$id = $_GET['id']; // Mengambil ID dari URL

// Query hapus
$query = mysqli_query($koneksi, "DELETE FROM tamu WHERE id_tamu='$id'");

if($query){
    header("location:tamu.php?pesan=hapus"); // Kembali ke tabel tamu
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
?>