<?php
include 'config.php';

$error = "";

if (isset($_POST['simpan'])) {

    $nama_alat = trim($_POST['nama_alat']);
    $tahun = $_POST['tahun'];
    $merek = trim($_POST['merek']);
    $lokasi = trim($_POST['lokasi']);

    if ($nama_alat == "" || $merek == "" || $lokasi == "") {
        $error = "Semua kolom harus diisi!";
    } elseif (!preg_match('/^\d{4}$/', $tahun) || $tahun < 1901 || $tahun > 2155) {
        $error = "Tahun tidak valid!";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO alat (nama_alat, tahun, merek, lokasi)
             VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $nama_alat,
            $tahun,
            $merek,
            $lokasi
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menambahkan data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Alat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mt-5">

    <div class="card shadow-sm mx-auto form-card">

        <div class="card-body p-4">

            <h3 class="mb-4">Tambah Data Alat Elektromedis</h3>

            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="nama_alat"
                           class="form-control" required
                           placeholder="Contoh: Patient Monitor">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun"
                           class="form-control"
                           min="1901" max="2155" required
                           placeholder="Contoh: 2024">
                </div>

                <div class="mb-3">
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek"
                           class="form-control" required
                           placeholder="Contoh: Philips">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi"
                           class="form-control" required
                           placeholder="Contoh: Ruang ICU">
                </div>

                <button type="submit" name="simpan"
                        class="btn btn-primary">
                    Simpan Data
                </button>

                <a href="index.php" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>