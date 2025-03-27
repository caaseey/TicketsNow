<?php
// Inicia la sesión si no está iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verifica si el user ha iniciado sesión
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Recogemos los datos desde la sesión
$name = $_SESSION['user_name'] ?? '';
$surname = $_SESSION['user_surname'] ?? '';
$email = $_SESSION['user_email'] ?? ''; // Solo si decides guardarlo también
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
    </header>

    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="img/interfaces/user_icon.png" alt="Foto de perfil">
            <h3><?php echo htmlspecialchars($name); ?></h3>
        </div>

        <div class="profile-info">
            <h2>Mi perfil</h2>

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

</body>

</html>