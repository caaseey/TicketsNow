<?php
class ConcertController
{
    private $conn;

    public function __construct()
    {
        try {
            // Conexión inicial sin base de datos
            $pdo = new PDO("mysql:host=localhost", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crear la base de datos si no existe
            $pdo->exec("CREATE DATABASE IF NOT EXISTS ticketsnow");

            // Conexión a la base de datos
            $this->conn = new PDO("mysql:host=localhost;dbname=ticketsnow", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crear la tabla concerts si no existe (ahora con campo photo)
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS concerts (
                    id_concert INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    location VARCHAR(255) NOT NULL,
                    date DATE NOT NULL,
                    price DECIMAL(10,2) NOT NULL,
                    photo VARCHAR(255) NOT NULL
                )
            ");
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // CREATE
    public function createConcert($name, $location, $date, $price, $photo)
    {
        $stmt = $this->conn->prepare("INSERT INTO concerts (name, location, date, price, photo) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $location, $date, $price, $photo]);
    }

    // READ ALL
    public function getAllConcerts()
    {
        $stmt = $this->conn->query("SELECT * FROM concerts ORDER BY date ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ ONE
    public function getConcertById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM concerts WHERE id_concert = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function updateConcert($id, $name, $location, $date, $price, $photo = null)
    {
        if ($photo) {
            $stmt = $this->conn->prepare("UPDATE concerts SET name = ?, location = ?, date = ?, price = ?, photo = ? WHERE id_concert = ?");
            return $stmt->execute([$name, $location, $date, $price, $photo, $id]);
        } else {
            $stmt = $this->conn->prepare("UPDATE concerts SET name = ?, location = ?, date = ?, price = ? WHERE id_concert = ?");
            return $stmt->execute([$name, $location, $date, $price, $id]);
        }
    }

    // DELETE
    public function deleteConcert($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM concerts WHERE id_concert = ?");
        return $stmt->execute([$id]);
    }
}