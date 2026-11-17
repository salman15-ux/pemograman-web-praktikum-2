
<?php
include 'config.php';

// Data akun admin
$username = "admin";
$password = "admin123";

// Cek apakah username sudah tersedia
$cek = mysqli_prepare(
    $conn,
    "SELECT id FROM users WHERE username = ?"
);

mysqli_stmt_bind_param($cek, "s", $username);
mysqli_stmt_execute($cek);

$result = mysqli_stmt_get_result($cek);

if (mysqli_num_rows($result) > 0) {

    // Jika sudah ada, perbarui password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $update = mysqli_prepare(
        $conn,
        "UPDATE users SET password = ? WHERE username = ?"
    );

    mysqli_stmt_bind_param(
        $update,
        "ss",
        $password_hash,
        $username
    );

    if (mysqli_stmt_execute($update)) {
        echo "PASSWORD ADMIN BERHASIL DIPERBARUI!";
    } else {
        echo "GAGAL MEMPERBARUI PASSWORD: " . mysqli_error($conn);
    }

} else {

    // Jika belum ada, buat akun baru
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $insert = mysqli_prepare(
        $conn,
        "INSERT INTO users (username, password) VALUES (?, ?)"
    );

    mysqli_stmt_bind_param(
        $insert,
        "ss",
        $username,
        $password_hash
    );

    if (mysqli_stmt_execute($insert)) {
        echo "AKUN ADMIN BERHASIL DIBUAT!";
    } else {
        echo "GAGAL MEMBUAT ADMIN: " . mysqli_error($conn);
    }
}
?>
