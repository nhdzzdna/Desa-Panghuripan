<?php
require '../config/koneksi.php';
require '../components/components.php';

// Ambil semua data (untuk list bawah)
$beritaItems = [];
$sqlBerita   = "SELECT * FROM berita_pengumuman ORDER BY tanggal DESC, id DESC";
$resultBerita = mysqli_query($koneksi, $sqlBerita);

if ($resultBerita) {
    while ($row = mysqli_fetch_assoc($resultBerita)) {
        $beritaItems[] = $row;
    }
}

// Ambil 3 pengumuman terbaru untuk featured
$featuredItems = [];
$sqlFeatured = "
    SELECT * FROM berita_pengumuman
    WHERE tipe = 'pengumuman'
    ORDER BY tanggal DESC, id DESC
    LIMIT 3
";
$resultFeatured = mysqli_query($koneksi, $sqlFeatured);

if ($resultFeatured) {
    while ($row = mysqli_fetch_assoc($resultFeatured)) {
        // siapkan fallback di level PHP
        $gambar = !empty($row['gambar'])
            ? $row['gambar']
            : '../assets/beritaPengumuman/pembangunan.jpg';

        $judul = !empty($row['judul'])
            ? $row['judul']
            : 'Tanpa judul';

        $isi = !empty($row['isi'])
            ? $row['isi']
            : 'Belum ada deskripsi untuk pengumuman ini.';

        $featuredItems[] = [
            'gambar' => $gambar,
            'judul'  => $judul,
            'isi'    => $isi,
        ];
    }
}
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
                        <?php if (!empty($featuredItems)): ?>
                            <?php
                                $firstFeat = $featuredItems[0];
                            ?>
                            <img
                                src="<?php echo htmlspecialchars($firstFeat['gambar'], ENT_QUOTES, 'UTF-8'); ?>"
                                alt="<?php echo htmlspecialchars($firstFeat['judul'], ENT_QUOTES, 'UTF-8'); ?>"
                            >
                        <?php else: ?>
                            <!-- fallback kalau tidak ada pengumuman -->
                            <img src="../assets/beritaPengumuman/musrenbang.jpg" alt="Pengumuman Musrenbang">
                        <?php endif; ?>
                    </div>
                    <div class="featuredContent">
                        <?php if (!empty($featuredItems)): ?>
                            <h2>
                                <?php echo htmlspecialchars($firstFeat['judul'], ENT_QUOTES, 'UTF-8'); ?>
                            </h2>
                            <p class="featuredExcerpt">
                                <?php echo htmlspecialchars($firstFeat['isi'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        <?php else: ?>
                            <h2>Pengumuman: Jadwal Musrenbang 2025</h2>
                            <p class="featuredExcerpt">
                                Rapat penyusunan rencana pembangunan desa akan diadakan pada bulan depan.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="beritaContainer">
            <div class="beritaFilterBar">
                <button class="filterChip active" data-filter="semua">Semua</button>
                <button class="filterChip" data-filter="pengumuman">Pengumuman</button>
                <button class="filterChip" data-filter="berita">Kegiatan Desa</button>

                <div class="beritaSearch">
                    <input type="text" placeholder="Search">
                    <button type="button" class="btnSearch">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <div class="beritaList">
                <?php if (!empty($beritaItems)): ?>
                    <?php foreach ($beritaItems as $item): 
                        $gambar = !empty($item['gambar']) 
                            ? $item['gambar'] 
                            : '../assets/beritaPengumuman/pembangunan.jpg';

                        $judul  = !empty($item['judul']) 
                            ? $item['judul'] 
                            : 'Tanpa judul';

                        $tipe   = strtolower($item['tipe']); 
                        $judulSearch = strtolower($judul);
                    ?>
                        <article 
                            class="beritaCard" 
                            data-tipe="<?php echo $tipe; ?>"
                            data-judul="<?php echo htmlspecialchars($judulSearch, ENT_QUOTES, 'UTF-8'); ?>"
                        >
                            <img 
                                src="<?php echo htmlspecialchars($gambar, ENT_QUOTES, 'UTF-8'); ?>" 
                                alt="<?php echo htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="beritaCardOverlay">
                                <h3><?php echo htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?></h3>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="
                        grid-column: 1 / -1;
                        text-align: center;
                        font-family: 'Plus Jakarta Sans';
                        font-size: 20px;
                        font-weight: 600;
                        color: #FFFFFF;
                        text-shadow: 0 2px 4px rgba(0,0,0,0.4);
                        padding: 20px 0;
                    ">
                        Belum ada berita atau pengumuman yang ditambahkan.
                    </p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php footer() ?>

    <script>
        // ====== DATA FEATURED DARI PHP (3 pengumuman terbaru) ======
        const featuredData = <?php echo json_encode($featuredItems, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?> || [];

        // ====== ELEMENTS UNTUK FEATURED ======
        const featuredImg     = document.querySelector(".featuredImage img");
        const featuredTitle   = document.querySelector(".featuredContent h2");
        const featuredExcerpt = document.querySelector(".featuredExcerpt");

        if (featuredData.length > 0 && featuredImg && featuredTitle && featuredExcerpt) {
            let currentIndex = 0;

            function showFeatured(index) {
                const item = featuredData[index];
                if (!item) return;

                featuredImg.src   = item.gambar;
                featuredImg.alt   = item.judul;
                featuredTitle.textContent   = item.judul;
                featuredExcerpt.textContent = item.isi;
            }

            // mulai dari data pertama (sudah di-set di HTML), lalu rotasi
            setInterval(() => {
                currentIndex = (currentIndex + 1) % featuredData.length;
                showFeatured(currentIndex);
            }, 5000);
        }

        // ====== FILTER + SEARCH BERITA LIST ======
        const filterButtons = document.querySelectorAll(".filterChip");
        const cards         = document.querySelectorAll(".beritaCard");
        const searchInput   = document.querySelector(".beritaSearch input");

        function applyFilters() {
            const activeBtn = document.querySelector(".filterChip.active");
            const filter    = activeBtn ? activeBtn.dataset.filter : "semua";
            const keyword   = searchInput.value.trim().toLowerCase();

            cards.forEach(card => {
                const type  = card.dataset.tipe;
                const title = card.dataset.judul || "";

                const matchFilter = (filter === "semua" || filter === type);
                const matchSearch = (keyword === "" || title.includes(keyword));

                if (matchFilter && matchSearch) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        filterButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                filterButtons.forEach(b => b.classList.remove("active"));
                btn.classList.add("active");
                applyFilters();
            });
        });

        if (searchInput) {
            searchInput.addEventListener("input", () => {
                applyFilters();
            });
        }
    </script>
</body>
</html>
