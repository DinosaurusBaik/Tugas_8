<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi MHS</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<nav>
    <?php
    // Menentukan tautan Home berdasarkan level pengguna
    if (isset($_SESSION['level'])) {
        if ($_SESSION['level'] == '1') {
            echo '<a href="user.php">Home</a> | ';
        } elseif ($_SESSION['level'] == '2') {
            echo '<a href="admin.php">Home</a> | ';
        }
    }
    ?>
    
    <?php
    // Menampilkan opsi Tambah Identitas dan Lihat Data Identitas hanya untuk admin
    if (isset($_SESSION['level']) && $_SESSION['level'] == '2') {
        echo '<a href="actions/tambah_identitas.php">Tambah Identitas</a> | 
              <a href="actions/tampil_identitas.php">Lihat Data Identitas</a> | ';
    }
    ?>
    <a href="logout.php">Logout</a> <!-- Link untuk logout -->
</nav>
<hr>
