<?php
require '../config/koneksi.php';
require '../components/components.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php head('Berita dan Pengumuman') ?>
</head>

<body>
    <?php navbar() ?>

    <main class="beritaPage">
        <section class="beritaHero">
            <div class="beritaHeroOverlay"></div>

            <div class="beritaHeroContent">
                <h1>Berita dan Pengumuman</h1>

                <div class="beritaFeatured">
                    <div class="featuredImage">
                        <img src="../assets/pengumumanBerita/musrenbang.jpg" alt="Pengumuman Musrenbang">
                    </div>
                    <div class="featuredContent">
                        <h2>Pengumuman: Jadwal Musrenbang 2025</h2>
                        <p class="featuredExcerpt">
                            Rapat penyusunan rencana pembangunan desa akan diadakan pada bulan depan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="beritaContainer">
            <div class="beritaFilterBar">
                <button class="filterChip active">Semua</button>
                <button class="filterChip">Pengumuman</button>
                <button class="filterChip">Kegiatan Desa</button>

                <div class="beritaSearch">
                    <input type="text" placeholder="Search">
                    <button type="button" class="btnSearch">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <div class="beritaList">
                <article class="beritaCard">
                    <img src="../assets/pengumumanBerita/pembangunan.jpg" alt="Berita pembangunan">
                    <div class="beritaCardOverlay">
                        <h3>Akhirnya Ada Pembangunan di Desa Kita Terlope</h3>
                    </div>
                </article>

                <article class="beritaCard">
                    <img src="../assets/pengumumanBerita/pembangunan.jpg" alt="Berita pembangunan">
                    <div class="beritaCardOverlay">
                        <h3>Akhirnya Ada Pembangunan di Desa Kita Terlope</h3>
                    </div>
                </article>

                <article class="beritaCard">
                    <img src="../assets/pengumumanBerita/pembangunan.jpg" alt="Berita pembangunan">
                    <div class="beritaCardOverlay">
                        <h3>Akhirnya Ada Pembangunan di Desa Kita Terlope</h3>
                    </div>
                </article>

                <article class="beritaCard">
                    <img src="../assets/pengumumanBerita/pembangunan.jpg" alt="Berita pembangunan">
                    <div class="beritaCardOverlay">
                        <h3>Akhirnya Ada Pembangunan di Desa Kita Terlope</h3>
                    </div>
                </article>

                <article class="beritaCard">
                    <img src="../assets/pengumumanBerita/pembangunan.jpg" alt="Berita pembangunan">
                    <div class="beritaCardOverlay">
                        <h3>Akhirnya Ada Pembangunan di Desa Kita Terlope</h3>
                    </div>
                </article>

                <article class="beritaCard">
                    <img src="../assets/pengumumanBerita/pembangunan.jpg" alt="Berita pembangunan">
                    <div class="beritaCardOverlay">
                        <h3>Akhirnya Ada Pembangunan di Desa Kita Terlope</h3>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <?php footer() ?>
</body>

</html>
