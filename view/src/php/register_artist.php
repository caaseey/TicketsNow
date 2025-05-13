<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/../../../controller/UserController.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();
    $result = $userController->registerArtist($_POST);

    $success = $result === true ? "Registro exitoso. ¡Ya puedes iniciar sesión!" : "";
    $error = $result !== true ? $result : "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Artista | Tickets Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <header class="navbar logo-only">
        <div class="logo">
            <a href="../../../view">
                <img src="../../media/img/interfaces/logo.png" alt="Logo Tickets Now">
            </a>
        </div>
    </header>

    <section class="container">
        <div class="form-container">
            <h2>Regístrate como Artista</h2>
            <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>

            <?php if ($error): ?>
                <div class="error"><?= $error ?></div>
            <?php elseif ($success): ?>
                <div class="success"><?= $success ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="input-group">
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="input-group">
                    <input type="text" name="apellido" placeholder="Apellido" required>
                </div>

                <div class="buttons">
                    <button type="submit" class="button">Registrar</button>
                </div>

                <div class="extra-buttons">
                    <a href="register_user.php">Registrarse como Usuario</a>
                    <a href="register_admin.php">Registrarse como Admin</a>
                </div>
            </form> 
        </div>

        <div class="image-container">
            <img src="../../media/img/interfaces/concierto.png" alt="Experiencia musical">
        </div>
    </section>
</body>
</html>
