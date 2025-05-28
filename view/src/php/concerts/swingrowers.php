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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/index.css" />
  <link rel="stylesheet" href="../../css/concert.css" />
  <title>Swingrowers | Tickets Now</title>
</head>

<body>
  <!-- NAVBAR -->
<nav class="navbar">
  <div>
    <a href="../../../" class="logo">
      <img src="../../../media/img/interfaces/logo.png" alt="Tickets Now">
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
        <img src="../../../media/img/interfaces/user_icon.png" alt="Usuario">
      </div>
    </button>
    <div class="account-dropdown-menu">
      <ul>
        <?php
        if (isset($_SESSION['logged_in'])) {
          echo '<li><a href="../profile.php">Mi perfil</a></li>';
          echo "<li><a href='#' onclick=\"document.getElementById('logoutForm').submit(); return false;\">Cerrar sesión</a></li>";

          if ($_SESSION['id_role'] == 3) {
            echo '<li><a href="../dashboard.php">Dashboard</a></li>';
          }
        } else {
          echo "<li><a href='../login.php'>Iniciar sesión</a></li>";
          echo "<li><a href='../register_user.php'>Regístrate</a></li>";
        }
        ?>
        <?php if (isset($_SESSION['logged_in'])): ?>
          <form id="logoutForm" action="../logout.php" method="post" style="display: none;"></form>
        <?php endif; ?>
        <hr>
        <li><a href="../../html/work_in_progress.html">Ayuda</a></li>
        <li><a href="../about.php">Sobre nosotros</a></li>
        <li><a href="#footer">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>
  <!-- HEADER -->
  <header class="banner-header" style="background-image: url('../../../media/img/concert_banners/swingrowers.jpg');">
    <div class="banner-text">
      <p>Electro Swing</p>
      <h1>Swingrowers</h1>
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

  <section class="ticket-container">
    <div class="ticket">
      <div class="ticket-info">
        <div class="ticket-date">
          <p>01</p>
          <p>ENE</p>
          <p>2026</p>
        </div>
        <div class="ticket-details">
          <p>jue · 20:00</p>
          <p>Swingrowers - Winter Electro Swing Tour</p>
          <p>Granada - Teatro Isabel la Católica</p>
        </div>
      </div>
      <a href="../tickets.php"><button>ENTRADAS</button></a>
    </div>
  </section>

  <!-- INTERNATIONAL TICKETS -->
  <div class="section-title">
    <h2>Conciertos Internacionales</h2>
  </div>

  <section class="ticket-container">
    <div class="ticket">
      <div class="ticket-info">
        <div class="ticket-date">
          <p>12</p>
          <p>ENE</p>
          <p>2026</p>
        </div>
        <div class="ticket-details">
          <p>lun · 21:00</p>
          <p>Swingrowers - Winter Electro Swing Tour</p>
          <p>París - Le Trianon</p>
        </div>
      </div>
      <a href="../tickets.php"><button>ENTRADAS</button></a>
    </div>
  </section>

  <section class="ticket-container">
    <div class="ticket">
      <div class="ticket-info">
        <div class="ticket-date">
          <p>18</p>
          <p>ENE</p>
          <p>2026</p>
        </div>
        <div class="ticket-details">
          <p>dom · 19:30</p>
          <p>Swingrowers - Winter Electro Swing Tour</p>
          <p>Londres - O2 Shepherd's Bush Empire</p>
        </div>
      </div>
      <a href="../tickets.php"><button>ENTRADAS</button></a>
    </div>
  </section>


  <!-- FOOTER -->
  <footer id="footer">
    <div class="footer-logo">
      <img src="../../../media/img/interfaces/logo_footer.png" alt="TicketsNow logo footer">
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