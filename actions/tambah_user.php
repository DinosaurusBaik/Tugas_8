<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: index.php');
    exit;
}

include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $npm = $_POST['npm'];
    $pass = $_POST['pass']; // Password akan dienkripsi
    $level = $_POST['level'];

    // Enkripsi password
    $pass_hashed = md5($pass);

    // Cek apakah npm ada dalam tabel identitas
    $check_query = "SELECT * FROM identitas WHERE npm='$npm'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // NPM valid, lanjutkan untuk menyimpan data user
        $insert_query = "INSERT INTO users (username, npm, pass, level) VALUES ('$username', '$npm', '$pass_hashed', '$level')";
        
        if (mysqli_query($conn, $insert_query)) {
            header('Location: ../admin.php');
            exit;
        } else {
            echo "Gagal menambahkan user: " . mysqli_error($conn);
        }
    } else {
        echo "NPM tidak valid. Pastikan NPM ada di tabel identitas.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body>
<h1>Tambah User</h1>
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>
    <label>NPM:</label><br>
    <input type="text" name="npm" required><br>
    <label>Password:</label><br>
    <input type="password" name="pass" required><br>
    <label>Level:</label><br>
    <select name="level">
        <option value="1">User Biasa</option>
        <option value="2">Admin</option>
    </select><br>
    <input type="submit" value="Tambah User">
</form>
<a href="../admin.php">Kembali</a>
</body>
</html>
