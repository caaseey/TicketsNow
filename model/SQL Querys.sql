create database ticketsnow;

use ticketsnow;

create table roles(
id_role int auto_increment not null primary key,
rol_name varchar(25) not null
);

create table users(
id_user int auto_increment not null primary key,
name varchar(25),
surname varchar(25),
email varchar(100),
password varchar(25),
id_role int not null,
FOREIGN KEY (id_role) REFERENCES roles(id_role)
);

select * from users;