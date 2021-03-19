-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2021 at 06:48 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyecto_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `datos_dispositivos`
--

CREATE TABLE `datos_dispositivos` (
  `id_tarjeta` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `propietario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datos_dispositivos`
--

INSERT INTO `datos_dispositivos` (`id_tarjeta`, `estado`, `ubicacion`, `propietario`) VALUES
(1, 0, 'Popayan', 'Lina'),
(2, 1, 'Popayan', 'Laura'),
(3, 0, 'Popayan', 'Santiago'),
(4, 1, 'Popayan', 'Jhon');

-- --------------------------------------------------------

--
-- Table structure for table `datos_maximos`
--

CREATE TABLE `datos_maximos` (
  `id` int(11) NOT NULL,
  `enfermedad` varchar(40) NOT NULL,
  `max_temp` int(11) NOT NULL,
  `max_hum` int(11) NOT NULL,
  `pre_lluvia` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datos_maximos`
--

INSERT INTO `datos_maximos` (`id`, `enfermedad`, `max_temp`, `max_hum`, `pre_lluvia`) VALUES
(1, 'fiebre_amarilla', 50, 80, '1'),
(2, 'dengue', 13, 13, '0');

-- --------------------------------------------------------

--
-- Table structure for table `datos_medidos`
--

CREATE TABLE `datos_medidos` (
  `id` int(11) NOT NULL,
  `id_tarjeta` int(11) NOT NULL,
  `temperatura` float NOT NULL,
  `humedad` float NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(20) NOT NULL,
  `lluvia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datos_medidos`
--

INSERT INTO `datos_medidos` (`id`, `id_tarjeta`, `temperatura`, `humedad`, `fecha`, `hora`, `lluvia`) VALUES
(1, 1, 28.8, 51.6, '2018-02-15', '15:17:15', 1),
(2, 1, 28.8, 51.8, '2018-02-15', '15:17:25', 0),
(3, 1, 28.7, 52, '2018-02-15', '15:17:35', 0),
(4, 1, 28.6, 52.2, '2018-02-15', '15:17:44', 1),
(5, 1, 28.5, 52.4, '2018-02-15', '15:17:53', 0),
(6, 1, 28.4, 52.6, '2018-02-15', '15:18:03', 1),
(7, 1, 28.3, 52.8, '2018-02-15', '15:18:12', 1),
(8, 1, 28.2, 53, '2018-02-15', '15:18:24', 1),
(9, 1, 28.1, 53.5, '2018-02-15', '15:18:34', 1),
(10, 1, 28, 53.6, '2018-02-15', '15:18:44', 1),
(11, 1, 27.9, 53.7, '2018-02-15', '15:18:53', 1),
(12, 1, 27.9, 53.8, '2018-02-15', '15:19:03', 1),
(13, 1, 27.9, 54, '2018-02-15', '15:19:12', 1),
(14, 1, 27.8, 54.2, '2018-02-15', '15:19:22', 1),
(15, 1, 27.8, 54.2, '2018-02-15', '15:19:31', 1),
(16, 1, 27.7, 54.3, '2018-02-15', '15:19:41', 1),
(17, 1, 27.7, 54.4, '2018-02-15', '15:19:50', 1),
(18, 1, 27.6, 54.5, '2018-02-15', '15:19:59', 1),
(19, 1, 27.6, 54.5, '2018-02-15', '15:20:09', 1),
(20, 1, 27.6, 54.7, '2018-02-15', '15:20:19', 1),
(21, 1, 27.5, 54.7, '2018-02-15', '15:20:28', 1),
(22, 1, 27.5, 54.7, '2018-02-15', '15:20:38', 1),
(23, 1, 27.4, 54.9, '2018-02-15', '15:20:47', 1),
(24, 1, 27.4, 55, '2018-02-15', '15:20:57', 1),
(25, 1, 27.3, 55, '2018-02-15', '15:21:06', 1),
(26, 1, 27.3, 55.3, '2018-02-15', '15:21:16', 0),
(27, 1, 27.2, 55.4, '2018-02-15', '15:21:25', 1),
(28, 1, 27.2, 55.5, '2018-02-15', '15:21:35', 1),
(29, 1, 27.1, 55.7, '2018-02-15', '15:21:44', 1),
(30, 1, 27.1, 55.8, '2018-02-15', '15:21:54', 1),
(31, 1, 27.1, 55.7, '2018-02-15', '15:22:03', 1),
(32, 1, 27.1, 55.8, '2018-02-15', '15:22:12', 1),
(33, 1, 27, 55.8, '2018-02-15', '15:22:22', 1),
(34, 1, 27, 55.8, '2018-02-15', '15:22:31', 1),
(35, 1, 27, 55.9, '2018-02-15', '15:22:41', 1),
(36, 1, 27, 56, '2018-02-15', '15:22:50', 1),
(37, 1, 26.9, 56.1, '2018-02-15', '15:23:00', 1),
(38, 1, 26.9, 56.6, '2018-02-15', '15:23:09', 1),
(39, 1, 26.9, 56.4, '2018-02-15', '15:23:19', 1),
(40, 1, 26.8, 56.5, '2018-02-15', '15:23:28', 1),
(41, 1, 26.8, 57.5, '2018-02-15', '15:23:38', 1),
(42, 1, 26.8, 56.6, '2018-02-15', '15:23:47', 1),
(43, 1, 26.8, 57, '2018-02-15', '15:23:57', 1),
(44, 1, 26.8, 56.7, '2018-02-15', '15:24:06', 1),
(45, 1, 26.8, 56.5, '2018-02-15', '15:24:16', 1),
(46, 1, 26.8, 56.4, '2018-02-15', '15:24:25', 1),
(47, 1, 26.8, 57, '2018-02-15', '15:24:35', 1),
(48, 1, 26.7, 56.7, '2018-02-15', '15:24:44', 1),
(49, 1, 26.7, 56.7, '2018-02-15', '15:24:53', 1),
(50, 1, 26.7, 56.5, '2018-02-15', '15:25:03', 1),
(51, 1, 26.7, 56.6, '2018-02-15', '15:25:12', 1),
(52, 1, 26.7, 56.6, '2018-02-15', '15:25:22', 1),
(53, 1, 26.7, 56.5, '2018-02-15', '15:25:31', 1),
(54, 1, 26.7, 56.6, '2018-02-15', '15:25:41', 1),
(55, 1, 26.7, 60.5, '2018-02-15', '15:25:50', 1),
(56, 1, 26.7, 58, '2018-02-14', '15:26:00', 0),
(57, 1, 26.7, 57.2, '2018-02-14', '15:26:09', 1),
(58, 1, 26.7, 56.9, '2018-02-14', '15:26:19', 1),
(59, 1, 26.7, 56.8, '2018-02-14', '15:26:28', 1),
(60, 1, 26.7, 56.8, '2018-02-14', '15:26:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datos_dispositivos`
--
ALTER TABLE `datos_dispositivos`
  ADD PRIMARY KEY (`id_tarjeta`);

--
-- Indexes for table `datos_maximos`
--
ALTER TABLE `datos_maximos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datos_medidos`
--
ALTER TABLE `datos_medidos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datos_maximos`
--
ALTER TABLE `datos_maximos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `datos_medidos`
--
ALTER TABLE `datos_medidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
