<?php 
include '../config/koneksi.php';

// Menangkap data yang dikirim dari form
$id_tamu      = $_POST['id_tamu'];
$id_kamar     = $_POST['id_kamar'];
$tgl_checkin  = $_POST['tgl_checkin'];
$tgl_checkout = $_POST['tgl_checkout'];
$status       = "Check-in"; // Status reservasi baru

// 1. Input data ke tabel transaksi
$query_transaksi = "INSERT INTO transaksi (id_tamu, id_kamar, tgl_checkin, tgl_checkout, status_transaksi) 
                    VALUES ('$id_tamu', '$id_kamar', '$tgl_checkin', '$tgl_checkout', '$status')";

if(mysqli_query($koneksi, $query_transaksi)){
    
    // 2. UPDATE status kamar menjadi 'Terisi' agar tidak bisa dipesan orang lain
    mysqli_query($koneksi, "UPDATE kamar SET status='Terisi' WHERE id_kamar='$id_kamar'");
    
    // Kembali ke halaman transaksi dengan pesan sukses
    header("location:transaksi.php?pesan=berhasil");
} else {
    // Jika gagal
    echo "Gagal menambahkan reservasi: " . mysqli_error($koneksi);
}
?>