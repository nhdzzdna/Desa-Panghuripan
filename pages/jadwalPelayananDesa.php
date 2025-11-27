<?php
require '../components/components.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php head('Jadwal Pelayanan Desa'); ?>
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
        .jadwalTable {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .jadwalTable th,
        .jadwalTable td {
            border: 1px solid #D0D8D2;
            padding: 10px 12px;
        }
        .jadwalTable th {
            background: #E6F0EA;
            font-weight: 700;
            text-align: left;
        }
        .jadwalTable td {
            background: #FFFFFF;
        }
        .jadwalNote {
            margin-top: 16px;
            font-size: 13px;
            color: #526659;
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
            .jadwalTable {
                font-size: 13px;
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
        <h1 class="layananTitle">Jadwal Pelayanan Desa</h1>
        <p class="layananSubtitle">
            Informasi jam operasional dan jadwal pelayanan di lingkungan Pemerintah Desa Panghuripan.
        </p>

        <table class="jadwalTable">
            <thead>
                <tr>
                    <th>Jenis Pelayanan</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pelayanan Administrasi (Surat Menyurat)</td>
                    <td>Senin – Jumat</td>
                    <td>08.00 – 13.00 WIB</td>
                    <td>Balai Desa Panghuripan</td>
                </tr>
                <tr>
                    <td>Pelayanan Kependudukan (KK, KTP, dll) - koordinasi kecamatan</td>
                    <td>Selasa &amp; Kamis</td>
                    <td>09.00 – 12.00 WIB</td>
                    <td>Balai Desa / Kantor Kecamatan (sesuai informasi petugas)</td>
                </tr>
                <tr>
                    <td>Posyandu Balita</td>
                    <td>Minggu ke-2 tiap bulan</td>
                    <td>08.00 – selesai</td>
                    <td>Posyandu / Balai Dusun</td>
                </tr>
                <tr>
                    <td>Posyandu Lansia</td>
                    <td>Minggu ke-3 tiap bulan</td>
                    <td>08.00 – selesai</td>
                    <td>Balai Desa</td>
                </tr>
                <tr>
                    <td>Forum Musyawarah Desa / Rapat Warga</td>
                    <td>Sesuai undangan</td>
                    <td>Sesuai undangan</td>
                    <td>Balai Desa / lokasi lain sesuai undangan</td>
                </tr>
            </tbody>
        </table>

        <p class="jadwalNote">
            Catatan: Jadwal dapat berubah sewaktu-waktu menyesuaikan kebijakan pemerintah dan kondisi lapangan.
            Informasi terbaru akan diumumkan melalui papan pengumuman, website, dan media sosial desa.
        </p>
    </section>
</main>

<?php footer(); ?>
</body>
</html>
