<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once __DIR__ . '/../../../controller/UserController.php';

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $newPassword = $_POST["password"] ?? '';
    $confirm = $_POST["confirm_password"] ?? '';

    if (empty($newPassword) || empty($confirm)) {
        $error = "Ambos campos son obligatorios.";
    } elseif ($newPassword !== $confirm) {
        $error = "Las contraseñas no coinciden.";
    } else {
        $controller = new UserController();
        $controller->updatePassword($_SESSION['reset_email'], $newPassword);
        unset($_SESSION['reset_email']);
        header("Location: login.php");
        exit();
    }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Establecer nueva contraseña</title>
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
            <h2>Establecer nueva contraseña</h2>

            <?php if (!empty($error)): ?>
                <div class="error"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="input-group">
                    <input type="password" name="password" placeholder="Nueva contraseña" required>
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required>
                </div>
                <button type="submit" class="button">Actualizar contraseña</button>
            </form>
        </div>
        <div class="image-container">
            <img src="../../media/img/interfaces/concierto.png" alt="Concierto">
        </div>
    </section>
</body>
</html>
