<?php
require "../components/session_protected.php";
require "../components/components.php";
require "../config/koneksi.php";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

$editMode = false;
$editData = [];

// CREATE / UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $tipe    = $_POST['tipe']; // berita / pengumuman
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $gambar  = $_POST['gambar'];
    $tanggal = $_POST['tanggal'];

    if ($id > 0) {
        $stmt = $koneksi->prepare("UPDATE berita_pengumuman SET tipe=?, judul=?, isi=?, gambar=?, tanggal=? WHERE id=?");
        $stmt->bind_param("sssssi", $tipe, $judul, $isi, $gambar, $tanggal, $id);
        $stmt->execute();
    } else {
        $stmt = $koneksi->prepare("INSERT INTO berita_pengumuman (tipe, judul, isi, gambar, tanggal) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $tipe, $judul, $isi, $gambar, $tanggal);
        $stmt->execute();
    }

    header("Location: admin_berita.php");
    exit;
}

// DELETE
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $koneksi->query("DELETE FROM berita_pengumuman WHERE id=$id");
    header("Location: admin_berita.php");
    exit;
}

// EDIT
if (isset($_GET['edit'])) {
    $editMode = true;
    $id = (int)$_GET['edit'];
    $res = $koneksi->query("SELECT * FROM berita_pengumuman WHERE id=$id");
    $editData = $res->fetch_assoc();
}

$items = $koneksi->query("SELECT * FROM berita_pengumuman ORDER BY tanggal DESC, id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <?= head('Kelola Berita & Pengumuman') ?>
    <style>
        /* ============================== */
        /* ADMIN BERITA PAGE STYLES      */
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

        .form-control,
        .form-check-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 18px;
            border: 1px solid #C7D6B8;
            font-size: 16px;
            background-color: #FBFAF5;
            font-family: "Plus Jakarta Sans", sans-serif;
            color: #333;
        }

        textarea.form-control {
            font-family: "Plus Jakarta Sans", sans-serif;
            resize: vertical;
            min-height: 120px;
        }

        .form-control:focus {
            outline: none;
            border-color: #256128;
            box-shadow: 0 0 0 2px rgba(37, 97, 40, 0.25);
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            cursor: pointer;
            border-radius: 50%;
            padding: 0;
            border: 1px solid #C7D6B8;
            background-color: #FBFAF5;
            flex-shrink: 0;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .form-check-label {
            margin-bottom: 0;
            cursor: pointer;
            font-size: 16px;
            color: #256128;
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

        .gap-3 {
            gap: 20px;
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

        /* ===== TABLE ===== */
        .table-responsive {
            overflow-x: auto;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: #FBFAF5;
        }

        .table thead {
            background: #F0F2EA;
        }

        .table thead th {
            padding: 14px 16px;
            font-size: 15px;
            font-weight: 700;
            color: #256128;
            text-align: left;
            border: none;
        }

        /* Zebra striping */
        .table tbody tr:nth-child(odd) {
            background-color: #F6F4EB !important;
        }

        .table tbody tr:nth-child(even) {
            background-color: #B5DDA8 !important;
        }

        .table tbody tr {
            border-bottom: 1px solid #E8EBE1;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody td {
            padding: 14px 16px;
            font-size: 15px;
            color: #333;
            vertical-align: middle;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .align-middle {
            vertical-align: middle;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .text-muted {
            color: #999;
        }

        /* ===== BADGES ===== */
        .badge-soft {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-berita {
            background-color: #E8F4F1;
            color: #256128;
        }

        .badge-pengumuman {
            background-color: #FFF4E6;
            color: #D97706;
        }

        /* ===== THUMBNAIL ===== */
        .thumb-sm {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
        }

        .mt-2 {
            margin-top: 12px;
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

            .admin-card {
                padding: 20px 16px;
            }

            .admin-card h3 {
                font-size: 24px;
            }

            .table {
                font-size: 13px;
            }

            .table thead th,
            .table tbody td {
                padding: 10px 12px;
            }

            .btn {
                padding: 8px 16px;
                font-size: 14px;
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
                <h1 class="admin-section-title">Berita dan Pengumuman</h1>
                <p class="admin-section-subtitle">
                    Atur konten informasi terbaru untuk warga desa.
                </p>
            </div>

            <div class="row">
                <!-- FORM -->
                <div class="col-lg-4">
                    <div class="admin-card">
                        <h3><?= $editMode ? "Edit Konten" : "Tambah Konten Baru" ?></h3>
                        <p class="subtext">Isi judul, isi berita/pengumuman, dan link gambar.</p>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $editMode ? $editData['id'] : '' ?>">

                            <div class="mb-2">
                                <label class="form-label">Tipe</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe" value="berita"
                                            <?= !$editMode || $editData['tipe'] == 'berita' ? 'checked' : '' ?>>
                                        <label class="form-check-label">Berita</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe" value="pengumuman"
                                            <?= $editMode && $editData['tipe'] == 'pengumuman' ? 'checked' : '' ?>>
                                        <label class="form-check-label">Pengumuman</label>
                                    </div>
                                </div>
                            </div>

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

                            <div class="mb-2">
                                <label class="form-label">Link Gambar (URL atau path)</label>
                                <input type="text" name="gambar" class="form-control"
                                    value="<?= $editMode ? htmlspecialchars($editData['gambar']) : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Isi</label>
                                <textarea name="isi" rows="5" class="form-control"><?= $editMode ? htmlspecialchars($editData['isi']) : '' ?></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-green btn-pill">
                                    <?= $editMode ? "Perbarui" : "Simpan" ?>
                                </button>
                                <?php if ($editMode): ?>
                                    <a href="admin_berita.php" class="btn btn-outline-green btn-pill">Batal</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- DAFTAR KONTEN -->
                <div class="col-lg-8">
                    <div class="admin-card">
                        <h3>Daftar Berita & Pengumuman</h3>
                        <p class="subtext">Konten terbaru berada di urutan paling atas.</p>

                        <div class="table-responsive table-rounded mt-2">
                            <table class="table mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Judul</th>
                                        <th>Tipe</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $items->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                                            <td>
                                                <div class="fw-semibold"><?= htmlspecialchars($row['judul']) ?></div>
                                                <small class="text-muted">
                                                    <?= substr(strip_tags($row['isi']), 0, 70) ?>...
                                                </small>
                                            </td>
                                            <td>
                                                <?php if ($row['tipe'] == 'berita'): ?>
                                                    <span class="badge-soft badge-berita">Berita</span>
                                                <?php else: ?>
                                                    <span class="badge-soft badge-pengumuman">Pengumuman</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['gambar']): ?>
                                                    <img src="<?= htmlspecialchars($row['gambar']) ?>" class="thumb-sm" alt="">
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="?edit=<?= $row['id'] ?>" class="btn btn-outline-green btn-sm btn-pill">Edit</a>
                                                    <a href="?hapus=<?= $row['id'] ?>"
                                                        onclick="return confirm('Yakin hapus konten ini?')"
                                                        class="btn btn-danger btn-danger-pill">Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>