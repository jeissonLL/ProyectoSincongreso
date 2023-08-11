<?php
require_once 'class_base.php';
class Tematica  {

    private $base;
    private $idlinea;
    private $idtematica;
    private $nombre_tematica;
    private $abreviacion;
    private $descripcion;
    private $comentario;
    private $idusuario;
    private $idcongreso;
    
    /*Alexis Escoto 17/11/2022
    Creacion de function construct.
    Insert con metodo PDO
    */
    public function __construct() {
        $this->base = new basedatos();
        
    }
    
    public function tematica_inicializar($idtematica, $nombre_tematica, $idlinea, $abreviacion, $descripcion, $comentario, $idusuario) {
        $this->idtematica = $idtematica;
        $this->idlinea = $idlinea;
        $this->nombre_tematica = $nombre_tematica;
        $this->abreviacion = $abreviacion;
        $this->descripcion = $descripcion;
        $this->comentario = $comentario;
        $this->idusuario = $idusuario;
    }
    

/*Alexis Escoto 01/12/2022
    Creacion de Formulario  Gestionar Líneas de Investigación.
    Insert con metodo PDO
    */

    public function crear_tematica() {
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_tematica(id_tematica_pk,nombre_tematica, abreviacion,
        descripcion_tematica,  comentarios,  id_linea_investigacion_fk,  creado_por,fecha_creacion,
        modificado_por,fecha_modificacion)
        VALUES (?,?,?,?,?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$this->nombre_tematica, $this->abreviacion,  
        $this->descripcion,$this->comentario,  $this->idlinea,
        $this->idusuario, date("y-m-d"),$this->idusuario, date("y-m-d")]);

      




        /*
        //echo $this->idtematica."<br>".$this->idlinea."<br>".$this->nombre_tematica."<br>".$this->abreviacion."<br>".$this->descripcion."<br>".$this->comentario."";
        $datos = $this->base->insert("INSERT INTO `tbl_tematica`(`nombre_tematica`, `abreviacion`, `id_linea_investigacion_fk`, `descripcion_tematica`, `comentarios`, `creado_por`, `fecha_creacion`) VALUES (?,?,?,?,?,?,?)", "ssissis", [$this->nombre_tematica, $this->abreviacion, $this->idlinea, $this->descripcion, $this->comentario, $this->idusuario, date("y-m-d")], TRUE);
        $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario, date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Creación de una temática de investigación", 1]);
        echo $datos;
        */
    }
  /*Alexis Escoto 30/11/2022
    Creacion SELECT Líneas de Investigación.
    SELECT con metodo PDO
    */

    public function mostrarTematicas() {
        $datos = $this->base->select("SELECT a.id_tematica_pk, a.nombre_tematica, b.id_linea_investigacion_pk, b.nombre_linea_investigacion, a.abreviacion, a.descripcion_tematica, a.comentarios
        FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
        WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
              b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
              c.id_congreso_pk = ".$_SESSION['idcongreso'].""); 
        return $datos;
    }

    public function modificar_tematica() {
        //echo $this->abreviacion, $this->comentario, $this->idtematica;
        /*
        $datos = $this->base->update("UPDATE tbl_tematica SET nombre_tematica=?,
         abreviacion=?, id_linea_investigacion_fk=?, descripcion_tematica=?, comentarios=?,
          modificado_por=?, fecha_modificacion=? WHERE id_tematica_pk=".$this->idtematica."", "ssissis", 
          [$this->nombre_tematica, $this->abreviacion, $this->idlinea, $this->descripcion, 
          $this->comentario, $this->idusuario, date("y-m-d")]);
*/
 /*Alexis Escoto 01/12/2022
    Creacion de UPDATE  Tabla Tematica.
    UPDATE con metodo PDO
    */
          $pdo = $this->base->abrir_conexion();    
          $datos =  $pdo->prepare("UPDATE tbl_tematica SET nombre_tematica=?,
          abreviacion=?, id_linea_investigacion_fk=?, descripcion_tematica=?, comentarios=?,
           modificado_por=?, fecha_modificacion=? WHERE id_tematica_pk=?");

        $resultado=$datos->execute([$this->nombre_tematica, $this->abreviacion,  $this->idlinea,
        $this->descripcion,  $this->comentario,  $this->idusuario, date("y-m-d"),  $this->idtematica,]);

        /*Alexis Escoto 01/12/2022
    Creacion de INSERT  tbl_log.
    INSERT con metodo PDO
    */
        $datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
        informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
        $resultado=$datos->execute([NULL,$this->idusuario, date("y-m-d"), date('H:i:s'),
        $_SERVER['REMOTE_ADDR'], "Modificación de una temática de investigación", 2]);
/*
        $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, 
        id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario, date("y-m-d"), date('H:i:s'),
         $_SERVER['REMOTE_ADDR'], "Modificación de una temática de investigación", 2]);*/
        echo $datos;
    }
    
    public function eliminar_tematica($id_tematica) {
        $dato = $this->base->delete("DELETE FROM `tbl_tematica` WHERE `id_tematica_pk` = ?", "i", [$id_tematica]);
        $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario, date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Eliminación de una temática de investigación", 3]);
        echo $dato;
        
    }
    
    public function get_ultima_linea() {
        $datos = $this->base->select("SELECT  * FROM `tbl_temmatica` WHERE 1=1 ORDER BY `id_tematica_pk` DESC LIMIT 1 ");
        echo $datos;
    }
    
    public function inicializar_linea_congreso($id_congreso) {
        $this->idcongreso = $id_congreso;
    }

        /*Alexis Escoto 04/12/2022
    Cuenta:20161000817
    Creacion de SELECT LINEAS DE INVESTIGACION
    SELECT con metodo PDO
    */
    function select_lineas_investigacion(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT a.id_linea_investigacion_pk, a.nombre_linea_investigacion
        FROM tbl_linea_investigacion a, tbl_congreso_linea_investigacion b
        WHERE a.id_linea_investigacion_pk = b.id_linea_investigacion_pk
        AND b.id_congreso_pk =".$_SESSION['idcongreso']."");
        return $datos;
    }
}
?>