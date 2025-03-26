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
    <title>Iniciar Sesión | Tickets Now</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <header>
        <a href="dashboard.php">
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
            <img src="img/interfaces/concierto.png" alt="Experiencia musical">
        </div>
    </section>
</body>

</html>