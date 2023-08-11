<?php

//global $bdd;

session_start();
//print_r($_POST);
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
    case 'crear_congreso':
        crear_congreso();
        break;
    case 'activar_congreso':
        activar_congreso();
        break;
    case 'inactivar_idioma':
        inactivar_idioma();
        break;
    case 'cerrar_congreso':
        cerrar_congreso();
        break;
    case 'inactivar_congreso':
        inactivar_congreso();
        break;
    case 'modificar_congreso':
        editar_congreso();
        break;
    case 'eliminar_congreso':
        eliminar_congreso();
        break;
    case 'agregar_administrador':
        agregar_administrador();
        break;
    case 'quitar_administrador':
        quitar_administrador();
        break;
    case 'crear_linea':
        crear_linea();
        break;
    case 'modificar_linea':
        modificar_linea();
        break;
    case 'eliminar_linea':
        eliminar_linea();
        break;
    case 'crear_tematica':
        crear_tematica();
        break;
    case 'modificar_tematica':
        modificar_tematica();
        break;
    case 'eliminar_tematica':
        eliminar_tematica();
        break;
    case 'habilitar_traduccion':
        habilitar_traduccion();
        break;
    case 'activar_idioma':
        activar_idioma();
        break;
    case 'subir_cargar_archivo_respaldo_idioma':
        subir_cargar_archivo_respaldo_idioma();
        break;
    case 'cargar_respaldo_idioma':
        cargar_respaldo_iidioma();
        break;
    case 'agregarautor':
        agregarautor();
        break;
    case 'guardarexpositores':
        guardarexpositores();
        break;
    case 'eliminartrabajo':
        eliminartrabajo();
        break;
    case 'instr_form':
        instr_form();
        break;
    case 'instr_prcuali';
        instr_prcuali();
        break;
    case 'aceptarhorario';
        aceptarhora();
        break;    
    case 'instr_prcuanti';
        instr_prcuanti();
        break;    
    case 'asoc_form_tematica';
        asoc_form_tematica();
        break;    
    case 'trabajo_a_revisor';
        trabajo_a_revisor();
        break;    
    case 'cancelar_a_revisor';
        cancelar_a_revisor();
        break;    
    case 'aceptar_trabajo_revisar';
        aceptar_trabajo_revisar();
        break;    
    case 'cancelar_trabajo_revisar';
        cancelar_trabajo_revisar();
        break;
    case 'guardarformulariorevision';
        guardarformulariorevision();
        break;    
    case 'dictaminar_trabajo';
        dictaminar_trabajo();
        break;    
    case 'enviar_dictamen_autores_trabajo';
        enviar_dictamen_autores_trabajo();
        break;    
    case 'asignar_trabajo_ess';
        asignar_trabajo_ess();
        break;
    case 'insertar_espacio';
        insertar_espacio();
        break;
    case 'modificar_espacio';
        guadar_modificar_espacio();
        break;
    case 'eliminar_espacio';
        eliminar_espacio();
        break;
    case 'insertar_actividad';
        insertar_actividad();
        break;   
    case 'modificar_actividad';
        guadar_modificar_actividad();
        break;
    case 'eliminar_actividad';
        eliminar_actividad();
        break;    
    case 'tbl_idiomas_traduccion':
        tbl_idiomas_traduccion();
        break;
    case 'traducir_idioma':
        traducir_idioma();
        break;
    case 'eliminarautortrabajo':
        eliminarautortrabajo();
        break;
    case 'insertar_distribucion_trabajos':
        insertar_distribucion_trabajos();
        break;
    case 'crear_respaldo':
        crear_respaldo();
        break;
    case 'cambiartrabajos_de_actividad':
        cambiartrabajos_de_actividad();
        break;
    case 'guardar_programa':
        guardar_programa();
        break;
    case 'eliminar_act_modificando_programa':
        eliminar_act_modificando_programa();
        break;
    case 'modificar_programa':
        guardar_modificar_programa();
        break;
    case 'eliminar_programa':
        eliminar_programa();
        break;
        
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


//funcion que me genera cadenas de texto y numeros aleatorios //para generar usuarios y contrase��as
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
                $rolescongreso = $_SESSION['roles'];
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
                $persona = "";$idperson = "";$telefono = "";$correo = ""; $usuario = "";$rol = ""; $respuesta = "";$enviomj = "";$palabras = "";
                if($elemp > 5){
                    $palabras = 2;
                }else{                   
                    $palc = implode(',', $arrpalabras); 
                    $tu->inicializartrabajo($titulotrabajo, $fecha, NULL, $resumentrabajo, $idestado, $tematica1, 1,$valpremio, $valrevista, 
                    $horasugerida, $ttrabajo, $idiomatrabajo, $palc, $resumenabreviado);
                    $resultado = $tu->insertar();
                   
                    // almacenamos tbl_trabajo_tematica
                    if($tematica1 != 0){
                        $tu->inicializartematicas($resultado,$tematica1,'1');
                        $result1 = $tu->insertartematicas();                    
                    }
                    if ($tematica2 != 0) {
                        $tu->inicializartematicas($resultado,$tematica2,'0');
                        $result2 = $tu->insertartematicas();                    
                    }
                    if ($tematica3 != 0){
                        $tu->inicializartematicas($resultado,$tematica3,'0');
                        $result3 = $tu->insertartematicas();
                    } 
                    //Premios para el trabajo                        
                    if($valpremio == 1){
                        $dt4=$tu->selectpremio($tematica1);
                        foreach ($dt4 as $vl) {
                            $tu->inicializarpremios($vl['id_premio_pk'],$resultado);
                            $result4 = $tu->insertarpremios();
                        }
                    } 
                    //version trabajo
                    $tu ->inicializarversiontrabajo(NULL, NULL, NULL, 'Trabajo subido a la plataforma', $idusuario, $resultado, $fecha);
                    $result5 = $tu ->versiontrabajo();
                    
                    
                    //Subida de otros autores
                            if($nautores != 0 || $nautores != NULL){
                                //guardo la persona que sube el trabajo 
                                    $cont = 0;
                                    for($j = 1; $j <= $nautores; $j++){
                                        $ap = filter_input(INPUT_POST, 'rd_ap_si'.$j);  
                                        if($ap == 1){ //si esta definida me cuenta cuantas estan y si es menor que nautores ingreso como autor principal
                                            $cont++;
                                        }
                                    }
                                    //INGRESAMOS EL AUTOR LOGEADO Y LO VINCULAMOS CON EL TRABAJO
                                    if($cont == 0){
                                        $tu->inicializarusuariotrabajo($idusuario, $resultado, 1, 1, null, 1,1,1);
                                        $result6 = $tu->usuariotrabajo();
                                    }else{
                                        $tu->inicializarusuariotrabajo($idusuario, $resultado, 1, null, 1, null,1,0);
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

                                    $cprincipal = filter_input(INPUT_POST, 'correo_autor'.$i);
                                    $correo= ['correo'=>filter_input(INPUT_POST, 'correo_autor'.$i),'tipo'=>1];
                                    //verificar si existe en la bd ya registrado
                                    $data = $tu ->selectusuario($cprincipal);
                                    $filas = mysqli_fetch_row($data);
                                    
                                    if($filas == 0){ //DETERMINA SI VIENE VACIA
                                         //variables por defecto IDentificacion aleatoria 
                                        $tprincipal = 1; $tidentificacion = 1;  $pais = "HN";
                                        $identificacion = random_cadena($length=12); $tpersona = 1; $talimentacion = 1;
                                        //CREAMOS USUARIO Y CONTRASENA ALEATORIAMENTE
                                        $nusuario = random_cadena($length=10);                                       
                                        $contrasenia1 = random_cadena($length=15);                                         

                                        $persona = new persona();
                                        $persona ->pinicializar(NULL, $pnombre, $snombre, $papellido, $sapellido, $cprincipal, $tprincipal, $tidentificacion, $pais,$identificacion, $tpersona, $talimentacion,$nusuario,$contrasenia1,$idiomatrabajo);
                                        $idperson = $persona -> registro();
                                        $telefono = $persona -> asignar_telefono();
                                        $correo = $persona -> asignar_correo();    
                                        $usuario = $persona -> crear_usuario();                                        
                                       
                                        //buscamos el rol autor en el arreglo de roles pertenecientes al congreso activo
                                        
                                        $idrol = array_search('Autor', $rolescongreso);                                       
                                        $us = new usuario();
                                        //inicializo y guardo el rol del usuario POR DEFECTO SERA autor
                                        $us ->uinicializar($usuario,$nusuario,$contrasenia1,NULL,$cprincipal,$idrol,NULL);                                     
                                        $rol = $us ->asignar_usuarioxrolxcongreso();  
                                        
                                        //usuario trabajo
                                        $aprincipal = filter_input(INPUT_POST, 'rd_ap_si'.$i);                                            
                                        if ($aprincipal == 1){
                                            $tu->inicializarusuariotrabajo($usuario, $resultado, NULL, 1, NULL, NULL,0,1);
                                            $tu->usuariotrabajo();
                                        }else{
                                            $tu->inicializarusuariotrabajo($usuario, $resultado, NULL, NULL, 1, NULL,0,0);
                                            $tu->usuariotrabajo();
                                        }
                                      
                                        $congreso = $tu->selectcongreso($idcongreso);
                                        //enviamos el correo al usuario para validar su autoria
                                        $titulo="AUTORÌA DE TRABAJO";  
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
                                        $mensaje.="Se ha subido un TRABAJO DE INVESTIGACIÓN al Congreso y se requiere de usted, para que ingrese y actualice sus datos y de igual manera confirme su AUTOR��A del trabajo, Ingresando a la secci��n de GESTION DE TRABAJOS DEL AUTOR y luego ACEPTAR AUTORIAS."
                                                . "<br><br>PARA DICHO PROCESO INGRESE A LA DIRECCIÓN:<br> <a href='http://ceat-unah.org/sistemas/gcongreso/beta/index.php' target='_blank'>AQU��</a>"
                                                . "<br><br>";
                                        $mensaje.="A continuación encontrará su usuario y contraseña con los que podrá tener acceso a la Plantaforma de Administraci��n de Congresos:<br>"
                                                . "USUARIO:  ".$nusuario."<br>"
                                                . "CLAVE:  ".$contrasenia1."<br>";
                                        $mensaje.="</p>";
                                        $mensaje.="<p>";     
                                        $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
                                        $mensaje.="</p>";
                                        $mensaje.="</body>";
                                        $mensaje.="</html>";      
                                        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                                        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                                        $correoautores = filter_input(INPUT_POST, 'correo_autor'.$i);
                                        if( mail($correoautores, $titulo, $mensaje, $cabeceras)){
                                            $enviomj = 1;
                                        } 
                                    }else{
                                        //en caso de que la o los autores ya esten la bd solo los agrego a la 
                                        //usuario trabajo
                                        //Extraigo el id de usuario tbl_usuario
                                        $array = $tu->selectusuarioreg($cprincipal);
                                        foreach ($array as $key) {
                                            $aprincipal = filter_input(INPUT_POST, 'rd_ap_si'.$i);                                            
                                            if ($aprincipal == 1){
                                                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $resultado, NULL, 1, NULL, NULL,0,1);
                                                $tu->usuariotrabajo();
                                            }else{
                                                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $resultado, NULL, NULL, 1, NULL,0,0);
                                                $tu->usuariotrabajo();
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
                                            $mensaje.="Se ha subido un TRABAJO DE INVESTIGACIÓN al Congreso y se requiere de usted, para que ingrese y actualice sus datos y de igual manera confirme su AUTORÍA del trabajo, Ingresando a la sección de GESTIÓN DE TRABAJOS DEL AUTOR y luego ACEPTAR AUTORÍAS."
                                                    . "<br><br>PARA DICHO PROCESO INGRESE A LA DIRECCIÓN:<br> <a href='http://ceat-unah.org/sistemas/gcongreso/beta/index.php' target='_blank'>AQUÍ</a>"
                                                    . "<br><br>";
                                            $mensaje.="</p>";
                                            $mensaje.="<p>";     
                                            $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
                                            $mensaje.="</p>";
                                            $mensaje.="</body>";
                                            $mensaje.="</html>";      
                                            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                                            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                                            $correoautores = filter_input(INPUT_POST, 'correo_autor'.$i);
                                            if( mail($correoautores, $titulo, $mensaje, $cabeceras)){
                                                $enviomj = 1;
                                            } 
                                        }
                                    } 
                                }
                            }else{
                                //guardo la persona que sube el trabajo 
                                $tu->inicializarusuariotrabajo($idusuario, $resultado, 1, 1, null, 1,1,1);
                                $result6 = $tu->usuariotrabajo();
                              
                            }
                                //enviamos un correo de agradecimiento por subir el trabajo
                                $congreso = $tu->selectcongreso($idcongreso);
                                //enviamos el correo al usuario para validar su autoria
                                $titulo="ENVIO DE TRABAJO";  
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
                                $mensaje.="EL CONGRESO ".strtoupper($key['nombre_congreso'])."<br>Agradece a usted por el envio del artículo ". strtoupper($titulotrabajo).".<br><br>";                                               
                                }
                                $mensaje.="Se le comunicará cuando el TRABAJO DE INVESTIGACIÓN se haya revisado."
                                        . "<br><br>Le invitamos a que visite nuestro Sitio WEB para mayor información:<br> <a href='http://ceat-unah.org/congreso_2017.html' target='_blank'><b>INGRESAR AL SITIO</b></a>"
                                        . "<br><br>";                
                                $mensaje.="</p>";
                                $mensaje.="<p>";     
                                $mensaje.="Reciba un saludo muy cordial, y gracias por participar en el Congreso.!!!";
                                $mensaje.="</p>";
                                $mensaje.="</body>";
                                $mensaje.="</html>";      
                                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                                $correoautores = $_SESSION['cprincipal'];
                                if( mail($correoautores, $titulo, $mensaje, $cabeceras)){
                                    $enviomj = 1;
                                } 
                    }
                     
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
    $url_arte =     $_FILES;
    $npersona = filter_input(INPUT_POST,'n_persona');
    $rdno=filter_input(INPUT_POST,'rd_no'); 
    $rolvadirigido=filter_input(INPUT_POST,'slcrolescongreso');
    $tu = new certificados();
    $icert = "";
    $icert1 = "";
    if(isset($rdsi,$npersona)){   
        $tu->cinicializar('NULL',$nombre,$encabezado,$motivo,$pie,'NULL',$rdsi,$npersona,$rolvadirigido);
        $icert = $tu->insertar();        
    }else if(isset($rdno)){  
        $tu->cinicializar('NULL',$nombre,$encabezado,$motivo,$pie,'NULL',$rdno,'NULL',$rolvadirigido);
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
    $rolvadirigido=filter_input(INPUT_POST,'slcrolescongreso');
    $modcertificado = "";
    $modcertificado1 = "";
    if(isset($rdsi,$npersona)){ 
        $tu->cinicializar($idcertificado,$nombre,$encabezado,$motivo,$pie,NULL,$rdsi,$npersona,$rolvadirigido);
        $modcertificado = $tu->modificar();
//        $datos=$bdd->update('update tbl_certificados set nombre_certificado=?, encabezado_certificado=?, motivo_certificado=?,pie_certificado=?, certificado_especial=?,nombre_persona=?  where id_certificado_pk="'.$id_certificado.'"','ssssis',[$nombre,$encabezado,$motivo,$pie,$rd_si,$n_persona]);
    }else if(isset($rdno)){ 
        $tu->cinicializar($idcertificado,$nombre,$encabezado,$motivo,$pie,NULL,$rdno,NULL,$rolvadirigido);
        $modcertificado1 = $tu->modificar();
//        $datos=$bdd->update('update tbl_certificados set nombre_certificado=?, encabezado_certificado=?, motivo_certificado=?,pie_certificado=?,certificado_especial=?,nombre_persona=?  where id_certificado_pk="'.$id_certificado.'"','ssssis',[$nombre,$encabezado,$motivo,$pie,$rd_no,NULL]);
    } 
    if($modcertificado != 0 || $modcertificado1 != 0){
        echo "1";
    }else{
        echo "2";
    }
}

/*ALEXIS ESCOTO
INSTANCIACION A LA CLASE certificados
con metodo PDO
02/01/2023 */
function eliminarcertificado(){
   /* require_once '../clases/class_base.php';
    global $bdd;
    $bdd = new basedatos();
    */
    include '../clases/class_certificados.php';
    $idcertificado = filter_input(INPUT_POST,'id_certificado');
    $tu = new certificados();
    
    $datos=  $tu->tbl_certificados($idcertificado);  
    $dt =  $tu->tbl_usuario_firma_certificado($idcertificado); 

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
        $tu->cinicializar($idcertificado,$val['nombre_certificado'],$val['encabezado_certificado'],$val['motivo_certificado'],$val['pie_certificado'],$val['url_arte'],$val['certificado_especial'],$val['nombre_persona'],$val['idrol_congreso']);

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
/*Alexis Escoto
27-01-2023 */
function insertar_mensajeria() {
  require '../clases/clase_Mensajeria.php';
  $asunto = trim(filter_input(INPUT_POST, 'asunto'));
  $contenido = trim(filter_input(INPUT_POST, 'mensaje'));
  $mensaje = new Mensajeria();
/*
  print_r($asunto);
  print_r($contenido);*/
  $mensaje->tematica_inicializar($asunto, $contenido, $_SESSION['idusuario']);
  $mensaje->enviarmensaje();

}

function responder_en_conversacion() {
    require '../clases/clase_Mensajeria.php';
    $respuesta_c = trim(filter_input(INPUT_POST, 'respuesta_cv'));
    $idconversacion = trim(filter_input(INPUT_POST, 'id_conversacion'));
    $resp_c = new Mensajeria();
    $resp_c->responderenconversacion($respuesta_c, $idconversacion, $_SESSION['idusuario']);
}

function responder_mensaje() {
    require '../clases/clase_Mensajeria.php';
    $respuesta_m = trim(filter_input(INPUT_POST, 'respuesta_mensaje'));
    $id_mensaje = trim(filter_input(INPUT_POST, 'id_mensaje'));
    $resp_m = new Mensajeria();
    $resp_m->responderenconversacion($respuesta_m, $id_mensaje, $_SESSION['idusuario']);
}


//CONGRESOS-------------------------------------------------------------------------------------------------

function crear_congreso() {
    
   print_r(INPUT_POST);
    require '../clases/clase_Congreso.php';
    
    
    $nombre_congreso                     =     trim(filter_input(INPUT_POST, 'nombre_congreso'));
    $siglas                              =     trim(filter_input(INPUT_POST, 'siglas'));
    $descripcion_congreso                =     trim(filter_input(INPUT_POST, 'descripcion_congreso'));
    $lugar                               =     trim(filter_input(INPUT_POST, 'lugar'));
    $coordenadas                         =     trim(filter_input(INPUT_POST, 'coordenadas'));
    $id_pais_fk                          =     trim(filter_input(INPUT_POST, 'pais'));   
    $logo_congreso                       =     $_FILES;
    $lema                                =     trim(filter_input(INPUT_POST, 'lema'));
    $numero_cai                          =     trim(filter_input(INPUT_POST, 'numero_cai'));
    $roles_congreso_agregados            =     filter_input(INPUT_POST, 'agregar_roles_congreso'); echo "hola".$roles_congreso_agregados;
    $anio                                =     filter_input(INPUT_POST, 'anio'); echo $anio;
    $fecha_inicio                        =     filter_input(INPUT_POST, 'fecha_inicio');
    $fecha_finalizacion                  =     filter_input(INPUT_POST, 'fecha_finalizacion');
    $fecha_i_recepcion                   =     filter_input(INPUT_POST, 'fecha_i_recepcion');
    $fecha_f_recepcion                   =     filter_input(INPUT_POST, 'fecha_f_recepcion');
    $fecha_i_revision                    =     filter_input(INPUT_POST, 'fecha_i_revision');
    $fecha_f_revision                    =     filter_input(INPUT_POST, 'fecha_f_revision');
    $fecha_p_programa                    =     filter_input(INPUT_POST, 'fecha_p_programa');
    $fecha_cambio_costo_inscripcion      =     filter_input(INPUT_POST, 'fecha_cambio_costo_inscripcion');
    $idusuario_cm                        =     (int)$_SESSION['idusuario'];
   // $fecha_creacion                      =     filter_input(INPUT_POST, 'fecha_creacion');
   // $id_estado_congreso_fk               =     filter_input(INPUT_POST, 'id_estado_congreso_fk');
    $congreso = new Congreso();
    //require_once '../clases/autoload.php';

   $congreso->cinicializar2( $nombre_congreso, $siglas, $descripcion_congreso, $lugar,
    $coordenadas,$id_pais_fk,$logo_congreso, $lema, $numero_cai,  $anio, $fecha_inicio, 
    $fecha_finalizacion, $fecha_i_recepcion,$fecha_f_recepcion, $fecha_i_revision,
     $fecha_f_revision, $fecha_p_programa,  $fecha_cambio_costo_inscripcion, $idusuario_cm,
   );
    if(   $congreso->crear_congreso()   ) {
        echo "1"."<>".$congreso->json_ultimo_congreso();
    }
   else {
       echo 0;
   }
}

function activar_congreso() {
    require '../clases/clase_Congreso.php';
    $idusuario = $_SESSION['idusuario'];
    $idcongreso = filter_input(INPUT_POST, 'id_congreso_pk');
    $congreso = new Congreso();
    $congreso->cinicializar3($idcongreso, $idusuario);
    if($congreso->activar()) {
        echo 1;
    }
    else {
        echo 0;
    }
}

function cerrar_congreso() {
    require '../clases/clase_Congreso.php';

    $idusuario = $_SESSION['idusuario'];
    $idcongreso = filter_input(INPUT_POST, 'id_congreso_pk');
    $congreso = new Congreso();
    $congreso->cinicializar3($idcongreso, $idusuario);
    if($congreso->cerrar()) {
        echo 1;
    }
    else {
        echo 0;
    }
}
 
function inactivar_congreso() {
    require '../clases/clase_Congreso.php';
    $idusuario = $_SESSION['idusuario']; 
    $idcongreso = filter_input(INPUT_POST, 'id_congreso_pk'); 
    $congreso = new Congreso();
    $congreso->cinicializar3($idcongreso, $idusuario);
    if($congreso->inactivar()) {
        echo 1;
    }
    else {
        echo 0;
    }
}
function editar_congreso() {
    require '../clases/clase_Congreso.php';
    $id_congreso_pk                      =     trim(filter_input(INPUT_POST, 'id_congreso_pk'));
    $nombre_congreso                     =     trim(filter_input(INPUT_POST, 'nombre_congreso'));
    $siglas                              =     trim(filter_input(INPUT_POST, 'siglas'));
    $descripcion_congreso                =     trim(filter_input(INPUT_POST, 'descripcion_congreso'));
    $lugar                               =     trim(filter_input(INPUT_POST, 'lugar'));
    $coordenadas                         =     trim(filter_input(INPUT_POST, 'coordenadas'));
    $id_pais_fk                          =     filter_input(INPUT_POST, 'pais');   
    $logo_congreso                       =     $_FILgES;
    $lema                                =     trim(filter_input(INPUT_POST, 'lema'));
    $numero_cai                          =     trim(filter_input(INPUT_POST, 'numero_cai'));
    $anio                                =     filter_input(INPUT_POST, 'anio');
    $fecha_inicio                        =     filter_input(INPUT_POST, 'fecha_inicio');
    $fecha_finalizacion                  =     filter_input(INPUT_POST, 'fecha_finalizacion');
    $fecha_i_recepcion                   =     filter_input(INPUT_POST, 'fecha_i_recepcion');
    $fecha_f_recepcion                   =     filter_input(INPUT_POST, 'fecha_f_recepcion');
    $fecha_i_revision                    =     filter_input(INPUT_POST, 'fecha_i_revision');
    $fecha_f_revision                    =     filter_input(INPUT_POST, 'fecha_f_revision');
    $fecha_p_programa                    =     filter_input(INPUT_POST, 'fecha_p_programa');
    $fecha_cambio_costo_inscripcion      =     filter_input(INPUT_POST, 'fecha_cambio_costo_inscripcion');
    $idusuario_cm                        =     (int)$_SESSION['idusuario'];
    $congreso = new Congreso();
    $congreso->cinicializar($id_congreso_pk,
     $nombre_congreso, $siglas, $descripcion_congreso, $lugar, 
     $coordenadas, $id_pais_fk, $logo_congreso, $lema, $numero_cai, $anio,
      $fecha_inicio, $fecha_finalizacion, $fecha_i_recepcion, $fecha_f_recepcion,
       $fecha_i_revision, $fecha_f_revision, $fecha_p_programa, $fecha_cambio_costo_inscripcion, 
       $idusuario_cm);
    if(   $congreso->editar()   ) {
        echo "1"."<>".$congreso->json__congreso($id_congreso_pk);
    }
    else {
        echo 0;
    }
}

function eliminar_congreso() {
    require '../clases/clase_Congreso.php';
    $idusuario = $_SESSION['idusuario']; 
    $idcongreso = filter_input(INPUT_POST, 'id_congreso_pk'); 
    $congreso = new Congreso();
    $congreso->cinicializar3($idcongreso, $idusuario);
    if($congreso->eliminar()) {
        echo 1;
    }
    else {
        echo 0;
    }
}

function quitar_administrador() {
    require '../clases/clase_Congreso.php';
    $idusuario = filter_input(INPUT_POST, "id_usuario_pk"); 
    $idcongreso = filter_input(INPUT_POST, 'id_congreso_pk');
    $congreso = new Congreso();
    $congreso->cinicializar7($idusuario, $_SESSION['idusuario'], $idcongreso);
    if(   $congreso->quitar_administrador()   ) {
        echo "1"."<>".$congreso->json_usuario_congreso($idusuario, $idcongreso);
    }
    else {
        echo 0;
    }
}

function agregar_administrador() {
    require '../clases/clase_Congreso.php';
    $idusuario = filter_input(INPUT_POST, "id_usuario_pk"); 
    $idcongreso = filter_input(INPUT_POST, 'id_congreso_pk'); 
    $congreso = new Congreso();
    $congreso->cinicializar7($idusuario, $_SESSION['idusuario'], $idcongreso);
    if(   $congreso->agregar_administrador()   ) {
        echo "1"."<>".$congreso->json_usuario_congreso($idusuario, $idcongreso);
    }
    else {
        echo 0;
    }
}
 

function crear_linea() {
    require '../clases/class_lineainvestigacion.php';
    $id = trim(filter_input(INPUT_POST, 'id_linea'));
    $nombre_linea = trim(filter_input(INPUT_POST, 'nombrelinea'));
    $abreviacion = trim(filter_input(INPUT_POST, 'abreviacion'));
    $descripcion = trim(filter_input(INPUT_POST, 'descripcion_linea'));
    $comentarios = trim(filter_input(INPUT_POST, 'comentarios_linea'));
    $linea = new Lineainvestigacion();
    $linea->linea_inicializar($id, $nombre_linea, $abreviacion, $descripcion, $comentarios, $_SESSION['idusuario']);
    $linea->inicializar_linea_congreso($_SESSION['idcongreso']);
    $linea->crear_linea();
}

function modificar_linea() {
    require '../clases/class_lineainvestigacion.php';
    $id = trim(filter_input(INPUT_POST, 'id_linea'));
    $nombre_linea = trim(filter_input(INPUT_POST, 'nombrelinea'));
    $abreviacion = trim(filter_input(INPUT_POST, 'abreviacion'));
    $descripcion = trim(filter_input(INPUT_POST, 'descripcion_linea'));
    $comentarios = trim(filter_input(INPUT_POST, 'comentarios_linea'));
    $linea = new Lineainvestigacion();
    $linea->linea_inicializar($id, $nombre_linea, $abreviacion, $descripcion, $comentarios, $_SESSION['idusuario']);
    $linea->modificar_linea(); 
 }
 
 function eliminar_linea() {
     require '../clases/class_lineainvestigacion.php';
     $id = trim(filter_input(INPUT_POST, 'id_linea'));
     $linea = new Lineainvestigacion();
     $linea->eliminar_linea($id);
 }
 
 function crear_tematica() {
    require '../clases/class_tematica.php';
    $idtematica = trim(filter_input(INPUT_POST, 'id_tematica'));
    $idlinea = trim(filter_input(INPUT_POST, 'lineas_investigacion'));
    $nombre_tematica = trim(filter_input(INPUT_POST, 'nombretematica'));
    $abreviacion = trim(filter_input(INPUT_POST, 'abreviacion'));
    $descripcion = trim(filter_input(INPUT_POST, 'descripcion_tematica'));
    $comentario = trim(filter_input(INPUT_POST, 'comentarios_tematica'));
    //echo $idtematica."<br>".$idlinea."<br>".$nombre_tematica."<br>".$abreviacion."<br>".$descripcion."<br>".$comentario."";
    $tma = new Tematica();
    $tma->tematica_inicializar($idtematica, $nombre_tematica, $idlinea, $abreviacion, $descripcion, $comentario, $_SESSION['idusuario']);
    $tma->crear_tematica();
}

function modificar_tematica() {
    require '../clases/class_tematica.php';
    $idtematica = trim(filter_input(INPUT_POST, 'id_tematica'));
    $idlinea = trim(filter_input(INPUT_POST, 'lineas_investigacion'));
    $nombre_tematica = trim(filter_input(INPUT_POST, 'nombretematica'));
    $abreviacion = trim(filter_input(INPUT_POST, 'abreviacion'));
    $descripcion = trim(filter_input(INPUT_POST, 'descripcion_tematica'));
    $comentario = trim(filter_input(INPUT_POST, 'comentarios_tematica'));
    //echo $idtematica."<br>".$idlinea."<br>".$nombre_tematica."<br>".$abreviacion."<br>".$descripcion."<br>".$comentario."";
    $tma = new Tematica();
    $tma->tematica_inicializar($idtematica, $nombre_tematica, $idlinea, $abreviacion, $descripcion, $comentario, $_SESSION['idusuario']);
    $tma->modificar_tematica();
 }
 
 function eliminar_tematica() {
     require '../clases/class_tematica.php';
     $id_tematica = filter_input(INPUT_POST, 'id_tematica');
     $tma = new Tematica();
     $tma->eliminar_tematica($id_tematica);
 }
 
 function habilitar_traduccion() {
     require "../clases/clase_Idioma.php";
     $id_idioma_pk   = filter_input(INPUT_POST, 'id_idioma_pk'); //echo $id_idioma_pk;
     $obj   =   new Idioma();
     $obj->iinicializar($id_idioma_pk);
     if($obj->habilitar_idioma()) {
         echo "1"."<>".$obj->json_idioma($id_idioma_pk);
     }
     else {
         
     }
 }
 
 function activar_idioma() {
     require "../clases/clase_Idioma.php";
     $id_idioma_pk   = filter_input(INPUT_POST, 'id_idioma_pk'); //echo $id_idioma_pk;
     $obj   =   new Idioma();
     $obj->iinicializar($id_idioma_pk);
     if($obj->activar_idioma()) {
         echo "1"."<>".$obj->json_idioma($id_idioma_pk);
     }
     else {
         
     }
 }
 
 function subir_cargar_archivo_respaldo_idioma() {
     require "../clases/clase_Idioma.php";
     $id_idioma_pk   = filter_input(INPUT_POST, 'id_idioma_r'); //echo $id_idioma_pk;
     $obj   =   new Idioma();
     $archivo = $_FILES;
     $id = $obj->s_cargar_respaldo_idioma($id_idioma_pk, $archivo);
    echo $id;
}

function cargar_respaldo_iidioma() {
    require "../clases/clase_Idioma.php";
    $archivo   = filter_input(INPUT_POST, 'archivo'); //echo $id_idioma_pk;
    $obj   =   new Idioma();
    if($obj->cargar_respaldo_idioma($archivo)) {
        echo 1;
    }
    else {
        echo 0;
    }
}

function inactivar_idioma() {
     require "../clases/clase_Idioma.php";
     $id_idioma_pk   = filter_input(INPUT_POST, 'id_idioma_pk'); //echo $id_idioma_pk;
     $obj   =   new Idioma();
     $obj->iinicializar($id_idioma_pk);
     if($obj->inactivar_idioma()) {
         echo "1"."<>".$obj->json_idioma($id_idioma_pk);
     }
     else {
         
     }
 }
 
 
 
 
 function agregarautor(){

    $idusuario = $_SESSION['idusuario'];  
    $nusuario = $_SESSION['nusuario'];   
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso = $_SESSION['idcongreso'];
    $rolescongreso = $_SESSION['roles'];
    //variable global para envio de correos 
    $enviomj = 0;  

    include '../clases/class_trabajos.php';                
    $tu = new trabajo();
    $idt = filter_input(INPUT_POST, 'idt');      
    $correo = ['correo'=>filter_input(INPUT_POST, 'correo_autor'),'tipo'=>1];
    $correo_autor = filter_input(INPUT_POST, 'correo_autor');
    $primer_nombre = filter_input(INPUT_POST, 'primer_nombre');
    $primer_apellido = filter_input(INPUT_POST, 'primer_apellido');
     $identificacion = filter_input(INPUT_POST, 'identificacion');
    //verificamos si existe
    $pn = explode(" ", $primer_nombre);
    $pa = explode(" ", $primer_apellido);
    $pnombre = $pn[0];
    if(isset($pn[1]))
    {
        $snombre = $pn[1];
    }else{
        $snombre = " ";
    }
    $papellido = $pa[0];
    if(isset($pa[1]))
    {
        $sapellido = $pa[1];
    }else{
        $sapellido = " ";
    }  

    //verificar si existe en la bd ya registrado con este correo
    $data = $tu ->selectusuario($correo_autor);
    $filas = mysqli_fetch_row($data);
    //
    $data1 = $tu ->selectpersona($identificacion);
    $filas1 = mysqli_fetch_row($data1);

    if($filas == 0 && $filas1 == 0){ //DETERMINA SI VIENE VACIA
         //variables por defecto IDentificacion aleatoria 
        $tprincipal = 1; $tidentificacion = 1;  $pais = "HN";        
        $tpersona = 1; $talimentacion = 1;
        //CREAMOS USUARIO Y CONTRASENA ALEATORIAMENTE
        $nusuario = random_cadena($length=10);                                       
        $contrasenia1 = random_cadena($length=15);                                         

        $persona = new persona();
        $persona ->pinicializar(NULL, $pnombre, $snombre, $papellido, $sapellido, $correo, $tprincipal, $tidentificacion, $pais,$identificacion, $tpersona, $talimentacion,$nusuario,$contrasenia1,$idioma);
        $idperson = $persona -> registro();
        $telefono = $persona -> asignar_telefono();
        $correo = $persona -> asignar_correo();    
        $usuario = $persona -> crear_usuario();                                        
        
        //buscamos el rol autor en el arreglo de roles pertenecientes al congreso activo

        $idrol = array_search('Autor', $rolescongreso);                                       
        $us = new usuario();
        //inicializo y guardo el rol del usuario POR DEFECTO SERA autor
        $us ->uinicializar($usuario,$nusuario,$contrasenia1,NULL,$correo_autor,$idrol,NULL);                                     
        $rol = $us ->asignar_usuarioxrolxcongreso();  

//*********        //vinculamos este usuario al trabajo
        $aprincipal = filter_input(INPUT_POST, 'rd_ap_si');                                            
        if ($aprincipal == 1){
            $tu->inicializarautorprincipalut($idt);
            $tu->autorpusuariotrabajo();
            
            $tu->inicializarusuariotrabajo($usuario, $idt, NULL, 1, NULL, NULL,0,1);
            $tu->usuariotrabajo();
        }else{
            $tu->inicializarusuariotrabajo($usuario, $idt, NULL, NULL, 1, NULL,0,0);
            $tu->usuariotrabajo();
        }

        $congreso = $tu->selectcongreso($idcongreso);
        //enviamos el correo al usuario para validar su autoria
        $titulo="AUTORÌA DE TRABAJO";  
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
        $mensaje.="Se ha subido un TRABAJO DE INVESTIGACIÓN al Congreso y se requiere de usted, para que ingrese y actualice sus datos y de igual manera confirme su AUTOR��A del trabajo, Ingresando a la secci��n de GESTION DE TRABAJOS DEL AUTOR y luego ACEPTAR AUTORIAS."
                . "<br><br>PARA DICHO PROCESO INGRESE A LA DIRECCIÓN:<br> <a href='http://ceat-unah.org/sistemas/gcongreso/beta/index.php' target='_blank'>AQU��</a>"
                . "<br><br>";
        $mensaje.="A continuación encontrará su usuario y contraseña con los que podrá tener acceso a la Plantaforma de Administraci��n de Congresos:<br>"
                . "USUARIO:  ".$nusuario."<br>"
                . "CLAVE:  ".$contrasenia1."<br>";
        $mensaje.="</p>";
        $mensaje.="<p>";     
        $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
        $mensaje.="</p>";
        $mensaje.="</body>";
        $mensaje.="</html>";      
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        
        if( mail($correo_autor, $titulo, $mensaje, $cabeceras)){
            $enviomj = 1;
        }
        echo $enviomj;
    }else{
        //en caso de que la o los autores ya esten la bd solo los agrego a la 
        //usuario trabajo
        //Extraigo el id de usuario tbl_usuario
        $array = $tu->selectusuarioreg($correo_autor);
        foreach ($array as $key) {
            $aprincipal = filter_input(INPUT_POST, 'rd_ap_si');                                            
            if ($aprincipal == 1){
                $tu->inicializarautorprincipalut($idt);
                $tu->autorpusuariotrabajo();
                
                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $idt, NULL, 1, NULL, NULL,0,1);
                $tu->usuariotrabajo();
            }else{
                $tu->inicializarusuariotrabajo($key['id_usuario_pk'], $idt, NULL, NULL, 1, NULL,0,0);
                $tu->usuariotrabajo();
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
            $mensaje.="Se ha subido un TRABAJO DE INVESTIGACIÓN al Congreso y se requiere de usted, para que ingrese y actualice sus datos y de igual manera confirme su AUTORÍA del trabajo, Ingresando a la sección de GESTIÓN DE TRABAJOS DEL AUTOR y luego ACEPTAR AUTORÍAS."
                    . "<br><br>PARA DICHO PROCESO INGRESE A LA DIRECCIÓN:<br> <a href='http://ceat-unah.org/sistemas/gcongreso/beta/index.php' target='_blank'>AQUÍ</a>"
                    . "<br><br>";
            $mensaje.="</p>";
            $mensaje.="<p>";     
            $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
            $mensaje.="</p>";
            $mensaje.="</body>";
            $mensaje.="</html>";      
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";           
            if( mail($correo_autor, $titulo, $mensaje, $cabeceras)){
                $enviomj = 1;
            } 
        }
        echo $enviomj;
        
    }
 }
 
 function guardarexpositores(){
     include '../clases/class_trabajos.php';                
    $tu = new trabajo();
    $idexpos = filter_input(INPUT_POST, 'idexpos');
    $idautor_corres = filter_input(INPUT_POST, 'id_autor_co');
     $idt = filter_input(INPUT_POST, 'idt');
     $array = array();
     $array1 = array();
     $array = explode(",", $idexpos);  
     $array1 = explode(",", $idautor_corres); 
     $val = 0;
     $val1 = 0;
     //actualizo todos los expositores y autores  a NULL
     $val2 = $tu->actualizaexpo($idt);
     //Guardo los actuales 
    for($k=0; $k < count($array);$k++){        
        $tu->inicializarexpositores($array[$k],'1',$idt);        
        $val = $tu->actualizaexpositores();
    }
    for($j=0; $j < count($array1);$j++){        
        $tu->inicializarautorcorrespondencia($array1[$j],'1',$idt);        
        $val1 = $tu->actualizaautorcorrespondencia();
    }
    if($val == 1 && $val1 == 1){
        echo 1;
    }else{
        echo 0;
    }
 }
 
 
 function eliminartrabajo(){
//     print_r($_POST);
//      print_r($_SESSION);
    $idusuario = $_SESSION['idusuario']; 
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso = $_SESSION['idcongreso'];
    $rolescongreso = $_SESSION['roles'];    

    include '../clases/class_trabajos.php';                
    $tu = new trabajo();
    $idt = filter_input(INPUT_POST, 'idt');
    $tu->inicializartrabajo($idt, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    $tu->epremiotrabajo();
    $tu->etematicastrabajo();
    $tu->eusuariostrabajo();
    $tu->eversiontrabajo();
    echo $tu->eliminartrabajo();
 }
 
 
function instr_form(){
    include '../clases/class_formulario.php';
    $nombre = filter_input(INPUT_POST, 'nombre');
    $descripcion = filter_input(INPUT_POST, 'des');
    $fecha = date('Y-m-d');
    $form = new formulario();
        $form->iniciaformu(null, $nombre, $descripcion, $_SESSION['idusuario'], $fecha , null, null);
        $resultado = $form->insertform();           
        $id = $form->ultimoform();     
        foreach ($id as $val) {  
            $lastid=($val['id_formulario_pk']);                     
        }
        if($resultado != 0){
            echo $lastid;
        }else{
            echo 0;
    } 
 }
 
 
 function instr_prcuali(){
 include '../clases/class_formulario.php';
    $id = filter_input(INPUT_POST, 'id');
    $pregunta = filter_input(INPUT_POST, 'valor');
    
    $pregcuali = new formulario();
        $pregcuali->inipregcuali(null, $pregunta, $id, 1);
        $resultado = $pregcuali->insertpregcuali(); 
        if($resultado != 0){
            echo 1;
        }else{
            echo 0;
    }
   
 }

 function instr_prcuanti(){
 include '../clases/class_formulario.php';
    
    $idform = filter_input(INPUT_POST, 'id');
    $pregunta = filter_input(INPUT_POST, 'pregunta');
    $opcion = filter_input(INPUT_POST, 'opcion');
    $peso = filter_input(INPUT_POST, 'peso');
    $tipo = filter_input(INPUT_POST, 'tipo');
    
    $option = "";
    $weight = "";
    
    
    $opciones = explode("<>", $opcion) ;
    $pesos  = explode("<>", $peso) ;
    
    
    for ($i=2; $i<=count($opciones) -1; $i++ ){ 
        $option .="<>".$opciones[$i];   
    }
    for ($a=1; $a<=count($pesos) -1; $a++ ){ 
        $weight .="<>".$pesos[$a]; 
    }
    
   
    $pregcuanti = new formulario();
        $pregcuanti->inipregcuanti(null, $pregunta, $option, $weight,$idform, $tipo);
        $resultado = $pregcuanti->insertpregcuanti(); 
        if($resultado != 0){
            echo 1;
        }else{
            echo 0;
    }
    
    
    
 }
 
 function asoc_form_tematica(){
    include '../clases/class_formulario.php';
    
    $idform = filter_input(INPUT_POST, 'idform');   
    $tematicas  = explode(",", filter_input(INPUT_POST, 'tematicas')) ;
    $asoc_form_tematica = new formulario();
    
    
     for($i=0; $i<count($tematicas); $i++){
        //echo $tematicas[$i];
      
        $asoc_form_tematica->iniciaasociartematica($idform, $tematicas[$i]);
        
        $resultado = $asoc_form_tematica->asociartematica(); 
        if($resultado != 0){
            echo 1;
        }else{
            echo 0;
        }
    }
    
 }
 
 
 function aceptarhora(){
//     print_r($_POST);
//     print_r($_SESSION);
    $idt = filter_input(INPUT_POST, 'idt');
    $si = filter_input(INPUT_POST, 'rd_si');
    include '../clases/class_trabajos.php';                
    $tu = new trabajo();
    $tu->inicializartrabajo($idt, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL); 
    if($si == 1){
        echo $tu->aceptarhorario(1);
    }else{
       echo  $tu->aceptarhorario(0);
    }
 }
 
 function trabajo_a_revisor(){
    include '../clases/class_usuario.php';
    
    $id_trabajo = filter_input(INPUT_POST, 'idtrabajo'); 
    $usuarios_revisores = explode(",", filter_input(INPUT_POST, 'revisores'));
    $idcongreso = $_SESSION['idcongreso'];
    /*$valores = implode(",", $usuarios_revisores);
    echo $valores ;*/
    $fecha = date('Y-m-d');
    $asignar_trabajo_revisor = new editorprincipal();
     for($i=0; $i<count($usuarios_revisores); $i++){
        /*echo $usuarios_revisores[$i];*/
        $asignar_trabajo_revisor->inicia_asignar_revisor_trabajo(null, 0, 0, $fecha, "0000-00-00", $id_trabajo,  $_SESSION['idusuario'], $usuarios_revisores[$i], 3) ;
        $resultado = $asignar_trabajo_revisor->asignar_revisor_trabajo(); 
        
        $asignar_trabajo_revisor->enviar_correo_revisor($usuarios_revisores[$i], $idcongreso, $id_trabajo);
    }
    if($resultado != 0){
            echo 1;
        }else{
            echo 0;
        }
    
 }
 
 function cancelar_a_revisor(){
    include '../clases/class_usuario.php';
    
    $idtrabajo = filter_input(INPUT_POST, 'idtrabajo');
    $idusuariorevisor =explode(",", filter_input(INPUT_POST, 'idusuario'));

    $cancelar_solicitud = new editorprincipal() ;
    for($i=0; $i<count($idusuariorevisor); $i++){
        //echo $idusuariorevisor[$i];
        $cancelar_solicitud->inicia_cancelar_revisor_trabajo($idusuariorevisor[$i], $idtrabajo);
        $resultado = $cancelar_solicitud->cancelar_revisor_trabajo();
    }
    
    if($resultado != 0){
        echo 1;
    }else{
        echo 0;
    }
}

function  aceptar_trabajo_revisar(){
    include '../clases/class_usuario.php';
    
    $idtrabajo = filter_input(INPUT_POST, 'idtrabjo');
    $idtabla   = filter_input(INPUT_POST, 'idtabla');
    $accion    = filter_input(INPUT_POST, 'accion');
    $fechaaceptacion = date('Y-m-d');
    if ($accion  == "aceptar"){
        $aceptartrabajo = new revisor();
        $aceptartrabajo->inicia_aceptar_cancelar_trabajo($idtrabajo, $idtabla, 1, 1, $fechaaceptacion) ;
        $resultado = $aceptartrabajo->aceptar_cancelar_trabajo();

        if($resultado != 0){
            echo 1;
        }else{
            echo 0;
        }    
    }else if($accion  == "rechazar"){
        $rechazartrabajo = new revisor();
        $rechazartrabajo->inicia_aceptar_cancelar_trabajo($idtrabajo, $idtabla, 1, 0, $fechaaceptacion) ;
        $resultado1 = $rechazartrabajo->aceptar_cancelar_trabajo();

        if($resultado1 != 0){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    //echo $fechaaceptacion;
       
    
}
/*Brayan Dictaminar trabajo ep*/
function dictaminar_trabajo(){
    include '../clases/class_usuario.php';
    //include '../clases/class_trabajos.php';                
    //$tu = new trabajo();
    $idt  = filter_input(INPUT_POST, 'idt');
    $iddictamen = filter_input(INPUT_POST, 'dictamen');
    $idcongreso = $_SESSION['idcongreso']; 
    $idtp =  filter_input(INPUT_POST, 'tipo');
    $nombretrabajo=  filter_input(INPUT_POST, 'ubicacion');
    $dictamen = "" ;
    
    $dictaminar = new editorprincipal();
    $dictaminar->inicia_dicatminar_trabajo($iddictamen, $idt);
    $resultado1 = $dictaminar->dictaminar_trabajo();
    
    if($resultado1 != 0){        
        if($iddictamen == 1){
            $dictamen = "Aceptado" ; 
            $dictaminar->inicia_dicatminar_trabajo(6, $idt);
            $dictaminar->cambia_estado_trabajo();
            $url_trabajo_origen = "../form/gestion_trabajos/trabajos/congreso$idcongreso"."/tipotrabajo".$idtp."/Revisiones/".$nombretrabajo;
            $url_trabajo_destino = "../form/gestion_trabajos/trabajos/congreso$idcongreso"."/tipotrabajo".$idtp."/Aceptados/".$nombretrabajo;
                if(!file_exists($url_trabajo_destino)){
                    copy($url_trabajo_origen, $url_trabajo_destino);
                }
                enviar_dictamen_autores_trabajo($idt ,$dictamen) ;               
                
        }else{
            $dictamen = "Rechazado" ; 
            $dictaminar->inicia_dicatminar_trabajo(2, $idt);
            $dictaminar->cambia_estado_trabajo();
            enviar_dictamen_autores_trabajo($idt ,$dictamen) ;
        }
        echo 1;
    }else{
        echo 0;
    }
}

/*Obed Guardar formulario de revisor de trabajos*/
function guardarformulariorevision(){
    date_default_timezone_set("America/New_York");
    include '../clases/class_usuario.php';
    $idt = filter_input(INPUT_POST, 'idt');
    $idusuario = $_SESSION['idusuario'];            
    $desicion = filter_input(INPUT_POST, 'desicion');/*tipo_dictamen*/
    $obstrabajo = filter_input(INPUT_POST, 'observacionestrabajo'); 
    $descargo_archivo = filter_input(INPUT_POST, 'descargo_archivo');
    $array_pcuanti = $_POST['array_pcuanti'];
    $array_pcuali = $_POST['array_pcuali'];
    $fecha_reviso = date("Y-m-d");
    $narray_pcuali = array();
    $narray_pcuanti = array();
    $qfinal1 = 0;$qfinal2 = 0;
   // print_r($_POST);
    $tu = new revisor();
    /*extraigo id de tbl_asignacion_a_revisiones*/
    $idasig_revisor = 0;
    $idasignacion_rev = $tu->idasignacion_revision($idt, $idusuario);
    $datos = mysqli_fetch_array($idasignacion_rev);
    foreach ($datos as $val) {
        $idasig_revisor = $val;
    }
    
    /*inserto datos en tbl_revisiones_trabajo*/
    $tu->inicializar_revisiontrabajos(NULL, $idasig_revisor, $descargo_archivo, 1, $fecha_reviso, $desicion, $obstrabajo);
    $idrev_trab = $tu->irevisiontrabajo();
        
    for($i = 0; $i < count($array_pcuali); $i++){       
        $narray_pcuali = explode(",",$array_pcuali[$i]); 
        $tu->inicializar_respuesta_cualitativa(NULL, $narray_pcuali[1], $narray_pcuali[0]);
        $idresp_cuali = $tu->irespuesta_cualitativa(); 
        
        /*guardo info en tbl_respuesta_revisiones_trabajos_cualitativos*/
        $tu->inicializar_respuestas_revisiones_trabajos_cualitativas($idrev_trab, $idresp_cuali);
        $qfinal1 = $tu->irespuestas_revisiones_trabajos_cualitativas();
        
    }
    for($j = 0; $j < count($array_pcuanti); $j++){
        $narray_pcuanti = explode(",",$array_pcuanti[$j]); 
        $tu->inicializar_respuesta_cuantitativa(NULL, "$narray_pcuanti[1]", $narray_pcuanti[0]);
        $idresp_cuanti = $tu->irespuesta_cuantitativa(); 
        
        /*guardo info en tbl_respuesta_revisiones_trabajos_cuantitativos*/
        $tu->inicializar_respuestas_revisiones_trabajos_cuantitativas($idrev_trab, $idresp_cuanti);
        $qfinal2 = $tu->irespuestas_revisiones_trabajos_cuantitativas();
        
    }
   
    if($idresp_cuali != 0 || $idresp_cuanti != 0){
        echo '1';
    }else{
        echo '0';
    }
}

function enviar_dictamen_autores_trabajo($idtrabajo,$dictamen){
    include '../clases/class_trabajos.php';
    $trabajo = new trabajo();
    $idcongreso = $_SESSION['idcongreso'];
    
    $congreso = $trabajo->selectcongreso($idcongreso);
    
    $infotrabajo = $trabajo->selecttrabajo($idtrabajo);
    
    foreach ($infotrabajo as $informacion) {
    $titulotrabajo = "".strtoupper($informacion['titulo_trabajo'])."";                                               
    }
    
    $coautores = $trabajo->autoresxtrabajo($idtrabajo);
    
    foreach ($coautores as $correos) {
    
            $correoautores = $correos['correo'];

            /*enviamos el correo a los usuario involucrados con el trabajo */
            $titulo="AUTORÌA DE TRABAJO";  
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
            $mensaje.=" Le comunica que su TRABAJO DE INVESTIGACIÓN $titulotrabajo ha sido revisado y este ha sido $dictamen "
                    . "<br><br>Le invitamos a que visite nuestro Sitio WEB para mayor información:<br> <a href='http://ceat-unah.org/congreso_2017.html' target='_blank'><b>INGRESAR AL SITIO</b></a>"
                    . "<br><br>";
            $mensaje.="</p>";
            $mensaje.="<p>";     
            $mensaje.="Un saludo muy cordial, y gracias por participar en el Congreso.!!!";
            $mensaje.="</p>";
            $mensaje.="</body>";
            $mensaje.="</html>";      
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            if( mail($correoautores, $titulo, $mensaje, $cabeceras)){
                $enviomj = 1;
            }
    }
}

function asignar_trabajo_ess(){
    include '../clases/class_usuario.php';
    $asignar_trabajo_ess = new editor_secundario_seccion();
    
    $idtrabajo  = filter_input(INPUT_POST, 'idtrabajo');
    $idusuario_ess = explode(",", filter_input(INPUT_POST, 'idusuario'));
    
    $fecha = date('Y-m-d');
    
    for($i=0; $i<count($idusuario_ess); $i++){
        //echo $idusuario_ess[$i];
        $asignar_trabajo_ess->inicia_editor_secundario_seccion(null, $fecha, $_SESSION['idusuario'], $idusuario_ess[$i], $idtrabajo);
        $resultado = $asignar_trabajo_ess->asignar_editor_secundario_seccion();
    }
    if($resultado != 0){
            echo 1;
        }else{
            echo 0;
        }
}

function insertar_espacio(){
    include '../clases/class_programa.php';    
    $idcongreso            = $_SESSION['idcongreso'];     
    $idespacio = filter_input(INPUT_POST, 'idespacio'); 
    $nombre_espacio        = filter_input(INPUT_POST, 'nombre_espacio');
    $nombre_alternativo    = filter_input(INPUT_POST, 'nombre_alternativo');    
    $descripcion           =  filter_input(INPUT_POST, 'descripcion');    
    $cant_personas         =  filter_input(INPUT_POST, 'cant_personas');
    $cant_tomas            =  filter_input(INPUT_POST, 'cant_tomas');    
    $url_mapa_espacio      =     $_FILES;
    $comentarios           = filter_input(INPUT_POST, 'comentarios_adicionales');
    
    $tu = new programa();
    $tu->inicializar_espacios(NULL, $nombre_espacio, $nombre_alternativo, $descripcion, $cant_personas, $cant_tomas, $url_mapa_espacio, $comentarios);
    $idespacio = $tu->insertar_espacio();
    $tu->insertar_espacio_congreso($idespacio, $idcongreso);
    
    if($idespacio != 0){
        echo 1;
    }else{
        echo 2;
    }       
}

function guadar_modificar_espacio(){
    //print_r($_POST);
    include '../clases/class_programa.php';    
   // $idcongreso = $_SESSION['idcongreso'];     
    $nombre_espacio  = filter_input(INPUT_POST, 'nombre_espacio');
    $nombre_alternativo = filter_input(INPUT_POST, 'nombre_alternativo');    
    $descripcion =  filter_input(INPUT_POST, 'descripcion');    
    $cant_personas =  filter_input(INPUT_POST, 'cant_personas');
    $cant_tomas =  filter_input(INPUT_POST, 'cant_tomas');    
    $comentarios = filter_input(INPUT_POST, 'comentarios_adicionales');
    $idespacio = filter_input(INPUT_POST, 'idespacio');
    
     $tu = new programa();
    $tu->inicializar_espacios($idespacio, $nombre_espacio, $nombre_alternativo, $descripcion, $cant_personas, $cant_tomas, NULL, $comentarios);
    $valor = $tu->modificar_espacio();
    if($valor != 0){
        echo 1;
    }else{
        echo 2;
    } 
}
function insertar_actividad(){

    print_r ($_POST);   

$idcongreso = $_SESSION['idcongreso'];     
$nombre_actividad  = filter_input(INPUT_POST, 'nombre_actividad');
$cresponsable = explode('/',filter_input(INPUT_POST, 'responsable'));    
$responsable = $cresponsable;
$hora_inicio =  filter_input(INPUT_POST, 'hora_inicio');    
$hora_fin =  filter_input(INPUT_POST, 'hora_fin');
$descripcion =  filter_input(INPUT_POST, 'descripcion');    
$comentarios = filter_input(INPUT_POST, 'comentarios');
$espacio_actividad = filter_input(INPUT_POST, 'espacio_actividad');
$tactividad = filter_input(INPUT_POST, 'tactividad');
$fecha = filter_input(INPUT_POST, 'fecha');
$tematica = filter_input(INPUT_POST, 'tematicas_trabajo');

$linea_investigacion = "";

require_once '../clases/class_usuario.php';
$usuario = new usuario();
$usuario->uinicializar(NULL, NULL, NULL, NULL, $responsable[1], NULL, NULL);
$usuario->get_ucorreo();
$idusuario = $usuario->get_id();   
print_r($idusuario) ;



/* Alexis Escoto 12/01/2023*/
include '../clases/class_programa.php';   
$obj = new programa();  
$datos = $obj->select_tematica($tematica);
foreach ($datos as $fil) {
    $linea_investigacion = $fil['id_linea_investigacion_pk'];
}        

/* Alexis Escoto 07/2/2022 */

$obj->inicializar_actividad($idcongreso,$nombre_actividad,$idusuario, $hora_inicio,
$hora_fin,$comentarios,$espacio_actividad,$tactividad,$fecha,$tematica,$linea_investigacion);
$obj->Insertar_Actividad();   
 
/*
$inicializar= $obj->inicializar_actividad($idcongreso, $nombre_actividad, $idusuario, $hora_inicio, $hora_fin, $descripcion, $comentarios, $espacio_actividad, $tactividad, $fecha,$tematica,$linea_investigacion);
*/



}
function eliminar_actividad(){    
    include '../clases/class_programa.php';    
    $idcongreso = $_SESSION['idcongreso'];     
    $id_actividad = filter_input(INPUT_POST, 'idactividad');
    $programa = new programa();
    $programa->inicializar_id_actividad($id_actividad);
    $verificador2 = $programa->eliminar_actividad_tematica();     
    $verificador = $programa->eliminar_actividad_congreso();     
    
    if(($verificador != -1) && ($verificador2 != -1)){
        $verificador = $programa->eliminar_actividad();
        if($verificador != -1){
            echo 1;            
        }else{
        echo 0;
    }       

    }else{
        echo 0;
    }       
}

function eliminar_espacio(){    
    include '../clases/class_programa.php';  
    $idespacio = filter_input(INPUT_POST, 'idespacio'); 
    $tu = new programa();
    /*traemos la info de este espacio para eliminar el mapa del mismo*/
    $datos = $tu->selectespacio($idespacio); 
    
    /*eliminamos el mapa del espacio*/        
    foreach ($datos as $val) {
        $nombre_mapa = $val['mapa_espacio'];
        if (!empty($nombre_mapa)) { 
            unlink("../form/gestion_programa/mapas_espacio/".$nombre_mapa);            
        }
    } 
    /*eliminamos el espacio*/
    $tu->inicializar_espacios($idespacio, NULL, NULL, NULL, NULL, NULL, NULL, NULL);    
    $resultado1 = $tu->eliminar_espacio_congreso();
    $resultado = $tu->eliminar_espacio();
    
    if($resultado != 0 && $resultado1 != 0){ 
        echo 1;
    }else{
        echo 2;
    }
}
function traducir_idioma() {
    require '../clases/clase_Idioma.php';
    $id = filter_input(INPUT_POST, "id");
    $clave = filter_input(INPUT_POST, "clave_".$id);
    $texto_sin_traducir = filter_input(INPUT_POST, "valor_".$id);
    $texto_traducido = filter_input(INPUT_POST, "tex_traduccion_".$id."");
    $idioma = filter_input(INPUT_POST, "idioma");
    $obj = new Idioma();
    if($obj->traduciridioma($idioma, $clave, $texto_sin_traducir, $texto_traducido)) {
        echo 1;
    }
    else {
        echo 0;
    }
}

function crear_respaldo() {
    require '../clases/clase_Idioma.php';
    $id = filter_input(INPUT_POST, "id_idioma_pk");
    $obj = new Idioma();
    $identificador = $obj->crear_respaldo($id);
    echo $identificador;
}

//echo $arreglo[$key]["clave"]." => ".$arreglo[$key]["valor"]." => ".$arreglo[$key]["peso"]."<br>";

function eliminarautortrabajo(){
    $idtrabajo = filter_input(INPUT_POST, 'idtrabajo');
    $idusuario = filter_input(INPUT_POST, 'idusuario');
    include '../clases/class_trabajos.php';
    $tu = new trabajo();
    $data =$tu->eliminarutrab($idtrabajo, $idusuario);
    if($data != 0){
        echo 1;
    }else{
        echo 0;
    }
}

function insertar_distribucion_trabajos(){
    $tematica = filter_input(INPUT_POST, 'tematicas_trabajo');    
    $distribucion = filter_input(INPUT_POST, 'iddistribucion');
    
    include '../clases/class_programa.php'; 
    $tu = new programa();
    /*traemos todas filas de la tbl_act_tematicas que existan de la tematica*/
    $datos = $tu->selectactividadtem($tematica); 
    $trabajos = $tu->selecttrabajosxtem($tematica);
    $arrayact = array();
    $arraytrab = array();
    $i = 0;
    /*eliminamos el mapa del espacio*/        
    foreach ($datos as $val) {
        /*guardamos la distribucion*/
        $tu->inicializar_actividad(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $val['id_tematica_fk'], NULL);    
        $resultado = $tu->agregar_distribucion_sesiones_paralelas($distribucion);  
        $arrayact[$i] = $val['id_actividad_fk'];
        $i+=1;
    }
    $j=0;
    foreach ($trabajos as $valor) {
        $arraytrab[$j] = $valor['id_trabajo_pk'];
        $j+=1;
    }
    
    /*lleno la tbl_actividad_trabajo*/
    if($distribucion == 1){
        for($r = 0; $r < count($arrayact); $r++){
            for($b = 0; $b < count($arraytrab); $b++){
                if($b == $r){
                    $tu->inicializar_actividad_trabajos($arrayact[$r], $arraytrab[$b]);
                    $tu->eliminar_actividad_trabajos();
                    $tu->insertar_actividad_trabajos();
                }
            }
        }        
    }else if($distribucion == 2){
        $cont = 0;
        for($r = 0; $r < count($arrayact); $r++){             
            for($f=0; $f < 2; $f++){ 
                /*se borra cualquier registro que tengan las actividades*/
                if($cont == 0){
                    for($t = 0; $t < count($arrayact); $t++){
                        $tu->inicializar_actividad_trabajos($arrayact[$t], NULL); 
                        $tu->eliminar_actividad_trabajos();
                    }                    
                }
                /*Almacenamos los trabajos de cada actividad dinamicamente*/
                $tu->inicializar_actividad_trabajos($arrayact[$r], $arraytrab[$cont]); 
                $cont+=1; 
                if($cont != 0){
                    $tu->insertar_actividad_trabajos(); 
                }              
            } 
        } 
    }else if($distribucion == 3){
        $cont = 0;
        for($r = 0; $r < count($arrayact); $r++){             
            for($f=0; $f < 3; $f++){ 
                /*se borra cualquier registro que tengan las actividades*/
                if($cont == 0){
                    for($t = 0; $t < count($arrayact); $t++){
                        $tu->inicializar_actividad_trabajos($arrayact[$t], NULL); 
                        $tu->eliminar_actividad_trabajos();
                    }                    
                }
                /*Almacenamos los trabajos de cada actividad dinamicamente*/
                $tu->inicializar_actividad_trabajos($arrayact[$r], $arraytrab[$cont]); 
                $cont+=1; 
                if($cont != 0){
                    $tu->insertar_actividad_trabajos(); 
                }              
            } 
        }
    }else if($distribucion == 4){
        $cont = 0;
        for($r = 0; $r < count($arrayact); $r++){             
            for($f=0; $f < 4; $f++){ 
                /*se borra cualquier registro que tengan las actividades*/
                if($cont == 0){
                    for($t = 0; $t < count($arrayact); $t++){
                        $tu->inicializar_actividad_trabajos($arrayact[$t], NULL); 
                        $tu->eliminar_actividad_trabajos();
                    }                    
                }
                /*Almacenamos los trabajos de cada actividad dinamicamente*/
                $tu->inicializar_actividad_trabajos($arrayact[$r], $arraytrab[$cont]); 
                $cont+=1; 
                if($cont != 0){
                    $tu->insertar_actividad_trabajos(); 
                }              
            } 
        }
    }
    echo $resultado;
}

function cambiartrabajos_de_actividad(){   
    $id_act = filter_input(INPUT_POST, "id_act");
    $idtrab = filter_input(INPUT_POST, "idtrab");
    include '../clases/class_programa.php'; 
    $tu = new programa();
    $tu->inicializar_actividad_trabajos($id_act, $idtrab);
    echo $resultado = $tu->update_actividad_trabajos();
}



function guardar_programa(){
//    print_r($_SESSION);
    include '../clases/class_programa.php'; 
    $tu = new programa();
    $nombre_p = filter_input(INPUT_POST, 'nombre_programa');
    $descripcion_p = filter_input(INPUT_POST, 'descripcion_programa');
    $estado_p = filter_input(INPUT_POST, 'estado_programa');
    $fecha_creacion = date("Y-m-d");
    $idcongreso = $_SESSION['idcongreso'];
    
    $tu->inicializar_programa(NULL, $nombre_p, $descripcion_p, $estado_p, $_SESSION['idusuario'], $fecha_creacion, NULL, NULL);
    $result = $tu->insertar_programa();
    /* Vinculo el programa con todas las actividades 
     * creadas y cargadas a la fecha del congreso seleccionado*/
   /*Alexis Escoto 13-01-2023 */ $act = $tu->get_act_por_congreso($idcongreso);
    $filas = $act;
    $resultado = 0;
    if($result != 0 && $filas != 0){
        foreach ($act as $fila) { 
         
           $resultado = $tu->insertar_programa_actividad($result, $fila['id_actividad_pk']);
        }              
      
    }
}


function eliminar_act_modificando_programa(){
    include '../clases/class_programa.php'; 
    $tu = new programa();
    $idact  = filter_input(INPUT_POST, 'idact');
    $idprograma  = filter_input(INPUT_POST, 'idprograma');
    $resultado = $tu->eliminar_act_programa($idact, $idprograma);
   // echo $resultado;
}


function guardar_modificar_programa(){
    include '../clases/class_programa.php'; 
    $tu = new programa();
    $nombre_p = filter_input(INPUT_POST, 'nombre_programa');
    $descripcion_p = filter_input(INPUT_POST, 'descripcion_programa');
    $estado_p = filter_input(INPUT_POST, 'estado_programa');
    $idprog = filter_input(INPUT_POST, 'idprog');
    $fecha_creacion = date("Y-m-d");    

    $tu->inicializar_programa($idprog, $nombre_p, $descripcion_p, $estado_p, $_SESSION['idusuario'], $fecha_creacion,$_SESSION['idusuario'],$fecha_modifica);
    echo $result = $tu->update_programa();
}

function eliminar_programa(){
    include '../clases/class_programa.php'; 
    $tu = new programa();
    $idprog = filter_input(INPUT_POST, 'idprograma');
    $tu->inicializar_programa($idprog, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    echo $result = $tu->eliminar_programa();
    
}
















 ?>
 
