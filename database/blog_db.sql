-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2025 a las 07:22:53
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
-- Base de datos: `blogs`
--
CREATE DATABASE IF NOT EXISTS `blogs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blogs`;

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
--
-- Base de datos: `blog_db`
--
CREATE DATABASE IF NOT EXISTS `blog_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog_db`;

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
  `imagen` varchar(255) DEFAULT NULL COMMENT 'Ruta/nombre del archivo de imagen',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
  'categoria' varcha(50) not NULL after 'imagen';
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones_2`
--

INSERT INTO `publicaciones_2` (`id`, `titular`, `fecha`, `descripcion_corta`, `contenido`, `referencia`, `imagen`, `fecha_creacion`) VALUES
(14, 'Esto es un test', '2025-04-30', 'testeo', 'Esto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un test', 'https://www.google.com', 'img_6812f27f023e9.png', '2025-05-01 04:03:11'),
(15, 'testeo del blog', '2006-01-01', 'descripcion corta aca de la educacion y asi', 'contenido aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi\r\ndescripcion corta aca de la educacion y asi', 'https://www.google.com', 'img_6818b848500f5.jpg', '2025-05-05 13:08:24'),
(16, 'aInfinity free best hosting online', '2025-05-08', 'Infinity free best hosting online', '&lt;p&gt;Infinity free best hosting onlineInfinity free best hosting online&lt;/p&gt;\r\n&lt;p&gt;Infinity free best hosting online&lt;/p&gt;\r\n&lt;p&gt;Infinity free best hosting online&lt;/p&gt;\r\n&lt;p&gt;Infinity free best hosting online&lt;/p&gt;', 'https://www.google.com', 'img_681c28ee340ec.png', '2025-05-08 03:45:50'),
(17, 'testeosdfbn', '2025-05-08', 'Infinity free best hosting online', '&lt;div&gt;\r\n&lt;div&gt;&amp;nbsp;&amp;lt;header class=&quot;page-header-footer sliding-header&quot; id=&quot;slidingHeader&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;page-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-left&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;logo&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;index.php&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;img src=&quot;../images/Logo_Mk2.png&quot; alt=&quot;Logo de DIGITALMIND&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-actions-left&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;create-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; class=&quot;size-6&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;../PHP/blog_add.php&quot; class=&quot;&quot;&amp;gt;Crear Blog&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;category-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;#&quot; class=&quot;&quot;&amp;gt;Categor&amp;iacute;a&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-right&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;Login-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; class=&quot;size-6&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;../PHP/register.php&quot; class=&quot;&quot;&amp;gt;Iniciar sesi&amp;oacute;n&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;search-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;pill-search&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;search-icon&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; width=&quot;20&quot; height=&quot;20&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;input type=&quot;text&quot; class=&quot;search-input&quot; placeholder=&quot;Buscar...&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;lt;/header&amp;gt;\r\n&lt;div&gt;\r\n&lt;div&gt;&amp;nbsp;&amp;lt;header class=&quot;page-header-footer sliding-header&quot; id=&quot;slidingHeader&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;page-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-left&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;logo&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;index.php&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;img src=&quot;../images/Logo_Mk2.png&quot; alt=&quot;Logo de DIGITALMIND&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-actions-left&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;create-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; class=&quot;size-6&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;../PHP/blog_add.php&quot; class=&quot;&quot;&amp;gt;Crear Blog&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;category-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;#&quot; class=&quot;&quot;&amp;gt;Categor&amp;iacute;a&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-right&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;Login-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; class=&quot;size-6&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;../PHP/register.php&quot; class=&quot;&quot;&amp;gt;Iniciar sesi&amp;oacute;n&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;search-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;pill-search&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;search-icon&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; width=&quot;20&quot; height=&quot;20&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;input type=&quot;text&quot; class=&quot;search-input&quot; placeholder=&quot;Buscar...&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;lt;/header&amp;gt;\r\n&lt;div&gt;\r\n&lt;div&gt;&amp;nbsp;&amp;lt;header class=&quot;page-header-footer sliding-header&quot; id=&quot;slidingHeader&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;page-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-left&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;logo&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;index.php&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;img src=&quot;../images/Logo_Mk2.png&quot; alt=&quot;Logo de DIGITALMIND&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-actions-left&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;create-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; class=&quot;size-6&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;../PHP/blog_add.php&quot; class=&quot;&quot;&amp;gt;Crear Blog&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;category-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;#&quot; class=&quot;&quot;&amp;gt;Categor&amp;iacute;a&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;header-right&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;action-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg class=&quot;Login-icon&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; class=&quot;size-6&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;a href=&quot;../PHP/register.php&quot; class=&quot;&quot;&amp;gt;Iniciar sesi&amp;oacute;n&amp;lt;/a&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;search-container&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;pill-search&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;div class=&quot;search-icon&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;currentColor&quot; width=&quot;20&quot; height=&quot;20&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;path fill-rule=&quot;evenodd&quot; d=&quot;M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z&quot; clip-rule=&quot;evenodd&quot; /&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/svg&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;input type=&quot;text&quot; class=&quot;search-input&quot; placeholder=&quot;Buscar...&quot;&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;nbsp; &amp;lt;/div&amp;gt;&lt;/div&gt;\r\n&lt;div&gt;&amp;nbsp; &amp;lt;/header&amp;gt;&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 'https://www.google.com', 'img_681c29145ae9a.png', '2025-05-08 03:46:28'),
(18, 'testeo de texto', '2025-05-08', 'testeo de texto', '&lt;div&gt;\r\n&lt;div&gt;&amp;nbsp;&lt;/div&gt;\r\n&lt;div&gt;\r\n&lt;div&gt;\r\n&lt;div&gt;&amp;nbsp;&lt;/div&gt;\r\n&lt;div&gt;&lt;em&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis soluta quibusdam harum ea corporis eos? Quae molestias exercitationem pariatur aperiam facere saepe temporibus, totam amet voluptas? Officia atque maxime amet!&lt;/em&gt;&lt;/div&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;div&gt;&amp;nbsp;&lt;/div&gt;\r\n&lt;div&gt;\r\n&lt;ol&gt;\r\n&lt;li&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis soluta quibusdam harum ea corporis eos? Quae molestias exercitationem pariatur aperiam facere saepe temporibus, totam amet voluptas? Officia atque maxime amet!&lt;/li&gt;\r\n&lt;li&gt;\r\n&lt;div&gt;\r\n&lt;div&gt;&amp;nbsp;&lt;/div&gt;\r\n&lt;div&gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis soluta quibusdam harum ea corporis eos? Quae molestias exercitationem pariatur aperiam facere saepe temporibus, totam amet voluptas? Officia atque maxime amet!&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/li&gt;\r\n&lt;/ol&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;\r\n&lt;/div&gt;', 'https://www.google.com', 'img_681c298018b20.jpg', '2025-05-08 03:48:16'),
(19, 'nombre del blog', '0001-01-01', 'ejemplo', '&lt;p&gt;ejemploejemploejemploejemploejemploejemploejemploejemploejemploejemploejemploejemplo&lt;/p&gt;', 'https://www.google.com', 'img_681c2b2fd9e84.webp', '2025-05-08 03:55:27'),
(20, 'tes imagentetet', '0001-01-01', 'fef', '&lt;p&gt;&lt;strong&gt;fefeef&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;em&gt;fefeef&lt;/em&gt;&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: center;&quot;&gt;&lt;em&gt;fefeef&lt;/em&gt;&lt;em&gt;fefeef&lt;/em&gt;&lt;em&gt;fefeef&lt;/em&gt;&lt;em&gt;fefeef&lt;/em&gt;&lt;em&gt;ffefeeffefeeffefeeffefeefefeef&lt;/em&gt;&lt;/p&gt;', 'https://www.google.com', 'img_681c2b9679c90.png', '2025-05-08 03:57:10'),
(21, 'testeo epico', '0001-01-01', 'yea perdonen', '&lt;p&gt;&lt;em&gt;yea perdonen&lt;/em&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;yea perdonen&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;yea perdonen&lt;/strong&gt;&lt;/p&gt;\n&lt;ol&gt;\n&lt;li style=&quot;text-align: left;&quot;&gt;&lt;strong&gt;yea perdonen&lt;/strong&gt;&lt;/li&gt;\n&lt;li style=&quot;text-align: left;&quot;&gt;&lt;strong&gt;yea perdonen&lt;/strong&gt;&lt;/li&gt;\n&lt;/ol&gt;\n&lt;ul&gt;\n&lt;li&gt;&lt;strong&gt;yea perdonen&lt;/strong&gt;&lt;/li&gt;\n&lt;/ul&gt;', 'https://www.google.com', 'img_681c2dbc0de74.jpg', '2025-05-08 04:06:20'),
(22, 'test texto', '0001-01-01', 'testeo texto', '<p><strong>Text test</strong></p>\r\n<p><strong>Text test</strong></p>\r\n<p><strong>Text test</strong></p>\r\n<p><strong>Text test</strong></p>\r\n<p><em><strong>Text test</strong></em></p>\r\n<ol>\r\n<li><em><strong>Text test</strong></em></li>\r\n<li><em><strong>Text test</strong></em></li>\r\n<li><em><strong>Text test</strong></em><em><strong></strong></em></li>\r\n</ol>\r\n<p><em><strong>Text test</strong></em></p>\r\n<ul>\r\n<li><em><strong>Text test</strong></em></li>\r\n<li><em><strong>Text test</strong></em></li>\r\n</ul>', 'https://www.google.com', 'img_681c38d636c38.png', '2025-05-08 04:53:42'),
(23, 'ejemplo de imagendfg', '0005-05-05', 'descrpcion', '<p>hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola </p>\r\n<p><img src=\"https://gdm-catalog-fmapi-prod.imgix.net/ProductScreenshot/e25018ef-1f01-428d-9a64-bf2b40a89298.png?auto=format&amp;q=50\" alt=\"\"></p>', 'https://www.google.com', 'img_681c3a64c7e86.png', '2025-05-08 05:00:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(7) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contraseña`) VALUES
(1, 'carlos', 'carlosleonardorosas@gmail.com', '$2y$10$IBoIqBh85ol8mZcjoGceiOZlzurqUVaqPxgx8EO2emtPSlzndu23m'),
(2, 'carlos', 'fi3hnm5yiohm569@gmail.com', '$2y$10$mbnSvnVWaKRU8aKlqIMyluTQ9dFa5zBlyzNj4881xD/ch.TeMfPZW'),
(3, 'carlos', 'carlos@gmail.com', '$2y$10$Sj.UhE.TUEBBwZvaz5K/i.Mf.fRe6SHB.eSfHczTbHdYezgRNJLEW'),
(4, 'a', 'a@gmail.com', '$2y$10$kPSpRUZiQ47V7pwVGC1OhuvHbZ8VvvxNOmNDjS/PzxZl87a/NOQw.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `publicaciones_2`
--
ALTER TABLE `publicaciones_2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `publicaciones_2`
--
ALTER TABLE `publicaciones_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Base de datos: `database`
--
CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `database`;
--
-- Base de datos: `login`
--
CREATE DATABASE IF NOT EXISTS `login` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `login`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Error leyendo la estructura de la tabla login.usuarios: #1932 - Table &#039;login.usuarios&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla login.usuarios: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `login`.`usuarios`&#039; en la linea 1
--
-- Base de datos: `pagina_web`
--
CREATE DATABASE IF NOT EXISTS `pagina_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pagina_web`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--
-- Error leyendo la estructura de la tabla pagina_web.publicaciones: #1932 - Table &#039;pagina_web.publicaciones&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla pagina_web.publicaciones: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `pagina_web`.`publicaciones`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Error leyendo la estructura de la tabla pagina_web.usuarios: #1932 - Table &#039;pagina_web.usuarios&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla pagina_web.usuarios: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `pagina_web`.`usuarios`&#039; en la linea 1
--
-- Base de datos: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__bookmark`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__bookmark: #1932 - Table &#039;phpmyadmin.pma__bookmark&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__bookmark: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__bookmark`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__central_columns`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__central_columns: #1932 - Table &#039;phpmyadmin.pma__central_columns&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__central_columns: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__central_columns`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__column_info`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__column_info: #1932 - Table &#039;phpmyadmin.pma__column_info&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__column_info`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__designer_settings`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__designer_settings: #1932 - Table &#039;phpmyadmin.pma__designer_settings&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__designer_settings: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__designer_settings`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__export_templates`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__export_templates: #1932 - Table &#039;phpmyadmin.pma__export_templates&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__export_templates: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__export_templates`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__favorite`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__favorite: #1932 - Table &#039;phpmyadmin.pma__favorite&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__favorite: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__favorite`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__history`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__history: #1932 - Table &#039;phpmyadmin.pma__history&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__history: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__history`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__navigationhiding`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__navigationhiding: #1932 - Table &#039;phpmyadmin.pma__navigationhiding&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__navigationhiding: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__navigationhiding`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__pdf_pages`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__pdf_pages: #1932 - Table &#039;phpmyadmin.pma__pdf_pages&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__pdf_pages: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__pdf_pages`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__recent`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__recent: #1932 - Table &#039;phpmyadmin.pma__recent&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__recent: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__recent`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__relation`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__relation: #1932 - Table &#039;phpmyadmin.pma__relation&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__relation: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__relation`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__savedsearches`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__savedsearches: #1932 - Table &#039;phpmyadmin.pma__savedsearches&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__savedsearches: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__savedsearches`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_coords`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__table_coords: #1932 - Table &#039;phpmyadmin.pma__table_coords&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__table_coords: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__table_coords`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_info`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__table_info: #1932 - Table &#039;phpmyadmin.pma__table_info&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__table_info: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__table_info`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__table_uiprefs`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__table_uiprefs: #1932 - Table &#039;phpmyadmin.pma__table_uiprefs&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__table_uiprefs`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__tracking`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__tracking: #1932 - Table &#039;phpmyadmin.pma__tracking&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__tracking`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__userconfig`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__userconfig: #1932 - Table &#039;phpmyadmin.pma__userconfig&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__userconfig: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__userconfig`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__usergroups`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__usergroups: #1932 - Table &#039;phpmyadmin.pma__usergroups&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__usergroups: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__usergroups`&#039; en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pma__users`
--
-- Error leyendo la estructura de la tabla phpmyadmin.pma__users: #1932 - Table &#039;phpmyadmin.pma__users&#039; doesn&#039;t exist in engine
-- Error leyendo datos de la tabla phpmyadmin.pma__users: #1064 - Algo está equivocado en su sintax cerca &#039;FROM `phpmyadmin`.`pma__users`&#039; en la linea 1
--
-- Base de datos: `posts`
--
CREATE DATABASE IF NOT EXISTS `posts` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `posts`;
--
-- Base de datos: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
