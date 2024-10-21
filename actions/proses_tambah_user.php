<?php
session_start();

// Memeriksa apakah pengguna telah login sebagai admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: ../index.php'); // Arahkan ke halaman login atau home
    exit;
}

include '../koneksi.php';

$username = $_POST['username'];
$npm = $_POST['npm'];
$pass = $_POST['pass'];
$level = $_POST['level'];

// Enkripsi password
$pass_hashed = md5($pass);

$insert_query = "INSERT INTO users (username, npm, pass, level) VALUES ('$username', '$npm', '$pass_hashed', '$level')";
if (mysqli_query($conn, $insert_query)) {
    header('Location: ../admin.php');
} else {
    echo "Gagal menambahkan user: " . mysqli_error($conn);
}
?>
