<?php 
session_start();
session_destroy(); // Menghapus semua data login
header("location:login.php?pesan=logout"); // Lempar kembali ke login
?>