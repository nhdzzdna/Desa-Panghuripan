<?php
require '../config/koneksi.php';
require '../components/components.php';

// Ambil semua data galeri
$sql    = "SELECT * FROM galeri_desa ORDER BY tanggal DESC, id DESC";
$result = mysqli_query($koneksi, $sql);

$galeri = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $galeri[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php head('Galeri Desa'); ?>
    <style>
        /* ================================
           GALERI DESA PAGE
        ================================= */

        body {
            margin: 0;
        }

        .galeriPage {
            min-height: 100vh;
            background-image: url("../assets/landingPage/bgLandingPage.svg");
            background-size: cover;
            background-position: center;
        }

        .galeriContainer {
            padding: 60px;
            box-sizing: border-box;
        }

        /* ---------- TOMBOL KEMBALI ---------- */
        .btnBack {
            display: inline-block;
            padding: 10px 28px;
            font-family: "Plus Jakarta Sans";
            font-size: 35px;
            font-weight: 60;
            color: #15463E;
            border-radius: 30px;
            text-decoration: none;
            transition: .25s ease;
            background: #edd8a8ff;
            border-radius: 20px;
        }

        .btnBack:hover {
            background: #d29a3f;
            color: #FFFFFF;
        }

        /* ---------- HEADER ---------- */

        .galeriHeader {
            display: flex;
            gap: 25px;
            width: 100%;
            padding: 22px 22px;
            border-radius: 30px;
            background: linear-gradient(90deg, #EFB34A 0%, rgba(255,255,255,0.85) 100%);
            box-shadow: 0 10px 20px rgba(0,0,0,0.25);
            margin-bottom: 34px;
        }

        .galeriHeaderTitle {
            margin: 0;
            font-family: "Marcellus SC", serif;
            font-weight: 400;
            font-size: 40px;
            color: #15463E;
        }

        .galeriHeaderSubtitle {
            margin: 8px 0 0;
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
            font-size: 15px;
            color: #15463ECC;
        }

        /* ---------- GRID GALERI ---------- */

        .galeriGrid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .galeriCard {
            background: #FFFFFF;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 18px rgba(0,0,0,0.18);
            display: flex;
            flex-direction: column;
        }

        .galeriImageWrapper {
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: #E0E0E0;
        }

        .galeriImageWrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .3s ease-out;
        }

        .galeriCard:hover .galeriImageWrapper img {
            transform: scale(1.06);
        }

        .galeriBody {
            padding: 12px 15px 14px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .galeriTitle {
            margin: 0;
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
            font-weight: 600;
            font-size: 15px;
            color: #15463E;
            line-height: 1.3;
        }

        .galeriDate {
            margin: 0;
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
            font-weight: 400;
            font-size: 13px;
            color: #6A7A72;
        }

        .galeriEmpty {
            margin-top: 30px;
            text-align: center;
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
            font-size: 17px;
            color: #15463ECC;
        }

        /* ---------- RESPONSIVE ---------- */

        @media (max-width: 1024px) {
            .galeriGrid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .galeriContainer {
                padding: 30px 16px 60px;
            }

            .galeriHeader {
                padding: 20px 26px;
                border-radius: 24px;
            }

            .galeriHeaderTitle {
                font-size: 30px;
            }

            .galeriGrid {
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
            }
        }

        @media (max-width: 520px) {
            .galeriGrid {
                grid-template-columns: 1fr;
            }

            .galeriCard {
                min-height: 210px;
            }
        }
    </style>
</head>
<body>
    <?php navbar(); ?>

    <main class="galeriPage">
        <div class="galeriContainer">

            <!-- TOMBOL KEMBALI -->

            <header class="galeriHeader">
                <a href="../pages/index.php" class="btnBack">←</a>
                <div><h1 class="galeriHeaderTitle">Galeri Desa Panghuripan</h1>
                <p class="galeriHeaderSubtitle">
                    Dokumentasi kegiatan, suasana, dan momen penting di Desa Panghuripan.
                </p></div>
                
            </header>

            <?php if (empty($galeri)): ?>
                <p class="galeriEmpty">Belum ada data galeri yang ditambahkan.</p>
            <?php else: ?>
                <section class="galeriGrid">
                    <?php foreach ($galeri as $item): 
                        $judul = $item['judul'] ?: ('Galeri Desa #' . $item['id']);
                        $foto  = $item['foto'];
                        $tgl   = $item['tanggal'];
                        $tglFormatted = $tgl ? date('d M Y', strtotime($tgl)) : null;
                    ?>
                        <article class="galeriCard">
                            <div class="galeriImageWrapper">
                                <img
                                    src="<?php echo htmlspecialchars($foto, ENT_QUOTES, 'UTF-8'); ?>"
                                    alt="<?php echo htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?>"
                                >
                            </div>
                            <div class="galeriBody">
                                <h2 class="galeriTitle"><?php echo htmlspecialchars($judul); ?></h2>
                                <p class="galeriDate">
                                    <?= $tglFormatted ? "Diunggah: $tglFormatted" : "Tanggal tidak tersedia"; ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>

        </div>

        <?php footer(); ?>
    </main>
</body>
</html>
