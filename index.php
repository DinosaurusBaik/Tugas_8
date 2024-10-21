<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // gunakan enkripsi MD5

    $query = "SELECT * FROM users WHERE username='$username' AND pass='$password'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data) {
        $_SESSION['level'] = $data['level'];
        $_SESSION['npm'] = $data['npm'];
        if ($data['level'] == '2') {
            header('Location: admin.php');
        } else {
            header('Location: user.php');
        }
    } else {
        echo "Username atau Password salah!";
    }
}
?>

<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="submit">Login</button>
</form>
