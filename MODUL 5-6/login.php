<?php
session_start();
include 'config.php';

$error = "";

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM users WHERE username = ?"
    );

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        session_regenerate_id(true);

        $_SESSION['login'] = true;
        $_SESSION['username'] = $user['username'];

        header("Location: index.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin Elektromedis</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body class="login-page">

<div class="login-container">

    <div class="login-icon">⚕</div>

    <h3>MEDICAL EQUIPMENT</h3>

    <p class="login-description">
        Sistem Informasi Data Alat Elektromedis
    </p>

    <?php if ($error != "") { ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3 text-start">
            <label class="form-label">Username</label>

            <input type="text"
                   name="username"
                   class="form-control"
                   placeholder="Masukkan username"
                   required>
        </div>

        <div class="mb-4 text-start">
            <label class="form-label">Password</label>

            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Masukkan password"
                   required>
        </div>

        <button type="submit"
                name="login"
                class="btn btn-login w-100">
            LOGIN
        </button>

    </form>

    <p class="login-footer">
        © 2026 Sistem Informasi Alat Elektromedis
    </p>

</div>

</body>
</html>