<?php
session_start();
if($_SESSION['status'] != "login") header("location:../login.php");
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu - Septiano Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #0d6efd; --bg-body: #f0f2f5; }
        body { background-color: var(--bg-body); font-family: 'Inter', sans-serif; }
        .sidebar { background-color: #0d6efd; min-height: 100vh; padding: 20px; border-top-right-radius: 40px; border-bottom-right-radius: 40px; position: fixed; width: 260px; z-index: 100; color: white; }
        .nav-link { color: rgba(255,255,255,0.7); border-radius: 15px; padding: 12px 20px; margin-bottom: 5px; display: flex; align-items: center; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: rgba(255,255,255,0.2); color: white !important; }
        .main-content { margin-left: 280px; padding: 40px 30px; }
        .card-custom { background: white; border-radius: 25px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.02); padding: 30px; }
        .table thead th { border: none; color: #adb5bd; font-size: 0.8rem; text-transform: uppercase; }
        .avatar-tamu { width: 40px; height: 40px; border-radius: 12px; background: #e7f0ff; color: #0d6efd; display: flex; align-items: center; justify-content: center; font-weight: bold; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-5 mt-3"><h4 class="fw-bold"><i class="bi bi-building-fill me-2"></i>Hotel</h4></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="index.php"><i class="bi bi-grid-fill me-3"></i> Dashboard</a>
        <a class="nav-link" href="kamar.php"><i class="bi bi-door-closed-fill me-3"></i> Data Kamar</a>
        <a class="nav-link active" href="tamu.php"><i class="bi bi-person-fill me-3"></i> Data Tamu</a>
        <a class="nav-link" href="transaksi.php"><i class="bi bi-calendar-check-fill me-3"></i> Reservasi</a>
        <div class="mt-5 pt-5"><a class="nav-link text-white-50" href="../logout.php"><i class="bi bi-box-arrow-left me-3"></i> Logout</a></div>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Daftar Tamu</h3>
        <a href="tambah_tamu.php" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-plus-lg me-2"></i>Tambah Tamu</a>
    </div>

    <div class="card-custom">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>TAMU</th>
                    <th>KONTAK</th>
                    <th>ALAMAT</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM tamu");
                while($d = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-tamu me-3"><?= substr($d['nama_tamu'], 0, 1) ?></div>
                            <div class="fw-bold text-dark"><?= $d['nama_tamu'] ?></div>
                        </div>
                    </td>
                    <td><i class="bi bi-telephone text-muted me-2"></i><?= $d['no_hp'] ?></td>
                    <td class="text-muted small"><?= $d['alamat'] ?></td>
                    <td class="text-center">
                        <a href="edit_tamu.php?id=<?= $d['id_tamu'] ?>" class="btn btn-light btn-sm rounded-3 me-1"><i class="bi bi-pencil text-warning"></i></a>
                        <a href="hapus_tamu.php?id=<?= $d['id_tamu'] ?>" class="btn btn-light btn-sm rounded-3 text-danger" onclick="return confirm('Hapus data tamu?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>