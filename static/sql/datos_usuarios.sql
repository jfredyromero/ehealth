-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2021 a las 23:27:56
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(60) CHARACTER SET latin1 NOT NULL,
  `identificacion` varchar(16) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(60) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `login` varchar(20) CHARACTER SET latin1 NOT NULL,
  `passwd` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `id_tarjeta` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id`, `nombre_completo`, `identificacion`, `direccion`, `fecha_nacimiento`, `login`, `passwd`, `tipo_usuario`, `id_tarjeta`, `activo`) VALUES
(1, 'Santiago Yangana Montoya', '22022000', 'Calle 5 #409-100', '2000-02-22', 'Santi', '123456789', 0, 3, 1),
(3, 'Nathalia Isabel ', '1061809038', 'Cra 15N #89-23', '1998-04-20', 'Natha', '123456789', 0, 4, 1),
(5, 'Pepito Perez', '0000011', 'Call 5 #34N-25', '2000-05-18', 'Pepito', '123456789', 0, 6, 1),
(6, 'lulita pooo', '111', 'El recuerdo', '1997-05-02', 'LULA', '123456789', 1, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
