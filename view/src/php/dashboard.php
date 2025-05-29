<?php
session_start();
require_once '../../../controller/ConcertController.php';
$concertController = new ConcertController();

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['create'])) {
            $artistName = $concertController->getArtistByID(intval($_POST['id_artist']))['name'];
            $concertController->createConcert(
                trim($artistName . " - " . $_POST['name']),
                trim($_POST['location']),
                $_POST['date'],
                $_POST['time'],
                floatval($_POST['price']),
                intval($_POST['id_artist'])
            );
            $_SESSION['success'] = "Concierto creado correctamente";
        } elseif (isset($_POST['update'])) {
            $concertController->updateConcert(
                intval($_POST['id_concert']),
                trim($_POST['name']),
                trim($_POST['location']),
                $_POST['date'],
                $_POST['time'],
                floatval($_POST['price']),
                intval($_POST['id_artist'])
            );
            $_SESSION['success'] = "Concierto actualizado correctamente";
        } elseif (isset($_POST['delete'])) {
            $concertController->deleteConcert(intval($_POST['delete']));
            $_SESSION['success'] = "Concierto eliminado correctamente";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    header("Location: dashboard.php");
    exit;
}

// Conseguir todos artistas
$artists = $concertController->getAllArtists();
$concerts = $concertController->getAllConcerts();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../../view/src/css/index.css" />
    <link rel="stylesheet" href="../../../view/src/css/dashboard.css" />
    <title>Admin Dashboard - TicketsNow</title>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div>
            <a href="../../" class="logo">
                <img src="../../../view/media/img/interfaces/logo.png" alt="Tickets Now">
            </a>
        </div>

        <div>
            <!-- Mensaje al crear un concierto -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>

        <div class="account-menu">
            <button class="account-button">
                <div class="account-icon">
                    <hr>
                    <hr>
                    <hr>
                </div>
                <div class="account-picture">
                    <img src="../../../view/media/img/interfaces/user_icon.png" alt="Usuario">
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

    <!-- MAIN -->
    <div class="main-container">
        

        <!-- Formulario para crear conciertos -->
        <section class="section">
            <h2>Crear Nuevo Concierto</h2>
            <hr/>
            <form method="post" class="concert-form">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Nombre del evento" required />
                    <input type="text" name="location" placeholder="Ubicación" required />
                </div>
                <div class="form-group">
                    <input type="date" name="date" required min="<?= date('Y-m-d'); ?>"/>
                    <input type="time" name="time" required/>
                    <input type="number" name="price" placeholder="Precio (€)" step="0.01" min="0.01" required/>
                </div>
                <div class="form-group">
                    <select name="id_artist" required>
                        <option value="">Seleccionar Artista</option>
                        <?php foreach ($artists as $artist) { ?>
                            <option value="<?php echo $artist['id_artist']; ?>">
                                <?php echo htmlspecialchars($artist['name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" name="create" class="primary-button">Publicar Concierto</button>
            </form>
        </section>

        <!-- Sección para mostrar conciertos -->
        <section class="section">
            <h2>Conciertos Programados</h2>
            <hr>

            <!-- Tabla de conciertos -->
            <table>
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Lugar</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Precio (€)</th>
                        <th>Artista</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($concerts)) { ?>
                        <tr>
                            <td colspan="7">No hay conciertos para mostrar.</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($concerts as $concert) { ?>
                            <?php 
                            $artista = $concertController->getArtistById($concert['id_artist']);
                            $nombre_artista = $artista ? htmlspecialchars($artista['name']) : 'Sin artista';

                            // Mira cada fila, si el ID concuerda con el $_GET['edit'], muestra en la fila un formulario de actualizar
                            $isEditing = false;
                            if (isset($_GET['edit']) && $_GET['edit'] == $concert['id_concert']) {
                                $isEditing = true;
                            }
                            ?>
                            <!-- Si se clica en "Editar", la fila cambia de estar en forma de ver a salir un formulario para actualizar los datos -->
                            <?php if ($isEditing) { ?>
                                <!-- Formulario de edición (Se coloca en la fila del registro) -->
                                <!-- Cada campo tiene de valor predeterminado el que tiene actualmente -->
                                <tr>
                                    <td colspan="7">
                                        <form method="post" class="concert-form">
                                            <div class="form-group">
                                                <input type="hidden" name="id_concert" value="<?php echo $concert['id_concert']; ?>">
                                                <input type="text" name="name" value="<?php echo htmlspecialchars($concert['name']); ?>" required />
                                                <input type="text" name="location" value="<?php echo htmlspecialchars($concert['location']); ?>" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="date" name="date" value="<?php echo $concert['date']; ?>" required min="<?php echo date('Y-m-d'); ?>" />
                                                <input type="time" name="time" value="<?php echo $concert['time']; ?>" required />
                                                <input type="number" name="price" value="<?php echo $concert['price']; ?>" step="0.01" min="0.01" required />
                                            </div>
                                            <div class="form-group">
                                                <select name="id_artist" required>
                                                    <option value="">Seleccionar Artista</option>
                                                    <?php foreach ($artists as $artist) { ?>
                                                        <option value="<?php echo $artist['id_artist']; ?>" <?php echo $artist['id_artist'] == $concert['id_artist'] ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($artist['name']); ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="update" class="primary-button">Guardar Cambios</button>
                                            <a href="dashboard.php" class="cancel-button">Cancelar</a>
                                        </form>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <!-- Filas de la tabla en estado normal -->
                                <tr>
                                    <td><?php echo htmlspecialchars($concert['name']); ?></td>
                                    <td><?php echo htmlspecialchars($concert['location']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($concert['date'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($concert['time'])); ?></td>
                                    <td><?php echo number_format($concert['price'], 2); ?></td>
                                    <td><?php echo $nombre_artista; ?></td>
                                    <td>
                                        <!-- Botón para editar (Da el ID del artista al $_GET['edit']) -->
                                        <a href="dashboard.php?edit=<?php echo $concert['id_concert']; ?>" class="edit-button">Editar</a>
                                        <!-- Botón para eliminar -->
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="delete" value="<?php echo $concert['id_concert']; ?>">
                                            <button type="submit" class="delete-button" onclick="return confirm('¿Quieres eliminar este concierto?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>

    <footer id="footer">
        <div class="footer-logo">
            <img src="../../media/img/interfaces/logo_footer.png" alt="TicketsNow logo footer">
        </div>
        <div class="footer-links">
            <div class="footer-column">
                <h3>Email</h3>
                <a href="mailto:ticketsnow_official@gmail.com">ticketsnow_official@gmail.com</a>
            </div>
            <div class="footer-column">
                <h3>Telefono</h3>
                <a href="tel:+34666666666">+34 666 66 66 66</a>
            </div>
        </div>
    </footer>
</body>

</html>