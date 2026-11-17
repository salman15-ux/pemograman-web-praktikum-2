<?php
include 'config.php';

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM alat WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan!");
}

$error = "";

if (isset($_POST['update'])) {

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
            "UPDATE alat SET nama_alat=?, tahun=?, merek=?, lokasi=?
             WHERE id=?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $nama_alat,
            $tahun,
            $merek,
            $lokasi,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal memperbarui data!";
        }
    }

    $data['nama_alat'] = $nama_alat;
    $data['tahun'] = $tahun;
    $data['merek'] = $merek;
    $data['lokasi'] = $lokasi;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Alat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container mt-5">

    <div class="card shadow-sm mx-auto form-card">

        <div class="card-body p-4">

            <h3 class="mb-4">Edit Data Alat Elektromedis</h3>

            <?php if ($error != "") { ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error); ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text" name="nama_alat"
                           class="form-control"
                           value="<?= htmlspecialchars($data['nama_alat']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun"
                           class="form-control"
                           min="1901" max="2155"
                           value="<?= htmlspecialchars($data['tahun']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek"
                           class="form-control"
                           value="<?= htmlspecialchars($data['merek']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi"
                           class="form-control"
                           value="<?= htmlspecialchars($data['lokasi']); ?>"
                           required>
                </div>

                <button type="submit" name="update"
                        class="btn btn-success">
                    Update Data
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