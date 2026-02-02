<?php
session_start();
if($_SESSION['status'] != "login") header("location:../login.php");
include '../config/koneksi.php';

if(isset($_POST['simpan'])){
    $nomor = $_POST['nomor_kamar'];
    $tipe  = $_POST['tipe_kamar'];
    $harga = $_POST['harga'];
    $fas   = $_POST['fasilitas'];

    $query = mysqli_query($koneksi, "INSERT INTO kamar (nomor_kamar, tipe_kamar, harga, fasilitas, status) VALUES ('$nomor', '$tipe', '$harga', '$fas', 'Tersedia')");
    
    if($query) header("location:kamar.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="col-md-6 mx-auto card p-4 shadow-sm">
            <h4>Tambah Kamar Baru</h4>
            <form method="POST">
                <div class="mb-3">
                    <label>Nomor Kamar</label>
                    <input type="text" name="nomor_kamar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tipe Kamar</label>
                    <select name="tipe_kamar" class="form-select">
                        <option value="Standard">Standard</option>
                        <option value="Deluxe">Deluxe</option>
                        <option value="Suite">Suite</option>
                        <option value="Family">Family</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Harga (Malam)</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Fasilitas</label>
                    <textarea name="fasilitas" class="form-control"></textarea>
                </div>
                <button type="submit" name="simpan" class="btn btn-success">Simpan Kamar</button>
                <a href="kamar.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>