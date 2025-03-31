<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css"/>
    <link rel="stylesheet" href="css/artist.css"/> 
    <link rel="stylesheet" href="css/concert.css"/>
    <title>TWICE - Artista</title>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="index.php" class="logo">
            <img src="img/Interfaces/logo.png" alt="Tickets Now" />
        </a>
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

    <!-- HEADER -->
    <header class="banner-header">
        <div class="banner-text">
            <h2>TWICE World Tour Ready To Be</h2>
            <p>Mar - Jul 22 · 2024 · 20:30</p>
            <p>Barcelona · Palau Sant Jordi</p>
        </div>
    </header>

    <!-- CONCERT NAVBAR -->
    <div class="concert-navbar">
        <div class="concert-navbar-group">
            <a href="#" class="concert-navbar-option">
            <span>
                <img src="img/Interfaces/seat_icon.png" alt="Elegir asientos">
                Elegir mis asientos
            </span>
            </a>
            <a href="#" class="concert-navbar-option">
            <span>
                <img src="img/Interfaces/chat_icon.png" alt="Chat en vivo">
                Chat en vivo
            </span>
            </a>
        </div>
    </div>

    <!-- SEAT MAP -->
    <div class="seat-map">
        <img src="./img/Interfaces/seat_map.jpg" alt="Seat Map">
    </div>

    <!-- SEAT MAP -->
    <div class="main-section-title">
        <h2>FILTRAR POR</h2>
        <hr>
    </div>

    <!-- SEAT FILTER -->
    <div class="filters-container">
        <!-- TYPE -->
        <div class="filter-box">
            <div class="filter-title">
                <img src="img/Interfaces/seat_type_icon.png" alt="Icono entradas">
                <h3>Tipos de entradas</h3>
            </div>
            <div class="filter-options">
                <label><input type="checkbox" checked> Entradas <strong>VIP</strong></label>
                <label><input type="checkbox"> Entradas <strong>Premium</strong></label>
                <label><input type="checkbox"> Entradas <strong> Estándar</strong> </label>
                <label><input type="checkbox"> Entradas <strong>Económicas</strong></label>
            </div>
            <hr>
            <div class="filter-options">
                <label><input type="checkbox" checked> <strong>Frontal </strong> al Escenario</label>
                <label><input type="checkbox"> Vista <strong>Lateral</strong></label>
                <label><input type="checkbox"> Zona <strong>Alta</strong></label>
                <label><input type="checkbox"> Zona <strong> Baja</strong></label>
            </div>
            <hr>
            <div class="filter-options">
                <label><input type="checkbox" checked><strong>Acceso prioritario </strong></label>
                <label><input type="checkbox"> <strong>Meet & Greet</strong></label>
                <label><input type="checkbox"> <strong>Movilidad reducida</strong></label>
            </div>
        </div>

        <!-- PRICE -->
        <div class="filter-box">
            <div class="filter-title">
                <img src="img/Interfaces/seat_price_icon.png" alt="Icono precio">
                <h3>Precio</h3>
            </div>
                <div class="filter-price">
                <span class="price-tag">€39</span>
                <input type="range" min="39" max="425" value="100">
                <span class="price-tag">€425</span>
            </div>
        </div>
    </div>

 


    <!-- FOOTER -->
    <footer>
    <div class="footer-links">
      <div class="footer-column">
        <h3>Tickets Now</h3>
        <a href="help.php">Ayuda</a>
      </div>
      <div class="footer-column">
        <h3>Contacto</h3>
        <a href="mailto:contacto@ticketsnow.com">contacto@ticketsnow.com</a>
        <p>+34 666 88 99 66</p>
      </div>
      <div class="footer-column">
        <h3>Legal</h3>
        <a href="#">Términos</a>
        <a href="#">Privacidad</a>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 TicketsNow. Todos los derechos reservados.</p>
    </div>
  </footer>
</body>
</html>