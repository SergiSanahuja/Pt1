-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2023 a las 16:03:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_pt1`
--
CREATE DATABASE IF NOT EXISTS `proyecto_pt1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyecto_pt1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `continent`
--

CREATE TABLE `continent` (
  `id` int(11) NOT NULL,
  `nom_continent` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `continent`
--

INSERT INTO `continent` (`id`, `nom_continent`) VALUES
(1, 'Europa'),
(2, 'America'),
(3, 'Asia'),
(4, 'Oceania'),
(5, 'Africa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nom_Pais` varchar(20) NOT NULL,
  `id_continente` int(11) NOT NULL,
  `preu_nit` float NOT NULL,
  `preu_vols` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nom_Pais`, `id_continente`, `preu_nit`, `preu_vols`) VALUES
(1, 'Espanya', 1, 150, 70),
(2, 'Alemania', 1, 178, 100),
(3, 'Italia', 1, 145, 50),
(4, 'Grecia', 1, 110, 400),
(5, 'Luxemburg', 1, 72, 44),
(6, 'Argentina', 2, 79, 513),
(7, 'Brazil', 2, 71, 511),
(8, 'Mexico', 2, 70, 357),
(9, 'Canada', 2, 79, 340),
(10, 'Estados Unidos', 2, 100, 292),
(11, 'Tokyo', 3, 92, 374),
(12, 'Xina', 3, 86, 321),
(13, 'Tailàndia', 3, 80, 264),
(14, 'Nepal', 3, 70, 173);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserves`
--

CREATE TABLE `reserves` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `telefon` char(9) NOT NULL,
  `num_persones` smallint(6) NOT NULL,
  `preu_final` int(11) NOT NULL,
  `descompte` tinyint(1) NOT NULL,
  `nom_pais` varchar(20) NOT NULL,
  `data_inici` varchar(10) NOT NULL,
  `data_fi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserves`
--

INSERT INTO `reserves` (`id`, `nom`, `telefon`, `num_persones`, `preu_final`, `descompte`, `nom_pais`, `data_inici`, `data_fi`) VALUES
(54, 'sergi', '123321122', 1, 466, 0, 'Tokyo', '2023-11-20', '2023-11-21'),
(55, 'Sergi', '699125192', 1, 1095, 0, 'Xina', '2023-11-29', '2023-12-08'),
(59, 'Sergi', '123123123', 1, 278, 0, 'Alemania', '2023-12-04', '2023-12-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `Nom` varchar(10) NOT NULL,
  `Telefono` char(9) NOT NULL,
  `Descuento` tinyint(1) NOT NULL,
  `DNI` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`DNI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `continent`
--
ALTER TABLE `continent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `reserves`
--
ALTER TABLE `reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `fk_pais_continente` FOREIGN KEY (`id_continente`) REFERENCES `continent` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
