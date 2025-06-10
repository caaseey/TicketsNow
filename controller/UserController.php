<?php
class UserController
{
    private $conn;

    public function __construct()
    {
        try {
            // Conectar sin base de datos primero
            $pdo = new PDO("mysql:host=localhost", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crear la base de datos si no existe
            $pdo->exec("CREATE DATABASE IF NOT EXISTS ticketsnow");

            // Ahora conectar a la base de datos
            $this->conn = new PDO("mysql:host=localhost;dbname=ticketsnow", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crear tabla users si no existe (opcional)
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS users (
                    id_user INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    name VARCHAR(100),
                    surname VARCHAR(100),
                    surname2 VARCHAR(100),
                    id_role INT,
                    profile_photo VARCHAR(255)
                )
            ");
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }


    public function login(): string
    {
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";

            if (empty($email) || empty($password)) {
                return "Todos los campos son obligatorios.";
            }

            $stmt = $this->conn->prepare("SELECT id_user, name, surname, id_role, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_surname'] = $user['surname'];
                $_SESSION['user_surname2'] = $user['surname2'];
                $_SESSION['user_email'] = $email;
                $_SESSION['id_role'] = $user['id_role'];

                header("Location: ./profile.php");
                exit;
            }

            $error = "Email o contraseña incorrectos.";
        }

        return $error;
    }

    public function emailExists($email): bool
    {
        $stmt = $this->conn->prepare("SELECT id_user FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    public function updatePassword($email, $newPassword): void
    {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashed, $email]);
    }

    public function logout(): void {}

    public function registerUser($data)
    {
        return $this->register($data, 1);
    }

    public function registerArtist($data)
    {
        return $this->register($data, 2);
    }

    public function registerAdmin($data)
    {
        return $this->register($data, 3);
    }

    // Hice el merge muy mal perdon, a la siguiente lo hare mejor pero no me di cuenta que estaba en otra rama
    private function register($data, $role_id)
    {
        if (
            empty($data['email']) ||
            empty($data['password']) ||
            empty($data['nombre']) ||
            empty($data['apellido']) ||
            empty($data['apellido2'] ?? '') // apellido2 es opcional
        ) {
            return "Todos los campos son obligatorios.";
        }

        $email = $data['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "El correo electrónico no es válido.";
        }
        $password = $data['password'];
        $pattern = "/^(?=.*\d)[a-zA-Z]{6}\d?|\d[a-zA-Z]{6}$/"; // He usado el chatgpt para el regex ya que no soy experto en regex
        // Verificamos con un if que la contraseña sea válida con el patron del regex que hemos usado antes
        if (!preg_match($pattern, $password)) { // si no coincide con el patrón
            return "La contraseña debe contener exactamente 6 letras seguidas de 1 dígito."; //return de un mensaje de error
        } // si la contraseña es válida, la hasheamos
        $password = password_hash($password, PASSWORD_DEFAULT);
        $name = $data['nombre'];
        $surname = $data['apellido'];
        $surname2 = $data['apellido2'] ?? ''; // apellido2 es opcional
        $profilePhoto = '';

        try {
            $check = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $check->execute([$email]);

            if ($check->fetchColumn() > 0) {
                return "El correo electrónico ya está registrado.";
            }

            $stmt = $this->conn->prepare("INSERT INTO users (email, password, name, surname, surname2, id_role, profile_photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$email, $password, $name, $surname, $surname2, $role_id, $profilePhoto]);

            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            return "Error al registrar: " . $e->getMessage();
        }
    }

    public function deleteUser($id_user)
    {
        try {
            // Obtener la foto actual del usuario
            $stmt = $this->conn->prepare("SELECT profile_photo FROM users WHERE id_user = ?");
            $stmt->execute([$id_user]);
            $photo = $stmt->fetchColumn();

            // Eliminar usuario
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id_user = ?");
            $stmt->execute([$id_user]);

            // Eliminar foto si no es la predeterminada
            $defaultPhoto = '../../media/img/Interfaces/user_icon.png';
            if ($photo && $photo !== $defaultPhoto) {
                $filePath = __DIR__ . '/../../' . str_replace('../', '', $photo);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Destruir sesión
            session_start();
            session_destroy();

            header("Location: login.php");
            exit();
        } catch (PDOException $e) {
            die("Error al eliminar el usuario: " . $e->getMessage());
        }
    }
}
