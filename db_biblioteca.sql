CREATE DATABASE db_biblioteca;

USE db_biblioteca;

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50),
  apellido VARCHAR(50),
  `user` VARCHAR(20),
  `password` VARCHAR(50)
);

-- Crear la tabla de autores
CREATE TABLE autores (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  nacionalidad VARCHAR(50)
);

-- Crear la tabla de libros
CREATE TABLE libros (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(100) NOT NULL,
  año INT,
  autor_id INT NOT NULL,
  FOREIGN KEY (autor_id) REFERENCES autores(id)
);

-- Insertar algunos datos de ejemplo
INSERT INTO autores (id, nombre, nacionalidad) VALUES
(1, 'Gabriel García Márquez', 'Colombia'),
(2, 'Isabel Allende', 'Chile'),
(3, 'Jorge Luis Borges', 'Argentina');

INSERT INTO libros (id, titulo, año, autor_id) VALUES
(1, 'Cien años de soledad', 1967, 1),
(2, 'La casa de los espíritus', 1982, 2),
(3, 'Ficciones', 1944, 3),
(4, 'El amor en los tiempos del cólera', 1985, 1),
(5, 'La ciudad de las bestias', 2002, 2),
(6, 'El Aleph', 1949, 3);