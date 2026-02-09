<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SASS</title>

    <!-- Bootstrap (grid & helper saja) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Shared CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">

<div class="auth-wrapper">

    <!-- Header -->
    <div class="text-center mb-4">
        <div class="logo-box mb-3">
            <i class="fas fa-school"></i>
        </div>
        <h1 class="auth-title">SASS Online</h1>
        <p class="auth-subtitle">Sistem Aspirasi Sarana Sekolah</p>
    </div>

    <!-- Card -->
    <div class="auth-card">
        <h2 class="auth-card-title">Selamat Datang Kembali</h2>

        <form method="POST">
            <!-- Username -->
            <div class="mb-3">
                <label class="auth-label">Username</label>
                <div class="position-relative">
                    <i class="fas fa-user auth-icon"></i>
                    <input type="text" name="username" class="auth-input ps-5" required>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="auth-label">Password</label>
                <div class="position-relative">
                    <i class="fas fa-lock auth-icon"></i>
                    <input type="password" name="password" class="auth-input ps-5" required>
                </div>
            </div>

            <button type="submit" name="login" class="auth-btn">
                Masuk Sekarang
            </button>
        </form>

        <div class="auth-footer">
            <p>Belum punya akun?
                <a href="register.php">Daftar Akun Baru</a>
            </p>
        </div>
    </div>

    <p class="auth-copy">&copy; 2026 UKK RPL Paket 3</p>
</div>

</body>
</html>
