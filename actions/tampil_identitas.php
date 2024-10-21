<?php

if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: ../index.php'); // Arahkan ke halaman login atau home
    exit;
}

include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Data Identitas</title>
    <link rel="stylesheet" href="style.css"> <!-- Tambahkan jika ada CSS eksternal -->
</head>
<body>
    <h1>Data Identitas</h1>
    <table border="1">
        <tr>
            <th>NPM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Email</th>
        </tr>

        <?php
        $query = "SELECT * FROM identitas";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['npm'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['jk'] . "</td>";
                echo "<td>" . $row['tgl_lhr'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada data.</td></tr>";
        }
        ?>
    </table>

    <a href="../admin.php"><button>Kembali ke Halaman Admin</button></a>
</body>
</html>
