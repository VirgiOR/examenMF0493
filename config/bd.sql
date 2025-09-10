-- Active: 1750671267468@@127.0.0.1@3306@tienda_web
drop database if exists tienda_web ; -- peligro

create database if not exists  tienda_web 
character set latin1 
   collate latin1_spanish_ci;

use tienda_web;

create user admin_tienda 
identified by 'P100cpbvepatv!';

grant all PRIVILEGES on tienda_web.* to admin_tienda;

create table usuarios (
    id int unsigned AUTO_INcreMENT primary key,
    nombre_usuario varchar(25) not null,
    email varchar(80) not null unique,
    contrasena varchar(255) not null,
    rol enum('admin','usuario') not null default 'usuario'
);

insert into usuarios (nombre_usuario,email,contrasena,rol) values
('admin','123456');
insert into categorias (nombre_categoria) values ('Electrónica');

create TABLE   categorias (
    id int unsigned AUTO_INcreMENT primary key,
    nombre_categoria varchar(50) not null
);
create table productos (
    id int unsigned AUTO_INcreMENT primary key,
    nombre_producto varchar(50) not null,
    descripcion text not null,
    precio decimal(10,2) not null,
    stock int not null,
    imagen_url varchar(255) not null,
    idCategoria int unsigned not null,
    foreign key (idCategoria) references categorias(id)
);


