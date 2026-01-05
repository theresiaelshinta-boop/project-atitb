<?php
include '../config/config.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Pendaftaran Berhasil!'); window.location='login.php';</script>";
    } else {
        $error = "Gagal mendaftar. Username mungkin sudah ada.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | E-Katalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f093fb 0%, #dc4237ff 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .register-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .btn-register {
            background: #f5576c;
            color: white;
            border-radius: 10px;
            padding: 12px;
            border: none;
            transition: 0.3s;
        }
        .btn-register:hover { background: #d43f51; color: white; }
        .form-control { border-radius: 10px; padding: 12px; }
    </style>
</head>
<body>

<div class="register-card">
    <div class="text-center mb-4">
        <h3 class="fw-bold">Buat Akun</h3>
        <p class="text-muted small">Daftar sekarang untuk melihat menu</p>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger py-2 small text-center"><?= $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold">Username Baru</label>
            <input type="text" name="username" class="form-control bg-light" placeholder="Pilih username" required>
        </div>
        
        <div class="mb-4">
            <label class="form-label small fw-bold">Password Baru</label>
            <div class="input-group">
                <input type="password" name="password" id="passReg" class="form-control bg-light border-end-0" placeholder="Minimal 6 karakter" required>
                <button class="btn btn-light border border-start-0" type="button" id="btnToggleReg">
                    <i class="fas fa-eye text-muted" id="eyeIconReg"></i>
                </button>
            </div>
        </div>

        <button type="submit" name="register" class="btn btn-register w-100 fw-bold shadow-sm">DAFTAR SEKARANG</button>
    </form>

    <div class="text-center mt-4">
        <p class="small mb-0">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold text-danger">Login Disini</a></p>
    </div>
</div>

<script>
    const passReg = document.getElementById('passReg');
    const btnToggleReg = document.getElementById('btnToggleReg');
    const eyeIconReg = document.getElementById('eyeIconReg');

    btnToggleReg.addEventListener('click', function () {
        const type = passReg.getAttribute('type') === 'password' ? 'text' : 'password';
        passReg.setAttribute('type', type);
        eyeIconReg.classList.toggle('fa-eye');
        eyeIconReg.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>