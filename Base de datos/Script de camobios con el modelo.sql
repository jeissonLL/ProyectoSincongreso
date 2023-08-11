-- MySQL Workbench Synchronization
-- Generated: 2022-02-02 19:48
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: alexv

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `dbcongresoceat`.`tbl_correo` 
DROP FOREIGN KEY `fk_tbl_correo_tbl_persona1`;

ALTER TABLE `dbcongresoceat`.`tbl_carrera` 
DROP COLUMN `tbl_carreracol`;

ALTER TABLE `dbcongresoceat`.`tbl_actividad` 
ADD COLUMN `responsable` INT(11) NULL DEFAULT NULL AFTER `fecha_actividad`,
ADD COLUMN `comentarios` TINYTEXT NULL DEFAULT NULL AFTER `responsable`;

ALTER TABLE `dbcongresoceat`.`tbl_actividad_tematica` 
ADD COLUMN `distribucion_sesiones_paralelas` TINYINT(1) NULL DEFAULT NULL AFTER `id_tematica_fk`;

CREATE TABLE IF NOT EXISTS `dbcongresoceat`.`tbl_institucion_facultad_carrera` (
  `id_institucion_facultad_carrera` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_institucion_fk` INT(11) NOT NULL,
  `id_facultad_fk` INT(11) NOT NULL,
  `id_carrera_fk` INT(11) NOT NULL,
  INDEX `fk_tbl_institucion_has_tbl_facultad_tbl_facultad1_idx` (`id_facultad_fk` ASC) VISIBLE,
  INDEX `fk_tbl_institucion_has_tbl_facultad_tbl_institucion1_idx` (`id_institucion_fk` ASC) VISIBLE,
  INDEX `fk_tbl_institucion_facultad_tbl_carrera1_idx` (`id_carrera_fk` ASC) VISIBLE,
  PRIMARY KEY (`id_institucion_facultad_carrera`),
  CONSTRAINT `fk_tbl_institucion_has_tbl_facultad_tbl_institucion1`
    FOREIGN KEY (`id_institucion_fk`)
    REFERENCES `dbcongresoceat`.`tbl_institucion` (`id_institucion_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_institucion_has_tbl_facultad_tbl_facultad1`
    FOREIGN KEY (`id_facultad_fk`)
    REFERENCES `dbcongresoceat`.`tbl_facultad` (`id_facultad_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_institucion_facultad_tbl_carrera1`
    FOREIGN KEY (`id_carrera_fk`)
    REFERENCES `dbcongresoceat`.`tbl_carrera` (`id_carrera_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

ALTER TABLE `dbcongresoceat`.`tbl_certificados` 
ADD COLUMN `idrol_congreso` INT(11) NULL DEFAULT NULL AFTER `nombre_persona`,
ADD INDEX `tbl_rol_congreso_pk_idx` (`idrol_congreso` ASC) VISIBLE;
;

ALTER TABLE `dbcongresoceat`.`tbl_solicitud` 
ADD COLUMN `id_usuario_pk` INT(11) NOT NULL AFTER `fecha_resolucion`,
CHANGE COLUMN `status` `status` TINYINT(1) NULL DEFAULT NULL COMMENT '2:Rechazada\n1: Aceptada\n0: Pendiente' ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id_solicitud`, `id_tipo_solicitud`, `id_usuario_pk`),
ADD INDEX `fk_tbl_solicitud_tbl_usuario1_idx` (`id_usuario_pk` ASC) VISIBLE;
;

ALTER TABLE `dbcongresoceat`.`tbl_solicitud_certificados` 
ADD UNIQUE INDEX `id_solicitud_UNIQUE` (`id_solicitud` ASC) VISIBLE,
ADD UNIQUE INDEX `id_certificado_pk_UNIQUE` (`id_certificado_pk` ASC) VISIBLE;
;

CREATE TABLE IF NOT EXISTS `dbcongresoceat`.`tbl_solicitud_idioma` (
  `id_solicitud` INT(11) NOT NULL,
  `id_idioma_pk` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`id_solicitud`, `id_idioma_pk`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

CREATE TABLE IF NOT EXISTS `dbcongresoceat`.`tbl_solicitud_roles_congreso` (
  `id_rol_congreso_pk` INT(11) NOT NULL,
  `id_solicitud` INT(11) NOT NULL,
  PRIMARY KEY (`id_rol_congreso_pk`, `id_solicitud`),
  INDEX `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_solicitud1_idx` (`id_solicitud` ASC) VISIBLE,
  INDEX `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_roles_congreso1_idx` (`id_rol_congreso_pk` ASC) VISIBLE,
  CONSTRAINT `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_roles_congreso1`
    FOREIGN KEY (`id_rol_congreso_pk`)
    REFERENCES `dbcongresoceat`.`tbl_roles_congreso` (`tbl_rol_congreso_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_roles_congreso_has_tbl_solicitud_tbl_solicitud1`
    FOREIGN KEY (`id_solicitud`)
    REFERENCES `dbcongresoceat`.`tbl_solicitud` (`id_solicitud`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

ALTER TABLE `dbcongresoceat`.`tbl_persona_institucion` 
DROP COLUMN `cargo`,
DROP COLUMN `id_institucion_fk`,
DROP COLUMN `id_persona_fk`,
ADD COLUMN `id_institucion_pk` INT(11) NULL DEFAULT NULL FIRST,
ADD COLUMN `id_institucion_facultad_carrera` INT(10) UNSIGNED NOT NULL AFTER `id_institucion_pk`,
ADD COLUMN `id_persona_pk` INT(11) NOT NULL AFTER `id_institucion_facultad_carrera`,
ADD INDEX `fk_tbl_persona_institucion_tbl_institucion1_idx` (`id_institucion_pk` ASC) VISIBLE,
ADD INDEX `fk_tbl_persona_institucion_tbl_institucion_facultad_carrera_idx` (`id_institucion_facultad_carrera` ASC) VISIBLE,
ADD INDEX `fk_tbl_persona_institucion_tbl_persona1_idx` (`id_persona_pk` ASC) VISIBLE,
DROP INDEX `fk_tbl_persona_has_tbl_institucion_tbl_persona1_idx` ,
DROP INDEX `fk_tbl_persona_has_tbl_institucion_tbl_institucion1_idx` ,
DROP PRIMARY KEY;
;

CREATE TABLE IF NOT EXISTS `dbcongresoceat`.`tbl_certificados_usuario` (
  `id_usuario_fk` INT(11) NOT NULL,
  `id_certificado_fk` INT(11) NOT NULL,
  `codigo_certificado` VARCHAR(250) NOT NULL,
  INDEX `id_usuario_pk_idx` (`id_usuario_fk` ASC) VISIBLE,
  INDEX `id_certificado_fk_idx` (`id_certificado_fk` ASC) VISIBLE,
  CONSTRAINT `id_usuario_pk`
    FOREIGN KEY (`id_usuario_fk`)
    REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_certificado_fk`
    FOREIGN KEY (`id_certificado_fk`)
    REFERENCES `dbcongresoceat`.`tbl_certificados` (`id_certificado_pk`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;

DROP TABLE IF EXISTS `dbcongresoceat`.`tbl_solicitud_usuario_congreso_roles` ;

DROP TABLE IF EXISTS `dbcongresoceat`.`tbl_institucion_facultad` ;

ALTER TABLE `dbcongresoceat`.`tbl_usuario` 
ADD CONSTRAINT `fk_tbl_usuario_tbl_idioma1`
  FOREIGN KEY (`id_idioma_fk`)
  REFERENCES `dbcongresoceat`.`tbl_idioma` (`id_idioma_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_tematica` 
ADD CONSTRAINT `fk_tbl_tematica_tbl_linea_investigacion`
  FOREIGN KEY (`id_linea_investigacion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_linea_investigacion` (`id_linea_investigacion_pk`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `dbcongresoceat`.`tbl_usuario_congreso_roles` 
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_congreso_tbl_usuario1`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_tbl_roles_congreso1`
  FOREIGN KEY (`id_rol_congreso_fk`)
  REFERENCES `dbcongresoceat`.`tbl_roles_congreso` (`tbl_rol_congreso_pk`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE `dbcongresoceat`.`tbl_usuario_tipo_usuario` 
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_usuario1`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_tipo_usuario_tbl_tipo_usuario1`
  FOREIGN KEY (`id_tipo_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_usuario` (`id_tipo_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_usuario_congreso_roles_modulos_acciones` 
ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_usuario_con1`
  FOREIGN KEY (`id_usuario_congreso_rol_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_usuario_congreso_roles_has_tbl_modulos_tbl_modulos1`
  FOREIGN KEY (`id_modulo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_modulos` (`id_modulo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_persona` 
ADD CONSTRAINT `fk_tbl_persona_tbl_tipo_persona2`
  FOREIGN KEY (`id_tipo_persona_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_persona` (`id_tipo_persona_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_persona_tbl_tipo_alimentacion1`
  FOREIGN KEY (`id_tipo_alimentacion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_alimentacion` (`id_tipo_alimentacion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_persona_tbl_tipo_identificacion1`
  FOREIGN KEY (`id_tipo_identificacion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_identificacion` (`id_tipo_identificacion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_persona_tbl_pais1`
  FOREIGN KEY (`id_pais_fk`)
  REFERENCES `dbcongresoceat`.`tbl_pais` (`id_pais_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_institucion` 
ADD CONSTRAINT `fk_tbl_institucion_tbl_tipo_institucion1`
  FOREIGN KEY (`id_tipo_institucion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_institucion` (`id_tipo_institucion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_institucion_tbl_pais1`
  FOREIGN KEY (`id_pais_fk`)
  REFERENCES `dbcongresoceat`.`tbl_pais` (`id_pais_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_titulo` 
ADD CONSTRAINT `fk_tbl_titulo_tbl_nivel_educativo1`
  FOREIGN KEY (`id_nivel_educativo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_nivel_educativo` (`id_nivel_educativo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_titulo_tbl_carrera1`
  FOREIGN KEY (`id_carrera_fk`)
  REFERENCES `dbcongresoceat`.`tbl_carrera` (`id_carrera_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_persona_titulo` 
ADD CONSTRAINT `fk_tbl_persona_has_tbl_titulo_tbl_titulo1`
  FOREIGN KEY (`id_titulo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_titulo` (`id_titulo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_trabajo` 
ADD CONSTRAINT `fk_tbl_trabajo_tbl_estado1`
  FOREIGN KEY (`id_estado_fk`)
  REFERENCES `dbcongresoceat`.`tbl_estado` (`id_estado_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_trabajo_tbl_tematica1`
  FOREIGN KEY (`id_tematica_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tematica` (`id_tematica_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_trabajo_tbl_citacion1`
  FOREIGN KEY (`id_citacion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_citacion` (`id_citacion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_trabajo_tbl_tipo_trabajo1`
  FOREIGN KEY (`id_tipo_trabajo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_trabajo` (`id_tipo_trabajo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_trabajo_tbl_idioma1`
  FOREIGN KEY (`id_idioma_fk`)
  REFERENCES `dbcongresoceat`.`tbl_idioma` (`id_idioma_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_trabajo_tematica` 
ADD CONSTRAINT `fk_tbl_trabajo_has_tbl_tematica_tbl_trabajo1`
  FOREIGN KEY (`id_trabajo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_trabajo` (`id_trabajo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_trabajo_has_tbl_tematica_tbl_tematica1`
  FOREIGN KEY (`id_tematica_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tematica` (`id_tematica_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_idioma` 
ADD CONSTRAINT `fk_tbl_estado_idioma`
  FOREIGN KEY (`id_estado_idioma_fk`)
  REFERENCES `dbcongresoceat`.`tbl_estado_idioma` (`id_estado_idioma_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_usuario_trabajo` 
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_trabajo_tbl_usuario1`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_trabajo_tbl_trabajo1`
  FOREIGN KEY (`id_trabajo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_trabajo` (`id_trabajo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_premio` 
ADD CONSTRAINT `fk_tbl_premio_tbl_tematica1`
  FOREIGN KEY (`id_tematica_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tematica` (`id_tematica_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_usuario_actividad_congreso` 
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_actividad_tbl_usuario1`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_actividad_tbl_actividad1`
  FOREIGN KEY (`id_actividad_fk`)
  REFERENCES `dbcongresoceat`.`tbl_actividad` (`id_actividad_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_usuario_has_tbl_actividad_tbl_congreso1`
  FOREIGN KEY (`id_congreso_fk`)
  REFERENCES `dbcongresoceat`.`tbl_congreso` (`id_congreso_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_premio_trabajo` 
ADD CONSTRAINT `fk_tbl_premio_has_tbl_trabajo_tbl_premio1`
  FOREIGN KEY (`id_premio_fk`)
  REFERENCES `dbcongresoceat`.`tbl_premio` (`id_premio_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_premio_has_tbl_trabajo_tbl_trabajo1`
  FOREIGN KEY (`id_trabajo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_trabajo` (`id_trabajo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_patrocinador` 
ADD CONSTRAINT `fk_tbl_patrocinador_tbl_tipo_institucion1`
  FOREIGN KEY (`id_tipo_institucion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_institucion` (`id_tipo_institucion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_premio_patrocinador` 
ADD CONSTRAINT `fk_tbl_premio_has_tbl_patrocinador_tbl_premio1`
  FOREIGN KEY (`id_premio_fk`)
  REFERENCES `dbcongresoceat`.`tbl_premio` (`id_premio_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_premio_has_tbl_patrocinador_tbl_patrocinador1`
  FOREIGN KEY (`id_patrocinador_fk`)
  REFERENCES `dbcongresoceat`.`tbl_patrocinador` (`id_patrocinador_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_respuesta_cuantitativa` 
ADD CONSTRAINT `fk_tbl_respuestas_cuantitativas_tbl_preguntas_cuantitativas1`
  FOREIGN KEY (`id_pregunta_cuantitativa_fk`)
  REFERENCES `dbcongresoceat`.`tbl_pregunta_cuantitativa` (`id_pregunta_cuantitativa_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_pregunta_cuantitativa` 
ADD CONSTRAINT `fk_tbl_preguntas_cuantitativas_tbl_formulario1`
  FOREIGN KEY (`id_formulario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_formulario` (`id_formulario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_preguntas_cuantitativas_tbl_tipo_pregunta1`
  FOREIGN KEY (`id_tipo_pregunta_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_pregunta` (`id_tipo_pregunta_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_pregunta_cualitativa` 
ADD CONSTRAINT `fk_tbl_preguntas_cualitativas_tbl_formulario1`
  FOREIGN KEY (`id_formulario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_formulario` (`id_formulario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_preguntas_cualitativas_tbl_tipo_pregunta1`
  FOREIGN KEY (`id_tipo_pregunta_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_pregunta` (`id_tipo_pregunta_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_respuesta_cualitativa` 
ADD CONSTRAINT `fk_tbl_respuestas_cualitativas_tbl_preguntas_cualitativas1`
  FOREIGN KEY (`id_pregunta_cualitativa_fk`)
  REFERENCES `dbcongresoceat`.`tbl_pregunta_cualitativa` (`id_pregunta_cualitativa_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_roles_congreso` 
ADD CONSTRAINT `fk_tbl_roles_has_tbl_congreso_tbl_roles1`
  FOREIGN KEY (`id_rol_fk`)
  REFERENCES `dbcongresoceat`.`tbl_roles` (`id_rol_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_roles_has_tbl_congreso_tbl_congreso1`
  FOREIGN KEY (`id_congreso_fk`)
  REFERENCES `dbcongresoceat`.`tbl_congreso` (`id_congreso_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_tour_usuario` 
ADD CONSTRAINT `fk_tbl_tour_has_tbl_usuario_tbl_tour1`
  FOREIGN KEY (`id_tour_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tour` (`id_tour_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_tour_has_tbl_usuario_tbl_usuario1`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_tour_usuario_tbl_factura_detalle1`
  FOREIGN KEY (`id_factura_detalle_fk`)
  REFERENCES `dbcongresoceat`.`tbl_factura_detalle` (`id_factura_detalle_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_voluntario` 
ADD CONSTRAINT `fk_tbl_voluntario_tbl_roles_congreso1`
  FOREIGN KEY (`id_rol_congreso_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_voluntario_tarea_voluntario` 
ADD CONSTRAINT `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_voluntario1`
  FOREIGN KEY (`id_voluntario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_voluntario` (`id_voluntario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_voluntario_has_tbl_tarea_voluntario_tbl_tarea_voluntar1`
  FOREIGN KEY (`id_tarea_voluntario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tarea_voluntario` (`id_tarea_voluntario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_version_trabajo` 
ADD CONSTRAINT `fk_tbl_version_trabajo_tbl_usuario1`
  FOREIGN KEY (`id_usuario_que_subio_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_version_trabajo_tbl_trabajo1`
  FOREIGN KEY (`id_trabajo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_trabajo` (`id_trabajo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_notificacion` 
ADD CONSTRAINT `fk_tbl_notificacion_tbl_usuario1`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_noticia` 
ADD CONSTRAINT `fk_tbl_noticia_tbl_usuario_congreso_roles1`
  FOREIGN KEY (`id_usuario_congreso_rol_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_log` 
ADD CONSTRAINT `fk_tbl_log_tbl_usuario1`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_log_tbl_tipo_logs1`
  FOREIGN KEY (`id_tipo_log_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_logs` (`id_tipo_log_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_persona_red_social` 
ADD CONSTRAINT `fk_tbl_persona_has_tbl_red_social_tbl_red_social1`
  FOREIGN KEY (`id_red_social_pk`)
  REFERENCES `dbcongresoceat`.`tbl_red_social` (`id_red_social_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_programa_actividad` 
ADD CONSTRAINT `fk_tbl_programa_has_tbl_actividad_tbl_programa1`
  FOREIGN KEY (`id_programa_fk`)
  REFERENCES `dbcongresoceat`.`tbl_programa` (`id_programa_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_programa_has_tbl_actividad_tbl_actividad1`
  FOREIGN KEY (`id_actividad_fk`)
  REFERENCES `dbcongresoceat`.`tbl_actividad` (`id_actividad_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_perfiles` 
ADD CONSTRAINT `fk_tbl_perfiles_tbl_usuario_congreso_roles1`
  FOREIGN KEY (`id_usuario_congreso_roles_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario_congreso_roles` (`tbl_usuario_congreso_rol_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_idiomas_personas` 
ADD CONSTRAINT `fk_tbl_idiomas_usuarios_tbl_idioma1`
  FOREIGN KEY (`id_idioma_fk`)
  REFERENCES `dbcongresoceat`.`tbl_idioma` (`id_idioma_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_tour_institucion` 
ADD CONSTRAINT `fk_tbl_tour_has_tbl_institucion_tbl_tour1`
  FOREIGN KEY (`id_tour_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tour` (`id_tour_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_tour_has_tbl_institucion_tbl_institucion1`
  FOREIGN KEY (`id_institucion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_institucion` (`id_institucion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_institucion_carrera` 
ADD CONSTRAINT `fk_tbl_institucion_has_tbl_carrera_tbl_institucion1`
  FOREIGN KEY (`id_institucion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_institucion` (`id_institucion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_institucion_has_tbl_carrera_tbl_carrera1`
  FOREIGN KEY (`id_carrera_fk`)
  REFERENCES `dbcongresoceat`.`tbl_carrera` (`id_carrera_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_pais_idioma` 
ADD CONSTRAINT `fk_tbl_pais_has_tbl_idioma_tbl_pais1`
  FOREIGN KEY (`id_pais_fk`)
  REFERENCES `dbcongresoceat`.`tbl_pais` (`id_pais_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_pais_has_tbl_idioma_tbl_idioma1`
  FOREIGN KEY (`id_idioma_fk`)
  REFERENCES `dbcongresoceat`.`tbl_idioma` (`id_idioma_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_organizadores` 
ADD CONSTRAINT `fk_tbl_organizadores_tbl_congreso1`
  FOREIGN KEY (`id_congreso_fk`)
  REFERENCES `dbcongresoceat`.`tbl_congreso` (`id_congreso_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_organizadores_tbl_institucion1`
  FOREIGN KEY (`id_institucion_fk`)
  REFERENCES `dbcongresoceat`.`tbl_institucion` (`id_institucion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_certificados` 
ADD CONSTRAINT `tbl_rol_congreso_pk`
  FOREIGN KEY (`idrol_congreso`)
  REFERENCES `dbcongresoceat`.`tbl_roles_congreso` (`tbl_rol_congreso_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_usuario_firma_certificado` 
ADD CONSTRAINT `fk_tbl_usuario_firma_certificado_tbl_certificados1`
  FOREIGN KEY (`id_certificado_pk`)
  REFERENCES `dbcongresoceat`.`tbl_certificados` (`id_certificado_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_mensaje` 
ADD CONSTRAINT `fk_tbl_usuario_mensaje`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_respuesta_mensaje` 
ADD CONSTRAINT `fk_tbl_respuesta_mensaje`
  FOREIGN KEY (`id_mensaje_fk`)
  REFERENCES `dbcongresoceat`.`tbl_mensaje` (`id_mensaje_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_usuario_respuesta_mensaje`
  FOREIGN KEY (`id_usuario_fk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_solicitud` 
ADD CONSTRAINT `fk_tbl_solicitud_tbl_tipo_solicitud1`
  FOREIGN KEY (`id_tipo_solicitud`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_solicitud` (`id_tipo_solicitud`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_solicitud_tbl_usuario1`
  FOREIGN KEY (`id_usuario_pk`)
  REFERENCES `dbcongresoceat`.`tbl_usuario` (`id_usuario_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_revisiones_trabajo` 
ADD CONSTRAINT `id_asignacion_a_revisor_fk`
  FOREIGN KEY (`id_asignacion_a_revisor_fk`)
  REFERENCES `dbcongresoceat`.`tbl_asignacion_a_revisor` (`id_asignacion_a_revisor_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `id_tipo_dictamen_pk`
  FOREIGN KEY (`id_tipo_dictamen_fk`)
  REFERENCES `dbcongresoceat`.`tbl_tipo_dictamen` (`id_tipo_dictamen_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_respuestas_revisiones_trabajos_cuantitativas` 
ADD CONSTRAINT `id_revisiones_trabajo_fk`
  FOREIGN KEY (`id_revisiones_trabajo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_revisiones_trabajo` (`id_revisiones_trabajo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `id_respuesta_cuantitativa_fk`
  FOREIGN KEY (`id_respuesta_cuantitativa_fk`)
  REFERENCES `dbcongresoceat`.`tbl_respuesta_cuantitativa` (`id_respuesta_cuantitativa_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_respuestas_revisiones_trabajos_cualitativas` 
ADD CONSTRAINT `tbl_revisiones_trabajo_fk`
  FOREIGN KEY (`id_revisiones_trabajo_fk`)
  REFERENCES `dbcongresoceat`.`tbl_revisiones_trabajo` (`id_revisiones_trabajo_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `tbl_respuesta_cualitativa_fk`
  FOREIGN KEY (`id_respuesta_cualitativa_fk`)
  REFERENCES `dbcongresoceat`.`tbl_respuesta_cualitativa` (`id_respuesta_cualitativa_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_solicitud_tematica` 
ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_tematica_tbl_solicitud1`
  FOREIGN KEY (`id_solicitud`)
  REFERENCES `dbcongresoceat`.`tbl_solicitud` (`id_solicitud`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_tematica_tbl_tematica1`
  FOREIGN KEY (`id_tematica_pk`)
  REFERENCES `dbcongresoceat`.`tbl_tematica` (`id_tematica_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_solicitud_certificados` 
ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_certificados_tbl_solicitud1`
  FOREIGN KEY (`id_solicitud`)
  REFERENCES `dbcongresoceat`.`tbl_solicitud` (`id_solicitud`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_solicitud_has_tbl_certificados_tbl_certificados1`
  FOREIGN KEY (`id_certificado_pk`)
  REFERENCES `dbcongresoceat`.`tbl_certificados` (`id_certificado_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbcongresoceat`.`tbl_persona_institucion` 
ADD CONSTRAINT `fk_tbl_persona_institucion_tbl_institucion1`
  FOREIGN KEY (`id_institucion_pk`)
  REFERENCES `dbcongresoceat`.`tbl_institucion` (`id_institucion_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_persona_institucion_tbl_institucion_facultad_carrera1`
  FOREIGN KEY (`id_institucion_facultad_carrera`)
  REFERENCES `dbcongresoceat`.`tbl_institucion_facultad_carrera` (`id_institucion_facultad_carrera`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_tbl_persona_institucion_tbl_persona1`
  FOREIGN KEY (`id_persona_pk`)
  REFERENCES `dbcongresoceat`.`tbl_persona` (`id_persona_pk`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
