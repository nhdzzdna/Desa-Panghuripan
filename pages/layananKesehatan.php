<?php
require '../components/components.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php head('Layanan Kesehatan'); ?>
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
        .kontakBox {
            margin-top: 20px;
            padding: 14px 16px;
            border-radius: 18px;
            background: #E8F3EA;
            font-size: 14px;
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
        <h1 class="layananTitle">Layanan Kesehatan</h1>
        <p class="layananSubtitle">
            Informasi layanan kesehatan dasar yang tersedia bagi warga Desa Panghuripan.
        </p>

        <h2 class="layananSectionTitle">Posyandu Balita</h2>
        <p class="layananParagraph">
            Posyandu Balita dilaksanakan secara rutin untuk memantau tumbuh kembang anak dan memberikan imunisasi.
        </p>
        <ul class="layananList">
            <li>Pelayanan penimbangan dan pengukuran tinggi badan.</li>
            <li>Pemberian imunisasi dasar sesuai jadwal.</li>
            <li>Konsultasi gizi dan kesehatan balita.</li>
        </ul>

        <h2 class="layananSectionTitle">Layanan Kesehatan Ibu Hamil</h2>
        <p class="layananParagraph">
            Pemeriksaan kehamilan dapat dilakukan di bidan desa maupun fasilitas kesehatan rujukan.
        </p>
        <ul class="layananList">
            <li>Pemeriksaan kehamilan berkala.</li>
            <li>Pemberian tablet tambah darah.</li>
            <li>Konseling gizi dan persiapan persalinan.</li>
        </ul>

        <h2 class="layananSectionTitle">Lansia dan Penyakit Tidak Menular</h2>
        <p class="layananParagraph">
            Layanan untuk warga lanjut usia dan pemantauan penyakit tidak menular seperti hipertensi dan diabetes.
        </p>
        <ul class="layananList">
            <li>Pemeriksaan tekanan darah.</li>
            <li>Pemeriksaan gula darah (bila tersedia).</li>
            <li>Penyuluhan pola hidup sehat.</li>
        </ul>

        <div class="kontakBox">
            Kontak layanan kesehatan desa:<br>
            Bidan Desa: 0812-xxxx-xxxx<br>
            Puskesmas Pembantu terdekat: 0274-xxx-xxx
        </div>
    </section>
</main>

<?php footer(); ?>
</body>
</html>
