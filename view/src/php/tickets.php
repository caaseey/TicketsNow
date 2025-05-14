<?php
if ((!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') && strpos($_SERVER['HTTP_HOST'], 'localhost') === false) {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css"/>
    <link rel="stylesheet" href="../css/concert.css"/>
    <link rel="stylesheet" href="../css/tickets.css"/>
    <link rel="stylesheet" href="../../../assets/nouislider/nouislider.min.css">
    <title>Entradas | Tickets Now</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div>
            <a href="../../" class="logo">
                <img src="../../media/img/interfaces/logo.png" alt="Tickets Now">
            </a>
        </div>

        <div class="account-menu">
            <button class="account-button">
                <div class="account-icon"><hr><hr><hr></div>
                <div class="account-picture">
                    <img src="../../media/img/interfaces/user_icon.png" alt="Usuario">
                </div>
            </button>
            <div class="account-dropdown-menu">
                <ul>
                    <?php
                    if (isset($_SESSION['logged_in'])) {    
                        echo '<li><a href="profile.php">Mi perfil</a></li>';
                        echo "<li><a href='#' onclick=\"document.getElementById('logoutForm').submit(); return false;\">Cerrar sesión</a></li>";
                    } else {
                        echo "<li><a href='login.php'>Iniciar sesión</a></li>";
                        echo "<li><a href='register_user.php'>Regístrate</a></li>";
                    }
                    ?>
                    <?php if (isset($_SESSION['logged_in'])): ?>
                        <form id="logoutForm" action="logout.php" method="post" style="display: none;"></form>
                    <?php endif; ?>
                    <hr>
                    <li><a href="../html/work_in_progress.html">Ayuda</a></li>
                    <li><a href="about.php">Sobre nosotros</a></li>
                    <li><a href="#footer">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <br><br><br><br><br>

    <!-- CONCERT NAVBAR -->
    <navbar class="concert-navbar">
        <div class="concert-navbar-group">
            <a href="#" class="concert-navbar-option" onclick="showSeats()">
                <span>
                    <img src="../../media/img/Interfaces/seat_icon.png" alt="Elegir asientos">
                    Elegir mis asientos
                </span>
            </a>
            <a href="#" class="concert-navbar-option" onclick="hideContent()">
                <span>
                    <img src="../../media/img/Interfaces/chat_icon.png" alt="Chat en vivo">
                    Chat en vivo
                </span>
            </a>
        </div>
    </navbar>

    <div id="main-content">
        <!-- SEAT MAP -->
        <section class="seat-map">
            <img src="../../media/img/interfaces/seat_map.png" alt="Seat Map">
        </section>

        <!-- SEAT FILTER -->
        <div class="main-section-title">
            <h2>FILTRAR POR</h2>
            <hr>
        </div>

        <section class="filters-container">
            <!-- TYPE -->
            <div class="filter-box">
                <div class="filter-title">
                    <img src="../../media/img/interfaces/seat_type_icon.png" alt="Icono entradas">
                    <h3>Tipos de entradas</h3>
                </div>
                <div class="filter-options">
                    <label><input type="checkbox" checked> Entradas <strong>Estándar</strong></label>
                    <label><input type="checkbox"> Entradas <strong>Premium</strong></label>
                    <label><input type="checkbox"> Entradas <strong>VIP</strong></label>
                </div>
                <hr>
                <div class="filter-options">
                    <label><input type="checkbox" checked> Zona <strong>Centro</strong></label>
                    <label><input type="checkbox"> Zona <strong>Lateral</strong></label>
                    <label><input type="checkbox"> Zona <strong>Alta</strong></label>
                    <label><input type="checkbox"> Zona <strong>Baja</strong></label>
                </div>
                <hr>
                <div class="filter-options">
                    <label><input type="checkbox" checked><strong>Acceso prioritario</strong></label>
                    <label><input type="checkbox"> <strong>Meet & Greet</strong></label>
                    <label><input type="checkbox"> <strong>Movilidad reducida</strong></label>
                </div>
            </div>

            <!-- PRICE -->
            <div class="filter-box">
                <div class="filter-title">
                    <img src="../../media/img/interfaces/seat_price_icon.png" alt="Icono precio">
                    <h3>Precio</h3>
                </div>
                <div class="filter-price">
                    <div class="price-range-values">
                        <span id="price-lower">100€</span> &nbsp;–&nbsp; <span id="price-upper">800€</span>
                    </div>
                    <div id="price-range"></div>
                </div>
            </div>
        </section>
    </div>

    <!-- FOOTER -->
    <footer id="footer">
        <div class="footer-links">
            <div class="footer-column">
                <h3>Escríbenos</h3>
                <a href="mailto:ticketsnow_official@gmail.com">ticketsnow_official@gmail.com</a>
            </div>
            <div class="footer-column">
                <h3>Sobre nosotros</h3>
                <a href="about.php">Haz click aquí</a>
            </div>
            <div class="footer-column">
                <h3>Llámanos</h3>
                <a href="tel:+34666666666">+34 666 66 66 66</a>
            </div>
            <div class="footer-column">
                <h3>¿Buscas ayuda?</h3>
                <a href="../html/work_in_progress.html">Página de ayuda</a><br>
            </div>
        </div>
    </footer>

    <script src="../../../assets/nouislider/nouislider.min.js"></script>
    <script>
        function hideContent() {
            document.getElementById("main-content").style.display = "none";
        }

        function showSeats() {
            document.getElementById("main-content").style.display = "block";
        }

        const priceSlider = document.getElementById('price-range');
        const priceLower = document.getElementById('price-lower');
        const priceUpper = document.getElementById('price-upper');

        noUiSlider.create(priceSlider, {
            start: [100, 800],
            connect: true,
            range: {
                'min': 0,
                'max': 1000
            },
            step: 1,
            tooltips: true,
            format: {
                to: value => `${Math.round(value)}€`,
                from: value => Number(value.replace('€', ''))
            }
        });

        priceSlider.noUiSlider.on('update', function(values) {
            priceLower.textContent = values[0];
            priceUpper.textContent = values[1];
        });
    </script>
</body>
</html>
