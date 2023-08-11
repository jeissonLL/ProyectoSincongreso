-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2017 a las 21:32:34
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbcongresoceat`
--
CREATE DATABASE IF NOT EXISTS `dbcongresoceat` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `dbcongresoceat`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad`
--

CREATE TABLE `tbl_actividad` (
  `id_actividad_pk` int(11) NOT NULL,
  `nombre_actividad` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `presento` tinyint(1) DEFAULT NULL COMMENT 'Este campo booleano sirve para determinar si el trabajo se presentó o no en la actividad.',
  `id_tipo_actividad_fk` int(11) NOT NULL,
  `id_espacio_pk` int(11) NOT NULL,
  `fecha_actividad` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_tematica`
--

CREATE TABLE `tbl_actividad_tematica` (
  `id_actividad_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Cuando se crea una actividad puede asociarse a una o más lineas de investigación, a su vez; al pertenecer a una línea de investigación, puede estar asociada a todas o algunas de las temáticas concernientes a ésa línea, como cada temática está asociada a una línea de investigación, basta con asociar actividad con temática para obtener los tres datos y tener la libertad de asociar a ''actividad'' con una o más ''temáticas'' y a su vez ''líneas de investigación''.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_trabajo`
--

CREATE TABLE `tbl_actividad_trabajo` (
  `id_actividad_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivo_complementario`
--

CREATE TABLE `tbl_archivo_complementario` (
  `id_archivo_complementario_pk` int(11) NOT NULL,
  `nombre_archivo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8,
  `ubicacion_archivo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignacion_a_revisor`
--

CREATE TABLE `tbl_asignacion_a_revisor` (
  `id_asignacion_a_revisor_pk` int(11) NOT NULL,
  `pendiente_aceptacion` tinyint(1) DEFAULT NULL,
  `aceptado` tinyint(1) DEFAULT NULL,
  `fecha_acepto_rechazo` date DEFAULT NULL,
  `fecha_que_se_le_asigno` date DEFAULT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `id_usuario_que_asigna` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `id_usuario_que_recibe` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `id_tipo_dictamen_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_asignacion_editor_seccion_secundario`
--

CREATE TABLE `tbl_asignacion_editor_seccion_secundario` (
  `id_asignacion_editor_seccion_secundaria_pk` int(11) NOT NULL,
  `fecha_recibe_asignacion` date DEFAULT NULL,
  `id_usuario_que_asigna` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `id_usuario_que_recibe` int(11) DEFAULT NULL COMMENT 'Este campo identifica al usuario en cuestion, pero de una forma referenciada, no relacional, es decir; lo que aui se guardara es la referencia al usuario',
  `id_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrera`
--

CREATE TABLE `tbl_carrera` (
  `id_carrera_pk` int(11) NOT NULL,
  `nombre_carrera` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `tbl_carreracol` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_centros`
--

CREATE TABLE `tbl_centros` (
  `id_centro_pk` int(11) NOT NULL,
  `nombre_centro` mediumtext CHARACTER SET utf8,
  `id_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_certificados`
--

CREATE TABLE `tbl_certificados` (
  `id_certificado_pk` int(11) NOT NULL,
  `nombre_certificado` varchar(250) CHARACTER SET utf8 NOT NULL,
  `encabezado_certificado` mediumtext CHARACTER SET utf8 NOT NULL,
  `motivo_certificado` mediumtext CHARACTER SET utf8 NOT NULL,
  `pie_certificado` mediumtext CHARACTER SET utf8 NOT NULL,
  `url_arte` mediumtext CHARACTER SET utf8 COMMENT 'En esta tabla se guardan los certificados y esta relacionada con la tabla tbl_personas_firma_certificado',
  `certificado_especial` tinyint(1) DEFAULT NULL,
  `nombre_persona` varchar(250) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_certificados`
--

INSERT INTO `tbl_certificados` (`id_certificado_pk`, `nombre_certificado`, `encabezado_certificado`, `motivo_certificado`, `pie_certificado`, `url_arte`, `certificado_especial`, `nombre_persona`) VALUES
(1, 'Certificado de Asistente', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU ASISTENCIA AL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA MDC 06-03-2017.', '1_00.jpg', 0, NULL),
(2, 'Certificado Editor Gestor', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR  GESTOR EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C', '2_00.jpg', 0, NULL),
(3, 'Certificado editor principal', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C', '3_00.jpg', 0, NULL),
(4, 'Certificado editor principal de sección ', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR PRINCIPAL DE SECCIÃ“N EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C', '4_00.jpg', 0, NULL),
(5, 'Certificado editor secundario de sección', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR SECUNDARIO DE SECCIÃ“N EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C.', '5_00.jpg', 0, NULL),
(6, 'Certificado encargado de voluntariado', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO ENCARGADO DEL VOLUNTARIADO DEL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C.', '6_00.jpg', 1, 'obed');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citacion`
--

CREATE TABLE `tbl_citacion` (
  `id_citacion_pk` int(11) NOT NULL,
  `nombre_citacion` mediumtext CHARACTER SET utf8,
  `descripcion` longtext CHARACTER SET utf8,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso`
--

CREATE TABLE `tbl_congreso` (
  `id_congreso_pk` int(11) NOT NULL COMMENT 'Identificador único para cada Congreso creado.',
  `nombre_congreso` longtext COMMENT 'Nombre dado a cada congreso creado',
  `siglas` varchar(10) DEFAULT NULL,
  `descripcion_congreso` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `lugar` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `coordenadas` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `id_pais_fk` varchar(2) NOT NULL,
  `logo_congreso` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `lema` varchar(200) DEFAULT NULL,
  `numero_cai` varchar(25) DEFAULT NULL COMMENT 'Número de cuenta de banco asociada al Congreso para cuestiones de pagos y demás.',
  `anio` year(4) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL COMMENT 'fecha de inicio del congreso',
  `fecha_finalizacion` date DEFAULT NULL COMMENT 'fecha de finalizacion del congreso',
  `fecha_i_recepcion` date DEFAULT NULL COMMENT 'fecha de inicio de recepcion de trabajos',
  `fecha_f_recepcion` date DEFAULT NULL COMMENT 'fecha de finalizacion de recepcion de trabajos',
  `fecha_i_revision` date DEFAULT NULL COMMENT 'fecha de inicio de revisiones',
  `fecha_f_revision` date DEFAULT NULL COMMENT 'fecha de finalizacion de revisiones',
  `fecha_p_programa` date DEFAULT NULL COMMENT 'fecha de publicacion del programa',
  `fecha_cambio_costo_inscripcion` date DEFAULT NULL,
  `id_estado_congreso_fk` int(11) NOT NULL COMMENT 'Identificador foráneo a la tabla ''tbl_estado_congreso''.',
  `creado_por` int(11) DEFAULT NULL COMMENT 'Campo en el que se guarda el id del usuario que modifico o creó la información dentro de la tabla, notese que es un campo no referenciado directamente, pero el dato que se guardará hará referencia directa a un usuario.',
  `fecha_creacion` date DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'Campo en el que se guarda el id del usuario que modifico o creó la información dentro de la tabla, notese que es un campo no referenciado directamente, pero el dato que se guardará hará referencia directa a un usuario.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_congreso`
--

INSERT INTO `tbl_congreso` (`id_congreso_pk`, `nombre_congreso`, `siglas`, `descripcion_congreso`, `lugar`, `coordenadas`, `id_pais_fk`, `logo_congreso`, `lema`, `numero_cai`, `anio`, `fecha_inicio`, `fecha_finalizacion`, `fecha_i_recepcion`, `fecha_f_recepcion`, `fecha_i_revision`, `fecha_f_revision`, `fecha_p_programa`, `fecha_cambio_costo_inscripcion`, `id_estado_congreso_fk`, `creado_por`, `fecha_creacion`, `fecha_modificacion`, `modificado_por`) VALUES
(2, '1er Congreso de Comercio Internacional: Perspectivas de la Globalización', 'CCI 2017', 'Congreso de la Carrera de Comercio Internacional', 'Tegucigalpa, MDC. Universidad Nacional Autóno', 'ffsdf', 'AG', '2_CCI 2017.png', 'Perspectivas de la Globalización', 'sdfsdf', 2017, '2017-08-03', '2017-08-18', '2017-08-08', '2017-08-11', '2017-08-10', '2017-08-11', '2017-08-18', '2017-08-18', 1, 1, NULL, '2017-08-21', 2),
(3, '1er Congreso Hondureño de Administración Pública: Abg Ramón Arturo Pineda Leiva', 'CAP 2017', 'Congreso de la Carrera de Administración Pública', 'Tegucigalpa, MDC. Universidad Nacional Autóno', 'rgrgrd', 'AL', '3_CAP 2017.jpg', 'Innovando | Desarrollando | Sirviendo', 'grtrtr', 2017, '2017-08-09', '2017-08-08', '2017-08-10', '2017-08-23', '2017-08-25', '2017-08-24', '2017-08-24', '2017-08-25', 2, 1, NULL, '2017-08-21', 2),
(112, 'Nuevo Congreso El Macizo', 'NCEM', 'Éste será un Congreso bien macizo\r\nque determinará el nivel de macizocieda que tiene.', 'sdfdsfd', 'dfdsfdsf', 'AE', '112_NCEM.png', 'sdfdf', 'sdfdf', 2017, '2017-08-16', '2017-08-23', '2017-08-23', '2017-08-09', '2017-08-23', '2017-08-24', '2017-08-17', '2017-08-24', 2, 2, '2017-08-21', '2017-08-21', 2),
(113, 'asdsadsa', 'asdsads', 'sdsds', 'sadsadas', 'sadsadsa', 'AU', '_asdsads.jpg', 'sdsds', 'sdsdsa', 2017, '2017-08-10', '2017-08-16', '2017-08-23', '2017-08-23', '2017-08-09', '2017-09-01', '2017-08-10', '2017-08-09', 2, 2, '2017-08-21', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_actividad`
--

CREATE TABLE `tbl_congreso_actividad` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_linea_investigacion_pk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_linea_investigacion`
--

CREATE TABLE `tbl_congreso_linea_investigacion` (
  `id_congreso_pk` int(11) NOT NULL,
  `id_linea_investigacion_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_congreso_linea_investigacion`
--

INSERT INTO `tbl_congreso_linea_investigacion` (`id_congreso_pk`, `id_linea_investigacion_pk`) VALUES
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_rol_tematicas`
--

CREATE TABLE `tbl_congreso_rol_tematicas` (
  `id_tematica_fk` int(11) NOT NULL,
  `id_usuario_congreso_roles_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_tipo_trabajo`
--

CREATE TABLE `tbl_congreso_tipo_trabajo` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_tipo_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_congreso_tipo_trabajo`
--

INSERT INTO `tbl_congreso_tipo_trabajo` (`id_congreso_fk`, `id_tipo_trabajo_fk`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_correo`
--

CREATE TABLE `tbl_correo` (
  `id_correo_pk` int(11) NOT NULL,
  `correo` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el correo indicado es o no el que usa la persona como principal',
  `id_persona_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_correo`
--

INSERT INTO `tbl_correo` (`id_correo_pk`, `correo`, `principal`, `id_persona_fk`) VALUES
(1, 'tote.ote@hotmial.com', 1, 1),
(2, 'alex.vargas@unah.hn', 1, 2),
(3, 'obed.martinez@unah.edu.hn', 1, 3),
(4, 'obed_arzu@hotmail.com', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_costo`
--

CREATE TABLE `tbl_costo` (
  `id_costo_pk` int(11) NOT NULL,
  `costo_momento` double DEFAULT NULL,
  `costo_exposicion` double DEFAULT NULL,
  `estudiante` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina al momento del cobro si quien va a realizar el pago es un estudiante o no, ya que de ser un estudiante se aplicará un costo especial.',
  `id_rol_congreso_fk` int(11) NOT NULL COMMENT 'Identificador foráneo a la tabla ''tbl_rol_congreso'' para saber el rol que realizó el usuario en un congreso determinado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_costo`
--

INSERT INTO `tbl_costo` (`id_costo_pk`, `costo_momento`, `costo_exposicion`, `estudiante`, `id_rol_congreso_fk`) VALUES
(1, 4544, 4554654, 1, 4),
(2, 4544, 4554654, 1, 5),
(3, 4544, 4554654, 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_espacio`
--

CREATE TABLE `tbl_espacio` (
  `id_espacio_pk` int(11) NOT NULL,
  `nombre_espacio` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `nombre_alternativo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion_espacio` mediumtext CHARACTER SET utf8,
  `capacidad_personas` int(11) DEFAULT NULL,
  `numero_tomacorriente` int(11) DEFAULT NULL,
  `mapa_espacio` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `comentarios` longtext CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_espacio_congreso`
--

CREATE TABLE `tbl_espacio_congreso` (
  `id_espacio_fk` int(11) NOT NULL,
  `id_congreso_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estadistica`
--

CREATE TABLE `tbl_estadistica` (
  `id_estadistica_pk` int(11) NOT NULL,
  `nombre_estadistica` longtext CHARACTER SET utf8,
  `descripcion` longtext CHARACTER SET utf8,
  `id_tipo_estadistica_fk` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `id_estado_pk` int(11) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_estado`
--

INSERT INTO `tbl_estado` (`id_estado_pk`, `estado`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Enviado', 1, '2017-03-15', 1, '2017-03-15'),
(2, 'Rechazado', 1, '2017-03-15', 1, '2017-03-15'),
(3, 'En Revisión', 1, '2017-06-16', 1, '2017-06-16'),
(4, 'Aceptado', 1, '2017-06-16', 1, '2017-06-16'),
(5, 'Aceptado con revisiones', 1, '2017-06-20', 1, '2017-06-20'),
(6, 'Aceptado en espera de programación', 1, '2017-06-20', 1, '2017-06-20'),
(7, 'Aceptado y programado', 1, '2017-06-20', 1, '2017-06-20'),
(8, 'Presentado', 1, '2017-06-20', 1, '2017-06-20'),
(9, 'Ausente', 1, '2017-06-20', 1, '2017-06-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_congreso`
--

CREATE TABLE `tbl_estado_congreso` (
  `id_estado_congreso_pk` int(11) NOT NULL COMMENT 'Identifcador único para cada estado de congreso',
  `nombre_estado` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre de estado de congreso, este puede ser, activo, inactivo, etc.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_estado_congreso`
--

INSERT INTO `tbl_estado_congreso` (`id_estado_congreso_pk`, `nombre_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_idioma`
--

CREATE TABLE `tbl_estado_idioma` (
  `id_estado_idioma_pk` int(11) NOT NULL,
  `nombre_estado` varchar(45) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_estado_idioma`
--

INSERT INTO `tbl_estado_idioma` (`id_estado_idioma_pk`, `nombre_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'En traducción'),
(4, 'Inhabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura`
--

CREATE TABLE `tbl_factura` (
  `id_factura_pk` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `identificador` int(11) DEFAULT NULL COMMENT 'Aquí se guardará el identificador de la entidad a la cual va dirigida la factura.',
  `id_rango_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura_detalle`
--

CREATE TABLE `tbl_factura_detalle` (
  `id_factura_fk` int(11) NOT NULL,
  `porcentaje_costo_usuario` double DEFAULT NULL,
  `porcentaje_tour` double DEFAULT NULL,
  `momento` tinyint(1) DEFAULT NULL,
  `id_tour_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_facultad`
--

CREATE TABLE `tbl_facultad` (
  `id_facultad_pk` int(11) NOT NULL,
  `nombre_facultad` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formulario`
--

CREATE TABLE `tbl_formulario` (
  `id_formulario_pk` int(11) NOT NULL,
  `nombre_formulario` mediumtext CHARACTER SET utf8,
  `descripcion` longtext CHARACTER SET utf8,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_formulario`
--

INSERT INTO `tbl_formulario` (`id_formulario_pk`, `nombre_formulario`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(10, 'mio', 'prueba', 18, '2017-06-07', NULL, NULL),
(11, 'test1', 'test del formulario', 18, '2017-06-07', NULL, NULL),
(12, 'este si ', 'este creo que si esta bueno ', 18, '2017-06-07', NULL, NULL),
(13, '!!siiiii ', 'este tinene que ser ', 18, '2017-06-07', NULL, NULL),
(14, 'Aj', 'sd', 18, '2017-06-07', NULL, NULL),
(15, 'mm', 'ya', 18, '2017-06-07', NULL, NULL),
(16, 'siiiiii', 'creo que es el numero 13', 18, '2017-06-07', NULL, NULL),
(17, 'formulario', 'descr', 18, '2017-06-07', NULL, NULL),
(18, 'form', 'dsa', 18, '2017-06-07', NULL, NULL),
(19, 'Maria', 'Maria', 18, '2017-06-08', NULL, NULL),
(20, 'formul', 'asd', 18, '2017-06-09', NULL, NULL),
(21, 'sfsdfsdfdsfds', 'sfsdgsdggsd', 2, '2017-07-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formulario_tematica`
--

CREATE TABLE `tbl_formulario_tematica` (
  `id_formulario_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_idioma`
--

CREATE TABLE `tbl_idioma` (
  `id_idioma_pk` varchar(2) NOT NULL,
  `nombre_idioma` varchar(100) DEFAULT NULL,
  `bandera` varchar(45) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  `id_estado_idioma_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_idioma`
--

INSERT INTO `tbl_idioma` (`id_idioma_pk`, `nombre_idioma`, `bandera`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `id_estado_idioma_fk`) VALUES
('aa', 'Afar;Afar;Qafár af', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ab', 'Abjasio;Abkhazian;Аҧсуа aphsua', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ae', 'Avéstico;Avestan;Avestan', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('af', 'Afrikáans;Afrikaans;Afrikaans', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ak', 'Akano;Akan;Akan', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('am', 'Amhárico;Amharic;አማርኛ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('an', 'Aragonés;Aragonese;Aragonés', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ar', 'Árabe;Arabic;‏العربية‏', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('as', 'Asamés;Assamese;অসমীয়া', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('av', 'Avar (o ávaro);Avaric;Магӏарул мацӏ ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ay', 'Aimara;Aymara;Aymar aru', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('az', 'Azerí;Azerbaijani;Azərbaycan dili', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ba', 'Baskir;Bashkir;Башҡорт теле', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('be', 'Bielorruso;Belarusian;Беларуская', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('bg', 'Búlgaro;Bulgarian;Български', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('bh', 'Bhoyapurí;Bihari languages;Bihari languages', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('bi', 'Bislama;Bislama;Bislama', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('bm', 'Bambara;Bambara;Bamanankan', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('bn', 'Bengalí;Bengali;বাংলা', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('bo', 'Tibetano;Tibetan;བོད་སྐད།', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('br', 'Bretón;Breton;Brezhoneg', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('bs', 'Bosnio;Bosnian;Bosanski', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ca', 'Catalán;Catalan;Català', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ce', 'Checheno;Chechen;نَاخچیین موٓتت / ნახჩიე მუოთთ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ch', 'Chamorro;Chamorro;Chamoru', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('co', 'Corso;Corsican;Corsu;Corsu', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('cr', 'Cree;Cree;Cree', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('cs', 'Checo;Czech;Čeština', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('cu', 'Eslavo eclesiástico antiguo;Church Slavic;църковнославянски език/sărkovnoslavyanski ezik', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('cv', 'Chuvasio;Chuvash;Чӑвашла, Čăvašla', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('cy', 'Galés;Welsh;Cymraeg', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('da', 'Danés;Danish;Dansk', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('de', 'Alemán;German;Deutsch', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('dv', 'Maldivo (o dhivehi);Maldivian (or Dhivehi);ދިވެހި / divehi', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('dz', 'Dzongkha;Dzongkha;རྫོང་ཁ་', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ee', 'Ewé;Ewe;Èʋegbe', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('el', 'Griego;Greek;Ελληνικά', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('en', 'Inglés;English;English', 'en', NULL, '2017-02-22', NULL, NULL, 1),
('eo', 'Esperanto;Esperanto;Esperanto', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('es', 'Español;Spanish;Español', 'es', NULL, '2017-02-22', NULL, NULL, 1),
('et', 'Estonio;Estonian;Eesti', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('eu', 'Euskera;Basque;euskara', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('fa', 'Persa;Persian;‏فارسی‏', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ff', 'Fula;Fulah;Pulaar', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('fi', 'Finés;Finnish;Suomi', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('fj', 'Fiyiano;Fijian;Na Vosa Vakaviti', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('fo', 'Feroés;Faroese;Føroyskt', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('fr', 'Francés;French;Français', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('fy', 'Frisón;Western Frisian;Frysk', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ga', 'Irlandés;Irish;Gaeilge', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('gd', 'Gaélico escocés;Scottish Gaelic;Gàidhlig', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('gl', 'Gallego;Galician;Galego', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('gn', 'Guaraní;Guarani;Guarani', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('gu', 'Guyaratí (o guyaratí);Gujarati;ગુજરાતી', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('gv', 'Manés;Manx;Gaelg Vanninagh', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ha', 'Hausa;Hausa;Hausa', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('he', 'Hebreo;Hebrew;‏עברית‏', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('hi', 'Hindi (o hindú);Hindi;हिन्दी', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ho', 'Hiri motu;Hiri Motu;Hiri Motu', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('hr', 'Croata;Croatian;Hrvatski', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ht', 'Haitiano;Haitian;Haitian', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('hu', 'Húngaro;Hungarian;Magyar', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('hy', 'Armenio;Armenian;Հայերեն', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('hz', 'Herero;Herero;Otjiherero', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ia', 'Interlingua;Interlingua;Interlingua', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('id', 'Indonesio;Indonesian;Bahasa Indonesia', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ie', 'Occidental;Occidental;Occidental', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ig', 'Igbo;Igbo;Asụsụ Igbo', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ii', 'Yi de Sichuán;Sichuan Yi;Nuosu', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ik', 'Iñupiaq;Inupiaq;Inupiaq', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('io', 'Ido;Ido;Ido', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('is', 'Islandés;Icelandic;Íslenska', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('it', 'Italiano;Italian;Italiano', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('iu', 'Inuktitut (o inuit);Inuktitut;ᐃᓄᒃᑎᑐᑦ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ja', 'Japonés;Japanese;日本語', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('jv', 'Javanés;Javanese;Basa Jawa', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ka', 'Georgiano;Georgian;ქართული', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kg', 'Kongo;Kongo;Kikongo', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ki', 'Kikuyu;Kikuyu;Gĩkũyũ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kj', 'Kuanyama;Kwanyama;Kwanyama', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kk', 'Kazajo;Kazakh;Қазақша', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kl', 'Groenlandés;Greenlandic;Kalaallisut', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('km', 'Camboyano;Central Khmer;ភាសាក្នុងប្រទេសកម្ពុជា', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kn', 'Canarés;Kannada;ಕನ್ನಡ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ko', 'Coreano;Korean;한국어', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kr', 'Kanuri;Kanuri;Kanuri', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ks', 'Cachemiro;Kashmiri;कॉशुर/کٲشُر /kạ̄šur', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ku', 'Kurdo;Kurdish;Kurdî (Kurmancî)', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kv', 'Komi;Komi;Коми/Komi', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('kw', 'Córnico;Cornish;Kernewek/Kernowek', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ky', 'Kirguís;Kirghiz;Кыргыз тили/Кыргызча\nKyrgyz tili, Kyrgyzça/قىرعىزچا/قىرعىز تىلى', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('la', 'Latín;Latin;lingua latina', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('lb', 'Luxemburgués;Luxembourgish;Lëtzebuergesch', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('lg', 'Luganda;Ganda;Ganda', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('li', 'Limburgués;Limburgan;Limburgan', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ln', 'Lingala;Lingala;Lingala', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('lo', 'Lao;Lao;ພາສາລາວ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('lt', 'Lituano;Lithuanian;Lietuvių', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('lu', 'Luba-katanga;Luba-Katanga;KiLuba', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('lv', 'Letón;Latvian;Latviešu', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('mg', 'Malgache;Malagasy;Malagasy', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('mh', 'Marshalés;Marshallese;Kajin M̧ajeļ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('mi', 'Maorí;Maori;reo māori', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('mk', 'Macedonio;Macedonian;Македонски', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ml', 'Malayalam;Malayalam;മലയാളം', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('mn', 'Mongol;Mongolian;Монгол', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('mr', 'Maratí;Marathi;मराठी', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ms', 'Malayo;Malay;Bahasa Melayu', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('mt', 'Maltés;Maltese;Malti', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('my', 'Birmano;Burmese;မြန်မာဘာသာ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('na', 'Nauruano;Nauru;Dorerin Naoero', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('nb', 'Noruego bokmål;Norwegian Bokmål;Norsk (bokmål)', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('nd', 'Ndebele del norte;North Ndebele;isiNdebele', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ne', 'Nepalí;Nepali;नेपाली', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ng', 'Ndonga;Ndonga;ndonga', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('nl', 'Neerlandés;Dutch;Nederlands', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('nn', 'Nynorsk;Norwegian Nynorsk;Norsk (nynorsk)', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('no', 'Noruego;Norwegian;Norsk', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('nr', 'Ndebele del sur;South Ndebele;isiNdebele', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('nv', 'Navajo;Navajo;Diné bizaad', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ny', 'Chichewa;Chichewa;Chicheŵa', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('oc', 'Occitano;Occitan;Occitan', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('oj', 'Ojibwa;Ojibwa;ᐊᓂᔑᓈᐯᒧᐎᓐ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('om', 'Oromo;Oromo;Afaan Oromoo', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('or', 'Oriya;Oriya;ଓଡ଼ିଆ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('os', 'Osético;Ossetian;Иронау/Irona', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('pa', 'Panyabí;Panjabi;ਪੰਜਾਬੀ pañjābī/پنجابی paṉjābī', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('pi', 'Pali;Pali;पाऴि/Pāḷi', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('pl', 'Polaco;Polish;Polski', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ps', 'Pastú;Pushto;‏پښتو', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('pt', 'Portugués;Portuguese;Português', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('qu', 'Quechua;Quechua;Quechua', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('rm', 'Romanche;Romansh;Romansh', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('rn', 'Kirundi;Rundi;Ikirundi', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ro', 'Rumano;Romanian;Română', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ru', 'Ruso;Russian;Русский', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('rw', 'Ruandés;Kinyarwanda;Ikinyarwanda', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sa', 'Sánscrito;Sanskrit;\'संस्कृतम्/Saṃskṛtam', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sc', 'Sardo;Sardinian;Sardu', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sd', 'Sindhi;Sindhi;सिन्धी/سنڌي', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('se', 'Sami septentrional;Northern Sami;Northern Sami', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sg', 'Sango;Sango;yângâ tî sängö', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('si', 'Cingalés;Sinhala;සිංහල', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sk', 'Eslovaco;Slovak;Slovenčina', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sl', 'Esloveno;Slovenian;Slovenščina', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sm', 'Samoano;Samoan;Gagana fa\'a Sāmoa', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sn', 'Shona;Shona;Shona', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('so', 'Somalí;Somali;Af-Soomaali/اف سومالى‎', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sq', 'Albanés;Albanian;Shqip', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sr', 'Serbio;Serbian;Српски', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ss', 'Suazi;Swati;SiSwati', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('st', 'Sesotho;Sotho;seSotho', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('su', 'Sundanés;Sundanese;ᮘᮞ ᮞᮥᮔ᮪ᮓ Basa Sunda', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sv', 'Sueco;Swedish;Svenska', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('sw', 'Suajili;Swahili;Kiswahili', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('te', 'Télugu;Telugu;తెలుగు', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('tg', 'Tayiko;Tajik;Тоҷикӣ', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('th', 'Tailandés;Thai;ภาษาไทย', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ti', 'Tigriña;Tigrinya;ትግርኛ/Təgərəña', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('tk', 'Turcomano;Turkmen;түркменче/түркмен дили/تورکمهن تیلی/تورکمهنچه', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('tl', 'Tagalo;Tagalog;Wikang tagalog', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('tn', 'Setsuana;Tswana;Setswana', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('to', 'Tongano;Tonga;lea faka-Tonga', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('tr', 'Turco;Turkish;Türkçe', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ts', 'Tsonga;Tsonga;Xitsonga', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('tt', 'Tártaro;Tatar;татар теле/tatar tele/تاتار تلی', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('tw', 'Twi;Twi;Asante Twi', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ty', 'Tahitiano;Tahitian;Reo Tahiti/Reo Mā\'ohi', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ug', 'Uigur;Uighu;ئۇيغۇرچە/ئۇيغۇر تىلى', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('uk', 'Ucraniano;Ukrainian;Українська', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ur', 'Urdu;Urdu;‏اردو‏', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('uz', 'Uzbeko;Uzbek;O\'zbek', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('ve', 'Venda;Venda;Tshivenḓa', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('vi', 'Vietnamita;Vietnamese;Tiếng Việt', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('vo', 'Volapük;Volapük;Volapük', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('wa', 'Valón;Walloon;Walon', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('wo', 'Wolof;Wolof;Wolof', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('xh', 'Xhosa;Xhosa;isiXhosa', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('yi', 'Yídish;Yiddish;ייִדיש', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('yo', 'Yoruba;Yoruba;Èdè Yorùbá', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('za', 'Chuan;Zhuang;Zhuang', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('zh', 'Chino mandarín;Chinese;中文(简体)', NULL, NULL, '2017-02-22', NULL, NULL, 0),
('zu', 'Zulú;Zulu;isiZulu', NULL, NULL, '2017-02-22', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_idiomas_personas`
--

CREATE TABLE `tbl_idiomas_personas` (
  `principal` tinyint(1) DEFAULT NULL,
  `id_idioma_fk` varchar(2) CHARACTER SET utf8 NOT NULL,
  `id_persona_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion`
--

CREATE TABLE `tbl_institucion` (
  `id_institucion_pk` int(11) NOT NULL,
  `nombre_institucion` mediumtext CHARACTER SET utf8,
  `id_tipo_institucion_fk` int(11) NOT NULL,
  `id_pais_fk` varchar(2) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_institucion`
--

INSERT INTO `tbl_institucion` (`id_institucion_pk`, `nombre_institucion`, `id_tipo_institucion_fk`, `id_pais_fk`) VALUES
(1, 'Universidad Nacional Autónoma de Honduras', 1, 'HN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion_carrera`
--

CREATE TABLE `tbl_institucion_carrera` (
  `id_institucion_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion_facultad`
--

CREATE TABLE `tbl_institucion_facultad` (
  `id_institucion_fk` int(11) NOT NULL,
  `id_facultad_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_linea_investigacion`
--

CREATE TABLE `tbl_linea_investigacion` (
  `id_linea_investigacion_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tipo de linea de investigación',
  `nombre_linea_investigacion` mediumtext COMMENT 'Nombre dado a cada línea de investigación creado.',
  `abreviacion` varchar(15) DEFAULT NULL,
  `comentarios` longtext,
  `descripcion_linea_investigacion` mediumtext,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_linea_investigacion`
--

INSERT INTO `tbl_linea_investigacion` (`id_linea_investigacion_pk`, `nombre_linea_investigacion`, `abreviacion`, `comentarios`, `descripcion_linea_investigacion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(2, 'COMPETITIVIDAD, PRODUCTIVIDAD Y CRECIMIENTO ECONÓMICO', '', '', NULL, 1, '2017-04-25', 1, '2017-04-25'),
(3, 'EDUCACIÓN ECONOMÍA Y BIENESTAR', '', '', NULL, 1, '2017-04-25', 1, '2017-04-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id_log_pk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `informacion_extra` longtext CHARACTER SET utf8,
  `id_tipo_log_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_log`
--

INSERT INTO `tbl_log` (`id_log_pk`, `id_usuario_fk`, `fecha`, `hora`, `ip`, `informacion_extra`, `id_tipo_log_fk`) VALUES
(1, 2, '2017-07-10', '15:20:14', '::1', 'Modificación de una línea de investigación', 2),
(2, 2, '2017-07-11', '15:54:19', '::1', 'Activó el congreso con id: 2', 2),
(3, 2, '2017-07-11', '15:57:11', '::1', 'Activó el congreso con id: 2', 2),
(4, 2, '2017-07-11', '16:01:21', '::1', 'Activó el congreso con id: 2', 2),
(5, 2, '2017-07-11', '16:02:13', '::1', 'Activó el congreso con id: 2', 2),
(6, 2, '2017-07-11', '16:02:59', '::1', 'Activó el congreso con id: 2', 2),
(7, 2, '2017-07-11', '16:06:04', '::1', 'Activó el congreso con id: 2', 2),
(8, 2, '2017-07-11', '16:09:55', '::1', 'Activó el congreso con id: 2', 2),
(9, 2, '2017-07-11', '16:11:21', '::1', 'Activó el congreso con id: 2', 2),
(10, 2, '2017-07-11', '16:12:54', '::1', 'Activó el congreso con id: 2', 2),
(11, 2, '2017-07-11', '16:14:33', '::1', 'Activó el congreso con id: 2', 2),
(12, 2, '2017-07-11', '16:16:07', '::1', 'Activó el congreso con id: 2', 2),
(13, 2, '2017-07-11', '16:18:19', '::1', 'Activó el congreso con id: 2', 2),
(14, 2, '2017-07-11', '16:19:27', '::1', 'Activó el congreso con id: 2', 2),
(15, 2, '2017-07-11', '16:20:10', '::1', 'Activó el congreso con id: 2', 2),
(16, 2, '2017-07-11', '17:18:47', '::1', 'Activó el congreso con id: 2', 2),
(17, 2, '2017-07-11', '17:27:35', '::1', 'Activó el congreso con id: 2', 2),
(18, 2, '2017-07-11', '17:28:28', '::1', 'Activó el congreso con id: 2', 2),
(19, 2, '2017-07-11', '17:28:35', '::1', 'Activó el congreso con id: 2', 2),
(20, 2, '2017-07-11', '17:29:53', '::1', 'Activó el congreso con id: 2', 2),
(21, 2, '2017-07-11', '17:56:27', '::1', 'Activó el congreso con id: 2', 2),
(22, 2, '2017-07-11', '17:58:00', '::1', 'Activó el congreso con id: 2', 2),
(23, 2, '2017-07-11', '19:13:52', '::1', 'Activó el congreso con id: 2', 2),
(24, 2, '2017-07-11', '21:04:07', '::1', 'Inactivó el congreso con id: 2', 2),
(25, 2, '2017-07-11', '21:04:14', '::1', 'Activó el congreso con id: 2', 2),
(26, 2, '2017-07-11', '21:04:20', '::1', 'Inactivó el congreso con id: 2', 2),
(27, 2, '2017-07-11', '21:06:21', '::1', 'Inactivó el congreso con id: 3', 2),
(28, 2, '2017-07-11', '21:07:43', '::1', 'Inactivó el congreso con id: 5', 2),
(29, 2, '2017-07-11', '21:08:00', '::1', 'Inactivó el congreso con id: 1', 2),
(30, 2, '2017-07-11', '21:08:09', '::1', 'Activó el congreso con id: 2', 2),
(31, 2, '2017-07-11', '21:10:15', '::1', 'Inactivó el congreso con id: 2', 2),
(32, 2, '2017-07-11', '21:10:25', '::1', 'Activó el congreso con id: 2', 2),
(33, 2, '2017-07-11', '21:10:39', '::1', 'Inactivó el congreso con id: 2', 2),
(34, 2, '2017-07-11', '21:10:42', '::1', 'Activó el congreso con id: 2', 2),
(35, 2, '2017-07-11', '21:12:34', '::1', 'Inactivó el congreso con id: 2', 2),
(36, 2, '2017-07-11', '21:12:54', '::1', 'Activó el congreso con id: 2', 2),
(37, 2, '2017-07-11', '21:13:09', '::1', 'Inactivó el congreso con id: 2', 2),
(38, 2, '2017-07-11', '21:13:12', '::1', 'Activó el congreso con id: 2', 2),
(39, 2, '2017-07-11', '21:13:18', '::1', 'Inactivó el congreso con id: 2', 2),
(40, 2, '2017-07-11', '21:13:21', '::1', 'Activó el congreso con id: 2', 2),
(41, 2, '2017-07-11', '21:14:26', '::1', 'Inactivó el congreso con id: 2', 2),
(42, 2, '2017-07-12', '16:37:01', '::1', 'Activó el congreso con id: 2', 2),
(43, 2, '2017-07-12', '16:37:07', '::1', 'Inactivó el congreso con id: 2', 2),
(44, 2, '2017-07-12', '16:37:32', '::1', 'Activó el congreso con id: 2', 2),
(45, 2, '2017-07-12', '16:38:13', '::1', 'Inactivó el congreso con id: 2', 2),
(46, 2, '2017-07-12', '16:38:57', '::1', 'Activó el congreso con id: 2', 2),
(47, 2, '2017-07-12', '16:39:02', '::1', 'Inactivó el congreso con id: 2', 2),
(48, 2, '2017-07-12', '16:39:27', '::1', 'Activó el congreso con id: 2', 2),
(49, 2, '2017-07-12', '16:39:30', '::1', 'Inactivó el congreso con id: 2', 2),
(50, 2, '2017-07-12', '16:39:52', '::1', 'Activó el congreso con id: 2', 2),
(51, 2, '2017-07-12', '16:48:08', '::1', 'Cerró el congreso con id: 2', 2),
(52, 2, '2017-07-12', '16:48:14', '::1', 'Activó el congreso con id: 2', 2),
(53, 2, '2017-07-12', '16:48:19', '::1', 'Cerró el congreso con id: 2', 2),
(54, 2, '2017-07-12', '16:53:10', '::1', 'Cerró el congreso con id: 2', 2),
(55, 2, '2017-07-12', '16:53:20', '::1', 'Activó el congreso con id: 2', 2),
(56, 2, '2017-07-12', '20:01:51', '::1', 'Inactivó el congreso con id: 2', 2),
(57, 2, '2017-07-12', '20:06:51', '::1', 'Activó el congreso con id: 2', 2),
(58, 2, '2017-07-12', '20:07:39', '::1', 'Inactivó el congreso con id: 2', 2),
(59, 2, '2017-07-12', '20:20:18', '::1', 'Activó el congreso con id: 2', 2),
(60, 2, '2017-07-12', '20:20:44', '::1', 'Activó el congreso con id: 2', 2),
(61, 2, '2017-07-12', '20:21:10', '::1', 'Activó el congreso con id: 2', 2),
(62, 2, '2017-07-12', '20:21:16', '::1', 'Inactivó el congreso con id: 2', 2),
(63, 2, '2017-07-12', '20:21:34', '::1', 'Activó el congreso con id: 2', 2),
(64, 2, '2017-07-14', '15:57:54', '::1', 'Inactivó el congreso con id: 2', 2),
(65, 2, '2017-07-14', '15:58:02', '::1', 'Activó el congreso con id: 2', 2),
(66, 2, '2017-07-14', '15:58:18', '::1', 'Activó el congreso con id: 2', 2),
(67, 2, '2017-07-14', '15:58:23', '::1', 'Inactivó el congreso con id: 2', 2),
(68, 2, '2017-07-14', '15:58:29', '::1', 'Activó el congreso con id: 2', 2),
(69, 2, '2017-07-14', '17:11:58', '::1', 'Creación de una temática de investigación', 1),
(70, 2, '2017-07-14', '17:20:21', '::1', 'Creación de una línea de investigación', 1),
(71, 2, '2017-07-14', '17:49:38', '::1', 'Creación de una temática de investigación', 1),
(72, 2, '2017-07-14', '21:44:03', '::1', 'Inactivó el congreso con id: 2', 2),
(73, 2, '2017-07-18', '20:15:58', '::1', 'Creación de una línea de investigación', 1),
(74, 2, '2017-08-21', '15:44:23', '::1', 'Modificación de información básica del Congreso Nuevo congreso con id 111', 1),
(75, 2, '2017-08-21', '15:51:17', '::1', 'Modificación de información básica del Congreso Nuevo congreso con id 111', 1),
(76, 2, '2017-08-21', '15:51:45', '::1', 'Modificación de información básica del Congreso Nuevo congreso con id 111', 1),
(77, 2, '2017-08-21', '15:53:28', '::1', 'Modificación de información básica del Congreso 1er Congreso Hondureño de Administración Valoración: Abg Eduardo Arturo Pineda Leiva con id 5', 1),
(78, 2, '2017-08-21', '15:55:20', '::1', 'Modificación de información básica del Congreso Este es mi congreso con id 5', 1),
(79, 2, '2017-08-21', '16:01:24', '::1', 'Activó el congreso con id: 2', 2),
(80, 2, '2017-08-21', '16:06:12', '::1', 'Modificación de información básica del Congreso Nuevo Congreso El Macizo con id 112', 1),
(81, 2, '2017-08-21', '16:06:33', '::1', 'Modificación de información básica del Congreso Nuevo Congreso El Macizo con id 112', 1),
(82, 2, '2017-08-21', '16:07:01', '::1', 'Modificación de información básica del Congreso Nuevo Congreso El Macizo con id 112', 1),
(83, 2, '2017-08-21', '16:07:53', '::1', 'Modificación de información básica del Congreso 1er Congreso Hondureño de Administración Pública: Abg Ramón Arturo Pineda Leiva con id 3', 1),
(84, 2, '2017-08-21', '16:09:32', '::1', 'Modificación de información básica del Congreso Nuevo Congreso El Macizo con id 112', 1),
(85, 2, '2017-08-21', '16:10:38', '::1', 'Modificación de información básica del Congreso 1er Congreso de Comercio Internacional: Perspectivas de la Globalización con id 2', 1),
(86, 2, '2017-08-21', '16:51:04', '::1', 'Inactivó el congreso con id: 2', 2),
(87, 2, '2017-08-21', '16:53:34', '::1', 'Activó el congreso con id: 2', 2),
(88, 2, '2017-08-21', '16:57:53', '::1', 'Quitó al usuario con ID4 como administrador del Congreso con id2', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mensaje`
--

CREATE TABLE `tbl_mensaje` (
  `id_mensaje_pk` int(11) NOT NULL,
  `asunto` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `contenido_mensaje` text CHARACTER SET utf8,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modulos`
--

CREATE TABLE `tbl_modulos` (
  `id_modulo_pk` int(11) NOT NULL,
  `nombre_modulo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_nivel_educativo`
--

CREATE TABLE `tbl_nivel_educativo` (
  `id_nivel_educativo_pk` int(11) NOT NULL,
  `nombre_nivel_educativo` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_noticia`
--

CREATE TABLE `tbl_noticia` (
  `id_noticia_pk` int(11) NOT NULL,
  `titulo` mediumtext CHARACTER SET utf8,
  `imagen` mediumtext CHARACTER SET utf8,
  `descripcion` longtext CHARACTER SET utf8,
  `id_usuario_congreso_rol_fk` int(11) NOT NULL,
  `fecha` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notificacion`
--

CREATE TABLE `tbl_notificacion` (
  `id_notificacion_pk` int(11) NOT NULL,
  `texto_notificacion` longtext CHARACTER SET utf8,
  `id_usuario_fk` int(11) NOT NULL,
  `fecha_notificacion` date DEFAULT NULL,
  `hora_notificacion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_organizadores`
--

CREATE TABLE `tbl_organizadores` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_organizadores`
--

INSERT INTO `tbl_organizadores` (`id_congreso_fk`, `id_institucion_fk`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pais`
--

CREATE TABLE `tbl_pais` (
  `id_pais_pk` varchar(2) CHARACTER SET utf8 NOT NULL COMMENT 'Identificador único para cada país.',
  `nombre_pais` longtext CHARACTER SET utf8 COMMENT 'Nombre de cada país (debe escribirse correctamente).',
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_pais`
--

INSERT INTO `tbl_pais` (`id_pais_pk`, `nombre_pais`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
('AD', 'Andorra;Andorra;Principat d\'Andorra', NULL, '2017-02-22', NULL, NULL),
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
('BI', 'Burundi;Burundi;Republika y\'u Burundi/République du Burundi', NULL, '2017-02-22', NULL, NULL),
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
('HT', 'Haití;Haiti;République d\'Haïti (Repiblik d’Ayiti)', NULL, '2017-02-22', NULL, NULL),
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
('LA', 'Laos;Lao People\'s Democratic Republic;ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ', NULL, '2017-02-22', NULL, NULL),
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
('MG', 'Madagascar;Madagascar;Repoblikan\'i Madagasikara/République de Madagascar', NULL, '2017-02-22', NULL, NULL),
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
('RW', 'Ruanda;Rwanda;Repubulika y\'u Rwanda/République du Rwanda/Republic of Rwanda/Jamhuri ya Rwanda', NULL, '2017-02-22', NULL, NULL),
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
('TO', 'Tonga;Tonga;Pule\'anga Fakatu\'i \'o Tonga', NULL, '2017-02-22', NULL, NULL),
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

CREATE TABLE `tbl_pais_idioma` (
  `id_pais_fk` varchar(2) CHARACTER SET utf8 NOT NULL,
  `id_idioma_fk` varchar(2) CHARACTER SET utf8 NOT NULL
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

CREATE TABLE `tbl_patrocinador` (
  `id_patrocinador_pk` int(11) NOT NULL,
  `nombre_patrocinador` mediumtext CHARACTER SET utf8 NOT NULL,
  `url` longtext CHARACTER SET utf8,
  `id_persona_contacto` int(11) NOT NULL,
  `descripcion` longtext CHARACTER SET utf8,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `id_tipo_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perfiles`
--

CREATE TABLE `tbl_perfiles` (
  `id_perfil_pk` int(11) NOT NULL,
  `id_usuario_congreso_roles_fk` int(11) NOT NULL,
  `resumen_bibliografico` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `certificado` tinyint(1) DEFAULT NULL,
  `codigo` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `institucion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE `tbl_persona` (
  `id_persona_pk` int(11) NOT NULL COMMENT 'Identificador único para cada persona.',
  `primer_nombre` varchar(100) DEFAULT NULL,
  `segundo_nombre` varchar(100) DEFAULT NULL,
  `primer_apellido` varchar(100) DEFAULT NULL,
  `segundo_apellido` varchar(100) DEFAULT NULL,
  `identificacion` varchar(50) DEFAULT NULL COMMENT 'Número de identificación usado por cada persona en el proceso de registro.',
  `id_tipo_persona_fk` int(11) NOT NULL,
  `id_tipo_alimentacion_fk` int(11) NOT NULL,
  `id_tipo_identificacion_fk` int(11) NOT NULL,
  `id_pais_fk` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_persona`
--

INSERT INTO `tbl_persona` (`id_persona_pk`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `identificacion`, `id_tipo_persona_fk`, `id_tipo_alimentacion_fk`, `id_tipo_identificacion_fk`, `id_pais_fk`) VALUES
(1, 'José', ' ', 'Rodríguez', ' ', '0408198500056', 1, 2, 1, 'HN'),
(2, 'Alex', '', 'Vargas', ' ', '0801199301292', 1, 2, 1, 'HN'),
(3, 'Obed', ' ', 'Martinez', ' ', '1208198900023', 2, 2, 1, 'HN'),
(4, 'Obed', 'Fernando', 'Arzú', 'Sambulá', '0801-1989-03060', 2, 2, 1, 'HN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_institucion`
--

CREATE TABLE `tbl_persona_institucion` (
  `id_persona_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL,
  `trabaja` tinyint(1) DEFAULT NULL,
  `cargo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_red_social`
--

CREATE TABLE `tbl_persona_red_social` (
  `id_persona_pk` int(11) NOT NULL,
  `id_red_social_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_titulo`
--

CREATE TABLE `tbl_persona_titulo` (
  `id_persona_fk` int(11) NOT NULL,
  `id_titulo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pregunta_cualitativa`
--

CREATE TABLE `tbl_pregunta_cualitativa` (
  `id_pregunta_cualitativa_pk` int(11) NOT NULL,
  `nombre_pregunta_cualitativa` longtext CHARACTER SET utf8,
  `id_formulario_fk` int(11) NOT NULL,
  `id_tipo_pregunta_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pregunta_cuantitativa`
--

CREATE TABLE `tbl_pregunta_cuantitativa` (
  `id_pregunta_cuantitativa_pk` int(11) NOT NULL,
  `nombre_pregunta_cuantitativa` longtext CHARACTER SET utf8,
  `opciones` longtext COLLATE utf8_bin,
  `ponderacion` longtext CHARACTER SET utf8,
  `id_formulario_fk` int(11) NOT NULL,
  `id_tipo_pregunta_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio`
--

CREATE TABLE `tbl_premio` (
  `id_premio_pk` int(11) NOT NULL COMMENT 'Identificador único dado a cada premio',
  `nombre_premio` mediumtext CHARACTER SET utf8 NOT NULL,
  `id_tematica_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_tematica'' y que asocia cada premio con una temática específica.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio_patrocinador`
--

CREATE TABLE `tbl_premio_patrocinador` (
  `id_premio_fk` int(11) NOT NULL,
  `id_patrocinador_fk` int(11) NOT NULL,
  `persona` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el premio fue patrocinado por una persona u institución.',
  `institucion` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el premio fue patrocinado por una persona u institución.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio_trabajo`
--

CREATE TABLE `tbl_premio_trabajo` (
  `id_premio_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa`
--

CREATE TABLE `tbl_programa` (
  `id_programa_pk` int(11) NOT NULL,
  `nombre_programa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `estado_programa` tinyint(1) DEFAULT NULL,
  `descripcion` longtext CHARACTER SET utf8,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa_actividad`
--

CREATE TABLE `tbl_programa_actividad` (
  `id_programa_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rango`
--

CREATE TABLE `tbl_rango` (
  `id_rango_pk` int(11) NOT NULL,
  `nombre_rango` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_red_social`
--

CREATE TABLE `tbl_red_social` (
  `id_red_social_pk` int(11) NOT NULL,
  `nombre_red_social` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_cualitativa`
--

CREATE TABLE `tbl_respuesta_cualitativa` (
  `id_respuesta_cualitativa_pk` int(11) NOT NULL,
  `respuesta_cualitativa` longtext CHARACTER SET utf8,
  `id_pregunta_cualitativa_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_cuantitativa`
--

CREATE TABLE `tbl_respuesta_cuantitativa` (
  `id_respuesta_cuantitativa_pk` int(11) NOT NULL,
  `respuesta_cuantitativa` longtext COLLATE utf8_bin NOT NULL,
  `id_pregunta_cuantitativa_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_mensaje`
--

CREATE TABLE `tbl_respuesta_mensaje` (
  `id_respuesta_mensaje` int(11) NOT NULL,
  `contenido_respuesta_mensaje` text CHARACTER SET utf8,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_mensaje_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuestas_revisiones_trabajos_cualitativas`
--

CREATE TABLE `tbl_respuestas_revisiones_trabajos_cualitativas` (
  `id_revisiones_trabajo_fk` int(11) NOT NULL,
  `id_respuesta_cualitativa_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuestas_revisiones_trabajos_cuantitativas`
--

CREATE TABLE `tbl_respuestas_revisiones_trabajos_cuantitativas` (
  `id_revisiones_trabajo_fk` int(11) NOT NULL,
  `id_respuesta_cuantitativa_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_revisiones_trabajo`
--

CREATE TABLE `tbl_revisiones_trabajo` (
  `id_revisiones_trabajo_pk` int(11) NOT NULL,
  `id_asignacion_a_revisor_fk` int(11) NOT NULL,
  `descargo_archivo` tinyint(1) DEFAULT NULL,
  `lleno_formulario` tinyint(1) DEFAULT NULL,
  `fecha_reviso` date DEFAULT NULL,
  `id_tipo_dictamen_fk` int(11) NOT NULL,
  `observaciones` mediumtext CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id_rol_pk` int(11) NOT NULL COMMENT 'Identificador único para cada rol dentro del sistema',
  `nombre_rol` varchar(45) DEFAULT NULL COMMENT 'Nombre dado a cada rol que puede tener cada usuario, por ejemplo: administrador, editor, asistente, etc. (Cada usuario puede tener uno o más roles por congreso)',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_rol_pk`, `nombre_rol`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Administrador', 1, '2017-03-16', NULL, NULL),
(2, 'Participante', 1, '2017-03-16', NULL, NULL),
(3, 'Ponente', 1, '2017-03-16', NULL, NULL),
(4, 'Autor', 1, '2017-03-16', NULL, NULL),
(5, 'Voluntario', 1, '2017-04-20', NULL, NULL),
(6, 'Revisor', 1, '2017-04-20', NULL, NULL),
(7, 'Editor Gestor', 1, '2017-04-20', NULL, NULL),
(8, 'Editor Principal de sección', 1, '2017-04-20', NULL, NULL),
(9, 'Editor Secundario de sección', 1, '2017-04-20', NULL, NULL),
(10, 'Editor Principal', 1, '2017-04-20', NULL, NULL),
(11, 'Encargado de Programa', 1, '2017-04-20', NULL, NULL),
(12, 'Encargado de voluntariado', 1, '2017-04-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles_congreso`
--

CREATE TABLE `tbl_roles_congreso` (
  `tbl_rol_congreso_pk` int(11) NOT NULL COMMENT 'Identificador único para la indexación de ésta tabla.''',
  `id_rol_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_rol''',
  `id_congreso_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_congresol'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_roles_congreso`
--

INSERT INTO `tbl_roles_congreso` (`tbl_rol_congreso_pk`, `id_rol_fk`, `id_congreso_fk`) VALUES
(4, 1, 2),
(5, 2, 2),
(6, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rtn`
--

CREATE TABLE `tbl_rtn` (
  `id_rtn_pk` int(11) NOT NULL COMMENT 'Identificador único para el ''RTN'' de cada individuo, persona u empresa con obligaciones tributarias hacia el Estado.',
  `empresa` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para identificar si el individuo en cuestión es una empresa.',
  `persona` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para identificar si el individuo en cuestión es una persona.',
  `identificador` int(11) DEFAULT NULL COMMENT 'Este es un tipo de idenificador, aunque no este relacionado, se guardara en el un id de referencia del tipo persona u empresa.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud`
--

CREATE TABLE `tbl_solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `id_usuario_pk` int(11) NOT NULL,
  `id_tipo_solicitud` int(11) NOT NULL,
  `id_congreso_pk` int(11) NOT NULL,
  `motivo_solicitud` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_resolucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tarea_voluntario`
--

CREATE TABLE `tbl_tarea_voluntario` (
  `id_tarea_voluntario_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tarea asociada a un voluntario. Ojo, éste campo no surje de la indexación porque esta no es una tabla transaccional, sino más bien la descripción de tareas que se asocian a los voluntarios.',
  `nombre_tarea` longtext CHARACTER SET utf8,
  `descripcion` longtext CHARACTER SET utf8,
  `ubicacion_complementario` mediumtext CHARACTER SET utf8,
  `comentarios` mediumtext CHARACTER SET utf8,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  `fecha_tarea` date DEFAULT NULL,
  `hora_tarea` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_telefono`
--

CREATE TABLE `tbl_telefono` (
  `id_telefono_pk` int(11) NOT NULL COMMENT 'Identificador único para cada número de teléfono',
  `numero_telefono` int(11) DEFAULT NULL COMMENT 'Aquí se almacenará ca da número telefónico',
  `id_persona_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''persona'' y que sirve para asociar cada número telefónica a una persona en específico.',
  `principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para determinar si el numero telefónico en cuestión es o no el número principal de la persona.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_telefono`
--

INSERT INTO `tbl_telefono` (`id_telefono_pk`, `numero_telefono`, `id_persona_fk`, `principal`) VALUES
(1, 9700, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tematica`
--

CREATE TABLE `tbl_tematica` (
  `id_tematica_pk` int(11) NOT NULL COMMENT 'Identificador único dado a cada tipo de temática.',
  `nombre_tematica` mediumtext NOT NULL COMMENT 'Nombre dado a cada temática creada',
  `abreviacion` varchar(15) DEFAULT NULL,
  `descripcion_tematica` mediumtext,
  `comentarios` longtext,
  `id_linea_investigacion_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_linea_investigacion'' y que asocia dentro de esta tabla cada temática a una línea de investigación específica.',
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tematica`
--

INSERT INTO `tbl_tematica` (`id_tematica_pk`, `nombre_tematica`, `abreviacion`, `descripcion_tematica`, `comentarios`, `id_linea_investigacion_fk`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Economía laboral y demográfica; Mercado laboral formal e informal.', '', NULL, '', 2, 1, '2017-03-10', 1, '2017-03-10'),
(4, 'Emprendedores; administración de empresas; economía de la empresa.', '', NULL, '', 2, 1, '2017-04-25', 1, '2017-04-25'),
(5, 'Marketing y publicidad.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(6, 'Investigación de Operaciones; teoría de la decisión estadística.', '', NULL, '', 2, 1, '2017-04-25', 1, '2017-04-25'),
(7, 'Economía del bienestar y Desarrollo económico.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(8, 'Nivel de vida; calidad de vida de los hogares; desigualdad y pobreza; pobreza multidimensional.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(9, 'Niveles de renta y riqueza de los hogares.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(10, 'Salud y desarrollo económico.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_actividad`
--

CREATE TABLE `tbl_tipo_actividad` (
  `id_tipo_actividad_pk` int(11) NOT NULL,
  `nombre_tipo_actividad` mediumtext CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_alimentacion`
--

CREATE TABLE `tbl_tipo_alimentacion` (
  `id_tipo_alimentacion_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tipo de alimentación',
  `nombre_tipo_alimentacion` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre del tipo de alimentación, puede ser vegetariana, vegana, habitual, etc.',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_alimentacion`
--

INSERT INTO `tbl_tipo_alimentacion` (`id_tipo_alimentacion_pk`, `nombre_tipo_alimentacion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Vegetariano', 0, '2017-03-15', NULL, NULL),
(2, 'Carnívoro', 0, '2017-03-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_dictamen`
--

CREATE TABLE `tbl_tipo_dictamen` (
  `id_tipo_dictamen_pk` int(11) NOT NULL,
  `nombre_tipo_dictamen` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_estadistica`
--

CREATE TABLE `tbl_tipo_estadistica` (
  `id_tipo_estadistica_pk` int(11) NOT NULL,
  `nombre_tipo_estadistica` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `tbl_tipo_estadisticacol` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_identificacion`
--

CREATE TABLE `tbl_tipo_identificacion` (
  `id_tipo_identificacion_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tipo de identificación que será usado por cada usuario.',
  `nombre_tipo_identificacion` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre u descripción dada a cada tipo de usuario-',
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_identificacion`
--

INSERT INTO `tbl_tipo_identificacion` (`id_tipo_identificacion_pk`, `nombre_tipo_identificacion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Cédula ', 0, '2017-03-15', NULL, NULL),
(2, 'Pasaporte', 0, '2017-03-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_institucion`
--

CREATE TABLE `tbl_tipo_institucion` (
  `id_tipo_institucion_pk` int(11) NOT NULL,
  `nombre_tipo_institucion` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_institucion`
--

INSERT INTO `tbl_tipo_institucion` (`id_tipo_institucion_pk`, `nombre_tipo_institucion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Universidad', 2, '2017-07-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_logs`
--

CREATE TABLE `tbl_tipo_logs` (
  `id_tipo_log_pk` int(11) NOT NULL,
  `tipo_log` varchar(150) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_logs`
--

INSERT INTO `tbl_tipo_logs` (`id_tipo_log_pk`, `tipo_log`) VALUES
(1, 'Insertar'),
(2, 'Modificar'),
(3, 'Eliminar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_persona`
--

CREATE TABLE `tbl_tipo_persona` (
  `id_tipo_persona_pk` int(11) NOT NULL,
  `nombre_tipo_persona` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_persona`
--

INSERT INTO `tbl_tipo_persona` (`id_tipo_persona_pk`, `nombre_tipo_persona`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Estudiante', 0, '2017-03-15', NULL, NULL),
(2, 'Trabajador', 0, '2017-03-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_pregunta`
--

CREATE TABLE `tbl_tipo_pregunta` (
  `id_tipo_pregunta_pk` int(11) NOT NULL,
  `nombre_tipo_pregunta` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_solicitud`
--

CREATE TABLE `tbl_tipo_solicitud` (
  `id_tipo_solicitud` int(11) NOT NULL,
  `nombre_tipo_solicitud` varchar(45) CHARACTER SET utf8 NOT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_solicitud`
--

INSERT INTO `tbl_tipo_solicitud` (`id_tipo_solicitud`, `nombre_tipo_solicitud`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Rol', NULL, '2017-06-08', NULL, NULL),
(2, 'Certificado', NULL, '2017-06-08', NULL, NULL),
(3, 'Traductor', NULL, '2017-06-08', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_trabajo`
--

CREATE TABLE `tbl_tipo_trabajo` (
  `id_tipo_trabajo_pk` int(11) NOT NULL,
  `nombre_tipo_trabajo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `numero_maximo_autores` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  `numero_maximo_palabras_clave` int(11) DEFAULT NULL,
  `numero_maximo_palabras_resumen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_tipo_trabajo`
--

INSERT INTO `tbl_tipo_trabajo` (`id_tipo_trabajo_pk`, `nombre_tipo_trabajo`, `numero_maximo_autores`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`, `numero_maximo_palabras_clave`, `numero_maximo_palabras_resumen`) VALUES
(1, 'Trabajo Completo', 10, 1, '2017-03-13', 1, '2017-03-13', 5, 250),
(2, 'Resumen Extendido', 5, 1, '2017-03-13', 1, '2017-03-13', 5, 50),
(3, 'Resumen Abreviado', 5, 1, '2017-04-25', 1, '2017-04-25', 3, 50),
(4, 'Mesas Interactivas', 5, 1, '2017-04-25', 1, '2017-04-25', 3, 50),
(5, 'Posters', 5, 1, '2017-04-25', 1, '2017-04-25', 3, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuario`
--

CREATE TABLE `tbl_tipo_usuario` (
  `id_tipo_usuario_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tipo de usuario.',
  `nombre_tipo_usuario` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre dado a cada tipo de usuario dentro del sistema como por ejemplo super usuario.',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_titulo`
--

CREATE TABLE `tbl_titulo` (
  `id_titulo_pk` int(11) NOT NULL,
  `nombre_titulo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_nivel_educativo_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour`
--

CREATE TABLE `tbl_tour` (
  `id_tour_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tour creado',
  `nombre_tour` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion` mediumtext CHARACTER SET utf8 COMMENT 'Descripción general del tour, aquí pueden ir datos de interés para dicho tour.',
  `comentario` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Algún dato clave que pueda ser de utilidad',
  `costo` double DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour_institucion`
--

CREATE TABLE `tbl_tour_institucion` (
  `id_tour_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour_usuario`
--

CREATE TABLE `tbl_tour_usuario` (
  `id_tour_usuario_pk` int(11) NOT NULL,
  `id_tour_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_trabajo`
--

CREATE TABLE `tbl_trabajo` (
  `id_trabajo_pk` int(11) NOT NULL,
  `titulo_trabajo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_subida` date DEFAULT NULL,
  `ubicacion_archivo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `resumen` longtext CHARACTER SET utf8 COMMENT 'Un resumen que reduce en síntesis de lo que se trata el trabajo.',
  `id_estado_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL COMMENT 'Identificador foráneo a la tabla ''tbl_tematica'' y que define una temática específica para cada trabajo.',
  `id_citacion_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_citacion'' y define para cada trabajo una citación específica.',
  `premio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina si el trabajo es calificado para premio o revista',
  `revista` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina si el trabajo es calificado para premio o revista',
  `horario_sugerido` time DEFAULT NULL COMMENT 'Es el horario en el cual al usuario le gustaría presentar su trabajo (no necesariamente en el cual se va a presentar, ya que depende del programa).',
  `id_tipo_trabajo_fk` int(11) NOT NULL,
  `id_idioma_fk` varchar(2) CHARACTER SET utf8 NOT NULL,
  `palabrasclave` mediumtext CHARACTER SET utf8,
  `resumenprograma` mediumtext CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_trabajo`
--

INSERT INTO `tbl_trabajo` (`id_trabajo_pk`, `titulo_trabajo`, `fecha_subida`, `ubicacion_archivo`, `resumen`, `id_estado_fk`, `id_tematica_fk`, `id_citacion_fk`, `premio`, `revista`, `horario_sugerido`, `id_tipo_trabajo_fk`, `id_idioma_fk`, `palabrasclave`, `resumenprograma`) VALUES
(1, 'zcxbxcvb', '2017-07-04', '3_es_2017-07-04_11-00-44_doc1.docx', 'xcvbcvxb', 1, 1, 0, 1, 1, '10:00:00', 1, 'es', 'bxcvbxcvb,cxvbxcvb,cxvbcvxb,xcvbcxvb', 'xcvbxcv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_trabajo_tematica`
--

CREATE TABLE `tbl_trabajo_tematica` (
  `id_trabajo_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL,
  `principal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_trabajo_tematica`
--

INSERT INTO `tbl_trabajo_tematica` (`id_trabajo_fk`, `id_tematica_fk`, `principal`) VALUES
(1, 1, 1),
(1, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario_pk` int(11) NOT NULL COMMENT 'Identificador único para cada usuario.',
  `nombre_usuario` varchar(150) DEFAULT NULL COMMENT 'Nick de usuario usado por cada persona para logearse en el sistema',
  `contrasena` varchar(100) DEFAULT NULL COMMENT 'Contraseña que junto con el nombre_usuario (Nick) controlan el login',
  `id_persona_fk` int(11) NOT NULL COMMENT 'Identificador único de persona, es una llave fornánea que hace referencia a la tabla persona que contiene los datos generales de cada individuo.',
  `id_idioma_fk` varchar(2) NOT NULL,
  `img_usuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario_pk`, `nombre_usuario`, `contrasena`, `id_persona_fk`, `id_idioma_fk`, `img_usuario`) VALUES
(1, 'jrodriguez', '$1$/t4.az4.$x9mTPpkx4uWvXiDAhX5zA.', 1, 'es', 'img/users/1_josn-luis.jpg'),
(2, 'alexvargas', '$1$3g..OR4.$s7XhcLBiyugnezFaJvi.m1', 2, 'es', NULL),
(3, 'omartinez', '$1$r90.YJ3.$nuaGpjqJJyGcZqL8PFeZC.', 3, 'es', NULL),
(4, 'oarzu', 'ocPUDslDOQ1is', 4, 'es', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_actividad_congreso`
--

CREATE TABLE `tbl_usuario_actividad_congreso` (
  `id_usuario_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_congreso_fk` int(11) NOT NULL,
  `asistio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleando que determina si un usuario asisitió o no a una actividad específica para un congreso dado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_congreso_roles`
--

CREATE TABLE `tbl_usuario_congreso_roles` (
  `tbl_usuario_congreso_rol_pk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_rol_congreso_fk` int(11) NOT NULL,
  `asistira` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para determinar si el usuario asistirá o no al congreso indicado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuario_congreso_roles`
--

INSERT INTO `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`, `id_usuario_fk`, `id_rol_congreso_fk`, `asistira`) VALUES
(4, 4, 5, 1),
(6, 2, 4, 1),
(7, 4, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_congreso_roles_modulos_acciones`
--

CREATE TABLE `tbl_usuario_congreso_roles_modulos_acciones` (
  `id_usuario_congreso_rol_fk` int(11) NOT NULL COMMENT 'Identificador que surje de la indexación de la tabla ''tbl_usuario_congreso_rol'', es una llave foránea que hace referencia a la tabla antes mencionada',
  `id_modulo_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_modulo'', sirve para identificar al módulo al cual se estableceran los accesos que tendrá el usuario.',
  `insertar` tinyint(1) NOT NULL COMMENT 'Campo booleano para definir si el usuario tendrá o no acceso a insertar dentro del sistema.',
  `modificar` tinyint(1) NOT NULL COMMENT 'Campo booleano para definir si el usuario tendrá o no acceso a modificar dentro del sistema.',
  `eliminar` tinyint(1) NOT NULL COMMENT 'Campo booleano para definir si el usuario tendrá o no acceso a eliminar dentro del sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_firma_certificado`
--

CREATE TABLE `tbl_usuario_firma_certificado` (
  `id_certificado_pk` int(11) NOT NULL,
  `id_persona_pk` int(11) NOT NULL,
  `url_firma` mediumtext CHARACTER SET utf8 NOT NULL COMMENT 'Tabla en la que se almacenan las personan que firman un certificado con su respectiva dirección de la firma digital.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_tipo_usuario`
--

CREATE TABLE `tbl_usuario_tipo_usuario` (
  `id_usuario_fk` int(11) NOT NULL,
  `id_tipo_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_trabajo`
--

CREATE TABLE `tbl_usuario_trabajo` (
  `id_usuario_trabajo_pk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `subio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuestión fue quien subió el archivo.',
  `autor_principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuestión es el autor principal del trabajo.',
  `coautor` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuestión es el co-autor principal del trabajo.',
  `expositor` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuestión es el expositor del trabajo.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_usuario_trabajo`
--

INSERT INTO `tbl_usuario_trabajo` (`id_usuario_trabajo_pk`, `id_usuario_fk`, `id_trabajo_fk`, `subio`, `autor_principal`, `coautor`, `expositor`) VALUES
(1, 3, 1, 1, 1, NULL, 1),
(2, 2, 1, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_version_trabajo`
--

CREATE TABLE `tbl_version_trabajo` (
  `id_version_trabajo_pk` int(11) NOT NULL,
  `ubicacion_archivo` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `version_editor_gestor` tinyint(1) DEFAULT NULL,
  `version_aprobado_conrevision` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `id_usuario_que_subio_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `fecha_subida` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_version_trabajo`
--

INSERT INTO `tbl_version_trabajo` (`id_version_trabajo_pk`, `ubicacion_archivo`, `version_editor_gestor`, `version_aprobado_conrevision`, `descripcion`, `id_usuario_que_subio_fk`, `id_trabajo_fk`, `fecha_subida`) VALUES
(1, NULL, 1, NULL, 'Trabajo subido a la plataforma', 3, 1, '2017-07-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_voluntario`
--

CREATE TABLE `tbl_voluntario` (
  `id_voluntario_pk` int(11) NOT NULL COMMENT 'Identificador único asociado a cada voluntario',
  `numero_horas` double DEFAULT NULL,
  `comentarios` mediumtext CHARACTER SET utf8,
  `estado` tinyint(1) DEFAULT NULL,
  `id_rol_congreso_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_rol_congreso'' y que sirve para identificar el rol y el congreso del voluntario en cuestión.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_voluntario_tarea_voluntario`
--

CREATE TABLE `tbl_voluntario_tarea_voluntario` (
  `id_voluntario_fk` int(11) NOT NULL,
  `id_tarea_voluntario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_actividad`
--
ALTER TABLE `tbl_actividad`
  ADD PRIMARY KEY (`id_actividad_pk`),
  ADD KEY `fk_tbl_actividad_tbl_tipo_actividad1_idx` (`id_tipo_actividad_fk`),
  ADD KEY `fk_tbl_actividad_tbl_espacio1_idx` (`id_espacio_pk`);

--
-- Indices de la tabla `tbl_actividad_tematica`
--
ALTER TABLE `tbl_actividad_tematica`
  ADD PRIMARY KEY (`id_actividad_fk`,`id_tematica_fk`),
  ADD KEY `fk_tbl_actividad_has_tbl_tematica_tbl_tematica1_idx` (`id_tematica_fk`),
  ADD KEY `fk_tbl_actividad_has_tbl_tematica_tbl_actividad1_idx` (`id_actividad_fk`);

--
-- Indices de la tabla `tbl_actividad_trabajo`
--
ALTER TABLE `tbl_actividad_trabajo`
  ADD PRIMARY KEY (`id_actividad_fk`,`id_trabajo_fk`),
  ADD KEY `fk_tbl_actividad_has_tbl_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`),
  ADD KEY `fk_tbl_actividad_has_tbl_trabajo_tbl_actividad1_idx` (`id_actividad_fk`);

--
-- Indices de la tabla `tbl_archivo_complementario`
--
ALTER TABLE `tbl_archivo_complementario`
  ADD PRIMARY KEY (`id_archivo_complementario_pk`),
  ADD KEY `fk_tbl_archivos_complementarios_tbl_trabajo1_idx` (`id_trabajo_fk`);

--
-- Indices de la tabla `tbl_asignacion_a_revisor`
--
ALTER TABLE `tbl_asignacion_a_revisor`
  ADD PRIMARY KEY (`id_asignacion_a_revisor_pk`),
  ADD KEY `fk_tbl_asignacion_a_revisores_tbl_trabajo1_idx` (`id_trabajo_fk`),
  ADD KEY `fk_tbl_asignacion_a_revisor_tbl_tipo_dictamen1_idx` (`id_tipo_dictamen_fk`);

--
-- Indices de la tabla `tbl_asignacion_editor_seccion_secundario`
--
ALTER TABLE `tbl_asignacion_editor_seccion_secundario`
  ADD PRIMARY KEY (`id_asignacion_editor_seccion_secundaria_pk`),
  ADD KEY `fk_tbl_asignacion_editor_seccion_secundario_tbl_trabajo1_idx` (`id_trabajo_fk`);

--
-- Indices de la tabla `tbl_carrera`
--
ALTER TABLE `tbl_carrera`
  ADD PRIMARY KEY (`id_carrera_pk`);

--
-- Indices de la tabla `tbl_centros`
--
ALTER TABLE `tbl_centros`
  ADD PRIMARY KEY (`id_centro_pk`,`id_institucion_fk`),
  ADD KEY `fk_tbl_centros_tbl_institucion1_idx` (`id_institucion_fk`);

--
-- Indices de la tabla `tbl_certificados`
--
ALTER TABLE `tbl_certificados`
  ADD PRIMARY KEY (`id_certificado_pk`);

--
-- Indices de la tabla `tbl_citacion`
--
ALTER TABLE `tbl_citacion`
  ADD PRIMARY KEY (`id_citacion_pk`);

--
-- Indices de la tabla `tbl_congreso`
--
ALTER TABLE `tbl_congreso`
  ADD PRIMARY KEY (`id_congreso_pk`),
  ADD KEY `fk_tbl_congreso_tbl_estado_congreso1_idx` (`id_estado_congreso_fk`),
  ADD KEY `fk_tbl_congreso_tbl_pais2_idx` (`id_pais_fk`);

--
-- Indices de la tabla `tbl_congreso_actividad`
--
ALTER TABLE `tbl_congreso_actividad`
  ADD PRIMARY KEY (`id_congreso_fk`,`id_actividad_fk`),
  ADD KEY `fk_tbl_congreso_has_tbl_actividad_tbl_actividad1_idx` (`id_actividad_fk`),
  ADD KEY `fk_tbl_congreso_has_tbl_actividad_tbl_congreso1_idx` (`id_congreso_fk`),
  ADD KEY `fk_tbl_congreso_actividad_tbl_linea_investigacion1_idx` (`id_linea_investigacion_pk`);

--
-- Indices de la tabla `tbl_congreso_linea_investigacion`
--
ALTER TABLE `tbl_congreso_linea_investigacion`
  ADD PRIMARY KEY (`id_congreso_pk`,`id_linea_investigacion_pk`),
  ADD KEY `fk_tbl_congreso_has_tbl_linea_investigacion_tbl_linea_inves_idx` (`id_linea_investigacion_pk`),
  ADD KEY `fk_tbl_congreso_has_tbl_linea_investigacion_tbl_congreso1_idx` (`id_congreso_pk`);

--
-- Indices de la tabla `tbl_congreso_rol_tematicas`
--
ALTER TABLE `tbl_congreso_rol_tematicas`
  ADD KEY `fk_tbl_congreso_rol_tematicas_tbl_tematica1_idx` (`id_tematica_fk`),
  ADD KEY `fk_tbl_congreso_rol_tematicas_tbl_usuario_congreso_roles1_idx` (`id_usuario_congreso_roles_fk`);

--
-- Indices de la tabla `tbl_congreso_tipo_trabajo`
--
ALTER TABLE `tbl_congreso_tipo_trabajo`
  ADD PRIMARY KEY (`id_congreso_fk`,`id_tipo_trabajo_fk`),
  ADD KEY `fk_tbl_congreso_has_tbl_tipo_trabajo_tbl_tipo_trabajo1_idx` (`id_tipo_trabajo_fk`),
  ADD KEY `fk_tbl_congreso_has_tbl_tipo_trabajo_tbl_congreso1_idx` (`id_congreso_fk`);

--
-- Indices de la tabla `tbl_correo`
--
ALTER TABLE `tbl_correo`
  ADD PRIMARY KEY (`id_correo_pk`),
  ADD KEY `fk_tbl_correo_tbl_persona1_idx` (`id_persona_fk`);

--
-- Indices de la tabla `tbl_costo`
--
ALTER TABLE `tbl_costo`
  ADD PRIMARY KEY (`id_costo_pk`),
  ADD KEY `fk_tbl_costo_tbl_roles_congreso1_idx` (`id_rol_congreso_fk`);

--
-- Indices de la tabla `tbl_espacio`
--
ALTER TABLE `tbl_espacio`
  ADD PRIMARY KEY (`id_espacio_pk`);

--
-- Indices de la tabla `tbl_espacio_congreso`
--
ALTER TABLE `tbl_espacio_congreso`
  ADD PRIMARY KEY (`id_espacio_fk`,`id_congreso_fk`),
  ADD KEY `fk_tbl_espacio_has_tbl_congreso_tbl_congreso1_idx` (`id_congreso_fk`),
  ADD KEY `fk_tbl_espacio_has_tbl_congreso_tbl_espacio1_idx` (`id_espacio_fk`);

--
-- Indices de la tabla `tbl_estadistica`
--
ALTER TABLE `tbl_estadistica`
  ADD PRIMARY KEY (`id_estadistica_pk`),
  ADD KEY `fk_tbl_estadistica_tbl_tipo_estadistica1_idx` (`id_tipo_estadistica_fk`);

--
-- Indices de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  ADD PRIMARY KEY (`id_estado_pk`);

--
-- Indices de la tabla `tbl_estado_congreso`
--
ALTER TABLE `tbl_estado_congreso`
  ADD PRIMARY KEY (`id_estado_congreso_pk`);

--
-- Indices de la tabla `tbl_estado_idioma`
--
ALTER TABLE `tbl_estado_idioma`
  ADD PRIMARY KEY (`id_estado_idioma_pk`);

--
-- Indices de la tabla `tbl_factura`
--
ALTER TABLE `tbl_factura`
  ADD PRIMARY KEY (`id_factura_pk`),
  ADD KEY `fk_tbl_factura_tbl_rango1_idx` (`id_rango_pk`);

--
-- Indices de la tabla `tbl_factura_detalle`
--
ALTER TABLE `tbl_factura_detalle`
  ADD KEY `fk_tbl_factura_has_tbl_costo_usuario_tbl_factura1_idx` (`id_factura_fk`),
  ADD KEY `fk_tbl_factura_detalle_tbl_tour_usuario1_idx` (`id_tour_usuario_fk`);

--
-- Indices de la tabla `tbl_facultad`
--
ALTER TABLE `tbl_facultad`
  ADD PRIMARY KEY (`id_facultad_pk`);

--
-- Indices de la tabla `tbl_formulario`
--
ALTER TABLE `tbl_formulario`
  ADD PRIMARY KEY (`id_formulario_pk`);

--
-- Indices de la tabla `tbl_formulario_tematica`
--
ALTER TABLE `tbl_formulario_tematica`
  ADD PRIMARY KEY (`id_formulario_fk`,`id_tematica_fk`),
  ADD KEY `fk_tbl_formulario_has_tbl_tematica_tbl_tematica1_idx` (`id_tematica_fk`),
  ADD KEY `fk_tbl_formulario_has_tbl_tematica_tbl_formulario1_idx` (`id_formulario_fk`);

--
-- Indices de la tabla `tbl_idioma`
--
ALTER TABLE `tbl_idioma`
  ADD PRIMARY KEY (`id_idioma_pk`),
  ADD KEY `fk_tbl_estado_idioma_idx` (`id_estado_idioma_fk`);

--
-- Indices de la tabla `tbl_idiomas_personas`
--
ALTER TABLE `tbl_idiomas_personas`
  ADD KEY `fk_tbl_idiomas_usuarios_tbl_idioma1_idx` (`id_idioma_fk`),
  ADD KEY `fk_tbl_idiomas_usuarios_tbl_persona1_idx` (`id_persona_pk`);

--
-- Indices de la tabla `tbl_institucion`
--
ALTER TABLE `tbl_institucion`
  ADD PRIMARY KEY (`id_institucion_pk`),
  ADD KEY `fk_tbl_institucion_tbl_tipo_institucion1_idx` (`id_tipo_institucion_fk`),
  ADD KEY `fk_tbl_institucion_tbl_pais1_idx` (`id_pais_fk`);

--
-- Indices de la tabla `tbl_institucion_carrera`
--
ALTER TABLE `tbl_institucion_carrera`
  ADD PRIMARY KEY (`id_institucion_fk`,`id_carrera_fk`),
  ADD KEY `fk_tbl_institucion_has_tbl_carrera_tbl_carrera1_idx` (`id_carrera_fk`),
  ADD KEY `fk_tbl_institucion_has_tbl_carrera_tbl_institucion1_idx` (`id_institucion_fk`);

--
-- Indices de la tabla `tbl_institucion_facultad`
--
ALTER TABLE `tbl_institucion_facultad`
  ADD PRIMARY KEY (`id_institucion_fk`,`id_facultad_fk`),
  ADD KEY `fk_tbl_institucion_has_tbl_facultad_tbl_facultad1_idx` (`id_facultad_fk`),
  ADD KEY `fk_tbl_institucion_has_tbl_facultad_tbl_institucion1_idx` (`id_institucion_fk`),
  ADD KEY `fk_tbl_institucion_facultad_tbl_carrera1_idx` (`id_carrera_fk`);

--
-- Indices de la tabla `tbl_linea_investigacion`
--
ALTER TABLE `tbl_linea_investigacion`
  ADD PRIMARY KEY (`id_linea_investigacion_pk`);

--
-- Indices de la tabla `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id_log_pk`),
  ADD KEY `fk_tbl_log_tbl_usuario1_idx` (`id_usuario_fk`),
  ADD KEY `fk_tbl_log_tbl_tipo_logs1_idx` (`id_tipo_log_fk`);

--
-- Indices de la tabla `tbl_mensaje`
--
ALTER TABLE `tbl_mensaje`
  ADD PRIMARY KEY (`id_mensaje_pk`),
  ADD KEY `fk_tbl_publicacion_tbl_usuario1_idx` (`id_usuario_fk`);

--
-- Indices de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  ADD PRIMARY KEY (`id_modulo_pk`);

--
-- Indices de la tabla `tbl_nivel_educativo`
--
ALTER TABLE `tbl_nivel_educativo`
  ADD PRIMARY KEY (`id_nivel_educativo_pk`);

--
-- Indices de la tabla `tbl_noticia`
--
ALTER TABLE `tbl_noticia`
  ADD PRIMARY KEY (`id_noticia_pk`),
  ADD KEY `fk_tbl_noticia_tbl_usuario_congreso_roles1_idx` (`id_usuario_congreso_rol_fk`);

--
-- Indices de la tabla `tbl_notificacion`
--
ALTER TABLE `tbl_notificacion`
  ADD PRIMARY KEY (`id_notificacion_pk`),
  ADD KEY `fk_tbl_notificacion_tbl_usuario1_idx` (`id_usuario_fk`);

--
-- Indices de la tabla `tbl_organizadores`
--
ALTER TABLE `tbl_organizadores`
  ADD KEY `fk_tbl_organizadores_tbl_congreso1_idx` (`id_congreso_fk`),
  ADD KEY `fk_tbl_organizadores_tbl_institucion1_idx` (`id_institucion_fk`);

--
-- Indices de la tabla `tbl_pais`
--
ALTER TABLE `tbl_pais`
  ADD PRIMARY KEY (`id_pais_pk`);

--
-- Indices de la tabla `tbl_pais_idioma`
--
ALTER TABLE `tbl_pais_idioma`
  ADD PRIMARY KEY (`id_pais_fk`,`id_idioma_fk`),
  ADD KEY `fk_tbl_pais_has_tbl_idioma_tbl_idioma1_idx` (`id_idioma_fk`),
  ADD KEY `fk_tbl_pais_has_tbl_idioma_tbl_pais1_idx` (`id_pais_fk`);

--
-- Indices de la tabla `tbl_patrocinador`
--
ALTER TABLE `tbl_patrocinador`
  ADD PRIMARY KEY (`id_patrocinador_pk`),
  ADD KEY `fk_tbl_patrocinador_tbl_persona1_idx` (`id_persona_contacto`),
  ADD KEY `fk_tbl_patrocinador_tbl_tipo_institucion1_idx` (`id_tipo_institucion_fk`);

--
-- Indices de la tabla `tbl_perfiles`
--
ALTER TABLE `tbl_perfiles`
  ADD PRIMARY KEY (`id_perfil_pk`),
  ADD KEY `fk_tbl_perfiles_tbl_usuario_congreso_roles1_idx` (`id_usuario_congreso_roles_fk`);

--
-- Indices de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD PRIMARY KEY (`id_persona_pk`),
  ADD KEY `fk_tbl_persona_tbl_tipo_persona2_idx` (`id_tipo_persona_fk`),
  ADD KEY `fk_tbl_persona_tbl_tipo_alimentacion1_idx` (`id_tipo_alimentacion_fk`),
  ADD KEY `fk_tbl_persona_tbl_tipo_identificacion1_idx` (`id_tipo_identificacion_fk`),
  ADD KEY `fk_tbl_persona_tbl_pais1_idx` (`id_pais_fk`);

--
-- Indices de la tabla `tbl_persona_institucion`
--
ALTER TABLE `tbl_persona_institucion`
  ADD PRIMARY KEY (`id_persona_fk`,`id_institucion_fk`),
  ADD KEY `fk_tbl_persona_has_tbl_institucion_tbl_institucion1_idx` (`id_institucion_fk`),
  ADD KEY `fk_tbl_persona_has_tbl_institucion_tbl_persona1_idx` (`id_persona_fk`);

--
-- Indices de la tabla `tbl_persona_red_social`
--
ALTER TABLE `tbl_persona_red_social`
  ADD PRIMARY KEY (`id_persona_pk`,`id_red_social_pk`),
  ADD KEY `fk_tbl_persona_has_tbl_red_social_tbl_red_social1_idx` (`id_red_social_pk`),
  ADD KEY `fk_tbl_persona_has_tbl_red_social_tbl_persona1_idx` (`id_persona_pk`);

--
-- Indices de la tabla `tbl_persona_titulo`
--
ALTER TABLE `tbl_persona_titulo`
  ADD PRIMARY KEY (`id_persona_fk`,`id_titulo_fk`),
  ADD KEY `fk_tbl_persona_has_tbl_titulo_tbl_titulo1_idx` (`id_titulo_fk`),
  ADD KEY `fk_tbl_persona_has_tbl_titulo_tbl_persona1_idx` (`id_persona_fk`);

--
-- Indices de la tabla `tbl_pregunta_cualitativa`
--
ALTER TABLE `tbl_pregunta_cualitativa`
  ADD PRIMARY KEY (`id_pregunta_cualitativa_pk`),
  ADD KEY `fk_tbl_preguntas_cualitativas_tbl_formulario1_idx` (`id_formulario_fk`),
  ADD KEY `fk_tbl_preguntas_cualitativas_tbl_tipo_pregunta1_idx` (`id_tipo_pregunta_fk`);

--
-- Indices de la tabla `tbl_pregunta_cuantitativa`
--
ALTER TABLE `tbl_pregunta_cuantitativa`
  ADD PRIMARY KEY (`id_pregunta_cuantitativa_pk`),
  ADD KEY `fk_tbl_preguntas_cuantitativas_tbl_formulario1_idx` (`id_formulario_fk`),
  ADD KEY `fk_tbl_preguntas_cuantitativas_tbl_tipo_pregunta1_idx` (`id_tipo_pregunta_fk`);

--
-- Indices de la tabla `tbl_premio`
--
ALTER TABLE `tbl_premio`
  ADD PRIMARY KEY (`id_premio_pk`),
  ADD KEY `fk_tbl_premio_tbl_tematica1_idx` (`id_tematica_fk`);

--
-- Indices de la tabla `tbl_premio_patrocinador`
--
ALTER TABLE `tbl_premio_patrocinador`
  ADD PRIMARY KEY (`id_premio_fk`,`id_patrocinador_fk`),
  ADD KEY `fk_tbl_premio_has_tbl_patrocinador_tbl_patrocinador1_idx` (`id_patrocinador_fk`),
  ADD KEY `fk_tbl_premio_has_tbl_patrocinador_tbl_premio1_idx` (`id_premio_fk`);

--
-- Indices de la tabla `tbl_premio_trabajo`
--
ALTER TABLE `tbl_premio_trabajo`
  ADD PRIMARY KEY (`id_premio_fk`,`id_trabajo_fk`),
  ADD KEY `fk_tbl_premio_has_tbl_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`),
  ADD KEY `fk_tbl_premio_has_tbl_trabajo_tbl_premio1_idx` (`id_premio_fk`);

--
-- Indices de la tabla `tbl_programa`
--
ALTER TABLE `tbl_programa`
  ADD PRIMARY KEY (`id_programa_pk`);

--
-- Indices de la tabla `tbl_programa_actividad`
--
ALTER TABLE `tbl_programa_actividad`
  ADD PRIMARY KEY (`id_programa_fk`,`id_actividad_fk`),
  ADD KEY `fk_tbl_programa_has_tbl_actividad_tbl_actividad1_idx` (`id_actividad_fk`),
  ADD KEY `fk_tbl_programa_has_tbl_actividad_tbl_programa1_idx` (`id_programa_fk`);

--
-- Indices de la tabla `tbl_rango`
--
ALTER TABLE `tbl_rango`
  ADD PRIMARY KEY (`id_rango_pk`);

--
-- Indices de la tabla `tbl_red_social`
--
ALTER TABLE `tbl_red_social`
  ADD PRIMARY KEY (`id_red_social_pk`);

--
-- Indices de la tabla `tbl_respuesta_cualitativa`
--
ALTER TABLE `tbl_respuesta_cualitativa`
  ADD PRIMARY KEY (`id_respuesta_cualitativa_pk`),
  ADD KEY `fk_tbl_respuestas_cualitativas_tbl_preguntas_cualitativas1_idx` (`id_pregunta_cualitativa_fk`);

--
-- Indices de la tabla `tbl_respuesta_cuantitativa`
--
ALTER TABLE `tbl_respuesta_cuantitativa`
  ADD PRIMARY KEY (`id_respuesta_cuantitativa_pk`),
  ADD KEY `fk_tbl_respuestas_cuantitativas_tbl_preguntas_cuantitativas_idx` (`id_pregunta_cuantitativa_fk`);

--
-- Indices de la tabla `tbl_respuesta_mensaje`
--
ALTER TABLE `tbl_respuesta_mensaje`
  ADD PRIMARY KEY (`id_respuesta_mensaje`),
  ADD KEY `fk_tbl_respuesta_publicacion_tbl_publicacion1_idx` (`id_mensaje_fk`),
  ADD KEY `fk_tbl_respuesta_publicacion_tbl_usuario1_idx` (`id_usuario_fk`);

--
-- Indices de la tabla `tbl_respuestas_revisiones_trabajos_cualitativas`
--
ALTER TABLE `tbl_respuestas_revisiones_trabajos_cualitativas`
  ADD PRIMARY KEY (`id_revisiones_trabajo_fk`,`id_respuesta_cualitativa_fk`),
  ADD KEY `id_respuesta_cualitativa_fk_idx` (`id_respuesta_cualitativa_fk`);

--
-- Indices de la tabla `tbl_respuestas_revisiones_trabajos_cuantitativas`
--
ALTER TABLE `tbl_respuestas_revisiones_trabajos_cuantitativas`
  ADD PRIMARY KEY (`id_revisiones_trabajo_fk`,`id_respuesta_cuantitativa_fk`),
  ADD KEY `id_respuesta_cuantitativa_fk_idx` (`id_respuesta_cuantitativa_fk`);

--
-- Indices de la tabla `tbl_revisiones_trabajo`
--
ALTER TABLE `tbl_revisiones_trabajo`
  ADD PRIMARY KEY (`id_revisiones_trabajo_pk`,`id_asignacion_a_revisor_fk`,`id_tipo_dictamen_fk`),
  ADD KEY `id_asignacion_a_revisor_fk_idx` (`id_asignacion_a_revisor_fk`),
  ADD KEY `id_tipo_dictamen_pk_idx` (`id_tipo_dictamen_fk`);

--
-- Indices de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id_rol_pk`);

--
-- Indices de la tabla `tbl_roles_congreso`
--
ALTER TABLE `tbl_roles_congreso`
  ADD PRIMARY KEY (`tbl_rol_congreso_pk`,`id_rol_fk`,`id_congreso_fk`),
  ADD KEY `fk_tbl_roles_has_tbl_congreso_tbl_congreso1_idx` (`id_congreso_fk`),
  ADD KEY `fk_tbl_roles_has_tbl_congreso_tbl_roles1_idx` (`id_rol_fk`);

--
-- Indices de la tabla `tbl_rtn`
--
ALTER TABLE `tbl_rtn`
  ADD PRIMARY KEY (`id_rtn_pk`);

--
-- Indices de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  ADD PRIMARY KEY (`id_solicitud`,`id_usuario_pk`,`id_tipo_solicitud`,`id_congreso_pk`),
  ADD UNIQUE KEY `id_solicitud_UNIQUE` (`id_solicitud`),
  ADD KEY `fk_tbl_solicitud_tbl_usuario1_idx` (`id_usuario_pk`),
  ADD KEY `fk_tbl_solicitud_tbl_tipo_solicitud1_idx` (`id_tipo_solicitud`),
  ADD KEY `fk_tbl_solicitud_tbl_congreso1_idx` (`id_congreso_pk`);

--
-- Indices de la tabla `tbl_tarea_voluntario`
--
ALTER TABLE `tbl_tarea_voluntario`
  ADD PRIMARY KEY (`id_tarea_voluntario_pk`);

--
-- Indices de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  ADD PRIMARY KEY (`id_telefono_pk`),
  ADD KEY `fk_tbl_telefono_Persona1_idx` (`id_persona_fk`);

--
-- Indices de la tabla `tbl_tematica`
--
ALTER TABLE `tbl_tematica`
  ADD PRIMARY KEY (`id_tematica_pk`),
  ADD KEY `fk_tbl_tematica_tbl_linea_investigacion_idx` (`id_linea_investigacion_fk`);

--
-- Indices de la tabla `tbl_tipo_actividad`
--
ALTER TABLE `tbl_tipo_actividad`
  ADD PRIMARY KEY (`id_tipo_actividad_pk`);

--
-- Indices de la tabla `tbl_tipo_alimentacion`
--
ALTER TABLE `tbl_tipo_alimentacion`
  ADD PRIMARY KEY (`id_tipo_alimentacion_pk`);

--
-- Indices de la tabla `tbl_tipo_dictamen`
--
ALTER TABLE `tbl_tipo_dictamen`
  ADD PRIMARY KEY (`id_tipo_dictamen_pk`);

--
-- Indices de la tabla `tbl_tipo_estadistica`
--
ALTER TABLE `tbl_tipo_estadistica`
  ADD PRIMARY KEY (`id_tipo_estadistica_pk`);

--
-- Indices de la tabla `tbl_tipo_identificacion`
--
ALTER TABLE `tbl_tipo_identificacion`
  ADD PRIMARY KEY (`id_tipo_identificacion_pk`);

--
-- Indices de la tabla `tbl_tipo_institucion`
--
ALTER TABLE `tbl_tipo_institucion`
  ADD PRIMARY KEY (`id_tipo_institucion_pk`);

--
-- Indices de la tabla `tbl_tipo_logs`
--
ALTER TABLE `tbl_tipo_logs`
  ADD PRIMARY KEY (`id_tipo_log_pk`);

--
-- Indices de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  ADD PRIMARY KEY (`id_tipo_persona_pk`);

--
-- Indices de la tabla `tbl_tipo_pregunta`
--
ALTER TABLE `tbl_tipo_pregunta`
  ADD PRIMARY KEY (`id_tipo_pregunta_pk`);

--
-- Indices de la tabla `tbl_tipo_solicitud`
--
ALTER TABLE `tbl_tipo_solicitud`
  ADD PRIMARY KEY (`id_tipo_solicitud`);

--
-- Indices de la tabla `tbl_tipo_trabajo`
--
ALTER TABLE `tbl_tipo_trabajo`
  ADD PRIMARY KEY (`id_tipo_trabajo_pk`);

--
-- Indices de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario_pk`);

--
-- Indices de la tabla `tbl_titulo`
--
ALTER TABLE `tbl_titulo`
  ADD PRIMARY KEY (`id_titulo_pk`),
  ADD KEY `fk_tbl_titulo_tbl_nivel_educativo1_idx` (`id_nivel_educativo_fk`),
  ADD KEY `fk_tbl_titulo_tbl_carrera1_idx` (`id_carrera_fk`);

--
-- Indices de la tabla `tbl_tour`
--
ALTER TABLE `tbl_tour`
  ADD PRIMARY KEY (`id_tour_pk`);

--
-- Indices de la tabla `tbl_tour_institucion`
--
ALTER TABLE `tbl_tour_institucion`
  ADD PRIMARY KEY (`id_tour_fk`,`id_institucion_fk`),
  ADD KEY `fk_tbl_tour_has_tbl_institucion_tbl_institucion1_idx` (`id_institucion_fk`),
  ADD KEY `fk_tbl_tour_has_tbl_institucion_tbl_tour1_idx` (`id_tour_fk`);

--
-- Indices de la tabla `tbl_tour_usuario`
--
ALTER TABLE `tbl_tour_usuario`
  ADD PRIMARY KEY (`id_tour_usuario_pk`,`id_tour_fk`,`id_usuario_fk`),
  ADD KEY `fk_tbl_tour_has_tbl_usuario_tbl_usuario1_idx` (`id_usuario_fk`),
  ADD KEY `fk_tbl_tour_has_tbl_usuario_tbl_tour1_idx` (`id_tour_fk`);

--
-- Indices de la tabla `tbl_trabajo`
--
ALTER TABLE `tbl_trabajo`
  ADD PRIMARY KEY (`id_trabajo_pk`),
  ADD KEY `fk_tbl_trabajo_tbl_estado1_idx` (`id_estado_fk`),
  ADD KEY `fk_tbl_trabajo_tbl_tematica1_idx` (`id_tematica_fk`),
  ADD KEY `fk_tbl_trabajo_tbl_tipo_trabajo1_idx` (`id_tipo_trabajo_fk`),
  ADD KEY `fk_tbl_trabajo_tbl_idioma1_idx` (`id_idioma_fk`),
  ADD KEY `fk_tbl_trabajo_tbl_citacion1_idx` (`id_citacion_fk`);

--
-- Indices de la tabla `tbl_trabajo_tematica`
--
ALTER TABLE `tbl_trabajo_tematica`
  ADD PRIMARY KEY (`id_trabajo_fk`,`id_tematica_fk`),
  ADD KEY `fk_tbl_trabajo_has_tbl_tematica_tbl_tematica1_idx` (`id_tematica_fk`),
  ADD KEY `fk_tbl_trabajo_has_tbl_tematica_tbl_trabajo1_idx` (`id_trabajo_fk`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario_pk`),
  ADD KEY `fk_tbl_usuario_Persona1_idx` (`id_persona_fk`),
  ADD KEY `fk_tbl_usuario_tbl_idioma1_idx` (`id_idioma_fk`);

--
-- Indices de la tabla `tbl_usuario_actividad_congreso`
--
ALTER TABLE `tbl_usuario_actividad_congreso`
  ADD PRIMARY KEY (`id_usuario_fk`,`id_actividad_fk`),
  ADD KEY `fk_tbl_usuario_has_tbl_actividad_tbl_actividad1_idx` (`id_actividad_fk`),
  ADD KEY `fk_tbl_usuario_has_tbl_actividad_tbl_usuario1_idx` (`id_usuario_fk`),
  ADD KEY `fk_tbl_usuario_has_tbl_actividad_tbl_congreso1_idx` (`id_congreso_fk`);

--
-- Indices de la tabla `tbl_usuario_congreso_roles`
--
ALTER TABLE `tbl_usuario_congreso_roles`
  ADD PRIMARY KEY (`tbl_usuario_congreso_rol_pk`),
  ADD KEY `fk_tbl_usuario_has_tbl_congreso_tbl_usuario1_idx` (`id_usuario_fk`),
  ADD KEY `fk_tbl_usuario_congreso_roles_tbl_roles_congreso1_idx` (`id_rol_congreso_fk`);

--
-- Indices de la tabla `tbl_usuario_congreso_roles_modulos_acciones`
--
ALTER TABLE `tbl_usuario_congreso_roles_modulos_acciones`
  ADD PRIMARY KEY (`id_usuario_congreso_rol_fk`,`id_modulo_fk`),
  ADD KEY `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_modulos1_idx` (`id_modulo_fk`),
  ADD KEY `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_usuario_c_idx` (`id_usuario_congreso_rol_fk`);

--
-- Indices de la tabla `tbl_usuario_firma_certificado`
--
ALTER TABLE `tbl_usuario_firma_certificado`
  ADD PRIMARY KEY (`id_certificado_pk`,`id_persona_pk`),
  ADD KEY `fk_tbl_usuario_firma_certificado_tbl_certificados1_idx` (`id_certificado_pk`),
  ADD KEY `fk_tbl_usuario_firma_certificado_tbl_persona1_idx` (`id_persona_pk`);

--
-- Indices de la tabla `tbl_usuario_tipo_usuario`
--
ALTER TABLE `tbl_usuario_tipo_usuario`
  ADD PRIMARY KEY (`id_usuario_fk`,`id_tipo_usuario_fk`),
  ADD KEY `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_tipo_usuario1_idx` (`id_tipo_usuario_fk`),
  ADD KEY `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_usuario1_idx` (`id_usuario_fk`);

--
-- Indices de la tabla `tbl_usuario_trabajo`
--
ALTER TABLE `tbl_usuario_trabajo`
  ADD PRIMARY KEY (`id_usuario_trabajo_pk`,`id_usuario_fk`,`id_trabajo_fk`),
  ADD KEY `fk_tbl_usuario_has_tbl_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`),
  ADD KEY `fk_tbl_usuario_has_tbl_trabajo_tbl_usuario1_idx` (`id_usuario_fk`);

--
-- Indices de la tabla `tbl_version_trabajo`
--
ALTER TABLE `tbl_version_trabajo`
  ADD PRIMARY KEY (`id_version_trabajo_pk`),
  ADD KEY `fk_tbl_version_trabajo_tbl_usuario1_idx` (`id_usuario_que_subio_fk`),
  ADD KEY `fk_tbl_version_trabajo_tbl_trabajo1_idx` (`id_trabajo_fk`);

--
-- Indices de la tabla `tbl_voluntario`
--
ALTER TABLE `tbl_voluntario`
  ADD PRIMARY KEY (`id_voluntario_pk`),
  ADD KEY `fk_tbl_voluntario_tbl_roles_congreso1_idx` (`id_rol_congreso_fk`);

--
-- Indices de la tabla `tbl_voluntario_tarea_voluntario`
--
ALTER TABLE `tbl_voluntario_tarea_voluntario`
  ADD PRIMARY KEY (`id_voluntario_fk`,`id_tarea_voluntario_fk`),
  ADD KEY `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_tarea_volunt_idx` (`id_tarea_voluntario_fk`),
  ADD KEY `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_voluntario1_idx` (`id_voluntario_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_actividad`
--
ALTER TABLE `tbl_actividad`
  MODIFY `id_actividad_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_archivo_complementario`
--
ALTER TABLE `tbl_archivo_complementario`
  MODIFY `id_archivo_complementario_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_asignacion_a_revisor`
--
ALTER TABLE `tbl_asignacion_a_revisor`
  MODIFY `id_asignacion_a_revisor_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_asignacion_editor_seccion_secundario`
--
ALTER TABLE `tbl_asignacion_editor_seccion_secundario`
  MODIFY `id_asignacion_editor_seccion_secundaria_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_carrera`
--
ALTER TABLE `tbl_carrera`
  MODIFY `id_carrera_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_centros`
--
ALTER TABLE `tbl_centros`
  MODIFY `id_centro_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_certificados`
--
ALTER TABLE `tbl_certificados`
  MODIFY `id_certificado_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tbl_citacion`
--
ALTER TABLE `tbl_citacion`
  MODIFY `id_citacion_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_congreso`
--
ALTER TABLE `tbl_congreso`
  MODIFY `id_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada Congreso creado.', AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT de la tabla `tbl_correo`
--
ALTER TABLE `tbl_correo`
  MODIFY `id_correo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_costo`
--
ALTER TABLE `tbl_costo`
  MODIFY `id_costo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_espacio`
--
ALTER TABLE `tbl_espacio`
  MODIFY `id_espacio_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_estadistica`
--
ALTER TABLE `tbl_estadistica`
  MODIFY `id_estadistica_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  MODIFY `id_estado_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tbl_estado_congreso`
--
ALTER TABLE `tbl_estado_congreso`
  MODIFY `id_estado_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifcador único para cada estado de congreso', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_estado_idioma`
--
ALTER TABLE `tbl_estado_idioma`
  MODIFY `id_estado_idioma_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_factura`
--
ALTER TABLE `tbl_factura`
  MODIFY `id_factura_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_facultad`
--
ALTER TABLE `tbl_facultad`
  MODIFY `id_facultad_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_formulario`
--
ALTER TABLE `tbl_formulario`
  MODIFY `id_formulario_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `tbl_institucion`
--
ALTER TABLE `tbl_institucion`
  MODIFY `id_institucion_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_linea_investigacion`
--
ALTER TABLE `tbl_linea_investigacion`
  MODIFY `id_linea_investigacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tipo de linea de investigación', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id_log_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  MODIFY `id_modulo_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_nivel_educativo`
--
ALTER TABLE `tbl_nivel_educativo`
  MODIFY `id_nivel_educativo_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_noticia`
--
ALTER TABLE `tbl_noticia`
  MODIFY `id_noticia_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_notificacion`
--
ALTER TABLE `tbl_notificacion`
  MODIFY `id_notificacion_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_patrocinador`
--
ALTER TABLE `tbl_patrocinador`
  MODIFY `id_patrocinador_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  MODIFY `id_persona_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada persona.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_pregunta_cualitativa`
--
ALTER TABLE `tbl_pregunta_cualitativa`
  MODIFY `id_pregunta_cualitativa_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_pregunta_cuantitativa`
--
ALTER TABLE `tbl_pregunta_cuantitativa`
  MODIFY `id_pregunta_cuantitativa_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_premio`
--
ALTER TABLE `tbl_premio`
  MODIFY `id_premio_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único dado a cada premio';
--
-- AUTO_INCREMENT de la tabla `tbl_programa`
--
ALTER TABLE `tbl_programa`
  MODIFY `id_programa_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_rango`
--
ALTER TABLE `tbl_rango`
  MODIFY `id_rango_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_red_social`
--
ALTER TABLE `tbl_red_social`
  MODIFY `id_red_social_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_respuesta_cualitativa`
--
ALTER TABLE `tbl_respuesta_cualitativa`
  MODIFY `id_respuesta_cualitativa_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_respuesta_cuantitativa`
--
ALTER TABLE `tbl_respuesta_cuantitativa`
  MODIFY `id_respuesta_cuantitativa_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_revisiones_trabajo`
--
ALTER TABLE `tbl_revisiones_trabajo`
  MODIFY `id_revisiones_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id_rol_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada rol dentro del sistema', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `tbl_roles_congreso`
--
ALTER TABLE `tbl_roles_congreso`
  MODIFY `tbl_rol_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para la indexación de ésta tabla.''', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tbl_rtn`
--
ALTER TABLE `tbl_rtn`
  MODIFY `id_rtn_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para el ''RTN'' de cada individuo, persona u empresa con obligaciones tributarias hacia el Estado.';
--
-- AUTO_INCREMENT de la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tarea_voluntario`
--
ALTER TABLE `tbl_tarea_voluntario`
  MODIFY `id_tarea_voluntario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tarea asociada a un voluntario. Ojo, éste campo no surje de la indexación porque esta no es una tabla transaccional, sino más bien la descripción de tareas que se asocian a los voluntarios.';
--
-- AUTO_INCREMENT de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  MODIFY `id_telefono_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada número de teléfono', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_tematica`
--
ALTER TABLE `tbl_tematica`
  MODIFY `id_tematica_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único dado a cada tipo de temática.', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_actividad`
--
ALTER TABLE `tbl_tipo_actividad`
  MODIFY `id_tipo_actividad_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_alimentacion`
--
ALTER TABLE `tbl_tipo_alimentacion`
  MODIFY `id_tipo_alimentacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tipo de alimentación', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_dictamen`
--
ALTER TABLE `tbl_tipo_dictamen`
  MODIFY `id_tipo_dictamen_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_estadistica`
--
ALTER TABLE `tbl_tipo_estadistica`
  MODIFY `id_tipo_estadistica_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_identificacion`
--
ALTER TABLE `tbl_tipo_identificacion`
  MODIFY `id_tipo_identificacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tipo de identificación que será usado por cada usuario.', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_institucion`
--
ALTER TABLE `tbl_tipo_institucion`
  MODIFY `id_tipo_institucion_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_logs`
--
ALTER TABLE `tbl_tipo_logs`
  MODIFY `id_tipo_log_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  MODIFY `id_tipo_persona_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_pregunta`
--
ALTER TABLE `tbl_tipo_pregunta`
  MODIFY `id_tipo_pregunta_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_solicitud`
--
ALTER TABLE `tbl_tipo_solicitud`
  MODIFY `id_tipo_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_trabajo`
--
ALTER TABLE `tbl_tipo_trabajo`
  MODIFY `id_tipo_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `id_tipo_usuario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tipo de usuario.';
--
-- AUTO_INCREMENT de la tabla `tbl_titulo`
--
ALTER TABLE `tbl_titulo`
  MODIFY `id_titulo_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_tour`
--
ALTER TABLE `tbl_tour`
  MODIFY `id_tour_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tour creado';
--
-- AUTO_INCREMENT de la tabla `tbl_tour_usuario`
--
ALTER TABLE `tbl_tour_usuario`
  MODIFY `id_tour_usuario_pk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_trabajo`
--
ALTER TABLE `tbl_trabajo`
  MODIFY `id_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada usuario.', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_usuario_congreso_roles`
--
ALTER TABLE `tbl_usuario_congreso_roles`
  MODIFY `tbl_usuario_congreso_rol_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tbl_usuario_trabajo`
--
ALTER TABLE `tbl_usuario_trabajo`
  MODIFY `id_usuario_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_version_trabajo`
--
ALTER TABLE `tbl_version_trabajo`
  MODIFY `id_version_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tbl_voluntario`
--
ALTER TABLE `tbl_voluntario`
  MODIFY `id_voluntario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único asociado a cada voluntario';
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
-- Filtros para la tabla `tbl_asignacion_a_revisor`
--
ALTER TABLE `tbl_asignacion_a_revisor`
  ADD CONSTRAINT `fk_tbl_asignacion_a_revisor_tbl_tipo_dictamen1` FOREIGN KEY (`id_tipo_dictamen_fk`) REFERENCES `tbl_tipo_dictamen` (`id_tipo_dictamen_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_asignacion_a_revisores_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_centros`
--
ALTER TABLE `tbl_centros`
  ADD CONSTRAINT `fk_tbl_centros_tbl_institucion1` FOREIGN KEY (`id_institucion_fk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `tbl_espacio_congreso`
--
ALTER TABLE `tbl_espacio_congreso`
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
-- Filtros para la tabla `tbl_idioma`
--
ALTER TABLE `tbl_idioma`
  ADD CONSTRAINT `fk_tbl_estado_idioma` FOREIGN KEY (`id_estado_idioma_fk`) REFERENCES `tbl_estado_idioma` (`id_estado_idioma_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `tbl_notificacion`
--
ALTER TABLE `tbl_notificacion`
  ADD CONSTRAINT `fk_tbl_notificacion_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_organizadores`
--
ALTER TABLE `tbl_organizadores`
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
  ADD CONSTRAINT `fk_tbl_respuestas_cualitativas_tbl_preguntas_cualitativas1` FOREIGN KEY (`id_pregunta_cualitativa_fk`) REFERENCES `tbl_pregunta_cualitativa` (`id_pregunta_cualitativa_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_respuesta_cuantitativa`
--
ALTER TABLE `tbl_respuesta_cuantitativa`
  ADD CONSTRAINT `fk_tbl_respuestas_cuantitativas_tbl_preguntas_cuantitativas1` FOREIGN KEY (`id_pregunta_cuantitativa_fk`) REFERENCES `tbl_pregunta_cuantitativa` (`id_pregunta_cuantitativa_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_respuesta_mensaje`
--
ALTER TABLE `tbl_respuesta_mensaje`
  ADD CONSTRAINT `fk_tbl_respuesta_publicacion_tbl_publicacion1` FOREIGN KEY (`id_mensaje_fk`) REFERENCES `tbl_mensaje` (`id_mensaje_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_respuesta_publicacion_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_respuestas_revisiones_trabajos_cualitativas`
--
ALTER TABLE `tbl_respuestas_revisiones_trabajos_cualitativas`
  ADD CONSTRAINT `tbl_respuesta_cualitativa_fk` FOREIGN KEY (`id_respuesta_cualitativa_fk`) REFERENCES `tbl_respuesta_cualitativa` (`id_respuesta_cualitativa_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_revisiones_trabajo_fk` FOREIGN KEY (`id_revisiones_trabajo_fk`) REFERENCES `tbl_revisiones_trabajo` (`id_revisiones_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_respuestas_revisiones_trabajos_cuantitativas`
--
ALTER TABLE `tbl_respuestas_revisiones_trabajos_cuantitativas`
  ADD CONSTRAINT `id_respuesta_cuantitativa_fk` FOREIGN KEY (`id_respuesta_cuantitativa_fk`) REFERENCES `tbl_respuesta_cuantitativa` (`id_respuesta_cuantitativa_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_revisiones_trabajo_fk` FOREIGN KEY (`id_revisiones_trabajo_fk`) REFERENCES `tbl_revisiones_trabajo` (`id_revisiones_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_revisiones_trabajo`
--
ALTER TABLE `tbl_revisiones_trabajo`
  ADD CONSTRAINT `id_asignacion_a_revisor_fk` FOREIGN KEY (`id_asignacion_a_revisor_fk`) REFERENCES `tbl_asignacion_a_revisor` (`id_asignacion_a_revisor_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_tipo_dictamen_pk` FOREIGN KEY (`id_tipo_dictamen_fk`) REFERENCES `tbl_tipo_dictamen` (`id_tipo_dictamen_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_roles_congreso`
--
ALTER TABLE `tbl_roles_congreso`
  ADD CONSTRAINT `fk_tbl_roles_has_tbl_congreso_tbl_roles1` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_roles` (`id_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  ADD CONSTRAINT `fk_tbl_solicitud_tbl_tipo_solicitud1` FOREIGN KEY (`id_tipo_solicitud`) REFERENCES `tbl_tipo_solicitud` (`id_tipo_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_solicitud_tbl_usuario1` FOREIGN KEY (`id_usuario_pk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  ADD CONSTRAINT `fk_tbl_telefono_Persona1` FOREIGN KEY (`id_persona_fk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_tematica`
--
ALTER TABLE `tbl_tematica`
  ADD CONSTRAINT `fk_tbl_tematica_tbl_linea_investigacion` FOREIGN KEY (`id_linea_investigacion_fk`) REFERENCES `tbl_linea_investigacion` (`id_linea_investigacion_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_tbl_trabajo_tbl_tipo_trabajo1` FOREIGN KEY (`id_tipo_trabajo_fk`) REFERENCES `tbl_tipo_trabajo` (`id_tipo_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_tbl_roles_congreso1` FOREIGN KEY (`id_rol_congreso_fk`) REFERENCES `tbl_roles_congreso` (`tbl_rol_congreso_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_congreso_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_congreso_roles_modulos_acciones`
--
ALTER TABLE `tbl_usuario_congreso_roles_modulos_acciones`
  ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_modulos1` FOREIGN KEY (`id_modulo_fk`) REFERENCES `tbl_modulos` (`id_modulo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_usuario_con1` FOREIGN KEY (`id_usuario_congreso_rol_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_tbl_usuario_has_tbl_trabajo_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_version_trabajo`
--
ALTER TABLE `tbl_version_trabajo`
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
