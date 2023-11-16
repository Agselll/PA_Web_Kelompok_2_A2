<?php
require 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM akun WHERE username=? AND password=?";
$stmt = mysqli_prepare($koneksi, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row["username"];
        $_SESSION['id_user'] = $row['id_akun'];
        $_SESSION['role'] = $row['role']; 
        $_SESSION['login'] = true;
        if ($_SESSION['role'] === 'pelanggan') {
            header("location: index.php");
        } else if ($_SESSION['role'] === 'admin') {
            header("location: ../views/index.php");
        } else {
            $error = "Peran tidak valid.";
        }
    } else {
        echo "
        <script>
        alert('Username atau password salah!');
        document.location.href='login.php';
        </script>
        ";
    }
    mysqli_stmt_close($stmt);
} else {
    $error = "Terjadi kesalahan dalam persiapan pernyataan SQL.";
}

}
