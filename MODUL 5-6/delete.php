<?php
include 'auth.php';
include 'config.php';

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {

    $id = (int) $_GET['id'];

    $stmt = mysqli_prepare($conn, "DELETE FROM alat WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: index.php");
exit;
?>