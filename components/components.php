<?php
function head($title){ ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- CSS Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- CSS Custom -->
    <link rel="stylesheet" href="../style/components.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&family=Marcellus+SC&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<?php } ?>

<?php
function footer(){ ?>
    <div class="footer">
        <div class="isiFooter">
            <div class="isiFooter1">
                <a href="../pages/landingPage.php" class="logoFooter">
                    <img src="../assets/components image/logoFooter.svg" alt="Ikon Desa">
                    <div>
                        <h3>Desa Panghuripan</h3>
                        <p>Kabupaten Sleman</p>
                    </div>
                </a>
                <div class="sloganFooter"><p>“Nguripi, Nglestari, Ngluhuraké”</p></div>
                <div class="alamatFooter">Jl. Dalgino, Area Sawah, Banyuraden, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55293</div>
            </div>
            <div class="isiFooter2"></div>
            <div class="isiFooter3"></div>
            <div class="isiFooter4">
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="copyright">
            <hr>
            <p>© 2025 Desa Panghuripan. All Right Reserved</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<?php
}
?>


<?php
function navbar(){ ?>
    <nav>
        <a href="../pages/landingPage.php" class="logo">
            <img src="../assets/components image/logo.svg" alt="Ikon Desa">
            <div>
                <h3>Desa Panghuripan</h3>
                <p>Kabupaten Sleman</p>
            </div>
        </a>
        <div class="menuNav">
            <div>
                <div class="menu">
                    <a href="../pages/landingPage.php">Beranda</a>
                    <a href="../pages/dataStatistik.php">Data dan Statistik</a>
                    <a href="../pages/beritaPengumuman.php">Berita</a>               
                </div>
                <div class="pilihMenu"></div>
            </div>
            <div class="layananWarga" >
                <a href="../pages/layananWarga.php">Layanan Warga</a> 
            </div>
            
        </div>
    </nav>
<?php } ?>