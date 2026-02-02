<?php
session_start();
if($_SESSION['status'] != "login") header("location:../login.php");
include '../config/koneksi.php';

// Statistik singkat
$kamar_tersedia = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kamar WHERE status='Tersedia'"));
$tamu_total = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tamu"));
$transaksi_aktif = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status_transaksi='Check-in'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Modern - Septiano Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --bg-body: #f0f2f5;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Sidebar Styling (Mirip Gambar Google Drive yang kamu kirim) */
        .sidebar {
            background-color: white;
            min-height: 100vh;
            padding: 20px;
            border-top-right-radius: 40px;
            border-bottom-right-radius: 40px;
            box-shadow: 10px 0 20px rgba(0,0,0,0.05);
            position: fixed;
            width: 260px;
            z-index: 100;
        }

        .nav-link {
            color: #6c757d;
            border-radius: 15px;
            padding: 12px 20px;
            margin-bottom: 5px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--primary-color);
            color: white !important;
        }

        .nav-link i {
            font-size: 1.2rem;
            margin-right: 15px;
        }

        /* Content Area */
        .main-content {
            margin-left: 280px;
            padding: 40px 30px;
        }

        /* Card Styling (Mirip "Quick Access" di gambar kamu) */
        .stat-card {
            background: white;
            border: none;
            border-radius: 25px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.02);
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: scale(1.03);
            box-shadow: 0 15px 30px rgba(13, 110, 253, 0.1);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .bg-blue-light { background: #e7f0ff; color: #0d6efd; }
        .bg-green-light { background: #e8f5e9; color: #2e7d32; }
        .bg-purple-light { background: #f3e5f5; color: #7b1fa2; }

    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-5 mt-3">
        <h4 class="fw-bold text-primary"><i class="bi bi-building-fill me-2"></i>Hotel</h4>
    </div>
    
    <nav class="nav flex-column">
        <a class="nav-link active" href="index.php"><i class="bi bi-grid-fill"></i> Dashboard</a>
        <a class="nav-link" href="kamar.php"><i class="bi bi-door-closed-fill"></i> Data Kamar</a>
        <a class="nav-link" href="tamu.php"><i class="bi bi-person-fill"></i> Data Tamu</a>
        <a class="nav-link" href="transaksi.php"><i class="bi bi-calendar-check-fill"></i> Reservasi</a>
        <div class="mt-5 pt-5">
            <a class="nav-link text-danger" href="../logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
        </div>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-1">Halo, Septiano! 👋</h2>
            <p class="text-muted">Inilah aktivitas penginapan kamu hari ini.</p>
        </div>
        <img src="https://ui-avatars.com/api/?name=Septiano&background=0D6EFD&color=fff" class="rounded-circle shadow-sm" width="50" alt="Avatar">
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="icon-circle bg-blue-light">
                    <i class="bi bi-door-open-fill"></i>
                </div>
                <p class="text-muted mb-1">Kamar Kosong</p>
                <h3 class="fw-bold mb-0"><?= $kamar_tersedia ?> Kamar</h3>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="icon-circle bg-green-light">
                    <i class="bi bi-people-fill"></i>
                </div>
                <p class="text-muted mb-1">Total Tamu</p>
                <h3 class="fw-bold mb-0"><?= $tamu_total ?> Orang</h3>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card">
                <div class="icon-circle bg-purple-light">
                    <i class="bi bi-clipboard-check-fill"></i>
                </div>
                <p class="text-muted mb-1">Check-in Hari Ini</p>
                <h3 class="fw-bold mb-0"><?= $transaksi_aktif ?> Aktif</h3>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="stat-card p-4">
                <h5 class="fw-bold mb-4">Aksi Cepat</h5>
                <div class="d-flex gap-3">
                    <a href="tambah_reservasi.php" class="btn btn-primary px-4 py-2 rounded-pill shadow">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Check-in
                    </a>
                    <a href="kamar.php" class="btn btn-outline-primary px-4 py-2 rounded-pill">
                        Lihat Daftar Kamar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>