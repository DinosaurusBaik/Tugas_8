<?php
session_start();

// Memeriksa apakah pengguna telah login sebagai admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: ../index.php'); // Arahkan ke halaman login atau home
    exit;
}
?>

<!-- Form untuk menambahkan identitas -->
<form method="POST" action="actions/proses_tambah_identitas.php">
    <input type="text" name="npm" placeholder="NPM" required>
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="text" name="alamat" placeholder="Alamat" required>
    <input type="text" name="jk" placeholder="Jenis Kelamin (L/P)" required>
    <input type="date" name="tgl_lhr" placeholder="Tanggal Lahir" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Tambah Data</button>
</form>

<!-- Tombol untuk kembali ke halaman admin -->
<a href="../admin.php">
    <button>Kembali ke Admin</button>
</a>
