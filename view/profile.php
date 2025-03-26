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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuarios | Tickets Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ... CSS igual al que ya tenías ... */
    </style>
</head>

<body>
    <header>
        <a href="login.php">
            <img src="img/Interfaces/logo.png" alt="Logo Tickets Now">
        </a>
    </header>
    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="img/Interfaces/avatar.png" alt="Foto de perfil">
            <h3><?php echo htmlspecialchars($name); ?></h3>
        </div>
        <div class="profile-form">
            <h2>Mi perfil</h2>
            <form method="post" action="updateProfile.php">
                <div class="input-group">
                    <label>Nombre</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="input-group">
                    <label>Apellido</label>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($surname); ?>">
                </div>
                <button type="submit" class="button">Actualizar</button>
            </form>
            <form method="post" action="updatePassword.php">
                <div class="input-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="input-group">
                    <label>Contraseña</label>
                    <input type="password" name="password">
                </div>
                <button type="submit" class="button">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>
