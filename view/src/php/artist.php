<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../../controller/ConcertController.php';

$concertController = new ConcertController();

// Obtener el nombre del artista desde la URL
if (isset($_GET['name'])) {
    $artistName = $_GET['name'];
} else {
    $artistName = null;
}

// Obtener datos del artista
$artist = $concertController->getArtistByName($artistName);
if (!$artist) {
    die("Artista no encontrado.");
}

// Obtener los conciertos del artista
$id_artist = $artist['id_artist'];
$concerts = $concertController->getConcertsByArtist($id_artist);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/concert.css" />
    <title><?php echo htmlspecialchars($artist['name']); ?> | Tickets Now</title>
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
                        if ($_SESSION['id_role'] == 3) {
                            echo '<li><a href="dashboard.php">Dashboard</a></li>';
                        }
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

    <!-- HEADER -->
    <header class="banner-header" style="background-image: url('<?php echo htmlspecialchars($artist['banner_image']); ?>');">
        <div class="banner-text">
            <p><?php echo htmlspecialchars($artist['genre']); ?></p>
            <h1><?php echo htmlspecialchars($artist['name']); ?></h1>
        </div>
    </header>

    <div class="main-section-title">
        <h2>EVENTOS</h2>
        <hr>
    </div>

    <!-- NATIONAL TICKETS -->
    <div class="section-title">
        <h2>Conciertos en España</h2>
    </div>

    <?php

    // Filtrar los conciertos si son Españones o Internacionales
    $spanishCities = [
        'Bilbao', 'Madrid', 'Barcelona', 'Valencia', 'Sevilla',
        'Málaga', 'Zaragoza', 'Granada', 'Murcia', 'Palma de Mallorca'
    ];

    $spanishConcerts = [];
    $internationalConcerts = [];

    foreach ($concerts as $concert) {
        $isSpanish = false;
        
        foreach ($spanishCities as $city) {
            if (stripos($concert['location'], $city) !== false) {
                $isSpanish = true;
                break;
            }
        }
        
        if ($isSpanish) {
            $spanishConcerts[] = $concert;
        } else {
            $internationalConcerts[] = $concert;
        }
    }
    
    if (empty($spanishConcerts)) { ?>
        <div class="no-concert-message">
            <p>No hay conciertos disponibles en España.</p>
        </div>
    <?php 
    } else {
        foreach ($spanishConcerts as $concert) {
            $date = new DateTime($concert['date']);
            $day = $date->format('d');
            $month = $date->format('M');
            $year = $date->format('Y');
            $time = (new DateTime($concert['time']))->format('H:i');
            $dayOfWeek = $date->format('D');
        ?>
            <section class="ticket-container">
                <div class="ticket">
                    <div class="ticket-info">
                        <div class="ticket-date">
                            <p><?php echo $day; ?></p>
                            <p><?php echo strtoupper($month); ?></p>
                            <p><?php echo $year; ?></p>
                        </div>
                        <div class="ticket-details">
                            <p><?php echo strtolower($dayOfWeek); ?> · <?php echo $time; ?></p>
                            <p><?php echo htmlspecialchars($concert['name']); ?></p>
                            <p><?php echo htmlspecialchars($concert['location']); ?></p>
                        </div>
                    </div>
                    <a href="tickets.php"><button>ENTRADAS</button></a>
                </div>
            </section>
        <?php 
        } 
    }
    ?>

    <!-- INTERNATIONAL TICKETS -->
    <div class="section-title">
        <h2>Conciertos Internacionales</h2>
    </div>

    <?php
    if (empty($internationalConcerts)) { ?>
        <div class="no-concert-message">
            <p>No hay conciertos internacionales disponibles.</p>
        </div>
    <?php 
    } else {
        foreach ($internationalConcerts as $concert) {
            $date = new DateTime($concert['date']);
            $day = $date->format('d');
            $month = $date->format('M');
            $year = $date->format('Y');
            $time = (new DateTime($concert['time']))->format('H:i');
            $dayOfWeek = $date->format('D');
        ?>
            <section class="ticket-container">
                <div class="ticket">
                    <div class="ticket-info">
                        <div class="ticket-date">
                            <p><?php echo $day; ?></p>
                            <p><?php echo strtoupper($month); ?></p>
                            <p><?php echo $year; ?></p>
                        </div>
                        <div class="ticket-details">
                            <p><?php echo strtolower($dayOfWeek); ?> · <?php echo $time; ?></p>
                            <p><?php echo htmlspecialchars($concert['name']); ?></p>
                            <p><?php echo htmlspecialchars($concert['location']); ?></p>
                        </div>
                    </div>
                    <a href="../tickets.php"><button>ENTRADAS</button></a>
                </div>
            </section>
        <?php 
        } 
    }
    ?>

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