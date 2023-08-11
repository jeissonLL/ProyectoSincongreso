<?php

/**----Archivo en el cual se conduce todas las transacciones de frontend respecto al usuario en todo el contexto del sistema----
 *
 * @author José L. Rodríguez 
 * @copyright 2017
 * @version 1
 */



$formulario= filter_input(INPUT_GET,'formulario');

switch ($formulario) {
    case 'form_registro':
        registrar();
        break;
    case 'form_login':
        logear();
        break;  
    case 'perfil':
        cargar_perfil();
        break;   
    case 'form_perfil':
        update_perfil();
        break;     
    case 'form_img':
        img();
        break;    
    case 'form_recuperar':
        form_recuperar();
        break;         
    case 'form_solicitud':
        form_solicitud();
        break;     
    case 'form_correo':
        form_correo();
        break;
    case 'form_info_req':
        form_info_req();
        break;
}

function form_info_req(){
    session_start();    
    $tpersona = filter_input(INPUT_POST,'tpersona');
    $institucion = 'NULL';
    $facultad = 'NULL';
    
    if ($tpersona==1 || $tpersona==2 || $tpersona==3)
    {
        $institucion = filter_input(INPUT_POST,'institucion');
    }else{
        $facultad = filter_input(INPUT_POST,'institucion'); //si no unah (trabajador o estudiante) camibar el nombre de la variable
    }
    $trabaja=0;
    if($tpersona==2 || $tpersona==4 || $tpersona==6){
        $trabaja=1;
    }    

    $persona=new persona();
    $persona->pinicializar($_SESSION['idpersona'], NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $tpersona, NULL, NULL, NULL, NULL, $institucion, $facultad, $trabaja);
    echo $pinstitucion = $persona ->asignar_institucion(); 
}
function form_correo(){

    session_start();    
    $correo = array('alterno' => $_POST['nuevo_correo']);
    $persona=new persona();
    $persona ->pinicializar($_SESSION['idpersona'], NULL, NULL, NULL, NULL, $correo, NULL, NULL, NULL,NULL, NULL, NULL,$_SESSION['nusuario'],NULL,NULL,NULL);
    echo $correos = $persona -> asignar_correo();        
}

function form_solicitud(){

    session_start();    
    $t_solicitud = filter_input(INPUT_POST,'tsolicitud');    
    $motivo = filter_input(INPUT_POST,'motivo');
    if(isset($_POST['tcertificado']))
    {
        $certificado=filter_input(INPUT_POST,'tcertificado');
    }
    if(isset($_POST['tparticipacion']))
    {
        $congreso_rol=filter_input(INPUT_POST,'tparticipacion');        
    }
    if(isset($_POST['origen_tematica']))
    {
       $tematica = $_POST['origen_tematica'];
    } 
    if(isset($_POST['idioma']))
    {
        $idioma=filter_input(INPUT_POST,'idioma');
    }    

    switch ($t_solicitud){
        case 1: //Solicitud de nuevo Rol

            $congreso = '';
            if(isset($_SESSION['idcongreso']))
            {
                $congreso = $_SESSION['idcongreso'];
            }else{
                $congreso = filter_input(INPUT_POST,'congreso');
            }
            $correo = $_SESSION['cprincipal'];
            $nusuario=$_SESSION['nusuario'];            
            
            require '../clases/class_solicitud.php';            
            $solicitud = new solicitud();
            $formato = 'Y-m-d';
            $fecha = date($formato);
            $solicitud ->sinicializar('', $t_solicitud, $motivo, '0', $congreso, $_SESSION['idusuario'], $fecha,$correo,$nusuario,$tematica,'',$congreso_rol,'','');
            $idsolicitud = $solicitud ->screar();
            $sol_tematica = 0;
            $rol=0;
            if($idsolicitud>0)
            {
                $rol = $solicitud->sol_rol();
            }
            if(isset($tematica))
            {
               $sol_tematica = $solicitud ->sol_tematica();         
            }
//            echo $idsolicitud."+".$sol_tematica."+".$rol;
            $nsolicitud = "";
            if($idsolicitud>0 && $sol_tematica>0 && $rol>0)
            {
                $datos = $solicitud ->get_solicitud();
                foreach ($datos as $fila)            
                {
                    $nsolicitud = $fila['nombre_tipo_solicitud'];
                }                
                if($nsolicitud != "")
                {
                   $verificador = $solicitud ->envio_sol();
                   if($verificador == TRUE)
                   {
                       echo 1;
                   }
                }else{
                    echo 0;
                }
            }else{
                echo 2;
            }
            break;
        case 2: //Solicitud de nuevo certificado
  
            $congreso = '';
            if(isset($_SESSION['idcongreso']))
            {
                $congreso = $_SESSION['idcongreso'];
            }else{
                $congreso = filter_input(INPUT_POST,'congreso');
            }
            $correo = $_SESSION['cprincipal'];
            $nusuario=$_SESSION['nusuario'];            
            
            require '../clases/class_solicitud.php';            

            $solicitud = new solicitud();
            $formato = 'Y-m-d';
            $fecha = date($formato);
            $solicitud ->sinicializar('', $t_solicitud, $motivo, '0', $congreso, $_SESSION['idusuario'], $fecha,$correo,$nusuario,'','','',$certificado,'');
            $idsolicitud = $solicitud ->screar();
            $nsolicitud = "";
            $sol_certificado =0;
            if(isset($certificado))
            {
               echo $sol_certificado = $solicitud ->sol_certificado();         
            }            
            if($idsolicitud > 0 && $sol_certificado ==0)
            {
                $datos = $solicitud ->get_solicitud();
            foreach ($datos as $fila)            
            {
                $nsolicitud = $fila['nombre_tipo_solicitud'];
            }                
                if($nsolicitud != "" )
                {
                    echo $solicitud ->envio_sol();
                }else{
                    echo 0;
                }
            }            
            break;
        case 3: // Solicitud para ser traductor
            $congreso = '';
            if(isset($_SESSION['idcongreso']))
            {
                $congreso = $_SESSION['idcongreso'];
            }else{
                $congreso = filter_input(INPUT_POST,'congreso');
            }
            $correo = $_SESSION['cprincipal'];
            $nusuario=$_SESSION['nusuario'];            
            
            require '../clases/class_solicitud.php';            

            $solicitud = new solicitud();
            $formato = 'Y-m-d';
            $fecha = date($formato);
            $solicitud ->sinicializar('', $t_solicitud, $motivo, '0', $congreso, $_SESSION['idusuario'], $fecha,$correo,$nusuario,'','','','',$idioma);
            $idsolicitud = $solicitud ->screar();
            $veridioma = $solicitud->sol_idioma();
            $nsolicitud = "";
            if($idsolicitud != 0 && $veridioma == 0)
            {
                $datos = $solicitud ->get_solicitud();
            foreach ($datos as $fila)            
            {
                $nsolicitud = $fila['nombre_tipo_solicitud'];
            }                
                if($nsolicitud != "")
                {
                    echo $solicitud ->envio_sol();
                }else{
                    echo 0;
                }
            }                 
            break;  
        case 8: //Solicitud de Revisor 

            $congreso = '';
            if(isset($_SESSION['idcongreso']))
            {
                $congreso = $_SESSION['idcongreso'];
            }else{
                $congreso = filter_input(INPUT_POST,'congreso');
            }
            $correo = $_SESSION['cprincipal'];
            $nusuario=$_SESSION['nusuario'];            
            
            require '../clases/class_solicitud.php';            

            $solicitud = new solicitud();
            $formato = 'Y-m-d';
            $fecha = date($formato);
            $solicitud ->sinicializar('', $t_solicitud, $motivo, '0', $congreso, $_SESSION['idusuario'], $fecha,$correo,$nusuario);
            $idsolicitud = $solicitud ->screar();
            $nsolicitud = "";
            if($idsolicitud != 0)
            {
                $datos = $solicitud ->get_solicitud();
            foreach ($datos as $fila)            
            {
                $nsolicitud = $fila['nombre_tipo_solicitud'];
            }                
                if($nsolicitud != "")
                {
                   $verificador = $solicitud ->envio_sol();
                   if($verificador == TRUE)
                   {
                       echo 1;
                   }
                }else{
                    echo 0;
                }
            }
            break;            
    }
    
}
function form_recuperar(){
    session_start();    
    /*Esta función se crea un objeto usuario con un nombre usuario reemplazado por el correo para luego inicializarle correctamente*/
    $correo = filter_input(INPUT_POST,'cprincipal');
    
    $usuario = new usuario();
    $usuario ->uinicializar(NULL, NULL, NULL,NULL, $correo,NULL,NULL);
    $usuario -> get_ucorreo();
    $usuario ->genera_contra();
    echo $usuario -> envio_contra();
}
/* Función para sustituir la imagen de perfil de un usuario*/
function img(){
    session_start();    
    $idusuario = $_SESSION['idusuario'];
    if (isset($_FILES["img_usuario"])){ 
//        echo ("Yupi si hay....");
            $img = $_FILES["img_usuario"];
            $nombreimg = $img["name"];
            $tipo = $img["type"];
            $rutaprovisional = $img["tmp_name"];
            $size = $img["size"];

            //verifico que tipo de trabajo es para darle formato al nombre del archivo
                $carpeta = "img/users";

                //eliminamos caracteres especiales en el nombre del doc
                $nombrearch = limpiacadena($nombreimg);
                //agregamos el identificador de la persona que lo subio, en el nombre del trabajo 
//                $nombrearchivo = $idusuario;
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO CON EL ID DEL CONGRESO
                if (!file_exists('../'.$carpeta)){
                    mkdir($carpeta, 0777, true);
//                    echo "exite";
                }                
                //RUTA COMPLETA DEL ARCHIVO
                $src = $carpeta.'/'.$idusuario.'_'.$nombrearch;
                 //verificamos que el archivo no existe
                $result = [];
                if (!file_exists($src)){  

                        if(move_uploaded_file($rutaprovisional, '../'.$src)){
                            $usuario = new usuario();
                            
                            $usuario ->uinicializar($_SESSION['idusuario'], $_SESSION['nusuario'], $_SESSION['contrasenia'], $src,$_SESSION['cprincipal'],NULL,NULL);    
                            if($usuario ->asignar_img()==1){
                                    $result += ['respuesta'=>1,'img_user'=> $src];
                                    $_SESSION['img']=$src;                                    
                                    echo json_encode($result);
                            }else{
                                if($_SESSION['img']==$src)
                                {
                                    $result += ['respuesta'=>1,'img_user'=> $src];
                                    echo json_encode($result);
                                }else{
                                    echo 2;
                                }
                            }
                        }
                    }else{
                        unlink($src);
                        if(move_uploaded_file($rutaprovisional, '../'.$src)){
                            $usuario = new usuario();
                            $usuario ->uinicializar($_SESSION['idusuario'], $_SESSION['nusuario'], $_SESSION['contrasenia'], $src,$_SESSION['cprincipal'],NULL,NULL);    
                            if($usuario ->asignar_img()==1){
                                    $result += ['respuesta'=>1,'img_user'=> $src];
                                    $_SESSION['img']=$src;
                                    echo json_encode($result);
                            }else{
                                if($_SESSION['img']==$src)
                                {
                                    $result += ['respuesta'=>1,'img_user'=> $src,];
                                    echo json_encode($result);
                                }else{
                                    echo 2;
                                }
                            }
                        }                        
                    }

        }    
    
}
//Función para eliminar caracteres especiales en el nombre de los archivos
function limpiacadena($cadena) {
	$cadena = trim($cadena);
	$cadena = strtr($cadena,
"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	$cadena = strtr($cadena,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
	$cadena = preg_replace('#([^.a-z0-9]+)#i', '-', $cadena);
        $cadena = preg_replace('#-{2,}#','-',$cadena);
        $cadena = preg_replace('#-$#','',$cadena);
        $cadena = preg_replace('#^-#','',$cadena);
	return $cadena;
}
//Función para renombrar los archivos de forma aleatoria
function  random_cadena($length=100,$n=TRUE,$sc=FALSE){
            $source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';  
            $rstr = "";
            if($n==1){
                if($length>0){          
                    $source = str_split($source,1);
                    for($i=1; $i<=$length; $i++){
                            mt_srand((double)microtime() * 1000000);
                            $num = mt_rand(1,count($source));
                            $rstr .= $source[$num-1];
                    }
                }            
           }
           return $rstr;
 }
 /* Función para actualización de perfil de usuario*/
function update_perfil(){
    session_start();    
    $nombres = explode(" ", filter_input(INPUT_POST,'nombres'));
    $apellidos = explode(" ", filter_input(INPUT_POST,'apellidos'));
    $pnombre = $nombres[0];
    if(isset($nombres[1]))
    {
        $snombre = $nombres[1];
    }else{
        $snombre = " ";
    }
    $papellido = $apellidos[0];
    if(isset($apellidos[1]))
    {
        $sapellido = $apellidos[1];
    }else{
        $sapellido = " ";
    }    
    $correo = ['correo'=>filter_input(INPUT_POST,'cprincipal'),'tipo'=>1];
    $tprincipal = filter_input(INPUT_POST,'tprincipal');
    
    $pais = filter_input(INPUT_POST,'pais');
    if($pais==0)
    {
        $pais = filter_input(INPUT_POST,'hpais');
    }
    $tidentificacion = filter_input(INPUT_POST,'tidentificacion');
    if($tidentificacion==0)
    {
        $tidentificacion = filter_input(INPUT_POST,'htidentificacion');
    }    
    $identificacion = filter_input(INPUT_POST,'identificacion');
    $tpersona = 0;
    $talimentacion = filter_input(INPUT_POST,'talimentacion');
    if($talimentacion==0)
    {
        $talimentacion=filter_input(INPUT_POST,'htalimentacion'); 
    }           
    $nusuario = filter_input(INPUT_POST,'nusuario');
    $nombre_user= filter_input(INPUT_POST, 'nombre_user');
    
    $contrasenia = filter_input(INPUT_POST,'contrase');    
    $idioma=filter_input(INPUT_POST,'idioma'); 
    if($idioma==0)
    {
        $idioma=filter_input(INPUT_POST,'hidioma'); 
    }
   array_push ($correo, ['correo'=>filter_input(INPUT_POST,'calterno'),'tipo'=>0]); 
   
   $cprincipal = filter_input(INPUT_POST,'cprincipal');
   
    $usuario = new usuario();
    $usuario ->uinicializar($_SESSION['idusuario'], $_SESSION['nusuario'], $_SESSION['contrasenia'], $_SESSION['img'],$_SESSION['cprincipal'],NULL,NULL);    
    $datos = $usuario ->get_usuario();
    foreach($datos as $personas)
        { 
            if($personas['id_idioma_fk'] == $idioma && $personas['primer_nombre'] == $pnombre && $personas['segundo_nombre'] == $snombre 
                    && $personas['primer_apellido'] == $papellido && $personas['segundo_apellido'] == $sapellido  && $personas['identificacion'] == $identificacion
                    && $personas['id_tipo_alimentacion_fk'] == $talimentacion && $personas['id_tipo_identificacion_fk'] == $tidentificacion  
                    && $personas['id_pais_fk'] == $pais && $personas['numero_telefono'] == $tprincipal && $personas['correo'] == $cprincipal && $_SESSION['nusuario'] == $nombre_user){
                    echo "3";

                 }else{
                        $persona=new persona();
                        $persona -> pinicializar($_SESSION['idpersona'], $pnombre, $snombre, $papellido, $sapellido, $correo, $tprincipal, $tidentificacion, $pais,$identificacion, $tpersona, $talimentacion,$nombre_user,$contrasenia,$idioma);
                        
                        
                        $usuario = new usuario();
                        $usuario ->uinicializar($_SESSION['idusuario'], $nombre_user, $contrasenia, $_SESSION['img'],$cprincipal,NULL,NULL);  
                        
                        
                        $ver = $persona -> update_persona();
                        $ver2 = $persona -> update_telefono();
                        $ver3 = $persona -> update_correo();
                        $ver4 = $usuario -> update_nusuario(); 
                        
                        
//                        echo $ver."/".$ver2."/".$ver3."/".$ver4;
                        if ($ver != -1 && $ver2 != -1 && $ver3 != -1 && $ver4 != -1)
                        {
                            $usuario->inicio_sesion();
                            echo "1";
                        }
                 }
                 
                            
        }
}
    
/* Función para mostrar el perfil de usuario*/
function cargar_perfil(){

    session_start();
    $usuario = new usuario();
    $usuario ->uinicializar($_SESSION['idusuario'], $_SESSION['nusuario'], $_SESSION['contrasenia'], $_SESSION['img'],$_SESSION['cprincipal'],NULL,NULL);
    $datos = $usuario ->get_usuario();
    $dcorreos = $usuario ->get_correo();
    $user=[];
    $correos_p=[NULL];
    $correos_a=[NULL];
    if(isset($dcorreos)){
                foreach($dcorreos as $correo_s)
                {
                    if($correo_s['principal']==1){
                       array_push($correos_p, $correo_s['correo']);
                    }else{
                       array_push($correos_a,$correo_s['correo']);
                    }

                } 
            
            }  
            
            $correos=['cprincipal' => $correos_p,'calterno' => $correos_a];
    
            foreach($datos as $persona)
            {
                $pais = explode(';', $persona['nombre_pais']);
                $user += [
            "id_usuario_pk" => $persona['id_usuario_pk'],
            "nombre_usuario" => $persona['nombre_usuario'],
            "contrasena" => $persona['contrasena'],
            "id_persona_fk" => $persona['id_persona_fk'],
            "id_idioma_fk" => $persona['id_idioma_fk'],
            "id_persona_pk" => $persona['id_persona_pk'],
            "primer_nombre" => ($persona['primer_nombre']),
            "segundo_nombre" => ($persona['segundo_nombre']),
            "primer_apellido" => ($persona['primer_apellido']),
            "segundo_apellido" =>  ($persona['segundo_apellido']),
            "identificacion" => $persona['identificacion'],
            "id_tipo_persona_fk" => $persona['id_tipo_persona_fk'],
            "id_tipo_alimentacion_fk" => $persona['id_tipo_alimentacion_fk'],
            "id_tipo_identificacion_fk" => $persona['id_tipo_identificacion_fk'],
            "id_pais_fk" => $persona['id_pais_fk'],
            "id_tipo_persona_pk" => $persona['id_tipo_persona_pk'],
            "nombre_tipo_persona" => ($persona['nombre_tipo_persona']),
            "fecha_modificacion" => $persona['fecha_modificacion'],
            "id_idioma_pk" => $persona['id_idioma_pk'],
            "nombre_idioma" => ($persona['nombre_idioma']),
            "bandera" => $persona['bandera'],
            "id_tipo_alimentacion_pk" => $persona['id_tipo_alimentacion_pk'],
            "nombre_tipo_alimentacion" => ($persona['nombre_tipo_alimentacion']),
            "id_tipo_identificacion_pk" => $persona['id_tipo_identificacion_pk'],
            "nombre_tipo_identificacion" => ($persona['nombre_tipo_identificacion']),
            "id_pais_pk" => $persona['id_pais_pk'],
            "nombre_pais" => ($pais[1]),
            "numero_telefono" => $persona['numero_telefono'],
            "contrase" => $_SESSION['contrasenia'],                    
            "correo" => $correos,
            "img_usuario" => $persona['img_usuario']] ; 
                
            }
     $informacion = json_encode($user);
    echo $informacion;
    
}
/* Función para realizar el registro de usuario*/
function registrar()
{require '../clases/class_persona.php';
    $nombres = explode(" ", filter_input(INPUT_POST,'nombres'));
    $apellidos = explode(" ", filter_input(INPUT_POST,'apellidos'));
    $pnombre = $nombres[0];
    if(isset($nombres[1]))
    {
        $snombre = $nombres[1];
    }else{
        $snombre = " ";
    }
    $papellido = $apellidos[0];
    if(isset($apellidos[1]))
    {
        $sapellido = $apellidos[1];
    }else{
        $sapellido = " ";
    }    
    session_start();
    $correo = array("principal" => filter_input(INPUT_POST,'cprincipal'), "alterno" => filter_input(INPUT_POST,'calterno'),);
    $tprincipal = filter_input(INPUT_POST,'tprincipal');
    $pais = filter_input(INPUT_POST,'pais');    
    $tidentificacion = filter_input(INPUT_POST,'tidentificacion');
    $identificacion = filter_input(INPUT_POST,'identificacion');
    $tpersona = filter_input(INPUT_POST,'tpersona');
    $talimentacion = filter_input(INPUT_POST,'talimentacion');
    $nusuario = filter_input(INPUT_POST,'nusuario');
    $contrasenia = filter_input(INPUT_POST,'contrase');    
    $idioma=filter_input(INPUT_POST,'idioma'); 
    $rol = filter_input(INPUT_POST,'tparticipacion'); 
    
    $institucion = NULL;
    $facultad = NULL;
    
    if (isset($_POST['institucion']))
    {
        $institucion = filter_input(INPUT_POST,'institucion');
    }else{
        $facultad = filter_input(INPUT_POST,'facultad');
    }
    $persona=new persona();
    $trabaja=0;
    if($tpersona==2 || $tpersona==4 || $tpersona==6){
        $trabaja=1;
    }
        
    $persona ->pinicializar('NULL', $pnombre, $snombre, $papellido, $sapellido, $correo, $tprincipal, $tidentificacion, $pais,$identificacion, $tpersona, $talimentacion,$nusuario,$contrasenia,$idioma,$institucion,$facultad,$trabaja);
    $idpersona = $persona -> registro();
    $telefono = $persona -> asignar_telefono();    
    $correos = $persona -> asignar_correo(); 
    $pinstitucion = $persona ->asignar_institucion(); 
    
    $idusuario = $persona -> crear_usuario();
    $usuario = new usuario();
    $img="img/users/usuario.png";
    $usuario ->uinicializar($idusuario, $nusuario, $contrasenia, $img,filter_input(INPUT_POST,'cprincipal'),$rol,'');
    $asignacion = $usuario ->asignar_usuarioxrolxcongreso();
//    echo $idpersona."inst".$telefono."inst".$idusuario."inst".$correos."inst".$asignacion."inst".$pinstitucion;
    if($idpersona!=0 &&$telefono!=0 && $idusuario!=0 && $correos!=0 && $asignacion!=0 && $pinstitucion==0)
    {
        echo 1;
    }else{
        echo 0;
    }
    

}
/* Función para el inicio de sesión del usuario*/
function logear()
{
    require '../clases/class_usuario.php';
    $usuario = new usuario();
    $idusuario = "";
    $nusuario = filter_input(INPUT_POST,'nusuario');
    $contrasenia = filter_input(INPUT_POST,'contrase');  
    $rol = "";
    $img = "";
    $cprincipal = "";    
    $usuario ->uinicializar($idusuario, $nusuario, $contrasenia, $img, $cprincipal,NULL,NULL);
    $verificador=$usuario ->login();

    if($verificador!=0)
    {
        $usuario ->inicio_sesion();
        include_once '../funciones/funcion_validaciones.php';
        echo  veri_tiempo();
        
    }else{
        echo 0;
    }
    
}
