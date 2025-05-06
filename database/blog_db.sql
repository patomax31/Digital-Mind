-- Creación de la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS `blog_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog_db`;

-- Tabla publicaciones_2 con campo para imágenes
CREATE TABLE IF NOT EXISTS `publicaciones_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titular` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion_corta` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL COMMENT 'Ruta/nombre del archivo de imagen',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,  -- Ampliado a 255 para almacenar hash seguro
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Reiniciar auto_increment para evitar conflictos
ALTER TABLE `publicaciones_2` AUTO_INCREMENT=8;