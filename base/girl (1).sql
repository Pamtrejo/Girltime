-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2019 a las 07:09:26
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `girl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imagen_categoria` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_categoria` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `imagen_categoria`, `descripcion_categoria`) VALUES
(1, 'Cremas', '5d152b1b454c6.png', 'Cremas faciales para todo tipo de piel.'),
(2, 'Jabones', '5d1cc4d9b08fe.jpg', 'Jabones para todo tipo de piel'),
(3, 'Mascarillas', '5d1cc8886fc8d.jpg', 'Mascarillas para una piel mejor'),
(5, 'Maquillaje', '5d1cee8dd6d5a.jpg', 'Maquillaje de productos naturales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nombres_cliente` varchar(50) NOT NULL,
  `apellidos_cliente` varchar(50) NOT NULL,
  `correo_cliente` varchar(100) NOT NULL,
  `clave_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombres_cliente`, `apellidos_cliente`, `correo_cliente`, `clave_cliente`) VALUES
(1, 'Pamela', 'Trejo', 'panayely@gmail.com', 123),
(2, 'Fernanda', 'Avendano', 'fer@gmail.com', 123),
(3, 'Daniel', 'Aguilar', 'dani@gmail.com', 321),
(4, 'Esmeralda', 'Ramirez', 'esme@gmail.com', 456),
(5, 'Kevin', 'Lemus', 'agreda@gmail.com', 741);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_usuario` int(11) UNSIGNED DEFAULT NULL,
  `venta_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `id_venta`, `id_producto`, `cantidad`, `id_usuario`, `venta_total`) VALUES
(1, 1, 2, 12, 1, 100),
(2, 2, 12, 2, 1, 8),
(3, 2, 8, 100, 1, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(10) UNSIGNED NOT NULL,
  `marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `marca`) VALUES
(1, 'Kiki'),
(2, 'Hydraus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predetalle`
--

CREATE TABLE `predetalle` (
  `id_predetalle` int(11) NOT NULL,
  `id_cliente` int(11) UNSIGNED NOT NULL,
  `id_producto` int(11) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) UNSIGNED NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_producto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `precio_producto` decimal(5,2) NOT NULL DEFAULT '0.00',
  `imagen_producto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado_producto` tinyint(1) NOT NULL DEFAULT '1',
  `id_categoria` int(11) UNSIGNED NOT NULL,
  `id_marca` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion_producto`, `precio_producto`, `imagen_producto`, `estado_producto`, `id_categoria`, `id_marca`) VALUES
(2, 'Pure Hydra', 'Crema para hidratar el rostro el uso es solo por la noche', '8.75', '5d1cd78f9d674.jpg', 1, 1, 1),
(3, 'Resgenerist', 'Crema restauradora de uso nocturno', '10.99', '5d1cd7fa07fac.jpg', 1, 1, 1),
(4, 'Collistar', 'Para hidratar el rostro y colageno', '15.99', '5d1ce16c0327d.jpg', 1, 1, 1),
(5, 'Cocolin', 'Jabon con coco y ambar', '5.00', '5d1ce21463acc.png', 1, 2, 1),
(6, 'Lavanda', 'Jabon con lavanda y aceite de coco', '5.50', '5d1ce2586a3db.png', 1, 2, 2),
(7, 'Meliss', 'Jabon marmolado con limon y glicerina', '8.00', '5d1ce303d999f.jpg', 1, 2, 2),
(8, 'Coco detox', 'mascarilla con limpiador de forma profunda detox', '4.60', '5d1ce3e74f389.jpg', 1, 3, 2),
(9, 'Exfoli for', 'Mascarrilla con efecto exfoliante', '10.00', '5d1ce4574916f.jpg', 1, 3, 2),
(10, 'Rose clay', 'Mascarilla con arcilla para una piel mas suave y saludable', '12.99', '5d1ce4a92ad48.jpg', 1, 3, 2),
(12, 'Siki', 'Labial rojo vegano con aceite  seda marruecos', '10.99', '5d1e3e8183240.jpg', 1, 5, 1),
(13, 'Ge up', 'Lapiz labial frida vegano', '5.69', '5d1e511ddb97a.jpg', 1, 5, 1),
(14, '1P Aloe Vera', 'Pinta labios con aceite de aloe vera', '2.99', '5d1e516295452.jpg', 1, 5, 1),
(15, 'Xamania', 'Rubor Vegano', '8.00', '5d1e51ac68982.jpg', 1, 5, 1),
(16, 'Vegalash', 'Mascara de pestañas sensitive negro', '15.50', '5d1e522a759fa.jpg', 1, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `nombres_usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos_usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `correo_usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias_usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clave_usuario` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres_usuario`, `apellidos_usuario`, `correo_usuario`, `alias_usuario`, `clave_usuario`) VALUES
(1, 'Pamela', 'Trejo', 'panayelyaguilar@gmail.com', 'Pam', '$2y$10$VI23L7lPxAaCp3KEZINNj.QtlOmL9F5573ymmGb2qWdV0UFnmvape'),
(2, 'Fernanda', 'Avendaño', 'fer.avendano@gmail.com', 'Fer', '$2y$10$vtxzSyUgTsmsVEe6k8wdgeG2D212zMn4NWh3KsMmiNYeHyjkLsPWm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) UNSIGNED DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_cliente`, `fecha`, `id_usuario`) VALUES
(1, 2, '2019-07-09 11:16:59', 1),
(2, 4, '2019-07-02 05:12:17', 1),
(3, 4, '2019-07-01 06:16:16', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `predetalle`
--
ALTER TABLE `predetalle`
  ADD PRIMARY KEY (`id_predetalle`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `nombre_producto` (`nombre_producto`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `alias` (`alias_usuario`),
  ADD UNIQUE KEY `correo` (`correo_usuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `predetalle`
--
ALTER TABLE `predetalle`
  MODIFY `id_predetalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`),
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `predetalle`
--
ALTER TABLE `predetalle`
  ADD CONSTRAINT `predetalle_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `predetalle_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
