<?php
session_start();
include 'config/koneksi.php'; // Pastikan path file koneksi benar

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// Mencari admin di database
$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);
    $_SESSION['id_admin'] = $data['id_admin'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama']     = $data['nama_lengkap'];
    $_SESSION['status']   = "login";
    
    // Jika berhasil, lempar ke halaman dashboard
    header("location:admin/index.php");
} else {
    // Jika gagal, kembali ke login dengan pesan error
    echo "<script>alert('Username atau Password Salah!'); window.location='login.php';</script>";
}
?>