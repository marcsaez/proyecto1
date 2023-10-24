INSERT INTO `cursos` (`codigo`, `nombre`, `descripcion`, `horas`, `inicio`, `final`, `activo`, `foto`, `fk_profesor`) VALUES
(1, 'Web', 'Entorn web', 33, '2023-10-25', '2023-12-23', 1, 'img/cursos/TECHrecortada.png.', '47440233L'),
(2, 'Javascript', 'Curso de programacion orientado a web enfocado en javascript', 42, '2023-10-25', '2023-12-21', 1, 'img/cursos/Javascript.png', '53638890S'),
(3, 'Bases de datos', 'Curso de formacion de base de datos, enfocado en mySQL', 61, '2023-10-26', '2024-03-11', 1, 'img/cursos/Bases de datos.png', '53638890S'),
(4, 'Programacion orientada a objeto', 'Curso de programacion orientada a objeto, donde tambien se enseñara MVC(Modelo, Vista y Controlador) y arquitectura hexagonal', 98, '2023-11-15', '2024-05-02', 1, 'img/cursos/Programcion orientada a objeto.png', '53638890S'),
(5, 'Sistemas operativos', 'Curso para administrar sistemas operativos', 61, '2023-10-27', '2024-03-11', 1, 'img/cursos/Sistemas operativos.webp', '13153772A'),
(6, 'Software', 'Curso básico de desarrollo de software', 93, '2023-10-24', '2024-05-17', 1, 'img/cursos/Software.png', '13153772A');

INSERT INTO `profesor` (`dni`, `nombre`, `apellidos`, `titulo_academico`, `foto`, `activo`, `contraseña`) VALUES
('13153772A', 'Marta', 'Perez', 'Ingeniera Telecomunicaciones', 'img/perfiles/13153772A.', 1, '$2y$10$j4PmK0qU0lyuBKEe1CSZM.3bi9pmyAjEtM4.A4Jk7sUC9igkWG4ti'),
('31313893Z', 'Pepe', 'Reina', 'CFGS Desarrollo aplicaciones multiplataforma', 'img/perfiles/31313893Z.', 1, '$2y$10$y.Ubd/BqG6T.kDchFiIYKeHcjjkZKuGahYcSvtm7GPAm1wZH78rtC'),
('47440233L', 'Ruben', 'Perez', 'Master', '', 1, 'r'),
('53638890S', 'Toni', 'Rubio', 'La 33', 'img/perfiles/53638890S.', 1, '$2y$10$hc/mOE8Dd/Nt.tihvi7/LuACSziaifEXB/tquj3qi9uifTq7Kplqi');
