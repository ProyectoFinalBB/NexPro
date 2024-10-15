-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 16:29:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `nexpro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usr` int(10) NOT NULL,
  `nombrecompleto` varchar(100) NOT NULL,
  `ci` int(8) NOT NULL,
  `contrasenia` varchar(255) DEFAULT NULL,
  `ruta_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usr`, `nombrecompleto`, `ci`, `contrasenia`, `ruta_img`) VALUES
(19, 'Choper Martin Garcia', 11211234, '$2y$10$P/fqEP2qb/tXjZvDu7dXWeNzHwawVp4bHA2gQ2utr5RC9BgSn1kDO', '../uploads/img/500x500.jpg'),
(23, 'Jomper Rodolfo Moreira', 55353754, '$2y$10$WyEx1dyCIc5sputwmNUKmOkCmz8tI5TQe8XJFdDbRyk.QdHzGmqXq', '../uploads/img/500x500.jpg'),
(32, 'Lucas  Ojeda Olivera', 55995129, '$2y$10$u8OC5pQYve3cgV9mE3cInea79bT9HPmkOBSfKxCkVeA8LQBo4nst6', NULL),
(34, 'hjhjjh hjhjhjhj hjjhjh hjhjhjhj', 56443876, '$2y$10$y7nSkJiSYJpxpjT1gvlz9eCvM2tEyE5D4qR9cI11TvVqV9I31qQZ2', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
