<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SASS</title>

    <!-- Bootstrap -->
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
        <h2 class="auth-card-title">Registrasi Akun</h2>

        <form id="regForm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="auth-label">Nama Lengkap</label>
                    <input type="text" class="auth-input" required>
                </div>

                <div class="col-md-6">
                    <label class="auth-label">Pilih Peran</label>
                    <select id="roleSelect" class="auth-input" onchange="toggleFields(this.value)">
                        <option value="siswa">Siswa</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div id="siswaFields" class="row g-3">
                    <div class="col-md-6">
                        <label class="auth-label">NIS</label>
                        <input type="number" class="auth-input">
                    </div>

                    <div class="col-md-6">
                        <label class="auth-label">Kelas</label>
                        <input type="text" class="auth-input">
                    </div>
                </div>

                <div class="col-12">
                    <label class="auth-label">Username</label>
                    <input type="text" class="auth-input" required>
                </div>

                <div class="col-12">
                    <label class="auth-label">Password</label>
                    <input type="password" class="auth-input" required>
                </div>
            </div>

            <button type="submit" class="auth-btn mt-4">
                Daftar Sekarang
            </button>
        </form>

        <div class="auth-footer">
            <p>Sudah punya akun?
                <a href="login.php">Masuk</a>
            </p>
        </div>
    </div>

    <p class="auth-copy">&copy; 2026 UKK RPL Paket 3</p>
</div>

<script>
function toggleFields(role) {
    document.getElementById('siswaFields').style.display =
        role === 'siswa' ? 'flex' : 'none';
}
</script>

</body>
</html>
