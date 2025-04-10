<?php
// Inicia la sesión solo si no está iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../controller/UserController.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UserController = new UserController();
    $result = $UserController->register();

    // Si register() devuelve un mensaje de éxito o error
    if ($result === true) {
        $success = "Registro exitoso. ¡Ya puedes iniciar sesión!";
    } else {
        $error = $result; // en caso de que devuelva un string con error
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Tickets Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <header>
        <a href="index.php">
            <img src="img/interfaces/logo.png" alt="Logo Tickets Now">
        </a>
    </header>

    <section class="container">
        <div class="form-container">
            <h2>Regístrate</h2>
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
                    <input type="text" name="nombre" placeholder="Nombre" 
                           pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                           title="Solo se permiten letras y espacios" required>
                </div>
                <div class="input-group">
                    <input type="text" name="apellido" placeholder="Apellido" 
                           pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                           title="Solo se permiten letras y espacios" required>
                </div>
                <button type="submit" class="button">Registrar</button>
            </form>

            <div class="extra-buttons">
                <button type="button" class="button" 
                        onclick="window.location.href='registroArtista.php'">
                    ¿Eres artista? ¡Regístrate aquí!
                </button>
                <button type="button" class="button" 
                        onclick="window.location.href='loginAdmin.php'">
                    Entrar como administrador
                </button>
            </div>
        </div>

        <div class="image-container">
            <img src="img/interfaces/concierto.png" alt="Experiencia musical">
        </div>
    </section>
</body>
</html>
