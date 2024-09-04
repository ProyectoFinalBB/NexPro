-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2024 a las 15:51:16
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
  `contrasenia` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usr`, `nombrecompleto`, `ci`, `contrasenia`) VALUES
(1, 'Alex Carnelli', 55353758, '$2y$10$XyeE/LSGsupcIqMwcg3PbeOuEwSX5HqpzJ6nLGD.vcjGLOjqWNtL2'),
(2, 'Candela Sosa', 12345678, '$2y$10$bLUaTp/d2Il6BgAln1fbA.aKnJdrK3JwBt5TwMqXCD6F0eOeD9hfK'),
(3, 'Candela Sosa', 12345678, '$2y$10$bLUaTp/d2Il6BgAln1fbA.aKnJdrK3JwBt5TwMqXCD6F0eOeD9hfK'),
(4, 'Lucas Ojeda', 12234567, '$2y$10$/6lWN4buSsVgda6nqnfvQu7Om2wy.QxvMCgTSINMKUIXbW1DXo77e'),
(5, 'Joaquin Stekl', 11111111, '$2y$10$rhSj2zmjF5.YXH/RWWAAzuIb.JNO8GtwayOIy.OG/MuBMCjHQxVFu'),
(6, 'Facundo Rubil', 22222222, '$2y$10$TR4os1dwDSm/YvghcIuDwe5jrR79OGM4TvR5q8lK/BxfJ3CmRgRj2'),
(7, 'Federico Fagundez', 12345676, '$2y$10$iwz2ZHPV8to1o6s9yIwjbeGJoZMl0MI.ZKSq7p7iLlLglDBbnoAZe'),
(8, 'Mamá MM', 23453456, '$2y$10$MZCQTM40FVoP1MGmG.GOROYmApfN6l4Kvp.BHNoTGmJxFodHn2myC'),
(9, 'Akla Robin', 34523456, '$2y$10$5TR0JJs.eLmaTa77kfqQ8.uUDczHTTD0VK4OGii43H4rS868mY3Fm');

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
  MODIFY `id_usr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
