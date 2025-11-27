<?php
require '../components/components.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php head('Pengajuan Surat'); ?>
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
            color: #15463E;
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
        .layananList {
            margin: 0;
            padding-left: 20px;
            font-size: 15px;
        }
        .layananParagraph {
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 10px;
        }
        .waBox {
            margin-top: 28px;
            padding: 16px 18px;
            border-radius: 18px;
            background: #E8F3EA;
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
            background: #25D366;
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

        <h1 class="layananTitle">Pengajuan Surat</h1>
        <p class="layananSubtitle">
            Layanan pengajuan berbagai surat keterangan dari Pemerintah Desa Panghuripan.
        </p>

        <h2 class="layananSectionTitle">Jenis Surat yang Dilayani</h2>
        <ul class="layananList">
            <li>Surat Keterangan Domisili</li>
            <li>Surat Keterangan Usaha (SKU)</li>
            <li>Surat Pengantar SKCK</li>
            <li>Surat Keterangan Tidak Mampu</li>
            <li>Surat Pengantar Nikah</li>
            <li>Surat Keterangan Kelahiran dan Kematian</li>
        </ul>

        <h2 class="layananSectionTitle">Persyaratan Umum</h2>
        <p class="layananParagraph">Persyaratan dapat berbeda tergantung jenis surat, namun secara umum meliputi:</p>
        <ul class="layananList">
            <li>Fotokopi KTP dan KK</li>
            <li>Formulir permohonan yang telah diisi</li>
            <li>Dokumen pendukung lain sesuai kebutuhan (misalnya surat pengantar RT/RW)</li>
        </ul>

        <h2 class="layananSectionTitle">Prosedur Pengajuan</h2>
        <ol class="layananList">
            <li>Siapkan dokumen persyaratan sesuai jenis surat yang dibutuhkan.</li>
            <li>Datang ke kantor Balai Desa Panghuripan pada jam pelayanan.</li>
            <li>Serahkan berkas kepada petugas dan isi formulir yang disediakan.</li>
            <li>Petugas akan memproses dan mencetak surat.</li>
            <li>Surat dapat diambil pada hari yang sama atau sesuai informasi petugas.</li>
        </ol>

        <div class="waBox">
            <div class="waBoxText">
                Ingin konfirmasi terlebih dahulu? Hubungi admin layanan surat melalui WhatsApp.
            </div>
            <a
                href="https://wa.me/6281234567890?text=Halo%20Admin%20Desa%2C%20saya%20ingin%20mengajukan%20surat."
                target="_blank"
                class="btnWA"
            >
                <i class="bi bi-whatsapp"></i>
                Hubungi via WhatsApp
            </a>
        </div>
    </section>
</main>

<?php footer(); ?>
</body>
</html>
