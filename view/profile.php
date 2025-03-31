<?php
session_start();

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ticketsnow;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$id_user = $_SESSION['id_user'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id");
$stmt->execute([':id' => $id_user]);
$user = $stmt->fetch();

if (!$user) {
    die("Usuario no encontrado.");
}

$name    = $user['name'];
$surname = $user['surname'];
$email   = $user['email'];
$role    = $user['id_role'];
$photo   = $user['profile_photo'] ?: 'img/interfaces/user_icon.png';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Mi perfil | Tickets Now</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/profileuser.css">
</head>
<body>
<header>
    <a href="index.php">
        <img src="img/Interfaces/logo.png" alt="Logo Tickets Now">
    </a>

    <!-- Boton de cerrar sesion -->
    <div class="account-menu">
        <button class="account-button">
            <div class="account-icon">
                <hr>
                <hr>
                <hr>
            </div>
            <div class="account-picture">
                <img src="img/Interfaces/user_icon.png" alt="Usuario">
            </div>
        </button>
        <div class="account-dropdown-menu">
            <ul>
                <?php
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session_start();
                }

                if (isset($_SESSION['logged_in'])) {
                    echo "<li><a href='profile.php'>Mi perfil</a></li>";
                    echo "
                        <li>
                            <form action='logout.php' method='post' style='margin: 0;'>
                                <button type='submit' style='
                                    background: none;
                                    border: none;
                                    color: inherit;
                                    font: inherit;
                                    cursor: pointer;
                                    padding: 0.75em;
                                    width: 100%;
                                    text-align: left;
                                '>Cerrar sesión</button>
                            </form>
                        </li>
                    ";
                }
                ?>
                <hr>
                <li><a href="help.php">Ayuda</a></li>
                <li><a href="about.php">Sobre nosotros</a></li>
                <li><a href="#footer">Contacto</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="profile-container">
    <div class="profile-sidebar">
        <img src="<?php echo htmlspecialchars($photo); ?>" alt="Foto de perfil">
        <h3><?php echo htmlspecialchars($name); ?></h3>
    </div>
    <div class="profile-info">
        <h2>Mi perfil</h2>
        <?php if ($role == 3): ?>
            <form action="updateAdminData.php" method="post" enctype="multipart/form-data">
                <div class="info-group">
                    <label>Nombre</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="info-group">
                    <label>Apellido</label>
                    <input type="text" name="surname" value="<?php echo htmlspecialchars($surname); ?>">
                </div>
                <div class="info-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="info-group">
                    <label>Nueva contraseña</label>
                    <input type="password" name="password" placeholder="Dejar en blanco si no cambia">
                </div>
                <div class="info-group">
                    <label>Foto de perfil</label>
                    <input type="file" name="profile_photo" accept="image/*">
                </div>
                <button type="submit" class="button">Guardar cambios</button>
            </form>
        <?php else: ?>
            <div class="info-group">
                <label>Nombre</label>
                <span><?php echo htmlspecialchars($name); ?></span>
            </div>
            <div class="info-group">
                <label>Apellido</label>
                <span><?php echo htmlspecialchars($surname); ?></span>
            </div>
            <div class="info-group">
                <label>Correo electrónico</label>
                <span><?php echo htmlspecialchars($email); ?></span>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
