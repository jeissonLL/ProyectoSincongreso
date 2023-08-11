<?php

/**----Clase Persona----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */

class solicitud {
    private $idsolicitud;
    private $tsolicitud;
    private $motivo;
    private $status;
    private $idcongreso;
    private $idusuario;
    private $fsolicitud;
    private $correo;
    private $nusuario;
    private $dsolicitud;
    private $tematica;   
    private $fresolucion;
    private $congreso_rol;
    private $certificado;
    private $idioma;    

    public function sinicializar($idsolicitud, $tsolicitud, $motivo, $status, $idcongreso, $idusuario, $fsolicitud,$correo, $nusuario,$tematica, $fresolucion,$congreso_rol,$certificado,$idioma)
    {
        $this-> idsolicitud = $idsolicitud;
        $this-> tsolicitud = $tsolicitud;
        $this-> motivo = $motivo;
        $this-> status = $status;
        $this-> idcongreso = $idcongreso;
        $this-> idusuario = $idusuario;
        $this-> fsolicitud = $fsolicitud;
        $this-> correo = $correo;
        $this-> nusuario=$nusuario;
        $this-> tematica=$tematica;    
        $this-> fresolucion = $fresolucion;
        $this-> congreso_rol = $congreso_rol;
        $this-> certificado = $certificado;
        $this-> idioma = $idioma;        
    }
        
    public function screar()
    {
        $bdd = new basedatos();
        return $this-> idsolicitud=$bdd->insert("INSERT INTO tbl_solicitud(id_solicitud, id_tipo_solicitud, motivo_solicitud, status, fecha_solicitud, fecha_resolucion, id_usuario_pk)"
                                                         . " VALUES (NULL,?,?,?,?,NULL,?)",'isssi',[$this->tsolicitud,$this->motivo,$this->status,$this->fsolicitud,$this->idusuario], TRUE );
//        echo "INSERT INTO tbl_solicitud(id_solicitud, id_tipo_solicitud, motivo_solicitud, status, fecha_solicitud, fecha_resolucion) VALUES (NULL,$this->tsolicitud,$this->motivo,$this->status,$this->fsolicitud,NULL)";
    }
    
    public function aceptar_solicitud()
    {
        $bdd = new basedatos();
        return $bdd ->update("UPDATE tbl_solicitud SET status = '1' , fecha_resolucion=? WHERE id_solicitud = ?",'si',[$this->fresolucion ,$this->idsolicitud]);
    }
    
    public function rechazar_solicitud()
    {
        $bdd = new basedatos();
        return $bdd ->update("UPDATE tbl_solicitud SET status = '2' , fecha_resolucion=? WHERE id_solicitud = ?",'si',[$this->fresolucion ,$this->idsolicitud]);
    }  
    
    public function get_solicitud()
    {
        $bdd = new basedatos();
        $datos = $bdd ->select("select nombre_tipo_solicitud from tbl_tipo_solicitud where id_tipo_solicitud =".$this-> tsolicitud."");
        return $datos;
    }    
    
    public function sol_rol()
    {
         $bdd = new basedatos();
         $verificador = $bdd->insert("INSERT INTO tbl_solicitud_roles_congreso(id_solicitud, id_rol_congreso_pk) "
                 . "VALUES (?,?)",'ii',[$this->idsolicitud,$this->congreso_rol],TRUE);
//                 echo "INSERT INTO tbl_solicitud_usuario_congreso_roles(id_solicitud, id_usuario_congreso_rol_pk) VALUES ($this->idsolicitud,$this->congreso_rol)";
                 
         if($verificador!=0)
         {
            $bdd->delete("DELETE FROM tbl_solicitud WHERE id_solicitud = ?",'i',[$this->idsolicitud]);
            return -1;
         }else{
                return 1;
         }                      
    }
    
    public function sol_tematica()
    {
        $bdd = new basedatos();
        $verificador;
        for ($i=0;$i<count($this->tematica);$i++)
        {
            $tematica = $this->tematica[$i];
            $verificador=$bdd->insert("INSERT INTO tbl_solicitud_tematica(id_solicitud, id_tematica_pk)"
                    . " VALUES (?,?)",'ii',[$this->idsolicitud,$tematica] );
            if(($verificador != -1) || ($verificador != 0))
            {
                $verificador = $i;
            }else{
                $verificador=$bdd->insert("delete from tbl_solicitud_tematica where id_solicitud =? and id_tematica_pk = ?"
                    . " ",'ii',[$this->idsolicitud,$tematica], TRUE );     
                return -1;
            }
        }
//        echo $verificador.count($this->tematica);
        if(($verificador+1) == count($this->tematica))
        {
            return 1;        
        }else{
            return -1;
        }
    } 
    
    public function sol_certificado()
    {
        $bdd = new basedatos();
        return $bdd->insert("INSERT INTO tbl_solicitud_certificados(id_solicitud, id_certificado_pk)"
                    . " VALUES (?,?)",'ii',[$this->idsolicitud, $this->certificado], TRUE );
    }  
    public function sol_idioma()
    {
        $bdd = new basedatos();
        return $bdd->insert("INSERT INTO tbl_solicitud_idioma(id_solicitud, id_idioma_pk)"
                    . " VALUES (?,?)",'is',[$this->idsolicitud, $this->idioma], TRUE );
    }      
    
    public function envio_sol()
    {
        $time = time();
        $fecha = date("Y-m-d", $time);
        $usuario_email = $this->correo; 
        $remite_nombre = "CEAT"; //nombre de la página 
        $remite_email = "admin@ceat-unah.org"; // tu correo 
        $asunto = "Solicitud"; // Asunto (se puede cambiar) 
        $mensaje = "Se ha generado una nueva solicitud del tipo ".$this->dsolicitud ."para el usuario<strong> ".$this->nusuario."</strong> <br>"
                . " Su número de solicitud es: <strong>".$this->idsolicitud."</strong><br>"
                . " En estos momentos se ha enviado la solicitud a los administradores del congreso para que den su visto bueno."; 
        $cabeceras = "From: ".$remite_nombre." <".$remite_email.">\r\n"; 
        $cabeceras.= "Mime-Version: 1.0\n"; 
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $enviar_email = mail($usuario_email,$asunto,$mensaje,$cabeceras);            
    
        return $enviar_email;
    }
        //json_idiomas(), retorna un json con la información requerida para cada uno de los idiomas.
    public function json_sol_idioma() {
        if (!(require '../funciones/funcion_traducir.php')) {
            require '../funciones/funcion_traducir.php';
        }
        if (   (   strlen(   session_id()   )   <   1   )   ) {
            session_start();
        }
        
        $bdd = new basedatos();
        $idiomas = $bdd->select("select a.id_idioma_pk,a.id_solicitud, b.id_usuario_pk, b.motivo_solicitud, b.fecha_solicitud, d.nombre_usuario, c.nombre_idioma, CONCAT_WS (' ',e.primer_nombre, e.segundo_nombre, e.primer_apellido, e.segundo_apellido) as nombres from tbl_solicitud_idioma a
                    join tbl_solicitud b on b.id_solicitud=a.id_solicitud and b.status=0
                    join tbl_idioma c on c.id_idioma_pk=a.id_idioma_pk
                    join tbl_usuario d on d.id_usuario_pk=b.id_usuario_pk
                    join tbl_persona e on d.id_persona_fk=e.id_persona_pk");
        $arreglo                          =    array();

        foreach (   $idiomas   as   $valor   ) {
            $botones="<button type='button' class='rechazartraductor btn btn-danger waves-effect w-md waves-light m-b-5'>@@rechazar@@</button><button type='button' class='aceptartraductor btn btn-success waves-effect w-md waves-light m-b-5'>@@aceptar@@</button>";
            $botones = traducirstring($botones, "../idiomas/" . $_SESSION['idioma'] . "/" . $_SESSION['idioma'] . ".php");
            $arreglo["data"][]     =    array(
                "id_idioma_pk"     =>   $valor['id_idioma_pk'],
                "id_solicitud"     =>   $valor['id_solicitud'],
                "motivo_solicitud" =>   $valor['motivo_solicitud'],
                "fecha_solicitud"  =>   $valor['fecha_solicitud'],
                "id_usuario_pk"    =>   $valor['id_usuario_pk'],
                "nombre_usuario"   =>   $valor['nombre_usuario'],
                "nombre_idioma"    =>   $valor['nombre_idioma'],
                "nombres"          =>   $valor['nombres'],
                "botones"          =>   $botones
            );
        }
        if ( sizeof($arreglo) == 0) {
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
    
    public function procesar_sol(){
        
    }
}