-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2018 a las 06:45:45
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

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
-- Estructura de tabla para la tabla `accionesdocumentos`
--

CREATE TABLE `accionesdocumentos` (
  `idaccion` int(11) NOT NULL,
  `descripcionaccion` varchar(150) NOT NULL,
  `fechainicio` datetime NOT NULL,
  `fechafin` datetime NOT NULL,
  `estadoavance` varchar(45) NOT NULL,
  `usuarioalta` varchar(15) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `iddocumento` int(11) NOT NULL,
  `idusuarioalta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `autorizadoresxdocumento`
--

CREATE TABLE `autorizadoresxdocumento` (
  `orden` tinyint(4) NOT NULL,
  `idruta` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autorizadoresxproceso`
--

CREATE TABLE `autorizadoresxproceso` (
  `orden` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idruta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avanceaccion`
--

CREATE TABLE `avanceaccion` (
  `enviado` tinyint(4) NOT NULL COMMENT '0 = No\n1 = Si',
  `autorizado` tinyint(4) NOT NULL COMMENT '0 = No\n1 = Si',
  `orden` tinyint(4) NOT NULL,
  `idaccion` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `iddocumento` int(11) NOT NULL,
  `nombredocumento` text NOT NULL,
  `estado` varchar(45) NOT NULL,
  `version` varchar(10) NOT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Inactivo\n1 = Activo\n3 = Papelera',
  `usuarioresponsable` varchar(15) NOT NULL,
  `conruta` tinyint(4) NOT NULL COMMENT '0 = ruta por proceso\n1 = ruta por documento',
  `usuarioalta` varchar(15) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `usuariomodificacion` varchar(15) DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `restaurado` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = No\n1 = Si',
  `usuariorestauracion` varchar(15) DEFAULT NULL,
  `fecharestauracion` datetime DEFAULT NULL,
  `enpapelera` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = No\n1 = Si',
  `idusuarioresponsable` int(11) NOT NULL,
  `idsubproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historicodocumentos`
--

CREATE TABLE `historicodocumentos` (
  `idhistorico` int(11) NOT NULL,
  `nombredocumento` int(11) NOT NULL,
  `version` varchar(45) NOT NULL,
  `fechasalida` datetime NOT NULL,
  `iddocumento` int(11) NOT NULL,
  `idaccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papelera`
--

CREATE TABLE `papelera` (
  `idpapelera` int(11) NOT NULL,
  `usuarioenvio` varchar(15) NOT NULL,
  `fechaenvio` datetime NOT NULL,
  `iddocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `idproceso` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `consubprocesos` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 No\n1 Si\n',
  `publicar` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 Si\n0 No',
  `condicion` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 Baja\n1 Activo',
  `identificadorproceso` varchar(45) NOT NULL,
  `usuarioalta` varchar(15) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `usuariomodificacion` varchar(15) DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `ultimapublicacion` datetime DEFAULT NULL,
  `usuariopublica` varchar(15) DEFAULT NULL,
  `idsuscriptor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`idproceso`, `descripcion`, `consubprocesos`, `publicar`, `condicion`, `identificadorproceso`, `usuarioalta`, `fechaalta`, `usuariomodificacion`, `fechamodificacion`, `ultimapublicacion`, `usuariopublica`, `idsuscriptor`) VALUES
(1, 'SISTEMAS', 1, 0, 1, '5c25b1364265d', 'RMARTINEZ', '2018-12-28 06:14:00', 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, 1),
(2, 'ADMIN', 1, 0, 1, '5c25b149bff89', 'RMARTINEZ', '2018-12-28 06:14:00', 'RMARTINEZ', '2018-12-28 06:37:00', '2018-12-28 06:37:00', 'RMARTINEZ', 1),
(3, 'MANTTO', 1, 0, 1, '5c25b167b70c4', 'RMARTINEZ', '2018-12-28 06:15:00', 'RMARTINEZ', '2018-12-28 06:17:00', NULL, NULL, 1),
(4, 'OPER', 1, 0, 1, '5c25b18ec9ac4', 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 1),
(5, 'BASCULA', 1, 0, 1, '5c25b1cf24058', 'RMARTINEZ', '2018-12-28 06:17:00', 'RMARTINEZ', '2018-12-28 06:37:00', '2018-12-28 06:37:00', 'RMARTINEZ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutaxdocumento`
--

CREATE TABLE `rutaxdocumento` (
  `idruta` int(11) NOT NULL,
  `usuarioalta` varchar(15) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `usuariomodificacion` varchar(15) DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `iddocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutaxsubproceso`
--

CREATE TABLE `rutaxsubproceso` (
  `idruta` int(11) NOT NULL,
  `usuarioalta` varchar(15) DEFAULT NULL,
  `fechaalta` datetime DEFAULT NULL,
  `usuariomodificacion` varchar(15) DEFAULT NULL,
  `idsubproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subprocesos`
--

CREATE TABLE `subprocesos` (
  `idsubproceso` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 Baja\n1 Activo\n2 Eliminar',
  `consecutivo` int(11) NOT NULL,
  `identificadorsubproceso` varchar(45) NOT NULL,
  `archivocreado` tinyint(4) NOT NULL DEFAULT '0',
  `usuarioalta` varchar(15) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `usuariomodificacion` varchar(15) DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `fechaeliminacion` datetime DEFAULT NULL,
  `usuarioeliminacion` varchar(15) DEFAULT NULL,
  `idproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subprocesos`
--

INSERT INTO `subprocesos` (`idsubproceso`, `descripcion`, `condicion`, `consecutivo`, `identificadorsubproceso`, `archivocreado`, `usuarioalta`, `fechaalta`, `usuariomodificacion`, `fechamodificacion`, `fechaeliminacion`, `usuarioeliminacion`, `idproceso`) VALUES
(1, 'SISTEMAS', 1, 0, '5c25b1367e1a7', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 1),
(2, 'A', 1, 1, '5c25b136c0edb', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 1),
(3, 'B', 1, 2, '5c25b136f3f88', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 1),
(4, 'C', 1, 3, '5c25b13768d39', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 1),
(5, 'ADMIN', 1, 0, '5c25b14a0a9f1', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 2),
(6, 'ADM1', 1, 1, '5c25b14a91e97', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 2),
(7, 'ADM2', 1, 2, '5c25b14ab8705', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 2),
(8, 'ADM3', 1, 3, '5c25b14ad98d9', 1, 'RMARTINEZ', '2018-12-28 06:14:00', NULL, NULL, NULL, NULL, 2),
(9, 'D', 1, 4, '5c25b158f4146', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 1),
(10, 'MANTTO', 1, 0, '5c25b167f40df', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 3),
(11, 'A', 1, 1, '5c25b168634e5', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 3),
(12, 'B', 1, 2, '5c25b168c401a', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 3),
(13, 'C', 1, 3, '5c25b1789e495', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 3),
(14, 'OPER', 1, 0, '5c25b18f121e2', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 4),
(15, 'OP1', 1, 1, '5c25b18f80525', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 4),
(16, 'OP2', 1, 2, '5c25b18fee3a0', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 4),
(17, 'OP3', 1, 3, '5c25b19026864', 1, 'RMARTINEZ', '2018-12-28 06:15:00', NULL, NULL, NULL, NULL, 4),
(18, 'ADM4', 2, 0, '5c25b19ebd427', 1, 'RMARTINEZ', '2018-12-28 06:16:00', 'RMARTINEZ', '2018-12-28 06:42:00', NULL, NULL, 2),
(19, 'BASCULA', 1, 0, '5c25b1cf4be8e', 1, 'RMARTINEZ', '2018-12-28 06:17:00', NULL, NULL, NULL, NULL, 5),
(20, 'B1', 1, 1, '5c25b1cfb4d16', 1, 'RMARTINEZ', '2018-12-28 06:17:00', NULL, NULL, NULL, NULL, 5),
(21, 'B2', 1, 2, '5c25b1d02404f', 1, 'RMARTINEZ', '2018-12-28 06:17:00', NULL, NULL, NULL, NULL, 5),
(22, 'D', 1, 4, '5c25b1dc1c11a', 1, 'RMARTINEZ', '2018-12-28 06:17:00', NULL, NULL, NULL, NULL, 3),
(23, 'B3', 1, 3, '5c25b1efcf707', 1, 'RMARTINEZ', '2018-12-28 06:17:00', NULL, NULL, NULL, NULL, 5);

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
(1, 'SACSI WEB', 'ABCDE', 5, 5, NULL, NULL, '2721289117', '300', 'sacsi', 'SISTEMA SACSI', 'AQUÍ ENCONTRARAS LA DOCUMENTACIÓN NECESARIA PARA EL SISTEMA DE GESTIÓN EN SACSI', 'views/img/sacsi/logo_sacsi.jpg', 1, '2018-11-08 05:06:00', 'SISTEMA', '2018-11-20 05:37:00', 'SISTEMA'),
(2, 'SERVICIOS DE INTEGRACION PARA PRODUCTOS BASICOS SA DE CV', 'SIPB123', 2, 2, NULL, NULL, '21752', '500', 'SIPB', NULL, NULL, NULL, 1, '2018-11-20 06:45:00', 'SISTEMA', NULL, NULL),
(3, 'CON PAGINA WEB SA DE CV', 'ABC123E', 5, 5, NULL, NULL, '2721289117', '300', 'PAGINAWEB', NULL, NULL, NULL, 1, '2018-11-22 06:37:00', 'SISTEMA', NULL, NULL),
(4, 'NETCAM SA DE CV', '646TRYUI', 5, 5, NULL, NULL, '2721289117', '500', 'netcam', NULL, NULL, NULL, 1, '2018-11-24 05:11:00', 'SISTEMA', NULL, NULL);

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
(3, 'RAUL MARTINEZ GONZALEZ', 'RMARTINEZ', '5b40171489659251097e7790fc2f1892e2183a72546fe1df283d07865db9149c', 1, 'raul.martinez@sacsi.com.mx', NULL, 0, 1, '2018-11-11 04:48:00', 'SISTEMA', NULL, NULL, 1),
(4, 'FERNANDO AMBROSIO', NULL, '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 1, 'fambrosio@correo.com', NULL, 0, 1, '2018-11-22 06:38:00', 'SISTEMA', NULL, NULL, 3),
(5, 'DAVID RODRIGUEZ', NULL, 'chk2wrs0', 1, 'david@mail.com', NULL, 0, 1, '2018-11-24 05:13:00', 'SISTEMA', NULL, NULL, 4);

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
-- Indices de la tabla `accionesdocumentos`
--
ALTER TABLE `accionesdocumentos`
  ADD PRIMARY KEY (`idaccion`),
  ADD UNIQUE KEY `idaccion_UNIQUE` (`idaccion`),
  ADD KEY `fk_acciones_documentos_documentos1_idx` (`iddocumento`),
  ADD KEY `fk_acciones_documentos_usuarios_suscriptores1_idx` (`idusuarioalta`);

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idadministrador`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `autorizadoresxdocumento`
--
ALTER TABLE `autorizadoresxdocumento`
  ADD KEY `fk_autorizadores_ruta_autorizacion1_idx` (`idruta`),
  ADD KEY `fk_autorizadores_usuarios_suscriptores1_idx` (`idusuario`);

--
-- Indices de la tabla `autorizadoresxproceso`
--
ALTER TABLE `autorizadoresxproceso`
  ADD KEY `fk_autorizadoresxproceso_usuarios_suscriptores1_idx` (`idusuario`),
  ADD KEY `fk_autorizadoresxproceso_rutaxsubproceso1_idx` (`idruta`);

--
-- Indices de la tabla `avanceaccion`
--
ALTER TABLE `avanceaccion`
  ADD KEY `fk_avanceaccion_accionesdocumentos1_idx` (`idaccion`),
  ADD KEY `fk_avanceaccion_usuarios_suscriptores1_idx` (`idusuario`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`iddocumento`),
  ADD KEY `fk_documentos_usuarios_suscriptores1_idx` (`idusuarioresponsable`),
  ADD KEY `fk_documentos_subprocesos1_idx` (`idsubproceso`);

--
-- Indices de la tabla `historicodocumentos`
--
ALTER TABLE `historicodocumentos`
  ADD PRIMARY KEY (`idhistorico`),
  ADD UNIQUE KEY `idhistorico_UNIQUE` (`idhistorico`),
  ADD KEY `fk_historicodocumentos_documentos1_idx` (`iddocumento`),
  ADD KEY `fk_historicodocumentos_accionesdocumentos1_idx` (`idaccion`);

--
-- Indices de la tabla `papelera`
--
ALTER TABLE `papelera`
  ADD PRIMARY KEY (`idpapelera`),
  ADD KEY `fk_papelera_documentos1_idx` (`iddocumento`);

--
-- Indices de la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`idproceso`),
  ADD UNIQUE KEY `identificadorproceso_UNIQUE` (`identificadorproceso`),
  ADD KEY `fk_procesos_suscriptores1_idx` (`idsuscriptor`);

--
-- Indices de la tabla `rutaxdocumento`
--
ALTER TABLE `rutaxdocumento`
  ADD PRIMARY KEY (`idruta`),
  ADD KEY `fk_rutapordocumento_documentos1_idx` (`iddocumento`);

--
-- Indices de la tabla `rutaxsubproceso`
--
ALTER TABLE `rutaxsubproceso`
  ADD PRIMARY KEY (`idruta`),
  ADD KEY `fk_rutaxsubproceso_subprocesos1_idx` (`idsubproceso`);

--
-- Indices de la tabla `subprocesos`
--
ALTER TABLE `subprocesos`
  ADD PRIMARY KEY (`idsubproceso`),
  ADD UNIQUE KEY `idenfiticadorsubproceso_UNIQUE` (`identificadorsubproceso`),
  ADD KEY `fk_subprocesos_procesos1_idx` (`idproceso`);

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
-- AUTO_INCREMENT de la tabla `accionesdocumentos`
--
ALTER TABLE `accionesdocumentos`
  MODIFY `idaccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `idadministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historicodocumentos`
--
ALTER TABLE `historicodocumentos`
  MODIFY `idhistorico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subprocesos`
--
ALTER TABLE `subprocesos`
  MODIFY `idsubproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `suscriptores`
--
ALTER TABLE `suscriptores`
  MODIFY `idsuscriptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios_suscriptores`
--
ALTER TABLE `usuarios_suscriptores`
  MODIFY `idusuario_suscriptor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accionesdocumentos`
--
ALTER TABLE `accionesdocumentos`
  ADD CONSTRAINT `fk_acciones_documentos_documentos1` FOREIGN KEY (`iddocumento`) REFERENCES `documentos` (`iddocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acciones_documentos_usuarios_suscriptores1` FOREIGN KEY (`idusuarioalta`) REFERENCES `usuarios_suscriptores` (`idusuario_suscriptor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `autorizadoresxdocumento`
--
ALTER TABLE `autorizadoresxdocumento`
  ADD CONSTRAINT `fk_autorizadores_ruta_autorizacion1` FOREIGN KEY (`idruta`) REFERENCES `rutaxdocumento` (`idruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_autorizadores_usuarios_suscriptores1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios_suscriptores` (`idusuario_suscriptor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `autorizadoresxproceso`
--
ALTER TABLE `autorizadoresxproceso`
  ADD CONSTRAINT `fk_autorizadoresxproceso_rutaxsubproceso1` FOREIGN KEY (`idruta`) REFERENCES `rutaxsubproceso` (`idruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_autorizadoresxproceso_usuarios_suscriptores1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios_suscriptores` (`idusuario_suscriptor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `avanceaccion`
--
ALTER TABLE `avanceaccion`
  ADD CONSTRAINT `fk_avanceaccion_accionesdocumentos1` FOREIGN KEY (`idaccion`) REFERENCES `accionesdocumentos` (`idaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avanceaccion_usuarios_suscriptores1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios_suscriptores` (`idusuario_suscriptor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_documentos_subprocesos1` FOREIGN KEY (`idsubproceso`) REFERENCES `subprocesos` (`idsubproceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentos_usuarios_suscriptores1` FOREIGN KEY (`idusuarioresponsable`) REFERENCES `usuarios_suscriptores` (`idusuario_suscriptor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historicodocumentos`
--
ALTER TABLE `historicodocumentos`
  ADD CONSTRAINT `fk_historicodocumentos_accionesdocumentos1` FOREIGN KEY (`idaccion`) REFERENCES `accionesdocumentos` (`idaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historicodocumentos_documentos1` FOREIGN KEY (`iddocumento`) REFERENCES `documentos` (`iddocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `papelera`
--
ALTER TABLE `papelera`
  ADD CONSTRAINT `fk_papelera_documentos1` FOREIGN KEY (`iddocumento`) REFERENCES `documentos` (`iddocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD CONSTRAINT `fk_procesos_suscriptores1` FOREIGN KEY (`idsuscriptor`) REFERENCES `suscriptores` (`idsuscriptor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rutaxdocumento`
--
ALTER TABLE `rutaxdocumento`
  ADD CONSTRAINT `fk_rutapordocumento_documentos1` FOREIGN KEY (`iddocumento`) REFERENCES `documentos` (`iddocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rutaxsubproceso`
--
ALTER TABLE `rutaxsubproceso`
  ADD CONSTRAINT `fk_rutaxsubproceso_subprocesos1` FOREIGN KEY (`idsubproceso`) REFERENCES `subprocesos` (`idsubproceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subprocesos`
--
ALTER TABLE `subprocesos`
  ADD CONSTRAINT `fk_subprocesos_procesos1` FOREIGN KEY (`idproceso`) REFERENCES `procesos` (`idproceso`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios_suscriptores`
--
ALTER TABLE `usuarios_suscriptores`
  ADD CONSTRAINT `fk_usuarios_suscriptores_suscriptores` FOREIGN KEY (`idsuscriptor`) REFERENCES `suscriptores` (`idsuscriptor`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
