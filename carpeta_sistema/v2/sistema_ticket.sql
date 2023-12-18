-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2023 a las 03:30:43
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
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `descripcion`, `fecha_registro`) VALUES
(1, 'SUBGERENCIA DE ATENCIÓN AL VECINO Y REGISTRO CIVIL', '2023-12-07'),
(2, 'GERENCIA DE PARTICIPACIÓN VECINAL', '2023-12-07'),
(3, 'SUBGERENCIA DE PROGRAMAS SOCIALES', '2023-12-07'),
(4, 'GERENCIA DE ASENTAMIENTOS HUMANOS', '2023-12-07'),
(5, 'GERENCIA DE TECNOLOGIAS DE LA INFORMACIÓN Y TELECOMUNICACIONES', '2023-12-07'),
(6, 'SUBGERENCIA DE FISCALIZACIÓN Y CONTROL', '2023-12-08'),
(7, 'SUBGERENCIA DE DEFENSA CIVIL', '2023-12-08'),
(8, 'SUBGERENCIA DE OBRAS PRIVADAS', '2023-12-08'),
(9, 'GERENCIA DE ADMINISTRACIÓN Y FINANZAS', '2023-12-08'),
(10, 'SUBGERENCIA DE CATASTRO Y PLANEAMIENTO URBANO', '2023-12-08'),
(11, 'SUBGERENCIA DE CONTABILIDAD Y COSTOS', '2023-12-08'),
(12, 'PASILLO 1', '2023-12-08'),
(13, 'SUBGERENCIA DE TESORERIA', '2023-12-08'),
(14, 'SUBGERENCIA DE OBRAS PÚBLICAS', '2023-12-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio_actual`
--

CREATE TABLE `cambio_actual` (
  `id_cambio` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `monto` varchar(250) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cambio_actual`
--

INSERT INTO `cambio_actual` (`id_cambio`, `descripcion`, `monto`, `id_usuario`, `fecha_registro`) VALUES
(1, 'primer cambio para pruebas', '0.5', 15, '2023-12-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador_impresiones`
--

CREATE TABLE `contador_impresiones` (
  `id_contador` int(11) NOT NULL,
  `id_usuario` int(50) NOT NULL,
  `id_impresora` int(50) NOT NULL,
  `id_area` int(50) NOT NULL,
  `fecha_inicial` date NOT NULL,
  `contador_inicial` varchar(250) NOT NULL,
  `fecha_final` date NOT NULL,
  `contador_final` varchar(250) NOT NULL,
  `contador_mes` varchar(250) NOT NULL,
  `monto_cambio` varchar(250) NOT NULL,
  `total_producido` varchar(250) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contador_impresiones`
--

INSERT INTO `contador_impresiones` (`id_contador`, `id_usuario`, `id_impresora`, `id_area`, `fecha_inicial`, `contador_inicial`, `fecha_final`, `contador_final`, `contador_mes`, `monto_cambio`, `total_producido`, `fecha_registro`) VALUES
(13, 2, 1, 2, '2023-01-01', '0', '2023-12-10', '100', '100', '0.5', '50', '2023-12-10'),
(14, 2, 2, 2, '2023-01-01', '0', '2023-12-10', '600', '600', '0.5', '300', '2023-12-10'),
(15, 2, 1, 1, '2023-12-10', '100', '2023-12-11', '600', '500', '0.5', '250', '2023-12-10'),
(16, 2, 2, 2, '2023-12-10', '600', '2023-12-12', '800', '200', '0.5', '100', '2023-12-10'),
(17, 2, 3, 7, '2023-01-01', '0', '2023-12-10', '800', '800', '0.5', '400', '2023-12-10'),
(18, 2, 1, 4, '2023-12-11', '600', '2023-12-13', '8614', '8014', '0.5', '4007', '2023-12-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impresora`
--

CREATE TABLE `impresora` (
  `id_impresora` int(11) NOT NULL,
  `marca` varchar(250) NOT NULL,
  `modelo` varchar(250) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `impresora`
--

INSERT INTO `impresora` (`id_impresora`, `marca`, `modelo`, `fecha_registro`) VALUES
(1, 'LEXMARK', 'MX711', '2023-12-07'),
(2, 'HP', 'M630', '2023-12-07'),
(3, 'RICOH', '6055', '2023-12-07'),
(4, 'HP', 'E82560', '2023-12-07');

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
  `id_impresora` int(50) NOT NULL,
  `estado_ticket` varchar(250) NOT NULL,
  `fecha_ticket` datetime NOT NULL,
  `id_usuario_soporte` int(11) NOT NULL,
  `nombre_usuario_soporte` varchar(250) NOT NULL,
  `fecha_revision_soporte` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `numero_ticket`, `id_usuario`, `nombre_solicitante`, `tipo_ticket`, `detalle_ticket`, `id_impresora`, `estado_ticket`, `fecha_ticket`, `id_usuario_soporte`, `nombre_usuario_soporte`, `fecha_revision_soporte`) VALUES
(1, 'tk001', 1, 'Maria Fernandez', 'soporte', 'necesito ayuda con la impresora se atasco el papel', 0, 'pendiente', '2023-12-02 17:44:20', 0, '0', '0000-00-00 00:00:00'),
(2, 'tk87449', 14, 'jose jimenez', 'soporte', 'detalle de prueba de inserción de datos en la database ', 0, 'en proceso', '2023-12-03 01:21:09', 2, 'soporte1', '2023-12-04 16:35:46'),
(3, 'tk21215', 1, 'javier macherano', 'soporte', 'prueba ', 0, 'pendiente', '2023-12-02 19:23:25', 0, '0', '0000-00-00 00:00:00'),
(4, 'tk46875', 14, 'ricon ozuna', 'toner', 'asfsafdsafdsfdsfdsfsfsdfadfds\r\nfdsfdsfdsf', 0, 'pendiente', '2023-12-02 19:27:30', 0, '0', '0000-00-00 00:00:00'),
(7, 'tk27490', 1, 'roberto martinez', 'toner', 'prueba de toner', 0, 'terminado', '2023-12-03 21:02:43', 2, 'soporte1', '2023-12-04 16:35:42'),
(16, 'tk14001', 1, 'jose jimenez', 'toner', 'necesita toner esta impresora', 2, 'pendiente', '2023-12-07 12:45:13', 0, '', '0000-00-00 00:00:00'),
(17, 'tk90993', 1, 'jose jimenez', 'toner', 'csadsafsdaf', 4, 'en proceso', '2023-12-07 12:46:31', 2, 'soporte1', '2023-12-10 17:58:31'),
(19, 'tk90248', 1, 'jose jimenez', 'soporte', 'dfgsdgfdsgsd', 0, 'terminado', '2023-12-07 13:28:00', 2, 'soporte1', '2023-12-09 21:15:49'),
(20, 'tk24042', 1, 'jose jimenez', 'toner', 'asdsadsad', 0, 'en proceso', '2023-12-07 13:32:54', 2, 'soporte1', '2023-12-09 21:15:39'),
(21, 'tk93260', 1, 'jose jimenez', 'toner', 'sdfgsdfdsf', 3, 'terminado', '2023-12-07 17:05:13', 2, 'soporte1', '2023-12-09 21:15:30'),
(22, 'tk14306', 14, 'jose jimenez', 'soporte', 'soporte', 0, 'pendiente', '2023-12-07 17:05:33', 2, 'soporte1', '2023-12-09 21:15:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `id_area` int(50) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `password`, `id_area`, `tipo`, `fecha_registro`) VALUES
(1, 'usuario1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, 'usuario', '2023-12-02'),
(2, 'soporte1', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 5, 'soporte', '2023-12-02'),
(14, 'usuario2', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 3, 'usuario', '2023-12-07'),
(15, 'super', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0, 'super', '2023-12-08'),
(16, '@usuario3', '15676680ffc67a48761517e72a60827e471fb3ce472862592ed25ce6a7e63a74', 6, 'usuario', '2023-12-08'),
(17, '@usuario4', '47b85ca8f181024f909d10f416bc436563109f4cc9106fc6c4e28398118c9f8e', 13, 'usuario', '2023-12-08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `cambio_actual`
--
ALTER TABLE `cambio_actual`
  ADD PRIMARY KEY (`id_cambio`);

--
-- Indices de la tabla `contador_impresiones`
--
ALTER TABLE `contador_impresiones`
  ADD PRIMARY KEY (`id_contador`);

--
-- Indices de la tabla `impresora`
--
ALTER TABLE `impresora`
  ADD PRIMARY KEY (`id_impresora`);

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
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cambio_actual`
--
ALTER TABLE `cambio_actual`
  MODIFY `id_cambio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contador_impresiones`
--
ALTER TABLE `contador_impresiones`
  MODIFY `id_contador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `impresora`
--
ALTER TABLE `impresora`
  MODIFY `id_impresora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
