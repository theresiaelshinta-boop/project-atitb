<?php
session_start();
include '../config/config.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna | E-Katalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #ea669bff 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .btn-custom {
            background: #764ba2;
            color: white;
            border-radius: 10px;
            padding: 12px;
            transition: 0.3s;
            border: none;
        }
        .btn-custom:hover { background: #5a3a7d; color: white; }
        .form-control { border-radius: 10px; padding: 12px; }
        .input-group-text { border-radius: 10px; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
            <i class="fas fa-user-lock fa-xl"></i>
        </div>
        <h3 class="fw-bold">Selamat Datang</h3>
        <p class="text-muted small">Silakan masuk ke akun Anda</p>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger py-2 small text-center"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                <input type="text" name="username" class="form-control bg-light border-start-0" placeholder="Username" required>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="form-label small fw-bold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-key text-muted"></i></span>
                <input type="password" name="password" id="passInput" class="form-control bg-light border-start-0 border-end-0" placeholder="Password" required>
                <button class="btn btn-light border border-start-0" type="button" id="btnToggle">
                    <i class="fas fa-eye text-muted" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <button type="submit" name="login" class="btn btn-custom w-100 fw-bold shadow-sm">MASUK</button>
    </form>

    <div class="text-center mt-4">
        <p class="small mb-0">Belum punya akun? <a href="daftar.php" class="text-decoration-none fw-bold" style="color: #764ba2;">Daftar Disini</a></p>
    </div>
</div>

<script>
    const passInput = document.getElementById('passInput');
    const btnToggle = document.getElementById('btnToggle');
    const eyeIcon = document.getElementById('eyeIcon');

    btnToggle.addEventListener('click', function () {
        const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passInput.setAttribute('type', type);
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>