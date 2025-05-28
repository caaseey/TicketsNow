<?php
session_start();
require_once '../../../controller/ConcertController.php';
$concertController = new ConcertController();

// Check admin role
if (empty($_SESSION['logged_in']) || ($_SESSION['id_role'] ?? 0) != 3) {
    header("Location: ../../../view/index.php");
    exit;
}

// Generate CSRF token if not set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Function to check CSRF token and handle errors
function checkCsrf()
{
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "CSRF token validation failed";
        header("Location: dashboard.php");
        exit;
    }
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    checkCsrf();

    try {
        if (isset($_POST['create'])) {
            // Manejo de la subida de la foto
            if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Debes subir una foto para el concierto.");
            }
            $photoName = uniqid() . '_' . basename($_FILES['photo']['name']);
            $photoPath = '../../../media/concerts/' . $photoName;
            $photoDbPath = 'media/concerts/' . $photoName;
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/../../../' . $photoDbPath)) {
                throw new Exception("Error al guardar la foto.");
            }

            $concertController->createConcert(
                trim($_POST['name']),
                trim($_POST['location']),
                $_POST['date'],
                floatval($_POST['price']),
                $photoDbPath // Nuevo parámetro para la foto
            );
            $_SESSION['success'] = "Concierto creado correctamente";
        } elseif (isset($_POST['update'])) {
            // Para editar, la foto es opcional
            $photoDbPath = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photoName = uniqid() . '_' . basename($_FILES['photo']['name']);
                $photoPath = '../../../media/concerts/' . $photoName;
                $photoDbPath = 'media/concerts/' . $photoName;
                if (!move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/../../../' . $photoDbPath)) {
                    throw new Exception("Error al guardar la foto.");
                }
            }
            $concertController->updateConcert(
                intval($_POST['id_concert']),
                trim($_POST['name']),
                trim($_POST['location']),
                $_POST['date'],
                floatval($_POST['price']),
                $photoDbPath // Nuevo parámetro para la foto (puede ser null)
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

// Get all concerts
$concerts = $concertController->getAllConcerts();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../../view/src/css/index.css" />
    <title>Admin Dashboard - TicketsNow</title>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div>
            <a href="../../../" class="logo">
                <img src="../../../view/media/img/interfaces/logo.png" alt="Tickets Now">
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

    <div class="admin-container">
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <section class="admin-section">
            <h2>Crear Nuevo Concierto</h2>
            <hr />
            <form method="post" class="concert-form" enctype="multipart/form-data" onsubmit="return validateForm(this)">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <div class="form-group">
                    <input type="text" name="name" placeholder="Nombre del evento" required />
                    <input type="text" name="location" placeholder="Ubicación" required />
                </div>
                <div class="form-group">
                    <input type="date" name="date" required min="<?= date('Y-m-d') ?>" />
                    <input type="number" name="price" placeholder="Precio (€)" step="0.01" min="0.01" required />
                    <input type="file" name="photo" accept="image/*" required />
                </div>
                <button type="submit" name="create" class="primary-button">Publicar Concierto</button>
            </form>
        </section>

        <section class="admin-section">
            <h2>Conciertos Programados</h2>
            <hr />
            <div class="concerts-grid">
                <?php foreach ($concerts as $concert): ?>
                    <div class="concert-card">
                        <?php if (!empty($concert['photo'])): ?>
                            <img src="../../../<?= htmlspecialchars($concert['photo']) ?>" alt="Foto del concierto" class="concert-photo" />
                        <?php endif; ?>
                        <div class="concert-info">
                            <h3><?= htmlspecialchars($concert['name']) ?></h3>
                            <p class="concert-location"><?= htmlspecialchars($concert['location']) ?></p>
                            <div class="concert-details">
                                <p><?= date('d M Y', strtotime($concert['date'])) ?></p>
                                <p class="concert-price"><?= number_format($concert['price'], 2) ?> €</p>
                            </div>
                        </div>
                        <div class="concert-actions">
                            <button class="edit-button" onclick="openEditModal(
                        <?= $concert['id_concert'] ?>,
                        '<?= htmlspecialchars($concert['name'], ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($concert['location'], ENT_QUOTES) ?>',
                        '<?= $concert['date'] ?>',
                        <?= $concert['price'] ?>
                    )">Editar</button>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                                <input type="hidden" name="delete" value="<?= $concert['id_concert'] ?>" />
                                <button type="submit" class="delete-button" onclick="return confirm('¿Eliminar concierto?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <div id="editModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-button" onclick="closeEditModal()">&times;</span>
            <h2>Editar Concierto</h2>
            <form method="post" class="concert-form" enctype="multipart/form-data" onsubmit="return validateForm(this)">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
                <input type="hidden" name="id_concert" id="edit-id" />
                <div class="form-group">
                    <input type="text" name="name" id="edit-name" placeholder="Nombre del evento" required />
                    <input type="text" name="location" id="edit-location" placeholder="Ubicación" required />
                </div>
                <div class="form-group">
                    <input type="date" name="date" id="edit-date" required min="<?= date('Y-m-d') ?>" />
                    <input type="number" name="price" id="edit-price" placeholder="Precio (€)" step="0.01" min="0.01" required />
                    <input type="file" name="photo" accept="image/*" />
                </div>
                <button type="submit" name="update" class="primary-button">Actualizar Concierto</button>
            </form>
        </div>
    </div>

    <footer id="footer">
        <div class="footer-links">
            <div class="footer-column">
                <h3>Soporte</h3>
                <a href="mailto:soporte@ticketsnow.com">soporte@ticketsnow.com</a>
            </div>
            <div class="footer-column">
                <h3>Emergencias</h3>
                <a href="tel:+34987654321">+34 987 654 321</a>
            </div>
        </div>
        <div class="footer-bottom">© 2025 TicketsNow. Administración de contenidos.</div>
    </footer>

    <script>
        function validateForm(form) {
            const priceInput = form.querySelector('input[name="price"]');
            if (!priceInput || parseFloat(priceInput.value) <= 0) {
                alert("El precio debe ser mayor a 0");
                return false;
            }
            const photoInput = form.querySelector('input[name="photo"]');
            // Solo obligatorio en creación
            if (form.querySelector('button[name="create"]') && (!photoInput || !photoInput.value)) {
                alert("Debes subir una foto para el concierto.");
                return false;
            }
            return true;
        }

        function openEditModal(id, name, location, date, price) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-location').value = location;
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-price').value = price;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) closeEditModal();
        };
    </script>
</body>

</html>