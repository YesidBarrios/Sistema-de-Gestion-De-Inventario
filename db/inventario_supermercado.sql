-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2024 a las 18:36:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_supermercado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre_tienda` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre_tienda`, `direccion`, `telefono`, `email`) VALUES
(1, 'Supermercado La Central', 'Calle Principal', '3006703456', 'contacto@supermercadolacentral.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `stock_minimo` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `fecha_creacion`, `stock_minimo`) VALUES
(1, 'Arroz', '1lb', 2000.00, 100, '2024-10-22 17:26:08', 10),
(3, 'Azucar', '1kg', 4000.00, 100, '2024-10-22 18:07:08', 10),
(4, 'Carne de res', '1kg', 25000.00, 20, '2024-10-22 18:08:30', 10),
(5, 'Pollo', '1kg', 13000.00, 20, '2024-10-22 18:09:00', 10),
(6, 'Sal', '1lb', 1000.00, 100, '2024-10-22 18:09:48', 10),
(7, 'Harina de Maiz ', '400gr', 2500.00, 100, '2024-10-22 18:11:09', 10),
(8, 'Buen Sabor', '1 Caja ', 2500.00, 20, '2024-10-22 18:11:50', 10),
(9, 'Platano', '1 Unidad', 1200.00, 30, '2024-10-22 18:12:46', 10),
(10, 'Salchichón', '1 Unidad', 7000.00, 30, '2024-10-22 18:13:54', 10),
(11, 'Papa', '1lb', 1000.00, 20, '2024-11-12 18:42:48', 10),
(12, 'Atún En Lata ', '120gr', 3000.00, 50, '2024-11-12 18:59:47', 10),
(13, 'Jabon', '1 Barra', 2500.00, 30, '2024-11-13 01:38:50', 10),
(14, 'Leche', '1lt', 3000.00, 20, '2024-11-13 01:47:41', 10),
(15, 'Yogurt', '1lt', 5000.00, 30, '2024-11-13 01:49:24', 10),
(16, 'Café', '1lb', 12000.00, 30, '2024-11-13 01:51:04', 10),
(17, 'Queso', '1kg', 17000.00, 20, '2024-11-13 01:52:52', 10),
(18, 'Avena', '500gr', 2500.00, 40, '2024-11-13 01:53:55', 10),
(19, 'Harina de Trigo', '500gr', 2000.00, 30, '2024-11-13 01:54:37', 10),
(20, 'Salsa de Tomate', '120gr', 1500.00, 20, '2024-11-13 01:56:33', 10),
(21, 'Arroz', '1 paca (25lb)', 50000.00, 30, '2024-11-13 01:58:01', 10),
(22, 'Cloro', '1lt', 2000.00, 30, '2024-11-13 01:58:49', 10),
(23, 'Mayonesa', '120gr', 1500.00, 30, '2024-11-13 01:59:24', 10),
(24, 'Mostaza', '120gr', 1500.00, 30, '2024-11-13 01:59:52', 10),
(25, 'Detergente en Polvo', '500gr', 6000.00, 30, '2024-11-13 02:00:43', 10),
(26, 'Papel Higiénico', '1 rollo', 3000.00, 30, '2024-11-13 02:01:28', 10),
(27, 'Pasta Dental', '100gr', 4500.00, 30, '2024-11-13 02:02:02', 10),
(28, 'Champú', '500ml', 8000.00, 30, '2024-11-13 02:04:35', 10),
(29, 'Pasta', '125gr', 1000.00, 100, '2024-11-13 02:05:46', 10),
(30, 'Mantequilla', '250gr', 3000.00, 30, '2024-11-13 02:06:41', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$SBhRlR5R45f7Rwx.qDgznuB5Gl9Pj.FdhDhrro4AeGpz1DSLMhxyi', '2024-10-21 18:24:49');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_stock_total`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_stock_total` (
`stock_total` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_stock_total`
--
DROP TABLE IF EXISTS `vista_stock_total`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_stock_total`  AS SELECT sum(`productos`.`stock`) AS `stock_total` FROM `productos` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
