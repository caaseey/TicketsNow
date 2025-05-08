<?php
session_start();

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['id_user'])) {
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_photo"])) {
    $targetDir = __DIR__ . '/../../media/img/profile_pictures/';
    $fileName = time() . '_' . basename($_FILES["profile_photo"]["name"]);
    $targetFile = $targetDir . $fileName;

    // Crear directorio si no existe
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Validación básica del tipo MIME (puedes mejorarla si quieres)
    $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($_FILES["profile_photo"]["type"], $validMimeTypes)) {
        die("Tipo de archivo no permitido.");
    }

    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
        // Obtener la ruta de la foto anterior
        $stmt = $pdo->prepare("SELECT profile_photo FROM users WHERE id_user = :id");
        $stmt->execute([':id' => $id_user]);
        $oldPhoto = $stmt->fetchColumn();

        // Eliminar si no es la imagen por defecto
        $defaultPhoto = '../../media/img/Interfaces/user_icon.png';
        if ($oldPhoto && $oldPhoto !== $defaultPhoto) {
            $oldFilePath = __DIR__ . '/../../' . str_replace('../', '', $oldPhoto);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Guardar la nueva ruta relativa
        $relativePath = '../../media/img/profile_pictures/' . $fileName;
        $stmt = $pdo->prepare("UPDATE users SET profile_photo = :photo WHERE id_user = :id");
        $stmt->execute([':photo' => $relativePath, ':id' => $id_user]);
        $photo = $relativePath;
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id");
$stmt->execute([':id' => $id_user]);
$user = $stmt->fetch();

if (!$user) {
    die("Usuario no encontrado.");
}

$name = $user['name'];
$surname = $user['surname'];
$email = $user['email'];
$photo = $user['profile_photo'] ?: '../../media/img/Interfaces/user_icon.png';
$role = $user['id_role'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Mi perfil | Tickets Now</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>

    <header class="main-header">
        <!-- NAVBAR -->
        <nav class="navbar">
            <div>
                <a href="#" class="logo">
                    <img src="../../media/img/interfaces/logo.png" alt="Tickets Now">
                </a>
            </div>
            <div class="account-menu">
                <button class="account-button">
                    <div class="account-icon">
                        <hr>
                        <hr>
                        <hr>
                    </div>
                    <div class="account-picture">
                        <img src="../view/media/img/interfaces/user_icon.png" alt="Usuario">
                    </div>
                </button>
                <div class="account-dropdown-menu">
                    <ul>
                        <?php
                        if (isset($_SESSION['logged_in'])) {
                            echo "<li><a href='profile.php'>Mi perfil</a></li>";
                        } else {
                            echo "<li><a href='../view/src/php/login.php'>Iniciar sesión</a></li>";
                            echo "<li><a href='../view/src/php/register_user.php'>Regístrate</a></li>";
                        }
                        ?>
                        <hr>
                        <li><a href="../view/src/html/work_in_progress.html">Ayuda</a></li>
                        <li><a href="../view/src/html/work_in_progress.html">Sobre nosotros</a></li>
                        <li><a href="../view/src/html/work_in_progress.html">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="<?php echo htmlspecialchars($photo); ?>" alt="Foto de perfil">
            <h3><?php echo htmlspecialchars($name); ?></h3>
        </div>
        <div class="profile-info">
            <h2>👤 Mi perfil</h2>
            <hr style="border: none; border-top: 1px solid #ddd; margin-bottom: 20px;">

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

            <?php if ($role == 3): ?>
                <form action="profile.php" method="post" enctype="multipart/form-data">
                    <div class="info-group">
                        <label>Cambiar foto de perfil</label>
                        <input type="file" name="profile_photo" accept="image/*" required>
                    </div>
                    <button type="submit" class="profile-update-btn">Actualizar foto</button>
                </form>
            <?php endif; ?>


        </div>
    </div>

    <script>
        function toggleProfileMenu() {
            const menu = document.getElementById("profileMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        document.addEventListener("click", function(e) {
            const dropdown = document.querySelector(".profile-dropdown");
            const menu = document.getElementById("profileMenu");
            if (!dropdown.contains(e.target)) {
                menu.style.display = "none";
            }
        });
    </script>

</body>

</html>
