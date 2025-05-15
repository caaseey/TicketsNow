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
    password VARCHAR(25),   
    id_role INT,   
    profile_photo VARCHAR(255) NOT NULL,   
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);
    
    -- Insertar en la tabla roles (¡no en users!) 
    INSERT INTO roles (rol_name) VALUES   ('user'),   ('artist'),   ('admin');
    
    -- Insertar usuarios (no hace falta especificar id_user) 
    INSERT INTO users (name, surname, email, password, id_role, profile_photo) VALUES   ('casey', 'cleto', 'casey@gmail.com', '123', 1, ''),   ('jonji', 'salango', 'jonji@gmail.com', '123', 2, ''),   ('marc', 'lopez', 'marc@gmail.com', '123', 3, '');
    
    -- Verificar 
    SELECT * FROM users;