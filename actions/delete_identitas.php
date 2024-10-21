<?php
session_start();

if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: ../index.php'); // Arahkan ke halaman login atau home
    exit;
}

if (!isset($_SESSION['level'])) {
    header('Location: index.php');
    exit;
}
?>
