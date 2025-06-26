-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
<<<<<<< HEAD
-- Tiempo de generación: 26-06-2025 a las 17:40:57
=======
-- Tiempo de generación: 26-06-2025 a las 17:32:27
>>>>>>> a7aa1cf3f58a3362270f56b0862a9a35fecc8a8f
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
<<<<<<< HEAD
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
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Fecha_adquisicion` date DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activo_mantenimiento`
--

CREATE TABLE `activo_mantenimiento` (
  `id_mantenimiento` int(11) NOT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `id_tipo_mantenimiento` int(11) DEFAULT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripción` text DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id_asignacion` int(11) NOT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `cedula_empleado` int(11) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Fecha_asignacion` date DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
=======
>>>>>>> a7aa1cf3f58a3362270f56b0862a9a35fecc8a8f

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `Nombre`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

<<<<<<< HEAD
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `cod_proveedor` int(11) DEFAULT NULL,
  `cedula_empleado` int(11) DEFAULT NULL,
  `Detalle_Compra` text DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Costo` decimal(10,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `Nombre`, `Descripcion`) VALUES
(1, 'ITV', 'International TV es pionera en cuanto a producción televisiva especializada en béisbol, permitiéndoles formar un equipo integrado por profesionales, que cuentan con una basta experiencia en el campo de producción de programas televisivos de dicho deporte.'),
(2, 'Palco de Operaciones Cardenales', 'Palco De Operaciones Cardenales, Encargado de la proyección y sonido del estadio ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `cedula_empleado` int(11) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `Nombre` varchar(100) NOT NULL,
  `correo_electronico` varchar(100) DEFAULT NULL,
  `Fecha_creacion` date DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`cedula_empleado`, `id_departamento`, `Nombre`, `correo_electronico`, `Fecha_creacion`, `id_cargo`, `Status`) VALUES
(7432637, 1, 'Julio Rodriguez', 'jcdomo69@gmail.com', '2025-06-23', 1, 1),
(25469224, 2, 'Keiver Zamudia', 'keiberzamudia14@gmail.com', '2025-06-23', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `cod_proveedor` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Numero_telefono` varchar(20) DEFAULT NULL,
  `Correo_elect` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`cod_proveedor`, `Nombre`, `Direccion`, `Numero_telefono`, `Correo_elect`) VALUES
(1, 'Amazon', '410 Terry Ave. N., Seattle, WA 98109-5210', '', 'cs-reply@amazon.com'),
(2, 'Ebay', '2025 Hamilton Avenue, San José, California 95125', '866-540-3229', 'customerhelp@ebay.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamo_activo`
--

CREATE TABLE `reclamo_activo` (
  `id_reclamo` int(11) NOT NULL,
  `cedula_empleado` int(11) DEFAULT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Fecha_reclamo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `cedula_empleado` int(11) DEFAULT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `id_ubicacion` int(11) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_activos`
--

CREATE TABLE `tipo_activos` (
  `id_tipo_activo` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_activos`
--

INSERT INTO `tipo_activos` (`id_tipo_activo`, `Nombre`, `Descripcion`) VALUES
(1, 'PC', 'Computadora de Mesa'),
(2, 'Laptop', 'Computador Portatil');

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
(2, 'Mant-Correctivo', 'Ocurre de forma imprevista cuando un equipo falla repentinamente, interrumpiendo la operación.');

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
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion_activos`
--

INSERT INTO `ubicacion_activos` (`id_Ubicacion`, `Nombre`) VALUES
(1, 'ITV'),
(2, 'Palco de Operaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_tipo_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario_email`, `clave`, `id_tipo_usuario`) VALUES
(25469224, 'keiberzamudia14@gmail.com', '25469224', 1);

=======
>>>>>>> a7aa1cf3f58a3362270f56b0862a9a35fecc8a8f
--
-- Índices para tablas volcadas
--

--
<<<<<<< HEAD
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
  ADD KEY `id_tipo_mantenimiento` (`id_tipo_mantenimiento`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_activo` (`id_activo`),
  ADD KEY `cedula_empleado` (`cedula_empleado`);

--
=======
>>>>>>> a7aa1cf3f58a3362270f56b0862a9a35fecc8a8f
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
<<<<<<< HEAD

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `cod_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `reclamo_activo`
--
ALTER TABLE `reclamo_activo`
  MODIFY `id_reclamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_activos`
--
ALTER TABLE `tipo_activos`
  MODIFY `id_tipo_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_mantenimiento`
--
ALTER TABLE `tipo_mantenimiento`
  MODIFY `id_tipo_mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ubicacion_activos`
--
ALTER TABLE `ubicacion_activos`
  MODIFY `id_Ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25469225;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activos`
--
ALTER TABLE `activos`
  ADD CONSTRAINT `activos_ibfk_2` FOREIGN KEY (`id_tipo_activo`) REFERENCES `tipo_activos` (`id_tipo_activo`),
  ADD CONSTRAINT `activos_ibfk_3` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion_activos` (`id_Ubicacion`);

--
-- Filtros para la tabla `activo_mantenimiento`
--
ALTER TABLE `activo_mantenimiento`
  ADD CONSTRAINT `activo_mantenimiento_ibfk_1` FOREIGN KEY (`id_tipo_mantenimiento`) REFERENCES `tipo_mantenimiento` (`id_tipo_mantenimiento`),
  ADD CONSTRAINT `activo_mantenimiento_ibfk_2` FOREIGN KEY (`id_activo`) REFERENCES `activos` (`id_activo`);

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `activos` (`id_activo`),
  ADD CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`cedula_empleado`) REFERENCES `empleado` (`cedula_empleado`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`cod_proveedor`) REFERENCES `proveedor` (`cod_proveedor`),
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`cedula_empleado`) REFERENCES `empleado` (`cedula_empleado`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id_cargo`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Filtros para la tabla `reclamo_activo`
--
ALTER TABLE `reclamo_activo`
  ADD CONSTRAINT `reclamo_activo_ibfk_1` FOREIGN KEY (`cedula_empleado`) REFERENCES `empleado` (`cedula_empleado`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`cedula_empleado`) REFERENCES `empleado` (`cedula_empleado`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`id_ubicacion`) REFERENCES `ubicacion_activos` (`id_Ubicacion`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`id_activo`) REFERENCES `activos` (`id_activo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);
=======
>>>>>>> a7aa1cf3f58a3362270f56b0862a9a35fecc8a8f
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
