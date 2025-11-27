<?php
require "../components/session_protected.php";
require "../components/components.php";
require "../config/koneksi.php";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

$editMode = false;
$editData = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $judul   = $_POST['judul'];
    $foto    = $_POST['foto']; // path atau URL
    $tanggal = $_POST['tanggal'];

    if ($id > 0) {
        $stmt = $koneksi->prepare("UPDATE galeri_desa SET judul=?, foto=?, tanggal=? WHERE id=?");
        $stmt->bind_param("sssi", $judul, $foto, $tanggal, $id);
        $stmt->execute();
    } else {
        $stmt = $koneksi->prepare("INSERT INTO galeri_desa (judul, foto, tanggal) VALUES (?,?,?)");
        $stmt->bind_param("sss", $judul, $foto, $tanggal);
        $stmt->execute();
    }

    header("Location: admin_galeri.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $koneksi->query("DELETE FROM galeri_desa WHERE id=$id");
    header("Location: admin_galeri.php");
    exit;
}

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = (int)$_GET['edit'];
    $res = $koneksi->query("SELECT * FROM galeri_desa WHERE id=$id");
    $editData = $res->fetch_assoc();
}

$items = $koneksi->query("SELECT * FROM galeri_desa ORDER BY tanggal DESC, id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <?= head('Kelola Galeri Desa') ?>
    <style>
        /* ============================== */
        /* ADMIN GALERI PAGE STYLES      */
        /* ============================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Plus Jakarta Sans", sans-serif;
            background-color: #EBE9DD;
            color: #333;
        }

        /* ===== NAVBAR ===== */
        .navbar-admin {
            height: 93px;
            background-color: #003631;
            box-shadow: 0 0 15px 6px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            color: #fff;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }

        .logo-area img {
            width: 41px;
            height: 41px;
        }

        .brand h3 {
            font-family: "Marcellus SC", serif;
            font-size: 20px;
            margin: 0;
            line-height: 1;
        }

        .brand p {
            font-size: 11px;
            margin: 0;
            line-height: 1.1;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 18px;
            font-weight: 600;
        }

        .logout-btn {
            background-color: #EFB34A;
            border-radius: 24.5px;
            padding: 8px 32px;
            border: 2px solid #EFB34A;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: transparent;
            color: #ffffff;
        }

        /* ===== PAGE CONTAINER ===== */
        .admin-page-bg {
            min-height: calc(100vh - 93px);
            background:
                linear-gradient(180deg, rgba(0, 54, 49, 0.75) 0%, rgba(255, 255, 255, 0.3) 50%, rgba(255, 198, 97, 0.65) 100%),
                url("../assets/admin/bg dashboard.png");
            background-size: cover;
            background-position: center;
            padding-bottom: 80px;
        }

        .container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px;
        }

        .mb-4 {
            margin-bottom: 32px;
        }

        .text-white {
            color: #FFFFFF;
        }

        /* ===== SECTION TITLE ===== */
        .admin-section-title {
            font-family: "Marcellus SC", serif;
            font-size: 56px;
            line-height: 1.1;
            color: #FFFFFF;
            margin-bottom: 6px;
            font-weight: 400;
        }

        .admin-section-subtitle {
            font-size: 20px;
            color: #FEF0B3;
            max-width: 760px;
            margin-bottom: 32px;
            font-weight: 500;
        }

        /* ===== FLEX LAYOUT (single row) ===== */
        .row {
            display: flex !important;
            flex-wrap: nowrap;
            gap: 15px;
            align-items: flex-start;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .col-lg-4 {
            flex: 0 0 360px !important;
            max-width: 360px !important;
            min-width: 320px !important;
            box-sizing: border-box;
        }

        .col-lg-8 {
            flex: 1 0 auto !important;
            min-width: 480px;
            box-sizing: border-box;
        }

        /* ===== CARD ===== */
        .admin-card {
            background: #F7F4E8;
            border-radius: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 32px 40px;
            width: 100%;
            min-width: 0;
        }

        .admin-card h3 {
            font-size: 32px;
            font-weight: 700;
            color: #256128;
            margin-bottom: 6px;
        }

        .subtext {
            font-size: 16px;
            color: #6E8C6F;
            margin-bottom: 20px;
        }

        /* ===== FORM ELEMENTS ===== */
        .mb-2 {
            margin-bottom: 18px;
        }

        .mb-3 {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 17px;
            font-weight: 600;
            color: #256128;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border-radius: 18px;
            border: 1px solid #C7D6B8;
            font-size: 16px;
            background-color: #FBFAF5;
            font-family: "Plus Jakarta Sans", sans-serif;
            color: #333;
        }

        .form-control:focus {
            outline: none;
            border-color: #256128;
            box-shadow: 0 0 0 2px rgba(37, 97, 40, 0.25);
        }

        /* ===== BUTTON GROUP ===== */
        .d-flex {
            display: flex;
        }

        .gap-2 {
            gap: 12px;
        }

        .gap-1 {
            gap: 6px;
        }

        /* ===== BUTTONS ===== */
        .btn {
            padding: 10px 24px;
            border-radius: 999px;
            border: none;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        .btn-green {
            background-color: #256128;
            color: #FFFFFF;
        }

        .btn-green:hover {
            background-color: #1c4c21;
        }

        .btn-outline-green {
            background-color: #FFFFFF;
            color: #256128;
            border: 2px solid #256128;
        }

        .btn-outline-green:hover {
            background-color: #e3f0e2;
        }

        .btn-danger {
            background-color: #E74C3C;
            color: #FFFFFF;
        }

        .btn-danger:hover {
            background-color: #c63b2d;
        }

        .btn-pill {
            border-radius: 999px;
        }

        .btn-sm {
            padding: 6px 16px;
            font-size: 14px;
        }

        /* ===== GALLERY GRID ===== */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .gallery-item {
            background: #FFFFFF;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-4px);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .gallery-item-body {
            padding: 16px;
        }

        .gallery-item-title {
            font-size: 16px;
            font-weight: 600;
            color: #256128;
            margin: 0 0 6px;
        }

        .gallery-item-date {
            font-size: 13px;
            color: #999;
            margin: 0 0 12px;
            display: block;
        }

        .gallery-item-actions {
            display: flex;
            gap: 6px;
        }

        /* ===== UTILITY CLASSES ===== */
        .text-muted {
            color: #999;
        }

        .d-block {
            display: block;
        }

        .mb-1 {
            margin-bottom: 4px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        /* ===== BACK BUTTON ===== */
        .btnBack {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #003631;
            color: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            text-decoration: none;
            transition: background 0.25s ease;
            margin-right: 5px;
        }

        .btnBack:hover {
            background: #0F352B;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .container {
                padding: 24px 16px 40px;
            }

            .row {
                flex-wrap: wrap;
            }

            .col-lg-4,
            .col-lg-8 {
                flex: 1 1 100% !important;
                max-width: 100% !important;
                min-width: 0 !important;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .admin-card {
                padding: 20px 16px;
            }

            .admin-card h3 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar-admin">
        <div class="logo-area">
            <a href="dashboardAdmin.php" class="btnBack">
                <i class="bi bi-arrow-left"></i>
            </a>
            <img src="../assets/admin/logo.svg" alt="Logo Desa">
            <div class="brand">
                <h3>Desa Panghuripan</h3>
                <p>Kabupaten Sleman</p>
            </div>
        </div>

        <div class="admin-info">
            <span>Hello, <?= htmlspecialchars($username) ?> !</span>
            <a href="../logic/logout.php" class="logout-btn">Logout</a>
        </div>
    </nav>


    <div class="admin-page-bg">
        <div class="container">
            <div class="mb-4 text-white">
                <h1 class="admin-section-title">Galeri Desa</h1>
                <p class="admin-section-subtitle">
                    Upload atau edit foto-foto kegiatan dan panorama desa.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="admin-card">
                        <h3><?= $editMode ? "Edit Foto" : "Tambah Foto" ?></h3>
                        <p class="subtext">Gunakan path lokal (../assets/..) atau URL penuh.</p>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $editMode ? $editData['id'] : '' ?>">

                            <div class="mb-2">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control"
                                    value="<?= $editMode ? htmlspecialchars($editData['judul']) : '' ?>">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control"
                                    value="<?= $editMode ? $editData['tanggal'] : date('Y-m-d') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link Foto</label>
                                <input type="text" name="foto" class="form-control"
                                    value="<?= $editMode ? htmlspecialchars($editData['foto']) : '' ?>">
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-green btn-pill">
                                    <?= $editMode ? "Perbarui" : "Simpan" ?>
                                </button>
                                <?php if ($editMode): ?>
                                    <a href="admin_galeri.php" class="btn btn-outline-green btn-pill">Batal</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="admin-card">
                        <h3>Album Foto</h3>
                        <p class="subtext">Foto terbaru tampil paling atas.</p>

                        <div class="gallery-grid">
                            <?php while ($row = $items->fetch_assoc()): ?>
                                <div class="gallery-item">
                                    <img src="<?= htmlspecialchars($row['foto']) ?>" alt="">
                                    <div class="gallery-item-body">
                                        <h5 class="gallery-item-title"><?= htmlspecialchars($row['judul']) ?></h5>
                                        <span class="gallery-item-date">
                                            <?= $row['tanggal'] ? date('d M Y', strtotime($row['tanggal'])) : '-' ?>
                                        </span>
                                        <div class="gallery-item-actions d-flex gap-2">
                                            <a href="?edit=<?= $row['id'] ?>" class="btn btn-outline-green btn-sm btn-pill">Edit</a>
                                            <a href="?hapus=<?= $row['id'] ?>"
                                                onclick="return confirm('Yakin hapus foto ini?')"
                                                class="btn btn-danger btn-sm btn-pill">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>