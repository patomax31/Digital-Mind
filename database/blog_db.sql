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



-- Tabla del administrador
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (usuario, clave)
VALUES ('Ernesto', 'Q1234567');

-- Reiniciar auto_increment para evitar conflictos
ALTER TABLE `publicaciones_2` AUTO_INCREMENT=8;
