<?php
session_start();
if($_SESSION['status'] != "login") header("location:../login.php");
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Reservasi - Septiano Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
        .sidebar { background-color: white; min-height: 100vh; padding: 20px; border-top-right-radius: 40px; border-bottom-right-radius: 40px; box-shadow: 10px 0 20px rgba(0,0,0,0.05); position: fixed; width: 260px; }
        .nav-link { color: #6c757d; border-radius: 15px; padding: 12px 20px; margin-bottom: 5px; font-weight: 500; display: flex; align-items: center; }
        .nav-link:hover, .nav-link.active { background-color: #0d6efd; color: white !important; }
        .main-content { margin-left: 280px; padding: 40px 30px; }
        .card-table { background: white; border-radius: 30px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.02); padding: 30px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-5 mt-3"><h4 class="fw-bold text-primary">Hotel</h4></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="index.php"><i class="bi bi-grid-fill me-3"></i> Dashboard</a>
        <a class="nav-link" href="kamar.php"><i class="bi bi-door-closed-fill me-3"></i> Data Kamar</a>
        <a class="nav-link" href="tamu.php"><i class="bi bi-person-fill me-3"></i> Data Tamu</a>
        <a class="nav-link active" href="transaksi.php"><i class="bi bi-calendar-check-fill me-3"></i> Reservasi</a>
        <div class="mt-5 pt-5"><a class="nav-link text-danger" href="../logout.php"><i class="bi bi-box-arrow-left me-3"></i> Logout</a></div>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Riwayat Reservasi</h3>
        <a href="tambah_reservasi.php" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-plus-lg me-2"></i>Check-in Baru</a>
    </div>

    <div class="card-table">
        <table class="table align-middle">
            <thead class="text-muted">
                <tr>
                    <th>TAMU</th>
                    <th>KAMAR</th>
                    <th>CHECK-IN</th>
                    <th>CHECK-OUT</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Gabungkan tabel transaksi, tamu, dan kamar agar muncul nama & nomor kamar
                $query = mysqli_query($koneksi, "SELECT * FROM transaksi 
                         JOIN tamu ON transaksi.id_tamu = tamu.id_tamu 
                         JOIN kamar ON transaksi.id_kamar = kamar.id_kamar 
                         ORDER BY id_transaksi DESC");
                while($d = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td>
                        <div class="fw-bold"><?php echo $d['nama_tamu']; ?></div>
                        <small class="text-muted"><?php echo $d['no_hp']; ?></small>
                    </td>
                    <td><span class="badge bg-light text-dark border">Kamar <?php echo $d['nomor_kamar']; ?></span></td>
                    <td><?php echo $d['tgl_checkin']; ?></td>
                    <td><?php echo $d['tgl_checkout']; ?></td>
                    <td>
                        <span class="badge rounded-pill <?php echo ($d['status_transaksi'] == 'Check-in') ? 'bg-primary' : 'bg-secondary'; ?>">
                            <?php echo $d['status_transaksi']; ?>
                        </span>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>