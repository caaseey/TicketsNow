<?php
// Inicia la sesión solo si no está iniciada
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UserController = new UserController();
    $result = $UserController->register();

    // Si register() devuelve un mensaje de éxito o error
    if ($result === true) {
        $success = "Registro exitoso. ¡Ya puedes iniciar sesión!";
    } else {
        $error = $result; // en caso de que devuelva un string con error
    }
}
?>