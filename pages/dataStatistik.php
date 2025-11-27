<?php 
require '../config/koneksi.php';
require '../components/components.php';

/*
 |--------------------------------------------------------------
 | 1. AMBIL DATA RINGKASAN (KARTU DI ATAS)
 |--------------------------------------------------------------
*/

// jumlah penduduk hidup
$qTotal = mysqli_query($koneksi, "
    SELECT COUNT(*) AS total 
    FROM penduduk 
    WHERE status_hidup = 'Hidup'
");
$totalPenduduk = (int) mysqli_fetch_assoc($qTotal)['total'];

// laki-laki & perempuan (hidup)
$qGender = mysqli_query($koneksi, "
    SELECT jenis_kelamin, COUNT(*) AS jml
    FROM penduduk
    WHERE status_hidup = 'Hidup'
    GROUP BY jenis_kelamin
");
$totalLaki = 0;
$totalPerempuan = 0;
while ($row = mysqli_fetch_assoc($qGender)) {
    if ($row['jenis_kelamin'] === 'L') {
        $totalLaki = (int) $row['jml'];
    } elseif ($row['jenis_kelamin'] === 'P') {
        $totalPerempuan = (int) $row['jml'];
    }
}

// kepala keluarga = jumlah KK unik
$qKK = mysqli_query($koneksi, "
    SELECT COUNT(DISTINCT no_kk) AS jml
    FROM penduduk
");
$kepalaKeluarga = (int) mysqli_fetch_assoc($qKK)['jml'];

/*
 |--------------------------------------------------------------
 | 2. DATA BERDASARKAN PEKERJAAN
 |   (Petani, Pedagang, Pegawai Swasta, Pelajar, Lainnya)
 |--------------------------------------------------------------
*/

$profesiLabels = ['Petani', 'Pedagang', 'Pegawai Swasta', 'Pelajar', 'Lainnya'];
$profesiCounts = array_fill_keys($profesiLabels, 0);

$qProfesi = mysqli_query($koneksi, "
    SELECT profesi, COUNT(*) AS jml
    FROM penduduk
    WHERE status_hidup = 'Hidup'
    GROUP BY profesi
");

while ($row = mysqli_fetch_assoc($qProfesi)) {
    $namaProfesi = $row['profesi'];
    $jml = (int) $row['jml'];

    if (isset($profesiCounts[$namaProfesi])) {
        $profesiCounts[$namaProfesi] += $jml;
    } else {
        // profesi yang tidak termasuk 4 kategori utama dimasukkan ke "Lainnya"
        $profesiCounts['Lainnya'] += $jml;
    }
}

/*
 |--------------------------------------------------------------
 | 3. DATA BERDASARKAN PENDIDIKAN
 |   (kategori sesuai desain UI/UX)
 |--------------------------------------------------------------
*/

$eduLabels = [
    'Belum Sekolah',
    'SD',
    'SMP',
    'SMA',
    'Perguruan Tinggi'
];

$eduCounts = array_fill_keys($eduLabels, 0);

$qEdu = mysqli_query($koneksi, "
    SELECT pendidikan, COUNT(*) AS jml
    FROM penduduk
    WHERE status_hidup = 'Hidup'
    GROUP BY pendidikan
");

while ($row = mysqli_fetch_assoc($qEdu)) {
    $pendidikan = $row['pendidikan'];
    $jml = (int) $row['jml'];

    if (isset($eduCounts[$pendidikan])) {
        $eduCounts[$pendidikan] += $jml;
    }
}

/*
 |--------------------------------------------------------------
 | 4. DATA STATUS PERNIKAHAN & KELAHIRAN/KEMATIAN
 |--------------------------------------------------------------
*/

$belumMenikah = 0;
$menikah = 0;

$qNikah = mysqli_query($koneksi, "
    SELECT status_pernikahan, COUNT(*) AS jml
    FROM penduduk
    WHERE status_hidup = 'Hidup'
    GROUP BY status_pernikahan
");

while ($row = mysqli_fetch_assoc($qNikah)) {
    if ($row['status_pernikahan'] === 'Belum Menikah') {
        $belumMenikah = (int) $row['jml'];
    } elseif ($row['status_pernikahan'] === 'Menikah') {
        $menikah = (int) $row['jml'];
    }
}

// asumsinya: kolom tahun_lahir & tahun_meninggal berisi tahun (YYYY)
$tahunIni = date('Y');

// kelahiran tahun ini
$qKelahiran = mysqli_query($koneksi, "
    SELECT COUNT(*) AS jml
    FROM penduduk
    WHERE tahun_lahir = $tahunIni
");
$kelahiranTahunIni = (int) mysqli_fetch_assoc($qKelahiran)['jml'];

// kematian tahun ini
$qKematian = mysqli_query($koneksi, "
    SELECT COUNT(*) AS jml
    FROM penduduk
    WHERE status_hidup = 'Meninggal'
      AND tahun_meninggal = $tahunIni
");
$kematianTahunIni = (int) mysqli_fetch_assoc($qKematian)['jml'];

/*
 |--------------------------------------------------------------
 | 5. DATA KELOMPOK USIA (UNTUK DIAGRAM PIRAMIDA)
 |   Kelompok usia mengikuti rentang di desain UI/UX
 |--------------------------------------------------------------
*/

$ageGroups = [
    '0-4', '5-9', '10-14', '15-19', '20-24',
    '25-29', '30-34', '35-39', '40-44', '45-49',
    '50-54', '55-59', '60-64', '65-69', '70-74',
    '75-79', '80-84', '85+'
];

$maleCounts   = array_fill(0, count($ageGroups), 0);
$femaleCounts = array_fill(0, count($ageGroups), 0);

// mapping usia -> label kelompok
$sqlAge = "
    SELECT 
        CASE
            WHEN usia BETWEEN 0 AND 4 THEN '0-4'
            WHEN usia BETWEEN 5 AND 9 THEN '5-9'
            WHEN usia BETWEEN 10 AND 14 THEN '10-14'
            WHEN usia BETWEEN 15 AND 19 THEN '15-19'
            WHEN usia BETWEEN 20 AND 24 THEN '20-24'
            WHEN usia BETWEEN 25 AND 29 THEN '25-29'
            WHEN usia BETWEEN 30 AND 34 THEN '30-34'
            WHEN usia BETWEEN 35 AND 39 THEN '35-39'
            WHEN usia BETWEEN 40 AND 44 THEN '40-44'
            WHEN usia BETWEEN 45 AND 49 THEN '45-49'
            WHEN usia BETWEEN 50 AND 54 THEN '50-54'
            WHEN usia BETWEEN 55 AND 59 THEN '55-59'
            WHEN usia BETWEEN 60 AND 64 THEN '60-64'
            WHEN usia BETWEEN 65 AND 69 THEN '65-69'
            WHEN usia BETWEEN 70 AND 74 THEN '70-74'
            WHEN usia BETWEEN 75 AND 79 THEN '75-79'
            WHEN usia BETWEEN 80 AND 84 THEN '80-84'
            ELSE '85+'
        END AS kelompok,
        jenis_kelamin,
        COUNT(*) AS jml
    FROM penduduk
    WHERE status_hidup = 'Hidup'
    GROUP BY kelompok, jenis_kelamin
";
$qAge = mysqli_query($koneksi, $sqlAge);

while ($row = mysqli_fetch_assoc($qAge)) {
    $kelompok = $row['kelompok'];
    $idx = array_search($kelompok, $ageGroups);
    if ($idx === false) continue;

    if ($row['jenis_kelamin'] === 'L') {
        $maleCounts[$idx] = (int) $row['jml'];
    } elseif ($row['jenis_kelamin'] === 'P') {
        $femaleCounts[$idx] = (int) $row['jml'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php head('Data dan Statistik') ?>
    <!-- Chart.js untuk grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php navbar() ?>

    <main class="dataStatistikPage">
        <!-- HERO STATISTIK -->
        <section class="statHero">

            <div class="statHeroContent">
                <h1 class="statHeroTitle">
                    Sensus dan Statistik Penduduk <div></div>
                </h1>
                
                <div class="statSummaryCards">
                    <div class="statCard">
                        <div class="statIcon">
                            <img src="../assets/dataStatistik/ikonPerempuan.svg" alt="Ikon Perempuan">
                        </div>
                        <p class="statLabel">Perempuan</p>
                        <div class="statValue">
                            <div class="garisCard"></div>
                            <p><?php echo $totalPerempuan; ?> jiwa</p>
                        </div>
                    </div>

                    <div class="statCard">
                        <div class="statIcon">
                            <img src="../assets/dataStatistik/ikonPenduduk.svg" alt="Ikon Jumlah Penduduk">
                        </div>
                        <p class="statLabel">Jumlah Penduduk</p>
                        <div class="statValue">
                            <div class="garisCard"></div>
                            <p><?php echo $totalPenduduk; ?> jiwa</p>
                        </div>
                    </div>

                    <div class="statCard">
                        <div class="statIcon">
                            <img src="../assets/dataStatistik/ikonKeluarga.svg" alt="Ikon Kepala Keluarga">
                        </div>
                        <p class="statLabel">Kepala Keluarga</p>
                        <div class="statValue">
                            <div class="garisCard"></div>
                            <p><?php echo $kepalaKeluarga; ?> jiwa</p>
                        </div>
                    </div>

                    <div class="statCard">
                        <div class="statIcon">
                            <img src="../assets/dataStatistik/ikonLaki.svg" alt="Ikon Laki-laki">
                        </div>
                        <p class="statLabel">Laki – Laki</p>
                        <div class="statValue">
                            <div class="garisCard"></div>
                            <p><?php echo $totalLaki; ?> jiwa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BERDASARKAN KELOMPOK USIA -->
        <section class="statAgeSection">
            <div class="statAgeHeaderWrapper">
                <h2 class="statAgeTitle">Berdasarkan Kelompok Usia</h2>
            </div>

            <div class="statAgeChartWrapper">
                <!-- ganti gambar statis dengan canvas chart -->
                <canvas id="ageChart"></canvas>
            </div>
        </section>

        <!-- INSIGHT TEKS KELOMPOK USIA (teks tetap, boleh Anda edit nanti) -->
        <section class="statInsightSection">
            <div class="statInsightCard">
                Kelompok umur 10–14 tahun merupakan kelompok terbesar dengan jumlah 74 orang,
                yaitu sekitar 12.21% dari total populasi laki-laki Desa Panghuripan. Sebaliknya,
                kelompok umur 85+ tahun menjadi yang paling sedikit dengan jumlah hanya 4 orang,
                atau 0.66%.
            </div>

            <div class="statInsightCard">
                Pada penduduk perempuan, kelompok umur 20–24 tahun dan 10–14 tahun
                merupakan kelompok dengan jumlah tertinggi, yaitu masing-masing 56 orang atau
                sekitar 10.24% dari total populasi perempuan. Sementara itu, kelompok umur 80–84 tahun
                menjadi yang terendah, dengan jumlah 3 orang atau sekitar 0.55%.
            </div>
        </section>

        <!-- BERDASARKAN PEKERJAAN -->
        <section class="statJobSection">
            <div class="statJobHeader">
                <div class="statJobTitle">
                    <h2>Berdasarkan Pekerjaan</h2>
                </div>
            </div>

            <div class="statJobLayout">
                <div class="statJobChart">
                    <!-- canvas untuk pie chart pekerjaan -->
                    <canvas id="jobChart"></canvas>
                </div>

                <div class="statJobLegend">
                    <h3>Keterangan :</h3>
                    <ul>
                        <li>Petani : <?php echo $profesiCounts['Petani']; ?> jiwa</li>
                        <li>Pedagang : <?php echo $profesiCounts['Pedagang']; ?> jiwa</li>
                        <li>Pegawai Swasta : <?php echo $profesiCounts['Pegawai Swasta']; ?> jiwa</li>
                        <li>Pelajar : <?php echo $profesiCounts['Pelajar']; ?> jiwa</li>
                        <li>Lainnya : <?php echo $profesiCounts['Lainnya']; ?> jiwa</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- BERDASARKAN PENDIDIKAN -->
        <section class="statEduSection">
            <div class="statEduHeader">
                <div class="statEduTitle"><h2>Berdasarkan Pendidikan</h2></div>
            </div>
            <div class="statEduChartWrapper">
                <!-- canvas untuk bar chart pendidikan -->
                <canvas id="eduChart"></canvas>
            </div>
        </section>

        <!-- DATA STATISTIK (Belum Menikah, Kelahiran, Menikah, Kematian) -->
        <section class="statExtraSection">
            <div class="statExtraWrapper">
                <div class="statExtraHeader">
                    <h2>Data Statistik</h2>
                </div>

                <div class="statExtraGrid">
                    <div class="statExtraCard">
                        <div class="statExtraIcon">
                            <img src="../assets/dataStatistik/ikonBelumMenikah.svg" alt="Belum Menikah">
                        </div>
                        <div class="statExtraText">
                            <p class="statExtraLabel">Belum Menikah</p>
                            <p class="statExtraValue"><?php echo $belumMenikah; ?> jiwa</p>
                        </div>
                    </div>

                    <div class="statExtraCard">
                        <div class="statExtraIcon">
                            <img src="../assets/dataStatistik/ikonKelahiran.svg" alt="Kelahiran">
                        </div>
                        <div class="statExtraText">
                            <p class="statExtraLabel">Kelahiran</p>
                            <p class="statExtraValue"><?php echo $kelahiranTahunIni; ?> jiwa</p>
                        </div>
                    </div>

                    <div class="statExtraCard">
                        <div class="statExtraIcon">
                            <img src="../assets/dataStatistik/ikonMenikah.svg" alt="Menikah">
                        </div>
                        <div class="statExtraText">
                            <p class="statExtraLabel">Menikah</p>
                            <p class="statExtraValue"><?php echo $menikah; ?> jiwa</p>
                        </div>
                    </div>

                    <div class="statExtraCard">
                        <div class="statExtraIcon">
                            <img src="../assets/dataStatistik/ikonKematian.svg" alt="Kematian">
                        </div>
                        <div class="statExtraText">
                            <p class="statExtraLabel">Kematian</p>
                            <p class="statExtraValue"><?php echo $kematianTahunIni; ?> jiwa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php footer() ?>
    </main>

    <!-- SCRIPT GRAFIK -->
<script>
    // ====== DATA DARI PHP ======
    const ageLabels   = <?php echo json_encode($ageGroups); ?>;
    const ageMaleRaw  = <?php echo json_encode($maleCounts); ?>;
    const ageFemale   = <?php echo json_encode($femaleCounts); ?>;

    const jobLabels   = <?php echo json_encode(array_keys($profesiCounts)); ?>;
    const jobData     = <?php echo json_encode(array_values($profesiCounts)); ?>;

    const eduLabels   = <?php echo json_encode(array_values($eduLabels)); ?>;
    const eduData     = <?php echo json_encode(array_values($eduCounts)); ?>;

    // ====== GRAFIK PIRAMIDA USIA ======
    const ageCtx = document.getElementById('ageChart').getContext('2d');
    new Chart(ageCtx, {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [
                {
                    label: 'Laki-Laki',
                    data: ageMaleRaw.map(v => -v),
                },
                {
                    label: 'Perempuan',
                    data: ageFemale,
                }
            ]
        },
        options: {
            maintainAspectRatio: false,   // <<< tambahkan ini
            indexAxis: 'y',
            scales: {
                x: {
                    ticks: {
                        callback: function(value) {
                            return Math.abs(value);
                        }
                    }
                }
            }
        }
    });

    // ====== GRAFIK PEKERJAAN (PIE) ======
    const jobCtx = document.getElementById('jobChart').getContext('2d');
    new Chart(jobCtx, {
        type: 'pie',
        data: {
            labels: jobLabels,
            datasets: [{
                data: jobData,
            }]
        },
        options: {
            maintainAspectRatio: false   // <<< tambahkan ini
        }
    });

    // ====== GRAFIK PENDIDIKAN (BAR) ======
    const eduCtx = document.getElementById('eduChart').getContext('2d');
    new Chart(eduCtx, {
        type: 'bar',
        data: {
            labels: eduLabels,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: eduData,
                borderWidth: 1,
            }]
        },
        options: {
            maintainAspectRatio: false,   // <<< tambahkan ini
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>

</body>

</html>
