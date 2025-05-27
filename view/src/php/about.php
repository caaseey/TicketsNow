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
    <title>Sobre nosotros | TicketsNow</title>
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

                <div class="grid two-cols history-section">
                    <div class="text history-text">
                        <p align="justify">TicketsNow started with a fun bet in 2014-2015. We said, "If FC Barcelona wins the Champions League, we will create a company." They won. Sadly, we didn’t go to the final because the tickets were sold out. We had to watch it from home.
                            That moment made us realize something important: many people wait months or even years for special events, and sometimes they miss them just because they couldn’t get a ticket. So we decided to do something about it. We created TicketsNow.
                            In 2020, the pandemic hit us hard. We went bankrupt. But soon after, we came back stronger. Today, we only sell music concert tickets because we don’t yet have the licenses for football, esports, or other types of events. Still, our big dream is to become the best ticket-selling company in every category.
                        </p>
                    </div>

                    <div class="youtube-container">
                        <iframe width="560" height="315"
                            src="https://www.youtube.com/embed/vEFUXC6flUI?autoplay=1&mute=1&loop=1&playlist=vEFUXC6flUI"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>

                </div>
            </section>

            <!-- MISIÓN / VISIÓN --------------------------------------------->
            <section class="section section--blue">
                <div class="grid two-cols cards mission-vision">
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

                <div class="grid three-cols cards values-cards">
                    <article class="card value-card">
                        <div class="icon">🤝</div>
                        <h4>Trust</h4>
                        <p>We always keep our promises.</p>
                    </article>
                    <article class="card value-card">
                        <div class="icon">🎟️</div>
                        <h4>Accessibility</h4>
                        <p>Tickets should be easy and fair to get.</p>
                    </article>
                    <article class="card value-card">
                        <div class="icon">🔥</div>
                        <h4>Passion</h4>
                        <p>We love live events just like our customers.</p>
                    </article>
                    <article class="card value-card">
                        <div class="icon">💪</div>
                        <h4>Resilience</h4>
                        <p>We never give up, even when times are hard.</p>
                    </article>
                    <article class="card value-card">
                        <div class="icon">🧭</div>
                        <h4>Integrity</h4>
                        <p>We do what’s right, even if it’s not easy.</p>
                    </article>
                    <article class="card value-card">
                        <div class="icon">🚀</div>
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
                        [
                            'img' => 'casey.png',
                            'name' => 'Casey',
                            'role_title' => 'Backend Developer & Database Architect',
                            'role_desc' => 'I’m in charge of building and maintaining the structure behind our platform. From database design to server-side logic, I make sure everything runs smoothly and securely.'
                        ],
                        [
                            'img' => 'marc.png',
                            'name' => 'Marc',
                            'role_title' => 'Backend Developer & Business Analyst',
                            'role_desc' => 'I focus on the platform’s backend logic and also study market needs. My job is to align our technical development with real-world user requirements and business goals.'
                        ],
                        [
                            'img' => 'john.png',
                            'name' => 'John',
                            'role_title' => 'Frontend Developer & Accessibility Champion',
                            'role_desc' => 'I build the user interface of our platform and ensure that everything is accessible to everyone, including users with disabilities.'
                        ],
                        [
                            'img' => 'wendy.png',
                            'name' => 'Wendy',
                            'role_title' => 'Frontend Developer & UI/UX Strategist',
                            'role_desc' => 'I design and improve how our users experience the website, making sure it’s intuitive, beautiful, and responsive across all devices.'
                        ]
                    ];
                    foreach ($team as $member): ?>
                        <article class="card team-card">
                            <img src="../../media/img/team/<?= $member['img']; ?>" alt="<?= htmlspecialchars($member['name']); ?>">
                            <h3><?= htmlspecialchars($member['name']); ?></h3>
                            <p class="role" style="text-align: justify;">
                                <strong><?= htmlspecialchars($member['role_title']); ?>.</strong><br>
                                <?= htmlspecialchars($member['role_desc']); ?>
                            </p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

        </main>

        <!-- FOOTER -->
        <footer id="footer">
            <div class="footer-logo">
                <img src="../../media/img/interfaces/logo_footer.png" alt="TicketsNow logo footer">
            </div>
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
    </body>

</html>