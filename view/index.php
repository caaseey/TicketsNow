<?php
if (
    (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') &&
    strpos($_SERVER['HTTP_HOST'], 'localhost') === false
) {
    $httpsUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $httpsUrl);
    exit();
}

if (session_status() !== PHP_SESSION_ACTIVE) session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/index.css">
    <title>TicketsNow</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div>
            <a href="#" class="logo">
                <img src="../view/media/img/interfaces/logo.png" alt="Tickets Now">
            </a>
        </div>
        <form class="search-container" action="../view/src/php/search.php" method="get">
            <input type="text" name="q" class="search-bar" placeholder="Buscar conciertos...">
            <button type="submit" class="search-button">
                <img src="../view/media/img/interfaces/lupa.png" alt="Buscar">
            </button>
        </form>

        <div class="account-menu">
            <button class="account-button">
                <div class="account-icon">
                    <hr>
                    <hr>
                    <hr>
                </div>
                <div class="account-picture">
                    <img src="../view/media/img/interfaces/user_icon.png" alt="Usuario">
                </div>
            </button>
            <div class="account-dropdown-menu">
                <ul>
                    <?php
                    if (isset($_SESSION['logged_in'])) {
                        echo '<li><a href="../view/src/php/profile.php">Mi perfil</a></li>';

                        if (isset($_SESSION['id_role']) && $_SESSION['id_role'] == 3) {
                            echo '<li><a href="../view/src/php/dashboard.php">Dashboard</a></li>';
                        }

                        echo "<li><a href='#' onclick=\"document.getElementById('logoutForm').submit(); return false;\">Cerrar sesión</a></li>";
                    } else {
                        echo "<li><a href='../view/src/php/login.php'>Iniciar sesión</a></li>";
                        echo "<li><a href='../view/src/php/register_user.php'>Regístrate</a></li>";
                    }
                    ?>
                    <?php if (isset($_SESSION['logged_in'])): ?>
                        <form id="logoutForm" action="../view/src/php/logout.php" method="post" style="display: none;"></form>
                    <?php endif; ?>
                    <hr>
                    <li><a href="../view/src/html/work_in_progress.html">Ayuda</a></li>
                    <li><a href="../view/src/php/about.php">Sobre nosotros</a></li>
                    <li><a href="#footer">Contacto</a></li>
                </ul>
            </div>

    </nav>

    <!-- CARROUSEL -->
    <header class="carousel-container">
        <div class="carousel-track">
            <div class="main-concert-banner" style="background-image: url('img/Banners/brunoMars.jpg');">
                <video autoplay muted loop playsinline>
                    <source src="../view/media/video/bruno_mars.mp4" type="video/mp4">
                </video>
                <div class="carousel-text">
                    <h1>Bruno Mars - World Tour</h1>
                    <a href="../view/src/php/artist.php?name=Bruno Mars"><button>ENTRADAS</button></a>
                </div>
            </div>

            <div class="main-concert-banner" style="background-image: url('img/Banners/twice.jpg');">
                <video autoplay muted loop playsinline>
                    <source src="../view/media/video/twice.mp4" type="video/mp4">
                </video>
                <div class="carousel-text">
                    <h1>TWICE - Ready To Be</h1>
                    <a href="../view/src/php/artist.php?name=TWICE"><button>ENTRADAS</button></a>
                </div>
            </div>

            <div class="main-concert-banner" style="background-image: url('img/Banners/theweeknd.jpg');">
                <video autoplay muted loop playsinline>
                    <source src="../view/media/video/the_weeknd.mp4" type="video/mp4">
                </video>
                <div class="carousel-text">
                    <h1>The Weeknd - After Hours Til Dawn Tour</h1>
                    <a href="../view/src/php/artist.php?name=The Weeknd"><button>ENTRADAS</button></a>
                </div>
            </div>
        </div>
        <button class="carousel-button prev">
            <img src="../view/media/img/interfaces/previous_button.png" alt="Anterior">
        </button>
        <button class="carousel-button next">
            <img src="../view/media/img/interfaces/next_button.png" alt="Siguiente">
        </button>
    </header>

    <!-- FLOATING SECTION BAR -->
    <nav id="floating-search" class="floating-search-container">
        <a href="#featured-concerts">Destacado</a>
        <span class="divider">|</span>
        <a href="#recommended-concerts">Recomendados</a>
        <span class="divider">|</span>
        <a href="#discover-concerts">Descubre</a>
    </nav>

    <!-- SECTION FEATURED CONCERTS -->
    <div class="featured-concerts-titles">
        <div class="main-section-title">
            <h2>Conciertos destacados</h2>
            <hr>
        </div>
    </div>

    <section id="featured-concerts" class="featured-concerts">
        <a href="../view/src/php/artist.php?name=SZA" class="concert-banner most-featured-concert">
            <img src="../view/media/img/concert_banners/sza.jpg" alt="SZA">
            <div class="concert-info">
                <p>Madrid, España | 20 de junio de 2025</p>
                <h3>SZA</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=aespa" class="concert-banner">
            <img src="../view/media/img/concert_banners/aespa.jpg" alt="aespa">
            <div class="concert-info">
                <p>Barcelona, España | 21 de noviembre de 2025</p>
                <h3>aespa</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Imagine%20Dragons" class="concert-banner">
            <img src="../view/media/img/concert_banners/imagine_dragons.jpg" alt="Imagine Dragons">
            <div class="concert-info">
                <p>Cantabria, España | 18 de mayo de 2025</p>
                <h3>Imagine Dragons</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Ado" class="concert-banner">
            <img src="../view/media/img/concert_banners/ado.jpg" alt="Ado">
            <div class="concert-info">
                <p>Bilbao, España | 22 de abril de 2026</p>
                <h3>Ado</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=KSI" class="concert-banner">
            <img src="../view/media/img/concert_banners/ksi.jpg" alt="KSI">
            <div class="concert-info">
                <p>Sevilla, España | 10 de mayo de 2026</p>
                <h3>KSI</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Eladio%20Carri%C3%B3n" class="concert-banner">
            <img src="../view/media/img/concert_banners/eladio_carrion.jpg" alt="Eladio Carrión">
            <div class="concert-info">
                <p>Madrid, España | 20 de agosto de 2025</p>
                <h3>Eladio Carrión</h3>
            </div>
        </a>
    </section>

    <!-- SECTION RECOMMENDED CONCERTS -->
    <div class="main-section-title">
        <h2>Conciertos recomendados</h2>
        <hr>
    </div>
    <section class="recommended-concerts">
        <a href="../view/src/php/artist.php?name=Marca%20Registrada" class="concert-banner">
            <img src="../view/media/img/concert_banners/marca_registrada.jpg" alt="Marca Registrada">
            <div class="concert-info">
                <p>Navarra, España | 7 de junio de 2025</p>
                <h3>Marca Registrada - America Tour</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=AURORA" class="concert-banner">
            <img src="../view/media/img/concert_banners/aurora.jpg" alt="aurora">
            <div class="concert-info">
                <p>Oviedo, España | 30 de marzo de 2026</p>
                <h3>AURORA - Celestial Path Tour</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Omar%20Courtz" class="concert-banner">
            <img src="../view/media/img/concert_banners/omar_courtz.jpg" alt="Omar Courtz">
            <div class="concert-info">
                <p>Lugo, España | 22 de abril de 2026</p>
                <h3>Omar Courtz - Asia Tour</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=ACDC" class="concert-banner">
            <img src="../view/media/img/concert_banners/acdc.jpg" alt="acdc">
            <div class="concert-info">
                <p>Madrid, España | 22 de abril de 2026</p>
                <h3>ACDC - Europe Tour</h3>
            </div>
        </a>
    </section>

    <!-- SECTION DISCOVER CONCERTS -->
    <div class="main-section-title">
        <h2>Descubre</h2>
        <hr>
    </div>
    <section id="discover-concerts" class="discover-concerts">
        <a href="../view/src/php/artist.php?name=Kendrick%20Lamar" class="concert-banner">
            <img src="../view/media/img/concert_banners/kendrick_lamar.jpg" alt="Kendrick Lamar">
            <div class="concert-info">
                <p>Ibiza, España | 3 de julio de 2025</p>
                <h3>Kendrick Lamar</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=YOASOBI" class="concert-banner">
            <img src="../view/media/img/concert_banners/yoasobi.jpg" alt="YOASOBI">
            <div class="concert-info">
                <p>Valencia, España | 15 de agosto de 2025</p>
                <h3>YOASOBI</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Swingrowers" class="concert-banner">
            <img src="../view/media/img/concert_banners/swingrowers.jpg" alt="Swingrowers">
            <div class="concert-info">
                <p>Andalucía, España | 1 de enero de 2026</p>
                <h3>Swingrowers</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Keshi" class="concert-banner">
            <img src="../view/media/img/concert_banners/keshi.jpg" alt="Keshi">
            <div class="concert-info">
                <p>Murcia, España | 18 de septiembre de 2025</p>
                <h3>Keshi</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Laufey" class="concert-banner">
            <img src="../view/media/img/concert_banners/laufey.jpg" alt="Laufey">
            <div class="concert-info">
                <p>La Rioja, España | 12 de octubre de 2025</p>
                <h3>Laufey</h3>
            </div>
        </a>
        <a href="../view/src/php/artist.php?name=Cuarteto%20de%20Nos" class="concert-banner">
            <img src="../view/media/img/concert_banners/cuarteto_de_nos.jpg" alt="Cuarteto de Nos">
            <div class="concert-info">
                <p>Barcelona, España | 24 de noviembre de 2025</p>
                <h3>Cuarteto de Nos</h3>
            </div>
        </a>
    </section>

    <!-- FOOTER -->
    <footer id="footer">
        <h2>Vivencias en Primera Fila</h2>
        <div class="reviews-cards">
            <div class="review-card">
                <p>活力与激情的爆发，乐队的演奏让场地的每个角落都震动起来；与观众的联系无与伦比</p>
                <div class="review-user">
                    <img src="../view/media/img/interfaces/users/user1.png" alt="user1">
                    <div>
                        <h4>Zeng</h4>
                        <p>Aespa - Beijing, China</p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <p>A spectacular sound journey, with an impressive lighting set and an atmosphere that never stopped moving. Incredible!</p>
                <div class="review-user">
                    <img src="../view/media/img/interfaces/users/user2.png" alt="user2">
                    <div>
                        <h4>Charles</h4>
                        <p>Ado - Londres, Reino Unido</p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <p id="review-text">KENDRICK LAMAR THE BEST ARTIST THIS DAMN CENTURY</p>
                <div class="review-user">
                    <img src="../view/media/img/interfaces/users/user3.png" alt="user3">
                    <div>
                        <h4>Tyrell</h4>
                        <p>Kendrick Lamar - Londres, Reino Unido</p>
                    </div>
                </div>
            </div>


        </div>

        <div class="footer-links">
            <div class="footer-column">
                <h3>Escríbenos</h3>
                <a href="mailto:ticketsnow_official@gmail.com">ticketsnow_official@gmail.com</a>
            </div>
            <div class="footer-column">
                <h3>Sobre nosotros</h3>
                <a href="../view/src/php/about.php">Haz click aquí</a>
            </div>
            <div class="footer-column">
                <h3>Llámanos</h3>
                <a href="tel:+34666666666">+34 666 66 66 66</a>
            </div>
            <div class="footer-column">
                <h3>¿Buscas ayuda?</h3>
                <a href="../view/src/html/work_in_progress.html">Página de ayuda</a><br>
            </div>
        </div>

        <div class="footer-bottom">
            © 2024-2025 TicketsNow. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Floating search bar script -->
    <script>
        // Detect floating search bar position
        const floatingSearch = document.getElementById('floating-search');

        // How many pixels to scroll before the floating search bar appears
        const triggerOffset = 50;

        window.addEventListener('scroll', () => {
            if (window.scrollY > triggerOffset) {
                // Show the floating search bar if the user has scrolled down more than the trigger offset
                floatingSearch.classList.add('visible');
            } else {
                // Hide the floating search bar if the user scrolls back up    
                floatingSearch.classList.remove('visible');
            }
        });
    </script>

    <!-- Carousel script -->
    <script>
        const track = document.querySelector('.carousel-track');
        const banners = document.querySelectorAll('.main-concert-banner');
        const nextBtn = document.querySelector('.carousel-button.next');
        const prevBtn = document.querySelector('.carousel-button.prev');
        let index = 0;
        let userActive = false;
        let timeout;

        function updateSlide() {
            const banner = banners[index];
            track.scrollTo({
                left: banner.offsetLeft,
                behavior: 'smooth'
            });

            banners.forEach((banner, i) => {
                const video = banner.querySelector('video');
                banner.classList.toggle('active', i === index);
                if (video) {
                    if (i === index) {
                        video.currentTime = 0;
                        video.play();
                    } else {
                        video.pause();
                    }
                }
            });
        }

        function nextSlide() {
            index = (index + 1) % banners.length;
            updateSlide();
        }

        function prevSlide() {
            index = (index - 1 + banners.length) % banners.length;
            updateSlide();
        }

        function setUserActive() {
            userActive = true;
            clearTimeout(timeout);
            timeout = setTimeout(() => userActive = false, 10000);
        }

        nextBtn.addEventListener('click', () => {
            nextSlide();
            setUserActive();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            setUserActive();
        });

        setInterval(() => {
            if (!userActive) nextSlide();
        }, 10000);

        window.addEventListener('load', updateSlide);

        window.addEventListener('resize', () => {
            updateSlide();
        });
    </script>
</body>

</html>