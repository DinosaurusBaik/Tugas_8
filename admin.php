<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: index.php');
    exit;
}

include 'koneksi.php';
include 'includes/header.php';

// Menampilkan data users
echo "<h1>Data Users</h1>";
echo '<a href="actions/tambah_user.php">Tambah User</a><br>'; // Tautan untuk menambah user

$query_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $query_users);

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>Username</th>
        <th>NPM</th>
        <th>Aksi</th>
      </tr>";

while ($data_user = mysqli_fetch_assoc($result_users)) {
    echo "<tr>
            <td>" . $data_user['username'] . "</td>
            <td>" . $data_user['npm'] . "</td>
            <td>
                <a href='actions/edit_user.php?username=" . $data_user['username'] . "'>Edit</a> |
                <a href='actions/hapus_user.php?username=" . $data_user['username'] . "' onclick='return confirm(\"Yakin ingin menghapus user?\")'>Hapus</a>
            </td>
          </tr>";
}

echo "</table>";

include 'includes/footer.php';
?>
