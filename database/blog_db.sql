-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2025 a las 15:45:53
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
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones_2`
--

INSERT INTO `publicaciones_2` (`id`, `titular`, `fecha`, `descripcion_corta`, `contenido`, `referencia`, `fecha_creacion`) VALUES
(4, 'a', '0001-01-01', '2', '2', '', '2025-04-10 17:16:39'),
(6, 'a', '0001-01-01', 'a', 'a', '', '2025-04-22 01:56:20'),
(7, 'montesori', '0091-09-09', 'El Método Montessori es un modelo educativo revolucionario desarrollado por la Dra. María Montessori (1870-1952), primera mujer médico en Italia y pionera en pedagogía científica. Su enfoque se basa en la \"autonomía, la libertad con límites\" y el respeto ', 'El Método Montessori es un modelo educativo revolucionario desarrollado por la Dra. María Montessori (1870-1952), primera mujer médico en Italia y pionera en pedagogía científica. Su enfoque se basa en la \"autonomía, la libertad con límites\" y el respeto por el desarrollo natural del niño. Aquí te explico sus principios clave y cómo funciona:\r\n\r\nPrincipios Fundamentales\r\nAyúdame a hacerlo por mí mismo.\r\nLos niños aprenden de manera \"autodirigida\", usando materiales didácticos especializados.\r\nEl rol del adulto es guiar, no dirigir.\r\nAmbiente Preparado:\r\nAulas ordenadas, con materiales accesibles y adecuados a cada etapa de desarrollo (ej.: torres rosa, letras de lija).\r\nDiseñado para fomentar la exploración sensorial y la concentración.\r\nMentes Absorbentes:\r\nLos niños de 0 a 6 años tienen una capacidad innata para absorber conocimientos como esponjas (ej.: aprender idiomas sin esfuerzo).\r\nPeríodos Sensibles:\r\nMomentos críticos en los que el niño está biológicamente preparado para adquirir habilidades específicas (ej.: lenguaje, orden, movimiento).\r\nLibertad con Responsabilidad:\r\nLos niños eligen sus actividades, pero dentro de un marco de normas claras (ej.: respetar a los demás y el material).\r\nCaracterísticas del Aula Montessori\r\nEdades mezcladas (ej.: 3-6 años en Casa de Niños): Los pequeños aprenden de los mayores, y estos refuerzan su conocimiento enseñando.\r\nMateriales autocorrectivos: El niño detecta sus errores sin necesidad de intervención del adulto (ej.: encajes de cilindros).\r\nEnfoque en la vida práctica: Actividades como lavar platos o abrochar botones desarrollan coordinación y autonomía.\r\nBeneficios\r\nDesarrollo de la independencia y autoestima.\r\nAprendizaje significativo (sin memorización forzada).\r\nRespeto por los ritmos individuales: No hay exámenes ni comparaciones.\r\nFomento de la creatividad y el pensamiento crítico.\r\nCríticas y Mitos\r\nEs demasiado libre: En realidad, promueve autodisciplina mediante límites claros.\r\nSolo para ricos: Aunque muchos colegios Montessori son privados, la filosofía puede adaptarse en casa con recursos sencillos (ej.: ordenar utensilios de cocina por tamaño).', 'https://www.google.com', '2025-04-22 02:18:52');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
