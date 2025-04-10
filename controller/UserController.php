<?php
class UserController
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "ticketsnow");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
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

            $stmt = $this->conn->prepare("SELECT id_user, name, surname, id_role FROM users WHERE email = ? AND password = ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                $_SESSION['logged_in'] = true;
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_surname'] = $user['surname'];
                $_SESSION['user_email'] = $email;
                $_SESSION['id_role'] = $user['id_role'];

                header("Location: ./profile.php");
                exit;
            } else {
                $error = "Email o contraseña incorrectos.";
            }

            $stmt->close();
        }

        return $error;
    }

    public function logout(): void {}
    public function register()
    {
        if (
            empty($_POST['email']) || empty($_POST['password']) ||
            empty($_POST['nombre']) || empty($_POST['apellido'])
        ) {
            return "Todos los campos son obligatorios.";
        }

        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        // Aquí conecta a la base de datos y guarda al nuevo usuario
        $db = new PDO("mysql:host=localhost;dbname=ticketsnow", "root", "");
        $stmt = $db->prepare("INSERT INTO users (email, password, nombre, apellido) VALUES (?, ?, ?, ?)");

        try {
            $stmt->execute([$email, $password, $nombre, $apellido]);
            return true;
        } catch (PDOException $e) {
            return "Error al registrar: " . $e->getMessage();
        }
    }
}
