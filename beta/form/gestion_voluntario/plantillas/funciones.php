<?php

/* 
 * Brayan Triminio
 * Funciones para la gestion de voluntarios
 * 11/08/17
 */

session_start();
switch ($_GET['caso']) {
    
    case 'aceptar_solicitud_voluntario':   //Brayan
        aceptar_solicitud_voluntario();
        break;  
    
    case 'inscribir_voluntario':
        inscribir_voluntario();
        break;
    
    case 'crear_actividad_voluntario' :
        crear_actividad_voluntario();
        break;
    
    case 'asociar_tarea_voluntario' : 
        asociar_tarea_voluntario();
        break;
    
    case 'validar_voluntario' ;
        validar_voluntario();
        break;
}

function aceptar_solicitud_voluntario(){
    require_once '../../../clases/class_usuario.php';
    $respuesta_voluntario = 0 ;
    
    $solicitud = new voluntario();
    
    $idsolicitud = filter_input(INPUT_GET, 'idsolicitud');
    $dictamen = filter_input(INPUT_GET, 'dictamen');
    
    $respuesta = $solicitud->inicia_aceptar_rechazar_voluntario($dictamen, $idsolicitud) ;
    
    if ($respuesta != 0){
        $respuesta_voluntario = 1;
        if($dictamen == 1){
            $idusuario      = filter_input(INPUT_GET, 'idusuario');
            $nusuario       = $_SESSION['nusuario'] ; 
            $contrasenia    = $_SESSION['contrasenia'] ;
            $img            = $_SESSION['img'] ;
            $correo         = $_SESSION['cprincipal'] ;

            $asignar_rol_voluntario = new usuario();
            $asignar_rol_voluntario->uinicializar($idusuario, $nusuario, $contrasenia, $img, $correo,5,'') ; 
            $respuesta = $asignar_rol_voluntario->asignar_rol_congreso() ;

            if($respuesta !=0){
                $respuesta_voluntario = 1;
                $voluntario = new voluntario() ;

                $voluntario->inicia_inscibir_voluntario(null, 0, "comentarios", 1, 5) ;
                $resultado = $voluntario->crea_voluntario() ;
                if($resultado !=0){
                    $respuesta_voluntario = 1;
                }else{
                    $respuesta_voluntario = 0;
                }
            }else{
                $respuesta_voluntario = 0;
            }
        }
                
    }else{
        $respuesta_voluntario =  0;
    }
    echo $respuesta_voluntario;
}

function inscribir_voluntario(){
    require_once '../../../clases/class_usuario.php';
    
    $idusuario      = filter_input(INPUT_GET, 'volutarios');
    $nusuario       = $_SESSION['nusuario'] ; 
    $contrasenia    = $_SESSION['contrasenia'] ;
    $img            = $_SESSION['img'] ;
    $correo         = $_SESSION['cprincipal'] ;
    
    $asignar_rol_voluntario = new usuario();
    $asignar_rol_voluntario->uinicializar($idusuario, $nusuario, $contrasenia, $img, $correo,5,'') ; 
    $respuesta = $asignar_rol_voluntario->asignar_rol_congreso() ;
    
    if($respuesta !=0){
        echo 1;
        $voluntario = new voluntario() ;
        $id = $voluntario->selectmaxid();
        
        foreach ($id as $valor){
            $id_usuario_rol_congreso = $valor['tbl_usuario_congreso_rol_pk'];
        }
        /*$id_voluntario_pk, $numero_horas, $comentarios, $estado, $id_rol_congreso_fk*/
        $voluntario->inicia_inscibir_voluntario(null, 0, "comentarios", 0, $id_usuario_rol_congreso) ;
        $resultado = $voluntario->crea_voluntario() ;
        if($resultado !=0){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo 0;
    }
    
}

function crear_actividad_voluntario(){
    require_once '../../../clases/class_usuario.php';
    
    $nombre_tarea = filter_input(INPUT_POST, 'nombre_actividad');
    $descripcion = filter_input(INPUT_POST, 'desc_actividad');
    $horas_sumar = filter_input(INPUT_POST, 'horas_sumar');
    $archivo_complementario = $_FILES;
    $fecha_actividad_voluntario = filter_input(INPUT_POST, 'fecha_actividad_voluntario');
    $persona_apollo = filter_input(INPUT_POST, 'persona_apoyo');
    
    $fecha = date('Y-m-d');
    
    if($archivo_complementario['archio_complementario']['name'] != ""){
        $ruta= $archivo_complementario['archio_complementario']['tmp_name'] ;
        $nombre = $archivo_complementario['archio_complementario']['name'] ;
        $destino = "../archivos1/".$nombre ; 
        move_uploaded_file($ruta, $destino);
   }else{
   }
    $activiad_voluntario = new voluntario() ;
    $activiad_voluntario->inicia_actividad_voluntario(null, $nombre_tarea, $descripcion, $archivo_complementario, $persona_apollo, $_SESSION['idusuario'], $fecha, null, null, $fecha_actividad_voluntario, $horas_sumar);
    $respues = $activiad_voluntario->crear_actividad_voluntario();
    
    if($respues !=0 ){
        echo 1 ;
    }else{
        echo 2 ; 
    }
 /*echo print_r($_POST);*/
}

function asociar_tarea_voluntario(){
    require_once '../../../clases/class_usuario.php';
    
    $idvoluntario = filter_input(INPUT_GET, 'idvoluntario');
    $idactividad = filter_input(INPUT_GET, 'actividad') ;
    
    $actividades = explode(',', $idactividad);
    $enviar = 0;
    
    $tarea_voluntario = new voluntario() ;
    
    for($i=0; $i<count($actividades); $i++){
        $tarea_voluntario->inicia_asociar_actividad_voluntario($idvoluntario, $actividades [$i]) ;
        $respuesta = $tarea_voluntario->asociar_actividad_voluntario();
        
        if($respuesta != 0){
            $enviar= 0 ;
        }else{
            $enviar = 1 ;
        }
    }
    if ($enviar !=0){
        echo 1 ;
    }else{
        echo 0 ;
    }
}

function validar_voluntario(){
    require_once '../../../clases/class_usuario.php';
    $voluntarios = explode(",", filter_input(INPUT_GET, 'voluntarios'))  ;
    
    $validar = new voluntario() ;
    $resp = " ";
    for ($i=0;$i<count($voluntarios);$i++){
        $respuesta = $validar->validar_voluntario($voluntarios[$i]);
        if($respuesta != 0){
            $rep = 0 ;
        }else{
            $rep = 1 ;   
        }
    }
    if ($resp ==0){
        echo 1;
    }else{
        echo 0;
    }
     
    
}