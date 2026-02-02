<?php
session_start();
if($_SESSION['status'] != "login") header("location:../login.php");
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Check-in Baru - Septiano Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #0d6efd; --bg-body: #f0f2f5; }
        body { background-color: var(--bg-body); font-family: 'Inter', sans-serif; }
        
        /* Sidebar Melengkung (Referensi Gambar 2) */
        .sidebar { 
            background-color: #0d6efd; 
            min-height: 100vh; 
            padding: 20px; 
            border-top-right-radius: 40px; 
            border-bottom-right-radius: 40px; 
            position: fixed; 
            width: 260px; 
            color: white; 
        }

        .nav-link { 
            color: rgba(255,255,255,0.7); 
            border-radius: 15px; 
            padding: 12px 20px; 
            margin-bottom: 5px; 
            display: flex; 
            align-items: center; 
        }

        .nav-link.active { background-color: rgba(255,255,255,0.2); color: white !important; }

        /* Content Area */
        .main-content { margin-left: 280px; padding: 40px 30px; }

        /* Form Card (Referensi Gambar 3 - Modern & Clean) */
        .form-card { 
            background: white; 
            border-radius: 30px; 
            border: none; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
            padding: 40px; 
        }

        .form-label { font-weight: 600; color: #495057; font-size: 0.9rem; }
        
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
        }

        .form-control:focus {
            background-color: white;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05);
        }

        .btn-checkin {
            background-color: #0d6efd;
            border: none;
            border-radius: 15px;
            padding: 15px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-checkin:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(13, 110, 253, 0.2); }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-5 mt-3"><h4 class="fw-bold">Hotel</h4></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="index.php"><i class="bi bi-grid-fill me-3"></i> Dashboard</a>
        <a class="nav-link" href="kamar.php"><i class="bi bi-door-closed-fill me-3"></i> Data Kamar</a>
        <a class="nav-link" href="tamu.php"><i class="bi bi-person-fill me-3"></i> Data Tamu</a>
        <a class="nav-link active" href="transaksi.php"><i class="bi bi-calendar-check-fill me-3"></i> Reservasi</a>
        <div class="mt-5 pt-5"><a class="nav-link text-white-50" href="../logout.php"><i class="bi bi-box-arrow-left me-3"></i> Logout</a></div>
    </nav>
</div>

<div class="main-content">
    <div class="mb-4">
        <h3 class="fw-bold">Check-in Baru</h3>
        <p class="text-muted">Silakan lengkapi data reservasi tamu di bawah ini.</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="form-card">
                <form action="proses_tambah_reservasi.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Pilih Tamu</label>
                            <select name="id_tamu" class="form-select" required>
                                <option value="">-- Cari Tamu --</option>
                                <?php
                                $tamu = mysqli_query($koneksi, "SELECT * FROM tamu");
                                while($t = mysqli_fetch_array($tamu)){
                                    echo "<option value='".$t['id_tamu']."'>".$t['nama_tamu']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Pilih Kamar (Tersedia)</label>
                            <select name="id_kamar" class="form-select" required>
                                <option value="">-- Pilih Kamar --</option>
                                <?php
                                $kamar = mysqli_query($koneksi, "SELECT * FROM kamar WHERE status='Tersedia'");
                                while($k = mysqli_fetch_array($kamar)){
                                    echo "<option value='".$k['id_kamar']."'>Kamar ".$k['nomor_kamar']." (".$k['tipe_kamar'].")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tanggal Check-in</label>
                            <input type="date" name="tgl_checkin" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Tanggal Check-out</label>
                            <input type="date" name="tgl_checkout" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-checkin w-100">Konfirmasi Reservasi</button>
                        <a href="transaksi.php" class="btn btn-light w-100 mt-2 py-3" style="border-radius:15px;">Batal</a>
                    </div>
                </form>
            </div>
        </div>