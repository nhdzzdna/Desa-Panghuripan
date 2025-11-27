<?php
require '../config/koneksi.php';
require '../components/components.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php head('Layanan Warga') ?>
</head>

<body>
    <?php navbar() ?>

    <main class="layananPage">
        <section class="layananHero">
            <div class="layananHeroOverlay"></div>

            <div class="layananHeroContent">
                <h1>Layanan Warga</h1>

                <div class="layananGrid">

                    <!-- 1. Pengajuan Surat -->
                    <a href="../pages/pengajuanSurat.php" class="layananCard">
                        <div class="layananIcon">
                            <img src="../assets/layananWarga/icon-surat.svg" alt="Pengajuan Surat">
                        </div>
                        <div class="layananText">
                            <h2>Pengajuan Surat</h2>
                            <p>Pengajuan berbagai jenis surat desa</p>
                        </div>
                    </a>

                    <!-- 2. Pengaduan Warga -->
                    <a href="../pages/pengaduanWarga.php" class="layananCard">
                        <div class="layananIcon">
                            <img src="../assets/layananWarga/icon-pengaduan.svg" alt="Pengaduan Warga">
                        </div>
                        <div class="layananText">
                            <h2>Pengaduan Warga</h2>
                            <p>Laporkan berbagai macam masalah di desa</p>
                        </div>
                    </a>

                    <!-- 3. Informasi Bantuan Sosial -->
                    <a href="../pages/informasiBantuanSosial.php" class="layananCard">
                        <div class="layananIcon">
                            <img src="../assets/layananWarga/icon-bantuan.svg" alt="Informasi Bantuan Sosial">
                        </div>
                        <div class="layananText">
                            <h2>Informasi Bantuan Sosial</h2>
                            <p>Informasi mengenai bantuan sosial</p>
                        </div>
                    </a>

                    <!-- 4. Jadwal Pelayanan Desa -->
                    <a href="../pages/jadwalPelayananDesa.php" class="layananCard">
                        <div class="layananIcon">
                            <img src="../assets/layananWarga/icon-jadwal.svg" alt="Jadwal Pelayanan Desa">
                        </div>
                        <div class="layananText">
                            <h2>Jadwal Pelayanan Desa</h2>
                            <p>Jadwal pelayanan yang tersedia di desa</p>
                        </div>
                    </a>

                    <!-- 5. Layanan Kesehatan -->
                    <a href="../pages/layananKesehatan.php" class="layananCard">
                        <div class="layananIcon">
                            <img src="../assets/layananWarga/icon-kesehatan.svg" alt="Layanan Kesehatan">
                        </div>
                        <div class="layananText">
                            <h2>Layanan Kesehatan</h2>
                            <p>Layanan kesehatan desa</p>
                        </div>
                    </a>

                    <!-- 6. Peminjaman Fasilitas Desa -->
                    <a href="../pages/peminjamanFasilitasDesa.php" class="layananCard">
                        <div class="layananIcon">
                            <img src="../assets/layananWarga/icon-fasilitas.svg" alt="peminjaman Fasilitas Desa">
                        </div>
                        <div class="layananText">
                            <h2>Peminjaman Fasilitas Desa</h2>
                            <p>Pengajuan peminjaman fasilitas desa</p>
                        </div>
                    </a>

                </div>
            </div>
        </section>

        <?php footer() ?>
    </main>
</body>

</html>
