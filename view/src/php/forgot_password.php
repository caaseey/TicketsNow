<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/../../../controller/UserController.php';

$error = $success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    if (empty($email)) {
        $error = "Por favor, introduce tu correo electrónico.";
    } else {
        $controller = new UserController();
        if ($controller->emailExists($email)) {
            $_SESSION['reset_email'] = $email;
            header('Location: reset_password.php');
            exit;
        } else {
            $error = "❌ El correo no está registrado.";
        }
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <header class="navbar logo-only">
        <div class="logo">
            <a href="../../../view">
                <img src="../../media/img/interfaces/logo.png" alt="Tickets Now">
            </a>
        </div>
    </header>
    <section class="container">
        <div class="form-container">
            <h2>¿Olvidaste tu contraseña?</h2>
            <p>Introduce tu correo y te dejaremos cambiar tu contraseña si existe.</p>

            <?php if (!empty($error)): ?>
                <div class="error"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Tu correo" required>
                </div>
                <button type="submit" class="button">Continuar</button>
                <div class="links">
                    <a href="login.php">Volver al inicio de sesión</a>
                </div>
            </form>
        </div>
        <div class="image-container">
            <img src="../../media/img/interfaces/concierto.png" alt="Concierto">
        </div>
    </section>
</body>
</html>
