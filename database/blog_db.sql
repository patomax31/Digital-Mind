-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2025 a las 01:21:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `blog_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog_db`;

CREATE TABLE IF NOT EXISTS `publicaciones_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titular` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion_corta` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `publicaciones_2` (`id`, `titular`, `fecha`, `descripcion_corta`, `contenido`, `referencia`, `fecha_creacion`) VALUES
(1, 'Travestis a Domicilio', '2025-04-01', 'Se abre nuevo negocio emprendedor', 'Aparta el tuyo ya', '', '2025-04-03 17:28:47'),
(3, 'me encuentro a mi primo cachondo en la cocina y me lo cogo bien rico sobre la mesa y se viene pero sale mal', '2025-04-03', 'pene', 'me la estaba jalando h mi prima me descubrio!!', '', '2025-04-03 18:10:08');

ALTER TABLE `publicaciones_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

CREATE DATABASE IF NOT EXISTS `blog_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog_db`;

CREATE TABLE `publicaciones_2` (
  `id` int(11) NOT NULL,
  `titular` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion_corta` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL COMMENT 'Ruta/nombre del archivo de imagen',
  `categoria` varchar(50) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `publicaciones_2` (`id`, `titular`, `fecha`, `descripcion_corta`, `contenido`, `referencia`, `imagen`, `categoria`, `fecha_creacion`) VALUES
(14, 'Esto es un test', '2025-04-30', 'testeo', 'Esto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un testEsto es un test', 'https://www.google.com', 'img_6812f27f023e9.png', '', '2025-05-01 04:03:11'),
(25, 'test de categoria', '0001-01-01', 'descripcion corta obligatoria?', '<p><strong>test de categoria</strong></p>\r\n<p><strong>test de categoria</strong></p>\r\n<p><strong>test de categoria</strong></p>\r\n<ul>\r\n<li><strong>test de categoria</strong></li>\r\n<li><strong>test de categoria</strong></li>\r\n<li><strong>test de categoria</strong></li>\r\n</ul>', 'https://www.google.com', 'img_681e43a02492c.webp', 'Métodos de Aprendizaje', '2025-05-09 18:04:16'),
(26, 'test de categoria', '0001-01-01', 'descripcion corta obligatoria?', '<p><strong>test de categoria</strong></p>\r\n<p><strong>test de categoria</strong></p>\r\n<p><strong>test de categoria</strong></p>\r\n<ul>\r\n<li><strong>test de categoria</strong></li>\r\n<li><strong>test de categoria</strong></li>\r\n<li><strong>test de categoria</strong></li>\r\n</ul>', 'https://www.google.com', 'img_681e44c0377f6.webp', 'Métodos de Aprendizaje', '2025-05-09 18:09:04'),
(27, 'test de categoria final', '0002-01-01', 'escuela primaria', '<p>test de categoria final</p>\r\n<p>test de categoria final</p>\r\n<p>test de categoria final</p>\r\n<p>test de categoria finaltest de categoria finaltest de categoria finaltest de categoria finaltest de categoria final</p>', 'https://www.google.com', 'img_681e457bf21ba.png', 'Educación Primaria', '2025-05-09 18:12:11');

CREATE TABLE `usuarios` (
  `id` int(7) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contraseña`) VALUES
(1, 'carlos', 'carlosleonardorosas@gmail.com', '$2y$10$IBoIqBh85ol8mZcjoGceiOZlzurqUVaqPxgx8EO2emtPSlzndu23m'),
(2, 'carlos', 'fi3hnm5yiohm569@gmail.com', '$2y$10$mbnSvnVWaKRU8aKlqIMyluTQ9dFa5zBlyzNj4881xD/ch.TeMfPZW'),
(3, 'carlos', 'carlos@gmail.com', '$2y$10$Sj.UhE.TUEBBwZvaz5K/i.Mf.fRe6SHB.eSfHczTbHdYezgRNJLEW'),
(4, 'a', 'a@gmail.com', '$2y$10$kPSpRUZiQ47V7pwVGC1OhuvHbZ8VvvxNOmNDjS/PzxZl87a/NOQw.');

ALTER TABLE `publicaciones_2`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `publicaciones_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

ALTER TABLE `usuarios`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `database`;

CREATE DATABASE IF NOT EXISTS `login` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `login`;

CREATE DATABASE IF NOT EXISTS `pagina_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pagina_web`;

CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

CREATE DATABASE IF NOT EXISTS `posts` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `posts`;

CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Tabla de comentarios
CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE `publicaciones_2` 
ADD COLUMN `categoria` VARCHAR(50) NOT NULL AFTER `imagen`;

ALTER TABLE usuarios ADD COLUMN rol ENUM('admin', 'usuario') DEFAULT 'usuario';

ALTER TABLE usuarios ADD COLUMN rol VARCHAR(20) DEFAULT 'usuario';

CREATE TABLE `contacto` (
  `id` int(7) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `contacto`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
