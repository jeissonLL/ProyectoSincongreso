-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2022 a las 01:19:24
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbcongresoceat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad`
--

CREATE TABLE `tbl_actividad` (
  `id_actividad_pk` int(11) NOT NULL,
  `nombre_actividad` varchar(200) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `presento` tinyint(1) DEFAULT NULL COMMENT 'Este campo booleano sirve para determinar si el trabajo se presentó o no en la actividad.',
  `id_tipo_actividad_fk` int(11) NOT NULL,
  `id_espacio_pk` int(11) NOT NULL,
  `fecha_actividad` date DEFAULT NULL,
  `responsable` int(11) DEFAULT NULL,
  `comentarios` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_tematica`
--

CREATE TABLE `tbl_actividad_tematica` (
  `id_actividad_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL,
  `distribucion_sesiones_paralelas` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cuando se crea una actividad puede asociarse a una o más lineas de investigación, a su vez; al pertenecer a una línea de investigación, puede estar asociada a todas o algunas de las temáticas concernientes a ésa línea, como cada temática está asociada a una línea de investigación, basta con asociar actividad con temática para obtener los tres datos y tener la libertad de asociar a ''actividad'' con una o más ''temáticas'' y a su vez ''líneas de investigación''.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad_trabajo`
--

CREATE TABLE `tbl_actividad_trabajo` (
  `id_actividad_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_archivo_complementario`
--

CREATE TABLE `tbl_archivo_complementario` (
  `id_archivo_complementario_pk` int(11) NOT NULL,
  `nombre_archivo` varchar(200) DEFAULT NULL,
  `descripcion` mediumtext,
  `ubicacion_archivo` varchar(200) DEFAULT NULL,
  `id_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrera`
--

CREATE TABLE `tbl_carrera` (
  `id_carrera_pk` int(11) NOT NULL,
  `nombre_carrera` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_centros`
--

CREATE TABLE `tbl_centros` (
  `id_centro_pk` int(11) NOT NULL,
  `nombre_centro` mediumtext,
  `id_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_certificados`
--

CREATE TABLE `tbl_certificados` (
  `id_certificado_pk` int(11) NOT NULL,
  `nombre_certificado` varchar(250) NOT NULL,
  `encabezado_certificado` mediumtext NOT NULL,
  `motivo_certificado` mediumtext NOT NULL,
  `pie_certificado` mediumtext NOT NULL,
  `url_arte` mediumtext COMMENT 'En esta tabla se guardan los certificados y esta relacionada con la tabla tbl_personas_firma_certificado',
  `certificado_especial` tinyint(1) DEFAULT NULL,
  `nombre_persona` varchar(250) DEFAULT NULL,
  `idrol_congreso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_certificados`
--

INSERT INTO `tbl_certificados` (`id_certificado_pk`, `nombre_certificado`, `encabezado_certificado`, `motivo_certificado`, `pie_certificado`, `url_arte`, `certificado_especial`, `nombre_persona`, `idrol_congreso`) VALUES
(1, 'Certificado de Asistente', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU ASISTENCIA AL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA MDC 06-03-2017.', '1_00.jpg', 0, NULL, NULL),
(2, 'Certificado Editor Gestor', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR  GESTOR EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C', '2_00.jpg', 0, NULL, NULL),
(3, 'Certificado editor principal', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C', '3_00.jpg', 0, NULL, NULL),
(4, 'Certificado editor principal de sección ', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR PRINCIPAL DE SECCIÃ“N EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C', '4_00.jpg', 0, NULL, NULL),
(5, 'Certificado editor secundario de sección', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO EDITOR SECUNDARIO DE SECCIÃ“N EN EL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C.', '5_00.jpg', 0, NULL, NULL),
(6, 'Certificado encargado de voluntariado', 'UNIVERSIDAD NACIONAL AUTÃ“NOMA DE HONDURAS', 'SE EXTIENDE EL PRESENTE CERTIFICADO POR SU APORTE COMO ENCARGADO DEL VOLUNTARIADO DEL CONGRESO DE ECONOMÃA ADMINISTRACIÃ“N Y TECNOLOGÃA EDICIÃ“N 2017.', 'TEGUCIGALPA M.D.C.', '6_00.jpg', 1, 'obed', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_certificados_usuario`
--

CREATE TABLE `tbl_certificados_usuario` (
  `id_usuario_fk` int(11) NOT NULL,
  `id_certificado_fk` int(11) NOT NULL,
  `codigo_certificado` varchar(250) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citacion`
--

CREATE TABLE `tbl_citacion` (
  `id_citacion_pk` int(11) NOT NULL,
  `nombre_citacion` mediumtext,
  `descripcion` longtext,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Congreso de Economía Administración y Tecnología 2017', 'CEAT 2017', '5to Congreso de Economía, Administración y Tecnología ', 'Tegucigalpa, MDC. Universidad Nacional Autóno', NULL, 'HN', 'ceat_2017.png', 'La responsabilidad social en la economía, administración y tecnología por medio de la Investigación, Desarrollo e Innovación', NULL, NULL, '2017-10-31', '2017-11-02', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL),
(2, '1er Congreso de Comercio Internacional: Perspectivas de la Globalización', 'CCI 2017', 'Congreso de la Carrera de Comercio Internacional', 'Tegucigalpa, MDC. Universidad Nacional Autóno', NULL, 'HN', 'cci.jpg', 'Perspectivas de la Globalización', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL),
(3, '1er Congreso Hondureño de Administración Pública: Abg Ramón Arturo Pineda Leiva', 'CAP 2017', 'Congreso de la Carrera de Administración Pública', 'Tegucigalpa, MDC. Universidad Nacional Autóno', NULL, 'HN', 'cap.jpg', 'Innovando | Desarrollando | Sirviendo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_actividad`
--

CREATE TABLE `tbl_congreso_actividad` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_linea_investigacion_pk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_linea_investigacion`
--

CREATE TABLE `tbl_congreso_linea_investigacion` (
  `id_congreso_pk` int(11) NOT NULL,
  `id_linea_investigacion_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_congreso_linea_investigacion`
--

INSERT INTO `tbl_congreso_linea_investigacion` (`id_congreso_pk`, `id_linea_investigacion_pk`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_rol_tematicas`
--

CREATE TABLE `tbl_congreso_rol_tematicas` (
  `id_tematica_fk` int(11) NOT NULL,
  `id_usuario_congreso_roles_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_congreso_tipo_trabajo`
--

CREATE TABLE `tbl_congreso_tipo_trabajo` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_tipo_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_correo`
--

CREATE TABLE `tbl_correo` (
  `id_correo_pk` int(11) NOT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el correo indicado es o no el que usa la persona como principal',
  `id_persona_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_correo`
--

INSERT INTO `tbl_correo` (`id_correo_pk`, `correo`, `principal`, `id_persona_fk`) VALUES
(1, 'tote.ote@hotmail.com', 1, 1),
(2, 'alex.vargas@unah.hn', 1, 2),
(3, 'obed.martinez@unah.edu.hn', 1, 3),
(4, 'obed_arzu@hotmail.com', 1, 4),
(5, 'leonela.turcios@unah.hn', 1, 5),
(6, 'jorge.pomare@unah.hn', 1, 6),
(7, 'clarisa.vallejo@unah.hn', 1, 7),
(8, 'angelica.rosales@unah.hn', 1, 8),
(11, 'jesus.argueta@unah.edu.hn', 1, 11),
(12, 'yesy.herrera@unah.hn', 1, 12),
(13, 'arleth.turcios@unah.hn', 1, 13),
(14, 'ravalladares@unah.hn', 1, 14),
(15, 'ehuete@iies-unah.org', 1, 15),
(20, 'varela_jose@unah.hn', 1, 20),
(21, 'carlosurbinab@hotmail.com', 1, 21),
(22, 'imarroquin@uca.edu.sv', 1, 22),
(25, 'mar.diaz.c@hotmail.com', 1, 25),
(26, 'jflores@iies-unah.org', 1, 23),
(27, 'jarrazola@iies-unah.org', 1, 24),
(28, 'zavalajulio@iies-unah.org', 1, 26),
(29, 'javedgardo@outlook.com', 1, 27),
(30, 'manuel.flores@unah.edu.hn', 1, 28),
(31, 'ludloz21@gmail.com', 1, 29),
(32, 'verenice_garciac@hotmail.com', 1, 30),
(33, 'celeo.emilio.arias@gmail.com', 1, 31),
(34, 'juanjose_ortizperez@yahoo.com', 1, 32),
(35, 'javier.delcid@unitec.edu.hn', 1, 33),
(36, 'eaguilera@iies-unah.org', 1, 34),
(37, 'cortega@iies-unah.org', 1, 35),
(38, 'marcymoncada@hotmail.com', 1, 36),
(40, 'Lcm69e@yahoo.es', 1, 38),
(41, 'malen333333@gmail.com', 1, 39),
(42, 'Hermaensa_gl@hotmail.com', 1, 40),
(43, 'Oscarl_27@yahoo.com', 1, 41),
(44, 'Annen_254@hotmail.com', 1, 42),
(45, 'kggo86@hotmail.com', 1, 43),
(46, 'pajoe_07@hotmail.com', 1, 44),
(47, 'miaisahurst@gmail.com', 1, 45),
(48, 'Andreamoncada389@gmail.com', 1, 46),
(49, 'dany.najeraflores@gmail.com', 1, 47),
(50, 'alejandro_acosta@unah.hn', 1, 48),
(51, 'baranuz@hotmail.com', 1, 49),
(52, 'Raudalesisabel22@gmail.com', 1, 50),
(53, 'clau_rivera3@hotmail.com', 1, 51),
(54, 'norma.castillo@unah.edu.hn', 1, 52),
(55, 'marvin.aguilar@unah.edu.hn', 1, 53),
(56, 'jlrodriguez@unah.edu.hn', 1, 54),
(57, 'ammy.lanza@unah.edu.hn', 1, 55),
(58, 'nraudales@iies-unah.org', 1, 56),
(59, 'jgomes@iies-unah.org', 1, 57),
(60, 'joshdgaleano@hotmail.com', 1, 58),
(63, 'mdiaz@iies-unah.org', 1, 61),
(64, 'mlopez@iies-unah.org', 1, 62),
(66, 'mraarobert251986@gmail.com', 1, 64),
(67, 'ncastillo@iies-unah.org', 1, 65),
(68, 'alfalla@us.es', 1, 66),
(70, 'btriminio@iies-unah.org', 1, 68),
(71, 'ordonezportillov85@hotmail.es', 1, 69),
(72, 'lopez.sunee@unah.edu.hn', 1, 70),
(73, 'ednagaby9@gmail.com', 1, 71),
(74, 'josebayardo89@gmail.com', 1, 72),
(75, 'guianni.jimenez@unah.edu.hn', 1, 73),
(76, '', 1, 74),
(77, 'jozzecarlo_95@hotmail.com', 1, 75),
(78, 'jessychic1194@hotmail.es', 1, 76),
(79, 'yharif1995@hotmail.com', 1, 77),
(80, 'bonilla_ingris@yahoo.com', 1, 78),
(81, 'vasquez.jeni@yahoo.com', 1, 79),
(82, 'yannymillaamaya@yahoo.es', 1, 80),
(83, 'madelin.dayana@hotmail.com', 1, 81),
(84, 'joselingaldamez1992@hotmail.com', 1, 82),
(85, 'jemerson.elvir@gmail.com', 1, 83),
(86, 'mirna.fernandez97@gmail.com', 1, 84),
(87, 'diego_velasquezm@hotmail.com', 1, 85),
(88, 'aby_r44@yahoo.com', 1, 86),
(89, 'dannymtz_sto25@yahoo.com', 1, 87),
(90, 'stafa9820@gmail.com', 1, 88),
(91, 'unah.michellamador@hotmail.com', 1, 89),
(92, 'wendy_amaya91@hotmail.com', 1, 90),
(93, 'wendy_amaya91@hotmail.com', 1, 91),
(94, 'angelicalmendarez@hotmail.com', 1, 92),
(95, 'francis.paz92@hotmail.com', 1, 93),
(96, 'Dalmaesmirna@gmail.com', 1, 94),
(97, 'relu_bh_1107@hotmail.com', 1, 95),
(98, 'fredy_martinez1995@yahoo.com', 1, 96),
(99, 'amaliadch@hotmail.com', 1, 97),
(100, 'tanimargoth94@hotmail.es', 1, 98),
(101, 'melban_lobo@hotmail.com', 1, 99),
(102, 'anny05estefany@hotmail.com', 1, 100),
(103, 'kerlyn.burgos@unah.hn', 1, 101),
(104, 'liliavila05@hotmail.com', 1, 102),
(105, 'r_narmin@yahoo.com', 1, 103),
(106, 'claudia.moreno.unah@gmail.com', 1, 104),
(107, 'pattylinda@hotmail.com', 1, 105),
(108, 'allanacosta2006@hotmail.com', 1, 106),
(109, 'gabypolancoh@hotmail.com', 1, 107),
(110, 'jvicky05@hotmail.com', 1, 108),
(111, 'glory_16_2006@yahoo.com', 1, 109),
(112, 'fpaz_@live.com', 1, 110),
(113, 'guevaram35@gmail.com', 1, 111),
(114, 'cruz.ale12@yahoo.com', 1, 112),
(115, 'rudydanierymartinez.1995@hotmail.com', 1, 113),
(116, 'j_sabasg@hotmail.com', 1, 114),
(117, 'Pamel_12@hotmail.es', 1, 115),
(118, 'angelabrahamsalinas@yahoo.com', 1, 116),
(119, 'margoth12ramos@hotmail.com', 1, 117),
(120, 'isabel_sevilla@yahoo.com', 1, 118),
(121, 'nelsonsilva689@hotmail.com', 1, 119),
(122, 'ale.kathy999@gmail.com', 1, 120),
(123, 'adopineda88@gmail.com', 1, 121),
(124, 'wsso_14@hotmail.com', 1, 122),
(125, 'senaydaherrera@yahoo.es', 1, 123),
(126, 'hjmpolv@gmail.com', 1, 124),
(127, 'gasars93adam@yahoo.es', 1, 125),
(128, 'alejandra.triminio@yahoo.com', 1, 126),
(129, 'labeba_godoy@yahoo.com', 1, 127),
(130, 'mirna.romero@unah.hn', 1, 128),
(131, 'selvin_ulloa@yahoo.com', 1, 129),
(132, 'aaron.ru94@gmail.com', 1, 130),
(133, 'gaby0211@hotmail.com.ar', 1, 131),
(134, 'KENIAABITM@hotmail.com', 1, 132),
(135, 'danielaavila15@yahoo.com', 1, 133),
(136, 'haydeemendoza60@yahoo.com', 1, 134),
(137, 'maritzapadilla8295@gmail.com', 1, 135),
(138, '10lema10@gmail.com', 1, 136),
(139, 'daviddiaz83@gmail.com', 1, 137),
(140, 'viiviifiigueroa22@gmail.com', 1, 138),
(141, '30821160@unitec.edu', 1, 139),
(142, 'aldoyoseth@unitec.edu', 1, 140),
(143, 'jessica.gomez@unitec.edu', 1, 141),
(144, 'arely.flores@unitec.edu', 1, 142),
(145, 'rbarrientos@unitec.edu', 1, 143),
(146, 'jmarroquin@unitec.edu', 1, 144),
(147, 'jdelcid@unitec.edu', 1, 145),
(148, 'nathanael@unitec.edu', 1, 146),
(149, 'gisylopez@hotmail.com', 1, 147),
(150, 'douglas_lopez1893@hotmail.com', 1, 148),
(151, 'javier.delcid@unitec.edu', 1, 149),
(152, 'jmalvarez0603@yahoo.com', 1, 150),
(153, 'hernandezordoezv@yahoo.es ', 1, 151),
(154, 'mendezvianney16@gmailcom', 1, 152),
(155, 'andreacelestefg@yahoo.com', 1, 153),
(156, 'stalinarq@yahoo.com', 1, 154),
(157, 'dianadessire1994@gmail.com', 1, 155),
(158, 'lourdes_martines51@yahoo.com', 1, 156),
(159, 'jennifercanales@outlook.com', 1, 157),
(160, 'xh2697@gmail.com', 1, 158),
(161, 'erikamejiamilla@gmail.com', 1, 159),
(162, 'lyansalgado@hotmail.com', 1, 160),
(163, 'dianaeguigure@hotmail.com', 1, 161),
(164, 'aldair.beau@gmail.com', 1, 162),
(165, 'bessypavon94@yahoo.com', 1, 163),
(166, 'ccanaca15@gmail.com', 1, 164),
(167, 'maria_sahury95@hotmail.com', 1, 165),
(168, 'shafikshaurieh@hotmail.com', 1, 166),
(169, 'greinelym@yahoo.com', 1, 167),
(170, 'maritzanazareth97@gmail.com', 1, 168),
(171, 'yensi_12@hotmail.com', 1, 169),
(172, 'kadamesa@gmail.com', 1, 170),
(173, 'larymarcas@gmail.com', 1, 171),
(174, 'danielarico06@gmail.com', 1, 172),
(175, 'kenermoncada@gmail.com', 1, 173),
(176, 'marlon.gilberto.medina@gmail.com', 1, 174),
(177, 'auxiliadora1998@hotmail.com', 1, 175),
(178, 'katty.gmez07@gmail.com', 1, 176),
(179, 'wgvs09@gmail.com', 1, 177),
(180, 'jennifer.amador19@yahoo.com', 1, 178),
(181, 'franciscoperalta@unah.hn', 1, 179),
(182, 'evelinmontes75@hotmail.com', 1, 180),
(183, 'anagrisel21@hotmail.com', 1, 181),
(184, 'mahely_morga@yahoo.com', 1, 182),
(185, 'luifi148@yahoo.com', 1, 183),
(186, 'fmerlynflores@yahoo.es', 1, 184),
(187, 'rrlesterm@yahoo.es', 1, 185),
(188, 'dilciaavilasierra@gmail.com', 1, 186),
(189, 'Kei.figueroa18@gmail.com', 1, 187),
(190, 'eileenandracastillo67@hotmail.com', 1, 188),
(191, 'clararivera163@gmail.com', 1, 189),
(192, 'evelincorea93@gmail.com', 1, 190),
(193, 'jacky369@hotmail.es', 1, 191),
(194, 'kathe_hrn@hotmail.com', 1, 192),
(195, 'emilysori95_1501', 1, 193),
(196, 'kattybustilllo@yahoo.com', 1, 194),
(197, 'saraginellespaa94@gmail.com', 1, 195),
(198, 'vanneflores_20@hotmail.com', 1, 196),
(199, 'carlos.elvir2323@gmail.com', 1, 197),
(201, 'gyareli.matute@gmail.com', 1, 199),
(202, 'valemarce3827@gmail.com', 1, 200),
(203, 'elmer.carcamo10@hotmail.com', 1, 201),
(204, 'bryanjosue12@gmail.com', 1, 202),
(205, 'astridvelasquez14@hotmail.com', 1, 203),
(206, 'Alex_maldonado_29@hotmail.com', 1, 204),
(207, 'yuzaribrizuela@gmail.com', 1, 205),
(208, 'ambar.izaguirre@unah.hn', 1, 206),
(209, 'andy_betancourth@hotmail.com', 1, 207),
(210, 'mercedes.estrada@unah.hn', 1, 208),
(211, 'eliel.zelaya@unah.hn', 1, 209),
(212, 'clarisa.fortin@unah.hn', 1, 210),
(213, 'daedgarca@hotmail.com', 1, 211),
(214, 'cristhian.cardenas@unah.hn', 1, 212),
(215, 'fiallos.alejandra@yahoo.es', 1, 213),
(216, 'yuzaribrizuela@yahoo.es', 1, 214),
(217, 'omar_may69@yahoo.com', 1, 215),
(218, 'hugo21tejeda@yahoo.es', 1, 216),
(219, 'pelinita_15@yahoo.es', 1, 217),
(220, 'alexander.giron@outlook.com', 1, 218),
(221, 'ldayni.dl@gmail.com', 1, 219),
(222, 'taria.andino@unah.edu.hn', 1, 220),
(223, 'malb777tetraa@yahoo.com.ar', 1, 221),
(224, 'colindrespavonv@yahoo.com', 1, 222),
(225, 'emilysori95_1501@hotmail.com', 1, 223),
(226, 'eva_and_b@hotmail.com', 1, 224),
(227, 'keren_aguilar93@outlook.com', 1, 225),
(228, 'belky_odalis@yahoo.es', 1, 226),
(229, 'yuzaribrizuela@yahoo.es', 1, 227),
(230, 'monserrathbrito14@yahoo.com', 1, 228),
(231, 'isismarielis@hotmail.com', 1, 229),
(232, 'asael.nunez@gmail.com', 1, 230),
(233, 'zuniga_elunico@yahoo.es', 1, 231),
(234, 'marijo_sierra@yahoo.com', 1, 232),
(235, 'tatobtancourth@gmail.com', 1, 233),
(236, 'tatobtancourth@gmail.com', 1, 234),
(237, 'tatobtancourth@gmail.com', 1, 235),
(238, 'tatobtancourth@gmail.com', 1, 236),
(239, 'tatobtancourth@gmail.com', 1, 237),
(240, 'tatobtancourth@gmail.com', 1, 238),
(241, 'tatobtancourth@gmail.com', 1, 239),
(242, 'tatobtancourth@gmail.com', 1, 240),
(243, 'tatobtancourth@gmail.com', 1, 241),
(244, 'tatobtancourth@gmail.com', 1, 242),
(245, 'tatobtancourth@gmail.com', 1, 243),
(246, 'tatobtancourth@gmail.com', 1, 244),
(247, 'tatobtancourth@gmail.com', 1, 245),
(248, 'tatobtancourth@gmail.com', 1, 246),
(249, 'tatobtancourth@gmail.com', 1, 247),
(250, 'tatobtancourth@gmail.com', 1, 248),
(251, 'tatobtancourth@gmail.com', 1, 249),
(252, 'tatobtancourth@gmail.com', 1, 250),
(253, 'abriceno_1984@yahoo.com', 1, 251),
(254, 'may20mel@gmail.com', 1, 252),
(255, 'sheylliherrera@gmail.com', 1, 253),
(256, 'ana.canadas@unah.hn', 1, 254),
(257, 'ana.canadas@unah.hn', 1, 255),
(258, 'ana.canadas@unah.hn', 1, 256),
(259, 'ana.canadas@unah.hn', 1, 257),
(260, 'ana.canadas@unah.hn', 1, 258),
(261, 'ana.canadas@unah.hn', 1, 259),
(262, 'ana.canadas@unah.hn', 1, 260),
(263, 'ana.canadas@unah.hn', 1, 261),
(264, 'ana.canadas@unah.hn', 1, 262),
(265, 'ana.canadas@unah.hn', 1, 263),
(266, 'ana.canadas@unah.hn', 1, 264),
(267, 'ana.canadas@unah.hn', 1, 265),
(268, 'ana.canadas@unah.hn', 1, 266),
(269, 'ana.canadas@unah.hn', 1, 267),
(270, 'ana.canadas@unah.hn', 1, 268),
(271, 'ana.canadas@unah.hn', 1, 269),
(272, 'ana.canadas@unah.hn', 1, 270),
(273, 'ana.canadas@unah.hn', 1, 271),
(274, 'ana.canadas@unah.hn', 1, 272),
(275, 'ana.canadas@unah.hn', 1, 273),
(276, 'ana.canadas@unah.hn', 1, 274),
(277, 'ana.canadas@unah.hn', 1, 275),
(278, 'melania199420@gmail.com', 1, 276),
(279, 'melania199420@gmail.com', 1, 277),
(280, 'melania199420@gmail.com', 1, 278),
(281, 'melania199420@gmail.com', 1, 279),
(282, 'melania199420@gmail.com', 1, 280),
(283, 'melania199420@gmail.com', 1, 281),
(284, 'melania199420@gmail.com', 1, 282),
(285, 'melania199420@gmail.com', 1, 283),
(286, 'melania199420@gmail.com', 1, 284),
(287, 'melania199420@gmail.com', 1, 285),
(288, 'melania199420@gmail.com', 1, 286),
(289, 'melania199420@gmail.com', 1, 287),
(290, 'melania199420@gmail.com', 1, 288),
(291, 'melania199420@gmail.com', 1, 289),
(292, 'melania199420@gmail.com', 1, 290),
(293, 'melania199420@gmail.com', 1, 291),
(294, 'melania199420@gmail.com', 1, 292),
(295, 'mel.pz177@gmail.com', 1, 293),
(296, 'mel.pz177@gmail.com', 1, 294),
(297, 'mel.pz177@gmail.com', 1, 295),
(298, 'mel.pz177@gmail.com', 1, 296),
(299, 'mel.pz177@gmail.com', 1, 297),
(300, 'mel.pz177@gmail.com', 1, 298),
(301, 'mel.pz177@gmail.com', 1, 299),
(302, 'mel.pz177@gmail.com', 1, 300),
(303, 'mel.pz177@gmail.com', 1, 301),
(304, 'mel.pz177@gmail.com', 1, 302),
(305, 'mel.pz177@gmail.com', 1, 303),
(306, 'mel.pz177@gmail.com', 1, 304),
(307, 'mel.pz177@gmail.com', 1, 305),
(308, 'mel.pz177@gmail.com', 1, 306),
(309, 'mel.pz177@gmail.com', 1, 307),
(310, 'mel.pz177@gmail.com', 1, 308),
(311, 'mel.pz177@gmail.com', 1, 309),
(312, 'mel.pz177@gmail.com', 1, 310),
(313, 'mel.pz177@gmail.com', 1, 311),
(314, 'mel.pz177@gmail.com', 1, 312),
(315, 'mel.pz177@gmail.com', 1, 313),
(316, 'mel.pz177@gmail.com', 1, 314),
(317, 'mel.pz177@gmail.com', 1, 315),
(318, 'mel.pz177@gmail.com', 1, 316),
(319, 'mel.pz177@gmail.com', 1, 317),
(320, 'mel.pz177@gmail.com', 1, 318),
(321, 'mel.pz177@gmail.com', 1, 319),
(322, 'mel.pz177@gmail.com', 1, 320),
(323, 'mel.pz177@gmail.com', 1, 321),
(324, 'mel.pz177@gmail.com', 1, 322),
(325, 'mel.pz177@gmail.com', 1, 323),
(326, 'mel.pz177@gmail.com', 1, 324),
(327, 'mel.pz177@gmail.com', 1, 325),
(328, 'mel.pz177@gmail.com', 1, 326),
(329, 'mel.pz177@gmail.com', 1, 327),
(330, 'mel.pz177@gmail.com', 1, 328),
(331, 'may20mel@gmail.com', 1, 329),
(332, 'maylin.montesi@yahoo.com', 1, 330),
(333, 'maylin.montesi@yahoo.com', 1, 331),
(334, 'maylin.montesi@yahoo.com', 1, 332),
(335, 'maylin.montesi@yahoo.com', 1, 333),
(336, 'maylin.montesi@yahoo.com', 1, 334),
(337, 'maylin.montesi@yahoo.com', 1, 335),
(338, 'maylin.montesi@yahoo.com', 1, 336),
(339, 'ana.canadas@unah.hn', 1, 337),
(340, 'ana.canadas@unah.hn', 1, 338),
(341, 'ana.canadas@unah.hn', 1, 339),
(342, 'ana.canadas@unah.hn', 1, 340),
(343, 'ana.canadas@unah.hn', 1, 341),
(344, 'ana.canadas@unah.hn', 1, 342),
(345, 'ana.canadas@unah.hn', 1, 343),
(346, 'ana.canadas@unah.hn', 1, 344),
(347, 'ana.canadas@unah.hn', 1, 345),
(348, 'ana.canadas@unah.hn', 1, 346),
(349, 'ana.canadas@unah.hn', 1, 347),
(350, 'ana.canadas@unah.hn', 1, 348),
(351, 'ana.canadas@unah.hn', 1, 349),
(352, 'ana.canadas@unah.hn', 1, 350),
(353, 'jasonhmorel@gmail.com', 1, 351),
(354, 'jasonhmorel@gmail.com', 1, 352),
(355, 'jasonhmorel@gmail.com', 1, 353),
(356, 'jasonhmorel@gmail.com', 1, 354),
(357, 'jasonhmorel@gmail.com', 1, 355),
(358, 'jason.morel@unah.hn', 1, 356),
(359, 'jason.morel@unah.hn', 1, 357),
(360, 'jason.morel@unah.hn', 1, 358),
(361, 'jason.morel@unah.hn', 1, 359),
(362, 'jason.morel@unah.hn', 1, 360),
(363, 'jason.morel@unah.hn', 1, 361),
(364, 'jason.morel@unah.hn', 1, 362),
(365, 'jason.morel@unah.hn', 1, 363),
(366, 'jason.morel@unah.hn', 1, 364),
(367, 'jason.morel@unah.hn', 1, 365),
(368, 'jason.morel@unah.hn', 1, 366),
(369, 'jason.morel@unah.hn', 1, 367),
(370, 'jason.morel@unah.hn', 1, 368),
(371, 'jason.morel@unah.hn', 1, 369),
(372, 'jason.morel@unah.hn', 1, 370),
(373, 'ana.canadas@unah.hn', 1, 371),
(374, 'ana.canadas@unah.hn', 1, 372),
(375, 'ana.canadas@unah.hn', 1, 373),
(376, 'ana.canadas@unah.hn', 1, 374),
(377, 'ana.canadas@unah.hn', 1, 375),
(378, 'ana.canadas@unah.hn', 1, 376),
(379, 'ana.canadas@unah.hn', 1, 377),
(380, 'ana.canadas@unah.hn', 1, 378),
(381, 'ana.canadas@unah.hn', 1, 379),
(382, 'ana.canadas@unah.hn', 1, 380),
(383, 'ana.canadas@unah.hn', 1, 381),
(384, 'ana.canadas@unah.hn', 1, 382),
(385, 'ana.canadas@unah.hn', 1, 383),
(386, 'ana.canadas@unah.hn', 1, 384),
(387, 'ana.canadas@unah.hn', 1, 385),
(388, 'ana.canadas@unah.hn', 1, 386),
(389, 'ana.canadas@unah.hn', 1, 387),
(390, 'ana.canadas@unah.hn', 1, 388),
(391, 'ana.canadas@unah.hn', 1, 389),
(392, 'doris.suazo@unah.hn', 1, 390),
(393, 'jeymeerobles@gmail.com', 1, 391),
(394, 'jeymeerobles@gmail.com', 1, 392),
(395, 'jeymeerobles@gmail.com', 1, 393),
(396, 'jeymeerobles@gmail.com', 1, 394),
(397, 'jeymeerobles@gmail.com', 1, 395),
(398, 'jeymeerobles@gmail.com', 1, 396),
(399, 'jeymeerobles@gmail.com', 1, 397),
(400, 'jeymeerobles@gmail.com', 1, 398),
(401, 'jeymeerobles@gmail.com', 1, 399),
(402, 'jeymeerobles@gmail.com', 1, 400),
(403, 'jeymeerobles@gmail.com', 1, 401),
(404, 'jeymeerobles@gmail.com', 1, 402),
(405, 'jeymeerobles@gmail.com', 1, 403),
(406, 'jeymeerobles@gmail.com', 1, 404),
(407, 'jeymeerobles@gmail.com', 1, 405),
(408, 'jeymeerobles@gmail.com', 1, 406),
(409, 'jeymeerobles@gmail.com', 1, 407),
(410, 'jeymeerobles@gmail.com', 1, 408),
(411, 'jeymeerobles@gmail.com', 1, 409),
(412, 'jeymeerobles@gmail.com', 1, 410),
(413, 'jeymeerobles@gmail.com', 1, 411),
(414, 'jeymeerobles@gmail.com', 1, 412),
(415, 'jeymeerobles@gmail.com', 1, 413),
(416, 'jeymeerobles@gmail.com', 1, 414),
(417, 'jeymeerobles@gmail.com', 1, 415),
(418, 'jeymeerobles@gmail.com', 1, 416),
(419, 'jeymeerobles@gmail.com', 1, 417),
(420, 'jeymeerobles@gmail.com', 1, 418),
(421, 'jeymeerobles@gmail.com', 1, 419),
(422, 'jeymeerobles@gmail.com', 1, 420),
(423, 'jeymeerobles@gmail.com', 1, 421),
(424, 'jeymeerobles@gmail.com', 1, 422),
(425, 'jeymeerobles@gmail.com', 1, 423),
(426, 'jeymeerobles@gmail.com', 1, 424),
(427, 'jeymeerobles@gmail.com', 1, 425),
(428, 'jeymeerobles@gmail.com', 1, 426),
(429, 'jeymeerobles@gmail.com', 1, 427),
(430, 'jeymeerobles@gmail.com', 1, 428),
(431, 'jeymeerobles@gmail.com', 1, 429),
(432, 'jeymeerobles@gmail.com', 1, 430),
(433, 'jasonhmorel@gmail.com', 1, 431),
(434, 'jeymeerobles@yahoo.com', 1, 432),
(435, 'jeymeerobles@yahoo.com', 1, 433),
(436, 'jeymeerobles@yahoo.com', 1, 434),
(437, 'jeymeerobles@yahoo.com', 1, 435),
(438, 'jeymeerobles@yahoo.com', 1, 436),
(439, 'jeymeerobles@yahoo.com', 1, 437),
(440, 'jeymeerobles@yahoo.com', 1, 438),
(441, 'jeymeerobles@yahoo.com', 1, 439),
(442, 'jeymeerobles@yahoo.com', 1, 440),
(443, 'jeymeerobles@yahoo.com', 1, 441),
(444, 'jeymeerobles@yahoo.com', 1, 442),
(445, 'jeymeerobles@yahoo.com', 1, 443),
(446, 'jeymeerobles@yahoo.com', 1, 444),
(447, 'jeymeerobles@yahoo.com', 1, 445),
(448, 'jeymeerobles@yahoo.com', 1, 446),
(449, 'jeymeerobles@yahoo.com', 1, 447),
(450, 'jeymeerobles@yahoo.com', 1, 448),
(451, 'jeymeerobles@yahoo.com', 1, 449),
(452, 'jeymeerobles@yahoo.com', 1, 450),
(453, 'jeymeerobles@yahoo.com', 1, 451),
(454, 'jeymeerobles@yahoo.com', 1, 452),
(455, 'jeymeerobles@yahoo.com', 1, 453),
(456, 'jeymeerobles@yahoo.com', 1, 454),
(457, 'jeymeerobles@yahoo.com', 1, 455),
(458, 'jeymeerobles@yahoo.com', 1, 456),
(459, 'jeymeerobles@yahoo.com', 1, 457),
(460, 'jeymeerobles@yahoo.com', 1, 458),
(461, 'jeymeerobles@yahoo.com', 1, 459),
(462, 'jeymeerobles@yahoo.com', 1, 460),
(463, 'jeymeerobles@yahoo.com', 1, 461),
(464, 'jeymeerobles@yahoo.com', 1, 462),
(465, 'jeymeerobles@yahoo.com', 1, 463),
(466, 'jeymeerobles@yahoo.com', 1, 464),
(467, 'jeymeerobles@yahoo.com', 1, 465),
(468, 'jeymeerobles@yahoo.com', 1, 466),
(469, 'jeymeerobles@yahoo.com', 1, 467),
(470, 'jeymeerobles@yahoo.com', 1, 468),
(471, 'jeymeerobles@yahoo.com', 1, 469),
(472, 'jeymeerobles@yahoo.com', 1, 470),
(473, 'jeymeerobles@yahoo.com', 1, 471),
(474, 'jeymeerobles@yahoo.com', 1, 472),
(475, 'jeymeerobles@yahoo.com', 1, 473),
(476, 'jeymeerobles@yahoo.com', 1, 474),
(477, 'jeymeerobles@yahoo.com', 1, 475),
(478, 'jeymeerobles@yahoo.com', 1, 476),
(479, 'jeymeerobles@yahoo.com', 1, 477),
(480, 'jeymeerobles@yahoo.com', 1, 478),
(481, 'jeymeerobles@yahoo.com', 1, 479),
(482, 'jeymeerobles@yahoo.com', 1, 480),
(483, 'jeymeerobles@yahoo.com', 1, 481),
(484, 'jeymeerobles@yahoo.com', 1, 482),
(485, 'jeymeerobles@yahoo.com', 1, 483),
(486, 'jeymeerobles@yahoo.com', 1, 484),
(487, 'jeymeerobles@yahoo.com', 1, 485),
(488, 'jeymeerobles@yahoo.com', 1, 486),
(489, 'jeymeerobles@yahoo.com', 1, 487),
(490, 'jeymeerobles@yahoo.com', 1, 488),
(491, 'jeymeerobles@yahoo.com', 1, 489),
(492, 'jeymeerobles@yahoo.com', 1, 490),
(493, 'jeymeerobles@yahoo.com', 1, 491),
(494, 'jeymeerobles@yahoo.com', 1, 492),
(495, 'jeymeerobles@yahoo.com', 1, 493),
(496, 'jeymeerobles@yahoo.com', 1, 494),
(497, 'jeymeerobles@yahoo.com', 1, 495),
(498, 'jeymeerobles@yahoo.com', 1, 496),
(499, 'jeymeerobles@yahoo.com', 1, 497),
(500, 'jeymeerobles@yahoo.com', 1, 498),
(501, 'jeymeerobles@yahoo.com', 1, 499),
(502, 'jeymeerobles@yahoo.com', 1, 500),
(503, 'jeymeerobles@yahoo.com', 1, 501),
(504, 'jeymeerobles@yahoo.com', 1, 502),
(505, 'jeymeerobles@yahoo.com', 1, 503),
(506, 'jeymeerobles@yahoo.com', 1, 504),
(507, 'jeymeerobles@yahoo.com', 1, 505),
(508, 'jeymeerobles@yahoo.com', 1, 506),
(509, 'jeymeerobles@yahoo.com', 1, 507),
(510, 'jeymeerobles@yahoo.com', 1, 508),
(511, 'jeymeerobles@yahoo.com', 1, 509),
(512, 'jeymeerobles@yahoo.com', 1, 510),
(513, 'jeymeerobles@yahoo.com', 1, 511),
(514, 'jeymeerobles@yahoo.com', 1, 512),
(515, 'jeymeerobles@yahoo.com', 1, 513),
(516, 'jeymeerobles@yahoo.com', 1, 514),
(517, 'jeymeerobles@yahoo.com', 1, 515),
(518, 'jeymeerobles@yahoo.com', 1, 516),
(519, 'jeymeerobles@yahoo.com', 1, 517),
(520, 'jeymeerobles@yahoo.com', 1, 518),
(521, 'jeymeerobles@yahoo.com', 1, 519),
(522, 'jeymeerobles@yahoo.com', 1, 520),
(523, 'jeymeerobles@yahoo.com', 1, 521),
(524, 'jeymeerobles@yahoo.com', 1, 522),
(525, 'jeymeerobles@yahoo.com', 1, 523),
(526, 'jeymeerobles@yahoo.com', 1, 524),
(527, 'jeymeerobles@yahoo.com', 1, 525),
(528, 'jeymeerobles@yahoo.com', 1, 526),
(529, 'jeymeerobles@yahoo.com', 1, 527),
(530, 'jeymeerobles@yahoo.com', 1, 528),
(531, 'jeymeerobles@yahoo.com', 1, 529),
(532, 'jeymeerobles@yahoo.com', 1, 530),
(533, 'jeymeerobles@yahoo.com', 1, 531),
(534, 'jeymeerobles@yahoo.com', 1, 532),
(535, 'jeymeerobles@yahoo.com', 1, 533),
(536, 'jeymeerobles@yahoo.com', 1, 534),
(537, 'jeymeerobles@yahoo.com', 1, 535),
(538, 'jeymeerobles@yahoo.com', 1, 536),
(539, 'jeymeerobles@yahoo.com', 1, 537),
(540, 'jeymeerobles@yahoo.com', 1, 538),
(541, 'jeymeerobles@yahoo.com', 1, 539),
(542, 'jeymeerobles@yahoo.com', 1, 540),
(543, 'jeymeerobles@yahoo.com', 1, 541),
(544, 'jeymeerobles@yahoo.com', 1, 542),
(545, 'jeymeerobles@yahoo.com', 1, 543),
(546, 'jeymeerobles@yahoo.com', 1, 544),
(547, 'jeymeerobles@yahoo.com', 1, 545),
(548, 'jeymeerobles@yahoo.com', 1, 546),
(549, 'jeymeerobles@yahoo.com', 1, 547),
(550, 'jeymeerobles@yahoo.com', 1, 548),
(551, 'jeymeerobles@yahoo.com', 1, 549),
(552, 'jeymeerobles@yahoo.com', 1, 550),
(553, 'jeymeerobles@yahoo.com', 1, 551),
(554, 'jeymeerobles@yahoo.com', 1, 552),
(555, 'jeymeerobles@yahoo.com', 1, 553),
(556, 'jeymeerobles@yahoo.com', 1, 554),
(557, 'jeymeerobles@yahoo.com', 1, 555),
(558, 'jeymeerobles@yahoo.com', 1, 556),
(559, 'jeymeerobles@yahoo.com', 1, 557),
(560, 'jeymeerobles@yahoo.com', 1, 558),
(561, 'jeymeerobles@yahoo.com', 1, 559),
(562, 'jeymeerobles@yahoo.com', 1, 560),
(563, 'jeymeerobles@yahoo.com', 1, 561),
(564, 'jeymeerobles@yahoo.com', 1, 562),
(565, 'jeymeerobles@yahoo.com', 1, 563),
(566, 'jeymeerobles@yahoo.com', 1, 564),
(567, 'jeymeerobles@yahoo.com', 1, 565),
(568, 'jeymeerobles@yahoo.com', 1, 566),
(569, 'jeymeerobles@yahoo.com', 1, 567),
(570, 'jeymeerobles@yahoo.com', 1, 568),
(571, 'jeymeerobles@yahoo.com', 1, 569),
(572, 'jeymeerobles@yahoo.com', 1, 570),
(573, 'jeymeerobles@yahoo.com', 1, 571),
(574, 'jeymeerobles@yahoo.com', 1, 572),
(575, 'jeymeerobles@yahoo.com', 1, 573),
(576, 'jeymeerobles@yahoo.com', 1, 574),
(577, 'jeymeerobles@yahoo.com', 1, 575),
(578, 'jeymeerobles@yahoo.com', 1, 576),
(579, 'jeymeerobles@yahoo.com', 1, 577),
(580, 'jeymeerobles@yahoo.com', 1, 578),
(581, 'jeymeerobles@yahoo.com', 1, 579),
(582, 'jeymeerobles@yahoo.com', 1, 580),
(583, 'jeymeerobles@yahoo.com', 1, 581),
(584, 'jeymeerobles@yahoo.com', 1, 582),
(585, 'jeymeerobles@yahoo.com', 1, 583),
(586, 'jeymeerobles@yahoo.com', 1, 584),
(587, 'jeymeerobles@yahoo.com', 1, 585),
(588, 'jeymeerobles@yahoo.com', 1, 586),
(589, 'jeymeerobles@yahoo.com', 1, 587),
(590, 'jeymeerobles@yahoo.com', 1, 588),
(591, 'jeymeerobles@yahoo.com', 1, 589),
(592, 'jeymeerobles@yahoo.com', 1, 590),
(593, 'stiwardeduardo', 1, 591),
(594, 'kaffati.alejandro@gmail.com', 1, 592),
(595, 'kaffati.alejandro@gmail.com', 1, 593),
(596, 'kaffati.alejandro@gmail.com', 1, 594),
(597, 'kaffati.alejandro@gmail.com', 1, 595),
(598, 'kaffati.alejandro@gmail.com', 1, 596),
(599, 'kaffati.alejandro@gmail.com', 1, 597),
(600, 'kaffati.alejandro@gmail.com', 1, 598),
(601, 'kaffati.alejandro@gmail.com', 1, 599),
(602, 'kaffati.alejandro@gmail.com', 1, 600),
(603, 'kaffati.alejandro@gmail.com', 1, 601),
(604, 'kaffati.alejandro@gmail.com', 1, 602),
(605, 'kaffati.alejandro@gmail.com', 1, 603),
(606, 'kaffati.alejandro@gmail.com', 1, 604),
(607, 'kaffati.alejandro@gmail.com', 1, 605),
(608, 'kaffati.alejandro@gmail.com', 1, 606),
(609, 'kaffati.alejandro@gmail.com', 1, 607),
(610, 'kaffati.alejandro@gmail.com', 1, 608),
(611, 'kaffati.alejandro@gmail.com', 1, 609),
(612, 'kaffati.alejandro@gmail.com', 1, 610),
(613, 'kaffati.alejandro@gmail.com', 1, 611),
(614, 'kaffati.alejandro@gmail.com', 1, 612),
(615, 'kaffati.alejandro@gmail.com', 1, 613),
(616, 'kaffati.alejandro@gmail.com', 1, 614),
(617, 'kaffati.alejandro@gmail.com', 1, 615),
(618, 'kaffati.alejandro@gmail.com', 1, 616),
(619, 'kaffati.alejandro@gmail.com', 1, 617),
(620, 'cuellar21@hotmail.es', 1, 618),
(621, 'cuellar21@hotmail.es', 1, 619),
(622, 'cuellar21@hotmail.es', 1, 620),
(623, 'cuellar21@hotmail.es', 1, 621),
(624, 'cuellar21@hotmail.es', 1, 622),
(625, 'tatobtancourth82@gmail.com', 1, 623),
(626, 'belky.mendoza@unah.hn', 1, 624),
(627, 'belky.mendoza@unah.hn', 1, 625),
(628, 'belky.mendoza@unah.hn', 1, 626),
(629, 'belky.mendoza@unah.hn', 1, 627),
(630, 'belky.mendoza@unah.hn', 1, 628),
(631, 'belky.mendoza@unah.hn', 1, 629),
(632, 'belky.mendoza@unah.hn', 1, 630),
(633, 'belky.mendoza@unah.hn', 1, 631),
(634, 'belky.mendoza@unah.hn', 1, 632),
(635, 'belky.mendoza@unah.hn', 1, 633),
(636, 'belky.mendoza@unah.hn', 1, 634),
(637, 'belky.mendoza@unah.hn', 1, 635),
(638, 'belky.mendoza@unah.hn', 1, 636),
(639, 'belky.mendoza@unah.hn', 1, 637),
(640, 'belky.mendoza@unah.hn', 1, 638),
(641, 'belky.mendoza@unah.hn', 1, 639),
(642, 'belky.mendoza@unah.hn', 1, 640),
(643, 'belky.mendoza@unah.hn', 1, 641),
(644, 'belky.mendoza@unah.hn', 1, 642),
(645, 'belky.mendoza@unah.hn', 1, 643),
(646, 'belky.mendoza@unah.hn', 1, 644),
(647, 'belky.mendoza@unah.hn', 1, 645),
(648, 'belky.mendoza@unah.hn', 1, 646),
(649, 'belky.mendoza@unah.hn', 1, 647),
(650, 'belky.mendoza@unah.hn', 1, 648),
(651, 'belky.mendoza@unah.hn', 1, 649),
(652, 'belky.mendoza@unah.hn', 1, 650),
(653, 'belky.mendoza@unah.hn', 1, 651),
(654, 'belky.mendoza@unah.hn', 1, 652),
(655, 'belky.mendoza@unah.hn', 1, 653),
(656, 'belky.mendoza@unah.hn', 1, 654),
(657, 'belky.mendoza@unah.hn', 1, 655),
(658, 'belky.mendoza@unah.hn', 1, 656),
(659, 'belky.mendoza@unah.hn', 1, 657),
(660, 'belky.mendoza@unah.hn', 1, 658),
(661, 'belky.mendoza@unah.hn', 1, 659),
(662, 'belky.mendoza@unah.hn', 1, 660),
(663, 'belky.mendoza@unah.hn', 1, 661),
(664, 'belky.mendoza@unah.hn', 1, 662),
(665, 'belky.mendoza@unah.hn', 1, 663),
(666, 'belky.mendoza@unah.hn', 1, 664),
(667, 'belky.mendoza@unah.hn', 1, 665),
(668, 'belky.mendoza@unah.hn', 1, 666),
(669, 'belky.mendoza@unah.hn', 1, 667),
(670, 'belky.mendoza@unah.hn', 1, 668),
(671, 'belky.mendoza@unah.hn', 1, 669),
(672, 'belky.mendoza@unah.hn', 1, 670),
(673, 'belky.mendoza@unah.hn', 1, 671),
(674, 'belky.mendoza@unah.hn', 1, 672),
(675, 'belky.mendoza@unah.hn', 1, 673),
(676, 'belky.mendoza@unah.hn', 1, 674),
(677, 'belky.mendoza@unah.hn', 1, 675),
(678, 'belky.mendoza@unah.hn', 1, 676),
(679, 'belky.mendoza@unah.hn', 1, 677),
(680, 'belky.mendoza@unah.hn', 1, 678),
(681, 'belky.mendoza@unah.hn', 1, 679),
(682, 'belky.mendoza@unah.hn', 1, 680),
(683, 'belky.mendoza@unah.hn', 1, 681),
(684, 'belky.mendoza@unah.hn', 1, 682),
(685, 'belky.mendoza@unah.hn', 1, 683),
(686, 'belky.mendoza@unah.hn', 1, 684),
(687, 'belky.mendoza@unah.hn', 1, 685),
(688, 'belky.mendoza@unah.hn', 1, 686),
(689, 'belky.mendoza@unah.hn', 1, 687),
(690, 'belky.mendoza@unah.hn', 1, 688);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_costo`
--

CREATE TABLE `tbl_costo` (
  `id_costo_pk` int(11) NOT NULL,
  `producto` varchar(150) DEFAULT NULL,
  `precio_unitario` double DEFAULT NULL,
  `grabado_exento` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina al momento del cobro si quien va a realizar el pago es un estudiante o no, ya que de ser un estudiante se aplicará un costo especial.',
  `descripcion` varchar(45) DEFAULT NULL,
  `valor_antes` double DEFAULT NULL,
  `valor_despues` double DEFAULT NULL,
  `id_congreso_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_costo_x_usuario`
--

CREATE TABLE `tbl_costo_x_usuario` (
  `id_costo_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_factura_detalle_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_espacio`
--

CREATE TABLE `tbl_espacio` (
  `id_espacio_pk` int(11) NOT NULL,
  `nombre_espacio` varchar(100) DEFAULT NULL,
  `nombre_alternativo` varchar(100) DEFAULT NULL,
  `descripcion_espacio` mediumtext,
  `capacidad_personas` int(11) DEFAULT NULL,
  `numero_tomacorriente` int(11) DEFAULT NULL,
  `mapa_espacio` varchar(100) DEFAULT NULL,
  `comentarios` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_espacio_congreso`
--

CREATE TABLE `tbl_espacio_congreso` (
  `id_espacio_fk` int(11) NOT NULL,
  `id_congreso_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estadistica`
--

CREATE TABLE `tbl_estadistica` (
  `id_estadistica_pk` int(11) NOT NULL,
  `nombre_estadistica` longtext,
  `descripcion` longtext,
  `id_tipo_estadistica_fk` int(11) NOT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `id_estado_pk` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombre_estado` varchar(50) DEFAULT NULL COMMENT 'Nombre de estado de congreso, este puede ser, activo, inactivo, etc.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado_congreso`
--

INSERT INTO `tbl_estado_congreso` (`id_estado_congreso_pk`, `nombre_estado`) VALUES
(1, 'Llamado a trabajos'),
(2, 'Revisión');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_idioma`
--

CREATE TABLE `tbl_estado_idioma` (
  `id_estado_idioma_pk` int(11) NOT NULL,
  `nombre_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_estado_idioma`
--

INSERT INTO `tbl_estado_idioma` (`id_estado_idioma_pk`, `nombre_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'En traduccion'),
(4, 'Inhabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura`
--

CREATE TABLE `tbl_factura` (
  `id_factura_pk` int(11) NOT NULL,
  `nombre_organizacion` varchar(45) DEFAULT NULL,
  `rtn` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `direccion` mediumtext,
  `impuesto` varchar(45) DEFAULT NULL,
  `id_rango_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura_detalle`
--

CREATE TABLE `tbl_factura_detalle` (
  `id_factura_detalle_pk` int(11) NOT NULL,
  `id_factura_fk` int(11) NOT NULL,
  `cantidad_adquirida` double DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `total_pagar` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_facultad`
--

CREATE TABLE `tbl_facultad` (
  `id_facultad_pk` int(11) NOT NULL,
  `nombre_facultad` varchar(150) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formulario`
--

CREATE TABLE `tbl_formulario` (
  `id_formulario_pk` int(11) NOT NULL,
  `nombre_formulario` mediumtext,
  `descripcion` longtext,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_formulario`
--

INSERT INTO `tbl_formulario` (`id_formulario_pk`, `nombre_formulario`, `descripcion`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'FORM1', 'zxcvzxv', 3, '2022-02-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formulario_tematica`
--

CREATE TABLE `tbl_formulario_tematica` (
  `id_formulario_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_idioma_fk` varchar(2) NOT NULL,
  `id_persona_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion`
--

CREATE TABLE `tbl_institucion` (
  `id_institucion_pk` int(11) NOT NULL,
  `nombre_institucion` mediumtext,
  `id_tipo_institucion_fk` int(11) NOT NULL,
  `id_pais_fk` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion_carrera`
--

CREATE TABLE `tbl_institucion_carrera` (
  `id_institucion_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_institucion_facultad_carrera`
--

CREATE TABLE `tbl_institucion_facultad_carrera` (
  `id_institucion_facultad_carrera` int(10) UNSIGNED NOT NULL,
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
(1, 'ECONOMÍA Y EMPRENDIMIENTO', '', '', NULL, 1, '2017-03-10', 1, '2017-03-10'),
(2, 'COMPETITIVIDAD, PRODUCTIVIDAD Y CRECIMIENTO ECONÓMICO', '', '', NULL, 1, '2017-04-25', 1, '2017-04-25'),
(3, 'EDUCACIÓN ECONOMÍA Y BIENESTAR', '', '', NULL, 1, '2017-04-25', 1, '2017-04-25'),
(4, 'CAMBIO TECNOLÓGICO: INNOVACIÓN, INCUBACIÓN, ACELERACIÓN Y DESARROLLO', '', '', NULL, 1, '2017-04-25', 1, '2017-04-25'),
(5, 'GESTIÓN DE CONOCIMIENTO Y HERRAMIENTAS INTELIGENTES', '', '', NULL, 1, '2017-04-25', 1, '2017-04-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id_log_pk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `informacion_extra` longtext,
  `id_tipo_log_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mensaje`
--

CREATE TABLE `tbl_mensaje` (
  `id_mensaje_pk` int(11) NOT NULL,
  `asunto` varchar(45) DEFAULT NULL,
  `contenido_mensaje` text,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modulos`
--

CREATE TABLE `tbl_modulos` (
  `id_modulo_pk` int(11) NOT NULL,
  `nombre_modulo` varchar(100) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_modulos`
--

INSERT INTO `tbl_modulos` (`id_modulo_pk`, `nombre_modulo`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Congresos Activos para Registro', 1, '2017-05-13', NULL, NULL),
(2, 'Solicitudes', 1, '2017-05-13', NULL, NULL),
(3, 'Perfil', 1, '2017-05-13', NULL, NULL),
(4, 'Gestión de Roles', 1, '2017-05-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_nivel_educativo`
--

CREATE TABLE `tbl_nivel_educativo` (
  `id_nivel_educativo_pk` int(11) NOT NULL,
  `nombre_nivel_educativo` varchar(150) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_noticia`
--

CREATE TABLE `tbl_noticia` (
  `id_noticia_pk` int(11) NOT NULL,
  `titulo` mediumtext,
  `imagen` mediumtext,
  `descripcion` longtext,
  `id_usuario_congreso_rol_fk` int(11) NOT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_notificacion`
--

CREATE TABLE `tbl_notificacion` (
  `id_notificacion_pk` int(11) NOT NULL,
  `texto_notificacion` longtext,
  `id_usuario_fk` int(11) NOT NULL,
  `fecha_notificacion` date DEFAULT NULL,
  `hora_notificacion` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_organizadores`
--

CREATE TABLE `tbl_organizadores` (
  `id_congreso_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pais`
--

CREATE TABLE `tbl_pais` (
  `id_pais_pk` varchar(2) NOT NULL COMMENT 'Identificador único para cada país.',
  `nombre_pais` longtext COMMENT 'Nombre de cada país (debe escribirse correctamente).',
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id_pais_fk` varchar(2) NOT NULL,
  `id_idioma_fk` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_pais_idioma`
--

INSERT INTO `tbl_pais_idioma` (`id_pais_fk`, `id_idioma_fk`) VALUES
('AD', 'ca'),
('AE', 'ar'),
('AE', 'en'),
('AF', 'fa'),
('AF', 'ps'),
('AG', 'en'),
('AI', 'en'),
('AL', 'sq'),
('AM', 'hy'),
('AN', 'en'),
('AN', 'nl'),
('AO', 'pt'),
('AR', 'es'),
('AS', 'en'),
('AS', 'sm'),
('AT', 'de'),
('AU', 'en'),
('AW', 'nl'),
('AX', 'sv'),
('AZ', 'az'),
('BA', 'bs'),
('BA', 'hr'),
('BA', 'sr'),
('BB', 'en'),
('BD', 'bn'),
('BE', 'de'),
('BE', 'fr'),
('BE', 'nl'),
('BF', 'fr'),
('BG', 'bg'),
('BH', 'ar'),
('BJ', 'fr'),
('BL', 'fr'),
('BM', 'en'),
('BN', 'ms'),
('BO', 'es'),
('BR', 'pt'),
('BS', 'en'),
('BT', 'dz'),
('BV', 'no'),
('BW', 'en'),
('BY', 'ru'),
('BZ', 'en'),
('CA', 'en'),
('CA', 'fr'),
('CC', 'en'),
('CC', 'ms'),
('CF', 'fr'),
('CF', 'sg'),
('CG', 'fr'),
('CG', 'ln'),
('CH', 'de'),
('CH', 'fr'),
('CH', 'it'),
('CH', 'rm'),
('CI', 'fr'),
('CK', 'en'),
('CL', 'es'),
('CM', 'en'),
('CM', 'fr'),
('CN', 'zh'),
('CO', 'es'),
('CR', 'es'),
('CU', 'es'),
('CV', 'pt'),
('CX', 'en'),
('CY', 'el'),
('CY', 'tr'),
('CZ', 'cs'),
('DE', 'de'),
('DJ', 'ar'),
('DJ', 'fr'),
('DK', 'da'),
('DK', 'fo'),
('DK', 'kl'),
('DM', 'en'),
('DO', 'es'),
('DZ', 'ar'),
('EC', 'es'),
('EE', 'et'),
('EG', 'ar'),
('EH', 'ar'),
('EH', 'es'),
('ER', 'ar'),
('ER', 'en'),
('ES', 'es'),
('ET', 'am'),
('FI', 'fi'),
('FI', 'sv'),
('FJ', 'en'),
('FJ', 'fj'),
('FK', 'en'),
('FM', 'en'),
('FO', 'da'),
('FO', 'fo'),
('FR', 'fr'),
('GA', 'fr'),
('GB', 'en'),
('GD', 'en'),
('GE', 'ka'),
('GF', 'fr'),
('GG', 'en'),
('GG', 'fr'),
('GH', 'en'),
('GI', 'en'),
('GL', 'kl'),
('GM', 'en'),
('GN', 'fr'),
('GP', 'fr'),
('GQ', 'es'),
('GQ', 'fr'),
('GQ', 'pt'),
('GR', 'el'),
('GS', 'en'),
('GT', 'es'),
('GU', 'ch'),
('GU', 'en'),
('GW', 'pt'),
('GY', 'en'),
('HK', 'en'),
('HM', 'en'),
('HN', 'es'),
('HR', 'hr'),
('HT', 'fr'),
('HU', 'hu'),
('ID', 'id'),
('IE', 'en'),
('IL', 'ar'),
('IL', 'he'),
('IM', 'en'),
('IM', 'gv'),
('IN', 'en'),
('IN', 'hi'),
('IO', 'en'),
('IQ', 'ar'),
('IR', 'fa'),
('IS', 'is'),
('IT', 'it'),
('JE', 'en'),
('JE', 'fr'),
('JM', 'en'),
('JO', 'ar'),
('JP', 'ja'),
('KE', 'en'),
('KE', 'sw'),
('KG', 'ky'),
('KG', 'ru'),
('KH', 'km'),
('KI', 'en'),
('KM', 'ar'),
('KM', 'fr'),
('KM', 'sw'),
('KN', 'en'),
('KP', 'ko'),
('KR', 'ko'),
('KW', 'ar'),
('KY', 'en'),
('KZ', 'kk'),
('KZ', 'ru'),
('LA', 'lo'),
('LB', 'ar'),
('LB', 'fr'),
('LC', 'en'),
('LI', 'de'),
('LK', 'ru'),
('LK', 'si'),
('LR', 'en'),
('LS', 'en'),
('LS', 'st'),
('LT', 'lt'),
('LU', 'de'),
('LU', 'fr'),
('LU', 'lb'),
('LV', 'lv'),
('LY', 'ar'),
('MA', 'ar'),
('MC', 'fr'),
('MD', 'ro'),
('MG', 'fr'),
('MG', 'mg'),
('MH', 'en'),
('MH', 'mh'),
('MK', 'mk'),
('ML', 'so'),
('MM', 'my'),
('MN', 'mn'),
('MO', 'pt'),
('MQ', 'fr'),
('MR', 'ar'),
('MS', 'en'),
('MT', 'en'),
('MT', 'mt'),
('MU', 'en'),
('MU', 'pt'),
('MV', 'dv'),
('MW', 'en'),
('MW', 'ny'),
('MX', 'es'),
('MY', 'en'),
('MY', 'ms'),
('MZ', 'pt'),
('NA', 'af'),
('NA', 'de'),
('NC', 'fr'),
('NE', 'fr'),
('NF', 'en'),
('NG', 'en'),
('NI', 'es'),
('NL', 'nl'),
('NO', 'no'),
('NP', 'ne'),
('NR', 'en'),
('NR', 'na'),
('NU', 'en'),
('NU', 'na'),
('NZ', 'en'),
('OM', 'ar'),
('PA', 'es'),
('PE', 'es'),
('PF', 'fr'),
('PF', 'ty'),
('PG', 'en'),
('PH', 'en'),
('PK', 'en'),
('PK', 'ur'),
('PL', 'pl'),
('PM', 'fr'),
('PN', 'en'),
('PR', 'en'),
('PR', 'es'),
('PS', 'ar'),
('PT', 'pt'),
('PW', 'en'),
('PW', 'ja'),
('PY', 'es'),
('PY', 'gn'),
('QA', 'ar'),
('RE', 'fr'),
('RO', 'ro'),
('RS', 'sr'),
('RU', 'ru'),
('RW', 'en'),
('RW', 'fr'),
('SA', 'ar'),
('SB', 'en'),
('SC', 'en'),
('SC', 'fr'),
('SD', 'ar'),
('SD', 'en'),
('SE', 'sv'),
('SG', 'en'),
('SG', 'ms'),
('SG', 'zh'),
('SH', 'en'),
('SI', 'sl'),
('SJ', 'no'),
('SK', 'sk'),
('SL', 'en'),
('SM', 'it'),
('SN', 'fr'),
('SO', 'so'),
('SR', 'nl'),
('ST', 'pt'),
('SV', 'es'),
('SY', 'ar'),
('SZ', 'en'),
('SZ', 'ss'),
('TC', 'en'),
('TD', 'ar'),
('TD', 'fr'),
('TF', 'fr'),
('TG', 'fr'),
('TK', 'en'),
('TK', 'sm'),
('TL', 'pt'),
('TN', 'ar'),
('TO', 'en'),
('TO', 'to'),
('TR', 'tr'),
('TT', 'en'),
('TV', 'en'),
('TW', 'zh'),
('UA', 'uk'),
('UG', 'en'),
('UG', 'sw'),
('US', 'en'),
('UY', 'es'),
('UZ', 'ru'),
('VA', 'it'),
('VA', 'la'),
('VC', 'en'),
('VE', 'es'),
('VG', 'en'),
('VI', 'en'),
('VN', 'vi'),
('VU', 'bi'),
('VU', 'en'),
('VU', 'fr'),
('WF', 'bi'),
('WF', 'en'),
('WF', 'fr'),
('WS', 'en'),
('WS', 'sm'),
('YE', 'ar'),
('YT', 'fr'),
('ZA', 'af'),
('ZA', 'en');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_patrocinador`
--

CREATE TABLE `tbl_patrocinador` (
  `id_patrocinador_pk` int(11) NOT NULL,
  `nombre_patrocinador` mediumtext NOT NULL,
  `url` longtext,
  `id_persona_contacto` int(11) NOT NULL,
  `descripcion` longtext,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `id_tipo_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perfiles`
--

CREATE TABLE `tbl_perfiles` (
  `id_perfil_pk` int(11) NOT NULL,
  `id_usuario_congreso_roles_fk` int(11) NOT NULL,
  `resumen_bibliografico` varchar(250) DEFAULT NULL,
  `certificado` tinyint(1) DEFAULT NULL,
  `codigo` varchar(150) DEFAULT NULL,
  `institucion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'José', ' ', 'Rodríguez', ' ', '04081985000565', 1, 2, 1, 'HN'),
(2, 'Alex', '', 'Vargas', ' ', '0801199301292', 1, 2, 1, 'HN'),
(3, 'Obed', ' Humberto', 'Martinez', ' Reyes', '1208198900023', 2, 2, 1, 'HN'),
(4, 'Obed', 'Fernando', 'Arzú', 'Sambulá', '0801-1989-03060', 2, 2, 1, 'HN'),
(5, 'LEONELA', 'ALEXANDRA', 'TURCIOS', 'RUIZ', '0801199414839', 1, 2, 1, 'HN'),
(6, 'JORGE', 'AMET', 'POMARE', 'GOMEZ', '0801199522171', 1, 2, 1, 'HN'),
(7, 'CLARISA', 'CELESTE', 'VALLEJO', 'GARCIA', '0715199500606', 1, 1, 1, 'HN'),
(8, 'Angelica', 'Maria', 'Rosales', 'Ramos', '0801199023880', 1, 2, 1, 'HN'),
(11, 'jesus', ' ', 'argueta', ' ', '0801198020000', 2, 1, 1, 'HN'),
(12, 'YESY', 'LORELY', 'HERRERA', 'POSADAS', '1406199500017', 1, 2, 1, 'HN'),
(13, 'ARLETH', 'MAYLIN', 'TURCIOS', 'GOMEZ', '0703199700048', 1, 2, 1, 'HN'),
(14, 'RAFAEL', 'ANTONIO', 'VALLADARES', 'ARGUIJO', '0801199613132', 1, 2, 1, 'HN'),
(15, 'Eduard', 'J.', 'Huete', 'Flores', '0801198713612', 2, 1, 1, 'HN'),
(20, 'jose', ' ', 'varela', 'alvarez', '0801-1992-16794', 1, 2, 1, 'HN'),
(21, 'Carlos', ' ', 'Urbina', ' ', '0801199306119', 2, 2, 1, 'HN'),
(22, 'Ileana', 'Beatriz', 'Marroquin', 'Martinez', '04650673-5', 2, 2, 1, 'SV'),
(23, 'Jorge', ' ', 'Flores', ' ', 'qYVL4Rgg5cfp', 1, 1, 1, 'HN'),
(24, 'Jose', '', 'Arrazola', '', 'cQuh3NoegUoA', 1, 2, 1, 'HN'),
(25, 'Marlon', 'Gustavo', 'Cerrato', 'Diaz', '0801-1989-00056', 2, 2, 1, 'HN'),
(26, 'Julio', ' ', 'Zavala', ' ', '0801198417918', 2, 2, 1, 'HN'),
(27, 'Javier', 'Edgardo', 'Mejia', 'Matute', '1503-1995-02080', 1, 2, 1, 'HN'),
(28, 'Manuel', 'Antonio', 'Flores', 'Fonseca', '0801196105777', 2, 2, 1, 'HN'),
(29, 'Ludwin', 'Arturo', 'López', 'Flores', '0801197210708', 1, 2, 1, 'HN'),
(30, 'Verenice', 'Jakeline', 'Garcia', 'Canizales', '0801199618666', 1, 2, 1, 'HN'),
(31, 'Celeo', 'Emilio', 'Arias', 'Moncada', 'L7L38X443', 2, 2, 1, 'HN'),
(32, 'Juan', 'Jose', 'Ortiz', 'Perez', '0801-1993-08589', 1, 2, 1, 'HN'),
(33, 'Javier', 'Enrique', 'DelCid', ' ', '0801198009801', 1, 2, 1, 'HN'),
(34, 'Evelyn', ' ', 'Aguilera', 'Calix', '0611-1992-00954', 1, 2, 1, 'HN'),
(35, 'Cesar', '', 'Ortega', '', '0301-1970-00440', 1, 2, 1, 'HN'),
(36, 'Marcia', 'Yasmina', 'Moncada', 'Moncada', '0801198712085', 1, 2, 1, 'HN'),
(38, 'Lino', ' ', 'Millian', ' ', 'OTzKRXXUjgeq', 1, 1, 1, 'HN'),
(39, 'karla', ' ', 'Vasquez', ' ', 'hjeDpofcd4p3', 1, 1, 1, 'HN'),
(40, 'Mario', ' ', 'Hernandez', ' ', '0NkuBQIcFydK', 1, 1, 1, 'HN'),
(41, 'Oscar', ' ', 'Gamez', ' ', 'K9YjvkP2s2Yx', 1, 1, 1, 'HN'),
(42, 'Anneli', ' ', 'Banegas', ' ', '2qYs94r0aOxG', 1, 1, 1, 'HN'),
(43, 'Karen', ' ', 'Gomez', ' ', 'bU85AQX4CHYk', 1, 1, 1, 'HN'),
(44, 'Lini', ' ', 'Lemus', ' ', 'LAd27brkTPEf', 1, 1, 1, 'HN'),
(45, 'Daniela', ' ', 'Hurst', ' ', '7TEdiiz6MvNs', 1, 1, 1, 'HN'),
(46, 'Andrea', '', 'Moncada', ' ', 'HfUcUiomcMF1', 1, 1, 1, 'HN'),
(47, 'Dany', ' ', 'Najera', ' ', 'gZUSm3YLb3w7', 1, 1, 1, 'HN'),
(48, 'Alejandro', 'Jose', 'Acosta', 'Gonzalez', '0801199304781', 1, 2, 1, 'HN'),
(49, 'Ricardo', ' ', 'Barrientos', ' ', 'zBedL2qCJcvJ', 1, 1, 1, 'HN'),
(50, 'Adriana', ' ', 'Raudales', ' ', 'Lq6z3wQT0z44', 1, 1, 1, 'HN'),
(51, 'Claudia', 'Estela', 'Rivera', 'Rodríguez', '0801-1992-08092', 1, 2, 1, 'HN'),
(52, 'Norma', 'Adriana', 'Castillo', 'Bertrand', '0801196106373', 2, 1, 1, 'HN'),
(53, 'Marvin', 'Josué', 'Aguilar', 'Romero', '0408198500056', 2, 2, 1, 'HN'),
(54, 'José', 'Luis', 'Rodríguez', 'García', '0408198500056', 1, 2, 1, 'HN'),
(55, 'Ammy', ' ', 'Lanza', ' ', 'ZKqFvhRTvvel', 1, 1, 1, 'HN'),
(56, 'Nelson', ' ', 'Raudales', ' ', '0801197302103', 2, 2, 1, 'HN'),
(57, 'Jeison', 'Eduardo', 'Gomes', 'Escobar', '1501199304526', 1, 2, 1, 'HN'),
(58, 'Jose', ' ', 'Galeano', ' ', 'bkFVin0kZKHl', 1, 1, 1, 'HN'),
(61, 'Margarita', 'Elizabeth', 'Díaz', 'Reyes', '0801-1981-43038', 2, 2, 1, 'HN'),
(62, 'MARIA', 'AUXILIADORA', 'LOPEZ', 'MENDEZ', '0801198510334', 2, 2, 1, 'HN'),
(64, 'Mario', ' ', 'Roberto', ' ', '0801198604274', 2, 2, 1, 'HN'),
(65, 'Norma', 'Adriana', 'Castillo', ' ', '0801-1961-06373', 2, 1, 1, 'HN'),
(66, 'Rafaela', ' ', 'Alfalla', ' ', 'oegY9IztTJqA', 1, 1, 1, 'HN'),
(68, 'Brayan', ' ', 'Triminio', ' ', '0801-1993-04475º', 2, 2, 1, 'HN'),
(69, 'Victor', 'Emanuel', 'Ordoñez', 'Portillo', '0801199518890', 2, 2, 1, 'HN'),
(70, 'Sunee', ' ', 'Eiamwasant', 'López', '0801197915019', 2, 2, 1, 'HN'),
(71, 'Edna', 'Gabriela', 'Martínez', 'Reyes', '0801198517525', 1, 1, 1, 'HN'),
(72, 'José', ' ', 'Cabrera', 'Rosales', '1503198901950', 2, 2, 1, 'HN'),
(73, 'Guianni', ' ', 'Aguero', ' ', '0801198304304', 2, 0, 1, 'HN'),
(74, '', ' ', '', ' ', 'DbKHdLEcMCnh', 1, 1, 1, 'HN'),
(75, 'Jose', 'Carlo', 'Bermúdez', 'Sánchez', '0801-1995-18805', 1, 2, 1, 'HN'),
(76, 'Jessy', 'Yolani', 'Molina', 'Esquivel', '1313-1994-00034', 1, 2, 1, 'HN'),
(77, 'Genesis', ' ', 'Aguilar', ' ', 'HndgljmOOMoe', 1, 1, 1, 'HN'),
(78, 'Ingris', ' ', 'Bonilla', ' ', 'daFvWBUt0kru', 1, 1, 1, 'HN'),
(79, 'Jeni', ' ', 'Vasquez', ' ', '3Hmv192CRgXv', 1, 1, 1, 'HN'),
(80, 'Yanny', ' ', 'Milla', ' ', 'iFbCx9MjbEVf', 1, 1, 1, 'HN'),
(81, 'Madelyn', 'Dayana', 'Guzmán', 'Fonseca', '0510199701521', 1, 2, 1, 'HN'),
(82, 'joselin', 'stefany', 'galdamez', 'galo', '0715199300036', 1, 2, 1, 'HN'),
(83, 'Jemerson', ' ', 'Elvir', ' ', 'A6gMMwSlpWqE', 1, 1, 1, 'HN'),
(84, 'Mirna', ' ', 'Fernández', ' ', 'GtDLFf4GoJv1', 1, 1, 1, 'HN'),
(85, 'Diego', ' ', 'Velásquez', ' ', '9aDGONyJ5kBv', 1, 1, 1, 'HN'),
(86, 'Sara', 'Abigail', 'Rosales', 'Rivera', '0801199605820', 1, 2, 1, 'HN'),
(87, 'Daniel', 'Enrique', 'Martinez', 'Sarmiento', '1811199300449', 1, 2, 1, 'HN'),
(88, 'Michell', 'Stefannia', 'Amador', 'Ramos', '0801-1994.19626', 1, 2, 1, 'HN'),
(89, 'Michell', 'Stefannia', 'Amador', 'Ramos', '0801-1994-19626', 1, 2, 1, 'HN'),
(90, 'Wendy', 'Elizabeth', 'Amaya', 'Santos', '0401-1991-01338', 1, 0, 1, 'HN'),
(91, 'Wendy', 'Elizabeth', 'Amaya', 'Santos', '0401-1991-01338', 1, 0, 1, 'HN'),
(92, 'Angélica', '', 'Almendarez', ' ', 'IPWtLJyjs72B', 1, 1, 1, 'HN'),
(93, 'Francis', '', 'Paz', ' ', 'eJV1f3Azggjw', 1, 1, 1, 'HN'),
(94, 'Dalma', ' ', 'Garcíare', ' ', 'uj9kdHI6jrqf', 1, 1, 1, 'HN'),
(95, 'Lucia', '', 'Bulnes', '', 'CMCuORHmXNVU', 1, 1, 1, 'HN'),
(96, 'Fredy', ' ', 'Martinez', ' ', 'cNk43eVQ8MrZ', 1, 1, 1, 'HN'),
(97, 'Amalia', ' ', 'Díaz', ' ', '43QEi3iZS5O0', 1, 1, 1, 'HN'),
(98, 'Tania', ' ', 'Escobar', ' ', '1BAj4B2O5Ge1', 1, 1, 1, 'HN'),
(99, 'Melba', ' ', 'Núñez', ' ', 'AtKUdZF3nLgK', 1, 1, 1, 'HN'),
(100, 'Anny', ' ', 'Gonzales', ' ', 'nQ1MOCizBrfu', 1, 1, 1, 'HN'),
(101, 'Kerlyn', ' ', 'Burgos', ' ', '0801-1995-03969', 1, 2, 1, 'HN'),
(102, 'Martha', 'Liliana', 'Avila', 'Lopez', '0703-1992-00549', 1, 2, 1, 'HN'),
(103, 'Narmin', 'Maryliz', 'Rosales', 'Cruz', '0801199513771', 1, 2, 1, 'HN'),
(104, 'Caludia', ' ', 'Moreno', ' ', 'mSXpC2JyFdkS', 1, 1, 1, 'HN'),
(105, 'Patricia', ' ', 'Morales', ' ', 'IqH1YU6hfPMS', 1, 1, 1, 'HN'),
(106, 'Allam', ' ', 'Acosta', ' ', 'zD5F2eEr2CH3', 1, 1, 1, 'HN'),
(107, 'Gabriela', '', 'Polanco', 'Hernandez', '0410199800376', 1, 2, 1, 'HN'),
(108, 'Victoria', ' ', 'Ramos', ' ', '2cp7IjrsI1fV', 1, 1, 1, 'HN'),
(109, 'Gloria', 'Raquel', 'Coello', 'Mejia', '0601-1993-01481', 1, 2, 1, 'HN'),
(110, 'Francisco', ' ', 'Paz', ' ', '0801199603837', 1, 2, 1, 'HN'),
(111, 'Miriam', ' ', 'Guevara', ' ', 'fyrvhvgXMYQq', 1, 1, 1, 'HN'),
(112, 'Mary', ' ', 'Cruz', ' ', 'BuekyFBselzm', 1, 1, 1, 'HN'),
(113, 'Rudy', 'Martinez', 'Martinez', 'Colindres', '0816-1995-00449', 1, 2, 1, 'HN'),
(114, 'Jonathan', 'Jader', 'Sabas', 'Gonzalez', '0801-1994-18033', 1, 2, 1, 'HN'),
(115, 'Alejandra', 'Pamela', 'Morales', 'Cerna', '0801-1989-22731', 1, 2, 1, 'HN'),
(116, 'Angel', 'Abraham', 'Salinas', 'Espinal', '0602199000165', 1, 2, 1, 'HN'),
(117, 'Isis', ' ', 'Ramos', ' ', 'zqMWF1DKyU6c', 1, 1, 1, 'HN'),
(118, 'Ellen', ' ', 'Sevilla', ' ', 'M8bIa3Y3Tyiw', 1, 1, 1, 'HN'),
(119, 'Nelson', ' ', 'Silva', ' ', 'FqBsoPLO0mVh', 1, 1, 1, 'HN'),
(120, 'Kathy', ' ', 'Ramos', ' ', '0801199423289', 1, 2, 1, 'HN'),
(121, 'Josue', 'Adonai', 'Pineda', 'Elvir', '0801198817864', 1, 2, 1, 'HN'),
(122, 'Wilkie', ' ', 'Salinas', ' ', 'dF58e9lHFw27', 1, 1, 1, 'HN'),
(123, 'Senayda', ' ', 'Herrera', ' ', 'Y3Zb9FeBIata', 1, 1, 1, 'HN'),
(124, 'Kevin', 'Aaron', 'Irias', 'Ruiz', '0808-1994-00248', 1, 2, 1, 'HN'),
(125, 'Gabriela', 'Samanta', 'Rodriguez', 'Soto', '0801199307540', 1, 0, 1, 'HN'),
(126, 'Alejandra', ' ', 'Triminio', ' ', 'XjAqdiQr4EqQ', 1, 1, 1, 'HN'),
(127, 'Annie', ' ', 'Godoy', ' ', 'd1km77mbKYWO', 1, 1, 1, 'HN'),
(128, 'Mirna', '', 'Romero', ' ', '2iVqZRuTUDmT', 1, 1, 1, 'HN'),
(129, 'Selvin', '', 'Zuniga', ' ', 'B4BfAiAWPoaQ', 1, 1, 1, 'HN'),
(130, 'Kevin', 'Aaron', 'Irias', 'Ruiz', '0808-1994-00248', 1, 2, 1, 'HN'),
(131, 'issis', 'gabriela', 'Rodriguez', 'Rodriguez', '0801199123083', 1, 2, 1, 'HN'),
(132, 'Kenia', '', 'Torres', '', 'eyRsxpUV9JdV', 1, 1, 1, 'HN'),
(133, 'Daniela', ' ', 'Avila', ' ', 'ftlEc1m7qvaO', 1, 1, 1, 'HN'),
(134, 'Haydee', 'Guadalupe', 'Mendoza', 'Laínez', '0101-1995-00415', 1, 2, 1, 'HN'),
(135, 'Rosa', ' ', 'Padilla', ' ', 'EM16bDzRBTob', 1, 1, 1, 'HN'),
(136, 'Lenin', ' ', 'Mateo', ' ', '1qCDtosfl6kT', 1, 1, 1, 'HN'),
(137, 'David', 'Daniel', 'Diaz', ' ', '0801198311494', 1, 2, 1, 'HN'),
(138, 'Vivian', ' ', 'Figueroa', ' ', 'aNoHb37WDc5Y', 1, 1, 1, 'HN'),
(139, 'Iris', 'Indira', 'Alvarenga', 'Alvarado', '0801198506302', 1, 2, 1, 'HN'),
(140, 'Aldo', '', 'Ferrera', ' ', '', 1, 1, 1, 'HN'),
(141, 'Jessica', ' ', 'Gomez', ' ', 'akKqW9e83gKC', 1, 1, 1, 'HN'),
(142, 'Arely', 'Yamileth', 'Flores', 'Flores', '0801198303762', 1, 2, 1, 'HN'),
(143, 'Rosi', ' ', 'Barrientos', ' ', 'udPSpBIlzxEb', 1, 1, 1, 'HN'),
(144, 'Juana', ' ', 'Marroquín', ' ', 'YSmFtyF0rkL5', 1, 1, 1, 'HN'),
(145, 'Javier', ' ', 'Del', 'Cid', 'F6IoE8O4IUrc', 1, 1, 1, 'HN'),
(146, 'Orlando', 'Nathanael', 'Barrientos', 'Zeron', '0801198919159', 1, 2, 1, 'HN'),
(147, 'Gissell', 'Alejandra', 'López', 'Canales', '0101-1994-02676', 1, 2, 1, 'HN'),
(148, 'Douglas', 'Gustavo', 'Torres', 'López', '0801199320704', 1, 2, 1, 'HN'),
(149, 'Javier', ' ', 'Del', 'Cid', 'TmdBgRAjaqzE', 1, 1, 1, 'HN'),
(150, 'Jorge', ' ', 'Alvarez', ' ', 'pIsmxxhVMR5O', 1, 1, 1, 'HN'),
(151, 'Vilma', '', 'Hernandez', ' ', 'lOYM0hRWA1vz', 1, 1, 1, 'HN'),
(152, 'Vianney', 'Sthefhany', 'Mendez', 'Canales', '0801199703755', 1, 0, 0, 'HN'),
(153, 'andrea', 'celeste', 'flores', 'galo', '0703-1997-01684', 1, 2, 1, 'HN'),
(154, 'José', ' ', 'Cruz', ' ', 'PGvgIusBjjAq', 1, 1, 1, 'HN'),
(155, 'Diana', ' ', 'Cantillano', ' ', '6kVkfXahnez7', 1, 1, 1, 'HN'),
(156, 'Cenia', ' ', 'Martinez', ' ', 'IMFIjD7ZOvmZ', 1, 1, 1, 'HN'),
(157, 'Jennifer', ' ', 'Canales', ' ', 'mZtwfIE7bmy2', 1, 1, 1, 'HN'),
(158, 'Xiomara', ' ', 'Cruz', ' ', 'umqTMY0fZr9m', 1, 1, 1, 'HN'),
(159, 'Erika', ' ', 'Mejía', ' ', 'Fhscu9Pvy47b', 1, 1, 1, 'HN'),
(160, 'Lilian', 'Yesenia', 'Salgado', 'Ponce', '0801-1992-01324', 1, 0, 1, 'HN'),
(161, 'Diana', '', 'Eguigure', '', '6XHABuQVe9OD', 1, 1, 1, 'HN'),
(162, 'Aldair', ' ', 'Cantarero', ' ', 'QQBumvDz73QX', 1, 1, 1, 'HN'),
(163, 'Bessy', ' ', 'Pavon', ' ', 'NkLIklzUjHVL', 1, 1, 1, 'HN'),
(164, 'Cristian', 'Arnaldo', 'Gonzalez', 'Canaca', '0801199800592', 1, 2, 1, 'HN'),
(165, 'Maria', '', 'Aguilar', '', '0801199507249', 1, 2, 1, 'HN'),
(166, 'Shafik', '', 'Shaurieh', '', '0101199303714', 1, 1, 1, 'HN'),
(167, 'Greinely', '', 'Gutiérrez', '', 'Nstbt0ENrYOu', 1, 1, 1, 'HN'),
(168, 'Maritza', ' ', 'Romero', ' ', 'vYPLouampFqX', 1, 1, 1, 'HN'),
(169, 'Yara', ' ', 'Núñez', ' ', 'WWKtDabTR5On', 1, 1, 1, 'HN'),
(170, 'Katy', ' ', 'Mendez', ' ', 'DD8cDmUbv9Rp', 1, 1, 1, 'HN'),
(171, 'Larissa', ' ', 'Martínez', 'Castillo', '0801199222285', 1, 2, 1, 'HN'),
(172, 'Daniela', 'Alejandra', 'Rico', 'Rivas', '0801-1995-11183', 1, 2, 1, 'HN'),
(173, 'kener', 'mauricio', 'reyes', 'moncada', '0801199402311', 1, 2, 1, 'HN'),
(174, 'Marlon', 'Gilberto', 'Medina', 'Berrios', '0408-1996-00073', 1, 2, 1, 'HN'),
(175, 'Maria', ' ', 'Flores', ' ', 'PfzFnFvJD76H', 1, 1, 1, 'HN'),
(176, 'Katerine', '', 'Baquedano', '', 'vq79mcjfvac3', 1, 2, 1, 'HN'),
(177, 'Walter', ' ', 'Vega', ' ', 'TBVdjL0oetKA', 1, 1, 1, 'HN'),
(178, 'Jennifer', ' ', 'Amador', ' ', 'wmcRuIa1aggk', 1, 1, 1, 'HN'),
(179, 'Francisco', ' ', 'Peralta', ' ', 'HjKTSfKmqYCZ', 1, 1, 1, 'HN'),
(180, 'evelin', 'jocex', 'corea', 'montes', '0814199300672', 1, 2, 1, 'HN'),
(181, 'ana', 'grisel', 'palma', 'rodriguez', '0801199600625', 1, 1, 1, 'HN'),
(182, 'Mahely', ' ', 'Morga', ' ', '8bOg3ilBSa0q', 1, 1, 1, 'HN'),
(183, 'Luis', '', 'Flores', '', '0703199203183', 1, 2, 1, 'HN'),
(184, 'Merlyn', 'Ninoska', 'Flores', 'Varela', '0801-199124970', 1, 2, 1, 'HN'),
(185, 'Lester', ' ', 'Beltrán', ' ', 'kBI3V1WvfhXS', 1, 1, 1, 'HN'),
(186, 'Dilcia', ' ', 'Ávila', ' ', 'd3YA3lFYvHOf', 1, 1, 1, 'HN'),
(187, 'Keidy', '', 'Figueroa', '', 'fwlZvTWtISum', 1, 1, 1, 'HN'),
(188, 'Eileen', ' ', 'Castillo', ' ', 'GnypBCMBHXIj', 1, 1, 1, 'HN'),
(189, 'Clara', 'Ibeth', 'Rivera', 'Portillo', '0301 1996 00850', 1, 2, 1, 'HN'),
(190, 'evelin', 'jocex', 'corea', 'montes', '0814199300672', 1, 2, 1, 'HN'),
(191, 'Jackelyne', '', 'Servellon', '', '0801199111942', 1, 2, 1, 'HN'),
(192, 'Katherine', 'Mariell', 'Nuñez', 'Oyuela', '0801199313086', 1, 2, 1, 'HN'),
(193, 'Emilia', ' ', 'Soriano', ' ', 'MpDV3jBmqhnB', 1, 1, 1, 'HN'),
(194, 'Laura', '', 'Bustillo', '', 'qRvASEf5FHaX', 1, 1, 1, 'HN'),
(195, 'Sara', '', 'Morazán', '', '0801199410729', 1, 2, 1, 'HN'),
(196, 'Jennifer', ' ', 'Flores', ' ', 'CSXLNvKNM6aZ', 1, 1, 1, 'HN'),
(197, 'Carlos', '', 'Elvir', '', '0826199500195', 1, 2, 1, 'HN'),
(199, 'Griselda', ' ', 'Matute', ' ', 'zQI3egpCLYia', 1, 1, 1, 'HN'),
(200, 'Valeria', 'Marcela', 'Dubon', 'Paz', '0801 1998 01037', 1, 2, 1, 'HN'),
(201, 'Elmer', 'Omar', 'Carcamo', 'Burgos', '1707-1993-00859', 1, 2, 1, 'HN'),
(202, 'bryan', '', 'carranza', ' ', '0801199423405', 1, 2, 1, 'HN'),
(203, 'Astrid', '', 'velasquez', ' ', 'bx7Ra8DOTJej', 1, 1, 1, 'HN'),
(204, 'Milton', ' ', 'Maldonado', '', '78yHlHxuNPLj', 1, 1, 1, 'HN'),
(205, 'Yuzari', ' ', 'Brizuela', ' ', 'MAztcqMTNpnd', 1, 1, 1, 'HN'),
(206, 'Ambar', ' ', 'Izaguirre', ' ', 'zrTfvQd1zBIk', 1, 1, 1, 'HN'),
(207, 'Andrea', ' ', 'Betancourth', ' ', 'HCJn9v8U7L6y', 1, 1, 1, 'HN'),
(208, 'Mercedes', ' ', 'Estrada', ' ', 'S8szpLbnfty5', 1, 1, 1, 'HN'),
(209, 'Eliel', ' ', 'Zelaya', ' ', 'QnRH8wXNBswj', 1, 1, 1, 'HN'),
(210, 'Clarisa', '', 'Fortin', '', '0801199606877', 1, 2, 1, 'HN'),
(211, 'David', '', 'Garcia', ' ', 'q9gCWlnY67lQ', 1, 1, 1, 'HN'),
(212, 'Cristhian', ' ', 'Cardenas', ' ', 'IZe7i2V6oTTy', 1, 1, 1, 'HN'),
(213, 'Maria', 'Alejandra', 'Fiallos', 'Pineda', '0318-1997-00130', 1, 2, 1, 'HN'),
(214, 'Yuzari', ' ', 'Brizuela', '', 'W46TtXFEF8Ge', 1, 1, 1, 'HN'),
(215, 'Omar', ' ', 'Maradiaga', ' ', 'kvWb8o16HVv7', 1, 1, 1, 'HN'),
(216, 'Hugo', ' ', 'Tejeda', ' ', 'VxN14yvJADHi', 1, 1, 1, 'HN'),
(217, 'Celina', 'María', 'Ramírez', 'Díaz', '0801199316000', 1, 2, 1, 'HN'),
(218, 'Alexander', 'Antonio', 'Girón', 'Montoya', '0801-1993-05986', 1, 2, 1, 'HN'),
(219, 'Dayni', '', '', 'López', 'WCoXUXFYYslW', 1, 1, 1, 'HN'),
(220, 'Taria', 'Fabiola', 'Andino', 'Ruiz', '0801199020956', 2, 2, 1, 'HN'),
(221, 'Marcia', ' ', 'Lujan', ' ', '3lkW27at4jrZ', 1, 1, 1, 'HN'),
(222, 'victor', ' ', 'colindres', ' ', 'rWgqPuI415zW', 1, 1, 1, 'HN'),
(223, 'Emilia', ' ', 'Soriano', ' ', '0801199508099', 1, 1, 1, 'HN'),
(224, 'Eva', ' ', 'Andino', ' ', '0812-1990-00022', 1, 1, 1, 'HN'),
(225, 'keren', '', 'Aguilar', '', '0801199314736', 1, 1, 1, 'HN'),
(226, 'Belky', ' ', 'Mendoza', ' ', '0801199404197', 1, 1, 1, 'HN'),
(227, 'Astrid', 'Eloisa', 'Velasquez', 'Flores', '1701-1996-00615', 1, 2, 1, 'HN'),
(228, 'Lourdes', 'Monserrath', 'Brito', ' ', 'DhuJBQPOmL2w', 1, 1, 1, 'HN'),
(229, 'Isis', 'Marielis', 'Chirinos', ' ', 'LRITYnN2YOFk', 1, 1, 1, 'HN'),
(230, 'Asael', 'Enrique', 'Nuñez', 'Solorzano', '0801198506028', 1, 2, 2, 'HN'),
(231, 'Angel', ' ', 'Zuniga', ' ', 'jVqcJDgzD9iw', 1, 1, 1, 'HN'),
(232, 'Maria', ' ', 'Jose', ' ', 'dlTCLJ5hPJWH', 1, 1, 1, 'HN'),
(233, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(234, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(235, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(236, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(237, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(238, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(239, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(240, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(241, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(242, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(243, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(244, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(245, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(246, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(247, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(248, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(249, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(250, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(251, 'Ana', '', 'Briceño', '', 'anitabriceño', 1, 1, 1, 'HN'),
(252, 'Maylin', '', 'Alvarez', '', 'SIotratYmzQC', 1, 1, 1, 'HN'),
(253, 'Sheylli', ' ', 'Herrera', ' ', 'uG1SE9j1T8rt', 1, 1, 1, 'HN'),
(254, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(255, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(256, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(257, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(258, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(259, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(260, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(261, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(262, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(263, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(264, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(265, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(266, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(267, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(268, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(269, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(270, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(271, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(272, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(273, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(274, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(275, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(276, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 0, 1, 'HN'),
(277, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(278, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(279, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(280, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(281, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(282, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(283, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(284, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(285, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(286, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(287, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(288, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(289, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(290, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(291, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(292, 'Melania', ' ', 'Alvarado', ' ', '0825-1994-00089', 1, 2, 1, 'HN'),
(293, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(294, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(295, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(296, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(297, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(298, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(299, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(300, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(301, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(302, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(303, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(304, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(305, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(306, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(307, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(308, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(309, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(310, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(311, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(312, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(313, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(314, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(315, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(316, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(317, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(318, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(319, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(320, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(321, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(322, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(323, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(324, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(325, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(326, 'Maylin', ' ', 'Alvarez', ' ', '1709199300674', 1, 2, 1, 'HN'),
(327, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(328, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(329, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(330, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(331, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(332, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(333, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(334, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(335, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(336, 'Maylin', ' ', 'Alvarez', 'Montesi', '1709-1993-00674', 1, 2, 1, 'HN'),
(337, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(338, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(339, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(340, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(341, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(342, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(343, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(344, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(345, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(346, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(347, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(348, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(349, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(350, 'Ana', 'Elizabeth', 'Cañadas', 'Cabrera', '0801-1984-06830', 1, 2, 1, 'HN'),
(351, 'Jason', ' ', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(352, 'Jason', ' ', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(353, 'Jason', ' ', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(354, 'Jason', ' ', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(355, 'Jason', ' ', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(356, 'Jason', '', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(357, 'Jason', '', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(358, 'Jason', '', 'Morel', ' ', '0801199808465', 1, 2, 1, 'HN'),
(359, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(360, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(361, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(362, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(363, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(364, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(365, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(366, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(367, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(368, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(369, 'Jason', '', 'Morel', ' ', '0801-1998-08465', 1, 2, 1, 'HN'),
(370, 'Jason', '', 'Morel', '', '0801-1998-08465', 1, 2, 1, 'HN'),
(371, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(372, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(373, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(374, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(375, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(376, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(377, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(378, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(379, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(380, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(381, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(382, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(383, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(384, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(385, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(386, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(387, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(388, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(389, 'Ana', '', 'Cañadas', ' ', '0801-1984-06830', 1, 1, 1, 'HN'),
(390, 'Doris', ' ', 'Suazo', ' ', '1503-1994-00945', 1, 1, 1, 'HN'),
(391, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(392, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(393, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(394, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(395, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(396, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(397, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(398, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(399, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(400, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(401, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(402, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(403, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(404, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(405, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(406, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(407, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(408, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(409, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(410, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(411, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(412, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(413, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(414, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(415, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(416, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(417, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(418, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(419, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(420, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(421, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(422, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(423, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(424, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(425, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(426, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(427, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(428, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(429, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(430, 'jeymee', ' ', 'Robles', '', '0801199412819', 1, 2, 1, 'HN'),
(431, 'Jason', ' ', 'Morel', ' ', '0801199808465', 1, 2, 0, 'HN'),
(432, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(433, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(434, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(435, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(436, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(437, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(438, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(439, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(440, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(441, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(442, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(443, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(444, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(445, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(446, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(447, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(448, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(449, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(450, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(451, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(452, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 2, 1, 'HN'),
(453, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(454, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(455, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(456, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(457, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(458, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(459, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(460, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(461, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(462, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(463, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(464, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(465, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(466, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(467, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(468, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(469, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(470, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(471, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(472, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(473, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(474, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(475, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(476, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(477, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(478, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(479, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(480, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(481, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(482, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(483, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(484, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(485, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(486, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(487, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(488, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(489, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(490, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(491, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(492, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(493, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(494, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 2, 1, 'HN'),
(495, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 0, 1, 'HN'),
(496, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 0, 1, 'HN'),
(497, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 0, 1, 'HN'),
(498, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 0, 1, 'HN'),
(499, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 0, 1, 'HN'),
(500, 'jeymee', ' ', 'Robles', 'Mejia', '0801-1994-12819', 1, 0, 1, 'HN'),
(501, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(502, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(503, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(504, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(505, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(506, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(507, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(508, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(509, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(510, 'jeymee', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(511, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(512, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(513, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(514, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(515, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(516, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(517, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(518, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(519, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(520, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(521, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(522, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(523, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(524, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(525, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(526, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(527, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(528, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(529, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(530, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(531, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(532, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(533, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(534, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(535, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(536, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(537, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(538, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(539, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(540, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(541, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(542, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(543, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(544, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(545, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(546, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(547, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(548, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(549, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(550, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(551, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(552, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(553, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(554, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(555, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(556, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(557, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(558, 'jeymee', 'alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(559, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(560, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(561, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(562, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(563, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(564, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(565, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(566, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(567, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(568, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(569, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(570, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(571, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(572, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(573, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(574, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(575, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(576, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(577, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(578, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(579, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(580, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(581, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(582, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(583, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(584, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(585, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(586, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(587, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(588, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(589, 'alexandra', ' ', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(590, 'Jeymee', 'Alexandra', 'Robles', 'Mejia', '0801199412819', 1, 0, 1, 'HN'),
(591, 'Stiward', ' ', 'Calderon', ' ', '1103199400229', 1, 1, 1, 'HN'),
(592, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(593, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(594, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(595, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(596, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(597, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(598, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(599, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(600, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(601, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(602, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(603, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(604, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(605, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(606, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(607, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(608, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(609, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(610, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(611, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(612, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(613, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(614, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(615, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(616, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(617, 'Alejandro', 'Josue', 'Kaffati', 'Aguilar', '0801-1996-08446', 1, 2, 1, 'HN'),
(618, 'Cecilia', 'Mariel', 'Cuellar', 'Avila', '0816199800102', 1, 2, 1, 'HN'),
(619, 'Cecilia', 'Mariel', 'Cuellar', 'Avila', '0816199800102', 1, 2, 1, 'HN'),
(620, 'Cecilia', 'Mariel', 'Cuellar', 'Avila', '0816199800102', 1, 2, 1, 'HN'),
(621, 'Cecilia', 'Mariel', 'Cuellar', 'Avila', '0816199800102', 1, 2, 1, 'HN'),
(622, 'Cecilia', 'Mariel', 'Cuellar', 'Avila', '0816199800102', 1, 2, 1, 'HN'),
(623, 'Roger', 'Eduardo', 'Betancourth', 'Maradiaga', '0801199701672', 1, 1, 1, 'HN'),
(624, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(625, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(626, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(627, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(628, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(629, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(630, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(631, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(632, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(633, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(634, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(635, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(636, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(637, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(638, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(639, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(640, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(641, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(642, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(643, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(644, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(645, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(646, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(647, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(648, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(649, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(650, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(651, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(652, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(653, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(654, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(655, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(656, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(657, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(658, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(659, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(660, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(661, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(662, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(663, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(664, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(665, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(666, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(667, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(668, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(669, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(670, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(671, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(672, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(673, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(674, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(675, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(676, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(677, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(678, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(679, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(680, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(681, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(682, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(683, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(684, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(685, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(686, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(687, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN'),
(688, 'Belky', 'Odalis', 'Mendoza', 'Quiñonez', '0801199404197', 1, 2, 1, 'HN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_institucion`
--

CREATE TABLE `tbl_persona_institucion` (
  `id_institucion_pk` int(11) DEFAULT NULL,
  `id_institucion_facultad_carrera` int(10) UNSIGNED NOT NULL,
  `id_persona_pk` int(11) NOT NULL,
  `trabaja` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_red_social`
--

CREATE TABLE `tbl_persona_red_social` (
  `id_persona_pk` int(11) NOT NULL,
  `id_red_social_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_titulo`
--

CREATE TABLE `tbl_persona_titulo` (
  `id_persona_fk` int(11) NOT NULL,
  `id_titulo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pregunta_cualitativa`
--

CREATE TABLE `tbl_pregunta_cualitativa` (
  `id_pregunta_cualitativa_pk` int(11) NOT NULL,
  `nombre_pregunta_cualitativa` longtext,
  `id_formulario_fk` int(11) NOT NULL,
  `id_tipo_pregunta_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_pregunta_cualitativa`
--

INSERT INTO `tbl_pregunta_cualitativa` (`id_pregunta_cualitativa_pk`, `nombre_pregunta_cualitativa`, `id_formulario_fk`, `id_tipo_pregunta_fk`) VALUES
(1, '1', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pregunta_cuantitativa`
--

CREATE TABLE `tbl_pregunta_cuantitativa` (
  `id_pregunta_cuantitativa_pk` int(11) NOT NULL,
  `nombre_pregunta_cuantitativa` longtext,
  `opciones` longtext,
  `ponderacion` longtext,
  `id_formulario_fk` int(11) NOT NULL,
  `id_tipo_pregunta_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_pregunta_cuantitativa`
--

INSERT INTO `tbl_pregunta_cuantitativa` (`id_pregunta_cuantitativa_pk`, `nombre_pregunta_cuantitativa`, `opciones`, `ponderacion`, `id_formulario_fk`, `id_tipo_pregunta_fk`) VALUES
(2, 'Debería considerarse éste trabajo para publicarse en Revista Científica', '<>SI<>NO', '<>50<>50', 1, 2),
(3, 'Debería considerarse éste trabajo para Otorgarle un premio', '<>SI<>NO', '<>50<>50', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio`
--

CREATE TABLE `tbl_premio` (
  `id_premio_pk` int(11) NOT NULL COMMENT 'Identificador único dado a cada premio',
  `nombre_premio` mediumtext NOT NULL,
  `id_tematica_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_tematica'' y que asocia cada premio con una temática específica.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio_patrocinador`
--

CREATE TABLE `tbl_premio_patrocinador` (
  `id_premio_fk` int(11) NOT NULL,
  `id_patrocinador_fk` int(11) NOT NULL,
  `persona` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el premio fue patrocinado por una persona u institución.',
  `institucion` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el premio fue patrocinado por una persona u institución.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_premio_trabajo`
--

CREATE TABLE `tbl_premio_trabajo` (
  `id_premio_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa`
--

CREATE TABLE `tbl_programa` (
  `id_programa_pk` int(11) NOT NULL,
  `nombre_programa` varchar(100) DEFAULT NULL,
  `estado_programa` tinyint(1) DEFAULT NULL,
  `descripcion` longtext,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa_actividad`
--

CREATE TABLE `tbl_programa_actividad` (
  `id_programa_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rango`
--

CREATE TABLE `tbl_rango` (
  `id_rango_pk` int(11) NOT NULL,
  `nombre_rango` varchar(50) DEFAULT NULL,
  `fecha_limite_emision` date DEFAULT NULL,
  `cai` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_red_social`
--

CREATE TABLE `tbl_red_social` (
  `id_red_social_pk` int(11) NOT NULL,
  `nombre_red_social` varchar(150) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuestas_revisiones_trabajos_cualitativas`
--

CREATE TABLE `tbl_respuestas_revisiones_trabajos_cualitativas` (
  `id_revisiones_trabajo_fk` int(11) NOT NULL,
  `id_respuesta_cualitativa_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura de tabla para la tabla `tbl_respuesta_cualitativa`
--

CREATE TABLE `tbl_respuesta_cualitativa` (
  `id_respuesta_cualitativa_pk` int(11) NOT NULL,
  `respuesta_cualitativa` longtext,
  `id_pregunta_cualitativa_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_cuantitativa`
--

CREATE TABLE `tbl_respuesta_cuantitativa` (
  `id_respuesta_cuantitativa_pk` int(11) NOT NULL,
  `respuesta_cuantitativa` longtext NOT NULL,
  `id_pregunta_cuantitativa_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_respuesta_mensaje`
--

CREATE TABLE `tbl_respuesta_mensaje` (
  `id_respuesta_mensaje_pk` int(11) NOT NULL,
  `contenido_respuesta_mensaje` text,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_mensaje_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `observaciones` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_roles_congreso`
--

INSERT INTO `tbl_roles_congreso` (`tbl_rol_congreso_pk`, `id_rol_fk`, `id_congreso_fk`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 1, 2),
(5, 2, 2),
(6, 3, 2),
(7, 1, 3),
(8, 2, 3),
(9, 3, 3),
(10, 4, 1),
(11, 5, 1),
(12, 6, 1),
(13, 7, 1),
(14, 8, 1),
(15, 9, 1),
(16, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rtn`
--

CREATE TABLE `tbl_rtn` (
  `id_rtn_pk` int(11) NOT NULL COMMENT 'Identificador único para el ''RTN'' de cada individuo, persona u empresa con obligaciones tributarias hacia el Estado.',
  `empresa` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para identificar si el individuo en cuestión es una empresa.',
  `persona` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para identificar si el individuo en cuestión es una persona.',
  `identificador` int(11) DEFAULT NULL COMMENT 'Este es un tipo de idenificador, aunque no este relacionado, se guardara en el un id de referencia del tipo persona u empresa.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud`
--

CREATE TABLE `tbl_solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `id_tipo_solicitud` int(11) NOT NULL,
  `motivo_solicitud` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '2:Rechazada\n1: Aceptada\n0: Pendiente',
  `fecha_solicitud` date DEFAULT NULL,
  `fecha_resolucion` date DEFAULT NULL,
  `id_usuario_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_solicitud`
--

INSERT INTO `tbl_solicitud` (`id_solicitud`, `id_tipo_solicitud`, `motivo_solicitud`, `status`, `fecha_solicitud`, `fecha_resolucion`, `id_usuario_pk`) VALUES
(1, 1, 'Revisor para ayudar ', 0, '2017-09-22', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud_certificados`
--

CREATE TABLE `tbl_solicitud_certificados` (
  `id_solicitud` int(11) NOT NULL,
  `id_certificado_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud_idioma`
--

CREATE TABLE `tbl_solicitud_idioma` (
  `id_solicitud` int(11) NOT NULL,
  `id_idioma_pk` varchar(2) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud_roles_congreso`
--

CREATE TABLE `tbl_solicitud_roles_congreso` (
  `id_rol_congreso_pk` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_solicitud_tematica`
--

CREATE TABLE `tbl_solicitud_tematica` (
  `id_solicitud` int(11) NOT NULL,
  `id_tematica_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbl_solicitud_tematica`
--

INSERT INTO `tbl_solicitud_tematica` (`id_solicitud`, `id_tematica_pk`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tarea_voluntario`
--

CREATE TABLE `tbl_tarea_voluntario` (
  `id_tarea_voluntario_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tarea asociada a un voluntario. Ojo, éste campo no surje de la indexación porque esta no es una tabla transaccional, sino más bien la descripción de tareas que se asocian a los voluntarios.',
  `nombre_tarea` longtext,
  `descripcion` longtext,
  `archivo_complementario` mediumtext,
  `persona_apoyo` varchar(45) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  `fecha_tarea` date DEFAULT NULL,
  `hora_tarea` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_telefono`
--

CREATE TABLE `tbl_telefono` (
  `id_telefono_pk` int(11) NOT NULL COMMENT 'Identificador único para cada número de teléfono',
  `numero_telefono` int(11) DEFAULT NULL COMMENT 'Aquí se almacenará ca da número telefónico',
  `id_persona_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''persona'' y que sirve para asociar cada número telefónica a una persona en específico.',
  `principal` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que sirve para determinar si el numero telefónico en cuestión es o no el número principal de la persona.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_telefono`
--

INSERT INTO `tbl_telefono` (`id_telefono_pk`, `numero_telefono`, `id_persona_fk`, `principal`) VALUES
(1, 9700, 4, 1),
(2, 98676248, 5, 1),
(3, 97859561, 6, 1),
(4, 96711549, 7, 1),
(5, 97727615, 8, 1),
(8, 22391849, 11, 1),
(9, 32231075, 12, 1),
(10, 98588162, 13, 1),
(11, 97238887, 14, 1),
(12, 98906371, 15, 1),
(17, 32835643, 20, 1),
(18, 96091185, 21, 1),
(19, 76924295, 22, 1),
(20, 1, 23, 1),
(21, 1, 24, 1),
(22, 31757699, 25, 1),
(23, 2239, 26, 1),
(24, 97544454, 27, 1),
(25, 33906268, 28, 1),
(26, 96557272, 29, 1),
(27, 9815, 30, 1),
(28, 98061089, 31, 1),
(29, 3396, 32, 1),
(30, 33909997, 33, 1),
(31, 96119231, 34, 1),
(32, 1, 35, 1),
(33, 99332553, 36, 1),
(35, 1, 38, 1),
(36, 1, 39, 1),
(37, 1, 40, 1),
(38, 1, 41, 1),
(39, 1, 42, 1),
(40, 1, 43, 1),
(41, 1, 44, 1),
(42, 1, 45, 1),
(43, 1, 46, 1),
(44, 1, 47, 1),
(45, 32672497, 48, 1),
(46, 1, 49, 1),
(47, 1, 50, 1),
(48, 32167485, 51, 1),
(49, 96126852, 52, 1),
(50, 2147483647, 53, 1),
(51, 31767997, 54, 1),
(52, 1, 55, 1),
(53, 2216, 56, 1),
(54, 32196034, 57, 1),
(55, 1, 58, 1),
(58, 31910104, 61, 1),
(59, 22391849, 62, 1),
(61, 99386745, 64, 1),
(62, 87628689, 65, 1),
(63, 1, 66, 1),
(65, 32334424, 68, 1),
(66, 33129451, 3, 1),
(67, 97152036, 69, 1),
(68, 22650813, 70, 1),
(69, 95497357, 71, 1),
(70, 98137081, 72, 1),
(71, 31771094, 73, 1),
(72, 1, 74, 1),
(73, 99379539, 75, 1),
(74, 95391189, 76, 1),
(75, 1, 77, 1),
(76, 1, 78, 1),
(77, 1, 79, 1),
(78, 1, 80, 1),
(79, 96657676, 81, 1),
(80, 94906446, 82, 1),
(81, 1, 83, 1),
(82, 1, 84, 1),
(83, 1, 85, 1),
(84, 95221083, 86, 1),
(85, 98810527, 87, 1),
(86, 95887836, 88, 1),
(87, 95887836, 89, 1),
(88, 9647, 90, 1),
(89, 9647, 91, 1),
(90, 1, 92, 1),
(91, 1, 93, 1),
(92, 1, 94, 1),
(93, 1, 95, 1),
(94, 1, 96, 1),
(95, 1, 97, 1),
(96, 1, 98, 1),
(97, 1, 99, 1),
(98, 1, 100, 1),
(99, 22455396, 101, 1),
(100, 96242418, 102, 1),
(101, 22286291, 103, 1),
(102, 1, 104, 1),
(103, 1, 105, 1),
(104, 1, 106, 1),
(105, 32985264, 107, 1),
(106, 1, 108, 1),
(107, 99683696, 109, 1),
(108, 96577223, 110, 1),
(109, 1, 111, 1),
(110, 1, 112, 1),
(111, 31527235, 113, 1),
(112, 97917325, 114, 1),
(113, 96234833, 115, 1),
(114, 22554225, 116, 1),
(115, 1, 117, 1),
(116, 1, 118, 1),
(117, 1, 119, 1),
(118, 88131653, 120, 1),
(119, 98318180, 121, 1),
(120, 1, 122, 1),
(121, 1, 123, 1),
(122, 22335695, 124, 1),
(123, 87930495, 125, 1),
(124, 1, 126, 1),
(125, 1, 127, 1),
(126, 1, 128, 1),
(127, 1, 129, 1),
(128, 22335695, 130, 1),
(129, 88802930, 131, 1),
(130, 33747877, 132, 1),
(131, 1, 133, 1),
(132, 96477067, 134, 1),
(133, 1, 135, 1),
(134, 1, 136, 1),
(135, 32900837, 137, 1),
(136, 1, 138, 1),
(137, 98763076, 139, 1),
(138, 1, 140, 1),
(139, 1, 141, 1),
(140, 9711, 142, 1),
(141, 1, 143, 1),
(142, 1, 144, 1),
(143, 1, 145, 1),
(144, 89918383, 146, 1),
(145, 8953, 147, 1),
(146, 32882335, 148, 1),
(147, 1, 149, 1),
(148, 1, 150, 1),
(149, 1, 151, 1),
(150, 33606398, 152, 1),
(151, 95883971, 153, 1),
(152, 1, 154, 1),
(153, 1, 155, 1),
(154, 1, 156, 1),
(155, 1, 157, 1),
(156, 1, 158, 1),
(157, 1, 159, 1),
(158, 32239910, 160, 1),
(159, 1, 161, 1),
(160, 1, 162, 1),
(161, 1, 163, 1),
(162, 32604440, 164, 1),
(163, 1, 165, 1),
(164, 1, 166, 1),
(165, 1, 167, 1),
(166, 1, 168, 1),
(167, 1, 169, 1),
(168, 1, 170, 1),
(169, 22362217, 171, 1),
(170, 97760066, 172, 1),
(171, 97001384, 173, 1),
(172, 3398, 174, 1),
(173, 1, 175, 1),
(174, 1, 176, 1),
(175, 1, 177, 1),
(176, 1, 178, 1),
(177, 1, 179, 1),
(178, 97794329, 180, 1),
(179, 99382982, 181, 1),
(180, 1, 182, 1),
(181, 1, 183, 1),
(182, 97018164, 184, 1),
(183, 1, 185, 1),
(184, 1, 186, 1),
(185, 33385858, 187, 1),
(186, 1, 188, 1),
(187, 99722809, 189, 1),
(188, 97794329, 190, 1),
(189, 32090065, 191, 1),
(190, 33108479, 192, 1),
(191, 1, 193, 1),
(192, 1, 194, 1),
(193, 98454243, 195, 1),
(194, 1, 196, 1),
(195, 98204606, 197, 1),
(196, 1, 198, 1),
(197, 1, 199, 1),
(198, 99979630, 200, 1),
(199, 89687171, 201, 1),
(200, 97175265, 202, 1),
(201, 1, 203, 1),
(202, 1, 204, 1),
(203, 1, 205, 1),
(204, 1, 206, 1),
(205, 1, 207, 1),
(206, 1, 208, 1),
(207, 1, 209, 1),
(208, 22224365, 210, 1),
(209, 1, 211, 1),
(210, 1, 212, 1),
(211, 33561127, 213, 1),
(212, 1, 214, 1),
(213, 1, 215, 1),
(214, 1, 216, 1),
(215, 32907873, 217, 1),
(216, 96854383, 218, 1),
(217, 1, 219, 1),
(218, 33801225, 220, 1),
(219, 1, 221, 1),
(220, 1, 222, 1),
(221, 1, 223, 1),
(222, 1, 224, 1),
(223, 1, 225, 1),
(224, 1, 226, 1),
(225, 32300370, 227, 1),
(226, 1, 228, 1),
(227, 1, 229, 1),
(228, 33041920, 230, 1),
(229, 1, 231, 1),
(230, 1, 232, 1),
(231, 89035564, 233, 1),
(232, 89035564, 234, 1),
(233, 89035564, 235, 1),
(234, 89035564, 236, 1),
(235, 89035564, 237, 1),
(236, 89035564, 238, 1),
(237, 89035564, 239, 1),
(238, 89035564, 240, 1),
(239, 89035564, 241, 1),
(240, 89035564, 242, 1),
(241, 89035564, 243, 1),
(242, 89035564, 244, 1),
(243, 89035564, 245, 1),
(244, 89035564, 246, 1),
(245, 89035564, 247, 1),
(246, 89035564, 248, 1),
(247, 89035564, 249, 1),
(248, 89035564, 250, 1),
(249, 1, 251, 1),
(250, 1, 252, 1),
(251, 1, 253, 1),
(252, 9520, 254, 1),
(253, 9520, 255, 1),
(254, 9520, 256, 1),
(255, 9520, 257, 1),
(256, 9520, 258, 1),
(257, 9520, 259, 1),
(258, 9520, 260, 1),
(259, 9520, 261, 1),
(260, 9520, 262, 1),
(261, 9520, 263, 1),
(262, 9520, 264, 1),
(263, 9520, 265, 1),
(264, 9520, 266, 1),
(265, 9520, 267, 1),
(266, 9520, 268, 1),
(267, 9520, 269, 1),
(268, 9520, 270, 1),
(269, 9520, 271, 1),
(270, 9520, 272, 1),
(271, 9520, 273, 1),
(272, 9520, 274, 1),
(273, 9520, 275, 1),
(274, 9726, 276, 1),
(275, 9726, 277, 1),
(276, 9726, 278, 1),
(277, 9726, 279, 1),
(278, 9726, 280, 1),
(279, 9726, 281, 1),
(280, 9726, 282, 1),
(281, 9726, 283, 1),
(282, 9726, 284, 1),
(283, 9726, 285, 1),
(284, 9726, 286, 1),
(285, 9726, 287, 1),
(286, 9726, 288, 1),
(287, 9726, 289, 1),
(288, 9726, 290, 1),
(289, 9726, 291, 1),
(290, 9726, 292, 1),
(291, 31742886, 293, 1),
(292, 31742886, 294, 1),
(293, 31742886, 295, 1),
(294, 31742886, 296, 1),
(295, 31742886, 297, 1),
(296, 31742886, 298, 1),
(297, 31742886, 299, 1),
(298, 31742886, 300, 1),
(299, 31742886, 301, 1),
(300, 31742886, 302, 1),
(301, 31742886, 303, 1),
(302, 31742886, 304, 1),
(303, 31742886, 305, 1),
(304, 31742886, 306, 1),
(305, 31742886, 307, 1),
(306, 31742886, 308, 1),
(307, 31742886, 309, 1),
(308, 31742886, 310, 1),
(309, 31742886, 311, 1),
(310, 31742886, 312, 1),
(311, 31742886, 313, 1),
(312, 31742886, 314, 1),
(313, 31742886, 315, 1),
(314, 31742886, 316, 1),
(315, 31742886, 317, 1),
(316, 31742886, 318, 1),
(317, 31742886, 319, 1),
(318, 31742886, 320, 1),
(319, 31742886, 321, 1),
(320, 31742886, 322, 1),
(321, 31742886, 323, 1),
(322, 31742886, 324, 1),
(323, 31742886, 325, 1),
(324, 31742886, 326, 1),
(325, 2147483647, 327, 1),
(326, 2147483647, 328, 1),
(327, 2147483647, 329, 1),
(328, 2147483647, 330, 1),
(329, 2147483647, 331, 1),
(330, 2147483647, 332, 1),
(331, 2147483647, 333, 1),
(332, 2147483647, 334, 1),
(333, 2147483647, 335, 1),
(334, 2147483647, 336, 1),
(335, 95208595, 337, 1),
(336, 95208595, 338, 1),
(337, 95208595, 339, 1),
(338, 95208595, 340, 1),
(339, 95208595, 341, 1),
(340, 95208595, 342, 1),
(341, 95208595, 343, 1),
(342, 95208595, 344, 1),
(343, 95208595, 345, 1),
(344, 95208595, 346, 1),
(345, 95208595, 347, 1),
(346, 95208595, 348, 1),
(347, 95208595, 349, 1),
(348, 95208595, 350, 1),
(349, 33941510, 351, 1),
(350, 33941510, 352, 1),
(351, 33941510, 353, 1),
(352, 33941510, 354, 1),
(353, 33941510, 355, 1),
(354, 33941510, 356, 1),
(355, 33941510, 357, 1),
(356, 33941510, 358, 1),
(357, 3394, 359, 1),
(358, 3394, 360, 1),
(359, 3394, 361, 1),
(360, 3394, 362, 1),
(361, 3394, 363, 1),
(362, 3394, 364, 1),
(363, 3394, 365, 1),
(364, 3394, 366, 1),
(365, 3394, 367, 1),
(366, 3394, 368, 1),
(367, 3394, 369, 1),
(368, 33941510, 370, 1),
(369, 95208595, 371, 1),
(370, 95208595, 372, 1),
(371, 95208595, 373, 1),
(372, 95208595, 374, 1),
(373, 95208595, 375, 1),
(374, 95208595, 376, 1),
(375, 95208595, 377, 1),
(376, 95208595, 378, 1),
(377, 95208595, 379, 1),
(378, 95208595, 380, 1),
(379, 95208595, 381, 1),
(380, 95208595, 382, 1),
(381, 95208595, 383, 1),
(382, 95208595, 384, 1),
(383, 95208595, 385, 1),
(384, 95208595, 386, 1),
(385, 95208595, 387, 1),
(386, 95208595, 388, 1),
(387, 95208595, 389, 1),
(388, 1, 390, 1),
(389, 96265374, 391, 1),
(390, 96265374, 392, 1),
(391, 96265374, 393, 1),
(392, 96265374, 394, 1),
(393, 96265374, 395, 1),
(394, 96265374, 396, 1),
(395, 96265374, 397, 1),
(396, 96265374, 398, 1),
(397, 96265374, 399, 1),
(398, 96265374, 400, 1),
(399, 96265374, 401, 1),
(400, 96265374, 402, 1),
(401, 96265374, 403, 1),
(402, 96265374, 404, 1),
(403, 96265374, 405, 1),
(404, 96265374, 406, 1),
(405, 96265374, 407, 1),
(406, 96265374, 408, 1),
(407, 96265374, 409, 1),
(408, 96265374, 410, 1),
(409, 96265374, 411, 1),
(410, 96265374, 412, 1),
(411, 96265374, 413, 1),
(412, 96265374, 414, 1),
(413, 96265374, 415, 1),
(414, 96265374, 416, 1),
(415, 96265374, 417, 1),
(416, 96265374, 418, 1),
(417, 96265374, 419, 1),
(418, 96265374, 420, 1),
(419, 96265374, 421, 1),
(420, 96265374, 422, 1),
(421, 96265374, 423, 1),
(422, 96265374, 424, 1),
(423, 96265374, 425, 1),
(424, 96265374, 426, 1),
(425, 96265374, 427, 1),
(426, 96265374, 428, 1),
(427, 96265374, 429, 1),
(428, 96265374, 430, 1),
(429, 33941510, 431, 1),
(430, 33179721, 432, 1),
(431, 33179721, 433, 1),
(432, 33179721, 434, 1),
(433, 33179721, 435, 1),
(434, 33179721, 436, 1),
(435, 33179721, 437, 1),
(436, 33179721, 438, 1),
(437, 33179721, 439, 1),
(438, 33179721, 440, 1),
(439, 33179721, 441, 1),
(440, 33179721, 442, 1),
(441, 33179721, 443, 1),
(442, 33179721, 444, 1),
(443, 33179721, 445, 1),
(444, 33179721, 446, 1),
(445, 33179721, 447, 1),
(446, 33179721, 448, 1),
(447, 33179721, 449, 1),
(448, 33179721, 450, 1),
(449, 33179721, 451, 1),
(450, 33179721, 452, 1),
(451, 33179721, 453, 1),
(452, 33179721, 454, 1),
(453, 33179721, 455, 1),
(454, 33179721, 456, 1),
(455, 33179721, 457, 1),
(456, 33179721, 458, 1),
(457, 33179721, 459, 1),
(458, 33179721, 460, 1),
(459, 33179721, 461, 1),
(460, 33179721, 462, 1),
(461, 33179721, 463, 1),
(462, 33179721, 464, 1),
(463, 33179721, 465, 1),
(464, 33179721, 466, 1),
(465, 33179721, 467, 1),
(466, 33179721, 468, 1),
(467, 33179721, 469, 1),
(468, 33179721, 470, 1),
(469, 33179721, 471, 1),
(470, 33179721, 472, 1),
(471, 33179721, 473, 1),
(472, 33179721, 474, 1),
(473, 33179721, 475, 1),
(474, 33179721, 476, 1),
(475, 33179721, 477, 1),
(476, 33179721, 478, 1),
(477, 33179721, 479, 1),
(478, 33179721, 480, 1),
(479, 33179721, 481, 1),
(480, 33179721, 482, 1),
(481, 33179721, 483, 1),
(482, 33179721, 484, 1),
(483, 33179721, 485, 1),
(484, 33179721, 486, 1),
(485, 33179721, 487, 1),
(486, 33179721, 488, 1),
(487, 33179721, 489, 1),
(488, 33179721, 490, 1),
(489, 33179721, 491, 1),
(490, 33179721, 492, 1),
(491, 33179721, 493, 1),
(492, 33179721, 494, 1),
(493, 33179721, 495, 1),
(494, 33179721, 496, 1),
(495, 33179721, 497, 1),
(496, 33179721, 498, 1),
(497, 33179721, 499, 1),
(498, 33179721, 500, 1),
(499, 33179721, 501, 1),
(500, 33179721, 502, 1),
(501, 33179721, 503, 1),
(502, 33179721, 504, 1),
(503, 33179721, 505, 1),
(504, 33179721, 506, 1),
(505, 33179721, 507, 1),
(506, 33179721, 508, 1),
(507, 33179721, 509, 1),
(508, 33179721, 510, 1),
(509, 33179721, 511, 1),
(510, 33179721, 512, 1),
(511, 33179721, 513, 1),
(512, 33179721, 514, 1),
(513, 33179721, 515, 1),
(514, 33179721, 516, 1),
(515, 33179721, 517, 1),
(516, 33179721, 518, 1),
(517, 33179721, 519, 1),
(518, 33179721, 520, 1),
(519, 33179721, 521, 1),
(520, 33179721, 522, 1),
(521, 33179721, 523, 1),
(522, 33179721, 524, 1),
(523, 33179721, 525, 1),
(524, 33179721, 526, 1),
(525, 33179721, 527, 1),
(526, 33179721, 528, 1),
(527, 33179721, 529, 1),
(528, 33179721, 530, 1),
(529, 33179721, 531, 1),
(530, 33179721, 532, 1),
(531, 33179721, 533, 1),
(532, 33179721, 534, 1),
(533, 33179721, 535, 1),
(534, 33179721, 536, 1),
(535, 33179721, 537, 1),
(536, 33179721, 538, 1),
(537, 33179721, 539, 1),
(538, 33179721, 540, 1),
(539, 33179721, 541, 1),
(540, 33179721, 542, 1),
(541, 33179721, 543, 1),
(542, 33179721, 544, 1),
(543, 33179721, 545, 1),
(544, 33179721, 546, 1),
(545, 33179721, 547, 1),
(546, 33179721, 548, 1),
(547, 33179721, 549, 1),
(548, 33179721, 550, 1),
(549, 33179721, 551, 1),
(550, 33179721, 552, 1),
(551, 33179721, 553, 1),
(552, 33179721, 554, 1),
(553, 33179721, 555, 1),
(554, 33179721, 556, 1),
(555, 33179721, 557, 1),
(556, 33179721, 558, 1),
(557, 33179721, 559, 1),
(558, 33179721, 560, 1),
(559, 33179721, 561, 1),
(560, 33179721, 562, 1),
(561, 33179721, 563, 1),
(562, 33179721, 564, 1),
(563, 33179721, 565, 1),
(564, 33179721, 566, 1),
(565, 33179721, 567, 1),
(566, 33179721, 568, 1),
(567, 33179721, 569, 1),
(568, 33179721, 570, 1),
(569, 33179721, 571, 1),
(570, 33179721, 572, 1),
(571, 33179721, 573, 1),
(572, 33179721, 574, 1),
(573, 33179721, 575, 1),
(574, 33179721, 576, 1),
(575, 33179721, 577, 1),
(576, 33179721, 578, 1),
(577, 33179721, 579, 1),
(578, 33179721, 580, 1),
(579, 33179721, 581, 1),
(580, 33179721, 582, 1),
(581, 33179721, 583, 1),
(582, 33179721, 584, 1),
(583, 33179721, 585, 1),
(584, 33179721, 586, 1),
(585, 33179721, 587, 1),
(586, 33179721, 588, 1),
(587, 33179721, 589, 1),
(588, 33179721, 590, 1),
(589, 1, 591, 1),
(590, 9466, 592, 1),
(591, 9466, 593, 1),
(592, 9466, 594, 1),
(593, 9466, 595, 1),
(594, 9466, 596, 1),
(595, 9466, 597, 1),
(596, 9466, 598, 1),
(597, 9466, 599, 1),
(598, 9466, 600, 1),
(599, 9466, 601, 1),
(600, 9466, 602, 1),
(601, 9466, 603, 1),
(602, 9466, 604, 1),
(603, 9466, 605, 1),
(604, 9466, 606, 1),
(605, 9466, 607, 1),
(606, 9466, 608, 1),
(607, 9466, 609, 1),
(608, 9466, 610, 1),
(609, 9466, 611, 1),
(610, 9466, 612, 1),
(611, 9466, 613, 1),
(612, 9466, 614, 1),
(613, 9466, 615, 1),
(614, 9466, 616, 1),
(615, 9466, 617, 1),
(616, 31735262, 618, 1),
(617, 31735262, 619, 1),
(618, 31735262, 620, 1),
(619, 31735262, 621, 1),
(620, 31735262, 622, 1),
(621, 89035564, 623, 1),
(622, 95090468, 624, 1),
(623, 95090468, 625, 1),
(624, 95090468, 626, 1),
(625, 95090468, 627, 1),
(626, 95090468, 628, 1),
(627, 95090468, 629, 1),
(628, 95090468, 630, 1),
(629, 95090468, 631, 1),
(630, 95090468, 632, 1),
(631, 95090468, 633, 1),
(632, 95090468, 634, 1),
(633, 95090468, 635, 1),
(634, 95090468, 636, 1),
(635, 95090468, 637, 1),
(636, 95090468, 638, 1),
(637, 95090468, 639, 1),
(638, 95090468, 640, 1),
(639, 95090468, 641, 1),
(640, 95090468, 642, 1),
(641, 95090468, 643, 1),
(642, 95090468, 644, 1),
(643, 95090468, 645, 1),
(644, 95090468, 646, 1),
(645, 95090468, 647, 1),
(646, 95090468, 648, 1),
(647, 95090468, 649, 1),
(648, 95090468, 650, 1),
(649, 95090468, 651, 1),
(650, 95090468, 652, 1),
(651, 95090468, 653, 1),
(652, 95090468, 654, 1),
(653, 95090468, 655, 1),
(654, 95090468, 656, 1),
(655, 95090468, 657, 1),
(656, 95090468, 658, 1),
(657, 95090468, 659, 1),
(658, 95090468, 660, 1),
(659, 95090468, 661, 1),
(660, 95090468, 662, 1),
(661, 95090468, 663, 1),
(662, 95090468, 664, 1),
(663, 95090468, 665, 1),
(664, 95090468, 666, 1),
(665, 95090468, 667, 1),
(666, 95090468, 668, 1),
(667, 95090468, 669, 1),
(668, 95090468, 670, 1),
(669, 95090468, 671, 1),
(670, 95090468, 672, 1),
(671, 95090468, 673, 1),
(672, 95090468, 674, 1),
(673, 95090468, 675, 1),
(674, 95090468, 676, 1),
(675, 95090468, 677, 1),
(676, 95090468, 678, 1),
(677, 95090468, 679, 1),
(678, 95090468, 680, 1),
(679, 95090468, 681, 1),
(680, 95090468, 682, 1),
(681, 95090468, 683, 1),
(682, 95090468, 684, 1),
(683, 95090468, 685, 1),
(684, 95090468, 686, 1),
(685, 95090468, 687, 1),
(686, 95090468, 688, 1);

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
(1, 'Economía laboral y demográfica; Mercado laboral formal e informal.', '', NULL, '', 1, 1, '2017-03-10', 1, '2017-03-10'),
(2, 'Economía pública, economía internacional; economía monetaria.', '', NULL, '', 1, 1, '2017-03-13', 1, '2017-03-13'),
(3, 'Economía: Econometría.', '', NULL, '', 1, 1, '2017-03-13', 1, '2017-03-13'),
(4, 'Emprendedores; administración de empresas; economía de la empresa.', '', NULL, '', 2, 1, '2017-04-25', 1, '2017-04-25'),
(5, 'Marketing y publicidad.', '', NULL, '', 2, 1, '2017-04-25', 1, '2017-04-25'),
(6, 'Investigación de Operaciones; teoría de la decisión estadística.', '', NULL, '', 2, 1, '2017-04-25', 1, '2017-04-25'),
(7, 'Economía del bienestar y Desarrollo económico.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(8, 'Nivel de vida; calidad de vida de los hogares; desigualdad y pobreza; pobreza multidimensional.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(9, 'Niveles de renta y riqueza de los hogares.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(10, 'Salud y desarrollo económico.', '', NULL, '', 3, 1, '2017-04-25', 1, '2017-04-25'),
(11, 'Cambios tecnológicos; investigación, desarrollo e innovación (I+D+i).', '', NULL, '', 4, 1, '2017-04-25', 1, '2017-04-25'),
(12, 'Industrialización; industrias manufactureras y de servicios; elección de tecnología.', '', NULL, '', 4, 1, '2017-04-25', 1, '2017-04-25'),
(13, 'Incubadoras de ciencias.', '', NULL, '', 4, 1, '2017-04-25', 1, '2017-04-25'),
(14, 'Inteligencia competitiva.', '', NULL, '', 5, 1, '2017-04-25', 1, '2017-04-25'),
(15, 'Métodos matemáticos y cuantitativos.', '', NULL, '', 5, 1, '2017-04-25', 1, '2017-04-25'),
(16, 'Gestión de la tecnología de la información; Programación; modelos matemáticos y de simulación.', '', NULL, '', 5, 1, '2017-04-25', 1, '2017-04-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_actividad`
--

CREATE TABLE `tbl_tipo_actividad` (
  `id_tipo_actividad_pk` int(11) NOT NULL,
  `nombre_tipo_actividad` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_actividad`
--

INSERT INTO `tbl_tipo_actividad` (`id_tipo_actividad_pk`, `nombre_tipo_actividad`) VALUES
(1, 'Actos protocolarios'),
(2, 'Sesiones magistrales'),
(3, 'Sesiones Paralelas'),
(4, 'Talleres'),
(5, 'Posteres'),
(6, 'Sesiones doctorales'),
(7, 'Ausencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_alimentacion`
--

CREATE TABLE `tbl_tipo_alimentacion` (
  `id_tipo_alimentacion_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tipo de alimentación',
  `nombre_tipo_alimentacion` varchar(50) DEFAULT NULL COMMENT 'Nombre del tipo de alimentación, puede ser vegetariana, vegana, habitual, etc.',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombre_tipo_dictamen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_dictamen`
--

INSERT INTO `tbl_tipo_dictamen` (`id_tipo_dictamen_pk`, `nombre_tipo_dictamen`) VALUES
(1, 'Aceptado'),
(2, 'Aceptado si modifica'),
(3, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_estadistica`
--

CREATE TABLE `tbl_tipo_estadistica` (
  `id_tipo_estadistica_pk` int(11) NOT NULL,
  `nombre_tipo_estadistica` varchar(200) DEFAULT NULL,
  `tbl_tipo_estadisticacol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_identificacion`
--

CREATE TABLE `tbl_tipo_identificacion` (
  `id_tipo_identificacion_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tipo de identificación que será usado por cada usuario.',
  `nombre_tipo_identificacion` varchar(45) DEFAULT NULL COMMENT 'Nombre u descripción dada a cada tipo de usuario-',
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombre_tipo_institucion` varchar(150) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_logs`
--

CREATE TABLE `tbl_tipo_logs` (
  `id_tipo_log_pk` int(11) NOT NULL,
  `tipo_log` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_persona`
--

CREATE TABLE `tbl_tipo_persona` (
  `id_tipo_persona_pk` int(11) NOT NULL,
  `nombre_tipo_persona` varchar(45) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombre_tipo_pregunta` varchar(45) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_tipo_pregunta`
--

INSERT INTO `tbl_tipo_pregunta` (`id_tipo_pregunta_pk`, `nombre_tipo_pregunta`, `creado_por`, `fecha_creacion`, `modificado_por`, `fecha_modificacion`) VALUES
(1, 'Cualitativa', 1, '2017-06-26', 1, '2017-06-26'),
(2, 'Dicotomica', 1, '2017-06-26', 1, '2017-06-26'),
(3, 'Escala de tres selecciones unicas', 2, '2017-06-26', 1, '2017-06-26'),
(4, 'Escala de cuatro selecciones unicas', 2, '2017-06-26', 1, '2017-06-26'),
(5, 'Escala de cinco selecciones unicas', 1, '2017-06-26', 1, '2017-06-26'),
(6, 'Escala de seis selecciones unicas', 1, '2017-06-26', 1, '2017-06-26'),
(7, 'Escala de siete selecciones unicas', 1, '2017-06-26', 1, '2017-06-26'),
(8, 'Escala de ocho selecciones unicas', 1, '2017-06-26', 1, '2017-06-26'),
(9, 'Escala de nueve selecciones unicas', 1, '2017-06-26', 1, '2017-06-26'),
(10, 'Escala de diez selecciones unicas', 1, '2017-06-26', 1, '2017-06-26'),
(11, 'Seleccion Multiple', 1, '2017-06-26', 1, '2017-06-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_solicitud`
--

CREATE TABLE `tbl_tipo_solicitud` (
  `id_tipo_solicitud` int(11) NOT NULL,
  `nombre_tipo_solicitud` varchar(45) NOT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombre_tipo_trabajo` varchar(200) DEFAULT NULL,
  `numero_maximo_autores` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL COMMENT 'En este campo se almacenará el id del usuario que efectuará la creación o modificación respectiva a est tabla. Nótese que estos campos no están relacionados como llave foránea a ninguna tabla, pero se establecerá la relación a manera de referencia.',
  `fecha_modificacion` date DEFAULT NULL,
  `numero_maximo_palabras_clave` int(11) DEFAULT NULL,
  `numero_maximo_palabras_resumen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombre_tipo_usuario` varchar(45) DEFAULT NULL COMMENT 'Nombre dado a cada tipo de usuario dentro del sistema como por ejemplo super usuario.',
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_titulo`
--

CREATE TABLE `tbl_titulo` (
  `id_titulo_pk` int(11) NOT NULL,
  `nombre_titulo` varchar(200) DEFAULT NULL,
  `id_nivel_educativo_fk` int(11) NOT NULL,
  `id_carrera_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour`
--

CREATE TABLE `tbl_tour` (
  `id_tour_pk` int(11) NOT NULL COMMENT 'Identificador único para cada tour creado',
  `nombre_tour` varchar(150) DEFAULT NULL,
  `descripcion` mediumtext COMMENT 'Descripción general del tour, aquí pueden ir datos de interés para dicho tour.',
  `comentario` varchar(150) DEFAULT NULL COMMENT 'Algún dato clave que pueda ser de utilidad',
  `costo` double DEFAULT NULL,
  `Impuesto` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `modificado_por` int(11) DEFAULT NULL,
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour_institucion`
--

CREATE TABLE `tbl_tour_institucion` (
  `id_tour_fk` int(11) NOT NULL,
  `id_institucion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tour_usuario`
--

CREATE TABLE `tbl_tour_usuario` (
  `id_tour_usuario_pk` int(11) NOT NULL,
  `id_tour_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_factura_detalle_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_trabajo`
--

CREATE TABLE `tbl_trabajo` (
  `id_trabajo_pk` int(11) NOT NULL,
  `titulo_trabajo` varchar(200) DEFAULT NULL,
  `fecha_subida` date DEFAULT NULL,
  `ubicacion_archivo` varchar(200) DEFAULT NULL,
  `resumen` longtext COMMENT 'Un resumen que reduce en síntesis de lo que se trata el trabajo.',
  `id_estado_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL COMMENT 'Identificador foráneo a la tabla ''tbl_tematica'' y que define una temática específica para cada trabajo.',
  `id_citacion_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_citacion'' y define para cada trabajo una citación específica.',
  `premio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina si el trabajo es calificado para premio o revista',
  `revista` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano que determina si el trabajo es calificado para premio o revista',
  `horario_sugerido` time DEFAULT NULL COMMENT 'Es el horario en el cual al usuario le gustaría presentar su trabajo (no necesariamente en el cual se va a presentar, ya que depende del programa).',
  `id_tipo_trabajo_fk` int(11) NOT NULL,
  `id_idioma_fk` varchar(2) NOT NULL,
  `palabrasclave` mediumtext,
  `resumenprograma` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_trabajo`
--

INSERT INTO `tbl_trabajo` (`id_trabajo_pk`, `titulo_trabajo`, `fecha_subida`, `ubicacion_archivo`, `resumen`, `id_estado_fk`, `id_tematica_fk`, `id_citacion_fk`, `premio`, `revista`, `horario_sugerido`, `id_tipo_trabajo_fk`, `id_idioma_fk`, `palabrasclave`, `resumenprograma`) VALUES
(1, 'Un Análisis sobre las tendencias contemporáneas de Tercerización en el Sector Turístico Hotelero del Continente Americano', '2017-07-12', '11_es_2017-07-12_01-35-39_documento-congreso-ceat-2017-ajustado.docx', 'La presente investigación, tiene a bien desarrollar un Análisis de tipo de Exploratorio, en el cual se pretenden: Identificar las causales que generan las nuevas tendencias de Tercerización y Subcontratación de Servicios, en el Sector Hotelero Americano, al considerar como principal objeto de estudio, las distintas áreas de gestión empresarial en los hoteles, sobre las cuales se aplican las estrategias de “Outsourcing”.', 1, 12, 0, 0, 1, '00:00:00', 1, 'es', 'Competitividad, Tercerización, Turismo Hotelero', 'La presente investigación, tiene a bien desarrollar un Análisis de tipo de Exploratorio, en el cual se pretenden: Identificar las causales que generan las nuevas tendencias de Tercerización y Subcontratación de Servicios, en el Sector Hotelero Americ'),
(2, 'Una Relación Entre Cartas Crédito y Logística Internacional', '2017-07-30', '4_es_2017-07-30_12-00-29_una-relacinin-entre-cartas-crn-dito-y-logn-stica-internacional.docx', 'Dado a que la globalización contribuye a que el comercio internacional sea cada vez más complejo, se ha creado una creciente interconexión de actividades que sirven de eslabón para unir las diferentes aéreas de una empresa, trabajando estas en conjunto. Por ello nace la necesidad de desarrollar artículos como el presente, cuyo objetivo principal es exponer, de manera técnicapráctica la relación que existe entre el servicio financiero de cartas de crédito y la logística internacional. Dos actividades centrales y de rápido cambio y crecimiento. \r\n\r\nDocumentación (como elemento principal),  Incoterms, otros servicios, como el aseguramiento de las mercancías y el proceso que se lleva a cabo desde la negociación de precios y cantidades hasta que las mismas llegan a su destino final y cómo estas actividades se interrelacionan, es de lo que trata el presente artículo. \r\n', 1, 2, 0, 1, 1, '15:00:00', 1, 'es', 'financiación, crédito, logística, internacional.', 'Se expone, de una manera técnica y practica la relación que posee el servicio financiero de cartas de crédito con la logística internacional, predominando en esta la documentación. '),
(3, 'Modelo de Gestión para la Planeación, Seguimiento, Desarrollo y Cierre Temprano de las Propuestas de Investigación que el IIES-UNAH, tendrá a bien postular en el concurso de Becas de Investigación DIC', '2017-08-14', '24_es_2017-08-15_02-00-17_modelo-de-gestinin-para-la-planeacinin-ceat-2017-2-.docx', 'La presente Investigación, tiene a bien desarrollar un Modelo de Gestión Integral, el cual tendrá a bien sistematizar los procesos requeridos para postular una propuesta de investigación en cualquiera de las categorías, que ofrece la Dirección de Investigación Científica y de Postgrados (DICYP) presenta, dirigido para cualquier investigador de la UNAH, que cuente con este interés/iniciativa', 1, 6, 0, 0, 1, '00:00:00', 1, 'es', 'Sistematización, Procesos, Investigación ', 'La presente Investigación, tiene a bien desarrollar un Modelo de Gestión Integral, el cual tendrá a bien sistematizar los procesos requeridos para postular una propuesta de investigación en cualquiera de las categorías, que ofrece la Dirección de Inv'),
(4, 'Territorios de la Migración Internacional de Honduras', '2017-09-18', '28_es_2017-09-18_08-27-59_trabajo-completo-ceat-2017-territorios-de-la-migracinin-internacional-de-honduras.docx', 'Honduras desde 1990 cambia la tendencia migratoria internacional de inmigración a emigración, ocurre al mismo tiempo que se implementan los procesos de ajuste estructural de la economía, en su afán de solucionar los desequilibrios de la finanzas estatales, repercuten en los hogares hondureños que empiezan con mayor ahínco a buscar una opción de vida en el exterior. A finales de la década el paso del Huracán Mitch tuvo impactos devastadores en el territorio, infraestructura y la economía que se manifestó en las comunidades y familias, ocurriendo que desde ese evento se empezara a visibilizar la emigración. Desde el inicio del nuevo siglo hasta la actualidad puede decirse que es el periodo del auge migratorio hondureño, ya que el fenómeno adquirió una relevancia como nunca en la historia, los Estados Unidos se convierten en el destino por excelencia, se agrega España y otros países de la región. En los años recientes aparte de la problemática estructural de la pobreza y la desigualdad, se agrega la presión demográfica, crisis económicas, deterioro del empleo, desastres naturales, crisis políticas y otros relativos con la violencia que invade todo el territorio nacional como factores que influyen para la búsqueda de oportunidades de vida en el exterior. Esta investigación tiene por objetivo estudiar la emigración internacional de Honduras, desde el ámbito de la demografía de los territorios de origen, donde se genera los flujos, partiendo de datos demográficos contenidos en los dos últimos censos de población, que incluyeron preguntas relativas a la emigración internacional', 1, 1, 0, 0, 1, '00:00:00', 1, 'en', 'Migración Internacional, Migración Internacional de Honduras, Territorios de la Emigración de Honduras', 'Honduras desde 1990 cambia la tendencia migratoria internacional de inmigración a emigración, ocurre al mismo tiempo que se implementan los procesos de ajuste estructural de la economía, en su afán de solucionar los desequilibrios de la finanzas esta'),
(5, 'Las tendencias de la facilitación comercial en la región Centroamericana: Regulaciones y Aranceles.', '2017-09-18', '30_es_2017-09-18_10-48-07_las-tendencias-de-la-facilitacinin-comercial-en-la-reginin-centroamericana.docx', 'La investigación respecto a las tendencias de la facilitación comercial en la región centroamericana, en función de las regulaciones y aranceles, busca en su contenido determinar los progresos en materia de aranceles y regulaciones de los países centroamericanos y las medidas que los mismos han adoptado para facilitar el comercio intrarregional como externo. Para ello, se hace uno de una investigación de tipo descriptiva con una única medición de datos en el tiempo. Asimismo, para enriquecer la investigación se tomó en cuenta diversos indicadores que se han desarrollado con el propósito de cuantificar los esfuerzos hechos por los Estados de la región en estudio, para el libre comercio dejando en manifiesto la importancia de dicha temática, concluyendo a su vez, que la facilitación del comercio y la integración regional están estrechamente relacionados para realizar un proceso comercial optimo, siendo necesario completar la integración Centroamérica con una estructura sólida, unificando instituciones, políticas y aranceles con el fin del bien común.', 1, 2, 0, 0, 1, '00:00:00', 1, 'es', 'Facilitación comercial, arancel, regulaciones.', 'La investigación respecto a las tendencias de la facilitación comercial en la región centroamericana, en función de las regulaciones y aranceles, busca en su contenido determinar los progresos en materia de aranceles y regulaciones de los países.'),
(6, 'INTEGRANDO APRENDIZAJES NO FORMALES E INFORMALES; EL CASO DEL TECNICO UNIVERSITARIO EN CONTROL DE CALIDAD DEL CAFÉ', '2017-09-18', '31_es_2017-09-18_01-40-20_resumen-congreso-iies-nov-2017.docx', 'El subsistema de educación superior hondureño históricamente ha contado con modelos educativos tradicionalistas que han venido reproduciendo, acumulando y agudizando la exclusión, y contribuyendo a la desigualdad sistémica y/o integral, en los aspectos sociales, económicos, culturales, políticos, etcétera, de la sociedad hondureña. Dicha exclusión se ha dado de diferentes formas, afectando personas, experiencias, aprendizajes, conocimientos, en el caso de las personas (grupos vulnerables, étnicos, entre otros), tanto las excluidas que no han logrado ingresar, así como las admitidas que durante el proceso de formación no reciben un reconocimiento de sus experiencias y aprendizajes previos, principalmente los de tipo no formal e informal.\r\nLa situación de exclusión y desigualdad en los sistemas educativos, es un problema que no es exclusivo de Honduras, se manifiesta en el contexto internacional con diferente intensidad en varios países, y desde los años 70´s surgieron movimientos sociales e iniciativas de múltiples actores, con discursos impregnados de una perspectiva humanista hacia justicia social, que luego en los 80´s se fueron dando una construcción discursiva con mecanismos institucionalizados privilegiando una perspectiva más economicista, pasando luego, desde los años 90´s al surgimiento de un entramado discursivo de ambas perspectivas, es decir una mezcla y/o dobles discursos, que al no estar claramente definidos, se corre el riesgo y peligro de conducirse a efectos e impactos, por un lado de inclusiones y/o exclusiones parciales que continúan reproduciendo desigualdades, y por otro lado definiendo agendas locales que responden más a intereses de otros contextos. La pregunta que interesa en esta tesis es sobre el cómo integrar el aprendizaje previo, principalmente el aprendizaje informal y no formal, en el modelo educativo de la UNAH, para lograr una inclusión integral optima y que conduzca a justicia social redistributiva.\r\nAl deconstruir el entramado discursivo, o discursos mezclados y/o dobles, permiten identificar con mayor claridad y de forma sistemática, hacia donde conducen los diferentes mecanismos y/o elementos que forman parte de dicho discurso. Luego, se puede dar un siguiente momento en el ajuste, diseño y o construcción de procesos, en todos los niveles (mega, macro, meso y micro) requeridos con todos los actores claves, orientados a políticas públicas con una inclusión integralmente optima y no parcial.\r\nEs importante resolver lo antes descrito, por diversas razones; a) para dar mayor acceso, cobertura e inclusión a las personas en general y especialmente dando prioridad a los grupos vulnerables; b) para reducir los niveles de desigualdad del sub-sistema de educación superior; b) contribuir al desarrollo humano sostenible de Honduras con justicia social redistributiva. Pero además, que La institucionalidad de la UNAH, como ente rector del sub-sistema de educación superior, cumpla con la responsabilidad de liderar los procesos de desarrollo con todos los actores claves (públicos y privados), y en relación a la ley fundamental de todo el sistema educativo que entró en vigencia desde el año 2012, en base a la autonomía que le faculta la constitución de la república de Honduras, deberá ajustar, diseñar, e implementar en su nueva ley orgánica y el marco jurídico complementario, los componentes de educación formal, no formal e informal.\r\nLa solución al problema de investigación, debe dar respuesta a la pregunta general y toda la cadena de preguntas complementarias de investigación (de insumo, de proceso, de resultado/producto y de síntesis concluyente), es decir que el ´aprendizaje previo` principalmente el no formal e informal, debe ser, gestionado, reconocido, validado y acreditado en el modelo educativo de la UNAH en todos sus niveles de concreción (mega, macro, meso y micro), privilegiando los enfoques, modelos y perspectivas que se orientan hacia lo inmaterial humanista, pero dicha integración para que sea una inclusión integralmente optima, debe ser no solo de los aprendizajes y experiencia, sino que de las personas y actores claves de la sociedad en general (públicos y privados), en un marco de ´educación y aprendizaje a lo largo y ancho de toda la vida`, la ’Sociedad y la Economía basada en el conocimiento´.\r\nLos constructos más utilizados en las dimensiones teóricas, metodológicas son: conocimiento, poder, pedagogía, aprendizaje, identidad, experiencia, aprendizaje de la experiencia, comunicación, cualificación. En la dimensión empírica se utilizan los mismos constructos, pero cambiando las frecuencias y saturación del uso, además surge la inclusión como un constructo muy utilizado en el documento de la política de modelo educativo de la UNAH, así como en el corpus discursivo empírico (contextualización, entrevistas y grupos focales). Además, las categorías integradoras, sobre los enfoques, modelos y perspectivas de los campos de estudio vinculados, fueron las siguientes: a) inmaterial humanista, la cual busca una inclusión integral optima; b) intermedias con tendencias a lo inmaterial (con inclusiones parciales) y/o material (con exclusión); c) material mercantilista que conduce a exclusión y/o desigualdad.\r\nLa solución descrita en el párrafo anterior conlleva una serie de implicancias, traducida en múltiples acciones en un pensamiento prospectivo estratégico de corto, mediano y largo plazo de construir una política pública en el sub-sistema de educación superior. Tomando en cuenta las limitantes de la investigación, y basado en los hallazgos de mecanismos (conceptos/constructos, políticas, leyes, acuerdos, agendas, iniciativas, financiamiento/fondos, conferencias, congresos, debates, reportes, etcétera) y/o elementos discursivos (supuestos, pretensiones de tener la verdad, creencias/principios/valores, privilegios, opuestos/binarios/polos, peligros y riesgos).\r\n', 1, 7, 0, 0, 0, '00:00:00', 2, 'es', 'Economía y sociedad del conocimiento, reconocimiento aprendizajes previos, mecanismos discursivos, desigualdad histórica, inclusión integral optima y justicia social redistributiva.', ''),
(7, 'Educación Bilingüe y su impacto en La Familia: ventajas y limitaciones ', '2017-09-18', '29_es_2017-09-18_01-51-18_propuesta-de-investigacion..docx', 'La educación bilingüe en Honduras ha tenido un significativo aumento en las últimas dos décadas. En Centroamérica, Honduras es el país con el mayor número de instituciones que ofrecen el aprendizaje de una segunda lengua como el idioma inglés, el cual tiene mucha relevancia mundial. Según datos de la Federación Nacional de Instituciones Educativas Privadas (FENIEP) Honduras es el país que ha graduado la mayor población bilingüe. Con este estudio se pretende presentar, a nivel de Tegucigalpa, como estudio de caso las ventajas y limitaciones de este tipo de educación y el impacto socio-económico que estas representan para la familia. ', 1, 7, 0, 0, 0, '16:00:00', 3, 'es', 'Educación, Bilingüe, Familia. ', ''),
(10, 'La importancia de la educación bilingüe en la internalización de educación superior e investigación científica ', '2017-09-18', '34_es_2017-09-18_02-57-42_observaciones-resumen-abreviado-evelyn.docx', 'La globalización ha facilitado intercambios e interacciones sociales en diversos ambientes, lo que ha permitido identificar los  contrastes culturales que es necesario solventar para potenciar el desarrollo global. En vista de que el idioma inglés es un idioma de gran envergadura  para la comunicación se considera necesario explicar la transcendencia e importancia que ha tenido el mismo en las tres últimas décadas en los procesos de internalización del sistema educativo a nivel superior y en el desarrollo de la producción científica, identificando las tendencias contemporáneas a nivel mundial en las dimensiones culturales, académicas, científicas y educativas.', 1, 11, 0, 0, 0, '13:00:00', 3, 'es', 'Importancia, Internalización, Educación superior ', 'Explicar la transcendencia del idioma inglés en lo'),
(11, 'Tendencias tecnológicas en innovación educativa: casos de éxito, sector latinoamericano.', '2017-09-18', '3_es_2017-09-18_03-01-14_tendencias-tecnolnigicas-en-innovacinin-educativa-casos-de-exito-sector-latinoamericano.docx', 'Esta investigación se realizó con el fin de identificar y conocer esas herramientas innovadoras que favorecen la innovación educativa mediante la incorporación pedagógica de las Tecnologías de la Información y las Comunicaciones (TIC). Esto mediante una exploración masiva de material bibliográfico de actualidad.\r\nLa innovación no es un concepto nuevo, sin embargo, en los últimos años con el cambio acelerado que producen las tecnologías de la información en el sector educativo la misma ha vuelto a cobrar relevancia hasta el punto de volverse un elemento fundamental en los procesos de formación. En la actualidad la innovación educativa es una práctica con complejidad absoluta ya que de por si la innovación busca mejoras de conocimiento mediante cambios planificados en procesos, bienes o servicios para una población específica, además engloba muchos aspectos y factores cuya manipulación demanda el manejo y conocimiento de tecnologías para crear competitividad en el medio y en educación considera además métricas para la transferencia de conocimiento.\r\nEn el presente trabajo se expone el problema de estudio, el cual consiste en realizar una exploración y descripción de las tendencias tecnológicas más comunes que se están implementando y desarrollando para la mejora educativa en algunos países de américa latina, esto con el objetivo de dar respuesta a la interrogante, ¿Qué tendencias tecnológicas emergentes se están implementando y se desarrollan en los países latinoamericanos actualmente, con el fin de mejorar la educación de la población?, se estableció el diseño de la investigación  de tipo descriptiva y exploratoria puesto que se busca describir esas tendencias tecnológicas que se están desarrollando e implementando y que aportan un grado significativo de mejora en la educación de la población, identificando características y propiedades de los casos más exitosos para poder realizar un análisis y concluir los avances en el ámbito educativo en estos países del sector, esto con el fin de lograr inducir mejora en nuestra educación adoptando y reflejando factores externos a los nuestros que pudieren influir para promover una educación de calidad.', 1, 11, 0, 0, 1, '10:00:00', 1, 'es', 'Tendencias tecnológicas, innovación educativa, proceso de formación, gestión de conocimiento', 'Tendencias tecnológicas que se están desarrollando e implementando y que aportan un grado significativo de mejora en la educación de la población, identificando características y propiedades de los casos más exitosos para poder realizar un análisis y concluir los avances en el sector educativo, esto con el fin de lograr inducir una conciencia de mejora en nuestra educación adoptando y reflejando factores externos a los nuestros que pudieren influir para promover mejora educativa y de calidad.'),
(12, 'Gasto económico directo de la fase aguda del Chikungunya en adultos durante el periodo epidémico, Honduras, junio 2015 - julio 2016', '2017-09-18', '25_es_2017-09-18_03-17-00_articulo-costos-directos..-con-resumen...docx', 'Las enfermedades generan importantes gastos a la economía de un país, cifras que ascienden hasta los 2,000.00Lps por persona en el sistema público, sobre todo en periodos de epidemia, son inalcanzables para la mayor parte de nuestra población.', 1, 10, 0, 1, 1, '00:00:10', 1, 'es', 'Gasto económico, Chikungunya, Farmacoeconomía, Honduras', ''),
(13, 'Gasto económico indirecto en salud por Chikungunya en adultos, junio 2015 – julio 2016, Honduras', '2017-09-18', '25_es_2017-09-18_03-25-33_articulo-costos-indirectos...-con-resumen.docx', 'gasto economico de una arbovirosis durante periodo epidemico', 1, 8, 0, 1, 1, '00:00:12', 1, 'es', 'Inversión, Chikungunya, ausentismo laboral, Honduras', 'Introducción: Una enfermedad implica inversión económica, en obtención del diagnóstico, sin embargo, también involucra gasto en trIntroducción: Una enfermedad implica inversión económica, en obtención del diagnóstico, sin embargo, también involucra g'),
(14, 'Exportaciones agropecuarias de Honduras hacia los Estados Unidos y las diferentes normativas sanitarias y fitosanitarias para exportar a Estados Unidos', '2017-09-18', '48_es_2017-09-18_03-39-23_investigacion-alejandro-acosta.docx', 'A lo largo de la historia el comercio internacional ha dado paso a la globalización. En la actualidad es común el poder adquirir productos en tiendas locales que hayan sido elaborados al otro lado del mundo, pero para que estos productos hayan llegado hasta estas tiendas tuvieron que aprobar con normas establecidas internacionalmente. Los alimentos tienen que cumplir con normas sanitarias y fitosanitarias, campo donde Estados Unidos resalta por contar con normas y organismos especializados en la protección de sus habitantes en el tema de seguridad alimenticia.', 1, 10, 0, 1, 1, '00:00:00', 1, 'es', 'Sanitarias, Fitosanitarias, Honduras, USA, agropecuario', 'Honduras es un país que cuenta con el sector agropecuario como un pilar económico fuerte y su principal socio económico es Estados Unidos, el país que cuenta con una de las leyes integrales más radicales en aspectos sanitarios y fito-sanitarios.'),
(15, 'Honduras ante el panorama de la dolarización', '2017-09-18', '23_es_2017-09-18_03-50-42_honduras-ante-el-panorama-de-la-dolarizacinin.docx', 'La dolarización en Honduras, aunque no esté oficializada por la autoridad monetaria, ya se vive y experimenta en el país. Sus efectos se hacen sentir en los agentes económicos y en todos los elementos estructurales y variables económicas más importantes relacionadas con la producción, la inversión, el ingreso, el comercio internacional y el consumo. El único que no se escapa de este problema dolarización-devaluación es el asalariado y/o consumidor final que quiera o no, tiene que dar más lempiras por lo que paga o compra. Cuando este fenómeno de la dolarización se somete al debate siempre se aborda desde la óptica financiera y monetaria, pero se rehúye resaltar la visión estructural que hace vislumbrar la pérdida de valor de la moneda nacional como efecto de la débil economía. En vista de ello, la investigación se realizó a partir de una serie de preguntas de investigación sobre el tema, en virtud que no se formularon hipótesis básicamente porque no hubo investigación de campo. Prevaleció el enfoque crítico utilizando para ello las herramientas que da la economía política, en este caso la economía política de la dolarización. Se utilizó el método dialectico. Ante ello, se puede concluir que en Honduras se mantiene un déficit crónico en su balanza de pagos, básicamente por su déficit en la balanza comercial. Por lo que la disponibilidad de divisas siempre es escasa, aun con la entrada de las remesas familiares. ', 1, 2, 0, 0, 1, '09:00:00', 1, 'es', 'Dolarización, Macroeconomía, Inversiones y Gastos', 'La dolarización en Honduras, no oficializada por la autoridad monetaria, se vive en el país. El único que no se escapa a ello es el asalariado y/o consumidor final. Ante ello, la investigación estimula el debate, de manera que permita tomar conciencia de las distintas posturas sobre este problema económico.'),
(16, 'Requisitos para exportar productos perecederos y no perecederos a Centro América ', '2017-09-18', '51_es_2017-09-18_03-55-16_requisitos-para-exportar-productos-perecederos-y-no-perecederos-a-centro-amn-rica-1-.docx', 'La presente investigación es una recopilación documental de los requisitos necesarios para exportar productos perecederos y no perecederos en Centroamérica. Dicha investigación resulta de la necesidad de generar estudios que den a conocer los requisitos que cualquier emprendedor o persona jurídica necesita para la expansión de sus mercados. Para ello, se desarrolla una investigación de tipo cuantitativa con carácter descriptivo. Detallando los requisitos que se requieren y entidades involucradas al momento de establecer procesos de comercio transfronterizo. El conocimiento de las entidades como los procesos necesarios genera una ventaja competitiva y acelera los procesos de comercialización de las empresas en la región Centroamericana. El análisis se detalló por país resaltando que el mismo varía según cada producto, sector, segmento y país de procedencia como de destino.', 1, 2, 0, 0, 1, '00:00:00', 1, 'es', 'Exportación, Productos perecederos, Productos no perecederos ', 'La investigación hace una recopilación documental de los requisitos necesarios para exportar productos perecederos y no perecederos en Centroamérica. Dicha investigación resulta de la necesidad de generar estudios que den a conocer los requisitos que cualquier emprendedor o persona jurídica necesita para la expansión de sus mercados.\r\n\r\n\r\n'),
(18, 'Requisitos para exportar productos perecederos y no perecederos a Centro América ', '2017-09-18', '51_es_2017-09-18_03-57-33_requisitos-para-exportar-productos-perecederos-y-no-perecederos-a-centro-amn-rica-1-.docx', 'La presente investigación es una recopilación documental de los requisitos necesarios para exportar productos perecederos y no perecederos en Centroamérica. Dicha investigación resulta de la necesidad de generar estudios que den a conocer los requisitos que cualquier emprendedor o persona jurídica necesita para la expansión de sus mercados. Para ello, se desarrolla una investigación de tipo cuantitativa con carácter descriptivo. Detallando los requisitos que se requieren y entidades involucradas al momento de establecer procesos de comercio transfronterizo. El conocimiento de las entidades como los procesos necesarios genera una ventaja competitiva y acelera los procesos de comercialización de las empresas en la región Centroamericana. El análisis se detalló por país resaltando que el mismo varía según cada producto, sector, segmento y país de procedencia como de destino.\r\n\r\n', 1, 2, 0, 0, 0, '00:00:00', 1, 'es', 'Exportación, Productos perecederos, Productos no perecederos ', 'La investigación hace una recopilación documental de los requisitos necesarios para exportar productos perecederos y no perecederos en Centroamérica. Dicha investigación resulta de la necesidad de generar estudios que den a conocer los requisitos que cualquier emprendedor o persona jurídica necesita para la expansión de sus mercados.\r\n\r\n'),
(20, 'CMI, PLANTEAMIENTO PARA INSTITUTOS DE INVESTIGACION EN INSTITUCIONES DE EDUCACION SUPERIOR', '2017-09-18', '53_es_2017-09-18_05-53-41_cmi-institutos-de-investigacion-adscritos-a-universidades-estatales.docx', 'Investigación, Desarrollo, Educación e innovación y emprendimiento (I+D+E+i+e) son de vital importancia para los países por ser la base del desarrollo, como tales es necesario la correcta ejecución de cada una de estas dimensiones por los actores involucrados en cada uno de los estratos de la sociedad. Las Instituciones Educación Superior (IES) se fundamentan en Investigación, Docencia y Vinculación por lo que el ciclo I+D+E+i+e tiene relación directa con ellas.\r\n\r\nLa investigación en IES permite no solo el crecimiento del conocimiento, sino que el desarrollo de competencias en los estudiantes y es base para proyectos de emprendimiento por ello, las unidades que se dedican a la investigación deben procurar operar de manera eficaz y eficiente precisamente porque en ellas descansa a responsabilidad de éste pilar. \r\n\r\nEl Cuadro de Mando Integral (CMI) es una herramienta de administración que permite el desarrollo de estrategias que faciliten la correcta ejecución del quehacer de éstas unidades y en el presente documento presentamos la implementación de la mismas en un instituto de investigaciones de una universidad estatal y las estrategias obtenidas para disminuir las debilidades y minimizar las amenazas.\r\n', 1, 4, 0, 1, 1, '10:00:00', 1, 'es', 'CMI, Institutos de investigación, educación superior, administración, plan estratégico', 'Éste trabajo consiste en la tropicalización e implantación del Cuadro de Mando Integral (CMI) en unidades de investigación adscritas a Instituciones de Educación Superior, se presenta la herramienta administrativa, se establece un contexto, se desarrolla un plan de acción y se consiguen objetivos estratégicos para la unidad.'),
(29, 'Innovación tecnológica en empresas para promover el crecimiento económico de Honduras.', '2017-09-18', '36_es_2017-09-18_07-37-42_innovacinen-tecnolnegica-en-empresas-para-promover-el-crecimiento-econnemico-de-honduras.docx', 'La innovación tecnológica brinda un mayor desarrolla a las empresas ante este mundo tan competitivo ya que de esta manera van creando estrategias para abrir nuevos caminos y crear un mayor crecimiento económica tanto para la empresa como para el país.', 1, 11, 0, 1, 0, '13:00:00', 1, 'es', 'Innovación, Tecnología, Crecimiento Económico', 'Hoy en día las empresas cuentan con mayor competencia y es por ello que deberían invertir más en tecnología por el hecho de que al innovar ayuda a un mayor desarrollo de las empresas dentro de su entorno y abre las puertas a nuevos mercados. Junto con ello crean nuevas estrategia de desarrollo y un ambiente competitivo ya que con esta manera se benefician y van creando un mayor crecimiento económico tanto a nivel regional como a nivel mundial.'),
(30, 'Paradigmas de Innovación', '2017-09-18', '26_es_2017-09-18_07-54-40_paradigmas-ceat.docx', 'Un establecimiento de los paradigmas de innovación de innovación que afronta los emprendedores, investigadores, y otros innovadores en su afán de proveer un resultado con características transformadoras de mercado', 1, 11, 0, 0, 1, '09:01:00', 1, 'es', 'Paradigmas, Innovación.', 'La innovación ha suscitado un boom dentro de la gestión de desarrollo y la investigación, la consideración de la innovación como un punto de gran importancia para los gobiernos, academias y empresas tiene una explicación fenomenológica apoyada en eventos históricos con un primer rastro en la revolución industrial, a partir de entonces la innovación ha tenido diversas fronteras, generándose una historia que seguirá haciendo historia.'),
(31, 'Análisis Web de la Clasificación Hotelera en Honduras ', '2017-09-18', '24_es_2017-09-18_10-06-08_paper-ceat-2017-final.docx', 'La Gestión de la Calidad (GC) puede entenderse como un conjunto de herramientas que le permiten a una empresa planear, ejecutar y controlar las actividades para el desarrollo de su función. Particularmente en el sector hotelero, la implementación de estas técnicas tiene gran importancia competitiva y estratégica a nivel mundial, ya que contribuyen a una mejora en la eficiencia de los hoteles y a una mayor satisfacción del cliente. En este sentido, la Organización mundial de Turismo (OMT) estableció una clasificación hotelera que se basa en la identificación de estándares y normas de equivalencia que proporcionan una medición de las características y servicios que brinda un hotel. En Honduras, el Instituto Hondureño de Turismo (IHT) posee una clasificación hotelera con una metodología afín a la desarrollada por la OMT, sin embargo, existen otras instituciones que proporcionan clasificaciones no oficiales de hoteles hondureños. Estas distintas clasificaciones crean señales confusas para los clientes sobre los niveles de calidad ofertados. Por esta razón, en esta investigación se desarrolló un análisis comparativo de las métricas de gestión de calidad oficiales y no oficiales. Asimismo, se desarrolló un análisis integral de la clasificación de los hoteles hondureños en el sistema web Booking, en donde se analizaron 483 hoteles. Los principales resultados de esta investigación indican que las fuentes oficiales poseen criterios más rígidos y objetivos para la clasificación de hoteles, mientras que las fuentes no oficiales ponderan en mayor proporción la opinión y percepción de los clientes. Asimismo, se encontró una relación lineal positiva entre el precio de un hotel, su categoría y las valoraciones subjetivas de los huéspedes del mismo.', 1, 6, 0, 0, 1, '10:00:00', 1, 'es', 'Clasificación Hotelera, Gestión de la Calidad', 'La implementación de la gestión de la calidad en el sector hotelero tiene gran importancia competitiva y estratégica a nivel mundial, ya que contribuyen a una mejora en la eficiencia de los hoteles y a una mayor satisfacción del cliente. El Instituto Hondureño de Turismo (IHT) es el ente encargado de regular la clasificación y categorización hotelera en Honduras, sin embargo, existen sistemas web que proporcionan clasificaciones no oficiales de hoteles hondureños (ej. Trivago, Booking, TripAdvisor). Estas distintas clasificaciones crean señales confusas para los clientes sobre los niveles de calidad de los hoteles hondureños. Por esta razón, en esta investigación se desarrolló un análisis comparativo de las métricas de gestión de calidad oficiales y no oficiales. Asimismo, se desarrolló un análisis integral de la clasificación de los hoteles hondureños en el sistema web Booking, en donde se analizaron 483 hoteles. Los principales resultados de esta investigación indican que las fuentes oficiales poseen criterios más rígidos y objetivos para la clasificación de hoteles, mientras que las fuentes no oficiales ponderan en mayor proporción la opinión y percepción de los clientes. Asimismo, se encontró una relación lineal positiva entre el precio de un hotel, su categoría y las valoraciones subjetivas de los huéspedes del mismo.'),
(32, '`Del enfoque conceptual a la práctica de la política social: Los programas de protección social en Honduras\r\n \r\n', '2017-09-18', '61_es_2017-09-18_10-34-49_de-lo-conceptual-a-la-practica-de-la-politica-social-ceat-2017.docx', 'La práctica social de las políticas públicas sociales implica una serie de acciones encaminadas a apoyar las carencias sociales y económicas por medio de programas y proyectos directamente relacionados con la población en desventaja social. Sin embargo, hay diferentes enfoques que ayudan a implementar estos programas. Desde lo conceptual a dirigir estas acciones y que son puestas en marcha en varios países donde han tenido éxito. \r\n\r\nLa revisión desde lo conceptual de la implementación de las políticas públicas sociales en Honduras, implica un esfuerzo para revisar los diferentes enfoques de la protección social, y no solo desde la teoría, sino de su aplicación, de ahí que se ve el caso de diferentes países en el contexto latinoamericano y otros países de otras latitudes. \r\nAsimismo, es importante analizar otros aspectos que impulsan las políticas sociales, en este caso de las transferencias monetarias condicionadas, como punta de lanza para contrarrestar los efectos de la pobreza continuada, para paliar los efectos de las medidas macroeconómicas, como la pobreza, el desempleo y la falta de acceso a los servicios básicos.\r\n', 1, 7, 0, 0, 1, '00:00:00', 1, 'es', '', ''),
(34, 'IMPACT OF DEMOGRAPHIC GROWTH IN THE ECONOMIC GROWTH AND PRODUCTIVITY OF LABOR MARKET IN NORTHERN TRIANGLE OF CENTRAL AMERICA', '2017-09-18', '62_es_2017-09-18_11-43-12_ponencia-eya-ceat-rv.docx', 'The present study pretends to know the impact on economic growth and productivity in the labor market caused by population growth presenting the North Triangle of Central America (NTCA). Diverse literature reviewed, argues that population growth is a key advantage for boosting economic growth in the long term and if it is concentrated in productive age (15-64 years).\r\n\r\nThe demographic boom, countries experiencing NTCA will concentrate on the productive age, which is why interest in this study, to know the impact on various policy variables such as GDP growth per worker and per person; Growth of physical capital per worker; growth rate of schooling per worker and productivity.\r\n\r\nThe innovation of this research is the analysis of the impact of population growth is not based on per-capita growth and not purely on accumulation, then by growth accounting analysis and econometric tools has determined that the impact interesting to analyze population dynamics, lies in considering changes through participation in the labor market through channels disaggregated contributions to productivity and the accumulation of each of the factors of production.', 1, 1, 0, 0, 1, '10:00:00', 1, 'en', 'Demographic bonus, Physical Capital per Worker, Labour Market productivity, Solow´s growth, Solow´s Residual.', 'The present study pretends to know the impact on economic growth and productivity in the labor market caused by population growth presenting the North Triangle of Central America (NTCA). Diverse literature reviewed, argues that population growth is a key advantage for boosting economic growth in the long term and if it is concentrated in productive age (15-64 years).\r\n\r\nThe demographic boom, countries experiencing NTCA will concentrate on the productive age, which is why interest in this study, to know the impact on various policy variables such as GDP growth per worker and per person; Growth of physical capital per worker; growth rate of schooling per worker and productivity.\r\n\r\nThe innovation of this research is the analysis of the impact of population growth is not based on per-capita growth and not purely on accumulation, then by growth accounting analysis and econometric tools has determined that the impact interesting to analyze population dynamics, lies in considering changes through participation in the labor market through channels disaggregated contributions to productivity and the accumulation of each of the factors of production.'),
(35, 'Problemas socioeconómicos de la población joven en Honduras del 2001 y 2013', '2017-09-18', '32_es_2017-09-19_09-09-18_investigacinin-final-de-la-poblacinin-juvenil-de-honduras.docx', 'En esta investigación se analizo los factores socioeconómicos que más afectan al desarrollo y comportamiento de la población joven en Honduras, de las edades comprendidas dentro 12 a 30 años. En este trabajo se tiene referencia de muchas investigaciones en el tema de grupos étnicos, educación, analfabetismo, discriminación social, necesidades básicas insatisfechas, oportunidades de empleo y otros más.', 1, 1, 0, 0, 1, '07:00:00', 1, 'es', 'Población juvenil, necesidades básicas insatisfechas, población económicamente activa.', 'análisis de los problemas socioeconómicos que enfrenta la población joven de Honduras comprendido dentro de las edades de 12 a 30 años, en los años 2001 y 2013 y que efectos generan en la juventud. '),
(37, 'Estrategias Mercadológicas para la difusión del Conocimiento generado por las unidades académicas de la Universidad Nacional Autónoma de Honduras ', '2017-09-18', '15_es_2017-09-25_08-14-59_estrategias-mercadolnigicas-para-la-difusinin-del-conocimiento-generado-por-las-unidades-acadn-micas-de-la-universidad-nacional-autninoma-de-honduras.docx', 'El conocimiento como materia prima en las sociedades, juega un rol indispensable en el siglo XXI, siendo a través de procesos metodológicos la inserción de nuevos modelos que favorecen el fortalecimiento y difusión del conocimiento, por ello; es considerable necesario que las unidades académicas de la Universidad Nacional Autónoma de Honduras (UNAH), implementen estrategias mercadológicas que difundan el conocimiento generado, contribuyendo de esta manera a la vinculación universidad – sociedad, insertando conocimiento que podrá implementarse, para la resolución de problemáticas que afectan la sociedad hondureña. Con la investigación se plantea de manera descriptiva las estrategias mercadológicas que podrán utilizar las unidades académicas de la UNAH. Canalizando así, el conocimiento a través de las unidades, haciendo uso de técnicas y herramientas difusoras, en las que podrán apropiándose del conocimiento y poniéndolo al servicio de la sociedad. Fortaleciendo de esta manera el desarrollo humano sostenible del país por medio de la ciencia y cultura. ', 1, 14, 0, 0, 1, '10:00:00', 1, 'es', 'Marketing, Gestión del Conocimiento, Difusión del conocimiento. ', 'El conocimiento como materia prima en las sociedades, juega un rol indispensable en el siglo XXI, siendo a través de procesos metodológicos la inserción de nuevos modelos que favorecen el fortalecimiento y difusión del conocimiento, por ello; es considerable necesario que las unidades académicas de la Universidad Nacional Autónoma de Honduras (UNAH), implementen estrategias mercadológicas que difundan el conocimiento generado, contribuyendo de esta manera a la vinculación universidad – sociedad, insertando conocimiento que podrá implementarse, para la resolución de problemáticas que afectan la sociedad hondureña.'),
(38, 'El efecto de la mediación de la Orientación de la cadena de suministros en la flexibilidad y el rendimiento competitivo\n\n', '2017-09-19', '64_es_2017-09-19_12-01-39_el-efecto-de-la-mediacinin-de-la-orientacinin-de-la-cadena-de-suministros-a-lo-largo-de-la-flexibilidad-y-el-rendimiento-competitivo.docx', 'Actualmente, las plantas competitivas centran sus esfuerzos en la reducción de los costos, la automatización, manejo de los desperdicios, expansión, crecimiento y nuevas tecnologías. No obstante, estudios ', 1, 12, 0, 0, 1, '10:00:00', 1, 'es', 'Orientación de la cadena de suministros, rendimiento competitivo, flexibilidad', 'Actualmente, las plantas competitivas centran sus esfuerzos en la reducción de los costos, la automatización, manejo de los desperdicios, expansión, crecimiento y nuevas tecnologías. No obstante, estudios recientes demuestran que la volatilidad del mercado y las incertidumbres en el mismo, no han dado paso a una visión integral del impacto que tienen variables tales como; orientación de la cadena de suministros (OCS) sobre la flexibilidad (F) y el rendimiento de las operaciones (RO). Esto implica que se requieren estudios que den claridad y profundidad al rol que tiene la flexibilidad (impulso o restricción) para ajustar los procesos de la cadena de suministros para la mejora del rendimiento competitivo. Para ello, se hace uso de las encuestas de la cuarta ronda del proyecto HPM, cuya composición muestral fue de 250 plantas de 10 países en 3 continentes, diseminados en el área de automoción, electrónica y maquinaria. Los análisis se desarrollaron bajo el modelo de ecuaciones estructurales, específicamente, el método de mínimos cuadrados parciales. Los resultados indican el nivel de mediación bidireccional que existe cuando OCS media entre las variables F y RO en las empresas de clase mundial'),
(39, 'Análisis de la Vivienda en Honduras 1988-2013', '2017-09-19', '65_es_2017-09-19_12-12-36_annolisis-de-la-vivienda-en-honduras.docx', 'El sector de la vivienda es un factor importante para el desarrollo de un país; tanto a nivel económico como de bienestar social, es después de la alimentación el rubro más importante en la inversión del núcleo familiar. La vivienda constituye dentro del marco del análisis demográfico, una variable muy importante porque refleja las condiciones sociales y económicas de una población. Asimismo, partiendo de las condiciones de calidad de las mismas se  puede asumir la calidad de vida de la población.\r\n\r\nEl acceso a la vivienda si bien es cierto es un derecho fundamental universal para la sobrevivencia humana, también es cierto que en las últimas décadas en nuestro país se ha convertido en un lujo para muchas personas, especialmente para los más jóvenes porque la precariedad laboral y el desempleo que impera en nuestro país, imposibilita el nivel de financiamiento requerido para tal fin.  \r\n\r\nEste artículo incluye la evolución que ha tenido el sector vivienda en las últimas tres décadas, de igual forma, abarca una estimación de las características de las viviendas particulares ocupadas y desocupadas con respecto a la disponibilidad de los servicios básicos. \r\n', 1, 7, 0, 0, 1, '10:00:00', 1, 'es', 'Vivienda, Calidad de vida, Condiciones de la vivienda  ', ''),
(40, 'El efecto de la mediación de la Orientación de la cadena de suministros en la flexibilidad y el rendimiento competitivo', '2017-09-19', '64_es_2017-09-19_12-40-33_el-efecto-de-la-mediacinin-de-la-orientacinin-de-la-cadena-de-suministros-a-lo-largo-de-la-flexibilidad-y-el-rendimiento-competitivo.docx', 'Actualmente, las plantas competitivas centran sus esfuerzos en la reducción de los costos, la automatización, manejo de los desperdicios, expansión, crecimiento y nuevas tecnologías. No obstante, estudios recientes demuestran que la volatilidad del mercado y las incertidumbres en el mismo, no han dado paso a una visión integral del impacto que tienen variables tales como; orientación de la cadena de suministros (OCS) sobre la flexibilidad (F) y el rendimiento de las operaciones (RO). Esto implica que se requieren estudios que den claridad y profundidad al rol que tiene la flexibilidad (impulso o restricción) para ajustar los procesos de la cadena de suministros para la mejora del rendimiento competitivo. Para ello, se hace uso de las encuestas de la cuarta ronda del proyecto HPM, cuya composición muestral fue de 250 plantas de 10 países en 3 continentes, diseminados en el área de automoción, electrónica y maquinaria. Los análisis se desarrollaron bajo el modelo de ecuaciones estructurales, específicamente, el método de mínimos cuadrados parciales. Los resultados indican el nivel de mediación bidireccional que existe cuando OCS media entre las variables F y RO en las empresas de clase mundial. ', 1, 6, 0, 0, 1, '10:00:00', 1, 'es', 'Orientación de la cadena de suministros, rendimiento competitivo, flexibilidad', 'Actualmente, las plantas competitivas centran sus esfuerzos en la reducción de los costos, la automatización, manejo de los desperdicios, expansión, crecimiento y nuevas tecnologías. No obstante, estudios recientes demuestran que la volatilidad del mercado y las incertidumbres en el mismo, no han dado paso a una visión integral del impacto que tienen variables tales como; orientación de la cadena de suministros (OCS) sobre la flexibilidad (F) y el rendimiento de las operaciones (RO). Esto implica que se requieren estudios que den claridad y profundidad al rol que tiene la flexibilidad (impulso o restricción) para ajustar los procesos de la cadena de suministros para la mejora del rendimiento competitivo. Para ello, se hace uso de las encuestas de la cuarta ronda del proyecto HPM, cuya composición muestral fue de 250 plantas de 10 países en 3 continentes, diseminados en el área de automoción, electrónica y maquinaria. Los análisis se desarrollaron bajo el modelo de ecuaciones estructurales, específicamente, el método de mínimos cuadrados parciales. Los resultados indican el nivel de mediación bidireccional que existe cuando OCS media entre las variables F y RO en las empresas de clase mundial. '),
(41, 'Construcción de una metodología como ayuda en la elaboración de videos educativos para fortalecer el aprendizaje', '2017-09-19', '68_es_2017-09-19_10-10-05_resumen-extendido.doc', 'Actualmente los videos se han convertido en un medio en el cual los estudiantes se apoyan ya sea sea para aprender o reforzar sus conocimientos dichos videos son creados por muchos educadores debido a su facilidad y su contenido puede ser especifico a un tema determinado a diferencia de los libros electrónicos según señala (Krosnick 2015) ya que los libros electrónicos proporcionan un panorama general del contenido lo cual muchas veces son menos atractivos, (Brame 2015) muestra un conjunto de consideraciones que proporcionan una base sólida para el desarrollo y el uso del video como herramienta educativa, (Pratusevich 2015) muestra un panorama sobre los videos educativos aunque sean de forma masiva la mayoría de ellos  comparten dos características en común las cuales son el contenido textual y la composición de las personas presentando el video.\r\n\r\nLa presente investigación se lista los criterios necesarios para la creación de videos educativos, para lo cual se analizaron fuentes relativas al tema de investigación para luego llegar a la creación de una metodología como soporte para la elaboración de los mismos  ', 1, 11, 0, 0, 0, '13:00:00', 2, 'es', 'Video, Metodología, Educativo.', 'La presente investigación se lista los criterios necesarios para la creación de videos educativos, para lo cual se analizaron fuentes relativas al tema de investigación para luego llegar a la creación de una metodología como soporte para la elaboración de los mismos.   ');
INSERT INTO `tbl_trabajo` (`id_trabajo_pk`, `titulo_trabajo`, `fecha_subida`, `ubicacion_archivo`, `resumen`, `id_estado_fk`, `id_tematica_fk`, `id_citacion_fk`, `premio`, `revista`, `horario_sugerido`, `id_tipo_trabajo_fk`, `id_idioma_fk`, `palabrasclave`, `resumenprograma`) VALUES
(42, 'Relaciones Comerciales de Taiwán con el Triángulo Norte de Centroamérica: Perspectivas, Implicaciones y Rumbos ', '2017-09-19', '57_es_2017-09-19_11-41-11_investigacinin-final-ceat-2017.docx', 'Este trabajo de investigación pretende presentar un amplio panorama sobre las relaciones comerciales de Honduras, El Salvador y Guatemala (Triángulo Norte de Centroamérica) con la Republica de China (Taiwán), bajo la premisa del impacto económico y social que estas relaciones comerciales han producido en los habitantes de los países signatarios, a través de datos estadísticos de exportación e importación así como analizando aspectos de carácter económico de Taiwán.\r\nEl comercio internacional ha tomado auge en todos los países alrededor del mundo en los últimos 30 años, principalmente por el incremento de los volúmenes del intercambio de los productos entre las naciones, la apertura comercial que han adoptado la gran mayoría de los países del hemisferio, y las tendencias de un sistema económico global orientado hacia una economía de mercado impulsada principalmente por el capitalismo. Estos factores incrementan las posibilidades de los países de tener acceso a aquellos bienes y servicios que no se producen en su territorio o que al producirlos tienen un alto costo en comparación con otros, aplicando así la división internacional del trabajo, la cual principalmente modela las características productivas que impulsaron el comercio en la antigüedad.', 1, 2, 0, 1, 1, '15:00:00', 1, 'es', 'Comercio internacional, política comercial, economía, exportaciones, importaciones.', 'El siguiente artículo de investigación pretende brindar un aporte a la contextualización de las relaciones comerciales del triángulo Norte de Centroamérica (Guatemala, El Salvador y Honduras) con la Republica de Taiwán, analizando la evolución histórica de las exportaciones e importaciones entre los países anteriormente mencionados, partiendo de la premisa de la ejemplar política comercial taiwanesa y analizando una posible unificación de los Tratados de Libre Comercio unilaterales de Honduras El Salvador y Guatemala con Taiwán conducente a una mayor fluidez comercial con el país asiático. '),
(43, 'Incubadoras y su aporte en investigación Científica, aproximación epistemológica ', '2017-09-20', '56_es_2017-09-20_12-49-36_incubadoras-desarrollo.docx', 'En el marco de la gestión de los procesos cognitivos en los Centros de Promoción Incubación y Desarrollo (CPID), así como la respectiva transferencia del conocimiento se encuentra inmerso un aspecto de importancia, no sólo contable y monetario, sino  también productivo y competitivo, el cual es denominado recientemente incubadoras de ciencias (I. C.). Elemento que traspasa la barrera de lo económico para convertirse en herramienta altamente utilizada en el medio empresarial y académico de las organizaciones de la cuádruple hélice.\r\nEl presente documento busca desarrollar una síntesis exploratoria, mediante un constructo  teórico  y bibliográfico de las  definiciones y modelos conocidos  sobre  el tema,  por medio  de la síntesis, compilación y análisis documental, para establecer algunos indicadores relevantes que permitan identificar el rol o función de la universidad pública  y, de esta  forma,  plantear un avance  en el diseño de indicadores de gestión en la función social  de la educación caso del nivel superior. El método para analizar el avance y/o contribución de dichos CPID se basa en la reflexión bibliográfica a fin de poder definir los indicadores que permitan resultados a ser considerados para procesos de evaluación periódica y con ello generar nuevos saberes para el beneficio de los actores previamente comentados. \r\n', 1, 7, 0, 0, 1, '09:00:00', 1, 'es', 'Capital humano, Mercados de trabajo, Emprendimiento ', 'En el marco de la gestión de los procesos cognitivos en los Centros de Promoción Incubación y Desarrollo (CPID), así como la respectiva transferencia del conocimiento se encuentra inmerso un aspecto de importancia, no sólo contable y monetario, sino  también productivo y competitivo, el cual es denominado recientemente incubadoras de ciencias (I. C.). Elemento que traspasa la barrera de lo económico para convertirse en herramienta altamente utilizada en el medio empresarial y académico de las organizaciones de la cuádruple hélice.'),
(44, 'Análisis del Mercado Internacional de la Piña', '2017-09-20', '27_es_2017-09-20_09-37-39_trabajo-completo-el-mercado-de-la-pin-a-javier-.docx', 'El presente trabajo analiza el comportamiento que ha tenido el mercado de la piña, tanto en su producción, comercialización, exportación e importación a diferentes países del mundo, tanto de la región centroamericana como de otras regiones líderes en la producción y exportación de esta fruta, identificando cuales son los principales productores, principales exportadores e importadores de la misma. Haciendo mención de que métodos utiliza Costa Rica para posicionarse como líder en la producción y exportación de la Piña. ', 1, 7, 0, 1, 1, '11:30:00', 1, 'es', 'Mercado de la Piña, exportación, importación', 'El mercado internacional de la piña se presagia con grandes expectativas de crecimiento tanto en la producción como en la comercialización, son diversos los factores que influyen para que se den cambios en este mercado frutícola que actualmente es liderado por el vecino país de Costa Rica.'),
(45, 'Análisis de la vivienda en Honduras 1988-2013', '2017-09-22', '52_es_2017-09-22_01-36-12_annolisis-de-la-vivienda-en-honduras.docx', 'El sector vivienda de Honduras, está estrechamente relacionado con la calidad de vida de la población y el déficit habitacional existente en el país. Esta investigación enuncia la evolución habitacional en las últimas tres décadas (1988-2013). Describe las características estructurales de las viviendas particulares y la disponibilidad de servicios básicos a nivel nacional. ', 1, 7, 0, 0, 1, '10:00:00', 1, 'es', 'Vivienda, Calidad de vida, Condiciones de la vivienda  ', 'El sector de la vivienda es un factor importante para el desarrollo de un país; tanto a nivel económico como de bienestar social, es después de la alimentación el rubro más importante en la inversión del núcleo familiar. La vivienda constituye dentro del marco del análisis demográfico, una variable muy importante porque refleja las condiciones sociales y económicas de una población. Asimismo, partiendo de las condiciones de calidad de las mismas se  puede asumir la calidad de vida de la población.\r\n\r\nEl acceso a la vivienda si bien es cierto es un derecho fundamental universal para la sobrevivencia humana, también es cierto que en las últimas décadas en nuestro país se ha convertido en un lujo para muchas personas, especialmente para los más jóvenes porque la precariedad laboral y el desempleo que impera en nuestro país, imposibilita el nivel de financiamiento requerido para tal fin.  \r\n\r\nEste artículo incluye la evolución que ha tenido el sector vivienda en las últimas tres décadas, de igual forma, abarca una estimación de las características de las viviendas particulares ocupadas y desocupadas con respecto a la disponibilidad de los servicios básicos. \r\n\r\n'),
(47, 'INTEGRACIÓN Y TIC EN HOTELES: IMPORTANCIA DE SU IMPLEMENTACIÓN CONJUNTA ', '2017-09-27', '33_es_2017-09-27_02-25-33_integracinin-y-tic-en-hoteles-importancia-de-implementacinin-conjunta-n-ltima-versinin.docx', 'La presente investigación tiene como principal objetivo consolidar, comparar y utilizar toda información y evidencia ya generada acerca las estrategias de integración dentro de una empresa y su relación con las tecnologías de información y comunicación para la misma. Se espera construir un marco referencial sustentado en dichas teorías de la aplicación de ambas herramientas o estrategias para así obtener un mejor desempeño en los indicadores de la empresa y al mismo tiempo logrando mayor satisfacción del cliente.\r\nLas estrategias de integración fueron dimensionadas o definidas de diferentes formas de acuerdo al enfoque de las teorías que los investigadores tomaran en cuenta. Para efectos de esta investigación, clasificaremos la integración de la empresa en tres categorías: 1. Integración interna de la compañía, 2. Integración con Proveedores y 3. Integración con el cliente (Flynn, Huo, & Zhao, 2010). Al mismo tiempo, estableceremos tres niveles de integración del proceso en las siguientes categorías: a) Integración de la información, b) Integración operativa y c) Integración Financiera. (Leuschner, Rogers, & Charvet, 2013).\r\nLa segunda herramienta o estrategia de gestión de operaciones que incluiremos en este estudio es el uso y niveles de intensidad de ese uso en cuanto a Tecnologías de Información y Comunicación se refiere. Es donde entra la mano informática, tecnológica y de agilización de procesos por medio de softwares y hardwares unidos al recurso humano de una empresa. \r\nEl principal enfoque final es encontrar evidencia de cómo estas dos prácticas de la gestión de operaciones se potencian al ser aplicadas complementariamente para lograr un mejor rendimiento de la empresa.\r\nPara lo anterior realizaremos una revisión sistemática de literatura por medio de cuadros comparativos donde se evaluarán escalas de medición utilizadas, muestras, variables, resultados y conclusiones de forma que nos permita realizar un enfoque robusto de discusión alrededor de estos temas.\r\n', 1, 4, 0, 1, 1, '09:00:00', 1, 'es', 'Cadena de suministros, Tecnologías de información y comunicación (TIC), Integración, desempeño empresarial', 'La presente es una investigación de enfoque cualitativo que utiliza la revisión sistemática de publicaciones científicas, con el fin de analizar las evidencias de diferentes industrias o sectores empresariales enfocados en aplicar estrategias de integración. Se delimita entre Integración Interna e Integración Externa y el uso de las Tecnologías de Información y Comunicación para dichos procesos.'),
(48, 'Determinantes del empleo infantil y Políticas Públicas durante el periodo 2010-2016', '2017-09-29', '72_es_2017-09-29_08-44-08_ceat-bayardo-cabrera.docx', 'La investigación aborda el tema del empleo infantil desde un paradigma cuantitativo, se determina cuáles son las variables socioeconómicas más incidentes para que un niño se vea forzado a tener que trabajar, se entiende como niño toda aquella persona menor a 18 años. Asimismo, se trata de evaluar cuál ha sido el rol de las políticas públicas en Honduras en la reducción del empleo infantil, y de esta manera saber si realmente los programas y políticas formuladas con el objetivo de la reducción del trabajo infantil, realmente están enmarcadas a resolver las principales problemáticas y determinantes del empleo infantil en Honduras. Aunado a lo anterior, se hizo una caracterización del empleo infantil para contextualizar como se ha encontrado esta problemática desde el año 2010. Para el desarrollo de la investigación se utilizó la EPHM del periodo 2010-2016 y se caracterizó todas las políticas y programas de reducción del trabajo infantil formuladas por el gobierno en el periodo 2010-2016.  ', 1, 1, 0, 0, 0, '00:00:00', 3, 'es', 'determinantes, empleo infantil, políticas públicas', 'La investigación aborda el tema del empleo infantil desde un paradigma cuantitativo, se determina cuáles son las variables socioeconómicas más incidentes para que un niño se vea forzado a tener que trabajar, se entiende como niño toda aquella persona menor a 18 años. Asimismo, se trata de evaluar cuál ha sido el rol de las políticas públicas en Honduras en la reducción del empleo infantil, y de esta manera saber si realmente los programas y políticas formuladas con el objetivo de la reducción del trabajo infantil, realmente están enmarcadas a resolver las principales problemáticas y determinantes del empleo infantil en Honduras. Aunado a lo anterior, se hizo una caracterización del empleo infantil para contextualizar como se ha encontrado esta problemática desde el año 2010. Para el desarrollo de la investigación se utilizó la EPHM del periodo 2010-2016 y se caracterizó todas las políticas y programas de reducción del trabajo infantil formuladas por el gobierno en el periodo 2010-2016.  '),
(49, 'Competencias y habilidades que necesitan los economistas de la UNAH para insertarse en el mercado laboral. ', '2017-09-29', '73_es_2017-09-29_10-12-45_competencias-y-habilidades-que-necesitan-los-economistas-de-la-unah-para-insertarse-al-mercado-laboral..docx', 'Con esta investigación se pretenden analizar los enfoques de cadena de suministro y cadena de valor en la educación superior, partiendo de tres clústeres principales, en el primer clúster se hace un análisis de las condiciones iniciales de ingreso a la carrera (sexo, edad, lugar de procedencia, sí es bilingüe, tipo de colegio, título de secundaria) y un análisis de las competencias que adquieren los estudiantes según el perfil de la carrera de economía en la UNAH. Las competencias del perfil de la carrera de economía se compararán con las competencias del perfil de las universidades públicas y con la mejor universidad privada de cada país de América Latina, esto con el propósito de validar el grado de actualización de nuestra carrera. En el segundo clúster, se analizarán las competencias deseadas de las organizaciones que emplean economistas, en este apartado se validaran los indicadores de la cadena de valor en cuanto habilidades adquiridas, segundo idioma, manejo de software, conocimientos teóricos, tiempo para insertarse en el mercado laboral, tipo de organización empleadora. El tercer clúster se centra en el match entre las competencias adquiridas por los economistas de la UNAH y las competencias deseadas por las organizaciones que emplean economistas de la misma, otras variables a medir son el grado de empleabilidad, escala salarial de acorde al arancel vigente, nivel en la toma de decisiones. ', 1, 1, 0, 0, 0, '10:30:00', 2, 'es', 'Educación Superior, Mercado laboral, Competencias', ''),
(50, 'Enseñanza de Lenguas Extranjeras a personas con discapacidad visual en la Universidad Nacional Autónoma de Honduras, Ciudad Universitaria: Propuesta de estrategias metodológicas', '2017-09-29', '76_es_2017-09-29_05-43-17_resumen-congreso-ceat.docx', 'La presente investigación está orientada a analizar las estrategias metodológicas empleadas en la enseñanza de Lenguas Extranjeras con estudiantes con discapacidad visual en Ciudad Universitaria en el año 2017. Los datos serán recolectados mediante encuestas realizadas a dichos estudiantes. El estudio será no experimental, usando una metodología de estudio de casos. Con dicho estudio se espera identificar los principales problemas que presentan los estudiantes con discapacidad visual en el aprendizaje de una lengua extranjera para poder elaborar un manual de estrategias metodológicas como apoyo para los docentes y estudiantes y que de esta manera puedan mejorar su aprendizaje.', 1, 11, 0, 0, 0, '10:00:00', 3, '0', 'estrategias metodológicas, atención a la diversidad, discapacidad visual', 'Esta investigación está orientada a analizar las estrategias metodológicas empleadas en la enseñanza de Lenguas Extranjeras con estudiantes con discapacidad visual en Ciudad Universitaria en el año 2017. Los datos serán recolectados mediante encuestas realizadas a dichos estudiantes. El estudio será no experimental, usando una metodología de estudio de casos'),
(52, 'Factores que influyen en la Cultura Gastronomica Hondureña en niños de 16 a 13 años', '2017-09-29', '81_es_2017-09-29_08-44-57_resumen-abreviado.docx', 'El propósito de la investigación es analizar los factores que influyen en la cultura gastronómica hondureña en estudiantes de 7 y 8 grado, se realizara una investigación cuantitativa, tomando en cuenta   las variables de tiempo, precio e influencia social, en el centro Educativo Evangélico Hosanna de Tegucigalpa, está investigación será de tipo experimental y consistirá en la manipulación de las variables, en condiciones rigurosamente controladas.', 1, 8, 0, 0, 0, '09:00:00', 3, 'es', 'Identidad, Gastronomía, Cultura. ', 'El propósito de la investigación es analizar los factores que influyen en la cultura gastronómica hondureña en estudiantes de 7 y 8 grado, se realizara una investigación cuantitativa, tomando en cuenta   las variables de tiempo, precio e influencia social, en el centro Educativo Evangélico Hosanna de Tegucigalpa, está investigación será de tipo experimental y consistirá en la manipulación de las variables, en condiciones rigurosamente controladas.'),
(53, 'Incidencias del Capital Humano en el Crecimiento Económico de Honduras 1980-2016', '2017-09-29', '75_es_2017-09-29_10-21-45_resumen-abreviado-capital-humano-y-crecimiento-econnimico..docx', 'Mediante el presente trabajo se analizan los componentes del capital humano y la incidencia que este, aunado con el resto de factores productivos, ha tenido dentro del crecimiento económico de Honduras durante el período 1980-2016. El estudio es de corte transversal con perspectiva histórica y denota un alcance hipotético-deductivo. En virtud de lo anterior se hicieron estimaciones mediante técnicas econométricas utilizando series de tiempo. Los resultados obtenidos señalan como el acervo de capital humano, a través de la educación y los factores de producción, incide en el crecimiento económico.      ', 1, 7, 0, 0, 0, '10:00:00', 3, 'es', 'Capital Humano, Crecimiento Económico, Educación, Factores Productivos.', 'Mediante el presente trabajo se analizan los componentes del capital humano y la incidencia que este, aunado con el resto de factores productivos, ha tenido dentro del crecimiento económico de Honduras durante el período 1980-2016. '),
(54, 'Situación de la autonomía en el proceso de aprendizaje en  los estudiantes de la carrera de Lenguas extranjeras del II PAC 2017', '2017-09-30', NULL, 'El presente documento resulta del análisis de los niveles del autoaprendizaje en los estudiantes de la carrera de lenguas extranjeras del II PAC 2017. Los datos serán presentados a través de medidas de tendencia central. El estudio es no experimental de corte transversal. Cuestionarios y pruebas serán aplicados para establecer el nivel de autonomía del aprendizaje en los estudiantes de dicha carrera y determinar el tipo de estrategias empíricas usadas para mejorar el proceso de aprendizaje. Se espera con los resultados identificar las estrategias empíricas utilizadas por los estudiantes con el fin de proponer medidas para reforzarlas o enseñarlas.  \r\n\r\n', 1, 14, 0, 0, 0, '14:00:00', 3, 'es', 'autoaprendizaje, estategias empiricas, factores de aplicación', '\r\n Análisis de la situación de la autonomía en el proceso de aprendizaje a través de cuestionarios y pruebas  para identificar las estrategias empíricas utilizadas en este y sus factores (des)uso con el fin de crear un espacio de reforzamiento o enseñanza de las mismas. \r\n'),
(56, 'Uso de los recursos didácticos para la enseñanza-aprendizaje de una segunda lengua en escuelas públicas.', '2017-09-30', NULL, 'El problema central de esta investigación es analizar el uso de los recursos didácticos como elemento que coadyuva la enseñanza-aprendizaje de una segunda lengua.', 1, 11, 0, 0, 0, '00:00:00', 3, 'es', 'Con el desarrollo de este proyecto de investigación se pretende demostrar, si existe relación entre el uso que se la da a los materiales didácticos y el desempeño lingüístico de los estudiantes de los centros educativos del sector público en el distrito escolar No.5 ', 'La presente investigación se realizará bajo un diseño no experimental de corte transversal y de tipo correlacional. '),
(57, 'Uso de los recursos didácticos para la enseñanza-aprendizaje de una segunda lengua en escuelas públicas.', '2017-09-30', '91_es_2017-09-30_09-16-23_resumen-de-investigacinin-para-ceat.docx', 'El problema central de esta investigación es analizar el uso de los recursos didácticos como elemento que coadyuva la enseñanza-aprendizaje de una segunda lengua.', 1, 11, 0, 0, 0, '00:00:00', 3, 'es', 'Con el desarrollo de este proyecto de investigación se pretende demostrar, si existe relación entre el uso que se la da a los materiales didácticos y el desempeño lingüístico de los estudiantes de los centros educativos del sector público en el distrito escolar No.5 ', 'La presente investigación se realizará bajo un diseño no experimental de corte transversal y de tipo correlacional. '),
(58, 'Corrupción-Homicidios y su relación con la inversión extranjera directa en Honduras durante el periodo 2005-2015.', '2017-09-30', '87_es_2017-09-30_09-25-31_corrupcinin-homicidios-y-su-relacinin-con-la-inversinin-extranjera-directa-en-honduras-durante-el-periodo-2005-2015..docx', 'El documento de investigación pretende determinar si la corrupción y los homicidios influyen sobre los flujos inversión extranjera directa de Honduras. Los datos fueron recolectados de fuentes secundarias como el banco Central de Honduras (BCH), International Transparency, Instituto Universitario en Democracia Paz y Seguridad (IUDPAS), entre otros. Es un estudio no experimental de corte longitudinal donde mediante un modelo econométrico se mide el tipo de relación de las variables. Los resultados señalan que la corrupción influye positivamente sobre el nivel de inversión extranjera Directa y los Homicidios influyen negativamente sobre la inversión extranjera directa en Honduras en el periodo 2005-2015.', 1, 7, 0, 0, 0, '00:00:00', 3, 'es', 'Inversión extranjera directa, corrupción, homicidios.', 'La investigación pretende determinar si la corrupción y los homicidios influyen sobre la inversión extranjera directa de Honduras. Los datos fueron recolectados de fuentes secundarias. El estudio es no experimental de corte longitudinal. Utilizando un modelo econométrico los resultados señalan que la corrupción influye positivamente sobre el nivel de inversión.'),
(59, 'Factores Asociados A Las Dificultades Fonéticas Y Fonológicas En Los Estudiantes De La Carrera De Lenguas Extranjeras De La UNAH', '2017-09-30', '103_es_2017-09-30_10-34-07_trabajo-junto.docx', '', 1, 0, 0, 0, 0, '00:00:00', 5, 'es', 'Idiomas,Produccion,entendimineto', 'El presente informe resulta de un estudio empírico de la precisión de la expresión oral de los estudiantes de inglés de la Carrera de Lenguas Extranjeras de Ciudad Universitaria. El estudio es no-experimental de corte transversal descriptivo. Se utilizarán  técnicas estadísticas para identificar los factores fonológicos y fonéticos que afectan en el aprendizaje del idioma inglés. Con tales resultados se espera crear un manual de apoyo para los maestros y estudiantes que pueda contribuir en el mejoramiento de la expresión oral de los estudiantes. '),
(60, 'Precios y Cantidades del Comercio Exterior\r\nHonduras 1990-2015.\r\n', '2017-09-30', '87_es_2017-09-30_10-48-13_precios-y-cantidades-del-comercio-exterior-ceat.docx', 'Honduras tiene bajos niveles de  participación en el mercado internacional lo que resulta en una alta dependencia de los precios fijados exteriormente. Se realizó la siguiente investigación tipo exploratorio, no experimental de corte longitudinal; para escudriñar como la región centroamericana y principalmente Honduras se vuelven tomadores de precios. Se espera que el lector obtenga un panorama general de la importancia de los precios internacionales, las brechas existentes de las exportaciones respecto a las importaciones en volumen e índice de precios, así como de los principales productos de exportación e importación de Centroamérica.', 1, 2, 0, 0, 0, '00:00:00', 3, 'es', 'Comercio Internacional, tomadores de precios, precios internacionales.', 'Honduras es un país tomador de precios por sus bajos niveles de participación en el mercado internacional. Esta investigación es de tipo exploratorio, no experimental de corte longitudinal. Se espera conocer la importancia de las exportaciones e importaciones hondureñas y como los precios internacionales afectan la economía del país.'),
(61, 'Empoderamiento de la mujer: en los procesos de negociación y comercialización en el Distrito Central, Francisco Morazán para el primer semestre del año 2017. (INAM).', '2017-10-01', '110_es_2017-10-01_09-35-57_resumen-abreviado-empoderamiento.docx', 'Medir el nivel de empoderamiento con el que cuenta la mujer en los procesos de negociación y comercialización en el Distrito Central, Francisco Morazán para el primer semestre del año 2017.\r\nEl estudio es no experimental, descriptiva y de corte transversal; la técnica de muestreo será probabilístico por área.\r\nSe pretende conocer el nivel de empoderamiento que tiene la mujer en los procesos de negociación y comercialización; y si se cumplen las leyes de igualdad de oportunidades para la mujer. ', 1, 1, 0, 0, 0, '14:00:00', 3, 'es', 'Empoderamiento, negociaciones, comercialización.   ', 'Nace la necesidad de conocer el nivel de empoderamiento que tiene la mujer en los procesos de negociación y comercialización dentro del Distrito Central; y si se cumplen las leyes de igualdad de oportunidades en el mismo para la mujer.'),
(62, 'Expectativas laborales de los estudiantes por egresar de la Carrera de Lenguas Extranjeras de la UNAH del año 2017', '2017-10-01', '114_es_2017-10-01_12-07-33_expectativas-laborales-de-los-estudiantes-por-egresar-de-la-cle-unah-del-2017.docx', 'El documento presente busca realizar un análisis de la coherencia entre las expectativas laborales y el perfil de egresado de los estudiantes por egresar de la carrera de Lenguas Extranjeras de la UNAH. Los datos serán recolectados a partir de cuestionarios aplicados a dichos estudiantes. El estudio es no-experimental de corte transversal y de tipo descriptivo. Los datos serán presentados a través de medidas de tendencia central. Esperamos que los resultados muestren las posibles incongruencias existentes entre las expectativas de los estudiantes y los empleos posibles a los que estos pueden optar.', 1, 1, 0, 0, 0, '00:00:10', 3, 'es', 'empleabilidad, expectativas, universitarios', 'Se busca analizar la coherencia entre las expectativas laborales y el perfil de egresado de los estudiantes por egresar de la carrera de Lenguas Extranjeras de la UNAH. Esperamos que los resultados muestren posibles incongruencias entre las expectativas de los estudiantes y los empleos a los que pueden optar.'),
(64, '“Factores que inciden en el aprendizaje de una lengua extranjera en estudiantes de Ingles General de la UNAH”', '2017-10-01', '116_es_2017-10-01_12-34-44_resumen-para-el-congreso-ceat.docx', 'Se presenta una investigación   respecto a los principales factores relacionados con el aprendizaje de una lengua extranjera en los estudiantes de inglés de la UNAH. Los datos se obtuvieron por medio de cuestionarios aplicados a una muestra de estudiantes de la clase de inglés. El estudio se realizó con un diseño no-experimental de corte transversal y de tipo descriptivo. Los resultados coinciden con otros estudios en que se ha encontrado que los factores económicos, sociales, académicos, entre otros; son los principales obstáculos que impiden el desarrollo de las competencias lingüísticas del idioma inglés.  ', 1, 11, 0, 0, 0, '00:00:00', 3, 'es', 'Aprendizaje,  lengua, competencias  ', 'Se presenta una investigación   respecto a los principales factores relacionados con el aprendizaje de una lengua extranjera en los estudiantes de inglés de la UNAH. Los datos se obtuvieron por medio de cuestionarios aplicados a una muestra de estudiantes de la clase de inglés. El estudio se realizó con un diseño no-experimental de corte transversal y de tipo descriptivo. '),
(65, 'Mujeres, Sociedad y Crímenes “Impacto socio-económico de los feminicidos en Tegucigalpa, Honduras', '2017-10-01', '115_es_2017-10-01_12-40-58_morales-pamela-u4t2a1.doc.docx', 'La presente investigación surge del alarmante aumento de femicidios en Tegucigalpa en los últimos años, cuyo propósito fue conocer el impacto socio-económico de estos crímenes en la sociedad. El estudio se inserta dentro de la investigación de campo de carácter descriptivo y explicativo. Los resultados muestran que mujeres en edad activa laboralmente sufren cualquier tipo de violencia, de las cuales un 19% sufren de violencia física, esto muestra que el asesinato por parte del conyugue a su compañera de hogar genera la pérdida de un pilar que sostiene económicamente una familia entera.', 1, 8, 0, 0, 0, '14:00:00', 3, '0', 'Mujeres, Socio-económico, Crímenes', 'La presente investigación surge del alarmante aumento de femicidios en Tegucigalpa en los últimos años. El estudio se inserta dentro de la investigación de campo de carácter descriptivo y explicativo. Los resultados muestran que el asesinato de una mujer genera la pérdida de un pilar que sostiene económicamente una familia.'),
(66, 'Influencia de las redes sociales (dislike life)', '2017-10-01', '121_es_2017-10-01_01-16-06_resumen-abreviado.docx', '', 1, 8, 0, 0, 0, '10:00:00', 3, 'es', 'Redes sociales, autoestima, like. ', ''),
(67, 'Estrategias de enseñanza de una lengua extranjera a niños con Trastornos de Déficit de Atención e Hiperactividad', '2017-10-01', '124_es_2017-10-01_02-06-12_tesis-planteamiento-del-problema-de-investigacion.docx', 'Esta investigación es sobre la problemática que enfrentan los niños con trastorno de déficit de atención e hiperactividad al momento de aprender una lengua extranjera y el desconocimiento de los maestros sobre este trastorno y como atender a los niños que o sufren. El estudio es no experimental de corte transversal con un alcance descriptivo. Con esta investigación se espera poder brindar a los maestros estrategias de enseñanza de lenguas extranjeras a niños con trastorno de déficit de atención e hiperactividad y al fortalecimiento de la enseñanza de lenguas en Honduras.', 1, 11, 0, 0, 0, '00:00:00', 3, 'es', 'Informar, Ayudar, Estrategias', 'La siguiente investigación tratará de informar a los maestros que desconocen sobre el trastorno de déficit de atención e hiperactividad y al mismo tiempo ayudar a los niños que padecen este trastorno. Lo que se espera lograr es encontrar estrategias que faciliten el aprendizaje a los niños con TDAH'),
(68, 'Estrategias de enseñanza a niños con trastorno de déficit de atención e hiperactividad', '2017-10-01', '130_es_2017-10-01_02-33-19_resumen-de-investigacion-estrategias-de-ensen-anza-de-una-lengua-extranjera-a-nin-os-con-tdah.docx', 'Esta investigación es sobre la problemática que enfrentan los niños con Trastorno de Déficit de Atención e Hiperactividad al momento de aprender una lengua extranjera y el desconocimiento de los maestros sobre este trastorno y como atender a los niños que o sufren. El estudio es no experimental de corte transversal con un alcance descriptivo. Con esta investigación se espera poder brindar a los maestros estrategias de enseñanza de lenguas extranjeras a niños con Trastorno de Déficit de Atención e Hiperactividad y al fortalecimiento de la enseñanza de lenguas en Honduras.', 1, 11, 0, 0, 0, '00:00:00', 3, 'es', 'Ayudar, Enseñar, Estrategias', 'La siguiente investigación tratará de informar a los maestros que desconocen sobre el déficit de atención e hiperactividad. Se espera proporcionar estrategias que faciliten el aprendizaje de una lengua extranjera a niños con TDAH'),
(69, 'Percepciones de las Lenguas Extranjeras en Estudiantes Universitarios.', '2017-10-01', '125_es_2017-10-01_02-39-09_resumen-tesis-ceat.docx', 'Debido a que actualmente las lenguas extrajeras juegan un rol muy importante dentro de nuestra sociedad y son una de las competencias profesionales de mayor demanda, los estudiantes de la UNAH de CU buscan aprender inglés y otros idiomas. Por lo tanto, el presente estudio propone recolectar datos usando el método cuantitativo para dar a conocer cuáles son las percepciones que tienen los estudiantes de distintas carreras ante el aprendizaje de una nueva lengua. Así mismo, lograr identificar los idiomas de mayor relevancia para ellos y cuál es la metodología que utilizan para aprenderlo. ', 1, 14, 0, 0, 0, '00:00:00', 3, 'es', 'Lenguas extranjeras, percepciones,relevancia, metodología', 'Se pretende hacer un estudio basándose en que motivan a los estudiantes a aprender un nuevo idioma que factores influyen lograr identificar los idiomas de mayor relevancia para ellos y cuál es la metodología o técnicas que usan para aprenderlo y si están interesados en más lenguas.'),
(70, '  “Sector Cafetalero de Honduras: Dificultades de producción”.\r\n', '2017-10-01', '131_es_2017-10-01_03-04-19_resumen-de-investigacinin-cafe.docx', 'planteamiento del problema ', 1, 11, 0, 0, 0, '14:00:00', 3, 'es', 'financiamiento,tecnología,infraestructura.', 'La investigación es resultado de un proceso empírico donde se analiza las dificultades a las que éste se enfrenta, tales como la obtención de financiamiento, herramientas tecnológicas e infraestructura para la producción del café. '),
(72, 'Maslach Burnout Inventory (MBI) caso: Hospital de Especialidad Psiquiátrico Santa Rosita, Honduras 2017', '2017-10-01', '53_es_2017-10-01_03-36-25_vivian.docx', 'Trabajar con personas mentalmente desequilibradas exige ciertas aptitudes por parte del personal, el síndrome provoca en las personas una dificultad para lidiar con las emociones de sus pacientes lo que los lleva a tratarlos de forma impersonal y deshumanizada lo que trae consigo nefastas consecuencias. A través de una investigación cuantitativa, transversal con particularidades descriptivas se procederá a aplicar un instrumento que deja en manifiesto la existencia del mismo. \r\nEstablecer prevalencia del síndrome, comparar la salud emocional entre los empleados según su cargo y determinar el porcentaje de los interesados en recibir tratamiento son los principales hallazgos de esta investigación.', 1, 10, 0, 0, 0, '08:00:00', 3, '0', 'MBI, Honduras, Burnout', 'Prevalencia del MIB en el Hospital de Especialidad Psiquiátrico Santa Rosita, Honduras 2017'),
(73, 'Procesos Claves en la Gestión de Propiedades Verticales', '2017-10-01', '137_es_2017-10-01_04-27-25_resumen-extendido-30-09.docx', 'La presente tesis plantea inquietudes acerca de la mejor manera en que se debe de administrar una propiedad vertical o un edificio de apartamentos, las principales ciudades del país están experimentando un aumento en la construcción de estas propiedades, debido a la falta de propiedad que esté circuncidante a las zonas dentro de dichas ciudades.  La legislación hondureña no específica la forma en que las distintas variables que afectan la operatividad de una propiedad vertical puede afectar el funcionamiento de las mismas, por ende no hay una uniformidad en la gestión de los edificios, dando lugar a que se apliquen criterios que no siempre son de beneficio para la propiedad como tal y más importante: para sus habitantes. ', 1, 4, 0, 0, 0, '11:00:00', 2, 'es', 'Propiedades Verticales, administración de propiedades verticales, edificio de apartamentos, administración de edificios de apartamentos', 'La presente tesis plantea inquietudes acerca de la mejor manera en que se debe de administrar una propiedad vertical o un edificio de apartamentos, las principales ciudades del país están experimentando un aumento en la construcción de estas propiedades, debido a la falta de propiedad que esté circuncidante a las zonas dentro de dichas ciudades'),
(74, 'PEQUEÑA Y MEDIANA EMPRESA: FACTORES ADMINISTRATIVOS CLAVES EN PROCESO DE EXPANSIÓN', '2017-10-01', '139_es_2017-10-01_04-41-46_resumen-extendido-expansininrevisado.docx', 'La presente investigación está diseñada para que los administradores de las pequeñas y medianas empresas utilicen como una referencia para identificar, y poner en práctica algunos de los procesos que aún no desarrollan en el manejo de sus operaciones administrativas, por medio de una planeación estratégica adecuada y realista', 1, 4, 0, 0, 0, '00:00:00', 2, 'es', 'PYME, Administración, Expansión, Procesos', 'La presente investigación está diseñada para que los administradores de las pequeñas y medianas empresas utilicen como una referencia para identificar, y poner en práctica algunos de los procesos que aún no desarrollan en el manejo de sus operaciones administrativas, por medio de una planeación estratégica adecuada y realista'),
(76, '', '2017-10-01', '142_es_2017-10-01_05-02-06_aplicabilidad-pg-programa-de-apoyo-a-las-mipymes.docx', '', 1, 0, 0, 0, 0, '00:00:00', 0, '0', '', ''),
(77, 'medición de servicio al cliente', '2017-10-01', '146_es_2017-10-01_05-51-49_resumen-extendido-servicio-al-cliente.docx', 'Articulo que nos habla sobre herramientas de medición de la gestión de servicio al cliente, sus ventajas y beneficios dentro de la organizacion', 1, 1, 0, 0, 0, '11:00:00', 2, 'es', 'Medición, Calidad, Servicio al Cliente', 'Este trabajo tiene como objetivo evaluar la medición de la calidad del servicio al cliente de las empresas comercializadoras y definir qué áreas de las empresas son las que ocupan un mayor reforzamiento a nuestro criterio según los datos recopilados'),
(79, 'Programa de Apoyo para la administracion financiera de las MIPYMES ', '2017-10-01', '142_es_2017-10-01_06-14-46_aplicabilidad-pg-programa-de-apoyo-a-las-mipymes-1-.docx', '', 1, 11, 0, 0, 0, '09:00:00', 2, 'es', 'Administración Financiera, Financiamiento, Mipymes', 'El principal propósito de este proyecto es investigar los diferentes programas de apoyo para la administración financiera de las MIPYMES a nivel general por parte del sector gobierno y empresarial.  Este estudio permitirá determinar la evolución de los programas de apoyo y las principales herramientas orientadas a promover el financiamiento.'),
(80, 'Factores que influyen en la competitividad de los estudiantes de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH)', '2017-10-01', '__2017-10-01_06-20-32_resumen-abreviado-eva.docx', 'El presente documento resulta de un estudio descriptivo con el propósito de identificar los factores que influyen en la competividad de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH), en relación a la competividad en el campo laboral.  \r\nEl estudio de la  investigación es no experimental con diseño transeccional de tipo descriptivo ya que el periodo de investigación se realizará únicamente en el segundo periodo académico del 2017.\r\n', 1, 11, 0, 0, 0, '08:00:00', 3, 'es', 'Competitividad, Tecnología y Inglés', 'El presente documento resulta de un estudio descriptivo con el propósito de identificar los factores que influyen en la competividad de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH), en relación a la competividad en el campo laboral.  \r\nEl estudio de la  investigación es no experimental con diseño transeccional de tipo descriptivo ya que el periodo de investigación se realizará únicamente en el segundo periodo académico del 2017.'),
(81, '', '2017-10-01', NULL, '', 1, 0, 0, 0, 0, '00:00:00', 0, '0', '', ''),
(82, 'Factores que influyen en la competitividad de los estudiantes de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH)', '2017-10-01', '148_es_2017-10-01_06-27-00_resumen-abreviado-eva.docx', 'El presente documento resulta de un estudio descriptivo con el propósito de identificar los factores que influyen en la competividad de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH), en relación a la competividad en el campo laboral.  \r\nEl estudio de la  investigación es no experimental con diseño transeccional de tipo descriptivo ya que el periodo de investigación se realizará únicamente en el segundo periodo académico del 2017', 1, 11, 0, 0, 0, '08:00:00', 3, 'es', 'Competitividad, Tecnología y Inglés', 'El presente documento resulta de un estudio descriptivo con el propósito de identificar los factores que influyen en la competividad de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH), en relación a la competividad en el campo laboral.  \r\nEl estudio de la  investigación es no experimental con diseño transeccional de tipo descriptivo ya que el periodo de investigación se realizará únicamente en el segundo periodo académico del 2017'),
(83, 'Factores que influyen en la competitividad de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH)', '2017-10-01', '148_es_2017-10-01_06-36-44_competitividad-alumnos-mkt.docx', 'El presente documento resulta de un estudio descriptivo con el propósito de identificar los factores que influyen en la competividad de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH), en relación a la competividad en el campo laboral.  \r\nEl estudio de la  investigación es no experimental con diseño transeccional de tipo descriptivo ya que el periodo de investigación se realizará únicamente en el segundo periodo académico del 2017.\r\n', 1, 11, 0, 0, 0, '08:00:00', 3, 'es', 'Competitividad, Tecnología y Inglés', 'El presente documento resulta de un estudio descriptivo con el propósito de identificar los factores que influyen en la competividad de la carrera de Mercadotecnia en la Universidad Nacional Autónoma de Honduras (UNAH), en relación a la competividad en el campo laboral.  \r\nEl estudio de la  investigación es no experimental con diseño transeccional de tipo descriptivo ya que el periodo de investigación se realizará únicamente en el segundo periodo académico del 2017.\r\n'),
(84, 'Factores Influyentes en el Aprendizaje del Ingles en Escuelas Publicas de Tegucigalpa', '2017-10-01', '101_es_2017-10-01_06-43-00_resumen-abreviado.docx', 'El presente documento demuestra un estudio detallado de los factores individuales, académicos e institucionales que influyen decisivamente al aprendizaje del idioma inglés por parte de los estudiantes de escuelas públicas en Tegucigalpa. El estudio es de tipo correlacional. Se utilizan técnicas investigativas como observaciones, encuestas y tests para indagar en el nivel de inglés de los estudiantes, metodologías docentes y el cumplimiento de aspectos institucionales. Los resultados esperados son que los alumnos tengan un bajo nivel lingüístico, que los docentes no cuentan con las herramientas didácticas necesarias y que las autoridades instituciones no apoyen la enseñanza de calidad del idioma.    ', 1, 8, 0, 0, 0, '16:00:00', 3, 'es', 'enseñanza, aprendizaje, ingles.', 'Actualmente los estudiantes de centros educativos públicos no demuestran competencias lingüísticas  que permitan la comunicación del idioma ingles en un nivel avanzado, por tanto los factores individuales, académicos e institucionales son considerados influyentes en el proceso de enseñanza-aprendizaje aunque la Ley Fundamental de Educacion establezca su obligatoriedad desde kínder.'),
(85, 'El uso de las TIC en la enseñanza del inglés en la carrera de Lenguas Extranjeras de la UNAH en el 2017', '2017-10-01', '__2017-10-01_07-05-03_resumen.docx', 'Esta investigación se centra en conocer si los maestros en la enseñanza del inglés usan correctamente las TIC para incrementar el nivel de lengua de sus estudiantes.  La investigación es no experimental y de corte transversal. Además, descriptiva por el uso de cuestionarios que serán aplicados a 10 estudiantes de una sección en cada clase para obtener un resultado congruente. Los resultados esperados se basan en que tanto influyen las tecnologías en el nivel de lengua de los estudiantes, recomendaciones a los maestros para el mejoramiento de las TIC y sugerir aplicaciones que promuevan el rendimiento del nivel de lengua.', 1, 11, 0, 0, 0, '09:00:00', 3, 'es', 'enseñanza,  tecnología, inglés', 'La presente investigación indaga sobre el uso de las TIC en la carrera de Lenguas Extranjeras. La investigación es cuantitativa de tipo descriptiva con una población de 10 estudiantes entre 17 a 40 años de cada clase. Esperando aumentar el nivel de inglés con el uso apropiado de las TIC.  '),
(86, 'Aplicación de metodologías para la enseñanza del inglés en la Carrera de Lenguas Extranjeras en los dos centros universitarios públicos de Tegucigalpa, UNAH y UPNFM ', '2017-10-01', '120_es_2017-10-01_07-17-07_ceat-2017-kathy-stalin-diana-cenia-resumen.docx', 'El siguiente documento busca analizar el rendimiento, estructura y nivel de actualización de la pedagogía de la enseñanza inglesa impartida en los centros universitarios públicos: UNAH Y UPNFM. La información se recolectará a partir de encuestas a estudiantes y docentes de dichas universidades. \r\n\r\nEl estudio es no experimental de corte transversal. Se utilizarán técnicas estadísticas para analizar críticamente el grado de las metodologías, enfoques, estrategias y recursos didácticos utilizados.\r\n\r\nSe espera identificar si la estructura de la enseñanza corresponde a los estándares de la certificación internacional, para que ambas universidades ajusten los currículos actuales y mejoren el perfil del egresado.\r\n', 1, 2, 0, 0, 0, '14:00:00', 3, 'es', 'Educación, Pedagogía, Enfoque', 'El siguiente documento tiene como finalidad el analizar el rendimiento, estructura y nivel de actualización de la pedagogía de la enseñanza inglesa impartida en los centros universitarios públicos: UNAH Y UPNFM, desde un punto de vista crítico hacia el grado de las metodologías, enfoques, estrategias y recursos didácticos utilizados.'),
(87, 'El uso de las TIC en la enseñanza del inglés en la carrera de Lenguas Extranjeras de la UNAH en el 2017', '2017-10-01', '134_es_2017-10-01_07-28-14_resumen.docx', 'Esta investigación se centra en conocer si los maestros en la enseñanza del inglés usan correctamente las TIC para incrementar el nivel de lengua de sus estudiantes.  La investigación es no experimental y de corte transversal. Además, descriptiva por el uso de cuestionarios que serán aplicados a 10 estudiantes de una sección en cada clase para obtener un resultado congruente. Los resultados esperados se basan en que tanto influyen las tecnologías en el nivel de lengua de los estudiantes, recomendaciones a los maestros para el mejoramiento de las TIC y sugerir aplicaciones que promuevan el rendimiento del nivel de lengua.', 1, 11, 0, 0, 0, '09:00:00', 3, 'es', 'enseñanza, tecnología, inglés', 'La presente investigación indaga sobre el uso de las TIC en la carrera de Lenguas Extranjeras. La investigación es cuantitativa de tipo descriptiva con una población de 10 estudiantes entre 17 a 40 años de cada clase. Esperando aumentar el nivel de inglés con el uso apropiado de las TIC.'),
(89, 'La efectividad de la publicidad en aplicaciones de música de streaming', '2017-10-01', '160_es_2017-10-01_07-49-41_la-efectividad-de-la-publicidad-en-aplicaciones-de-mn-sica-de-streaming-resumen.docx', 'El presente documento resulta de un estudio de la efectividad de la publicidad en aplicaciones de música de streaming en jóvenes de 18 a 27 años. Los datos fueron obtenidos a través de encuestas a una muestra de personas en UNAH. El estudio es cuantitativo descriptivo. Elementos como el tiempo, factores personales y la economía son causas por las cuales la publicidad en apps de música de streaming seria eficaz. Se espera conocer cuál es el tiempo idóneo para publicarse, así como determinar cuáles factores personales y económicos influyen en la aceptación de publicidad en aplicaciones de música de streaming.', 1, 5, 0, 0, 0, '08:00:00', 3, 'es', 'Publicidad, aplicaciones, streaming. ', 'El presente documento resulta de un estudio de la efectividad de la publicidad en aplicaciones de música de streaming en jóvenes de 18 a 27 años. Los datos fueron obtenidos a través de encuestas a una muestra de personas en UNAH. El estudio es cuantitativo descriptivo. Elementos como el tiempo, factores personales y la economía son causas por las cuales la publicidad en apps de música de streaming seria eficaz. Se espera conocer cuál es el tiempo idóneo para publicarse, así como determinar cuáles factores personales y económicos influyen en la aceptación de publicidad en aplicaciones de música de streaming.'),
(90, 'EFECTO DE LOS INFLUENCERS EN LOS MILENNIALS EN LAS REDES SOCIALES', '2017-10-01', '152_es_2017-10-03_07-36-39_resumen-abreviado.docx', '', 1, 5, 0, 0, 0, '08:00:00', 3, 'es', 'influencers,modas,tendencias,millennials ', ''),
(91, 'Percepción de la Enseñanza de Lenguas Extranjeras en la Educación ´Pública Primaria\r\n', '2017-10-01', NULL, 'La presente investigación se enmarca en el bajo nivel de lengua extranjera que reflejan los estudiantes egresados de las escuelas públicas en Honduras, a través de un test de nivel de lengua y una encuesta aplicada en dos escuelas públicas de la capital del país. Los datos serán presentados mediante medidas de tendencias centrales (Análisis de correlación de Personas) para medir el nivel de lengua extranjera de los (as) estudiantes de primaria. Con esta investigación intentamos conocer las dificultades que tienen los niños de las escuelas y dar soluciones al porqué de su bajo nivel de lengua extranjera.', 1, 14, 0, 0, 0, '10:00:00', 3, 'es', 'Investigación, Escuelas, Lengua', 'Esta investigación estudia el bajo nivel de lengua extranjera de los estudiantes egresados de escuelas públicas en Honduras. Los datos recolectados en un test de nivel lingüístico y una encuesta aplicada a dos escuelas de Tegucigalpa, mediante análisis correlacional de personas buscan conocer las dificultades a tal problemática y solucionarlas.'),
(92, 'Factores Que Intervienen En La Formación De Los Valores Morales En Los Estudiantes De La UNAH. ', '2017-10-01', '153_es_2017-10-03_07-17-25_resumen-abreviado.docx', '', 1, 8, 0, 0, 0, '08:00:00', 3, 'es', 'Valores, Educación, Familia, Estudiantes', '');
INSERT INTO `tbl_trabajo` (`id_trabajo_pk`, `titulo_trabajo`, `fecha_subida`, `ubicacion_archivo`, `resumen`, `id_estado_fk`, `id_tematica_fk`, `id_citacion_fk`, `premio`, `revista`, `horario_sugerido`, `id_tipo_trabajo_fk`, `id_idioma_fk`, `palabrasclave`, `resumenprograma`) VALUES
(93, 'Factores que influyen en la repitencia de la clase de métodos cuantitativos I', '2017-10-01', '171_es_2017-10-03_07-26-54_resumen-abreviado.docx', 'Lograr identificar metodologías del docente\r\nanalizar técnicas de estudio y evaluar el conocimiento previo del estudiante', 1, 16, 0, 0, 0, '07:00:00', 3, 'es', 'repitencia,metodología, técnicas', 'Esta investigación busca posibles soluciones ante la problemática que presentan los estudiantes universitarios sobre la repitencia de la clase de métodos cuantitativos I, lograr identificar metodologías más eficaces de enseñanza por parte del docente, evaluar técnicas de estudio empleadas por el estudiante y analizar la base de conocimientos previos. '),
(95, 'Hábitos alimenticios y su efecto en el rendimiento físico de los estudiantes de primer año de la carrera de Mercadotecnia.', '2017-10-01', '174_es_2017-10-01_08-50-20_resumen-abreviado.docx', 'El presente documento brinda un estudio de mercado descriptivo con el cual se espera determinar cuáles son los principales hábitos alimenticios de los estudiantes, y su efecto en el rendimiento físico de los mismos. Los datos fueron recolectados mediante una encuesta en forma de cuestionario escrito. Es un estudio no experimental con un enfoque cuantitativo para probar hipótesis con base en medición numérica. Los resultados esperados son: determinar la relación entre peso corporal y hábitos alimenticios, definir cómo influye el factor económico en la alimentación e identificar el efecto de la alimentación de los estudiantes en su rendimiento físico.', 1, 10, 0, 0, 0, '09:00:00', 3, 'es', 'Horarios de comida, alimentación sana, rendimiento físico', 'Esta investigación busca concientizar a los estudiantes, de primer año de Mercadotecnia, en llevar una alimentación sana y rica en nutrientes para que así no sufran de cansancio, estrés, enfermedades crónicas, trastornos alimenticios y así puedan llevar una vida más sana y feliz durante sus años universitarios. '),
(96, ' Factores que afectan las competencias lingüísticas en el aprendizaje del inglés en la carrera de lenguas extranjeras en la UNAH en el segundo periodo académico del año 2017', '2017-10-01', NULL, '\r\nLa presente investigación surge del interés por conocer los factores que afectan las competencias lingüísticas en el aprendizaje del inglés en la carrera de lenguas extranjeras en la UNAH en el segundo periodo académico del año 2017. Los datos serán recolectados a través de un cuestionario y una prueba que serán aplicados a estudiantes de dicha carrera.\r\nEl estudio en no experimental de corte transversal. El mismo será presentado a través de medidas de tendencia central y análisis de correlación de personas.\r\nSe espera conocer los diferentes factores que afectan al rendimiento de las competencias lingüísticas de los estudiantes.\r\n', 1, 14, 0, 0, 0, '13:00:00', 3, 'es', 'competencias lingüísticas, factores, rendimiento ', 'El objetivo de la investigación es conocer los factores que afectan las Competencias Lingüísticas en el aprendizaje del inglés en la CLE en la UNAH en el 2017. El estudio en no experimental de corte transversal. Se espera conocer los factores asociados al rendimiento de las CL en la CLE.'),
(97, 'FACTORES MOTIVACIONALES QUE INCITAN AL TURISTA A VIAJAR A SANTA LUCÍA EN EL AÑO 2017', '2017-10-01', '164_es_2017-10-01_09-27-39_resumen-abreviado.docx', 'Se prende realizar esta investigación para estudiar las causas que motivan a los turistas a visitar Santa Lucia; y en qué aspectos favorece esto al municipio. Para  el análisis de  los factores motivacionales del presente trabajo  se  pretende darle un enfoque de investigación cuantitativo ya que  se  realizaran mediciones de carácter numérico. Además, se abordara bajo un diseño no experimental de corte transversal debido a que se llevara a cabo un levantamiento de encuestas mediante un alcance descriptivo, se espera conocer mediante datos precisos el nivel de satisfacción de los visitantes con respecto a la oferta turística de Santa Lucia.  ', 1, 7, 0, 0, 0, '14:15:00', 3, 'es', 'Turismo, Ingreso, Necesidades', 'El turismo, es tomado como un referente de la satisfacción de las necesidades pero también es vinculado con lo económico. Por ello en esta investigación se pretende analizar los factores motivacionales de los turistas para visitar Santa Lucia a través de levantamiento de encuestas.'),
(98, 'Comportamiento de los Jóvenes en edades comprendidas entre 18 a 30 años en relación a los Memes utilizados como una herramienta de comunicación en Facebook', '2017-10-01', '192_es_2017-10-01_09-46-10_resumen-abreviado-1-.docx', 'Con el propósito de analizar el comportamiento de los jóvenes en edades comprendidas entre 18 a 30 años en relación a la comunicación a través de “Memes” en Facebook se realizara una investigación cuantitativa, en Distrito Central, Ciudad Universitaria en el II periodo académico 2017. El tipo de estudio a utilizar es la investigación no experimental. Precisado el planteamiento del problema se definió un alcance de investigación descriptivo. Los resultados esperados al finalizar la investigación es conocer y determinar la influencia y utilidad que le dan los jóvenes a los “Memes” y la  frecuencia de uso.', 1, 5, 0, 0, 0, '10:00:00', 3, 'es', 'Memes, Frecuencia de Uso, Utilidad. ', 'En la actualidad los “Memes” en Facebook son tendencia al momento de ser utilizados frecuentemente por los Millenials. La utilidad que le dan los jóvenes al compartir este tipo de contenido puede ser por diversos factores como ser: Burla, Diversión, Comunicación y Distracción. '),
(99, 'Estudio técnico de la Matriz Insumo Producto para Honduras', '2017-10-01', '113_es_2017-10-01_09-49-24_resumen-abreviado-mip.docx', 'El presente documento resulta de un análisis teórico-práctico del modelo de Matriz Insumo Producto (MIP), en el cual se evalúan las interrelaciones e interdependencias sectoriales en la economía. Los datos fueron recolectados de la MIP del Banco Central de Honduras para el año de 2013. El estudio se caracteriza por ser de carácter técnico, utilizándose un modelo teórico-práctico para demostrar que la MIP requiere de un equilibrio estático sectorial en el cual se satisfacen las condiciones tecnológicas de producción. Los cálculos señalan que los cambios en los niveles de demanda final afectan la producción de insumos de cada sector. ', 1, 7, 0, 0, 0, '16:00:00', 3, 'es', 'Producción,interrelaciones,interdependencias', 'El presente documento resulta de un análisis teórico-práctico del modelo de Matriz Insumo Producto (MIP), en el cual se evalúan las interrelaciones e interdependencias sectoriales en la economía. El estudio es de carácter técnico, señalándose que los cambios en la demanda final afectan la producción de insumos de cada sector. '),
(100, 'DETERMINANTES DE LA INSERCIÓN DE LA MUJER EN EL SECTOR SERVICIOS DE LA ECONOMÍA HONDUREÑA (2000 - 2016)', '2017-10-01', '191_es_2017-10-01_09-51-49_resumen-para-el-ceats.docx', 'La incorporación de la mujer al mercado laboral ha sido un proceso paulatino, en los últimos años existen avances en la inclusión de la mujer sin embargo siguen existiendo obstáculos para conseguir una participación plena y equitativa en todos los sectores de la economia. La inclusión de género es un tema relevante  para  la economía, ya que una mayor inclusión potencia los niveles de producción. La metodología de la investigación es no experimental con alcance correlacional, además se utilizaron cuadros de sectores económicos por género y la Encuesta Permanente de Hogares del Instituto Nacional de Estadística (INE). ', 1, 1, 0, 0, 0, '08:00:00', 3, 'es', 'Insercion l, femenino, determinantes', 'La incorporación de la mujer al mercado laboral en los últimos años ha avanzado, sin embargo siguen existiendo obstáculos para conseguir una participación plena y equitativa en todos los sectores de la economía. La inclusión de género es un tema relevante  para  la economía, ya que una mayor inclusión potencia los niveles de producción'),
(101, 'Evolución de la matriz energética en Honduras 2007-2016.\r\n', '2017-10-01', '87_es_2017-10-01_10-04-37_evolucinin-de-la-matriz-energn-tica-en-honduras-2007-ceat.docx', 'Toda actividad requiere de energía para su realización, incluyendo la producción de bienes y servicios. El uso de energía no renovable para cualquier actividad humana provoca agotamiento de las fuentes energéticas y cambio perjudiciales en el medio ambiente. Esta investigación es de tipo exploratorio, no experimental de corte longitudinal, pretende mostrar la evolución, usos e intensidad energética de Honduras y Centroamérica, la tasa de renovabilidad de la energía, estructura de consumo y otros aspectos del panorama energético del país, de esa forma comprender el papel  de la generación energética en el desarrollo económico y la sostenibilidad ambiental.', 1, 2, 0, 0, 0, '15:00:00', 3, 'es', '(Energía, Medio ambiente, Matriz energética)', 'Para  producir bienes y servicios se requiere  energía. El uso de energía no renovable provoca agotamiento de las fuentes energéticas y cambio perjudiciales en el medio ambiente. Esta investigación es de tipo exploratorio, no experimental de corte longitudinal, pretende mostrar la evolución, usos e intensidad energética de Honduras y Centroamérica.'),
(102, 'Estructura de la recaudación fiscal en Honduras: progresivo o regresivo ', '2017-10-01', NULL, 'El presente documento hace un análisis del comportamiento de los ingresos fiscales en Centroamérica y da a conocer  la  estructura de la recaudación fiscal  y la trayectoria que siguen  los ingresos tributarios en Honduras durante el periodo 2000-2015.  Es importante conocer las medidas adoptadas  por el Gobierno para contrarrestar los efectos causados tanto por la crisis financiera mundial y  la  crisis política por la que atravesó la economía hondureña.\r\nTambién se analiza la estructura y tendencias de la recaudación de los principales impuestos en Honduras, así como  una comparación  de la trayectoria que siguen los impuestos tributarios en toda la región centroamericana. \r\nEl siguiente informe cuenta con dos secciones. En la primera sección se describen las generalidades de la región centroamericana, en donde se observa la débil recuperación que mostro la presión tributaria y las finanzas públicas de los estados centroamericanos  después de la crisis financiera global. Además se realizan estimaciones de cuanto de los ingresos tributarios  es representado  por los ingresos totales, el mismo procedimiento se realiza  en el caso de  los gastos totales. En ese mismo apartado se describe la evolución que ha tenido la presión tributaria en Honduras y cuáles fueron  los detonantes de la contracción  de los ingresos tributarios. Igualmente  se hace mención  a la caracterización del sector fiscal hondureño y como este está estructurado. Adicionalmente se realiza una estimación de la inversión que hace el Gobierno en dos de las áreas que contribuyen al desarrollo económico de un país como lo son educación y salud en función de los ingresos tributarios. Asimismo se describen las leyes y reformas tributarias que se implementaron para subsanar las finanzas del Estado de Honduras.\r\nEn la segunda sección se presenta el análisis de los resultados de los datos obtenidos de los  diferentes ministerios y secretarias de Estado.  También en este apartado se explica la trayectoria que mantienen los impuestos directos e indirectos. Además  se hace énfasis en las principales impuestos que generan mayores ingresos tributarios. Y por último  se muestran las debilidades y fortalezas que presenta el sistema tributario hondureño.', 1, 7, 0, 0, 0, '18:30:00', 1, 'es', 'Progresividad, Regresividad, Impuestos Directos, Impuestos Indirectos', 'El propósito de la presente investigación técnica es hacer un análisis del comportamiento de los ingresos fiscales durante el periodo 2000-2015 de los países centroamericanos, principalmente Honduras. Se espera que el lector adquiera un panorama más amplio de la importancia de los ingresos tributarios en el país y de los países de la región'),
(103, 'factores que influyen en el bajo rendimiento academico estudiantil ', '2017-10-01', NULL, 'los diferentes factores que tienen mayor influencia en el bajo rendimiento academico ', 1, 6, 0, 0, 0, '00:00:00', 2, 'es', 'bajo rendimiento academico ', ''),
(105, '', '2017-10-01', '86_es_2017-10-01_10-12-38_estructura-de-la-recaudacinin-fiscal-en-honduras.docx', '', 1, 0, 0, 0, 0, '00:00:00', 0, '0', '', ''),
(107, 'Comportamiento de las políticas y programas sectoriales en las zonas turísticas de Honduras, en el periodo 1998-2015.', '2017-10-01', '113_es_2017-10-02_01-40-31_resumen-abreviado-turismo.docx', 'El presente documento resulta de un análisis de la incidencia de las políticas y programas sectoriales en las zonas turísticas de Honduras en el periodo 1998-2015. Los datos fueron recogidos de las instituciones públicas y privadas del país. El estudio es de tipo explicativo, técnicas estadísticas permitieron analizar la relación causal entre las políticas y programas implementados y las fluctuaciones de la oferta turísticas así como sus repercusiones en la demanda de servicios turísticos. Los resultados muestran que el sector turístico tiene una tendencia positiva de crecimiento, reflejándose la sensibilidad de este a los cambios socio-económicos, políticos y naturales.', 1, 7, 0, 0, 0, '00:00:00', 3, 'es', 'Turismo,políticas,programas', 'El presente documento resulta de un análisis de la incidencia de políticas y programas sectoriales en las zonas turísticas de Honduras en el periodo 1998-2015. El análisis causal entre las políticas y programas y la oferta turística muestran que el sector turístico tiene una tendencia positiva de crecimiento.'),
(108, 'Inasistencia del publico en general a los partidos de la Liga Nacional en el estadio Tiburcio Carias Andino.', '2017-10-01', '200_es_2017-10-01_11-18-00_proyecto-de-investigacion-metodos-y-tecnicas-ceat.docx', 'Se pretende determinar y encontrar los diversos factores que contribuyen a que los aficionados del fútbol nacional no asistan de manera regular al estadio nacional, describiendo la problemática como un asunto social,que ha causado un impacto y este ha sido notorio en los últimos años.', 1, 6, 0, 0, 0, '15:00:00', 3, 'es', 'Estadio,Aficionados,Factores', 'Honduras es caracterizada por ser un país “futbolero”, hay una gran cantidad de aficionados al futbol y a la Liga Nacional. Frecuentemente se comparten opiniones sobre los partidos de la Liga Nacional y es tema de conversación entre amigos. En los años 80s y 90s aún se podía percibir una gran cantidad de aficionados que asistían con frecuencia al Estadio Nacional Tiburcio Carias Andino de Tegucigalpa a disfrutar los partidos de los respectivos equipos locales (Olimpia y Motagua).\r\nEl abandono en las graderías del Estadio, (el cuál en vez de generar emoción, genera incomodidades con sus instalaciones, su falta de organización, y la falta de higiene que hay en el mismo) era notorio, a tal punto que en el año 2012 se pensó en cerrar la Liga Nacional por la inasistencia de la afición. El problema se mantuvo hasta la fecha ya que el último acontecimiento de relevancia, fue el pasado 28 de Mayo del presente año en que se jugó la final de la Liga Nacional y lamentablemente, la misma cobró la vida de 4 aficionados, provocando así la preocupación tanto de la afición como de los medios de comunicación. '),
(110, 'Inflación e indicadores para su medición', '2017-10-01', '201_es_2017-10-01_11-47-49_inflacinin-e-indicadores-para-su-medicinin.docx', 'En este trabajo se realiza un análisis de las diferentes formas de medición de la inflación en Honduras en el periodo 2000-2016. Este estudio se realizó con el fin de observar y explicar el comportamiento de ciertos indicadores como ser; Índice de Precios al Consumidor (IPC), Deflactor Implícito del PIB, asimismo se llevó a cabo un análisis del costo de la Canasta Básica de Alimentos (CBA).El IPC en Honduras es utilizado para medir la Inflación por lo que se empleó como base para realizar el  análisis comparativo con los demás indicadores.\r\nEn el caso del IPC se realizó un análisis comparativo con los países de Centroamérica  y un análisis solamente de Honduras respectos a sus variaciones de dicho índice, además se analizó sus rubros y cuál fue el comportamiento de los mismos y su impacto en la inflación. Seguidamente se realizó la comparación de las variaciones del costo de la canasta básica de alimentos y el Deflactor Implícito del PIB.\r\nSe concluye que debido a la diferencia entre los años base y los productos que componen el Índice de Precios al Consumidor así como sus ponderaciones, en Centroamérica Honduras presentan el mayor índice en la región. Debido a las diferencias metodológicas de cálculo del Índice de Precios al Consumidor y el Deflactor implícito del PIB la evolución de la brecha ha ido aumentando a través del tiempo, pero se puede observar que el Consumo Privado es el que más se asemeja al comportamiento del primero. También se concluye que la Canasta Básica de Alimentos es vulnerable en mayor medida que el Índice de Precios al Consumidor a las variaciones de los precios. Los cambios de los indicadores antes mencionados pueden incidir de manera positiva o negativa sobre la inflación y de no ser controlada puede ocasionar graves daños a las economías.\r\n', 1, 2, 0, 0, 0, '13:00:00', 3, 'es', 'Inflación, IPC, Deflactor Implícito del PIB', 'El presente trabajo trata sobre la inflación e indicadores para su medición (IPC, Deflactor implícito del PIB) a nivel centroamericano, realizando una comparación metodológica y de tendencia a nivel regional entre los indicadores, asimismo probar el nivel de convergencia entre los países y las diferencias entre metodologías e indicadores.'),
(111, 'Impacto del nuevo régimen de facturación en la rentabilidad de las micro, pequeñas y medianas empresas del distrito central en el año 2017', '2017-10-01', '213_es_2017-10-01_11-49-40_resumen-abreviado.doc', 'El presente documento resulta de un estudio realizado sobre el impacto  de un nuevo régimen de facturación en la rentabilidad de las Mipymes en el Distrito Central en el año 2017. Los datos fueron recolectados mediante encuestas aplicadas y entrevistas realizadas a las micro,  pequeñas y medianas empresas, de la misma forma se obtuvo información relevante sobre el comportamiento tributario proveniente de la plataforma de la Secretaria de Finanzas de Honduras.  El diseño del estudio es de corte transversal. Los resultados señalan que muchas empresas de la región especificada lograron formalizarse y que la rentabilidad no presenta un comportamiento uniforme.', 1, 1, 0, 0, 0, '11:00:00', 3, 'es', 'rentabilidad, facturacion, mipymes.', 'Estudio sobre el impacto  del nuevo régimen de facturación en la rentabilidad de las Mipymes en el Distrito Central en el año 2017. Con datos recolectados mediante encuestas  y entrevistas realizadas a las Mipymes, igualmente se obtuvo información del comportamiento tributario recolectado de la plataforma “Secretaria de Finanzas de Honduras”'),
(112, 'Comportamiento  de la producción del sub-sector eléctrico de energía renovable en Honduras en el periodo 2000-2016.', '2017-10-01', '113_es_2017-10-02_02-09-17_resumen-abreviado-energn-a.docx', 'El presente documento resulta de un análisis del comportamiento de la producción del Sub-Sector Eléctrico de Energía Renovable en Honduras en el periodo 2000-2016. Los datos fueron recolectados de organismos internacionales e instituciones gubernamentales. El estudio se caracteriza por ser de carácter no-experimental y de corte transversal correlacional, Se realizara un análisis estadístico descriptivo de las variables para determinar el comportamiento de la producción de energía renovable a través de los años. Los resultados señalan que hay una tendencia en invertir la matriz energética, principalmente con la generación de energía renovable.', 1, 7, 0, 0, 0, '00:00:00', 3, 'es', 'Energía, renovable, producción.', 'El presente documento resulta de un análisis del comportamiento de la producción del Sub-Sector Eléctrico de Energía Renovable en Honduras en el periodo 2000-2016, a partir de un análisis estadístico descriptivo. Los resultados señalan que hay una tendencia en invertir la matriz energética con la generación de energía renovable.'),
(113, 'Efecto que tienen las publicaciones GIF e24 años de edad en la ciudad de Tegucigalpa, en las redes sociales.', '2017-10-01', '184_es_2017-10-01_11-58-14_resumen-gif-1.docx', 'Con el propósito de Analizar la influencia de la publicidad a través de GIF en redes sociales implementadas por empresas de comidas, se realizará una investigación cuantitativa a usuarios de Facebook en el Distrito Central. Dada la naturaleza de la investigación se decidió realizar un estudio cuantitativo concluyente mediante la aplicación de encuestas estructuradas para jóvenes de Tegucigalpa que tienen acceso a la tecnología, nos enfocaremos en los consumidores, lo cual nos proporcionara información sobre el comportamiento que tienen a este tipo de herramienta de publicidad. Esperando demostrar  la importancia de la publicidad GIF en las empresas de comidas rápidas  en las redes sociales', 1, 15, 0, 0, 0, '09:00:00', 3, 'es', 'PUBLICIDAD, TECNOLOGIA, CONSUMIDOR', 'Con el propósito de Analizar la influencia de la publicidad a través de GIF en redes sociales implementadas por empresas de comidas, se realizará una investigación cuantitativa a usuarios de Facebook en el Distrito Central. Dada la naturaleza de la investigación se decidió realizar un estudio cuantitativo concluyente mediante la aplicación de encuestas estructuradas para jóvenes de Tegucigalpa que tienen acceso a la tecnología, nos enfocaremos en los consumidores, lo cual nos proporcionara información sobre el comportamiento que tienen a este tipo de herramienta de publicidad. Esperando demostrar  la importancia de la publicidad GIF en las empresas de comidas rápidas  en las redes sociales'),
(114, 'Solución de Software “Sistema de Información para Gestiones Hospitalarias (SIGEH)” desarrollado para el Instituto Nacional Cardio Pulmonar (INCP). ', '2017-10-02', '218_es_2017-10-02_12-45-51_solucinin-de-software-a-sistema-de-informacinin-para-gestiones-hospitalarias-sigeh-a-desarrollado-para-el-instituto-nacional-cardio-pulmonar-incp-.-.docx', 'El Sistema de Información para Gestiones Hospitalarias (SIGEH) fue diseñado, programado e implementado para el Instituto Nacional Cario Pulmonar por alumnos de la carrera de Informática Administrativa de la Universidad Nacional Autónoma de Honduras (UNAH) como una carga académica resultado como producto la donación del SIGEH al INCP.', 1, 16, 0, 0, 0, '14:30:00', 2, 'es', 'Software, Gestión Desarrollo\r\n', 'El Sistema de Información para Gestiones Hospitalarias (SIGEH) fue diseñado, programado e implementado para el Instituto Nacional Cario Pulmonar por alumnos de la carrera de Informática Administrativa de la Universidad Nacional Autónoma de Honduras (UNAH) como una carga académica resultado como producto la donación del SIGEH al INCP.'),
(115, 'El uso de las TIC por parte de los docentes como herramienta para la enseñanza de lenguas en la carrera de  lenguas extrajeras en la unah en el 2017.', '2017-10-02', NULL, 'El presente documento es el resultado empírico sobre el uso de las tic en la didáctica de lenguas extrajeras. El estudio no es experimental de corte longitudinal. Los datos fueron recolectados por medio de cuestionarios aplicados a maestros del área. Los resultados muestran que existe una utilización de las tic como herramientas para la enseñanza de lenguas por parte de los licenciados de la carrera de lenguas extrajeras de la unah, mostrando una aceptación por parte de los maestros hacia las nuevas tecnologías.', 1, 0, 0, 0, 0, '00:00:00', 2, 'es', 'Didáctica, herramienta, enseñanza, utilización, tecnologías', ''),
(116, 'TENDENCIAS ACTUALES EN LOS PROCESOS DE LA INDUSTRIA HOTELERA', '2017-10-02', '220_es_2017-10-02_07-26-44_i-paper-ceat-2017-par.docx', 'La industria  hotelera es una actividad económica de productos-servicios compleja que además de alojamiento, alimentación y bebidas ofrece una variedad de servicios complementarios y auxiliares para satisfacer las necesidades, demandas y deseos de estos consumidores. Es por ello que muchos hoteleros son conscientes de que la mejor manera de destacar y estar un paso por adelante de la competencia, en estos tiempos tan difíciles y competitivos, es incorporar adelantos tecnológicos y ofrecer servicios adecuados a los nuevos estándares de vida que existen en la actualidad (tan íntimamente ligados a avances tecnológicos). Tanto es así que las  tendencias actuales, sobretodo en tecnología marcarán el rumbo en la planificación de las nuevas estrategias a implementar, y también influirá en el modo en que se gestiona una empresa hotelera en general.', 1, 12, 0, 0, 0, '10:00:00', 2, 'es', 'procesos tecnologicos, tendencias, industria hotelera ', 'La industria hotelera es conscientes de que la mejor manera de destacar y estar un paso por adelante de la competencia, en estos tiempos tan difíciles y competitivos, es incorporar adelantos tecnológicos y ofrecer servicios adecuados a los nuevos estándares de vida que existen en la actualidad .'),
(117, 'limitantes del docente', '2017-10-02', '181_es_2017-10-03_08-00-26_181-es-2017-10-02-08-30-45-resumen-abreviado-ceat-2017.docx', 'Medir el desempeño del docente en el salón de clases', 1, 11, 0, 0, 0, '10:00:00', 3, 'es', 'docentes\r\nlimitantes\r\ndesempeño', 'limitantes del docente que evitan un buen desempeño en el salon de clase.\r\nMETODOLOGIA:\r\nprobabilistico\r\ncuatitativo\r\ntransversal\r\nRESULTADOS ESPERADOS:\r\nse identifiquen los recursos basicos que necesita el docente para un buen desempeño\r\nse determine la metodologia pedagogica adecuada para el docente\r\nse pueda establecer factores que intervengan en su autonomia.'),
(118, '', '2017-10-02', NULL, '', 1, 0, 0, 0, 0, '00:00:00', 0, '0', '', ''),
(119, 'percepcion de los consumidores hacia las practicas del marketing social de Las empresas ', '2017-10-02', '190_es_2017-10-02_08-41-12_resumen-abreviado.docx', 'El presente documento es resultado de un estudio empírico de la percepción que tienen los consumidores en relación a las prácticas del marketing social de las empresas. Los datos fueron recopilados a partir de una encuesta  y un estudio por observación. El estudio es explicativo y tiene corte longitudinal. Se utilizaron escalas de Likert para medir actitudes de los consumidores ya sea favorables o desfavorables  ante la situación  de las labores sociales. Los resultados señalan que existe una buena precepción por los consumidores y es por eso que apoyan las distintas áreas del marketing social realizadas por las empresas. \r\n\r\n', 1, 11, 0, 0, 0, '08:00:00', 3, 'es', 'percepcion, areas del marketing social, publicidad ', 'El presente documento es resultado de un estudio empírico de la percepción que tienen los consumidores en relación a las prácticas del marketing social de las empresas. Los datos fueron recopilados a partir de una encuesta  y un estudio por observación. El estudio es explicativo y tiene corte longitudinal. Se utilizaron escalas de Likert para medir actitudes de los consumidores ya sea favorables o desfavorables  ante la situación  de las labores sociales. Los resultados señalan que existe una buena precepción por los consumidores y es por eso que apoyan las distintas áreas del marketing social realizadas por las empresas. \r\n\r\n'),
(120, 'cultura gastronómica hondureña ', '2017-10-02', '82_es_2017-10-02_09-06-01_resumen-abreviado-cultura-gastronnimica-honduren-a.docx', 'El propósito de la investigación es analizar los factores que influyen en la cultura gastronómica hondureña en estudiantes de 7 y 8 grado, se realizara una investigación cuantitativa, tomando en cuenta   las variables de tiempo, precio e influencia social, en el centro Educativo Evangélico Hosanna de Tegucigalpa, está investigación será de tipo experimental y consistirá en la manipulación de las variables, en condiciones rigurosamente controladas.', 1, 8, 0, 0, 0, '00:00:00', 3, 'es', 'Identidad, Gastronomía, Cultura. ', ''),
(121, 'Phonemic Awareness', '2017-10-02', '230_es_2017-10-02_09-25-38_resumen-tesis.docx', 'Phonemic Awareness', 1, 14, 0, 0, 0, '15:00:00', 3, 'es', '(enseñanza, aprendizaje, idiomas)', 'La presente  investigación establece si el  conocimiento fonemico es una variable que afecta en el aprendizaje de una segunda lengua.\r\nAnalizamos el grado de dificultad que implica la conciencia fonética.\r\nLos resultados de investigación muestran que existe una fuerte debilidad en el área fonética en la enseñanza de lenguas.\r\n'),
(122, '', '2017-10-02', NULL, '', 1, 0, 0, 0, 0, '00:00:00', 0, '0', '', ''),
(127, 'Problemas de Aprendizaje en Adultos en una Segunda Lengua', '2017-10-02', '115_es_2017-10-02_05-15-41_problema-de-investigacion.docx', 'El presente trabajo resulta de un estudio investigativo empírico que tiene como objetivo principal encontrar, auditar, clasificar y jerarquizar las dificultades para aprender una lengua extranjera.\r\nLa investigación es de tipo descriptivo y los datos serán recolectados mediante encuestas a estudiantes de la carrera de lenguas extranjeras.\r\nComo resultado de la investigación se espera identificar los problemas que afectan a los estudiantes en la adquisición de una segunda lengua y poder proporcionarles a los docentes de lenguas las herramientas necesarias para facilitar este proceso de manera que se brinde un aprendizaje significativo. \r\n', 1, 11, 0, 0, 0, '03:00:00', 3, 'es', 'Aprendizaje, Lengua, Adultos', 'La investigación tiene como finalidad encontrar, auditar, clasificar y jerarquizar las dificultades para aprender una lengua extranjera. La investigación es de tipo descriptivo; los datos serán recolectados mediante encuestas. Como resultado de la investigación se espera identificar los problemas que afectan a los estudiantes en la adquisición de una lengua.'),
(128, 'Comportamiento de la generación “Baby Boomers” en relación al material de información en las redes sociales', '2017-10-03', '152_es_2017-10-03_07-55-27_resumen-abreviado-investigacion-sobre-noticias-falsas.docx', '', 1, 5, 0, 0, 0, '00:00:00', 3, 'es', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_trabajo_tematica`
--

CREATE TABLE `tbl_trabajo_tematica` (
  `id_trabajo_fk` int(11) NOT NULL,
  `id_tematica_fk` int(11) NOT NULL,
  `principal` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_trabajo_tematica`
--

INSERT INTO `tbl_trabajo_tematica` (`id_trabajo_fk`, `id_tematica_fk`, `principal`) VALUES
(1, 4, 0),
(1, 6, 0),
(1, 12, 1),
(2, 2, 1),
(2, 4, 0),
(2, 7, 0),
(3, 6, 1),
(3, 11, 0),
(3, 15, 0),
(4, 1, 1),
(4, 2, 0),
(4, 7, 0),
(5, 2, 1),
(6, 7, 1),
(6, 8, 0),
(6, 11, 0),
(7, 7, 1),
(7, 8, 0),
(7, 10, 0),
(10, 11, 1),
(10, 13, 0),
(10, 14, 0),
(11, 11, 1),
(11, 13, 0),
(11, 14, 0),
(12, 10, 1),
(13, 8, 1),
(13, 10, 0),
(14, 10, 1),
(15, 2, 1),
(15, 4, 0),
(15, 7, 0),
(16, 2, 1),
(18, 2, 1),
(20, 4, 1),
(29, 4, 0),
(29, 7, 0),
(29, 11, 1),
(30, 4, 0),
(30, 7, 0),
(30, 11, 1),
(31, 6, 1),
(32, 7, 1),
(34, 1, 1),
(34, 3, 0),
(34, 7, 0),
(35, 1, 1),
(35, 8, 0),
(35, 10, 0),
(37, 5, 0),
(37, 14, 1),
(38, 12, 1),
(39, 7, 1),
(39, 8, 0),
(39, 9, 0),
(40, 4, 0),
(40, 6, 1),
(40, 12, 0),
(41, 11, 1),
(41, 13, 0),
(41, 14, 0),
(42, 2, 1),
(42, 7, 0),
(42, 13, 0),
(43, 4, 0),
(43, 7, 1),
(43, 9, 0),
(44, 7, 1),
(44, 11, 0),
(44, 12, 0),
(45, 7, 1),
(45, 8, 0),
(45, 10, 0),
(47, 1, 0),
(47, 4, 1),
(47, 12, 0),
(48, 1, 1),
(49, 1, 1),
(49, 7, 0),
(50, 11, 1),
(52, 8, 1),
(53, 3, 0),
(53, 7, 1),
(54, 8, 0),
(54, 14, 1),
(56, 11, 1),
(57, 11, 1),
(58, 2, 0),
(58, 7, 1),
(60, 2, 1),
(61, 1, 1),
(61, 8, 0),
(62, 1, 1),
(64, 1, 0),
(64, 10, 0),
(64, 11, 1),
(65, 8, 1),
(65, 9, 0),
(65, 10, 0),
(66, 5, 0),
(66, 8, 1),
(66, 10, 0),
(67, 11, 1),
(68, 11, 1),
(69, 14, 1),
(70, 2, 0),
(70, 7, 0),
(70, 11, 1),
(72, 8, 0),
(72, 10, 1),
(72, 13, 0),
(73, 4, 1),
(74, 4, 1),
(77, 1, 1),
(77, 4, 0),
(77, 7, 0),
(79, 7, 0),
(79, 11, 1),
(80, 11, 1),
(82, 11, 1),
(83, 11, 1),
(84, 8, 1),
(85, 11, 1),
(85, 14, 0),
(85, 16, 0),
(86, 2, 1),
(86, 11, 0),
(87, 11, 1),
(89, 5, 1),
(90, 5, 1),
(91, 6, 0),
(91, 8, 0),
(91, 14, 1),
(92, 8, 1),
(93, 15, 0),
(93, 16, 1),
(95, 7, 0),
(95, 8, 0),
(95, 10, 1),
(96, 14, 1),
(97, 5, 0),
(97, 7, 1),
(97, 9, 0),
(98, 5, 1),
(98, 8, 0),
(99, 7, 1),
(100, 1, 1),
(100, 3, 0),
(100, 15, 0),
(101, 2, 1),
(101, 7, 0),
(102, 7, 1),
(103, 6, 1),
(107, 7, 1),
(108, 5, 0),
(108, 6, 1),
(108, 11, 0),
(110, 2, 1),
(110, 7, 0),
(111, 1, 1),
(111, 2, 0),
(111, 3, 0),
(112, 7, 1),
(113, 5, 0),
(113, 14, 0),
(113, 15, 1),
(114, 10, 0),
(114, 11, 0),
(114, 16, 1),
(116, 12, 1),
(117, 11, 1),
(119, 5, 0),
(119, 11, 1),
(120, 7, 0),
(120, 8, 1),
(121, 10, 0),
(121, 11, 0),
(121, 14, 1),
(127, 10, 0),
(127, 11, 1),
(127, 14, 0),
(128, 5, 1);

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
(3, 'omartinez', '$1$/t4.az4.$x9mTPpkx4uWvXiDAhX5zA.', 3, 'es', NULL),
(4, 'oarzu', 'ocPUDslDOQ1is', 4, 'es', NULL),
(5, 'LeonelaTurcios', 'lH0MtfmKA9IMg', 5, 'es', NULL),
(6, 'AmetPomare', 'EmKP27Ft8zzp.', 6, 'es', NULL),
(7, 'ClarisaVallejo', 'SaCfa4H7Jg48.', 7, 'es', NULL),
(8, 'Angelica', 'Bo5sHt6yszzDA', 8, 'es', 'img/users/8_fb-img-14921840213471293.jpg'),
(11, 'jargueta', 'DopmRRjLB5wMQ', 11, 'es', NULL),
(12, 'YesyHerrera', 'wPl4uvr.ttDKU', 12, 'es', NULL),
(13, 'ArlethTurcios', 'erpb2SIxTOWS6', 13, 'es', NULL),
(14, 'RafaelValladares', 'PyvqQg5WrV7vY', 14, 'es', NULL),
(15, 'edhuf', 'ISY.UB4cfy6B2', 15, 'es', 'img/users/15_crop-eduard.jpg'),
(20, 'Jose varela', 'UZpwtUiH0ZtIM', 20, 'es', NULL),
(21, 'karlitoz17', '3Xclf86sPJN8Q', 21, 'es', NULL),
(22, 'imarroquin', 'KATr7Mb2fVQS2', 22, 'es', NULL),
(23, 'jflores', '$1$r90.YJ3.$nuaGpjqJJyGcZqL8PFeZC.', 23, 'es', NULL),
(24, 'jarrazola', 'NVUuGJdzonEb6', 24, 'es', NULL),
(25, 'marlon_cerrato', 'bD6tgFkzDldyY', 25, 'es', NULL),
(26, 'jc', 'DfyPvBH4W9fLI', 26, 'es', NULL),
(27, 'Javedgardo', '07WzJmwwQnqUk', 27, 'es', NULL),
(28, 'ManuelFlores', '2OYuCkvTlVZbI', 28, 'es', NULL),
(29, 'Ludwin López', 'yXCaZcKugCNrM', 29, 'es', NULL),
(30, 'vjcanizales', 'CCdWD53SOUvvo', 30, 'es', NULL),
(31, 'Celeo Emilio Masculino Arias Moncada', '1Fmuk8P4pPoGQ', 31, 'es', 'img/users/31_252423-10151039775177000-1729443342-n.jpg'),
(32, 'Conde', 'S0af.2yx/erEM', 32, 'es', NULL),
(33, 'javier.delcid', '1pqmFc4Uvobxw', 33, 'es', 'img/users/33_yo.jpg'),
(34, 'evelyn', 'SK9wS3gQFh9JI', 34, 'es', NULL),
(35, 'cortega', 'rC8URd16GYGVI', 35, 'es', NULL),
(36, 'Marcia Moncada', '5zz9cXIAkcT5s', 36, 'es', NULL),
(37, 'iBBUbkyKhB', 'WyUdQAQ/vysaE', 38, 'es', NULL),
(38, 'dgSK6UVnMZ', 'GdEuw.60qm5oo', 39, 'es', NULL),
(39, 'vosajsLRUy', 'm1rcvj4r0Fmcw', 40, 'es', NULL),
(40, 'ARRWAQInIN', '9THnSrcuLodAo', 41, 'es', NULL),
(41, '0IezsplIH8', 'hmnSJBmz.yeyA', 42, 'es', NULL),
(42, 'jOAng0mNWu', 'gCMa7aBazripk', 43, 'es', NULL),
(43, '2ssn2uLC0t', 'oqsx6y1uguCn2', 44, 'es', NULL),
(44, 'pAvLmLGdB6', 'o3Uz0V7SFN3iY', 45, 'es', NULL),
(45, 'uj7TrhWsaU', 'ee2KAaPSivpYQ', 46, 'es', NULL),
(46, 'kJoDh7IxDW', 'HcAh8OveXm7k.', 47, 'es', NULL),
(47, 'aacosta', '6XT3vr6f6wxO.', 48, 'es', NULL),
(48, 'JraHjEJFMA', '77.vruZfQVFtg', 49, 'es', NULL),
(49, 'VSIJhjhK60', 'F/NSCoGioBjqo', 50, 'es', NULL),
(50, 'clauerivera', 'pdyR8rW44w/v.', 51, 'es', NULL),
(51, 'ncastillob', '$1$r90.YJ3.$nuaGpjqJJyGcZqL8PFeZC.', 52, 'es', NULL),
(52, 'marvin.aguilar', 'kZxTzHWBpt1c2', 53, 'es', NULL),
(53, 'jlrodriguez', 'oXQIcVXmQauvY', 54, 'es', 'img/users/53_1376864920-765.jpg'),
(54, 'neo9Fvvs8O', 'I+BIJBbyAEPFE', 55, 'es', 'img/users/54_11755917-1078742825487141-6491781407546303778-n.jpg'),
(55, 'nraudales', 'GmWjtmMa7vy7k', 56, 'es', NULL),
(56, 'eduardo1994', 'CdDAiCfMGRoe2', 57, 'es', NULL),
(57, 'Ghj8FiZ9Za', 'jTY4AqXI7SKiQ', 58, 'es', NULL),
(60, 'mareli', 'A7BjlNI7d1Pns', 61, 'es', NULL),
(61, 'mlopez', 'OTGESsXv/VpKo', 62, 'es', NULL),
(63, 'marioceatiies', 'OQtgvZcQz5tJc', 64, 'es', NULL),
(64, 'ncastillo', 'pq7yj/AsTwRCs', 65, 'es', NULL),
(65, 'EoL6dWhV6H', '09yjARihCrIjo', 66, 'es', NULL),
(67, 'bracho', 'de6iTrV3YcU2k', 68, 'es', NULL),
(68, 'Vefull', 'HwwR.OI78ghEc', 69, 'es', NULL),
(69, 'sueilop', 'GpCwv/9VrXkHc', 70, 'es', NULL),
(70, 'Edna Martinez', 'qnSIRyqpqyghU', 71, 'es', NULL),
(71, 'jcabrera', 'LjqS3sgIjRaqI', 72, 'es', NULL),
(72, 'Guianni Jimenez Aguero', '0GgPKk4CAeukk', 73, 'es', NULL),
(73, 'yMmTLdXBuS', 'o7Z/H0WyaWrIM', 74, 'es', NULL),
(74, 'jcbermudez', 'plobrNesMCifA', 75, 'es', NULL),
(75, 'jymolina', 'Jf6/EfkYHkxKE', 76, 'es', NULL),
(76, 'rMV2cs6Zr3', 'xsjzyIKfwX6h.', 77, '0', NULL),
(77, 'jMjeZs5jwE', 'Uik7pcmIfoulM', 78, '0', NULL),
(78, 'h36SY4GbaT', 'sICELw2/CoTtc', 79, '0', NULL),
(79, '93Mzo9CVN5', 'U+DQ/bCoUZu2w', 80, '0', NULL),
(80, 'madelyn.dayana', 'ejGVXd.8um.iI', 81, 'es', NULL),
(81, 'joselin.galdamez', 'd8/FZxkTzQHjQ', 82, 'es', NULL),
(82, 'XxqepmY2gF', 'MGY0IJ2FnXxp6', 83, 'es', NULL),
(83, 'F4ScQpeaO3', 'VJ2Tfyc6anSi.', 84, 'es', NULL),
(84, 'MFbiwnp499', 'M7ST0IIyg5j3w', 85, 'es', NULL),
(85, 'aby_r44', '4ov.k1Uf5ABG2', 86, 'es', NULL),
(86, 'dannymtz', 'fngLcXBs3QVis', 87, 'es', NULL),
(87, 'Michell Amador ', 'G26uvZbaStYb.', 88, 'es', NULL),
(88, 'Stefannia Amador ', 'ixzuQjKHR8wSQ', 89, 'es', NULL),
(89, 'Wendy amaya', 'HiypCwRTTl/rM', 90, 'es', NULL),
(90, 'Wendy Amaya', 'd6zOi3LmRInPU', 91, 'es', NULL),
(91, 'MB0ibHi3tb', 'lF2rH7aRXjWMw', 92, 'es', NULL),
(92, 'p2Qyx1ddoN', 'sRVfrGNeEJuWM', 93, 'es', NULL),
(93, 'osB9YHpVj6', 'D93XgMnoSpuCU', 94, 'es', NULL),
(94, 'EiljZ3KJRh', 'ZRnu1Abbq3boE', 95, 'es', NULL),
(95, 'FD1oFP82mm', 'ymVTDSCcH/SaU', 96, 'es', NULL),
(96, 'Av8LMXCBT4', 'RJRuIJThRun0U', 97, 'es', NULL),
(97, 'Or6P3ZMlz4', '+HfKYfcPjTscM', 98, 'es', NULL),
(98, 'weFKoHW3Wg', 'ASo6JyKcFjrwk', 99, 'es', NULL),
(99, 'OWTA1brUMZ', 'aUHjpmZ4QWFkU', 100, 'es', NULL),
(100, 'Kerlyn Burgos', 'TzdxipTTa4K.g', 101, 'es', NULL),
(101, 'Liliavila', 'ecnQVGckR6cXo', 102, 'es', NULL),
(102, 'rnarmin', '4W/opDe1jR5y2', 103, 'es', NULL),
(103, '6KVTXniyCk', 'bOv71oHraJYAw', 104, 'es', NULL),
(104, 'aMZ6ufvLX5', 'EdepN4QWckDwQ', 105, 'es', NULL),
(105, 'gEBF7DXrUZ', 'x0zw5vagjr9qU', 106, 'es', NULL),
(106, 'gabriela-polanco', 'ZK3RzCaPzAxAo', 107, 'es', NULL),
(107, 'lEKZK1w8bB', 'wP.XNXags2CGM', 108, 'es', NULL),
(108, 'Gloria Coello', 'NWSTlmt2lwyto', 109, 'es', NULL),
(109, 'IscoPaz', '+mDwUlUpqwM6M', 110, 'es', NULL),
(110, 'WdZR9PP62s', 'HIVpRQqU04Edg', 111, 'es', NULL),
(111, 'qmezNzc8Ax', 'ElNcADf2Z1hsc', 112, 'es', NULL),
(112, 'Rudy Martinez', 'lB2AtZffkzxFc', 113, 'es', NULL),
(113, 'jsabasg', 'DI8./tcJMjE1k', 114, 'es', NULL),
(114, 'Pamela Morales', 'JstrprAP8JGFg', 115, 'es', NULL),
(115, 'abrahamangel', 'b6/0rblM0WzfY', 116, 'es', NULL),
(116, 'KCb3BMi5ym', 'okuxQaxmMPj5E', 117, 'es', NULL),
(117, 'dYFkAqGQrW', 'eAQmjCe4RP2yI', 118, 'es', NULL),
(118, 'qRZ289a5hK', 'jXmky97yFcwq6', 119, 'es', NULL),
(119, 'Kathy Alejandra Ramos', 'EMmCXp71Xw6ao', 120, 'es', NULL),
(120, 'adopineda', 'ZphTisXD50Nkw', 121, 'es', NULL),
(121, 'BKvzant87F', 'nZlBwS/1CFl5.', 122, 'es', NULL),
(122, 'bk1akgy7fO', 'uvxR/EVY30HWQ', 123, 'es', NULL),
(123, 'AaronRu', 'ydT/XdTj.d91U', 124, 'es', NULL),
(124, 'Gabriela Rodriguez', 'zRVPlcwqxqlAg', 125, 'es', NULL),
(125, 'sr49HGCofh', '3kb/TI5VHyH2k', 126, 'es', NULL),
(126, 'bwZgOvPbT4', 'oE5ns1Q5R7dyY', 127, 'es', NULL),
(127, 'E35znf56QM', 'YLmzgaNIj5Xjk', 128, 'es', NULL),
(128, 'gBdKb1nB9X', 'nWhZwM8Cu7L5A', 129, 'es', NULL),
(129, 'KevinIrias', 'j6jfuV9O7MzGo', 130, 'es', NULL),
(130, 'issis rodriguez', 'Xuf2hLnaR22B6', 131, 'es', NULL),
(131, '5EWIHpgO2x', 'FujGsqPJIaGSc', 132, 'es', 'img/users/131_img-20170829-wa0012.jpg'),
(132, 'vzA6gjmZPn', '13Z7CNfa6BSz.', 133, 'es', NULL),
(133, 'Haydee Mendoza', 'JxyWY1Y/VWeGs', 134, 'es', NULL),
(134, '5lzJUICFUt', 'Oz/ir2KSc1Ocg', 135, 'es', NULL),
(135, 'v23UHKijT1', '3iHeRo5UxGKGM', 136, 'es', NULL),
(136, 'daviddiaz', 'zaycw8WCW5l2k', 137, 'es', NULL),
(137, '4KpzpTmNOX', 'NjmI32OTjlJ92', 138, '0', 'img/users/137_img-20170326-wa0003.jpg'),
(138, 'IrisAlvarenga', 'Flw14yaJc3n8k', 139, 'es', NULL),
(139, '30O5C8mKfg', 'EFy8f.A7ZWNmw', 140, 'es', NULL),
(140, 'fXYxJC3ioe', 'SaHbERioyh8qU', 141, 'es', NULL),
(141, 'arely.flores@unitec.edu', 'ttfynHQ6qxn6s', 142, 'es', NULL),
(142, 'k1kBsS4Gss', 'DfAKkttZZwC6g', 143, 'es', NULL),
(143, 'llq12OKUZr', '9/2jO1xxn1IlY', 144, 'es', NULL),
(144, 'rBMvRFKRpl', 'P8zRPjS2f1Lf2', 145, 'es', NULL),
(145, 'nathanael2017', 'V6jyncipcxdEM', 146, 'es', NULL),
(146, 'Alejandra Canales', 'Y9rkmJJMwrUfs', 147, 'es', NULL),
(147, 'douggtorress', 'qlp1Al5KjmFKg', 148, 'es', NULL),
(148, 'tdt7k4wgm0', 'O8UvcozxfB/4I', 149, 'es', NULL),
(149, 'mRW0lThJvx', '0zbCWil/jzcCc', 150, 'es', NULL),
(150, 'IjTns11kQ6', 'ygInsNCNFJvSw', 151, 'es', NULL),
(151, 'vianney mendez', 'mv690jTbDdKX6', 152, 'es', NULL),
(152, 'andrea flores', 'lWH7XK/3wJkBA', 153, 'es', NULL),
(153, 'LxtIGq6OQE', '6SGhfWapvhvr.', 154, 'es', NULL),
(154, 'eEvPwBCG9b', 'b+gNmo/dwAde.', 155, 'es', NULL),
(155, 'sM13NGEeSl', '+hF7TBAYlEKKw', 156, 'es', NULL),
(156, 'vMtMLx7qEB', 'cdBdk6bsU.vBs', 157, 'es', NULL),
(157, '7OIUK74LiG', 'Q3acHUKGlEkHs', 158, 'es', NULL),
(158, '87T8lKHSmQ', 'SLyrBuPsbWA.o', 159, 'es', NULL),
(159, 'lyansalgado', 't6cS2NJASaEGI', 160, 'es', NULL),
(160, 'Diana Eguigure', 'FYakhZdJUDmdo', 161, 'es', NULL),
(161, 'EDAAF10OEl', 'xQR3tRNZj3Wt.', 162, 'es', NULL),
(162, '7tdca3hRce', 'elsttKXC9SDFg', 163, 'es', NULL),
(163, 'Cristian Gonzalez', 'JK.G3Hl1Y8wVw', 164, 'es', NULL),
(164, 'MSahury', 'VUouuqggxCVHo', 165, 'es', 'img/users/164_img-20170511-wa0049.jpg'),
(165, 'shhafik', '5aKDyujgg1kes', 166, 'es', NULL),
(166, 'rapEMwsgrh', 'dA7kENQ1ul7fI', 167, 'es', NULL),
(167, 'wy8eCdl7fv', 'bMVx7JaOzqx4w', 168, 'es', NULL),
(168, 'OZo8y0y9jm', 'pyha7nGG7x.dU', 169, 'es', NULL),
(169, 'F4fARXX8g7', 'pBcJgsr.55lGI', 170, 'es', NULL),
(170, 'Lary', 'N6akS9egfjRWU', 171, 'es', NULL),
(171, 'danielarico', 'cNfvvDLNG56HA', 172, 'es', NULL),
(172, 'kener reyes ', 'bh3uLK7QWLEjY', 173, 'es', NULL),
(173, 'marlonmedina96', 'kgr1TvylJOoHA', 174, 'es', NULL),
(174, 'zfDtc2CmMg', 'GQbiOkwwZbfBU', 175, 'es', NULL),
(175, 'Katerine', '0AMLIcn5UGDvU', 176, 'es', NULL),
(176, 'cdJ0Kbdwes', 'kwFJne95.zfRc', 177, 'es', NULL),
(177, 'nhrnyCGgkJ', '/nH76nIZK3sVM', 178, 'es', NULL),
(178, 'mb7O4S6a31', 'GJzMQ3J81swaM', 179, 'es', NULL),
(179, 'evelin ', 'LMapy9LsutItA', 180, 'es', NULL),
(180, 'ana palma', 'oaZKu6Gx.UzsQ', 181, 'es', NULL),
(181, 'f26986vMwT', 'QLap.fd/VLWxg', 182, 'es', NULL),
(182, 'luifi148', '8wdJ4giXXS5GY', 183, 'es', NULL),
(183, 'fmerlynflores', 'kvFs2xTUKeNDU', 184, 'es', NULL),
(184, 'DDQig4yD3N', '8KIvE.iDguw5g', 185, 'es', NULL),
(185, '1DMoEw1dBt', 'Q3fvdwgNhwrnA', 186, 'es', NULL),
(186, 'kApBGwI86V', 'pzmQOHLo2cMvg', 187, 'es', NULL),
(187, 'HHx4f3N8W5', 'hG/SXIwufgz56', 188, 'es', NULL),
(188, 'claribt95', 'dbpTRcPTYx90s', 189, 'es', NULL),
(189, 'evelin corea ', '4TpSf9sb2Pw2M', 190, 'es', NULL),
(190, 'JackyS', '5/Z32vSfATjwM', 191, 'es', NULL),
(191, 'Katherine Nuñez', 'R4Xaogk5P63dk', 192, 'es', NULL),
(192, 'zrdQEJqkcE', 'U+OApQgBzTJGE', 193, 'es', NULL),
(193, 'woKS530HH0', 'LJZs/VKPNihrQ', 194, 'es', NULL),
(194, 'kRrlhgqZpt', 'wLMdiRzz0YlUc', 195, 'es', NULL),
(195, 'xsYuQcuvaQ', '1139qCExutWZg', 196, 'es', NULL),
(196, 'carloselvir', 'a1bq1ZtxuLVUo', 197, 'es', NULL),
(198, 'zr9NXuk7VC', '1YoJfxXt.OwLg', 199, 'es', NULL),
(199, 'valedubon', '+7kRi9anZsdZQ', 200, 'es', NULL),
(200, 'elmer.carcamo', 'XuCkgzoLtywUE', 201, 'es', NULL),
(201, 'danagers1', '30ysLgimDs8bI', 202, 'es', NULL),
(202, 'py5i87AxdA', 'Y5xqTutVpuXNk', 203, 'es', NULL),
(203, 'tcvvDPrJLJ', 'RViOGqe8Kv.YQ', 204, 'es', NULL),
(204, 'B3NadH5vxv', 'PcWW2O3Sf8II.', 205, 'es', NULL),
(205, 'ixGqBikZsl', 'eoyZ9f3wCOBQk', 206, 'es', NULL),
(206, 'RtVtTCBfx0', 'a7aI3aimEQyl6', 207, 'es', NULL),
(207, 'e8mBm0Lcs9', '+W7VCs1R7ys22', 208, 'es', NULL),
(208, 'N8DWAukF91', 'omuU9uhL2TYFA', 209, 'es', NULL),
(209, 'UomkDeYMSl', '2QHSMPLbTtd0.', 210, 'es', NULL),
(210, 'e31wLJMj7k', 'yXAe3h2pH0wIw', 211, 'es', NULL),
(211, 'LFGCVZEUSL', 'g+gu9j.LbSFfk', 212, 'es', NULL),
(212, 'alejandra', 'fGxm5hSDkmxCA', 213, 'es', NULL),
(213, 'W1eVn11Sxk', 'NG89fUSzVA5OA', 214, 'es', NULL),
(214, 'vkPgtEBSYS', '7xp8l.Hf1e9Ko', 215, 'es', NULL),
(215, 'ViE7R06b6X', '0wnLJEaPh26fY', 216, 'es', NULL),
(216, 'celina.ramirez', 'ZA0Q1Tk8Yyy9Q', 217, 'es', NULL),
(217, 'alex_giron', '+6Ffmp2SxBhCM', 218, 'es', NULL),
(218, 'B9A2cZAcXa', 'prY0SMYMfEjuw', 219, 'es', NULL),
(219, 'truiz', '2j9elno2jND0A', 220, 'es', NULL),
(220, 'yIZ8F16DPS', 'g+QI/wKxirb9w', 221, 'es', NULL),
(221, 'iRKVIfjZEH', 'q4C6gKK1BwFpk', 222, 'es', NULL),
(222, 'AWpuMZ1unA', 'D+lsbX.4HJcA6', 223, 'es', NULL),
(223, 'pgsQZ7bNUb', 'qkKS1m.HknwHQ', 224, 'es', NULL),
(224, 'HGKEyUSM3C', 'HxPOQ2UJtzSOA', 225, 'es', NULL),
(225, 'u53R6Ts6Y5', 'lhEVGPzhGYky.', 226, 'es', NULL),
(226, 'astridvelasquez14@hotmail.com', 'hxlC5gMP3coKk', 227, '0', NULL),
(227, 'QNrTpVJ6B1', 'fdx0R9Fq5zZN2', 228, 'es', NULL),
(228, 'KiME9GXFtB', 'ZIxQwrJ9vh.Oc', 229, 'es', NULL),
(229, 'AsaelNunez', 'w+/qkljaUNSNo', 230, 'es', NULL),
(230, 'jXXv4COZsC', 'T7xnCgIfYGIJ2', 231, 'es', NULL),
(231, 'gGWM1bWIXV', 'YSpIxUtwwUG3g', 232, 'es', NULL),
(232, 'Roger97', 'T5JJReciQ95DI', 233, 'es', NULL),
(233, 'Roger97', 'HFTU.k2uP2k2o', 234, 'es', NULL),
(234, 'Roger97', 'CVDkP56Ll5sPM', 235, 'es', NULL),
(235, 'Roger97', 'EtWm5gahDl5MQ', 236, 'es', NULL),
(236, 'Roger97', 'pE1qJ6qqBy77.', 237, 'es', NULL),
(237, 'Roger97', '1wBh9v2uKXCkw', 238, 'es', NULL),
(238, 'Roger97', 'g7VUnmiPjxITY', 239, 'es', NULL),
(239, 'Roger97', '0R5IwgLHxMOWw', 240, 'es', NULL),
(240, 'Roger97', 'YlFfN/tlldYQA', 241, 'es', NULL),
(241, 'Roger97', 'd2o0HvfpPAcn2', 242, 'es', NULL),
(242, 'Roger97', 'C9bQY3raOvmtM', 243, 'es', NULL),
(243, 'Roger97', 'Z9gppad.Wgvic', 244, 'es', NULL),
(244, 'Roger97', 'XjTvm4RdxUcWg', 245, 'es', NULL),
(245, 'Roger97', 'duli9iy76UAPg', 246, 'es', NULL),
(246, 'Roger97', 'QjaekastZzt7A', 247, 'es', NULL),
(247, 'Roger97', 'H6eLgnhNq/eSk', 248, 'es', NULL),
(248, 'Roger97', '+qt1jGVLuElT2', 249, 'es', NULL),
(249, 'Roger97', 'YlFfN/tlldYQA', 250, 'es', NULL),
(250, 'ana briceño', 'lMwpSR4wnPnK2', 251, 'es', NULL),
(251, 'NhomQdOUYH', '+eWgrL4MJhFMk', 252, 'es', NULL),
(252, 'boDf9vNlPx', 'EULU34LqKp9X6', 253, 'es', NULL),
(253, 'anacanadas', 'AG44vhmwygkes', 254, 'es', NULL),
(254, 'anacanadas', 'I8x.n5bWqoGpQ', 255, 'es', NULL),
(255, 'anacanadas', 'dlARv45rmiIWI', 256, 'es', NULL),
(256, 'anacanadas', 'vWcSAnY2eCXCI', 257, 'es', NULL),
(257, 'anacanadas', 'cdsPEWPKJr9dU', 258, 'es', NULL),
(258, 'anacanadas', 'WkEeZnmk0uN0g', 259, 'es', NULL),
(259, 'anacanadas', 'pUQWdzxfqlAW2', 260, 'es', NULL),
(260, 'anacanadas', '7jdRlut5Hl..E', 261, 'es', NULL),
(261, 'anacanadas', 'yFNNasNfJBKwc', 262, 'es', NULL),
(262, 'anacanadas', 'KbXfnS51ONYa.', 263, 'es', NULL),
(263, 'anacanadas', 'zMX2C5vZNwXQk', 264, 'es', NULL),
(264, 'anacanadas', 'lWmL4wkKn2CYU', 265, 'es', NULL),
(265, 'anacanadas', 'uFpTOkKZUSPHE', 266, 'es', NULL),
(266, 'anacanadas', 'Xq2QMBqhLVM66', 267, 'es', NULL),
(267, 'anacanadas', 'jl1Xqu6O25xLE', 268, 'es', NULL),
(268, 'anacanadas', 'jtQSYoi.o7Dvs', 269, 'es', NULL),
(269, 'anacanadas', 'NVLEZYucc3jzA', 270, 'es', NULL),
(270, 'anacanadas', 'IlcgMxHlaI93Q', 271, 'es', NULL),
(271, 'anacanadas', 'z54Sb3mKcLzm6', 272, 'es', NULL),
(272, 'anacanadas', 'HsDWJN6UBkIDQ', 273, 'es', NULL),
(273, 'anacanadas', 'ykr86pyMf9I1E', 274, 'es', NULL),
(274, 'anacanadas', 'YK01BVV2g84YI', 275, 'es', NULL),
(275, 'Melania', 'hQ2g5FSsueqCY', 276, 'es', NULL),
(276, 'Melania', 'e955B7..4.Gxo', 277, 'es', NULL),
(277, 'Melania', 'ezi5bZpZ8J1/I', 278, 'es', NULL),
(278, 'Melania', 'vHhH5hPaqTA5c', 279, 'es', NULL),
(279, 'Melania', 'JWFffI/wOkIbE', 280, 'es', NULL),
(280, 'Melania', 'FFj/6gX7VdU6.', 281, 'es', NULL),
(281, 'Melania', '0PGTT.qBLB0s6', 282, 'es', NULL),
(282, 'Melania', 'CRIXRE9soKUgY', 283, 'es', NULL),
(283, 'Melania', 'U4J08R4d74swA', 284, 'es', NULL),
(284, 'Melania', '6TRfNKGnI.VYg', 285, 'es', NULL),
(285, 'Melania', '02dOfC3TZUyJU', 286, 'es', NULL),
(286, 'Melania', '0EkaiSoJUa3O.', 287, 'es', NULL),
(287, 'Melania', 'cBBVmVZnb.ofg', 288, 'es', NULL),
(288, 'Melania', 'hhBXl.cC5UY.k', 289, 'es', NULL),
(289, 'Melania', 'Athr.q0nmgJWM', 290, 'es', NULL),
(290, 'Melania', 'xZADxa8VF8fic', 291, 'es', NULL),
(291, 'Melania', 'eERQkaT15Rvlg', 292, 'es', NULL),
(292, 'May', 'y9afLUotcbGqg', 293, 'es', NULL),
(293, 'May', 'xOn/loH2cUris', 294, 'es', NULL),
(294, 'May', 'LGP6hXDkMhig6', 295, 'es', NULL),
(295, 'May', 'VfEvxVeA/h1bw', 296, 'es', NULL),
(296, 'May', 'LaIPvxnBKVO82', 297, 'es', NULL),
(297, 'May', 'rb6SdpLJdCVRg', 298, 'es', NULL),
(298, 'May', '09F/zDmCySnlg', 299, 'es', NULL),
(299, 'May', '/jUjImNkZoK/.', 300, 'es', NULL),
(300, 'May', '3Hro7ZnlRyKss', 301, 'es', NULL),
(301, 'May', 'oO3uVRxRGmDa2', 302, 'es', NULL),
(302, 'May', 'tYY2q5uFq7Yvg', 303, 'es', NULL),
(303, 'May', 'PEnhqbsnyoEgk', 304, 'es', NULL),
(304, 'May', 'ZlZBHrMpo0RZA', 305, 'es', NULL),
(305, 'May', 'q+0kBs20R67l2', 306, 'es', NULL),
(306, 'May', 'EbTfo89dSiXG.', 307, 'es', NULL),
(307, 'May', 'Og4A8MXeUH73.', 308, 'es', NULL),
(308, 'May', 'DOJvnla6MuUzU', 309, 'es', NULL),
(309, 'May', 'A0p7CWg56xfbQ', 310, 'es', NULL),
(310, 'May', '/95LzCirwh1ww', 311, 'es', NULL),
(311, 'May', 'bm22mzNiiyang', 312, 'es', NULL),
(312, 'May', '3dWgupy7R9n6Q', 313, 'es', NULL),
(313, 'May', 'cm11YZZlkmBXA', 314, 'es', NULL),
(314, 'May', '0io83q/moqVBk', 315, 'es', NULL),
(315, 'May', 'xSJXFcGq.H0eo', 316, 'es', NULL),
(316, 'May123', 'mWc8Aor7hBF1.', 317, 'es', NULL),
(317, 'May123', '6BAKMjI.IOui.', 318, 'es', NULL),
(318, 'May123', 'pK72dM91GSdR6', 319, 'es', NULL),
(319, 'May123', 'OTAE.SN8KLIOA', 320, 'es', NULL),
(320, 'May123', 'DgQIjrWgK/9SY', 321, 'es', NULL),
(321, 'May123', '+Lc97eh678oEI', 322, 'es', NULL),
(322, 'May123', 'b4ZRvcLnlYRx2', 323, 'es', NULL),
(323, 'May123', 'GIL/KC4GWyZ4w', 324, 'es', NULL),
(324, 'May', 'R3.6vbO4OG3U2', 325, 'es', NULL),
(325, 'May', 'jsN5oPninAx86', 326, 'es', NULL),
(326, 'May123', 'H8QjJeYrfvDZo', 327, 'es', NULL),
(327, 'May123', 'AvlKb9Pr5Vch6', 328, 'es', NULL),
(328, 'May123', '+KUw2dlw0PSAs', 329, 'es', NULL),
(329, 'May123', '1zYIwTMAP/QtQ', 330, 'es', NULL),
(330, 'May123', 'ZuczW792SAKW.', 331, 'es', NULL),
(331, 'May123', 'nZlXbC3zarUEg', 332, 'es', NULL),
(332, 'May123', 'CXRbisvGJXD6U', 333, 'es', NULL),
(333, 'May123', 'Jm3qLfKROB3sc', 334, 'es', NULL),
(334, 'May123', '2POG8NFSTWF4Y', 335, 'es', NULL),
(335, 'May123', 'hkYjW1M0HrFn2', 336, 'es', NULL),
(336, 'anacanadas', 'm4OFjfIanonU2', 337, 'es', NULL),
(337, 'anacanadas', 'jestDMB0j7JKc', 338, 'es', NULL),
(338, 'anacanadas', 'A5VeUFJTzMfLo', 339, 'es', NULL),
(339, 'anacanadas', 's3FTgnnqqLafM', 340, 'es', NULL),
(340, 'anacanadas', 'cRFIO4P/4n5qc', 341, 'es', NULL),
(341, 'anacanadas', 'MwGTN4dxd1FNM', 342, 'es', NULL),
(342, 'anacanadas', '2IIW6eu/Yv5mQ', 343, 'es', NULL),
(343, 'anacanadas', 'f7DALojr9fvhY', 344, 'es', NULL),
(344, 'anacanadas', 'OCgvU..yRkxcE', 345, 'es', NULL),
(345, 'anacanadas', 'anN4OCV/NmArY', 346, 'es', NULL),
(346, 'anacanadas', 'HXUaKMb3aKBeU', 347, 'es', NULL),
(347, 'anacanadas', 'e+2KZZPEfZY0A', 348, 'es', NULL),
(348, 'anacanadas', 'uu25rBKjUr1nU', 349, 'es', NULL),
(349, 'anacanadas', 'UscN8ECQ6Z8kI', 350, 'es', NULL),
(350, 'jasonhmorel', 'T3gDry0p1YCnM', 351, 'es', NULL),
(351, 'jasonhmorel', 'HcTtM41B29LoA', 352, 'es', NULL),
(352, 'jasonhmorel', 'Ks3aIOp9tzkgY', 353, 'es', NULL),
(353, 'jasonhmorel', 'pqETjtCFhIQRA', 354, 'es', NULL),
(354, 'jasonhmorel', 'zPj549rmpuGiE', 355, 'es', NULL),
(355, 'jasonmorel', 'rZb0oIT8wYENw', 356, 'es', NULL),
(356, 'jasonmorel', 'l5iX50taR.lBk', 357, 'es', NULL),
(357, 'jasonmorel', 'ctYCtFYGYlAb.', 358, 'es', NULL),
(358, 'jasonmorel', 'W3c8Nfd8TjaMw', 359, 'es', NULL),
(359, 'jasonmorel', 'el4ZoTn4MT1nI', 360, 'es', NULL),
(360, 'jasonmorel', 'KxMDUooJe6JEU', 361, 'es', NULL),
(361, 'jasonmorel', 'PcxH6mfd57baI', 362, 'es', NULL),
(362, 'jasonmorel', 'A+misHJ7f2Hxw', 363, 'es', NULL),
(363, 'jasonmorel', 'fv3UutrGzjnig', 364, 'es', NULL),
(364, 'jasonmorel', 'RSslwJlVzX28I', 365, 'es', NULL),
(365, 'jasonmorel', 'XAjjz/DOdJ.rI', 366, 'es', NULL),
(366, 'jasonmorel', '1xr4BFipMD1..', 367, 'es', NULL),
(367, 'jasonmorel', 'OJficprKRX/Oo', 368, 'es', NULL),
(368, 'jasonmorel', '0FXJ6/Zh1AxFY', 369, 'es', NULL),
(369, 'jasonmorel', 'Fr8zybD3M0p5Q', 370, 'es', NULL),
(370, 'Ana', 'unyHiT1xKR/Sw', 371, 'es', NULL),
(371, 'Ana', 'PJUnkhd7iTNf6', 372, 'es', NULL),
(372, 'Ana', 'd5cvpTjEL1FZs', 373, 'es', NULL),
(373, 'Ana', 'nHgD7bx9PY81w', 374, 'es', NULL),
(374, 'Ana', 'C7lUVz3lJL9j2', 375, 'es', NULL),
(375, 'Ana', 'g/yDTGtFvU29I', 376, 'es', NULL),
(376, 'Ana', 'b7flYyLS8mvWI', 377, 'es', NULL),
(377, 'Ana', 'vlsn09Coa7kRk', 378, 'es', NULL),
(378, 'Ana', 'OfaA.AyLOFz6M', 379, 'es', NULL),
(379, 'Ana', 'y1emcQIfIsyjA', 380, 'es', NULL),
(380, 'Ana', 'uYYexACuYJjWA', 381, 'es', NULL),
(381, 'Ana', 'nlybHc6qK5BNM', 382, 'es', NULL),
(382, 'Ana', '/Kud9oUh3W7hU', 383, 'es', NULL),
(383, 'Ana', 'l8UggEGYH9jFY', 384, 'es', NULL),
(384, 'Ana', 'pmUJA0RRGEYlA', 385, 'es', NULL),
(385, 'Ana', 'Wecd/Mbt7O.dU', 386, 'es', NULL),
(386, 'Ana', 'LTURvwTpK7UGg', 387, 'es', NULL),
(387, 'Ana', 'rDcu1fffAI.pU', 388, 'es', NULL),
(388, 'Ana', '7SI.j5pR04FdU', 389, 'es', NULL),
(389, 'sScmqoOc3q', 'V9//pxRfDkIXs', 390, 'es', NULL),
(390, 'alexajr', '6+XV9wQAAMAEI', 391, 'es', NULL),
(391, 'alexajr', 'LJ1nCyxyQoASk', 392, 'es', NULL),
(392, 'alexajr', '9kjyJei2uprK6', 393, 'es', NULL),
(393, 'alexajr', 'u7Oa0/Kshm2fU', 394, 'es', NULL),
(394, 'alexajr', 'c7aztKkBj/8lE', 395, 'es', NULL),
(395, 'alexajr', 'H0yvxInY9uv3Q', 396, 'es', NULL),
(396, 'alexajr', '220Wotahzg8yA', 397, 'es', NULL),
(397, 'alexajr', '8bGVvirEuHxyc', 398, 'es', NULL),
(398, 'alexajr', 'sGOUycANQ6Fk6', 399, 'es', NULL),
(399, 'alexajr', 'ak/waWvA3bDSc', 400, 'es', NULL),
(400, 'alexajr', 'm2Uzqv1dUlGNw', 401, 'es', NULL),
(401, 'alexajr', 'auM2IMhxrbsr6', 402, 'es', NULL),
(402, 'alexajr', 'FyXZNOtSgN8EA', 403, 'es', NULL),
(403, 'alexajr', 'SWLnf3jNh8TVs', 404, 'es', NULL),
(404, 'alexajr', 'd5a/obL0mnnTk', 405, 'es', NULL),
(405, 'alexajr', 'AOIiPoH4gZDKI', 406, 'es', NULL),
(406, 'alexajr', 'I76mft8dTTuvc', 407, 'es', NULL),
(407, 'alexajr', 'ZYFnVO0fahJME', 408, 'es', NULL),
(408, 'alexajr', 'KVrdS2D7nYykc', 409, 'es', NULL),
(409, 'alexajr', 'kxMGhUNSupUz.', 410, 'es', NULL),
(410, 'alexajr', 'eSQAl0VLbG2tc', 411, 'es', NULL),
(411, 'alexajr', 'OSb7.RRaAeFtY', 412, 'es', NULL),
(412, 'alexajr', 'OHW2yRNpJco4E', 413, 'es', NULL),
(413, 'alexajr', 'rKgq9uJigcCQo', 414, 'es', NULL),
(414, 'alexajr', 'kbp0r85wcmT/s', 415, 'es', NULL),
(415, 'alexajr', 'Bew5tIyaTR8CY', 416, 'es', NULL),
(416, 'alexajr', '38qDwOmptznJ6', 417, 'es', NULL),
(417, 'alexajr', '5s1h0F82x2ZjQ', 418, 'es', NULL),
(418, 'alexajr', 'Q7xTCu3z8VPBM', 419, 'es', NULL),
(419, 'alexajr', 'gCUhERgiymtH.', 420, 'es', NULL),
(420, 'alexajr', '8GfR.etlvGjqA', 421, 'es', NULL),
(421, 'alexajr', 'mJHBFj6hC2dj.', 422, 'es', NULL),
(422, 'alexajr', 'JpENQ7vx2DfF2', 423, 'es', NULL),
(423, 'alexajr', 'uRltj810pMbKU', 424, 'es', NULL),
(424, 'alexajr', '8e0SKDerTCu46', 425, 'es', NULL),
(425, 'alexajr', 'DX6iSOOBXW3M.', 426, 'es', NULL),
(426, 'alexajr', 'RjEOARenqVoPY', 427, 'es', NULL),
(427, 'alexajr', 'AL/ygxRfG5LL2', 428, 'es', NULL),
(428, 'alexajr', 'Nkigh.Kjdcu.I', 429, 'es', NULL),
(429, 'jeymeejr07', 'NY07rPw5797NU', 430, 'es', NULL),
(430, 'jasnhmorel2', 'asXpvRhPlAwBo', 431, 'es', NULL),
(431, 'jeymeejr07', '0oRPR5I0J3cmI', 432, 'es', NULL),
(432, 'jeymeejr07', 'ufhPk/NuXV9IQ', 433, 'es', NULL),
(433, 'jeymeejr07', 'gco1AKTKMNLFU', 434, 'es', NULL),
(434, 'jeymeejr07', '78rSMYS5kawQ.', 435, 'es', NULL),
(435, 'jeymeejr07', 'hJsz2CyfdZcmw', 436, 'es', NULL),
(436, 'jeymeejr07', 'yJb5hglaxg7lw', 437, 'es', NULL),
(437, 'jeymeejr07', 'VkydGkM029EFc', 438, 'es', NULL),
(438, 'jeymeejr07', 'yH0faP0iPCwR2', 439, 'es', NULL),
(439, 'jeymeejr07', '8OCvUhfUR469w', 440, 'es', NULL),
(440, 'jeymeejr07', 'tcwvRYfHKyxPI', 441, 'es', NULL),
(441, 'jeymeejr07', 'ry9MsXUIGx8G2', 442, 'es', NULL),
(442, 'jeymeejr07', 'k1VJq7RyIZIO.', 443, 'es', NULL),
(443, 'jeymeejr07', 'pdwXHcDs7Joh2', 444, 'es', NULL),
(444, 'jeymeejr07', '10itzoCDMZaH.', 445, 'es', NULL),
(445, 'jeymeejr07', 'vuav0VPf.PkmQ', 446, 'es', NULL),
(446, 'jeymeejr07', '0dU4ZhBMQdDQU', 447, 'es', NULL),
(447, 'jeymeejr07', 'I1fNSgNa0j/o6', 448, 'es', NULL),
(448, 'jeymeejr07', '0oRPR5I0J3cmI', 449, 'es', NULL),
(449, 'jeymeejr07', 'MkdyOGm7z4xTk', 450, 'es', NULL),
(450, 'jeymeejr07', 'eKFAs/zTizWlE', 451, 'es', NULL),
(451, 'jeymeejr07', 'mWJCqTtbzy07.', 452, 'es', NULL),
(452, 'jeymeejr07', 'skgrTej/V9aUo', 453, 'es', NULL),
(453, 'jeymeejr07', 'mjMZ7V51kbSTc', 454, 'es', NULL),
(454, 'jeymeejr07', '0P0z592lDFihM', 455, 'es', NULL),
(455, 'jeymeejr07', 'dpxfCzLvGKN4U', 456, 'es', NULL),
(456, 'jeymeejr07', 'W9lP/zGMwsCFg', 457, 'es', NULL),
(457, 'jeymeejr07', 'Q0Xx6dM5H912s', 458, 'es', NULL),
(458, 'jeymeejr07', 'LFdqR.gLD2Gr.', 459, 'es', NULL),
(459, 'jeymeejr07', 'HvEQugGjXWoCs', 460, 'es', NULL),
(460, 'jeymeejr07', 'ZQhayioFOLxnY', 461, 'es', NULL),
(461, 'jeymeejr07', 'aUaLllCjBr0WU', 462, 'es', NULL),
(462, 'jeymeejr07', '0XkJW8HLOZ.NA', 463, 'es', NULL),
(463, 'jeymeejr07', 'VNTC.FiWJoiN6', 464, 'es', NULL),
(464, 'jeymeejr07', 'AYX8dgLK1wRHo', 465, 'es', NULL),
(465, 'jeymeejr07', 'KDUQDiCKFS7WM', 466, 'es', NULL),
(466, 'jeymeejr07', 'E5L5fUAwksFsY', 467, 'es', NULL),
(467, 'jeymeejr07', 'rnpj6YjO2UQpI', 468, 'es', NULL),
(468, 'jeymeejr07', 'bsBOkiRFjG8Qc', 469, 'es', NULL),
(469, 'jeymeejr07', 'FVh1p5pw/atic', 470, 'es', NULL),
(470, 'jeymeejr07', 'S0C2AsbEXvCsc', 471, 'es', NULL),
(471, 'jeymeejr07', 'Z1zRs6ShGKo9U', 472, 'es', NULL),
(472, 'jeymeejr07', 'H4jER/Si3TCsY', 473, 'es', NULL),
(473, 'jeymeejr07', 'nabUpJFBRAqRc', 474, 'es', NULL),
(474, 'jeymeejr07', 'cFVf8aTYSfJjM', 475, 'es', NULL),
(475, 'jeymeejr07', 'dg6Cdkxr8.cJ2', 476, 'es', NULL),
(476, 'jeymeejr07', 'ipWE53qYKOppw', 477, 'es', NULL),
(477, 'jeymeejr07', 'BK6R6/M5hHAH6', 478, 'es', NULL),
(478, 'jeymeejr07', 'T4WJl4mR9gVPk', 479, 'es', NULL),
(479, 'jeymeejr07', 'oQ6zGWKgRkhJ6', 480, 'es', NULL),
(480, 'jeymeejr07', 'VCLOZix/gMGbc', 481, 'es', NULL),
(481, 'jeymeejr07', 'UJDXkZ6QNIbZU', 482, 'es', NULL),
(482, 'jeymeejr07', '1AARRvWmOKfWM', 483, 'es', NULL),
(483, 'jeymeejr07', 'MEOtgYnmiF3pw', 484, 'es', NULL),
(484, 'jeymeejr07', 'I1fNSgNa0j/o6', 485, 'es', NULL),
(485, 'jeymeejr07', 'DuE.8udmftsuo', 486, 'es', NULL),
(486, 'jeymeejr07', 'Uw41fDPCMwvj2', 487, 'es', NULL),
(487, 'jeymeejr07', 'trkXVHB8exI0o', 488, 'es', NULL),
(488, 'jeymeejr07', 'mAsmYyUQBgePk', 489, 'es', NULL),
(489, 'jeymeejr07', 'LuXL7oRv.82QQ', 490, 'es', NULL),
(490, 'jeymeejr07', 'brauSpMcqtotA', 491, 'es', NULL),
(491, 'jeymeejr07', 'umRNEH2eOhcgo', 492, 'es', NULL),
(492, 'jeymeejr07', '9vPg9GxSjvado', 493, 'es', NULL),
(493, 'jeymeejr07', 'umRNEH2eOhcgo', 494, 'es', NULL),
(494, 'jeymeejr07', 'z7lIA6/QInioo', 495, 'es', NULL),
(495, 'jeymeejr07', 'PvfSnyCgc/jJ.', 496, 'es', NULL),
(496, 'jeymeejr07', 'ix./UqURsp2hI', 497, 'es', NULL),
(497, 'jeymeejr07', '/K702Yo68gRAE', 498, 'es', NULL),
(498, 'jeymeejr07', 'v8Gdd1I/00s56', 499, 'es', NULL),
(499, 'jeymeejr07', 'dJsI8zTh3M3I.', 500, 'es', NULL),
(500, 'jeymeejr07', 'OTyGxaprXsDWc', 501, 'es', NULL),
(501, 'jeymeejr07', 'A5Ln8UaOBeqjY', 502, 'es', NULL),
(502, 'jeymeejr07', 'TTQzMiRxHkOV6', 503, 'es', NULL),
(503, 'jeymeejr07', '98uwk8UfOOxKc', 504, 'es', NULL),
(504, 'jeymeejr07', 'm6qED/.UuHaiI', 505, 'es', NULL),
(505, 'jeymeejr07', 'VLJ0znuZ.PxkU', 506, 'es', NULL),
(506, 'jeymeejr07', 'DD4R/a730hGW.', 507, 'es', NULL),
(507, 'jeymeejr07', 'NcQPaJL5jTVes', 508, 'es', NULL),
(508, 'jeymeejr07', '5cuP51D/5chdY', 509, 'es', NULL),
(509, 'jeymeejr07', 'B49kBUshWDeeg', 510, 'es', NULL),
(510, 'jeymeejr07', 'dmTtp66CusMyI', 511, 'es', NULL),
(511, 'jeymeejr07', 'v0TEq6Kb6oGfc', 512, 'es', NULL),
(512, 'jeymeejr07', 'INKapMg8rmY8U', 513, 'es', NULL),
(513, 'jeymeejr07', 'RFcpxBygWXsag', 514, 'es', NULL),
(514, 'jeymeejr07', 'rXp5qc3GzbSB.', 515, 'es', NULL),
(515, 'jeymeejr07', 'WbshvkMQZGpho', 516, 'es', NULL),
(516, 'jeymeejr07', '74EMbmSeuL3Ic', 517, 'es', NULL),
(517, 'jeymeejr07', '4E5NIOwx2LSyM', 518, 'es', NULL),
(518, 'jeymeejr07', 'FXmBdNTlHr7Ak', 519, 'es', NULL),
(519, 'jeymeejr07', 'Wj.nmmXc/1axo', 520, 'es', NULL),
(520, 'jeymeejr07', '0jaA/mYFkS17k', 521, 'es', NULL),
(521, 'jeymeejr07', 'ZQhayioFOLxnY', 522, 'es', NULL),
(522, 'jeymeejr07', 'beVRXYx2.wN1A', 523, 'es', NULL),
(523, 'jeymeejr07', '3uLXB1Ykvoa6o', 524, 'es', NULL),
(524, 'jeymeejr07', 'f9YoDPCvYh2Bw', 525, 'es', NULL),
(525, 'jeymeejr07', 'Z5Xls9x5cHh8M', 526, 'es', NULL),
(526, 'jeymeejr07', 'rqMr/OGbXEFDs', 527, 'es', NULL),
(527, 'jeymeejr07', 'pRKmUwbdDwUJQ', 528, 'es', NULL),
(528, 'jeymeejr07', 'PV67R80cIAoqs', 529, 'es', NULL),
(529, 'jeymeejr07', 'sRbt.IuutcIHc', 530, 'es', NULL),
(530, 'jeymeejr07', 'mdvIaXUOgnl2E', 531, 'es', NULL),
(531, 'jeymeejr07', '+q2Uhf7OVTcAc', 532, 'es', NULL),
(532, 'jeymeejr07', 'PmvNRhVgxOisI', 533, 'es', NULL),
(533, 'jeymeejr07', 'h4ojGuFFjDoUQ', 534, 'es', NULL),
(534, 'jeymeejr07', 'hMNT35.RPtRqc', 535, 'es', NULL),
(535, 'jeymeejr07', 'BWO6I1792nhvE', 536, 'es', NULL),
(536, 'jeymeejr07', '5U9StdDf.oGH2', 537, 'es', NULL),
(537, 'jeymeejr07', 'THboSGwS.hWlc', 538, 'es', NULL),
(538, 'jeymeejr07', '/coxzzgZ7/3f.', 539, 'es', NULL),
(539, 'jeymeejr07', 'M7Hr799qwgVIc', 540, 'es', NULL),
(540, 'jeymeejr07', 'Z62vG4n1Mm1O2', 541, 'es', NULL),
(541, 'jeymeejr07', 'fTaDuGxTn6DU.', 542, 'es', NULL),
(542, 'jeymeejr07', 'ZF8K6ULO/WNTw', 543, 'es', NULL),
(543, 'jeymeejr07', 'Mcy.7WCWPjy8Q', 544, 'es', NULL),
(544, 'jeymeejr07', 'J82iyUAsrz0e.', 545, 'es', NULL),
(545, 'jeymeejr07', '3W4G.oUIxQ2LE', 546, 'es', NULL),
(546, 'jeymeejr07', '9AKn2ZkGF3zdI', 547, 'es', NULL),
(547, 'jeymeejr07', '2LUVsuhXtUEIc', 548, 'es', NULL),
(548, 'jeymeejr07', '0vrR01FOz.vqg', 549, 'es', NULL),
(549, 'jeymeejr07', 'Zi4MF6tuYi5bY', 550, 'es', NULL),
(550, 'jeymeejr07', '/7DKDqCko9Miw', 551, 'es', NULL),
(551, 'jeymeejr07', 'niUbYwk/8ZBLk', 552, 'es', NULL),
(552, 'jeymeejr07', 'pZp1MemnvFh/M', 553, 'es', NULL),
(553, 'jeymeejr07', 'hMNT35.RPtRqc', 554, 'es', NULL),
(554, 'jeymeejr07', 'vIvMaEovg//pE', 555, 'es', NULL),
(555, 'jeymeejr07', 'TeViEJY3UyQAw', 556, 'es', NULL),
(556, 'jeymeejr07', 'z1Z8hraKPxfOY', 557, 'es', NULL),
(557, 'jeymeejr07', 'gRfQ1phcO/hdE', 558, 'es', NULL),
(558, 'jeymeejr07', 'W/Xyo4221iSeM', 559, 'es', NULL),
(559, 'jeymeejr07', 'Zb/GXyyfTa8cc', 560, 'es', NULL),
(560, 'jeymeejr07', '/VoukPOm6kvx.', 561, 'es', NULL),
(561, 'jeymeejr07', 'KMtwmixAc3MRc', 562, 'es', NULL),
(562, 'jeymeejr07', 'kjv3Nz4iK.gNc', 563, 'es', NULL),
(563, 'jeymeejr07', 'P1DdpuB9vXbW6', 564, 'es', NULL),
(564, 'jeymeejr07', 'fluYpJSH4sOh6', 565, 'es', NULL),
(565, 'jeymeejr07', '5NhKZbJJPbztk', 566, 'es', NULL),
(566, 'jeymeejr07', 'CQ3BInWZpsXxE', 567, 'es', NULL),
(567, 'jeymeejr07', '7dAPgdlZ/yvBo', 568, 'es', NULL),
(568, 'jeymeejr07', '0WV1xP3MQ8ROM', 569, 'es', NULL),
(569, 'jeymeejr07', 'h/LJVEPfbgXlo', 570, 'es', NULL),
(570, 'jeymeejr07', '4Rc4t9/L9IpLo', 571, 'es', NULL),
(571, 'jeymeejr07', 'LXrjpwJpmd5TE', 572, 'es', NULL),
(572, 'jeymeejr07', 'M7Hr799qwgVIc', 573, 'es', NULL),
(573, 'jeymeejr07', 'z+6goHihlgMe.', 574, 'es', NULL),
(574, 'jeymeejr07', 'zn8mTE8cBhYA6', 575, 'es', NULL),
(575, 'jeymeejr07', 'Wnhhjh4ujQc3U', 576, 'es', NULL),
(576, 'jeymeejr07', 'B13lWRw4vtO4M', 577, 'es', NULL),
(577, 'jeymeejr07', 'qNjTUZE8bMQ1A', 578, 'es', NULL),
(578, 'jeymeejr07', 'dmTtp66CusMyI', 579, 'es', NULL),
(579, 'jeymeejr07', 'AfTogUbqGySSo', 580, 'es', NULL),
(580, 'jeymeejr07', 'D7H91WB/jjaCU', 581, 'es', NULL),
(581, 'jeymeejr07', 'MRwQ44bJhooPY', 582, 'es', NULL),
(582, 'jeymeejr07', 'VpLOSKQjo2O0I', 583, 'es', NULL),
(583, 'jeymeejr07', 'JHo/MjHQfX4As', 584, 'es', NULL),
(584, 'jeymeejr07', 'u0ETJ/dMlHXfg', 585, 'es', NULL),
(585, 'jeymeejr07', 'IyG5Lx8W7FHKc', 586, 'es', NULL),
(586, 'jeymeejr07', '82IZ0cIo8.w2g', 587, 'es', NULL),
(587, 'jeymeejr07', '68AmUHb5VbfVE', 588, 'es', NULL),
(588, 'jeymeejr07', 'iER6JPQsNYoUM', 589, 'es', NULL),
(589, 'jeymeejr07', 'OsGuEqjg/4u1E', 590, 'es', NULL),
(590, '0T7BeDkSbx', '36hA5wYC/TOSI', 591, 'es', NULL),
(591, 'kaffati.alejandro', 'yRJuKTt.1L7Vk', 592, 'es', NULL),
(592, 'kaffati.alejandro', 'hwc/U1erYtD5c', 593, 'es', NULL),
(593, 'kaffati.alejandro', 'GCrjskX6GbnoI', 594, 'es', NULL),
(594, 'kaffati.alejandro', 'Of812pGlffXZ6', 595, 'es', NULL),
(595, 'kaffati.alejandro', 'Zb7N3dpodpWXQ', 596, 'es', NULL),
(596, 'kaffati.alejandro', 'UdkzybviOy8vs', 597, 'es', NULL),
(597, 'kaffati.alejandro', 'E2fuEe4LkF8Yc', 598, 'es', NULL),
(598, 'kaffati.alejandro', '75.PvsBLHnLlA', 599, 'es', NULL),
(599, 'kaffati.alejandro', 'z9utOxqLiiCIk', 600, 'es', NULL),
(600, 'kaffati.alejandro', 'AFt7SeDE8c44Q', 601, 'es', NULL),
(601, 'kaffati.alejandro', '15ylezyCdtZgY', 602, 'es', NULL),
(602, 'kaffati.alejandro', 'mt8M7R3hGM/WM', 603, 'es', NULL),
(603, 'kaffati.alejandro', 'fZC14vL8B3nv.', 604, 'es', NULL),
(604, 'kaffati.alejandro', 'UckVTqnFCB1yw', 605, 'es', NULL),
(605, 'kaffati.alejandro', 'seSecDWMEpl6Y', 606, 'es', NULL),
(606, 'kaffati.alejandro', 'hexHr9iefga2k', 607, 'es', NULL),
(607, 'kaffati.alejandro', 'kXNF5gT2A.PKE', 608, 'es', NULL),
(608, 'kaffati.alejandro', 'HckyNvQqPhtzo', 609, 'es', NULL),
(609, 'kaffati.alejandro', 'k6ThfYIhEHxko', 610, 'es', NULL),
(610, 'kaffati.alejandro', 'IQIACNSj1bDTo', 611, 'es', NULL),
(611, 'kaffati.alejandro', 'w9YDooUYzcVUY', 612, 'es', NULL),
(612, 'kaffati.alejandro', '6XYNPAkcXbWNI', 613, 'es', NULL),
(613, 'kaffati.alejandro', 'obStBx8BDY7T2', 614, 'es', NULL),
(614, 'kaffati.alejandro', '5ksZ1RU0VeqYc', 615, 'es', NULL),
(615, 'kaffati.alejandro', 'a3mfbTnCzEgnk', 616, 'es', NULL),
(616, 'kaffati.alejandro', 'OYEuHQM6eswK6', 617, 'es', NULL),
(617, 'Ceci.Cuellar', 'ip0DNdjojVo0A', 618, 'es', NULL),
(618, 'Ceci.Cuellar', 'D2b0kol2HtnG2', 619, 'es', NULL),
(619, 'Ceci.Cuellar', 'E7YLQRgK5Mltc', 620, 'es', NULL),
(620, 'Ceci.Cuellar', 'Vxux6zbh/6mS6', 621, 'es', NULL),
(621, 'Ceci.Cuellar', 'UGSZXGC1uMbGg', 622, 'es', NULL),
(622, 'Roger1997', '3T5MKAnwHBlO2', 623, 'es', NULL),
(623, 'Belky Mendoza', '4nnfvX2TiBPfs', 624, 'es', NULL),
(624, 'Belky Mendoza', 'XVo9NfIyIcyGE', 625, 'es', NULL),
(625, 'Belky Mendoza', 'ONjq9CfFZ.Be6', 626, 'es', NULL),
(626, 'Belky Mendoza', 'ypa7JidECyKus', 627, 'es', NULL),
(627, 'Belky Mendoza', 'L+dY1AxfJaR62', 628, 'es', NULL),
(628, 'Belky Mendoza', 'C6heNYUulfXuk', 629, 'es', NULL),
(629, 'Belky Mendoza', 'p2npfUuUTzHNA', 630, 'es', NULL),
(630, 'Belky Mendoza', 'itrE7UFUfXSEc', 631, 'es', NULL),
(631, 'Belky Mendoza', '6i0pONGkaOtHA', 632, 'es', NULL),
(632, 'Belky Mendoza', 'BLciQk0yxwQ4Y', 633, 'es', NULL),
(633, 'Belky Mendoza', '0ywq17XMOebDA', 634, 'es', NULL),
(634, 'Belky Mendoza', 'NulsGth5cP/8Q', 635, 'es', NULL),
(635, 'Belky Mendoza', 'U/fbo08EViOk2', 636, 'es', NULL),
(636, 'Belky Mendoza', 'i5keqwhFmiZfE', 637, 'es', NULL),
(637, 'Belky Mendoza', 'hnUA8l4FiyuJc', 638, 'es', NULL),
(638, 'Belky Mendoza', '7HPlRdAnQnqCE', 639, 'es', NULL),
(639, 'Belky Mendoza', 'HAU6RcZsEw5C6', 640, 'es', NULL),
(640, 'Belky Mendoza', 'D/LK5.mzzNqlA', 641, 'es', NULL),
(641, 'Belky Mendoza', 'g0yuErRIProcY', 642, 'es', NULL),
(642, 'Belky Mendoza', 'pwL5N2OSatmAs', 643, 'es', NULL),
(643, 'Belky Mendoza', 'Ay.1w.TEz8Ay2', 644, 'es', NULL),
(644, 'Belky Mendoza', 'KxRbt06ycKkcg', 645, 'es', NULL),
(645, 'Belky Mendoza', 'c/by.RvrhEPJo', 646, 'es', NULL),
(646, 'Belky Mendoza', 'hjRWukrfAVzOo', 647, 'es', NULL),
(647, 'Belky Mendoza', '6TtxDAotthB4w', 648, 'es', NULL),
(648, 'Belky Mendoza', 'CImCqVuMIRdFk', 649, 'es', NULL),
(649, 'Belky Mendoza', 'fPmmLlpSvKzZg', 650, 'es', NULL),
(650, 'Belky Mendoza', 'tZu4gH.RK.4U2', 651, 'es', NULL),
(651, 'Belky Mendoza', 'fy2M/UlNVGNqE', 652, 'es', NULL),
(652, 'Belky Mendoza', 'zXzb.7O1ol/dk', 653, 'es', NULL),
(653, 'Belky Mendoza', 'bErT/mReYr.QA', 654, 'es', NULL),
(654, 'Belky Mendoza', 'e8cC7F7kJLKjw', 655, 'es', NULL),
(655, 'Belky Mendoza', 'p40hv/jvfi6P.', 656, 'es', NULL),
(656, 'Belky Mendoza', '7AVPbYUUGwVho', 657, 'es', NULL),
(657, 'Belky Mendoza', 'T726nQF4ASjjQ', 658, 'es', NULL),
(658, 'Belky Mendoza', 'Q3UGww5nzGb/o', 659, 'es', NULL),
(659, 'Belky Mendoza', 'fGTT6TymfRTFc', 660, 'es', NULL),
(660, 'Belky Mendoza', '4cieBs6Lzfuug', 661, 'es', NULL),
(661, 'Belky Mendoza', 'ZLb08UsHqgh/s', 662, 'es', NULL),
(662, 'Belky Mendoza', 'OR7.mt.RMenDk', 663, 'es', NULL),
(663, 'Belky Mendoza', 'NsSSCBFp3VfoI', 664, 'es', NULL),
(664, 'Belky Mendoza', 'aYvQhN0kePQIo', 665, 'es', NULL),
(665, 'Belky Mendoza', 'aPTEAZCDxtVL2', 666, 'es', NULL),
(666, 'Belky Mendoza', 'kO/ZeVxkcK2iU', 667, 'es', NULL),
(667, 'Belky Mendoza', 'f7QqWbzLHJ.fs', 668, 'es', NULL),
(668, 'Belky Mendoza', 'jKbjd/dauRuhI', 669, 'es', NULL),
(669, 'Belky Mendoza', '+naydjDRLftoA', 670, 'es', NULL),
(670, 'Belky Mendoza', 'ypa7JidECyKus', 671, 'es', NULL),
(671, 'Belky Mendoza', 'XhBU5Jl4h/X6I', 672, 'es', NULL),
(672, 'Belky Mendoza', 'scRrA7qC4Nx4k', 673, 'es', NULL),
(673, 'Belky Mendoza', 'Qq1vIyOuKkyy.', 674, 'es', NULL),
(674, 'Belky Mendoza', 'BxRm67ZQk7d0I', 675, 'es', NULL),
(675, 'Belky Mendoza', 'kD/3.H5t7Wb9I', 676, 'es', NULL),
(676, 'Belky Mendoza', 'br/GRW/dKTQ1s', 677, 'es', NULL),
(677, 'Belky Mendoza', 'iW.inkFUzhbB2', 678, 'es', NULL),
(678, 'Belky Mendoza', 'xbiPcWgD982Jg', 679, 'es', NULL),
(679, 'Belky Mendoza', 'L1txDWT3OcBhI', 680, 'es', NULL),
(680, 'Belky Mendoza', 'LrtBqkS.19jLo', 681, 'es', NULL),
(681, 'Belky Mendoza', 'hFzttHPtxRe2Y', 682, 'es', NULL),
(682, 'Belky Mendoza', 'W1Ngk5bVZX3A2', 683, 'es', NULL),
(683, 'Belky Mendoza', 'fh1Dwv6i7lIwg', 684, 'es', NULL),
(684, 'Belky Mendoza', 'I0o6JdPRzbucE', 685, 'es', NULL),
(685, 'Belky Mendoza', 'NU/WVXwSqGSDU', 686, 'es', NULL),
(686, 'Belky Mendoza', 'UCijk.Y9owZgQ', 687, 'es', NULL),
(687, 'Belky Mendoza', 'XWYubQM1iGzbM', 688, 'es', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_actividad_congreso`
--

CREATE TABLE `tbl_usuario_actividad_congreso` (
  `id_usuario_fk` int(11) NOT NULL,
  `id_actividad_fk` int(11) NOT NULL,
  `id_congreso_fk` int(11) NOT NULL,
  `asistio` tinyint(1) DEFAULT NULL COMMENT 'Campo booleando que determina si un usuario asisitió o no a una actividad específica para un congreso dado.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 5, 1),
(5, 5, 6, 1),
(6, 6, 6, 1),
(7, 7, 6, 1),
(8, 8, 10, 1),
(11, 11, 10, 1),
(12, 12, 5, 1),
(13, 13, 5, 1),
(14, 14, 5, 1),
(15, 15, 10, 1),
(20, 20, 2, 1),
(21, 21, 3, 1),
(22, 22, 10, 1),
(25, 25, 3, 1),
(26, 26, 10, 1),
(27, 24, 10, 1),
(28, 27, 3, 1),
(29, 28, 3, 1),
(30, 29, 2, 1),
(31, 30, 10, 1),
(32, 31, 3, 1),
(33, 32, 2, 1),
(34, 33, 10, 1),
(35, 34, 10, 1),
(37, 36, 10, 1),
(39, 37, 3, 1),
(40, 38, 3, 1),
(41, 39, 3, 1),
(42, 40, 3, 1),
(43, 41, 3, 1),
(44, 42, 3, 1),
(45, 43, 3, 1),
(46, 44, 3, 1),
(47, 45, 3, 1),
(48, 46, 3, 1),
(49, 47, 10, 1),
(50, 48, 3, 1),
(51, 49, 3, 1),
(52, 23, 10, 1),
(53, 50, 10, 1),
(54, 51, 10, 1),
(55, 52, 10, 1),
(58, 55, 10, 1),
(59, 56, 10, 1),
(63, 60, 3, 1),
(64, 61, 10, 1),
(66, 63, 3, 1),
(67, 64, 10, 1),
(68, 65, 3, 1),
(70, 67, 10, 1),
(71, 54, 10, 1),
(72, 35, 10, 1),
(73, 53, 10, 1),
(74, 68, 2, 1),
(75, 8, 5, 1),
(76, 69, 10, 1),
(77, 70, 3, 1),
(78, 71, 10, 1),
(79, 72, 10, 1),
(80, 73, 4, 1),
(81, 74, 2, 1),
(82, 75, 3, 1),
(83, 76, 10, 1),
(84, 77, 10, 1),
(85, 78, 10, 1),
(86, 79, 10, 1),
(87, 80, 3, 1),
(88, 81, 2, 1),
(89, 82, 10, 1),
(90, 83, 10, 1),
(91, 84, 10, 1),
(92, 85, 10, 1),
(93, 86, 10, 1),
(94, 87, 2, 1),
(95, 88, 4, 1),
(96, 89, 2, 1),
(97, 90, 3, 1),
(98, 91, 10, 1),
(99, 92, 10, 1),
(100, 93, 10, 1),
(101, 94, 10, 1),
(102, 95, 4, 1),
(103, 96, 10, 1),
(104, 97, 10, 1),
(105, 98, 10, 1),
(106, 99, 10, 1),
(107, 100, 2, 1),
(108, 101, 3, 1),
(109, 102, 3, 1),
(110, 103, 10, 1),
(111, 104, 10, 1),
(112, 105, 10, 1),
(113, 106, 4, 1),
(114, 107, 4, 1),
(115, 108, 3, 1),
(116, 109, 3, 1),
(117, 110, 10, 1),
(118, 111, 10, 1),
(119, 112, 3, 1),
(120, 113, 3, 1),
(121, 114, 2, 1),
(122, 115, 2, 1),
(123, 116, 10, 1),
(124, 117, 10, 1),
(125, 118, 10, 1),
(126, 119, 3, 1),
(127, 120, 3, 1),
(128, 121, 10, 1),
(129, 122, 10, 1),
(130, 123, 2, 1),
(131, 124, 2, 1),
(132, 125, 10, 1),
(133, 126, 10, 1),
(134, 127, 10, 1),
(135, 128, 10, 1),
(136, 129, 3, 1),
(137, 130, 2, 1),
(138, 131, 10, 1),
(139, 132, 10, 1),
(140, 133, 2, 1),
(141, 134, 10, 1),
(142, 135, 10, 1),
(143, 136, 2, 1),
(144, 137, 4, 1),
(145, 138, 10, 1),
(146, 139, 10, 1),
(147, 140, 4, 1),
(148, 141, 2, 1),
(149, 142, 10, 1),
(150, 143, 10, 1),
(151, 144, 10, 1),
(152, 145, 2, 1),
(153, 146, 3, 1),
(154, 147, 2, 1),
(155, 148, 10, 1),
(156, 149, 10, 1),
(157, 150, 10, 1),
(158, 151, 2, 1),
(159, 152, 2, 1),
(160, 153, 10, 1),
(161, 154, 10, 1),
(162, 155, 10, 1),
(163, 156, 10, 1),
(164, 157, 10, 1),
(165, 158, 10, 1),
(166, 159, 10, 1),
(167, 160, 10, 1),
(168, 161, 10, 1),
(169, 162, 10, 1),
(170, 163, 2, 1),
(171, 164, 4, 1),
(172, 165, 4, 1),
(173, 166, 10, 1),
(174, 167, 10, 1),
(175, 168, 10, 1),
(176, 169, 10, 1),
(177, 170, 10, 1),
(178, 171, 3, 1),
(179, 172, 2, 1),
(180, 173, 2, 1),
(181, 174, 10, 1),
(182, 175, 10, 1),
(183, 176, 10, 1),
(184, 177, 10, 1),
(185, 178, 10, 1),
(186, 179, 2, 1),
(187, 180, 2, 1),
(188, 181, 10, 1),
(189, 182, 10, 1),
(190, 183, 2, 1),
(191, 184, 10, 1),
(192, 185, 10, 1),
(193, 186, 10, 1),
(194, 187, 10, 1),
(195, 188, 2, 1),
(196, 189, 2, 1),
(197, 190, 3, 1),
(198, 191, 3, 1),
(199, 192, 10, 1),
(200, 193, 10, 1),
(201, 194, 10, 1),
(202, 195, 10, 1),
(203, 196, 10, 1),
(204, 199, 2, 1),
(205, 200, 2, 1),
(206, 201, 2, 1),
(207, 202, 10, 1),
(208, 203, 10, 1),
(209, 204, 10, 1),
(210, 205, 10, 1),
(211, 206, 10, 1),
(212, 207, 10, 1),
(213, 208, 10, 1),
(214, 209, 10, 1),
(215, 210, 10, 1),
(216, 211, 10, 1),
(217, 212, 2, 1),
(218, 213, 10, 1),
(219, 214, 10, 1),
(220, 215, 10, 1),
(221, 216, 3, 1),
(222, 217, 2, 1),
(223, 218, 10, 1),
(224, 219, 3, 1),
(225, 220, 10, 1),
(226, 221, 10, 1),
(227, 222, 10, 1),
(228, 223, 10, 1),
(229, 224, 10, 1),
(230, 225, 10, 1),
(231, 226, 2, 1),
(232, 227, 10, 1),
(233, 228, 10, 1),
(234, 229, 2, 1),
(235, 230, 10, 1),
(236, 231, 10, 1),
(237, 198, 10, 1),
(238, 250, 0, 1),
(239, 251, 0, 1),
(240, 252, 0, 1),
(241, 590, 4, 1);

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
  `url_firma` mediumtext NOT NULL COMMENT 'Tabla en la que se almacenan las personan que firman un certificado con su respectiva dirección de la firma digital.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `expositor` tinyint(1) DEFAULT NULL COMMENT 'Campo booleano para saber si el usuario en cuestión es el expositor del trabajo.',
  `autoria` tinyint(1) NOT NULL,
  `autor_correspondencia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuario_trabajo`
--

INSERT INTO `tbl_usuario_trabajo` (`id_usuario_trabajo_pk`, `id_usuario_fk`, `id_trabajo_fk`, `subio`, `autor_principal`, `coautor`, `expositor`, `autoria`, `autor_correspondencia`) VALUES
(1, 11, 1, 1, 1, NULL, 1, 1, 1),
(2, 4, 2, 1, 1, NULL, 1, 1, 1),
(3, 11, 3, 1, NULL, 1, NULL, 1, 0),
(4, 11, 3, NULL, 1, NULL, NULL, 0, 1),
(5, 23, 3, NULL, NULL, 1, NULL, 0, 0),
(6, 24, 3, NULL, NULL, 1, NULL, 1, 0),
(7, 28, 4, 1, 1, NULL, 1, 1, 1),
(8, 30, 5, 1, 1, NULL, 1, 1, 1),
(9, 31, 6, 1, 1, NULL, 1, 1, 1),
(10, 29, 7, 1, 1, NULL, 1, 1, 1),
(17, 34, 10, 1, 1, NULL, 1, 1, 1),
(18, 3, 11, 1, 1, NULL, 1, 1, 1),
(19, 25, 12, 1, 1, NULL, 1, 1, 1),
(20, 37, 12, NULL, NULL, 1, NULL, 0, 0),
(21, 38, 12, NULL, NULL, 1, NULL, 0, 0),
(22, 39, 12, NULL, NULL, 1, NULL, 1, 0),
(23, 40, 12, NULL, NULL, 1, NULL, 0, 0),
(24, 41, 12, NULL, NULL, 1, NULL, 0, 0),
(25, 42, 12, NULL, NULL, 1, NULL, 0, 0),
(26, 43, 12, NULL, NULL, 1, NULL, 0, 0),
(27, 44, 12, NULL, NULL, 1, NULL, 1, 0),
(28, 45, 12, NULL, NULL, 1, NULL, 0, 0),
(29, 46, 12, NULL, NULL, 1, NULL, 0, 0),
(30, 25, 13, 1, 1, NULL, 1, 1, 1),
(31, 43, 13, NULL, NULL, 1, NULL, 0, 0),
(32, 42, 13, NULL, NULL, 1, NULL, 0, 0),
(33, 38, 13, NULL, NULL, 1, NULL, 0, 0),
(34, 39, 13, NULL, NULL, 1, NULL, 1, 0),
(35, 48, 13, NULL, NULL, 1, NULL, 0, 0),
(36, 44, 13, NULL, NULL, 1, NULL, 1, 0),
(37, 40, 13, NULL, NULL, 1, NULL, 0, 0),
(38, 41, 13, NULL, NULL, 1, NULL, 0, 0),
(39, 49, 13, NULL, NULL, 1, NULL, 0, 0),
(40, 37, 13, NULL, NULL, 1, NULL, 0, 0),
(41, 47, 14, 1, 1, NULL, 1, 1, 1),
(42, 23, 15, 1, 1, NULL, 1, 1, 1),
(43, 50, 16, 1, 1, NULL, 1, 1, 1),
(45, 50, 18, 1, 1, NULL, 1, 1, 1),
(47, 52, 20, 1, 1, NULL, 1, 1, 1),
(48, 3, 20, NULL, NULL, 1, NULL, 1, 0),
(49, 15, 20, NULL, NULL, 1, NULL, 1, 0),
(50, 53, 20, NULL, NULL, 1, NULL, 1, 0),
(51, 54, 20, NULL, NULL, 1, NULL, 1, 0),
(68, 36, 29, 1, NULL, 1, NULL, 1, 0),
(69, 36, 29, NULL, 1, NULL, NULL, 0, 1),
(70, 57, 29, NULL, NULL, 1, NULL, 0, 0),
(71, 26, 30, 1, 1, NULL, 1, 1, 1),
(72, 24, 30, NULL, NULL, 1, NULL, 1, 0),
(73, 24, 31, 1, 1, NULL, 1, 1, 1),
(74, 26, 31, NULL, NULL, 1, NULL, 0, 0),
(75, 60, 32, 1, 1, NULL, 1, 1, 1),
(77, 61, 34, 1, 1, NULL, 1, 1, 1),
(78, 32, 35, 1, 1, NULL, 1, 1, 1),
(80, 15, 37, 1, 1, NULL, 1, 1, 1),
(81, 52, 37, NULL, NULL, 1, NULL, 1, 0),
(82, 53, 37, NULL, NULL, 1, NULL, 1, 0),
(84, 64, 39, 1, 1, NULL, 1, 1, 1),
(85, 63, 40, 1, 1, NULL, 1, 1, 1),
(86, 35, 40, NULL, NULL, 1, NULL, 1, 0),
(87, 65, 40, NULL, NULL, 1, NULL, 0, 0),
(89, 61, 35, NULL, NULL, 1, NULL, 0, 1),
(90, 63, 35, NULL, NULL, 1, NULL, 0, 1),
(92, 67, 41, 1, 1, NULL, 1, 1, 1),
(93, 56, 42, 1, 1, NULL, 1, 1, 1),
(94, 61, 42, NULL, NULL, 1, NULL, 0, 0),
(96, 55, 43, 1, 1, NULL, 1, 1, 1),
(97, 27, 44, 1, 1, NULL, 1, 1, 1),
(98, 51, 45, 1, 1, NULL, 1, 1, 1),
(100, 33, 47, 1, 1, NULL, 1, 1, 1),
(101, 35, 47, NULL, NULL, 1, NULL, 1, 0),
(102, 52, 11, NULL, NULL, 1, NULL, 1, 0),
(103, 71, 48, 1, 1, NULL, 1, 1, 1),
(104, 72, 49, 1, 1, NULL, 1, 1, 1),
(105, 73, 49, NULL, NULL, 1, NULL, 0, 0),
(106, 75, 50, 1, 1, NULL, 1, 1, 1),
(107, 76, 50, NULL, NULL, 1, NULL, 1, 0),
(108, 77, 50, NULL, NULL, 1, NULL, 0, 0),
(109, 78, 50, NULL, NULL, 1, NULL, 0, 0),
(110, 79, 50, NULL, NULL, 1, NULL, 0, 0),
(112, 81, 0, 1, 1, NULL, 1, 1, 1),
(113, 80, 52, 1, 1, NULL, 1, 1, 1),
(114, 74, 53, 1, 1, NULL, 1, 1, 1),
(115, 82, 53, NULL, NULL, 1, 1, 0, 0),
(116, 83, 53, NULL, NULL, 1, 1, 0, 0),
(117, 84, 53, NULL, NULL, 1, 1, 0, 0),
(118, 87, 54, 1, NULL, 1, NULL, 1, 0),
(119, 91, 54, NULL, 1, NULL, NULL, 0, 1),
(120, 92, 54, NULL, NULL, 1, NULL, 0, 0),
(121, 93, 54, NULL, NULL, 1, NULL, 0, 0),
(122, 94, 54, NULL, NULL, 1, NULL, 1, 0),
(125, 90, 56, 1, 1, NULL, 1, 1, 1),
(126, 96, 56, NULL, NULL, 1, NULL, 0, 0),
(127, 97, 56, NULL, NULL, 1, NULL, 0, 0),
(128, 98, 56, NULL, NULL, 1, NULL, 0, 0),
(129, 99, 56, NULL, NULL, 1, NULL, 0, 0),
(130, 90, 57, 1, 1, NULL, 1, 1, 1),
(131, 96, 57, NULL, NULL, 1, NULL, 0, 0),
(132, 97, 57, NULL, NULL, 1, NULL, 0, 0),
(133, 98, 57, NULL, NULL, 1, NULL, 0, 0),
(134, 99, 57, NULL, NULL, 1, NULL, 0, 0),
(135, 86, 58, 1, 1, NULL, 1, 1, 1),
(136, 95, 58, NULL, NULL, 1, NULL, 1, 0),
(137, 102, 59, 1, 1, NULL, 1, 1, 1),
(138, 102, 59, NULL, NULL, 1, NULL, 0, 0),
(139, 103, 59, NULL, NULL, 1, NULL, 1, 0),
(140, 104, 59, NULL, NULL, 1, NULL, 0, 0),
(141, 105, 59, NULL, NULL, 1, NULL, 0, 0),
(142, 86, 60, 1, 1, NULL, 1, 1, 1),
(143, 106, 60, NULL, NULL, 1, NULL, 1, 0),
(144, 107, 60, NULL, NULL, 1, NULL, 1, 0),
(145, 109, 61, 1, 1, NULL, 1, 1, 1),
(146, 110, 61, NULL, NULL, 1, NULL, 0, 0),
(147, 111, 61, NULL, NULL, 1, NULL, 0, 0),
(148, 113, 62, 1, 1, NULL, 1, 1, 1),
(149, 116, 62, NULL, NULL, 1, NULL, 0, 0),
(150, 117, 62, NULL, NULL, 1, NULL, 0, 0),
(151, 118, 62, NULL, NULL, 1, NULL, 0, 0),
(154, 115, 64, 1, 1, NULL, 1, 1, 1),
(155, 73, 64, NULL, NULL, 1, NULL, 0, 0),
(156, 73, 64, NULL, NULL, 1, NULL, 0, 0),
(157, 73, 64, NULL, NULL, 1, NULL, 0, 0),
(158, 73, 64, NULL, NULL, 1, NULL, 0, 0),
(159, 73, 64, NULL, NULL, 1, NULL, 0, 0),
(160, 73, 64, NULL, NULL, 1, NULL, 0, 0),
(161, 114, 65, 1, 1, NULL, 1, 1, 1),
(162, 120, 66, 1, 1, NULL, 1, 1, 1),
(163, 121, 66, NULL, NULL, 1, NULL, 1, 0),
(164, 122, 66, NULL, NULL, 1, NULL, 0, 0),
(165, 123, 67, 1, 1, NULL, 1, 1, 1),
(166, 125, 67, NULL, NULL, 1, NULL, 0, 0),
(167, 126, 67, NULL, NULL, 1, NULL, 0, 0),
(168, 127, 67, NULL, NULL, 1, NULL, 0, 0),
(169, 73, 67, NULL, NULL, 1, NULL, 0, 0),
(170, 128, 67, NULL, NULL, 1, NULL, 0, 0),
(171, 129, 68, 1, 1, NULL, 1, 1, 1),
(172, 126, 68, NULL, NULL, 1, NULL, 0, 0),
(173, 128, 68, NULL, NULL, 1, NULL, 0, 0),
(174, 127, 68, NULL, NULL, 1, NULL, 0, 0),
(175, 125, 68, NULL, NULL, 1, NULL, 0, 0),
(176, 73, 68, NULL, NULL, 1, NULL, 0, 0),
(177, 124, 69, 1, NULL, 1, NULL, 1, 0),
(178, 131, 69, NULL, 1, NULL, NULL, 0, 1),
(179, 108, 69, NULL, NULL, 1, NULL, 0, 0),
(180, 132, 69, NULL, NULL, 1, NULL, 0, 0),
(181, 124, 69, NULL, NULL, 1, NULL, 1, 0),
(182, 130, 70, 1, NULL, 1, NULL, 1, 0),
(183, 130, 70, NULL, 1, NULL, NULL, 1, 1),
(184, 134, 70, NULL, NULL, 1, NULL, 0, 0),
(185, 135, 70, NULL, NULL, 1, NULL, 0, 0),
(187, 52, 72, 1, NULL, 1, NULL, 1, 0),
(188, 137, 72, NULL, 1, NULL, NULL, 1, 1),
(190, 136, 73, 1, 1, NULL, 1, 1, 1),
(191, 139, 73, NULL, NULL, 1, NULL, 0, 0),
(195, 33, 74, NULL, NULL, 1, NULL, 1, 0),
(200, 141, 76, 1, 1, NULL, 1, 1, 1),
(201, 141, 0, 1, 1, NULL, 1, 1, 1),
(202, 33, 73, NULL, NULL, 1, NULL, 0, 0),
(203, 138, 74, NULL, NULL, 1, NULL, 0, 1),
(204, 140, 74, NULL, 1, NULL, NULL, 0, 1),
(205, 145, 77, 1, 1, NULL, 1, 1, 1),
(210, 141, 79, 1, 1, NULL, 1, 1, 1),
(211, 142, 79, NULL, NULL, 1, NULL, 0, 0),
(212, 143, 79, NULL, NULL, 1, NULL, 0, 0),
(213, 148, 79, NULL, NULL, 1, NULL, 0, 0),
(214, 73, 80, NULL, NULL, 1, NULL, 0, 0),
(215, 73, 80, NULL, NULL, 1, NULL, 0, 0),
(216, 73, 80, NULL, NULL, 1, NULL, 0, 0),
(217, 73, 80, NULL, NULL, 1, NULL, 0, 0),
(218, 147, 82, 1, 1, NULL, 1, 1, 1),
(219, 147, 83, 1, 1, NULL, 1, 1, 1),
(220, 100, 84, 1, 1, NULL, 1, 1, 1),
(221, 149, 84, NULL, NULL, 1, 1, 0, 0),
(222, 150, 84, NULL, NULL, 1, 1, 0, 0),
(223, 119, 86, 1, 1, NULL, 1, 1, 1),
(224, 153, 86, NULL, NULL, 1, NULL, 0, 0),
(225, 154, 86, NULL, NULL, 1, NULL, 0, 0),
(226, 155, 86, NULL, NULL, 1, NULL, 0, 0),
(227, 133, 87, 1, NULL, 1, NULL, 1, 0),
(228, 156, 87, NULL, NULL, 1, NULL, 0, 0),
(229, 157, 87, NULL, 1, NULL, NULL, 0, 1),
(230, 158, 87, NULL, NULL, 1, NULL, 0, 0),
(236, 159, 89, 1, 1, NULL, 1, 1, 1),
(237, 164, 89, NULL, NULL, 1, NULL, 1, 0),
(238, 165, 89, NULL, NULL, 1, NULL, 0, 0),
(239, 151, 90, 1, 1, NULL, 1, 1, 1),
(240, 73, 90, NULL, NULL, 1, NULL, 0, 0),
(241, 166, 90, NULL, NULL, 1, NULL, 1, 0),
(242, 167, 90, NULL, NULL, 1, NULL, 1, 0),
(243, 168, 90, NULL, NULL, 1, NULL, 1, 0),
(244, 146, 91, 1, NULL, 1, NULL, 1, 0),
(245, 146, 91, NULL, 1, NULL, NULL, 0, 1),
(246, 160, 91, NULL, NULL, 1, NULL, 0, 0),
(247, 161, 91, NULL, NULL, 1, NULL, 0, 0),
(248, 162, 91, NULL, NULL, 1, NULL, 0, 0),
(249, 152, 92, 1, 1, NULL, 1, 1, 1),
(250, 169, 92, NULL, NULL, 1, NULL, 0, 0),
(251, 170, 93, 1, 1, NULL, 1, 1, 1),
(258, 173, 95, 1, 1, NULL, 1, 1, 1),
(259, 181, 95, NULL, NULL, 1, NULL, 0, 0),
(260, 182, 95, NULL, NULL, 1, NULL, 0, 0),
(263, 101, 96, 1, 1, NULL, 1, 1, 1),
(264, 184, 96, NULL, NULL, 1, NULL, 1, 0),
(265, 185, 96, NULL, NULL, 1, NULL, 0, 0),
(266, 186, 96, NULL, NULL, 1, NULL, 0, 0),
(267, 187, 96, NULL, NULL, 1, NULL, 0, 0),
(270, 163, 97, 1, 1, NULL, 1, 1, 1),
(271, 174, 97, NULL, NULL, 1, NULL, 0, 0),
(272, 175, 97, NULL, NULL, 1, NULL, 0, 0),
(273, 176, 97, NULL, NULL, 1, NULL, 0, 0),
(274, 177, 97, NULL, NULL, 1, NULL, 0, 0),
(275, 178, 97, NULL, NULL, 1, NULL, 0, 0),
(279, 112, 99, 1, 1, NULL, 1, 1, 1),
(280, 194, 99, NULL, NULL, 1, 1, 1, 0),
(281, 195, 99, NULL, NULL, 1, 1, 0, 0),
(282, 190, 100, 1, NULL, 1, NULL, 1, 0),
(283, 196, 100, NULL, NULL, 1, NULL, 1, 0),
(284, 188, 100, NULL, 1, NULL, NULL, 0, 1),
(285, 86, 101, 1, NULL, 1, NULL, 1, 0),
(286, 106, 101, NULL, 1, NULL, NULL, 1, 1),
(287, 107, 101, NULL, NULL, 1, NULL, 1, 0),
(289, 85, 102, 1, 1, NULL, 1, 1, 1),
(290, 172, 103, 1, 1, NULL, 1, 1, 1),
(294, 172, 105, 1, 1, NULL, 1, 1, 1),
(300, 112, 107, 1, NULL, 1, 1, 1, 0),
(301, 194, 107, NULL, 1, NULL, 1, 1, 1),
(302, 205, 107, NULL, NULL, 1, NULL, 1, 0),
(303, 206, 107, NULL, NULL, 1, NULL, 0, 0),
(304, 207, 107, NULL, NULL, 1, NULL, 0, 0),
(305, 199, 108, 1, 1, NULL, 1, 1, 1),
(306, 208, 108, NULL, NULL, 1, NULL, 0, 0),
(307, 209, 108, NULL, NULL, 1, NULL, 0, 0),
(308, 210, 108, NULL, NULL, 1, NULL, 0, 0),
(309, 211, 108, NULL, NULL, 1, NULL, 0, 0),
(314, 200, 110, 1, NULL, 1, NULL, 1, 0),
(315, 202, 110, NULL, 1, NULL, NULL, 0, 1),
(316, 213, 110, NULL, NULL, 1, NULL, 0, 0),
(317, 203, 110, NULL, NULL, 1, NULL, 0, 0),
(318, 212, 111, 1, NULL, 1, NULL, 1, 0),
(319, 212, 111, NULL, 1, NULL, NULL, 0, 1),
(320, 73, 111, NULL, NULL, 1, NULL, 0, 0),
(321, 73, 111, NULL, NULL, 1, NULL, 0, 0),
(322, 73, 111, NULL, NULL, 1, NULL, 0, 0),
(323, 73, 111, NULL, NULL, 1, NULL, 0, 0),
(324, 112, 112, 1, 1, NULL, 1, 1, 1),
(325, 214, 112, NULL, NULL, 1, 1, 1, 0),
(326, 195, 112, NULL, NULL, 1, 1, 0, 0),
(327, 183, 113, 1, 1, NULL, 1, 1, 1),
(328, 215, 113, NULL, NULL, 1, NULL, 0, 0),
(329, 217, 114, 1, 1, NULL, 1, 1, 1),
(330, 216, 115, 1, 1, NULL, 1, 1, 1),
(331, 218, 115, NULL, NULL, 1, NULL, 0, 0),
(332, 219, 116, 1, 1, NULL, 1, 1, 1),
(333, 180, 117, 1, NULL, 1, NULL, 1, 0),
(334, 220, 117, NULL, 1, NULL, NULL, 0, 1),
(335, 201, 117, NULL, NULL, 1, NULL, 0, 0),
(336, 221, 117, NULL, NULL, 1, NULL, 0, 0),
(337, 147, 118, 1, 1, NULL, 1, 1, 1),
(338, 222, 98, NULL, NULL, 1, 1, 0, 0),
(340, 223, 82, NULL, NULL, 1, NULL, 0, 0),
(343, 225, 82, NULL, NULL, 1, NULL, 0, 0),
(345, 189, 119, 1, 1, NULL, 1, 1, 1),
(346, 227, 119, NULL, NULL, 1, NULL, 0, 0),
(347, 228, 119, NULL, NULL, 1, NULL, 0, 0),
(348, 193, 98, NULL, NULL, 1, NULL, 0, 0),
(349, 191, 98, NULL, 1, NULL, NULL, 1, 1),
(350, 81, 120, 1, 1, NULL, 1, 1, 1),
(351, 80, 120, NULL, NULL, 1, NULL, 0, 0),
(352, 224, 120, NULL, NULL, 1, NULL, 0, 0),
(353, 229, 121, 1, 1, NULL, 1, 1, 1),
(354, 230, 121, NULL, NULL, 1, NULL, 0, 0),
(355, 231, 121, NULL, NULL, 1, NULL, 0, 0),
(356, 112, 122, 1, 1, NULL, 1, 1, 1),
(357, 198, 102, NULL, NULL, 1, 1, 1, 0),
(391, 114, 127, NULL, 1, NULL, 1, 1, 1),
(434, 590, 102, NULL, NULL, 1, 1, 0, 0),
(435, 151, 128, 1, NULL, 1, NULL, 1, 0),
(436, 232, 128, NULL, NULL, 1, NULL, 0, 0),
(437, 233, 128, NULL, NULL, 1, NULL, 0, 0),
(438, 234, 128, NULL, NULL, 1, NULL, 0, 0),
(439, 235, 128, NULL, NULL, 1, NULL, 0, 0),
(440, 236, 128, NULL, NULL, 1, NULL, 0, 0),
(441, 237, 128, NULL, NULL, 1, NULL, 0, 0),
(442, 238, 128, NULL, NULL, 1, NULL, 0, 0),
(443, 239, 128, NULL, NULL, 1, NULL, 0, 0),
(444, 240, 128, NULL, NULL, 1, NULL, 0, 0),
(445, 241, 128, NULL, NULL, 1, NULL, 0, 0),
(446, 242, 128, NULL, NULL, 1, NULL, 0, 0),
(447, 243, 128, NULL, NULL, 1, NULL, 0, 0),
(448, 244, 128, NULL, NULL, 1, NULL, 0, 0),
(449, 245, 128, NULL, NULL, 1, NULL, 0, 0),
(450, 246, 128, NULL, NULL, 1, NULL, 0, 0),
(451, 247, 128, NULL, NULL, 1, NULL, 0, 0),
(452, 248, 128, NULL, NULL, 1, NULL, 0, 0),
(453, 249, 128, NULL, NULL, 1, NULL, 0, 0),
(454, 617, 128, NULL, 1, NULL, NULL, 0, 1),
(455, 618, 128, NULL, 1, NULL, NULL, 0, 1),
(456, 619, 128, NULL, 1, NULL, NULL, 0, 1),
(457, 620, 128, NULL, 1, NULL, NULL, 0, 1),
(458, 621, 128, NULL, 1, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_version_trabajo`
--

CREATE TABLE `tbl_version_trabajo` (
  `id_version_trabajo_pk` int(11) NOT NULL,
  `ubicacion_archivo` varchar(200) DEFAULT NULL,
  `version_editor_gestor` tinyint(1) DEFAULT NULL,
  `version_aprobado_conrevision` tinyint(1) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `id_usuario_que_subio_fk` int(11) NOT NULL,
  `id_trabajo_fk` int(11) NOT NULL,
  `fecha_subida` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_version_trabajo`
--

INSERT INTO `tbl_version_trabajo` (`id_version_trabajo_pk`, `ubicacion_archivo`, `version_editor_gestor`, `version_aprobado_conrevision`, `descripcion`, `id_usuario_que_subio_fk`, `id_trabajo_fk`, `fecha_subida`) VALUES
(1, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 11, 1, '2017-07-12'),
(2, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 4, 2, '2017-07-30'),
(3, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 11, 3, '2017-08-14'),
(4, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 28, 4, '2017-09-18'),
(5, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 30, 5, '2017-09-18'),
(6, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 31, 6, '2017-09-18'),
(7, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 29, 7, '2017-09-18'),
(10, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 34, 10, '2017-09-18'),
(11, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 3, 11, '2017-09-18'),
(12, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 25, 12, '2017-09-18'),
(13, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 25, 13, '2017-09-18'),
(14, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 47, 14, '2017-09-18'),
(15, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 23, 15, '2017-09-18'),
(16, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 50, 16, '2017-09-18'),
(18, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 50, 18, '2017-09-18'),
(20, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 52, 20, '2017-09-18'),
(29, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 36, 29, '2017-09-18'),
(30, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 26, 30, '2017-09-18'),
(31, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 24, 31, '2017-09-18'),
(32, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 60, 32, '2017-09-18'),
(34, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 61, 34, '2017-09-18'),
(35, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 32, 35, '2017-09-18'),
(37, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 15, 37, '2017-09-18'),
(38, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 63, 38, '2017-09-19'),
(39, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 64, 39, '2017-09-19'),
(40, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 63, 40, '2017-09-19'),
(41, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 67, 41, '2017-09-19'),
(42, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 56, 42, '2017-09-19'),
(43, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 55, 43, '2017-09-20'),
(44, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 27, 44, '2017-09-20'),
(45, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 51, 45, '2017-09-22'),
(47, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 33, 47, '2017-09-27'),
(48, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 71, 48, '2017-09-29'),
(49, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 72, 49, '2017-09-29'),
(50, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 75, 50, '2017-09-29'),
(52, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 81, 0, '2017-09-29'),
(53, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 80, 52, '2017-09-29'),
(54, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 74, 53, '2017-09-29'),
(55, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 87, 54, '2017-09-30'),
(57, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 90, 56, '2017-09-30'),
(58, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 90, 57, '2017-09-30'),
(59, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 86, 58, '2017-09-30'),
(60, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 102, 59, '2017-09-30'),
(61, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 86, 60, '2017-09-30'),
(62, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 109, 61, '2017-10-01'),
(63, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 113, 62, '2017-10-01'),
(65, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 115, 64, '2017-10-01'),
(66, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 114, 65, '2017-10-01'),
(67, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 120, 66, '2017-10-01'),
(68, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 123, 67, '2017-10-01'),
(69, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 129, 68, '2017-10-01'),
(70, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 124, 69, '2017-10-01'),
(71, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 130, 70, '2017-10-01'),
(73, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 52, 72, '2017-10-01'),
(74, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 136, 73, '2017-10-01'),
(75, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 138, 74, '2017-10-01'),
(77, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 141, 76, '2017-10-01'),
(78, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 141, 0, '2017-10-01'),
(79, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 145, 77, '2017-10-01'),
(81, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 141, 79, '2017-10-01'),
(82, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 147, 82, '2017-10-01'),
(83, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 147, 83, '2017-10-01'),
(84, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 100, 84, '2017-10-01'),
(85, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 119, 86, '2017-10-01'),
(86, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 133, 87, '2017-10-01'),
(88, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 159, 89, '2017-10-01'),
(89, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 151, 90, '2017-10-01'),
(90, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 146, 91, '2017-10-01'),
(91, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 152, 92, '2017-10-01'),
(92, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 170, 93, '2017-10-01'),
(94, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 173, 95, '2017-10-01'),
(95, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 101, 96, '2017-10-01'),
(96, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 163, 97, '2017-10-01'),
(97, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 191, 98, '2017-10-01'),
(98, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 112, 99, '2017-10-01'),
(99, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 190, 100, '2017-10-01'),
(100, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 86, 101, '2017-10-01'),
(101, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 172, 103, '2017-10-01'),
(103, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 172, 105, '2017-10-01'),
(105, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 112, 107, '2017-10-01'),
(106, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 199, 108, '2017-10-01'),
(108, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 200, 110, '2017-10-01'),
(109, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 212, 111, '2017-10-01'),
(110, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 112, 112, '2017-10-01'),
(111, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 183, 113, '2017-10-01'),
(112, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 217, 114, '2017-10-02'),
(113, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 216, 115, '2017-10-02'),
(114, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 219, 116, '2017-10-02'),
(115, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 180, 117, '2017-10-02'),
(116, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 147, 118, '2017-10-02'),
(117, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 189, 119, '2017-10-02'),
(118, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 81, 120, '2017-10-02'),
(119, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 229, 121, '2017-10-02'),
(120, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 112, 122, '2017-10-02'),
(125, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 114, 127, '2017-10-02'),
(126, NULL, NULL, NULL, 'Trabajo subido a la plataforma', 151, 128, '2017-10-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_voluntario`
--

CREATE TABLE `tbl_voluntario` (
  `id_voluntario_pk` int(11) NOT NULL COMMENT 'Identificador único asociado a cada voluntario',
  `numero_horas` double DEFAULT NULL,
  `comentarios` mediumtext,
  `estado` tinyint(1) DEFAULT NULL,
  `id_rol_congreso_fk` int(11) NOT NULL COMMENT 'Identificador foráneo que hace referencia a la tabla ''tbl_rol_congreso'' y que sirve para identificar el rol y el congreso del voluntario en cuestión.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_voluntario_tarea_voluntario`
--

CREATE TABLE `tbl_voluntario_tarea_voluntario` (
  `id_voluntario_fk` int(11) NOT NULL,
  `id_tarea_voluntario_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD PRIMARY KEY (`id_certificado_pk`),
  ADD KEY `tbl_rol_congreso_pk_idx` (`idrol_congreso`);

--
-- Indices de la tabla `tbl_certificados_usuario`
--
ALTER TABLE `tbl_certificados_usuario`
  ADD KEY `id_usuario_pk_idx` (`id_usuario_fk`),
  ADD KEY `id_certificado_fk_idx` (`id_certificado_fk`);

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
  ADD PRIMARY KEY (`id_costo_pk`,`id_congreso_fk`),
  ADD KEY `fk_tbl_costo_tbl_congreso1_idx` (`id_congreso_fk`);

--
-- Indices de la tabla `tbl_costo_x_usuario`
--
ALTER TABLE `tbl_costo_x_usuario`
  ADD PRIMARY KEY (`id_costo_fk`,`id_usuario_fk`,`id_factura_detalle_fk`),
  ADD KEY `fk_tbl_costo_has_tbl_usuario_tbl_usuario1_idx` (`id_usuario_fk`),
  ADD KEY `fk_tbl_costo_has_tbl_usuario_tbl_costo1_idx` (`id_costo_fk`),
  ADD KEY `fk_tbl_costo_x_usuario_tbl_factura_detalle1_idx` (`id_factura_detalle_fk`);

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
  ADD PRIMARY KEY (`id_factura_detalle_pk`),
  ADD KEY `fk_tbl_factura_has_tbl_costo_usuario_tbl_factura1_idx` (`id_factura_fk`);

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
-- Indices de la tabla `tbl_institucion_facultad_carrera`
--
ALTER TABLE `tbl_institucion_facultad_carrera`
  ADD PRIMARY KEY (`id_institucion_facultad_carrera`),
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
  ADD KEY `fk_tbl_usuario_mensaje_idx` (`id_usuario_fk`);

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
  ADD KEY `fk_tbl_persona_institucion_tbl_institucion1_idx` (`id_institucion_pk`),
  ADD KEY `fk_tbl_persona_institucion_tbl_institucion_facultad_carrera_idx` (`id_institucion_facultad_carrera`),
  ADD KEY `fk_tbl_persona_institucion_tbl_persona1_idx` (`id_persona_pk`);

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
  ADD PRIMARY KEY (`id_respuesta_mensaje_pk`),
  ADD KEY `fk_tbl_respuesta_mensaje_idx` (`id_mensaje_fk`),
  ADD KEY `fk_tbl_usuario_respuesta_mensaje_idx` (`id_usuario_fk`);

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
  ADD PRIMARY KEY (`id_solicitud`,`id_tipo_solicitud`,`id_usuario_pk`),
  ADD UNIQUE KEY `id_solicitud_UNIQUE` (`id_solicitud`),
  ADD KEY `fk_tbl_solicitud_tbl_tipo_solicitud1_idx` (`id_tipo_solicitud`),
  ADD KEY `fk_tbl_solicitud_tbl_usuario1_idx` (`id_usuario_pk`);

--
-- Indices de la tabla `tbl_solicitud_certificados`
--
ALTER TABLE `tbl_solicitud_certificados`
  ADD PRIMARY KEY (`id_solicitud`,`id_certificado_pk`),
  ADD UNIQUE KEY `id_solicitud_UNIQUE` (`id_solicitud`),
  ADD UNIQUE KEY `id_certificado_pk_UNIQUE` (`id_certificado_pk`),
  ADD KEY `fk_tbl_solicitud_has_tbl_certificados_tbl_certificados1_idx` (`id_certificado_pk`),
  ADD KEY `fk_tbl_solicitud_has_tbl_certificados_tbl_solicitud1_idx` (`id_solicitud`);

--
-- Indices de la tabla `tbl_solicitud_idioma`
--
ALTER TABLE `tbl_solicitud_idioma`
  ADD PRIMARY KEY (`id_solicitud`,`id_idioma_pk`);

--
-- Indices de la tabla `tbl_solicitud_roles_congreso`
--
ALTER TABLE `tbl_solicitud_roles_congreso`
  ADD PRIMARY KEY (`id_rol_congreso_pk`,`id_solicitud`),
  ADD KEY `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_solicitud1_idx` (`id_solicitud`),
  ADD KEY `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_roles_congreso1_idx` (`id_rol_congreso_pk`);

--
-- Indices de la tabla `tbl_solicitud_tematica`
--
ALTER TABLE `tbl_solicitud_tematica`
  ADD PRIMARY KEY (`id_solicitud`,`id_tematica_pk`),
  ADD KEY `fk_tbl_solicitud_has_tbl_tematica_tbl_tematica1_idx` (`id_tematica_pk`),
  ADD KEY `fk_tbl_solicitud_has_tbl_tematica_tbl_solicitud1_idx` (`id_solicitud`);

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
  ADD PRIMARY KEY (`id_tour_usuario_pk`,`id_tour_fk`,`id_usuario_fk`,`id_factura_detalle_fk`),
  ADD KEY `fk_tbl_tour_has_tbl_usuario_tbl_usuario1_idx` (`id_usuario_fk`),
  ADD KEY `fk_tbl_tour_has_tbl_usuario_tbl_tour1_idx` (`id_tour_fk`),
  ADD KEY `fk_tbl_tour_usuario_tbl_factura_detalle1_idx` (`id_factura_detalle_fk`);

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
  MODIFY `id_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada Congreso creado.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_correo`
--
ALTER TABLE `tbl_correo`
  MODIFY `id_correo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=691;

--
-- AUTO_INCREMENT de la tabla `tbl_costo`
--
ALTER TABLE `tbl_costo`
  MODIFY `id_costo_pk` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_estado_congreso_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifcador único para cada estado de congreso', AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `tbl_factura_detalle`
--
ALTER TABLE `tbl_factura_detalle`
  MODIFY `id_factura_detalle_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_facultad`
--
ALTER TABLE `tbl_facultad`
  MODIFY `id_facultad_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_formulario`
--
ALTER TABLE `tbl_formulario`
  MODIFY `id_formulario_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_institucion`
--
ALTER TABLE `tbl_institucion`
  MODIFY `id_institucion_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_institucion_facultad_carrera`
--
ALTER TABLE `tbl_institucion_facultad_carrera`
  MODIFY `id_institucion_facultad_carrera` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_linea_investigacion`
--
ALTER TABLE `tbl_linea_investigacion`
  MODIFY `id_linea_investigacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tipo de linea de investigación', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id_log_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_mensaje`
--
ALTER TABLE `tbl_mensaje`
  MODIFY `id_mensaje_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_modulos`
--
ALTER TABLE `tbl_modulos`
  MODIFY `id_modulo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_persona_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada persona.', AUTO_INCREMENT=689;

--
-- AUTO_INCREMENT de la tabla `tbl_pregunta_cualitativa`
--
ALTER TABLE `tbl_pregunta_cualitativa`
  MODIFY `id_pregunta_cualitativa_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_pregunta_cuantitativa`
--
ALTER TABLE `tbl_pregunta_cuantitativa`
  MODIFY `id_pregunta_cuantitativa_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de la tabla `tbl_respuesta_mensaje`
--
ALTER TABLE `tbl_respuesta_mensaje`
  MODIFY `id_respuesta_mensaje_pk` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_tarea_voluntario`
--
ALTER TABLE `tbl_tarea_voluntario`
  MODIFY `id_tarea_voluntario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tarea asociada a un voluntario. Ojo, éste campo no surje de la indexación porque esta no es una tabla transaccional, sino más bien la descripción de tareas que se asocian a los voluntarios.';

--
-- AUTO_INCREMENT de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  MODIFY `id_telefono_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada número de teléfono', AUTO_INCREMENT=687;

--
-- AUTO_INCREMENT de la tabla `tbl_tematica`
--
ALTER TABLE `tbl_tematica`
  MODIFY `id_tematica_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único dado a cada tipo de temática.', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_actividad`
--
ALTER TABLE `tbl_tipo_actividad`
  MODIFY `id_tipo_actividad_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_alimentacion`
--
ALTER TABLE `tbl_tipo_alimentacion`
  MODIFY `id_tipo_alimentacion_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada tipo de alimentación', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_dictamen`
--
ALTER TABLE `tbl_tipo_dictamen`
  MODIFY `id_tipo_dictamen_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_tipo_institucion_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_logs`
--
ALTER TABLE `tbl_tipo_logs`
  MODIFY `id_tipo_log_pk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  MODIFY `id_tipo_persona_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_pregunta`
--
ALTER TABLE `tbl_tipo_pregunta`
  MODIFY `id_tipo_pregunta_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_usuario_pk` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único para cada usuario.', AUTO_INCREMENT=688;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario_congreso_roles`
--
ALTER TABLE `tbl_usuario_congreso_roles`
  MODIFY `tbl_usuario_congreso_rol_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario_trabajo`
--
ALTER TABLE `tbl_usuario_trabajo`
  MODIFY `id_usuario_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;

--
-- AUTO_INCREMENT de la tabla `tbl_version_trabajo`
--
ALTER TABLE `tbl_version_trabajo`
  MODIFY `id_version_trabajo_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

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
  ADD CONSTRAINT `fk_tbl_asignacion_a_revisor_tbl_tipo_dictamen1` FOREIGN KEY (`id_tipo_dictamen_fk`) REFERENCES `tbl_tipo_dictamen` (`id_tipo_dictamen_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_asignacion_a_revisores_tbl_trabajo1` FOREIGN KEY (`id_trabajo_fk`) REFERENCES `tbl_trabajo` (`id_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `tbl_certificados`
--
ALTER TABLE `tbl_certificados`
  ADD CONSTRAINT `tbl_rol_congreso_pk` FOREIGN KEY (`idrol_congreso`) REFERENCES `tbl_roles_congreso` (`tbl_rol_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_certificados_usuario`
--
ALTER TABLE `tbl_certificados_usuario`
  ADD CONSTRAINT `id_certificado_fk` FOREIGN KEY (`id_certificado_fk`) REFERENCES `tbl_certificados` (`id_certificado_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usuario_pk` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_congreso`
--
ALTER TABLE `tbl_congreso`
  ADD CONSTRAINT `tbl_congreso_estado_congreso_fk` FOREIGN KEY (`id_estado_congreso_fk`) REFERENCES `tbl_estado_congreso` (`id_estado_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_congreso_pais_fk` FOREIGN KEY (`id_pais_fk`) REFERENCES `tbl_pais` (`id_pais_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `tbl_congreso_rol_tematicas`
--
ALTER TABLE `tbl_congreso_rol_tematicas`
  ADD CONSTRAINT `fk_tbl_congreso_rol_tematicas_tbl_tematica1` FOREIGN KEY (`id_tematica_fk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_rol_tematicas_tbl_usuario_congreso_roles1` FOREIGN KEY (`id_usuario_congreso_roles_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_congreso_tipo_trabajo`
--
ALTER TABLE `tbl_congreso_tipo_trabajo`
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_tipo_trabajo_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_congreso_has_tbl_tipo_trabajo_tbl_tipo_trabajo1` FOREIGN KEY (`id_tipo_trabajo_fk`) REFERENCES `tbl_tipo_trabajo` (`id_tipo_trabajo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_costo`
--
ALTER TABLE `tbl_costo`
  ADD CONSTRAINT `fk_tbl_costo_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_costo_x_usuario`
--
ALTER TABLE `tbl_costo_x_usuario`
  ADD CONSTRAINT `fk_tbl_costo_has_tbl_usuario_tbl_costo1` FOREIGN KEY (`id_costo_fk`) REFERENCES `tbl_costo` (`id_costo_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_costo_has_tbl_usuario_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_costo_x_usuario_tbl_factura_detalle1` FOREIGN KEY (`id_factura_detalle_fk`) REFERENCES `tbl_factura_detalle` (`id_factura_detalle_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tbl_idiomas_usuarios_tbl_idioma1` FOREIGN KEY (`id_idioma_fk`) REFERENCES `tbl_idioma` (`id_idioma_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `tbl_institucion_facultad_carrera`
--
ALTER TABLE `tbl_institucion_facultad_carrera`
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
  ADD CONSTRAINT `fk_tbl_usuario_mensaje` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tbl_persona_institucion_tbl_institucion1` FOREIGN KEY (`id_institucion_pk`) REFERENCES `tbl_institucion` (`id_institucion_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_institucion_tbl_institucion_facultad_carrera1` FOREIGN KEY (`id_institucion_facultad_carrera`) REFERENCES `tbl_institucion_facultad_carrera` (`id_institucion_facultad_carrera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_persona_institucion_tbl_persona1` FOREIGN KEY (`id_persona_pk`) REFERENCES `tbl_persona` (`id_persona_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona_red_social`
--
ALTER TABLE `tbl_persona_red_social`
  ADD CONSTRAINT `fk_tbl_persona_has_tbl_red_social_tbl_red_social1` FOREIGN KEY (`id_red_social_pk`) REFERENCES `tbl_red_social` (`id_red_social_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona_titulo`
--
ALTER TABLE `tbl_persona_titulo`
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
  ADD CONSTRAINT `fk_tbl_respuesta_mensaje` FOREIGN KEY (`id_mensaje_fk`) REFERENCES `tbl_mensaje` (`id_mensaje_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_usuario_respuesta_mensaje` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tbl_roles_has_tbl_congreso_tbl_congreso1` FOREIGN KEY (`id_congreso_fk`) REFERENCES `tbl_congreso` (`id_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_roles_has_tbl_congreso_tbl_roles1` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_roles` (`id_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitud`
--
ALTER TABLE `tbl_solicitud`
  ADD CONSTRAINT `fk_tbl_solicitud_tbl_tipo_solicitud1` FOREIGN KEY (`id_tipo_solicitud`) REFERENCES `tbl_tipo_solicitud` (`id_tipo_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_solicitud_tbl_usuario1` FOREIGN KEY (`id_usuario_pk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitud_certificados`
--
ALTER TABLE `tbl_solicitud_certificados`
  ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_certificados_tbl_certificados1` FOREIGN KEY (`id_certificado_pk`) REFERENCES `tbl_certificados` (`id_certificado_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_certificados_tbl_solicitud1` FOREIGN KEY (`id_solicitud`) REFERENCES `tbl_solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitud_roles_congreso`
--
ALTER TABLE `tbl_solicitud_roles_congreso`
  ADD CONSTRAINT `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_roles_congreso1` FOREIGN KEY (`id_rol_congreso_pk`) REFERENCES `tbl_roles_congreso` (`tbl_rol_congreso_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_solicitud1` FOREIGN KEY (`id_solicitud`) REFERENCES `tbl_solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_solicitud_tematica`
--
ALTER TABLE `tbl_solicitud_tematica`
  ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_tematica_tbl_solicitud1` FOREIGN KEY (`id_solicitud`) REFERENCES `tbl_solicitud` (`id_solicitud`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_tematica_tbl_tematica1` FOREIGN KEY (`id_tematica_pk`) REFERENCES `tbl_tematica` (`id_tematica_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tbl_tour_has_tbl_usuario_tbl_usuario1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_usuario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_tour_usuario_tbl_factura_detalle1` FOREIGN KEY (`id_factura_detalle_fk`) REFERENCES `tbl_factura_detalle` (`id_factura_detalle_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_usuario_con1` FOREIGN KEY (`id_usuario_congreso_rol_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario_firma_certificado`
--
ALTER TABLE `tbl_usuario_firma_certificado`
  ADD CONSTRAINT `fk_tbl_usuario_firma_certificado_tbl_certificados1` FOREIGN KEY (`id_certificado_pk`) REFERENCES `tbl_certificados` (`id_certificado_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_tbl_voluntario_tbl_roles_congreso1` FOREIGN KEY (`id_rol_congreso_fk`) REFERENCES `tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_voluntario_tarea_voluntario`
--
ALTER TABLE `tbl_voluntario_tarea_voluntario`
  ADD CONSTRAINT `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_tarea_voluntar1` FOREIGN KEY (`id_tarea_voluntario_fk`) REFERENCES `tbl_tarea_voluntario` (`id_tarea_voluntario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_voluntario1` FOREIGN KEY (`id_voluntario_fk`) REFERENCES `tbl_voluntario` (`id_voluntario_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
