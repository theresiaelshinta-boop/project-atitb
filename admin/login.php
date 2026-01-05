<?php
session_start();
include '../config/config.php';

// Matikan laporan error mysqli_sql_exception agar halaman tidak crash jika DB mati
mysqli_report(MYSQLI_REPORT_OFF);

if (isset($_POST['login_admin'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Cek akun admin (Tanpa hashing sesuai permintaan sebelumnya)
    $query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['admin_login'] = true;
        $_SESSION['admin_name'] = $row['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Akses Ditolak! Username atau Password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Panel Kendali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }
        .admin-login-card {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .admin-icon {
            width: 70px;
            height: 70px;
            background: #4e73df;
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.2);
        }
        .form-label {
            color: #4a4a4a;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control {
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            padding: 12px;
            border-radius: 8px;
            color: #333;
        }
        .form-control:focus {
            background: #fff;
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1);
        }
        .btn-admin {
            background: #4e73df;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 10px;
        }
        .btn-admin:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        .input-group-text {
            background: #f8f9fc;
            border: 1px solid #d1d3e2;
            color: #b7b9cc;
        }
    </style>
</head>
<body>

<div class="admin-login-card">
    <div class="text-center mb-4">
        <div class="admin-icon">
            <i class="fas fa-user-shield fa-2x"></i>
        </div>
        <h4 class="fw-bold text-dark mb-1">Admin Panel</h4>
        <p class="text-muted small">Masuk untuk mengelola katalog</p>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger py-2 small text-center border-0 shadow-sm mb-4">
            <i class="fas fa-exclamation-circle me-1"></i> <?= $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="fas fa-user"></i></span>
                <input type="text" name="username" class="form-control border-start-0" placeholder="Username admin" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text border-end-0"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="passAdmin" class="form-control border-start-0 border-end-0" placeholder="Password" required>
                <button class="btn btn-light border border-start-0" type="button" id="btnToggleAdmin">
                    <i class="fas fa-eye text-muted" id="eyeIconAdmin"></i>
                </button>
            </div>
        </div>

        <button type="submit" name="login_admin" class="btn btn-admin w-100">
            LOGIN SYSTEM <i class="fas fa-sign-in-alt ms-2"></i>
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="../user/login.php" class="text-muted small text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Login User
        </a>
    </div>
</div>

<script>
    const passAdmin = document.getElementById('passAdmin');
    const btnToggleAdmin = document.getElementById('btnToggleAdmin');
    const eyeIconAdmin = document.getElementById('eyeIconAdmin');

    btnToggleAdmin.addEventListener('click', function (e) {
        // Mencegah form terkirim
        e.preventDefault();
        
        // Toggle tipe input
        const isPassword = passAdmin.getAttribute('type') === 'password';
        passAdmin.setAttribute('type', isPassword ? 'text' : 'password');
        
        // Toggle ikon
        eyeIconAdmin.classList.toggle('fa-eye');
        eyeIconAdmin.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>