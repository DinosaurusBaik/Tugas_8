<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: index.php');
    exit;
}

include '../koneksi.php';

if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];
    $delete_query = "DELETE FROM identitas WHERE npm='$npm'";

    if (mysqli_query($conn, $delete_query)) {
        header('Location: ../tampil_identitas.php');
    } else {
        echo "Gagal menghapus identitas: " . mysqli_error($conn);
    }
} else {
    header('Location: ../tampil_identitas.php');
}
?>
