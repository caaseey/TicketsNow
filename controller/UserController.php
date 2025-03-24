<?php
    session_start();

    class UserController
    {
 
        private $conn;

        //Constructor de la clase
        public function __construct()
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ticketsnow";
 
            $this->conn = new mysqli($servername, $username, $password, $dbname);
           
            // Check connection
            if ($this->conn->connect_error)
            {
                die("Connection failed: " . $this->conn->connect_error);
            }
            echo "Connection Succesfully";
        }

        //Método de login
        public function login(): void 
        {
            //Recoge la información del formulario POST
            $email = $_POST["email"];
            $password = $_POST["password"];
 
            //Lanzamos el SELECT a la base de datos
            $stmt = $this->conn->prepare(query: "SELECT email, password FROM users WHERE email=? AND password=?");
            $stmt->bind_param( "ss", $email, $password);
            $stmt->execute();
       
            if ($stmt->fetch()) 
            {
                //Guardamos en $_SESSION que ya está logueado en la web
                $_SESSION["logged"] = true;
                $_SESSION["email"] = $email;

                //Cerramos la conexión con la base de datos
                $this->conn->close();
 
                //Redirección a la página de perfil después de loguearse
                header(header: "Location: ../view/profile.php"); //TO-DO Igual hay que cambiar la ruta del fichero del perfil de usuario
                exit();
            }
        }
 
        //Método de loguot
        public function logout(): void 
        {
            //TO-DO
        }
        
        //Método de register
        public function register(): void 
        {
            //TO-DO
        }
    }
?>