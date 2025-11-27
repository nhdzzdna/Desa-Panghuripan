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
    <link rel="stylesheet" href="../style/layananWarga.css">
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
                <a href="../pages/index.php" class="logoFooter">
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
                <a href="../pages/index.php">Beranda</a>
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
        <a href="../pages/index.php" class="logo">
            <img src="../assets/componentImages/logo.svg" alt="Ikon Desa">
            <div>
                <h3>Desa Panghuripan</h3>
                <p>Kabupaten Sleman</p>
            </div>
        </a>

        <!-- TOMBOL HAMBURGER UNTUK MOBILE -->
        <button class="navToggle" id="navToggle" type="button" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>

        <div class="menuNav">
            <div class="menuWrapper">
                <div class="menu">
                    <a href="../pages/index.php">Beranda</a>
                    <a href="../pages/dataStatistik.php">Data dan Statistik</a>
                    <a href="../pages/beritaPengumuman.php">Berita</a>
                </div>
                <div class="pilihMenu"></div>
            </div>

            <div class="layananWarga">
                <a href="../pages/layananWarga.php" id="layananLink">Layanan Warga</a>
            </div>
        </div>
    </nav>

    <script>
    (function () {
        const menuLinks    = document.querySelectorAll("nav .menu a");
        const indicator    = document.querySelector("nav .pilihMenu");
        const wrapper      = document.querySelector("nav .menu");
        const layananLink  = document.getElementById("layananLink");
        const layananBox   = layananLink ? layananLink.parentElement : null;

        if (!menuLinks.length || !indicator || !wrapper) return;

        function moveIndicator(active, animate = true) {
            const rect       = active.getBoundingClientRect();
            const parentRect = wrapper.getBoundingClientRect();

            if (!animate) {
                indicator.style.transition = "none";
            }

            indicator.style.width = rect.width + "px";
            const left = (rect.left - parentRect.left);
            indicator.style.transform = "translateX(" + left + "px)";

            menuLinks.forEach(link => {
                link.style.color = "#FFFFFF";
            });
            active.style.color = "#EFB34A";

            if (!animate) {
                void indicator.offsetWidth;
                indicator.style.transition = "transform .3s ease, width .3s ease";
            }

            indicator.style.display = "block";

            if (layananBox && layananLink) {
                layananBox.style.background   = "transparent";
                layananBox.style.borderColor  = "#EFB34A";
                layananLink.style.color       = "#FFFFFF";
            }
        }

        menuLinks.forEach(link => {
            link.addEventListener("click", () => moveIndicator(link, true));
        });

        const current = window.location.pathname.split("/").pop();
        let active = menuLinks[0];
        let isLayanan = false;

        if (current.includes("layananWarga")) {
            isLayanan = true;
        }

        if (!isLayanan) {
            menuLinks.forEach(link => {
                const href = link.getAttribute("href");
                if (href && href.indexOf(current) !== -1) {
                    active = link;
                }
            });

            moveIndicator(active, false);
        } else {
            indicator.style.display = "none";

            menuLinks.forEach(link => {
                link.style.color = "#FFFFFF";
            });

            if (layananBox && layananLink) {
                layananBox.style.background   = "#EFB34A";
                layananBox.style.borderColor  = "#EFB34A";
                layananLink.style.color       = "#FFFFFF";
            }
        }

    })();

    // TOGGLE NAVBAR PADA LAYAR KECIL
    (function () {
        const toggleBtn = document.getElementById('navToggle');
        const menuNav   = document.querySelector('nav .menuNav');
        if (!toggleBtn || !menuNav) return;

        toggleBtn.addEventListener('click', function () {
            menuNav.classList.toggle('is-open');
        });
    })();
    </script>
<?php } ?>
