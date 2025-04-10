-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2025 a las 17:28:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

USE blog_db;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones_2`
--

CREATE TABLE `publicaciones_2` (
  `id` int(11) NOT NULL,
  `titular` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion_corta` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones_2`
--

INSERT INTO `publicaciones_2` (`id`, `titular`, `fecha`, `descripcion_corta`, `contenido`, `referencia`, `fecha_creacion`) VALUES
(1, 'Travestis a Domicilio', '2025-04-01', 'Se abre nuevo negocio emprendedor', 'Aparta el tuyo ya', '', '2025-04-03 17:28:47'),
(3, 'me encuentro a mi primo cachondo en la cocina y me lo cogo bien rico sobre la mesa y se viene pero sale mal', '2025-04-03', 'pene', 'me la estaba jalando h mi prima me descubrio!!', '', '2025-04-03 18:10:08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `publicaciones_2`
--
ALTER TABLE `publicaciones_2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `publicaciones_2`
--
ALTER TABLE `publicaciones_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
