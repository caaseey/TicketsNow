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
            
            // Crear la tabla artists si no existe 
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS artists (
                    id_artist INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL UNIQUE,
                    genre VARCHAR(100),
                    banner_image VARCHAR(255)
                )
            ");

            // Añadir artistas si no existía la tabla artistas
            $stmt = $this->conn->query("SELECT COUNT(*) FROM artists");

            $tableArtistsExisted = false;
            if ($stmt->fetchColumn() != 0) {
                $tableArtistsExisted = true;
            }

            if ($tableArtistsExisted == false) {
                $insertArtists = "
                    INSERT INTO artists (name, genre, banner_image) VALUES
                    ('ACDC', 'Rock', '../../media/img/concert_banners/acdc.jpg'),
                    ('Ado', 'J-Pop', '../../media/img/concert_banners/ado.jpg'),
                    ('aespa', 'K-Pop', '../../media/img/concert_banners/aespa.jpg'),
                    ('AURORA', 'Indie Pop', '../../media/img/concert_banners/aurora.jpg'),
                    ('Bruno Mars', 'Pop', '../../media/img/concert_banners/bruno_mars.jpg'),
                    ('Cuarteto de Nos', 'Rock Alternativo', '../../media/img/concert_banners/cuarteto_de_nos.jpg'),
                    ('Eladio Carrión', 'Reggaeton', '../../media/img/concert_banners/eladio_carrion.jpg'),
                    ('Imagine Dragons', 'Rock', '../../media/img/concert_banners/imagine_dragons.jpg'),
                    ('Kendrick Lamar', 'Hip-Hop', '../../media/img/concert_banners/kendrick_lamar.jpg'),
                    ('Keshi', 'Indie Pop', '../../media/img/concert_banners/keshi.jpg'),
                    ('KSI', 'Hip-Hop', '../../media/img/concert_banners/ksi.jpg'),
                    ('Laufey', 'Jazz Pop', '../../media/img/concert_banners/laufey.jpg'),
                    ('Marca Registrada', 'Regional Mexicano', '../../media/img/concert_banners/marca_registrada.jpg'),
                    ('Omar Courtz', 'Reggaeton', '../../media/img/concert_banners/omar_courtz.jpg'),
                    ('Swingrowers', 'Electro Swing', '../../media/img/concert_banners/swingrowers.jpg'),
                    ('SZA', 'R&B', '../../media/img/concert_banners/sza.jpg'),
                    ('The Weeknd', 'Pop/R&B', '../../media/img/concert_banners/the_weeknd.jpg'),
                    ('TWICE', 'K-Pop', '../../media/img/concert_banners/twice.jpg'),
                    ('YOASOBI', 'J-Pop', '../../media/img/concert_banners/yoasobi.jpg')
                ";
                $this->conn->exec($insertArtists);
            }

            // Crear la tabla concerts si no existe 
            $this->conn->exec("
                CREATE TABLE IF NOT EXISTS concerts (
                    id_concert INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    location VARCHAR(255) NOT NULL,
                    date DATE NOT NULL,
                    time TIME NOT NULL,
                    price DECIMAL(10,2) NOT NULL,
                    id_artist INT,
                    FOREIGN KEY (id_artist) REFERENCES artists(id_artist)
                )
            ");

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // CREATE
    public function createConcert($name, $location, $date, $time, $price, $id_artist)
    {
        $stmt = $this->conn->prepare("INSERT INTO concerts (name, location, date, time, price, id_artist) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $location, $date, $time, $price, $id_artist]);
    }

    // READ (Todos los conciertos y todos los artistas)--
    public function getAllConcerts()
    {
        $stmt = $this->conn->query("SELECT * FROM concerts ORDER BY date ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllArtists()
    {
        $stmt = $this->conn->query("SELECT * FROM artists ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (Todos los conciertos por artista)
    public function getConcertsByArtist($id_artist)
    {
        $stmt = $this->conn->prepare("SELECT * FROM concerts WHERE id_artist = ? ORDER BY date ASC");
        $stmt->execute([$id_artist]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getArtistByName($artistName)
    {
        $stmt = $this->conn->prepare("SELECT * FROM artists WHERE name = ?");
        $stmt->execute([$artistName]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getArtistByID($id_artist)
    {
        $stmt = $this->conn->prepare("SELECT * FROM artists WHERE id_artist = ?");
        $stmt->execute([$id_artist]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function updateConcert($id_concert, $name, $location, $date, $time, $price, $id_artist)
    {
        $stmt = $this->conn->prepare("UPDATE concerts SET name = ?, location = ?, date = ?, time = ?, price = ?, id_artist = ? WHERE id_concert = ?");
        return $stmt->execute([$name, $location, $date, $time, $price, $id_artist, $id_concert]);
    }

    // DELETE
    public function deleteConcert($id_concert)
    {
        $stmt = $this->conn->prepare("DELETE FROM concerts WHERE id_concert = ?");
        return $stmt->execute([$id_concert]);
    }
}