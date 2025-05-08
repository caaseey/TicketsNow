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
            <a href="../../../view/index.php" class="logo">
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
                    <h2>Our history</h2>
                    <hr>
                </div>

                <div class="grid two-cols">
                    <div class="text">
                        <p>TicketsNow started with a fun bet in 2014-2015. We said, "If FC Barcelona wins the Champions League, we will create a company." They won. Sadly, we didn’t go to the final because the tickets were sold out. We had to watch it from home.
                            That moment made us realize something important: many people wait months or even years for special events, and sometimes they miss them just because they couldn’t get a ticket. So we decided to do something about it. We created TicketsNow.
                            In 2020, the pandemic hit us hard. We went bankrupt. But soon after, we came back stronger. Today, we only sell music concert tickets because we don’t yet have the licenses for football, esports, or other types of events. Still, our big dream is to become the best ticket-selling company in every category.
                        </p>
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
                        <h3>Mission</h3>
                        <ul>
                            <li><b>What do we do today?</b> We sell tickets for music concerts online. Our platform is easy to use, fast, and safe.</li>
                            <li><b>Who do we serve?</b> We help fans who want to enjoy live music and don’t want to miss their favorite artists.</li>
                            <li><b>What are we trying to accomplish?</b> We want to make it simple for everyone to buy tickets and avoid missing events.</li>
                            <li><b>What impact do we want to achieve?</b> We want people to live the moments they have been dreaming about, not miss them because tickets were sold out.</li>
                        </ul>
                    </article>

                    <article class="card glass">
                        <h3>Vision</h3>
                        <ul>
                            <li><b>Where are we going in the future?</b> We want to grow and sell tickets for all types of events: sports, esports, theatre, and more.</li>
                            <li><b>What do we want to achieve in the long term? </b>To be the most trusted and complete ticket platform in the world.</li>
                            <li><b>What kind of future society do we envision? </b>A world where everyone can go to events they love without stress or unfair systems.</li>
                        </ul>
                    </article>
                </div>
            </section>

            <!-- VALORES ------------------------------------------------------>
            <section class="section">
                <div class="section-title">
                    <h2>Our values</h2>
                    <hr>
                </div>

                <div class="grid three-cols cards">
                    <article class="card">
                        <h4>Trust</h4>
                        <p>We always keep our promises.</p>
                    </article>
                    <article class="card">
                        <h4>Accessibility</h4>
                        <p>Tickets should be easy and fair to get.</p>
                    </article>
                    <article class="card">
                        <h4>Passion</h4>
                        <p>We love live events just like our customers.</p>
                    </article>
                    <article class="card">
                        <h4>Resilience</h4>
                        <p>We never give up, even when times are hard.</p>
                    </article>
                    <article class="card">
                        <h4>Integrity</h4>
                        <p>We do what’s right, even if it’s not easy.</p>
                    </article>
                    <article class="card">
                        <h4>Innovation</h4>
                        <p>We look for new ways to improve every day.</p>
                    </article>
                </div>
            </section>

            <!-- EQUIPO ------------------------------------------------------->
            <section class="section">
                <div class="section-title">
                    <h2>Meet the team</h2>
                    <hr>
                </div>

                <div class="grid four-cols team">
                    <?php
                    $team = [
                        ['img' => 'casey.png', 'name' => 'Casey', 'role' => 'Backend Developer & Database Architect'],
                        ['img' => 'marc.png',  'name' => 'Marc',  'role' => 'Backend Developer & Business Analyst'],
                        ['img' => 'john.png',  'name' => 'John',  'role' => 'Frontend Developer & Accessibility Champion'],
                        ['img' => 'wendy.png', 'name' => 'Wendy', 'role' => 'Frontend Developer & UI/UX Strategist'],
                    ];
                    foreach ($team as $member): ?>
                        <article class="card team-card">
                            <img src="../../media/img/team/<?= $member['img']; ?>"
                                alt="<?= htmlspecialchars($member['name']); ?>">
                            <h3><?= htmlspecialchars($member['name']); ?></h3>
                            <p class="role"><?= htmlspecialchars($member['role']); ?></p>
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