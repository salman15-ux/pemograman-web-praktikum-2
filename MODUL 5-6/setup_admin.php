<?php
include 'config.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO users (username, password)
     VALUES (?, ?)"
);

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $username,
    $password
);

if (mysqli_stmt_execute($stmt)) {
    echo "Akun admin berhasil dibuat!";
} else {
    echo "Gagal membuat akun. Username mungkin sudah digunakan.";
}
?>