<?php

// inicia la sesión si no está iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verifica si el user ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header('Location: loginUser.php');
    exit();
}
$user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuarios | Tickets Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgba(77, 106, 141, 1);
            --accent-color: rgba(77, 106, 141, 1);
            --text-dark: rgba(45, 52, 54, 1);
            --background-light: #fdfcef;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background-light);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 2rem;
            max-width: 800px;
            width: 90%;
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .profile-sidebar {
            text-align: center;
        }

        .profile-sidebar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-sidebar h3 {
            color: var(--primary-color);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .profile-form {
            flex: 1;
        }

        h2 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
            display: inline-block;
            padding-bottom: 5px;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .button {
            background: var(--primary-color);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            transition: 0.3s;
            margin-top: 10px;
        }

        .button:hover {
            background: var(--accent-color);
        }
    </style>
</head>

<body>
    <header>
        <a href="login.php">
            <img src="img/Interfaces/logo.png" alt="Logo Tickets Now">
        </a>
    </header>
    <body>
    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="img/Interfaces/avatar.png" alt="Foto de perfil">
            <h3><?php echo htmlspecialchars($user['name']); ?></h3>
        </div>
        <div class="profile-form">
            <h2>Mi perfil</h2>
            <form method="post" action="updateProfile.php">
                <div class="input-group">
                    <label>Nombre</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="input-group">
                    <label>Apellido</label>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname'] ?? ''); ?>">
                </div>
                <button type="submit" class="button">Actualizar</button>
            </form>
            <form method="post" action="updatePassword.php">
                <div class="input-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
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
</body>
</html>