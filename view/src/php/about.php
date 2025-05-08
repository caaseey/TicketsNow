<?php
/* ---------- SEGURIDAD / HTTPS ---------- */
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
    <link rel="stylesheet" href="../css/index.css">
    <title>TicketsNow</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div>
            <a href="#" class="logo">
                <img src="../../media/img/interfaces/logo.png" alt="Tickets Now">
            </a>
        </div>
        <form class="search-container" action="../../src/php/buscar.php" method="get">
            <input type="text" name="q" class="search-bar" placeholder="Buscar conciertos...">
            <button type="submit" class="search-button">
                <img src="../../media/img/interfaces/lupa.png" alt="Buscar">
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
                    <li><a href="../../../html/work_in_progress.html">Ayuda</a></li>
                    <li><a href="../../../html/work_in_progress.html">Sobre nosotros</a></li>
                    <li><a href="../../../html/work_in_progress.html">Contacto</a></li>
                </ul>
            </div>


    </nav>

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="../css/index.css"><!-- paleta, tipografías, navbar, footer… -->

    <!--  CSS ESPECÍFICO DE “ABOUT”  -->
    <link rel="stylesheet" href="../css/about.css">

    <title>Sobre nosotros | TicketsNow</title>
    </head>

    <body>

        <main class="container">
            <!-- HISTORIA ----------------------------------------------------->
            <section class="section">
                <div class="section-title">
                    <h2>Nuestra historia</h2>
                    <hr>
                </div>

                <div class="grid two-cols">
                    <div class="text">
                        <p>TicketsNow nació de una apuesta en 2014-15: «Si el Barça gana la Champions creamos una compañía». Ganaron… pero las entradas estaban agotadas. 😅</p>
                        <p>En 2020 la pandemia nos dejó KO, pero volvimos más fuertes. Hoy nos enfocamos en conciertos y trabajamos para cubrir todo tipo de eventos.</p>
                    </div>

                    <figure>
                        <img src="../view/media/img/about/history.jpg" alt="Nuestro camino">
                    </figure>
                </div>
            </section>

            <!-- MISIÓN / VISIÓN --------------------------------------------->
            <section class="section section--blue">
                <div class="grid two-cols cards">
                    <article class="card glass">
                        <h3>Misión</h3>
                        <ul>
                            <li>Compra de tickets fácil y rápida</li>
                            <li>Servir a fans de la música en todo el mundo</li>
                            <li>Eliminar barreras de acceso</li>
                        </ul>
                    </article>

                    <article class="card glass">
                        <h3>Visión</h3>
                        <ul>
                            <li>Liderar la ticketera global</li>
                            <li>Cubrir todos los tipos de eventos</li>
                            <li>Acceso sin estrés para cualquier persona</li>
                        </ul>
                    </article>
                </div>
            </section>

            <!-- VALORES ------------------------------------------------------>
            <section class="section">
                <div class="section-title">
                    <h2>Nuestros valores</h2>
                    <hr>
                </div>

                <div class="grid three-cols cards">
                    <article class="card">
                        <h4>Confianza</h4>
                        <p>Cumplimos lo que prometemos.</p>
                    </article>
                    <article class="card">
                        <h4>Pasión</h4>
                        <p>Amamos los eventos en vivo.</p>
                    </article>
                    <article class="card">
                        <h4>Innovación</h4>
                        <p>Mejoramos de forma constante.</p>
                    </article>
                </div>
            </section>

            <!-- EQUIPO ------------------------------------------------------->
            <section class="section">
                <div class="section-title">
                    <h2>Conoce al equipo</h2>
                    <hr>
                </div>

                <div class="grid four-cols team">
                    <?php
                    $team = [
                        ['img' => 'casey.jpg', 'name' => 'Casey', 'role' => 'Back-End'],
                        ['img' => 'marc.jpg', 'name' => 'Marc', 'role' => 'Business'],
                        ['img' => 'john.jpg', 'name' => 'John', 'role' => 'Front-End'],
                        ['img' => 'wendy.jpg', 'name' => 'Wendy', 'role' => 'UI/UX'],
                    ];
                    foreach ($team as $member): ?>
                        <article class="card team-card">
                            <img src="../../media/img/team/casey.png?= $member['img']; ?>" alt="<?= $member['name']; ?>">
                            <h3><?= $member['name']; ?></h3>
                            <p class="role"><?= $member['role']; ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>

        <footer id="footer">
            <h2>Vivencias en Primera Fila</h2>
            <div class="reviews-cards">
                <div class="review-card">
                    <p>活力与激情的爆发，乐队的演奏让场地的每个角落都震动起来；与观众的联系无与伦比</p>
                    <div class="review-user">
                        <img src="../../media/img/interfaces/users/user1.png" alt="user1">
                        <div>
                            <h4>Zeng</h4>
                            <p>Aespa - Beijing, China</p>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <p>A spectacular sound journey, with an impressive lighting set and an atmosphere that never stopped moving. Incredible!</p>
                    <div class="review-user">
                        <img src="../../media/img/interfaces/users/user2.png" alt="user2">
                        <div>
                            <h4>Charles</h4>
                            <p>Ado - Londres, Reino Unido</p>
                        </div>
                    </div>
                </div>
                <div class="review-card">
                    <p id="review-text">KENDRICK LAMAR THE BEST ARTIST THIS DAMN CENTURY</p>
                    <div class="review-user">
                        <img src="../../media/img/interfaces/users/user3.png" alt="user3">
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
                    <a href="../../src/html/work_in_progress.html">Haz click aquí</a>
                </div>
                <div class="footer-column">
                    <h3>Llámanos</h3>
                    <a href="tel:+34666666666">+34 666 66 66 66</a>
                </div>
                <div class="footer-column">
                    <h3>¿Buscas ayuda?</h3>
                    <a href="../../src/html/work_in_progress.html">Página de ayuda</a><br>
                </div>
            </div>

            <div class="footer-bottom">
                © 2024-2025 TicketsNow. Todos los derechos reservados.
            </div>
        </footer>
    </body>

</html>