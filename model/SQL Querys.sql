-- Crear base de datos
CREATE DATABASE IF NOT EXISTS ticketsnow;
USE ticketsnow;

-- Crear tabla de roles
CREATE TABLE roles (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    rol_name VARCHAR(25) NOT NULL
);

-- Crear tabla de usuarios
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_role INT NOT NULL,
    profile_photo VARCHAR(255) DEFAULT '',
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);

-- Insertar roles
INSERT INTO roles (rol_name) VALUES
('user'),
('artist'),
('admin');

-- Insertar usuarios (contraseñas simples para pruebas; luego se deben hashear)
INSERT INTO users (name, surname, email, password, id_role, profile_photo) VALUES
('Casey', 'Cleto', 'casey@gmail.com', '123', 1, ''),
('Jonji', 'Salango', 'jonji@gmail.com', '123', 2, ''),
('Marc', 'Lopez', 'marc@gmail.com', '123', 3, '');

-- Verificar inserciones
SELECT * FROM users;
