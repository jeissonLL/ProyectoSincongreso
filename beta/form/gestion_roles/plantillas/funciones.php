<?php

/* * ----Archivo con funciones para llenar dinamicamente los select de un formulario----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */



$funcion= filter_input(INPUT_POST,'funcion');
session_start();
switch ($funcion) {
    case 'aceptar_solicitud':
        aceptar_solicitud();
        break;
    case 'rechazar_solicitud':
        rechazar_solicitud();
        break;  
    case 'inscribir_rol_tematica':
        inscribir_rol_tematica();
        break;   
    case 'exis_tematica':
        exis_tematica();
        break;     
    case 'inscribir_rol':
        inscribir_rol();
        break;    
//    case 'exit_usuario_rol':
//        exit_usuario_rol();
//        break;         
//    case 'form_solicitud':
//        form_solicitud();
//        break;     
}
function inscribir_rol(){
    $idusuario = filter_input(INPUT_POST, 'idusuario');
    $rol = filter_input(INPUT_POST, 'rol');
    
    require '../../../clases/class_usuario.php';      
    $usuario = new usuario();     
    $usuario ->uinicializar($idusuario, NULL, NULL, NULL, NULL, $rol, NULL);
    $usuario ->get_rol_congreso();
    $esrevisor = $usuario -> get_usuarioxrolxcongreso();
    
    if($esrevisor == 0)
    {
        echo $ver = $usuario -> asignar_usuarioxrolxcongreso();      
    }
    
}
function exis_tematica(){
    
    $idusuario = filter_input(INPUT_POST, 'idusuario');
    $rol = filter_input(INPUT_POST, 'rol');
    
    require '../../../clases/class_usuario.php';            
    
    
    $usuario = new usuario();    
    $usuario ->uinicializar($idusuario, NULL, NULL, NULL, NULL, $rol, NULL);
    $usuario ->get_rol_congreso();
    $es = $usuario -> get_usuarioxrolxcongreso();    
    if($es>0)
    {
        $bdd = new basedatos();
            $datos = $bdd->select("select a.id_tematica_fk, a.id_usuario_congreso_roles_fk from tbl_congreso_rol_tematicas a where 1=1 and a.id_usuario_congreso_roles_fk='".$es."'");
            $tematica=array();
        //    echo "select a.id_tematica_fk, a.id_usuario_congreso_roles_fk from tbl_congreso_rol_tematicas a where 1=1 and a.id_usuario_congreso_roles_fk='".$esrevisor."'"
            foreach ($datos as $valor) {
                array_push($tematica, $valor['id_tematica_fk']);

            }    
            $tematicas = json_encode($tematica);
            echo $tematicas;        
    }
    
}

function inscribir_rol_tematica()
{
    $idusuario = filter_input(INPUT_POST, 'idusuario');
    $tematica = filter_input(INPUT_POST, 'tematica');    
  
    $formato = 'Y-m-d';
    $fecha = date($formato);  
    $rol = filter_input(INPUT_POST, 'rol');
 
    require '../../../clases/class_usuario.php';            

    $usuario = new usuario();    
    $usuario ->uinicializar($idusuario, NULL, NULL, NULL, NULL, $rol, $tematica);
    $usuario ->get_rol_congreso();
    $esrevisor = $usuario -> get_usuarioxrolxcongreso();
    
    if($esrevisor == 0)
    {
        echo $ver = $usuario -> asignar_usuarioxrolxcongreso();
        if($ver != -1)
        {
            echo $esrevisor;
            $usuario ->asignar_tematica();
        }else{
            echo -1;
        }
    }else{
        echo $esrevisor;
        $usuario ->asignar_tematica();
    }
}
function aceptar_solicitud()
{
    $idsol = filter_input(INPUT_POST, 'idsol');
    $formato = 'Y-m-d';
    $fecha = date($formato);  
    require '../../../clases/class_base.php';
    require '../../../clases/class_solicitud.php';            

    $solicitud = new solicitud();    
    $solicitud ->sinicializar($idsol, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL,NULL,$fecha,NULL,NULL,NULL);
    echo $solicitud ->aceptar_solicitud();
}
function rechazar_solicitud()
{
    $idsol = filter_input(INPUT_POST, 'idsol');
    $formato = 'Y-m-d';
    $fecha = date($formato);  
    require '../../../clases/class_base.php';
    require '../../../clases/class_solicitud.php';            

    $solicitud = new solicitud();    
    $solicitud ->sinicializar($idsol, NULL, NULL, NULL, NULL, NULL, NULL,NULL, NULL,NULL,$fecha,NULL,NULL,NULL);
    echo $solicitud ->rechazar_solicitud();
}
