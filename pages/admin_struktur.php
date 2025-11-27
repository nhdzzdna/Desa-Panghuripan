<?php
require "../components/session_protected.php";
require "../components/components.php";
require "../config/koneksi.php";

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

$editMode = false;
$editData = [];

// Ambil penduduk untuk dropdown (sebagian saja biar tidak berat; mis. 200 pertama)
$pendudukOptions = $koneksi->query("SELECT id, nama FROM penduduk ORDER BY nama LIMIT 300");

// SIMPAN / UPDATE
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $jabatan     = $_POST['jabatan'];
    $foto        = $_POST['foto'];
    $penduduk_id = $_POST['penduduk_id'] !== '' ? (int)$_POST['penduduk_id'] : null;
    $urutan      = (int)$_POST['urutan'];

    if ($id > 0) {
        $stmt = $koneksi->prepare("UPDATE struktur_perangkat_desa SET foto=?, jabatan=?, penduduk_id=?, urutan=? WHERE id=?");
        $stmt->bind_param("ssiii", $foto, $jabatan, $penduduk_id, $urutan, $id);
        $stmt->execute();
    } else {
        $stmt = $koneksi->prepare("INSERT INTO struktur_perangkat_desa (foto, jabatan, penduduk_id, urutan) VALUES (?,?,?,?)");
        $stmt->bind_param("ssii", $foto, $jabatan, $penduduk_id, $urutan);
        $stmt->execute();
    }

    header("Location: admin_struktur.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $koneksi->query("DELETE FROM struktur_perangkat_desa WHERE id=$id");
    header("Location: admin_struktur.php");
    exit;
}

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = (int)$_GET['edit'];
    $res = $koneksi->query("SELECT * FROM struktur_perangkat_desa WHERE id=$id");
    $editData = $res->fetch_assoc();
}

// daftar struktur (join ke penduduk)
$list = $koneksi->query("SELECT s.*, p.nama AS nama_penduduk
                         FROM struktur_perangkat_desa s
                         LEFT JOIN penduduk p ON p.id = s.penduduk_id
                         ORDER BY s.urutan ASC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <?= head('Kelola Struktur Desa') ?>
    <style>
        /* ============================== */
        /* ADMIN STRUKTUR PAGE STYLES    */
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
        /* Gunakan flex tanpa wrap agar kedua card selalu berada di satu baris.
           Jika ruang tidak cukup, tampilkan scroll horizontal. */
        .row {
            display: flex !important;
            flex-wrap: nowrap;
            /* jangan wrap, tetap satu baris */
            gap: 15px;
            align-items: flex-start;
            overflow-x: auto;
            /* scroll ketika konten meluber */
            -webkit-overflow-scrolling: touch;
        }

        .col-lg-4 {
            flex: 0 0 360px !important;
            max-width: 360px !important;
            min-width: 320px !important;
            box-sizing: border-box;
        }

        /* Kolom kanan (daftar) — fleksibel */
        .col-lg-8 {
            flex: 1 0 auto !important;
            min-width: 480px;
            box-sizing: border-box;
        }

        /* Pastikan card mengikuti lebar kolomnya */
        .col-lg-4 .admin-card {
            width: 100% !important;
            max-width: 360px !important;
            min-width: 0 !important;
        }

        .col-lg-8 .admin-card {
            width: 100% !important;
            max-width: none !important;
            min-width: 0 !important;
        }

        /* ===== CARD ===== */
        .admin-card {
            background: #F7F4E8;
            border-radius: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 32px 40px;
            width: 100%;
            min-width: 0;
            /* penting untuk grid agar item bisa mengecil tanpa memaksa overflow */
        }

        /* Jika masih ada aturan lain yang menimpa, paksa ukuran untuk card di kolom kiri */
        .col-lg-4 .admin-card {
            max-width: 400px !important;
            min-width: 320px !important;
            width: 100% !important;
        }

        /* Pastikan card daftar (kolom kanan) tidak dibatasi */
        .col-lg-8 .admin-card {
            max-width: none !important;
            min-width: 0 !important;
            width: 100% !important;
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
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 18px;
            border: 1px solid #C7D6B8;
            font-size: 16px;
            background-color: #FBFAF5;
            font-family: "Plus Jakarta Sans", sans-serif;
            color: #333;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #256128;
            box-shadow: 0 0 0 2px rgba(37, 97, 40, 0.25);
        }

        .form-select {
            cursor: pointer;
        }

        .form-control::placeholder {
            color: #999;
        }

        small {
            display: block;
            font-size: 13px;
            color: #999;
            margin-top: 4px;
        }

        .text-muted {
            color: #999;
        }

        /* ===== BUTTON GROUP ===== */
        .d-flex {
            display: flex;
        }

        .gap-2 {
            gap: 12px;
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

        /* ===== TABLE SECTION ===== */
        .mt-2 {
            margin-top: 12px;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: #15463E !important;
        }

        .table thead {
            background: #15463E !important;
        }

        /* Zebra striping seperti di adm_penduduk.css */
        .col-lg-8 .table tbody tr:nth-child(odd) {
            background-color: #EBE9DD !important;
            /* baris ganjil */
        }

        .col-lg-8 .table tbody tr:nth-child(even) {
            background-color: #cbe2c4ff !important;
            /* baris genap */
        }

        /* Jika tr tidak menampilkan background karena td menimpa, targetkan td juga */
        .col-lg-8 .table tbody tr:nth-child(odd) td {
            background-color: EBE9DD !important;
        }

        .col-lg-8 .table tbody tr:nth-child(even) td {
            background-color: #cbe2c4ff !important;
        }

        .table thead th {
            padding: 14px 16px;
            font-size: 15px;
            font-weight: 700;
            color: #256128;
            text-align: left;
            border: none;
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

        /* ===== THUMBNAIL ===== */
        .thumb-sm {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* ===== ACTION BUTTONS IN TABLE ===== */
        .d-flex.gap-1 {
            display: flex;
            gap: 6px;
        }

        .btn-danger-pill {
            border-radius: 999px;
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
            .admin-page-bg {
                padding-bottom: 40px;
            }

            .container {
                padding: 24px 16px 40px;
            }

            .row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .col-lg-4,
            .col-lg-8 {
                grid-column: 1;
            }

            .admin-section-title {
                font-size: 40px;
            }

            .admin-section-subtitle {
                font-size: 16px;
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
                <h1 class="admin-section-title">Struktur Desa</h1>
                <p class="admin-section-subtitle">
                    Atur susunan perangkat desa dan hubungkan dengan data penduduk.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="admin-card">
                        <h3><?= $editMode ? "Edit Jabatan" : "Tambah Jabatan" ?></h3>
                        <p class="subtext">Set posisi, urutan tampilan, dan foto.</p>

                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $editMode ? $editData['id'] : '' ?>">

                            <div class="mb-2">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control"
                                    value="<?= $editMode ? htmlspecialchars($editData['jabatan']) : '' ?>">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Penduduk (opsional)</label>
                                <select name="penduduk_id" class="form-select">
                                    <option value="">Belum dihubungkan</option>
                                    <?php
                                    mysqli_data_seek($pendudukOptions, 0);
                                    while ($p = $pendudukOptions->fetch_assoc()):
                                        $selected = $editMode && $editData['penduduk_id'] == $p['id'] ? 'selected' : '';
                                    ?>
                                        <option value="<?= $p['id'] ?>" <?= $selected ?>>
                                            <?= htmlspecialchars($p['nama']) ?> (ID: <?= $p['id'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <small class="text-muted">Pastikan ID penduduk sudah benar.</small>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Urutan Tampilan</label>
                                <input type="number" name="urutan" class="form-control"
                                    value="<?= $editMode ? $editData['urutan'] : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link Foto</label>
                                <input type="text" name="foto" class="form-control"
                                    value="<?= $editMode ? htmlspecialchars($editData['foto']) : '' ?>">
                                <small class="text-muted">Boleh kosong, nanti tampil placeholder.</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-green btn-pill">
                                    <?= $editMode ? "Perbarui" : "Simpan" ?>
                                </button>
                                <?php if ($editMode): ?>
                                    <a href="admin_struktur.php" class="btn btn-outline-green btn-pill">Batal</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="admin-card">
                        <h3>Daftar Perangkat Desa</h3>
                        <p class="subtext">Urutan menentukan posisi pada tampilan struktur di halaman publik.</p>

                        <div class="table-responsive table-rounded mt-2">
                            <table class="table mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>Urutan</th>
                                        <th>Foto</th>
                                        <th>Jabatan</th>
                                        <th>Nama Penduduk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $list->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $row['urutan'] ?></td>
                                            <td>
                                                <?php if ($row['foto']): ?>
                                                    <img src="<?= htmlspecialchars($row['foto']) ?>" class="thumb-sm" alt="">
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row['jabatan']) ?></td>
                                            <td><?= $row['nama_penduduk'] ? htmlspecialchars($row['nama_penduduk']) : '<span class="text-muted">Belum dihubungkan</span>' ?></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="?edit=<?= $row['id'] ?>" class="btn btn-outline-green btn-sm btn-pill">Edit</a>
                                                    <a href="?hapus=<?= $row['id'] ?>"
                                                        onclick="return confirm('Yakin hapus jabatan ini?')"
                                                        class="btn btn-danger btn-sm btn-danger-pill">Hapus</a>
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