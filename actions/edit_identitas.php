<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: index.php');
    exit;
}

include '../koneksi.php';

if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];
    $query = "SELECT * FROM identitas WHERE npm='$npm'";
    $result = mysqli_query($conn, $query);
    $data_identitas = mysqli_fetch_assoc($result);
} else {
    header('Location: ../tampil_identitas.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_npm = $_POST['npm'];
    $new_nama = $_POST['nama'];
    $new_alamat = $_POST['alamat'];
    $new_jk = $_POST['jk'];
    $new_tgl_lhr = $_POST['tgl_lhr'];
    $new_email = $_POST['email'];

    $update_query = "UPDATE identitas SET npm='$new_npm', nama='$new_nama', alamat='$new_alamat', jk='$new_jk', tgl_lhr='$new_tgl_lhr', email='$new_email' WHERE npm='$npm'";
    
    if (mysqli_query($conn, $update_query)) {
        header('Location: ../tampil_identitas.php');
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>
