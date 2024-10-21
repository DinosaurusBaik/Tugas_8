<?php
session_start();

// Memeriksa apakah pengguna telah login sebagai admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: ../index.php'); // Arahkan ke halaman login atau home
    exit;
}

include '../koneksi.php';

$npm = $_POST['npm'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jk = $_POST['jk'];
$tgl_lhr = $_POST['tgl_lhr'];
$email = $_POST['email'];

$query = "INSERT INTO identitas (npm, nama, alamat, jk, tgl_lhr, email) VALUES ('$npm', '$nama', '$alamat', '$jk', '$tgl_lhr', '$email')";
if (mysqli_query($conn, $query)) {
    header('Location: ../actions/tampil_identitas.php');
} else {
    echo "Gagal menambahkan data: " . mysqli_error($conn);
}
?>
