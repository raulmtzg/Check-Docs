-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2020 a las 07:19:16
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
  `codigodocumento` varchar(20) NOT NULL,
  `nombredocumento` varchar(200) NOT NULL,
  `tipodocumento` varchar(200) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `version` varchar(10) NOT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 = Inactivo\n1 = Activo\n3 = Papelera',
  `usuarioresponsable` varchar(60) NOT NULL,
  `fechaultimarevision` date NOT NULL,
  `nombrearchivo` varchar(45) NOT NULL,
  `conruta` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = ruta por proceso\n1 = ruta por documento',
  `usuarioalta` varchar(15) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `usuariomodificacion` varchar(15) DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `restaurado` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = No\n1 = Si',
  `usuariorestauracion` varchar(15) DEFAULT NULL,
  `fecharestauracion` datetime DEFAULT NULL,
  `enpapelera` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = No\n1 = Si',
  `idusuarioresponsable` int(11) NOT NULL,
  `idsubproceso` int(11) NOT NULL,
  `idtipodocumento` int(11) NOT NULL,
  `idempresa` int(11) NOT NULL
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
  `idempresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempresas`
--

CREATE TABLE `tblempresas` (
  `idempresa` int(11) NOT NULL,
  `nombre_empresa` varchar(256) NOT NULL,
  `rfc` varchar(30) NOT NULL,
  `cantidad_admin` int(11) NOT NULL DEFAULT '1',
  `limite_usuarios` int(11) NOT NULL DEFAULT '1',
  `direccion` text,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `capacidad_almacenamiento` varchar(250) DEFAULT NULL,
  `nombre_corto_empresa` varchar(20) NOT NULL,
  `encabezado` text,
  `descripcion` text,
  `multi_empresa` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0. No\n1. Si',
  `logo` text,
  `condicion` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_alta` datetime NOT NULL,
  `usuario_alta` varchar(15) NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `usuario_modificacion` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempresas_has_usuarios`
--

CREATE TABLE `tblempresas_has_usuarios` (
  `idempresa` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuarios`
--

CREATE TABLE `tblusuarios` (
  `idusuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_usuario` varchar(256) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellido1` varchar(60) NOT NULL,
  `apellido2` varchar(60) DEFAULT NULL,
  `perfil` int(11) NOT NULL COMMENT '1.SuperAdministrador\n2.Adiministrador del Sistema\n3.Usuario Autorizador de Procesos\n4.Usuario Dueño de Proceso\n5.Usuario Consultor',
  `foto` text,
  `intentos` tinyint(4) NOT NULL DEFAULT '0',
  `condicion` tinyint(4) NOT NULL DEFAULT '1',
  `fecha_alta` datetime NOT NULL,
  `usuario_alta` varchar(15) NOT NULL,
  `fecha_modificacion` varchar(15) DEFAULT NULL,
  `usuario_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblusuarios`
--

INSERT INTO `tblusuarios` (`idusuario`, `email`, `password_usuario`, `nombres`, `apellido1`, `apellido2`, `perfil`, `foto`, `intentos`, `condicion`, `fecha_alta`, `usuario_alta`, `fecha_modificacion`, `usuario_modificacion`) VALUES
(1, 'raul.mtzglez@gmail.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Raul', 'Martinez', 'Gonzalez', 1, NULL, 0, 1, '2020-03-23 05:00:00', 'SISTEMA', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idtipodocumento` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `usuarioalta` varchar(15) NOT NULL,
  `fechaalta` datetime NOT NULL,
  `usuariomodificacion` varchar(15) DEFAULT NULL,
  `fechamodificacion` datetime DEFAULT NULL,
  `condicion` tinyint(4) NOT NULL DEFAULT '1',
  `idempresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vwopciones_menu`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vwopciones_menu` (
`idempresa` int(11)
,`idproceso` int(11)
,`proceso` varchar(60)
,`publicar` tinyint(4)
,`condicionproceso` tinyint(4)
,`idsubproceso` int(11)
,`subproceso` varchar(60)
,`condicionsubproceso` tinyint(4)
,`consecutivo` int(11)
,`identificadorsubproceso` varchar(45)
,`archivocreado` tinyint(4)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vwopciones_menu`
--
DROP TABLE IF EXISTS `vwopciones_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwopciones_menu`  AS  select `procesos`.`idempresa` AS `idempresa`,`procesos`.`idproceso` AS `idproceso`,`procesos`.`descripcion` AS `proceso`,`procesos`.`publicar` AS `publicar`,`procesos`.`condicion` AS `condicionproceso`,`subprocesos`.`idsubproceso` AS `idsubproceso`,`subprocesos`.`descripcion` AS `subproceso`,`subprocesos`.`condicion` AS `condicionsubproceso`,`subprocesos`.`consecutivo` AS `consecutivo`,`subprocesos`.`identificadorsubproceso` AS `identificadorsubproceso`,`subprocesos`.`archivocreado` AS `archivocreado` from (`procesos` join `subprocesos` on((`procesos`.`idproceso` = `subprocesos`.`idproceso`))) ;

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
  ADD UNIQUE KEY `codigodocumento_UNIQUE` (`codigodocumento`),
  ADD KEY `fk_documentos_usuarios_suscriptores1_idx` (`idusuarioresponsable`),
  ADD KEY `fk_documentos_subprocesos1_idx` (`idsubproceso`),
  ADD KEY `fk_documentos_tipodocumento1_idx` (`idtipodocumento`),
  ADD KEY `fk_documentos_tblempresas1_idx` (`idempresa`);

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
  ADD KEY `fk_procesos_tblempresas1_idx` (`idempresa`);

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
-- Indices de la tabla `tblempresas`
--
ALTER TABLE `tblempresas`
  ADD PRIMARY KEY (`idempresa`),
  ADD UNIQUE KEY `tax_id_number_UNIQUE` (`rfc`);

--
-- Indices de la tabla `tblempresas_has_usuarios`
--
ALTER TABLE `tblempresas_has_usuarios`
  ADD KEY `fk_table1_tblempresas1_idx` (`idempresa`),
  ADD KEY `fk_table1_tblusuarios1_idx` (`idusuario`);

--
-- Indices de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `idusuario_UNIQUE` (`idusuario`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idtipodocumento`),
  ADD KEY `fk_tipodocumento_tblempresas1_idx` (`idempresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accionesdocumentos`
--
ALTER TABLE `accionesdocumentos`
  MODIFY `idaccion` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subprocesos`
--
ALTER TABLE `subprocesos`
  MODIFY `idsubproceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblempresas`
--
ALTER TABLE `tblempresas`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblusuarios`
--
ALTER TABLE `tblusuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idtipodocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accionesdocumentos`
--
ALTER TABLE `accionesdocumentos`
  ADD CONSTRAINT `fk_acciones_documentos_documentos1` FOREIGN KEY (`iddocumento`) REFERENCES `documentos` (`iddocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acciones_documentos_usuarios_suscriptores1` FOREIGN KEY (`idusuarioalta`) REFERENCES `tblusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `autorizadoresxdocumento`
--
ALTER TABLE `autorizadoresxdocumento`
  ADD CONSTRAINT `fk_autorizadores_ruta_autorizacion1` FOREIGN KEY (`idruta`) REFERENCES `rutaxdocumento` (`idruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_autorizadores_usuarios_suscriptores1` FOREIGN KEY (`idusuario`) REFERENCES `tblusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `autorizadoresxproceso`
--
ALTER TABLE `autorizadoresxproceso`
  ADD CONSTRAINT `fk_autorizadoresxproceso_rutaxsubproceso1` FOREIGN KEY (`idruta`) REFERENCES `rutaxsubproceso` (`idruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_autorizadoresxproceso_usuarios_suscriptores1` FOREIGN KEY (`idusuario`) REFERENCES `tblusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `avanceaccion`
--
ALTER TABLE `avanceaccion`
  ADD CONSTRAINT `fk_avanceaccion_accionesdocumentos1` FOREIGN KEY (`idaccion`) REFERENCES `accionesdocumentos` (`idaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avanceaccion_usuarios_suscriptores1` FOREIGN KEY (`idusuario`) REFERENCES `tblusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_documentos_subprocesos1` FOREIGN KEY (`idsubproceso`) REFERENCES `subprocesos` (`idsubproceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentos_tblempresas1` FOREIGN KEY (`idempresa`) REFERENCES `tblempresas` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentos_tipodocumento1` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`idtipodocumento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documentos_usuarios_suscriptores1` FOREIGN KEY (`idusuarioresponsable`) REFERENCES `tblusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_procesos_tblempresas1` FOREIGN KEY (`idempresa`) REFERENCES `tblempresas` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `tblempresas_has_usuarios`
--
ALTER TABLE `tblempresas_has_usuarios`
  ADD CONSTRAINT `fk_table1_tblempresas1` FOREIGN KEY (`idempresa`) REFERENCES `tblempresas` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_tblusuarios1` FOREIGN KEY (`idusuario`) REFERENCES `tblusuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD CONSTRAINT `fk_tipodocumento_tblempresas1` FOREIGN KEY (`idempresa`) REFERENCES `tblempresas` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
