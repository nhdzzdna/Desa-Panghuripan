<?php
require '../components/components.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php head('Pengaduan Warga'); ?>
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
            margin-top: 28px;
            padding: 16px 18px;
            border-radius: 18px;
            background: #FFF5D8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .waBoxText {
            font-size: 14px;
        }
        .btnWA {
            padding: 10px 20px;
            border-radius: 999px;
            border: none;
            background: #FF9900;
            color: #FFFFFF;
            font-weight: 600;
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
        <h1 class="layananTitle">Pengaduan Warga</h1>
        <p class="layananSubtitle">
            Saluran resmi untuk menyampaikan keluhan, saran, dan laporan terkait pelayanan maupun kondisi lingkungan desa.
        </p>

        <h2 class="layananSectionTitle">Jenis Pengaduan yang Dapat Dilaporkan</h2>
        <ul class="layananList">
            <li>Jalan rusak, lampu penerangan jalan mati, atau fasilitas umum lainnya.</li>
            <li>Gangguan kebersihan lingkungan (sampah menumpuk, bau, banjir, dan sejenisnya).</li>
            <li>Gangguan ketertiban dan keamanan lingkungan.</li>
            <li>Pelayanan publik yang kurang baik atau tidak sesuai prosedur.</li>
            <li>Masalah sosial di lingkungan warga.</li>
        </ul>

        <h2 class="layananSectionTitle">Etika dan Tata Cara Pengaduan</h2>
        <ol class="layananList">
            <li>Sampaikan pengaduan dengan bahasa yang sopan dan jelas.</li>
            <li>Sertakan lokasi kejadian dan waktu kejadian secara lengkap.</li>
            <li>Bila memungkinkan, lampirkan foto pendukung ketika menghubungi petugas.</li>
            <li>Pengaduan akan diproses sesuai prioritas dan tingkat kedaruratan.</li>
        </ol>

        <div class="waBox">
            <div class="waBoxText">
                Untuk pengaduan cepat, silakan kirim pesan WhatsApp ke petugas pengaduan desa.
            </div>
            <a
                href="https://wa.me/6281234567890?text=Halo%20Admin%20Desa%2C%20saya%20ingin%20menyampaikan%20pengaduan%20terkait..."
                target="_blank"
                class="btnWA"
            >
                <i class="bi bi-whatsapp"></i>
                Kirim Pengaduan via WhatsApp
            </a>
        </div>
    </section>
</main>

<?php footer(); ?>
</body>
</html>
