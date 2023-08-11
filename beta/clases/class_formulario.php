<?php

/* 
 * Clase para manipulacion de formularios
 * Brayan Triminio
 * 02/06/2017
 */
require_once 'class_base.php';
class formulario {
    //Campos necesario para la creacion de formulario 
    private $id;
    private $nombre;
    private $desc;
    private $creado;
    private $fechacreacion;
    private $modificado;
    private $fechamodificacion;
   
    //Campos para insertar pregunta cualitativa/cuantitativa
    private $idtabla;
    private $tipopregunta;
    private $opcion;
    private $ponderacion;
    
    //Métodos
    public function iniciaformu($id,$dato1,$dato2,$dato3,$dato4,$dato5,$dato6){
        $this->id=$id;
        $this->nombre=$dato1;
        $this->desc=$dato2;
        $this->creado=$dato3;
        $this->fechacreacion=$dato4;
        $this->modificado=$dato5;
        $this->fechamodificacion=$dato6;
    }

    


    public function __construct() {
        $this->base = new basedatos();
    }

    public function insertform(){
        /*
  Alexis Escoto 22/11/2022
    Creacion de INSERT  tbl_formulario.
    Insert con metodo PDO
*/
    $pdo = $this->base->abrir_conexion();    
    $datos   =   $pdo->prepare("INSERT INTO tbl_formulario (id_formulario_pk, nombre_formulario, 
    descripcion,  creado_por, 
    fecha_creacion, modificado_por,
     fecha_modificacion) 
    VALUES (?,?,?,?,?,?,?)");
       
    $resultado=$datos->execute([NULL, $this->nombre, $this->desc,
    $this->creado,  date("y-m-d"), $this->creado, date("y-m-d") 
    ]);

}
    
    public function ultimoform() {
     $bdd = new basedatos();
     return $bdd->select("SELECT MAX(id_formulario_pk) AS id_formulario_pk FROM tbl_formulario");  
     
    }
    
    public function inipregcuali($id, $dato, $dato1, $dato2) {
        $this->idtabla      = $id ; 
        $this->nombre       = $dato ; 
        $this->id           = $dato1;
        $this->tipopregunta = $dato2; 
    }
    
    public function insertpregcuali(){
        /*
  Alexis Escoto 22/11/2022
    Creacion de INSERT  tbl_pregunta_cualitativa.
    Insert con metodo PDO
*/
    $pdo = $this->base->abrir_conexion(); 
    $datos   =   $pdo->prepare("INSERT INTO tbl_pregunta_cualitativa (id_pregunta_cualitativa_pk, 
    nombre_pregunta_cualitativa, id_formulario_fk, id_tipo_pregunta_fk) 
    VALUES (?,?,?,?)");
       
    $resultado=$datos->execute([NULL, $this->nombre, $this->id,
    $this->tipopregunta]);

    }

  /*Alexis Escoto 05/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_formulario para la tabla tbl_editar_form 
    SELECT con metodo PDO
    */
    public function mostrar_editar_form() {
    $datos = $this->base->select('SELECT * FROM tbl_formulario '); 
    return $datos;

}
/*Alexis Escoto 05/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_formulario_tematica para la tabla tbl_editar_form 
    SELECT con metodo PDO
    */
public function mostrar_editar_form_revision($idformulario) {
   
    $datos = $this->base->select("SELECT * FROM tbl_formulario_tematica a
    join tbl_tematica b on b.id_tematica_pk = a.id_tematica_fk
    where a.id_formulario_fk = ".$idformulario); 
    return $datos;
}

  /*Alexis Escoto 06/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_formulario de pantalla ASOCIAR FORMULARIO A TEMÁTICA
    SELECT con metodo PDO
    */
    public function mostrar_form_asosiar() {
        $datos = $this->base->select('select id_formulario_pk, nombre_formulario, descripcion 
        from tbl_formulario order by nombre_formulario asc'); 
        return $datos;
    
    }
    /*Alexis Escoto 06/12/2022
        Cuenta:20161000817
        Creacion de SELECT tbl_formulario_tematica de pantalla ASOCIAR FORMULARIO A TEMÁTICA
        SELECT con metodo PDO
        */
    public function mostrar_form_asosicar_tematica($idform) {
       
        $datos = $this->base->select('select a.nombre_tematica, a.id_tematica_pk from tbl_tematica a 
        join tbl_formulario_tematica b on b.id_tematica_fk = a.id_tematica_pk 
        where b.id_formulario_fk ='.$idform.''); 
        return $datos;
    }
    /* Inicilizamos las preguntas cuantitativas */
    public function inipregcuanti($id, $dato, $dato1, $dato2,$dato3, $dato4) {
        $this->idtabla      = $id ; 
        $this->nombre       = $dato ; 
        $this->opcion       = $dato1;
        $this->ponderacion  = $dato2; 
        $this->id           = $dato3;
        $this->tipopregunta = $dato4;
    }
    
    public function insertpregcuanti(){
        /*
    Alexis Escoto 22/11/2022
    Creacion de INSERT  tbl_pregunta_cuantitativa.
    Insert con metodo PDO
    */
    $pdo = $this->base->abrir_conexion(); 
    $datos   =   $pdo->prepare("INSERT INTO tbl_pregunta_cuantitativa (id_pregunta_cuantitativa_pk, 
    nombre_pregunta_cuantitativa, opciones, 
    ponderacion, id_formulario_fk, id_tipo_pregunta_fk) 
    VALUES (?,?,?,?,?,?)");
       
    $resultado=$datos->execute([NULL, $this->nombre, $this->opcion, 
     $this->ponderacion, $this->id,  $this->tipopregunta]);
}
    
    public function inicia_insert_preguntas_revista($id_pregunta_cuantitativa_pk,$nombre_pregunta_cuantitativa,$opciones,$ponderacion,$id_formulario_fk,$id_tipo_pregunta_fk){
        $this->idtabla = $id_pregunta_cuantitativa_pk;
        $this->nombre  = $nombre_pregunta_cuantitativa;
        $this->opcion  = $opciones;
        $this->ponderacion =$ponderacion;
        $this->id =$id_formulario_fk ;
        $this->tipopregunta = $id_tipo_pregunta_fk;
    }

    public function insert_preguntas_revista(){
             /*
    Alexis Escoto 22/11/2022
    Creacion de INSERT  Preguntas Revista tbl_pregunta_cuantitativa.
    Insert con metodo PDO
    */
        /*
        $bdd = new basedatos();		
        return $bdd->insert("insert into tbl_pregunta_cuantitativa(id_pregunta_cuantitativa_pk,
         nombre_pregunta_cuantitativa, opciones, ponderacion, id_formulario_fk, id_tipo_pregunta_fk) 
         values (?,?,?,?,?,?)","isssii",[$this->idtabla, 
          $this->nombre, $this->opcion, $this->ponderacion, $this->id, 
           $this->tipopregunta],True);    
           */  
          $pdo = $this->base->abrir_conexion(); 
          $datos   =   $pdo->prepare("INSERT INTO tbl_pregunta_cuantitativa (id_pregunta_cuantitativa_pk, 
          nombre_pregunta_cuantitativa, opciones, 
          ponderacion, id_formulario_fk, id_tipo_pregunta_fk) 
          VALUES (?,?,?,?,?,?)");
             
          $resultado=$datos->execute([NULL, $this->nombre, $this->opcion, 
           $this->ponderacion, $this->id,  $this->tipopregunta]);
    }
    
    public function iniciaasociartematica($idform, $idtematica){
        $this->id       = $idform;
        $this->idtabla  = $idtematica;
    }
    
    
    public function asociartematica(){
     /*
    Alexis Escoto 22/11/2022
    Creacion de INSERT Asociar tematica tbl_formulario_tematica.
    Insert con metodo PDO
    */
    $pdo = $this->base->abrir_conexion(); 

    $datos   =   $pdo->prepare("INSERT INTO tbl_formulario_tematica (id_formulario_fk, 
    id_tematica_fk) 
    VALUES (?,?)");
       
    $resultado=$datos->execute([$this->id,$this->idtabla]);
}
    
    public function inicia_modificar_pregunta_cuanti($id_pregunta_cuantitativa_pk, $nombre_pregunta_cuantitativa, $opciones,$ponderacion) {
        $this->idtabla  = $id_pregunta_cuantitativa_pk;
        $this->nombre = $nombre_pregunta_cuantitativa ;
        $this->opcion = $opciones ;
        $this->ponderacion= $ponderacion;
    }
    
    public function modifica_preguntas_cuanti(){
        $bdd = new basedatos();
        return $bdd->update("UPDATE tbl_pregunta_cuantitativa SET nombre_pregunta_cuantitativa=? , opciones=?,
         ponderacion=? where id_pregunta_cuantitativa_pk=? " ,'sssi',[$this->nombre, $this->opcion,
          $this->ponderacion,  $this->idtabla]);
    }
    
    public function inicia_modificar_pregunta_cuali($id_pregunta_cualitativa_pk, $nombre_pregunta_cualitativa) {
        $this->idtabla  = $id_pregunta_cualitativa_pk;
        $this->nombre = $nombre_pregunta_cualitativa ;
       
    }
    
    public function modifica_preguntas_cuali(){
        $bdd = new basedatos();
        return $bdd->update("update tbl_pregunta_cualitativa set nombre_pregunta_cualitativa=? where id_pregunta_cualitativa_pk=? " ,'si',[$this->nombre,  $this->idtabla]);
    }
    
      /*Alexis Escoto 02/02/2023
        Cuenta:20161000817
        Creacion de SELECT tbl_pregunta_cualitativa 
        SELECT con metodo PDO
        */
        public function pregunta_cualitativa($idformulario) {
       
            $datos = $this->base->select('SELECT * FROM  tbl_pregunta_cualitativa a
            join tbl_formulario b on b.id_formulario_pk = a.id_formulario_fk
            join tbl_tipo_pregunta c on c.id_tipo_pregunta_pk = a.id_tipo_pregunta_fk 
            where id_formulario_fk = "'.$idformulario.'"
            '); 
            return $datos;
        }  
          /*Alexis Escoto 02/02/2023
        Cuenta:20161000817
        Creacion de SELECT pregunta_cualitativa_2 
        SELECT con metodo PDO
        */
        public function pregunta_cualitativa_2($idformulario) {
       
            $datos = $this->base->select('SELECT * FROM  tbl_pregunta_cuantitativa a
            join tbl_formulario b on b.id_formulario_pk = a.id_formulario_fk
            join tbl_tipo_pregunta c on c.id_tipo_pregunta_pk = a.id_tipo_pregunta_fk 
            where id_formulario_fk = "'.$idformulario.'"
        '); 
            return $datos;
        }  
}
