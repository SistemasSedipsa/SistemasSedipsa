-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-09-2024 a las 23:35:17
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
-- Base de datos: `contabilidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `atiende` varchar(255) NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `empresa`, `atiende`, `puesto`, `correo`, `telefono`) VALUES
(1, 'SIEMENS ENERGY INC.', 'Janet Ortega Mondragon', 'Compras', 'laura.lopez@ilogsa.com', '81 1212 0274'),
(2, 'SIMANIND', 'Ing. Diego Alejandro Zamora Pantoa', 'Cotizacionez', 'ventas@simanind.com', '722 528 8937'),
(3, 'OPTIMUS WELDING', 'Ing. Josafat Torres', '-', 'jtorrres@optimuswelding.com.mx', '722 528 8937'),
(4, 'GIASA', 'Ing. Erick Roman', 'Calidad', 'erick.roman@giasamx.com', '229 771 1832');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripciones`
--

CREATE TABLE `descripciones` (
  `id` int(11) NOT NULL,
  `partida_id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE `pruebas` (
  `id` int(11) NOT NULL,
  `prueba` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pruebas`
--

INSERT INTO `pruebas` (`id`, `prueba`, `descripcion`, `precio`) VALUES
(1, 'RADIOLÓGICA', 'Examinación radiográfica en uniones soldadas de tubería de acero al carbón de 3/8” a 2 ½ hasta 12.7 mm de espesor al 100%', 7000.00),
(2, 'PARTICULAS MAGNETICAS', 'Examinación con Partículas Magnéticas en uniones soldadas de 3/8” a 2 1/2\" de diámetro.', 5250.00),
(3, 'LIQUIDOS PENETRANTES', 'Examinación con líquidos penetrantes de 0.500” hasta 2.5” de diámetro.', 3456.00),
(4, 'MEDICION DE DUREZAS', 'Examinación con medición de durezas.', 54321.00),
(5, 'INSPECCION ULTRASONICA (DETECCION DE FALLAS)', 'Junta de 2” inspeccionada con ultrasonido industrial.', 9876.00),
(6, 'PMI', 'Examinación con PMI incluye punto.', 7890.00),
(7, 'MEDICION DE ESPESORES', 'Examinación con Medición de Espesores', 4567.00),
(8, 'INSPECCION CON METALOGRAFIA (REPLICA METALOGRÁFICA)', 'Punto inspeccionado con metalografía en sitio (Stand By)', 2345.00),
(9, 'CAMARA DE VACIO', 'Examinación con cámara de vacío por metro lineal.', 1234.00),
(10, 'INSPECCION ULTRASONICA (ARREGLO DE FASES)', 'Junta hasta 3” inspeccionada con ultrasonido industrial (PA)', 6543.25),
(12, 'INSPECCION ELECTROMAGNETICA (CORRIENTE EDDY)', 'Examinación con inducción electromagnetica (corrientes Eddy) en uniones soldadas de 3/8” a 2 1/2\" de diámetro.', 4679.00),
(13, 'Renta de unidad móvil para examinación radiográfica con equipo portátil de rayos gamma Ir-192, incluye: equipo de seguridad radiológica, equipo para revelado y personal técnico que lo opera.', 'Examinación radiográfica en uniones soldadas de tubería de acero al carbón de 3” hasta 12.7 mm de espesor al 100%', 4500.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `descripciones`
--
ALTER TABLE `descripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `partida_id` (`partida_id`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `descripciones`
--
ALTER TABLE `descripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `descripciones`
--
ALTER TABLE `descripciones`
  ADD CONSTRAINT `descripciones_ibfk_1` FOREIGN KEY (`partida_id`) REFERENCES `pruebas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
