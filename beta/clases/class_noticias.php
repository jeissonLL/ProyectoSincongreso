<?php

/* 
 * Clase noticia
 * Brayan Triminio
 * 28/7/17
 */
require_once  'class_base.php';
class noticias{
    private $id_noticia_pk ;
    private $titulo ;
    private $imagen ;
    private $descripcion ;
    private $id_usuario_congreso_rol_fk ;
    private $fecha ;
    private $creado_por ;
    private $fecha_creacion ;
    private $modificado_por ;
    private $fecha_modificacion ;   


    /*Metodo para visualizar las noticias por el asistente */
    public function ver_noticias(){
        $bdd = new basedatos();
        return $bdd -> select("select * from tbl_noticia"); 
    }
    
}
