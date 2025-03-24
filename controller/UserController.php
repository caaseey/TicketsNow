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

    /**
     * Método de login usando archivo "users.dat"
     * Retorna un string con el mensaje de error, o vacío si no hay error.
     */
    public function login(): string
    {
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";

            if (empty($email) || empty($password)) {
                $error = "Todos los campos son obligatorios.";
            } else {
                // Buscar usuario en archivo
                $users = @file('users.dat', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];

                foreach ($users as $user) {
                    $data = explode('||', $user);
                    // data[0] = email
                    // data[1] = password hash (BCRYPT u otro) -- no texto plano
                    // data[2] = nombre
                    // data[3] = apellido (opcional)

                    // Verificamos que coincida el email y la contraseña (password_verify con hash)
                    if ($data[0] === $email && password_verify($password, $data[1])) {
                        // Usuario válido
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user_name'] = $data[2];

                        // Redirigimos al index o a donde gustes
                        header("Location: index.php");
                        exit;
                    }
                }

                // Si llega aquí, es que no coincidió con ningún registro del archivo
                $error = "Email o contraseña incorrectos.";
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