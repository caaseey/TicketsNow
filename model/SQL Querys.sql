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

CREATE TABLE IF NOT EXISTS concerts (
    id_concert INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    price DECIMAL(10,2) NOT NULL
);

-- Insertar roles
INSERT INTO roles (rol_name) VALUES ('user'), ('artist'), ('admin');

-- Verificar
SELECT * FROM users;
SELECT * FROM concerts;