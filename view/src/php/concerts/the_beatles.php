<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../css/index.css" />
  <link rel="stylesheet" href="../../css/concert.css" />
  <title>TWICE - Artista</title>
</head>

<body>
  <!-- NAVBAR -->
  <nav class="navbar">
    <a href="../../../index.php" class="logo">
      <img src="../../../media/img/interfaces/logo.png" alt="Tickets Now" />
    </a>
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
          if (isset($_SESSION['logged_in'])) 
          {
            echo "<li><a href='../profile.php'>Mi perfil</a></li>";
          } else {
            echo "<li><a href='../login.php'>Iniciar sesión</a></li>";
            echo "<li><a href='../register_user.php'>Regístrate</a></li>";
          }
          ?>
          <hr>
          <li><a href="../../html/work_in_progress.html">Ayuda</a></li>
          <li><a href="../../html/work_in_progress.html">Sobre nosotros</a></li>
          <li><a href="../../html/work_in_progress.html">Contacto</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HEADER -->
  <header class="banner-header" style="background-image: url('../../../media/img/concert_banners/the_beatles.jpg');">
    <div class="banner-text">
      <p>Pop Rock</p>
      <h1>The Beatles</h1>
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
          <p>22</p>
          <p>JUL</p>
          <p>2025</p>
        </div>
        <div class="ticket-details">
          <p>mar · 20:30</p>
          <p>TWICE World Tour Ready To Be</p>
          <p>Barcelona - Palau Sant Jordi</p>
        </div>
      </div>
      <a href="../tickets.php"><button>ENTRADAS</button></a>
    </div>
  </section>

  <section class="ticket-container">
    <div class="ticket">
      <div class="ticket-info">
        <div class="ticket-date">
          <p>25</p>
          <p>JUL</p>
          <p>2025</p>
        </div>
        <div class="ticket-details">
          <p>vie · 21:00</p>
          <p>TWICE World Tour Ready To Be</p>
          <p>Madrid - WiZink Center</p>
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
          <p>03</p>
          <p>AGO</p>
          <p>2025</p>
        </div>
        <div class="ticket-details">
          <p>sáb · 19:00</p>
          <p>TWICE Global Encore Tour: With YOU-th</p>
          <p>Seúl - KSPO Dome</p>
        </div>
      </div>
      <a href="../tickets.php"><button>ENTRADAS</button></a>
    </div>
  </section>

  <section class="ticket-container">
    <div class="ticket">
      <div class="ticket-info">
        <div class="ticket-date">
          <p>09</p>
          <p>AGO</p>
          <p>2025</p>
        </div>
        <div class="ticket-details">
          <p>vie · 20:00</p>
          <p>TWICE Global Encore Tour: With YOU-th</p>
          <p>Nueva York - Madison Square Garden</p>
        </div>
      </div>
      <a href="../tickets.php"><button>ENTRADAS</button></a>
    </div>
  </section>

  <section class="ticket-container">
    <div class="ticket">
      <div class="ticket-info">
        <div class="ticket-date">
          <p>13</p>
          <p>AGO</p>
          <p>2025</p>
        </div>
        <div class="ticket-details">
          <p>mié · 20:30</p>
          <p>TWICE Global Encore Tour: With YOU-th</p>
          <p>París - Accor Arena</p>
        </div>
      </div>
      <a href="../tickets.php"><button>ENTRADAS</button></a>
    </div>
  </section>

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