<?php
session_start();
if ($_SESSION['level'] != '1') {
    header('Location: index.php');
    exit;
}

include 'koneksi.php';
include 'includes/header.php';

$npm = $_SESSION['npm'];

$query = "SELECT * FROM users WHERE npm='$npm'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

echo "<h1>Data Anda</h1>";
echo "Username: " . $data['username'] . " - NPM: " . $data['npm'] . "<br>";

include 'includes/footer.php';
?>
