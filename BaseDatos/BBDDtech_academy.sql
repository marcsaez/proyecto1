--  Crear base de datos
CREATE DATABASE tech_academy;
USE tech_academy;

-- Crear la tabla PROFESOR
CREATE TABLE PROFESOR (
    dni VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    titulo_academico VARCHAR(255),
    contraseña VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    activo BOOLEAN
);

-- Crear la tabla ALUMNOS
CREATE TABLE ALUMNOS (
    dni VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    edad INT,
    contraseña VARCHAR(255) NOT NULL,
    foto VARCHAR(255)
);

-- Crear la tabla ADMINISTRADORES
CREATE TABLE ADMINISTRADORES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    contraseña VARCHAR(255) NOT NULL
);

-- Crear la tabla CURSOS
CREATE TABLE CURSOS (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    horas INT,
    inicio DATE,
    final DATE,
    activo BOOLEAN,
    foto VARCHAR(255),
    fk_profesor VARCHAR(10),
    FOREIGN KEY (fk_profesor) REFERENCES PROFESOR(dni)
);

-- Crear la tabla MATRICULADOS
CREATE TABLE MATRICULADOS (
    codigo INT,
    dni VARCHAR(10),
    nota DECIMAL(5,2),
    PRIMARY KEY (codigo, dni),
    FOREIGN KEY (codigo) REFERENCES CURSOS(codigo),
    FOREIGN KEY (dni) REFERENCES ALUMNOS(dni)
);

-- Crear registro en ADMINISTRADORES
INSERT INTO ADMINISTRADORES (usuario, contraseña) VALUES ('admin', 'admin');
