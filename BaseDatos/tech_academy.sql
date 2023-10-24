-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 24-10-2023 a les 11:58:56
-- Versió del servidor: 10.4.28-MariaDB
-- Versió de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `tech_academy`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `contraseña`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de la taula `alumnos`
--

CREATE TABLE `alumnos` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `concurso` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `alumnos`
--

INSERT INTO `alumnos` (`dni`, `nombre`, `apellidos`, `edad`, `contraseña`, `foto`, `concurso`) VALUES
('28600598Y', 'Luis', 'Javier', 19, '$2y$10$w23dl000mQZlZNYBbxEiGOEvSdMyCNDBRd0giIS8FArlPvXWSwWBi', 'img/perfiles/28600598Y.', 0),
('33348988T', 'Paco', 'Ibañez', 35, '$2y$10$gccny00b6HVlJFUjGQLJNezuM6kPYtXgTegoWnoRR5M5.XtP2E2V2', 'img/perfiles/33348988T.', 0),
('53638890S', 'Toni', 'Rubio', 20, '$2y$10$eyPaZZC/E2XDvo4bWjK8GuH9ANRFE3O2XaVa02dRWUe6H/8fI72.q', 'img/perfiles/53638890S.', 0),
('78258092V', 'Luis', 'Paco', 19, '$2y$10$m32EgTK1df4NgWqoIND48OokTuu3Pezrf6DrAzZaRMuRtuVOtxIPO', 'img/perfiles/78258092V.', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `cursos`
--

CREATE TABLE `cursos` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `final` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `fk_profesor` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `cursos`
--

INSERT INTO `cursos` (`codigo`, `nombre`, `imagen`, `descripcion`, `horas`, `inicio`, `final`, `activo`, `foto`, `fk_profesor`) VALUES
(6, 'Java', NULL, 'Java es una plataforma informática de lenguaje de programación creada por Sun Microsystems en 1995. Ha evolucionado desde sus humildes comienzos hasta impulsar una gran parte del mundo digital actual, ya que es una plataforma fiable en la que se crean muchos servicios y aplicaciones. Los nuevos e innovadores productos y servicios digitales diseñados para el futuro también siguen basándose en Java.', 40, '2023-10-10', '2023-10-18', 1, 'img/cursos/CS2.png', '46715509W'),
(7, 'JavaScript', NULL, 'JavaScript (abreviado comúnmente JS) es un lenguaje de programación interpretado, dialecto del estándar ECMAScript. Se define como orientado a objetos,2​ basado en prototipos, imperativo, débilmente tipado y dinámico.\r\n\r\nSe utiliza principalmente del lado del cliente, implementado como parte de un navegador web permitiendo mejoras en la interfaz de usuario y páginas web dinámicas3​ y JavaScript del lado del servidor (Server-side JavaScript o SSJS). Su uso en aplicaciones externas a la web, por ejemplo en documentos PDF, aplicaciones de escritorio (mayoritariamente widgets) es también significativo. ', 120, '2024-10-21', '2025-02-20', 1, 'img/cursos/Javascript.png', '46715509W'),
(8, 'Python', NULL, 'ython es un lenguaje de alto nivel de programación interpretado cuya filosofía hace hincapié en la legibilidad de su código, se utiliza para desarrollar aplicaciones de todo tipo, por ejemplo: Instagram, Netflix, Spotify, Panda3D, entre otros.2​ Se trata de un lenguaje de programación multiparadigma, ya que soporta parcialmente la orientación a objetos, programación imperativa y, en menor medida, programación funcional. Es un lenguaje interpretado, dinámico y multiplataforma. ', 250, '2024-10-21', '2026-10-21', 1, 'img/cursos/Python.png', '47440234C'),
(9, 'C', NULL, 'C es un lenguaje de programación de propósito general: 1  originalmente desarrollado por Dennis Ritchie entre 1969 y 1972 en los Laboratorios Bell,1​ como evolución del anterior lenguaje B, a su vez basado en BCPL.2​: 1 3​4​\r\n\r\nAl igual que B, es un lenguaje orientado a la implementación de sistemas operativos, concretamente Unix. C es apreciado por la eficiencia del código que produce y es el lenguaje de programación más popular para crear softwares de sistemas y aplicaciones. ', 100, '2025-10-08', '2026-10-15', 1, 'img/cursos/C.png', '47440234C'),
(10, 'C++', NULL, 'C++ es un lenguaje de programación diseñado en 1979 por Bjarne Stroustrup. La intención de su creación fue extender al lenguaje de programación C y añadir mecanismos que permiten la manipulación de objetos. En ese sentido, desde el punto de vista de los lenguajes orientados a objetos, C++ es un lenguaje híbrido.\r\n\r\nPosteriormente se añadieron facilidades de programación genérica, que se sumaron a los paradigmas de programación estructurada y programación orientada a objetos. Por esto se suele decir que el C++ es un lenguaje de programación multiparadigma. ', 125, '2026-10-20', '2027-10-20', 1, 'img/cursos/C++.png', '46715509W');

-- --------------------------------------------------------

--
-- Estructura de la taula `matriculados`
--

CREATE TABLE `matriculados` (
  `codigo` int(11) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `nota` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `matriculados`
--

INSERT INTO `matriculados` (`codigo`, `dni`, `nota`) VALUES
(6, '28600598Y', 9.90),
(6, '53638890S', 3.00),
(6, '78258092V', 10.00),
(7, '53638890S', 0.00);

-- --------------------------------------------------------

--
-- Estructura de la taula `profesor`
--

CREATE TABLE `profesor` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `titulo_academico` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `profesor`
--

INSERT INTO `profesor` (`dni`, `nombre`, `apellidos`, `titulo_academico`, `foto`, `activo`, `contraseña`) VALUES
('46715509W', 'Olga', 'Domene', 'Ing', 'img/perfiles/46715509W.', 1, '$2y$10$XzZbikzkLZFnznV5X7cI7ezzR23RlCTJzNsv1lNT.jjoeBxbEndmy'),
('47440234C', 'Pablo', 'Lopez', 'DAW', 'img/perfiles/47440234C.', 1, '$2y$10$fS2MLpByigBZCAy9E7QhmePrtkfROdDZVAAR5U/a4NFrv.aCKpSmC');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`dni`);

--
-- Índexs per a la taula `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_profesor` (`fk_profesor`);

--
-- Índexs per a la taula `matriculados`
--
ALTER TABLE `matriculados`
  ADD PRIMARY KEY (`codigo`,`dni`),
  ADD KEY `dni` (`dni`);

--
-- Índexs per a la taula `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la taula `cursos`
--
ALTER TABLE `cursos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`dni`);

--
-- Restriccions per a la taula `matriculados`
--
ALTER TABLE `matriculados`
  ADD CONSTRAINT `matriculados_ibfk_1` FOREIGN KEY (`codigo`) REFERENCES `cursos` (`codigo`),
  ADD CONSTRAINT `matriculados_ibfk_2` FOREIGN KEY (`dni`) REFERENCES `alumnos` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
