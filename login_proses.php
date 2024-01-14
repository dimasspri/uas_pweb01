<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'koneksi.php';

    // Escape input untuk mencegah SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk mencari pengguna dengan username dan password yang sesuai
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Jika kredensial benar, set session dan arahkan ke halaman selanjutnya
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        // Jika kredensial salah, arahkan kembali ke halaman login
        echo "Login gagal. Silakan cek kembali username dan password.";
    }

    mysqli_close($conn);
} else {
    // Jika bukan metode POST, arahkan kembali ke halaman login
    header("Location: login.php");
}
?>
