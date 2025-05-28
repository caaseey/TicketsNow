CREATE DATABASE ticketsnow; 
USE ticketsnow; 

CREATE TABLE roles (   
	id_role INT AUTO_INCREMENT NOT NULL PRIMARY KEY,   
	rol_name VARCHAR(25) NOT NULL
); 

CREATE TABLE users (   
	id_user INT AUTO_INCREMENT NOT NULL PRIMARY KEY,   
    name VARCHAR(25),   
    surname VARCHAR(25),   
    email VARCHAR(100),   
    password VARCHAR(255),   
    id_role INT,   
    profile_photo VARCHAR(255) NOT NULL,   
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);
    
    -- Insertar en la tabla roles (¡no en users!) 
    INSERT INTO roles (rol_name) VALUES   ('user'),   ('artist'),   ('admin');
    
    -- Verificar 
    SELECT * FROM users;