<?php
/*
Clase 
creado por:  OM
fecha: 24/02/17

*/
require_once 'class_base.php';
require_once 'class_persona.php';

class trabajo {
        private $idtrabajo;
	private $titulotrabajo;
	private $fecha;
	private $ubicacionarchivo;
        private $resumen;
        private $idestado;
        private $idtematica;
        private $premio;
        private $revista;
        private $horario;
        private $idtipotrabajo;
        private $idioma;
        private $palabrasclave;
        private $resumenprograma;
        
        //tematicas
        private $idtematicas;
        private $principal;
        
        //premios
        private $idpremio;
        
        //usuario trabajo
        private $idusuario;
        private $subio;
        private $autor_principal;
        private $coautor;
        private $expositor;
        private $autoria;
        private $autor_correspondencia;

        //version del trabajo
        private $version_editor_gestor;
        private $version_aprobado_conrevision;
        private $descripcion;
        //expositores
        private $valor;
        public function __construct() {
            $this->base = new basedatos();
            
        }
        public function inicializartrabajo($titulotrabajo,
        $fecha,$ubicacionarchivo,$resumen,$idestado,$idtematica,$id_citacion_fk, 
        $premio,$revista,$horario,$idtipotrabajo,$idioma,$palabrasclave,$resumenprograma){
		//$this->idtrabajo=$idtrabajo;
		$this->titulotrabajo=$titulotrabajo;
                $this->fecha=$fecha;
                $this->ubicacionarchivo=$ubicacionarchivo;		
                $this->resumen=$resumen;
                $this->idestado=$idestado;
                $this->idtematica=$idtematica;
                $this->id_citacion_fk =$id_citacion_fk ;
                $this->premio=$premio;
                $this->revista=$revista;
                $this->horario=$horario;
                $this->idtipotrabajo=$idtipotrabajo;
                $this->idioma=$idioma;
                $this->palabrasclave=$palabrasclave;
                $this->resumenprograma=$resumenprograma;
                
	}
        public function inicializartematicas($idtrabajo,$idtematicas,$principal){
            $this->idtrabajo=$idtrabajo;
            $this->idtematicas=$idtematicas;
            $this->principal=$principal;
        }
        public function inicializarpremios($idpremio,$idtrabajo){            
            $this->idpremio=$idpremio;           
            $this->idtrabajo=$idtrabajo;
        }
        public function inicializarmodificarubicacion($ubicacion,$idtrabajo){            
            $this->ubicacionarchivo=$ubicacion;           
            $this->idtrabajo=$idtrabajo;
        }
        public function inicializarusuariotrabajo($idusuario,$idtrabajo,$subio,$autor_principal,$coautor,$expositor,$autoria,$autor_correspondencia) {
            $this->idusuario=$idusuario;           
            $this->idtrabajo=$idtrabajo;
            $this->subio=$subio;
            $this->autor_principal=$autor_principal;
            $this->coautor=$coautor;
            $this->expositor=$expositor;
            $this->autoria=$autoria;
            $this->autor_correspondencia=$autor_correspondencia;
                    
        }
        public function inicializarautorprincipalut($idt) {
            $this->idtrabajo=$idt;
        }
        public function inicializarversiontrabajo($ubicaciontrabajo, $version_editor_gestor, $version_aprobado_conrevision, $descripcion, $idusuariosubio, $idtrabajo, $fechasubida) {
            $this->ubicacionarchivo=$ubicaciontrabajo;
            $this->version_editor_gestor=$version_editor_gestor;
            $this->version_aprobado_conrevision=$version_aprobado_conrevision;
            $this->descripcion=$descripcion;
            $this->idusuario=$idusuariosubio;
            $this->idtrabajo=$idtrabajo;
            $this->fecha=$fechasubida;
            
        }
        public function inicializarexpositores($idusuario, $valor, $idt){
            $this->idusuario = $idusuario;
            $this->valor = $valor;
            $this->idtrabajo = $idt;
        }
        public function inicializarautorcorrespondencia($idusuario, $valor, $idt){
            $this->idusuario = $idusuario;
            $this->valor = $valor;
            $this->idtrabajo = $idt;
        }
        public function aautorias($idusuariotrabajo,$valor){
            $bdd = new basedatos();
            return $bdd->update("update tbl_usuario_trabajo set autoria=? where id_usuario_trabajo_pk=?",'ii',[$valor, $idusuariotrabajo]);
        }
    /*Alexis Escoto 18/01/2023
    Creacion de UPDATE  tbl_presentacion_trabajos .
    Insert con metodo PDO
    NO EXISTE TABLA
    */
        public function aceptarhorario($valor){
            /*$bdd = new basedatos();
            return $bdd->update("update tbl_presentacion_trabajos set horario_aceptado=? where id_trabajo_fk=?",'ii',[$valor, $this->idtrabajo]);
       */
      $pdo = $this->base->abrir_conexion(); 
      $datos =  $pdo->prepare("UPDATE tbl_presentacion_trabajos SET horario_aceptado=?  WHERE id_trabajo_fk=?");
      $resultado=$datos->execute([$valor, $this->idtrabajo]);
      return $resultado;
        }

        public function get_id(){
		return $this->idtrabajo;
	}
    /*Alexis Escoto 18/01/2023
    Cuenta:20161000817
    Creacion de SELECT tbl_trabajo
    SELECT con metodo PDO
    */
    public function aceptar_horario($idt){
        $pdo = $this->base->abrir_conexion();    
     
        $datos = $pdo->query("select * from tbl_trabajo where id_trabajo_pk='".$idt."'");
        return $datos;
     
    }
 /*Alexis Escoto 18/01/2023
    Cuenta:20161000817
    Creacion de SELECT tbl_trabajo
    SELECT con metodo PDO
    NO EXISTE TABLA
    */
    public function horario_tbl_presentacion_trabajos($idt){
        $pdo = $this->base->abrir_conexion();    
     
        $datos = $pdo->query("select * from  tbl_presentacion_trabajos  where id_trabajo_fk='".$idt."'");
        return $datos;
     
    }



      /*Alexis Escoto 02/12/2022
    Creacion de INSERT  Tabla trabajo.
    Insert con metodo PDO
    */
	public function insertar(){
 
      $pdo = $this->base->abrir_conexion();    
      $datos   =   $pdo->prepare("INSERT INTO tbl_trabajo (id_trabajo_pk,titulo_trabajo,
      fecha_subida, ubicacion_archivo, resumen, id_estado_fk, id_tematica_fk, id_citacion_fk, premio,
       revista, horario_sugerido, id_tipo_trabajo_fk, id_idioma_fk, palabrasclave, resumenprograma) 
              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                 
              $resultado=$datos->execute([NULL,$this->titulotrabajo,  date("y-m-d"), 
              $this->ubicacionarchivo,  $this->resumen, 1,  $this->idtematica, 
               $this->id_citacion_fk ,$this->premio, 
               $this->revista,  $this->horario,  $this->idtipotrabajo,  $this->idioma,  $this->palabrasclave,
                 $this->resumenprograma]);
                 return $pdo-> lastInsertId();


	}
    /*Alexis Escoto 26/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_trabajos_subidos
    SELECT con metodo PDO
    */
    public function tbl_trabajos_subidos($idusuario){
        $pdo = $this->base->abrir_conexion();    
     
        $datos = $pdo->query('select * from tbl_trabajo a, tbl_tipo_trabajo b, tbl_estado c, tbl_usuario_trabajo d where a.id_tipo_trabajo_fk=b.id_tipo_trabajo_pk and a.id_estado_fk=c.id_estado_pk and a.id_trabajo_pk=d.id_trabajo_fk and d.id_usuario_fk="'.$idusuario.'"');
        return $datos;
     
    }
                                   /*Alexis Escoto 26/12/2022
    Cuenta:20161000817
    Creacion de SELECT mostrar_trabajos_subidos_eg
    SELECT con metodo PDO
    */
    public function mostrar_trabajos_subidos_eg($idcongreso){
        $pdo = $this->base->abrir_conexion();    
     
        $datos = $pdo->query('select id_trabajo_pk,titulo_trabajo,ubicacion_archivo,nombre_tipo_trabajo,estado,id_tipo_trabajo_fk, 
        id_congreso_pk, id_linea_investigacion_pk, id_tematica_pk, nombre_tematica  from tbl_trabajo a,
         tbl_tipo_trabajo b, tbl_estado c, tbl_congreso_linea_investigacion d, tbl_tematica e  where a.id_tipo_trabajo_fk=b.id_tipo_trabajo_pk and a.id_estado_fk=c.id_estado_pk and  d.id_linea_investigacion_pk=e.id_linea_investigacion_fk and a.id_tematica_fk=e.id_tematica_pk and c.id_estado_pk <> 2 and  d.id_congreso_pk="'.$idcongreso.'"');
        return $datos;
     
    }
    
/*Alexis Escoto 26/12/2022
Cuenta:20161000817
Creacion de SELECT mostrar_trabajos
SELECT con metodo PDO
*/
public function mostrar_trabajos($fila){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query("select * from tbl_usuario_trabajo where id_trabajo_fk='".$fila['id_trabajo_pk']."'");
    return $datos;
    
    }

   /*Alexis Escoto 09/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_trabajos_ep
SELECT con metodo PDO
*/
public function mostrar_tbl_trabajos_ep($idcongreso){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select  a.*, b.nombre_tipo_trabajo, c.nombre_tematica from tbl_trabajo a
    join tbl_tipo_trabajo b on b.id_tipo_trabajo_pk = a.id_tipo_trabajo_fk
    join tbl_tematica c on c.id_tematica_pk=a.id_tematica_fk
    join tbl_linea_investigacion d on d.id_linea_investigacion_pk = c.id_linea_investigacion_fk
    join tbl_congreso_linea_investigacion e on e.id_linea_investigacion_pk = d.id_linea_investigacion_pk
    where a.id_estado_fk =3 and e.id_congreso_pk =  '.$idcongreso.'
    order by a.titulo_trabajo asc
    ');
    return $datos->fetchAll(PDO::FETCH_ASSOC);
    
    }
 
   /*Alexis Escoto 09/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_asignacion_a_revisor
SELECT con metodo PDO
*/
public function mostrar_tbl_asignacion_a_revisor($idtrabajo){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select a.*, c.primer_nombre, c.segundo_nombre , c.primer_apellido, c.segundo_apellido from tbl_asignacion_a_revisor a
    join tbl_usuario b on b.id_usuario_pk = a.id_usuario_que_recibe 
    join tbl_persona c on c.id_persona_pk = b.id_persona_fk 
    where b.id_usuario_pk = a.id_usuario_que_recibe and a.id_trabajo_fk ='.$idtrabajo.'  
    ');
    return $datos;
    
    }

   /*Alexis Escoto 09/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_premio_a_trabajo
SELECT con metodo PDO
*/
public function mostrar_tbl_premio_a_trabajo($idcongreso){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query("select a.* from tbl_tematica  a
    join tbl_linea_investigacion b on b.id_linea_investigacion_pk = a.id_linea_investigacion_fk
    join tbl_congreso_linea_investigacion c on c.id_linea_investigacion_pk = b.id_linea_investigacion_pk
    where c.id_congreso_pk = $idcongreso
    order by  nombre_tematica");
    return $datos;
    
    }
       /*Alexis Escoto 09/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_premio
SELECT con metodo PDO
*/
public function mostrar_tbl_premio($idtemtica){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query("select * from tbl_premio where id_tematica_fk = ".$idtemtica." ");
    return $datos;
    
    }
           /*Alexis Escoto 09/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_premio_a_trabajo
SELECT con metodo PDO
*/
public function mostrar_tbl_premio_trabajo($id_permio){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query("select * from tbl_premio_trabajo a 
    join tbl_premio b on b.id_premio_pk = a.id_premio_fk
    join tbl_trabajo c on c.id_trabajo_pk = a.id_trabajo_fk
    where b.id_premio_pk  = ".$id_permio." 
");
    return $datos;
    
    }


/*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_trabajos_epseccion
SELECT con metodo PDO
*/
public function mostrar_tbl_trabajos_epseccion($idusuario,$idcongreso){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select a.*, b.nombre_tipo_trabajo, e.nombre_tematica from tbl_trabajo a 
    join tbl_tipo_trabajo b on b.id_tipo_trabajo_pk = a.id_tipo_trabajo_fk 
    join tbl_congreso_rol_tematicas c on c.id_tematica_fk = a.id_tematica_fk 
    join tbl_usuario_congreso_roles d on d.tbl_usuario_congreso_rol_pk = c.id_usuario_congreso_roles_fk 
    join tbl_tematica e on e.id_tematica_pk = a.id_tematica_fk 
    join tbl_roles_congreso f on f.tbl_rol_congreso_pk = d.id_rol_congreso_fk
    where d.id_usuario_fk = "'.$idusuario.'" and a.id_estado_fk = 3 and f.id_congreso_fk = "'.$idcongreso.'"
    order by e.nombre_tematica asc
    ');
    return $datos;
   
     
   
    }
               /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT revisoresxtrabajo
SELECT con metodo PDO
*/
public function revisoresxtrabajo($idtrabajo){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select a.*, c.primer_nombre, c.segundo_nombre , c.primer_apellido, c.segundo_apellido from tbl_asignacion_a_revisor a
    join tbl_usuario b on b.id_usuario_pk = a.id_usuario_que_recibe 
    join tbl_persona c on c.id_persona_pk = b.id_persona_fk 
    where b.id_usuario_pk = a.id_usuario_que_recibe and a.id_trabajo_fk ='.$idtrabajo.'  
    ');
    return $datos;
    
    }
                   /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT trabajosa_ess
SELECT con metodo PDO
*/
public function trabajosa_ess($idtrabajo){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select * from tbl_asignacion_editor_seccion_secundario
    where id_trabajo_fk ="'.$idtrabajo.'"
    ');
    return $datos;
    
    }
/*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_dictaminar_trabajos_eps
SELECT con metodo PDO
*/
public function mostrar_tbl_dictaminar_trabajos_eps($idusuario,$idcongreso){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select * from tbl_trabajo a 
    join tbl_tipo_trabajo b on b.id_tipo_trabajo_pk = a.id_tipo_trabajo_fk 
    join tbl_congreso_rol_tematicas c on c.id_tematica_fk = a.id_tematica_fk 
    join tbl_usuario_congreso_roles d on d.tbl_usuario_congreso_rol_pk = c.id_usuario_congreso_roles_fk 
    join tbl_tematica e on e.id_tematica_pk = a.id_tematica_fk 
    join tbl_roles_congreso f on f.tbl_rol_congreso_pk = d.id_rol_congreso_fk
    where d.id_usuario_fk = "'.$idusuario.'" and a.id_estado_fk = 3 and f.id_congreso_fk = "'.$idcongreso.'"
    order by e.nombre_tematica asc 
    ');
    
    return  $datos;

    
    }
    /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT tbl_asignacion_a_revisor
SELECT con metodo PDO
*/
public function tbl_asignacion_a_revisor($idtrabajo){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select * from tbl_asignacion_a_revisor a
    where id_trabajo_fk = "'.$idtrabajo.'" ');
    return $datos;
    
    }
        /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT tbl_revisiones_trabajo
SELECT con metodo PDO
*/
public function tbl_revisiones_trabajo($fila1){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select * from tbl_revisiones_trabajo 
    where id_asignacion_a_revisor_fk = "'.$fila1['id_asignacion_a_revisor_pk'].'"  and lleno_formulario =1');
    return $datos;
    
    }
/*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_trabajos_ess
SELECT con metodo PDO
*/
public function mostrar_tbl_trabajos_ess(){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select * from tbl_trabajo a 
    join tbl_tipo_trabajo b on b.id_tipo_trabajo_pk = a.id_tipo_trabajo_fk 
    join tbl_asignacion_editor_seccion_secundario c on c.id_trabajo_fk = a.id_trabajo_pk
    join tbl_tematica d on d.id_tematica_pk = a.id_tematica_fk
    where c.id_usuario_que_recibe ="'.$_SESSION['idusuario'].'" and a.id_estado_fk = 3
    order by a.titulo_trabajo asc');
    return $datos;
    
    }
                /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT revisores_xtrabajo
SELECT con metodo PDO
*/
public function revisores_xtrabajo($idtrabajo){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select a.*, c.primer_nombre, c.segundo_nombre , c.primer_apellido, c.segundo_apellido from tbl_asignacion_a_revisor a
    join tbl_usuario b on b.id_usuario_pk = a.id_usuario_que_recibe 
    join tbl_persona c on c.id_persona_pk = b.id_persona_fk 
    where b.id_usuario_pk = a.id_usuario_que_recibe and a.id_trabajo_fk ='.$idtrabajo.'  
    ');
    return $datos;
    
    }

      /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_dictaminar_trabajos_ep
SELECT con metodo PDO
*/
public function mostrar_tbl_dictaminar_trabajos_ep($idcongreso){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select id_trabajo_pk,titulo_trabajo,ubicacion_archivo,fecha_subida,palabrasclave,resumen,nombre_tipo_trabajo,estado,id_tipo_trabajo_fk, id_congreso_pk, id_linea_investigacion_pk, id_tematica_pk, nombre_tematica  from tbl_trabajo a, tbl_tipo_trabajo b, tbl_estado c, tbl_congreso_linea_investigacion d, tbl_tematica e  where a.id_tipo_trabajo_fk=b.id_tipo_trabajo_pk and a.id_estado_fk=c.id_estado_pk and  d.id_linea_investigacion_pk=e.id_linea_investigacion_fk and a.id_tematica_fk=e.id_tematica_pk and c.id_estado_pk = 3 and  d.id_congreso_pk="'.$idcongreso.'"');
    return $datos;
    
    }
/*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT dictamen_tbl_asignacion_a_revisor
SELECT con metodo PDO
*/
public function dictamen_tbl_asignacion_a_revisor($idtrabajo){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select * from tbl_asignacion_a_revisor a
    where id_trabajo_fk = "'.$idtrabajo.'" ');
    return $datos;
    
    }
    /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT dictamen_tbl_revisiones_trabajo
SELECT con metodo PDO
*/
public function dictamen_tbl_revisiones_trabajo($fila1){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select * from tbl_revisiones_trabajo 
    where id_asignacion_a_revisor_fk = "'.$fila1['id_asignacion_a_revisor_pk'].'"  and lleno_formulario =1');
    return $datos;
    
    }
        /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tbl_revisiones
SELECT con metodo PDO
*/
public function mostrar_tbl_revisiones($idrol){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select a.*, b.titulo_trabajo, c.nombre_tipo_trabajo from tbl_asignacion_a_revisor a
    join tbl_trabajo b on b.id_trabajo_pk = a.id_trabajo_fk 
    join tbl_tipo_trabajo c on c.id_tipo_trabajo_pk = b.id_tipo_trabajo_fk
    where id_usuario_que_recibe = '.$idrol.' and a.pendiente_aceptacion = 0 and aceptado= 0
    ');
    return $datos;
}
        /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_tabajos_aceptados
SELECT con metodo PDO
*/
public function mostrar_tabajos_aceptados($idusuariorevisor){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query('select a.*, b.titulo_trabajo, b.resumen, b.palabrasclave, b.ubicacion_archivo , c.nombre_tipo_trabajo, c.id_tipo_trabajo_pk, d.nombre_tematica, d.id_tematica_pk  from tbl_asignacion_a_revisor a
    join tbl_trabajo b on b.id_trabajo_pk = a.id_trabajo_fk
    join tbl_tipo_trabajo c on c.id_tipo_trabajo_pk = b.id_tipo_trabajo_fk
    join tbl_tematica d on d.id_tematica_pk = b.id_tematica_fk
where a.id_usuario_que_recibe = '.$idusuariorevisor.' and a.pendiente_aceptacion = 1 and a.aceptado = 1
');
    return $datos->fetchAll(PDO::FETCH_ASSOC);
}

        /*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de SELECT mostrar_revision_rabajos
SELECT con metodo PDO
*/
public function mostrar_revision_rabajos($idtrabajo,$idusuariorevisor){
    $pdo = $this->base->abrir_conexion();    
    
    $datos = $pdo->query("select a.lleno_formulario from tbl_revisiones_trabajo a, 
    tbl_asignacion_a_revisor b 
    where a.id_asignacion_a_revisor_fk=b.id_asignacion_a_revisor_pk and b.id_trabajo_fk='".$idtrabajo."'
     and b.id_usuario_que_recibe='".$idusuariorevisor."'");
    return $datos;
}
        public function modificar(){		
		$bdd = new basedatos();
		return $bdd->update("update tbl_trabajo set titulo_trabajo=?,fecha_subida=?,ubicacion_archivo=?,resumen=?,id_estado_fk=?, id_tematica_fk=?, premio=?, revista=?, horario_sugerido=?, id_tipo_trabajo_fk=?, id_idioma_fk=?, palabrasclave=?, resumenprograma=? where id_trabajo_pk=?",'ssssiiiisisssi',[$this->titulotrabajo,  $this->fecha,  $this->ubicacionarchivo,  $this->resumen, $this->idestado,  $this->idtematica,  $this->premio,  $this->revista,  $this->horario,  $this->idtipotrabajo,  $this->idioma,  $this->palabrasclave,  $this->resumenprograma, $this->idtrabajo ]);
        }

        /*ALEXIS ESCOTO
        
        16-01-2023
        Creacion de UPDATE en tabla tbl_trabajo
        aplicando metodo PDO
        */
        public function modificarubicacion(){		
		/*
            $bdd = new basedatos();
		return $bdd->update("update tbl_trabajo set ubicacion_archivo=? where id_trabajo_pk=?",'si',[$this->ubicacionarchivo, $this->idtrabajo ]);
       */
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("UPDATE tbl_trabajo SET ubicacion_archivo=?  WHERE id_trabajo_pk=?");
      $resultado=$datos->execute([$this->ubicacionarchivo,$this->idtrabajo]);
      return $resultado;
       
    }
        /*eliminar usuario de trabajos*/
	public function eliminarutrab($idtrabajo, $idusuario){//		
		$bdd = new basedatos();
		return $bdd->delete("delete from tbl_usuario_trabajo where id_usuario_fk=? and id_trabajo_fk=?",'ii',[$idusuario, $idtrabajo]);
	}
        
        public function eliminartrabajo(){//eliminar		
		$bdd = new basedatos();
		return $bdd->delete("delete from tbl_trabajo where id_trabajo_pk=?",'i',[$this->idtrabajo]);
	}
        
        
        public function etematicastrabajo(){//eliminar		
		$bdd = new basedatos();
		return $bdd->delete("delete from tbl_trabajo_tematica where id_trabajo_fk=?",'i',[$this->idtrabajo]);
	}
        public function epremiotrabajo(){//eliminar		
		$bdd = new basedatos();
		return $bdd->delete("delete from tbl_premio_trabajo where id_trabajo_fk=?",'i',[$this->idtrabajo]);
	}
        public function eversiontrabajo(){//eliminar		
		$bdd = new basedatos();
		return $bdd->delete("delete from tbl_version_trabajo where id_trabajo_fk=?",'i',[$this->idtrabajo]);
	}
        public function eusuariostrabajo(){//eliminar		
		$bdd = new basedatos();
		return $bdd->delete("delete from tbl_usuario_trabajo where id_trabajo_fk=?",'i',[$this->idtrabajo]);
	}
        /*fin eliminar*/
 /**Alexis Escoto
  * 17-03-2023
  */
        public function selectcongreso($idcongreso){
            /*
            $bdd = new basedatos();
            return $bdd->select("SELECT * FROM tbl_congreso where id_congreso_pk='".$idcongreso."'");  
            */
            $pdo = $this->base->abrir_conexion();

             $datos=$pdo->query("SELECT * FROM tbl_congreso where id_congreso_pk='".$idcongreso."'");  
             return $datos;
        }
           /*Alexis Escoto 16/01/2023
    Creacion de SELECT  Tabla tbl_trabajo DENTRO DE LA  function selectmaxid()
    Insert con metodo PDO
    */
        public function selectmaxid(){//funcion para extraer el ultimo id insertado
           
           /* $bdd = new basedatos();
            return $bdd->select("SELECT MAX(id_trabajo_pk) AS id_trabajo_pk FROM tbl_trabajo");  
      */
      $pdo = $this->base->abrir_conexion();
            return $datos=$pdo->query("SELECT MAX(id_trabajo_pk) AS id_trabajo_pk FROM tbl_trabajo");  
      
        }
        public function selectpremio($idtematica){//funcion para extraer el o los premios a los que puede participar con la tematica principal seleccionada
            $bdd = new basedatos();
            return $bdd->select("SELECT * FROM tbl_premio where id_tematica_fk='".$idtematica."'");  
        }
        public function insertartematicas(){
            /*
            $bdd = new basedatos();
            return $bdd->insert("insert into tbl_trabajo_tematica(id_trabajo_fk,id_tematica_fk, principal) 
            values (?,?,?)","iii",[$this->idtrabajo,  $this->idtematicas,  $this->principal],True);*/

             /*Alexis Escoto 07/12/2022
    Creacion de INSERT  Tabla trabajo tematica.
    Insert con metodo PDO
    */
    $pdo = $this->base->abrir_conexion();    
    $datos   =   $pdo->prepare("insert into tbl_trabajo_tematica (id_trabajo_fk,id_tematica_fk,principal) 
            VALUES (?,?,?)");
               
            $resultado=$datos->execute([$this->idtrabajo,  $this->idtematicas,  $this->principal]);
           
              
                
        }


        public function insertarpremios(){
                $bdd = new basedatos();
		return $bdd->insert("insert into tbl_premio_trabajo(id_premio_fk,id_trabajo_fk) values (?,?)","ii",[$this->idpremio,  $this->idtrabajo],True);
        }
        public function selectusuario($correo){
            $bdd = new basedatos();
            return $bdd->select("SELECT * FROM tbl_correo where correo='".$correo."'");            
        }
        public function selectmaxusuario() {
            $bdd = new basedatos();
            return $bdd->select("SELECT MAX(id_usuario_pk) AS id_usuario_pk FROM tbl_usuario");  
        }
        public function selectusuarioreg($correo){
            $bdd = new basedatos();
            return $bdd->select("SELECT * FROM tbl_correo a, tbl_usuario b where a.id_persona_fk=b.id_persona_fk and a.correo='".$correo."'");            
        }
        public function selecttrabajo($idtrabajo){
            $bdd = new basedatos();
            return $bdd->select("SELECT * FROM tbl_trabajo where id_trabajo_pk='".$idtrabajo."'");            
        }
        /**Alexis Escoto
         * 17-13-2023
         */
        public function usuariotrabajo() {
           /*
            $bdd = new basedatos();
            return $bdd->insert("insert into tbl_usuario_trabajo(id_usuario_fk,id_trabajo_fk,subio,autor_principal,coautor,expositor,autoria,autor_correspondencia) values (?,?,?,?,?,?,?,?)","iiiiiiii",[$this->idusuario,  $this->idtrabajo, $this->subio, $this->autor_principal, $this->coautor, $this->expositor, $this->autoria, $this->autor_correspondencia],True);
            */
            $pdo = $this->base->abrir_conexion();    
            $datos   =   $pdo->prepare("insert into tbl_usuario_trabajo(id_usuario_fk,id_trabajo_fk,subio,autor_principal,coautor,
            expositor,autoria,autor_correspondencia) 
            VALUES (?,?,?,?,?,?,?,?)");
            $resultado=$datos->execute([$this->idusuario,  $this->idtrabajo, $this->subio, $this->autor_principal, 
            $this->coautor, $this->expositor, $this->autoria, $this->autor_correspondencia]);
            return $resultado;
        }
        public function versiontrabajo() {
            /*$bdd = new basedatos();
            return $bdd->insert("insert into tbl_version_trabajo
            (ubicacion_archivo,version_editor_gestor,version_aprobado_conrevision,
            descripcion,id_usuario_que_subio_fk,id_trabajo_fk,fecha_subida) values
             (?,?,?,?,?,?,?)","siisiis",[$this->ubicacionarchivo,
               $this->version_editor_gestor, $this->version_aprobado_conrevision, $this->descripcion, 
               $this->idusuario, $this->idtrabajo, $this->fecha],True);*/
            $pdo = $this->base->abrir_conexion();    
            $datos   =   $pdo->prepare("insert into tbl_version_trabajo (
                id_version_trabajo_pk,ubicacion_archivo,version_editor_gestor,
            version_aprobado_conrevision,
            descripcion,id_usuario_que_subio_fk,id_trabajo_fk,fecha_subida) 
            VALUES (?,?,?,?,?,?,?,?)");
            $resultado=$datos->execute([NULL,$this->ubicacionarchivo,
            $this->version_editor_gestor, $this->version_aprobado_conrevision, $this->descripcion, 
            $this->idusuario, $this->idtrabajo,date("y-m-d")]);
        }
        public function autorpusuariotrabajo() {
            $bdd = new basedatos();
            return $bdd->update("update tbl_usuario_trabajo set autor_principal=NULL, coautor=1 where id_trabajo_fk=?" ,'i',[$this->idtrabajo ]);
        }
        public function selectpersona($identificacion) {
            $bdd = new basedatos();
            return $bdd->select("SELECT * FROM tbl_persona where identificacion='".$identificacion."'");
            
        }
        public function actualizaexpo($idtrabajo) {
            $bdd = new basedatos();
            return $bdd->update("update tbl_usuario_trabajo set expositor=?, autor_correspondencia=? where id_trabajo_fk=?" ,'ssi',[NULL,NULL,$idtrabajo]);
        }
        public function actualizaexpositores() {
            $bdd = new basedatos();
            return $bdd->update("update tbl_usuario_trabajo set expositor=? where id_usuario_fk=? and id_trabajo_fk=?" ,'sii',[$this->valor, $this->idusuario, $this->idtrabajo]);
       }
       public function actualizaautorcorrespondencia() {
            $bdd = new basedatos();
            return $bdd->update("update tbl_usuario_trabajo set autor_correspondencia=? where id_usuario_fk=? and id_trabajo_fk=?" ,'sii',[$this->valor, $this->idusuario, $this->idtrabajo]);
       }
       /*Metodo para obtener infromaicon del trabajo y los autores y coutores*/
       
       public function autoresxtrabajo($idtrabajo){
           $bdd = new basedatos();
           return $bdd->select("Select * from  tbl_usuario_trabajo a
                join tbl_usuario b on b.id_usuario_pk = a.id_usuario_fk
                join tbl_persona c on c.id_persona_pk = b.id_persona_fk 
                join tbl_correo d on d.id_persona_fk = c.id_persona_pk 
                where d.principal = 1 and a.id_trabajo_fk ='".$idtrabajo."'");
       }
       
           /*Alexis Escoto 19/01/2023
    Creacion de SELECT  Tabla tbl_trabajo DENTRO DE LA  origen_todos_revisores selectmaxid()
    Insert con metodo PDO
    */
    public function origen_todos_revisores(){
           
   $pdo = $this->base->abrir_conexion();
          $datos=$pdo->query('select  a.nombre_rol, c.id_usuario_fk , e.primer_nombre ,e.segundo_nombre , e.primer_apellido , e.segundo_apellido, g.id_tematica_pk ,g.nombre_tematica from tbl_roles a
         join tbl_roles_congreso b on b.id_rol_fk = a.id_rol_pk
         join tbl_usuario_congreso_roles c on c.id_rol_congreso_fk = b.tbl_rol_congreso_pk
         join tbl_usuario d on d.id_usuario_pk = c.id_usuario_fk
         join tbl_persona e on e.id_persona_pk = d.id_persona_fk
         join tbl_congreso_rol_tematicas f on f.id_usuario_congreso_roles_fk = c.tbl_usuario_congreso_rol_pk
         join tbl_tematica g on g.id_tematica_pk = f.id_tematica_fk
       
       ');  
       return $datos->fetchAll(PDO::FETCH_ASSOC);
      // where a.id_rol_pk = 6
       //order by e.primer_nombre and g.nombre_tematica
     }
         /*Alexis Escoto 19/01/2023
    Creacion de SELECT  Tabla tbl_trabajo DENTRO DE LA  origen_todos_revisores selectmaxid()
    Insert con metodo PDO
    */
    public function mostrarinfotrabajo($idcongreso,$idt){//funcion para extraer el ultimo id insertado
           
        $pdo = $this->base->abrir_conexion();
               $datos=$pdo->query('select id_trabajo_pk,titulo_trabajo,ubicacion_archivo,
               fecha_subida,palabrasclave,resumen,nombre_tipo_trabajo,estado,id_tipo_trabajo_fk, 
               id_congreso_pk, id_linea_investigacion_pk, id_tematica_pk, nombre_tematica  from tbl_trabajo a, 
               tbl_tipo_trabajo b, tbl_estado c, tbl_congreso_linea_investigacion d, tbl_tematica e  
               where a.id_tipo_trabajo_fk=b.id_tipo_trabajo_pk and a.id_estado_fk=c.id_estado_pk and
                 d.id_linea_investigacion_pk=e.id_linea_investigacion_fk and a.id_tematica_fk=e.id_tematica_pk and c.id_estado_pk = 3 
                 and  d.id_congreso_pk="'.$idcongreso.'" and a.id_trabajo_pk="'.$idt.'"');  
            return $datos;
           // where a.id_rol_pk = 6
            //order by e.primer_nombre and g.nombre_tematica
          }
       
}
