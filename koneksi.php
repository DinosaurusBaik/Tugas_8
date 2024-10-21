<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'mhs';

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>