-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2023 a las 17:41:52
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_ticket`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `numero_ticket` varchar(250) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `nombre_solicitante` varchar(250) NOT NULL,
  `tipo_ticket` varchar(250) NOT NULL,
  `detalle_ticket` varchar(250) NOT NULL,
  `estado_ticket` varchar(250) NOT NULL,
  `fecha_ticket` datetime NOT NULL,
  `id_usuario_soporte` int(11) NOT NULL,
  `nombre_usuario_soporte` varchar(250) NOT NULL,
  `fecha_revision_soporte` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `numero_ticket`, `id_usuario`, `nombre_solicitante`, `tipo_ticket`, `detalle_ticket`, `estado_ticket`, `fecha_ticket`, `id_usuario_soporte`, `nombre_usuario_soporte`, `fecha_revision_soporte`) VALUES
(1, 'tk001', 1, 'Maria Fernandez', 'soporte', 'necesito ayuda con la impresora se atasco el papel', 'pendiente', '2023-12-02 17:44:20', 0, '0', '0000-00-00 00:00:00'),
(2, 'tk87449', 1, 'jose jimenez', 'soporte', 'detalle de prueba de inserción de datos en la database ', 'pendiente', '2023-12-03 01:21:09', 2, 'soporte1', '2023-12-03 22:49:17'),
(3, 'tk21215', 1, 'javier macherano', 'soporte', 'prueba ', 'pendiente', '2023-12-02 19:23:25', 0, '0', '0000-00-00 00:00:00'),
(4, 'tk46875', 1, 'ricon ozuna', 'toner', 'asfsafdsafdsfdsfdsfsfsdfadfds\r\nfdsfdsfdsf', 'pendiente', '2023-12-02 19:27:30', 0, '0', '0000-00-00 00:00:00'),
(7, 'tk27490', 1, 'roberto martinez', 'toner', 'prueba de toner', 'pendiente', '2023-12-03 21:02:43', 2, 'soporte1', '2023-12-04 10:15:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `area` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `password`, `area`, `tipo`, `fecha_registro`) VALUES
(1, 'usuario1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'administracion', 'usuario', '2023-12-02'),
(2, 'soporte1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'soporte', 'soporte', '2023-12-02'),
(11, 'soporte2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Sistemas', 'soporte', '2023-12-04'),
(12, 'usuario2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Gerencia Seguridad Ciudadana', 'usuario', '2023-12-04'),
(13, 'usuario3', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Gerencia Seguridad Ciudadana', 'usuario', '2023-12-04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
