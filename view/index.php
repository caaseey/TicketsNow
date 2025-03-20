<!DOCTYPE html>
<!-- Hola-->
 <!-- Hola2-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>TicketsNow</title>
</head>
<body>
    <nav class="navbar">
        <div>
            <!-- Adois-->
            <a href="#" class="logo">
                <img src="img/logo.png" alt="Tickets Now">
            </a>
        </div>
        <div class="section-nav">
            <a href="#featured-concerts">Destacados</a>
            <a href="#recommended-concerts">Recomendados</a>
            <a href="#discover-concerts">Descubre</a>
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
                    <img src="img/icon_user.png" alt="Usuario">
                </div>
            </button>
            <div class="account-dropdown-menu">
                <ul>
                    <li><a href="login.php">Iniciar sesión</a></li>
                    <li><a href="register.php">Regístrate</a></li>
                    <hr>
                    <li><a href="paginadeayuda.php">Ayuda</a></li>
                    <li><a href="#">Configuración</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </div>
        </div>        
    </nav>

    <header class="main-concert-banner">
        <h1>Michael Jackson - World Tour</h1>
        <a href="">
            <button>ENTRADAS</button>
        </a>
    </header>

    <div id="featured-concerts" class="featured-concerts-titles">
        <div class="section-title">
            <h2>Conciertos destacados</h2>
            <hr>
        </div>
        <div class="section-title">
            <h2>Otros conciertos</h2>
            <hr>
        </div>
    </div>
    <section class="featured-concerts">
        <a href="#" class="concert-banner most-featured-concert">
            <img src="img/Banners/aurora.png" alt="TWICE">
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
            <img src="img/banner_imagine_dragons.jpg" alt="Imagine Dragons">
            <div class="concert-info">
                <p>EE.UU. | 3 de julio de 2025</p>
                <h3>Imagine Dragons</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_ado.jpg" alt="Ado">
            <div class="concert-info">
                <p>Japón | 22 de abril de 2025</p>
                <h3>Ado</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_ksi.jpg" alt="KSI">
            <div class="concert-info">
                <p>Reino Unido | 10 de mayo de 2025</p>
                <h3>KSI</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_eladio_carrion.jpeg" alt="Eladio Carrión">
            <div class="concert-info">
                <p>México | 20 de agosto de 2025</p>
                <h3>Eladio Carrión</h3>
            </div>
        </a>
    </section>  
    
    <div id="recommended-concerts" class="section-title">
        <h2>Conciertos recomendados</h2>
        <hr>
    </div>
    <section class="recommended-concerts">
        <a href="#" class="concert-banner">
            <img src="img/banner_twice.jpeg" alt="TWICE">
            <div class="concert-info">
                <p>Madrid, España | 15 de marzo de 2025</p>
                <h3>TWICE - World Tour Ready To Be</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_aespa.jpg" alt="aespa">
            <div class="concert-info">
                <p>Nueva York, EE.UU. | 8 de junio de 2025</p>
                <h3>aespa - LIVE TOUR</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_ado.jpg" alt="Ado">
            <div class="concert-info">
                <p>Tokyo, Japón | 22 de abril de 2025</p>
                <h3>Ado - Kyougen Tour</h3>
            </div>
        </a>
        <div class="concert-banner empty-concert">
            <h4>Nada más por recomendar...</h4>
        </div>
    </section>

    <div id="discover-concerts" class="section-title">
        <h2>Descubre</h2>
        <hr>
    </div>
    <section class="discover-concerts">
        <a href="#" class="concert-banner">
            <img src="img/banner_imagine_dragons.jpg" alt="Imagine Dragons">
            <div class="concert-info">
                <p>EE.UU. | 3 de julio de 2025</p>
                <h3>Imagine Dragons</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_ksi.jpg" alt="KSI">
            <div class="concert-info">
                <p>Reino Unido | 10 de mayo de 2025</p>
                <h3>KSI</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_eladio_carrion.jpeg" alt="Eladio Carrión">
            <div class="concert-info">
                <p>México | 20 de agosto de 2025</p>
                <h3>Eladio Carrión</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_imagine_dragons.jpg" alt="Imagine Dragons">
            <div class="concert-info">
                <p>EE.UU. | 3 de julio de 2025</p>
                <h3>Imagine Dragons</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_ksi.jpg" alt="KSI">
            <div class="concert-info">
                <p>Reino Unido | 10 de mayo de 2025</p>
                <h3>KSI</h3>
            </div>
        </a>
        <a href="#" class="concert-banner">
            <img src="img/banner_eladio_carrion.jpeg" alt="Eladio Carrión">
            <div class="concert-info">
                <p>México | 20 de agosto de 2025</p>
                <h3>Eladio Carrión</h3>
            </div>
        </a>
    </section>
    
    <footer>
        <h2>Vivencias en Primera Fila</h2>
        <div class="reviews-cards">
            <div class="review-card">
                <p>“Una explosión de energía y pasión, con una banda que hizo vibrar cada rincón del lugar; la conexión
                    con el público fue inigualable.”</p>
                <div class="review-user">
                    <img src="img/user1.jpg" alt="User foto">
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
                    <img src="img/user2.jpg" alt="User foto">
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
                    <img src="img/user3.jpg" alt="User foto">
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
                <a href="mailto:caseycleto@gmail.com">caseycleto@gmail.com</a>
            </div>
            <div class="footer-column">
                <h3>Consúltanos</h3>
                <a href="#">Contacto</a>
            </div>
            <div class="footer-column">
                <h3>Llámanos</h3>
                <a href="tel:+34666666666">+34 666 66 66 66</a>
            </div>
            <div class="footer-column">
                <h3>¿Buscas ayuda?</h3>
                <a href="paginadeayuda.php">Página de ayuda</a><br>
                <a href="#">FAQ</a>
            </div>
        </div>

        <div class="footer-bottom">
            © 1939-2024 TicketsNow. Todos los derechos reservados.
        </div>
    </footer>
</body>
</html>