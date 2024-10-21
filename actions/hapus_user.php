<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: index.php');
    exit;
}

include '../koneksi.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $delete_query = "DELETE FROM users WHERE username='$username'";

    if (mysqli_query($conn, $delete_query)) {
        header('Location: ../admin.php');
    } else {
        echo "Gagal menghapus user: " . mysqli_error($conn);
    }
} else {
    header('Location: ../admin.php');
}
?>
