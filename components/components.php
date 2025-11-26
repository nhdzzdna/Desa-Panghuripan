<?php
function head($title){ ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- CSS Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- CSS Custom -->
    <link rel="stylesheet" href="../style/components.css">
    <link rel="stylesheet" href="../style/loginAdmin.css">
    <link rel="stylesheet" href="../style/landingPage.css">
    <link rel="stylesheet" href="../style/dataStatistik.css">
    <link rel="stylesheet" href="../style/beritaPengumuman.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&family=Marcellus+SC&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <?php } ?>

<?php
function footer(){ ?>
    <div class="footer">
        <div class="isiFooter">
            <div class="isiFooter1">
                <a href="../pages/landingPage.php" class="logoFooter">
                    <img src="../assets/componentImages/logoFooter.svg" alt="Ikon Desa">
                    <div>
                        <h3>Desa Panghuripan</h3>
                        <p>Kabupaten Sleman</p>
                    </div>
                </a>
                <div class="sloganFooter">“Nguripi, Nglestari, Ngluhuraké”</div>
                <div class="alamatFooter">Jl. Dalgino, Area Sawah, Banyuraden, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55293</div>
            </div>
            <div class="isiFooter2">
                <h3>Menu</h3>
                <a href="../pages/landingPage.php">Beranda</a>
                <a href="../pages/dataStatistik.php">Data dan Statistik</a>
                <a href="../pages/beritaPengumuman.php">Berita</a>
                <a href="../pages/layananWarga.php">Layanan Warga</a> 
            </div>
            <div class="isiFooter3">
                <h3>Kontak Darurat</h3>

                <div class="kontakItem">
                    
                    <a href="https://wa.me/6281912345678">
                        <p class="noTelp"><img src="../assets/componentImages/wa.svg" alt="WA">+62819-1234-5678</p>
                        <p class="deskripsi">Kepala Desa (Hanbin)</p>
                    </a>
                </div>
                <div class="kontakItem">
                    <a href="https://wa.me/6282287654321">
                        <p class="noTelp"><img src="../assets/componentImages/wa.svg" alt="WA"> +62822-8765-4321</p>
                        <p class="deskripsi">Ambulance Desa (Xinlong)</p>
                    </a>
                </div>
            </div>
            <div class="isiFooter4">
                <div class="medsos">
                    <h3>Media Sosial</h3>
                    <div class="ikonMedsos">
                        <a href="#"><img src="../assets/componentImages/ig.svg" alt="Instagram"></a>
                        <a href="#"><img src="../assets/componentImages/email.svg" alt="Email"></a>
                        <a href="#"><img src="../assets/componentImages/fb.svg" alt="Facebook"></a>
                    </div>
                </div>
                <div class="loginAdmin">
                    <a href="../pages/loginAdmin.php" class="btnLogin">Log In</a>
                </div>
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
            <img src="../assets/componentImages/logo.svg" alt="Ikon Desa">
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