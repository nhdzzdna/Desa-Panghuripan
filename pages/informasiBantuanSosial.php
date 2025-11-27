<?php
require '../components/components.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php head('Informasi Bantuan Sosial'); ?>
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
        <h1 class="layananTitle">Informasi Bantuan Sosial</h1>
        <p class="layananSubtitle">
            Informasi mengenai program bantuan sosial yang tersedia bagi warga Desa Panghuripan.
        </p>

        <h2 class="layananSectionTitle">Jenis Bantuan</h2>
        <ul class="layananList">
            <li>Program Keluarga Harapan (PKH).</li>
            <li>Bantuan Pangan Non Tunai (BPNT).</li>
            <li>Bantuan Langsung Tunai (BLT) Dana Desa.</li>
            <li>Bantuan bagi lanjut usia dan penyandang disabilitas.</li>
            <li>Bantuan kedaruratan bagi korban bencana.</li>
        </ul>

        <h2 class="layananSectionTitle">Syarat Umum Penerima</h2>
        <ul class="layananList">
            <li>Terdaftar sebagai penduduk Desa Panghuripan.</li>
            <li>Masuk dalam data terpadu kesejahteraan sosial (DTKS) atau hasil verifikasi desa.</li>
            <li>Tidak sedang menerima bantuan sejenis dari program lain, kecuali ditentukan lain oleh pemerintah.</li>
        </ul>

        <h2 class="layananSectionTitle">Alur Pendaftaran / Pembaruan Data</h2>
        <ol class="layananList">
            <li>Menghubungi Ketua RT/RW setempat untuk pendataan awal.</li>
            <li>Pengajuan data diajukan ke Pemerintah Desa melalui Kasi Kesejahteraan.</li>
            <li>Tim desa melakukan verifikasi dan validasi data.</li>
            <li>Data dikirim ke instansi terkait sesuai program bantuan.</li>
            <li>Informasi penerima dan jadwal penyaluran akan diumumkan melalui papan informasi, website desa, dan media sosial.</li>
        </ol>
    </section>
</main>

<?php footer(); ?>
</body>
</html>
