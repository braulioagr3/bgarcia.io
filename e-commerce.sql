-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 31-03-2022 a las 04:02:54
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `e-commerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nit` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `dateadd` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nit`, `nombre`, `telefono`, `direccion`, `dateadd`, `usuario_id`, `estatus`) VALUES
(5, 1, '2', 3, '4', '2022-03-31 00:48:29', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL,
  `Comentario` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `codproducto`, `fecha`, `cantidad`, `precio`, `usuario_id`) VALUES
(63, 76, '2022-03-25 04:52:25', 5, '300.00', 1),
(64, 77, '2022-03-25 05:07:16', 5, '300.00', 1),
(65, 78, '2022-03-25 05:07:52', 5, '300.00', 1),
(66, 79, '2022-03-25 05:08:07', 5, '300.00', 1),
(67, 80, '2022-03-25 05:09:45', 5, '300.00', 1),
(68, 81, '2022-03-25 05:12:51', 5, '300.00', 1),
(69, 82, '2022-03-25 05:13:17', 5, '300.00', 1),
(74, 87, '2022-03-31 02:00:25', 2, '55.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL DEFAULT 1,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `descripcion`, `categoria`, `precio`, `existencia`, `date_add`, `usuario_id`, `estatus`, `foto`) VALUES
(76, 'Harry Potter y la Piedra Filosofal', 8, '300.00', 5, '2022-03-25 04:52:25', 1, 1, '1.png'),
(77, 'Harry Potter y La Camara Secreta', 7, '300.00', 5, '2022-03-25 05:07:16', 1, 1, '2.png'),
(78, 'Harry Potter y El Prisionero de Azkaban', 7, '300.00', 5, '2022-03-25 05:07:52', 1, 1, '3.png'),
(79, 'Harry Potter y El Caliz de Fuego', 7, '300.00', 5, '2022-03-25 05:08:07', 1, 1, '4.png'),
(80, 'Harry Potter y La Orden del Fenix', 7, '300.00', 5, '2022-03-25 05:09:45', 1, 1, '5.png'),
(81, 'Harry Potter y El Principe Mestizo', 7, '300.00', 5, '2022-03-25 05:12:51', 1, 1, '6.png'),
(82, 'Harry Potter y Las Reliquias de la Muerte', 7, '300.00', 5, '2022-03-25 05:13:17', 1, 1, '7.png'),
(87, 'libro 1', 7, '55.00', 2, '2022-03-31 02:00:25', 1, 1, 'img_fb465120ff9b2108178943f3b2531221.jpg');

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    	INSERT INTO entradas(codproducto,cantidad,precio,usuario_id)
        VALUES(new.codproducto,new.existencia,new.precio,new.usuario_id);
     END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idcat` int(11) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `caracteristica` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idcat`, `categoria`, `caracteristica`, `descripcion`, `date_add`, `usuario_id`, `estatus`) VALUES
(6, '1', '2', '3', '2022-03-23 22:03:22', 1, 0),
(7, 'Fantasias', 'Fantasia', 'Otro dato', '2022-03-25 04:43:50', 1, 1),
(8, 'Ciencia Ficcion', 'Ficticias', 'Autores reconocidos: Lovecraft', '2022-03-26 02:02:51', 1, 1),
(9, 'X', 'X', 'X', '2022-03-26 02:03:40', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Vendedor'),
(4, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldetavent`
--

CREATE TABLE `tbldetavent` (
  `ID` int(11) NOT NULL,
  `IDVENTA` int(11) NOT NULL,
  `IDPRODUCTO` int(11) NOT NULL,
  `PRECIODUNO` decimal(20,2) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `DESCARGADO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbldetavent`
--

INSERT INTO `tbldetavent` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIODUNO`, `CANTIDAD`, `DESCARGADO`) VALUES
(47, 68, 76, '300.00', 1, 0),
(48, 68, 77, '300.00', 1, 0),
(49, 68, 78, '300.00', 1, 0),
(50, 68, 79, '300.00', 1, 0),
(51, 68, 80, '300.00', 1, 0),
(52, 68, 81, '300.00', 1, 0),
(53, 68, 82, '300.00', 1, 0),
(54, 69, 76, '300.00', 1, 0),
(55, 69, 80, '300.00', 1, 0),
(56, 70, 76, '300.00', 1, 0),
(57, 70, 80, '300.00', 1, 0),
(58, 70, 77, '300.00', 1, 0),
(59, 70, 81, '300.00', 1, 0),
(60, 70, 78, '300.00', 1, 0),
(61, 70, 82, '300.00', 1, 0),
(62, 70, 79, '300.00', 1, 0),
(63, 71, 76, '300.00', 1, 0),
(64, 71, 77, '300.00', 1, 0),
(65, 72, 87, '55.00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductos`
--

CREATE TABLE `tblproductos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Precio` decimal(20,2) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `id_pro` int(11) NOT NULL,
  `Imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblventas`
--

CREATE TABLE `tblventas` (
  `ID` int(11) NOT NULL,
  `ClaveTransaccion` varchar(250) NOT NULL,
  `PaypalDatos` text NOT NULL,
  `Fecha` datetime NOT NULL,
  `Correo` varchar(5000) NOT NULL,
  `Total` decimal(60,0) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblventas`
--

INSERT INTO `tblventas` (`ID`, `ClaveTransaccion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) VALUES
(68, 'af0ec5337a66cb8be19ecaf48ae687f1', '', '2022-03-30 04:46:12', 'admin@gmail.com', '2100', 'pendiente'),
(69, 'af0ec5337a66cb8be19ecaf48ae687f1', '', '2022-03-30 04:49:00', 'admin@gmail.com', '600', 'pendiente'),
(70, '294c28cc3cafded1c1cdbf7f6f7f9d78', '', '2022-03-31 00:47:59', 'admin@gmail.com', '2100', 'pendiente'),
(71, '294c28cc3cafded1c1cdbf7f6f7f9d78', '', '2022-03-31 01:59:32', 'admin@gmail.com', '600', 'pendiente'),
(72, '294c28cc3cafded1c1cdbf7f6f7f9d78', '', '2022-03-31 02:00:46', 'admin@gmail.com', '55', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 1, 1),
(2, 'Braulio Alejandro Garcia Rivera', 'braulioagr3@gmail.com', 'braulioagr3', 'b14960f6dd7a8bcb0144994cc0271e54', 4, 1),
(20, 'Fernando Herrera', 'fherrera@gmail.com', 'fherrera', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1),
(21, 'Ricardo Moreno', 'rmoreno@gmail.com', 'rmoreno', '81dc9bdb52d04dc20036dbd8313ed055', 2, 1),
(22, 'Braulio', 'ejemplo@uaslp.cmx', 'brau', '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`categoria`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idcat`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tbldetavent`
--
ALTER TABLE `tbldetavent`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDVENTA` (`IDVENTA`),
  ADD KEY `IDPRODUCTO` (`IDPRODUCTO`);

--
-- Indices de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_pro` (`id_pro`);

--
-- Indices de la tabla `tblventas`
--
ALTER TABLE `tblventas`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idcat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbldetavent`
--
ALTER TABLE `tbldetavent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tblventas`
--
ALTER TABLE `tblventas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `proveedor` (`idcat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbldetavent`
--
ALTER TABLE `tbldetavent`
  ADD CONSTRAINT `tbldetavent_ibfk_1` FOREIGN KEY (`IDVENTA`) REFERENCES `tblventas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbldetavent_ibfk_2` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
