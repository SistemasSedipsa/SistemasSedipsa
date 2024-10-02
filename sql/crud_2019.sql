-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-09-2024 a las 23:35:24
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
-- Base de datos: `crud_2019`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id` int(11) NOT NULL,
  `accesorio_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `ns` varchar(255) DEFAULT NULL,
  `condicion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios_consumibles`
--

CREATE TABLE `accesorios_consumibles` (
  `id` int(11) NOT NULL,
  `consumible_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `ns` varchar(255) DEFAULT NULL,
  `condicion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios_radiacion`
--

CREATE TABLE `accesorios_radiacion` (
  `id` int(11) NOT NULL,
  `radiacion_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id` int(11) NOT NULL,
  `num_int` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `metodo` varchar(50) NOT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `inventario` varchar(50) NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `accesorios` varchar(50) NOT NULL,
  `calibracion` varchar(50) DEFAULT NULL,
  `verificacion` varchar(50) DEFAULT NULL,
  `ultima` varchar(50) DEFAULT NULL,
  `informe` varchar(50) NOT NULL,
  `proxima` varchar(50) DEFAULT NULL,
  `status_c` varchar(50) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `prueba` varchar(100) DEFAULT NULL,
  `condiciones` varchar(255) DEFAULT NULL,
  `observaciones` varchar(50) DEFAULT NULL,
  `situacion` varchar(50) NOT NULL,
  `bodega` varchar(50) NOT NULL,
  `archivo_pdf` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `num_int`, `descripcion`, `metodo`, `serie`, `inventario`, `modelo`, `marca`, `accesorios`, `calibracion`, `verificacion`, `ultima`, `informe`, `proxima`, `status_c`, `ubicacion`, `prueba`, `condiciones`, `observaciones`, `situacion`, `bodega`, `archivo_pdf`) VALUES
(1, 'SEN-001-A23', 'BLOQUE DE ENSAYO DE DUERZA', 'qwer', 'AT-PB1808902', '123456', 'THL280PLUS', 'TM TECK INSTRUMENT', '', 'X', 'X', '01/09/2023', '654321', '01/09/2024', 'VIGENTE', 'CANC?N', 'RESISTENCIA', 'BUENO', 'EN BUENAS CONDICIONES', 'VIGENTE', 'ESTANTE 3', ''),
(2, 'SEN-002', 'CAMARA DE VACIO LINEAL', '', 'S/NS', '', 'N/A', 'SEDIPSA', '', '', 'X', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(3, 'SEN-003', 'DUROMETRO', '', 'S/NS', '', 'EPX5500', 'ENPQIX', '', 'X', '', '10/03/2021', '', '10/03/2022', 'VENCIDO', '', '', 'BUENO', '', '', '', ''),
(4, 'SEN-004', 'BOMBA DE VACO', '', 'AT-PB1808901', '', 'AIT-270', 'GB', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(5, 'SEN-005', 'VACUOMETRO TIPO MICRO', '', 'S/NS', '', '63100/0-4', 'METRON', '', '-', '-', '12/11/2012', '', '12/11/2013', 'VENCIDO', '', '', '', '', '', '', ''),
(6, 'SEN-006', 'VACUOMETRO TIPO MICRO', '', 'S/NS', '', '63100/0-4', 'METRON', '', '-', '-', '12/06/2012', '', '12/06/2013', 'VENCIDO', '', '', '', '', '', '', ''),
(7, 'SEN-007', 'MICROSCOPIO METALOGRAFICO', '', '1214363', '', 'N/A', 'SEIGEN', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(8, 'SEN-008', 'MICROSCOPIO METALOGRAFICO', '', 'M004616m', '', 'MC3111', 'MOTICAM 1000', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(9, 'SEN-009', 'MICROSCOPIO METALOGRAFICO', '', 'S/NS', '', 'SON-MP01', 'VITINY', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(10, 'SEN-010', 'MICROSCOPIO METALOGRAFICO', '', 'S/NS', '', 'MD500', 'S/M', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(11, 'SEN-011', 'INDICADOR MAGNETICO', '', 'MX3503 IS', '', 'MFS-PG1', 'MX INDUSTRIAL', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(12, 'SEN-012', 'INDICADOR MAGNETICO', '', 'MX3503 IS', '', 'MFS-PG1', 'MX INDUSTRIAL', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(13, 'SEN-013', 'INDICADOR MAGNETICO', '', 'MX3503 IS', '', 'MFS-PG1', 'MX INDUSTRIAL', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(14, 'SEN-014', 'BARRA DE LEVANTAMIENTO', '', '16917', '', 'TB-10', 'PARKER', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(15, 'SEN-015', 'BARRA DE LEVANTAMIENTO', '', '16918', '', 'TB-10', 'PARKER', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(16, 'SEN-016', 'BARRA DE LEVANTAMIENTO', '', '16919', '', 'TB-10', 'PARKER', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(17, 'SEN-017', 'BARRA DE LEVANTAMIENTO', '', '16920', '', 'TB-10', 'PARKER', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(18, 'SEN-018', 'BARRA DE LEVANTAMIENTO', '', 'NW0802', '', 'LT-10', 'NAWOO TECH Ltd.', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(19, 'SEN-019', 'BARRA DE LEVANTAMIENTO', '', 'NW0803', '', 'LT-10', 'NAWOO TECH Ltd.', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(20, 'SEN-020', 'BARRA DE LEVANTAMIENTO', '', 'NW0804', '', 'LT-10', 'NAWOO TECH Ltd.', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(21, 'SEN-021', 'BARRA DE LEVANTAMIENTO', '', 'NW0805', '', 'LT-10', 'NAWOO TECH Ltd.', '', '-', 'X', '25/11/2023', '', '25/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(22, 'SEN-022', 'YUGO MAGNETICO ', '', '8944', '', 'DA-400', 'PARKER', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(23, 'SEN-023', 'YUGO MAGNETICO ', '', '9173', '', 'B310-PDC', 'PARKER', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(24, 'SEN-024', 'YUGO MAGNETICO ', '', '9866', '', 'B310-PDC', 'PARKER', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(25, 'SEN-025', 'YUGO MAGNETICO ', '', '9427', '', 'B310-PDC', 'PARKER', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(26, 'SEN-026', 'YUGO MAGNETICO ', '', '10001', '', 'B310-PDC', 'PARKER', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(27, 'SEN-027', 'YUGO MAGNETICO ', '', '624145', '', 'Y8', 'MAGNAFLUX', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(28, 'SEN-028', 'YUGO MAGNETICO ', '', '10000', '', 'B310-PDC', 'PARKER', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(29, 'SEN-029', 'YUGO MAGNETICO ', '', '19112013', '', 'Y8', 'MAGNAFLUX', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(30, 'SEN-030', 'YUGO MAGNETICO ', '', '2898', '', 'Y-1', 'MAGNAFLUX', '', '', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(31, 'SEN-031', 'HOLIDAY DETECTOR', '', 'DB150062', '', 'HD101', 'TIME GROUP INC.', '', 'X', '-', '14/06/2017', '', '14/06/2018', 'VENCIDO', '', '', '', '', '', '', ''),
(32, 'SEN-032', 'MEDIDOR DE PINTURA 60 ML', '', 'S/NS', '', '6000', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(33, 'SEN-033', 'MEDIDOR DE PREPARACION DE SUPERFICIE', '', 'S/NS', '', '6000', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(34, 'SEN-034', 'MEDIDOR DE VELOCIDAD DE VIENTO', '', 'S/NS', '', '6000', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(35, 'SEN-035', 'MEDIDOR DE HUMEDAD', '', 'S/NS', '', '6000', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(36, 'SEN-036', 'MEDIDOR DE SUPERFICIE DE CONTACTO', '', 'S/NS', '', '6000', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(37, 'SEN-037', 'PMI (INDICADOR POSTIVO DE MATERIALES)', '', '32245', '', 'XL3T800', 'THERMO FISHER', '', 'X', '-', '09/01/2023', '', '09/01/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(38, 'SEN-038', 'PATRONES VARIOS', '', 'IARM35HN', '', 'MONEDA REF. PMI 1/4 Cr 1/2 Mo', 'NITON', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(39, 'SEN-039', 'PATRONES VARIOS', '', 'S/NS', '', 'MONEDAREF PMI SS 316', 'SKYRAY INTRUMENT', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(40, 'SEN-040', 'PATRONES VARIOS', '', 'S/NS', '', 'MONEDAREF PMI SS 317', 'OLYMPUS', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(41, 'SEN-041', 'PATRONES VARIOS', '', '19969', '', 'MONEDA REF PMI SS 304 L', 'SEDIPSA', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(42, 'SEN-042', 'PATRONES VARIOS', '', '765J', '', 'MONEDA REF PMI SS 304 ', 'SEDIPSA', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(43, 'SEN-043', 'PATRONES VARIOS', '', '795H', '', 'MONEDA REF PMI SS 316 L', 'SEDIPSA', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(44, 'SEN-044', 'MEDIDOR DE LUMINANCIA ', '', 'N/A', '', 'HER-410', 'STEREN', '', 'X', '-', '21/06/2022', '', '21/06/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(45, 'SEN-044A', 'MEDIDOR DE ILUMNANCIA', '', 'Q964242', '', 'YK-10LX', 'LUTRON', '', 'X', '-', '25/09/2023', '', '25/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(46, 'SEN-045', 'MEDIDOR DE ILUMNANCIA', '', 'S/NS', '', 'HER-410', 'STEREN', '', 'X', '-', '05/04/2022', '', '05/04/2023', 'VENCIDO', '', '', 'NOFUNCIONA', 'NO SIRVE', '', '', ''),
(47, 'SEN-046', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-04', '', 'BLOCK DSC', 'TITAN', '', 'X', '-', '26/03/2024', '', '26/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(48, 'SEN-047', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-08', '', 'S/M', 'TITAN', '', 'X', '-', '20/03/2024', '', '20/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(49, 'SEN-048', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-06', '', 'IIW 2 (V-2)', 'TITAN', '', 'X', '-', '26/03/2024', '', '26/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(50, 'SEN-049', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-05', '', 'S/M', 'TITAN', '', 'X', '-', '20/03/2024', '', '20/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(51, 'SEN-050', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-09', '', '55674', 'TITAN', '', 'X', '-', '08/12/2022', '', '08/12/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(52, 'SEN-051', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-02', '', '9755', 'TITAN', '', 'X', '-', '24/02/2021', '', '', 'VENCIDO', '', '', 'NO FUNCIONA', '', '', '', ''),
(53, 'SEN-052', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-11', '', '55674', 'AUTOTEC', '', 'X', '-', '20/03/2024', '', '20/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(54, 'SEN-053', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-13', '', 'S/M', 'AUTOTEC', '', 'X', '-', '29/06/2022', '', '29/06/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(55, 'SEN-054', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-01', '', 'S/M', 'AUTOTEC', '', 'X', '-', '08/12/2022', '', '08/12/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(56, 'SEN-055', 'CALIBRADOR DIGITAL VERNIER', '', 'SON-VE-12', '', 'S/M', 'AUTOTEC', '', 'X', '-', '29/06/2022', '', '29/06/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(57, 'SEN-056', 'RADIOMETRO UV ', '', 'S845266', '', 'UV340B', 'UV LIGHT METER', '', 'X', '-', '11/08/2023', '', '11/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(58, 'SEN-057', 'TERMOMETRO INFRAROJO ', '', 'S/NS', '', 'HER-427', 'STEREN', '', 'X', '-', '17/03/2023', '', '17/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(59, 'SEN-058', 'FUENTE IR 192', '', '75634', '', 'A242-9', 'GS GLOBAL', '', '-', '-', '10/08/2023', '', '22/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(60, 'SEN-059', 'FUENTE IR 192', '', 'TT1538', '', '702', 'GS GLOBAL', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', 'SE ENTREGO A SUPLITEC', '', '', '', ''),
(61, 'SEN-060', 'FUENTE IR 192', '', '75633', '', 'A424-9', 'GS GLOBAL', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(62, 'SEN-061', 'FUENTE IR 192', '', '29310M', '', 'A424-10', 'GS GLOBAL', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(63, 'SEN-062', 'CONTENEDOR DE FUENTE RADIOACTIVA', '', 'D12809', '', 'DELTA 880', 'DELTA 880', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(64, 'SEN-063', 'CONTENEDOR DE FUENTE RADIOACTIVA', '', 'D12801', '', 'DELTA 880', 'DELTA 880', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(65, 'SEN-064', 'CONTENEDOR DE FUENTE RADIOACTIVA', '', 'D12420', '', 'DELTA 880', 'DELTA 880', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(66, 'SEN-065', 'CONTENEDOR DE FUENTE RADIOACTIVA', '', 'D3224', '', 'DELTA 880', 'DELTA 880', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(67, 'SEN-066', 'DENSITOMETRO/NEGATOSCOPIO', '', '95501', '', 'FV-2009T', 'ILOG', '', '-', 'X', '24/04/2023', '', '24/07/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(68, 'SEN-067', 'DENSITOMETRO/NEGATOSCOPIO', '', '95507', '', 'FV-2009T', 'ILOG', '', '-', 'X', '24/04/2023', '', '24/07/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(69, 'SEN-068', 'DENSITOMETRO/NEGATOSCOPIO', '', '95508', '', 'FV-2009T', 'ILOG', '', '-', 'X', '30/12/2023', '', '30/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(70, 'SEN-069', 'DENSITOMETRO/NEGATOSCOPIO', '', '95509', '', 'FV-2009T', 'ILOG', '', '-', 'X', '03/05/2017', '', '03/08/2017', 'VENCIDO', '', '', '', '', '', '', ''),
(71, 'SEN-070', 'DENSITOMETRO/NEGATOSCOPIO', '', '95510', '', 'FV-2009T', 'ILOG', '', '-', 'X', '24/07/2023', '', '22/10/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(72, 'SEN-071', 'ALARMA SONORA', '', '95888', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '07/07/2023', '', '07/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(73, 'SEN-072', 'ALARMA SONORA', '', '38075', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '27/11/2023', '', '22/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(74, 'SEN-073', 'ALARMA SONORA', '', '38388', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '27/11/2023', '', '22/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(75, 'SEN-074', 'ALARMA SONORA', '', '32137', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '06/12/2023', '', '06/06/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(76, 'SEN-075', 'ALARMA SONORA', '', '95889', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '07/08/2023', '', '01/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(77, 'SEN-076', 'ALARMA SONORA', '', '78027', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '07/08/2023', '', '01/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(78, 'SEN-077', 'ALARMA SONORA', '', '53715', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '10/10/2023', '', '10/04/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(79, 'SEN-078', 'ALARMA SONORA', '', '78452', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '29/04/2023', '', '28/10/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(80, 'SEN-079', 'ALARMA SONORA', '', '68737', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '10/10/2023', '', '10/04/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(81, 'SEN-080', 'ALARMA SONORA', '', '70440', '', 'ND-15', 'NDS PRODUCTS', '', 'X', '-', '27/01/2023', '', '25/07/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(82, 'SEN-081', 'CONTADOR GEIGER', '', '15642', '', 'ND-2000', 'NDS PRODUCTS', '', 'X', '-', '27/11/2023', '', '15/06/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(83, 'SEN-082', 'CONTADOR GEIGER', '', '51659', '', 'ND-2000', 'NDS PRODUCTS', '', 'X', '-', '04/08/2023', '', '02/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(84, 'SEN-083', 'CONTADOR GEIGER', '', 'NH-0432', '', '3009 A', 'ARROW-TECH', '', 'X', '-', '01/12/2020', '', '09/05/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(85, 'SEN-084', 'CONTADOR GEIGER', '', '28356', '', 'ND-2000', 'NDS PRODUCTS', '', 'X', '-', '04/08/2023', '', '02/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(86, 'SEN-085', 'CONTADOR GEIGER', '', '45906', '', 'ND-2000', 'NDS PRODUCTS', '', 'X', '-', '27/04/2023', '', '24/10/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(87, 'SEN-086', 'DENSITOMETRO ', '', '42596', '', '331', 'X RITE', '', '-', 'X', '08/11/2022', '', '17/11/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(88, 'SEN-087', 'DENSITOMETRO ', '', '101628', '', '331', 'X RITE', '', '-', 'X', '08/11/2022', '', '17/11/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(89, 'SEN-088', 'DENSITOMETRO ', '', 'APP321', '', '331', 'X RAY', '', '-', 'X', '28/06/2014', '', '26/09/2014', 'VENCIDO', '', '', '', '', '', '', ''),
(90, 'SEN-089', 'COLIMADOR', '', 'S/NS', '', 'S/M', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(91, 'SEN-090', 'COLIMADOR', '', 'S/NS', '', 'S/M', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(92, 'SEN-091', 'COLIMADOR', '', 'S/NS', '', 'S/M', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(93, 'SEN-092', 'COLIMADOR', '', 'S/NS', '', 'S/M', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(94, 'SEN-093', 'COLIMADOR', '', 'S/NS', '', 'S/M', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(95, 'SEN-094', 'COLIMADOR', '', 'S/NS', '', 'S/M', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(96, 'SEN-095', 'COLIMADOR', '', 'S/NS', '', 'S/M', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(97, 'SEN-096', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(98, 'SEN-097', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(99, 'SEN-098', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(100, 'SEN-099', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(101, 'SEN-100', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(102, 'SEN-101', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(103, 'SEN-102', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(104, 'SEN-103', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(105, 'SEN-104', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(106, 'SEN-105', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(107, 'SEN-106', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(108, 'SEN-107', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(109, 'SEN-108', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(110, 'SEN-109', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(111, 'SEN-110', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(112, 'SEN-111', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(113, 'SEN-112', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(114, 'SEN-113', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(115, 'SEN-114', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(116, 'SEN-115', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1C', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(117, 'SEN-116', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1C', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(118, 'SEN-117', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1C', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(119, 'SEN-118', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 3B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(120, 'SEN-119', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 3B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(121, 'SEN-120', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 2B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(122, 'SEN-121', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 2B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(123, 'SEN-122', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 2B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(124, 'SEN-123', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(125, 'SEN-124', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(126, 'SEN-125', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(127, 'SEN-126', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(128, 'SEN-127', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(129, 'SEN-128', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(130, 'SEN-129', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(131, 'SEN-130', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1A', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(132, 'SEN-131', 'INDICADOR DE CALIDAD', '', '5.4031E+11', '', 'ECHO II', 'CYRUSTECH', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(133, 'SEN-132', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1 B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(134, 'SEN-133', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1 B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(135, 'SEN-134', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1 B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(136, 'SEN-135', 'INDICADOR DE CALIDAD', '', 'S/NS', '', 'ASTM 1 B', 'S/M', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(137, 'SEN-136', 'TERMOMETRO INFRAROJO ', '', 'S/NS', '', 'TCHP180', 'UPDATE', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(138, 'SEN-137', 'DETECTOR DE FALLAS POR ULTRASONIDO', '', '15077602', '', 'USM 36', 'GE', '', 'X', '-', '29/12/2023', '', '29/12/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(139, 'SEN-138', 'DETECTOR DE FALLAS POR ULTRASONIDO', '', '15077562', '', 'USM 36', 'GE INSPECTIOON TECHNOLOGIES', '', 'X', '-', '29/06/2023', '', '29/06/2024', 'VENCIDO', 'CANCUN ', '', '', '', '', '', ''),
(140, 'SEN-139', 'DETECTOR DE FALLAS POR ULTRASONIDO', '', '540310101122', '', 'ECHO II', 'CYRUSTECH', '', 'X', '-', '21/08/2023', '', '21/08/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(141, 'SEN-140', 'MEDIDOR DE ESPESORES POR ULTRASONIDO', '', '14066034', '', 'DMS GO/USM', 'GE INSPECTIOON TECHNOLOGIES', '', 'X', '-', '04/09/2023', '', '04/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(142, 'SEN-141', 'MEDIDOR DE ESPESORES POR ULTRASONIDO', '', '1404532', '', 'DM5E DL', 'GE INSPECTIOON TECHNOLOGIES', '', 'X', '-', '31/08/2021', '', '31/08/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(143, 'SEN-142', 'MEDIDOR DE ESPESORES POR ULTRASONIDO', '', '1407220', '', 'DM5E', 'GE', '', 'X', '-', '22/09/2022', '', '22/09/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(144, 'SEN-143', 'MEDIDOR DE ESPESORES POR ULTRASONIDO', '', '1411052', '', 'DM5E', 'GE INSPECTIOON TECHNOLOGIES', '', 'X', '-', '04/09/2023', '', '04/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(145, 'SEN-144', 'MEDIDOR DE ESPESORES POR ULTRASONIDO', '', '1411085', '', 'DM5E', 'GE INSPECTIOON TECHNOLOGIES', '', 'X', '-', '04/09/2023', '', '04/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(146, 'SEN-145', 'DETECTOR DE FALLAS POR ULTRASONIDO', '', '17H01JHC', '', 'PHASOR XS', 'GE INSPECTIOON TECHNOLOGIES', '', 'X', '-', '16/05/2024', '', '16/05/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(147, 'SEN-146', 'BLOCK ASME 3/4', '', '30951', '', 'BLOCK ASME 3/4', 'ZION', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(148, 'SEN-147', 'BLOQUE PATRON', '', '120111', '', 'BLOCK ASME 3/4', 'HIGH TECH', '', 'X', '-', '26/03/2024', '', '26/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(149, 'SEN-148', 'BLOQUE PATRON ', '', '120110', '', 'BLOCK ASME 3/4', 'LLOG', '', '-', '', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(150, 'SEN-149', 'BLOQUE PATRON', '', '34054', '', 'BLOCK ASME 1 1/2', 'LLOG', '', 'X', '-', '26/03/2024', '', '26/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(151, 'SEN-150', 'BLOQUE PATRON', '', 'V1/CS/IIW/TYPEII/C09', '', 'IIW-TIPO 2', '3E NDT', '', 'X', '-', '12/03/2024', '', '12/03/2025', 'VIGENTE', 'CANCUN', '', '', '', '', '', ''),
(152, 'SEN-151', 'BLOOCK IIW TYPE 2', '', '73246', '', 'BLQ IIW T2 1018', 'PH TOOL', '', 'X', '-', '08/09/2023', '', '08/09/2024', 'VIGENTE', '', '', '', 'Requiere observacion', '', '', ''),
(153, 'SEN-152', 'BLOOCK IIW ', '', '47588', '', 'IIW-TIPO 2', 'ZION NDT', '', 'X', '-', '12/03/2024', '', '12/03/2025', 'VIGENTE', '', '', '', 'Requiere observacion', '', '', ''),
(154, 'SEN-153', '', '', 'S/NS', '', 'BLOCK TIPO DS AWS', 'ZION', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(155, 'SEN-154', 'PATRONES VARIOS', '', 'NN05092', '', 'BLOCK ESCALERA 0.250 A 1.000', 'GE', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(156, 'SEN-155', 'PATRONES VARIOS', '', 'N07235', '', 'BLOCK ESCALERA 0.100 A 0.500', 'GE', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(157, 'SEN-156', 'KIT INSPECCION VISUAL 8 PZAS', '', '120859693', '', '-', '-', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(158, 'SEN-157', 'KIT INSPECCION VISUAL 16 PZAS', '', '150524112', '', '-', '-', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(159, 'SEN-158', 'ESPEJO TELESCOPIO ', '', '-', '', '-', '-', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(160, 'SEN-159', 'ESPEJO TELESCOPIO ', '', '-', '', '-', '-', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(161, 'SEN-160', 'ESPEJO TELESCOPIO ', '', '-', '', '', '', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(162, 'SEN-161', 'MULTIMETRO DE GANCHO ', '', 'S/NS', '', 'MUL122', 'STEREN ', '', 'X', '-', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(163, 'SEN-162', 'DETECTOR DE FALLAS', '', '14E01K8P', '', 'PHASOR XS', 'GE INSPECTION TECHNOLOGIES', '', 'X', '-', '29/06/2023', '', '29/06/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(164, 'SEN-163', 'MANOMETRO', '', '712116818', '', 'S/M', 'DEWIT', '', 'X', '-', '30/05/2020', '', '30/05/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(165, 'SEN-164', 'MANOMETRO', '', 'S/NS', '', 'S/M', 'BOURDON HAENNI', '', 'X', '-', '30/05/2020', '', '30/05/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(166, 'SEN-165', 'MANOMETRO', '', 'M14012929', '', '2000SS', 'DEWIT', '', 'X', '-', '30/05/2020', '', '30/05/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(167, 'SEN-166', 'MANOMETRO', '', '814071505', '', '2000SS', 'DEWIT', '', 'X', '-', '30/05/2020', '', '30/05/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(168, 'SEN-167', 'GRAFICADOR DE PRESION', '', '13235800833', '', '242E', 'BARTON ', '', 'X', '-', '20/06/2020', '', '20/06/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(169, 'SEN-168', 'CRAWLER', '', 'S/NS', '', 'LPS-1', 'SIUI', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(170, 'SEN-169', 'ALARMA SONORA', '', '68736', '', 'ND-15', 'NDS-PRODUCTS', '', 'X', '-', '29/05/2023', '', '28/10/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(171, 'SEN-170', 'ALARMA SONORA', '', '53714', '', 'ND-15', 'NDS-PRODUCTS', '', 'X', '-', '10/10/2023', '', '10/04/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(172, 'SEN-171', 'ALARMA SONORA', '', '66209', '', 'ND-16', 'NDS-PRODUCTS', '', 'X', '-', '10/10/2023', '', '10/04/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(173, 'SEN-172', 'BLOQUE PATRON ESCALONADO DE 5 PASOS ', '', '41340', '', '1018', 'ILOG', '', 'X', '-', '08/09/2023', '', '08/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(174, 'SEN-173', 'BLOQUE PATRON ESCALONADO DE 4 PASOS ', '', 'NN05001', '', 'NN05001', 'GE', '', 'X', '-', '08/09/2023', '', '08/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(175, 'SEN-174', 'BLOQUE PATRON ESCALONADO', '', 'NN05091', '', 'S/M', 'INSPECTION TECHNOLOGIES', '', 'X', '-', '23/04/2021', '', '23/04/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(176, 'SEN-175', 'BLOQUE PATRON ESCALONADO 5 PASOS ', '', 'N07238', '', 'N07238', 'GE', '', 'X', '-', '08/09/2023', '', '08/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(177, 'SEN-176', 'TIRA DE DENSIDADES', '', '1504205-0904175', '', '-', 'AGFA', '', '-', '-', '30/09/2019', '', '30/11/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(178, 'SEN-177', 'TIRA DE DENSIDADES', '', '3225206', '', '-', 'AGFA', '', '-', '-', '07/06/2022', '', '20/06/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(179, 'SEN-178', 'MANOMETRO', '', '01181131210', '', '251/63/70', 'DEWIT', '', 'X', '-', '23/09/2020', '', '23/09/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(180, 'SEN-179', 'MANOMETRO', '', '06171107145', '', '251/63/70', 'DEWIT', '', 'X', '-', '23/09/2020', '', '23/09/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(181, 'SEN-180', 'MANOMETRO', '', '06171107305', '', '251/63/70', 'DEWIT', '', 'X', '-', '23/09/2020', '', '23/09/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(182, 'SEN-181', 'MULTIMETRO DE GANCHO ', '', 'S/NS', '', 'MUL-110', 'STEREN', '', '-', '-', '10/09/2022', '', '10/09/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(183, 'SEN-182', 'MEDIDOR DE RECUBRIMIENTO ', '', 'A23080', '', 'DFT', 'POSITEST', '', 'X', '-', '16/10/2015', '', '16/10/2016', 'VENCIDO', '', '', '', '', '', '', ''),
(184, 'SEN-183', 'PATRONES VARIOS', '', 'H02115', '', 'DS TEST BLOCK', 'S/M', '', 'X', '-', '19/02/2021', '', '19/02/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(185, 'SEN-184', 'PATRONES VARIOS', '', '2012292', '', 'BLOCK IIW (V2)', 'AJR NDT CO,LTD', '', 'X', '-', '29/12/2020', '', '29/12/2021', 'VENCIDO', '', '', '', '', '', '', ''),
(186, 'SEN-185', 'VACUOMETRO ', '', 'S/NS', '', '51100/0-4', 'METRON', '', 'X', '-', '04/08/2021', '', '04/08/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(187, 'SEN-185-1', 'RADIOMETRO UV ', '', 'S797922', '', 'UV340B', 'UV LIGHT METER', '', 'X', '-', '26/09/2023', '', '26/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(188, 'SEN-186', 'VACUOMETRO ', '', 'S/NS', '', '51100/0-4', 'METRON', '', 'X', '-', '04/08/2021', '', '04/08/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(189, 'SEN-187', 'VACUOMETRO ', '', 'S/NS', '', '51100/0-4', 'METRON', '', 'X', '-', '15/08/2023', '', '15/08/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(190, 'SEN-188', 'VACUOMETRO ', '', 'FS-22-2846', '', '51100/0-4', 'METRON', '', 'X', '-', '23/03/2022', '', '23/03/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(191, 'SEN-189', 'TERMOMETRO INFRAROJO ', '', 'S/NS', '', 'HER-427', 'STEREN', '', 'X', '-', '27/08/2021', '', '27/08/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(192, 'SEN-190', 'BLOCK MINIPACS', '', '55394', '', 'MINI PACS', 'S/M', '', 'X', '-', '26/03/2024', '', '26/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(193, 'SEN-191', 'TERMOMETRO INFRAROJO ', '', 'S/NS', '', 'HER-427', 'STEREN', '', 'X', '-', '13/09/2021', '', '13/09/2022', 'VENCIDO', '', '', '', '', '', '', ''),
(194, 'SEN-192', 'YUGO MAGNETICO ', '', '28966', '', 'B300', 'PARKER', '', '-', 'X', '24/03/2024', '', '24/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(195, 'SEN-193', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(196, 'SEN-194-A ', 'CONTADOR GEIGER', '', 'NL-0439', '', '3009A', 'ARROW-TECH', '', 'X', '-', '20/03/2024', '', '20/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(197, 'SEN-194', 'MEDIDOR DE ILUMINANCIA ', '', 'H22023445', '', 'HER-408', 'STEREN', '', 'X', '-', '13/03/2023', '', '13/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(198, 'SEN-195', 'MEDIDOR DE ILUMINANCIA ', '', 'H21151192', '', 'HER-408', 'STEREN', '', 'X', '-', '13/03/2023', '', '13/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(199, 'SEN-195-A', 'ALARMA SONORA', '', '93473', '', 'ND-15', 'NDS-PRODUCTS', '', 'X', '-', '22/12/2023', '', '06/06/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(200, 'SEN-196', 'ALARMA SONORA', '', '93472', '', 'ND-15', 'NDS-PRODUCTS', '', 'X', '-', '27/04/2023', '', '24/10/2023', 'VENCIDO', '', '', '', '', '', '', ''),
(201, 'SEN-197', 'PIROMETRO', '', 'PO-43483', '', 'HER-424', 'STEREN ', '', 'X', '-', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(202, 'SEN-198', 'PIROMETRO', '', 'PO-43483', '', 'HER-424', 'STEREN ', '', 'X', '-', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(203, 'SEN-199', 'MEDIDOR DE ILUMINANCIA ', '', 'PO-28267', '', 'HER-410', 'STEREN ', '', 'X', '-', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(204, 'SEN-200', 'TERMOMETRO INFRAROJO ', '', 'OT0468-1', '', 'HER-427 V. 2.0 ', 'STEREN', '', 'X', '-', '17/03/2023', '', '17/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(205, 'SEN-201', 'TERMOMETRO INFRAROJO ', '', 'OT0468-2', '', 'HER-424', 'STEREN', '', 'X', '-', '17/03/2023', '', '17/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(206, 'SEN-202', 'TERMOMETRO INFRAROJO ', '', 'OT0468-3', '', 'HER-427 V. 2.0 ', 'STEREN', '', 'X', '-', '17/03/2023', '', '17/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(207, 'SEN-203', 'MULTIPLICADOR DE PAR TORSIONAL ', '', '2022J10380', '', 'MTMB1990', 'SNAP-ON', '', 'X', '-', '21/04/2023', '', '21/04/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(208, 'SEN-204', 'TERMOHIGROMETRO', '', '1042791', '', 'DPM', 'DEFELSKO', '', 'X', '-', '18/03/2023', '', '18/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(209, 'SEN-205', 'MEDIDOR DE ESPESORES ', '', '1038240', '', 'FNS', 'DEFELSKO', '', 'X', '-', '18/03/2023', '', '18/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(210, 'SEN-206', 'PERFIL DE ANCLAJE', '', '1015767', '', 'SPG', 'DEFELSKO', '', 'X', '-', '18/03/2023', '', '18/03/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(211, 'SEN-207', 'DETECTOR DE FALLAS', '', 'M06321220224R', '', 'SMARTOR', 'SIUI', '', 'X', '-', '30/05/2024', '', '30/05/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(212, 'SEN-208', 'DETECTOR DE FALLAS', '', 'M06321220223R', '', 'SMARTOR', 'SIUI', '', 'X', '-', '30/05/2024', '', '30/05/2025', 'VIGENTE', 'MERIDA', '', '', '', '', '', ''),
(213, 'SEN-209', 'CAM BRIGE GAUGE', '', 'S/NS', '', 'CAT4', 'GAL GAGE', '', '-', 'X', '04/05/2023', '', '04/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(214, 'SEN-210', 'V-WAC GAGE', '', 'S/NS', '', 'S/M', 'STAINLESS PATENTED', '', '-', 'X', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(215, 'SEN-211', 'TORQUIMETRO DIGITAL ', '', '123500625', '', 'ATECH4RS600', 'SNAP-ON', '', 'X', '-', '21/04/2023', '', '21/04/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(216, 'SEN-212', 'CU?A DE COMPROBACION ACERO', '', '206087', '', 'DEFELSKO', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(217, 'SEN-213', 'SONDA MEDIDOR DE ESPESOR UTG ', '', 'S/NS', '', '-', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(218, 'SEN-214', 'CUERPO POSITECTOR', '', '741726', '', 'DEFELSKO', 'POSITECTOR', '', '-', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(219, 'SEN-215', 'TORQUIMETRO DIGITAL ', '', '1223501637', '', 'ATECH4RS600', 'SNAP-ON', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(220, 'SEN-216', 'MULTIPLICADOR DE TORQUE ', '', 'NSA-PT7766', '', '2024A10218', 'SNAP-ON', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(221, 'SEN-217', 'BLOQUE PATRON ESCALONADO DE 4 PASOS ', '', '22387', '', 'BLOCK DE ESCALERA', 'LLOG', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(222, 'SEN-218', 'BLOQUE PATRON (DSC TEST BLOCK)', '', 'HJ09094', '', 'BLOCK DSC', 'LLOG', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(223, 'SEN-219', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(224, 'SEN-220', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(225, 'SEN-221', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(226, 'SEN-222', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(227, 'SEN-223', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(228, 'SEN-224', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(229, 'SEN-225', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(230, 'SEN-226', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(231, 'SEN-227', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(232, 'SEN-228', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(233, 'SEN-229', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(234, 'SEN-230', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(235, 'SEN-231', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(236, 'SEN-232', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(237, 'SEN-233', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(238, 'SEN-234', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(239, 'SEN-235', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(240, 'SEN-236', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(241, 'SEN-237', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(242, 'SEN-238', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(243, 'SEN-239', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(244, 'SEN-240', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(245, 'SEN-241', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(246, 'SEN-242', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(247, 'SEN-243', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(248, 'SEN-244', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(249, 'SEN-245', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(250, 'SEN-246', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(251, 'SEN-247', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(252, 'SEN-248', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(253, 'SEN-249', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(254, 'SEN-250', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(255, 'SEN-251', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(256, 'SEN-252', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(257, 'SEN-253', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(258, 'SEN-254', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(259, 'SEN-255', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(260, 'SEN-256', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(261, 'SEN-257', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(262, 'SEN-258', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(263, 'SEN-259', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(264, 'SEN-260', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(265, 'SEN-261', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(266, 'SEN-262', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(267, 'SEN-263', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(268, 'SEN-264', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(269, 'SEN-265', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(270, 'SEN-266', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(271, 'SEN-267', 'FERITSCOPE FMP30', '', '111-38756A', '', 'FD13H', 'FISCHER', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(272, 'SEN-268', 'DETECTOR DE FALLAS', '', 'M06322230451R', '', 'SMARTOR ', 'SIUI', '', 'X', '-', '31/05/2024', '', '01/05/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(273, 'SEN-269', 'DETECTOR DE FALLAS', '', 'M06322230447R', '', 'SMARTOR ', 'SIUI', '', 'X', '-', '31/05/2024', '', '01/05/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(274, 'SEN-270-23', 'TERMOETRO DE RADIACION', '', 'S/NS', '', 'HER-424', 'STEREN', '', 'X', '-', '11/10/2023', '', '11/10/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(275, 'SEN-271-23', 'TERMOETRO DE RADIACION', '', 'PO# 43483', '', 'HER-424', 'STEREN', '', 'X', '-', '15/03/2024', '', '15/03/2025', 'VIGENTE', 'TOLUCA', '', '', '', '', '', ''),
(276, 'SEN-272-23', 'MEDIDOR DE ILUMINANCIA ', '', 'C223168170', '', 'UT-383', 'UNI-T', '', 'X', '-', '27/09/2023', '', '27/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(277, 'SEN-273-23', 'MEDIDOR DE ILUMINANCIA ', '', 'S/NS', '', 'HER-410', 'STEREN', '', 'X', '-', '27/09/2023', '', '27/09/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(278, 'SEN-274-23', 'TERMOMETRO DE RADIACION', '', 'S/NS', '', 'HER-424', 'STEREN', '', 'X', '-', '11/10/2023', '', '11/10/2024', 'VIGENTE', 'CANCUN', '', '', '', '', '', ''),
(279, 'SEN-275-23', 'TERMOMETRO DE RADIACION', '', 'S/NS', '', 'HER-425', 'STEREN', '', 'X', '-', '14/02/2024', '', '14/02/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(280, 'SEN-276-23', 'BLOCK IIW TYPE 2', '', '73248', '', '1018', 'ZION NDT', '', 'X', '-', '27/02/2023', '', '27/02/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(281, 'SEN-277-23', 'LUCES LED (NEGRA)', '', '101468', '', 'HD-200', 'S/M', '', '-', '-', '14/04/2023', '', '14/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(282, 'SEN-278-23', 'MEDIDOR DE ILUMINANCIA ', '', 'C223168161', '', 'UT383', 'UNI-T', '', 'X', '-', '13/02/2024', '', '14/02/2025', 'VIGENTE', 'CANCUN', '', '', '', '', '', ''),
(283, 'SEN-279-23', 'TERMOMETRO DE RADIACION', '', 'S/NS', '', 'HER-424', 'STEREN', '', 'X', '-', '14/02/2023', '', '14/02/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(284, 'SEN-280-23', 'MEDIDOR DE ILUMINANCIA ', '', 'C223168184', '', 'UT383', 'UNI-T', '', 'X', '-', '14/02/2023', '', '14/02/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(285, 'SEN-281-23', 'MEDIDOR DE ILUMINANCIA ', '', 'C222181205', '', 'UT383', 'UNI-T', '', 'X', '-', '14/02/2023', '', '14/02/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(286, 'SEN-282-23', '', '', '', '', '', '', '', 'X', '-', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(287, 'SEN-283-23', 'MEDIDOR DE ILUMINANCIA ', '', 'C223168177', '', 'UT383', 'UNI-T', '', 'X', '-', '14/02/2023', '', '14/02/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(288, 'SEN-284-23', '', '', '', '', '', '', '', 'X', '-', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(289, 'SEN-285-23', 'MEDIDOR DE ILUMINANCIA ', '', 'PO#42160', '', 'HER-408', 'STEREN', '', 'X', '-', '14/02/2023', '', '14/02/2025', 'VIGENTE', 'TOLUCA', '', '', '', '', '', ''),
(290, 'SEN-286-23', 'TERMOMETRO DE RADIACION', '', 'S/NS', '', 'HER-427', 'STEREN', '', 'X', '-', '14/02/2023', '', '14/02/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(291, 'SEN-287-23', 'DETECTOR DE FALLAS ', '', 'M13311230203R', '', 'SYNCSCAN 2', 'SIUI', '', 'X', '-', '09/06/2023', '', '09/06/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(292, 'SEN-288-23', 'NEGATOSCOPIO', '', '912671', '', 'FV-2009T PLUS', 'ILOG', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(293, 'SEN-289-23', 'TERMOMETRO DE RADIACION', '', 'S/NS', '', 'HER-424', 'STEREN', '', 'X', '-', '11/10/2023', '', '11/10/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(294, 'SEN-290-23', 'CONTADOR GEIGER', '', '901052', '', 'MODEL-2', 'INDUSTRIAL NUCLEAR COMPANY', '', 'X', '-', '16/11/2023', '', '16/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(295, 'SEN-291-23', 'ALARMA SONORA', '', '48228', '', 'ND-15', 'NDS-PRODUCTS', '', 'X', '-', '22/11/2023', '', '22/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(296, 'SEN-292-23', 'ALARMA SONORA', '', '72632', '', 'RA-500', 'NDS-PRODUCTS', '', 'X', '-', '22/11/2023', '', '22/05/2024', 'VENCIDO', '', '', '', '', '', '', ''),
(297, 'SEN-293-23', 'MEDIDOR DE SOCABADOS', '', '-', '', 'WG-08VG', 'RF GAGE ', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(298, 'SEN-294', 'CALIBRADOR DE SOLDADURA ', '', '-', '', 'CAT4', 'GAL GAGE', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(299, 'SEN-295', 'BLOCK DSC ', '', 'J09079', '', '1018 STEEL', 'DSC', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(300, 'SEN-296', 'CAMBRIDGE', '', '296-465-5750', '', 'CAT4 ', 'GAL GAGE', '', 'X', '-', '-', '', '-', 'VIGENTE', '', '', '', '', '', '', ''),
(301, 'SEN-297', 'DETECTOR DE SOCABADOS ', '', '-', '', 'WG-08VG', 'RF GAGE ', '', 'X', '-', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(302, 'SEN-298', 'DETECTOR DE FALLAS', '', 'M06322230446R', '', 'SMARTOR', 'SIUI', '', 'X', '-', '26/02/2024', '', '26/02/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(303, 'SEN-299', 'CALIBRADOR DIGITAL', '', 'S/NS', '', 'HER-411', 'STEREN', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(304, 'SEN-300', 'CALIBRADOR DIGITAL', '', 'S/NS', '', 'HER-411', 'STEREN', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(305, 'SEN-301', 'CALIBRADOR DIGITAL', '', 'S/NS', '', 'HER-411', 'STEREN', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(306, 'SEN-302', 'CALIBRADOR DIGITAL', '', 'S/NS', '', 'HER-411', 'STEREN', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(307, 'SEN-303', 'MEDIDOR DE ILUMINANCIA ', '', 'PO-43038', '', 'HER-408', 'STEREN', '', 'X', '-', '14/03/2024', '', '14/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(308, 'SEN-304', 'TERMOMETRO DE RADIACION ', '', 'PO-42397', '', 'HER-427', 'STEREN ', '', 'X', '-', '14/03/2024', '', '14/03/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(309, 'SEN-305', 'BLOCK IIW TIPO 2', '', '71503', '', 'BLQ IIW TIPO 2', 'S/M', '', 'X', '-', '05/10/2023', '', '05/10/2024', 'VIGENTE', 'TOLUCA', '', '', '', '', '', ''),
(310, 'SEN-306', 'DUROMETRO ', '', 'EDO-0228', '', 'DHT-200', 'HARDENESS TESTER', '', 'X', '-', '03/11/2023', '', '03/11/2024', 'VIGENTE', '', '', '', '', '', '', ''),
(311, 'SEN-307', 'BLOCK', '', 'G0C190014R', '', '5052UA', 'S/N', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(312, 'SEN-308', 'DETECTOR DE FALLAS POR ULTRASONIDO', '', '776260', '', 'TOPAZ 16/64p', 'ZETEC', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(313, 'SEN-309', 'DETECTOR DE FALLAS POR ULTRASONIDO', '', 'M06320210053R', '', 'SMARTOR', 'SIUI', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(314, 'SEN-310', 'CALIBRADOR DIGITAL', '', 'SON-VE-03', '', 'S/M', 'TITAN', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(315, 'SEN-311', 'ULTRASONIDO', '', '14J022YK', '', 'S/N', 'GE INSPECTION TECHNOLOGIES', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(316, 'SEN-312', 'TRANSDUCTOR', '', '2134 Y 2137', '', 'AWS266', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(317, 'SEN-313', 'TRANSDUCTOR', '', '16L-1940', '', '113-544-001', 'GE', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(318, 'SEN-314', '4 STEP TEST BLOCK ', '', 'NN05001', '', '', 'GE', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(319, 'SEN-315', 'MANUALLY CONTROLLED ULTRASONIC PULSER-RECIEVER', '', '192175', '', '5077PR', 'OLYMPUS', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(320, 'SEN-316', 'QUICK CONNECT ANGLE BEAM TRANSDUCER', '', 'SF1011', '', '', 'GE', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(321, 'SEN-317', 'KRAUTKRAMER TRANSDUCER', '', '023FW9', '', '', 'GE', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(322, 'SEN-318', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(323, 'SEN-319', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(324, 'SEN-320', '', '', '', '', '', '', '', '', '', '', '', '', 'VENCIDO', '', '', '', '', '', '', ''),
(325, 'SON-VE03', 'CALIBRADOR DIGITAL', '', 'S/NS', '', 'S/M', 'TITAN', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(326, 'SON-VE04', 'CALIBRADOR DIGITAL', '', 'S/NS', '', 'S/M', 'TITAN', '', 'X', '-', '20/04/2024', '', '20/04/2025', 'VIGENTE', '', '', '', '', '', '', ''),
(327, '', 'DUR?METRO ', '', 'YDJ240612023324', '', 'LEED HARDNESS', 'LEED HARDNESS', 'SI', 'PENDIENTE', 'PENDIENTE', 'PENDIENTE', 'PENDIENTE', 'PENDIENTE', 'PENDIENTE', 'PENDIENTE', 'PENDIENTE', 'PENDIENTE', 'BLOCK HDL SERIE:DL2312-927 NUEVO CON PROTECTOR, LA', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_almacen`
--

CREATE TABLE `archivo_almacen` (
  `id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_fuente`
--

CREATE TABLE `archivo_fuente` (
  `id` int(11) NOT NULL,
  `fuente_id` int(11) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_personal`
--

CREATE TABLE `archivo_personal` (
  `id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `archivo_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_radiacion`
--

CREATE TABLE `archivo_radiacion` (
  `id` int(11) NOT NULL,
  `radiacion_id` int(11) NOT NULL,
  `archivo_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo_vehiculos`
--

CREATE TABLE `archivo_vehiculos` (
  `id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `archivo_vehiculo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumibles`
--

CREATE TABLE `consumibles` (
  `id` int(11) NOT NULL,
  `consumible` varchar(50) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `entrada` varchar(50) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `unidades` int(11) NOT NULL,
  `accesorios` varchar(250) NOT NULL,
  `ns` varchar(50) NOT NULL,
  `inventario` varchar(50) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `caducidad` varchar(50) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `salida` int(11) NOT NULL,
  `personal` varchar(50) NOT NULL,
  `restantes` int(11) NOT NULL,
  `status_con` varchar(50) NOT NULL,
  `condiciones` varchar(50) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `proveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `id` int(11) NOT NULL,
  `entrada_id` int(11) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `curies` varchar(255) NOT NULL,
  `tbq` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `equipo` varchar(50) NOT NULL,
  `talla` varchar(50) NOT NULL,
  `entrada` varchar(50) NOT NULL,
  `unidades` int(11) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `salida` varchar(50) NOT NULL,
  `salida_unidad` varchar(50) NOT NULL,
  `personal` varchar(50) NOT NULL,
  `restantes` int(11) NOT NULL,
  `proveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_radiacion`
--

CREATE TABLE `equipo_radiacion` (
  `id` int(11) NOT NULL,
  `num_int` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `calibracion` varchar(50) NOT NULL,
  `verificacion` varchar(50) NOT NULL,
  `ultima` varchar(50) NOT NULL,
  `proxima` varchar(50) NOT NULL,
  `status_c` varchar(50) NOT NULL,
  `ubicacion` varchar(50) NOT NULL,
  `prueba` varchar(50) NOT NULL,
  `condiciones` varchar(50) NOT NULL,
  `observaciones` varchar(50) NOT NULL,
  `accesorios` varchar(255) NOT NULL,
  `archivo_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE `fechas` (
  `id` int(11) NOT NULL,
  `fechas_id` int(11) NOT NULL,
  `ultimo_mantenimiento` date NOT NULL,
  `proximo_mantenimiento` date NOT NULL,
  `kilometraje` varchar(50) NOT NULL,
  `status_v` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuentes`
--

CREATE TABLE `fuentes` (
  `id` int(11) NOT NULL,
  `fuentes` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `serie` varchar(50) NOT NULL,
  `contenedor` varchar(50) NOT NULL,
  `entrada` varchar(255) NOT NULL,
  `salida` varchar(255) NOT NULL,
  `decantamiento` varchar(255) NOT NULL,
  `documentos_fuente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdfs`
--

CREATE TABLE `pdfs` (
  `id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_poe`
--

CREATE TABLE `personal_poe` (
  `id` int(11) NOT NULL,
  `personal` varchar(50) NOT NULL,
  `dosimetros` varchar(50) NOT NULL,
  `cnsns` varchar(50) NOT NULL,
  `documentos_poe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `alta` varchar(255) NOT NULL,
  `seleccion` varchar(100) NOT NULL,
  `notas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre`, `correo`, `producto`, `alta`, `seleccion`, `notas`) VALUES
(1, 'RADDOS S.A .DE C.V.', 'logistica@raddos.mx:\ndireccion@raddos.mx: Ana María Navarro Ramírez:\nTEL: 5515463837, 5515464517 Y 5526088473', 'Dosimetria', '2020-06-01', 'Eval.', 'Proveedor confiable'),
(2, 'ZION', 'fruz@zion-ndt.mxCristian: Torres Tel: 55 30 44 71 38', 'Equipos END y Calibracion', '2020-06-01', 'Eval.', 'Proveedor confiable'),
(3, 'Llog', 'laura.lopez@ilogsa.com: Pilar Palacio: Tel: Cel: 55 18 00 63 27, Trab: 55 57 50 14 14', 'Equipos END y Calibracion e Insumos', '2020-06-01', 'Eval.', 'Proveedor confiable'),
(4, 'ASMET', 'Srita. Olga, Tel 5551192039 asmet.mx19@gmail.com: Lindavista (oficina) c/ SARA GARCÍA: sgarcia@asmet.com.mx, 55 5754-3425/ 55 5754-6433 ', 'Calibracion de equipos e Instrumentos ', '2020-06-01', 'Eval.', 'Proveedor confiable'),
(5, 'Zuplitek', 'samuel@suplitec-ndt.com: Samuel Tel: Cel: 55 70 52 38 65', 'Equipos e Insumos', '2020-06-01', 'Eval.', 'Proveedor confiable'),
(6, 'CYSTEC', 'ventas@cystec.com.mx: servicioclientes@cystec.com.mx: Ing. Axel Arturo Ramos Sánchez:  Tel: 5559326141, 5559326147', 'Calibracion de equipos y Ensayos de aptitud. Calibracion y equipos tecnicos en PND', '2020-06-01', 'Eval.', 'Proveedor confiable'),
(7, 'Tubería, válvulas y conexiones ', 'invacoindustrial@hotmail.com', 'Herramientas e insumos para prueba hidrostatica', '2020-10-15', 'Eval.', 'Proveedor confiable'),
(8, 'Ingeniería e inspección en soldadura', 'ventas1@inissa.com', 'Cursos y pruebas', '2021-05-14', 'Eval.', 'Proveedor confiable'),
(9, 'Metrología y Física Aplicada S.A. de C. V.', 'mfa@metrogiafa.com: Martin Suarez Barraza Tel: 5515464517', 'Calibracion de equipos e instrumentos ', '2021-03-21', 'Eval.', 'Proveedor confiable'),
(10, 'INPROS S.A. DE C.V ', 'Susana.reynoso@inprosmexico.com.mx', 'Calibracion de equipos', '2022-06-17', 'Eval.', 'Proveedor confiable'),
(11, 'Caltest Metrologia', 'Yuridia García:  Tel.: 5557776404, 5557778208, 5543945320 Rebeca Rodríguez ', 'Calibración', '2022-11-12', 'Eval.', 'Proveedor confiable'),
(12, 'ASEI', 'gabrielguillen@aseimexico.com: Lic. Gabriel Guillen: Trabajo: 8331265584', 'Pruebas de Impacto', '2023-08-07', 'Eval.', 'Proveedor confiable'),
(13, 'Fluss Technologies de Mexico S.A.S. de C.V.', 'contacto@flusstech.com: Lic. Juan Antonio Labarrios: 5538987080', 'Calibración', '2023-08-19', 'Eval.', 'Proveedor confiable'),
(14, 'Pablo Leyva Martinez', 'Ing. Agustín Correa', 'Mantenimiento a Rieles y puntas de ubicación, extensiones ', '2022-06-16', 'Eval.', 'Proveedor confiable'),
(15, 'ICEMA', 'fabiola_fernandez@icema.com.mx:  Tel. Fabiola Fernández Cruz: Tel: 5571557731, 5571557742, 5571557736', 'Calibración', '2022-09-09', 'Eval.', 'Proveedor confiable'),
(16, 'A&C Metrology Services S.A. de C. V.', 'Tel 2225740702, EMAIL: ventas@acmetrology.com, ventas2@acmetrology.com. ', 'Servicios de Calibración ', '2022-12-16', 'Eval.', 'Proveedor confiable'),
(17, 'Bruder NDT', 'Bruner: Tel.5548494909, Tel Cd. Mex. 5522330740, Tel. 8335755560', 'Suministros ', '2023-08-24', 'Eval.', 'Proveedor confiable'),
(18, 'Twilight S. A. de C.V.', 'Av. Alfonso Reyes Piso 7, Of. 704 2612, Col. Del Paseo Residencial, Monterrey Nuevo León, 64920, Tel: (81) 8115-1400, ventas@twilight.mx, ventas5twilight.mx', 'Servicios de Calibración ', '2023-04-29', 'Eval.', 'Proveedor confiable'),
(19, 'CENAM', 'Tel.: 442 2110500 ext. 3692, e-mail: dsiservtec@cenam.mx, ', 'Servicios de Calibración ', '2023-05-31', 'Eval.', 'Proveedor confiable'),
(20, 'Canamex', 'Gitana Mz 87 Lt 8, No. 445, Col. Del Mar Tláhuac C.P. 13270, Ciudad de México, Tel 5558509220, 5565492513', 'Servicios de Calibración ', '2023-10-20', 'Eval.', 'Proveedor confiable'),
(21, 'ARJESSIGER ', 'TEL: 5553910665, Ventas, ventas@arjessiger.com', 'Servicios de Calibración ', '2024-01-10', 'Eval.', 'Proveedor confiable '),
(22, 'Nodet S.A. de C.V.', 'hector@nodet.com.mx: Tel. (55) 5771 0661 / (55)63636665: Cel. (56) 3400 1230 ', 'Calibración y equipos', '2023-03-26', 'Eval.', 'Proveedor confiable'),
(23, 'IVG Servicios', ' (55) 3036-6594, gerenciageneral@ivgservicios.com, Úrsulo Galvan53 Col.Presidentes, Ejidales, Coyoacán, ivgservicios.com', 'Servicios de Calibración ', '2024-01-22', 'Eval.', 'Proveedor confiable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `producto` varchar(255) DEFAULT NULL,
  `alta` varchar(255) DEFAULT NULL,
  `seleccion` varchar(255) DEFAULT NULL,
  `notas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_eq`
--

CREATE TABLE `proveedor_eq` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `producto` varchar(50) NOT NULL,
  `alta` varchar(50) NOT NULL,
  `seleccion` varchar(255) NOT NULL,
  `notas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `id` int(11) NOT NULL,
  `salida_id` int(11) DEFAULT NULL,
  `fecha_salida` varchar(255) DEFAULT NULL,
  `curies_salida` varchar(255) DEFAULT NULL,
  `tbq_salida` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `vehiculo` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `ano` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `ns` varchar(50) NOT NULL,
  `servicio` varchar(50) NOT NULL,
  `placas` varchar(50) NOT NULL,
  `motor` varchar(50) NOT NULL,
  `compania` varchar(50) NOT NULL,
  `poliza` varchar(50) NOT NULL,
  `termina` varchar(50) NOT NULL,
  `circulacion` varchar(50) NOT NULL,
  `verificacion` varchar(50) NOT NULL,
  `mantenimiento` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `gasolina` varchar(50) NOT NULL,
  `responsable` varchar(50) NOT NULL,
  `archivo_vehiculo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificacion`
--

CREATE TABLE `verificacion` (
  `id` int(11) NOT NULL,
  `verificacion_id` int(11) NOT NULL,
  `verificacion` varchar(50) NOT NULL,
  `fecha_verificacion` varchar(50) NOT NULL,
  `status_ver` varchar(50) NOT NULL,
  `kilometraje` int(50) NOT NULL,
  `status_v` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accesorio_id` (`accesorio_id`);

--
-- Indices de la tabla `accesorios_consumibles`
--
ALTER TABLE `accesorios_consumibles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consumible_id` (`consumible_id`);

--
-- Indices de la tabla `accesorios_radiacion`
--
ALTER TABLE `accesorios_radiacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `radiacion_id` (`radiacion_id`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivo_almacen`
--
ALTER TABLE `archivo_almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `almacen_id` (`almacen_id`);

--
-- Indices de la tabla `archivo_fuente`
--
ALTER TABLE `archivo_fuente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuente_id` (`fuente_id`);

--
-- Indices de la tabla `archivo_personal`
--
ALTER TABLE `archivo_personal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personal_id` (`personal_id`);

--
-- Indices de la tabla `archivo_radiacion`
--
ALTER TABLE `archivo_radiacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `radiacion_id` (`radiacion_id`);

--
-- Indices de la tabla `archivo_vehiculos`
--
ALTER TABLE `archivo_vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculo_id` (`vehiculo_id`);

--
-- Indices de la tabla `consumibles`
--
ALTER TABLE `consumibles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entrada_id` (`entrada_id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo_radiacion`
--
ALTER TABLE `equipo_radiacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fechas_id` (`fechas_id`);

--
-- Indices de la tabla `fuentes`
--
ALTER TABLE `fuentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pdfs`
--
ALTER TABLE `pdfs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `almacen_id` (`almacen_id`);

--
-- Indices de la tabla `personal_poe`
--
ALTER TABLE `personal_poe`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `proveedor_eq`
--
ALTER TABLE `proveedor_eq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_id` (`proveedor_id`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salida_id` (`salida_id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `verificacion`
--
ALTER TABLE `verificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verificacion_id` (`verificacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `accesorios_consumibles`
--
ALTER TABLE `accesorios_consumibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `accesorios_radiacion`
--
ALTER TABLE `accesorios_radiacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=328;

--
-- AUTO_INCREMENT de la tabla `archivo_almacen`
--
ALTER TABLE `archivo_almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_fuente`
--
ALTER TABLE `archivo_fuente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_personal`
--
ALTER TABLE `archivo_personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_radiacion`
--
ALTER TABLE `archivo_radiacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivo_vehiculos`
--
ALTER TABLE `archivo_vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `consumibles`
--
ALTER TABLE `consumibles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrada`
--
ALTER TABLE `entrada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipo_radiacion`
--
ALTER TABLE `equipo_radiacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fechas`
--
ALTER TABLE `fechas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fuentes`
--
ALTER TABLE `fuentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pdfs`
--
ALTER TABLE `pdfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_poe`
--
ALTER TABLE `personal_poe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor_eq`
--
ALTER TABLE `proveedor_eq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `verificacion`
--
ALTER TABLE `verificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD CONSTRAINT `accesorios_ibfk_1` FOREIGN KEY (`accesorio_id`) REFERENCES `almacen` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `accesorios_consumibles`
--
ALTER TABLE `accesorios_consumibles`
  ADD CONSTRAINT `accesorios_consumibles_ibfk_1` FOREIGN KEY (`consumible_id`) REFERENCES `consumibles` (`id`);

--
-- Filtros para la tabla `accesorios_radiacion`
--
ALTER TABLE `accesorios_radiacion`
  ADD CONSTRAINT `accesorios_radiacion_ibfk_1` FOREIGN KEY (`radiacion_id`) REFERENCES `equipo_radiacion` (`id`);

--
-- Filtros para la tabla `archivo_almacen`
--
ALTER TABLE `archivo_almacen`
  ADD CONSTRAINT `archivo_almacen_ibfk_1` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id`);

--
-- Filtros para la tabla `archivo_fuente`
--
ALTER TABLE `archivo_fuente`
  ADD CONSTRAINT `archivo_fuente_ibfk_1` FOREIGN KEY (`fuente_id`) REFERENCES `fuentes` (`id`);

--
-- Filtros para la tabla `archivo_personal`
--
ALTER TABLE `archivo_personal`
  ADD CONSTRAINT `archivo_personal_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `personal_poe` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `archivo_radiacion`
--
ALTER TABLE `archivo_radiacion`
  ADD CONSTRAINT `archivo_radiacion_ibfk_1` FOREIGN KEY (`radiacion_id`) REFERENCES `equipo_radiacion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `archivo_vehiculos`
--
ALTER TABLE `archivo_vehiculos`
  ADD CONSTRAINT `archivo_vehiculos_ibfk_1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`entrada_id`) REFERENCES `fuentes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD CONSTRAINT `fechas_ibfk_1` FOREIGN KEY (`fechas_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pdfs`
--
ALTER TABLE `pdfs`
  ADD CONSTRAINT `pdfs_ibfk_1` FOREIGN KEY (`almacen_id`) REFERENCES `almacen` (`id`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `consumibles` (`id`);

--
-- Filtros para la tabla `proveedor_eq`
--
ALTER TABLE `proveedor_eq`
  ADD CONSTRAINT `proveedor_eq_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`salida_id`) REFERENCES `fuentes` (`id`);

--
-- Filtros para la tabla `verificacion`
--
ALTER TABLE `verificacion`
  ADD CONSTRAINT `verificacion_ibfk_1` FOREIGN KEY (`verificacion_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
