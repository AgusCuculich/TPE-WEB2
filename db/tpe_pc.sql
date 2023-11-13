-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2023 a las 19:16:04
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpe_pc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `gama` varchar(40) NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `gama`, `descripcion`) VALUES
(1, 'alta', 'Descripcion gama alta'),
(2, 'media', 'Descripcion gama media'),
(3, 'baja', 'Descripcion gama baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pc`
--

CREATE TABLE `pc` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `procesador` varchar(100) NOT NULL,
  `grafica` varchar(100) NOT NULL,
  `mother` varchar(100) NOT NULL,
  `disco` varchar(100) NOT NULL,
  `ram` int(11) NOT NULL,
  `imagen` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pc`
--

INSERT INTO `pc` (`id`, `id_categoria`, `nombre`, `procesador`, `grafica`, `mother`, `disco`, `ram`, `imagen`) VALUES
(1, 1, 'Aqua Aurora', 'AMD RYZEN 9 5900X', 'Nvidia RTX 3060 12GB', 'ASUS PRIME X570', 'SDD 2TB', 32, 'https://res.cloudinary.com/jawa/image/upload/f_auto,ar_1:1,c_fill,w_3840,q_auto/production/listings/p3buijgwhvwiyp53k6ep'),
(2, 2, 'Quantum Force', 'AMD Ryzen 5 3400G', 'NVIDIA GeForce GTX 1650 Super', 'Asus prime A320M-K', 'SSD 500 GB', 16, 'https://m.media-amazon.com/images/I/71CBtGIXRxL.jpg'),
(3, 3, 'Neon Nova', 'AMD Ryzen 3 3200G', 'Vega 8 Graphics', 'Micro ATX B450', 'SSD 500 GB', 8, 'https://a-static.mlcdn.com.br/1500x1500/pc-gamer-pichau-rawson-ryzen-3-3200g-memoria-8gb-ddr4-ssd-120gb-400w-gabinete-hunter-rgb/pichauinfo/pichau-mkt-12830/3ae7f499f2aec9f6695945a386ef3624.jpg'),
(4, 3, 'Avalanche Aegis', 'Intel Pentium Gold G', 'UHD Graphics 630', 'Micro ATX H410', 'SSD 500 GB', 4, 'https://dcdn.mitiendanube.com/stores/001/329/803/products/gabinete-cooler-master-masterbox-q300l-filtros-magneticos-fullstock-011-9df83bf5ee815cbb2b16147937560564-640-0.jpg'),
(5, 3, 'Nova Nexus', 'Intel Core i3-10100', 'UHD Graphics 630', 'Micro ATX H410', 'HDD 1 TB', 8, 'https://setupsparastreamers.files.wordpress.com/2019/04/71rbnuwrwl._sl1080_.jpg'),
(6, 3, 'Rogue Rocket', 'AMD Ryzen 5 3400G', 'Vega 11 Graphics', 'Micro ATX B450', 'SSD 250 GB', 16, 'https://resources.sears.com.mx/medios-plazavip/mkt/62b72b7948103_d_nq_np_2x_702507-mlm43852016084_102020-fpng.jpg?scale=500&qlty=75'),
(7, 2, 'Blazing Comet', 'AMD Ryzen 5 5600X', 'NVIDIA GeForce GTX 1650 Super', 'ATX B550', 'SSD 1TB', 16, 'https://tiendas.contapyme.com.ar/clientes/goodgames/archivos/images/1/image_4900.png'),
(8, 2, 'Frostbite Fusion', 'AMD Ryzen 5 5600X', 'NVIDIA Quadro P2200', 'ATX X570', 'SSD 1TB', 16, 'https://casatecno.com.ar/img/Public/1108-producto-ca-1x2-00m1wn-00-w01-619.jpg'),
(9, 2, 'Hyper Havoc', 'Intel Core i5-11600K', 'AMD Radeon RX 6700 XT', 'ATX Z590', 'SSD 1TB', 16, 'https://trulustore.cl/wp-content/uploads/2023/02/Pcblack3x.png'),
(10, 1, 'Cosmic Cascade', 'Intel Core i9-11900K', 'NVIDIA Quadro RTX 5000', 'ATX Z590', 'SSD 2TB', 64, 'https://store974.com/cdn/shop/products/Pink2-188377.jpg?v=1657771776'),
(11, 1, 'Firestorm Fury', 'AMD RYZEN 9 5900X', 'NVIDIA GeForce RTX 3090', 'ATX X570', 'SSD 2TB', 32, 'https://intercompras.com/images/product/XTREME_PC_GAMING_XTMSIR932GB54080W.jpg'),
(12, 1, 'Phoenix Phenom', 'Intel Core i9-12900K', 'NVIDIA Quadro GV100', 'ATX Z690', 'SSD 4TB', 64, 'https://falabella.scene7.com/is/image/Falabella/8062189_1?wid=800&hei=800&qlt=70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `rol` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `contraseña`, `rol`) VALUES
(1, 'webadmin', '$2y$10$KkaHZK4W2REGF8TCUVDa9eh1HVfI56S8g5ADrAJbQ.DeNsqbr4hsa', 'admin'),
(2, 'queso', '$2y$10$22yp9NreeEEZ7BhWO5CPqOegUpT8imfNu4HcutaWJ.yh8oG6hF.FO', 'carpincho');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pc`
--
ALTER TABLE `pc`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
