<?php

//global $bdd;

session_start();
//print_r($_GET);
//print_r($_SESSION);
$funcion= filter_input(INPUT_GET,'caso');
switch ($funcion) {
    case 'insertar_certificados':
        insertarcertificados();
        break;
    case 'modificar_certificados':
        guardarmodificacionesc();
        break;
    case 'eliminar_certificado':
        eliminarcertificado();
        break;
    case 'insertar_mensajeria':
        insertar_mensajeria();
        break;
    case 'responder_en_conversacion':
        responder_en_conversacion();
        break;
    case 'insertar_trabajo':
        insertartrabajo();
        break;
    case 'responder_mensaje':
        responder_mensaje();
        break;
    case 'aautoria':
        aautoria();
        break;
    case 'rautoria':
        rautoria();
        break;
    case 'crear_congreso1':
        crear_congreso1();
        break;
    case 'crear_linea':
        crear_linea();
        break;
    case 'modificar_linea':
        modificar_linea();
        break;
    case 'crear_tematica':
        crear_tematica();
        break;
    case 'modificar_tematica':
        modificar_tematica();
        break;
    case 'modificar':
        modificar();
        break;
    case 'editar_congreso':
        editar_congreso();
        break;
}

function modificar() {
    /*require "../clases/clase_Congreso";
    $idcongreso = filter_input(INPUT_POST, 'id_congreso_pk');
    echo $idcongreso;*/
    echo 1;
    /*$idusuario = $_SESSION['idusuario'];
    $congreso = new Congreso();
    $congreso->cinicializar3($idcongreso, $idusuario);
    $congreso->activar();*/
}

function editar_congreso(){
    echo "holasdsdsdsdsdsdsds";
}

function rautoria(){
    $idusuariotrabajo = filter_input(INPUT_POST, 'idusuariotrabajo');
    include '../clases/class_trabajos.php';
    $tu = new trabajo();
    $data =$tu->aautorias($idusuariotrabajo, 2); //2 para autoria rechazada
    if($data != 0){
        echo 1;
    }else{
        echo 0;
    }
    
}
function aautoria(){
    $idusuariotrabajo = filter_input(INPUT_POST, 'idusuariotrabajo');
    include '../clases/class_trabajos.php';
    $tu = new trabajo();
    $data =$tu->aautorias($idusuariotrabajo, 1);
    if($data != 0){
        echo 1;
    }else{
        echo 0;
    }
    
}


//funcion que me genera cadenas de texto y numeros aleatorios //para generar usuarios y contraseñas
function  random_cadena($length,$n=TRUE,$sc=FALSE){
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
function insertartrabajo(){
                
                $idusuario = $_SESSION['idusuario'];  
                $nusuario = $_SESSION['nusuario'];   
                $idpersona = $_SESSION['idpersona']; 
                $idioma = $_SESSION['idioma']; 
                $idcongreso = $_SESSION['idcongreso'];
            //    global $bdd;
            //    $bdd = new basedatos();
                include '../clases/class_trabajos.php';
                $tu = new trabajo();

                setlocale(LC_ALL,"es_ES");
                $ttrabajo = filter_input(INPUT_POST, 'ttrabajo');
                $titulotrabajo = filter_input(INPUT_POST, 'titulo_trabajo');
                $resumentrabajo = filter_input(INPUT_POST, 'resumen_trabajo');
                $resumenabreviado = filter_input(INPUT_POST, 'resumen_abreviado');
                $palabrasclave = filter_input(INPUT_POST, 'palabras_clave');
                $idiomatrabajo = filter_input(INPUT_POST, 'idioma');
                $tematica1 = filter_input(INPUT_POST, 'tematicas_trabajo');
                $tematica2 = filter_input(INPUT_POST, 'tematicas_trabajo2');
                $tematica3 = filter_input(INPUT_POST, 'tematicas_trabajo3');
                $premiosi = filter_input(INPUT_POST, 'premio_si');
                $premiono = filter_input(INPUT_POST, 'premio_no');
                $revistasi = filter_input(INPUT_POST, 'revista_si');
                $revistano = filter_input(INPUT_POST, 'revista_no');
                $horasugerida = filter_input(INPUT_POST, 'hora_sugerida');
                $fecha = date("y-m-d");
                $nautores = filter_input(INPUT_POST, 'n_autores');
                //FALTAN 
                //id_estado_fk        =======       1 ('subido')
                $idestado = 1;
                ///
                $valpremio = "";
                if($premiosi == 1){
                    $valpremio = 1;
                }else{
                    $valpremio = 0;
                }
                $valrevista = "";
                if($revistasi==1){
                    $valrevista = 1;
                }else{
                    $valrevista = 0;
                }    
                //Verifico cuantas palabras vienen en la cadena
                $arrpalabras = explode(',', $palabrasclave);
                $elemp = count($arrpalabras);
                $resultado ="";$result1 = "";$result2 = "";$result3 = "";$result4="";$result5=""; $result6 ="";
                $persona = "";
                $idperson = "";
                $telefono = "";
                $correo = "";   
                $usuario = "";
                $rol = ""; 
                $respuesta = "";
                $enviomj = "";
                $palabras = "";
                if($elemp > 5){
                    $palabras = 2;
                }else{                   
                    $palc = implode(',', $arrpalabras); 
                    $tu->inicializartrabajo(NULL, $titulotrabajo, $fecha, NULL, $resumentrabajo, $idestado, $tematica1, $valpremio, $valrevista, $horasugerida, $ttrabajo, $idiomatrabajo, $palc, $resumenabreviado);
                    $resultado = $tu->insertar();
                    
                    //extraemos el ultimo id del trabajo guardado
                    $datos = $tu->selectmaxid();
                    //Almacenamos las tematicas
                    foreach ($datos as $val) {  
                       // almacenamos tbl_trabajo_tematica
                            if($tematica1 != 0){
                                $tu->inicializartematicas($val['id_trabajo_pk'],$tematica1,'1');
                                $result1 = $tu->insertartematicas();                    
                            }
                            if ($tematica2 != 0) {
                                $tu->inicializartematicas($val['id_trabajo_pk'],$tematica2,'0');
                                $result2 = $tu->insertartematicas();                    
                            }
                            if ($tematica3 != 0){
                                $tu->inicializartematicas($val['id_trabajo_pk'],$tematica3,'0');
                                $result3 = $tu->insertartematicas();
                            } 
                        //Premios para el trabajo
                        //echo 'val premio'.$valpremio;
                            if($premiosi == 1){
                                $dt4=$tu->selectpremio($tematica1);
                                foreach ($dt4 as $vl) {
                                    $tu->inicializarpremios($vl['id_premio_pk'],$val['id_trabajo_pk']);
                                    $result4 = $tu->insertarpremios();
                                }
                            }
                            
                            //version trabajo
                            //version trabajo
                            $tu ->inicializarversiontrabajo(NULL, 1, NULL, 'Trabajo subido y enviado a revisión', $idusuario, $val['id_trabajo_pk'], $fecha);
                            $result5 = $tu ->versiontrabajo();
                            
                           
                            //Subida de otros autores
                            if($nautores != 0){
                                 //guardo la persona que sube el trabajo 
                                $cont = 0;
                                for($j = 1; $j <= $nautores; $j++){
                                    $ap = filter_input(INPUT_POST, 'rd_ap_si'.$j);  
                                    if($ap == 1){ //si esta definida me cuenta cuantas estan y si es menor que nautores ingreso como autor principal
                                        $cont++;
                                    }
                                }
                                if($cont != 1){
                                    $tu->inicializarusuariotrabajo($idusuario, $val['id_trabajo_pk'], NULL, 1, NULL, NULL,0);
                                    $result6 = $tu->usuariotrabajo();
                                }else{
                                    $tu->inicializarusuariotrabajo($idusuario, $val['id_trabajo_pk'], NULL, NULL, 1, NULL,0);
                                    $result6 = $tu->usuariotrabajo();
                                }
                                
                                
                                //INGRESAMOS LOS OTROS AUTORES
                                for($i = 1; $i <=$nautores; $i++){
                                    $nombres = explode(" ", filter_input(INPUT_POST,'primer_nombre'.$i));
                                    $apellidos = explode(" ", filter_input(INPUT_POST,'primer_apellido'.$i));
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

                                    $correo = ['correo'=>filter_input(INPUT_POST, 'correo_autor'.$i),'tipo'=>1];
                                    $cprincipal = filter_input(INPUT_POST, 'correo_autor'.$i);
                                    //verificar si existe en la bd ya registrado
                                    $data = $tu ->selectusuario($cprincipal);
                                    if(empty($data)){ //DETERMINA SI VIENE VACIA, POR TANTO NO EXISTE EL CORREO EN LA BD
                                         //variables por defecto
                                        $tprincipal = 1; //telefono del autor
                                        $tidentificacion = 1;
                                        $pais = 1;
                                        $identificacion = random_cadena($length=12);
                                        $tpersona = 1;
                                        $talimentacion = 1;
                                        //CREAMOS USUARIO Y CONTRASENA ALEATORIAMENTE
                                        $nusuario = random_cadena($length=10);
                                        $contrasenia = random_cadena($length=15);
                                        $contrasenia1 = password_hash($contrasenia, PASSWORD_DEFAULT);                                          

                                        $persona = new persona();
                                        $persona ->pinicializar(NULL, $pnombre, $snombre, $papellido, $sapellido, $cprincipal, $tprincipal, $tidentificacion, $pais,$identificacion, $tpersona, $talimentacion,$nusuario,$contrasenia1,$idiomatrabajo);
                                        $idperson = $persona -> registro();
                                        $telefono = $persona -> asignar_telefono();
                                        $correo = $persona -> asignar_correo();    
                                        $usuario = $persona -> crear_usuario();
                                        
                                        $us = new usuario();
                                        //extraigo el id de usuario que acabo de crear 
                                        $dt = $tu->selectmaxusuario();
                                        foreach ($dt as $key) {
                                            //inicializo y guardo el rol del usuario POR DEFECTO SERA ASISTENTE
                                            $us ->uinicializar($key['id_usuario_pk'], $nusuario, $contrasenia1, 1);
                                            $rol = $us ->asignar_rol_congreso();
                                            
                                            //usuario trabajo
                                            $aprincipal = filter_input(INPUT_POST, 'rd_ap_si'.$i);                                            
                                            if ($aprincipal == 1){
                                                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $val['id_trabajo_pk'], NULL, 1, NULL, NULL,0);
                                                $tu->usuariotrabajo();
                                            }else{
                                                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $val['id_trabajo_pk'], NULL, NULL, 1, NULL,0);
                                                $tu->usuariotrabajo();
                                            }
                                        }
                                        $congreso = $tu->selectcongreso($idcongreso);
                                        //enviamos el correo al usuario para validar su autoria
                                        $titulo="AUTORÍA DE TRABAJO";  
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
                                        $mensaje.="EL CONGRESO ".strtoupper($key['nombre_congreso'])."<br>Comunica a usted lo siguiente:<br><br>";                                               
                                        }
                                        $mensaje.="Se ha subido un TRABAJO DE INVESTIGACIÓN al Congreso y se requiere de usted, para que ingrese y actualice sus datos y de igual manera confirme su AUTORÍA del trabajo, Ingresando a la sección de GESTION DE TRABAJOS DEL AUTOR y luego ACEPTAR AUTORIAS."
                                                . "<br><br>PARA DICHO PROCESO INGRESE A LA DIRECCIÓN:<br> <a href='http://ceat-unah.org/sistemaceat2017wc/CEAT/blue_PHP/index.php' target='_blank'>AQUÍ</a>"
                                                . "<br><br>";
                                        $mensaje.="A continuación encontrará su usuario y contraseña con los que podrá tener acceso a la Plantaforma de Administración de Congresos:<br>"
                                                . "USUARIO:  ".$nusuario."<br>"
                                                . "CLAVE:  ".$contrasenia."<br>";
                                        $mensaje.="</p>";
                                        $mensaje.="<p>";     
                                        $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
                                        $mensaje.="</p>";
                                        $mensaje.="</body>";
                                        $mensaje.="</html>";      
                                        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                                        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                                        $correoautores = filter_input(INPUT_POST, "correo_autor".$i);
                                        if( mail($correoautores, $titulo, $mensaje, $cabeceras)){
                                            $enviomj = 1;
                                        } 
                                    }else{
                                        //en caso de que la o los autores ya esten la bd solo los agrego a la TBL_TRABAJO_AUTORES
                                        //usuario trabajo
                                        //Extraigo el id de usuario tbl_usuario
                                        $array = $tu->selectusuarioreg($cprincipal);
                                        foreach ($array as $key) {
                                            $aprincipal = filter_input(INPUT_POST, 'rd_ap_si'.$i);                                            
                                            if ($aprincipal == 1){
                                                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $val['id_trabajo_pk'], NULL, 1, NULL, NULL,0);
                                                $tu->usuariotrabajo();
                                            }else{
                                                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $val['id_trabajo_pk'], NULL, NULL, 1, NULL,0);
                                                $tu->usuariotrabajo();
                                            }
                                        }
                                        $persona = 1;
                                        $idperson = 1;
                                        $telefono = 1;
                                        $correo = 1;   
                                        $usuario = 1;
                                        $rol = 1;
                                        $respuesta = 3;
                                    }   


                                }
                            }else{
                                $tu->inicializarusuariotrabajo($idusuario, $val['id_trabajo_pk'], NULL, 1, NULL, NULL,0);
                                $result6 = $tu->usuariotrabajo();
                            }
                    }
                } 
               // echo 'resultado'.$resultado.'result1'.$result1.'resulta2'.$result2.'result3'.$result3.'result4'.$result4.'persona'.$persona.'idpersona'.$idpersona.'tel'.$telefono.'correo'.$correo.'user'.$usuario;
                if($resultado != 0){
                    echo '1';
                }else{
                    echo '2';
                } 
}

function insertarcertificados(){
    include '../clases/class_certificados.php';
    $nombre = filter_input(INPUT_POST,'nombre_c');
    $encabezado = filter_input(INPUT_POST,'encabezado_c');
    $motivo = filter_input(INPUT_POST,'motivo_c');
    $pie = filter_input(INPUT_POST,'pie_c');   
    $rdsi = filter_input(INPUT_POST,'rd_si');
    $npersona = filter_input(INPUT_POST,'n_persona');
    $rdno=filter_input(INPUT_POST,'rd_no');    
    $tu = new certificados();
    $icert = "";
    $icert1 = "";
    if(isset($rdsi,$npersona)){   
        $tu->cinicializar('NULL',$nombre,$encabezado,$motivo,$pie,'NULL',$rdsi,$npersona);
        $icert = $tu->insertar();        
    }else if(isset($rdno)){  
        $tu->cinicializar('NULL',$nombre,$encabezado,$motivo,$pie,'NULL',$rdno,'NULL');
        $icert1 = $tu->insertar();
    }     
    if($icert != 0 || $icert1 != 0){
        echo "1";
    }else{
        echo "2";
    }
}

function guardarmodificacionesc(){
//    global $bdd;
//    $bdd = new basedatos();
    include '../clases/class_certificados.php';
    $tu = new certificados();
    $idcertificado = filter_input(INPUT_POST,'id');
    $nombre = filter_input(INPUT_POST,'nombre_c');
    $encabezado = filter_input(INPUT_POST,'encabezado_c');
    $motivo = filter_input(INPUT_POST,'motivo_c');
    $pie = filter_input(INPUT_POST,'pie_c');
    $rdsi = filter_input(INPUT_POST,'rd_si');
    $npersona = filter_input(INPUT_POST,'n_persona');
    $rdno=filter_input(INPUT_POST,'rd_no');
    $modcertificado = "";
    $modcertificado1 = "";
    if(isset($rdsi,$npersona)){ 
        $tu->cinicializar($idcertificado,$nombre,$encabezado,$motivo,$pie,NULL,$rdsi,$npersona);
        $modcertificado = $tu->modificar();
//        $datos=$bdd->update('update tbl_certificados set nombre_certificado=?, encabezado_certificado=?, motivo_certificado=?,pie_certificado=?, certificado_especial=?,nombre_persona=?  where id_certificado_pk="'.$id_certificado.'"','ssssis',[$nombre,$encabezado,$motivo,$pie,$rd_si,$n_persona]);
    }else if(isset($rdno)){ 
        $tu->cinicializar($idcertificado,$nombre,$encabezado,$motivo,$pie,NULL,$rdno,NULL);
        $modcertificado1 = $tu->modificar();
//        $datos=$bdd->update('update tbl_certificados set nombre_certificado=?, encabezado_certificado=?, motivo_certificado=?,pie_certificado=?,certificado_especial=?,nombre_persona=?  where id_certificado_pk="'.$id_certificado.'"','ssssis',[$nombre,$encabezado,$motivo,$pie,$rd_no,NULL]);
    } 
    if($modcertificado != 0 || $modcertificado1 != 0){
        echo "1";
    }else{
        echo "2";
    }
}

function eliminarcertificado(){
    /*require_once '../clases/class_base.php';
    global $bdd;
  
    $bdd = new basedatos();
      */
    include '../clases/class_certificados.php';
    $idcertificado = filter_input(INPUT_POST,'id_certificado');
    $tu = new certificados();
    
    $datos=  $tu->tbl_certificados();  
    $dt =  $tu->tbl_usuario_firma_certificado(); 

    foreach ($dt as $vl) {//eliminamos firmas IMG
        $img = $vl['url_firma'];
        if (!empty($img)) {
            unlink("../img/certificados/".$img);
            //return true;
        }
    } 
    $ecert = "";
    $ecert1 = "";
     foreach ($datos as $val) {         
        $tu->cinicializar($idcertificado,$val['nombre_certificado'],$val['encabezado_certificado'],$val['motivo_certificado'],$val['pie_certificado'],$val['url_arte'],$val['certificado_especial'],$val['nombre_persona']);
        $borraimg = $val['url_arte'];
        if (!empty($borraimg)) { //eliminamos arte 
            unlink("../img/certificados/".$borraimg);
            //return true;
        }
        //Eliminamos usuarios que firman 
        $ecert = $tu->eusuariofirman();
        $ecert1 = $tu->eliminar();
    }
    if($ecert != 0 || $ecert1 != 0){
        echo '1';
    }else{
        echo '2';
    }

}

function insertar_mensajeria() {
  require '../clases/clase_Mensajeria.php';
  $asunto = filter_input(INPUT_POST, 'asunto');
  $contenido = filter_input(INPUT_POST, 'mensaje');
  $mensaje = new Mensajeria();
  $mensaje->enviarmensaje($asunto, $contenido, $_SESSION['idusuario']);
}

function responder_en_conversacion() {
    require '../clases/clase_Mensajeria.php';
    $respuesta_c = filter_input(INPUT_POST, 'respuesta_cv');
    $idconversacion = filter_input(INPUT_POST, 'id_conversacion');
    $resp_c = new Mensajeria();
    $resp_c->responderenconversacion($respuesta_c, $idconversacion, $_SESSION['idusuario']);
}

function responder_mensaje() {
    require '../clases/clase_Mensajeria.php';
    $respuesta_m = filter_input(INPUT_POST, 'respuesta_mensaje');
    $id_mensaje = filter_input(INPUT_POST, 'id_mensaje');
    $resp_m = new Mensajeria();
    $resp_m->responderenconversacion($respuesta_m, $id_mensaje, $_SESSION['idusuario']);
}

function crear_congreso1() {
    require_once '../clases/class_base.php';
    require '../clases/clase_Congreso.php';
    $nombrecongreso = filter_input(INPUT_POST, 'nombrecongreso'); 
    $anio = filter_input(INPUT_POST, 'anio'); 
    $siglas = filter_input(INPUT_POST, 'siglas'); 
    $descripcion = filter_input(INPUT_POST, 'descripcion'); 
    $lugar = filter_input(INPUT_POST, 'lugar'); 
    $coordenadas = filter_input(INPUT_POST, 'coordenadas'); 
    $pais = filter_input(INPUT_POST, 'pais'); 
    $fechainicio = filter_input(INPUT_POST, 'fechainicio'); 
    $fechafin = filter_input(INPUT_POST, 'fechafin'); 
    $lema = filter_input(INPUT_POST, 'lema');
    $fechainiciorecepciontrabajos = filter_input(INPUT_POST, 'fechainiciorecepciontrabajos'); 
    $fechafinalrecepciontrabajos = filter_input(INPUT_POST, 'fechafinalrecepciontrabajos'); 
    $fechainiciorevisiontrabajos = filter_input(INPUT_POST, 'fechainiciorevisiontrabajos'); 
    $fechafinalrevisiontrabajos = filter_input(INPUT_POST, 'fechafinalrevisiontrabajos'); 
    $fechapublicacionprograma = filter_input(INPUT_POST, 'fechapublicacionprograma'); 
    $logo = "";
    $ruta_logo = "";
    $congreso1 = new Congreso();
    $congreso1->crear_congreso1($nombrecongreso, $siglas, $descripcion, $lugar, $coordenadas, $pais, $logo, $ruta_logo, $lema, $anio, $fechainicio, $fechafin, $fechainiciorecepciontrabajos, $fechafinalrecepciontrabajos, $fechainiciorevisiontrabajos, $fechafinalrevisiontrabajos, $fechapublicacionprograma, $_SESSION['idusuario']);
}

function crear_linea() {
    require '../clases/class_lineainvestigacion.php';
    $nombre_linea = filter_input(INPUT_POST, 'nombrelinea');
    $abreviacion = filter_input(INPUT_POST, 'abreviacion');
    $descripcion = filter_input(INPUT_POST, 'descripcion_linea');
    $comentarios = filter_input(INPUT_POST, 'comentarios_linea');
    $linea = new Lineainvestigacion();
    $linea->crear_linea($nombre_linea, $abreviacion, $descripcion, $comentarios, $_SESSION['idusuario']);
}

function modificar_linea() {
    require '../clases/class_lineainvestigacion.php';
    $id = filter_input(INPUT_POST, 'id_linea');
    $nombre_linea = filter_input(INPUT_POST, 'nombrelinea');
    $abreviacion = filter_input(INPUT_POST, 'abreviacion');
    $descripcion = filter_input(INPUT_POST, 'descripcion_linea');
    $comentarios = filter_input(INPUT_POST, 'comentarios_linea');
    $linea = new Lineainvestigacion();
    $linea->modificar_linea($id, $nombre_linea, $abreviacion, $descripcion, $comentarios, $_SESSION['idusuario']); 
 }
 
 function crear_tematica() {
    require '../clases/class_Tematicainvestigacion.php';
    $nombre_linea = filter_input(INPUT_POST, 'nombrelinea');
    $abreviacion = filter_input(INPUT_POST, 'abreviacion');
    $descripcion = filter_input(INPUT_POST, 'descripcion_linea');
    $comentarios = filter_input(INPUT_POST, 'comentarios_linea');
    $linea = filter_input(INPUT_POST, '');
    $tem = new Tematicainvestigacion();
    $tem->crear_tematica($nombre_linea, $abreviacion, $descripcion, $comentarios, $_SESSION['idusuario']);
}

function modificar_tematica() {
    require '../clases/class_tematica.php';
    $id = filter_input(INPUT_POST, 'id_linea');
    $nombre_linea = filter_input(INPUT_POST, 'nombrelinea');
    $abreviacion = filter_input(INPUT_POST, 'abreviacion');
    $descripcion = filter_input(INPUT_POST, 'descripcion_linea');
    $comentarios = filter_input(INPUT_POST, 'comentarios_linea');
    $linea = new Tematicainvestigacion();
    $linea->modificar_tematica($id, $nombre_linea, $abreviacion, $descripcion, $comentarios, $_SESSION['idusuario']); 
 }
 
 ?>