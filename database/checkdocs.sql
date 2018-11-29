-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2018 a las 17:53:40
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `checkdocs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `idadministrador` int(11) NOT NULL,
  `nombre_completo` varchar(60) NOT NULL,
  `nombre_usuario` varchar(15) NOT NULL,
  `password_usuario` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT '0',
  `intentos` tinyint(4) NOT NULL,
  `usuario_alta` varchar(15) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `usuario_modificacion` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idadministrador`, `nombre_completo`, `nombre_usuario`, `password_usuario`, `email`, `condicion`, `intentos`, `usuario_alta`, `fecha_alta`, `fecha_modificacion`, `usuario_modificacion`) VALUES
(1, 'RAUL MARTINEZ GONZALEZ', 'RMARTINEZ', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'raul.mtzglez@gmail.com', 1, 0, 'SISTEMA', '2018-11-21 18:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscriptores`
--

CREATE TABLE `suscriptores` (
  `idsuscriptor` int(11) NOT NULL,
  `nombre_empresa` varchar(256) NOT NULL,
  `rfc` varchar(30) NOT NULL,
  `cantidad_admin` int(11) NOT NULL,
  `limite_usuarios` int(11) NOT NULL,
  `direccion` text,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `capacidad_almacenamiento` varchar(250) NOT NULL,
  `carpeta` varchar(45) NOT NULL,
  `encabezado` text,
  `descripcion` text,
  `logo` text,
  `condicion` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_alta` datetime NOT NULL,
  `usuario_alta` varchar(15) NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `usuario_modificacion` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `suscriptores`
--

INSERT INTO `suscriptores` (`idsuscriptor`, `nombre_empresa`, `rfc`, `cantidad_admin`, `limite_usuarios`, `direccion`, `codigo_postal`, `telefono`, `capacidad_almacenamiento`, `carpeta`, `encabezado`, `descripcion`, `logo`, `condicion`, `fecha_alta`, `usuario_alta`, `fecha_modificacion`, `usuario_modificacion`) VALUES
(1, 'SACSI WEB', 'ABCDE', 5, 5, NULL, NULL, '2721289117', '300', 'sacsi', 'SISTEMA DE GESTIÓN DE CALIDAD EN LA EMPRESA', 'ESTE SITIO INCLUYE TODA LA DOCUMENTACIÓN NECESARIA PARA EL SISTEMA DE GESTIÓN DE CALIDAD', 'logo_sacsi.jpg', 1, '2018-11-08 05:06:00', 'SISTEMA', '2018-11-20 05:37:00', 'SISTEMA'),
(5, 'YO LO HAGO SA DE CV', 'YOLO123', 2, 2, NULL, NULL, '2721279118', '100', 'yolohago', NULL, NULL, 'views/img/yolohago/logo_yolohago.jpg', 1, '2018-11-29 17:25:00', 'SISTEMA', NULL, NULL),
(6, 'MR SITE', 'MRSITE', 3, 3, NULL, NULL, '22299', '200', 'mrsite', NULL, NULL, 'views/img/mrsite/logo_mrsite.png', 1, '2018-11-29 17:49:00', 'SISTEMA', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_suscriptores`
--

CREATE TABLE `usuarios_suscriptores` (
  `idusuario_suscriptor` int(11) NOT NULL,
  `nombre_completo` varchar(60) NOT NULL,
  `nombre_usuario` varchar(15) DEFAULT NULL,
  `password_usuario` varchar(256) NOT NULL,
  `perfil` int(11) NOT NULL COMMENT '1:SuperAdministrador\n2:Adiministrador\n3:Editor\n4:Consultor',
  `email` varchar(100) NOT NULL,
  `foto` text,
  `intentos` tinyint(4) NOT NULL DEFAULT '0',
  `condicion` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_alta` datetime NOT NULL,
  `usuario_alta` varchar(15) NOT NULL,
  `usuario_modificacion` datetime DEFAULT NULL,
  `fecha_modificacion` varchar(15) DEFAULT NULL,
  `idsuscriptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_suscriptores`
--

INSERT INTO `usuarios_suscriptores` (`idusuario_suscriptor`, `nombre_completo`, `nombre_usuario`, `password_usuario`, `perfil`, `email`, `foto`, `intentos`, `condicion`, `fecha_alta`, `usuario_alta`, `usuario_modificacion`, `fecha_modificacion`, `idsuscriptor`) VALUES
(3, 'RAUL MARTINEZ GONZALEZ', NULL, '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 1, 'raul.martinez@sacsi.com.mx', NULL, 0, 1, '2018-11-11 04:48:00', 'SISTEMA', NULL, NULL, 1),
(6, 'JEZIEL MARTINEZ', NULL, 'd3ad9315b7be5dd53b31a273b3b3aba5defe700808305aa16a3062b76658a791', 1, 'jd@mail.com', NULL, 0, 1, '2018-11-29 17:27:00', 'SISTEMA', NULL, NULL, 5),
(7, 'DAVID', NULL, '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 1, 'david@mrsite.com', NULL, 0, 1, '2018-11-29 17:50:00', 'SISTEMA', NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vwacceso`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vwacceso` (
`idsuscriptor` int(11)
,`nombre_empresa` varchar(256)
,`rfc` varchar(30)
,`limite_usuarios` int(11)
,`carpeta` varchar(45)
,`capacidad_almacenamiento` varchar(250)
,`condicion_suscriptor` tinyint(4)
,`idusuario_suscriptor` int(11)
,`nombre_completo` varchar(60)
,`nombre_usuario` varchar(15)
,`perfil` int(11)
,`email` varchar(100)
,`password_usuario` varchar(256)
,`intentos` tinyint(4)
,`condicion_usuario` tinyint(4)
,`foto` text
,`descripcion` text
,`logo` text
,`encabezado` text
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vwacceso`
--
DROP TABLE IF EXISTS `vwacceso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwacceso`  AS  select `s`.`idsuscriptor` AS `idsuscriptor`,`s`.`nombre_empresa` AS `nombre_empresa`,`s`.`rfc` AS `rfc`,`s`.`limite_usuarios` AS `limite_usuarios`,`s`.`carpeta` AS `carpeta`,`s`.`capacidad_almacenamiento` AS `capacidad_almacenamiento`,`s`.`condicion` AS `condicion_suscriptor`,`u`.`idusuario_suscriptor` AS `idusuario_suscriptor`,`u`.`nombre_completo` AS `nombre_completo`,`u`.`nombre_usuario` AS `nombre_usuario`,`u`.`perfil` AS `perfil`,`u`.`email` AS `email`,`u`.`password_usuario` AS `password_usuario`,`u`.`intentos` AS `intentos`,`u`.`condicion` AS `condicion_usuario`,`u`.`foto` AS `foto`,`s`.`descripcion` AS `descripcion`,`s`.`logo` AS `logo`,`s`.`encabezado` AS `encabezado` from (`suscriptores` `s` join `usuarios_suscriptores` `u` on((`s`.`idsuscriptor` = `u`.`idsuscriptor`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idadministrador`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  ADD PRIMARY KEY (`idsuscriptor`),
  ADD UNIQUE KEY `tax_id_number_UNIQUE` (`rfc`);

--
-- Indices de la tabla `usuarios_suscriptores`
--
ALTER TABLE `usuarios_suscriptores`
  ADD PRIMARY KEY (`idusuario_suscriptor`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_usuarios_suscriptores_suscriptores_idx` (`idsuscriptor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `idadministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  MODIFY `idsuscriptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios_suscriptores`
--
ALTER TABLE `usuarios_suscriptores`
  MODIFY `idusuario_suscriptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_suscriptores`
--
ALTER TABLE `usuarios_suscriptores`
  ADD CONSTRAINT `fk_usuarios_suscriptores_suscriptores` FOREIGN KEY (`idsuscriptor`) REFERENCES `suscriptores` (`idsuscriptor`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
