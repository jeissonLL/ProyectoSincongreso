-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generaci�n: 30-03-2017 a las 17:58:45
-- Versi�n del servidor: 5.5.24-log
-- Versi�n de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbcongresoceat`
--
CREATE DATABASE `dbcongresoceat` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `dbcongresoceat`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_actividad` (
  `id_actividad_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_actividad` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `presento` tinyint(1) DEFAULT NULL COMMENT 'Este campo booleano sirve para determinar si el trabajo se present� o no en la actividad.',
  `id_tipo_actividad_fk` int(11) NOT NULL,
  `id_espacio_pk` int(11) NOT NULL,
  `fecha_actividad` date DEFAULT NULL,
  PRIMARY KEY (`id_actividad_pk`),
  KEY `fk_tbl_actividad_tbl_tipo_actividad1_idx` (`id_tipo_actividad_fk`),
  KEY `fk_tbl_actividad_tbl_espacio1_idx` (`id_espacio_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_tematica`
--

CREATE TABLE IF NOT EXISTS `tbl_actividad_tematica` (
  `id_actividad_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_actividad_fk`,`id_tematica_fk`),
  KEY `fk_tbl_actividad_has_tbl_tematica_tbl_tematica1_idx` (`id_tematica_fk`),
  KEY `fk_tbl_actividad_has_tbl_tematica_tbl_actividad1_idx` (`id_actividad_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Cuando se crea una actividad puede asociarse a una o m�s lineas de investigaci�n, a su vez; al pertenecer a una l�nea de investigaci�n, puede estar asociada a todas o algunas de las tem�ticas concernientes a �sa l�nea, como cada tem�tica est� asociada a una l�nea de investigaci�n, basta con asociar actividad con tem�tica para obtener los tres datos y tener la libertad de asociar a ''actividad'' con una o m�s ''tem�ticas'' y a su vez ''l�neas de investigaci�n''.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_trabajo`
--

CREATE TABLE IF NOT EXISTS `tbl_actividad_trabajo` (
  `id_actividad_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_actividad_fk`,`id_trabajo_fk`),
  KEY `fk_tbl_actividad_has_tbl_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`),
  KEY `fk_tbl_actividad_has_tbl_trabajo_tbl_actividad1_idx` (`id_actividad_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivo_complementario`
--

CREATE TABLE IF NOT EXISTS `tbl_archivo_complementario` (
  `id_archivo_complementario_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_archivo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` mediumtext COLLATE utf8_bin,
  `ubicacion_archivo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_archivo_complementario_pk`),
  KEY `fk_tbl_archivos_complementarios_tbl_trabajo1_idx` (`id_trabajo_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignacion_a_revisor`
--

CREATE TABLE IF NOT EXISTS `tbl_asignacion_a_revisor` (
  `id_asignacion_a_revisor_pk` int(11) NOT NULL AUTO_INCREMENT,
  `pendiente_aceptacion` tinyint(1) DEFAULT NULL,
  `aceptado` tinyint(1) DEFAULT NULL,
  `descargo_archivo` tinyint(1) DEFAULT NULL,
  `termino_llenar_formulario` tinyint(1) DEFAULT NULL,
  `fecha_que_reviso` date DEFAULT NULL,
  `fecha_acepto_rechazo` date DEFAULT NULL,
  `fecha_que_se_le_asigno` date DEFAULT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `id_usuario_que_asigna` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `id_usuario_que_recibe` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `id_tipo_dictamen_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_asignacion_a_revisor_pk`),
  KEY `fk_tbl_asignacion_a_revisores_tbl_trabajo1_idx` (`id_trabajo_fk`),
  KEY `fk_tbl_asignacion_a_revisor_tbl_tipo_dictamen1_idx` (`id_tipo_dictamen_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignacion_editor_seccion_secundario`
--

CREATE TABLE IF NOT EXISTS `tbl_asignacion_editor_seccion_secundario` (
  `id_asignacion_editor_seccion_secundaria_pk` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_recibe_asignacion` date DEFAULT NULL,
  `id_usuario_que_asigna` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `id_usuario_que_recibe` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `a_dictamen` tinyint(1) DEFAULT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_asignacion_editor_seccion_secundaria_pk`),
  KEY `fk_tbl_asignacion_editor_seccion_secundario_tbl_trabajo1_idx` (`id_trabajo_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrera`
--

CREATE TABLE IF NOT EXISTS `tbl_carrera` (
  `id_carrera_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_carrera` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `tbl_carreracol` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_carrera_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_centros`
--

CREATE TABLE IF NOT EXISTS `tbl_centros` (
  `id_centro_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_centro` mediumtext COLLATE utf8_bin,
  `id_institucion_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_centro_pk`,`id_institucion_fk`),
  KEY `fk_tbl_centros_tbl_institucion1_idx` (`id_institucion_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_certificados`
--

CREATE TABLE IF NOT EXISTS `tbl_certificados` (
  `id_certificado_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_certificado` varchar(250) COLLATE utf8_bin NOT NULL,
  `encabezado_certificado` mediumtext COLLATE utf8_bin NOT NULL,
  `motivo_certificado` mediumtext COLLATE utf8_bin NOT NULL,
  `pie_certificado` mediumtext COLLATE utf8_bin NOT NULL,
  `url_arte` mediumtext COLLATE utf8_bin COMMENT 'En esta tabla se guardan los certificados y esta relacionada con la tabla tbl_personas_firma_certificado',
  `certificado_especial` tinyint(1) DEFAULT NULL,
  `nombre_persona` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_certificado_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tbl_certificados`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citacion`
--

CREATE TABLE IF NOT EXISTS `tbl_citacion` (
  `id_citacion_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_citacion` mediumtext COLLATE utf8_bin,
  `descripcion` longtext COLLATE utf8_bin,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_citacion_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso`
--

CREATE TABLE IF NOT EXISTS `tbl_congreso` (
  `id_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada Congreso creado.',
  `nombre_congreso` longtext COLLATE utf8_bin COMMENT 'Nombre dado a cada congreso creado',
  `a�o` year(4) DEFAULT NULL,
  `siglas` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `descripcion_congreso` longtext COLLATE utf8_bin,
  `lugar` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `coordenadas` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `id_pais_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  `fecha_inicio` date DEFAULT NULL COMMENT 'fecha de inicio del congreso',
  `fecha_finalizacion` date DEFAULT NULL COMMENT 'fecha de finalizacion del congreso',
  `lema` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_estado_congreso_fk` int(11) NOT NULL COMMENT 'Identificador for�neo a la tabla ''tbl_estado_congreso''.',
  `fecha_i_recepcion` date DEFAULT NULL COMMENT 'fecha de inicio de recepcion de trabajos',
  `fecha_f_recepcion` date DEFAULT NULL COMMENT 'fecha de finalizacion de recepcion de trabajos',
  `fecha_i_revision` date DEFAULT NULL COMMENT 'fecha de inicio de revisiones',
  `fecha_f_revision` date DEFAULT NULL COMMENT 'fecha de finalizacion de revisiones',
  `fecha_p_programa` date DEFAULT NULL COMMENT 'fecha de publicacion del programa',
  `fecha_cambio_costo_inscripcion` date DEFAULT NULL,
  `logo_congreso` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `numero_cai` int(11) DEFAULT NULL COMMENT 'N�mero de cuenta de banco asociada al Congreso para cuestiones de pagos y dem�s.',
  `creado_por` int(11) DEFAULT NULL COMMENT 'Campo en el que se guarda el id del usuario que modifico o cre� la informaci�n dentro de la tabla, notese que es un campo no referenciado directamente, pero el dato que se guardar� har� referencia directa a un usuario.',
  `fecha_creacion` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'Campo en el que se guarda el id del usuario que modifico o cre� la informaci�n dentro de la tabla, notese que es un campo no referenciado directamente, pero el dato que se guardar� har� referencia directa a un usuario.',
  PRIMARY KEY (`id_congreso_pk`),
  KEY `fk_tbl_congreso_tbl_estado_congreso1_idx` (`id_estado_congreso_fk`),
  KEY `fk_tbl_congreso_tbl_pais1_idx` (`id_pais_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_congreso_actividad` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_linea_investigacion_pk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_congreso_fk`,`id_actividad_fk`),
  KEY `fk_tbl_congreso_has_tbl_actividad_tbl_actividad1_idx` (`id_actividad_fk`),
  KEY `fk_tbl_congreso_has_tbl_actividad_tbl_congreso1_idx` (`id_congreso_fk`),
  KEY `fk_tbl_congreso_actividad_tbl_linea_investigacion1_idx` (`id_linea_investigacion_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_linea_investigacion`
--

CREATE TABLE IF NOT EXISTS `tbl_congreso_linea_investigacion` (
  `id_congreso_pk` int(11) NOT NULL,
  `id_linea_investigacion_pk` int(11) NOT NULL,
  PRIMARY KEY (`id_congreso_pk`,`id_linea_investigacion_pk`),
  KEY `fk_tbl_congreso_has_tbl_linea_investigacion_tbl_linea_inves_idx` (`id_linea_investigacion_pk`),
  KEY `fk_tbl_congreso_has_tbl_linea_investigacion_tbl_congreso1_idx` (`id_congreso_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_patrocinador`
--

CREATE TABLE IF NOT EXISTS `tbl_congreso_patrocinador` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_patrocinador_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_congreso_fk`,`id_patrocinador_fk`),
  KEY `fk_tbl_congreso_has_tbl_patrocinador_tbl_patrocinador1_idx` (`id_patrocinador_fk`),
  KEY `fk_tbl_congreso_has_tbl_patrocinador_tbl_congreso1_idx` (`id_congreso_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_rol_tematicas`
--

CREATE TABLE IF NOT EXISTS `tbl_congreso_rol_tematicas` (
  `id_tematica_fk` int(11) NOT NULL,
  `id_usuario_congreso_roles_fk` int(11) NOT NULL,
  KEY `fk_tbl_congreso_rol_tematicas_tbl_tematica1_idx` (`id_tematica_fk`),
  KEY `fk_tbl_congreso_rol_tematicas_tbl_usuario_congreso_roles1_idx` (`id_usuario_congreso_roles_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_correo`
--

CREATE TABLE IF NOT EXISTS `tbl_correo` (
  `id_correo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el correo indicado es o no el que usa la persona como principal',
  `id_persona_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_correo_pk`),
  KEY `fk_tbl_correo_tbl_persona1_idx` (`id_persona_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_costo`
--

CREATE TABLE IF NOT EXISTS `tbl_costo` (
  `id_costo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `costo_momento` double DEFAULT NULL,
  `costo_exposicion` double DEFAULT NULL,
  `estudiante` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina al momento del cobro si quien va a realizar el pago es un estudiante o no, ya que de ser un estudiante se aplicar� un costo especial.',
  `id_rol_congreso_fk` int(11) NOT NULL COMMENT 'Identificador for�neo a la tabla ''tbl_rol_congreso'' para saber el rol que realiz� el usuario en un congreso determinado.',
  PRIMARY KEY (`id_costo_pk`),
  KEY `fk_tbl_costo_tbl_roles_congreso1_idx` (`id_rol_congreso_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_espacio`
--

CREATE TABLE IF NOT EXISTS `tbl_espacio` (
  `id_espacio_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_espacio` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `nombre_alternativo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `descripcion_espacio` mediumtext COLLATE utf8_bin,
  `capacidad_personas` int(11) DEFAULT NULL,
  `numero_tomacorriente` int(11) DEFAULT NULL,
  `mapa_espacio` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `comentarios` longtext COLLATE utf8_bin,
  PRIMARY KEY (`id_espacio_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_espacio_congreso`
--

CREATE TABLE IF NOT EXISTS `tbl_espacio_congreso` (
  `id_espacio_fk` int(11) NOT NULL,
  `id_congreso_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_espacio_fk`,`id_congreso_fk`),
  KEY `fk_tbl_espacio_has_tbl_congreso_tbl_congreso1_idx` (`id_congreso_fk`),
  KEY `fk_tbl_espacio_has_tbl_congreso_tbl_espacio1_idx` (`id_espacio_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estadistica`
--

CREATE TABLE IF NOT EXISTS `tbl_estadistica` (
  `id_estadistica_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estadistica` longtext COLLATE utf8_bin,
  `descripcion` longtext COLLATE utf8_bin,
  `id_tipo_estadistica_fk` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_estadistica_pk`),
  KEY `fk_tbl_estadistica_tbl_tipo_estadistica1_idx` (`id_tipo_estadistica_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE IF NOT EXISTS `tbl_estado` (
  `id_estado_pk` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_estado_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_congreso`
--

CREATE TABLE IF NOT EXISTS `tbl_estado_congreso` (
  `id_estado_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifcador �nico para cada estado de congreso',
  `nombre_estado` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre de estado de congreso, este puede ser, activo, inactivo, etc.',
  PRIMARY KEY (`id_estado_congreso_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura`
--

CREATE TABLE IF NOT EXISTS `tbl_factura` (
  `id_factura_pk` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `identificador` int(11) DEFAULT NULL COMMENT 'Aqu� se guardar� el identificador de la entidad a la cual va dirigida la factura.',
  `id_rango_pk` int(11) NOT NULL,
  PRIMARY KEY (`id_factura_pk`),
  KEY `fk_tbl_factura_tbl_rango1_idx` (`id_rango_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura_detalle`
--

CREATE TABLE IF NOT EXISTS `tbl_factura_detalle` (
  `id_factura_fk` int(11) NOT NULL,
  `porcentaje_costo_usuario` double DEFAULT NULL,
  `porcentaje_tour` double DEFAULT NULL,
  `momento` tinyint(1) DEFAULT NULL,
  `id_tour_usuario_fk` int(11) NOT NULL,
  KEY `fk_tbl_factura_has_tbl_costo_usuario_tbl_factura1_idx` (`id_factura_fk`),
  KEY `fk_tbl_factura_detalle_tbl_tour_usuario1_idx` (`id_tour_usuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_facultad`
--

CREATE TABLE IF NOT EXISTS `tbl_facultad` (
  `id_facultad_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_facultad` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_facultad_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formulario`
--

CREATE TABLE IF NOT EXISTS `tbl_formulario` (
  `id_formulario_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_formulario` mediumtext COLLATE utf8_bin,
  `descripcion` longtext COLLATE utf8_bin,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_formulario_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formulario_tematica`
--

CREATE TABLE IF NOT EXISTS `tbl_formulario_tematica` (
  `id_formulario_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_formulario_fk`,`id_tematica_fk`),
  KEY `fk_tbl_formulario_has_tbl_tematica_tbl_tematica1_idx` (`id_tematica_fk`),
  KEY `fk_tbl_formulario_has_tbl_tematica_tbl_formulario1_idx` (`id_formulario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_idioma`
--

CREATE TABLE IF NOT EXISTS `tbl_idioma` (
  `id_idioma_pk` varchar(2) COLLATE utf8_bin NOT NULL,
  `nombre_idioma` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `estado_idioma` tinyint(1) DEFAULT NULL,
  `bandera` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_idioma_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_idioma`
--

INSERT INTO `tbl_idioma` (`id_idioma_pk`, `nombre_idioma`, `estado_idioma`, `bandera`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
('aa', 'Afar;Afar;Qaf�r af', 0, NULL, NULL, '2017-02-22', NULL, NULL),
('ab', 'Abjasio;Abkhazian;????? aphsua', 0, NULL, NULL, '2017-02-22', NULL, NULL),
('ae', 'Av�stico;Avestan;Avestan', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('af', 'Afrik�ans;Afrikaans;Afrikaans', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ak', 'Akano;Akan;Akan', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('am', 'Amh�rico;Amharic;????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('an', 'Aragon�s;Aragonese;Aragon�s', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ar', '�rabe;Arabic;?????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('as', 'Asam�s;Assamese;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('av', 'Avar (o �varo);Avaric;???????? ???? ', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ay', 'Aimara;Aymara;Aymar aru', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('az', 'Azer�;Azerbaijani;Az?rbaycan dili', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ba', 'Baskir;Bashkir;??????? ????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('be', 'Bielorruso;Belarusian;??????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('bg', 'B�lgaro;Bulgarian;?????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('bh', 'Bhoyapur�;Bihari languages;Bihari languages', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('bi', 'Bislama;Bislama;Bislama', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('bm', 'Bambara;Bambara;Bamanankan', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('bn', 'Bengal�;Bengali;?????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('bo', 'Tibetano;Tibetan;????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('br', 'Bret�n;Breton;Brezhoneg', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('bs', 'Bosnio;Bosnian;Bosanski', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ca', 'Catal�n;Catalan;Catal�', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ce', 'Checheno;Chechen;???????? ????? / ?????? ?????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ch', 'Chamorro;Chamorro;Chamoru', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('co', 'Corso;Corsican;Corsu;Corsu', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('cr', 'Cree;Cree;Cree', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('cs', 'Checo;Czech;Ce�tina', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('cu', 'Eslavo eclesi�stico antiguo;Church Slavic;????????????????? ????/sarkovnoslavyanski ezik', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('cv', 'Chuvasio;Chuvash;???????, Cava�la', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('cy', 'Gal�s;Welsh;Cymraeg', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('da', 'Dan�s;Danish;Dansk', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('de', 'Alem�n;German;Deutsch', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('dv', 'Maldivo (o dhivehi);Maldivian (or Dhivehi);?????? / divehi', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('dz', 'Dzongkha;Dzongkha;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ee', 'Ew�;Ewe;�?egbe', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('el', 'Griego;Greek;????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('en', 'Ingl�s;English;English', 1, 'en', NULL, '2017-02-22', NULL, NULL),
('eo', 'Esperanto;Esperanto;Esperanto', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('es', 'Espa�ol;Spanish;Espa�ol', 1, 'es', NULL, '2017-02-22', NULL, NULL),
('et', 'Estonio;Estonian;Eesti', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('eu', 'Euskera;Basque;euskara', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('fa', 'Persa;Persian;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ff', 'Fula;Fulah;Pulaar', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('fi', 'Fin�s;Finnish;Suomi', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('fj', 'Fiyiano;Fijian;Na Vosa Vakaviti', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('fo', 'Fero�s;Faroese;F�royskt', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('fr', 'Franc�s;French;Fran�ais', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('fy', 'Fris�n;Western Frisian;Frysk', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ga', 'Irland�s;Irish;Gaeilge', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('gd', 'Ga�lico escoc�s;Scottish Gaelic;G�idhlig', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('gl', 'Gallego;Galician;Galego', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('gn', 'Guaran�;Guarani;Guarani', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('gu', 'Guyarat� (o guyarat�);Gujarati;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('gv', 'Man�s;Manx;Gaelg Vanninagh', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ha', 'Hausa;Hausa;Hausa', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('he', 'Hebreo;Hebrew;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('hi', 'Hindi (o hind�);Hindi;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ho', 'Hiri motu;Hiri Motu;Hiri Motu', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('hr', 'Croata;Croatian;Hrvatski', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ht', 'Haitiano;Haitian;Haitian', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('hu', 'H�ngaro;Hungarian;Magyar', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('hy', 'Armenio;Armenian;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('hz', 'Herero;Herero;Otjiherero', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ia', 'Interlingua;Interlingua;Interlingua', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('id', 'Indonesio;Indonesian;Bahasa Indonesia', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ie', 'Occidental;Occidental;Occidental', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ig', 'Igbo;Igbo;As?s? Igbo', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ii', 'Yi de Sichu�n;Sichuan Yi;Nuosu', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ik', 'I�upiaq;Inupiaq;Inupiaq', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('io', 'Ido;Ido;Ido', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('is', 'Island�s;Icelandic;�slenska', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('it', 'Italiano;Italian;Italiano', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('iu', 'Inuktitut (o inuit);Inuktitut;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ja', 'Japon�s;Japanese;???', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('jv', 'Javan�s;Javanese;Basa Jawa', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ka', 'Georgiano;Georgian;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kg', 'Kongo;Kongo;Kikongo', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ki', 'Kikuyu;Kikuyu;Gikuyu', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kj', 'Kuanyama;Kwanyama;Kwanyama', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kk', 'Kazajo;Kazakh;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kl', 'Groenland�s;Greenlandic;Kalaallisut', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('km', 'Camboyano;Central Khmer;??????????????????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kn', 'Canar�s;Kannada;?????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ko', 'Coreano;Korean;???', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kr', 'Kanuri;Kanuri;Kanuri', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ks', 'Cachemiro;Kashmiri;?????/????? /k?��ur', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ku', 'Kurdo;Kurdish;Kurd� (Kurmanc�)', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kv', 'Komi;Komi;????/Komi', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('kw', 'C�rnico;Cornish;Kernewek/Kernowek', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ky', 'Kirgu�s;Kirghiz;?????? ????/????????\nKyrgyz tili, Kyrgyz�a/????????/?????? ????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('la', 'Lat�n;Latin;lingua latina', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('lb', 'Luxemburgu�s;Luxembourgish;L�tzebuergesch', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('lg', 'Luganda;Ganda;Ganda', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('li', 'Limburgu�s;Limburgan;Limburgan', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ln', 'Lingala;Lingala;Lingala', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('lo', 'Lao;Lao;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('lt', 'Lituano;Lithuanian;Lietuviu', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('lu', 'Luba-katanga;Luba-Katanga;KiLuba', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('lv', 'Let�n;Latvian;Latvie�u', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('mg', 'Malgache;Malagasy;Malagasy', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('mh', 'Marshal�s;Marshallese;Kajin M�ajel', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('mi', 'Maor�;Maori;reo maori', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('mk', 'Macedonio;Macedonian;??????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ml', 'Malayalam;Malayalam;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('mn', 'Mongol;Mongolian;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('mr', 'Marat�;Marathi;?????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ms', 'Malayo;Malay;Bahasa Melayu', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('mt', 'Malt�s;Maltese;Malti', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('my', 'Birmano;Burmese;??????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('na', 'Nauruano;Nauru;Dorerin Naoero', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('nb', 'Noruego bokm�l;Norwegian Bokm�l;Norsk (bokm�l)', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('nd', 'Ndebele del norte;North Ndebele;isiNdebele', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ne', 'Nepal�;Nepali;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ng', 'Ndonga;Ndonga;ndonga', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('nl', 'Neerland�s;Dutch;Nederlands', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('nn', 'Nynorsk;Norwegian Nynorsk;Norsk (nynorsk)', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('no', 'Noruego;Norwegian;Norsk', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('nr', 'Ndebele del sur;South Ndebele;isiNdebele', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('nv', 'Navajo;Navajo;Din� bizaad', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ny', 'Chichewa;Chichewa;Chichewa', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('oc', 'Occitano;Occitan;Occitan', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('oj', 'Ojibwa;Ojibwa;????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('om', 'Oromo;Oromo;Afaan Oromoo', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('or', 'Oriya;Oriya;?????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('os', 'Os�tico;Ossetian;??????/Irona', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('pa', 'Panyab�;Panjabi;?????? pa�jabi/?????? pa?jabi', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('pi', 'Pali;Pali;????/Pa?i', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('pl', 'Polaco;Polish;Polski', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ps', 'Past�;Pushto;?????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('pt', 'Portugu�s;Portuguese;Portugu�s', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('qu', 'Quechua;Quechua;Quechua', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('rm', 'Romanche;Romansh;Romansh', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('rn', 'Kirundi;Rundi;Ikirundi', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ro', 'Rumano;Romanian;Rom�na', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ru', 'Ruso;Russian;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('rw', 'Ruand�s;Kinyarwanda;Ikinyarwanda', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sa', 'S�nscrito;Sanskrit;''?????????/Sa?sk?tam', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sc', 'Sardo;Sardinian;Sardu', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sd', 'Sindhi;Sindhi;??????/????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('se', 'Sami septentrional;Northern Sami;Northern Sami', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sg', 'Sango;Sango;y�ng� t� s�ng�', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('si', 'Cingal�s;Sinhala;?????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sk', 'Eslovaco;Slovak;Slovencina', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sl', 'Esloveno;Slovenian;Sloven�cina', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sm', 'Samoano;Samoan;Gagana fa''a Samoa', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sn', 'Shona;Shona;Shona', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('so', 'Somal�;Somali;Af-Soomaali/?? ???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sq', 'Alban�s;Albanian;Shqip', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sr', 'Serbio;Serbian;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ss', 'Suazi;Swati;SiSwati', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('st', 'Sesotho;Sotho;seSotho', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('su', 'Sundan�s;Sundanese;?? ????? Basa Sunda', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sv', 'Sueco;Swedish;Svenska', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('sw', 'Suajili;Swahili;Kiswahili', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('te', 'T�lugu;Telugu;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('tg', 'Tayiko;Tajik;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('th', 'Tailand�s;Thai;???????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ti', 'Tigri�a;Tigrinya;????/T?g?r?�a', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('tk', 'Turcomano;Turkmen;?????????/??????? ????/??????? ????/?????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('tl', 'Tagalo;Tagalog;Wikang tagalog', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('tn', 'Setsuana;Tswana;Setswana', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('to', 'Tongano;Tonga;lea faka-Tonga', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('tr', 'Turco;Turkish;T�rk�e', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ts', 'Tsonga;Tsonga;Xitsonga', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('tt', 'T�rtaro;Tatar;????? ????/tatar tele/????? ???', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('tw', 'Twi;Twi;Asante Twi', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ty', 'Tahitiano;Tahitian;Reo Tahiti/Reo Ma''ohi', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ug', 'Uigur;Uighu;????????/?????? ????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('uk', 'Ucraniano;Ukrainian;??????????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ur', 'Urdu;Urdu;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('uz', 'Uzbeko;Uzbek;O''zbek', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('ve', 'Venda;Venda;Tshiven?a', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('vi', 'Vietnamita;Vietnamese;Ti?ng Vi?t', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('vo', 'Volap�k;Volap�k;Volap�k', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('wa', 'Val�n;Walloon;Walon', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('wo', 'Wolof;Wolof;Wolof', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('xh', 'Xhosa;Xhosa;isiXhosa', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('yi', 'Y�dish;Yiddish;??????', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('yo', 'Yoruba;Yoruba;�d� Yor�b�', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('za', 'Chuan;Zhuang;Zhuang', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('zh', 'Chino mandar�n;Chinese;??(??)', NULL, NULL, NULL, '2017-02-22', NULL, NULL),
('zu', 'Zul�;Zulu;isiZulu', NULL, NULL, NULL, '2017-02-22', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_idiomas_personas`
--

CREATE TABLE IF NOT EXISTS `tbl_idiomas_personas` (
  `principal` tinyint(1) DEFAULT NULL,
  `id_idioma_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  `id_persona_pk` int(11) NOT NULL,
  KEY `fk_tbl_idiomas_usuarios_tbl_idioma1_idx` (`id_idioma_fk`),
  KEY `fk_tbl_idiomas_usuarios_tbl_persona1_idx` (`id_persona_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion`
--

CREATE TABLE IF NOT EXISTS `tbl_institucion` (
  `id_institucion_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_institucion` mediumtext COLLATE utf8_bin,
  `id_tipo_institucion_fk` int(11) NOT NULL,
  `id_pais_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_institucion_pk`),
  KEY `fk_tbl_institucion_tbl_tipo_institucion1_idx` (`id_tipo_institucion_fk`),
  KEY `fk_tbl_institucion_tbl_pais1_idx` (`id_pais_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion_carrera`
--

CREATE TABLE IF NOT EXISTS `tbl_institucion_carrera` (
  `id_institucion_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_institucion_fk`,`id_carrera_fk`),
  KEY `fk_tbl_institucion_has_tbl_carrera_tbl_carrera1_idx` (`id_carrera_fk`),
  KEY `fk_tbl_institucion_has_tbl_carrera_tbl_institucion1_idx` (`id_institucion_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion_facultad`
--

CREATE TABLE IF NOT EXISTS `tbl_institucion_facultad` (
  `id_institucion_fk` int(11) NOT NULL,
  `id_facultad_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_institucion_fk`,`id_facultad_fk`),
  KEY `fk_tbl_institucion_has_tbl_facultad_tbl_facultad1_idx` (`id_facultad_fk`),
  KEY `fk_tbl_institucion_has_tbl_facultad_tbl_institucion1_idx` (`id_institucion_fk`),
  KEY `fk_tbl_institucion_facultad_tbl_carrera1_idx` (`id_carrera_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_linea_investigacion`
--

CREATE TABLE IF NOT EXISTS `tbl_linea_investigacion` (
  `id_linea_investigacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada tipo de linea de investigaci�n',
  `nombre_linea_investigacion` mediumtext COLLATE utf8_bin COMMENT 'Nombre dado a cada l�nea de investigaci�n creado.',
  `descripcion_linea_investigacion` mediumtext COLLATE utf8_bin,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_linea_investigacion_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_log`
--

CREATE TABLE IF NOT EXISTS `tbl_log` (
  `id_log_pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_fk` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `informacion_extra` longtext COLLATE utf8_bin,
  `id_tipo_log_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_log_pk`),
  KEY `fk_tbl_log_tbl_usuario1_idx` (`id_usuario_fk`),
  KEY `fk_tbl_log_tbl_tipo_logs1_idx` (`id_tipo_log_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mensaje`
--

CREATE TABLE IF NOT EXISTS `tbl_mensaje` (
  `id_mensaje_pk` int(11) NOT NULL AUTO_INCREMENT,
  `asunto` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `contenido_mensaje` text COLLATE utf8_bin,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_mensaje_pk`),
  KEY `fk_tbl_publicacion_tbl_usuario1_idx` (`id_usuario_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modulos`
--

CREATE TABLE IF NOT EXISTS `tbl_modulos` (
  `id_modulo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_modulo_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_nivel_educativo`
--

CREATE TABLE IF NOT EXISTS `tbl_nivel_educativo` (
  `id_nivel_educativo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_nivel_educativo` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  PRIMARY KEY (`id_nivel_educativo_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_noticia`
--

CREATE TABLE IF NOT EXISTS `tbl_noticia` (
  `id_noticia_pk` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` mediumtext COLLATE utf8_bin,
  `imagen` mediumtext COLLATE utf8_bin,
  `descripcion` longtext COLLATE utf8_bin,
  `id_usuario_congreso_rol_fk` int(11) NOT NULL,
  `fecha` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_noticia_pk`),
  KEY `fk_tbl_noticia_tbl_usuario_congreso_roles1_idx` (`id_usuario_congreso_rol_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notificacion`
--

CREATE TABLE IF NOT EXISTS `tbl_notificacion` (
  `id_notificacion_pk` int(11) NOT NULL AUTO_INCREMENT,
  `texto_notificacion` longtext COLLATE utf8_bin,
  `id_usuario_fk` int(11) NOT NULL,
  `fecha_notificacion` date DEFAULT NULL,
  `hora_notificacion` time DEFAULT NULL,
  PRIMARY KEY (`id_notificacion_pk`),
  KEY `fk_tbl_notificacion_tbl_usuario1_idx` (`id_usuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_organizadores`
--

CREATE TABLE IF NOT EXISTS `tbl_organizadores` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL,
  KEY `fk_tbl_organizadores_tbl_congreso1_idx` (`id_congreso_fk`),
  KEY `fk_tbl_organizadores_tbl_institucion1_idx` (`id_institucion_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pais`
--

CREATE TABLE IF NOT EXISTS `tbl_pais` (
  `id_pais_pk` varchar(2) COLLATE utf8_bin NOT NULL COMMENT 'Identificador �nico para cada pa�s.',
  `nombre_pais` longtext COLLATE utf8_bin COMMENT 'Nombre de cada pa�s (debe escribirse correctamente).',
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_pais_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_pais`
--

INSERT INTO `tbl_pais` (`id_pais_pk`, `nombre_pais`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
('AD', 'Andorra;Andorra;Principat d''Andorra', NULL, '2017-02-22', NULL, NULL),
('AE', 'Emiratos Árabes Unidos;United Arab Emirates;دولة الإمارات العربية المتحدة', NULL, '2017-02-22', NULL, NULL),
('AF', 'Afganistán;Afghanistan;افغانستان', NULL, '2017-02-22', NULL, NULL),
('AG', 'Antigua y Barbuda;Antigua and Barbuda;Antigua and Barbuda', NULL, '2017-02-22', NULL, NULL),
('AI', 'Anguila;Anguilla;Anguilla', NULL, '2017-02-22', NULL, NULL),
('AL', 'Albania;Albania;Shqipëri', NULL, '2017-02-22', NULL, NULL),
('AM', 'Armenia;Armenia;Հայաստան', NULL, '2017-02-22', NULL, NULL),
('AN', 'Antillas Neerlandesas;Nederlandse Antillen;Nederlandse Antillen', NULL, '2017-02-22', NULL, NULL),
('AO', 'Angola;Angola;Angola', NULL, '2017-02-22', NULL, NULL),
('AQ', 'Antártida;Antarctica;Antarctica', NULL, '2017-02-22', NULL, NULL),
('AR', 'Argentina;Argentina;Argentina', NULL, '2017-02-22', NULL, NULL),
('AS', 'Samoa Americana;American Samoa;Sāmoa Amelika (American Samoa)', NULL, '2017-02-22', NULL, NULL),
('AT', 'Austria;Austria;Österreich', NULL, '2017-02-22', NULL, NULL),
('AU', 'Australia;Australia;Australia', NULL, '2017-02-22', NULL, NULL),
('AW', 'Aruba;Aruba;Aruba', NULL, '2017-02-22', NULL, NULL),
('AX', 'Islas Áland;Aland Islands;Åland', NULL, '2017-02-22', NULL, NULL),
('AZ', 'Azerbaiyán;Azerbaijan;Azərbaycan', NULL, '2017-02-22', NULL, NULL),
('BA', 'Bosnia y Herzegovina;Bosnia and Herzegovina;Bosna i Hercegovina (Босна и Херцеговина)', NULL, '2017-02-22', NULL, NULL),
('BB', 'Barbados;Barbados;Barbados', NULL, '2017-02-22', NULL, NULL),
('BD', 'Bangladesh;Bangladesh;বাংলাদেশ', NULL, '2017-02-22', NULL, NULL),
('BE', 'Bélgica;Belgium;België/Belgique/Belgien', NULL, '2017-02-22', NULL, NULL),
('BF', 'Burkina Faso;Burkina Faso;Burkina Faso', NULL, '2017-02-22', NULL, NULL),
('BG', 'Bulgaria;Bulgaria;България', NULL, '2017-02-22', NULL, NULL),
('BH', 'Bahréin;Bahrain;مملكة البحرين', NULL, '2017-02-22', NULL, NULL),
('BI', 'Burundi;Burundi;Republika y''u Burundi/République du Burundi', NULL, '2017-02-22', NULL, NULL),
('BJ', 'Benin;Benin;Bénin', NULL, '2017-02-22', NULL, NULL),
('BL', 'San Bartolomé;Saint Barthélemy;Saint-Barthélemy', NULL, '2017-02-22', NULL, NULL),
('BM', 'Bermudas;Bermuda;Bermuda', NULL, '2017-02-22', NULL, NULL),
('BN', 'Brunéi;Brunei Darussalam;Negara Brunei Darussalam/بروني دارالسلام ', NULL, '2017-02-22', NULL, NULL),
('BO', 'Bolivia;Bolivia;Bolivia', NULL, '2017-02-22', NULL, NULL),
('BR', 'Brasil;Brazil;Brasil', NULL, '2017-02-22', NULL, NULL),
('BS', 'Bahamas;Bahamas;Bahamas', NULL, '2017-02-22', NULL, NULL),
('BT', 'Bhután;Bhutan;འབྲུག་ རྒྱལ་ཁབ་', NULL, '2017-02-22', NULL, NULL),
('BV', 'Isla Bouvet;Bouvet Island;Bouvetøya', NULL, '2017-02-22', NULL, NULL),
('BW', 'Botsuana;Botswana;Botswana', NULL, '2017-02-22', NULL, NULL),
('BY', 'Bielorrusia;Belarus;Рэспубліка Беларусь (Belarus)', NULL, '2017-02-22', NULL, NULL),
('BZ', 'Belice;Belize;Belice', NULL, '2017-02-22', NULL, NULL),
('CA', 'Canadá;Canada;Canada', NULL, '2017-02-22', NULL, NULL),
('CC', 'Islas Cocos;Territory of Cocos (Keeling) Islands;Wilayah Kepulauan Cocos (Cocos)', NULL, '2017-02-22', NULL, NULL),
('CF', 'República Centro-Africana;Central African Republic; Ködörösêse tî Bêafrîka/République centrafricaine', NULL, '2017-02-22', NULL, NULL),
('CG', 'Congo;Congo;République du Congo;République du Congo', NULL, '2017-02-22', NULL, NULL),
('CH', 'Suiza;Switzerland;Schweiz/Suisse/Svizzera/Svizzera', NULL, '2017-02-22', NULL, NULL),
('CI', 'Costa de Marfil;Ivory Coast;Côte d’Ivoire', NULL, '2017-02-22', NULL, NULL),
('CK', 'Islas Cook;Cook Islands;Cook Islands', NULL, '2017-02-22', NULL, NULL),
('CL', 'Chile;Chile;Chile', NULL, '2017-02-22', NULL, NULL),
('CM', 'Camerún;Cameroon;Cameroun', NULL, '2017-02-22', NULL, NULL),
('CN', 'China;China;中华人民共和国', NULL, '2017-02-22', NULL, NULL),
('CO', 'Colombia;Colombia;Colombia', NULL, '2017-02-22', NULL, NULL),
('CR', 'Costa Rica;Costa Rica;Costa Rica', NULL, '2017-02-22', NULL, NULL),
('CU', 'Cuba;Cuba;Cuba', NULL, '2017-02-22', NULL, NULL),
('CV', 'Cabo Verde;Cabo Verde;Cabo Verde', NULL, '2017-02-22', NULL, NULL),
('CX', 'Islas Christmas;Christmas Island;Christmas Island', NULL, '2017-02-22', NULL, NULL),
('CY', 'Chipre;Cyprus;Κύπρος/Kıbrıs', NULL, '2017-02-22', NULL, NULL),
('CZ', 'República Checa;Czechia;Česká republika', NULL, '2017-02-22', NULL, NULL),
('DE', 'Alemania;Germany;Deutschland', NULL, '2017-02-22', NULL, NULL),
('DJ', 'Yibuti;Djibouti;Djibouti/جيبوتي ', NULL, '2017-02-22', NULL, NULL),
('DK', 'Dinamarca;Denmark; Danmark', NULL, '2017-02-22', NULL, NULL),
('DM', 'Domínica;Dominica;Dominica', NULL, '2017-02-22', NULL, NULL),
('DO', 'República Dominicana;Dominican Republic;República Dominicana', NULL, '2017-02-22', NULL, NULL),
('DZ', 'Argelia;Algeria;الجزائر', NULL, '2017-02-22', NULL, NULL),
('EC', 'Ecuador;Ecuador;Ecuador', NULL, '2017-02-22', NULL, NULL),
('EE', 'Estonia;Estonia;Eesti Vabariik)', NULL, '2017-02-22', NULL, NULL),
('EG', 'Egipto;Egypt;جمهوريّة مصرالعربيّة ', NULL, '2017-02-22', NULL, NULL),
('EH', 'Sahara Occidental;Western Sahara;Western Sahara', NULL, '2017-02-22', NULL, NULL),
('ER', 'Eritrea;Eritrea;Eritrea', NULL, '2017-02-22', NULL, NULL),
('ES', 'España;Spain;España', NULL, '2017-02-22', NULL, NULL),
('ET', 'Etiopía;Ethiopia;ኢትዮጵያ', NULL, '2017-02-22', NULL, NULL),
('FI', 'Finlandia;Finland;Finland /Suomi', NULL, '2017-02-22', NULL, NULL),
('FJ', 'Fiji;Fiji;Fiji/Matanitu ko Viti,', NULL, '2017-02-22', NULL, NULL),
('FK', 'Islas Malvinas;Falkland Islands (Malvinas);Falkland Islands', NULL, '2017-02-22', NULL, NULL),
('FM', 'Micronesia;Micronesia;Micronesia', NULL, '2017-02-22', NULL, NULL),
('FO', 'Islas Faroe;Faroe Islands;Føroyar/Færøerne', NULL, '2017-02-22', NULL, NULL),
('FR', 'Francia;France;France', NULL, '2017-02-22', NULL, NULL),
('GA', 'Gabón;Gabon;Gabon', NULL, '2017-02-22', NULL, NULL),
('GB', 'Reino Unido;United Kingdom of Great Britain and Northern Ireland;United Kingdom of Great Britain and Northern Ireland', NULL, '2017-02-22', NULL, NULL),
('GD', 'Granada;Grenada;Grenada', NULL, '2017-02-22', NULL, NULL),
('GE', 'Georgia;Georgia;საქართველო', NULL, '2017-02-22', NULL, NULL),
('GF', 'Guayana Francesa;French Guiana;Guyane française', NULL, '2017-02-22', NULL, NULL),
('GG', 'Guernsey;Guernsey;Guernsey', NULL, '2017-02-22', NULL, NULL),
('GH', 'Ghana;Ghana;Ghana', NULL, '2017-02-22', NULL, NULL),
('GI', 'Gibraltar;Gibraltar;Gibraltar', NULL, '2017-02-22', NULL, NULL),
('GL', 'Groenlandia;Greenland;Kalaallit Nunaat/Grønland', NULL, '2017-02-22', NULL, NULL),
('GM', 'Gambia;Gambia;Gambia/جمهورية غامبيا', NULL, '2017-02-22', NULL, NULL),
('GN', 'Guinea;Guinea;République de Guinée)', NULL, '2017-02-22', NULL, NULL),
('GP', 'Guadalupe;Guadeloupe;Guadeloupe', NULL, '2017-02-22', NULL, NULL),
('GQ', 'Guinea Ecuatorial;Equatorial Guinea;Guinea Ecuatorial', NULL, '2017-02-22', NULL, NULL),
('GR', 'Grecia;Greece;Ελληνική Δημοκρατία', NULL, '2017-02-22', NULL, NULL),
('GS', 'Georgia del Sur e Islas Sandwich del Sur;South Georgia and the South Sandwich Islands;Georgia del Sur e Islas Sandwich del Sur', NULL, '2017-02-22', NULL, NULL),
('GT', 'Guatemala;Guatemala;Guatemala', NULL, '2017-02-22', NULL, NULL),
('GU', 'Guam;Guam;Guam/Guåhån', NULL, '2017-02-22', NULL, NULL),
('GW', 'Guinea-Bissau;Guinea-Bissau;República da Guiné-Bissau', NULL, '2017-02-22', NULL, NULL),
('GY', 'Guyana;Guyana;Guyana', NULL, '2017-02-22', NULL, NULL),
('HK', 'Hong Kong;Hong Kong;中華人民共和國香港特別行政區', NULL, '2017-02-22', NULL, NULL),
('HM', 'Islas Heard y McDonald;Heard Island and McDonald Islands;Heard Island and McDonald Islands', NULL, '2017-02-22', NULL, NULL),
('HN', 'Honduras;Honduras;Honduras', NULL, '2017-02-22', NULL, NULL),
('HR', 'Croacia;Croatia;Republika Hrvatska', NULL, '2017-02-22', NULL, NULL),
('HT', 'Haití;Haiti;République d''Haïti (Repiblik d’Ayiti)', NULL, '2017-02-22', NULL, NULL),
('HU', 'Hungría;Hungary;Magyarország', NULL, '2017-02-22', NULL, NULL),
('ID', 'Indonesia;Indonesia;Indonesia', NULL, '2017-02-22', NULL, NULL),
('IE', 'Irlanda;Ireland;Éire (Ireland)', NULL, '2017-02-22', NULL, NULL),
('IL', 'Israel;Israel;מְדִינַת יִשְרָאֵל / دولة إِسرائيل ', NULL, '2017-02-22', NULL, NULL),
('IM', 'Isla de Man;Isle of Man;Ellan Vannin (Isle of Man)', NULL, '2017-02-22', NULL, NULL),
('IN', 'India;India;भारत गणराज्य', NULL, '2017-02-22', NULL, NULL),
('IO', 'Territorio Británico del Océano Índico;British Indian Ocean Territory;British Indian Ocean Territory', NULL, '2017-02-22', NULL, NULL),
('IQ', 'Irak;Iraq;العراق', NULL, '2017-02-22', NULL, NULL),
('IR', 'Irán;Iran;جمهوری اسلامی ایران', NULL, '2017-02-22', NULL, NULL),
('IS', 'Islandia;Iceland;Ísland', NULL, '2017-02-22', NULL, NULL),
('IT', 'Italia;Italy;Repubblica Italiana', NULL, '2017-02-22', NULL, NULL),
('JE', 'Jersey;Jersey;Jersey', NULL, '2017-02-22', NULL, NULL),
('JM', 'Jamaica;Jamaica;Jamaica', NULL, '2017-02-22', NULL, NULL),
('JO', 'Jordania;Jordan;الأردنّ', NULL, '2017-02-22', NULL, NULL),
('JP', 'Japón;Japan;日本, ', NULL, '2017-02-22', NULL, NULL),
('KE', 'Kenia;Kenya;Jamhuri Ya Kenya (Kenya)', NULL, '2017-02-22', NULL, NULL),
('KG', 'Kirguistán;Kyrgyzstan;Kyrgyzstan', NULL, '2017-02-22', NULL, NULL),
('KH', 'Camboya;Cambodia;ព្រះរាជាណាចក្រកម្ពុជា', NULL, '2017-02-22', NULL, NULL),
('KI', 'Kiribati;Kiribati;Kiribati', NULL, '2017-02-22', NULL, NULL),
('KM', 'Comoras;Comoros', NULL, '2017-02-22', NULL, NULL),
('KN', 'San Cristóbal y Nieves;Saint Kitts and Nevis;Saint Kitts and Nevis', NULL, '2017-02-22', NULL, NULL),
('KP', 'Corea del Norte;North Korea;조선민주주의인민공화국', NULL, '2017-02-22', NULL, NULL),
('KR', 'Corea del Sur;South Korea;대한민국', NULL, '2017-02-22', NULL, NULL),
('KW', 'Kuwait;Kuwait;دولة الكويت', NULL, '2017-02-22', NULL, NULL),
('KY', 'Islas Caimán;Cayman Islands;Cayman Islands', NULL, '2017-02-22', NULL, NULL),
('KZ', 'Kazajstán;Kazakhstan;Қазақстан/Казахстан', NULL, '2017-02-22', NULL, NULL),
('LA', 'Laos;Lao People''s Democratic Republic;ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ', NULL, '2017-02-22', NULL, NULL),
('LB', 'Líbano;Lebanon;الجمهورية اللبنانية', NULL, '2017-02-22', NULL, NULL),
('LC', 'Santa Lucía;Saint Lucia;Saint Lucia', NULL, '2017-02-22', NULL, NULL),
('LI', 'Liechtenstein;Liechtenstein;Fürstentum Liechtenstein', NULL, '2017-02-22', NULL, NULL),
('LK', 'Sri Lanka;Sri Lanka;ශ්‍රී ලංකා ප්‍රජාතාන්ත්‍රික සමාජවාදී ජනරජය', NULL, '2017-02-22', NULL, NULL),
('LR', 'Liberia;Liberia;Liberia', NULL, '2017-02-22', NULL, NULL),
('LS', 'Lesotho;Lesotho;Lesotho/ Muso oa Lesotho', NULL, '2017-02-22', NULL, NULL),
('LT', 'Lituania;Lithuania;Lietuvos Respublika', NULL, '2017-02-22', NULL, NULL),
('LU', 'Luxemburgo;Luxembourg;Groussherzogtum Lëtzebuerg/Grand-Duché de Luxembourg/Großherzogtum Luxemburg', NULL, '2017-02-22', NULL, NULL),
('LV', 'Letonia;Latvia;Latvijas Republika/Латви́йская Респу́блика', NULL, '2017-02-22', NULL, NULL),
('LY', 'Libia;Libya/دولة ليبيا', NULL, '2017-02-22', NULL, NULL),
('MA', 'Marruecos;Morocco;المملكة المغربية', NULL, '2017-02-22', NULL, NULL),
('MC', 'Mónaco;Monaco;Principauté de Monaco', NULL, '2017-02-22', NULL, NULL),
('MD', 'Moldova;Moldova;Republica Moldova', NULL, '2017-02-22', NULL, NULL),
('ME', 'Montenegro;Montenegro;Црна Гора', NULL, '2017-02-22', NULL, NULL),
('MG', 'Madagascar;Madagascar;Repoblikan''i Madagasikara/République de Madagascar', NULL, '2017-02-22', NULL, NULL),
('MH', 'Islas Marshall;Marshall Islands;Aolepān Aorōkin M̧ajeļ/Republic of the Marshall Islands', NULL, '2017-02-22', NULL, NULL),
('MK', 'Macedonia;Macedonia;Република Македонија', NULL, '2017-02-22', NULL, NULL),
('ML', 'Mali;Mali;Mali', NULL, '2017-02-22', NULL, NULL),
('MM', 'Myanmar;Myanmar;Pyidaungsu Myanma Naingngandaw', NULL, '2017-02-22', NULL, NULL),
('MN', 'Mongolia;Mongolia;Монгол Улс', NULL, '2017-02-22', NULL, NULL),
('MO', 'Macao;Macao;Macau', NULL, '2017-02-22', NULL, NULL),
('MQ', 'Martinica;Martinique;Martinique', NULL, '2017-02-22', NULL, NULL),
('MR', 'Mauritania;Mauritania;الجمهورية الإسلامية الموريتانية', NULL, '2017-02-22', NULL, NULL),
('MS', 'Montserrat;Montserrat;Montserrat', NULL, '2017-02-22', NULL, NULL),
('MT', 'Malta;Malta;Malta', NULL, '2017-02-22', NULL, NULL),
('MU', 'Mauricio;Mauritania;Republic of Mauritius/République de Maurice/Repiblik Moris', NULL, '2017-02-22', NULL, NULL),
('MV', 'Maldivas;Maldives;ދިވެހިރާއްޖޭގެ ޖުމުހޫރިއްޔާ', NULL, '2017-02-22', NULL, NULL),
('MW', 'Malawi;Malawi;Malawi', NULL, '2017-02-22', NULL, NULL),
('MX', 'México;Mexico;México', NULL, '2017-02-22', NULL, NULL),
('MY', 'Malasia;Malaysia;Malaysia', NULL, '2017-02-22', NULL, NULL),
('MZ', 'Mozambique;Mozambique;República de Moçambique', NULL, '2017-02-22', NULL, NULL),
('NA', 'Namibia;Namibia;Namibia', NULL, '2017-02-22', NULL, NULL),
('NC', 'Nueva Caledonia;New Caledonia;Nouvelle-Calédonie', NULL, '2017-02-22', NULL, NULL),
('NE', 'Níger;Niger;Niger', NULL, '2017-02-22', NULL, NULL),
('NF', 'Islas Norkfolk;Norfolk Island;Norfolk Island', NULL, '2017-02-22', NULL, NULL),
('NG', 'Nigeria;Nigeria;Nigeria', NULL, '2017-02-22', NULL, NULL),
('NI', 'Nicaragua;Nicaragua;Nicaragua', NULL, '2017-02-22', NULL, NULL),
('NL', 'Países Bajos;Nederland;Nederland', NULL, '2017-02-22', NULL, NULL),
('NO', 'Noruega;Norway;Norge/Nynorsk', NULL, '2017-02-22', NULL, NULL),
('NP', 'Nepal;Nepal;संघीय लोकतान्त्रिक गणतन्त्र नेपाल', NULL, '2017-02-22', NULL, NULL),
('NR', 'Nauru;Nauru;Nauru', NULL, '2017-02-22', NULL, NULL),
('NU', 'Niue;Niue;Niue', NULL, '2017-02-22', NULL, NULL),
('NZ', 'Nueva Zelanda;New Zealand;New Zealand', NULL, '2017-02-22', NULL, NULL),
('OM', 'Omán;Oman;سلطانة عمان‎', NULL, '2017-02-22', NULL, NULL),
('PA', 'Panamá;Panama;Panamá', NULL, '2017-02-22', NULL, NULL),
('PE', 'Perú;Peru;Perú', NULL, '2017-02-22', NULL, NULL),
('PF', 'Polinesia Francesa;French Polynesia;Polynésie Française', NULL, '2017-02-22', NULL, NULL),
('PG', 'Papúa Nueva Guinea;Papua New Guinea;Papua New Guinea', NULL, '2017-02-22', NULL, NULL),
('PH', 'Filipinas;Philippines;Republika ng Pilipinas (Philippines)', NULL, '2017-02-22', NULL, NULL),
('PK', 'Pakistán;Pakistan;اسلامی جمہوریۂ پاکستان', NULL, '2017-02-22', NULL, NULL),
('PL', 'Polonia;Poland;Polska', NULL, '2017-02-22', NULL, NULL),
('PM', 'San Pedro y Miquelón;Saint Pierre and Miquelon;Saint-Pierre-et-Miquelon', NULL, '2017-02-22', NULL, NULL),
('PN', 'Islas Pitcairn;Pitcairn Islands;Pitcairn Islands', NULL, '2017-02-22', NULL, NULL),
('PR', 'Puerto Rico;Puerto Rico;Puerto Rico', NULL, '2017-02-22', NULL, NULL),
('PS', 'Palestina;Palestine;دولة فلسطين', NULL, '2017-02-22', NULL, NULL),
('PT', 'Portugal;Portugal;Portugal', NULL, '2017-02-22', NULL, NULL),
('PW', 'Islas Palaos;Palau;Beluu er a Belau/Republic of Palau/パラオ共和国', NULL, '2017-02-22', NULL, NULL),
('PY', 'Paraguay;Paraguay;Paraguay', NULL, '2017-02-22', NULL, NULL),
('QA', 'Qatar;Qatar;دولة قطر\n', NULL, '2017-02-22', NULL, NULL),
('RE', 'Reunión;Reunion;Reunion', NULL, '2017-02-22', NULL, NULL),
('RO', 'Rumanía;Romania;România', NULL, '2017-02-22', NULL, NULL),
('RS', 'Serbia y Montenegro;Serbia and Montenegro;Државна Заједница Србија и Црна Гора/Državna zajednica Srbija i Crna Gora', NULL, '2017-02-22', NULL, NULL),
('RU', 'Rusia;Russia;Российская Федерация', NULL, '2017-02-22', NULL, NULL),
('RW', 'Ruanda;Rwanda;Repubulika y''u Rwanda/République du Rwanda/Republic of Rwanda/Jamhuri ya Rwanda', NULL, '2017-02-22', NULL, NULL),
('SA', 'Arabia Saudita;Saudi Arabia;المملكة العربية السعودية', NULL, '2017-02-22', NULL, NULL),
('SB', 'Islas Solomón;Solomon Islands;Solomon Islands', NULL, '2017-02-22', NULL, NULL),
('SC', 'Seychelles;Seychelles;Seychelles', NULL, '2017-02-22', NULL, NULL),
('SD', 'Sudán;Sudan;جمهورية السودان', NULL, '2017-02-22', NULL, NULL),
('SE', 'Suecia;Sweden;Konungariket Sverige', NULL, '2017-02-22', NULL, NULL),
('SG', 'Singapur;Singapore;Singapore', NULL, '2017-02-22', NULL, NULL),
('SH', 'Santa Elena;Saint Helena;Saint Helena,', NULL, '2017-02-22', NULL, NULL),
('SI', 'Eslovenia;Slovenia;Republika Slovenija', NULL, '2017-02-22', NULL, NULL),
('SJ', 'Islas Svalbard y Jan Mayen;Svalbard and Jan Mayen;Svalbard and Jan Mayen', NULL, '2017-02-22', NULL, NULL),
('SK', 'Eslovaquia;Slovakia;Slovenská republika', NULL, '2017-02-22', NULL, NULL),
('SL', 'Sierra Leona;Sierra Leone;Sierra Leone', NULL, '2017-02-22', NULL, NULL),
('SM', 'San Marino;San Marino;Serenissima Repubblica di San Marino', NULL, '2017-02-22', NULL, NULL),
('SN', 'Senegal;Senegal;République du Sénégal', NULL, '2017-02-22', NULL, NULL),
('SO', 'Somalia;Somalia;Soomaaliya/الصومال', NULL, '2017-02-22', NULL, NULL),
('SR', 'Surinam;Suriname;Suriname', NULL, '2017-02-22', NULL, NULL),
('ST', 'Santo Tomé y Príncipe;Saint Tome and Principe;República Democrática de São Tomé e Príncipe', NULL, '2017-02-22', NULL, NULL),
('SV', 'El Salvador;El Salvador;El Salvador', NULL, '2017-02-22', NULL, NULL),
('SY', 'Siria;Syrian Arab Republic;الجمهورية العربية السورية', NULL, '2017-02-22', NULL, NULL),
('SZ', 'Suazilandia;Swaziland;Umbuso weSwatini/Kingdom of Swaziland', NULL, '2017-02-22', NULL, NULL),
('TC', 'Islas Turcas y Caicos;Turks and Caicos Islands;Turks and Caicos Islands', NULL, '2017-02-22', NULL, NULL),
('TD', 'Chad;Chad;Tchad/تشاد', NULL, '2017-02-22', NULL, NULL),
('TF', 'Territorios Australes Franceses;	French Southern Territories;Terres australes et antarctiques française', NULL, '2017-02-22', NULL, NULL),
('TG', 'Togo;Togo;Togo', NULL, '2017-02-22', NULL, NULL),
('TH', 'Tailandia;Thailand;ราชอาณาจักรไทย', NULL, '2017-02-22', NULL, NULL),
('TJ', 'Tayikistán;Tajikistan;Ҷумҳурии Тоҷикистон/Республика Таджикистан', NULL, '2017-02-22', NULL, NULL),
('TK', 'Tokelau;Tokelau;Tokelau', NULL, '2017-02-22', NULL, NULL),
('TL', 'Timor-Leste;Timor-Leste;Timor-Leste', NULL, '2017-02-22', NULL, NULL),
('TM', 'Turkmenistán;Turkmenistan;Türkmenistan Respublikasy', NULL, '2017-02-22', NULL, NULL),
('TN', 'Túnez;Tunisia;الجمهورية التونسية', NULL, '2017-02-22', NULL, NULL),
('TO', 'Tonga;Tonga;Pule''anga Fakatu''i ''o Tonga', NULL, '2017-02-22', NULL, NULL),
('TR', 'Turquía;Turkey;Türkiye', NULL, '2017-02-22', NULL, NULL),
('TT', 'Trinidad y Tobago;Trinidad and Tobago;Trinidad and Tobago', NULL, '2017-02-22', NULL, NULL),
('TV', 'Tuvalu;Tuvalu;Tuvalu', NULL, '2017-02-22', NULL, NULL),
('TW', 'Taiwán;Taiwan;中華民國', NULL, '2017-02-22', NULL, NULL),
('UA', 'Ucrania;Ukraine;Україна', NULL, '2017-02-22', NULL, NULL),
('UG', 'Uganda;Uganda;Uganda', NULL, '2017-02-22', NULL, NULL),
('US', 'Estados Unidos de América;United States of America;United States of America', NULL, '2017-02-22', NULL, NULL),
('UY', 'Uruguay;Uruguay;Uruguay', NULL, '2017-02-22', NULL, NULL),
('UZ', 'Uzbekistán;Uzbekistan;Ўзбекистон Республикаси', NULL, '2017-02-22', NULL, NULL),
('VA', 'Ciudad del Vaticano;Holy See;tatus Civitatis Vaticanæ/Stato della Città del Vaticano', NULL, '2017-02-22', NULL, NULL),
('VC', 'San Vicente y las Granadinas;Saint Vincent and the Grenadines;Saint Vincent and the Grenadines', NULL, '2017-02-22', NULL, NULL),
('VE', 'Venezuela;Venezuela;Venezuela', NULL, '2017-02-22', NULL, NULL),
('VG', 'Islas Vírgenes Británicas;British Virigin Islands;British Virigin Islands', NULL, '2017-02-22', NULL, NULL),
('VI', 'Islas Vírgenes de los Estados Unidos de América;Virgin Islands;Virgin Islands', NULL, '2017-02-22', NULL, NULL),
('VN', 'Vietnam;Vietnam;Cộng hòa Xã hội chủ nghĩa Việt Nam', NULL, '2017-02-22', NULL, NULL),
('VU', 'Vanuatu;Vanuatu;Vanuatu', NULL, '2017-02-22', NULL, NULL),
('WF', 'Wallis y Futuna;Wallis and Futuna;Collectivité de Wallis et Futuna', NULL, '2017-02-22', NULL, NULL),
('WS', 'Samoa;Samoa;Samoa', NULL, '2017-02-22', NULL, NULL),
('YE', 'Yemen;Yemen;الجمهوريّة اليمنية', NULL, '2017-02-22', NULL, NULL),
('YT', 'Mayotte;Mayotte;Mayotte', NULL, '2017-02-22', NULL, NULL),
('ZA', 'Sudáfrica;South Africa;South Africa', NULL, '2017-02-22', NULL, NULL);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pais_idioma`
--

CREATE TABLE IF NOT EXISTS `tbl_pais_idioma` (
  `id_pais_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  `id_idioma_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_pais_fk`,`id_idioma_fk`),
  KEY `fk_tbl_pais_has_tbl_idioma_tbl_idioma1_idx` (`id_idioma_fk`),
  KEY `fk_tbl_pais_has_tbl_idioma_tbl_pais1_idx` (`id_pais_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_pais_idioma`
--

INSERT INTO `tbl_pais_idioma` (`id_pais_fk`, `id_idioma_fk`) VALUES
('NA', 'af'),
('ZA', 'af'),
('ET', 'am'),
('AE', 'ar'),
('BH', 'ar'),
('DJ', 'ar'),
('DZ', 'ar'),
('EG', 'ar'),
('EH', 'ar'),
('ER', 'ar'),
('IL', 'ar'),
('IQ', 'ar'),
('JO', 'ar'),
('KM', 'ar'),
('KW', 'ar'),
('LB', 'ar'),
('LY', 'ar'),
('MA', 'ar'),
('MR', 'ar'),
('OM', 'ar'),
('PS', 'ar'),
('QA', 'ar'),
('SA', 'ar'),
('SD', 'ar'),
('SY', 'ar'),
('TD', 'ar'),
('TN', 'ar'),
('YE', 'ar'),
('AZ', 'az'),
('BG', 'bg'),
('VU', 'bi'),
('WF', 'bi'),
('BD', 'bn'),
('BA', 'bs'),
('AD', 'ca'),
('GU', 'ch'),
('CZ', 'cs'),
('DK', 'da'),
('FO', 'da'),
('AT', 'de'),
('BE', 'de'),
('CH', 'de'),
('DE', 'de'),
('LI', 'de'),
('LU', 'de'),
('NA', 'de'),
('MV', 'dv'),
('BT', 'dz'),
('CY', 'el'),
('GR', 'el'),
('AE', 'en'),
('AG', 'en'),
('AI', 'en'),
('AN', 'en'),
('AS', 'en'),
('AU', 'en'),
('BB', 'en'),
('BM', 'en'),
('BS', 'en'),
('BW', 'en'),
('BZ', 'en'),
('CA', 'en'),
('CC', 'en'),
('CK', 'en'),
('CM', 'en'),
('CX', 'en'),
('DM', 'en'),
('ER', 'en'),
('FJ', 'en'),
('FK', 'en'),
('FM', 'en'),
('GB', 'en'),
('GD', 'en'),
('GG', 'en'),
('GH', 'en'),
('GI', 'en'),
('GM', 'en'),
('GS', 'en'),
('GU', 'en'),
('GY', 'en'),
('HK', 'en'),
('HM', 'en'),
('IE', 'en'),
('IM', 'en'),
('IN', 'en'),
('IO', 'en'),
('JE', 'en'),
('JM', 'en'),
('KE', 'en'),
('KI', 'en'),
('KN', 'en'),
('KY', 'en'),
('LC', 'en'),
('LR', 'en'),
('LS', 'en'),
('MH', 'en'),
('MS', 'en'),
('MT', 'en'),
('MU', 'en'),
('MW', 'en'),
('MY', 'en'),
('NF', 'en'),
('NG', 'en'),
('NR', 'en'),
('NU', 'en'),
('NZ', 'en'),
('PG', 'en'),
('PH', 'en'),
('PK', 'en'),
('PN', 'en'),
('PR', 'en'),
('PW', 'en'),
('RW', 'en'),
('SB', 'en'),
('SC', 'en'),
('SD', 'en'),
('SG', 'en'),
('SH', 'en'),
('SL', 'en'),
('SZ', 'en'),
('TC', 'en'),
('TK', 'en'),
('TO', 'en'),
('TT', 'en'),
('TV', 'en'),
('UG', 'en'),
('US', 'en'),
('VC', 'en'),
('VG', 'en'),
('VI', 'en'),
('VU', 'en'),
('WF', 'en'),
('WS', 'en'),
('ZA', 'en'),
('AR', 'es'),
('BO', 'es'),
('CL', 'es'),
('CO', 'es'),
('CR', 'es'),
('CU', 'es'),
('DO', 'es'),
('EC', 'es'),
('EH', 'es'),
('ES', 'es'),
('GQ', 'es'),
('GT', 'es'),
('HN', 'es'),
('MX', 'es'),
('NI', 'es'),
('PA', 'es'),
('PE', 'es'),
('PR', 'es'),
('PY', 'es'),
('SV', 'es'),
('UY', 'es'),
('VE', 'es'),
('EE', 'et'),
('AF', 'fa'),
('IR', 'fa'),
('FI', 'fi'),
('FJ', 'fj'),
('DK', 'fo'),
('FO', 'fo'),
('BE', 'fr'),
('BF', 'fr'),
('BJ', 'fr'),
('BL', 'fr'),
('CA', 'fr'),
('CF', 'fr'),
('CG', 'fr'),
('CH', 'fr'),
('CI', 'fr'),
('CM', 'fr'),
('DJ', 'fr'),
('FR', 'fr'),
('GA', 'fr'),
('GF', 'fr'),
('GG', 'fr'),
('GN', 'fr'),
('GP', 'fr'),
('GQ', 'fr'),
('HT', 'fr'),
('JE', 'fr'),
('KM', 'fr'),
('LB', 'fr'),
('LU', 'fr'),
('MC', 'fr'),
('MG', 'fr'),
('MQ', 'fr'),
('NC', 'fr'),
('NE', 'fr'),
('PF', 'fr'),
('PM', 'fr'),
('RE', 'fr'),
('RW', 'fr'),
('SC', 'fr'),
('SN', 'fr'),
('TD', 'fr'),
('TF', 'fr'),
('TG', 'fr'),
('VU', 'fr'),
('WF', 'fr'),
('YT', 'fr'),
('PY', 'gn'),
('IM', 'gv'),
('IL', 'he'),
('IN', 'hi'),
('BA', 'hr'),
('HR', 'hr'),
('HU', 'hu'),
('AM', 'hy'),
('ID', 'id'),
('IS', 'is'),
('CH', 'it'),
('IT', 'it'),
('SM', 'it'),
('VA', 'it'),
('JP', 'ja'),
('PW', 'ja'),
('GE', 'ka'),
('KZ', 'kk'),
('DK', 'kl'),
('GL', 'kl'),
('KH', 'km'),
('KP', 'ko'),
('KR', 'ko'),
('KG', 'ky'),
('VA', 'la'),
('LU', 'lb'),
('CG', 'ln'),
('LA', 'lo'),
('LT', 'lt'),
('LV', 'lv'),
('MG', 'mg'),
('MH', 'mh'),
('MK', 'mk'),
('MN', 'mn'),
('BN', 'ms'),
('CC', 'ms'),
('MY', 'ms'),
('SG', 'ms'),
('MT', 'mt'),
('MM', 'my'),
('NR', 'na'),
('NU', 'na'),
('NP', 'ne'),
('AN', 'nl'),
('AW', 'nl'),
('BE', 'nl'),
('NL', 'nl'),
('SR', 'nl'),
('BV', 'no'),
('NO', 'no'),
('SJ', 'no'),
('MW', 'ny'),
('PL', 'pl'),
('AF', 'ps'),
('AO', 'pt'),
('BR', 'pt'),
('CV', 'pt'),
('GQ', 'pt'),
('GW', 'pt'),
('MO', 'pt'),
('MU', 'pt'),
('MZ', 'pt'),
('PT', 'pt'),
('ST', 'pt'),
('TL', 'pt'),
('CH', 'rm'),
('MD', 'ro'),
('RO', 'ro'),
('BY', 'ru'),
('KG', 'ru'),
('KZ', 'ru'),
('LK', 'ru'),
('RU', 'ru'),
('UZ', 'ru'),
('CF', 'sg'),
('LK', 'si'),
('SK', 'sk'),
('SI', 'sl'),
('AS', 'sm'),
('TK', 'sm'),
('WS', 'sm'),
('ML', 'so'),
('SO', 'so'),
('AL', 'sq'),
('BA', 'sr'),
('RS', 'sr'),
('SZ', 'ss'),
('LS', 'st'),
('AX', 'sv'),
('FI', 'sv'),
('SE', 'sv'),
('KE', 'sw'),
('KM', 'sw'),
('UG', 'sw'),
('TO', 'to'),
('CY', 'tr'),
('TR', 'tr'),
('PF', 'ty'),
('UA', 'uk'),
('PK', 'ur'),
('VN', 'vi'),
('CN', 'zh'),
('SG', 'zh'),
('TW', 'zh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_patrocinador`
--

CREATE TABLE IF NOT EXISTS `tbl_patrocinador` (
  `id_patrocinador_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_patrocinador` mediumtext COLLATE utf8_bin NOT NULL,
  `url` longtext COLLATE utf8_bin,
  `id_persona_contacto` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_bin,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `id_tipo_institucion_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_patrocinador_pk`),
  KEY `fk_tbl_patrocinador_tbl_persona1_idx` (`id_persona_contacto`),
  KEY `fk_tbl_patrocinador_tbl_tipo_institucion1_idx` (`id_tipo_institucion_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perfiles`
--

CREATE TABLE IF NOT EXISTS `tbl_perfiles` (
  `id_perfil_pk` int(11) NOT NULL,
  `id_usuario_congreso_roles_fk` int(11) NOT NULL,
  `resumen_bibliografico` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `certificado` tinyint(1) DEFAULT NULL,
  `codigo` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `institucion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_perfil_pk`),
  KEY `fk_tbl_perfiles_tbl_usuario_congreso_roles1_idx` (`id_usuario_congreso_roles_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE IF NOT EXISTS `tbl_persona` (
  `id_persona_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada persona.',
  `primer_nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `segundo_nombre` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `primer_apellido` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `segundo_apellido` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `identificacion` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'N�mero de identificaci�n usado por cada persona en el proceso de registro.',
  `id_tipo_persona_fk` int(11) NOT NULL,
  `id_tipo_alimentacion_fk` int(11) NOT NULL,
  `id_tipo_identificacion_fk` int(11) NOT NULL,
  `id_pais_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_persona_pk`),
  KEY `fk_tbl_persona_tbl_tipo_persona2_idx` (`id_tipo_persona_fk`),
  KEY `fk_tbl_persona_tbl_tipo_alimentacion1_idx` (`id_tipo_alimentacion_fk`),
  KEY `fk_tbl_persona_tbl_tipo_identificacion1_idx` (`id_tipo_identificacion_fk`),
  KEY `fk_tbl_persona_tbl_pais1_idx` (`id_pais_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_institucion`
--

CREATE TABLE IF NOT EXISTS `tbl_persona_institucion` (
  `id_persona_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL,
  `trabaja` tinyint(1) DEFAULT NULL,
  `cargo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_persona_fk`,`id_institucion_fk`),
  KEY `fk_tbl_persona_has_tbl_institucion_tbl_institucion1_idx` (`id_institucion_fk`),
  KEY `fk_tbl_persona_has_tbl_institucion_tbl_persona1_idx` (`id_persona_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_red_social`
--

CREATE TABLE IF NOT EXISTS `tbl_persona_red_social` (
  `id_persona_pk` int(11) NOT NULL,
  `id_red_social_pk` int(11) NOT NULL,
  PRIMARY KEY (`id_persona_pk`,`id_red_social_pk`),
  KEY `fk_tbl_persona_has_tbl_red_social_tbl_red_social1_idx` (`id_red_social_pk`),
  KEY `fk_tbl_persona_has_tbl_red_social_tbl_persona1_idx` (`id_persona_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_titulo`
--

CREATE TABLE IF NOT EXISTS `tbl_persona_titulo` (
  `id_persona_fk` int(11) NOT NULL,
  `id_titulo_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_persona_fk`,`id_titulo_fk`),
  KEY `fk_tbl_persona_has_tbl_titulo_tbl_titulo1_idx` (`id_titulo_fk`),
  KEY `fk_tbl_persona_has_tbl_titulo_tbl_persona1_idx` (`id_persona_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pregunta_cualitativa`
--

CREATE TABLE IF NOT EXISTS `tbl_pregunta_cualitativa` (
  `id_pregunta_cualitativa_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pregunta_cualitativa` longtext COLLATE utf8_bin,
  `id_formulario_fk` int(11) NOT NULL,
  `id_tipo_pregunta_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_pregunta_cualitativa_pk`),
  KEY `fk_tbl_preguntas_cualitativas_tbl_formulario1_idx` (`id_formulario_fk`),
  KEY `fk_tbl_preguntas_cualitativas_tbl_tipo_pregunta1_idx` (`id_tipo_pregunta_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pregunta_cuantitativa`
--

CREATE TABLE IF NOT EXISTS `tbl_pregunta_cuantitativa` (
  `id_pregunta_cuantitativa_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pregunta_cuantitativa` longtext COLLATE utf8_bin,
  `ponderacion` int(11) DEFAULT NULL,
  `id_formulario_fk` int(11) NOT NULL,
  `id_tipo_pregunta_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_pregunta_cuantitativa_pk`),
  KEY `fk_tbl_preguntas_cuantitativas_tbl_formulario1_idx` (`id_formulario_fk`),
  KEY `fk_tbl_preguntas_cuantitativas_tbl_tipo_pregunta1_idx` (`id_tipo_pregunta_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio`
--

CREATE TABLE IF NOT EXISTS `tbl_premio` (
  `id_premio_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico dado a cada premio',
  `nombre_premio` mediumtext COLLATE utf8_bin NOT NULL,
  `id_tematica_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''tbl_tematica'' y que asocia cada premio con una tem�tica espec�fica.',
  PRIMARY KEY (`id_premio_pk`),
  KEY `fk_tbl_premio_tbl_tematica1_idx` (`id_tematica_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio_patrocinador`
--

CREATE TABLE IF NOT EXISTS `tbl_premio_patrocinador` (
  `id_premio_fk` int(11) NOT NULL,
  `id_patrocinador_fk` int(11) NOT NULL,
  `persona` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el premio fue patrocinado por una persona u instituci�n.',
  `institucion` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el premio fue patrocinado por una persona u instituci�n.',
  PRIMARY KEY (`id_premio_fk`,`id_patrocinador_fk`),
  KEY `fk_tbl_premio_has_tbl_patrocinador_tbl_patrocinador1_idx` (`id_patrocinador_fk`),
  KEY `fk_tbl_premio_has_tbl_patrocinador_tbl_premio1_idx` (`id_premio_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio_trabajo`
--

CREATE TABLE IF NOT EXISTS `tbl_premio_trabajo` (
  `id_premio_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_premio_fk`,`id_trabajo_fk`),
  KEY `fk_tbl_premio_has_tbl_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`),
  KEY `fk_tbl_premio_has_tbl_trabajo_tbl_premio1_idx` (`id_premio_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa`
--

CREATE TABLE IF NOT EXISTS `tbl_programa` (
  `id_programa_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_programa` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_bin,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_programa_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_programa_actividad` (
  `id_programa_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_programa_fk`,`id_actividad_fk`),
  KEY `fk_tbl_programa_has_tbl_actividad_tbl_actividad1_idx` (`id_actividad_fk`),
  KEY `fk_tbl_programa_has_tbl_actividad_tbl_programa1_idx` (`id_programa_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rango`
--

CREATE TABLE IF NOT EXISTS `tbl_rango` (
  `id_rango_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rango` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  PRIMARY KEY (`id_rango_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_red_social`
--

CREATE TABLE IF NOT EXISTS `tbl_red_social` (
  `id_red_social_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_red_social` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_red_social_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_cualitativa`
--

CREATE TABLE IF NOT EXISTS `tbl_respuesta_cualitativa` (
  `id_respuesta_cualitativa_pk` int(11) NOT NULL AUTO_INCREMENT,
  `respuesta_cualitativa` longtext COLLATE utf8_bin,
  `id_pregunta_cualitativa_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_respuesta_cualitativa_pk`),
  KEY `fk_tbl_respuestas_cualitativas_tbl_preguntas_cualitativas1_idx` (`id_pregunta_cualitativa_fk`),
  KEY `fk_tbl_respuestas_cualitativas_tbl_trabajo1_idx` (`id_trabajo_fk`),
  KEY `fk_tbl_respuestas_cualitativas_tbl_usuario1_idx` (`id_usuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_cuantitativa`
--

CREATE TABLE IF NOT EXISTS `tbl_respuesta_cuantitativa` (
  `id_respuesta_cuantitativa_pk` int(11) NOT NULL AUTO_INCREMENT,
  `respuesta_cuantitativa` int(11) DEFAULT NULL,
  `id_pregunta_cuantitativa_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `tbl_usuario_id_usuario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_respuesta_cuantitativa_pk`),
  KEY `fk_tbl_respuestas_cuantitativas_tbl_preguntas_cuantitativas_idx` (`id_pregunta_cuantitativa_fk`),
  KEY `fk_tbl_respuestas_cuantitativas_tbl_trabajo1_idx` (`id_trabajo_fk`),
  KEY `fk_tbl_respuestas_cuantitativas_tbl_usuario1_idx` (`tbl_usuario_id_usuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_mensaje`
--

CREATE TABLE IF NOT EXISTS `tbl_respuesta_mensaje` (
  `id_respuesta_mensaje_pk` int(11) NOT NULL AUTO_INCREMENT,
  `contenido_respuesta_mensaje` text COLLATE utf8_bin,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_mensaje_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_respuesta_mensaje_pk`),
  KEY `fk_tbl_respuesta_publicacion_tbl_publicacion1_idx` (`id_mensaje_fk`),
  KEY `fk_tbl_respuesta_publicacion_tbl_usuario1_idx` (`id_usuario_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id_rol_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada rol dentro del sistema',
  `nombre_rol` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre dado a cada rol que puede tener cada usuario, por ejemplo: administrador, editor, asistente, etc. (Cada usuario puede tener uno o m�s roles por congreso)',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_rol_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles_congreso`
--

CREATE TABLE IF NOT EXISTS `tbl_roles_congreso` (
  `tbl_rol_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para la indexaci�n de �sta tabla.''',
  `id_rol_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''tbl_rol''',
  `id_congreso_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''tbl_congresol''',
  PRIMARY KEY (`tbl_rol_congreso_pk`,`id_rol_fk`,`id_congreso_fk`),
  KEY `fk_tbl_roles_has_tbl_congreso_tbl_congreso1_idx` (`id_congreso_fk`),
  KEY `fk_tbl_roles_has_tbl_congreso_tbl_roles1_idx` (`id_rol_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rtn`
--

CREATE TABLE IF NOT EXISTS `tbl_rtn` (
  `id_rtn_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para el ''RTN'' de cada individuo, persona u empresa con obligaciones tributarias hacia el Estado.',
  `empresa` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para identificar si el individuo en cuesti�n es una empresa.',
  `persona` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para identificar si el individuo en cuesti�n es una persona.',
  `identificador` int(11) DEFAULT NULL COMMENT 'Este es un tipo de idenificador, aunque no este relacionado, se guardara en el un id de referencia del tipo persona u empresa.',
  PRIMARY KEY (`id_rtn_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tarea_voluntario`
--

CREATE TABLE IF NOT EXISTS `tbl_tarea_voluntario` (
  `id_tarea_voluntario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada tarea asociada a un voluntario. Ojo, �ste campo no surje de la indexaci�n porque esta no es una tabla transaccional, sino m�s bien la descripci�n de tareas que se asocian a los voluntarios.',
  `nombre_tarea` longtext COLLATE utf8_bin,
  `descripcion` longtext COLLATE utf8_bin,
  `ubicacion_complementario` mediumtext COLLATE utf8_bin,
  `comentarios` mediumtext COLLATE utf8_bin,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  `fecha_tarea` date DEFAULT NULL,
  `hora_tarea` time DEFAULT NULL,
  PRIMARY KEY (`id_tarea_voluntario_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_telefono`
--

CREATE TABLE IF NOT EXISTS `tbl_telefono` (
  `id_telefono_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada n�mero de tel�fono',
  `numero_telefono` int(11) DEFAULT NULL COMMENT 'Aqu� se almacenar� ca da n�mero telef�nico',
  `id_persona_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''persona'' y que sirve para asociar cada n�mero telef�nica a una persona en espec�fico.',
  `principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para determinar si el numero telef�nico en cuesti�n es o no el n�mero principal de la persona.',
  PRIMARY KEY (`id_telefono_pk`),
  KEY `fk_tbl_telefono_Persona1_idx` (`id_persona_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tematica`
--

CREATE TABLE IF NOT EXISTS `tbl_tematica` (
  `id_tematica_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico dado a cada tipo de tem�tica.',
  `nombre_tematica` mediumtext COLLATE utf8_bin NOT NULL COMMENT 'Nombre dado a cada tem�tica creada',
  `id_linea_investigacion_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''tbl_linea_investigacion'' y que asocia dentro de esta tabla cada tem�tica a una l�nea de investigaci�n espec�fica.',
  `descripcion_tematica` mediumtext COLLATE utf8_bin,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tematica_pk`),
  KEY `fk_tbl_tematica_tbl_linea_investigacion_idx` (`id_linea_investigacion_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_actividad` (
  `id_tipo_actividad_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_actividad` mediumtext COLLATE utf8_bin,
  PRIMARY KEY (`id_tipo_actividad_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_alimentacion`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_alimentacion` (
  `id_tipo_alimentacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada tipo de alimentaci�n',
  `nombre_tipo_alimentacion` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre del tipo de alimentaci�n, puede ser vegetariana, vegana, habitual, etc.',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tipo_alimentacion_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_dictamen`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_dictamen` (
  `id_tipo_dictamen_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_dictamen` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_tipo_dictamen_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_estadistica`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_estadistica` (
  `id_tipo_estadistica_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_estadistica` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `tbl_tipo_estadisticacol` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_tipo_estadistica_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_identificacion`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_identificacion` (
  `id_tipo_identificacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada tipo de identificaci�n que ser� usado por cada usuario.',
  `nombre_tipo_identificacion` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre u descripci�n dada a cada tipo de usuario-',
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tipo_identificacion_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_institucion`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_institucion` (
  `id_tipo_institucion_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_institucion` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tipo_institucion_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_logs`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_logs` (
  `id_tipo_log_pk` int(11) NOT NULL,
  `tipo_log` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_tipo_log_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_persona`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_persona` (
  `id_tipo_persona_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_persona` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tipo_persona_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_pregunta`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_pregunta` (
  `id_tipo_pregunta_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_pregunta` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tipo_pregunta_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_trabajo`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_trabajo` (
  `id_tipo_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_trabajo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `numero_maximo_autores` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenar� el id del usuario que efectuar� la creaci�n o modificaci�n respectiva a est tabla. N�tese que estos campos no est�n relacionados como llave for�nea a ninguna tabla, pero se establecer� la relaci�n a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  `numero_maximo_palabras_clave` int(11) DEFAULT NULL,
  `numero_maximo_palabras_resumen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_trabajo_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_usuario` (
  `id_tipo_usuario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada tipo de usuario.',
  `nombre_tipo_usuario` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre dado a cada tipo de usuario dentro del sistema como por ejemplo super usuario.',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_titulo`
--

CREATE TABLE IF NOT EXISTS `tbl_titulo` (
  `id_titulo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_titulo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_nivel_educativo_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_titulo_pk`),
  KEY `fk_tbl_titulo_tbl_nivel_educativo1_idx` (`id_nivel_educativo_fk`),
  KEY `fk_tbl_titulo_tbl_carrera1_idx` (`id_carrera_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour`
--

CREATE TABLE IF NOT EXISTS `tbl_tour` (
  `id_tour_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada tour creado',
  `nombre_tour` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` mediumtext COLLATE utf8_bin COMMENT 'Descripci�n general del tour, aqu� pueden ir datos de inter�s para dicho tour.',
  `comentario` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT 'Alg�n dato clave que pueda ser de utilidad',
  `costo` double DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  PRIMARY KEY (`id_tour_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour_institucion`
--

CREATE TABLE IF NOT EXISTS `tbl_tour_institucion` (
  `id_tour_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_tour_fk`,`id_institucion_fk`),
  KEY `fk_tbl_tour_has_tbl_institucion_tbl_institucion1_idx` (`id_institucion_fk`),
  KEY `fk_tbl_tour_has_tbl_institucion_tbl_tour1_idx` (`id_tour_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_tour_usuario` (
  `id_tour_usuario_pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_tour_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_tour_usuario_pk`,`id_tour_fk`,`id_usuario_fk`),
  KEY `fk_tbl_tour_has_tbl_usuario_tbl_usuario1_idx` (`id_usuario_fk`),
  KEY `fk_tbl_tour_has_tbl_usuario_tbl_tour1_idx` (`id_tour_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_trabajo`
--

CREATE TABLE IF NOT EXISTS `tbl_trabajo` (
  `id_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_trabajo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `fecha_subida` date DEFAULT NULL,
  `ubicacion_archivo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `resumen` longtext COLLATE utf8_bin COMMENT 'Un resumen que reduce en s�ntesis de lo que se trata el trabajo.',
  `id_estado_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL COMMENT 'Identificador for�neo a la tabla ''tbl_tematica'' y que define una tem�tica espec�fica para cada trabajo.',
  `id_citacion_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''tbl_citacion'' y define para cada trabajo una citaci�n espec�fica.',
  `premio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina si el trabajo es calificado para premio o revista',
  `revista` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina si el trabajo es calificado para premio o revista',
  `horario_sugerido` time DEFAULT NULL COMMENT 'Es el horario en el cual al usuario le gustar�a presentar su trabajo (no necesariamente en el cual se va a presentar, ya que depende del programa).',
  `id_tipo_trabajo_fk` int(11) NOT NULL,
  `id_idioma_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  `palabrasclave` mediumtext COLLATE utf8_bin,
  `resumenprograma` mediumtext COLLATE utf8_bin,
  PRIMARY KEY (`id_trabajo_pk`,`id_citacion_fk`),
  KEY `fk_tbl_trabajo_tbl_estado1_idx` (`id_estado_fk`),
  KEY `fk_tbl_trabajo_tbl_tematica1_idx` (`id_tematica_fk`),
  KEY `fk_tbl_trabajo_tbl_citacion1_idx` (`id_citacion_fk`),
  KEY `fk_tbl_trabajo_tbl_tipo_trabajo1_idx` (`id_tipo_trabajo_fk`),
  KEY `fk_tbl_trabajo_tbl_idioma1_idx` (`id_idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_trabajo_tematica`
--

CREATE TABLE IF NOT EXISTS `tbl_trabajo_tematica` (
  `id_trabajo_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL,
  `principal` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_trabajo_fk`,`id_tematica_fk`),
  KEY `fk_tbl_trabajo_has_tbl_tematica_tbl_tematica1_idx` (`id_tematica_fk`),
  KEY `fk_tbl_trabajo_has_tbl_tematica_tbl_trabajo1_idx` (`id_trabajo_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id_usuario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico para cada usuario.',
  `nombre_usuario` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nick de usuario usado por cada persona para logearse en el sistema',
  `contrasena` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Contrase�a que junto con el nombre_usuario (Nick) controlan el login',
  `id_persona_fk` int(11) NOT NULL COMMENT 'Identificador �nico de persona, es una llave forn�nea que hace referencia a la tabla persona que contiene los datos generales de cada individuo.',
  `id_idioma_fk` varchar(2) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_usuario_pk`),
  KEY `fk_tbl_usuario_Persona1_idx` (`id_persona_fk`),
  KEY `fk_tbl_usuario_tbl_idioma1_idx` (`id_idioma_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_actividad_congreso`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario_actividad_congreso` (
  `id_usuario_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_congreso_fk` int(11) NOT NULL,
  `asistio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleando que determina si un usuario asisiti� o no a una actividad espec�fica para un congreso dado.',
  PRIMARY KEY (`id_usuario_fk`,`id_actividad_fk`),
  KEY `fk_tbl_usuario_has_tbl_actividad_tbl_actividad1_idx` (`id_actividad_fk`),
  KEY `fk_tbl_usuario_has_tbl_actividad_tbl_usuario1_idx` (`id_usuario_fk`),
  KEY `fk_tbl_usuario_has_tbl_actividad_tbl_congreso1_idx` (`id_congreso_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_congreso_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario_congreso_roles` (
  `tbl_usuario_congreso_rol_pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_fk` int(11) NOT NULL,
  `id_rol_congreso_fk` int(11) NOT NULL,
  `asistira` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para determinar si el usuario asistir� o no al congreso indicado.',
  PRIMARY KEY (`tbl_usuario_congreso_rol_pk`),
  KEY `fk_tbl_usuario_has_tbl_congreso_tbl_usuario1_idx` (`id_usuario_fk`),
  KEY `fk_tbl_usuario_congreso_roles_tbl_roles_congreso1_idx` (`id_rol_congreso_fk`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_congreso_roles_modulos_acciones`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario_congreso_roles_modulos_acciones` (
  `id_usuario_congreso_rol_fk` int(11) NOT NULL COMMENT 'Identificador que surje de la indexaci�n de la tabla ''tbl_usuario_congreso_rol'', es una llave for�nea que hace referencia a la tabla antes mencionada',
  `id_modulo_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''tbl_modulo'', sirve para identificar al m�dulo al cual se estableceran los accesos que tendr� el usuario.',
  `insertar` tinyint(1) NOT NULL COMMENT 'Campo booleano para definir si el usuario tendr� o no acceso a insertar dentro del sistema.',
  `modificar` tinyint(1) NOT NULL COMMENT 'Campo booleano para definir si el usuario tendr� o no acceso a modificar dentro del sistema.',
  `eliminar` tinyint(1) NOT NULL COMMENT 'Campo booleano para definir si el usuario tendr� o no acceso a eliminar dentro del sistema.',
  PRIMARY KEY (`id_usuario_congreso_rol_fk`,`id_modulo_fk`),
  KEY `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_modulos1_idx` (`id_modulo_fk`),
  KEY `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_usuario_c_idx` (`id_usuario_congreso_rol_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_firma_certificado`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario_firma_certificado` (
  `id_certificado_pk` int(11) NOT NULL,
  `id_persona_pk` int(11) NOT NULL,
  `url_firma` mediumtext COLLATE utf8_bin NOT NULL COMMENT 'Tabla en la que se almacenan las personan que firman un certificado con su respectiva direcci�n de la firma digital.',
  PRIMARY KEY (`id_certificado_pk`,`id_persona_pk`),
  KEY `fk_tbl_usuario_firma_certificado_tbl_certificados1_idx` (`id_certificado_pk`),
  KEY `fk_tbl_usuario_firma_certificado_tbl_persona1_idx` (`id_persona_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario_tipo_usuario` (
  `id_usuario_fk` int(11) NOT NULL,
  `id_tipo_usuario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario_fk`,`id_tipo_usuario_fk`),
  KEY `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_tipo_usuario1_idx` (`id_tipo_usuario_fk`),
  KEY `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_usuario1_idx` (`id_usuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_trabajo`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario_trabajo` (
  `id_usuario_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `subio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuesti�n fue quien subi� el archivo.',
  `autor_principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuesti�n es el autor principal del trabajo.',
  `coautor` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuesti�n es el co-autor principal del trabajo.',
  `expositor` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuesti�n es el expositor del trabajo.',
  `autoria` tinyint(1) DEFAULT NULL COMMENT 'Campo autoria: \nAlmacena 0(cero) por defecto cuando se vinculaun trabajo a un usuario.\nAlmacena 1(uno) cuando la autoria fue aceptada por el usuario.\nAlmacena 2 (dos) cuando la autoria fue rechazada por el usuario.',
  PRIMARY KEY (`id_usuario_trabajo_pk`,`id_usuario_fk`,`id_trabajo_fk`),
  KEY `fk_tbl_usuario_has_tbl_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`),
  KEY `fk_tbl_usuario_has_tbl_trabajo_tbl_usuario1_idx` (`id_usuario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_version_trabajo`
--

CREATE TABLE IF NOT EXISTS `tbl_version_trabajo` (
  `id_version_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `ubicacion_archivo` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `version_editor_gestor` tinyint(1) DEFAULT NULL,
  `version_aprobado_conrevision` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_usuario_que_subio_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `fecha_subida` date DEFAULT NULL,
  PRIMARY KEY (`id_version_trabajo_pk`),
  KEY `fk_tbl_version_trabajo_tbl_usuario1_idx` (`id_usuario_que_subio_fk`),
  KEY `fk_tbl_version_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_voluntario`
--

CREATE TABLE IF NOT EXISTS `tbl_voluntario` (
  `id_voluntario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador �nico asociado a cada voluntario',
  `numero_horas` double DEFAULT NULL,
  `comentarios` mediumtext COLLATE utf8_bin,
  `estado` tinyint(1) DEFAULT NULL,
  `id_rol_congreso_fk` int(11) NOT NULL COMMENT 'Identificador for�neo que hace referencia a la tabla ''tbl_rol_congreso'' y que sirve para identificar el rol y el congreso del voluntario en cuesti�n.',
  PRIMARY KEY (`id_voluntario_pk`),
  KEY `fk_tbl_voluntario_tbl_roles_congreso1_idx` (`id_rol_congreso_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_voluntario_tarea_voluntario`
--

CREATE TABLE IF NOT EXISTS `tbl_voluntario_tarea_voluntario` (
  `id_voluntario_fk` int(11) NOT NULL,
  `id_tarea_voluntario_fk` int(11) NOT NULL,
  PRIMARY KEY (`id_voluntario_fk`,`id_tarea_voluntario_fk`),
  KEY `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_tarea_volunt_idx` (`id_tarea_voluntario_fk`),
  KEY `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_voluntario1_idx` (`id_voluntario_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_actividad`
--
ALTER TABLE `tbl_actividad`
  ADD CONSTRAINT `fk_tbl_actividad_tbl_espacio1` FOREIGN KEY (`id_espacio_pk`) REFERENCES `tbl_espacio` (`id_espacio_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_actividad_tbl_tipo_actividad1` FOREIGN KEY (`id_tipo_actividad_fk`) REFERENCES `tbl_tipo_actividad` (`id_tipo_actividad_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_actividad_tematica`
--
ALTER TABLE `tbl_actividad_tematica`
  ADD CONSTRAINT `fk_tbl_actividad_has_tbl_tematica_tbl_actividad1` FOREIGN KEY (`id_actividad_fk`) REFERENCES `tbl_actividad` (`id_actividad_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_actividad_has_tbl_tematica_tbl_tematica1` FOREIGN KEY (`id_tematica_fk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_actividad_trabajo`
--
ALTER TABLE `tbl_actividad_trabajo`
  ADD CONSTRAINT `fk_tbl_actividad_has_tbl_trabajo_tbl_actividad1` FOREIGN KEY (`id_actividad_fk`) REFERENCES `tbl_actividad` (`id_actividad_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_actividad_has_tbl_trabajo_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_archivo_complementario`
--
ALTER TABLE `tbl_archivo_complementario`
  ADD CONSTRAINT `fk_tbl_archivos_complementarios_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_asignacion_a_revisor`
--
ALTER TABLE `tbl_asignacion_a_revisor`
  ADD CONSTRAINT `fk_tbl_asignacion_a_revisores_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_asignacion_a_revisor_tbl_tipo_dictamen1` FOREIGN KEY (`id_tipo_dictamen_fk`) REFERENCES `tbl_tipo_dictamen` (`id_tipo_dictamen_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_asignacion_editor_seccion_secundario`
--
ALTER TABLE `tbl_asignacion_editor_seccion_secundario`
  ADD CONSTRAINT `fk_tbl_asignacion_editor_seccion_secundario_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_centros`
--
ALTER TABLE `tbl_centros`
  ADD CONSTRAINT `fk_tbl_centros_tbl_institucion1` FOREIGN KEY (`id_institucion_fk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_congreso`
--
ALTER TABLE `tbl_congreso`
  ADD CONSTRAINT `fk_tbl_congreso_tbl_estado_congreso1` FOREIGN KEY (`id_estado_congreso_fk`) REFERENCES `tbl_estado_congreso` (`id_estado_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_tbl_pais1` FOREIGN KEY (`id_pais_fk`) REFERENCES `tbl_pais` (`id_pais_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_congreso_actividad`
--
ALTER TABLE `tbl_congreso_actividad`
  ADD CONSTRAINT `fk_tbl_congreso_actividad_tbl_linea_investigacion1` FOREIGN KEY (`id_linea_investigacion_pk`) REFERENCES `tbl_linea_investigacion` (`id_linea_investigacion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_actividad_tbl_actividad1` FOREIGN KEY (`id_actividad_fk`) REFERENCES `tbl_actividad` (`id_actividad_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_actividad_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_congreso_linea_investigacion`
--
ALTER TABLE `tbl_congreso_linea_investigacion`
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_linea_investigacion_tbl_congreso1` FOREIGN KEY (`id_congreso_pk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_linea_investigacion_tbl_linea_investi1` FOREIGN KEY (`id_linea_investigacion_pk`) REFERENCES `tbl_linea_investigacion` (`id_linea_investigacion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_congreso_patrocinador`
--
ALTER TABLE `tbl_congreso_patrocinador`
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_patrocinador_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_patrocinador_tbl_patrocinador1` FOREIGN KEY (`id_patrocinador_fk`) REFERENCES `tbl_patrocinador` (`id_patrocinador_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_congreso_rol_tematicas`
--
ALTER TABLE `tbl_congreso_rol_tematicas`
  ADD CONSTRAINT `fk_tbl_congreso_rol_tematicas_tbl_tematica1` FOREIGN KEY (`id_tematica_fk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_rol_tematicas_tbl_usuario_congreso_roles1` FOREIGN KEY (`id_usuario_congreso_roles_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_correo`
--
ALTER TABLE `tbl_correo`
  ADD CONSTRAINT `fk_tbl_correo_tbl_persona1` FOREIGN KEY (`id_persona_fk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_costo`
--
ALTER TABLE `tbl_costo`
  ADD CONSTRAINT `fk_tbl_costo_tbl_roles_congreso1` FOREIGN KEY (`id_rol_congreso_fk`) REFERENCES `tbl_roles_congreso` (`tbl_rol_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_espacio_congreso`
--
ALTER TABLE `tbl_espacio_congreso`
  ADD CONSTRAINT `fk_tbl_espacio_has_tbl_congreso_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_espacio_has_tbl_congreso_tbl_espacio1` FOREIGN KEY (`id_espacio_fk`) REFERENCES `tbl_espacio` (`id_espacio_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_estadistica`
--
ALTER TABLE `tbl_estadistica`
  ADD CONSTRAINT `fk_tbl_estadistica_tbl_tipo_estadistica1` FOREIGN KEY (`id_tipo_estadistica_fk`) REFERENCES `tbl_tipo_estadistica` (`id_tipo_estadistica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_factura`
--
ALTER TABLE `tbl_factura`
  ADD CONSTRAINT `fk_tbl_factura_tbl_rango1` FOREIGN KEY (`id_rango_pk`) REFERENCES `tbl_rango` (`id_rango_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_factura_detalle`
--
ALTER TABLE `tbl_factura_detalle`
  ADD CONSTRAINT `fk_tbl_factura_detalle_tbl_tour_usuario1` FOREIGN KEY (`id_tour_usuario_fk`) REFERENCES `tbl_tour_usuario` (`id_tour_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_factura_has_tbl_costo_usuario_tbl_factura1` FOREIGN KEY (`id_factura_fk`) REFERENCES `tbl_factura` (`id_factura_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_formulario_tematica`
--
ALTER TABLE `tbl_formulario_tematica`
  ADD CONSTRAINT `fk_tbl_formulario_has_tbl_tematica_tbl_formulario1` FOREIGN KEY (`id_formulario_fk`) REFERENCES `tbl_formulario` (`id_formulario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_formulario_has_tbl_tematica_tbl_tematica1` FOREIGN KEY (`id_tematica_fk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_idiomas_personas`
--
ALTER TABLE `tbl_idiomas_personas`
  ADD CONSTRAINT `fk_tbl_idiomas_usuarios_tbl_idioma1` FOREIGN KEY (`id_idioma_fk`) REFERENCES `tbl_idioma` (`id_idioma_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_idiomas_usuarios_tbl_persona1` FOREIGN KEY (`id_persona_pk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_institucion`
--
ALTER TABLE `tbl_institucion`
  ADD CONSTRAINT `fk_tbl_institucion_tbl_pais1` FOREIGN KEY (`id_pais_fk`) REFERENCES `tbl_pais` (`id_pais_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_institucion_tbl_tipo_institucion1` FOREIGN KEY (`id_tipo_institucion_fk`) REFERENCES `tbl_tipo_institucion` (`id_tipo_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_institucion_carrera`
--
ALTER TABLE `tbl_institucion_carrera`
  ADD CONSTRAINT `fk_tbl_institucion_has_tbl_carrera_tbl_carrera1` FOREIGN KEY (`id_carrera_fk`) REFERENCES `tbl_carrera` (`id_carrera_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_institucion_has_tbl_carrera_tbl_institucion1` FOREIGN KEY (`id_institucion_fk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_institucion_facultad`
--
ALTER TABLE `tbl_institucion_facultad`
  ADD CONSTRAINT `fk_tbl_institucion_facultad_tbl_carrera1` FOREIGN KEY (`id_carrera_fk`) REFERENCES `tbl_carrera` (`id_carrera_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_institucion_has_tbl_facultad_tbl_facultad1` FOREIGN KEY (`id_facultad_fk`) REFERENCES `tbl_facultad` (`id_facultad_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_institucion_has_tbl_facultad_tbl_institucion1` FOREIGN KEY (`id_institucion_fk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD CONSTRAINT `fk_tbl_log_tbl_tipo_logs1` FOREIGN KEY (`id_tipo_log_fk`) REFERENCES `tbl_tipo_logs` (`id_tipo_log_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_log_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_mensaje`
--
ALTER TABLE `tbl_mensaje`
  ADD CONSTRAINT `fk_tbl_publicacion_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_noticia`
--
ALTER TABLE `tbl_noticia`
  ADD CONSTRAINT `fk_tbl_noticia_tbl_usuario_congreso_roles1` FOREIGN KEY (`id_usuario_congreso_rol_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_notificacion`
--
ALTER TABLE `tbl_notificacion`
  ADD CONSTRAINT `fk_tbl_notificacion_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_organizadores`
--
ALTER TABLE `tbl_organizadores`
  ADD CONSTRAINT `fk_tbl_organizadores_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_organizadores_tbl_institucion1` FOREIGN KEY (`id_institucion_fk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pais_idioma`
--
ALTER TABLE `tbl_pais_idioma`
  ADD CONSTRAINT `fk_tbl_pais_has_tbl_idioma_tbl_idioma1` FOREIGN KEY (`id_idioma_fk`) REFERENCES `tbl_idioma` (`id_idioma_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_pais_has_tbl_idioma_tbl_pais1` FOREIGN KEY (`id_pais_fk`) REFERENCES `tbl_pais` (`id_pais_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_patrocinador`
--
ALTER TABLE `tbl_patrocinador`
  ADD CONSTRAINT `fk_tbl_patrocinador_tbl_persona1` FOREIGN KEY (`id_persona_contacto`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_patrocinador_tbl_tipo_institucion1` FOREIGN KEY (`id_tipo_institucion_fk`) REFERENCES `tbl_tipo_institucion` (`id_tipo_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_perfiles`
--
ALTER TABLE `tbl_perfiles`
  ADD CONSTRAINT `fk_tbl_perfiles_tbl_usuario_congreso_roles1` FOREIGN KEY (`id_usuario_congreso_roles_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD CONSTRAINT `fk_tbl_persona_tbl_pais1` FOREIGN KEY (`id_pais_fk`) REFERENCES `tbl_pais` (`id_pais_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_tbl_tipo_alimentacion1` FOREIGN KEY (`id_tipo_alimentacion_fk`) REFERENCES `tbl_tipo_alimentacion` (`id_tipo_alimentacion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_tbl_tipo_identificacion1` FOREIGN KEY (`id_tipo_identificacion_fk`) REFERENCES `tbl_tipo_identificacion` (`id_tipo_identificacion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_tbl_tipo_persona2` FOREIGN KEY (`id_tipo_persona_fk`) REFERENCES `tbl_tipo_persona` (`id_tipo_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona_institucion`
--
ALTER TABLE `tbl_persona_institucion`
  ADD CONSTRAINT `fk_tbl_persona_has_tbl_institucion_tbl_institucion1` FOREIGN KEY (`id_institucion_fk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_has_tbl_institucion_tbl_persona1` FOREIGN KEY (`id_persona_fk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona_red_social`
--
ALTER TABLE `tbl_persona_red_social`
  ADD CONSTRAINT `fk_tbl_persona_has_tbl_red_social_tbl_persona1` FOREIGN KEY (`id_persona_pk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_has_tbl_red_social_tbl_red_social1` FOREIGN KEY (`id_red_social_pk`) REFERENCES `tbl_red_social` (`id_red_social_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona_titulo`
--
ALTER TABLE `tbl_persona_titulo`
  ADD CONSTRAINT `fk_tbl_persona_has_tbl_titulo_tbl_persona1` FOREIGN KEY (`id_persona_fk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_has_tbl_titulo_tbl_titulo1` FOREIGN KEY (`id_titulo_fk`) REFERENCES `tbl_titulo` (`id_titulo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pregunta_cualitativa`
--
ALTER TABLE `tbl_pregunta_cualitativa`
  ADD CONSTRAINT `fk_tbl_preguntas_cualitativas_tbl_formulario1` FOREIGN KEY (`id_formulario_fk`) REFERENCES `tbl_formulario` (`id_formulario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_preguntas_cualitativas_tbl_tipo_pregunta1` FOREIGN KEY (`id_tipo_pregunta_fk`) REFERENCES `tbl_tipo_pregunta` (`id_tipo_pregunta_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pregunta_cuantitativa`
--
ALTER TABLE `tbl_pregunta_cuantitativa`
  ADD CONSTRAINT `fk_tbl_preguntas_cuantitativas_tbl_formulario1` FOREIGN KEY (`id_formulario_fk`) REFERENCES `tbl_formulario` (`id_formulario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_preguntas_cuantitativas_tbl_tipo_pregunta1` FOREIGN KEY (`id_tipo_pregunta_fk`) REFERENCES `tbl_tipo_pregunta` (`id_tipo_pregunta_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_premio`
--
ALTER TABLE `tbl_premio`
  ADD CONSTRAINT `fk_tbl_premio_tbl_tematica1` FOREIGN KEY (`id_tematica_fk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_premio_patrocinador`
--
ALTER TABLE `tbl_premio_patrocinador`
  ADD CONSTRAINT `fk_tbl_premio_has_tbl_patrocinador_tbl_patrocinador1` FOREIGN KEY (`id_patrocinador_fk`) REFERENCES `tbl_patrocinador` (`id_patrocinador_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_premio_has_tbl_patrocinador_tbl_premio1` FOREIGN KEY (`id_premio_fk`) REFERENCES `tbl_premio` (`id_premio_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_premio_trabajo`
--
ALTER TABLE `tbl_premio_trabajo`
  ADD CONSTRAINT `fk_tbl_premio_has_tbl_trabajo_tbl_premio1` FOREIGN KEY (`id_premio_fk`) REFERENCES `tbl_premio` (`id_premio_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_premio_has_tbl_trabajo_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_programa_actividad`
--
ALTER TABLE `tbl_programa_actividad`
  ADD CONSTRAINT `fk_tbl_programa_has_tbl_actividad_tbl_actividad1` FOREIGN KEY (`id_actividad_fk`) REFERENCES `tbl_actividad` (`id_actividad_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_programa_has_tbl_actividad_tbl_programa1` FOREIGN KEY (`id_programa_fk`) REFERENCES `tbl_programa` (`id_programa_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_respuesta_cualitativa`
--
ALTER TABLE `tbl_respuesta_cualitativa`
  ADD CONSTRAINT `fk_tbl_respuestas_cualitativas_tbl_preguntas_cualitativas1` FOREIGN KEY (`id_pregunta_cualitativa_fk`) REFERENCES `tbl_pregunta_cualitativa` (`id_pregunta_cualitativa_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_respuestas_cualitativas_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_respuestas_cualitativas_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_respuesta_cuantitativa`
--
ALTER TABLE `tbl_respuesta_cuantitativa`
  ADD CONSTRAINT `fk_tbl_respuestas_cuantitativas_tbl_preguntas_cuantitativas1` FOREIGN KEY (`id_pregunta_cuantitativa_fk`) REFERENCES `tbl_pregunta_cuantitativa` (`id_pregunta_cuantitativa_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_respuestas_cuantitativas_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_respuestas_cuantitativas_tbl_usuario1` FOREIGN KEY (`tbl_usuario_id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_respuesta_mensaje`
--
ALTER TABLE `tbl_respuesta_mensaje`
  ADD CONSTRAINT `fk_tbl_respuesta_publicacion_tbl_publicacion1` FOREIGN KEY (`id_mensaje_fk`) REFERENCES `tbl_mensaje` (`id_mensaje_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_respuesta_publicacion_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_roles_congreso`
--
ALTER TABLE `tbl_roles_congreso`
  ADD CONSTRAINT `fk_tbl_roles_has_tbl_congreso_tbl_roles1` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_roles` (`id_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_roles_has_tbl_congreso_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  ADD CONSTRAINT `fk_tbl_telefono_Persona1` FOREIGN KEY (`id_persona_fk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_tematica`
--
ALTER TABLE `tbl_tematica`
  ADD CONSTRAINT `fk_tbl_tematica_tbl_linea_investigacion` FOREIGN KEY (`id_linea_investigacion_fk`) REFERENCES `tbl_linea_investigacion` (`id_linea_investigacion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_titulo`
--
ALTER TABLE `tbl_titulo`
  ADD CONSTRAINT `fk_tbl_titulo_tbl_carrera1` FOREIGN KEY (`id_carrera_fk`) REFERENCES `tbl_carrera` (`id_carrera_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_titulo_tbl_nivel_educativo1` FOREIGN KEY (`id_nivel_educativo_fk`) REFERENCES `tbl_nivel_educativo` (`id_nivel_educativo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_tour_institucion`
--
ALTER TABLE `tbl_tour_institucion`
  ADD CONSTRAINT `fk_tbl_tour_has_tbl_institucion_tbl_institucion1` FOREIGN KEY (`id_institucion_fk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_tour_has_tbl_institucion_tbl_tour1` FOREIGN KEY (`id_tour_fk`) REFERENCES `tbl_tour` (`id_tour_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_tour_usuario`
--
ALTER TABLE `tbl_tour_usuario`
  ADD CONSTRAINT `fk_tbl_tour_has_tbl_usuario_tbl_tour1` FOREIGN KEY (`id_tour_fk`) REFERENCES `tbl_tour` (`id_tour_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_tour_has_tbl_usuario_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_trabajo`
--
ALTER TABLE `tbl_trabajo`
  ADD CONSTRAINT `fk_tbl_trabajo_tbl_citacion1` FOREIGN KEY (`id_citacion_fk`) REFERENCES `tbl_citacion` (`id_citacion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_trabajo_tbl_estado1` FOREIGN KEY (`id_estado_fk`) REFERENCES `tbl_estado` (`id_estado_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_trabajo_tbl_idioma1` FOREIGN KEY (`id_idioma_fk`) REFERENCES `tbl_idioma` (`id_idioma_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_trabajo_tbl_tematica1` FOREIGN KEY (`id_tematica_fk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_trabajo_tbl_tipo_trabajo1` FOREIGN KEY (`id_tipo_trabajo_fk`) REFERENCES `tbl_tipo_trabajo` (`id_tipo_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_trabajo_tematica`
--
ALTER TABLE `tbl_trabajo_tematica`
  ADD CONSTRAINT `fk_tbl_trabajo_has_tbl_tematica_tbl_tematica1` FOREIGN KEY (`id_tematica_fk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_trabajo_has_tbl_tematica_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_tbl_usuario_Persona1` FOREIGN KEY (`id_persona_fk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_tbl_idioma1` FOREIGN KEY (`id_idioma_fk`) REFERENCES `tbl_idioma` (`id_idioma_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_actividad_congreso`
--
ALTER TABLE `tbl_usuario_actividad_congreso`
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_actividad_tbl_actividad1` FOREIGN KEY (`id_actividad_fk`) REFERENCES `tbl_actividad` (`id_actividad_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_actividad_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_actividad_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_congreso_roles`
--
ALTER TABLE `tbl_usuario_congreso_roles`
  ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_tbl_roles_congreso1` FOREIGN KEY (`id_rol_congreso_fk`) REFERENCES `tbl_roles_congreso` (`tbl_rol_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_congreso_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_congreso_roles_modulos_acciones`
--
ALTER TABLE `tbl_usuario_congreso_roles_modulos_acciones`
  ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_modulos1` FOREIGN KEY (`id_modulo_fk`) REFERENCES `tbl_modulos` (`id_modulo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_usuario_con1` FOREIGN KEY (`id_usuario_congreso_rol_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_firma_certificado`
--
ALTER TABLE `tbl_usuario_firma_certificado`
  ADD CONSTRAINT `fk_tbl_usuario_firma_certificado_tbl_certificados1` FOREIGN KEY (`id_certificado_pk`) REFERENCES `tbl_certificados` (`id_certificado_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_firma_certificado_tbl_persona1` FOREIGN KEY (`id_persona_pk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_tipo_usuario`
--
ALTER TABLE `tbl_usuario_tipo_usuario`
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_tipo_usuario1` FOREIGN KEY (`id_tipo_usuario_fk`) REFERENCES `tbl_tipo_usuario` (`id_tipo_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_trabajo`
--
ALTER TABLE `tbl_usuario_trabajo`
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_trabajo_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_trabajo_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_version_trabajo`
--
ALTER TABLE `tbl_version_trabajo`
  ADD CONSTRAINT `fk_tbl_version_trabajo_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_version_trabajo_tbl_usuario1` FOREIGN KEY (`id_usuario_que_subio_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_voluntario`
--
ALTER TABLE `tbl_voluntario`
  ADD CONSTRAINT `fk_tbl_voluntario_tbl_roles_congreso1` FOREIGN KEY (`id_rol_congreso_fk`) REFERENCES `tbl_roles_congreso` (`tbl_rol_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_voluntario_tarea_voluntario`
--
ALTER TABLE `tbl_voluntario_tarea_voluntario`
  ADD CONSTRAINT `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_tarea_voluntar1` FOREIGN KEY (`id_tarea_voluntario_fk`) REFERENCES `tbl_tarea_voluntario` (`id_tarea_voluntario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_voluntario1` FOREIGN KEY (`id_voluntario_fk`) REFERENCES `tbl_voluntario` (`id_voluntario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
