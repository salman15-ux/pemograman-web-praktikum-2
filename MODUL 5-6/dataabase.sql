CREATE DATABASE IF NOT EXISTS db_elektromedis;

USE db_elektromedis;

-- Tabel admin
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabel alat elektromedis
CREATE TABLE IF NOT EXISTS alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(100) NOT NULL,
    tahun YEAR NOT NULL,
    merek VARCHAR(100) NOT NULL,
    lokasi VARCHAR(100) NOT NULL
);

-- Membuat akun admin
INSERT INTO users (username, password)
VALUES (
    'admin',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
)
ON DUPLICATE KEY UPDATE username = username;