<?php

//global $bdd;
require '../clases/class_base.php';
session_start();
//print_r($_POST);
//print_r($_SESSION);
$funcion= filter_input(INPUT_GET,'caso');
switch ($funcion) {
    case 'datatbl_congresos':
        datatbl_congresos();
        break;
    case 'datatbl_lineas_investigacion':
        datatbl_lineas_investigacion();
        break;
    case 'ultima_linea':
        devolver_ultima_linea();
        break;
    case 'ultima_tematica':
        devolver_ultima_tematica();
        break;
    case 'linea_modificar':
        linea_modificar();
        break;
    case 'tematica_modificar':
        tematica_modificar();
        break;
    case 'datatbl_tematicas_investigacion':
        datatbl_tematicas_investigacion();
        break;
    case 'ultimo_congreso':
        ultimo_congreso();
        break;
    case 'datatbl_usuarios_para_administrador':
        datatbl_usuarios_para_administrador();
        break;
    case 'datatbl_idiomas':
        datatbl_idiomas();
        break;
    case 'datatbl_idiomas_traducciones':
        datatbl_idiomas_traducciones();
        break;
    case 'datatbl_solicitudes_traductores':
        datatbl_solicitudes_traductores();
        break;    
}
function datatbl_solicitudes_traductores() {
    require "../clases/class_solicitud.php";
    $obj = new solicitud();
    $json   =   $obj->json_sol_idioma();
    echo $json;
}


function datatbl_congresos() {
    require "../clases/clase_Congreso.php";
    $obj = new Congreso();
    
    /*-----------------------------------------*/
    require_once '../funciones/funcion_traducir.php';
        if((strlen(session_id()) < 1)) {
            session_start();
        }
        $congresos   =   $obj->mostrarCongresos(); 
       
        
        foreach ($congresos as $valor) {
             $estado            =   $valor['id_estado_congreso_fk'];
             $botones           =   "";
             $roles             =   ""; 
             $consulta_roles    =  $obj->mostrarRoles($valor['id_congreso_pk']);
             
             foreach ($consulta_roles as $value) {
                 $roles .= "<option value='".$value['id_rol_fk']."' id='".$value['id_rol_fk']."'>".$value['nombre_rol']."</option>";
             }
             switch($estado) {
                 case 1:
                     $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='inactivarcongreso btn btn-icon waves-effect waves-light btn-warning m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button class='cerrarcongreso btn btn-icon waves-effect waves-light btn-purple m-b-5' title='@@cerrar@@'><i class='md-view-agenda'></i></button>";
                     break;
                 case 2:
                     $botones   =   "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button><button class='eliminarcongreso btn btn-icon waves-effect waves-light btn-danger m-b-5 ' title='@@eliminar_congreso@@'><i class='fa fa-trash-o'></i></button>";
                     break;
                 case 3:
                     $botones   =   "<button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button>";
             }
             $botones = traducirstring($botones, "../idiomas/".$_SESSION['idioma']."/".$_SESSION['idioma'].".php");
              $arreglo["data"][] = array(
                  "id_congreso_pk"                    =>    $valor['id_congreso_pk'],
                  "nombre_congreso"                   =>    $valor['nombre_congreso']." (".$valor['siglas'].").",
                  "nombre"                            =>    $valor['nombre_congreso'],
                  "siglas"                            =>    $valor['siglas'],
                  "descripcion_congreso"              =>    $valor['descripcion_congreso'],
                  "lugar"                             =>    $valor['lugar'],
                  "coordenadas"                       =>    $valor['coordenadas'],
                  "nombre_estado"                     =>    $valor['nombre_estado'],
                  "id_pais_fk"                        =>    $valor['id_pais_fk'],
                  "logo_congreso"                     =>    $valor['logo_congreso'],
                  "lema"                              =>    $valor['lema'],
                  "numero_cai"                        =>    $valor['numero_cai'],
                  "anio"                              =>    $valor['anio'],
                  "fecha_inicio"                      =>    $valor['fecha_inicio'],
                  "fecha_finalizacion"                =>    $valor['fecha_finalizacion'],
                  "fecha_i_recepcion"                 =>    $valor['fecha_i_recepcion'],
                  "fecha_f_recepcion"                 =>    $valor['fecha_f_recepcion'],
                  "fecha_i_revision"                  =>    $valor['fecha_i_revision'],
                  "fecha_f_revision"                  =>    $valor['fecha_f_revision'],
                  "fecha_p_programa"                  =>    $valor['fecha_p_programa'],
                  "fecha_cambio_costo_inscripcion"    =>    $valor['fecha_cambio_costo_inscripcion'],
                  "id_estado_congreso_fk"             =>    $valor['id_estado_congreso_fk'],
                  "botones"                           =>    $botones,
                  "roles"                             =>    $roles
                );
        }
        
        
        
        if(   sizeof($arreglo)   ==   0   ) {
            return '{
               "sEcho": 1,
               "iTotalRecords": "0",
               "iTotalDisplayRecords": "0",
               "aaData": []
             }';
        }
        else {
            echo json_encode($arreglo);
        }   
    /*-----------------------------------------------------------*/
   
}

function datatbl_idiomas() {
    require "../clases/clase_Idioma.php";
    $obj = new Idioma();
    $json   =   $obj->json_idiomas();
    echo $json;
}

/*
ALEXIS ESCOTO 30-NOV-2022
DATATABLE
*/ 
function datatbl_lineas_investigacion() {
    require "../clases/class_lineainvestigacion.php";
    $obj = new Lineainvestigacion();

    require_once '../funciones/funcion_traducir.php';
    

    $id_congreso = filter_input(INPUT_GET, 'id_congreso');
    $lineas   =   $obj->mostrarLineasInvestigacion($id_congreso); 
    //echo $id_congreso;
               
    $arreglo = array();
    if($arreglo == 0) {
        echo '{
               "sEcho": 1,
               "iTotalRecords": "0",
               "iTotalDisplayRecords": "0",
               "aaData": []
             }';
    }
    else {
        foreach ($lineas as  $data) {
          $arreglo["data"][] = $data;
        }
       echo json_encode($arreglo);
    }
    
}
/*
ALEXIS ESCOTO 30-NOV-2022
DATATABLE
*/
function datatbl_tematicas_investigacion() {
    require "../clases/class_tematica.php";
    $obj = new Tematica();

    require_once '../funciones/funcion_traducir.php';
    


    $tematicas   =   $obj->mostrarTematicas(); 
    //echo $id_congreso;
    $arreglo = array();
    if($arreglo  == 0) {
        echo '{
               "sEcho": 1,
               "iTotalRecords": "0",
               "iTotalDisplayRecords": "0",
               "aaData": []
             }';
    }
    else {
        foreach ($tematicas as  $data) {
          $arreglo["data"][] = $data;
        }
       echo json_encode($arreglo);
    }
}

function devolver_ultima_linea() {
    global  $bdd;
    $bdd =  new basedatos();
    $datos = $bdd->select("SELECT  * FROM `tbl_linea_investigacion` WHERE 1=1 ORDER BY `id_linea_investigacion_pk` DESC LIMIT 1 ");
    foreach ($datos as  $data) {
        $arreglo["data"][] = $data;
    }
    echo json_encode($arreglo);
}

function linea_modificar() {
    global  $bdd;
    $bdd =  new basedatos();
    $id = filter_input(INPUT_POST, 'id');
    $datos = $bdd->select("SELECT  * FROM `tbl_linea_investigacion` WHERE id_linea_investigacion_pk =".$id);
    $arreglo = array();
    foreach ($datos as  $data) {
          $arreglo["data"][] = $data;
    }
       echo json_encode($arreglo);
}

function tematica_modificar() {
    global  $bdd;
    $bdd =  new basedatos();
    $id = filter_input(INPUT_POST, 'id');
    $datos = $bdd->select("SELECT a.id_tematica_pk, a.nombre_tematica, b.id_linea_investigacion_pk, b.nombre_linea_investigacion, a.abreviacion, a.descripcion_tematica, a.comentarios
                           FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                           WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                 b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                 c.id_congreso_pk = ".$_SESSION['idcongreso']." AND a.id_tematica_pk=".$id."");
    //$arreglo = array();
    foreach ($datos as  $data) {
          $arreglo["data"][] = $data;
    }
       echo json_encode($arreglo);
}

function devolver_ultima_tematica() {
    global  $bdd;
    $bdd =  new basedatos();
    $datos = $bdd->select("SELECT a.id_tematica_pk, a.nombre_tematica, b.id_linea_investigacion_pk, b.nombre_linea_investigacion, a.abreviacion, a.descripcion_tematica, a.comentarios
                           FROM tbl_tematica a, tbl_linea_investigacion b, tbl_congreso_linea_investigacion c
                           WHERE a.id_linea_investigacion_fk = b.id_linea_investigacion_pk AND
                                 b.id_linea_investigacion_pk = c.id_linea_investigacion_pk AND
                                 c.id_congreso_pk = ".$_SESSION['idcongreso']." ORDER BY `id_tematica_pk` DESC LIMIT 1 ");
    foreach ($datos as  $data) {
        $arreglo["data"][] = $data;
    }
    echo json_encode($arreglo);
}

function ultimo_congreso() {
    require "../clases/clase_Congreso.php";
    $congreso   =   new Congreso();
    echo $congreso->json_ultimo_congreso();
    
}

function datatbl_usuarios_para_administrador() {
    require "../clases/clase_Congreso.php";
    $idcongreso = filter_input(INPUT_POST, "id_congreso_pk");
    $obj = new Congreso();
    $obj->cinicializar3($idcongreso, $_SESSION['idusuario']);
    $json   =   $obj->json_usuarios_congreso();
    echo $json;
}

function datatbl_idiomas_traducciones() {
    require "../clases/clase_Idioma.php";
    $obj = new Idioma();
    $obj->iinicializar2($_SESSION['idusuario']);
    $json   =   $obj->json_idiomas_traducciones();
    echo $json;
}
?>
