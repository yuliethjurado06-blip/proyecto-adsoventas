-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 00:11:33
-- Versión del servidor: 8.4.0
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
USE norliajeff;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `norliajeff`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID` int NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `UsuarioID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID`, `Nombre`, `Apellido`, `Correo`, `Direccion`, `Telefono`, `UsuarioID`) VALUES
(1, 'Cristhian', 'Moreno', 'hb@gm.com', 'hvh', '11', 1),
(2, 'Juan', 'Moreno', 'dsd@dsd.com', '444', 'dsds', 1),
(4, 'jorman', 'ferrerira', 'dd@dd.com', 'dd', 'dd', 1),
(5, '1', '1', '1@gmail.com', '1', '1', 2),
(6, 'Jose', 'Romero', 'rr@rr.com', '232', '322', 1),
(7, 'Romero', 'Antonio', '5@5.com', '44', '23', 1),
(8, 'Valeria', 'Rodriguez', 'VA@gmail.com', '1', '1', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Cantidad` int DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `ProductoID` int DEFAULT NULL,
  `UsuarioID` int DEFAULT NULL,
  `ProveedorID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`ID`, `Fecha`, `Total`, `Cantidad`, `Precio`, `ProductoID`, `UsuarioID`, `ProveedorID`) VALUES
(6, '2024-09-03', 246024.00, 4556, 54.00, 1, 1, 1),
(11, '2024-09-20', 100000.00, 20, 5000.00, 3, 1, 1),
(12, '2024-09-13', 25.00, 5, 5.00, 1, 1, 1),
(13, '2024-09-13', 2420.00, 55, 44.00, 3, 1, 1),
(14, '2024-09-13', 44.00, 2, 22.00, 1, 1, 1),
(15, '2024-09-06', 12.00, 4, 3.00, 3, 1, 1),
(18, '2024-09-23', 50000.00, 20, 2500.00, 7, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Stock` int DEFAULT NULL,
  `UsuarioID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `Nombre`, `Descripcion`, `Precio`, `Stock`, `UsuarioID`) VALUES
(1, 'Coca Cola', 'Gaseosa', 7500.00, 20, 1),
(2, '1', '1', 1.00, 1, 2),
(3, 'Doritos', 'Papitas', 2500.00, 10, 1),
(4, 'Mani', 'Fruto seco', 5000.00, 2, 1),
(5, 'Maletin', 'Bolso', 50000.00, 5, 1),
(6, 'Doritos', 'Papitas', 5000.00, 10, 4),
(7, 'Coca cola', 'Refresco', 2500.00, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID` int NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `UsuarioID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`ID`, `Nombre`, `Direccion`, `Telefono`, `UsuarioID`) VALUES
(1, 'Rogelio', 'Santander', '311', 1),
(2, '1', '1', '1', 2),
(4, 'Shaggy', '555', '222', 1),
(5, 'Rogelio', 'Santa', '1', 4),
(6, '11', '44', '11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Contrasena` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `Nombre`, `Apellido`, `Email`, `Contrasena`) VALUES
(1, 'cristhian', 'moreno', 'cristhian@gmail.com', '$2y$10$4OPLKTgvhyzFeniKrGJgi.xpa0fhB6PggjN5v.0GtVKQu2uNVv2ZG'),
(2, 'Juan', 'Felipe', 'cristhian1@gmail.com', '$2y$10$nhwEUdBdHDZTi4s2hpZWOuof6zp5EfGLsK5yDZLvv6WCpm7Q/Vz.K'),
(3, 'Jose', 'Rodriguez', '\'@gmail.com', '$2y$10$V.2wBaiC8EADoA7QOFkrwuiPyorxDvK1IIm.zxRwSR99pWphQEomW'),
(4, 'Jose', 'Romero', 'Jose@gmail.com', '$2y$10$F.6AdzrnE4q7aznVeT2uvOu/2wkKXaBhJb8rhWQxtGYH.yDcFI.62');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID` int NOT NULL,
  `Fecha` date DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Cantidad` int DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `ProductoID` int DEFAULT NULL,
  `UsuarioID` int DEFAULT NULL,
  `ClienteID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID`, `Fecha`, `Total`, `Cantidad`, `Precio`, `ProductoID`, `UsuarioID`, `ClienteID`) VALUES
(7, '2024-09-18', 726.00, 22, 33.00, 3, 1, 4),
(8, '2024-09-10', 25000.00, 5, 5000.00, 6, 4, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProductoID` (`ProductoID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `ProveedorID` (`ProveedorID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProductoID` (`ProductoID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `ClienteID` (`ClienteID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `productos` (`ID`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`ProveedorID`) REFERENCES `proveedor` (`ID`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `productos` (`ID`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`UsuarioID`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`ClienteID`) REFERENCES `cliente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
