-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2024 a las 16:30:25
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
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `id_integrantes` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','aceptado','denegado') DEFAULT 'pendiente',
  `id_usr_creador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `titulo`, `descripcion`, `ruta`, `id_integrantes`, `tags`, `fecha_subida`, `estado`, `id_usr_creador`) VALUES
(38, 'NexPro', 'Software para proyectos', 'Practico CU.pdf', '32', 'Educación', '2024-10-07 18:26:46', 'aceptado', NULL),
(39, 'aa', 'aa', 'Practico CU.pdf', '32', 'Entretenimiento', '2024-10-07 18:56:01', 'aceptado', NULL),
(40, 'HAHJHa', 'hjGJ', 'Escrito Formación Empresarial.pdf', '33', 'Finanzas,Ciber seguridad', '2024-10-08 14:12:14', 'aceptado', NULL),
(41, 'aa', 'aa', 'Escrito Formación Empresarial.pdf', '33', 'Entretenimiento', '2024-10-08 15:05:00', 'aceptado', 32),
(42, 'fede', 'ingles', 'Escrito Formación Empresarial.pdf', '33', 'Educación', '2024-10-09 15:46:10', 'denegado', 23),
(43, 'fede', 'ingles', 'Escrito Formación Empresarial.pdf', '33', 'Educación', '2024-10-09 15:46:15', 'aceptado', 23),
(44, 'sssssssssss', 'ssssssss', 'Practico CU.pdf', '33', 'Entretenimiento', '2024-10-10 10:57:04', 'aceptado', 23),
(45, 'NexPro', 'hjhjhjhhj', 'Practico CU.pdf', '23', 'Entretenimiento', '2024-10-10 13:45:40', 'pendiente', 32);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
