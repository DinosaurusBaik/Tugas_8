<?php
session_start();
if (!isset($_SESSION['level']) || $_SESSION['level'] != '2') {
    header('Location: ../index.php');
    exit;
}

include '../koneksi.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_user = $result->fetch_assoc();
    $stmt->close();
} else {
    header('Location: ../admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_npm = $_POST['npm'];
    $new_level = $_POST['level'];

    // Check if the new npm exists in identitas table
    $check_stmt = $conn->prepare("SELECT * FROM identitas WHERE npm = ?");
    $check_stmt->bind_param("s", $new_npm);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // NPM valid, lakukan update
        $update_stmt = $conn->prepare("UPDATE users SET username = ?, npm = ?, level = ? WHERE username = ?");
        $update_stmt->bind_param("ssis", $new_username, $new_npm, $new_level, $username);

        if ($update_stmt->execute()) {
            header('Location: ../admin.php');
            exit;
        } else {
            echo "Gagal mengupdate data: " . $conn->error;
        }

        $update_stmt->close();
    } else {
        echo "NPM tidak valid. Pastikan NPM ada di tabel identitas.";
    }

    $check_stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
<h1>Edit User</h1>
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($data_user['username']); ?>" required><br>
    <label>NPM:</label><br>
    <input type="text" name="npm" value="<?php echo htmlspecialchars($data_user['npm']); ?>" required><br>
    <label>Level:</label><br>
    <select name="level">
        <option value="1" <?php echo ($data_user['level'] == '1') ? 'selected' : ''; ?>>User Biasa</option>
        <option value="2" <?php echo ($data_user['level'] == '2') ? 'selected' : ''; ?>>Admin</option>
    </select><br>
    <input type="submit" value="Update User">
</form>
<a href="../admin.php">Kembali</a>
</body>
</html>
