<?php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Buscar usuario en archivo
        $users = @file('users.dat', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        $found = false;

        foreach ($users as $user) {
            $data = explode('||', $user);
            // data[0] = email
            // data[1] = password hash
            // data[2] = nombre
            // data[3] = apellido
            // ...

            if ($data[0] === $email && password_verify($password, $data[1])) {
                $_SESSION['logged_in'] = true;
                // Guardamos el nombre en vez del email
                $_SESSION['user_name'] = $data[2]; // <--- Aquí
                // Si también quieres el apellido:
                // $_SESSION['user_lastname'] = $data[3];

                header("Location: dashboard.php");
                exit;
            }
        }

        $error = "Email o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Tickets Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgba(77, 106, 141, 1);
            --accent-color:rgba(77, 106, 141, 1);
            --text-dark:rgba(45, 52, 54, 1);
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('img/fondo.png') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Header con el logo */
        header {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        header a img { /*hola*/
            width: 100px;
            transition: transform 0.3s ease;
        }

        header a img:hover {
            transform: scale(1.05);
        }

        .container {
            background: rgba(255, 255, 255, 0.98);
            padding: 2.5rem;
            display: flex;
            max-width: 900px;
            width: 95%;
            gap: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .form-container {
            flex: 1;
            padding-right: 2rem;
        }

        .image-container {
            flex: 1;
            border-radius: 15px;
            overflow: hidden;
            transition: transform var(--transition-speed) ease;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h2 {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group {
            position: relative;
            margin: 1.5rem 0;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            background: #f8f9fa;
        }

        input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 12px rgba(52, 152, 219, 0.25);
            background: white;
        }

        .button {
            background: var(--primary-color);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }

        .button:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }

        .error {
            background: #fee;
            color: #e74c3c;
            padding: 12px;
            border-radius: 8px;
            margin: 1rem 0;
            border: 1px solid #fad2d2;
            font-size: 0.95rem;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            25% {
                transform: translateX(-5px);
            }
            75% {
                transform: translateX(5px);
            }
        }

        .show-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
            font-size: 0.9em;
            font-weight: 500;
            transition: color var(--transition-speed) ease;
        }

        .show-password:hover {
            color: var(--accent-color);
        }

        .links {
            margin-top: 1.5rem;
            text-align: center;
        }

        a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            transition: color var(--transition-speed) ease;
        }

        a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                margin: 1rem;
                padding: 1.5rem;
            }
            .image-container {
                max-height: 200px;
            }
        }
    </style>
</head>

<body>
    <header>
        <a href="dashboard.php">
            <img src="img/logo.png" alt="Logo Tickets Now">
        </a>
    </header>

    <section class="container">
        <div class="form-container">
            <h2>Iniciar Sesión</h2>
            <p>¿Nuevo en Tickets Now? <a href="register.php">Crear cuenta</a></p>

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

                <button type="submit" class="button">Acceder</button>

                <div class="links">
                    <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                </div>
            </form>
        </div>

        <div class="image-container">
            <img src="img/concierto.jpg" alt="Experiencia musical">
        </div>
    </section>
</body>
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
</html>
