-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-07-2016 a las 02:03:46
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `planglobal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliografia`
--

CREATE TABLE `bibliografia` (
  `Id_Bibliografia` int(11) NOT NULL,
  `texto` text CHARACTER SET latin1 NOT NULL,
  `ID_PG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bibliografia`
--

INSERT INTO `bibliografia` (`Id_Bibliografia`, `texto`, `ID_PG`) VALUES
(1, 'James Foley, Andries van Dam, Steven Feiner, John Hughes, "COMPUTER\r\nGRAPHICS Principles and Practice", Addison Wesley (1992)\r\n', 1),
(2, 'Donald Eran, Pauline Baker, "COMPUTER GRAPHICS", Prentice Hall (1994).', 1),
(3, 'M. E. Mortenson, "COMPUTER GRAPHICS An introduction to the mathematics and\r\nGeometry", Industrial Press\r\n', 1),
(4, 'Heinz-Otto Peitgen, Hartmut Jürgens, Dietmar Saupe, "FRACTALS FOR THE CLASSROOM Introduction to Fractals and Chaos", Springer Verlag (1993)\r\n', 1),
(5, 'Craig A. Lindley, "PRACTICAL RAY TRACING IN C", John Wiley and Sons (1992)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `ID_Carrera` int(11) NOT NULL,
  `nombre_carrera` varchar(200) NOT NULL,
  `facultad` varchar(100) NOT NULL,
  `id_facultad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`ID_Carrera`, `nombre_carrera`, `facultad`, `id_facultad`) VALUES
(1, 'INGENIERÍA CIVIL', 'TECNOLOGIA', 1),
(2, 'INGENIERÍA DE ALIMENTOS', 'TECNOLOGIA', 1),
(3, 'INGENIERÍA DE SISTEMAS', 'TECNOLOGIA', 1),
(4, 'INGENIERÍA ELECTRICA', 'TECNOLOGIA', 1),
(5, 'INGENIERÍA ELECTRONICA', 'TECNOLOGIA', 1),
(6, 'INGENIERÍA ELECTROMECANICA ', 'TECNOLOGIA', 1),
(7, 'INGENIERÍA INDUSTRIAL ', 'TECNOLOGIA', 1),
(8, 'INGENIERÍA EN INFORMATICA', 'TECNOLOGIA', 1),
(9, 'INGENIERÍA MATEMATICA', 'TECNOLOGIA', 1),
(10, 'INGENIERÍA MECANICA', 'TECNOLOGIA', 1),
(11, 'INGENIERÍA QUIMICA', 'TECNOLOGIA', 1),
(12, 'LICENCIATURA EN BIOLOGIA', 'TECNOLOGIA', 1),
(13, 'LICENCIATURA EN DIDACTICA DE LA FISICA ', 'TECNOLOGIA', 1),
(14, 'LICENCIATURA EN DIDACTICA DE LA MATEMATICA ', 'TECNOLOGIA', 1),
(15, 'LICENCIATURA EN FISICA ', 'TECNOLOGIA', 1),
(16, 'LICENCIATURA EN MATEMATICAS ', 'TECNOLOGIA', 1),
(17, 'LICENCIATURA EN QUIMICA', 'TECNOLOGIA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio`
--

CREATE TABLE `criterio` (
  `ID_Criterio` int(11) NOT NULL,
  `Criterio` text NOT NULL,
  `ID_PG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criterio`
--

INSERT INTO `criterio` (`ID_Criterio`, `Criterio`, `ID_PG`) VALUES
(1, 'Los parciales y el Examen final se evaluarán con un examen escrito y una práctica cada uno. El\r\ntrabajo práctico servirá para reforzar los conocimientos adquiridos y para lograr la relación\r\nálgebra-geometría.\r\n', 1),
(2, 'Para el examen final, se desarrollará un proyecto que ponga en práctica todos los conceptos\r\ndesarrollados en el curso. La defensa será en computadora. Dependiendo de la cantidad de\r\nalumnos se puede considerar el trabajo en grupos de dos personas.', 1),
(3, 'Para el examen Final se deberá presentar un artículo científico relacionado con un tema\r\nespecífico de la infografía. Este trabajo será individual.\r\n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `ID_Docente` int(11) NOT NULL,
  `Nombre_Completo` varchar(200) NOT NULL,
  `Apellido_Paterno` varchar(200) NOT NULL,
  `Apellido_Materno` varchar(200) NOT NULL,
  `Profesion` text NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Celular` int(11) NOT NULL,
  `Correo` varchar(200) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `User_Login` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`ID_Docente`, `Nombre_Completo`, `Apellido_Paterno`, `Apellido_Materno`, `Profesion`, `Telefono`, `Celular`, `Correo`, `Direccion`, `User_Login`, `Password`) VALUES
(1, 'Marco Antonio', 'Montecinos', 'Choque', 'Msc. Lic. Informatico   ', 4432412, 70789239, 'markmcbo@gmail.com    ', 'Av. America entre Libertador Edificio Aduve Nro. 302', '198010290', '3046678'),
(2, 'Jaime Christian', 'Villazón', 'Alcocer', 'Lic. Informatica  ', 4307898, 77226552, 'villazon@gmail.com   ', 'Av. 6 de Agosto y Panamá Nro. 654 ', '198529373', '4067597'),
(3, 'Rosemary', 'Torrico', 'Bascope', 'Msc. Lic. Informatica', 4415679, 71778384, 'rosemary@cs.umss.edu.bo ', 'Calle Manuela Gandarrillas y Calle Segunda Nro. 234 2053489', '197508320', '2053489');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `ID_Facultad` int(11) NOT NULL,
  `Facultad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`ID_Facultad`, `Facultad`) VALUES
(1, 'FACULTAD DE CIENCIAS Y TECNOLOGIA'),
(2, 'FACULTAD DE CIENCIAS ECONOMICAS'),
(3, 'FACULTADAD DE ARQUITECTURA Y CIENCIAS DEL HABITAT'),
(4, 'FACULTAD DE HUMANIDADES Y CIENCIA DE LA EDUCACIÓN '),
(5, 'FACULDAD DE CIENCIAS JURIDICAS Y POLITICAS'),
(6, 'FACULTAD DE MEDICINA'),
(7, 'FACULTAD DE ODONTOLOGIA'),
(8, 'FACULTAD DE BIOQUIMICA Y FARMACIA'),
(9, 'FACULTAD DE CIENCIAS AGROPECUARIAS, FORESTALES Y VETERINARIAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificacion`
--

CREATE TABLE `justificacion` (
  `Id_Justificacion` int(11) NOT NULL,
  `Justificacion` text NOT NULL,
  `ID_PG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `justificacion`
--

INSERT INTO `justificacion` (`Id_Justificacion`, `Justificacion`, `ID_PG`) VALUES
(1, 'Durante las últimas décadas, el campo de la Graficación por Computadora ha evolucionado de\r\nuna manera continua y rápida aplicándose a diversas áreas del saber humano que van desde la\r\nsimulación hasta el entretenimiento, muchas de las cuales han maravillado e impactado a la\r\nsociedad.\r\nEntre las numerosas aplicaciones, podemos mencionar las siguientes: Interfaces GUI, Industria\r\ndel Entretenimiento, Aplicaciones Comerciales, Diseño Asistido, Aplicaciones Científicas,\r\nMedicina, Cartografía y GIS.\r\nTodos estos sistemas, utilizados para fines tan diversos, tienen un fundamento subyacente que\r\nconsiste en una seria de técnicas derivadas de la aplicación de la Graficación por Computadora.\r\nEn este contexto se hace necesario un estudio de los algoritmos y técnicas gráficas que\r\npermitan el desarrollo de nuevas aplicaciones para solucionar diversos problemas que se\r\npresentan.\r\n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `ID_Kardex` int(11) NOT NULL,
  `ID_PG_K` int(11) NOT NULL,
  `tipo_K` varchar(100) NOT NULL,
  `ID_Materia_K` int(11) NOT NULL,
  `ID_Docente_K` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `ID_Materia` int(11) NOT NULL,
  `Nombre_Materia` varchar(200) NOT NULL,
  `Codigo` int(11) NOT NULL,
  `Grupo` varchar(10) NOT NULL,
  `Nivel_Materia` varchar(10) NOT NULL,
  `Carga_Horaria` varchar(100) NOT NULL,
  `Materias_Relacionadas` text NOT NULL,
  `Departamento` varchar(200) NOT NULL,
  `ID_Carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`ID_Materia`, `Nombre_Materia`, `Codigo`, `Grupo`, `Nivel_Materia`, `Carga_Horaria`, `Materias_Relacionadas`, `Departamento`, `ID_Carrera`) VALUES
(1, 'Graficación por Computadora', 2010042, '1', 'D', '24', 'Algoritmos Avanzados,Programación WEB', 'Informática y Sistemas', 8),
(2, 'Graficación por Computadora', 2010042, '2', 'D', '24', 'Algoritmos Avanzados,Programación WEB\r\n ', 'Informática y Sistemas', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodologia`
--

CREATE TABLE `metodologia` (
  `ID_Metod` int(11) NOT NULL,
  `Metodologia` text NOT NULL,
  `ID_PG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `metodologia`
--

INSERT INTO `metodologia` (`ID_Metod`, `Metodologia`, `ID_PG`) VALUES
(1, 'Los cursos estarán compuestos de clases magistrales en aula, complementados por ejercicio, donde el alumno podrá poner en práctica los conceptos aprendidos. El curso tendrá sesiones prácticas en laboratorio, donde el alumno debe participar con sus dudas y resultados de los ejercicios propuestos.', 1),
(2, 'En las clases, los alumnos deberán mostrarse participativos, y deberán mostrar creatividad e\r\niniciativa en la resolución de los ejercicios planteados', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivo`
--

CREATE TABLE `objetivo` (
  `ID_Objetivos` int(11) NOT NULL,
  `ID_PG` int(11) NOT NULL,
  `Texto_Obj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `objetivo`
--

INSERT INTO `objetivo` (`ID_Objetivos`, `ID_PG`, `Texto_Obj`) VALUES
(1, 1, 'Tener los suficientes fundamentos matemáticos, geométricos y de programación para\r\ndesarrollar aplicaciones gráficas.'),
(2, 1, 'Introducir los algoritmos y estructura de datos necesarios para presentar datos gráficamente\r\nen una computadora.'),
(3, 1, 'Estudiar la generación de las primitivas básicas y su correspondiente manipulación.'),
(4, 1, 'Desarrollar modelos 3D, junto con su representación, visualización y transformación.'),
(5, 1, 'Generar imágenes con realismo fotográfico.'),
(6, 1, 'Aprender algoritmos y técnicas para el modelamiento geométrico.'),
(7, 1, 'Tener conocimiento sobre los modelos Fractales y su aplicación.\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planglobal`
--

CREATE TABLE `planglobal` (
  `ID_PG` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `ID_Materia` int(11) NOT NULL,
  `ID_Docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planglobal`
--

INSERT INTO `planglobal` (`ID_PG`, `tipo`, `ID_Materia`, `ID_Docente`) VALUES
(1, 'Titular', 1, 2),
(2, 'Normal', 2, 3);

--
-- Disparadores `planglobal`
--
DELIMITER $$
CREATE TRIGGER `datos_kardex` AFTER DELETE ON `planglobal` FOR EACH ROW insert into kardex(ID_PG_K,tipo_K,ID_Materia_K,ID_Docente_K) values (Old.ID_PG,Old.tipo,Old.ID_Materia,Old.ID_Docente)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_editado_pg`
--

CREATE TABLE `registro_editado_pg` (
  `ID_Registro` int(11) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `ID_PG` int(11) NOT NULL,
  `ID_Docente` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro_editado_pg`
--

INSERT INTO `registro_editado_pg` (`ID_Registro`, `Estado`, `ID_PG`, `ID_Docente`, `fecha`) VALUES
(1, 'Llenado', 1, 2, '2016-07-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_contenido`
--

CREATE TABLE `seccion_contenido` (
  `ID_Contenido` int(11) NOT NULL,
  `Contenido` text NOT NULL,
  `ID_Unidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion_contenido`
--

INSERT INTO `seccion_contenido` (`ID_Contenido`, `Contenido`, `ID_Unidad`) VALUES
(1, 'Introducción a las Gráficas por Computadora\r\n', 1),
(2, 'Aplicaciones\r\n', 1),
(3, 'Historia de las Gráficas por Computadora', 1),
(4, 'Dispositivos de Despliegue', 1),
(5, 'Fundamentos gráficos\r\n', 1),
(6, 'El álgebra Lineal y las Gráficas por Computadora', 2),
(7, 'Sistemas de Coordenadas\r\n', 2),
(8, 'Vectores y Matrices', 2),
(9, 'Matrices y las Transformaciones Lineales', 2),
(10, 'Coordenadas Homogéneas', 2),
(11, 'Transformaciones Afines', 2),
(12, 'Matrices Avanzadas y Proyecciones\r\n', 2),
(13, 'Orientación y Desplazamiento Angular en 3D\r\n', 2),
(14, 'Generalización de las Transformaciones\r\n', 2),
(15, 'Transformaciones Window-Viewport', 2),
(16, 'Verificaciones Geométricas\r\n', 2),
(17, 'Técnicas de discretización\r\n', 3),
(18, 'Discretización de la línea', 3),
(19, 'Algoritmo de Bresehman\r\n', 3),
(20, 'Discretización del Círculo', 3),
(21, 'Discretización de la Elipse', 3),
(22, 'Aliasing\r\n', 3),
(23, 'Importancia de una buena representación', 4),
(24, 'Tipos de Representación', 4),
(25, 'Mallas Poligonales', 4),
(26, 'Aplicación de las transformaciones y proyecciones a una Representación\r\n', 4),
(27, 'Otras representaciones: Sup. Cuadráticas y Sup. Paramétricas\r\n', 4),
(28, 'Introducción', 5),
(29, 'Historia', 5),
(30, ' Curvas', 5),
(31, 'Curvas de Hermite', 5),
(32, 'Curvas de Bézier', 5),
(33, 'Curvas B-Spline', 5),
(34, 'Superficies', 5),
(35, 'Superficies bicubicas de Hermite\r\n', 5),
(36, 'Superficies de Bézier', 5),
(37, 'Sólidos', 5),
(38, 'Introducción', 6),
(39, 'Naturaleza de la Luz', 6),
(40, 'Luz e Iluminación', 6),
(41, 'Modelos para el Color', 6),
(42, 'Modelo Geométrico para la Luz\r\n', 6),
(43, 'Modelos de Reflexión', 6),
(44, 'Modelo de Phong', 6),
(45, 'Modelo de Cook y Torrance', 6),
(46, 'Modelos de Iluminación\r\n', 6),
(47, 'La generación de imágenes de realismo fotográfico', 7),
(48, 'En busca del Realismo', 7),
(49, 'Modelos de Lambert, Gouraud y Phong', 7),
(50, 'Ray Tracing\r\n', 7),
(51, 'Naturaleza recursiva del Ray Tracing', 7),
(52, 'Intersección Rayo-Objeto\r\n', 7),
(53, 'Visibilidad Selectiva\r\n', 7),
(54, 'Atenuación Atmosférica', 7),
(55, 'Técnicas de Aceleración', 7),
(56, 'Orientación y Dirección', 8),
(57, 'Formas de especificar la orientación', 8),
(58, 'Matrices', 8),
(59, 'Ángulos de Euler', 8),
(60, 'Cuaterniones', 8),
(61, 'Introducción a los fractales', 9),
(62, 'Fractales Clásicos', 9),
(63, 'Autosimilaridad\r\n', 9),
(64, 'Sistema de Funciones Iteradas', 9),
(65, 'Sistemas L', 9),
(66, 'Conjunto de Julia', 9),
(67, 'Conjunto de Mandelbrot', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_objetivo`
--

CREATE TABLE `seccion_objetivo` (
  `ID_Objetivo` int(11) NOT NULL,
  `Objetivo` text NOT NULL,
  `ID_Unidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seccion_objetivo`
--

INSERT INTO `seccion_objetivo` (`ID_Objetivo`, `Objetivo`, `ID_Unidad`) VALUES
(1, ' Realizar una revisión histórica de la Infografía.', 1),
(2, 'Presentar las múltiples aplicaciones de la Infografía.\r\n', 1),
(3, 'Presentar los fundamentos de la Infografía', 1),
(4, 'Establecer claramente la relación entre algebra-geometría-código', 2),
(5, 'Proporcionar los fundamentos matemáticos usados en las Gráficas por Computadora.', 2),
(6, 'Lograr un entendimiento geométrico de los conceptos matemáticos para su implementación en software', 2),
(7, 'Presentar la discretización como elemento básico dentro de las Graficas por computadora junto con los problemas relacionados', 3),
(8, 'Presentar los algoritmos básicos para la graficación de las primitivas básicas y las diversas operaciones que se pueden realizar sobre las mismas.\r\n', 3),
(9, 'Determinar la importancia de una buena representación.', 4),
(10, 'Especificar las diferentes formas de representar los objetos con fines infográficos', 4),
(11, 'Relacionar la Representación con las Transformaciones y las Proyecciones con fines de visualización', 4),
(12, 'Determinar las limitaciones geométricas de las representaciones clásicas: forma implícita y explicita.\r\n', 5),
(13, 'Extender el esquema de representación de la forma de los objetos a curvas y superficies paramétricas.', 5),
(14, 'Estudiar como poder representar superficies y Curvas paramétricas.', 5),
(15, 'Presentar los fundamentos para representar Sólidos.', 5),
(16, 'Entender la naturaleza de la Luz y el Color.', 6),
(17, 'Presentar modelos para el color.', 6),
(18, 'Presentar los modelos de Reflexión e Iluminación para la generación de imágenes realistas.', 6),
(19, 'Aplicar los modelos de Reflexión, iluminación y del Color a la generación de imágenes realistas', 7),
(20, 'Describir los algoritmos y técnicas que permiten crear el realismo.', 7),
(21, 'Generar imágenes de realismo fotográfico.', 7),
(22, 'Establecer la diferencia entre dirección, orientación y desplazamiento angular', 8),
(23, 'Determinar las formas más comunes de especificar la orientación junto con sus ventajas y desventajas.', 8),
(24, 'Especificar un Sistema de Coordenadas.', 8),
(25, 'Introducción el concepto de fractal.\r\n', 9),
(26, 'Presentar algoritmos y técnicas para modelar la naturaleza.\r\n', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `ID_Unidad` int(11) NOT NULL,
  `Unidad` text NOT NULL,
  `Numero_Unidad` int(11) NOT NULL,
  `Hora_Academica` int(11) NOT NULL,
  `Cant_Semana` int(11) NOT NULL,
  `ID_PG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`ID_Unidad`, `Unidad`, `Numero_Unidad`, `Hora_Academica`, `Cant_Semana`, `ID_PG`) VALUES
(1, 'INTRODUCCIÓN A LAS GRÁFICAS POR COMPUTADORA\r\n', 1, 6, 1, 1),
(2, 'FUNDAMENTOS MATEMATICOS PARA LA INFOGRAFIA', 2, 18, 3, 1),
(3, 'ALGORITMOS Y CONCEPTOS BASICOS', 3, 12, 2, 1),
(4, 'REPRESENTACION Y VISUALIZACION 3D', 4, 18, 3, 1),
(5, 'MODELAMIENTO GEOMETRICO\r\n', 5, 24, 4, 1),
(6, 'LA LUZ Y MODELOS DE REFLEXION, ILUMINACION Y DEL COLOR', 6, 18, 3, 1),
(7, 'RAY TRACING', 7, 12, 2, 1),
(8, 'DIRECCIÓN Y ORIENTACIÓN\r\n', 8, 6, 1, 1),
(9, 'GEOMETRIA FRACTAL', 9, 6, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_User` int(11) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Cargo` varchar(100) NOT NULL,
  `ID_Docente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_User`, `alias`, `password`, `Cargo`, `ID_Docente`) VALUES
(1, 'root', 'root', 'Administrador', 0),
(2, 'AdminSI', 'AdmindSI2016', 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE `video` (
  `ID_Video` int(11) NOT NULL,
  `Titulo` varchar(200) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Caracteristica` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bibliografia`
--
ALTER TABLE `bibliografia`
  ADD PRIMARY KEY (`Id_Bibliografia`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`ID_Carrera`);

--
-- Indices de la tabla `criterio`
--
ALTER TABLE `criterio`
  ADD PRIMARY KEY (`ID_Criterio`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`ID_Docente`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`ID_Facultad`);

--
-- Indices de la tabla `justificacion`
--
ALTER TABLE `justificacion`
  ADD PRIMARY KEY (`Id_Justificacion`);

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`ID_Kardex`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`ID_Materia`);

--
-- Indices de la tabla `metodologia`
--
ALTER TABLE `metodologia`
  ADD PRIMARY KEY (`ID_Metod`);

--
-- Indices de la tabla `objetivo`
--
ALTER TABLE `objetivo`
  ADD PRIMARY KEY (`ID_Objetivos`);

--
-- Indices de la tabla `planglobal`
--
ALTER TABLE `planglobal`
  ADD PRIMARY KEY (`ID_PG`);

--
-- Indices de la tabla `registro_editado_pg`
--
ALTER TABLE `registro_editado_pg`
  ADD PRIMARY KEY (`ID_Registro`);

--
-- Indices de la tabla `seccion_contenido`
--
ALTER TABLE `seccion_contenido`
  ADD PRIMARY KEY (`ID_Contenido`);

--
-- Indices de la tabla `seccion_objetivo`
--
ALTER TABLE `seccion_objetivo`
  ADD PRIMARY KEY (`ID_Objetivo`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`ID_Unidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_User`);

--
-- Indices de la tabla `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`ID_Video`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bibliografia`
--
ALTER TABLE `bibliografia`
  MODIFY `Id_Bibliografia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `ID_Carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `criterio`
--
ALTER TABLE `criterio`
  MODIFY `ID_Criterio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `ID_Docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `ID_Facultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `justificacion`
--
ALTER TABLE `justificacion`
  MODIFY `Id_Justificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `ID_Kardex` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `ID_Materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `metodologia`
--
ALTER TABLE `metodologia`
  MODIFY `ID_Metod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `objetivo`
--
ALTER TABLE `objetivo`
  MODIFY `ID_Objetivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `planglobal`
--
ALTER TABLE `planglobal`
  MODIFY `ID_PG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `registro_editado_pg`
--
ALTER TABLE `registro_editado_pg`
  MODIFY `ID_Registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `seccion_contenido`
--
ALTER TABLE `seccion_contenido`
  MODIFY `ID_Contenido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `seccion_objetivo`
--
ALTER TABLE `seccion_objetivo`
  MODIFY `ID_Objetivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `ID_Unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `video`
--
ALTER TABLE `video`
  MODIFY `ID_Video` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
