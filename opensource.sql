-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2025 a las 23:42:26
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
-- Base de datos: `opensource`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id_colaborador` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colaboradores`
--

INSERT INTO `colaboradores` (`id_colaborador`, `id_tarea`, `id_usuario`) VALUES
(37798, 12457, 36962);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtarea`
--

CREATE TABLE `subtarea` (
  `id` int(6) NOT NULL,
  `id_tarea` int(6) NOT NULL,
  `id_usuario` int(6) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` int(1) NOT NULL,
  `prioridad` int(1) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `fecha_recordatorio` date NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `colaborador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subtarea`
--

INSERT INTO `subtarea` (`id`, `id_tarea`, `id_usuario`, `descripcion`, `estado`, `prioridad`, `fecha_creacion`, `fecha_vencimiento`, `fecha_recordatorio`, `comentario`, `colaborador`) VALUES
(16160, 12457, 36962, 'ver', 1, 2, '2025-05-12', '2025-05-20', '0000-00-00', NULL, 0),
(45784, 23568, 36962, 'Implementar la gestión de sesiones para mantener el estado de usuario autenticado.', 2, 1, '2025-05-07', '2025-05-28', '2025-05-18', 'none', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `id` int(6) NOT NULL,
  `id_usuario` int(6) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `prioridad` int(1) NOT NULL,
  `estado` int(1) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `fecha_recordatorio` date DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `archivo` varchar(255) NOT NULL,
  `colaborador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`id`, `id_usuario`, `tema`, `descripcion`, `prioridad`, `estado`, `fecha_vencimiento`, `fecha_recordatorio`, `fecha_creacion`, `archivo`, `colaborador`) VALUES
(12457, 36962, 'Configurar base de datos', 'Definir tablas y relaciones en MySQL para las tareas y subtareas', 2, 1, '2025-05-28', '2025-05-15', '2025-05-01', '2', 0),
(15915, 36962, 'Redactar documentación del proyecto', 'Explicar el funcionamiento del sistema y la estructura de la base de datos', 3, 1, '2025-05-28', '2025-05-15', '2025-05-08', '1', 0),
(23568, 36962, 'Implementar autenticación de usuarios', 'Crear sistema de login y logout con gestión de sesiones en CodeIgniter', 1, 2, '2025-05-28', '2025-05-15', '2025-05-05', '1', 0),
(75323, 36962, 'Notificaciones de vencimiento', 'Implementar alertas para recordar fechas de vencimiento de tareas', 3, 2, '2025-05-28', '2025-05-15', '2025-05-08', '1', 0),
(78451, 36962, 'Diseñar interfaz de usuario', 'Crear una maqueta visual del panel de tareas usando Figma', 1, 2, '2025-05-18', '2025-05-12', '2025-04-30', '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(6) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contra` varchar(10) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `email`, `contra`, `fecha_creacion`) VALUES
(53, 'pablo', 'miranda', 'pabloo@gmail.com', '$2y$10$FBM', '0000-00-00'),
(63, 'pablo', 'miranda', 'pablohhoo@gmail.com', '$2y$10$ezJ', '0000-00-00'),
(372, 'pablo', 'miranda', 'pablo@gmail.com', '$2y$10$nTy', '0000-00-00'),
(381, 'pablo', 'miranda', 'pablohhojjo@gmail.com', '$2y$10$l8M', '0000-00-00'),
(407, 'pablo', 'miranda', 'pablooo@gmail.com', '$2y$10$mKj', '0000-00-00'),
(36962, 'camila', 'guglielmino', 'cami@gmail.com', '1111111', '2025-05-12'),
(37798, 'sdsd', 'sdds', 'cama@gmail.com', '5a55a55a5a', '2025-05-13'),
(70005, 'Juan', 'Perez', 'jperez@gmail.com', 'Password45', '2025-04-08'),
(75345, 'Luis', 'Sosa', 'luis.sosa@gmail.com', 'Password12', '2025-04-10'),
(84500, 'Sofia', 'Fernandez', 'soffia@gmail.com', 'Password78', '2025-04-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id_colaborador`),
  ADD KEY `id_tarea` (`id_tarea`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `subtarea`
--
ALTER TABLE `subtarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tarea` (`id_tarea`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD CONSTRAINT `colaboradores_ibfk_1` FOREIGN KEY (`id_colaborador`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `colaboradores_ibfk_2` FOREIGN KEY (`id_tarea`) REFERENCES `tarea` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `colaboradores_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subtarea`
--
ALTER TABLE `subtarea`
  ADD CONSTRAINT `subtarea_ibfk_1` FOREIGN KEY (`id_tarea`) REFERENCES `tarea` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
