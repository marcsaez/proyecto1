--  Crear base de datos
CREATE DATABASE tech_academy;
USE tech_academy;

-- Crear la tabla PROFESOR
CREATE TABLE profesor (
    dni VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    titulo_academico VARCHAR(255),
    foto VARCHAR(255),
    activo BOOLEAN
);

-- Crear la tabla ALUMNOS
CREATE TABLE alumnos (
    dni VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    edad INT,
    foto VARCHAR(255)
);

-- Crear la tabla ADMINISTRADORES
CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    contraseña VARCHAR(255) NOT NULL
);

-- Crear la tabla CURSOS
CREATE TABLE cursos (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    horas INT,
    inicio DATE,
    final DATE,
    activo BOOLEAN,
    fk_profesor VARCHAR(10),
    FOREIGN KEY (fk_profesor) REFERENCES profesor(dni)
);

-- Crear la tabla MATRICULADOS
CREATE TABLE matriculados (
    codigo INT,
    dni VARCHAR(10),
    nota DECIMAL(5,2),
    PRIMARY KEY (codigo, dni),
    FOREIGN KEY (codigo) REFERENCES cursos(codigo),
    FOREIGN KEY (dni) REFERENCES alumnos(dni)
);

-- Crear registro en ADMINISTRADORES
INSERT INTO administradores (usuario, contraseña) VALUES ('admin', 'admin');

-- Usuario admin
create user "super" identified by "P4ssword!";
grant all privileges on tech_academy.* to "super";