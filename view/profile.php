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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    HOLAAAA
</body>
</html>