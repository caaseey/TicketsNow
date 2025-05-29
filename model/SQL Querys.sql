CREATE DATABASE IF NOT EXISTS ticketsnow;
USE ticketsnow;

CREATE TABLE IF NOT EXISTS roles (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    rol_name VARCHAR(25) NOT NULL
);

CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    surname VARCHAR(25) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_role INT NOT NULL,
    profile_photo VARCHAR(255),
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);

CREATE TABLE IF NOT EXISTS artists (
    id_artist INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    genre VARCHAR(100),
    banner_image VARCHAR(255)
)

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

-- Insertar roles
INSERT INTO roles (rol_name) VALUES ('user'), ('artist'), ('admin');

-- Insertar artistas
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
    ('YOASOBI', 'J-Pop', '../../media/img/concert_banners/yoasobi.jpg');

-- Verificar
SELECT * FROM users;
SELECT * FROM concerts;
SELECT * FROM artists;