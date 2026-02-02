<?php 
include '../config/koneksi.php';

$nama = $_POST['nama_tamu'];
$hp   = $_POST['no_hp'];
$alamat = $_POST['alamat'];

$query = mysqli_query($koneksi, "INSERT INTO tamu (nama_tamu, no_hp, alamat) VALUES ('$nama', '$hp', '$alamat')");

if($query){
    header("location:tamu.php?pesan=berhasil");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>