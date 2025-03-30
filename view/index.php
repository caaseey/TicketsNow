<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>TicketsNow</title>
</head>
<body>
    <nav class="navbar">
        <div>
            <a href="#" class="logo">
                <img src="img/Interfaces/logo.png" alt="Tickets Now">
            </a>
        </div>
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Buscar...">
            <button class="search-button">
                <img src="img/Interfaces/lupa.png" alt="Buscar">
            </button>
        </div>
        <div class="account-menu">
            <button class="account-button">
                <div class="account-icon">
                    <hr>
                    <hr>
                    <hr>
                </div>
                <div class="account-picture">
                    <img src="img/Interfaces/user_icon.png" alt="Usuario">
                </div>
            </button>
            <div class="account-dropdown-menu">
                <?php
                ?>
                <ul>
                    <?php
                        if (isset($_SESSION['logged_in'])) {
                            echo "<li><a href='profile.php'>Mi perfil</a></li>";
                        } else {
                            echo "<li><a href='login.php'>Iniciar sesión</a></li>";
                            echo "<li><a href='register.php'>Regístrate</a></li>";
                        }
                    ?>
                    <hr>
                    <li><a href="help.php">Ayuda</a></li>
                    <li><a href="about.php">Sobre nosotros</a></li>
                    <li><a href="#footer">Contacto</a></li>
                </ul>
            </div>
        </div>        
    </nav>

    <div class="carousel-container">
        <div class="carousel-track">
        <div class="main-concert-banner active" style="background-image: url('img/Banners/twice.jpg');">
            <video autoplay muted loop playsinline></video>
            <div class="carousel-text">
                <h1>TWICE - Ready To Be</h1>
                <a href=""><button>ENTRADAS</button></a>
            </div>
            </div>
            <div class="main-concert-banner" style="background-image: url('img/Banners/brunoMars.jpg');">
            <video autoplay muted loop playsinline></video>
            <div class="carousel-text">
                <h1>Bruno Mars - World Tour</h1>
                <a href=""><button>ENTRADAS</button></a>
            </div>
            </div>
            <div class="main-concert-banner" style="background-image: url('img/Banners/twice.jpg');">
            <video autoplay muted loop playsinline></video>
            <div class="carousel-text">
                <h1>TWICE - Ready To Be</h1>
                <a href=""><button>ENTRADAS</button></a>
            </div>
            </div>
        </div>
        <button class="carousel-button prev">
            <img src="img/Interfaces/previous_button.png" alt="Anterior">
        </button>
        <button class="carousel-button next">
            <img src="img/Interfaces/next_button.png" alt="Siguiente">
        </button>
    </div>

    
    <div id="floating-search" class="floating-search-container">
        <a href="#featured-concerts">Destacado</a>
        <span class="divider">|</span>
        <a href="#recommended-concerts">Recomendados</a>
        <span class="divider">|</span>
        <a href="#discover-concerts">Descubre</a>
    </div>
    

    <div class="featured-concerts-titles">
        <div class="section-title">
            <h2>Conciertos destacados</h2>
            <hr>
        </div>
        <div class="section-title">
            <h2>Otros conciertos</h2>
            <hr>
        </div>
    </div>
    <section id="featured-concerts" class="featured-concerts">
        <a href="#" class="concert-banner most-featured-concert">
            <img src="img/Banners/twice.jpg" alt="TWICE">
            <div class="concert-info">
                <p>Madrid, España | 15 de marzo de 2025</p>
                <h3>TWICE - World Tour Ready To Be</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/aespa.png" alt="aespa">
            <div class="concert-info">
                <p>España | 15 de marzo de 2025</p>
                <h3>aespa</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/imagineDragons.jpg" alt="Imagine Dragons">
            <div class="concert-info">
                <p>EE.UU. | 3 de julio de 2025</p>
                <h3>Imagine Dragons</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/ado.png" alt="Ado">
            <div class="concert-info">
                <p>Japón | 22 de abril de 2025</p>
                <h3>Ado</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/ksi.jpg" alt="KSI">
            <div class="concert-info">
                <p>Reino Unido | 10 de mayo de 2025</p>
                <h3>KSI</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/eladioCarrion.jpg" alt="Eladio Carrión">
            <div class="concert-info">
                <p>México | 20 de agosto de 2025</p>
                <h3>Eladio Carrión</h3>
            </div>
        </a>
    </section>  
    
    <div class="section-title">
        <h2>Conciertos recomendados</h2>
        <hr>
    </div>
    <section id="recommended-concerts" class="recommended-concerts">
        <a href="#" class="concert-banner">
            <img src="img/Banners/marcaRegistrada.jpg" alt="Marca Registrada">
            <div class="concert-info">
                <p>Madrid, España | 15 de marzo de 2025</p>
                <h3>Marca Registrada - America Tour</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/aurora.jpg" alt="aurora">
            <div class="concert-info">
                <p>Nueva York, EE.UU. | 8 de junio de 2025</p>
                <h3>aurora - LIVE TOUR</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/omarCourtz.png" alt="Omar Courtz">
            <div class="concert-info">
                <p>Tokyo, Japón | 22 de abril de 2025</p>
                <h3>Omar Courtz - Asia Tour 2025</h3>
            </div>
        </a>
        <div class="concert-banner empty-concert">
            <h4>Nada más por recomendar...</h4>
        </div>
    </section>

    <div class="section-title">
        <h2>Descubre</h2>
        <hr>
    </div>
    <section id="discover-concerts" class="discover-concerts">
        <a href="#" class="concert-banner">
            <img src="img/Banners/kendrickLamar.jpg" alt="Kendrick Lamar">
            <div class="concert-info">
                <p>EE.UU. | 3 de julio de 2025</p>
                <h3>Kendrick Lamar</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/yoasobi.jpg" alt="YOASOBI">
            <div class="concert-info">
                <p>Osaka, Japón | 15 de agosto de 2025</p>
                <h3>YOASOBI</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/swingrowers.jpg" alt="Swingrowers">
            <div class="concert-info">
                <p>París, Francia | 30 de junio de 2025</p>
                <h3>Swingrowers</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/keshi.jpg" alt="Keshi">
            <div class="concert-info">
                <p>Seúl, Corea del Sur | 18 de septiembre de 2025</p>
                <h3>Keshi</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/laufey.png" alt="Laufey">
            <div class="concert-info">
                <p>Londres, Reino Unido | 12 de octubre de 2025</p>
                <h3>Laufey</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/Banners/waveToEarth.jpg" alt="Wave to Earth">
            <div class="concert-info">
                <p>Bangkok, Tailandia | 5 de noviembre de 2025</p>
                <h3>Wave to Earth</h3>
            </div>
        </a>
    </section>
    
    <footer id="footer">
        <h2>Vivencias en Primera Fila</h2>
        <div class="reviews-cards">
            <div class="review-card">
                <p>“Una explosión de energía y pasión, con una banda que hizo vibrar cada rincón del lugar; la conexión
                    con el público fue inigualable.”</p>
                <div class="review-user">
                    <img src="img/Interfaces/users/user1.png" alt="User foto">
                    <div>
                        <h4>Zeng</h4>
                        <p>Aespa</p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <p>“Un viaje sonoro espectacular, con un set de luces impresionante y un ambiente que nunca dejó de
                    moverse. ¡Increíble!”</p>
                <div class="review-user">
                    <img src="img/Interfaces/users/user2.png" alt="User foto">
                    <div>
                        <h4>Nishimura</h4>
                        <p>Ado</p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <p>“Un recital lleno de improvisación y talento, donde los músicos crearon una atmósfera mágica que
                    mantuvo a todos en suspenso.”</p>
                <div class="review-user">
                    <img src="img/Interfaces/users/user3.png" alt="User foto">
                    <div>
                        <h4>Hyo-Rin</h4>
                        <p>Twice</p>
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
                <a href="about.php">Clica aquí</a>
            </div>
            <div class="footer-column">
                <h3>Llámanos</h3>
                <a href="tel:+34666666666">+34 666 66 66 66</a>
            </div>
            <div class="footer-column">
                <h3>¿Buscas ayuda?</h3>
                <a href="paginadeayuda.php">Página de ayuda</a><br>
            </div>
        </div>

        <div class="footer-bottom">
            © 1999-2024 TicketsNow. Todos los derechos reservados.
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

    <!-- Recommended concerts invert colors effect script -->
    <script>
    // Section to detect
    const section = document.querySelector('#recommended-concerts');

    const observer = new IntersectionObserver(
        entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.intersectionRatio >= 0.2) {
                // When the section is visible more than 20%, activate the invert effect
                section.classList.add('active');
            } else {
                // If not, remove the invert effect
                section.classList.remove('active');
            }
        });
        },
        // Detect when the section is 0% visible or 20% visible
        {
        threshold: [0, 0.2]
        }
    );

    observer.observe(section);
    </script>

    <!-- Carousel script -->
    <script>
    // Container of the banners
    const track = document.querySelector('.carousel-track');
    // The array of banners
    const banners = Array.from(track.children);

    // Hears the buttons
    const nextButton = document.querySelector('.carousel-button.next');
    const prevButton = document.querySelector('.carousel-button.prev');

    // Index of the banner
    let currentSlide = 0;

    // To detect if the user made a click
    let userIsActive = false;

    // To know the inactivity of the user
    let resetTimer;


    function showSlide() {
    // Move the track to the next slide
    track.style.transform = `translateX(calc(-${currentSlide * 80}vw - ${currentSlide * 2}rem))`;
    // Makes the current slide active
    banners.forEach((banner, i) => {
        banner.classList.toggle('active', i === currentSlide);
    });
    }

    function setUserActive() {
    // When user clicks, make the user active
    userIsActive = true;
    // After 10 seconds of inactivity, make the user inactive
    clearTimeout(resetTimer);
    resetTimer = setTimeout(() => {
        userIsActive = false;
    }, 10000);
    }

    // When the next button is clicked, move to the next slide
    // If the slide is the last one, go back to the first slide
    nextButton.addEventListener('click', () => {
    currentSlide = (currentSlide + 1) % banners.length;
    showSlide();
    setUserActive();
    });

    // When the previous button is clicked, move to the previous slide
    // If the slide is the first one, go back to the last slide
    prevButton.addEventListener('click', () => {
    currentSlide = (currentSlide - 1 + banners.length) % banners.length;
    showSlide();
    setUserActive();
    });

    // When user is inactive, move automatically to the next slide every 10 seconds
    setInterval(() => {
    if (!userIsActive) {
        currentSlide = (currentSlide + 1) % banners.length;
        showSlide();
    }
    }, 10000);
    </script>
</body>
</html>
