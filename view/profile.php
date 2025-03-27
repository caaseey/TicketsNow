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
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
        }

        header {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header img {
            height: 40px;
        }

        .profile-container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            display: flex;
            gap: 30px;
        }

        .profile-sidebar {
            width: 180px;
            text-align: center;
        }

        .profile-sidebar img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #4f73df;
            margin-bottom: 15px;
        }

        .profile-info {
            flex: 1;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .info-group {
            margin-bottom: 15px;
        }

        .info-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 4px;
            color: #555;
        }

        .info-group span,
        .info-group input {
            display: block;
            width: 100%;
            padding: 10px;
            background: #f0f0f0;
            border: none;
            border-radius: 6px;
            font-size: 15px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 14px;
            font-weight: 500;
            color: #4f73df;
            cursor: pointer;
        }
    </style>
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