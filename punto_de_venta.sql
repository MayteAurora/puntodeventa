-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2020 a las 18:03:21
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `punto_de_venta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idCompra` int(5) NOT NULL,
  `TotalProductos` int(4) DEFAULT NULL,
  `MontoTotalC` float DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Sucursal` varchar(30) DEFAULT NULL,
  `Proveedor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idCompra`, `TotalProductos`, `MontoTotalC`, `Fecha`, `Hora`, `Sucursal`, `Proveedor`) VALUES
(2, 25, 13250, '2020-11-15', '19:31:26', 'La Favorita', 'Empresa S.A de C.V'),
(8, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 10, 3600, '2020-10-19', '09:46:03', 'La Favorita', 'Empresa S.A de C.V'),
(12, 10, 15000, '2020-10-19', '09:48:32', 'La Favorita', 'Empresa S.A de C.V');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `idDetalleCompra` int(5) NOT NULL,
  `idProducto` int(5) DEFAULT NULL,
  `CantidadProd` int(4) DEFAULT NULL,
  `PrecioCompra` float DEFAULT NULL,
  `TotalCompra` float DEFAULT NULL,
  `idCompra` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`idDetalleCompra`, `idProducto`, `CantidadProd`, `PrecioCompra`, `TotalCompra`, `idCompra`) VALUES
(1, 2, 10, 360, 3600, 9),
(2, 2, 10, 1500, 15000, 12),
(3, 5, 25, 530, 13250, 2);

--
-- Disparadores `detallecompra`
--
DELIMITER $$
CREATE TRIGGER `actTotalcompra` BEFORE INSERT ON `detallecompra` FOR EACH ROW set new.TotalCompra = new.CantidadProd * new.PrecioCompra
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actcompra` AFTER INSERT ON `detallecompra` FOR EACH ROW update producto set cantidad = cantidad + new.CantidadProd 
where idproducto = new.idproducto
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `actlcompra` BEFORE INSERT ON `detallecompra` FOR EACH ROW BEGIN   IF not exists (SELECT  idcompra FROM compra ) THEN INSERT INTO compra  values ("", 0, 0, NOW(), "La Favorita", "Empresa S.A de C.V");  ELSEIF new.idcompra> (SELECT MAX(idcompra) FROM compra) THEN insert into compra values ("",0,0,now(),"La Favorita","Empresa S.A de C.V"); END IF; end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nueva_compra` BEFORE INSERT ON `detallecompra` FOR EACH ROW begin insert into Compra SELECT * FROM (SELECT new.idcompra, new.CantidadProd, new.TotalCompra, now(), curtime(),"La Favorita","Empresa S.A de C.V") AS tmp WHERE  NOT EXISTS (SELECT idcompra from compra WHERE idcompra = new.idcompra) LIMIT 1; end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `idDetalleVenta` int(5) NOT NULL,
  `idProducto` int(5) DEFAULT NULL,
  `CantidadProductos` int(4) DEFAULT NULL,
  `PrecioVenta` decimal(7,2) DEFAULT NULL,
  `Total` decimal(7,2) DEFAULT NULL,
  `idVenta` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`idDetalleVenta`, `idProducto`, `CantidadProductos`, `PrecioVenta`, `Total`, `idVenta`) VALUES
(1, 1, 5, '1500.00', '7500.00', 1),
(2, 2, 10, '360.00', '3600.00', 5),
(4, 2, 5, '360.00', '1800.00', 7),
(5, 1, 3, '1500.00', '4500.00', 8),
(6, 1, 2, '1500.00', '3000.00', 9),
(7, 2, 5, '360.00', '1800.00', 10),
(8, 2, 5, '360.00', '1800.00', 11),
(9, 1, 4, '1500.00', '6000.00', 12),
(10, 1, 1, '1500.00', '1500.00', 13),
(11, 5, 2, '530.00', '1060.00', 14),
(12, 5, 1, '530.00', '530.00', 14),
(13, 4, 5, '350.00', '1750.00', 16);

--
-- Disparadores `detalleventa`
--
DELIMITER $$
CREATE TRIGGER `actTotal` BEFORE INSERT ON `detalleventa` FOR EACH ROW set new.Total = new.CantidadProductos * new.PrecioVenta
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nueva_venta` BEFORE INSERT ON `detalleventa` FOR EACH ROW begin insert into Ventas SELECT * FROM (SELECT new.idVenta, new.CantidadProductos, new.Total, now(), curtime(),"La Favorita","Leslie") AS tmp WHERE  NOT EXISTS (SELECT idVenta from Ventas WHERE idVenta = new.idVenta) LIMIT 1; end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `resprod` BEFORE INSERT ON `detalleventa` FOR EACH ROW update producto set Cantidad = Cantidad - new.CantidadProductos where idproducto
= new.idproducto
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(5) NOT NULL,
  `NomProducto` varchar(30) DEFAULT NULL,
  `Categoria` varchar(20) DEFAULT NULL,
  `Talla` varchar(20) DEFAULT NULL,
  `Marca` varchar(20) DEFAULT NULL,
  `Precio` decimal(7,2) DEFAULT NULL,
  `Cantidad` int(4) DEFAULT NULL,
  `Color` varchar(15) DEFAULT NULL,
  `Material` varchar(30) DEFAULT NULL,
  `Temporada` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `NomProducto`, `Categoria`, `Talla`, `Marca`, `Precio`, `Cantidad`, `Color`, `Material`, `Temporada`) VALUES
(1, 'Sueter', 'Mujer', 'Chica', 'Calvin Klein', '1500.00', 230, 'Azul', 'Algodon', 'Primavera'),
(2, 'Playera', 'Hombre', 'Mediana', 'H&M', '360.00', 355, 'Negra', 'Algodon', 'Primavera'),
(3, 'Blusa', 'Mujer', 'Chica', 'Levis', '150.00', 100, 'Rosa', 'Algodon', 'Verano'),
(4, 'Pantalon', 'Hombre', 'Grande', 'Nike', '350.00', 30, 'Azul', 'Mezclilla', 'Oto?o'),
(5, 'Sudadera', 'Mujer', 'Chica', 'Nike', '530.00', 50, 'Gris', 'Algodon', 'Invierno'),
(6, 'Camisa', 'Mujer', 'Grande', 'Adidas', '150.00', 50, 'Rosa', 'Algodon', 'Primavera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(5) NOT NULL,
  `TotalProductos` int(4) DEFAULT NULL,
  `MontoTotal` decimal(7,2) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Sucursal` varchar(30) DEFAULT NULL,
  `Vendedor` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Error leyendo datos de la tabla punto_de_venta.ventas: #1064 - Algo está equivocado en su sintax cerca 'FROM `punto_de_venta`.`ventas`' en la linea 1

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idCompra`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`idDetalleCompra`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idCompra` (`idCompra`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`idDetalleVenta`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idVenta` (`idVenta`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idCompra` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `idDetalleCompra` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  MODIFY `idDetalleVenta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `detallecompra_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `detallecompra_ibfk_2` FOREIGN KEY (`idCompra`) REFERENCES `compra` (`idCompra`);

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `detalleventa_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `detalleventa_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`idVenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
