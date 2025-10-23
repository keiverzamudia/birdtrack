-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2025 a las 01:22:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bridtrack`
--
CREATE DATABASE IF NOT EXISTS `bridtrack` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bridtrack`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activos`
--

CREATE TABLE `activos` (
  `id_activo` int(11) NOT NULL,
  `id_tipo_activo` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `Nombre_Activo` varchar(100) NOT NULL,
  `Descripcion_Activo` text DEFAULT NULL,
  `Estado_Activo` varchar(50) DEFAULT 'Disponible',
  `Fecha_adquisicion` date DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `activos`
--

INSERT INTO `activos` (`id_activo`, `id_tipo_activo`, `id_ubicacion`, `Nombre_Activo`, `Descripcion_Activo`, `Estado_Activo`, `Fecha_adquisicion`, `Status`) VALUES
(1, 2, 1, 'HP', 'PC Hp 1200 8Gb de Ram disco 120GB', 'Disponible', '2025-06-10', 1),
(2, 2, 2, 'Asus Zen', 'Asus Zen I5 7ma 16GB Ram 1Tb Disco', 'Disponible', '2025-06-26', 1),
(3, 2, 1, 'Dell xh2', 'Dell xh2 16Gb de Ram', 'Disponible', '2025-06-27', 1),
(4, 2, 1, 'La PC Lenta de Maria', 'mas Lenta que una Canaima', 'Disponible', '2025-06-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_mantenimiento`
--

CREATE TABLE `activo_mantenimiento` (
  `id_mantenimiento` int(11) NOT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `id_tipo_mantenimiento` int(11) DEFAULT NULL,
  `cedula_empleado` int(11) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT 'Pendiente',
  `Fecha` date DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `activo_mantenimiento`
--

INSERT INTO `activo_mantenimiento` (`id_mantenimiento`, `id_activo`, `id_tipo_mantenimiento`, `cedula_empleado`, `Estado`, `Fecha`, `Status`) VALUES
(1, 1, 1, 7432637, 'Consolidado', '2025-06-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id_asignacion` int(11) NOT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `cedula_empleado` int(11) DEFAULT NULL,
  `Descripcion_Asignacion` text DEFAULT NULL,
  `Fecha_asignacion` date DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `Nombre_Cargo` varchar(100) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `Nombre_Cargo`, `Status`) VALUES
(1, 'Administrador', 1),
(2, 'Empleado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_subject` varchar(250) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_subject`, `comment_text`, `comment_status`) VALUES
(1, 'Prueba', 'prueba 1', 1),
(2, 'Keiver Zamudia', 'Segunda Prueba', 1),
(3, 'Admin', 'no puedo ingresar a la plataforma', 1),
(4, 'Admin', 'este quedara en 0', 1),
(5, 'Edgardo Torrealba', 'tengo problemas, me ayudas?', 1),
(6, 'Edgardo Torrealba', 'esta no me sirve', 0),
(7, 'Admin', 'wkqdw', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `Nombre_Departamento` varchar(100) NOT NULL,
  `Descripcion_Departamento` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `Nombre_Departamento`, `Descripcion_Departamento`, `Status`) VALUES
(1, '  ITV ', '  International TV', 1),
(2, 'Palco de Operaciones Cardenales', 'Palco De Operaciones Cardenales, Encargado de la proyección y sonido del estadio ', 1),
(3, 'Mercadeo Cardenales', 'Mercadeo Trabaja con Toda la logistica y promocion del equipo', 1),
(4, 'pepe', 'xcCS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `cedula_empleado` int(11) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `Nombre_Empleado` varchar(100) NOT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `clave` varchar(20) NOT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `perfil` text NOT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`cedula_empleado`, `id_departamento`, `Nombre_Empleado`, `correo_electronico`, `clave`, `Fecha_creacion`, `id_cargo`, `perfil`, `Status`) VALUES
(123456, 1, 'Admin', 'admin@gmail.com', '12345678', '2025-10-20', 1, '', 1),
(7432637, 1, 'Julio Rodriguez', 'jcdomo69@gmail.com', '', '2025-06-23', 1, '', 1),
(25469224, 2, 'Keiver Zamudia', 'keiberzamudia14@gmail.com', '', '2025-06-23', 1, '', 1),
(25894881, 1, 'Yolianna Angulo', 'yolianna14@gmail.com', '', '2025-06-26', 2, '', 1),
(26480334, 1, 'daniel', 'mariaj334@gmail.com', '', '2025-10-07', 1, '', 1),
(31388643, 2, 'Edgardo Torrealba', 'edgardo@gmail.com', '87654321', '2025-10-20', 2, 'empleado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `cod_proveedor` int(11) NOT NULL,
  `Nombre_Proveedor` varchar(100) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Numero_telefono` varchar(20) DEFAULT NULL,
  `Correo_elect` varchar(100) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`cod_proveedor`, `Nombre_Proveedor`, `Direccion`, `Numero_telefono`, `Correo_elect`, `Status`) VALUES
(1, 'Amazon', '410 Terry Ave. N., Seattle, WA 98109-5210', '', 'cs-reply@amazon.com', 1),
(2, 'Ebay', '2025 Hamilton Avenue, San José, California 95125', '866-540-3229', 'customerhelp@ebay.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamo_activo`
--

CREATE TABLE `reclamo_activo` (
  `id_reclamo` int(11) NOT NULL,
  `cedula_empleado` int(11) DEFAULT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Fecha_reclamo` date DEFAULT NULL,
  `comment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reclamo_activo`
--

INSERT INTO `reclamo_activo` (`id_reclamo`, `cedula_empleado`, `id_activo`, `Descripcion`, `Fecha_reclamo`, `comment_status`) VALUES
(1, 123456, 1, 'Aqui funciona todo', '2025-10-23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_activos`
--

CREATE TABLE `tipo_activos` (
  `id_tipo_activo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion_tipo` text DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_activos`
--

INSERT INTO `tipo_activos` (`id_tipo_activo`, `Nombre`, `Descripcion_tipo`, `Status`) VALUES
(1, 'PC', 'Computadora de Mesa', 1),
(2, ' Laptop ', ' Computador Portatil Doble', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mantenimiento`
--

CREATE TABLE `tipo_mantenimiento` (
  `id_tipo_mantenimiento` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_mantenimiento`
--

INSERT INTO `tipo_mantenimiento` (`id_tipo_mantenimiento`, `Nombre`, `Descripcion`) VALUES
(1, 'Mant-Preventivo', 'estrategia proactiva de cuidado y conservación de equipos, maquinaria e instalaciones que se realiza de forma programada y sistemática.'),
(2, 'Mant-Correctivo', 'Ocurre de forma imprevista cuando un equipo falla repentinamente, interrumpiendo la operación.'),
(3, 'Mant-Paulatino', 'Mantenimiento a veces'),
(4, 'sxqxqwx', 'qssqxqsxqs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion_activos`
--

CREATE TABLE `ubicacion_activos` (
  `id_Ubicacion` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion_activos`
--

INSERT INTO `ubicacion_activos` (`id_Ubicacion`, `Nombre`, `Status`) VALUES
(1, 'ITV', 1),
(2, 'Palco de Operaciones', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `cedula` varchar(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `telefono` int(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` varchar(11) NOT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL,
  `perfil` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `cedula`, `nombre`, `apellidos`, `telefono`, `correo`, `clave`, `rol`, `id_tipo_usuario`, `perfil`, `status`) VALUES
(25469225, '26480334', 'MariaJ', 'Alvarez', 41284920, 'mariajose98@gmail.com', 'Mariaj24*', 'admin', NULL, NULL, 1),
(25469227, '1234567', 'PruebasAdmin', '', 5252552, 'admin@gmail.com', '12345678', 'Admin', 1, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activos`
--
ALTER TABLE `activos`
  ADD PRIMARY KEY (`id_activo`),
  ADD KEY `id_tipo_activo` (`id_tipo_activo`),
  ADD KEY `id_ubicacion` (`id_ubicacion`);

--
-- Indices de la tabla `activo_mantenimiento`
--
ALTER TABLE `activo_mantenimiento`
  ADD PRIMARY KEY (`id_mantenimiento`),
  ADD KEY `id_activo` (`id_activo`),
  ADD KEY `id_tipo_mantenimiento` (`id_tipo_mantenimiento`),
  ADD KEY `Empleado_Responsable` (`cedula_empleado`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_activo` (`id_activo`),
  ADD KEY `cedula_empleado` (`cedula_empleado`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`cedula_empleado`),
  ADD KEY `id_departamento` (`id_departamento`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`cod_proveedor`);

--
-- Indices de la tabla `reclamo_activo`
--
ALTER TABLE `reclamo_activo`
  ADD PRIMARY KEY (`id_reclamo`),
  ADD KEY `cedula_empleado` (`cedula_empleado`),
  ADD KEY `id_activo` (`id_activo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reclamo_activo`
--
ALTER TABLE `reclamo_activo`
  MODIFY `id_reclamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
