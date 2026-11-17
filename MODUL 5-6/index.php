<?php
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alat Elektromedis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand fw-bold">
            MEDICAL EQUIPMENT
        </span>
        <span class="text-white">Sistem Informasi Alat Elektromedis</span>
    </div>
</nav>

<div class="container mt-5">

    <div class="header-section mb-4">
        <h2>Data Alat Elektromedis</h2>
        <p>Kelola data inventaris alat elektromedis dengan mudah.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold">Daftar Inventaris Alat</h5>

                <a href="add.php" class="btn btn-primary">
                    + Tambah Data
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alat</th>
                            <th>Tahun</th>
                            <th>Merek</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    if (mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                    ?>

                        <tr>
                            <td><?= $no++; ?></td>

                            <td>
                                <?= htmlspecialchars($data['nama_alat']); ?>
                            </td>

                            <td><?= htmlspecialchars($data['tahun']); ?></td>

                            <td><?= htmlspecialchars($data['merek']); ?></td>

                            <td><?= htmlspecialchars($data['lokasi']); ?></td>

                            <td>
                                <a href="edit.php?id=<?= $data['id']; ?>"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="delete.php?id=<?= $data['id']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>

                    <?php
                        }
                    } else {
                    ?>

                        <tr>
                            <td colspan="6" class="text-center">
                                Belum ada data alat elektromedis.
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <footer class="text-center mt-4">
        <p>© 2026 Sistem Informasi Alat Elektromedis</p>
    </footer>

</div>

</body>
</html>