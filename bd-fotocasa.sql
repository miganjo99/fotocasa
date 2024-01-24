-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2022 a las 18:41:13
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionario`
--

-- --------------------------------------------------------





-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `car`
--

CREATE TABLE `vivienda` (
  `id_vivienda` int(11) NOT NULL,
  `estado` varchar(8) DEFAULT NULL,
  `antiguedad` int(8) DEFAULT NULL,
  `num_habs` varchar(20) DEFAULT NULL,
  `fecha_publicacion` varchar(10) DEFAULT NULL,
  `precio` int(8) DEFAULT NULL,
  `img_vivienda` varchar(300) NOT NULL,
  `aseos` int(3) NOT NULL,
  `m2` int(8) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_operacion` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_ciudad` int(11) NOT NULL,
  `id_img` int(11) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `car`
--

INSERT INTO `vivienda` (`id_vivienda`, `estado`, `antiguedad`, `num_habs`, `fecha_publicacion`, `precio`, `img_vivienda`, `aseos`, `m2`, `id_tipo`,`id_operacion`,`id_categoria`,`id_ciudad`,`id_img`) VALUES
(1, 'a reformar', 50, 4, '10/01/2015', 150000, 'views/img/vivienda/vivienda1.1.jpg', 3, 200,1,1,1,1,1), 
(2, 'reformado', 30, 5, '10/01/2019', 35000, 'views/img/vivienda/vivienda2.1.jpg', 1, 100,2,2,2,2,2),
(3, 'nuevo', 0, 3, '10/01/2020', 122000, 'views/img/vivienda/vivienda3.1.jpg', 3, 90,3,3,3,3,3),
(4, 'reformado', 25, 4, '10/01/2023', 200000, 'views/img/vivienda/vivienda4.1.jpg', 1, 190,2,2,2,2,2),
(5, 'a reformar', 45, 5, '10/01/2022', 55000, 'views/img/vivienda/vivienda5.1.jpg', 2, 80,1,1,1,1,1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `tipo` (
  `id_tipo` int(11) NOT NULL,
  `name_tipo` varchar(25) NOT NULL,
  `img_tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `tipo` (`id_tipo`, `name_tipo`, `img_tipo`) VALUES
(1,'chalet', 'views/img/tipo/chalet.png'),
(2,'finca', 'views/img/tipo/finca.png'),
(3,'piso', 'views/img/tipo/piso.png'),
(4,'casa', 'views/img/tipo/casa.png'),
(5,'apartamento', 'views/img/tipo/apartamento.png');
-- --------------------------------------------------------
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `ciudad` (
  `id_ciudad` int(11) NOT NULL,
  `name_ciudad` varchar(25) NOT NULL,
  `img_ciudad` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `ciudad` (`id_ciudad`, `name_ciudad`, `img_ciudad`) VALUES
(1,'valencia', 'views/img/ciudad/valencia.png'),
(2,'madrid', 'views/img/ciudad/madrid.png'),
(3,'barcelona', 'views/img/ciudad/barcelona.png'),
(4,'santander', 'views/img/ciudad/santander.png'),
(5,'ontinyent', 'views/img/ciudad/ontinyent.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exceptions`
--

CREATE TABLE `exceptions` (
  `type_error` int(10) NOT NULL,
  `spot` varchar(100) NOT NULL,
  `current_date_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `exceptions`
--

INSERT INTO `exceptions` (`type_error`, `spot`, `current_date_time`) VALUES
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:54:35'),
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:54:39'),
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:54:40'),
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:54:41'),
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:54:41'),
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:56:23'),
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:56:29'),
(503, 'Carrusel_Categoria HOME', '2022-03-18 23:57:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_cars`
--

CREATE TABLE `img_vivienda` (
  `id_img` int(11) NOT NULL,
  `id_vivienda` int(11) DEFAULT NULL,
  `img_vivienda` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `img_cars`
--

INSERT INTO `img_vivienda` (`id_img`, `id_vivienda`, `img_vivienda`) VALUES
(1, 1, 'views/img/vivienda/vivienda1.1.jpg'),
(2, 1, 'views/img/vivienda/vivienda1.2.jpg'),
(3, 1, 'views/img/vivienda/vivienda1.3.jpg'),
(4, 1, 'views/img/vivienda/vivienda1.4.jpg'),
(5, 2, 'views/img/vivienda/vivienda2.1.jpg'),
(6, 2, 'views/img/vivienda/vivienda2.2.jpg'),
(7, 2, 'views/img/vivienda/vivienda2.3.jpg'),
(8, 2, 'views/img/vivienda/vivienda2.4.jpg'),
(9, 3, 'views/img/vivienda/vivienda3.1.jpg'),
(10, 3, 'views/img/vivienda/vivienda3.2.jpg'),
(11, 3, 'views/img/vivienda/vivienda3.3.jpg'),
(12, 3, 'views/img/vivienda/vivienda3.4.jpg'),
(13, 4, 'views/img/vivienda/vivienda4.1.jpg'),
(14, 4, 'views/img/vivienda/vivienda4.2.jpg'),
(15, 4, 'views/img/vivienda/vivienda4.3.jpg'),
(16, 4, 'views/img/vivienda/vivienda4.4.jpg'),
(17, 5, 'views/img/vivienda/vivienda5.1.jpg'),
(18, 5, 'views/img/vivienda/vivienda5.2.jpg'),
(19, 5, 'views/img/vivienda/vivienda5.3.jpg'),
(20, 5, 'views/img/vivienda/vivienda5.4.jpg');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `type_motor`
--

CREATE TABLE `operacion` (
  `id_operacion` varchar(10) NOT NULL,
  `name_operacion` varchar(25) NOT NULL,
  `img_operacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `type_motor`
--

INSERT INTO `operacion` (`id_operacion`, `name_operacion`, `img_operacion`) VALUES
(1, 'compra', 'views/img/operacion/compra.jpg'),
(2, 'alquiler', 'views/img/operacion/alquiler.jpg'),
(3, 'compartir', 'views/img/operacion/compartir.jpg'),
(4, 'alquiler_habitacion', 'views/img/operacion/alquiler_habitacion.jpg'),
(5, 'alquiler_con_compra', 'views/img/operacion/alquiler_con_compra.jpg');






CREATE TABLE `categoria` (
  `id_categoria` varchar(10) NOT NULL,
  `name_categoria` varchar(25) NOT NULL,
  `img_categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `type_motor`
--

INSERT INTO `categoria` (`id_categoria`, `name_categoria`, `img_categoria`) VALUES
(1, 'obra nueva', 'views/img/operacion/obra_nueva.jpg'),
(2, 'buen estado', 'views/img/operacion/buen_estado.jpg'),
(3, 'a reformar', 'views/img/operacion/a_reformar.jpg');

-- --------------------------------------------------------


-- Indices de la tabla `img_cars`
--
ALTER TABLE `img_vivienda`
  ADD PRIMARY KEY (`id_img`),
  ADD KEY `id_vivienda` (`id_vivienda`);

ALTER TABLE `vivienda`
  MODIFY `id_vivienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `ciudad`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;


ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `img_vivienda`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;


ALTER TABLE `operacion`
  MODIFY `id_operacion` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;



