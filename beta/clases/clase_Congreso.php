<?php

/*
  Alex Siboney Vargas Osorto
  18-4-2017
  alexv7142@gmail.com
  Manejo y gestión de congresos
 */

require_once 'class_base.php';
class Congreso  {
  
    private $base;
    private $id_congreso_pk;
    private $nombre_congreso;
    private $siglas;
    private $descripcion_congreso;
    private $lugar;
    private $coordenadas;
    private $id_pais_fk;
    private $logo_congreso;
    private $lema;
    private $numero_cai;
    private $anio;
    private $fecha_inicio;
    private $fecha_finalizacion;
    private $fecha_i_recepcion;
    private $fecha_f_recepcion;
    private $fecha_i_revision;
    private $fecha_f_revision;
    private $fecha_p_programa;
    private $fecha_cambio_costo_inscripcion;
   // private $id_estado_congreso_fk;
    private $idusuario_cm;
    private $id_usuario;
   // private $fecha_creacion;
    
    public function __construct() {
        $this->base = new basedatos();
       
    }
      // $this->base = $con->abrir_conexion();
      
    
    public function cinicializar($id_congreso_pk, $nombre_congreso, $siglas, $descripcion_congreso, $lugar, $coordenadas, $id_pais_fk, $logo_congreso, $lema, $numero_cai, $anio, $fecha_inicio, $fecha_finalizacion, $fecha_i_recepcion, $fecha_f_recepcion, $fecha_i_revision, $fecha_f_revision, $fecha_p_programa, $fecha_cambio_costo_inscripcion, $idusuario_cm ) {
        $this->id_congreso_pk                      =     $id_congreso_pk;
        $this->nombre_congreso                     =     $nombre_congreso;
        $this->siglas                              =     $siglas;
        $this->descripcion_congreso                =     $descripcion_congreso;
        $this->lugar                               =     $lugar;
        $this->coordenadas                         =     $coordenadas;
        $this->id_pais_fk                          =     $id_pais_fk;
        $this->logo_congreso                       =     $logo_congreso;
        $this->lema                                =     $lema;
        $this->numero_cai                          =     $numero_cai;
        $this->anio                                =     $anio;
        $this->fecha_inicio                        =     $fecha_inicio;
        $this->fecha_finalizacion                  =     $fecha_finalizacion;
        $this->fecha_i_recepcion                   =     $fecha_i_recepcion;
        $this->fecha_f_recepcion                   =     $fecha_f_recepcion;
        $this->fecha_i_revision                    =     $fecha_i_revision;
        $this->fecha_f_revision                    =     $fecha_f_revision;
        $this->fecha_p_programa                    =     $fecha_p_programa;
        $this->fecha_cambio_costo_inscripcion      =     $fecha_cambio_costo_inscripcion;
        $this->idusuario_cm                        =     $idusuario_cm;
    
        
    }
    
    public function cinicializar2($nombre_congreso, $siglas, $descripcion_congreso, $lugar, $coordenadas, $id_pais_fk, $logo_congreso, $lema, $numero_cai, $anio, $fecha_inicio, $fecha_finalizacion, $fecha_i_recepcion, $fecha_f_recepcion, $fecha_i_revision, $fecha_f_revision, $fecha_p_programa, $fecha_cambio_costo_inscripcion, $idusuario_cm ) {
        $this->nombre_congreso                     =     $nombre_congreso;
        $this->siglas                              =     $siglas;
        $this->descripcion_congreso                =     $descripcion_congreso;
        $this->lugar                               =     $lugar;
        $this->coordenadas                         =     $coordenadas;
        $this->id_pais_fk                          =     $id_pais_fk;
        $this->logo_congreso                       =     $logo_congreso;
        $this->lema                                =     $lema;
        $this->numero_cai                          =     $numero_cai;
        $this->anio                                =     $anio;
        $this->fecha_inicio                        =     $fecha_inicio;
        $this->fecha_finalizacion                  =     $fecha_finalizacion;
        $this->fecha_i_recepcion                   =     $fecha_i_recepcion;
        $this->fecha_f_recepcion                   =     $fecha_f_recepcion;
        $this->fecha_i_revision                    =     $fecha_i_revision;
        $this->fecha_f_revision                    =     $fecha_f_revision;
        $this->fecha_p_programa                    =     $fecha_p_programa;
        $this->fecha_cambio_costo_inscripcion      =     $fecha_cambio_costo_inscripcion;
        $this->idusuario_cm                        =     $idusuario_cm;   
       // $this->fecha_creacion                      =     $fecha_creacion;
        $this->idusuario_cm                        = $idusuario_cm;
       // $this->id_estado_congreso_fk               =   2;
    }
    
    public function cinicializar3($idcongreso, $idusuario) {
        $this->id_congreso_pk   =   $idcongreso;
        $this->idusuario_cm     =   $idusuario;
    }
    
    public function cinicializar4($siglas) {
        $this->siglas   =   $siglas;
    }
    
    public function cinicializar5($nombre_congreso) {
        $this->nombre_congreso   =   $nombre_congreso;
    }
    
    public function cinicializar6($idcongreso) {
        $this->id_congreso_pk   =   $idcongreso;
    }
    public function cinicializar7($id_usuario, $idusuario_cm, $id_congreso_pk) {
        $this->id_usuario = $id_usuario;
        $this->idusuario_cm = $idusuario_cm;
        $this->id_congreso_pk = $id_congreso_pk;
    }

/*
    public function crear_congreso() {
        $datos   =   $this->base->insert("INSERT INTO tbl_congreso(nombre_congreso, siglas, descripcion_congreso, lugar, coordenadas, id_pais_fk, logo_congreso, lema, numero_cai, anio, fecha_inicio, fecha_finalizacion, fecha_i_recepcion, fecha_f_recepcion, fecha_i_revision, fecha_f_revision, fecha_p_programa, fecha_cambio_costo_inscripcion, id_estado_congreso_fk, creado_por, fecha_creacion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", "ssssssssssssssssssiis", [$this->nombre_congreso, $this->siglas, $this->descripcion_congreso, $this->lugar, $this->coordenadas, $this->id_pais_fk, "", $this->lema, $this->numero_cai, $this->anio, $this->fecha_inicio, $this->fecha_finalizacion, $this->fecha_i_recepcion, $this->fecha_f_recepcion, $this->fecha_i_revision, $this->fecha_f_revision, $this->fecha_p_programa, $this->fecha_cambio_costo_inscripcion, 2, $this->idusuario_cm, date("y-m-d")], TRUE);
       
        if(   $datos   >   0   ) {
            $this->id_congreso_pk   =   (int)$datos;
            self::subir_logo_congreso();

            return true;
        }
        else {
            return false;
        }
    } 
*/
 /*Alexis Escoto 1/11/2022
    Creacion de Formulario  Crear Congreso.
    Insert con metodo PDO
    */
    private function nombre_logo() {
        $explode         =   explode(".", $this->logo_congreso['logo_congreso']['name']);
        $size            =   sizeof($explode);
        $terminacion     =   $explode[$size - 1];
        $nombre_imagen   =   $this->id_congreso_pk."_".$this->siglas.".".$terminacion;
        return $nombre_imagen;
    }
    
public function crear_congreso() {  
    $pdo = $this->base->abrir_conexion();   
   // $nombre_logo       =   self::nombre_logo();  
    $datos   =   $pdo->prepare("INSERT INTO tbl_congreso (id_congreso_pk, nombre_congreso, siglas, 
    descripcion_congreso, lugar, 
    coordenadas,id_pais_fk,
    logo_congreso,  lema,  numero_cai, anio,  fecha_inicio,  fecha_finalizacion, fecha_i_recepcion,
     fecha_f_recepcion,
    fecha_i_revision, fecha_f_revision,  fecha_p_programa,fecha_cambio_costo_inscripcion,
    id_estado_congreso_fk, creado_por, fecha_creacion, fecha_modificacion, modificado_por) VALUES
     (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
    ?,?,?,?,?)");
    $resultado=$datos->execute([NULL, $this->nombre_congreso, $this->siglas,
    $this->descripcion_congreso, $this->lugar, $this->coordenadas, $this->id_pais_fk, $this->logo_congreso      ,
    $this->lema, $this->numero_cai, $this->anio, $this->fecha_inicio, $this->fecha_finalizacion,
    $this->fecha_i_recepcion, $this->fecha_f_recepcion, $this->fecha_i_revision, $this->fecha_f_revision,
    $this->fecha_p_programa, $this->fecha_cambio_costo_inscripcion, 2, $this->idusuario_cm, date("y-m-d"),date("y-m-d"),
    $this->idusuario_cm]);
    
    if(   $resultado   >   0   ) {
        $this->id_congreso_pk   =  $pdo-> lastInsertId();
        self::subir_logo_congreso();
        return true;
    }
    else {
        return false;
    }
}
//29-noviembre-2022
public function mostrarCongresos() {
    $datos = $this->base->select("SELECT `id_congreso_pk`, `nombre_congreso`, `siglas`, 
    `descripcion_congreso`, `lugar`, `coordenadas`, `id_pais_fk`, `logo_congreso`, `lema`, 
    `numero_cai`, `anio`, `fecha_inicio`, `fecha_finalizacion`, `fecha_i_recepcion`, `fecha_f_recepcion`,
     `fecha_i_revision`, `fecha_f_revision`, `fecha_p_programa`, `fecha_cambio_costo_inscripcion`,
      `id_estado_congreso_fk`, `nombre_estado` FROM tbl_congreso, tbl_estado_Congreso 
      WHERE id_estado_congreso_fk = id_estado_congreso_pk"); 
    return $datos;
}
//29-noviembre-2022
public function mostrarRoles($idcongreso) {
    $datos = $this->base->select("SELECT a.id_congreso_fk, a.id_rol_fk, b.nombre_rol  
    FROM tbl_roles_congreso a, tbl_roles b, tbl_congreso c WHERE a.id_rol_fk = b.id_rol_pk 
    AND a.id_congreso_fk = c.id_congreso_pk AND a.id_congreso_fk = ".$idcongreso); 
    return $datos;
}


   /*Alexis Escoto 05/12/2022
    Cuenta:20161000817
    Creacion de SELECT agregar_roles_congreso
    SELECT con metodo PDO
    */
    function select_roles_congreso(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT `id_rol_pk`, `nombre_rol` FROM `tbl_roles` WHERE 1=1");
        return $datos;
     
    }
      /*Alexis Escoto 05/12/2022
    Cuenta:20161000817
    Creacion de SELECT select_congreso_administrador
    SELECT con metodo PDO
    */
    function select_congreso_administrador(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("select distinct c.id_congreso_pk, c.nombre_congreso, c.siglas, c.id_congreso_pk from tbl_usuario_congreso_roles a, tbl_roles_congreso b, tbl_congreso c
        where a.id_rol_congreso_fk and b.tbl_rol_congreso_pk=a.id_rol_congreso_fk and c.id_congreso_pk=b.id_congreso_fk
       and b.id_rol_fk = 1 and a.id_usuario_fk = " . $_SESSION['idusuario'] . "");
        return $datos;
     
    }
public function editar() {
/*
    $consulta          =   $this->base->select("SELECT `logo_congreso` FROM `tbl_congreso` WHERE `id_congreso_pk` = 
    ".$this->id_congreso_pk."");
        $arreglo           =   mysqli_fetch_row($consulta);
        $logo_anterior     =   (string)$arreglo[0];
        self::eliminar_logo_congreso($logo_anterior);
        $nombre_logo       =   self::nombre_logo(); 
            $datos             =   $this->base->update("UPDATE `tbl_congreso` SET `nombre_congreso`=?,`siglas`=?,
    `descripcion_congreso`=?,`lugar`=?,`coordenadas`=?,`id_pais_fk`=?,`logo_congreso`=?,`lema`=?,`numero_cai`=?,
    `anio`=?,`fecha_inicio`=?,`fecha_finalizacion`=?,`fecha_i_recepcion`=?,`fecha_f_recepcion`=?,
    `fecha_i_revision`=?,`fecha_f_revision`=?,`fecha_p_programa`=?,`fecha_cambio_costo_inscripcion`=?,
    `fecha_modificacion`=?,`modificado_por`=? WHERE `id_congreso_pk`=".$this->id_congreso_pk."",
     "sssssssssssssssssssi", [$this->nombre_congreso, $this->siglas, $this->descripcion_congreso, 
     $this->lugar, $this->coordenadas, $this->id_pais_fk, $nombre_logo, $this->lema, $this->numero_cai, 
     $this->anio, $this->fecha_inicio, $this->fecha_finalizacion, $this->fecha_i_recepcion, 
     $this->fecha_f_recepcion, $this->fecha_i_revision, $this->fecha_f_revision, $this->fecha_p_programa, 
     $this->fecha_cambio_costo_inscripcion, date("y-m-d"), $this->idusuario_cm]);

     
    $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, id_tipo_log_fk)
     VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario_cm, date("y-m-d"), date('H:i:s'),
      $_SERVER['REMOTE_ADDR'], "Modificación de información básica del Congreso "
      .$this->nombre_congreso." con id ".$this->id_congreso_pk, 1]);

*/

/*
Alexis Escoto 24/11/2022
    Creacion de  SELECT Tabla congreso.
    UPDATE con metodo PDO

    Este query selecciona el logo de la tabla congreso.
*/

$pdo = $this->base->abrir_conexion();  
$datos = $pdo->prepare('SELECT logo_congreso FROM tbl_congreso WHERE id_congreso_pk = ?');
$datos->execute([$this->id_congreso_pk]);
$resultado = $datos->fetch(PDO::FETCH_ASSOC);
    $arreglo           =   $resultado;
    $logo_anterior     =   $arreglo['logo_congreso'];
    self::eliminar_logo_congreso($logo_anterior);
    $nombre_logo       =   self::nombre_logo(); 
  //  print_r ($logo_anterior);
   /// echo 'SELECT logo_congreso FROM tbl_congreso WHERE id_congreso_pk = '.$this->id_congreso_pk.'';
/*
Alexis Escoto 24/11/2022
    Creacion de  UPDATE Tabla congreso.
    UPDATE con metodo PDO

    Este query modifica los registros ingresados.
*/
$pdo = $this->base->abrir_conexion();  
     $datos =  $pdo->prepare("UPDATE tbl_congreso SET nombre_congreso=?,siglas=?,
     descripcion_congreso=?,lugar=?,coordenadas=?,id_pais_fk=?,logo_congreso=?,lema=?,numero_cai=?,
     anio=?,fecha_inicio=?,fecha_finalizacion=?,fecha_i_recepcion=?,fecha_f_recepcion=?,
     fecha_i_revision=?,fecha_f_revision=?,fecha_p_programa=?,fecha_cambio_costo_inscripcion=?,
     fecha_modificacion=?,modificado_por=? WHERE id_congreso_pk=?");
   $resultados=$datos->execute([$this->nombre_congreso, $this->siglas, $this->descripcion_congreso, 
   $this->lugar, $this->coordenadas, $this->id_pais_fk, $nombre_logo, $this->lema, $this->numero_cai, 
   $this->anio, $this->fecha_inicio, $this->fecha_finalizacion, $this->fecha_i_recepcion, 
   $this->fecha_f_recepcion, $this->fecha_i_revision, $this->fecha_f_revision, $this->fecha_p_programa, 
   $this->fecha_cambio_costo_inscripcion, date("y-m-d"), $this->idusuario_cm,$this->id_congreso_pk]);

   if(   $resultado   >   0   ) {
    self::subir_logo_congreso();
    return true;
}
else {
    return false;
}
/*
Alexis Escoto 24/11/2022
    Creacion de  INSERT Tabla LOG.
    INSERT con metodo PDO

    Cuando se modifica un congreso autimaticamente se llena la tbl_log, haciendo constar de que se esta
    modificando tal registro.
*/
      $datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
      informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
      $resultado=$datos->execute([NULL,$this->idusuario_cm, date("y-m-d"), date('H:i:s'),
      $_SERVER['REMOTE_ADDR'], "Modificación de información básica del Congreso" ,2]);
    
    
   
        
}

 

public function activar() {
    if  ( 
        self::congreso_activo()   
          /*  self::tiene_organizadores()      &&   
            self:: tiene_lineas()            &&   
            self::tiene_tematicas()          && 
            self::tiene_tipo_trabajos()      &&
            self::tiene_costos_definidos()    */  
        ) 
    {
        /*
        $activar   =   $this->base->update("UPDATE `tbl_congreso` SET `id_estado_congreso_fk`=?,
        `fecha_modificacion`=?,`modificado_por`=? WHERE `id_congreso_pk`=".$this->id_congreso_pk."", 
        "isi", [1, date("y-m-d"), $this->idusuario_cm]);

        $log       =   $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip,
         informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario_cm, 
         date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Activó el congreso con id: ".$this->id_congreso_pk."", 2]);
      */

/*
Alexis Escoto 24/11/2022
    Creacion de  UPDATE tbl_congreso y INSERT EN tbl_log
    UPDATE y INSERT con metodo PDO

  
*/

         $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("UPDATE tbl_congreso SET id_estado_congreso_fk=?,
        fecha_modificacion=?, modificado_por=?  WHERE id_congreso_pk=?");
      $resultado=$datos->execute([1, date("y-m-d"), $this->idusuario_cm,$this->id_congreso_pk]);
       
      $datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
      informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
      $resultado=$datos->execute([NULL,$this->idusuario_cm, date("y-m-d"), date('H:i:s'),
      $_SERVER['REMOTE_ADDR'], "Activó el congreso con id: ".$this->id_congreso_pk."", 2]);
       
       
        return true;
    }
    else {
        return false;
    }
}
 /*ALEXIS ESCOTO
    04-01-2023
    METODO PDO */
public function inactivar() {
    if(  self::congreso_activo()  ) {
        /*  
        $inactivar   =   $this->base->update("UPDATE `tbl_congreso` SET `id_estado_congreso_fk`=?,`fecha_modificacion`=?,`modificado_por`=? WHERE `id_congreso_pk`=".$this->id_congreso_pk."", "isi", [2, date("y-m-d"), $this->idusuario_cm]);
        $log         =   $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario_cm, date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Inactivó el congreso con id: ".$this->id_congreso_pk."", 2]);
       */

       /*ALEXIS ESCOTO 
       UPDATE Y INSERT CON METODO PDO
       05-01-2023
       */
      $pdo = $this->base->abrir_conexion();    
      $datos =  $pdo->prepare("UPDATE tbl_congreso SET id_estado_congreso_fk=?,
      fecha_modificacion=?, modificado_por=?  WHERE id_congreso_pk=?");
    $resultado=$datos->execute([2, date("y-m-d"), $this->idusuario_cm,$this->id_congreso_pk]);
  
     
    $datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
    informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
    $resultado=$datos->execute([NULL,$this->idusuario_cm, date("y-m-d"), date('H:i:s'),
    $_SERVER['REMOTE_ADDR'], "Inactivó el congreso con id: ".$this->id_congreso_pk."", 2]);


        return true;
    }
    else {
        return false;
    }
}
public function cerrar() {
    if(  self::congreso_activo()  ) {
  /*
        $activar   =   $this->base->update("UPDATE `tbl_congreso` SET `id_estado_congreso_fk`=?,`fecha_modificacion`=?,
        `modificado_por`=? WHERE `id_congreso_pk`=".$this->id_congreso_pk."", "isi", [3, date("y-m-d"), $this->idusuario_cm]);
        $log       =   $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, 
        informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario_cm, date("y-m-d"), 
        date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Cerró el congreso con id: ".$this->id_congreso_pk."", 2]);
       */

       
       /*ALEXIS ESCOTO 
       UPDATE Y INSERT CON METODO PDO
       05-01-2023
       */
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("UPDATE tbl_congreso SET id_estado_congreso_fk=?,
        fecha_modificacion=?, modificado_por=?  WHERE id_congreso_pk=?");
      $resultado=$datos->execute([3, date("y-m-d"), $this->idusuario_cm,$this->id_congreso_pk]);
    
       
      $datos =  $pdo->prepare("INSERT INTO tbl_log(id_log_pk,id_usuario_fk, fecha, hora, ip,
      informacion_extra,  id_tipo_log_fk) VALUES (?,?,?,?,?,?,?)");
      $resultado=$datos->execute([NULL,$this->idusuario_cm, date("y-m-d"), date('H:i:s'),
      $_SERVER['REMOTE_ADDR'], "Cerró el congreso con id: ".$this->id_congreso_pk."", 2]);
  
        
        
        return true;
    }
    else {
        return false;
    }
}




public function eliminar() {
    $pdo = $this->base->abrir_conexion();  
    /*
Alexis Escoto 03/01/2023
    Creacion de  SELECT  en la tabla tbl_congreso_linea_investigacion
    con metodo PDO
*/
    $registros_lineas       =     $pdo->query("SELECT `id_linea_investigacion_pk` FROM `tbl_congreso_linea_investigacion` WHERE `id_congreso_pk` = ".$this->id_congreso_pk);
    $lineas                 =      array();
    $contador_lineas        =      0;
    $contador_congreso      =      0;
    $validacion             =      false;
    foreach (   $registros_lineas   as  $value) {
        $lineas[]           =      $value['id_linea_investigacion_pk'];
    }
    for(   $i   =   0;   $i   < sizeof($lineas);   $i++   ) {
            /*
Alexis Escoto 03/01/2023
    Creacion de  DELETE  en la tabla tbl_linea_investigacion
    con metodo PDO
*/
        $linea_borrada      =      $pdo->prepare("DELETE FROM `tbl_linea_investigacion` WHERE `id_linea_investigacion_pk`=?");
        $linea_borrada      ->      execute([$lineas[$i]]);
        if(   $linea_borrada      ==   1   ) {
            $contador_lineas++;
        }
    }
    /*
    Alexis Escoto 03/01/2023
    Creacion de  DELETE  en la tabla tbl_congreso
    con metodo PDO
*/
    $congreso_borrado       =    $pdo->prepare("DELETE FROM `tbl_congreso` WHERE `id_congreso_pk`=?");
    $congreso_borrado       ->    execute([$this->id_congreso_pk]);
    if(   $congreso_borrado ==   1   ) {
        $contador_congreso++;
    }
    $validacion             =   (   $contador_congreso   ==   1   &&  $contador_lineas   == sizeof($lineas)   )   ?   true   :   false;
    return $validacion;
}

public function siglas_repetidas() {               
    $siglas     =   $this->base->select("SELECT `siglas` FROM `tbl_congreso` WHERE 1=1");
    $contador   =   0;
    foreach (   $siglas   as   $value   ) {
        if(   $value['siglas']   ==    $this->siglas) {
            $contador++;
        }
    }
    $validacion   =   (   $contador   >   0   )  ?  true   :   false;
    return $validacion;
}

public function nombre_repetido() {               
    $nombres     =   $this->base->select("SELECT `nombre_congreso` FROM `tbl_congreso` WHERE 1=1");
    $contador   =   0;
    foreach (   $nombres   as   $value   ) {
        if(   $value['nombre_congreso']   ==    $this->nombre_congreso   ) {
            $contador++;
        }
    }
    $validacion   =   (   $contador   >   0   )  ?  true   :   false;
    return $validacion;
}

private function tiene_organizadores() {
    /*ALEXIS ESCOTO
    05-01-2023
    METODO PDO */
    $pdo = $this->base->abrir_conexion();  
    $consulta     =   $pdo->query("SELECT COUNT(`id_institucion_fk`) FROM `tbl_organizadores` WHERE `id_congreso_fk` = ".$this->id_congreso_pk);
    //$arreglo      =   mysqli_fetch_row($consulta);
   //$contador     =   (int)$arreglo[0];
    $arreglo      =  $consulta->fetch(PDO::FETCH_ASSOC);
    $contador     =   (int)$arreglo;
    $validacion   =   ($contador > 0)   ?   true   :   false;
    return $validacion;
}

private function tiene_lineas() {
    /*ALEXIS ESCOTO
    05-01-2023
    METODO PDO */
    $pdo = $this->base->abrir_conexion();  
    $consulta     = $pdo->query("SELECT COUNT(`id_linea_investigacion_pk`) FROM `tbl_congreso_linea_investigacion` WHERE `id_congreso_pk` = ".$this->id_congreso_pk."");
    $arreglo      =    $consulta->fetch(PDO::FETCH_ASSOC);
    $contador     =   (int)$arreglo;
    $validacion   =   ($contador > 0)   ?   true  :  false;
    return $validacion;
}

private function tiene_tematicas() {
    $contador    =   0;
    $lineas      =   array();
    $datos       =   $this->base->select("SELECT `id_linea_investigacion_pk` FROM `tbl_congreso_linea_investigacion` WHERE `id_congreso_pk` = " . $this->id_congreso_pk);
    $tematicas   =   $this->base->select("SELECT * FROM `tbl_tematica` WHERE 1=1");
    $validacion     =   false;
    if (self::tiene_lineas()) {
        foreach ($datos as $valor) {
            $lineas[]   =   $valor['id_linea_investigacion_pk'];
        }
        foreach ($tematicas as $value) {
            for ($i = 0; $i < sizeof($lineas); $i++) {
                if ($lineas[$i]   ==   $value['id_linea_investigacion_fk']) {
                    $contador++;
                }
            }
        }
        $validacion   =   ($contador > 0) ? true : false;
        return $validacion;
    } 
    else {
        return $validacion;
    }
     
}
             
private function tiene_tipo_trabajos() {
    /*
    $consulta     =   $this->base->select("SELECT COUNT(`id_tipo_trabajo_fk`) FROM `tbl_congreso_tipo_trabajo` WHERE `id_congreso_fk`=".$this->id_congreso_pk);
    $arreglo      =   mysqli_fetch_row($consulta);
    $contador     =   (int)$arreglo[0];
*/
  /*ALEXIS ESCOTO
    05-01-2023
    METODO PDO */
    $pdo = $this->base->abrir_conexion();  
    $consulta     = $pdo->query("SELECT COUNT(`id_tipo_trabajo_fk`) FROM `tbl_congreso_tipo_trabajo` WHERE `id_congreso_fk`=".$this->id_congreso_pk);
    $arreglo      =    $consulta->fetch(PDO::FETCH_ASSOC);
    $contador     =   (int)$arreglo;
    $validacion   =   ($contador > 0)   ?   true   :   false;
    return $validacion;
}

public function tiene_costos_definidos() {
    $contador         =   0;
   /*
    $roles_congreso   =   $this->base->select("SELECT `tbl_rol_congreso_pk` FROM `tbl_roles_congreso` WHERE `id_congreso_fk` = ".$this->id_congreso_pk);
    $costos           =   $this->base->select("SELECT `costo_momento`, `costo_exposicion`, `id_rol_congreso_fk` FROM `tbl_costo`");
   */
   /*ALEXIS ESCOTO
    05-01-2023
    METODO PDO */
  $pdo = $this->base->abrir_conexion();  
  $roles_congreso     = $pdo->query("SELECT `tbl_rol_congreso_pk` FROM `tbl_roles_congreso` WHERE `id_congreso_fk` = ".$this->id_congreso_pk);
  $costos     = $pdo->query("SELECT `costo_momento`, `costo_exposicion`, `id_rol_congreso_fk` FROM `tbl_costo`");
  $roles            =   array();
    foreach ($roles_congreso as $value) {
        $roles[]      =   $value['tbl_rol_congreso_pk'];
    } 
    foreach ($costos as $value) { 
        for($i = 0; $i   < sizeof($roles);   $i++) {
            if($roles[$i]   ==   $value['id_rol_congreso_fk']) { 
                if( $value['costo_momento']   &&   $value['costo_exposicion']   !=   "") {
                    $contador++;  
                }
            }
        }
    }
    $validacion   =   (   $contador   == sizeof($roles)   )   ?   true   :   false;
    return $validacion;
}


private function congreso_activo() {
    /*ALEXIS ESCOTO 
    04-01-2023 */
    $pdo = $this->base->abrir_conexion();  
    $consulta          =    $pdo->query("SELECT `id_estado_congreso_fk` FROM `tbl_congreso` WHERE `id_congreso_pk`=".$this->id_congreso_pk);
    //$arreglo           =   mysqli_fetch_row($consulta); 
    //$estado_congreso   =   (int)$arreglo[0];
    $arreglo      =    $consulta->fetch(PDO::FETCH_ASSOC);
    $estado_congreso   =   (int)$arreglo;
    $validacion        =   ($estado_congreso == 1)   ?   true   :   false;
    return $validacion;
}

public function json_congresos() {
    require_once '../funciones/funcion_traducir.php';
    if((strlen(session_id()) < 1)) {
        session_start();
    }
    $congresos = $this->base->select("SELECT `id_congreso_pk`, `nombre_congreso`, `siglas`, `descripcion_congreso`, `lugar`, `coordenadas`, `id_pais_fk`, `logo_congreso`, `lema`, `numero_cai`, `anio`, `fecha_inicio`, `fecha_finalizacion`, `fecha_i_recepcion`, `fecha_f_recepcion`, `fecha_i_revision`, `fecha_f_revision`, `fecha_p_programa`, `fecha_cambio_costo_inscripcion`, `id_estado_congreso_fk`, `nombre_estado` FROM tbl_congreso, tbl_estado_Congreso WHERE id_estado_congreso_fk = id_estado_congreso_pk");
    $arreglo = array();
    
    foreach ($congresos as $valor) {
         $estado            =   $valor['id_estado_congreso_fk'];
         $botones           =   "";
         $roles             =   ""; 
         $consulta_roles    =   $this->base->select("SELECT a.id_congreso_fk, a.id_rol_fk, b.nombre_rol  FROM tbl_roles_congreso a, tbl_roles b, tbl_congreso c WHERE a.id_rol_fk = b.id_rol_pk AND a.id_congreso_fk = c.id_congreso_pk AND a.id_congreso_fk = ".$valor["id_congreso_pk"]);
         foreach ($consulta_roles as $key => $value) {
             $roles .= "<option value='".$value['id_rol_fk']."' id='".$value['id_rol_fk']."'>".$value['nombre_rol']."</option>";
         }
         switch($estado) {
             case 1:
                 $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='inactivarcongreso btn btn-icon waves-effect waves-light btn-warning m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button class='cerrarcongreso btn btn-icon waves-effect waves-light btn-purple m-b-5' title='@@cerrar@@'><i class='md-view-agenda'></i></button>";
                 break;
             case 2:
                 $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button><button class='eliminarcongreso btn btn-icon waves-effect waves-light btn-danger m-b-5 ' title='@@eliminar_congreso@@'><i class='fa fa-trash-o'></i></button>";
                 break;
             case 3:
                 $botones   =   "<button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button>";
         }
         $botones = traducirstring($botones, "../idiomas/".$_SESSION['idioma']."/".$_SESSION['idioma'].".php");
          $arreglo["data"][] = array(
              "id_congreso_pk"                    =>    $valor['id_congreso_pk'],
              "nombre_congreso"                   =>    $valor['nombre_congreso']." (".$valor['siglas'].").",
              "nombre"                            =>    $valor['nombre_congreso'],
              "siglas"                            =>    $valor['siglas'],
              "descripcion_congreso"              =>    $valor['descripcion_congreso'],
              "lugar"                             =>    $valor['lugar'],
              "coordenadas"                       =>    $valor['coordenadas'],
              "nombre_estado"                     =>    $valor['nombre_estado'],
              "id_pais_fk"                        =>    $valor['id_pais_fk'],
              "logo_congreso"                     =>    $valor['logo_congreso'],
              "lema"                              =>    $valor['lema'],
              "numero_cai"                        =>    $valor['numero_cai'],
              "anio"                              =>    $valor['anio'],
              "fecha_inicio"                      =>    $valor['fecha_inicio'],
              "fecha_finalizacion"                =>    $valor['fecha_finalizacion'],
              "fecha_i_recepcion"                 =>    $valor['fecha_i_recepcion'],
              "fecha_f_recepcion"                 =>    $valor['fecha_f_recepcion'],
              "fecha_i_revision"                  =>    $valor['fecha_i_revision'],
              "fecha_f_revision"                  =>    $valor['fecha_f_revision'],
              "fecha_p_programa"                  =>    $valor['fecha_p_programa'],
              "fecha_cambio_costo_inscripcion"    =>    $valor['fecha_cambio_costo_inscripcion'],
              "id_estado_congreso_fk"             =>    $valor['id_estado_congreso_fk'],
              "botones"                           =>    $botones,
              "roles"                             =>    $roles
            );
    }
    if(   sizeof($arreglo)   ==   0   ) {
        return '{
           "sEcho": 1,
           "iTotalRecords": "0",
           "iTotalDisplayRecords": "0",
           "aaData": []
         }';
    }
    else {
        return json_encode($arreglo);
    }
}

public function json_ultimo_congreso() {
    $congresos = $this->base->select("SELECT `id_congreso_pk`, `nombre_congreso`, `siglas`, `descripcion_congreso`, `lugar`, `coordenadas`, `id_pais_fk`, `logo_congreso`, `lema`, `numero_cai`, `anio`, `fecha_inicio`, `fecha_finalizacion`, `fecha_i_recepcion`, `fecha_f_recepcion`, `fecha_i_revision`, `fecha_f_revision`, `fecha_p_programa`, `fecha_cambio_costo_inscripcion`, `id_estado_congreso_fk`, `nombre_estado` FROM tbl_congreso, tbl_estado_Congreso WHERE id_estado_congreso_fk = id_estado_congreso_pk AND id_congreso_pk=".$this->id_congreso_pk."");
    $arreglo = array();
    
    foreach ($congresos as $valor) {
        require_once '../funciones/funcion_traducir.php';
        if((strlen(session_id()) < 1)) {
            session_start();
        }
         $estado    =   $valor['id_estado_congreso_fk'];
         $botones   =   "";
         switch($estado) {
             case 1:
                 $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='inactivarcongreso btn btn-icon waves-effect waves-light btn-warning m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button class='cerrarcongreso btn btn-icon waves-effect waves-light btn-purple m-b-5' title='@@cerrar@@'><i class='md-view-agenda'></i></button>";
                 break;
             case 2:
                 $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button><button class='eliminarcongreso btn btn-icon waves-effect waves-light btn-danger m-b-5 ' title='@@eliminar_congreso@@'><i class='fa fa-trash-o'></i></button>";
                 break;
             case 3:
                 $botones   =   "<button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button>";
         }
         $botones = traducirstring($botones, "../idiomas/".$_SESSION['idioma']."/".$_SESSION['idioma'].".php");
          $arreglo["data"][] = array(
              "id_congreso_pk"                    =>    $valor['id_congreso_pk'],
              "nombre_congreso"                   =>    $valor['nombre_congreso']." (".$valor['siglas'].").",
              "nombre"                            =>    $valor['nombre_congreso'],
              "siglas"                            =>    $valor['siglas'],
              "descripcion_congreso"              =>    $valor['descripcion_congreso'],
              "lugar"                             =>    $valor['lugar'],
              "coordenadas"                       =>    $valor['coordenadas'],
              "nombre_estado"                     =>    $valor['nombre_estado'],
              "id_pais_fk"                        =>    $valor['id_pais_fk'],
              "logo_congreso"                     =>    $valor['logo_congreso'],
              "lema"                              =>    $valor['lema'],
              "numero_cai"                        =>    $valor['numero_cai'],
              "anio"                              =>    $valor['anio'],
              "fecha_inicio"                      =>    $valor['fecha_inicio'],
              "fecha_finalizacion"                =>    $valor['fecha_finalizacion'],
              "fecha_i_recepcion"                 =>    $valor['fecha_i_recepcion'],
              "fecha_f_recepcion"                 =>    $valor['fecha_f_recepcion'],
              "fecha_i_revision"                  =>    $valor['fecha_i_revision'],
              "fecha_f_revision"                  =>    $valor['fecha_f_revision'],
              "fecha_p_programa"                  =>    $valor['fecha_p_programa'],
              "fecha_cambio_costo_inscripcion"    =>    $valor['fecha_cambio_costo_inscripcion'],
              "id_estado_congreso_fk"             =>    $valor['id_estado_congreso_fk'],
              "botones"                           =>    $botones
            );
    }
    if(   sizeof($arreglo)   ==   0   ) {
        return '{
           "sEcho": 1,
           "iTotalRecords": "0",
           "iTotalDisplayRecords": "0",
           "aaData": []
         }';
    }
    else {
        return json_encode($arreglo);
    }
}

public function json__congreso($id_congreso) {
    $congresos = $this->base->select("SELECT `id_congreso_pk`, `nombre_congreso`, `siglas`, `descripcion_congreso`, `lugar`, `coordenadas`, `id_pais_fk`, `logo_congreso`, `lema`, `numero_cai`, `anio`, `fecha_inicio`, `fecha_finalizacion`, `fecha_i_recepcion`, `fecha_f_recepcion`, `fecha_i_revision`, `fecha_f_revision`, `fecha_p_programa`, `fecha_cambio_costo_inscripcion`, `id_estado_congreso_fk`, `nombre_estado` FROM tbl_congreso, tbl_estado_Congreso WHERE id_estado_congreso_fk = id_estado_congreso_pk AND id_congreso_pk=".$id_congreso."");
    $arreglo = array();
    
    foreach ($congresos as $valor) {
        require_once '../funciones/funcion_traducir.php';
        if((strlen(session_id()) < 1)) {
            session_start();
        }
         $estado    =   $valor['id_estado_congreso_fk'];
         $botones   =   "";
         switch($estado) {
             case 1:
                 $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='inactivarcongreso btn btn-icon waves-effect waves-light btn-warning m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button class='cerrarcongreso btn btn-icon waves-effect waves-light btn-purple m-b-5' title='@@cerrar@@'><i class='md-view-agenda'></i></button>";
                 break;
             case 2:
                 $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button><button class='eliminarcongreso btn btn-icon waves-effect waves-light btn-danger m-b-5 ' title='@@eliminar_congreso@@'><i class='fa fa-trash-o'></i></button>";
                 break;
             case 3:
                 $botones   =   "<button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button>";
         }
         $botones = traducirstring($botones, "../idiomas/".$_SESSION['idioma']."/".$_SESSION['idioma'].".php");
          $arreglo["data"][] = array(
              "id_congreso_pk"                    =>    $valor['id_congreso_pk'],
              "nombre_congreso"                   =>    $valor['nombre_congreso']." (".$valor['siglas'].").",
              "nombre"                            =>    $valor['nombre_congreso'],
              "siglas"                            =>    $valor['siglas'],
              "descripcion_congreso"              =>    $valor['descripcion_congreso'],
              "lugar"                             =>    $valor['lugar'],
              "coordenadas"                       =>    $valor['coordenadas'],
              "nombre_estado"                     =>    $valor['nombre_estado'],
              "id_pais_fk"                        =>    $valor['id_pais_fk'],
              "logo_congreso"                     =>    $valor['logo_congreso'],
              "lema"                              =>    $valor['lema'],
              "numero_cai"                        =>    $valor['numero_cai'],
              "anio"                              =>    $valor['anio'],
              "fecha_inicio"                      =>    $valor['fecha_inicio'],
              "fecha_finalizacion"                =>    $valor['fecha_finalizacion'],
              "fecha_i_recepcion"                 =>    $valor['fecha_i_recepcion'],
              "fecha_f_recepcion"                 =>    $valor['fecha_f_recepcion'],
              "fecha_i_revision"                  =>    $valor['fecha_i_revision'],
              "fecha_f_revision"                  =>    $valor['fecha_f_revision'],
              "fecha_p_programa"                  =>    $valor['fecha_p_programa'],
              "fecha_cambio_costo_inscripcion"    =>    $valor['fecha_cambio_costo_inscripcion'],
              "id_estado_congreso_fk"             =>    $valor['id_estado_congreso_fk'],
              "botones"                           =>    $botones
            );
    }
    if(   sizeof($arreglo)   ==   0   ) {
        return '{
           "sEcho": 1,
           "iTotalRecords": "0",
           "iTotalDisplayRecords": "0",
           "aaData": []
         }';
    }
    else {
        return json_encode($arreglo);
    }
}

public function json_usuarios_congreso() {
    require_once '../funciones/funcion_traducir.php';
    if((strlen(session_id()) < 1)) {
        session_start();
    }
    $usuarios            =   $this->base->select("select DISTINCT(id_usuario_pk), nombre_usuario, correo from tbl_usuario a, tbl_persona b, tbl_correo c, tbl_usuario_congreso_roles d, tbl_roles_congreso e
                                                where a.id_persona_fk = b.id_persona_pk and b.id_persona_pk = c.id_persona_fk and a.id_usuario_pk = d.id_usuario_fk and d.id_rol_congreso_fk = e.tbl_rol_congreso_pk
                                                and e.id_congreso_fk = " . $this->id_congreso_pk . " and a.id_usuario_pk !=".$this->idusuario_cm.""); 
    $roles_por_usuario   =   $this->base->select("select id_usuario_pk, id_rol_fk from tbl_usuario a, tbl_persona b, tbl_correo c, tbl_usuario_congreso_roles d, tbl_roles_congreso e
                                                where a.id_persona_fk = b.id_persona_pk and b.id_persona_pk = c.id_persona_fk and a.id_usuario_pk = d.id_usuario_fk and d.id_rol_congreso_fk = e.tbl_rol_congreso_pk
                                                and e.id_congreso_fk = " . $this->id_congreso_pk . " and a.id_usuario_pk !=".$this->idusuario_cm."");
    $arreglo             =    array();

    foreach ($usuarios as $valor) {
        $contador   =   0;
        $botones    =   "";
        foreach ($roles_por_usuario as $valor1) {
            if ($valor['id_usuario_pk'] == $valor1['id_usuario_pk'] && $valor1['id_rol_fk'] == 1) {
                $contador++;
            }
        }
        if ($contador > 0) {
            $contador = 0;
            $botones = "<button type='button' class='quitar_administrador btn btn-danger waves-effect w-md waves-light m-b-5'>@@quitar_administrador@@</button>";
        } else {
            $botones = "<button type='button' class='agregar_administrador btn btn-primary waves-effect w-md waves-light m-b-5'>@@agregar_administrador@@</button>";
        }
        $botones = traducirstring($botones, "../idiomas/".$_SESSION['idioma']."/".$_SESSION['idioma'].".php");
        $arreglo["data"][] = array(
            "id_usuario_pk" => $valor["id_usuario_pk"],
            "nombre_usuario" => $valor["nombre_usuario"],
            "correo" => $valor["correo"],
            "botones" => $botones
        );
    }
    if (sizeof($arreglo) == 0) {
        return '{
           "sEcho": 1,
           "iTotalRecords": "0",
           "iTotalDisplayRecords": "0",
           "aaData": []
         }';
    } else {
        return json_encode($arreglo);
    }
}

public function json_usuario_congreso($idusuario, $idcongreso) {
    require_once '../funciones/funcion_traducir.php';
    if((strlen(session_id()) < 1)) {
        session_start();
    }
    $usuarios            =   $this->base->select("select DISTINCT(id_usuario_pk), nombre_usuario, correo from tbl_usuario a, tbl_persona b, tbl_correo c, tbl_usuario_congreso_roles d, tbl_roles_congreso e
                                                where a.id_persona_fk = b.id_persona_pk and b.id_persona_pk = c.id_persona_fk and a.id_usuario_pk = d.id_usuario_fk and d.id_rol_congreso_fk = e.tbl_rol_congreso_pk
                                                and e.id_congreso_fk = " . $idcongreso . " and a.id_usuario_pk=".$idusuario.""); 
    $roles_por_usuario   =   $this->base->select("select id_usuario_pk, id_rol_fk from tbl_usuario a, tbl_persona b, tbl_correo c, tbl_usuario_congreso_roles d, tbl_roles_congreso e
                                                where a.id_persona_fk = b.id_persona_pk and b.id_persona_pk = c.id_persona_fk and a.id_usuario_pk = d.id_usuario_fk and d.id_rol_congreso_fk = e.tbl_rol_congreso_pk
                                                and e.id_congreso_fk = " . $idcongreso . " and a.id_usuario_pk=".$idusuario."");
    $arreglo             =    array();

    foreach ($usuarios as $valor) {
        $contador   =   0;
        $botones    =   "";
        foreach ($roles_por_usuario as $valor1) {
            if ($valor['id_usuario_pk'] == $valor1['id_usuario_pk'] && $valor1['id_rol_fk'] == 1) {
                $contador++;
            }
        }
        if ($contador > 0) {
            $contador = 0;
            $botones = "<button type='button' class='quitar_administrador btn btn-danger waves-effect w-md waves-light m-b-5'>@@quitar_administrador@@</button>";
        } else {
            $botones = "<button type='button' class='agregar_administrador btn btn-primary waves-effect w-md waves-light m-b-5'>@@agregar_administrador@@</button>";
        }
        $botones = traducirstring($botones, "../idiomas/".$_SESSION['idioma']."/".$_SESSION['idioma'].".php");
        $arreglo["data"][] = array(
            "id_usuario_pk" => $valor["id_usuario_pk"],
            "nombre_usuario" => $valor["nombre_usuario"],
            "correo" => $valor["correo"],
            "botones" => $botones
        );
    }
    if (sizeof($arreglo) == 0) {
        return '{
           "sEcho": 1,
           "iTotalRecords": "0",
           "iTotalDisplayRecords": "0",
           "aaData": []
         }';
    } else {
        return json_encode($arreglo);
    }
}

public function quitar_administrador() { 
    $consulta = $this->base->select("SELECT `tbl_rol_congreso_pk` FROM `tbl_roles_congreso` WHERE `id_congreso_fk` = ".$this->id_congreso_pk." and `id_rol_fk` = 1;");
    $arreglo           =   mysqli_fetch_row($consulta); 
    $id_tblrolcongreso   =   (int)$arreglo[0]; 
    $datos = $this->base->delete("DELETE FROM `tbl_usuario_congreso_roles` WHERE `id_usuario_fk` = ".$this->id_usuario." and `id_rol_congreso_fk` =".$id_tblrolcongreso."");
    if($datos == 1) {
        $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario_cm, date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Quitó al usuario con ID".$this->id_usuario." como administrador del Congreso con id".$this->id_congreso_pk."", 3]);
        return true;
    }
    else {
        return false;
    }
}

public function agregar_administrador() {
    $consulta = $this->base->select("SELECT `tbl_rol_congreso_pk` FROM `tbl_roles_congreso` WHERE `id_congreso_fk` = ".$this->id_congreso_pk." and `id_rol_fk` = 1;");
    $arreglo           =   mysqli_fetch_row($consulta); 
    $id_tblrolcongreso   =   (int)$arreglo[0]; 
    $datos = $this->base->insert("INSERT INTO `tbl_usuario_congreso_roles`(`id_usuario_fk`, `id_rol_congreso_fk`, `asistira`) VALUES (?,?,?)", "iii", [$this->id_usuario, $id_tblrolcongreso, 1], TRUE);
    if($datos > 0) {
        $this->base->insert("INSERT INTO tbl_log(id_usuario_fk, fecha, hora, ip, informacion_extra, id_tipo_log_fk) VALUES(?,?,?,?,?,?)", "issssi", [$this->idusuario_cm, date("y-m-d"), date('H:i:s'), $_SERVER['REMOTE_ADDR'], "Quitó al usuario con ID".$this->id_usuario." como administrador del Congreso con id".$this->id_congreso_pk."", 3]);
        return true;
    }
    else {
        return false;
    }
}

public function subir_logo_congreso() {
    $pdo = $this->base->abrir_conexion();    
    $carpeta         =   "../img/congresos/";
    $tmp             =   $this->logo_congreso['logo_congreso']['tmp_name'];
    $nombre_imagen   =   self::nombre_logo(); 
    $src             =   $carpeta.$nombre_imagen;
    move_uploaded_file($tmp, $src);
//$this->base->update("UPDATE `tbl_congreso` SET `logo_congreso`= ? WHERE `id_congreso_pk`=".$this->id_congreso_pk."", "s", [$nombre_imagen]);  
/*
/*
Alexis Escoto 24/11/2022
    Creacion de  INSERT Y UPDATE Tabla congreso.
    INSERT con metodo PDO

    PARA SUBIR LOGO.
*/
   $datos =$pdo->prepare("UPDATE tbl_congreso 
   SET logo_congreso= ? WHERE id_congreso_pk= ?");
    $respuesta=$datos->execute([$nombre_imagen,
    $this->id_congreso_pk]);

}

private function eliminar_logo_congreso($logo) {
    $carpeta         ="../img/congresos/";
    unlink($carpeta.$logo);
}


/*
public function get_last_id_congreso() {
    $id = $this->base->select("");
}
*/
    public function get_congreso($idcongreso)
{
    $bdd = new basedatos();
    $datos = $bdd ->select("select * from tbl_usuario a, tbl_persona b, tbl_tipo_persona c, tbl_idioma d, tbl_tipo_alimentacion e, tbl_tipo_identificacion f, tbl_pais g, tbl_correo h, tbl_telefono i
                where a.nombre_usuario='$this->nusuario'
                and a.id_usuario_pk='$this->idusuario'
                and a.id_persona_fk=b.id_persona_pk
                and a.id_idioma_fk=d.id_idioma_pk
                and b.id_tipo_persona_fk=c.id_tipo_persona_pk
                and b.id_tipo_alimentacion_fk=e.id_tipo_alimentacion_pk
                and b.id_tipo_identificacion_fk=f.id_tipo_identificacion_pk
                and b.id_pais_fk=g.id_pais_pk and h.id_persona_fk=b.id_persona_pk and i.id_persona_fk=b.id_persona_pk and i.principal='1'");
        return $datos;        
}
public function get_congreso_inf()
{
    $bdd = new basedatos();
    $datos = $bdd ->select("select a.nombre_congreso, a.descripcion_congreso, a.siglas, b.nombre_estado, c.nombre_pais,a.lugar, a.fecha_inicio, a.fecha_finalizacion from tbl_congreso a 
                    join tbl_estado_congreso b on b.id_estado_congreso_pk=a.id_estado_congreso_fk
                    join tbl_pais c on c.id_pais_pk=a.id_pais_fk
                    where 1=1 and a.id_estado_congreso_fk > 0 and a.id_congreso_pk='$this->id_congreso_pk'");
    return $datos;        
}

}

?>
