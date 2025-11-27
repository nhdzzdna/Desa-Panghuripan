<?php
require '../config/koneksi.php';
require '../components/components.php';

// Ambil 3 data galeri terbaru
$galeriLanding = [];
$sqlGaleri = "SELECT foto, judul FROM galeri_desa ORDER BY tanggal DESC, id DESC LIMIT 3";
$resultGaleri = mysqli_query($koneksi, $sqlGaleri);

if ($resultGaleri) {
    while ($row = mysqli_fetch_assoc($resultGaleri)) {
        $galeriLanding[] = $row;
    }
}

// ---------------------------
// Data Struktur Perangkat Desa
// ---------------------------
$strukturList = [];
$defaultFotoKosong = 'https://i.pinimg.com/originals/21/d2/9f/21d29f70c61cdfc6a90cf1e53004d22e.png';

$sqlStruktur = "
    SELECT s.*, p.nama AS penduduk_nama
    FROM struktur_perangkat_desa s
    LEFT JOIN penduduk p ON s.penduduk_id = p.id
    ORDER BY s.urutan ASC, s.id ASC
";
$resultStruktur = mysqli_query($koneksi, $sqlStruktur);

if ($resultStruktur) {
    while ($row = mysqli_fetch_assoc($resultStruktur)) {
        $strukturList[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php head('Landing Page') ?>
</head>

<body>
    <?php navbar() ?>

    <main class="landingPage">
        <section class="heroLanding">
            <div class="heroContent">
                <h1>Desa Panghuripan</h1>
                <p class="heroTagline">“Nguripi, Nglestari, Ngluhuraké”</p>
            </div>
        </section>

        <section class="sectionGaleri">
            <div class="wrapperGaleri">
                <div class="headerGaleri">
                    <h2>Galeri Desa</h2>
                    <a href="../pages/galeriDesa.php" class="btnSelengkapnya">Selengkapnya</a>
                </div>
                <div class="listGaleri">
                    <?php if (!empty($galeriLanding)): ?>

                        <?php foreach ($galeriLanding as $item): 
                            $src = $item['foto'];
                            $alt = !empty($item['judul']) ? $item['judul'] : 'Galeri Desa Panghuripan';
                        ?>
                            <div class="cardGaleri">
                                <img 
                                    src="<?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8'); ?>" 
                                    alt="<?php echo htmlspecialchars($alt, ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <!-- KETERANGAN JIKA GALERI KOSONG (inline style) -->
                        <p style="
                            grid-column: 1 / -1;
                            text-align: center;
                            font-family: 'Plus Jakarta Sans';
                            font-size: 20px;
                            font-weight: 600;
                            color: white;
                            padding: 20px 0;
                        ">
                            Belum ada foto galeri yang ditambahkan.
                        </p>

                    <?php endif; ?>
                </div>

            </div>
        </section>

        <section class="sectionTentang">
            <div class="tentangWrapper">
                <img src="../assets/landingPage/daun2.svg" class="leaf leaf1">
                <img src="../assets/landingPage/daun1.svg" class="leaf leaf2">
                <img src="../assets/landingPage/daun1.svg" class="leaf leaf3">
                <img src="../assets/landingPage/daun2.svg" class="leaf leaf4">

                <div class="judulTentang">
                    <div class="line"></div>
                    <h2>Desa Panghuripan</h2>
                    <div class="line"></div>
                </div>
                
                <p class="subJudulJawa">ꦣꦼꦱꦥꦁꦲꦸꦫꦶꦥꦤ꧀</p>

                <p class="deskripsiTentang">
                    Desa Panghuripan berdiri sekitar tahun 1950–an sebagai pemukiman kecil di kaki Gunung Merapi. 
                    Nama ‘Panghuripan’ berasal dari bahasa Jawa ‘ngurip-urip’, yang berarti menghidupi atau memberi kehidupan. 
                    Desa ini dikenal dengan tradisi gotong royong yang kuat dan pertanian organik yang menjadi ciri khasnya.
                </p>
            </div>
        </section>

        <section class="visiMisi">
            <div class="boxVisi">
                <h3>VISI</h3>
                <p>Menjadi desa mandiri, hijau, dan berbudaya di era digital.</p>
            </div>

            <div class="boxMisi">
                <h3>MISI</h3>
                <ol>
                    <li>Mengembangkan potensi pertanian dan pariwisata berbasis teknologi.</li>
                    <li>Meningkatkan pelayanan publik berbasis digital.</li>
                    <li>Melestarikan budaya dan tradisi lokal.</li>
                    <li>Mendorong partisipasi masyarakat dalam pembangunan desa.</li>
                </ol>
            </div>
        </section>

        <section class="strukturDesa">
            <div class="strukturWrapper">
                <div class="strukturHeader">
                    <h2>Struktur Perangkat Desa</h2>
                </div>

                <button class="navStruktur prev" type="button" aria-label="Sebelumnya">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="strukturTrack">
                    <?php foreach ($strukturList as $s): ?>
                        <?php
                            // Tentukan nama
                            if (!is_null($s['penduduk_id']) && !empty($s['penduduk_nama'])) {
                                $nama = $s['penduduk_nama'];
                            } else {
                                $nama = 'Jabatan kosong';
                            }

                            // Tentukan foto: pakai kolom foto jika ada, kalau kosong pakai default
                            if (!empty($s['foto'])) {
                                $foto = $s['foto'];
                            } else {
                                $foto = $defaultFotoKosong;
                            }

                            $jabatan = $s['jabatan'];
                        ?>
                        <div class="cardStruktur">
                            <img 
                                src="<?php echo htmlspecialchars($foto, ENT_QUOTES, 'UTF-8'); ?>" 
                                alt="<?php echo htmlspecialchars($jabatan, ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="cardStrukturBody">
                                <p class="jabatan"><?php echo htmlspecialchars($jabatan, ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="nama"><?php echo htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="navStruktur next" type="button" aria-label="Berikutnya">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </section>

        <section class="lokasiDesa">
            <div class="lokasiWrapper">
                <div class="lokasiMap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31624.69913842993!2d110.3078017!3d-7.7805584!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59170e3ab1a7%3A0xd7ea9242c49b29d9!2sAyom%20Jogja!5e0!3m2!1sid!2sid!4v1764096681959!5m2!1sid!2sid">
                    </iframe>
                </div>

                <div class="lokasiInfo">
                    <h3>
                        Lokasi Desa 
                        <i class="bi bi-geo-alt-fill"></i>
                    </h3>
                    <p>Jl. Dalgino, Area Sawah, Banyuraden, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55293</p>
                </div>
            </div>
        </section>
    </main>

    <?php footer() ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const track = document.querySelector(".strukturTrack");
            const prevBtn = document.querySelector(".navStruktur.prev");
            const nextBtn = document.querySelector(".navStruktur.next");

            const cardWidth = 265 + 18; // card + gap
            const scrollAmount = cardWidth * 2; // geser 2 kartu

            // NONAKTIFKAN scroll manual
            track.style.overflowX = "hidden";

            prevBtn.addEventListener("click", () => {
                track.scrollBy({ left: -scrollAmount, behavior: "smooth" });
            });

            nextBtn.addEventListener("click", () => {
                track.scrollBy({ left: scrollAmount, behavior: "smooth" });
            });
        });
    </script>
</body>

</html>
