<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/../../../controller/UserController.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UserController = new UserController();
    $error = $UserController->login();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Iniciar Sesión | Tickets Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/login.css">
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
        <h2>Iniciar Sesión</h2>
        <p>¿Nuevo en Tickets Now? <a href="register_user.php">Crear cuenta</a></p>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Contraseña" required>
                <span class="show-password" onclick="togglePassword()">MOSTRAR</span>
            </div>

            <div class="buttons">
                <button type="submit" class="button">Acceder</button>
            </div>

            <div class="links">
                <p><a href="forgot_password.php">¿Olvidaste tu contraseña?</a></p>
            </div>
        </form>
    </div>

    <div class="image-container">
        <img src="../../media/img/interfaces/concierto.png" alt="Experiencia musical">
    </div>
</section>

<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";
}
</script>

</body>
</html>
