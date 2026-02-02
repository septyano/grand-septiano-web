<?php
session_start();
if($_SESSION['status'] != "login") header("location:../login.php");
include '../config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Kamar - Septiano Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
        .sidebar { background-color: white; min-height: 100vh; padding: 20px; border-top-right-radius: 40px; border-bottom-right-radius: 40px; box-shadow: 10px 0 20px rgba(0,0,0,0.05); position: fixed; width: 260px; }
        .nav-link { color: #6c757d; border-radius: 15px; padding: 12px 20px; margin-bottom: 5px; font-weight: 500; display: flex; align-items: center; }
        .nav-link:hover, .nav-link.active { background-color: #0d6efd; color: white !important; }
        .main-content { margin-left: 280px; padding: 40px 30px; }
        .card-table { background: white; border-radius: 30px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.02); padding: 30px; }
        .table thead th { border: none; color: #adb5bd; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; }
        .badge-status { border-radius: 10px; padding: 8px 15px; font-size: 0.85rem; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="text-center mb-5 mt-3"><h4 class="fw-bold text-primary">Hotel</h4></div>
    <nav class="nav flex-column">
        <a class="nav-link" href="index.php"><i class="bi bi-grid-fill me-3"></i> Dashboard</a>
        <a class="nav-link active" href="kamar.php"><i class="bi bi-door-closed-fill me-3"></i> Data Kamar</a>
        <a class="nav-link" href="tamu.php"><i class="bi bi-person-fill me-3"></i> Data Tamu</a>
        <a class="nav-link" href="transaksi.php"><i class="bi bi-calendar-check-fill me-3"></i> Reservasi</a>
        <div class="mt-5 pt-5"><a class="nav-link text-danger" href="../logout.php"><i class="bi bi-box-arrow-left me-3"></i> Logout</a></div>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Manajemen Kamar</h3>
        <a href="tambah_kamar.php" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-plus-lg me-2"></i>Tambah Kamar</a>
    </div>

    <div class="card-table">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>NOMOR</th>
                    <th>TIPE KAMAR</th>
                    <th>HARGA / MALAM</th>
                    <th>STATUS</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM kamar");
                while($d = mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td class="fw-bold text-primary">#<?php echo $d['nomor_kamar']; ?></td>
                    <td><?php echo $d['tipe_kamar']; ?></td>
                    <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <span class="badge-status <?php echo ($d['status'] == 'Tersedia') ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger'; ?>">
                            <i class="bi bi-circle-fill me-2" style="font-size: 0.5rem;"></i><?php echo $d['status']; ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="edit_kamar.php?id=<?php echo $d['id_kamar']; ?>" class="btn btn-light btn-sm rounded-3 me-2 text-warning"><i class="bi bi-pencil-square"></i></a>
                        <a href="hapus_kamar.php?id=<?php echo $d['id_kamar']; ?>" class="btn btn-light btn-sm rounded-3 text-danger" onclick="return confirm('Hapus kamar?')"><i class="bi bi-trash3-fill"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>