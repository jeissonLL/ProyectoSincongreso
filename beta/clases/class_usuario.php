<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_usuario
 *
 * @author jrodriguez
 */

require_once 'class_base.php';
class usuario {
    private $idusuario;
    private $nusuario;
    private $contrasenia;
    
    private $img;    
    private $correo;    
    private $ncontrasenia;
    private $rol;
    private $tematica;
    private $usuario_congreso_rol;


    public function __construct() {
        $this->base = new basedatos();
        
    }

    public function uinicializar($idusuario,$nusuario,$contrasenia,$img,$correo,$rol,$tematica)
        {
            $this-> idusuario=$idusuario;
            $this-> nusuario=$nusuario;
            $this-> contrasenia=$contrasenia;
            $this-> img=$img;            
            $this-> correo=$correo;  
            $this-> rol=$rol;            
            $this-> tematica=$tematica;             
        }
//        public function uinicializar2($idusuario,$nusuario,$rol,$tematica) //Para inicializar usuarios segun rol
//        {
//            $this-> idusuario=$idusuario;
//            $this-> nusuario=$nusuario;
//            $this-> rol=$rol;            
//            $this-> tematica=$tematica;            
//        }        
        public function get_id()
        {
            return $this->idusuario;
	}    
        
        public function get_usuario()
        {
            $bdd = new basedatos();

            $datos = $bdd ->select("select * from tbl_usuario a, tbl_persona b, tbl_tipo_persona c, tbl_idioma d, tbl_tipo_alimentacion e, tbl_tipo_identificacion f, tbl_pais g,  tbl_telefono i
                            where a.nombre_usuario='$this->nusuario'
                            and a.id_usuario_pk='$this->idusuario'
                            and a.id_persona_fk=b.id_persona_pk
                            and a.id_idioma_fk=d.id_idioma_pk
                            and b.id_tipo_persona_fk=c.id_tipo_persona_pk
                            and b.id_tipo_alimentacion_fk=e.id_tipo_alimentacion_pk
                            and b.id_tipo_identificacion_fk=f.id_tipo_identificacion_pk
                            and b.id_pais_fk=g.id_pais_pk and i.id_persona_fk=b.id_persona_pk and i.principal='1'");
            return $datos;

        }     
        
        public function get_correo()
        {
            $bdd = new basedatos();

            $datos = $bdd ->select("select a.correo,a.principal from tbl_correo a 
                                    join tbl_usuario b on b.id_persona_fk=a.id_persona_fk
                                    where 1=1 and b.id_usuario_pk='$this->idusuario'");
            return $datos;

        }  
        
        public function get_ucorreo()
        {
            $pdo = $this->base->abrir_conexion(); 
            
            $datos=$pdo->query("select c.correo, a.id_usuario_pk, a.nombre_usuario, 
            c.id_persona_fk from tbl_usuario a, tbl_persona b, tbl_correo c where a.id_persona_fk=b.id_persona_pk 
            and b.id_persona_pk=c.id_persona_fk and c.correo='".$this->correo."' "); 
            foreach ($datos as $fila) { 
                    $this->idusuario = $fila['id_usuario_pk'];
                    $this-> nusuario = $fila['nombre_usuario'];
            }
            return $datos;
        }   
        public function get_nusuario()
        {
            $bdd = new basedatos();
            $datos=$bdd->select("select * from tbl_usuario where nombre_usuario = '".$this->nusuario."'"); 
            return $datos;
        }        
       
        
        public function login()
        {
      /*
            $bdd = new basedatos();
            $contrasena=$bdd ->select("SELECT contrasena FROM tbl_usuario where nombre_usuario='$this->nusuario'");   
*/
            $pdo = $this->base->abrir_conexion();    
            $contrasena = $pdo->query("SELECT contrasena FROM tbl_usuario  WHERE nombre_usuario='$this->nusuario'");
            

            if(!empty($contrasena))
                {    
                    $salt=substr(base64_encode(openssl_random_pseudo_bytes(17)),0,22);            
                    foreach ($contrasena as $contra) 
                        {
                            $pass = ($this->contrasenia);
                            $pass_crypt = crypt($pass, $contra['contrasena']);
                            $contrasenai= $contra['contrasena'];
                            if(strlen($contrasenai) != strlen($pass_crypt)) {
                              return false;
                            } else {
                              $res = $contrasenai ^ $pass_crypt;
                              $ret = 0;
                              for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
                              return !$ret;
                            }
            //                    if(password_verify($this->contrasenia, $contra['contrasena']))                    
//                            if($pass_crypt == crypt($pass, $pass_crypt))

                            }

                }
        }
    
        public function inicio_sesion()
        {
            session_start();
            $bd = new basedatos();
            $usuario=$bd ->select("select a.id_usuario_pk, a.id_persona_fk, a.id_idioma_fk, a.img_usuario,b.correo,a.contrasena "
                    . "from tbl_usuario a, tbl_correo b where a.nombre_usuario='$this->nusuario' and a.id_persona_fk=b.id_persona_fk and b.principal = '1'");   
            if(!empty($usuario))
            {                        
                foreach ($usuario as $user) {
                        $_SESSION['hoy'] = new DateTime();
                        $_SESSION['nusuario']= $this->nusuario;
                        $_SESSION['idusuario']= $user['id_usuario_pk'];
                        $_SESSION['idpersona']= $user['id_persona_fk'];
                        $_SESSION['contrasenia']= $user['contrasena'];
                        if(!isset($_SESSION['idioma']))
                        {
                            $_SESSION['idioma']= $user['id_idioma_fk'];
                        }
                        $_SESSION['img'] = $user['img_usuario']; 
                        $_SESSION['cprincipal'] = $user['correo']; 

                }
            }
        }
        
        
/***************************************************************************Roles de Usuarios***************************************************************************/        
        public function get_rol_congreso()
        {
            $bd = new basedatos();

            $roles_congreso = $bd ->select("SELECT * FROM tbl_roles_congreso where 1=1 and id_rol_fk = ".$this->rol." and id_congreso_fk = ".$_SESSION['idcongreso']."");
            if(!empty($roles_congreso))
            {                        
                foreach ($roles_congreso as $rol) {
                   return $this->rol = $rol['tbl_rol_congreso_pk'];
                }
            }        
//            return "SELECT * FROM tbl_roles_congreso where 1=1 and id_rol_fk = $this->rol and id_congreso_fk = ".$_SESSION['idcongreso']." ";
        }       

        public function get_usuarioxrolxcongreso()
        {
            $bd = new basedatos();
            $datos = $bd ->select("select * from tbl_usuario_congreso_roles where 1=1 and id_usuario_fk = ".$this->idusuario." and id_rol_congreso_fk = ".$this->rol." ");
            foreach ($datos as $valor) {
                return $this ->usuario_congreso_rol = $valor["tbl_usuario_congreso_rol_pk"];
            }
//            return "select * from tbl_usuario_congreso_roles where 1=1 and id_usuario_fk = ".$this->idusuario." and id_rol_congreso_fk = ".$this->rol."";
        }    
        
        public function asignar_usuarioxrolxcongreso()
        {
            
            $bd = new basedatos();
            return $this ->usuario_congreso_rol = $bd ->insert("INSERT INTO tbl_usuario_congreso_roles(id_usuario_fk, id_rol_congreso_fk, asistira) "
                    . "VALUES (?,?,1)",'ii',[$this->idusuario, $this->rol], TRUE);
        }
    

/***********************************************************************************************************************************************************************/
        
        public function asignar_tematica()
        {
            $bd = new basedatos();
            return $bd ->insert("INSERT INTO tbl_congreso_rol_tematicas(id_tematica_fk, id_usuario_congreso_roles_fk) "
                    . "VALUES (?,?)",'ii',[$this->tematica,$this->usuario_congreso_rol], TRUE);
            return "INSERT INTO tbl_congreso_rol_tematicas(id_tematica_fk, id_usuario_congreso_roles_fk) "
                    . "VALUES ($this->tematica,$this->usuario_congreso_rol)";            
        }        
        
        public function asignar_img()
        {
            $bd = new basedatos();
            return $bd ->update("UPDATE tbl_usuario SET img_usuario =? WHERE id_usuario_pk = ?",'si',[$this->img,  $this->idusuario]);
//            echo "UPDATE tbl_usuario SET img_usuario =$this->img WHERE id_usuario_pk = $this->idusuario";
        }        
        public function genera_contra()
        {
            $length = 10;
            $n=0;
            $source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            if ($n == 1)
                $source .= '1234567890';
                $source .='$#@-/+*-&'; 
            if ($length > 0) {
                $rstr = "";
                $source = str_split($source, 1);
                for ($i = 1; $i <= $length; $i++) {
                    mt_srand((double) microtime() * 1000000);
                    $num = mt_rand(1, count($source));
                    $rstr .= $source[$num - 1];
                }
            }
            $this -> ncontrasenia = $rstr;
            return trim($rstr);            
        }        
        public function envio_contra()
        {
        
            $salt=substr(base64_encode(openssl_random_pseudo_bytes(17)),0,22);   
            $ncontrasenia=crypt($this->ncontrasenia, $salt);
            
            $bd = new basedatos();
            $resp = $bd ->update("UPDATE tbl_usuario SET contrasena = '".$ncontrasenia."' WHERE id_usuario_pk = ".$this->idusuario."");
            
            if($resp == 1)
            {
                $time = time();
                $fecha=date("Y-m-d", $time);
                $usuario_email = $this->correo; 
                $remite_nombre = "CEAT"; //nombre de la página 
                $remite_email = "PASSWORD"; // tu correo 
                $asunto = "NEW PASSWORD"; // Asunto (se puede cambiar) 
                $mensaje = "Se ha generado una contraseña para el usuario: <strong>".$this->nusuario."</strong> <br>"
                        . " Su contraseña es: <strong>".$this->ncontrasenia."</strong><br>"
                        . "Seguidamente de ingresar en su cuenta por favor proceda a cambiarla desde la parte de perfil"; 
                $cabeceras = "From: ".$remite_nombre." <".$remite_email.">\r\n"; 
                $cabeceras.= "Mime-Version: 1.0\n"; 
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $enviar_email = mail($usuario_email,$asunto,$mensaje,$cabeceras);

            } 

            return $resp;
            
        }
        public function update_nusuario()
        {
            $bd = new basedatos();
            
            $salt=substr(base64_encode(openssl_random_pseudo_bytes(17)),0,22);            
            $contrasenia=crypt($this->contrasenia, $salt);
            if(($_SESSION['contrasenia']!= $this->contrasenia) && ($_SESSION['contrasenia']!=$contrasenia))
            {
                $this-> contrasenia = $contrasenia;
            }
            
            return $resp = $bd -> update("UPDATE tbl_usuario SET nombre_usuario = ?, contrasena=? WHERE id_usuario_pk = ?",'ssi',[$this->nusuario, $this->contrasenia, $this->idusuario]);
        }

        public function tabs_gestion_roles(){
            
            $pdo = $this->base->abrir_conexion(); 
            $datos_ver = $pdo->query("select * from tbl_solicitud_roles_congreso");
            $resultado = $datos_ver;
            
           return $resultado;
        }
        /**ALEXIS ESCOTO 
        * 20-01-2023
        */
        public function tbl_solicitud_roles_congreso(){
            $pdo = $this->base->abrir_conexion(); 
            $datos_ver = $pdo->query("select * from tbl_solicitud_roles_congreso");
            return $datos_ver;
    
    }
      
    
        /*
        public function tbl_usuario($rol){
            $pdo = $this->base->abrir_conexion(); 
           // $num_row = $bdd->num_row();
            $sql =$pdo->query("select distinct a.id_usuario_pk, a.nombre_usuario, CONCAT_WS(' ',b.primer_nombre, b.segundo_nombre,b.primer_apellido,b.segundo_apellido) as nombres from tbl_usuario a
                                        join tbl_persona b on b.id_persona_pk=a.id_persona_fk
                                        join tbl_usuario_congreso_roles c on c.id_usuario_fk=a.id_usuario_pk
                                        join tbl_roles_congreso d on d.tbl_rol_congreso_pk=c.id_rol_congreso_fk  
                                        join tbl_roles e on e.id_rol_pk=d.id_rol_fk 
                                        join tbl_solicitud f on f.id_usuario_pk!=a.id_usuario_pk");    
            if( $pdo==0){
                $sql.= " where 1=1 and d.id_congreso_fk='".$_SESSION['idcongreso']."' and e.id_rol_pk!='".$rol."' and c.asistira='1' order by nombres ASC";
            }else{
                $sql.=" join tbl_solicitud_roles_congreso g on g.id_rol_congreso_pk!=d.tbl_rol_congreso_pk "
                        . "where 1=1 and d.id_congreso_fk='".$_SESSION['idcongreso']."' and e.id_rol_pk!='".$rol."' and c.asistira='1' order by nombres ASC";
            }
    }

*/

/**ALEXIS ESCOTO 
 * 20-01-2023
 */
        public function tabs_srevision(){
            
            $pdo = $this->base->abrir_conexion(); 
            $datos = $pdo->query("select a.id_solicitud, a.motivo_solicitud, a.fecha_solicitud, c.nombre_usuario, CONCAT_WS(' ',e.primer_nombre, e.segundo_nombre,e.primer_apellido,e.segundo_apellido) as nombres from tbl_solicitud a
            join tbl_usuario c on c.id_usuario_pk=a.id_usuario_pk
            join tbl_persona e on e.id_persona_pk=c.id_persona_fk
            where a.id_tipo_solicitud='1' and a.status='0'");
          return $datos;
        }
}

class editorprincipal extends usuario{ 
     //Campos necesario para la asignacion de trabajo a revisor 
    private $idtabla;
    private $pendiente;
    private $aceptado;
    private $fecha_asignacion;
    private $fecha_acepto_rechazo ;
    private $idtrabajo;
    private $idusuario_queasigna;
    private $idusuario_quearecibe;
    private $dictamen ;
    
    //Métodos
    public function inicia_asignar_revisor_trabajo($id,$pendiente, $aceptado, $fecha_asignacion, $fecha_acepto_rechazo,$trabajo, $asigna, $recibe, $dictamen){
        $this->idtabla              =$id;
        $this->pendiente            =$pendiente;
        $this->aceptado             =$aceptado;
        $this->fecha_asignacion     =$fecha_asignacion;
        $this->fecha_acepto_rechazo =$fecha_acepto_rechazo;
        $this->idtrabajo            =$trabajo;
        $this->idusuario_queasigna  =$asigna;
        $this->idusuario_quearecibe =$recibe;
        $this->dictamen             =$dictamen;
        
    }
    /**
     * ALEXIS ESCOTO
     * 19-01-2023
     * INSERT Con metodo PDO EN TABLA tbl_asignacion_a_revisor
     */
    public function asignar_revisor_trabajo(){
    /*
        $bdd = new basedatos();		
    return $bdd->insert("insert into tbl_asignacion_a_revisor(id_asignacion_a_revisor_pk, pendiente_aceptacion, aceptado, fecha_acepto_rechazo, fecha_que_se_le_asigno,id_trabajo_fk,id_usuario_que_asigna,id_usuario_que_recibe,id_tipo_dictamen_fk) values (?,?,?,?,?,?,?,?,?)","iiissiiii",[$this->idtabla,  $this->pendiente,  $this->aceptado, $this->fecha_acepto_rechazo ,$this->fecha_asignacion,  $this->idtrabajo,  $this->idusuario_queasigna,  $this->idusuario_quearecibe,  $this->dictamen],True);
  */
    $pdo = $this->base->abrir_conexion();   
     $datos   =   $pdo->prepare("INSERT INTO tbl_asignacion_a_revisor (id_asignacion_a_revisor_pk,
      pendiente_aceptacion, aceptado, fecha_acepto_rechazo, fecha_que_se_le_asigno,id_trabajo_fk,id_usuario_que_asigna,
      id_usuario_que_recibe,id_tipo_dictamen_fk) VALUES
      (?,?,?,?,?,?,?,?,?)");
     $resultado=$datos->execute([$this->idtabla,  $this->pendiente,  $this->aceptado, $this->fecha_acepto_rechazo ,
     $this->fecha_asignacion,  $this->idtrabajo, $this->idusuario_queasigna,  $this->idusuario_quearecibe,  $this->dictamen]);
return $datos;
    }
    
    public function inicia_cancelar_revisor_trabajo ($idusuario, $idtrabajo){
        $this->idusuario_quearecibe = $idusuario;
        $this->idtrabajo = $idtrabajo;
    }
    
    public function cancelar_revisor_trabajo(){
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_asignacion_a_revisor where id_trabajo_fk=? and id_usuario_que_recibe=?",'ii',[$this->idtrabajo, $this->idusuario_quearecibe] );
       
    }
    
    public function  inicia_dicatminar_trabajo($dictamen , $idtrabajo){
        $this->dictamen = $dictamen;
        $this->idtrabajo = $idtrabajo;
    }

    public function dictaminar_trabajo(){
    $bdd = new basedatos();
    return $bdd->update("update tbl_asignacion_a_revisor set id_tipo_dictamen_fk=? where id_trabajo_fk=? ",'ii',[$this->dictamen,$this->idtrabajo] );
       
    }
    
    public function cambia_estado_trabajo(){
    $bdd = new basedatos();
    return $bdd->update("update tbl_trabajo set id_estado_fk=? where id_trabajo_pk=? ",'ii',[$this->dictamen,$this->idtrabajo] );
       
    }
     /**
     * ALEXIS ESCOTO
     * 19-01-2023
     * SELECT Con metodo PDO EN TABLA tbl_congreso
     * SELECT Con metodo PDO EN TABLA tbl_trabajo
     * SELECT Con metodo PDO EN TABLA tbl_correo
     */
    public function enviar_correo_revisor($idusuario, $idcongreso, $idtrabajo){
        $pdo = $this->base->abrir_conexion(); 
        
        $congreso = $pdo->query("SELECT * FROM tbl_congreso where id_congreso_pk='".$idcongreso."'");
        $infotrabajo = $pdo->query("SELECT * FROM tbl_trabajo where id_trabajo_pk='".$idtrabajo."'");
        $correo_revisor = $pdo->query("Select correo from tbl_correo a
                            join tbl_persona b on b.id_persona_pk = a.id_persona_fk
                            join tbl_usuario c on c.id_persona_fk = b.id_persona_pk
                            where c.id_usuario_pk = '".$idusuario."' and a.principal = 1
                ");
        
        foreach ($correo_revisor as $correo) {
            $correorevisor = $correo['correo'];                                               
        }
        
        foreach ($infotrabajo as $informacion) {
            $titulotrabajo = "".strtoupper($informacion['titulo_trabajo'])."";                                               
        }
         /*enviamos el correo a los usuario con el rol revisor */
        $titulo="REVISOR DE TRABAJO";  
        $mensaje="<html>"; 
        $mensaje.="<p>";
        $mensaje.="UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS (UNAH).";
        $mensaje.="</p><BR>";
        $mensaje.="<p>";
        $mensaje.="INSTITUTO DE INVESTIGACIONES ECONÓMICAS Y SOCIALES (IIES).";
        $mensaje.="</p>";
        //$mensaje.="<title></title";
        $mensaje.="<body>";
        $mensaje.="<p>";
        $mensaje.="Estimado(a)";
        $mensaje.="</p><BR>";
        $mensaje.="<p>";
        foreach ($congreso as $key) {
        $mensaje.="EL CONGRESO ".strtoupper($key['nombre_congreso'])."<br>Le Comunica a usted lo siguiente:<br><br>";                                               
        }
        $mensaje.=" Se le solicita ser revisor del TRABAJO DE INVESTIGACIÓN $titulotrabajo para lo cual ud puede ingresar a nuestro sitio e ingresar al menú Gestión de Revisor, posteriormente seleccionando Trabajos a Revisar "
                . "<br><br>Le invitamos a que ingrese nuestro Sitio WEB :<br> <a href='http://ceat-unah.org/sistemas/gcongreso/beta/index.php' target='_blank'><b>INGRESAR AL SITIO</b></a>"
                . "<br><br>";
        $mensaje.="</p>";
        $mensaje.="<p>";     
        $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
        $mensaje.="</p>";
        $mensaje.="</body>";
        $mensaje.="</html>";      
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        if( mail($correorevisor, $titulo, $mensaje, $cabeceras)){
            $enviomj = 1;
        }
    }
    
}

class editor_secundario_seccion extends usuario{
    private $id_asignacion_editor_seccion_secundaria_pk ;
    private $fecha_recibe_asignacion;
    private $id_usuario_que_asigna;
    private $id_usuario_que_recibe;
    private $id_trabajo_fk ;
    
    /*Metodos  para el ususario con el rol editoer secundario de seccion*/
    
    public function inicia_editor_secundario_seccion($id_asignacion_ess, $fecha_recibe, $editor_ps, $editor_ss, $idtrabajo){
        $this->id_asignacion_editor_seccion_secundaria_pk = $id_asignacion_ess;
        $this->fecha_recibe_asignacion = $fecha_recibe;
        $this->id_usuario_que_asigna = $editor_ps ;
        $this->id_usuario_que_recibe = $editor_ss;
        $this->id_trabajo_fk = $idtrabajo;
                
    }
    
    public function  asignar_editor_secundario_seccion(){
        $bdd = new basedatos();		
        return $bdd->insert("insert into tbl_asignacion_editor_seccion_secundario(id_asignacion_editor_seccion_secundaria_pk, fecha_recibe_asignacion, id_usuario_que_asigna, id_usuario_que_recibe, id_trabajo_fk) values (?,?,?,?,?)","isiii",[$this->id_asignacion_editor_seccion_secundaria_pk,  $this->fecha_recibe_asignacion,  $this->id_usuario_que_asigna, $this->id_usuario_que_recibe ,$this->id_trabajo_fk],True);
    }
}

class revisor extends usuario{
    //parametros: estos datos seran actualizados dependiendo de la acciones del ususario revisor 
    
    private $idtabla;
    private $pendiente ;
    private $aceptado ;
    private $fecha_acepto_rechazo;
    private $idtrabajo;
    
    //variables Obed
    private   $id_revisiones_trabajo_pk;
    private   $id_respuesta_cualitativa_pk;
    private   $id_respuesta_cuantitativa_pk;
    private   $id_asignacion_a_revisor_fk;
    private   $descargo_archivo;
    private   $lleno_formulario; 
    private   $fecha_reviso;
    private   $id_tipo_dictamen_fk;
    private   $observaciones;
    private   $respuesta_cualitativa; 
    private   $respuesta_cuantitativa;
    private   $id_pregunta_cualitativa_fk;
    private   $id_pregunta_cuantitativa_fk; 
    
    //metodo inicializar guardar revisiones de trabajo
    public function inicializar_revisiontrabajos($id_revisiones_trabajo_pk,  $id_asignacion_a_revisor_fk, $descargo_archivo, $lleno_formulario, $fecha_reviso, $id_tipo_dictamen_fk,$observaciones){
        $this->id_revisiones_trabajo_pk= $id_revisiones_trabajo_pk;
        $this->id_asignacion_a_revisor_fk = $id_asignacion_a_revisor_fk;
        $this->descargo_archivo = $descargo_archivo;
        $this->lleno_formulario = $lleno_formulario;
        $this->fecha_reviso = $fecha_reviso;
        $this->id_tipo_dictamen_fk = $id_tipo_dictamen_fk;
        $this->observaciones = $observaciones;
    }
    public function inicializar_respuesta_cualitativa($id_respuesta_cualitativa_pk, $respuesta_cualitativa, $id_pregunta_cualitativa_fk) {
        $this->id_respuesta_cualitativa_pk = $id_respuesta_cualitativa_pk;
        $this->respuesta_cualitativa = $respuesta_cualitativa;
        $this->id_pregunta_cualitativa_fk = $id_pregunta_cualitativa_fk;
    }
    public function inicializar_respuesta_cuantitativa($id_respuesta_cuantitativa_pk, $respuesta_cuantitativa, $id_pregunta_cuantitativa_fk) {
        $this->id_respuesta_cuantitativa_pk = $id_respuesta_cuantitativa_pk;
        $this->respuesta_cuantitativa = $respuesta_cuantitativa;
         $this->id_pregunta_cuantitativa_fk = $id_pregunta_cuantitativa_fk;
    }
    public function inicializar_respuestas_revisiones_trabajos_cuantitativas($id_revisiones_trabajo_fk, $id_respuesta_cuantitativa_fk) {
        $this->id_revisiones_trabajo_pk = $id_revisiones_trabajo_fk;
        $this->id_respuesta_cuantitativa_pk = $id_respuesta_cuantitativa_fk;
    }
    public function inicializar_respuestas_revisiones_trabajos_cualitativas($id_revisiones_trabajo_fk, $id_respuesta_cualitativa_fk) {
        $this->id_revisiones_trabajo_pk = $id_revisiones_trabajo_fk;
        $this->id_respuesta_cualitativa_pk = $id_respuesta_cualitativa_fk;
    }
    
    public function irespuesta_cualitativa() {
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_respuesta_cualitativa(id_respuesta_cualitativa_pk,respuesta_cualitativa, id_pregunta_cualitativa_fk) values (?,?,?)","isi",[$this->id_respuesta_cualitativa_pk,  $this->respuesta_cualitativa, $this->id_pregunta_cualitativa_fk],True);
    }
    public function irespuesta_cuantitativa() {
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_respuesta_cuantitativa(id_respuesta_cuantitativa_pk,respuesta_cuantitativa, id_pregunta_cuantitativa_fk) values (?,?,?)","isi",[$this->id_respuesta_cuantitativa_pk,  $this->respuesta_cuantitativa, $this->id_pregunta_cuantitativa_fk],True);
    }
    public function irevisiontrabajo() {
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_revisiones_trabajo(id_revisiones_trabajo_pk, id_asignacion_a_revisor_fk, descargo_archivo, lleno_formulario, fecha_reviso, id_tipo_dictamen_fk, observaciones) values (?,?,?,?,?,?,?)","iiiisis",[$this->id_revisiones_trabajo_pk, $this->id_asignacion_a_revisor_fk, $this->descargo_archivo, $this->lleno_formulario, $this->fecha_reviso, $this->id_tipo_dictamen_fk, $this->observaciones ],True);
    }
    public function irespuestas_revisiones_trabajos_cuantitativas() {
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_respuestas_revisiones_trabajos_cuantitativas(id_revisiones_trabajo_fk, id_respuesta_cuantitativa_fk) values (?,?)","ii",[$this->id_revisiones_trabajo_pk,  $this->id_respuesta_cuantitativa_pk],True);
    }
    public function irespuestas_revisiones_trabajos_cualitativas() {
        $bdd = new basedatos();
        return $bdd->insert("insert into tbl_respuestas_revisiones_trabajos_cualitativas(id_revisiones_trabajo_fk, id_respuesta_cualitativa_fk) values (?,?)","ii",[$this->id_revisiones_trabajo_pk,  $this->id_respuesta_cualitativa_pk],True);
    }
    public function idasignacion_revision($idt, $idusuario) {
        $bdd = new basedatos();
        return $bdd->select("SELECT id_asignacion_a_revisor_pk FROM tbl_asignacion_a_revisor where id_trabajo_fk='".$idt."' and id_usuario_que_recibe='".$idusuario."'");  
    }
    
    
    /*Final metodos OBED -> REVISION DE TRABAJOS*/
    

    //Métodos para aceptar ser revisor de trabajo
    public function inicia_aceptar_cancelar_trabajo($idtrabajo, $idtabla, $pendiente, $aceptado, $fecha){
        $this->idtrabajo = $idtrabajo;
        $this->idtabla = $idtabla;
        $this->pendiente = $pendiente ;
        $this->aceptado = $aceptado;
        $this->fecha_acepto_rechazo = $fecha ;
               
    }
    
    public function aceptar_cancelar_trabajo(){
        $bdd = new basedatos();
        return $bdd->update("update tbl_asignacion_a_revisor set pendiente_aceptacion=? , aceptado=?, fecha_acepto_rechazo=? where id_trabajo_fk=? and id_asignacion_a_revisor_pk=?" ,'iisii',[$this->pendiente, $this->aceptado, $this->fecha_acepto_rechazo, $this->idtrabajo, $this->idtabla]);
    }

       
    public function cancelar_trabajo(){
        $bdd = new basedatos();
        return $bdd->delete("delete from tbl_asignacion_a_revisor where id_trabajo_fk=? and id_asignacion_a_revisor_pk=?",'ii',[$this->idtrabajo, $this->idtabla] );
    }
    
    
}

class voluntario extends usuario{
    private $id_voluntario_pk ;
    private $numero_horas ;
    private $comentarios;
    private $estado ;
    private $id_rol_congreso_fk;
    
    /*Elementos necesarios para la creacion de las tareas a voluntarios*/
    private $id_tarea_voluntario_pk;
    private $nombre_tarea;
    private $descripcion;
    private $archivo_complementario;
    private $persona_apoyo;
    private $creado_por;
    private $fecha_creacion;
    private $modificado_por;
    private $fecha_modificacion;
    private $fecha_tarea;
    private $hora_tarea;

    public function __construct() {
        $this->base = new basedatos();
        
    }
    /*Elementos necesarios para la creacion de las tareas a voluntarios*/
    
    /*Metodo para Aceptar/Rechazar Voluntarios*/
    public function inicia_aceptar_rechazar_voluntario($dictamen, $id_solicitud){
        $bdd = new basedatos();
        return $bdd ->update("update tbl_solicitud set status='".$dictamen."' where id_solicitud = ".$id_solicitud."") ;
    }
    
    public function inicia_inscibir_voluntario($id_voluntario_pk, $numero_horas, $comentarios, $estado, $id_rol_congreso_fk){
        $this->id_voluntario_pk     = $id_voluntario_pk;
        $this->numero_horas         = $numero_horas ;
        $this->comentarios          = $comentarios ;
        $this->estado               = $estado ;
        $this->id_rol_congreso_fk   = $id_rol_congreso_fk ;
        }
    
    /*ALEXIS ESCOTO
       16-01-2023
    *Creacion de SELECT tbl_usuario_congreso_rol_pk
    SELECT con metodo PDO
     *      */
    public function selectmaxid(){/*funcion para extraer el ultimo id insertado*/
        /*
        $bdd = new basedatos();
        return $bdd->select("SELECT MAX(tbl_usuario_congreso_rol_pk) AS tbl_usuario_congreso_rol_pk "
                . "FROM tbl_usuario_congreso_roles");  
         * */
         $pdo = $this->base->abrir_conexion(); 
        $datos = $pdo->query("SELECT MAX(tbl_usuario_congreso_rol_pk) AS tbl_usuario_congreso_rol_pk 
                 FROM tbl_usuario_congreso_roles");
    
        return $datos;
         
    }
    /*ALEXIS ESCOTO
     *  Creacion de INSERT   tbl_voluntario.
     con metodo PDO
     */
    public  function crea_voluntario(){
        /*$bdd = new basedatos();
        return $bdd->insert("insert into tbl_voluntario(id_voluntario_pk, numero_horas, comentarios,
         *  estado, id_rol_congreso_fk) "
                . "values (?,?,?,?,?)","iisii",[$this->id_voluntario_pk,  $this->numero_horas, 
                    $this->comentarios,  $this->estado, $this->id_rol_congreso_fk],True);*/
     $pdo = $this->base->abrir_conexion();   
    $datos   =   $pdo->prepare("INSERT INTO tbl_voluntario (id_voluntario_pk, numero_horas, comentarios,estado, 
      id_rol_congreso_fk) VALUES(?,?,?,?,?)");
    $resultado=$datos->execute([$this->id_voluntario_pk,$this->numero_horas,$this->comentarios, $this->estado,
        $this->id_rol_congreso_fk]);
    return $resultado;
    }
    

 /*Alexis Escoto 21/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_solicitud
    SELECT con metodo PDO
    */
    public function tbl_inscribir_voluntarios(){
       $pdo = $this->base->abrir_conexion(); 
        $idcongreso = $_SESSION['idcongreso']; 
        $datos = $pdo->query('select a.id_usuario_pk from tbl_solicitud a
        join tbl_usuario b on b.id_usuario_pk = a.id_usuario_pk
        join tbl_persona c on c.id_persona_pk = b.id_persona_fk
        where a.id_tipo_solicitud = 5  
        order by c.primer_nombre
        ');
    
        return $datos;
     /*   $solicitudesxusuario = $bdd->select('select a.id_usuario_pk from tbl_solicitud a
        join tbl_usuario b on b.id_usuario_pk = a.id_usuario_pk
        join tbl_persona c on c.id_persona_pk = b.id_persona_fk
        where a.id_tipo_solicitud = 5  and a.id_congreso_pk = "'.$idcongreso.'" 
        order by c.primer_nombre
        ');
*/
    
    }
     /*Alexis Escoto 21/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_voluntario
    SELECT con metodo PDO
    */
    function voluntarios_inscritos(){
        $pdo = $this->base->abrir_conexion(); 
    
        $datos = $pdo->query('select * from tbl_voluntario a
        join tbl_usuario_congreso_roles b on b.tbl_usuario_congreso_rol_pk = a.id_rol_congreso_fk
        join tbl_usuario c on c.id_usuario_pk = b.id_usuario_fk ');
        return $datos;
    
     
    }
        /*Alexis Escoto 21/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_persona
    SELECT con metodo PDO
    */
    function personas_registradas(){
        $pdo = $this->base->abrir_conexion(); 
    
        $datos = $pdo->query('select * from tbl_persona a
        join tbl_usuario b on b.id_persona_fk = a.id_persona_pk
            ');
        return $datos;
    
     
    }
           /*Alexis Escoto 21/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_persona
    SELECT con metodo PDO
    */
    public function tbl_solicitudes_voluntarios(){
        $pdo = $this->base->abrir_conexion(); 
    
        $datos = $pdo->query('select * from tbl_solicitud a
        join tbl_usuario b on b.id_usuario_pk = a.id_usuario_pk
        join tbl_persona c on c.id_persona_pk = b.id_persona_fk
        where a.id_tipo_solicitud = 1  and a.status = 0
        order by c.primer_nombre
        ');
        return $datos;
    
     
    }
    public function inicia_actividad_voluntario($id_tarea_voluntario_pk, $nombre_tarea, $descripcion, $archivo_complementario, $persona_apoyo, $creado_por, $fecha_creacion, $modificado_por, $fecha_modificacion, $fecha_tarea, $hora_tarea){
        $this->id_tarea_voluntario_pk   = $id_tarea_voluntario_pk ;
        $this->nombre_tarea             = $nombre_tarea ;
        $this->descripcion              = $descripcion ;
        $this->archivo_complementario   = $archivo_complementario ;
        $this->persona_apoyo           = $persona_apoyo ;
        $this->creado_por               = $creado_por ;
        $this->fecha_creacion           = $fecha_creacion;
        $this->modificado_por           = $modificado_por;
        $this->fecha_modificacion       = $fecha_modificacion ;
        $this->fecha_tarea              = $fecha_tarea ;
        $this->hora_tarea               = $hora_tarea ;
           
    }
    
    public function crear_actividad_voluntario(){
        /*
       $bdd = new basedatos();
       return $bdd->insert("insert into tbl_tarea_voluntario(id_tarea_voluntario_pk, nombre_tarea, 
       descripcion, archivo_complementario, persona_apoyo, creado_por,fecha_creacion,modificado_por,
       fecha_modificacion,fecha_tarea,hora_tarea) "
                . "values (?,?,?,?,?,?,?,?,?,?,?)","issssisissi",[$this->id_tarea_voluntario_pk, 
                 $this->nombre_tarea,  $this->descripcion,  $this->archivo_complementario['archio_complementario']['name'],
                  $this->persona_apoyo, $this->creado_por, $this->fecha_creacion, $this->modificado_por, $this->fecha_modificacion, 
                  $this->fecha_tarea, $this->hora_tarea],True);
*/
/*Alexis Escoto 6/12/2022
    Creacion de   INSERT tbl_tarea_voluntario.
    Insert con metodo PDO
    HACE FALTA REVISAR BIEN EL ARCHIVO COMPLEMENTARIO
    */
                  $pdo = $this->base->abrir_conexion();   
                  
                   $datos   =   $pdo->prepare("INSERT INTO tbl_tarea_voluntario
                   (id_tarea_voluntario_pk, nombre_tarea, descripcion, archivo_complementario,
                    persona_apoyo,creado_por,fecha_creacion, modificado_por,
                   fecha_modificacion,fecha_tarea,hora_tarea) VALUES
                    (?,?,?,?,?,?,?,?,?,?,?)");
                   $resultado=$datos->execute([NULL, 
                   $this->nombre_tarea,  $this->descripcion,  
                   $this->archivo_complementario['archio_complementario']['name'],
                    $this->persona_apoyo, $this->creado_por, date("y-m-d"), 
                    $this->creado_por, date("y-m-d"), 
                    $this->fecha_tarea, $this->hora_tarea]);
    }
         /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_voluntario, dentro de la funcion tbl_actividades_voluntarios
    SELECT con metodo PDO
    */
    function tbl_actividades_voluntarios(){
        $pdo = $this->base->abrir_conexion(); 
    
        $datos = $pdo->query("select * from tbl_voluntario a 
        join tbl_usuario_congreso_roles b on b.tbl_usuario_congreso_rol_pk = a.id_rol_congreso_fk
        join tbl_usuario c on c.id_usuario_pk = b.id_usuario_fk 
        join tbl_persona d on d.id_persona_pk = c.id_persona_fk");
        return $datos;
    
     
    }
        /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_voluntario, dentro de la funcion tbl_voluntario_tarea_voluntario
    SELECT con metodo PDO
    */
    function actividades_voluntarios($id_voluntario){
        $pdo = $this->base->abrir_conexion(); 
    
        $datos = $pdo->query('select * from tbl_voluntario_tarea_voluntario a 
        join tbl_tarea_voluntario b on b.id_tarea_voluntario_pk = a.id_tarea_voluntario_fk
        where id_voluntario_fk  ="'.$id_voluntario.'" ');
        return $datos;

    
    }

        /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_voluntario, dentro de la funcion tbl_validacion_voluntario
    SELECT con metodo PDO
    */
    function tbl_validacion_voluntario(){
        $pdo = $this->base->abrir_conexion();   
        $datos = $pdo->query("select * from tbl_voluntario a 
        join tbl_usuario_congreso_roles b on b.tbl_usuario_congreso_rol_pk = a.id_rol_congreso_fk
        join tbl_usuario c on c.id_usuario_pk = b.id_usuario_fk 
        join tbl_persona d on d.id_persona_pk = c.id_persona_fk 
        where a.estado = 0");
        return $datos;

    
    }

          /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_voluntario_tarea_voluntario, dentro de la funcion tbl_voluntario_tarea_voluntario
    SELECT con metodo PDO
    */
    function validacion_voluntario($id_voluntario){
        $pdo = $this->base->abrir_conexion(); 
        $datos = $pdo->query('select * from tbl_voluntario_tarea_voluntario a 
        join tbl_tarea_voluntario b on b.id_tarea_voluntario_pk = a.id_tarea_voluntario_fk
        where id_voluntario_fk  ="'.$id_voluntario.'" ');
        return $datos;

    
    }
              /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_usuario_congreso_roles, dentro de la funcion act_asignada_voluntarios
    SELECT con metodo PDO

    REVISARLO BIEN
    */
     function act_asignada_voluntarios($id_usuario){
        $pdo = $this->base->abrir_conexion(); 
     
        $datos = $pdo->query(" select * from tbl_usuario_congreso_roles a
        join tbl_voluntario b on b.id_rol_congreso_fk = a.tbl_usuario_congreso_rol_pk
        join tbl_voluntario_tarea_voluntario c on c.id_voluntario_fk = b.id_voluntario_pk
        join tbl_tarea_voluntario d on d.id_tarea_voluntario_pk = c.id_tarea_voluntario_fk
        where a.id_usuario_fk ='".$id_usuario."'  ");
        return $datos->fetchAll(PDO::FETCH_ASSOC);

    
    }

                  /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT from, dentro de la funcion tbl_asis_persona
    SELECT con metodo PDO

    REVISARLO BIEN
    */
    function tbl_asis_persona(){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("Select * from tbl_persona a
        join tbl_usuario b on b.id_persona_fk = a.id_persona_pk
        ");
        return $datos;

    
    }
                      /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT from, dentro de la funcion tbl_asis_autores
    SELECT con metodo PDO

    REVISARLO BIEN
    */
    function tbl_asis_autores(){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("select * from tbl_trabajo  a
        join tbl_usuario_trabajo b on b.id_trabajo_fk = a.id_trabajo_pk
        join tbl_usuario c on c.id_usuario_pk = b.id_usuario_fk
        join tbl_persona d on d.id_persona_pk = c.id_persona_fk
        where id_estado_fk = 7 and  b.autor_principal = 1
        ");
        return $datos->fetchAll(PDO::FETCH_ASSOC);

    
    }
                      /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT from, dentro de la funcion pagos_persona
    SELECT con metodo PDO

    REVISARLO BIEN
    */
    function pagos_persona(){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("Select * from tbl_persona a 
        join tbl_correo b on b.id_persona_fk = a.id_persona_pk
        ");
        return $datos;

    }
                  /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_usuario, dentro de la funcion pago_usuario
    SELECT con metodo PDO

    REVISARLO BIEN
    */
   public  function pago_usuario($id_persona){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("select * from tbl_usuario c 
        join tbl_usuario_trabajo d on d.id_usuario_fk = c.id_usuario_pk
        join tbl_trabajo e on e.id_trabajo_pk = d.id_trabajo_fk
        where c.id_persona_fk=".$id_persona." and e.id_estado_fk =7
        ");
        return $datos;

    
    }
                  /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_usuario, dentro de la funcion pago_usuario
    SELECT con metodo PDO

    REVISARLO BIEN
    */
    function costo_usuario($idusuario){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("Select * from tbl_costo_x_usuario a 
        join tbl_costo b on b.id_costo_pk = a.id_costo_fk
        where a.id_usuario_fk = ".$idusuario." and b.producto LIKE '%Inscripción'
        ");
        return $datos;

    
    }
    /*Alexis Escoto 22/12/2022
    Cuenta:20161000817
    Creacion de SELECT tbl_usuario_trabajo, dentro de la funcion usuario_trabajo
    SELECT con metodo PDO

    REVISARLO BIEN
    */
    function usuario_trabajo($idtrabajo){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query("select * from tbl_usuario_trabajo a
        join tbl_usuario b on b.id_usuario_pk = a.id_usuario_fk
        join tbl_persona c on c.id_persona_pk = b.id_persona_fk
        where a.id_trabajo_fk  =".$idtrabajo."  
        ");
        return $datos;

    
    }
    public function inicia_asociar_actividad_voluntario($idvoluntario ,$idactividad){
        $this->id_voluntario_pk         = $idvoluntario; 
        $this->id_tarea_voluntario_pk   = $idactividad;
    }
/*Alexis Escoto 16/01/2023
    Cuenta:20161000817
    Creacion de SELECT tbl_voluntario, dentro de la funcion asociar_actividad_voluntario,
    Creacion de SELECT tbl_tarea_voluntario, dentro de la funcion asociar_actividad_voluntario,
    Ambos SELECT con metodo PDO

     Creacion de UPDATE tbl_voluntario, dentro de la funcion asociar_actividad_voluntario,
      Creacion de INSERT tbl_voluntario_tarea_voluntario, dentro de la funcion asociar_actividad_voluntario,
    Ambos con metodo PDO
*/
    public function asociar_actividad_voluntario(){
        /*$bdd = new basedatos();
        $horas_actuales = $bdd->select("select numero_horas from tbl_voluntario where id_voluntario_pk = ".$this->id_voluntario_pk." ");
        $horas_tarea = $bdd->select("select hora_tarea from tbl_tarea_voluntario where id_tarea_voluntario_pk = ".$this->id_tarea_voluntario_pk." ");
        */
        $pdo = $this->base->abrir_conexion();
        $horas_actuales = $pdo->query("select numero_horas from tbl_voluntario where id_voluntario_pk = ".$this->id_voluntario_pk." ");
        $horas_tarea = $pdo->query("select hora_tarea from tbl_tarea_voluntario where id_tarea_voluntario_pk = ".$this->id_tarea_voluntario_pk." ");
        
        foreach ($horas_actuales as $valor){
            $hora_actual = $valor['numero_horas'];
        }
        
        foreach ($horas_tarea as $datos){
            $hora_tarea = $datos['hora_tarea'];
        }
        /*
        $horas_totales = intval($hora_actual) + intval($hora_tarea) ;
        $bdd->update("update tbl_voluntario set numero_horas= ".$horas_totales." where id_voluntario_pk = ".$this->id_voluntario_pk." ");
        return $bdd->insert("insert into tbl_voluntario_tarea_voluntario(id_voluntario_fk, id_tarea_voluntario_fk) values (?,?)","ii",[$this->id_voluntario_pk,  $this->id_tarea_voluntario_pk],True);
    */

        $horas_totales = intval($hora_actual) + intval($hora_tarea) ;
       
       $result = $pdo->prepare("UPDATE tbl_voluntario SET numero_horas=? WHERE id_voluntario_pk=?");
      $resultados=$result->execute([$horas_totales,$this->id_voluntario_pk]);

      $datos =  $pdo->prepare("INSERT INTO tbl_voluntario_tarea_voluntario(id_voluntario_fk, id_tarea_voluntario_fk)
      VALUES (?,?)");
      $resultado=$datos->execute([$this->id_voluntario_pk,  $this->id_tarea_voluntario_pk]);
      return $resultado;
    
    }
    
    public function validar_voluntario($idvoluntario){
        $bdd = new basedatos();
        return $bdd->update("update tbl_voluntario set estado=1 where id_voluntario_pk = ".$idvoluntario." ");
    }

/*Alexis Escoto 16/01/2023
Cuenta:20161000817
Creacion de SELECT tbl_tarea_voluntario.
Con metodo PDO
*/
    public function info_actividad_voluntario($idtarea){
      /*
        $bdd= new basedatos();
       return $bdd->select("select * from tbl_tarea_voluntario where id_tarea_voluntario_pk = ".$idtarea." ");*/
       $pdo = $this->base->abrir_conexion();
       $datos = $pdo->query("select * from tbl_tarea_voluntario where id_tarea_voluntario_pk = ".$idtarea." ");
    return   $datos;
    }

/* Alexis Escoto 17/01/2023
Cuenta:20161000817
Creacion de UPDATE tbl_trabajo  con metodo PDO */
    public function validar_asistencia_persona($idactividad,$idcongreso,$idusuario){
        /* $bdd = new basedatos();
        return $bdd->update("update tbl_usuario_actividad_congreso set asistio=1 where id_actividad_fk = ".$idactividad." and id_congreso_fk= ".$idcongreso." and id_usuario_fk= ".$idusuario." ");*/
        $pdo = $this->base->abrir_conexion(); 
        $datos =  $pdo->prepare("UPDATE tbl_usuario_actividad_congreso SET asistio=? where id_actividad_fk=?  and id_congreso_fk= ? and id_usuario_fk= ?");
        $resultados=$datos->execute([1, $idactividad,$idcongreso,$idusuario]);
        return $resultados;
    }

/* Alexis Escoto 17/01/2023
Cuenta:20161000817
Creacion de SELECT tbl_usuario_actividad_congreso  con metodo PDO */
    public function tbl_itinerario_persona($persona){
        $pdo = $this->base->abrir_conexion(); 
        $datos =  $pdo->query("select * from tbl_usuario_actividad_congreso a 
        join tbl_usuario b on b.id_usuario_pk = a.id_usuario_fk
        join tbl_persona c on c.id_persona_pk = b.id_persona_fk
        join tbl_actividad d on d.id_actividad_pk = a.id_actividad_fk
        join tbl_tipo_actividad e on e.id_tipo_actividad_pk = d.id_tipo_actividad_fk
        join tbl_espacio f on f.id_espacio_pk = d.id_espacio_pk 
    where c.id_persona_pk = '".$persona."' and a.asistio = 0
    ");
    
        return $datos;
    }

    public function validar_asistencia_autor($idtrabajo, $estado, $idcongreso){
/*Alexis Escoto 17/01/2023
Cuenta:20161000817
Creacion de SELECT tbl_congreso ,tbl_trabajo.
Con metodo PDO
*/ 
        $pdo = $this->base->abrir_conexion(); 
        $congreso = $pdo->query("SELECT * FROM tbl_congreso where id_congreso_pk='".$idcongreso."'");
        $infotrabajo = $pdo->query("SELECT * FROM tbl_trabajo a 
                join tbl_usuario_trabajo b on b.id_trabajo_fk = a.id_trabajo_pk
                join tbl_usuario c on c.id_usuario_pk = b.id_usuario_fk
                join tbl_persona d on d.id_persona_pk = c.id_persona_fk
                join tbl_correo e on e.id_persona_fk = d.id_persona_pk
                where a.id_trabajo_pk = '".$idtrabajo."' and b.autor_principal =1 and e.principal = 1 
                ");
        
        foreach ($infotrabajo as $correo) {
           $correautor = $correo['correo'];                                               
           // $correautor = 'btriminio@iies-unah.org';                                               
        }
        
        foreach ($infotrabajo as $informacion) {
            $titulotrabajo = "".strtoupper($informacion['titulo_trabajo'])."";                                               
        }
         /*enviamos el correo a los usuario con el rol revisor */
        $titulo="VALIDACIÓN AUTOR";  
        $mensaje="<html>"; 
        $mensaje.="<p>";
        $mensaje.="UNIVERSIDAD NACIONAL AUTÓNOMA DE HONDURAS (UNAH).";
        $mensaje.="</p><BR>";
        $mensaje.="<p>";
        $mensaje.="INSTITUTO DE INVESTIGACIONES ECONÓMICAS Y SOCIALES (IIES).";
        $mensaje.="</p>";
        //$mensaje.="<title></title";
        $mensaje.="<body>";
        $mensaje.="<p>";
        $mensaje.="Estimado(a)";
        $mensaje.="</p><BR>";
        $mensaje.="<p>";
        foreach ($congreso as $key) {
        $mensaje.="EL CONGRESO ".strtoupper($key['nombre_congreso'])."<br>Le Comunica a usted lo siguiente:<br><br>";                                               
        }
        $mensaje.="Se ha validado su asistencia al congreso ".strtoupper($key['nombre_congreso'])." "
                . "<br><br>Le invitamos a que ingrese nuestro Sitio WEB :<br> <a href='http://ceat-unah.org/' target='_blank'><b>INGRESAR AL SITIO</b></a>"
                . "<br><br>";
        $mensaje.="</p>";
        $mensaje.="<p>";     
        $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
        $mensaje.="</p>";
        $mensaje.="</body>";
        $mensaje.="</html>";      
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        if( mail($correautor, $titulo, $mensaje, $cabeceras)){
            $enviomj = 1;
        }
    // return $bdd->update("update tbl_trabajo set id_estado_fk=".$estado." where id_trabajo_pk = ".$idtrabajo."  ");
/* Alexis Escoto 17/01/2023
Cuenta:20161000817
Creacion de UPDATE tbl_trabajo  con metodo PDO */
        $datos =  $pdo->prepare("UPDATE tbl_trabajo SET id_estado_fk=? where id_trabajo_pk=?");
        $resultados=$datos->execute([$estado, $idtrabajo]);
        return $resultados;
        }
        
        public function info_costo($id){
            $bdd= new basedatos();
            return $bdd->select("select * from tbl_costo where id_costo_pk = ".$id." "); 
        }
        
        public function info_tour($id){
            $bdd= new basedatos();
            return $bdd->select("select * from tbl_tour where id_tour_pk = ".$id." "); 
        }
        
        public function info_factura(){
            $bdd= new basedatos();
            return $bdd->select("select * from tbl_factura"); 
        }
        
  /*Alexis Escoto 18/01/2023
Cuenta:20161000817
Creacion de  SELECT tbl_usuario en funcion id_usuario
Con metodo PDO
    */      
        public function id_usuario($id){
            /*$bdd= new basedatos();
            return $bdd->select("select id_usuario_pk from tbl_usuario where id_persona_fk =".$id."  ");*/
            $pdo= $this->base->abrir_conexion();
            return $datos=$pdo->query("select id_usuario_pk from tbl_usuario where id_persona_fk =".$id."  ");
        }
        
/*Alexis Escoto 10/01/2023
Cuenta:20161000817
Creacion de mostrar_intereses_revisor
SELECT con metodo PDO
    */
    public function mostrar_intereses_revisor($idsol){
        $pdo = $this->base->abrir_conexion();  
   
        $datos = $pdo->query("select d.nombre_tematica from tbl_solicitud a
        join tbl_solicitud_has_tbl_tematica b on b.tbl_solicitud_id_solicitud=a.id_solicitud
        join tbl_usuario c on c.id_usuario_pk=a.id_usuario_pk
        join tbl_tematica d on d.id_tematica_pk=b.tbl_tematica_id_tematica_pk
        join tbl_persona e on e.id_persona_pk=c.id_persona_fk
        join tbl_congreso_linea_investigacion g on g.id_linea_investigacion_pk=d.id_linea_investigacion_fk
        where a.id_tipo_solicitud='1' and a.status='0' and g.id_congreso_pk=1 and a.id_solicitud='$idsol'");
        return $datos;
       
    }
                             /*Alexis Escoto 17/01/2023
    Cuenta:20161000817
    Creacion de SELECT tbl_costo, dentro de la funcion slc_tipo_pago
    SELECT con metodo PDO
    */
    function slc_tipo_pago(){
        $pdo = $this->base->abrir_conexion(); 
       
        $datos = $pdo->query('select * from tbl_costo order by id_costo_pk ');
        return $datos;

    }
 
    
}
