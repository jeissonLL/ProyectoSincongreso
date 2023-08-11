<?php

/**----Clase Persona----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */

require_once 'class_base.php';
require_once 'class_usuario.php';
class persona extends usuario{
    private $idpersona;
    private $pnombre;
    private $snombre;
    private $papellido;
    private $sapellido;
    private $tprincipal;
    private $correos;
    private $tidentificacion;
    private $pais;
    private $identificacion;
    private $tpersona;
    private $talimentacion;
    private $nusuario;
    private $contrasenia;
    private $idioma;     
    private $institucion;
    private $trabaja;
    private $facultad;

    public function __construct() {
        $this->base = new basedatos();
        
    }
    public function pinicializar($idpersona,$pnombre,$snombre,$papellido,$sapellido,$correos,$tprincipal,$tidentificacion,$pais,$identificacion, $tpersona,$talimentacion,$nusuario,$contrasenia,$idioma, $institucion, $facultad,$trabaja)
        {
            $this-> idpersona=$idpersona;
            $this-> pnombre=$pnombre;
            $this-> snombre=$snombre;
            $this-> papellido=$papellido;
            $this-> sapellido=$sapellido;
            $this-> tprincipal=$tprincipal;
            $this-> correos=$correos;
            $this-> tidentificacion=$tidentificacion;
            $this-> pais=$pais;
            $this-> identificacion=$identificacion;
            $this-> tpersona=$tpersona;
            $this-> talimentacion=$talimentacion;
            $this-> nusuario=$nusuario;
//            $this-> contrasenia=password_hash($contrasenia, PASSWORD_DEFAULT);
            $salt=substr(base64_encode(openssl_random_pseudo_bytes(17)),0,22);            
            $this-> contrasenia=crypt($contrasenia, $salt);
            $this-> idioma=$idioma;    
            $this->institucion=$institucion;
            $this->trabaja=$trabaja;
            $this->facultad=$facultad;
            
        }
                
        public function get_id(){
		return $this->idpersona;
	}
     /*Alexis Escoto 14/11/2022
    Cuenta:20161000817
    Creacion de INSERT tbl_persona, En la funcion registro
    Insert con metodo PDO
    */
        public function registro()
        {
/*
            $bdd = new basedatos();
            $this-> idpersona=$bdd->insert("INSERT INTO tbl_persona(id_psersona_pk,primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
            identificacion, "
                    . " id_tipo_persona_fk, id_tipo_alimentacion_fk, id_tipo_identificacion_fk, id_pais_fk) "
                    . " VALUES (?,?,?,?,?,?,?,?,?)",'sssssiiis',[$this->pnombre,$this->snombre,$this->papellido,$this->sapellido
                    ,$this->identificacion,$this->tpersona,$this->talimentacion,$this->tidentificacion,  $this->pais], TRUE );
        return $this->idpersona;
        */
        $pdo = $this->base->abrir_conexion();    
        $datos =  $pdo->prepare("INSERT INTO tbl_persona(id_persona_pk,primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, 
        identificacion,id_tipo_persona_fk, id_tipo_alimentacion_fk, id_tipo_identificacion_fk, id_pais_fk)
        VALUES (?,?,?,?,?,?,?,?,?,?)");

        $resultado=$datos->execute([NULL,$this->pnombre,$this->snombre,$this->papellido,$this->sapellido
        ,$this->identificacion,$this->tpersona,$this->talimentacion,$this->tidentificacion,  $this->pais]);
        
        return $this->idpersona;
        }
     /*Alexis Escoto 14/11/2022
    Cuenta:20161000817
    Creacion de INSERT tbl_telefono, En la funcion asignar_telefono
    Insert con metodo PDO
    */
        public function asignar_telefono()
        {/*
            $bdd = new basedatos();
            return $bdd -> insert("INSERT INTO tbl_telefono(numero_telefono, id_persona_fk, principal)
             VALUES (?,?,?)",'iii', [$this->tprincipal,  $this->idpersona, 1], TRUE);
           */

            $pdo = $this->base->abrir_conexion();    
            $datos =  $pdo->prepare("INSERT INTO tbl_telefono(id_telefono_pk,numero_telefono,
             id_persona_fk, principal)
            VALUES (?,?,?,?)");
    
            $resultado=$datos->execute([NULL,$this->tprincipal, $this->idpersona, 1]);
          return $pdo->lastInsertId();
        }

    /*Alexis Escoto 14/11/2022
    Cuenta:20161000817
    Creacion de INSERT tbl_correo, En la funcion asignar_correo
    Insert con metodo PDO
    */
        public function asignar_correo()
        {
            $pdo = $this->base->abrir_conexion();  
            $verificador = 0;
            $correos = $this->correos;
//            print_r($correos);
            if($correos['principal'])
            {
               
                $datos = $pdo->prepare("INSERT INTO tbl_correo(id_correo_pk,correo, principal, id_persona_fk)
                VALUES (?,?,?,?)");
               
       
               $verificador=$datos->execute([NULL,$correos['principal'],1,$this->idpersona]);
            }
            if(($verificador != -1) && (isset($correos['alterno'])))
            {
                for ($i=0;$i<count($correos['alterno']);$i++){
                    if(count($correos['alterno']==1))        
                    {
                    $correo = $correos['alterno'];    
                    }else{
                        $correo = $correos['alterno'][$i]; 
                        }
                    
                          /*  $verificador=$bdd->insert("INSERT INTO tbl_correo(correo, principal, id_persona_fk) VALUES (?,?,?)",'sii', 
                            [$correo,0,$this->idpersona], TRUE);*/
                            $datos=$bdd->prepare("INSERT INTO tbl_correo(id_correo_pk,correo, principal, id_persona_fk) 
                            VALUES (?,?,?,?)");
                            $verificador=$datos->execute([NULL,$correo,0,$this->idpersona]);
                            if(($verificador != -1) || ($verificador != 0)){
                                $verificador = $i;
                            }else{

                                /*
                                $verificador=$bdd->insert("delete from tbl_correo where correo =? and id_persona_fk = ?"
                                    . " ",'si',[$correo,$this->idpersona], TRUE );     
                                return -1;
                                */
                            $verificador=$bdd->prepare("delete from tbl_correo where correo =? and id_persona_fk = ?")->execute([$correo,$this->idpersona]);
                            return -1;
                            }
                        }                
            }
            if(($verificador+1) == ($correos['alterno'])){
                       return 1;        
                   }else{
                       return -1;
                   }            
        }        

    /*Alexis Escoto 15/11/2022
    Cuenta:20161000817
    Creacion de INSERT tbl_usuario, En la funcion crear_usuario
    Insert con metodo PDO
    */
        public function crear_usuario()
        {/*
            $bdd = new basedatos();
            return $bdd -> insert("INSERT INTO tbl_usuario(nombre_usuario, 
            contrasena, id_persona_fk, id_idioma_fk) VALUES (?,?,?,?)",'ssis',[$this->nusuario, 
             $this->contrasenia,  $this->idpersona, $this->idioma], TRUE);
*/
         $pdo = $this->base->abrir_conexion();  
             $datos=$pdo->prepare("INSERT INTO tbl_usuario(id_usuario_pk,nombre_usuario, 
             contrasena, id_persona_fk, id_idioma_fk) 
             VALUES (?,?,?,?,?)");
             $verificador=$datos->execute([NULL,$this->nusuario, 
             $this->contrasenia,  $this->idpersona, $this->idioma]);
         
        }
    /*Alexis Escoto 15/11/2022
    Cuenta:20161000817
    Creacion de INSERT tbl_persona_institucion, En la funcion asignar_institucion
    Insert con metodo PDO
    */
        public function asignar_institucion()
        {/*
            $bdd = new basedatos();
            return $bdd -> insert("INSERT INTO tbl_persona_institucion(id_institucion_facultad_carrera,
            id_persona_pk,trabaja,id_institucion_pk) VALUES (?,?,?,?)",'iiii',[$this->institucion,$this->idpersona, 
             $this->trabaja, $this->facultad], TRUE);
//            return "INSERT INTO tbl_persona_institucion(id_institucion_facultad_carrera,id_persona_pk,trabaja,id_institucion_pk)
 VALUES ($this->idpersona,  $this->trabaja, $this->institucion, $this->facultad)";
       */
      $pdo = $this->base->abrir_conexion();  
      $datos = $pdo->prepare("INSERT INTO tbl_persona_institucion(id_institucion_pk,id_institucion_facultad_carrera,
      id_persona_pk,trabaja)
      VALUES (?,?,?,?)");


$verificador=$datos->execute([NULL,$this->institucion,$this->idpersona,$this->trabaja]);
}
        
        public function update_persona()
        {
            $bdd = new basedatos();
            return $bdd ->update("UPDATE tbl_persona SET primer_nombre=?,segundo_nombre=?,primer_apellido=?,segundo_apellido=?,identificacion=?,"
                    . " id_tipo_alimentacion_fk=?,id_tipo_identificacion_fk=?,id_pais_fk=? "
                    . "WHERE 1=1 and id_persona_pk='$this->idpersona'","sssssiis",[$this->pnombre,$this->snombre,$this->papellido,$this->sapellido,  $this->identificacion, $this->talimentacion,  $this->tidentificacion,  $this->pais]);
        }
        public function update_telefono()
        {
            $bdd = new basedatos();
            return $bdd ->update("UPDATE tbl_telefono SET numero_telefono=?,principal=1 WHERE 1=1 and id_persona_fk='$this->idpersona'","i",[$this->tprincipal] );
        }        
        public function update_correo()
        {
            $bdd = new basedatos();
            $verificador = 0;
            $correos = $this->correos;
            
            if($correos['principal'])
            {
                $verificador = $bdd -> update("update tbl_correo set correo=? where 1=1 and principal= ? id_persona_fk =?",'sii', [$correos['principal'],1,$this->idpersona], TRUE);
            }
            if(($verificador != -1) && (isset($correos['alterno'])))
            {
                for ($i=0;$i<count($correos['alterno']);$i++){
                            $correo = $correos['alterno'][$i];
                            $verificador=$bdd->insert("update tbl_correo set correo=? where 1=1 and principal= ? id_persona_fk =?",'sii', [$correo,0,$this->idpersona], TRUE);
                            if(($verificador != -1) || ($verificador != 0)){
                                $verificador = $i;
                            }else{
                                $verificador=$bdd->insert("delete from tbl_correo where correo =? and id_persona_fk = ?"
                                    . " ",'si',[$correo,$this->idpersona], TRUE );     
                                return -1;
                            }
                        }                
            }
            if(($verificador+1) == count($correos['alterno'])){
                       return 1;        
                   }else{
                       return -1;
                   }
        }        
        

}