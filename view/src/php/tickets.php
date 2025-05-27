<?php
if ((!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') && strpos($_SERVER['HTTP_HOST'], 'localhost') === false) {
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas | Tickets Now</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/concert.css">
    <link rel="stylesheet" href="../css/tickets.css">
    <link rel="stylesheet" href="../../../view/media/assets/nouislider/nouislider.min.css">
</head>
<body>
<nav class="navbar">
    <div>
        <a href="../../../view/index.php" class="logo">
            <img src="../../media/img/interfaces/logo.png" alt="Tickets Now">
        </a>
    </div>

    <div class="account-menu">
        <button class="account-button">
            <div class="account-icon">
                <hr>
                <hr>
                <hr>
            </div>
            <div class="account-picture">
                <img src="../../media/img/interfaces/user_icon.png" alt="Usuario">
            </div>
        </button>
        <div class="account-dropdown-menu">
            <ul>
                <?php
                if (isset($_SESSION['logged_in'])) {
                    echo '<li><a href="profile.php">Mi perfil</a></li>';

                    if ($_SESSION['id_role'] == 3) {
                        echo '<li><a href="dashboard.php">Dashboard</a></li>';
                    }

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
                <li><a href="../php/about.php">Sobre nosotros</a></li>
                <li><a href="#footer">Contacto</a></li>
            </ul>
        </div>
    </div>
</nav>

    <br>
    <br>
    <br>

    <!-- CONCERT NAVBAR -->
    <navbar class="concert-navbar">
        <div class="concert-navbar-group">
            <a href="#" class="concert-navbar-option" onclick="showSeats()">
                <span><img src="../../media/img/interfaces/seat_icon.png" alt="Asientos">Elegir mis asientos</span>
            </a>
            <a href="#" class="concert-navbar-option" onclick="showChat()">
                <span><img src="../../media/img/interfaces/chat_icon.png" alt="Chat">Chat en vivo</span>
            </a>
        </div>
    </navbar>

    <!-- MAIN CONTENT -->
    <div id="main-content">
        <!-- SEAT MAP -->
        <section class="seat-map">
            <img src="../../media/img/interfaces/seat_map.png" alt="Seat Map">
        </section>

        <!-- FILTERS -->
        <div class="main-section-title">
            <h2>FILTRAR POR</h2>
            <hr>
        </div>
        <section class="filters-container">
            <!-- TYPE FILTER -->
            <div class="filter-box">
                <div class="filter-title">
                    <img src="../../media/img/interfaces/seat_type_icon.png" alt="Icono entradas">
                    <h3>Tipos de entradas</h3>
                </div>
                <div class="filter-options">
                    <label><input type="checkbox" checked> Estándar</label>
                    <label><input type="checkbox"> Premium</label>
                    <label><input type="checkbox"> VIP</label>
                </div>
                <hr>
                <div class="filter-options">
                    <label><input type="checkbox" checked> Zona Centro</label>
                    <label><input type="checkbox"> Zona Lateral</label>
                    <label><input type="checkbox"> Zona Alta</label>
                    <label><input type="checkbox"> Zona Baja</label>
                </div>
                <hr>
                <div class="filter-options">
                    <label><input type="checkbox" checked> Acceso prioritario</label>
                    <label><input type="checkbox"> Meet & Greet</label>
                    <label><input type="checkbox"> Movilidad reducida</label>
                </div>
            </div>

            <!-- PRICE FILTER -->
            <div class="filter-box">
                <div class="filter-title">
                    <img src="../../media/img/interfaces/seat_price_icon.png" alt="Icono precio">
                    <h3>Precio</h3>
                </div>
                <div class="filter-price">
                    <div class="price-range-values">
                        <span id="price-lower">100€</span>&nbsp;&nbsp;–&nbsp;&nbsp;<span id="price-upper">800€</span>
                    </div>
                    <div id="price-range"></div>
                </div>
            </div>
        </section>

        <!-- PURCHASE BUTTON -->
        <div class="purchase-button-container">
            <a href="../html/work_in_progress.html" class="purchase-button">
                <img src="../../media/img/interfaces/logo.png" alt="Ticket" class="purchase-icon">
                Continuar con la compra
            </a>
        </div>
    </div>

    <!-- LIVE CHAT -->
    <div id="chat-container" class="chat-container" style="display: none;">
        <div class="chat-box">
            <div class="chat-messages" id="chat-messages"></div>
            <form id="chat-form" class="chat-form">
                <img src="../../media/img/interfaces/chat_user_icon.png" alt="Usuario" class="chat-avatar chat-avatar-form">
                <input type="text" id="chat-input" placeholder="Escriba su mensaje..." autocomplete="off">
                <button type="submit">➤</button>
            </form>
        </div>
    </div>

    <!-- FOOTER -->
    <footer id="footer">
        <div class="footer-links">
            <div class="footer-column"><h3>Escríbenos</h3><a href="mailto:ticketsnow_official@gmail.com">ticketsnow_official@gmail.com</a></div>
            <div class="footer-column"><h3>Sobre nosotros</h3><a href="about.php">Haz click aquí</a></div>
            <div class="footer-column"><h3>Llámanos</h3><a href="tel:+34666666666">+34 666 66 66 66</a></div>
            <div class="footer-column"><h3>¿Buscas ayuda?</h3><a href="../html/work_in_progress.html">Página de ayuda</a></div>
        </div>
    </footer>

    <script src="../../../view/media/assets/nouislider/nouislider.min.js"></script>
    <script>
        const priceSlider = document.getElementById('price-range');
        const priceLower = document.getElementById('price-lower');
        const priceUpper = document.getElementById('price-upper');

        noUiSlider.create(priceSlider, {
            start: [100, 800],
            connect: true,
            range: { 'min': 0, 'max': 1000 },
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

        function showChat() {
            document.getElementById('main-content').style.display = 'none';
            document.getElementById('chat-container').style.display = 'flex';
        }

        function showSeats() {
            document.getElementById('chat-container').style.display = 'none';
            document.getElementById('main-content').style.display = 'block';
        }

        // Chat logic
        const chatForm = document.getElementById("chat-form");
        const chatInput = document.getElementById("chat-input");
        const chatMessages = document.getElementById("chat-messages");

        chatForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const msg = chatInput.value.trim();
            if (msg !== "") {
                const messageElement = document.createElement("div");
                messageElement.classList.add("chat-message");
                messageElement.innerHTML = `
                    <img src="../../media/img/interfaces/chat_user_icon.png" alt="user" class="chat-avatar">
                    <p class="chat-text">${msg}</p>
                `;
                chatMessages.appendChild(messageElement);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                chatInput.value = "";
            }
        });
    </script>
</body>
</html>
