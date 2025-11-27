<?php
require '../components/components.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php head('Peminjaman Fasilitas Desa'); ?>
    <style>
        .layananPage {
            min-height: 100vh;
            background: linear-gradient(180deg, #003631 0%, #EBE9DD 60%);
        }
        .layananContainer {
            max-width: 960px;
            margin: 40px auto 60px;
            padding: 30px 24px;
            background: #FFFFFFEE;
            border-radius: 26px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            font-family: "Plus Jakarta Sans", system-ui, sans-serif;
            color: #15463E;
        }
        .layananTitle {
            font-family: "Marcellus SC", serif;
            font-size: 40px;
            margin: 0 0 10px;
            text-align: center;
        }
        .layananSubtitle {
            margin: 0 0 24px;
            text-align: center;
            color: #3A5F4C;
            font-size: 16px;
        }
        .layananSectionTitle {
            font-weight: 700;
            font-size: 20px;
            margin: 24px 0 8px;
        }
        .layananParagraph {
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 10px;
        }
        .layananList {
            margin: 0;
            padding-left: 20px;
            font-size: 15px;
        }
        .waBox {
            margin-top: 24px;
            padding: 16px 18px;
            border-radius: 18px;
            background: #FFF5D8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            font-size: 14px;
        }
        .btnWA {
            padding: 10px 20px;
            border-radius: 999px;
            border: none;
            background: #EFB34A;
            color: #15463E;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btnWA i {
            font-size: 18px;
        }
        /* Tombol Kembali */
        .backRow {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .btnBack {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #15463E;
            color: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
            transition: background .25s ease;
        }

        .btnBack:hover {
            background: #0F352B;
        }


        @media (max-width: 768px) {
            .layananContainer {
                margin: 20px 16px 40px;
                padding: 22px 18px;
            }
            .layananTitle {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
<?php navbar(); ?>

<main class="layananPage">
    <section class="layananContainer">
        <div class="backRow">
            <a href="../pages/layananWarga.php" class="btnBack">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <h1 class="layananTitle">Peminjaman Fasilitas Desa</h1>
        <p class="layananSubtitle">
            Layanan peminjaman dan penggunaan fasilitas milik desa untuk kegiatan warga dan organisasi.
        </p>

        <h2 class="layananSectionTitle">Fasilitas yang Dapat Dipinjam</h2>
        <ul class="layananList">
            <li>Balai Desa / Aula pertemuan.</li>
            <li>Sound system dan perlengkapan dasar.</li>
            <li>Tenda, kursi, dan meja milik desa (sesuai ketersediaan).</li>
            <li>Lapangan desa untuk kegiatan olahraga atau acara tertentu.</li>
        </ul>

        <h2 class="layananSectionTitle">Persyaratan Peminjaman</h2>
        <ul class="layananList">
            <li>Mengajukan permohonan minimal H-3 sebelum kegiatan.</li>
            <li>Melampirkan fotokopi KTP penanggung jawab kegiatan.</li>
            <li>Menandatangani surat pernyataan menjaga fasilitas desa.</li>
            <li>Bersedia mengganti kerusakan apabila terjadi kelalaian.</li>
        </ul>

        <h2 class="layananSectionTitle">Prosedur Peminjaman</h2>
        <ol class="layananList">
            <li>Menghubungi perangkat desa atau datang langsung ke Balai Desa untuk mengecek ketersediaan.</li>
            <li>Mengisi formulir peminjaman fasilitas desa.</li>
            <li>Apabila disetujui, peminjaman akan dijadwalkan dan dicatat oleh petugas.</li>
            <li>Setelah kegiatan selesai, fasilitas dikembalikan dalam kondisi baik.</li>
        </ol>

        <div class="waBox">
            <span>Ingin menanyakan ketersediaan fasilitas desa?</span>
            <a
                href="https://wa.me/6281234567890?text=Halo%20Admin%20Desa%2C%20saya%20ingin%20menanyakan%20ketersediaan%20fasilitas%20desa."
                target="_blank"
                class="btnWA"
            >
                <i class="bi bi-whatsapp"></i>
                Tanya Ketersediaan
            </a>
        </div>
    </section>
</main>

<?php footer(); ?>
</body>
</html>
