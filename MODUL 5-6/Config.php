<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "db_elektromedis";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("KONEKSI GAGAL: " . mysqli_connect_error());
}

echo "KONEKSI DATABASE BERHASIL!";

?>