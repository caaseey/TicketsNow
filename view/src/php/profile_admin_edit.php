<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['id_role'] != 3) {
    header('Location: login.php');
    exit();
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ticketsnow;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$id_user = $_SESSION['id_user'];
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$updatePassword = false;

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $updatePassword = true;
}

// Manejo de la imagen
$profile_photo_path = null;
if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['profile_photo']['tmp_name'];
    $file_name = basename($_FILES['profile_photo']['name']);
    $upload_dir = 'img/uploads/';

    // Validación de tipo MIME
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $file_type = mime_content_type($file_tmp);

    if (!in_array($file_type, $allowed_types)) {
        die("Error: El archivo debe ser una imagen JPEG, PNG o WebP.");
    }
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    $dest_path = $upload_dir . time() . '_' . $file_name;
    if (move_uploaded_file($file_tmp, $dest_path)) {
        $profile_photo_path = $dest_path;
    }
}

// Construir consulta
$sql = "UPDATE users SET name = :name, surname = :surname, email = :email";
$params = [
    ':name' => $name,
    ':surname' => $surname,
    ':email' => $email,
    ':id' => $id_user
];

if ($updatePassword) {
    $sql .= ", password = :password";
    $params[':password'] = $hashed_password;
}

if ($profile_photo_path) {
    $sql .= ", profile_photo = :photo";
    $params[':photo'] = $profile_photo_path;
}

$sql .= " WHERE id_user = :id";

$stmt = $pdo->prepare($sql);
if ($stmt->execute($params)) {
    // Actualizar datos en la sesión también
    $_SESSION['user_name'] = $name;
    $_SESSION['user_surname'] = $surname;
    $_SESSION['user_email'] = $email;

    header('Location: profile.php');
    exit();
} else {
    echo "Error al actualizar los datos.";
}
?>
