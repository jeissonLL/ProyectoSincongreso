<?php
require_once 'class_base.php';
class Lineainvestigacion {

    private $base;
    private $idlinea;
    private $nombre_linea;
    private $abreviacion;
    private $descripcion;
    private $comentario;
    private $idusuario;
    private $idcongreso;
    
    public function __construct() {
        $this->base = new basedatos();
    }
    
    public function linea_inicializar($idlinea, $nombre_linea, $abreviacion, $descripcion, $comentario, $idusuario) {
        $this->idlinea = $idlinea;
        $this->nombre_linea = $nombre_linea;
        $this->abreviacion = $abreviacion;
        $this->descripcion = $descripcion;
        $this->comentario = $comentario;
        $this->idusuario = $idusuario;
    }
    
    /*Alexis Escoto 15/11/2022
    Creacion de Formulario  Gestionar Líneas de Investigación.
    Insert con metodo PDO
    */
    public function crear_linea() {
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_linea_investigacion(id_linea_investigacion_pk,
        nombre_linea_investigacion, abreviacion,
        comentarios,  descripcion_linea_investigacion,  creado_por,fecha_creacion,modificado_por,
        fecha_modificacion)
        VALUES (?,?,?,?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$this->nombre_linea, $this->abreviacion,  $this->comentario,
         $this->descripcion,
        $this->idusuario, date("y-m-d"),$this->idusuario, date("y-m-d")]);

       // $this->base->insert("INSERT INTO `tbl_congreso_linea_investigacion`(`id_congreso_pk`, `id_linea_investigacion_pk`) VALUES (?,?)", "ii", [$this->idcongreso, $datos], TRUE);
       // $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario, date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Creación de una línea de investigación", 1]);
        echo $datos;
    }
    /*Alexis Escoto 30/11/2022
    Creacion SELECT Líneas de Investigación.
    SELECT con metodo PDO
    */

    public function mostrarLineasInvestigacion() {
        $datos = $this->base->select("SELECT * FROM tbl_linea_investigacion a, 
        tbl_congreso_linea_investigacion b "
                           . "WHERE a.id_linea_investigacion_pk = 
                           b.id_linea_investigacion_pk and 
                           b.id_congreso_pk =".$_SESSION['idcongreso'].""); 
        return $datos;
    }
  
    
    public function modificar_linea() {
        /*
        $pdo = $this->base->abrir_conexion(); 
        $datos = $this->base->update("UPDATE tbl_linea_investigacion SET nombre_linea_investigacion=?,
         abreviacion=?, descripcion_linea_investigacion=?, comentarios=?, modificado_por=?,
          fecha_modificacion=? WHERE id_linea_investigacion_pk=".$this->idlinea."", "ssssis", 
          [$this->nombre_linea, $this->abreviacion, $this->descripcion, $this->comentario,
           $this->idusuario, date("y-m-d")]);
*/
        /*Alexis Escoto 23/11/2022
    Creacion de UPDATE  Gestionar Líneas de Investigación.
    UPDATE con metodo PDO
    */
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("UPDATE tbl_linea_investigacion SET nombre_linea_investigacion=?,
        abreviacion=?, descripcion_linea_investigacion=?, comentarios=?, modificado_por=?,
         fecha_modificacion=? WHERE id_linea_investigacion_pk=?");
      $resultado=$datos->execute([$this->nombre_linea, $this->abreviacion,  $this->descripcion,
       $this->comentario,  $this->idusuario, date("y-m-d"),  $this->idlinea,]);

       /*
          $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, 
        id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario, date("y-m-d"), date('H:i:s'),
         $_SERVER['REMOTE_ADDR'], "Modificación de una línea de investigación", 2]);
        echo $datos;
       */
              /*Alexis Escoto 23/11/2022
    Creacion de INSERT  tbl_log.
    INSERT con metodo PDO
    */
        $datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
        informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
        $resultado=$datos->execute([NULL,$this->idusuario, date("y-m-d"), date('H:i:s'),
        $_SERVER['REMOTE_ADDR'], "Modificación de una línea de investigación", 2]);

    }
    
    public function eliminar_linea($id_linea_i) {
        /*
        $this->base->delete("DELETE FROM tbl_congreso_linea_investigacion WHERE 
        id_linea_investigacion_pk = ".$id_linea_i);
        $dato = $this->base->delete("DELETE FROM `tbl_linea_investigacion` 
        WHERE `id_linea_investigacion_pk` = ?", "i", [$id_linea_i]);

$this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip,
informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi",
 [$this->idusuario, date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'],
  "Eliminación de una línea de investigación", 3]);
echo $dato;
*/
      $pdo = $this->base->abrir_conexion(); 
      $datos =  $pdo->prepare("DELETE FROM tbl_congreso_linea_investigacion WHERE id_linea_investigacion_pk=?");
      $datos->execute([$id_linea_i]); 

      $datos =  $pdo->prepare("DELETE FROM tbl_linea_investigacion WHERE id_linea_investigacion_pk=?");
      $datos->execute([$id_linea_i]); 
     
        $datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
        informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
        $resultado=$datos->execute([NULL,$this->idusuario, date("y-m-d"), date('H:i:s'),
        $_SERVER['REMOTE_ADDR'], "Eliminación de una línea de investigación", 3]);
        echo $dato;
    }
    
    public function get_ultima_linea() {
      //  $pdo = $this->base->abrir_conexion();  
        $datos = $this->base->select("SELECT  * FROM `tbl_linea_investigacion` WHERE 1=1 ORDER BY `id_linea_investigacion_pk` DESC LIMIT 1 ");
        echo $datos;
    }
    
    public function inicializar_linea_congreso($id_congreso) {
        //$pdo = $this->base->abrir_conexion(); 
        $this->idcongreso = $id_congreso;
    }


}
?>