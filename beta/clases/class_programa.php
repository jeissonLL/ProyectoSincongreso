<?php

/* 
 * Autor: Obed
 */
require_once 'class_base.php';
class programa{
    
    /*Variables para creación de espacios
       CREACIÓN DE ESPACIOS     */
    private $idespacio;
    private $nombre_espacio;
    private $nombre_alternativo;
    private $descripcion;
    private $cant_personas;
    private $cant_tomas;
    private $url_mapa_espacio;
    private $comentarios;  
    private $idactividad;
    private $nombre_actividad;
    private $responsable;
    private $hora_inicio_act;		
    private $hora_fin_act;        
//    private $descripcion_act;
//    private $comentarios_act;
    private $congreso;      
    private $tactividad;
    private $fecha_act;    
    private $tematica;
    private $linea_investigacion;
    
    private $idusuario_cm; 
    /*almacenar distribucion de trabajos*/
    private $idtrabajo;
    
    
    
    /*variables para almacenar programa*/
    private $idprograma;
    private $nombre_programa;
    private $descripcion_programa;
    private $estado_programa;
    private $creado_por;
    private $fecha_creacion;
    private $modificado_por;
    private $fecha_modificacion;

    public function __construct() {
        $this->base = new basedatos();
        
    }


    public function inicializar_espacios($idespacio,$nombre_espacio,$nombre_alternativo,$descripcion,$cant_personas,$cant_tomas,$url_mapa_espacio,$comentarios){
        $this->idespacio=$idespacio;       
        $this->nombre_espacio=$nombre_espacio;
        $this->nombre_alternativo=$nombre_alternativo;
        $this->descripcion=$descripcion;
        $this->cant_personas=$cant_personas;		
        $this->cant_tomas=$cant_tomas;
        $this->url_mapa_espacio=$url_mapa_espacio;
        $this->comentarios=$comentarios;
    }

    /*Alexis Escoto 18/11/2022
    Cuenta:20161000817
    Creacion de INSERT Tbl_espacio.
    Insert con metodo PDO
    */
    public function insertar_espacio(){
       /* $bdd = new basedatos();		
        return $bdd->insert("insert into tbl_espacio(id_espacio_pk,nombre_espacio, nombre_alternativo, descripcion_espacio, capacidad_personas, numero_tomacorriente, mapa_espacio, comentarios) values (?,?,?,?,?,?,?,?)","isssiiss",
        [$this->idespacio,$this->nombre_espacio,  $this->nombre_alternativo,  
        $this->descripcion,  $this->cant_personas, $this->cant_tomas,  $this->url_mapa_espacio, 
         $this->comentarios],True);
        */
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_espacio(id_espacio_pk,nombre_espacio, nombre_alternativo,
         descripcion_espacio, capacidad_personas, numero_tomacorriente, mapa_espacio, comentarios)
        VALUES (?,?,?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$this->nombre_espacio, $this->nombre_alternativo,  
        $this->descripcion,$this->cant_personas,  $this->cant_tomas,NULL, $this->comentarios]);
        
     
    }

       /*Alexis Escoto 12/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_espacio
    SELECT con metodo PDO
    */
    function tbl_espacios_creados(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT * FROM tbl_espacio a, tbl_espacio_congreso b where a.id_espacio_pk=b.id_espacio_fk");
       $resultado = $datos->fetchAll();
     
        return $resultado;
        
    }

//************************************************************************************************************************************** */
    //funcion para extraer el ultimo id insertado

     /*Alexis Escoto 18/11/2022
    Cuenta:20161000817
    Creacion de SELECT Tbl_espacio.
    Select con metodo PDO
    */

    public function getid_espacio(){
       /* $bdd = new basedatos();
        return $bdd->select("SELECT MAX(id_espacio_pk) AS id_espacio_pk FROM tbl_espacio");  */

        $pdo = $this->base->abrir_conexion();
        $datos = $pdo->query("SELECT MAX(id_espacio_pk) AS id_espacio_pk FROM tbl_espacio");    
       
      
        return $datos;
    }
//*************************************************************************************************************************************************** */
        /*FUNCION QUE ESTRAE LA INFO DE LA BD DE UN ESPACIO ESPECIFICO*/

    /*Alexis Escoto 18/11/2022
    Cuenta:20161000817
    Creacion de SELECT Tbl_espacio.
    Select con metodo PDO.
    */
    public function selectespacio($idespacio){
        /*
        $bdd = new basedatos();
        return $bdd->select("SELECT * FROM tbl_espacio where id_espacio_pk='".$idespacio."'");  
*/

        $pdo = $this->base->abrir_conexion();
        $datos=$pdo->query("SELECT * FROM tbl_espacio where id_espacio_pk='".$idespacio."'"); 
        return $datos;
        
    }

//******************************************************************************************************************************************************************** */
     /*FUNCION QUE ESTRAE LA INFO DE LA BD DE LA TBL_ACTIVIDAD_TEMATICA*/
    public function selectactividadtem($tematica){
        $bdd = new basedatos();
        return $bdd->select("SELECT * FROM tbl_actividad_tematica where id_tematica_fk='".$tematica."'");  
    }
     /*FUNCION QUE ESTRAE LOS TRABAJOS POR TEMATICA*/
    public function selecttrabajosxtem($tematica){
        $bdd = new basedatos();
        return $bdd->select("SELECT * FROM tbl_trabajo where id_tematica_fk='".$tematica."'  order by titulo_trabajo ASC");  
    }
    
    /*Alexis Escoto 18/11/2022
    Cuenta:20161000817
    Creacion de Insert Tbl_espacio_congreso.
    Insert con metodo PDO
    */
    public function insertar_espacio_congreso($idespacio,$idcongreso){
        /*$bdd = new basedatos();		
        return $bdd->insert("insert into tbl_espacio_congreso(id_espacio_fk, id_congreso_fk) 
        values (?,?)","ii",[$idespacio,$idcongreso],true);
*/
        $pdo = $this->base->abrir_conexion();   
       
        $datos =  $pdo->prepare("INSERT INTO tbl_espacio_congreso(id_espacio_fk, id_congreso_fk)
        VALUES (?,?)");

        $resultado=$datos->execute([$idespacio,$idcongreso]);
     
    }
    public function modificar_espacio(){
        /*		
        $bdd = new basedatos();
        return $bdd->update("update tbl_espacio set nombre_espacio=?,nombre_alternativo=?,descripcion_espacio=?,
        capacidad_personas=?,numero_tomacorriente=?, comentarios=? where id_espacio_pk=?",'sssiisi',[$this->nombre_espacio, 
         $this->nombre_alternativo,  $this->descripcion,  $this->cant_personas, $this->cant_tomas,  $this->comentarios,
          $this->idespacio]);
*/
/*
Alexis Escoto 12/12/2022
    Creacion de  UPDATE Tabla Espacio.
    UPDATE con metodo PDO

    Este query modifica los registros ingresados.
*/
          $pdo = $this->base->abrir_conexion();  
     $datos =  $pdo->prepare("UPDATE tbl_espacio SET nombre_espacio=?,nombre_alternativo=?,descripcion_espacio=?,
     capacidad_personas=?,numero_tomacorriente=?, comentarios=? where id_espacio_pk=?");
   $resultados=$datos->execute([$this->nombre_espacio, 
   $this->nombre_alternativo,  $this->descripcion,  $this->cant_personas, $this->cant_tomas,  $this->comentarios,
    $this->idespacio]);

    
    }

    /*Alexis Escoto 12/01/2023
    Cuenta:20161000817
    Creacion de SELECT TIPO tbl_espacio
    SELECT con metodo PDO
    */
    function tbl_espacio($idespacio){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("select * from tbl_espacio where id_espacio_pk='".$idespacio."' ");
        return $datos;
     
    }

   /* Alexis Escoto 12/01/2023
    Creacion de  DELETE  en la tabla tbl_espacio
    con metodo PDO
*/
    public function eliminar_espacio(){	
        /*	
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_espacio where id_espacio_pk=?",'i',[$this->idespacio]);
        */
        $pdo = $this->base->abrir_conexion(); 
        $espacio_borrado       =    $pdo->prepare("DELETE FROM `tbl_espacio` WHERE `id_espacio_pk`=?");
        $espacio_borrado       ->    execute([$this->idespacio]);
        return $espacio_borrado;
    }
       /* Alexis Escoto 12/01/2023
    Creacion de  DELETE  en la tabla tbl_espacio_congreso
    con metodo PDO
*/
    public function eliminar_espacio_congreso(){	
        /*	
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_espacio_congreso where id_espacio_fk=?",'i',[$this->idespacio]);
        */
        $pdo = $this->base->abrir_conexion(); 
        $espacio_congreso_borrado       =    $pdo->prepare("DELETE FROM `tbl_espacio_congreso` WHERE `id_espacio_fk`=?");
        $espacio_congreso_borrado       ->    execute([$this->idespacio]);
        return $espacio_congreso_borrado;
    }
    /*ACTUALIZAR NOMBRE IMG MAPA ESPACIO*/
    public function inicializarmodificarmapa_espacio($ubicacion,$idespacio){            
            $this->url_mapa_espacio=$ubicacion;           
            $this->idespacio=$idespacio;
        }

          /*Alexis Escoto 28/11/2022
    Cuenta:20161000817
    Creacion de Update Tbl_espacio.
    Update con metodo PDO
    */
    public function modificarmapaespacio(){		 /*
            $bdd = new basedatos();
            return $bdd->update("update tbl_espacio set mapa_espacio=? where id_espacio_pk=?",
            'si',[$this->url_mapa_espacio, $this->idespacio]);*/

            $pdo = $this->base->abrir_conexion();
            $datos =$pdo->prepare("UPDATE tbl_espacio SET mapa_espacio= ? WHERE id_espacio_pk= ?");
            $respuesta=$datos->execute([$this->url_mapa_espacio, $this->idespacio]);
    }
    
    /*FINAL CREACIóN DE ESPACIOS*/
    /*INICIO CREACIóN DE ACTIVIDAD*/    
    public function inicializar_actividad($idcongreso, $nombre_actividad, $responsable,
     $hora_inicio, $hora_fin, $comentarios, $espacio_actividad, $tactividad, $fecha,$tematica,
     $linea_investigacion){
        $this-> congreso = $idcongreso;
        $this-> nombre_actividad = $nombre_actividad;
        $this-> responsable = $responsable;
        $this-> hora_inicio_act = $hora_inicio;		
        $this-> hora_fin_act = $hora_fin;        
        $this-> comentarios = $comentarios;
        $this-> idespacio = $espacio_actividad;
        $this-> tactividad = $tactividad;
        $this-> fecha_act = $fecha;
        $this-> tematica = $tematica;
        $this-> linea_investigacion = $linea_investigacion;
      //  $this->idusuario_cm = $idusuario_cm;
    }    
    public function Insertar_Actividad(){
        /*       /*Alexis Escoto 11/11/2022
    Cuenta:20161000817
    Creacion de INSERT tbl_actividad, tbl_actividad_tematica,tbl_congreso_actividad.
    insert con metodo PDO
    */
    $verificador = -1;
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_actividad(id_actividad_pk, nombre_actividad, 
        hora_inicio, hora_final, presento, 
        id_tipo_actividad_fk, id_espacio_pk, fecha_actividad, responsable,comentarios)
                VALUES (?,?,?,?,?,?,?,?,?,?)");    
        $resultado=$datos->execute([NULL,$this->nombre_actividad,  $this->hora_inicio_act,  
        $this->hora_fin_act, NULL, $this->tactividad,  $this->idespacio,  $this->fecha_act , 
        $this->responsable, $this->comentarios]);
        if($this->idactividad  != 0)
        {
            $pdo = $this->base->abrir_conexion();    
            $col = $pdo->prepare("INSERT INTO tbl_actividad_tematica(id_actividad_fk, id_tematica_fk,
            distribucion_sesiones_paralelas)
             VALUES (?,?,?)");
             $res=$col->execute([$this->idactividad, $this->tematica, NULL]);
          if($res != -1)
          {
            $pdo = $this->base->abrir_conexion();    
            $resp = $pdo->prepare("INSERT INTO tbl_congreso_actividad(id_congreso_fk,
            id_actividad_fk, id_linea_investigacion_pk) VALUES (?,?,?)"); 
              $verificador=$resp->execute([  $this-> congreso, $this->idactividad,
            $this->linea_investigacion]);
          }

        }
        return $verificador;
  
        //echo $resultado;
//        return "INSERT INTO tbl_actividad(id_actividad_pk, nombre_actividad, hora_inicio, hora_final, presento, id_tipo_actividad_fk, id_espacio_pk, fecha_actividad, comentarios, responsable) "
//                . "values (NULL,$this->nombre_actividad,  $this->hora_inicio_act,  $this->hora_fin_act, $this->tactividad,  $this->idespacio,  $this->fecha_act,  $this->comentarios, $this->responsable)";
        

    }
                  
          /*Alexis Escoto 12/01/2023
    Cuenta:20161000817
    Creacion de SELECT select_tematica
    SELECT con metodo PDO
    */
    function select_tematica($tematica){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("select b.id_linea_investigacion_pk, b.nombre_linea_investigacion from tbl_tematica a
        join tbl_linea_investigacion b on b.id_linea_investigacion_pk=a.id_linea_investigacion_fk
        where a.id_tematica_pk='".$tematica."'");
        return $datos;
     
    }    
        
    
     

   
    
    /*Alexis Escoto 04/12/2022
    Cuenta:20161000817
    Creacion de SELECT TIPO ACTIVIDAD
    SELECT con metodo PDO
    */
    function select_tipo_actividad(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query("SELECT * FROM tbl_tipo_actividad WHERE 1=1");
        return $datos;
     
    }
              /*       /*Alexis Escoto 04/12/2022
    Cuenta:20161000817
    Creacion de SELECT ESPACIO ACTIVIDAD
    SELECT con metodo PDO
    */
    function select_espacio_actividad(){
        $pdo = $this->base->abrir_conexion(); 
        /*
        $datos = $pdo->query("SELECT b.id_espacio_pk, c.id_congreso_pk, b.nombre_espacio, c.nombre_congreso FROM tbl_espacio_congreso a
        join tbl_espacio b on a.id_espacio_fk=b.id_espacio_pk
        join tbl_congreso c on c.id_congreso_pk=a.id_congreso_fk
        where c.id_congreso_pk='".$_SESSION['idcongreso']."'");*/
        $datos = $pdo->query("SELECT b.id_espacio_pk, c.id_congreso_pk, b.nombre_espacio, c.nombre_congreso FROM tbl_espacio_congreso a
        join tbl_espacio b on a.id_espacio_fk=b.id_espacio_pk
        join tbl_congreso c on c.id_congreso_pk=a.id_congreso_fk");
        return $datos;
     
    }
 /*Alexis Escoto 04/12/2022
    Cuenta:20161000817
    Creacion de SELECT TIPO ACTIVIDAD
    SELECT con metodo PDO
    */
    function select_tematica_asociada(){
        $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query('select * from tbl_tematica a                                
        join tbl_congreso_linea_investigacion b on a.id_linea_investigacion_fk=b.id_linea_investigacion_pk 
        and b.id_congreso_pk = '.$_SESSION['idcongreso'].'
        where 1=1 group by nombre_tematica order by nombre_tematica ASC');
        return $datos;
     
    }
 /*Alexis Escoto 12/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_actividades
    SELECT con metodo PDO
    */
    function tbl_actividades(){
       $pdo = $this->base->abrir_conexion();    
        $datos = $pdo->query('select a.id_actividad_pk, a.nombre_actividad, a.responsable,concat_ws(" ",e.primer_nombre,
        e.segundo_nombre,e.primer_apellido,e.segundo_apellido ) as nombre,
         a.hora_inicio,a.hora_final,a.comentarios,a.fecha_actividad from tbl_actividad a 
        join tbl_congreso_actividad b on b.id_actividad_fk=a.id_actividad_pk
        join tbl_linea_investigacion c on c.id_linea_investigacion_pk=b.id_linea_investigacion_pk
        join tbl_usuario d on d.id_usuario_pk=a.responsable
        join tbl_persona e on e.id_persona_pk=d.id_persona_fk                            
        where b.id_congreso_fk='.$_SESSION['idcongreso'].'');

     
        return $datos;
        
    }

    /*Alexis Escoto 19/12/2022
    Cuenta:20161000817
    Creacion de listas_de_actividad
    SELECT con metodo PDO
    */
    function listas_de_actividad($idcongreso){
        $pdo = $this->base->abrir_conexion();  
     
        $datos = $pdo->query('select a.*, c.id_programa_fk, d.nombre_programa, e.nombre_espacio  from tbl_actividad a 
        join tbl_programa_actividad c on c.id_actividad_fk = a.id_actividad_pk
        join tbl_programa d on d.id_programa_pk = c.id_programa_fk
        join tbl_espacio e on e.id_espacio_pk = a.id_espacio_pk
        join  tbl_espacio_congreso f on f.id_espacio_fk = e.id_espacio_pk
        where f.id_congreso_fk ="'.$idcongreso.'" 
        ');
        return $datos;
     
    }

     /*Alexis Escoto 12/01/2023
    Cuenta:20161000817
    Creacion de funcion auto_completar
    SELECT con metodo PDO
    */
    function auto_completar($responsable){
        $pdo = $this->base->abrir_conexion();  
     
        $datos = $pdo->select("select * from tbl_usuario a
        join tbl_persona b on a.id_persona_fk=b.id_persona_pk
        join tbl_correo c on c.id_persona_fk=a.id_persona_fk and c.principal='1'
        where 1=1 and (a.nombre_usuario like '".$responsable."%') or (b.primer_nombre like '".$responsable."%') or (c.correo like '".$responsable."%')");
        return $datos;
     
    }

    //funcion para extraer el ultimo id insertado
    public function getid_actividad(){
        $bdd = new basedatos();
        return $bdd->select("SELECT MAX(id_espacio_pk) AS id_espacio_pk FROM tbl_espacio");  
    }
    public function insertar_actividad_congreso(){
        $bdd = new basedatos();		
        return $bdd->insert("insert into tbl_espacio_congreso(id_espacio_fk, id_congreso_fk) values (?,?)","ii",[$this->idespacio,  $this->congreso],true);
    }
    public function inicializar_id_actividad($idactividad){
        $this->idactividad  = $idactividad;
    }   
    
    public function modificar_actividad(){		
        $bdd = new basedatos();
        $verificador = 0;
        $verificador = $bdd->update("UPDATE tbl_actividad SET nombre_actividad=?,hora_inicio=?,hora_final=?,presento=0,id_tipo_actividad_fk=?,id_espacio_pk=?,fecha_actividad=?,comentarios=?,responsable=? WHERE 1=1 and id_actividad_pk=$this->idactividad",'sssiissi',[$this->nombre_actividad,  $this->hora_inicio_act,  $this->hora_fin_act, $this->tactividad,  $this->idespacio,  $this->fecha_act,  $this->comentarios, $this->responsable]);
        if($verificador != -1)
        {
            $verificador = $bdd->update("UPDATE tbl_actividad_tematica SET id_tematica_fk=? WHERE 1=1 and id_actividad_fk=$this->idactividad",'i',[$this->tematica]);
            return $verificador;
        }else{
            return $verificador;
        }
    }
    
    
    
    //            return "UPDATE tbl_actividad_tematica SET id_tematica_fk=$this->tematica WHERE 1=1 and id_actividad_fk=$this->idactividad";
//        return "UPDATE tbl_actividad SET nombre_actividad=$this->nombre_actividad,hora_inicio=$this->hora_inicio_act,hora_final=$this->hora_fin_act,presento=0,"
//                . "id_tipo_actividad_fk=$this->tactividad,id_espacio_pk=$this->idespacio,fecha_actividad=$this->fecha_act"
//        . ",comentarios=$this->comentarios,responsable=$this->responsable WHERE 1=1 and id_actividad_pk=$this->idactividad";
  

/*Alexis Escoto 12/01/2023
   Creacion de  DELETE  en la tabla tbl_actividad
   con metodo PDO
 */
public function eliminar_actividad(){		
       /*
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_actividad where id_actividad_pk=?",'i',[$this->idactividad]);
*/
        $pdo = $this->base->abrir_conexion(); 
        $eliminar_actividad      =    $pdo->prepare("DELETE FROM `tbl_actividad` WHERE `id_actividad_pk`=?");
        $eliminar_actividad       ->    execute([$this->idactividad]);
        return $eliminar_actividad;
    }
/*  Alexis Escoto 12/01/2023
    Creacion de  DELETE  en la tabla tbl_congreso_actividad
    con metodo PDO
*/
    public function eliminar_actividad_tematica(){		
      /*tbl_congreso_actividad
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_congreso_actividad where id_actividad_fk=?",'i',[$this->idactividad]);
//        return "delete from tbl_congreso_actividad where id_actividad_fk=$this->idactividad";
*/
       $pdo = $this->base->abrir_conexion(); 
       $eliminar_actividad_tematica      =    $pdo->prepare("DELETE FROM `tbl_actividad_tematica` WHERE `id_actividad_fk`=?");
       $eliminar_actividad_tematica       ->    execute([$this->idactividad]);
       return $eliminar_actividad_tematica;
    }
/*  Alexis Escoto 12/01/2023
    Creacion de  DELETE  en la tabla tbl_actividad_tematica
    con metodo PDO
*/
    public function eliminar_actividad_congreso(){		
       /* $bdd = new basedatos();
        return $bdd->delete("delete from tbl_actividad_tematica where id_actividad_fk=?",'i',[$this->idactividad]);*/
        $pdo = $this->base->abrir_conexion(); 
        $eliminar_actividad_congreso      =    $pdo->prepare("DELETE FROM `tbl_congreso_actividad` WHERE `id_actividad_fk`=?");
        $eliminar_actividad_congreso       ->    execute([$this->idactividad]);
        return $eliminar_actividad_congreso;
    }    
    
    /*FINAL CREACIóN DE ACTIVIDAD*/    
    
    /*insertar distribucion en sesiones paralelas   OBED*/
    public function agregar_distribucion_sesiones_paralelas($distrib){
        $bdd = new basedatos();	
        $result = 0;  
        $result = $bdd->update("UPDATE tbl_actividad_tematica SET distribucion_sesiones_paralelas=? WHERE id_tematica_fk=$this->tematica",'i',[$distrib]);
         if($result != -1){
             echo 1;
         }else{
             echo 0;
         }
    }
    public function inicializar_actividad_trabajos($idactividad,$idtrabajo){
        $this->idactividad  = $idactividad;
        $this->idtrabajo = $idtrabajo;
    }
    public function eliminar_actividad_trabajos(){		
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_actividad_trabajo where id_actividad_fk=?",'i',[$this->idactividad]);
    }
    public function insertar_actividad_trabajos(){		
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_actividad_trabajo(id_actividad_fk, id_trabajo_fk) values (?,?)","ii",[$this->idactividad,$this->idtrabajo],true);
    }
    public function update_actividad_trabajos() {        
        $bdd = new basedatos();	
        $result = 0;  
        $result = $bdd->update("UPDATE tbl_actividad_trabajo SET id_actividad_fk=? WHERE id_trabajo_fk=$this->idtrabajo",'i',[$this->idactividad]);
         if($result != -1){
             echo 1;
         }else{
             echo 0;
         }
    }
    
    /*
     * 
     * PROGRAMA
     * 
     *      */
    public function inicializar_programa($idprograma,$nombre_programa,$descripcion, $estado, $usuario, $fecha_creacion, $usuario_modifica, $fecha_modifica){
        $this->idprograma = $idprograma;
        $this->nombre_programa = $nombre_programa;
        $this->descripcion_programa = $descripcion;
        $this->estado_programa = $estado;
        $this->creado_por = $usuario;
        $this->fecha_creacion = $fecha_creacion;
        $this->modificado_por = $usuario_modifica;
        $this->fecha_modificacion = $fecha_modifica;
    }
    /*  Alexis Escoto 13/01/2023
    Creacion de  DELETE  en la tabla tbl_programa_actividad y  tbl_programa
    con metodo PDO
*/
    public function eliminar_programa(){	
        /*	
        $bdd = new basedatos();
        $resultado1 = $bdd->delete("delete from tbl_programa_actividad where id_programa_fk=?",'i',[$this->idprograma]);
        return $resultado = $bdd->delete("delete from tbl_programa where id_programa_pk=?",'i',[$this->idprograma]);        
       */
        $pdo = $this->base->abrir_conexion(); 
        $resultado1=$pdo->prepare("DELETE FROM `tbl_programa_actividad` WHERE `id_programa_fk`=?");
        $resultado1-> execute([$this->idprograma]);

        $resultado=$pdo->prepare("DELETE FROM `tbl_programa` WHERE `id_programa_pk`=?");
        $resultado-> execute([$this->idprograma]);
        return $resultado;
     }
   
      /*  Alexis Escoto 13/01/2023
    Creacion de  DELETE  en la tabla tbl_programa_actividad
    con metodo PDO
*/
    public function eliminar_act_programa($idact, $idprograma){	
        /*	
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_programa_actividad where id_programa_fk=? 
        and id_actividad_fk=?",'ii',[$idprograma,$idact]);  
*/
        $pdo = $this->base->abrir_conexion(); 
        $resultado1=$pdo->prepare("DELETE FROM `tbl_programa_actividad` WHERE `id_programa_fk`=?  and id_actividad_fk=?" );
        $resultado1-> execute([$idprograma,$idact]);
        return $resultado1;
    }

     /*Alexis Escoto 13/01/2023
    Creacion de SEECT  tbl_actividad.
    Insert con metodo PDO
    */
    public function get_act_por_congreso($idcongreso) {
        $pdo = $this->base->abrir_conexion();  
        $datos= $pdo->query("select * from tbl_actividad a  
                join tbl_actividad_trabajo b on a.id_actividad_pk = b.id_actividad_fk
                join tbl_actividad_tematica c on a.id_actividad_pk = c.id_actividad_fk
                join tbl_tematica d on c.id_tematica_fk = d.id_tematica_pk                
                join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_fk=e.id_linea_investigacion_pk and e.id_congreso_pk = ".$idcongreso."               
                where 1=1 group by a.fecha_actividad , a.hora_inicio
                order by a.fecha_actividad , a.hora_inicio asc");
        return $datos;
    }
      /*Alexis Escoto 13/01/2023
    Creacion de INSERT  tbl_programa_actividad.
    Insert con metodo PDO
    */
    public function insertar_programa_actividad($idprograma, $idactividad){		
        /*
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_programa_actividad(id_programa_fk, id_actividad_fk ) 
        values (?,?)","ii",[$idprograma, $idactividad],true);
    */
    $pdo = $this->base->abrir_conexion();    
    $datos =  $pdo->prepare("INSERT INTO tbl_programa_actividad(id_programa_fk, id_actividad_fk )
    VALUES (?,?)");

    $resultado=$datos->execute([$idprograma, $idactividad]);
    }

    /*Alexis Escoto 21/11/2022
    Creacion de INSERT  Programa.
    Insert con metodo PDO
    */
    public function insertar_programa(){	
        /*	
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_programa(nombre_programa, 
        estado_programa, descripcion, creado_por, fecha_creacion, modificado_por, 
        fecha_modificacion ) values (?,?,?,?,?,?,?)","sisisis",[$this->nombre_programa,$this->estado_programa,
         $this->descripcion_programa, $this->creado_por, $this->fecha_creacion, $this->modificado_por,
          $this->fecha_modificacion ],true);
       */
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_programa(id_programa_pk,nombre_programa, estado_programa, 
        descripcion, creado_por, fecha_creacion, modificado_por, fecha_modificacion)
        VALUES (?,?,?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$this->nombre_programa, $this->estado_programa,  
        $this->descripcion_programa,$this->creado_por,  
        date("y-m-d"), $this->creado_por, date("y-m-d")]);

        //echo $datos;
  
    }
    /*Alexis Escoto 08/12/2022
    Cuenta:20161000817
   UPDATE CON METODO PDO , de la tabla   tbl_programa
 
    */
    public function update_programa() {        
        $pdo = $this->base->abrir_conexion();  
        $result = 0;  
        $result = $pdo->prepare("UPDATE tbl_programa SET nombre_programa=?, estado_programa=?, descripcion=?,
        modificado_por=?, fecha_modificacion=?  WHERE id_programa_pk=?");
      $resultados=$result->execute([$this->nombre_programa,$this->estado_programa, $this->descripcion_programa, $this->modificado_por, 
      date("y-m-d"),$this->idprograma]);
         if($resultados != -1){
             echo 1;
         }else{
             echo 0;
         }


    }
    /*FIN programa
     *  OBED*/
    
    /*ALEXIS ESCOTO 20/12/2022
       DISTRIBUCION DE TRABAJOS EN SESIONES PARALELAS, SELECT UTILIZANDO en la tabla con METODO PDO
       */
      public function tbr_encotrados(){
        $pdo = $this->base->abrir_conexion();  
       $idtematica = filter_input(INPUT_POST, 'idtematica');
       $idcongreso = $_SESSION['idcongreso'];
       $datos = $this->base->select("select a.*, b.*, c.*, d.* from tbl_trabajo a 
                               join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                               join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                               join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                               join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                               where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."' and b.id_tematica_pk='".$idtematica."'"); 
       
                         
    } 
     /*ALEXIS ESCOTO 20/12/2022
       DISTRIBUCION DE TRABAJOS EN SESIONES PARALELAS, SELECT UTILIZANDO en la tabla con METODO PDO
       */              
    public function divact_encontradas(){
        $pdo = $this->base->abrir_conexion(); 
        $idtematica = filter_input(INPUT_POST, 'idtematica');
        $idcongreso = $_SESSION['idcongreso'];
     $datos = $this->base->select("select a.*, b.*, c.*
             from tbl_actividad a 
             join tbl_actividad_tematica b on a.id_actividad_pk = b.id_actividad_fk  
             join tbl_congreso_actividad c on a.id_actividad_pk = c.id_actividad_fk
             where b.id_tematica_fk = '".$idtematica."' and c.id_congreso_fk = '".$idcongreso."'"); 
        
        
        }
    
          /*Alexis Escoto 20/12/2022
    Cuenta:20161000817
    Creacion de tbl_distribucion_tematica
    SELECT con metodo PDO
    */
    public function tbl_distribucion_tematica(){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query("select DISTINCT a.id_tematica_fk, a.distribucion_sesiones_paralelas, b.nombre_tematica from tbl_actividad_tematica a 
        join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk                
        join tbl_congreso_linea_investigacion c on b.id_linea_investigacion_fk=c.id_linea_investigacion_pk and c.id_congreso_pk = ".$_SESSION['idcongreso']." 
        where a.distribucion_sesiones_paralelas NOT LIKE 'NULL'");
        return $datos;
       
    }
       /*Alexis Escoto 08/12/2022
    Cuenta:20161000817
    Creacion de tbl_programacreado
    SELECT con metodo PDO
    */
    public function tbl_programacreado(){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query("select * from  tbl_programa a 
        join tbl_programa_actividad b on a.id_programa_pk = b.id_programa_fk 
        join tbl_actividad c on b.id_actividad_fk= c.id_actividad_pk
        join tbl_actividad_tematica d on b.id_actividad_fk = d.id_actividad_fk                
        join tbl_tematica e on d.id_tematica_fk = e.id_tematica_pk                
        join tbl_congreso_linea_investigacion f on e.id_linea_investigacion_fk=f.id_linea_investigacion_pk 
        where 1=1 and f.id_congreso_pk = ".$_SESSION['idcongreso']);
        return $datos;
       
    }
  
         /*Alexis Escoto 08/12/2022
    Cuenta:20161000817
    Creacion de funcion modificar_programa para seleccionar  y mostrar el registro que se editara
    SELECT con metodo PDO
    */
    public function modificar_programa(){
        
        $pdo = $this->base->abrir_conexion();  
        $idprograma = filter_input(INPUT_POST, 'idprograma');
        $datos = $pdo->query("select  * from  tbl_programa a 
        join tbl_programa_actividad b on a.id_programa_pk = b.id_programa_fk 
        join tbl_actividad c on b.id_actividad_fk= c.id_actividad_pk
        join tbl_actividad_tematica d on b.id_actividad_fk = d.id_actividad_fk                
        join tbl_tematica e on d.id_tematica_fk = e.id_tematica_pk                
        join tbl_congreso_linea_investigacion f on e.id_linea_investigacion_fk=f.id_linea_investigacion_pk and f.id_congreso_pk = ".$_SESSION['idcongreso']."
        where 1=1 and a.id_programa_pk=".$idprograma);

        
        return $datos;
       
    }

       /*Alexis Escoto 10/01/2023
    Cuenta:20161000817
    Creacion de mostrar_tbl_asis_programa
    SELECT con metodo PDO
    */
    public function mostrar_tbl_asis_programa(){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query('select * from tbl_tipo_actividad 
        ');
        return $datos;
       
    }
       /*Alexis Escoto 10/01/2023
    Cuenta:20161000817
    Creacion de mostrar_actividad_programa
    SELECT con metodo PDO
    */
    public function mostrar_actividad_programa($idcongreso,$idtpoactividad){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query('select a.*, c.id_programa_fk, d.nombre_programa, e.nombre_espacio  from tbl_actividad a 
        join tbl_programa_actividad c on c.id_actividad_fk = a.id_actividad_pk
        join tbl_programa d on d.id_programa_pk = c.id_programa_fk
        join tbl_espacio e on e.id_espacio_pk = a.id_espacio_pk
        join  tbl_espacio_congreso f on f.id_espacio_fk = e.id_espacio_pk
        where f.id_congreso_fk ="'.$idcongreso.'" and a.id_tipo_actividad_fk = "'.$idtpoactividad.'"
        ');
        return $datos;
       
    }

}

/*Brayan Crear Itinerario*/

class itinerario extends programa{
    private  $id_usuario_fk;
    private  $idactividad ;/*Este creo que deberia ser publico*/
    private  $congreso ;/*Este creo que deberia ser publico*/
    private  $asistio ;
    
    public function inicia_crear_itinerario($idusuario,$idactividad,$idcongreso,$asistio){
        $this->id_usuario_fk    = $idusuario ;
        $this->idactividad      = $idactividad ;
        $this->congreso         = $idcongreso ;
        $this->asistio          = $asistio ;
    }
    public function __construct() {
        $this->base = new basedatos();
        
    }
    /* ALEXIS ESCOTO
    INSERT PDO
    10-01-2023 */
    public function crear_itinerario(){
/*
       $bdd = new basedatos();		
       return $bdd->insert("insert into tbl_usuario_actividad_congreso(id_usuario_fk, 
       id_actividad_fk, id_congreso_fk, asistio) values (?,?,?,?)","iiii",
       [$this->id_usuario_fk ,$this->idactividad, $this->congreso, $this->asistio],true); 
*/
       return $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("insert into tbl_usuario_actividad_congreso(id_usuario_fk, 
        id_actividad_fk, id_congreso_fk, asistio) values (?,?,?,?)");

        $resultado=$datos->execute([$_SESSION['idusuario'] ,$this->idactividad, $this->congreso, $this->asistio]);
   
    }
    
    public function actividades_usuario($idusuario, $idcongreso){
       $bdd = new basedatos();		
       return $bdd->select("select * from tbl_usuario_actividad_congreso where id_usuario_fk='".$idusuario."' and id_congreso_fk ='".$idcongreso."' ");          
    }
    
    public function inicia_eliminar_actividad_itineario($idactividad , $idusuario, $idcongreso){
        $this->idactividad      = $idactividad;
        $this->id_usuario_fk    = $idusuario;
        $this->congreso         = $idcongreso;
    }
    
    public function eliminar_actividad_itinerario(){
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_usuario_actividad_congreso where id_actividad_fk=? and id_usuario_fk=? and id_congreso_fk=?" ,'iii',[$this->idactividad, $this->id_usuario_fk, $this->congreso] );
    }
    
    public function inicia_eliminar_itinerario_usuario($idusuario, $idcongreso, $idactividad){
        $this->id_usuario_fk    = $idusuario;
        $this->congreso         = $idcongreso;
        $this->idactividad      = $idactividad ;
    }

    public function eliminar_itinerario_usuario(){
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_usuario_actividad_congreso where id_usuario_fk=? and id_congreso_fk=? and id_actividad_fk=?" ,'iii',[$this->id_usuario_fk, $this->congreso, $this->idactividad] );
    }

      /*Alexis Escoto 10/01/2023
    Cuenta:20161000817
    Creacion de tbl_asis_c_itineraio
    SELECT con metodo PDO
    */
    public function tbl_asis_c_itineraio($idcongreso,$idtpoactividad){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query('select a.*, c.id_programa_fk, d.nombre_programa, e.nombre_espacio  from tbl_actividad a 
        join tbl_programa_actividad c on c.id_actividad_fk = a.id_actividad_pk
        join tbl_programa d on d.id_programa_pk = c.id_programa_fk
        join tbl_espacio e on e.id_espacio_pk = a.id_espacio_pk
        join  tbl_espacio_congreso f on f.id_espacio_fk = e.id_espacio_pk
        where f.id_congreso_fk ="'.$idcongreso.'" and a.id_tipo_actividad_fk = "'.$idtpoactividad.'"
        ');
        return $datos;
       
    }
        /*Alexis Escoto 10/01/2023
    Cuenta:20161000817
    Creacion de mostrar_itinerario
    SELECT con metodo PDO
    */
    public function mostrar_itinerario(){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query('select * from tbl_tipo_actividad 
        ');
        return $datos;
       
    }
         /*Alexis Escoto 10/01/2023
    Cuenta:20161000817
    Creacion de mostrar_tbl_tipo_actividad
    SELECT con metodo PDO
    */
    public function mostrar_tbl_tipo_actividad(){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query('select * from tbl_tipo_actividad 
        ');
        return $datos;
       
    }
        /*Alexis Escoto 10/01/2023
    Cuenta:20161000817
    Creacion de tbl_asis_c_itineraio
    SELECT con metodo PDO
    */
    public function tbl_asis_modifcar_itineraio($idcongreso,$idtpoactividad){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query('select a.*, c.id_programa_fk, d.nombre_programa, e.nombre_espacio  from tbl_actividad a 
        join tbl_programa_actividad c on c.id_actividad_fk = a.id_actividad_pk
        join tbl_programa d on d.id_programa_pk = c.id_programa_fk
        join tbl_espacio e on e.id_espacio_pk = a.id_espacio_pk
        join  tbl_espacio_congreso f on f.id_espacio_fk = e.id_espacio_pk
        where f.id_congreso_fk ="'.$idcongreso.'" and a.id_tipo_actividad_fk = "'.$idtpoactividad.'"
        ');
        return $datos;
       
    }
            /*Alexis Escoto 10/01/2023
    Cuenta:20161000817
    Creacion de tbl_usuario_actividad_congreso
    SELECT con metodo PDO
    */
    public function tbl_usuario_actividad_congreso($idactividad,$idcongreso,$idusuario){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query('select *  from tbl_usuario_actividad_congreso where 
        id_actividad_fk = "'.$idactividad.'" and id_congreso_fk="'.$idcongreso.'" and id_usuario_fk= "'.$idusuario.'"
        ');
        return $datos;
       
    }
}
