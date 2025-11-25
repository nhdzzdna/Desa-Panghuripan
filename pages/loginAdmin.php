<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin - Desa Panghuripan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font (opsional, biar mirip desain) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS kamu -->
    <link rel="stylesheet" href="loginAdmin.css">
</head>

<body class="bg-light">

    <div class="login-bg d-flex align-items-center min-vh-100">
        <div class="container">

            <!-- Tombol kembali -->
            <button class="btn back-btn" type="button" onclick="history.back()"> Kembali </button>

            <!-- Card utama -->
            <div class="card login-card shadow-lg mx-auto border-0">
                <div class="row g-0">

                    <!-- Kiri -->
                    <div class="col-md-6 login-left d-flex flex-column justify-content-between">
                        <div>
                            <h1 class="fw-bold mb-4 title-hi">
                                Hi,<br> welcome !
                            </h1>
                        </div>
                        <div class="text-center">
                            <!-- ganti src dengan nama file ilustrasi kamu -->
                            <img src="52e202397f8136ea4ac3a7b0e4713f21.png"
                                alt="Ilustrasi Admin"
                                class="img-fluid left-illustration">
                        </div>
                    </div>

                    <!-- Kanan -->
                    <div class="col-md-6 bg-body login-right">
                        <div class="p-4 p-md-5">

                            <h2 class="text-center fw-bold text-success mb-2">Login</h2>
                            <p class="text-center text-success-subtle mb-4">
                                Silahkan isi form berikut terlebih dahulu
                            </p>

                            <form action="auth.php" method="POST">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-success" for="username">Username</label>
                                    <input type="text" class="form-control input-box" id="username" name="username" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-success" for="password">Password</label>
                                    <input type="password" class="form-control input-box" id="password" name="password" required>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-login">
                                        Log In
                                    </button>
                                </div>
                            </form>

                            <div class="text-center small text-muted mt-3">
                                © 2025 Desa Panghuripan. All Right Reserved
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>
</body>

</html>