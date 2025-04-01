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

// 👇 Procesar la foto si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_photo"])) {
    $targetDir = "img";
    $fileName = basename($_FILES["profile_photo"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $targetFile)) {
        $stmt = $pdo->prepare("UPDATE users SET profile_photo = :photo WHERE id_user = :id");
        $stmt->execute([':photo' => $targetFile, ':id' => $id_user]);
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
$photo = $user['profile_photo'] ?: 'img/Interfaces/user_icon.png';
$role = $user['id_role'];
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Mi perfil | Tickets Now</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/profileuser.css">
</head>

<body>

    <header class="main-header">
        <a href="index.php" class="logo">
            <img src="img/Interfaces/logo.png" alt="Logo Tickets Now">
        </a>

        <div class="profile-dropdown">
            <button class="profile-toggle" onclick="toggleProfileMenu()">
                <div class="menu-icon">
                    <span></span><span></span><span></span>
                </div>
                <img src="img/Interfaces/user_icon.png" alt="Usuario">
            </button>

            <div class="profile-menu" id="profileMenu">
                <ul>
                    <li><a href="profile.php">Mi perfil</a></li>
                    <li>
                        <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Cerrar
                            sesión</a>
                        <form id="logoutForm" action="logout.php" method="post" style="display:none;"></form>
                    </li>
                    <hr>
                    <li><a href="help.php">Ayuda</a></li>
                    <li><a href="about.php">Sobre nosotros</a></li>
                    <li><a href="#footer">Contacto</a></li>
                </ul>
            </div>
        </div>
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

        document.addEventListener("click", function (e) {
            const dropdown = document.querySelector(".profile-dropdown");
            const menu = document.getElementById("profileMenu");
            if (!dropdown.contains(e.target)) {
                menu.style.display = "none";
            }
        });
    </script>

</body>

</html>