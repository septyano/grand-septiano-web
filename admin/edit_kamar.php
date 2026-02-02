<?php
session_start();
if($_SESSION['status'] != "login") header("location:../login.php");
include '../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM kamar WHERE id_kamar='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nomor  = $_POST['nomor_kamar'];
    $tipe   = $_POST['tipe_kamar'];
    $harga  = $_POST['harga'];
    $status = $_POST['status'];

    $update = mysqli_query($koneksi, "UPDATE kamar SET nomor_kamar='$nomor', tipe_kamar='$tipe', harga='$harga', status='$status' WHERE id_kamar='$id'");
    
    if($update) header("location:kamar.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Kamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="col-md-6 mx-auto card p-4 shadow-sm">
            <h4>Edit Data Kamar</h4>
            <hr>
            <form method="POST">
                <div class="mb-3">
                    <label>Nomor Kamar</label>
                    <input type="text" name="nomor_kamar" class="form-control" value="<?= $d['nomor_kamar'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Tipe Kamar</label>
                    <select name="tipe_kamar" class="form-select">
                        <option value="Standard" <?= $d['tipe_kamar'] == 'Standard' ? 'selected' : '' ?>>Standard</option>
                        <option value="Deluxe" <?= $d['tipe_kamar'] == 'Deluxe' ? 'selected' : '' ?>>Deluxe</option>
                        <option value="Suite" <?= $d['tipe_kamar'] == 'Suite' ? 'selected' : '' ?>>Suite</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= $d['harga'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="Tersedia" <?= $d['status'] == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                        <option value="Terisi" <?= $d['status'] == 'Terisi' ? 'selected' : '' ?>>Terisi</option>
                        <option value="Perbaikan" <?= $d['status'] == 'Perbaikan' ? 'selected' : '' ?>>Perbaikan</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-warning w-100">Update Data</button>
                <a href="kamar.php" class="btn btn-link w-100 mt-2">Kembali</a>
            </form>
        </div>
    </div>
</body>
</html>