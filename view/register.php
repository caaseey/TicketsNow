<?php
session_start();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $pais = trim($_POST['pais']);
    $zip = trim($_POST['zip']);

    // Validación de campos vacíos y formato
    if (empty($email) || empty($password) || empty($nombre) || empty($apellido) || empty($pais) || empty($zip)) {
        $error = 'Todos los campos son obligatorios';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Formato de email inválido';
    } elseif (!preg_match('/^\d{4,10}$/', $zip)) {
        $error = 'Código postal inválido';
    } else {
        // Comprobamos que el email NO esté ya registrado
        $users = @file('users.dat', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        foreach ($users as $user) {
            $data = explode('||', $user);
            // $data[0] es el email guardado
            if ($data[0] === $email) {
                $error = 'El email ya está registrado';
                break;
            }
        }

        // Si no hay error después de la comprobación, guardamos el nuevo usuario
        if (empty($error)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $user_data = implode('||', [
                $email,
                $hashed_password,
                $nombre,
                $apellido,
                $pais,
                $zip
            ]) . "\n";
            
            if (file_put_contents('users.dat', $user_data, FILE_APPEND | LOCK_EX)) {
                $_SESSION['registered'] = true;
                $success = 'Registro exitoso! Redirigiendo...';
                // Redirigir tras 2 segundos
                header('Refresh: 2; URL=login.php');
            } else {
                $error = 'Error al guardar los datos';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | Tickets Now</title>
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
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('img/fondo.png') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        header {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        header a img {
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

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--accent-color);
            animation: progress-bar 2s ease-in-out;
        }

        @keyframes progress-bar {
            0% { width: 0; }
            100% { width: 100%; }
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
            position: relative;
        }

        .image-container:hover {
            transform: scale(1.02);
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.9);
        }

        h2 {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            transition: width 0.3s ease;
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
            transition: all var(--transition-speed) ease;
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
            position: relative;
            overflow: hidden;
        }

        .button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: translate(-50%, -50%) rotate(45deg);
            transition: all 0.5s ease;
        }

        .button:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }

        .button:hover::after {
            transform: translate(50%, 50%) rotate(45deg);
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

        .success {
            background: #e8f9f5;
            color: #009879;
            padding: 12px;
            border-radius: 8px;
            margin: 1rem 0;
            border: 1px solid #b8f2e6;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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
                    <input type="text" name="nombre" placeholder="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo se permiten letras y espacios" required>
                </div>
                <div class="input-group">
                    <input type="text" name="apellido" placeholder="Apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo se permiten letras y espacios" required>
                </div>
                <div class="input-group">
                    <input type="text" name="pais" placeholder="País de residencia" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo se permiten letras y espacios" required>
                </div>
                <div class="input-group">
                    <input type="text" name="zip" placeholder="Código Postal" pattern="\d{4,10}" title="Debe contener entre 4 y 10 dígitos" required>
                </div>
                <button type="submit" class="button">Registrar</button>
            </form>
        </div>
        <div class="image-container">
            <img src="img/concierto.jpg" alt="Experiencia musical">
        </div>
    </section>
</body>
</html>
