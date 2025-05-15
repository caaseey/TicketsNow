-- Aquí pondremos las Querys de MySQL que utilizamos para crear la base de datos.
-- Si haceis algun cambio en la BBDD, actualizad este archivo.

-- ===============================
-- 1. CREACIÓN DE LA BASE DE DATOS
-- ===============================
CREATE DATABASE ticketsnow; 
USE ticketsnow; 

-- =========================
-- 2. CREACIÓN DE LAS TABLAS
-- =========================

CREATE TABLE roles
(   
	id_role INT AUTO_INCREMENT NOT NULL PRIMARY KEY,   
	rol_name VARCHAR(25) NOT NULL
); 

-- Insertar en la tabla roles los diferentes roles de cada usuario. Ejecutar 1 vez y no tocar nada.
INSERT INTO roles (rol_name) VALUES   ('user'),   ('artist'),   ('admin');

CREATE TABLE users 
(   
	id_user INT AUTO_INCREMENT NOT NULL PRIMARY KEY,   
    name VARCHAR(25),   
    surname VARCHAR(25),   
    email VARCHAR(100),   
    password VARCHAR(25),   
    id_role INT,   
    profile_photo VARCHAR(255) NOT NULL,   
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);
    
-- Ejemplo de como insertar un usuario en la tabla de users.
INSERT INTO users (name, surname, email, password, id_role, profile_photo) VALUES   ('casey', 'cleto', 'casey@gmail.com', '123', 1, ''),   ('jonji', 'salango', 'jonji@gmail.com', '123', 2, ''),   ('marc', 'lopez', 'marc@gmail.com', '123', 3, '');

-- ====================
-- 3. Consultas típicas
-- ====================

-- Verificar datos en la tabla users.
SELECT * FROM users;