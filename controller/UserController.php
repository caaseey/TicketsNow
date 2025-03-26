<?php

class UserController
{
    private $conn;

    // Constructor de la clase
    public function __construct()
    {
        // Solo necesitas la conexión si vas a usar la base de datos en otros métodos
        // (En este ejemplo, el login usa "users.dat", no la base de datos)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ticketsnow";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
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
                $error = "Todos los campos son obligatorios.";
            } else {
                // Consulta simple sin hash
                $stmt = $this->conn->prepare("SELECT id_user, name, surname FROM users WHERE email = ? AND password = ?");
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $user = $result->fetch_assoc();

                    // Usuario encontrado, iniciamos sesión
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $user['id_user'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_surname'] = $user['surname'];

                    // Redirección a perfil
                    header("Location: INTRODUCIR AQUI LA DIRECCIÓN");
                    exit;
                } else {
                    $error = "Email o contraseña incorrectos.";
                }

                $stmt->close();
            }
        }

        return $error;
    }

    

    // Método de logout (por implementar)
    public function logout(): void
    {
        //TO-DO
    }

    // Método de register (por implementar)
    public function register(): void
    {
        //TO-DO
    }
}