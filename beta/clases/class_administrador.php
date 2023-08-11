<?php
require 'class_base.php';
require 'class_tematica.php';
require 'class_lineainvestigacion.php';
class administrador{
	private $id_usuario;

	public function crearlinea($nombre,$descripcion){
		$fecha = date("Y-m-d");

		$bdd = new basedatos();
		$id_linea=$bdd->insert('insert into tbl_linea_investigacion(nombre_linea_investigacion,descripcion_linea_investigacion,creado_por,modificado_por,fecha_creacion,fecha_modificacion) values (?,?,?,?,?,?)',[[$nombre,'s'],[$descripcion,'s'],[$this->id_usuario,'i'],[$this->id_usuario,'i'],[$fecha,'s'],[$fecha,'s']],True);
		$linea=$bdd->select('select * from tbl_linea_investigacion where id_linea_investigacion_pk='.$id_linea);
		return new lineainvestigacion($id_linea,$linea[0]['nombre_linea_investigacion'],$linea[0]['descripcion_linea_investigacion'],[]);
	}
	public function vincularlineacongreso($congreso,$linea){

	}



	public function creartematica($nombre,$descripcion,$idlinea){
		$fecha = date("Y-m-d");

		$bdd = new basedatos();

		$id_tematica=$bdd->insert("insert into tbl_tematica(nombre_tematica,id_linea_investigacion_fk,descripcion_tematica,creado_por,modificado_por,fecha_creacion,fecha_modificacion) values (?,?,?,?,?,?,?)",'sisiiss',[$nombre,$idlinea,$descripcion,$this->id_usuario,$this->id_usuario,$fecha,$fecha],True);

		$tematica=$bdd->select('select * from tbl_tematica where id_tematica_pk='.$id_tematica);

		return new tematica($id_tematica,$tematica[0]['nombre_tematica'],$tematica[0]['descripcion_tematica']);
	}

	public function modificartematica($nombre,$descripcion,$idtematica){
		$fecha = date("Y-m-d");
		
		$bdd = new basedatos();

		$bdd->update("update set nombre_tematica=?,descripcion_tematica=?,modificado_por=?,fecha_modificacion=? where id_tematica_pkp=?",'ssisi',[$nombre,$descripcion,$this->id_usuario,$fecha,$idtematica]);

		$tematica=$bdd->select('select * from tbl_tematica where id_tematica_pk=?','i',[$idtematica]);

		return new tematica($tematica[0]['id_tematica_pk'],$tematica[0]['nombre_tematica'],$tematica[0]['descripcion_tematica']);
	}

	public function eliminartematica($idtematica){
	$bdd->delete('delete from tbl_tematica where id_tematica_pk=?','i',[$idtematica]);
	}
}



?>