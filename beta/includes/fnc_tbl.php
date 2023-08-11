<?php

/* * ----Archivo con funciones para llenar dinamicamente las tablas de una página----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */

require '../clases/class_base.php';
require '../funciones/funcion_traducir.php';
session_start();
switch ($_POST['funcion']) {

    case 'tbl_certificados':   //OBED
        tbl_certificados();
        break;
    case 'tbl_idioma':
        tbl_idioma();
        break;
    case 'tbl_trabajos_subidos':
        tbl_trabajos_subidos();
        break;
    case 'tbl_congresos':
        tbl_congresos();
        break;
    case 'tbl_lineas_investigacion':
        tbl_lineas_investigacion();
        break;    
    case 'tbl_form_tem':
        tbl_form_tem();
        break;
     case 'tbl_trabajos_subidos_eg':
        tbl_trabajos_subidos_eg();
        break;
    case 'tbl_trabajos_ep' :
        tbl_trabajos_ep();
        break;
    case 'tbl_trabajos_subidos_egxtem':   //OBED
        tbl_trabajos_subidos_egxtem();
        break;
    
    case 'tbl_revisiones' :
        tbl_revisiones();
        break;
        
     case 'tbl_dictaminar_trabajos_ep':   //OBED
        tbl_dictaminar_trabajos_ep();
        break;
    
    case 'info_trabajo':
        info_trabajo();
        break;
    
    case 'tabajos_aceptados':
        tabajos_aceptados();
        break;
    
    case 'tbl_asis_programa':
        tbl_asis_programa();
        break;
    
    case 'tbl_trabajos_epseccion':
        tbl_trabajos_epseccion();
        break;
    
    case 'tbl_dictaminar_trabajos_eps':
        tbl_dictaminar_trabajos_eps();
        break;
    
    case 'tbl_trabajos_ess':
        tbl_trabajos_ess();
        break;
    case'tbl_espacios':
        tbl_espacios();
        break;
    
    case 'tbl_editar_form':
        tbl_editar_form();
        break;
    
    case'tbl_actividades':
        tbl_actividades();
        break;
    
    case 'tbl_asis_c_itineraio':
        tbl_asis_c_itineraio();
        break;
    
    case 'tbl_asis_modifcar_itineraio':
        tbl_asis_modifcar_itineraio();
        break;
    
    case 'tbl_listas_actividades':
        tbl_listas_actividades();
        break;
    
    case 'tbl_solicitudes_voluntarios':
        tbl_solicitudes_voluntarios();
        break;
    
    case 'tbl_inscribir_voluntario':
        tbl_inscribir_voluntario();
        break;
    
    case 'tbl_actividades_voluntarios';
        tbl_actividades_voluntarios();
        break;
    
    case 'tbl_validacion_voluntario';
        tbl_validacion_voluntario();
        break;
    
    case 'tbl_act_asignada_voluntarios' ;
        tbl_act_asignada_voluntarios();
        break;
    
    case 'tbl_asis_persona';
        tbl_asis_persona();
        break;
    
    case 'tbl_itinerario_persona';
        tbl_itinerario_persona();
        break;
    
    case'tbl_asis_autores';
        tbl_asis_autores();
        break;
    
    case'tbl_validar_pagos';
        tbl_validar_pagos();
        break;
    
    case 'tbl_tours';
        tbl_tours();
        break;
    
    case 'tbl_articulos';
        tbl_articulos();
        break;
    
    case 'tbl_info_factura':
        tbl_info_factura();
        break;
    case 'tbl_idiomas_traduccion':
        tbl_idiomas_traduccion();
        break;
    case 'tbl_respaldos_idioma':
        tbl_respaldos_idioma();
        break;
    case 'tbl_distribuciontematica':
        tbl_distribuciontematica();
        break;
    case 'tbl_tematica':
        tbl_tematica();
        break;
    
    case 'tbl_premio_a_trabajo':
        tbl_premio_a_trabajo();
        break;
    case 'tbl_movertrabajos_sp':
        tbl_movertrabajos_sp();
        break;
    case 'tbl_programa_creado':
        tbl_programa_creado();
        break;
    
}
function tbl_tematica() {

    global $bdd;
    $bdd = new basedatos();
    $rol = filter_input(INPUT_POST, 'rol');
    $datos=$bdd->select('select * from tbl_tematica order by nombre_tematica'); 
    
    $idusuario = filter_input(INPUT_POST, 'idusuario');
    $html="";
    
    foreach ($datos as $fila) {
        $html.="<tr>"
                . "<td align='center'>".$fila['nombre_tematica']."</td>"
                . "<td align='center' id='".$fila['id_tematica_pk']."'><a  href='#'  class='on-default edit-row' title='@@interesesd@@' onclick='inscribir_tematica(".$fila['id_tematica_pk'].",".$idusuario.",".$rol.");' ><i class='glyphicon glyphicon-ok'></i></a></td>";
    }

    echo $html;
    
}
function tbl_idioma() {
    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("select * from tbl_idioma where id_estado_idioma_fk = 1");
    $html = "<tbody>";

    foreach ($datos as $fila) {
        $lenguaje = "'" . $fila['id_idioma_pk'] . "'";
        $html .= "<tr>"
                . "<td align='center'>"
                . "<a href='javascript:;' onclick=inicializar_var_session($lenguaje) class='btn btn-success m-r-5'><img src='./img/banderas/" . $fila['bandera'] . ".ico' /> </a>"
                . "</td>"
                . "</tr>";
    }
    $html .= "</tbody>";
    echo $html;
}
/*

function tbl_certificados() {  //OBED
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_certificados');
    $html = "<tbody>";
    foreach ($datos as $fila) {
        $html .= "<tr class='gradeX'  id='" . $fila['id_certificado_pk'] . "'>
               <td>" . $fila['nombre_certificado'] . "</td>
               <td>" . $fila['motivo_certificado'] . "</td>
                 <td class='actions'  align='right'>
                    <a href='#' class='on-default edit-row' onclick='modificar_certificado(" . $fila['id_certificado_pk'] . ");' ><i class='fa fa-pencil'></i></a>
                    <a href='#' class='on-default remove-row' onclick='eliminar_certificado(" . $fila['id_certificado_pk'] . ");'><i class='fa fa-trash-o'></i></a>
                </td></tr>";
    }
    $html .= "</tbody>";
    echo $html;
}
*/
/*ALEXIS ESCOTO DATATABLE */
function tbl_certificados() {  //OBED
    require "../clases/class_certificados.php";
    $obj = new certificados();
    $certificados   =   $obj->mostrarCertificado(); 
    $html = "<tbody>";
    
    foreach ($certificados as $fila) {
        $html .= "<tr class='gradeX'  id='" . $fila['id_certificado_pk'] . "'>
               <td>" . $fila['nombre_certificado'] . "</td>
               <td>" . $fila['motivo_certificado'] . "</td>
                 <td class='actions'  align='right'>
                    <a href='#' class='on-default edit-row' onclick='modificar_certificado(" . $fila['id_certificado_pk'] . ");' ><i class='fa fa-pencil'></i></a>
                    <a href='#' class='on-default remove-row' onclick='eliminar_certificado(" . $fila['id_certificado_pk'] . ");'><i class='fa fa-trash-o'></i></a>
                </td></tr> "
                ;
    }
    $html .= "</tbody>";
    
    echo $html;
}






function tbl_usuario() {

    global $conectID;
    $html = "<tbody>";
    $sql_user = "select * from tusuario a, ttipousuario b
                where a.ttipousuario_codtu=b.codtu";
    $qry_user = mysqli_query($conectID, $sql_user);
    $i = 0;
    while ($arr_user = mysqli_fetch_array($qry_user)) {
        $i++;
        $html .= "<tr><td>" . $i . "</td><td>" . $arr_user['nombreusuario'] . "</td><td>" . $arr_user['nombretu'] . "</td><td><a href='javascript:;' onclick='mod_nusuario(" . $arr_user['codusuario'] . ")' class='btn btn-success m-r-5'><i class='fa fa-pencil-square-o'></i> Editar</a></td></tr>";
    }
    $html .= "</tbody>";
    echo $html;
}

function tbl_tusuario() {
    global $conectID;
    $html = "<tbody>";
    $sql_tuser = "select * from ttipousuario";
    $qry_tuser = mysqli_query($conectID, $sql_tuser);
    $i = 0;
    while ($arr_tuser = mysqli_fetch_array($qry_tuser)) {
        $i++;
        $html .= "<tr><td>" . $i . "</td><td>" . $arr_tuser['nombretu'] . "</td><td><a href='javascript:;' onclick='mod_tusuario(" . $arr_tuser['codtu'] . ")' class='btn btn-success m-r-5'><i class='fa fa-pencil-square-o'></i> Editar</a></td></tr>";
    }
    $html .= "</tbody>";
    echo $html;
}


function tbl_trabajos_subidos() {
    require "../clases/class_trabajos.php";
    $obj = new trabajo();
    
    $idusuario = $_SESSION['idusuario'];  
    $nusuario = $_SESSION['nusuario'];   
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso = $_SESSION['idcongreso'];
    $rolescongreso = $_SESSION['roles'];
    $datos =  $obj->tbl_trabajos_subidos($idusuario); 
    $html = "<tbody >";
     $t = 1;
    foreach ($datos as $fila) {
        $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center'>".$t."</td>
                <td align='justify'>" . $fila['titulo_trabajo'] . "</td>
                <td align='justify'>" . $fila['resumenprograma'] . "</td>
                <td align='center'>" . $fila['fecha_subida'] . "</td>
                <td align='center'>" . $fila['nombre_tipo_trabajo'] . "</td>
                <td align='center'>" . $_SESSION['idioma'] . "</td>
                <td align='center'>" . $fila['estado'] . "</td>
                <td class='actions'  align='center'>";
                
                    if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/'.$fila['ubicacion_archivo'])){
                        $html .= "<td ><div class='checkbox checkbox-success checkbox-circle'><input id='checkbox-10' type='checkbox' checked disabled><label for='checkbox-10'><strong>@@subido@@</strong></label></div></td>
                                <td style='background-color: #dae6ec;' > <a href='#' class='on-default edit-row' title='@@cambiar_documento@@' onclick='cambiadoc(" . $fila['id_trabajo_pk'] . ");' ><i class=' md-cloud-upload' ></i></a></td>                        
                       <td > <a  href='#'  class='on-default edit-row' title='@@agregar_autor@@' onclick=agregarautor('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['numero_maximo_autores']."');><i class='md-person' ></i></a></td>
                       <td style='background-color: #dae6ec;' > <a  href='#'  class='on-default edit-row' title='@@ver_revisiones@@' onclick=verrevisiones('".$fila['id_trabajo_pk']."','".$fila['id_tematica_fk']."');><i class='md-view-list' ></i></a></td>
                  /*onclick=verrevisiones('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."');*/    
                       <td ><a  href='#'  class='on-default edit-row' title='@@infopostrev@@' onclick='cambiadocrev(".$fila['id_trabajo_pk'].");' ><i class=' md-open-in-browser' ></i></a> </td>                       
                  /*onclick='cambiadocrev(".$fila['id_trabajo_pk'].");'*/";
                        $html.="<td style='background-color: #dae6ec;' align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' ><i class= 'md-file-download' ></i></a></td>";     
                    }else{
                        $html .= "<td ><div class='checkbox checkbox-danger checkbox-circle'><input id='checkbox-11' type='checkbox' checked disabled><label for='checkbox-11'><strong>@@malsubido@@</strong></label></div></td>
                                 <td class='alert alert-danger' style='background-color: #dae6ec;' > <a href='#' class='on-default edit-row' title='@@cambiar_documento@@' onclick='cambiadoc(" . $fila['id_trabajo_pk'] . ");' ><i class= 'md-cloud-upload' ></i></a></td>                        
                       <td > <a  href='#'  class='on-default edit-row' title='@@agregar_autor@@' onclick=agregarautor('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['numero_maximo_autores']."');><i class= 'md-person' ></i></a></td>
                       <td  style='background-color: #dae6ec;' > <a  href='#'  class='on-default edit-row' title='@@ver_revisiones@@' onclick='avisonoexiste();'><i class= 'md-view-list' ></i></a></td>
                       <td ><a  href='#'  class='on-default edit-row' title='@@infopostrev@@' onclick='avisonoexiste()');' ><i class='md-open-in-browser' ></i></a> </td>";     
                        $html.="<td style='background-color: #dae6ec;' align='center' ><a href='#' class='on-default edit-row' title='@@verdocoriginal@@' onclick='avisonoexiste();' ><i class= 'md-file-download' ></i></a></td>";     
                    }
                       
                    $html.="<td ><a  href='#'  class='on-default edit-row' title='@@aceptarhorario@@' onclick='aceptarhorario(".$fila['id_trabajo_pk'].");' ><i class='md-access-time' ></i></a> </td> 
                        <td style='background-color: #dae6ec;'><a  href='#'  class='on-default edit-row' title='@@eliminartrabajo@@' onclick='eliminatrabajo(".$fila['id_trabajo_pk'].");' ><i class=' md-highlight-remove' ></i></a></td>
                          
                </td></tr>";
       $t+=1;
    }
    $html .= "<tr class='alert alert-success'><td align='left' colspan='16'><p class='text-success'><strong>@@ntrabajos@@:   ".($t-1)."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function tbl_lineas_investigacion() {
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_linea_investigacion where 1 = 1');
    $html = "<tbody >";
    foreach ($datos as $fila) {
        $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='justify'>" . $fila['titulo_trabajo'] . "</td>
                <td align='justify'>" . $fila['resumenprograma'] . "</td>
                <td align='center'>" . $fila['fecha_subida'] . "</td>
                <td align='center'>" . $fila['nombre_tipo_trabajo'] . "</td>
                <td align='center'>" . $_SESSION['idioma'] . "</td>
                <td align='center'>" . $fila['estado'] . "</td>
                <td class='actions'  align='center'>
                    <a href='#' class='on-default edit-row' title='@@cambiar_documento@@' onclick='cambiadoc(" . $fila['id_trabajo_pk'] . ");' ><i class='fa fa-pencil'></i></a>                    
                </td></tr>";
    }
    $html .= "</tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}


function tbl_congresos() {
    global  $bdd;
    $bdd =  new basedatos();
    $datos = $bdd->select("SELECT * FROM tbl_congreso where 1 = 1");
    $html = "<tbody>";
    foreach ($datos as $clave => $valor) {
        $arreglo["data"][] = $datos;
        /*$html.="<tr class='gradeA'>
                    <td>".$valor['nombre_congreso']."</td>
                    <td>".$valor['siglas']."</td>
                    <td>".$valor['anio']."</td>
                    <td class='actions'>
                        <a href='#' class='hidden on-editing save-row'><i class='fa fa-save'></i></a>
                        <a href='#' class='hidden on-editing cancel-row'><i class='fa fa-times'></i></a>
                        <a href='#' class='on-default edit-row'><i class='fa fa-pencil'></i></a>
                        <a href='#' class='on-default remove-row'><i class='fa fa-trash-o'></i></a>
                    </td>
                </tr>";*/
    }
    $html .= "</tbody>";
    echo json_encode($arreglo);
}
/*Alexis Escoto
26/12/2022 */
function tbl_trabajos_subidos_eg(){
//    print_r($_POST);
//    print_r($_SESSION);and  e.id_tematica_pk="'.$idtem.'"

require "../clases/class_trabajos.php";
$obj = new trabajo();

    $idusuario = $_SESSION['idusuario'];  
    $nusuario = $_SESSION['nusuario'];   
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso = $_SESSION['idcongreso'];
    $rolescongreso = $_SESSION['roles'];
    $datos = $obj->mostrar_trabajos_subidos_eg($idcongreso);
    $html = "<tbody >";
    $t = 1;
    $confirmados = 0;
    $noconfirmados = 0;
    foreach ($datos as $fila) {
        $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center'>".$t."</td>
                <td align='justify'>" . $fila['titulo_trabajo'] . "</td>   
                <td align='center'>" . $fila['nombre_tipo_trabajo'] . "</td>
                <td align='center'>" . $_SESSION['idioma'] . "</td>
                    <td align='center' class='text-success'><b>" . $fila['estado'] . "</b></td>";
                    $cnt = 0;
                    $autoria = $obj->mostrar_trabajos($fila);
                    foreach ($autoria as $val) {
                        if($val['autoria'] == 0){
                            $cnt += 1;
                        }
                    }
                    if($cnt > 0){                        
                        $html.="<td align='center' ><span id='checkbox".$fila['id_trabajo_pk']."' style='cursor:pointer; -webkit-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);-moz-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);' title='@@trecordar_autores@@' class='label label-danger' onclick='rconfirmarautoria(".$fila['id_trabajo_pk'].");'>@@recordar_autores@@</span></td>";
                        $noconfirmados +=1;
                        
                    }else{
                         $html.="<td align='center' ><p class='text-success'><strong>@@yaconfirmada@@!</strong></p></td>";
                         $confirmados +=1;
                         
                    }
                
                $html.="<td class='actions'  align='center'> ";
                    /*TRABAJO original*/
                    if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/'.$fila['ubicacion_archivo'])){
                        $html.="<td style='background-color: #dae6ec;' align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' ><i class=' md-file-download'></i></a></td>";     //se cambio el boton
                    }else{
                        $html.="<td style='background-color: #dae6ec;' align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' onclick='avisonoexiste();' ><i class=' md-file-download'></i></a></td>";     
                    }
                    /*TRABAJOS EN REVISION*/
                    if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/Revisiones/'.$fila['ubicacion_archivo'])){
                        $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/Revisiones/".$fila['ubicacion_archivo']."' ><i class=' md-mode-edit'></i></a></td>";     //se cambio el boton
                        $html.="<td align='center' style='background-color: #dae6ec;'><a  href='#'  class='on-default edit-row' title='@@cambiar_documento@@' onclick='cambiadocrev(".$fila['id_trabajo_pk'].");' ><i class='md-cloud-upload'></i></a> </td>";//se cambio el boton
                    }else{
                        $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' onclick='avisoarchivo();' ><i class=' md-mode-edit'></i></a></td>";     //se cambio el boton
                        $html.="<td align='center' style='background-color: #dae6ec;'><a  href='#'  class='on-default edit-row' title='@@cambiar_documento@@' onclick='avisoarchivo();' ><i class='md-cloud-upload'></i></a> </td>"; //se cambio el boton
                    }                  
                    
                    
                    $html.="<td  align='center'> <a href='#' id='btnaceptartrabajo' class='on-default edit-row' title='@@aceptar_documento@@' onclick=aceptartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['ubicacion_archivo']."'); > <i class='md-done'></i></a></td>                        
                    <td align='center' style='background-color: #dae6ec;'><a  href='#' id='btnrechazartrabajo' class='on-default edit-row' title='@@rechazar_documento@@' onclick=rechazartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['ubicacion_archivo']."'); > <i class='md-highlight-remove'></i></a> </td> 
                          
                </td></tr>";
      $t+=1;
    }
    $html .= "<tr class='alert alert-success'><td align='left' colspan='2'><p class='text-success'><strong>@@ntrabajos@@:   ".($t-1)."</strong></p></td><td align='left' colspan='3'><p class='text-success'><strong>@@yaconfirmados@@:   ".$confirmados."</strong></p></td><td align='left' colspan='7'><p class='text-success'><strong>@@noconfirmados@@:   ".$noconfirmados."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*ALEXIS ESCOTO  06/12/2022
Instancia que viene de la class_formulario funcion mostrar_form_asosiar y funcion mostrar_editar_form_revision 
FALTA REVISAR LOS BOTONES DE LAS ACCIONES*/
function tbl_form_tem(){
   require "../clases/class_formulario.php";
   $obj = new formulario();
   $mostrar_asociar = $obj->mostrar_form_asosiar();
 
    $html = "<tbody >";
    $totaltrabajos = 0 ;
    foreach ($mostrar_asociar as $fila) {
       $totaltrabajos++ ;
       $idform = $fila['id_formulario_pk'] ;
       $nombre = $fila['nombre_formulario'];
       $descripcion = $fila['descripcion'];
      
      
       $tematicaxformulario =   $obj->mostrar_editar_form_revision($fila['id_formulario_pk']);  
        $tem_asociada = "";
        $idtematica ="";
        $contar = $tematicaxformulario;
        if ($contar == 0){
            $tem_asociada = "No tiene temática asocida" ;
        }
       
        foreach ($tematicaxformulario as $valor) {    
               $tem_asociada .=  "<li>". $valor['nombre_tematica']."</li>"; 
               $idtematica .= $valor['id_tematica_pk']. "<>";
        }
       
       
       $html .= "<tr class='gradeA'   id='".$idform."'>
                <td align='justify'>".$totaltrabajos."</td>
                <td align='justify'>".$nombre."</td>
                <td align='justify'>".$descripcion."</td>
                <td align='justify'>".$tem_asociada."</td>
                <input type='hidden'  id=bracho".$idform." value= '".$idtematica."'>
               " ;
       
 
       $html .= "<td class='actions ' align='center'>
                    <a  href='#' class='btn btn-primary waves-effect waves-light m-b-5' title='@@asignar_tematica@@'  onclick='asociar_tematica(".$idform." );' ><i class='fa fa-sliders'></i></a>
                    </td></tr>";
    }

    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@totalform@@:   ".$totaltrabajos."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

/* 
ALEXIS ESCOTO
09-01-2023 */
function tbl_trabajos_ep(){
    require "../clases/class_trabajos.php";
    $idcongreso = $_SESSION['idcongreso'];
    
    $obj = new trabajo();
    $datos = $obj->mostrar_tbl_trabajos_ep($idcongreso);   
    $html = "<tbody >";
    //$totaltrabajos = $datos->num_rows; 
    $totaltrabajos = $datos;
    $num = 1 ;
    foreach ($datos as $fila) {
       $idtrabajo   = $fila['id_trabajo_pk'] ;
       $titulo      = $fila['titulo_trabajo'];
       $palabras    = explode(",", $fila['palabrasclave']);
       $tipotrabajo = $fila['nombre_tipo_trabajo'];
       $idtematica  = $fila['id_tematica_fk'];
       $tematica  = $fila['nombre_tematica'];
       $words = "" ;
      
       for($i=0; $i<count($palabras); $i++ ){
           $words .= "<li>" . $palabras[$i] ."</li>"  ;
       }
       
       $revisoresxtrabajo = $obj->mostrar_tbl_asignacion_a_revisor($idtrabajo);
        $revisorxtrabajo = "";
        $accio =  "" ;
        $idrevisres = "" ;
        $revisorxtrabajop = " ";
        $idrevisresp= "";
        //$contar = $revisoresxtrabajo->num_rows;
        $contar = $revisoresxtrabajo->fetch(PDO::FETCH_ASSOC);
        if ($contar == 0){
            $revisorxtrabajo = "No tiene revisores asignados" ;
            $revisorxtrabajop = "No tiene revisores asignados";
            $idrevisres = "9999". "." ;
        }else{
           
             
        }
        foreach ($revisoresxtrabajo as $valor){  
            
            
            if($valor['pendiente_aceptacion']== 0){
               $revisorxtrabajop .=   "<li>" .$valor['primer_nombre']. " " .$valor['primer_apellido'].  "<br>". "</li>"; 
               $idrevisres .=  $valor['id_usuario_que_recibe']. "," ;
            }else{
              $revisorxtrabajo .= "<li>".  $valor['primer_nombre']. " ".$valor['primer_apellido'].  "<br>"."</li>"; 
               $idrevisres .=  $valor['id_usuario_que_recibe']. "," ; 
               
            }
        }
       $rest = substr($idrevisres, 0, -1);  //
       $resvi_traba = $idtrabajo . "," . $rest. ",". $idtematica ;
       if ($contar == 0){
        }else{
            $accio = "<td style='background-color: #dae6ec;' align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@cancelar_solicitud@@' onclick='cancelarsolicitud(".$resvi_traba.");' > <i class='fa fa-times'></i></a> </td>";
             
        }
        $html .= "<tr class='gradeA' id='tematica".$idtematica."'  name=tematica".$idtematica." value=".$idtematica." >
                <td align='justify'>".$num."</td>
                <td align='justify'>".$titulo."</td>
                <td align='justify'>".$words."</td>
                <td align='justify'>".$tipotrabajo."</td>
                <td align='justify' id=revisores".$idrevisres." >".$revisorxtrabajo."</td>
                <td align='justify'id=pendiente".$idtrabajo." >".$revisorxtrabajop."</td>
                <input type='hidden' id=tem".$idtematica." value= '".$idtematica."'>
               " ;
        $html.="<td align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@asignar_revisores@@' onclick='asignarrevisores( ".$resvi_traba." );' ><i class='fa fa-users'></i></a> </td>                          
                ".$accio."                  
                </td></tr>";
         $num++;
    }

    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@ntrabajos@@:   ".$num."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}


function tbl_trabajos_subidos_egxtem(){
    //print_r($_POST);
//    print_r($_SESSION);
    global $bdd;
    $bdd = new basedatos();
    $id_tem = filter_input(INPUT_POST, 'id_tem');
    $idusuario = $_SESSION['idusuario'];  
    $nusuario = $_SESSION['nusuario'];   
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso = $_SESSION['idcongreso'];
    $rolescongreso = $_SESSION['roles'];
    $datos = $bdd->select('select id_trabajo_pk,titulo_trabajo,ubicacion_archivo,nombre_tipo_trabajo,estado,id_tipo_trabajo_fk, id_congreso_pk, id_linea_investigacion_pk, id_tematica_pk, nombre_tematica  from tbl_trabajo a, tbl_tipo_trabajo b, tbl_estado c, tbl_congreso_linea_investigacion d, tbl_tematica e  where a.id_tipo_trabajo_fk=b.id_tipo_trabajo_pk and a.id_estado_fk=c.id_estado_pk and  d.id_linea_investigacion_pk=e.id_linea_investigacion_fk and a.id_tematica_fk=e.id_tematica_pk and c.id_estado_pk <> 2 and a.id_tematica_fk="'.$id_tem.'" and d.id_congreso_pk="'.$idcongreso.'" ');
    $html = "<tbody >";
    $t = 1;
    $confirmados = 0;
    $noconfirmados = 0;
    if($datos != ""){
        foreach ($datos as $fila) {
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                        <td align='center'>".$t."</td>
                        <td align='justify'>" . $fila['titulo_trabajo'] . "</td>   
                        <td align='center'>" . $fila['nombre_tipo_trabajo'] . "</td>
                        <td align='center'>" . $_SESSION['idioma'] . "</td>
                            <td align='center' class='text-success'><b>" . $fila['estado'] . "</b></td>";
                            $cnt = 0;
                            $autoria = $bdd->select("select * from tbl_usuario_trabajo where id_trabajo_fk='".$fila['id_trabajo_pk']."'");
                            foreach ($autoria as $val) {
                                if($val['autoria'] == 0){
                                    $cnt += 1;
                                }
                            }
                            if($cnt > 0){                        
                                $html.="<td align='center' ><span id='checkbox".$fila['id_trabajo_pk']."' style='cursor:pointer; -webkit-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);-moz-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);' title='@@trecordar_autores@@' class='label label-danger' onclick='rconfirmarautoria(".$fila['id_trabajo_pk'].");'>@@recordar_autores@@</span></td>";
                                $noconfirmados +=1;

                            }else{
                                 $html.="<td align='center' ><p class='text-success'><strong>@@yaconfirmada@@!</strong></p></td>";
                                 $confirmados +=1;

                            }

                        $html.="<td class='actions'  align='center'> ";
                            /*TRABAJO original*/
                            if($fila['ubicacion_archivo'] != 0){
                                $html.="<td style='background-color: #dae6ec;' align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' ><i class='glyphicon glyphicon-download-alt'></i></a></td>";     
                            }else{
                                $html.="<td style='background-color: #dae6ec;' align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' onclick='avisoarchivo();' ><i class='glyphicon glyphicon-download-alt'></i></a></td>";     
                            }
                            /*TRABAJOS EN REVISION*/
                            if($fila['ubicacion_archivo'] != 0){
                                $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/Revisiones/".$fila['ubicacion_archivo']."' ><i class='glyphicon glyphicon-edit'></i></a></td>";     
                            }else{
                                $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' onclick='avisoarchivo();' ><i class='glyphicon glyphicon-edit'></i></a></td>";     
                            }  
                            $html.="<td align='center' style='background-color: #dae6ec;'><a  href='#'  class='on-default edit-row' title='@@cambiar_documento@@' onclick='cambiadocrev(".$fila['id_trabajo_pk'].");' ><i class='glyphicon glyphicon-cloud-upload'></i></a> </td>                          
                            <td  align='center'> <a href='#' id='btnaceptartrabajo' class='on-default edit-row' title='@@aceptar_documento@@' onclick=aceptartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['ubicacion_archivo']."'); > <i class='glyphicon glyphicon-ok'></i></a></td>                        
                            <td align='center' style='background-color: #dae6ec;'><a  href='#' id='btnrechazartrabajo' class='on-default edit-row' title='@@rechazar_documento@@' onclick=rechazartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['ubicacion_archivo']."'); > <i class='glyphicon glyphicon-remove'></i></a> </td>

                        </td></tr>";
              $t+=1;
            }
            $html .= "<tr class='alert alert-success'><td align='left' colspan='2'><p class='text-success'><strong>@@ntrabajos@@:   ".($t-1)."</strong></p></td><td align='left' colspan='3'><p class='text-success'><strong>@@yaconfirmados@@:   ".$confirmados."</strong></p></td><td align='left' colspan='7'><p class='text-success'><strong>@@noconfirmados@@:   ".$noconfirmados."</strong></p></td></tr></tbody>";
            $html1 = traducirstring($html, '../idiomas/es/es.php');
            echo $html1;
    }else{
        echo '2';
    }
    
}

/*Alexis Escoto
10-01-2023
 */
function tbl_dictaminar_trabajos_ep(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();

    $idusuario = $_SESSION['idusuario'];  
    $nusuario = $_SESSION['nusuario'];   
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso = $_SESSION['idcongreso'];
    $rolescongreso = $_SESSION['roles'];
    $datos = $obj->mostrar_tbl_dictaminar_trabajos_ep($idcongreso);
    $html = "<tbody >";
    $t = 1;
    
    $confirmados = 0;
    $noconfirmados = 0;
    
    
    foreach ($datos as $fila){
        $text = " ";
        $idtrabajo=  $fila['id_trabajo_pk']; 
        $datos1 = $obj->dictamen_tbl_asignacion_a_revisor($idtrabajo);
        $contar = $datos1->fetch(PDO::FETCH_ASSOC); 
        $sinconfirmar = 0;
        $aceptado = 0;
        $lleno = 0 ;
        $sinllenar = 0;
        
        foreach ($datos1 as $fila1){ 
        if($fila1['aceptado'] == 1){
            $datos2 = $obj->dictamen_tbl_revisiones_trabajo($fila1);
            $llenoelform = $datos2->fetch(PDO::FETCH_ASSOC);
                if($llenoelform > 0){
                    $lleno +=1 ; 
                }else{
                    $sinllenar +=1 ;
                }
        $aceptado +=1 ; 
        }else if($fila1['pendiente_aceptacion'] == 0){
            $sinconfirmar = 50 ;
            } 
        }
        if(($aceptado > $sinconfirmar) && ($lleno>$sinllenar) && ($sinllenar==0)){
                $text = "@@r_completa@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center'>".$fila['id_trabajo_pk']."</td>
                <td align='justify'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='justify'><b>" .$fila['nombre_tematica'] . "</b></td>
                <td align='center'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-success'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> ";  
            }else if(($aceptado > $sinconfirmar) && ($lleno<=$sinllenar)  && ($lleno !=0)){
                $text = "@@r_incompleta1@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-primary' >".$fila['id_trabajo_pk']."</td>
                <td align='justify'class='text-primary'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='justify'class='text-primary'><b>" .$fila['nombre_tematica'] . "</b></td>
                <td align='center' class='text-primary'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-primary'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-primary'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> 
                ";
            }else if(($aceptado > $sinconfirmar) && ($lleno<$sinllenar) && ($aceptado !=0)  ){
                $text = "@@r_incompleta2@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-warning' > ".$fila['id_trabajo_pk']."</td>
                <td align='justify' class='text-warning'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='justify' class='text-warning'><b>" .$fila['nombre_tematica'] . "</b></td>
                <td align='center' class='text-warning'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-warning'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-warning'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> "; 
            }else if(($contar !=0) && ($sinconfirmar >0)){
                $text = "@@asignado@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-muted' > ".$fila['id_trabajo_pk']."</td>
                <td align='justify' class='text-muted'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='justify' class='text-muted'><b>" .$fila['nombre_tematica'] . "</b></td>
                <td align='center' class='text-muted'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-muted'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-muted'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> "; 
                
            }else{
                $text = "@@sin_asignado@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-danger'>".$fila['id_trabajo_pk']."</td>
                <td align='justify' class='text-danger'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='justify' class='text-danger'><b>" .$fila['nombre_tematica'] . "</b></td>
                <td align='center' class='text-danger'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-danger'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-danger'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> ";  
            }

            /*TRABAJO*/
                    $html.="<td  align='center' style='background-color: #dae6ec;' ><a class='on-default edit-row' style='cursor:pointer;' title='@@verinfotrabajo@@' onclick=inftrabajo('".$fila['id_trabajo_pk']."'); ><i class='fa fa-info-circle'></i></a></td>";       //glyphicon glyphicon-info-sign
                    if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/'.$fila['ubicacion_archivo'])){
                         /*Informacion del trabajo*/
                    /*2*/    $html.="<td align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' ><i class='fa fa-download'></i></a></td>";     //glyphicon glyphicon-download-alt
                    }else{
                    /*2 */ $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' onclick='avisonoexiste();' ><i class='fa fa-download'></i></a></td>";     
                    }
                    if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/Revisiones/'.$fila['ubicacion_archivo'])){
                         /*Informacion del trabajo*/
                    /*2*/    $html.="<td align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/Revisiones/".$fila['ubicacion_archivo']."' ><i class='fa fa-cloud-download'></i></a></td>";     
                    }else{
                    /*2 */ $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' onclick='avisonoexiste();' ><i class='fa fa-cloud-download'></i></a></td>";     
                    }
                   
                   /*$html.=" <td align='center' style='background-color: #dae6ec;'><a  href='#' id='btnrechazartrabajo' class='on-default edit-row' title='@@rechazar_documento@@' onclick=rechazartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['ubicacion_archivo']."'); > <i class='glyphicon glyphicon-remove'></i></a> </td>";
                       $html.="<td  align='center' style='background-color: #dae6ec;' ><a class='on-default edit-row' style='cursor:pointer;' title='@@verinfotrabajo@@' onclick=inftrabajo('".$fila['id_trabajo_pk']."'); ><i class='glyphicon glyphicon-info-sign'></i></a></td>";     
                       $html.="<td align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' ><i class='glyphicon glyphicon-download-alt'></i></a></td>";     
                       $html.="<td align='center' ><a class='on-default edit-row' title='@@verdoccorrec@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/Revisiones/".$fila['ubicacion_archivo']."' ><i class='glyphicon glyphicon-download-alt'></i></a></td>";     
                       $html.="<td  align='center' style='background-color: #dae6ec;'> <a href='#' id='btndictaminatrab' class='on-default edit-row' title='@@dictaminatrab@@' onclick=dictaminartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tematica_pk']."'); > <i class='glyphicon glyphicon-edit'></i></a></td>";                             */
                    $html.="<td  align='center' style='background-color: #dae6ec;'> <a href='#' id='btndictaminatrab' class='on-default edit-row' title='@@dictaminatrab@@' onclick=dictaminartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tematica_pk']."'); > <i class='fa fa-pencil-square-o'></i></a></td>";
                $html.="</td></tr><input type='hidden' id='titulo$idtrabajo' name='titulo$idtrabajo' value='".$fila['titulo_trabajo']."'>
                    <input type='hidden' id='tipo$idtrabajo' name='tipo$idtrabajo' value='".$fila['id_tipo_trabajo_fk']."'>
                    <input type='hidden' id='ubicacion$idtrabajo' name='ubicacion$idtrabajo' value='".$fila['ubicacion_archivo']."'>
                    ";
      $t+=1;
    }
    $html .= "<tr class='alert alert-success'><td align='left' colspan='11'><p class='text-success'><strong>@@ntrabajos@@:   ".($t-1)."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*Alexis Escoto
10-01-2023
 */
function tbl_revisiones(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();
    $idrol = $_SESSION['idusuario']; 
    
    
    $revisoresxtrabajo = $obj->mostrar_tbl_revisiones($idrol);
    
    $contar = 1;
    $resultado = $revisoresxtrabajo->fetch(PDO::FETCH_ASSOC);
   
    $html = "<tbody >";
    if($resultado > 0){
    
    
    foreach ($revisoresxtrabajo as $fila) { 
        $idtrabajo = $fila['id_trabajo_fk'];
        $titulo = $fila['titulo_trabajo'];
        $tipotrabajo = $fila['nombre_tipo_trabajo'];
        
        $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td align='justify'>".$contar."</td>
                <td align='justify'>".$titulo."</td>
                <td align='center'>".$tipotrabajo."</td>
                
               " ;
        $html.="<td  align='center'  width='5%' style='background-color: #dae6ec;'> <a href='#' id='btnaceptartrabajo_revision' class='on-default edit-row' title='@@aceptar_documento_revision@@' onclick=aceptar_revisar_trabajo('".$fila['id_trabajo_fk']."','".$fila['id_asignacion_a_revisor_pk']."'); > <i class='fa fa-check-circle'></i></a></td>                        
                <td align='center'  width='5%'  ><a  href='#' id='btnrechazartrabajo_revision' class='on-default edit-row' title='@@rechazar_documento_revision@@' onclick=rechazar_revisar_trabajo('".$fila['id_trabajo_fk']."','".$fila['id_asignacion_a_revisor_pk']."'); > <i class='fa fa-times'></i></a> </td>
                <td  align='center'  width='5%' style='background-color: #dae6ec;'> <a href='#' id='infotrabajo_revision' class='on-default edit-row' title='@@info_documento_revision@@' onclick=infotrabajo('".$idtrabajo."','0'); > <i class='fa fa-info-circle'></i></a></td>                        
                </td></tr>";
        $contar++;
    }
    $contar--;
    }else{
       $contar--; 
      $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td id='numero' ></td>
                 <td id='numero' style='font-weight: bold;' >@@sin_solicitudes@@</td></tr>
               ";
    
    }
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@ntrabajos@@: ".$contar."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
   echo $html1;
}

function info_trabajo(){
    global $bdd;
    $bdd = new basedatos();
    $idcongreso = $_SESSION['idcongreso'];
    
    $infotrabajo = $bdd->select('select a.*, b.nombre_tematica from tbl_trabajo a
            join tbl_tematica b on b.id_tematica_pk = a.id_tematica_fk
            
            ');
    $html = "<tbody >";
    foreach ($infotrabajo as $fila) { 
        $idtrabajo      = $fila['id_trabajo_pk'];    
        $titulo         = $fila['titulo_trabajo'];
        $resumen        = $fila['resumen'];
        $palabrasclave  = $fila['palabrasclave'];
        $tematica       = $fila['nombre_tematica'];
        
        $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td id='titulo".$idtrabajo."' >".$titulo."</td>
                <td id='resumen".$idtrabajo."'>".$resumen."</td>
                <td id='palabras".$idtrabajo."'>".$palabrasclave."</td>
                <td id='tematica".$idtrabajo."'>".$tematica."</td>
                
               " ;
        if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/'.$fila['ubicacion_archivo'])){
                        $html.="<td id='boton".$idtrabajo."' style='center'  ><a class='btn btn-primary waves-effect waves-light' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' >@@descargar@@</i></a></td>";     
                        //@@descargar@@
                    }else{
                        $html.="<td  id='boton".$idtrabajo."' ><a class='btn btn-primary waves-effect waves-light' title='@@verdocoriginal@@' onclick='avisonoexiste();' >@@descargar@@</i></a></td>";     
                    }
    }
    
    $html .= "</tbody >";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
   echo $html1;
}
/*Alexis Escoto
10-01-2023
 */
function tabajos_aceptados(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();
    $idusuariorevisor = $_SESSION['idusuario'];
    $idcongreso = $_SESSION['idcongreso'];
    $contar = 1;
    $infotrabajo = $obj->mostrar_tabajos_aceptados($idusuariorevisor);
    $resultado = $infotrabajo;
   
    $html = "<tbody >";
    if($resultado > 0){
       foreach ($infotrabajo as $fila) { 
        $idtrabajo      = $fila['id_trabajo_fk'];    
        $titulo         = $fila['titulo_trabajo'];
        $tipotrabajo    = $fila['nombre_tipo_trabajo'];
        $palabrasclave  = $fila['palabrasclave'];
        $tematica       = $fila['nombre_tematica'];
        
        $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td id='numero".$idtrabajo."' >".$idtrabajo."</td>
                <td id='titulo".$idtrabajo."' >".$titulo."</td>
                <td id='palabras".$idtrabajo."'>".$palabrasclave."</td>
                <td id='tipo".$idtrabajo."' align='center' >".$tipotrabajo."</td>
                <td id='tematica".$idtrabajo."'>".$tematica."</td>
               " ;
        /*verifico si lleno o no el formulario de revisión */
        $cont = 0;
        $query = $obj->mostrar_revision_rabajos($idtrabajo,$idusuariorevisor);
         foreach ($query as $val) {
             if($val['lleno_formulario'] == 1){
                $cont += 1;
            }
         }
               
        if($cont > 0){
            $html.="<td align='center' ><span id='chexlleno_form' style='font-size:10px; -webkit-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);-moz-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);' class='label label-success'>@@completo@@</span></td>";
        }else{
            $html.="<td align='center' ><span id='chexlleno_form' style='font-size:10px;-webkit-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);-moz-box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);box-shadow: 5px 5px 10px 2px rgba(0,0,0,0.30);' class='label label-danger'>@@incompleto@@</span></td>";
        }
        
         $html.="<td  align='center'  width='5%' style='background-color: #dae6ec;'> <a href='#' id='infotrabajo_revision' class='on-default edit-row' title='@@info_documento_revision@@' onclick=infotrabajo('".$idtrabajo."','1'); > <i class='fa fa-info-circle'></i></a></td>";
                if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_pk'].'/Revisiones/'.$fila['ubicacion_archivo'])){
                         /*Informacion del trabajo*/
                    ///*1*/    $html.="<td  align='center' style='background-color: #dae6ec;' ><a class='on-default edit-row' style='cursor:pointer;' title='@@verinfotrabajo@@' onclick=inftrabajo('".$fila['id_trabajo_pk']."'); ><i class='glyphicon glyphicon-info-sign'></i></a></td>";     
                    /*2*/    $html.="<td align='center' ><a class='on-default edit-row' title='@@descargartrabajo@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_pk']."/".$fila['ubicacion_archivo']."' ><i class='fa fa-download' onclick='descargo_archivo();'></i></a></td>";     
                    /*si lleno me lo deshabilita*/    
                    if($cont > 0){
                        $html.="<td  align='center' style='background-color: #dae6ec;' > <a  id='btndictaminatrab' class='on-default edit-row' title='@@formrevisartrablleno@@' disabled=true> <i class='fa fa-pencil-square-o'></i></a></td>";                        
                    }else{
                        $html.="<td  align='center' style='background-color: #dae6ec;'> <a href='#' id='btndictaminatrab' class='on-default edit-row' title='@@revisartrab@@' onclick=revisartrabajo_gr('".$fila['id_trabajo_fk']."','".$fila['id_tematica_pk']."'); > <i class='fa fa-pencil-square-o'></i></a></td>";                        
                    }
                    }else{
                    ///*1*/    $html.="<td  align='center' style='background-color: #dae6ec;' ><a class='on-default edit-row' style='cursor:pointer;' title='@@verinfotrabajo@@' onclick='avisonoexiste();' ><i class='glyphicon glyphicon-info-sign'></i></a></td>";     
                    /*2*/    $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' onclick='avisonoexiste();' ><i class='fa fa-download'></i></a></td>";     
                    /*3*/    $html.="<td  align='center' style='background-color: #dae6ec;'> <a href='#' id='btndictaminatrab' class='on-default edit-row' title='@@revisartrab@@' onclick='avisonoexiste();' > <i class='fa fa-pencil-square-o'></i></a></td>";                        
                    } 
          $html.="</tr>";
    $contar++;
    }
    $contar--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@ntrabajos@@: ".$contar."</strong></p></td></tr></tbody>"; 
    }else{
       $contar--; 
      $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td id='numero' ></td>
                 <td id='numero' style='font-weight: bold;' >No tiene tabajos aceptados</td></tr>
               ";
       $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@ntrabajos@@: ".$contar."</strong></p></td></tr></tbody>";  
    }
    $html1 = traducirstring($html, '../idiomas/es/es.php');
   echo $html1;
}
/*
ALEXIS ESCOTO
10-01-2023
 */
function tbl_asis_programa(){
    require '../clases/class_programa.php';
    $obj = new programa();
    $idcongreso = $_SESSION['idcongreso'];
   
    $datos = $obj->mostrar_tbl_asis_programa('select * from tbl_tipo_actividad 
            ');
    
    $html = "<tbody >";
    $num = 1 ;
    foreach ($datos as $fila) {
      $idtpoactividad = $fila['id_tipo_actividad_pk'];
      $tipoactividad  = $fila['nombre_tipo_actividad'];
     
        $html .= "<tr class='gradeA'>
            <td>".$num."</td>
            <td align='justify'>".$tipoactividad."</td>
           " ;
      
   
        $actxtipo= $obj->mostrar_actividad_programa($idcongreso,$idtpoactividad);
        $resultado = $actxtipo->fetch(PDO::FETCH_ASSOC);
        $actividades = '' ;
        $fechas = '' ;
        $espacios = '' ;
        
        if($resultado > 0){
            foreach ($actxtipo as $valores) { 
                $idactividad = $valores['id_actividad_pk'];
                $actividad   = $valores['nombre_actividad'];
                $fecha       = $valores['fecha_actividad'];
                $espacio     = $valores['nombre_espacio'];
                
                $actividades .= "<li>" . $actividad . "</li>" . "<br>";
                /*  $actividades .=  "<div class='checkbox checkbox-success'>
                                        <input id='$idactividad' value='$idactividad' type='checkbox'>
                                        <label for='checkbox3'>
                                            $actividad 
                                        </label>
                                   </div>" . "<br>" ;*/
                $fechas .= "<li>" . $fecha . "</li>" . "<br>";
                $espacios .= "<li>" . $espacio . "</li>" . "<br>";
                
                
               
            }
        }else{
            $actividades = '@@n_actividad@@' ;
            $fechas = '@@n_fecha@@' ;
            $espacios = '@@n_espacio@@' ;
        } 
        $html .= "<td style='text-align: justify' >".$actividades."</td>
                  <td style='text-align: justify' >".$fechas."</td>
                  <td style='text-align: justify' >".$espacios."</td>
                   " ;
            
        
   
    $num++;
    }
    $num--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@ntipoact@@:   ".$num."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*
ALEXIS ESCOTO
10-01-2023
 */
function tbl_trabajos_epseccion(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();
    $idusuario = $_SESSION['idusuario'] ;
    $idcongreso = $_SESSION['idcongreso'];
    
    $datos = $obj->mostrar_tbl_trabajos_epseccion($idusuario,$idcongreso);
    
    $html = "<tbody >";
    $totaltrabajos = $datos->rowCount();
    $num = 1 ;
    if($totaltrabajos == 0){
         $html .= "<tr><td></td><td style='font-weight: bold;'>@@sin_trabajos_asignados@@</td></tr>" ;
    }else{
       foreach ($datos as $fila) {
       $idtrabajo   = $fila['id_trabajo_pk'] ;
       $titulo      = $fila['titulo_trabajo'];
       $palabras    = explode(",", $fila['palabrasclave']);
       $tematica    = $fila['nombre_tematica'];
       $tipotrabajo = $fila['nombre_tipo_trabajo'];
       $idtematica  = $fila['id_tematica_fk'];
       $words = "" ;
       
       for($i=0; $i<count($palabras); $i++ ){
           $words .= "<li>" . $palabras[$i] ."</li>"  ;
       }
       
       $revisoresxtrabajo = $obj->revisoresxtrabajo($idtrabajo);
        $revisorxtrabajo = "";
        $accio =  "" ;
        $idrevisres = "" ;
        $revisorxtrabajop = " ";
        $idrevisresp= "";
        $contar = $revisoresxtrabajo->fetch(PDO::FETCH_ASSOC);
        
        if ($contar == 0){
            $revisorxtrabajo = "No tiene revisores asignados" ;
            $revisorxtrabajop = "No tiene revisores asignados";
            $idrevisres = "9999". "." ;
        }else{
        }
        
        foreach ($revisoresxtrabajo as $valor){  
            if($valor['pendiente_aceptacion']== 0){
               $revisorxtrabajop .=   "<li>" .$valor['primer_nombre']. " " .$valor['primer_apellido'].  "<br>". "</li>"; 
               $idrevisres .=  $valor['id_usuario_que_recibe']. "," ;
            }else{
              $revisorxtrabajo .= "<li>".  $valor['primer_nombre']. " ".$valor['primer_apellido'].  "<br>"."</li>"; 
               $idrevisres .=  $valor['id_usuario_que_recibe']. "," ; 
            }
        }
       $rest = substr($idrevisres, 0, -1);  //
       $resvi_traba = $idtrabajo . "," . $rest . ",". $idtematica ;
       
       if ($contar == 0){
        }else{
            $accio = "<td style='background-color: #dae6ec;' align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@cancelar_solicitud@@' onclick='modalcancelarsolicitud(".$resvi_traba.");' > <i class='fa fa-times'></i></a> </td>";
        }
        
        $trabajosa_ess = $obj->trabajosa_ess($idtrabajo);
        $totaltrabajosaess = $trabajosa_ess->fetch(PDO::FETCH_ASSOC);
        
        if ($totaltrabajosaess == ""){
           $html .= "<tr class='gradeA' id='tematica".$idtematica."'  name=tematica".$idtematica." value=".$idtematica." >
                <td align='justify'>".$num."</td>
                <td align='justify'>".$titulo."</td>
                <td align='justify'>".$words."</td>
                <td align='justify'>".$tematica."</td>
                <td align='justify'>".$tipotrabajo."</td>
                <td align='justify' id=revisores".$idrevisres." >".$revisorxtrabajo."</td>
                <td align='justify'id=pendiente".$idtrabajo." >".$revisorxtrabajop."</td>
                <input type='hidden' id=tem".$idtematica." value= '".$idtematica."'>
               " ; 
            $html.="<td align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@asignar_revisores@@' onclick='modaleps( ".$resvi_traba.");' ><i class='fa fa-users'></i></a> </td>                          
                ".$accio."
                <td align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@asignar_editor_s@@' onclick='modal_ess( ".$idtrabajo." , ".$idtematica.");' ><i class='ion ion-android-social-user'></i></a> </td>
                </td></tr>";
        }else{
          
        }
        $num++;
        } 
    }
    

    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@ntrabajos@@:   ".$totaltrabajos."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
    
}
/*
ALEXIS ESCOTO
10-01-2023
 */
function tbl_dictaminar_trabajos_eps(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();
    $idcongreso = $_SESSION['idcongreso'];
    $idusuario = $_SESSION['idusuario'];
    
  
    $datos = $obj->mostrar_tbl_dictaminar_trabajos_eps($idusuario,$idcongreso);
    $html = "<tbody >";
     $totaltrabajos = $datos->rowCount();
    // print_R($totaltrabajos);
    foreach ($datos as $fila){
        $text = " ";
        $asignado = "" ;
        $idtrabajo=  $fila['id_trabajo_pk']; 
        $datos1 = $obj->tbl_asignacion_a_revisor($idtrabajo);
        $contar = $datos1; 
        $sinconfirmar = 0;
        $aceptado = 0;
        $lleno = 0 ;
        $sinllenar = 0;
       
        
        foreach ($datos1 as $fila1){ 
        if($fila1['aceptado'] == 1){
            $datos2 = $obj->tbl_revisiones_trabajo($fila1);
            $llenoelform = $datos2;
                if($llenoelform > 0){
                    $lleno +=1 ; 
                }else{
                    $sinllenar +=1 ;
                }
        $aceptado +=1 ; 
        }else if($fila1['pendiente_aceptacion'] == 0){
            $sinconfirmar = 50 ;
            } 
        }
        if(($aceptado > $sinconfirmar) && ($lleno>$sinllenar) && ($sinllenar==0)){
                $text = "@@r_completa@@";
                
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center'>".$fila['id_trabajo_pk']."</td>
                <td align='justify'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='center'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-success'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> ";  
            }else if(($aceptado > $sinconfirmar) && ($lleno<=$sinllenar)  && ($lleno !=0)){
                $text = "@@r_incompleta1@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-primary' >".$fila['id_trabajo_pk']."</td>
                <td align='justify'class='text-primary'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='center' class='text-primary'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-primary'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-primary'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> 
                ";
            }else if(($aceptado > $sinconfirmar) && ($lleno<$sinllenar) && ($aceptado !=0)  ){
                $text = "@@r_incompleta2@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-warning' > ".$fila['id_trabajo_pk']."</td>
                <td align='justify' class='text-warning'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='center' class='text-warning'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-warning'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-warning'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> "; 
            }else if(($contar !=0) && ($sinconfirmar >0)){
                $text = "@@asignado@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-muted' > ".$fila['id_trabajo_pk']."</td>
                <td align='justify' class='text-muted'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='center' class='text-muted'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-muted'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-muted'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> "; 
            }else{
                $text = "@@sin_asignado@@";
                $html .= "<tr class='gradeX'  id='" . $fila['id_trabajo_pk'] . "'>
                <td align='center' class='text-danger'>".$fila['id_trabajo_pk']."</td>
                <td align='justify' class='text-danger'>" . $fila['titulo_trabajo'] . "</td> 
                <td align='center' class='text-danger'>" . $fila['nombre_tipo_trabajo'] . "</td>                
                <td align='center' class='text-danger'>" . $_SESSION['idioma'] . "</td>
                <td align='justify' class='text-danger'><b>" . $text. "</b></td>";
                $html.="<td class='actions'  align='center'> ";  
                
            }
            /*TRABAJO*/
                    $html.="<td  align='center' style='background-color: #dae6ec;' ><a class='on-default edit-row' style='cursor:pointer;' title='@@verinfotrabajo@@' onclick=inftrabajo_eps('".$fila['id_trabajo_pk']."'); ><i class='fa fa-info-circle'></i></a></td>";     
                    if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/'.$fila['ubicacion_archivo'])){
                         /*Informacion del trabajo*/
                    /*2*/    $html.="<td align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' ><i class='fa fa-download'></i></a></td>";     
                    }else{
                    /*2 */ $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' onclick='avisonoexiste();' ><i class='fa fa-cloud-download'></i></a></td>";     
                    }
                    if(file_exists('../form/gestion_trabajos/trabajos/congreso'.$idcongreso.'/tipotrabajo'.$fila['id_tipo_trabajo_fk'].'/Revisiones/'.$fila['ubicacion_archivo'])){
                         /*Informacion del trabajo*/
                    /*2*/    $html.="<td align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/Revisiones/".$fila['ubicacion_archivo']."' ><i class='fa fa-cloud-download'></i></a></td>";     
                    }else{
                    /*2 */ $html.="<td  align='center' ><a class='on-default edit-row' title='@@verdocrevision@@' onclick='avisonoexiste();' ><i class='fa fa-cloud-download'></i></a></td>";     
                    }
                   /*$html.=" <td align='center' style='background-color: #dae6ec;'><a  href='#' id='btnrechazartrabajo' class='on-default edit-row' title='@@rechazar_documento@@' onclick=rechazartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tipo_trabajo_fk']."','".$fila['ubicacion_archivo']."'); > <i class='glyphicon glyphicon-remove'></i></a> </td>";
                       $html.="<td  align='center' style='background-color: #dae6ec;' ><a class='on-default edit-row' style='cursor:pointer;' title='@@verinfotrabajo@@' onclick=inftrabajo('".$fila['id_trabajo_pk']."'); ><i class='glyphicon glyphicon-info-sign'></i></a></td>";     
                       $html.="<td align='center' ><a class='on-default edit-row' title='@@verdocoriginal@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/".$fila['ubicacion_archivo']."' ><i class='glyphicon glyphicon-download-alt'></i></a></td>";     
                       $html.="<td align='center' ><a class='on-default edit-row' title='@@verdoccorrec@@' download='".$fila['ubicacion_archivo']."'  href='form/gestion_trabajos/trabajos/congreso$idcongreso/tipotrabajo".$fila['id_tipo_trabajo_fk']."/Revisiones/".$fila['ubicacion_archivo']."' ><i class='glyphicon glyphicon-download-alt'></i></a></td>";     
                       $html.="<td  align='center' style='background-color: #dae6ec;'> <a href='#' id='btndictaminatrab' class='on-default edit-row' title='@@dictaminatrab@@' onclick=dictaminartrabajo('".$fila['id_trabajo_pk']."','".$fila['id_tematica_pk']."'); > <i class='glyphicon glyphicon-edit'></i></a></td>";                             */
                    $html.="<td  align='center' style='background-color: #dae6ec;'> <a href='#' id='btndictaminatrab_eps' class='on-default edit-row' title='@@dictaminatrab@@' onclick=dictaminartrabajo_eps('".$fila['id_trabajo_pk']."','".$fila['id_tematica_pk']."'); > <i class='fa fa-pencil-square-o'></i></a></td>";
                    $html.="</td></tr><input type='hidden' id='titulo$idtrabajo' name='titulo$idtrabajo' value='".$fila['titulo_trabajo']."'>
                    <input type='hidden' id='tipo$idtrabajo' name='tipo$idtrabajo' value='".$fila['id_tipo_trabajo_fk']."'>
                    <input type='hidden' id='ubicacion$idtrabajo' name='ubicacion$idtrabajo' value='".$fila['ubicacion_archivo']."'>
                    ";
                   
    }

    
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@ntrabajos@@:".$totaltrabajos."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*
ALEXIS ESCOTO
10-01-2023
 */
function tbl_trabajos_ess(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();
    
    $datos = $obj->mostrar_tbl_trabajos_ess();
    $html = "<tbody >";
    
    $totaltrabajos = $datos->rowCount();
    $num = 1 ;
    if ($totaltrabajos == 0){
         $html .= "<tr><td></td><td style='font-weight: bold;'>@@sin_trabajos_asignados@@</td></tr>" ;
    }else{
        foreach ($datos as $fila) {
       $idtrabajo   = $fila['id_trabajo_pk'] ;
       $titulo      = $fila['titulo_trabajo'];
       $palabras    = explode(",", $fila['palabrasclave']);
       $tipotrabajo = $fila['nombre_tipo_trabajo'];
       $words = "" ;

       for($i=0; $i<count($palabras); $i++ ){
           $words .= "<li>" . $palabras[$i] ."</li>"  ;
       }
       
       $revisoresxtrabajo = $obj->revisores_xtrabajo($idtrabajo);
        $revisorxtrabajo = "";
        $accio =  "" ;
        $idrevisres = "" ;
        $revisorxtrabajop = " ";
        $idrevisresp= "";
        $contar = $revisoresxtrabajo->fetch(PDO::FETCH_ASSOC);
        
        if ($contar == 0){
            $revisorxtrabajo = "No tiene revisores asignados" ;
            $revisorxtrabajop = "No tiene revisores asignados";
            $idrevisres = "9999". "." ;
        }else{
        }
        
        foreach ($revisoresxtrabajo as $valor){  
            if($valor['pendiente_aceptacion']== 0){
               $revisorxtrabajop .=   "<li>" .$valor['primer_nombre']. " " .$valor['primer_apellido'].  "<br>". "</li>"; 
               $idrevisres .=  $valor['id_usuario_que_recibe']. "," ;
            }else{
              $revisorxtrabajo .= "<li>".  $valor['primer_nombre']. " ".$valor['primer_apellido'].  "<br>"."</li>"; 
               $idrevisres .=  $valor['id_usuario_que_recibe']. "," ; 
            }
        }
       $rest = substr($idrevisres, 0, -1);  //
       $resvi_traba = $idtrabajo . "," . $rest ;
       
       if ($contar == 0){
        }else{
            $accio = "<td style='background-color: #dae6ec;' align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@cancelar_solicitud@@' onclick='modalcancelarsolicitud_ess(".$resvi_traba.");' > <i class='fa fa-times'></i></a> </td>";
        }
        $html .= "<tr class='gradeA' id='tematica'  name=tematica value= >
                <td align='justify'>".$num."</td>
                <td align='justify'>".$titulo."</td>
                <td align='justify'>".$words."</td>
                <td align='justify'>".$tipotrabajo."</td>
                <td align='left' id=revisores".$idrevisres." >".$revisorxtrabajo."</td>
                <td align='left'id=pendiente".$idtrabajo." >".$revisorxtrabajop."</td>
               " ; 
            $html.="<td align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@asignar_revisores@@' onclick='modal_ess( ".$resvi_traba.");' ><i class='fa fa-users'></i></a> </td>                          
                ".$accio."
                </td></tr>";
        $num++;
        }
    }
    

    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@ntrabajos@@:   ".$totaltrabajos."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
    
    
}
/*ALEXIS ESCOTO  12/12/2022
Instancia que viene de la class_programa funcion tbl_espacios_creados 
*/
function tbl_espacios(){
    require "../clases/class_programa.php";
    $obj = new programa();
    $datos   =   $obj->tbl_espacios_creados(); 
    $html = "<tbody>";
    $filas = $datos;  
    if($filas != 0){
         foreach ($datos as $fila) {
            $html.= "<tr class='gradeX'>
               <td style='text-align: justify;'>".$fila['nombre_espacio']."</td>
               <td style='text-align: justify;'>".$fila['nombre_alternativo']."</td>
               <td style='text-align: center;'>".$fila['capacidad_personas']."</td>    
               <td style='text-align: center;'>".$fila['numero_tomacorriente']."</td>
               <td style='text-align: center;'><a href='./form/gestion_programa/mapas_espacio/".$fila['mapa_espacio']."' target='_blank'><img style='border-radius: 20px 20px 20px 20px;-moz-border-radius: 20px 20px 20px 20px;-webkit-border-radius: 20px 20px 20px 20px;border: 4px; box-shadow: 0 0 3px 6px #fff, 0 0 25px;' src='./form/gestion_programa/mapas_espacio/".$fila['mapa_espacio']."' width='100px' height='80px'></a></td>
                 <td class='actions'  align='center'>
                    <a href='#' class='on-default edit-row' title='@@editar_espacio@@' onclick='modificar_espacio(" . $fila['id_espacio_pk'] . ");' ><i class='fa fa-pencil'></i></a>
                    <a href='#' class='on-default remove-row' title='@@eliminar_espacio@@' onclick='eliminar_espacio(" . $fila['id_espacio_pk'] . ");'><i class='fa fa-trash-o'></i></a>
                </td></tr>";
        }
    }else{
             $html.= "<tr class='gradeX'>
                        <td colspan='7' style='text-align: center;'><h1 class='text-primary'>@@msj_no_tiene_espacios@@</h1></td>
                     </tr>";
    }
    $html.="</tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*ALEXIS ESCOTO  05/12/2022
Instancia que viene de la class_formulario funcion mostrar_editar_form y funcion mostrar_editar_form_tematica 
FALTA AGREGAR LOS BOTONES DE LAS ACCIONES*/
function tbl_editar_form(){
    require "../clases/class_formulario.php";
    $obj = new formulario();
    $formulario   =   $obj->mostrar_editar_form(); 
    $idioma = $_SESSION['idioma'];
    $i = 1 ;  
    $html = "<tbody>";
    
     foreach ($formulario as $fila) {
        //print_r($formulario);
        $tematica_asociada =  " " ;
        $idformulario =  $fila['id_formulario_pk']; 
        $formulario_tematica   =   $obj->mostrar_editar_form_revision($fila['id_formulario_pk']);       
        $contar = $formulario_tematica ;
        if ($contar != 0){
            foreach ($formulario_tematica as $fila1) { 
                $tematica_asociada .= "<li>".$fila1['nombre_tematica']."</li><br>" ;
            }
        }else{
            $tematica_asociada = "@@sintematica@@";
        }   
        $html .= "<tr class='gradeX'>
               <td style='text-align: justify;'>".$i."</td>
               <td style='text-align: justify;'>".$fila['nombre_formulario']."</td>
               <td style='text-align: justify;'>".$fila['descripcion']."</td>
               <td style='text-align: justify;'>".$tematica_asociada."</td>    
               ";      
        $html.="<td style='background-color: #dae6ec;' align='center' width='2%'>   
        <button  title='@@editar_preguntas@@' class='on-default edit-row'  onclick='modal_editar_pcualitativas(".$idformulario.");' ><i class='md-mode-edit'></i></button>                         
       </td>
                </tr>";   
        $i++;
    }
    $i--;
    $html .= "</tbody>";
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@totalform@@: ".$i."   </strong></p></td></tr></tbody>";
   //print_r($html);
    $html1 = traducirstring($html, '../idiomas/'.$idioma.'/'.$idioma.'.php');
    echo $html1;
}
 /*Alexis Escoto 12/12/2022
    Cuenta:20161000817
    Creacion de Instancia tbl_actividades
    SELECT con metodo PDO
    */
function tbl_actividades(){
    require "../clases/class_programa.php";
    $obj = new programa();
    $datos   =   $obj->tbl_actividades(); 

    $html = "<tbody>";
    foreach ($datos as $fila) {
        $html .= "<tr class='gradeX'>
               <td style='text-align: center;'>".$fila['nombre_actividad']."</td>
               <td style='text-align: center;'>".$fila['nombre']."</td>
               <td style='text-align: center;'>".$fila['comentarios']."</td>
                <td style='text-align: center;'>".$fila['hora_inicio']."-".$fila['hora_final']."</td>    
                 <td class='actions'  align='center'>
                    <a href='#' class='on-default edit-row' onclick='modificar_actividad(" . $fila['id_actividad_pk'] . ");' ><i class='fa fa-pencil'></i></a>
                    <a href='#' class='on-default remove-row' onclick='eliminar_actividad(" . $fila['id_actividad_pk'] . ");'><i class='fa fa-trash-o'></i></a>
                </td></tr>";
    }
    $html .= "</tbody>";
    echo $html;
}
/*ALEXIS ESCOTO
10-01-2023
 */

function tbl_asis_c_itineraio(){
    require "../clases/class_programa.php";
    $obj = new itinerario();
    

    $idcongreso = $_SESSION['idcongreso'];
    $idioma = $_SESSION['idioma'];
 
    $datos = $obj->mostrar_itinerario();
    
    $html = "<tbody >";
    $num = 1 ;
    foreach ($datos as $fila) {
      $idtpoactividad = $fila['id_tipo_actividad_pk'];
      $tipoactividad  = $fila['nombre_tipo_actividad'];
     
        $html .= "<tr class='gradeA'>
            <td>".$num."</td>
            <td align='justify'>".$tipoactividad."</td>
           " ;
      
   
        $actxtipo= $obj->tbl_asis_c_itineraio($idcongreso,$idtpoactividad);
        $resultado = $actxtipo->fetch(PDO::FETCH_ASSOC);
        $actividades = '' ;
        $fechas = '' ;
        $espacios = '' ;
        
        if($resultado > 0){
            foreach ($actxtipo as $valores) { 
                $idactividad = $valores['id_actividad_pk'];
                $actividad   = $valores['nombre_actividad'];
                $fecha       = $valores['fecha_actividad'];
                $espacio     = $valores['nombre_espacio'];
                
                /*$actividades .= "<li>" . $actividad . "</li>" . "<br>";*/
                  $actividades .=  "<div class='checkbox checkbox-success'>
                                        <input id='$idactividad' value='$idactividad' type='checkbox'>
                                        <label for='checkbox3'>
                                            $actividad 
                                        </label>
                                   </div>" . "<br>" ;
                $fechas .= "<li>" . $fecha . "</li>" . "<br>";
                $espacios .= "<li>" . $espacio . "</li>" . "<br>";
                
                
               
            }
        }else{
            $actividades = '@@n_actividad@@' ;
            $fechas = '@@n_fecha@@' ;
            $espacios = '@@n_espacio@@' ;
        } 
        $html .= "<td style='text-align: justify' >".$actividades."</td>
                  <td style='text-align: justify' >".$fechas."</td>
                  <td style='text-align: justify' >".$espacios."</td>
                   " ;
        
    $num++;
    }
    $num--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@ntipoact@@:   ".$num."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/'.$idioma.'/'.$idioma.'.php');
    echo $html1;
}

function tbl_asis_modifcar_itineraio(){
    require "../clases/class_programa.php";
    $obj = new itinerario();
    $idcongreso = $_SESSION['idcongreso'];
    $idusuario= $_SESSION['idusuario'];
    $idioma = $_SESSION['idioma'];
   
    
    $datos = $obj->mostrar_tbl_tipo_actividad();
    
    $sitine= 0 ;
    
    $html = "<tbody >";
    $num = 1 ;
    foreach ($datos as $fila) {
      $idtpoactividad = $fila['id_tipo_actividad_pk'];
      $tipoactividad  = $fila['nombre_tipo_actividad'];
     
        $html .= "<tr class='gradeA'>
            <td>".$num."</td>
            <td align='justify'>".$tipoactividad."</td>
           " ;
      
   
        $actxtipo= $obj->tbl_asis_modifcar_itineraio($idcongreso,$idtpoactividad);
        $resultado = $actxtipo->fetch(PDO::FETCH_ASSOC);
        $actividades = '' ;
        $fechas = '' ;
        $espacios = '' ;
        
        if($resultado > 0){
            foreach ($actxtipo as $valores) { 
                $idactividad = $valores['id_actividad_pk'];
                $actividad   = $valores['nombre_actividad'];
                $fecha       = $valores['fecha_actividad'];
                $espacio     = $valores['nombre_espacio'];
                
            $actxusuario= $obj->tbl_usuario_actividad_congreso($idactividad,$idcongreso,$idusuario);
            $tieneactividades = $actxusuario->fetch(PDO::FETCH_ASSOC);
               if($tieneactividades != 0){
                    $actividades .=  "<div class='checkbox checkbox-success'>
                                        <input id='$idactividad' value='$idactividad' type='checkbox' checked>
                                        <label for='checkbox3'>
                                            $actividad 
                                        </label>
                                   </div>" . "<br>" ;
                    $sitine++;
               }else{
                    $actividades .=  "<div class='checkbox checkbox-success'>
                                        <input id='$idactividad' value='$idactividad' type='checkbox' >
                                        <label for='checkbox3'>
                                            $actividad 
                                        </label>
                                   </div>" . "<br>" ;
               } 
                $fechas .= "<li>" . $fecha . "</li>" . "<br>";
                $espacios .= "<li>" . $espacio . "</li>" . "<br>";
            }
        }else{
            $actividades = '@@n_actividad@@' ;
            $fechas = '@@n_fecha@@' ;
            $espacios = '@@n_espacio@@' ;
        } 
        $html .= "<td style='text-align: justify' >".$actividades."</td>
                  <td style='text-align: justify' >".$fechas."</td>
                  <td style='text-align: justify' >".$espacios."</td>
                   " ;
    $num++;
    }
    $num--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@ntipoact@@:   ".$num."</strong></p></td></tr></tbody>";
    if($sitine>0){
        $html1 = traducirstring($html, '../idiomas/'.$idioma.'/'.$idioma.'.php');
        echo $html1;
    }else{
        echo 0;
    }
    
}
 /*Alexis Escoto 19/12/2022
    Cuenta:20161000817
    Creacion de Instancia tbl_listas_actividades
    SELECT con metodo PDO
    */
function tbl_listas_actividades(){
    require "../clases/class_programa.php";
    $obj = new programa();
  

    $a=1;
    $idcongreso = $_SESSION['idcongreso']; 
    print_r($idcongreso);
    $idioma = $_SESSION['idioma'];
    $actividades   =   $obj->listas_de_actividad($idcongreso); 
    $acti= "";
    $html = "<tbody >" ;

    
    foreach($actividades as $fila){
        $idactividad = $fila['id_actividad_pk'];
        $nombre = $fila['nombre_actividad'];
         $acti .=  "<div class='radio radio-success'>
                                        <input id='$idactividad' name='activiadad' value='$idactividad' type='radio'>
                                        <label for='radios'>
                                            $nombre
                                        </label>
                                   </div>" . "<br>" ;
        
        $html .= "<tr class='gradeX'>
            <td style='text-align: justify;'>".$a.".</td>
            <td style='text-align: justify;'>".$acti."</td>
            <td style='text-align: justify;'>".$fila['fecha_actividad']."</td>
            <td style='text-align: justify;'>".$fila['nombre_espacio']."</td>
            
            </tr>";
        $a++;
        $acti= "";
    }
     $a--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p id='numeros' class='text-success'><strong  >@@nact@@:   ".$a."</strong></p></td></tr></tbody>";
    
    $html1 = traducirstring($html, '../idiomas/'.$idioma.'/'.$idioma.'.php');
    echo $html1;
}

/* Solicitudes para ser voluntarios*/
function tbl_solicitudes_voluntarios(){
    require "../clases/class_usuario.php";
  
    $obj = new voluntario();
    $solicitudesxusuario = $obj->tbl_solicitudes_voluntarios();
    
 
    
    $contar = 1;
    $resultado = $solicitudesxusuario->fetch(PDO::FETCH_ASSOC);
   
    $html = "<tbody >";
    if($resultado > 0){
    
    
    foreach ($solicitudesxusuario as $fila) { 
        $idusuario      = $fila['id_usuario_pk'];
        $nombre_persona = $fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido'] ;
        $motivo         = $fila['motivo_solicitud'];
        $mostar = explode("-", $motivo);
        if($mostar[1]==11){
             $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td align='justify'>".$contar."</td>
                <td align='justify'>".$nombre_persona."</td>
                <td align='justify'>".$mostar[0]."</td>
                
               " ;
            $html.="<td  align='center'  width='5%' style='background-color: #dae6ec;'> <a href='#' value='".$fila['id_usuario_pk']."''  id='btn_aceptar_voluntario' class='on-default edit-row' title='@@aceptar_voluntario@@' onclick=aceptar_voluntario('".$fila['id_usuario_pk']."','".$fila['id_solicitud']."',1); > <i class='glyphicon glyphicon-ok'></i></a></td>
                         <td align='center'  width='5%'  ><a  href='#' id='btn_rechazar_voluntario' class='on-default edit-row' title='@@rechazar_voluntario@@' onclick=aceptar_voluntario('".$fila['id_usuario_pk']."','".$fila['id_solicitud']."',2); > <i class='glyphicon glyphicon-remove'></i></a> </td>
                     </tr>";
            $contar++;
        }
       
        
    }
    $contar--;
    }else{
       $contar--; 
      $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td id='numero' ></td>
                 <td id='numero' style='font-weight: bold;' >@@sin_solicitudes@@</td></tr>
               ";
    
    }
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@nsolicitudes@@: ".$contar."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
   echo $html1;
}
/*Alexis Escoto
Cuenta:20161000817 21/12/2022
Instanciacion de la clase usuario, metodo voluntario
SELECT con metodo PDO
*/
function tbl_inscribir_voluntario(){
    require "../clases/class_usuario.php";
  
   $obj = new voluntario();

   $solicitudesxusuario = $obj->tbl_inscribir_voluntarios();
    $contar = 1 ;
 
    $array_solicitudes =  array();
    $array_voluntarios =  array();
    
    $i=0;
    $a=0;
    

    $html = "<tbody >";
            /*Solicitudes de los voluntarios*/
    
            /*Solicitudes de los voluntarios*/
    foreach ($solicitudesxusuario as $solicitud){
        $array_solicitudes[$a]=$solicitud['id_usuario_pk'];
        $a++;
    }
    
        /*Voluntarios inscritos*/
    $voluntarios_inscritos = $obj->voluntarios_inscritos();
        /*Voluntarios inscritos*/
    foreach ($voluntarios_inscritos as $voluntarios){
        $array_voluntarios[$i]=$voluntarios['id_usuario_fk'];
        $i++;
    }
    
    /*Personas Registradas que se mostraran para la inscripcion de los voluntarios*/
    
    $personas_registradas =$obj->personas_registradas();
    
    /*$resultado = array_intersect($array_voluntarios, $array_solicitudes);*/
    /*echo print_r($resultado);*/
     
    foreach ($personas_registradas as $persona){
        $idusuario= $persona['id_usuario_pk'];
            
        if((in_array($idusuario, $array_voluntarios)) || (in_array($idusuario, $array_solicitudes))){
            
        }else{
            $nombre_persona= $persona['primer_nombre']." ".$persona['segundo_nombre']." ".$persona['primer_apellido']." ".$persona['segundo_apellido'];
            
            $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td align='justify'>".$contar."</td>
                <td align='justify'><div class=' radio-success'>
                                        <input id='$idusuario' name='personas' value='$idusuario' type='radio'>
                                        <label for='radios'>
                                            $nombre_persona
                                        </label>
                                   </div></td>
               " ;
        }
        $contar++;
    }
    
    $contar--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@personas_registradas@@: ".$contar."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*Alexis Escoto
Cuenta:20161000817 22/12/2022
Instanciacion de la clase usuario, metodo voluntario

*/
function  tbl_actividades_voluntarios(){
    require "../clases/class_usuario.php";
    $obj = new  voluntario();

    
    $contar = 1 ;
    $html = "<tbody >";
    
    $voluntarios = $obj->tbl_actividades_voluntarios();
    
    foreach ($voluntarios as $voluntario){
        $nombre_persona = $voluntario['primer_nombre']." ".$voluntario['segundo_nombre']." ".$voluntario['primer_apellido']." ".$voluntario['segundo_apellido'] ;
        $id_voluntario = $voluntario['id_voluntario_pk'] ; 
        
            $actividades_mostar = ""; 
            
            $actividades_voluntarios = $obj->actividades_voluntarios($id_voluntario);
            $total = $actividades_voluntarios;
            
            if($total != " "){
                foreach ($actividades_voluntarios as $actividades){
                    $actividades_mostar .="<li>".$actividades['nombre_tarea']." </li><br> "  ;
                }
            }else{
                $actividades_mostar= "@@no_actividad@@" ;
            }
            
        $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                <td >".$contar."</td>
                <td align='justify'>".$nombre_persona."</td>
                <td align='justify'>".$actividades_mostar."</td>
                <td align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@asignar_actividad_voluntario@@' onclick='asignar_actividad_voluntario(".$id_voluntario.");' ><i class='md-list'></i></a> </td>   
                                                                                                                                                                                           
                </td></tr>
                 " ;
        $contar++ ;
        
    }
    
    $contar--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@personas_registradas@@: ".$contar."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
    
}
/*Alexis Escoto
Cuenta:20161000817 22/12/2022


*/
function tbl_validacion_voluntario(){
    require "../clases/class_usuario.php";
    $obj = new  voluntario();
    
    $contar = 1 ;
    $html = "<tbody >";
    
    
    $voluntarios = $obj->tbl_validacion_voluntario();
    $total = $voluntarios->fetch(PDO::FETCH_ASSOC);
    if($total == 0){
        $html .= "<tr><td></td><td style=' font-weight: bold;'>@@no_voluntarios@@</td></tr>";
    }else{
        $html .= "<tr><td></td><td><div class='checkbox checkbox-success' onclick='cambia()'>
                                        <input id='select_all' name='select_all'  type='checkbox'>
                                        <label for='checkbox'>
                                            @@select_all@@
                                        </label>
                                   </div> </td></tr>";
                foreach ($voluntarios as $voluntario){
                $nombre_persona = $voluntario['primer_nombre']." ".$voluntario['segundo_nombre']." ".$voluntario['primer_apellido']." ".$voluntario['segundo_apellido'] ;
                $id_voluntario = $voluntario['id_voluntario_pk'] ; 

                    $actividades_mostar = ""; 

                    $actividades_voluntarios = $obj->validacion_voluntario($id_voluntario);
                    $total = $actividades_voluntarios->fetch(PDO::FETCH_ASSOC);

                    if($total != " "){
                        foreach ($actividades_voluntarios as $actividades){
                            $actividades_mostar .="<li>".$actividades['nombre_tarea']." </li><br> "  ;
                        }
                    }else{
                        $actividades_mostar= "@@no_actividad@@" ;
                    }

                $html .= "<tr class='gradeA' id='revisor'  name='revisor' value='' >
                        <td >".$contar."</td>
                        <td align='justify'><div class='checkbox checkbox-success'>
                                                <input id='$id_voluntario' name='personas' value='$id_voluntario' type='checkbox'>
                                                <label for='checkbox'>
                                                    $nombre_persona
                                                </label>
                                           </div> </td>
                        <td align='justify'>".$actividades_mostar."</td>
                        </td></tr>
                         " ;
                $contar++ ;

            }
    }
    
    
    
    
    $contar--;
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@personas_registradas@@: ".$contar."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*Alexis Escoto
Cuenta:20161000817 22/12/2022


*/
function tbl_act_asignada_voluntarios(){
 
    require "../clases/class_usuario.php";
    
    $contar = 1;
    $html = "<tbody >";
    $id_usuario = $_SESSION['idusuario'];
    $obj = new  voluntario();
    $actividades_asignadas = $obj->act_asignada_voluntarios($id_usuario);
    
    $total_actividades = $actividades_asignadas;
    if ($total_actividades > 0){
        foreach ($actividades_asignadas as $actividad){
            $id_tarea = $actividad['id_tarea_voluntario_pk'] ;
            $html .= "<tr>
                        <td>".$contar."</td>
                        <td>".$actividad['nombre_tarea']."</td>
                        <td>".$actividad['descripcion']."</td>
                        <td align='center' width='5%'><a  href='#'  class='on-default edit-row' title='@@asignar_actividad_voluntario@@' onclick='info_tarea_voluntario(".$id_tarea.");' ><i class='md-view-list'></i></a> </td>
                    </tr>" ;
            $contar++;
        }
    }else{
        $html .="<td></d>
                 <td style=' font-weight: bold;'>@@no_actividad@@</d>" ;
    }
   
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@total_acti_asignadas@@: ".$contar."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*Alexis Escoto
Cuenta:20161000817 22/12/2022


*/
function tbl_asis_persona(){
 
    require "../clases/class_usuario.php";
    $obj = new  voluntario();
    
    $contar = 1 ;
    $html = "<tbody >";
    
    $personas_itinerario =  $obj->tbl_asis_persona();
    $total_personas = $personas_itinerario;
    
    foreach ($personas_itinerario as $nombre){
        $nombre_completo = $nombre['primer_nombre']." ".$nombre['segundo_nombre']." ".$nombre['primer_apellido']." ".$nombre['segundo_apellido'] ;
        $id_persona = $nombre['id_persona_pk'] ;
        $idusuario = $nombre['id_usuario_pk'] ; 
        $html .="<tr>
                    <td>".$contar."</td>
                    <td>".$nombre_completo."</td>
                    <td align='left' width='5%'><a  href='#'  class='btn btn-primary waves-effect waves-light m-b-5' title='@@asignar_actividad_voluntario@@' onclick='info_persona_itinerario(".$id_persona.",".$idusuario.");' ><i class='md-info-outline'></i></a> </td>
                </tr>";
        $contar++;
    }
    
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@personas_registradas@@: ".$contar."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*Alexis Escoto
17-01-2023 */
function tbl_itinerario_persona(){
    require "../clases/class_usuario.php";
    $obj = new  voluntario();
    
    $persona = filter_input(INPUT_POST, 'idpersona');
    $num= 1 ;
    
    $datos = $obj->tbl_itinerario_persona($persona);
    
    $html = "<tbody >";
    $total_actividades = $datos;
    if($total_actividades == 0){
        $html .="<tr>
                    <td></td>
                    <td style='font-weight:bold'>@@no_actividad@@</td>
                    <td></td>
                    <td></td>
                </tr>
                ";
    }else{
        foreach ($datos as $fila) {
            $idactividad = $fila['id_actividad_pk'];
        $html .="<tr>
                    <td>".$num."</td>
                    <td><div class='checkbox checkbox-success'>
                                                <input id='$idactividad' name='personas' value='$idactividad' type='checkbox'>
                                                <label for='checkbox'>
                                                    ".$fila['nombre_actividad']."
                                                </label>
                                           </div></td>
                    <td>".$fila['fecha_actividad']."</td>
                    <td>".$fila['nombre_espacio']."</td>
                </tr>
                ";
        $num++;
        }
    }
    
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@nact@@: ".$total_actividades."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
    
}
/*
Alexis Escoto 
22/12/2022
*/
function tbl_asis_autores(){
    require "../clases/class_usuario.php";
    $obj = new  voluntario();
    $num= 1 ;
  
    $datos = $obj->tbl_asis_autores();
    
    $html = "<tbody >";
    $total_actividades = $datos;
    if($total_actividades == 0){
        $html .="<tr>
                    <td></td>
                    <td style='font-weight:bold'>@@sin_trabajo@@</td>
                    <td></td>
                    <td></td>
                </tr>
                ";
    }else{
        foreach ($datos as $fila) {
            $idtrabajo = $fila['id_trabajo_pk'];
            $autor = $fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido'] ;
            $html .="<tr>
                        <td>".$num."</td>
                        <td> ".$fila['titulo_trabajo']."</td>
                        <td>".$autor."</td>
                        <td><div class=' radio-success'>
                                <input id='$idtrabajo' name='personas' value='P' type='radio'>
                                <label for='radio'>
                                   @@si@@
                                </label>
                            </div></td>
                            <td><div class=' radio-success'>
                                 <input id='$idtrabajo' name='personas' value='A' type='radio'>
                                 <label for='radio'>
                                    @@no@@
                                 </label>
                            </div></td>
                    </tr>
                    ";
            $num++;
        }
    }
    
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@ntrabajos@@: ".$num."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
    
}
/*
Alexis Escoto 
22/12/2022
*/
function tbl_validar_pagos(){
    require "../clases/class_usuario.php";
    $obj = new  voluntario();
    
    
    $num= 1 ;
    $datos = $obj->pagos_persona();

    
    $html = "<tbody >";
    $total_personas = $datos;
    foreach ($datos as $persona){
        $titulo_nombre = "";
        
        $id_persona =  $persona['id_persona_pk'];
        $nombre = $persona['primer_nombre']." ".$persona['segundo_nombre']." ".$persona['primer_apellido']." ".$persona['segundo_apellido'] ;
        
        $correo = $persona['correo'] ;
    
        $titulo=$obj->pago_usuario($id_persona);
        $contar= $titulo;
        
        foreach ($titulo as $trab){
                $idtrabajo = $trab['id_trabajo_fk'];
                $titulo_nombre .="<li>" .$trab['titulo_trabajo']. "</li>" ;
                $idusuario = $trab['id_usuario_pk'];
                
                $pago=$obj->costo_usuario($idusuario);
                $pago_inscrip= $pago;
                
                if($pago_inscrip !=0){
                    $array = array();
                    $autor_co = $obj->usuario_trabajo($idtrabajo);
                    $i= 0;
                    foreach ($autor_co as $datos_co){
                        $array['id_persona_fk'.$i] = $datos_co['id_persona_fk'];
                        $i++;
                    }
                    
                }else{
                   
                }
            }
        
        if ($contar ==0){
            $html .="<tr>
                   <td>".$num."</td>
                   <td>@@sin_trabajo@@</td>
                   <td>".$nombre."</td>
                   <td>".$correo."</td>
                   <td align='left' width='5%'><a  href='#'  class='btn btn-primary waves-effect waves-light m-b-5' title='@@validar_pago@@' onclick='validar_pago_persona(".$id_persona.");' ><i class='md-info-outline'></i></a> </td>
               </tr>
               ";
        }else{
           if (empty($array)){
               $html .="<tr>
                    <td>".$num."</td>
                    <td>".$titulo_nombre."</td>
                    <td><div class='checkbox checkbox-info'>
                                        <input id='checkbox12' type='checkbox' disabled=''  >
                                        <label for='checkbox12'>
                                            <strong>".$nombre."</strong>
                                        </label>
                                    </div></td>
                    <td>".$correo."</td>
                    <td align='left' width='5%'><a  href='#'  class='btn btn-primary waves-effect waves-light m-b-5' title='@@validar_pago@@' onclick='validar_pago_persona(".$id_persona.");' ><i class='md-info-outline'></i></a> </td>
                 </tr>
               ";
           }else if (in_array($id_persona, $array)){
               $si = "checked=''";
               $html .="<tr>
                    <td>".$num."</td>
                    <td>".$titulo_nombre."</td>
                    <td><div class='checkbox checkbox-info'>
                                        <input id='checkbox12' type='checkbox' disabled='' $si >
                                        <label for='checkbox12'>
                                            <strong>".$nombre."</strong>
                                        </label>
                                    </div></td>
                    <td>".$correo."</td>
                    <td align='left' width='5%'><a  href='#'  class='btn btn-primary waves-effect waves-light m-b-5' title='@@validar_pago@@' onclick='validar_pago_persona(".$id_persona.");' ><i class='md-info-outline'></i></a> </td>
                 </tr>
               ";
           }else{
               
           }
            
        }
        $num++;
    }
    
    $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong >@@nact@@: ".$num."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*ALEXIS ESCOTO  17/12/2022
Instancia que viene de la class_factura funcion mostrarfacturas 
FALTA REVISAR LOS BOTONES DE LAS ACCIONES*/
function tbl_tours(){
require "../clases/class_factura.php";
$obj = new factura();
$mostrar_tour = $obj->mostrarfacturas();
    
    $num= 1 ;
    
  
    
    $html = "<tbody >";
    $total_personas = 0;
    foreach ($mostrar_tour as $fila){
        $total_personas++ ;
        $id_tour = $fila['id_tour_pk'];
        $html .="<tr>
                    <td>".$num."</td>
                    <td>".$fila['nombre_tour']."</td>
                    <td>".$fila['descripcion']."</td>
                    <td align='left' width='5%'><a  href='#'  class='on-default edit-row' title='@@modificar_tour@@' onclick='llenar_tour(".$id_tour.");' ><i class='md-mode-edit'></i></a> </td>
                </tr>
                ";
        $num++;
    }
    
    $html .= "<tr class='alert alert-default'><td align='left' colspan='12'><p class='text-success'><strong >@@ntours@@: ".$total_personas."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function tbl_articulos(){
    require "../clases/class_factura.php";
$obj = new factura();
$mostrar_articulos = $obj->mostrararticulos();
    
    $num= 1 ;
    
  
    
    $html = "<tbody >";
    $total_personas = 0;
    foreach ($mostrar_articulos as $fila){
        $total_personas++ ;
        $id_costo = $fila['id_costo_pk'];
        $html .="<tr>
                    <td>".$num."</td>
                    <td>".$fila['producto']."</td>
                    <td>".$fila['descripcion']."</td>
                    <td align='left' width='5%'><a  href='#'  class='on-default edit-row' title='@@modificar_articulo@@' onclick='llenar_articulo(".$id_costo.");'><i class='md-mode-edit'></i></a></td>
                </tr>
                ";
        $num++;
    }
    
    $html .= "<tr class='alert alert-default'><td align='left' colspan='12'><p class='text-success'><strong >@@narticulos@@: ".$total_personas."</strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*Alexis Escoto
17-01-2023
 */
function tbl_info_factura(){
 
    require '../clases/class_factura.php';
    $obj = new factura();
    $id = filter_input(INPUT_POST, 'id');
    $dato = filter_input(INPUT_POST, 'dato');
    $impuesto = "";
    
    $factura = $obj->tbl_factura();
    $isv = 0 ;
    
    foreach ($factura as $val){
        $isv = $val['impuesto'];
    }
    
    $num= 1 ;
    $html = "<tbody >";
    if ($dato==0){
        $datos = $obj->tbl_costo($id);
         
    
        foreach ($datos as $fila){
            $grabado_exento =$fila['grabado_exento'] ;
            $id_costo =$fila['id_costo_pk'] ;
            if($grabado_exento == 2){
                $impuesto = "E";
                $isv = "N/A";
                $valor_a_impuesto = $fila['precio_unitario'] ;
            }else{
                $impuesto = "G";
                $valor_a_impuesto = round(($fila['precio_unitario']/($isv/100)), 4);
            }
            $html .="<tr >
                        <td id=costo name='$id'>".$num."</td>
                        <td >".$fila['producto']."</td>
                        <td>".$fila['precio_unitario']."</td>
                        <td>".$impuesto."</td>
                        <td>".$fila['descripcion']."</td>
                        <td>".$isv."</td>
                        <td  id='descuento_pago$num' name=".$fila['precio_unitario']." onclick='mymodal(this.id)'>@@en_porcentaje@@</td>
                        <td>".$valor_a_impuesto."</td>
                        <td>".$fila['precio_unitario']."</td>
                        <td id='bracho' align='left' width='5%'><a  href='#'  class='btn btn-primary waves-effect waves-light btn-sm m-b-5' title='@@agregar_articulo@@' onclick='agregar_articulo();' ><i class='md-add-circle'></i></a> </td>
                        <td style='display:none' id='bracho1' align='left' width='5%'><a  href='#'  class='btn btn-danger waves-effect waves-light btn-sm m-b-5' title='@@eliminar_articulo@@' onclick='eliminar_articulo();' ><i class='md-remove-circle'></i></a> </td>
                    </tr>
                    ";
            /*<td tabindex='1'>".$fila['producto']."</td> para modificar en cada td*/
            $num++;
        }
        $html .= "<tfoot><td id=".$fila['precio_unitario']."></td><td ></td><td ></td><td ></td><td ></td><td ></td><td align='left' colspan='12' id='total_pagar'><p class='text-default'><strong >@@total_pagar@@ ".$fila['precio_unitario']."</strong></p></td></tfoot></tbody>";
    }else if($dato == 1){
        $idtour = filter_input(INPUT_POST, 'tour');
        $tour = $obj->tbl_tour($idtour);
        
        foreach ($tour as $fila){
            $graba_exento =$fila['Impuesto'] ;
            if($graba_exento == 2){
                $impuesto = "E";
                $isv = "N/A";
                $valor_a_impuesto = $fila['costo'] ;
            }else{
                $impuesto = "G";
                $valor_a_impuesto = round(($fila['costo']/($isv/100)), 4);
            }
            
            $html .="<tr >
                        <td id=tour name=$idtour>".$num."</td>
                        <td >".$fila['nombre_tour']."</td>
                        <td>".$fila['costo']."</td>
                        <td>".$impuesto."</td>
                        <td>".$fila['descripcion']."</td>
                        <td>".$isv."</td>
                        <td  id='descuento_pago$num' name=".$fila['costo']." onclick='mymodal(this.id)'>@@en_porcentaje@@</td>
                        <td>".$valor_a_impuesto."</td>
                        <td>".$fila['costo']."</td>
                        <td id='bracho' align='left' width='5%'><a  href='#'   class='btn btn-primary waves-effect waves-light btn-sm m-b-5' title='@@agregar_articulo@@' onclick='agregar_articulo();' ><i class='md-add-circle'></i></a> </td>
                        <td style='display:none' id='bracho1' align='left' width='5%'><a  href='#'  class='btn btn-danger waves-effect waves-light btn-sm m-b-5' title='@@eliminar_articulo@@' onclick='eliminar_articulo();' ><i class='md-remove-circle'></i></a> </td>
                    </tr>
                    ";
            /*<td tabindex='1'>".$fila['producto']."</td> para modificar en cada td*/
            $num++;
        }
        $html .= "<tfoot><td id=".$fila['costo']."></td><td ></td><td ></td><td ></td><td ></td><td ></td><td id='total_pagar' align='left' colspan='12'><p class='text-default'><strong >@@total_pagar@@ ".$fila['costo']."</strong></p></td></tfoot></tbody>";
    }
    
    
    
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function tbl_idiomas_traduccion() {
    require '../clases/clase_Idioma.php';
    $id_idioma_pk = filter_input(INPUT_POST, 'id'); 
    $html = "";
    $obj = new Idioma();
    $arreglo = $obj->arreglo_traducciones($id_idioma_pk); 
    foreach ($arreglo as $key => $value) {
        if ($arreglo[$key]["peso"] == 0) {
            $html .= "<tr class='rojo'>
                            <td class='col-sm-6'>
                                <div class='col-sm-12'>
                                    <div class='card-box'>
                                        <form enctype='multipart/form-data' method='POST' name=''  id='' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                            <div class='form-group'>
                                                <div>
                                                    <p style='font-size:20px; font-style:italic; overflow-wrap: break-word;'> " . $arreglo[$key]["valor"]. "</p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class='col-sm-6'>
                                <div class='col-sm-12'>
                                    <div class='card-box'>
                                        <form enctype='multipart/form-data' method='POST' name='form_traduccion_".$key."'  id='form_traduccion_".$key."' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                            <div class='form-group'>
                                                <div>
                                                    <textarea  name = 'tex_traduccion_".$key."' id = 'tex_traduccion_".$key."' class='form-control' rows='5'></textarea>
                                                </div>
                                            </div>
                                            <div class='form-group text-right m-b-0'>
                                                <button onclick='traducir(".$key.");' class='btn btn-primary waves-effect waves-light' type='button' id= 'enviar_".$key."' name = 'enviar_".$key."'  >
                                                    @@traducir@@
                                                </button>
                                                <button type='reset' class='btn btn-default waves-effect waves-light m-l-5'>
                                                    @@cancelar@@
                                                </button>
                                                <input type='hidden' name='caso_".$key."'  id='caso_".$key."' value='enviar_traduccion_".$key."'/>
                                                <input type='hidden' name='id' id='id' value='".$key."'/>
                                                <input type='hidden' name='clave_".$key."'  id='clave_".$key."'  value='".$arreglo[$key]["clave"]."'/>
                                                <input type='hidden' name='valor_".$key."' id='valor_".$key."'  value='".$arreglo[$key]["valor"]."'/>
                                                <input type='hidden' name='idioma' id='idioma' value='$id_idioma_pk'/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>";
        } 
        else {
            $html .= "<tr class='verde'>
                            <td class='col-sm-6'>
                            <div class='col-sm-12'>
                                <div class='card-box'>
                                    <form enctype='multipart/form-data' method='POST' name=''  id='' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                        <div class='form-group'>
                                            <div>
                                                <p style='font-size:20px; font-style:italic; overflow-wrap: break-word;'> " . $arreglo[$key]["v_original"]. "</p> <br> <p>@@traduccion_previa@@ : " . $arreglo[$key]["valor"] . " </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </td>
                            <td class='col-sm-6'>
                                <div class='col-sm-12'>
                                    <div class='card-box'>
                                        <form enctype='multipart/form-data' method='POST' name='form_traduccion_".$key."'  id='form_traduccion_".$key."' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                                            <div class='form-group'>
                                                <div >
                                                    <textarea disabled='true' name = 'tex_traduccion_".$key."' id = 'tex_traduccion_".$key."' class='form-control' rows='5'>" . $arreglo[$key]["valor"] . "</textarea>
                                                </div>
                                            </div>
                                            <div class='form-group text-right m-b-0'>
                                                <button onclick='traducir(".$key.");' class='btn btn-primary waves-effect waves-light' type='button' id= 'enviar_".$key."' name = 'enviar_".$key."' >
                                                    @@editar@@
                                                </button>
                                                <button type='reset' class='btn btn-default waves-effect waves-light m-l-5'>
                                                    @@cancelar@@
                                                </button>
                                                <input type='hidden' name='caso_".$key."' id='caso_".$key."' value='editar_traduccion_".$key."'/>
                                                <input type='hidden' name='traducir_".$key."' id='traducir_".$key."' value='@@traducir@@'/>
                                                <input type='hidden' name='editar_".$key."' id='editar_".$key."' value='@@editar@@'/>
                                                <input type='hidden' name='id' id='id' value='".$key."'/>
                                                <input type='hidden' name='clave_".$key."' id='clave_".$key."' value='".$arreglo[$key]["clave"]."'/>
                                                <input type='hidden' name='valor_".$key."' id='valor_".$key."' value='".$arreglo[$key]["valor"]."'/>
                                                <input type='hidden' name='idioma' id='idioma' value='$id_idioma_pk'/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>";
        }
    }
    $html = traducirstring($html, "../idiomas/".$_SESSION["idioma"]."/".$_SESSION["idioma"].".php");
    echo $html;
}

function tbl_respaldos_idioma() {
    require '../clases/clase_Idioma.php';
    $id_idioma_pk = filter_input(INPUT_POST, 'id'); 
    $html = "";
    $obj = new Idioma();
    $arreglo = $obj->arreglo_respaldos_idioma($id_idioma_pk);
    foreach ($arreglo as $key => $value) {
        $html .= "<tr class='gradeX'>"
                . "<td>".$arreglo[$key]["nombre_archivo"]."</td>"
                . "<td>".$arreglo[$key]["fecha"]."</td>"
                . "<td>".$arreglo[$key]["acciones"]."</td>"
                . "</tr>";
    }
    echo $html;
}
     /*Alexis Escoto 20/12/2022
    Cuenta:20161000817
    tbl_distribuciontematica  (TEMÁTICAS CON DISTRIBUCIÓN ASIGNADA)
    Se instancia la clase programa
  
    */

function tbl_distribuciontematica() {
    require '../clases/class_programa.php';
    $obj = new programa();
   $distribucion_tematica = $obj->tbl_distribucion_tematica();
   
    $html = "<tbody>";
    $cont = 1;
    
    foreach ($distribucion_tematica as $fila) {        
        $html .= "<tr>"
                . "<td align='center'>".$cont."</td>"
                . "<td align='center'>".$fila['nombre_tematica']."</td>"
                . "<td align='center'><div class='checkbox checkbox-success checkbox-circle'>
                                            <input id='checkbox-tem-dist' type='checkbox' checked='true' disabled='true'>
                                            <label for='checkbox-tem-dist'>@@distribucionhecha@@ : ".$fila['distribucion_sesiones_paralelas']." @@por_sesion@@</label>
                                        </div></td>"
                . "</tr>";
        $cont+=1;
    }
    $html .= "</tbody>";
    $html1 = traducirstring($html, "../idiomas/".$_SESSION["idioma"]."/".$_SESSION["idioma"].".php");
    echo $html1;
}
/*ALEXIS ESCOTO
09-01-2023 */
function tbl_premio_a_trabajo(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();
 
    $idcongreso = $_SESSION['idcongreso'];
    
    $html = "";
    $num = 1 ;
    
    $tematicas = $obj->mostrar_tbl_premio_a_trabajo( $idcongreso );
    $total_personas = $tematicas->rowCount();
    foreach ($tematicas as $tematica){
        $premios = "";
        $premio_trabajo = "";
        $idpremio_asignado = "" ;
        $idtemtica = $tematica['id_tematica_pk'];
        $nombre_tematica =$tematica['nombre_tematica'];
        
        
        $preminoxtematica = $obj->mostrar_tbl_premio( $idtemtica );
      // $to_pre = $preminoxtematica->num_rows ;
       $to_pre = $preminoxtematica->fetch(PDO::FETCH_ASSOC);
        if($to_pre > 0){
            
            foreach ($preminoxtematica as $premio) {
                $id_permio = $premio['id_premio_pk'];
                
                $premioxtrabajo =  $obj->mostrar_tbl_premio_trabajo( $id_permio );
                $total_premixtrab = $premioxtrabajo->fetch(PDO::FETCH_ASSOC);
            
                if($total_premixtrab >0){
                    
                    foreach ($premioxtrabajo as $pre_trab){
                        $idpremio_asignado .= $pre_trab['id_premio_fk'] . ",";
                        $trabajo = $pre_trab['titulo_trabajo'];
                        $nombre_premio = $pre_trab['nombre_premio'];
                        $premio_trabajo .= "<li>".$nombre_premio. " --> " .$trabajo."</li>" ;
                    
                    }
                }else{
                    $premios .= "<li>".$premio['nombre_premio']." </li>";
                }

            }
            $fin = count($idpremio_asignado) -1;
            $idpremio_asignado = $idpremio_asignado.substr(0, $fin);     
            $id_trabajo_premio = $idpremio_asignado. ", ". $idtemtica;
            $btn = "<td id='asig_premio_trabajo' align='left' width='5%'><a href='#' class='btn btn-primary waves-effect waves-light btn-sm m-b-5' title='@@asig_premio_trab@@' onclick='asig_premio_trabajo(".$id_trabajo_premio.");'><i class='fa fa-list'></i></a></td> 
                <td style= id='bracho1' align='left' width='5%'><a  href='#'  class='btn btn-success  waves-effect waves-light btn-sm m-b-5' title='@@asignacion_automatica@@' onclick='asignacion_automatica(".$id_trabajo_premio.");'><i class='md-autorenew'></i></a></td>";
               
            }else{
            $premios = "@@sin_premio@@";
            $btn = "<td></td><td></td>";
            $id_trabajo_premio = " ";
        } 
        
        $html .= "<tr>
                <td> $num</td>
                <td> $nombre_tematica</td>
                <td> $premios</td>
                <td> $premio_trabajo</td>
                $btn
                
        ";
        $num++;
    }
    $html .= "<tr class='alert alert-default'><td align='left' colspan='12'><p class='text-success'><strong >@@premios@@: ".$total_personas."</strong></p></td></tr></tbody>";
   // $html .= "<tr class='alert alert-success'><td align='left' colspan='12'><p class='text-success'><strong ></strong></p></td></tr></tbody>";
    $html1 = traducirstring($html, "../idiomas/".$_SESSION["idioma"]."/".$_SESSION["idioma"].".php");
    echo $html1;
}


function tbl_movertrabajos_sp(){
    global $bdd;
    $bdd = new basedatos();
    $act = $bdd->select("select * from tbl_actividad a  
                join tbl_actividad_trabajo b on a.id_actividad_pk = b.id_actividad_fk
                join tbl_actividad_tematica c on a.id_actividad_pk = c.id_actividad_fk
                join tbl_tematica d on c.id_tematica_fk = d.id_tematica_pk                
                join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_fk=e.id_linea_investigacion_pk and e.id_congreso_pk = ".$_SESSION['idcongreso']."               
                where 1=1 group by a.fecha_actividad , a.hora_inicio
                order by a.fecha_actividad , a.hora_inicio asc");
    
    
    $html = "<tbody>";
    $cont = 1;
    $val = 0;
    foreach ($act as $fila) {         
        $trab = $bdd->select("select * from tbl_actividad a  
                join tbl_actividad_trabajo b on a.id_actividad_pk = b.id_actividad_fk 
                join tbl_trabajo c on b.id_trabajo_fk = c.id_trabajo_pk 
                where 1=1 and a.id_actividad_pk='".$fila['id_actividad_pk']."' group by a.fecha_actividad , a.hora_inicio, c.titulo_trabajo 
                order by a.fecha_actividad , a.hora_inicio, c.titulo_trabajo asc");        
        
        $html .= "<tr class='text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'>"
                . "<td align='center'><b>".$cont."</b></td>"
                . "<td align='center'><b>".strtoupper($fila['nombre_actividad'])."</b></td>";
                setlocale(LC_ALL,'Spanish_Honduras');
                $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fila['fecha_actividad'])));
                $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));
                
                $newhorai = date("g:i A",strtotime($fila['hora_inicio']));                
                $newhoraf = date("g:i A",strtotime($fila['hora_final']));               
        
        
                $html.="<td align='center'><b>".$newfecha."</b></td>"
                . "<td align='center'><b>".$newhorai."</b></td>"
                . "<td align='center'><b>".$newhoraf."</b></td></tr>"                                
                . "<tr style='border: 2px solid #F5BCA9;' > <td colspan='5' >";
                    /*ciclo para trabajos*/
                    foreach ($trab as $fi){
                        
                        $datos = $bdd->select('select * from tbl_actividad where 1=1 and id_actividad_pk not like '.$fila['id_actividad_pk'].' group by fecha_actividad order by hora_inicio asc ');
                    
                        $html.="<div class='form-group' style='text-align: justify;'>                                    
                                    <label class='col-md-8 control-label' for='fullname'>".$fi['titulo_trabajo']."</label>
                                    <div class='col-md-4' align='center'>
                                        <select id='slc_actividades_creadas".$val."' name='slc_actividades_creadas".$val."' class='form-control' placeholder='@@actividades_creadas@@' >";
                                         $html.="<option value='0'>@@seleccione@@</option>";
                                            foreach ($datos as $valor) {                                                 
                                                $newfecha1 = strftime('%A %d de %B del %Y',strtotime($valor['fecha_actividad']));
                                                $newfecha1 = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha1));

                                                $newhorai1 = date("g:i A",strtotime($valor['hora_inicio']));                
                                                $newhoraf1 = date("g:i A",strtotime($valor['hora_final'])); 
                                                
                                                $html .= "<option value='" . $valor['id_actividad_pk'] . "'>" . $valor['nombre_actividad'] . "    =>    ".$newfecha1." / ".$newhorai1." - ".$newhoraf1."</option>";
                                            }
                                       $html.=" </select>
                                       <a href='#' class='btn btn-icon waves-effect waves-light btn-success m-b-5' onclick='guardartrabajomact(".$fi['id_trabajo_pk'].", ".$val.")'> <i class='fa fa-save'></i></a>
                                    </div>
                                </div>";    
                        $val += 1;
                    } 
                    $html.="</td></tr>";
        $cont+=1;
    }
    $html .= "</tbody>";
    $html1 = traducirstring($html, "../idiomas/".$_SESSION["idioma"]."/".$_SESSION["idioma"].".php");
    echo $html1;
}

 /*Alexis Escoto 08/12/2022
    Cuenta:20161000817
   de instancia de clase programa,  tbl_programacreado
 
    */
function tbl_programa_creado(){
    require "../clases/class_programa.php";
    $obj = new programa();
    $programa_creado = $obj->tbl_programacreado();
   

    $i = 0; $valor = 0;$j = 0;
    $array=array();  
    /*Extraigo Programas creados*/
    foreach ($programa_creado as $fi) {
        $result = in_array($fi['id_programa_pk'], $array);
        if( $result == false){
            $array['id_programa_pk'.$i] = $fi['id_programa_pk'];
            $array['nombre_programa'.$i] = $fi['nombre_programa'];
            $array['estado_programa'.$i] = $fi['estado_programa'];
            $i++; 
        }
    }
    $html = "<tbody>";
    $cont = 1;
    
    for($j = 0; $j < $i ; $j++){
        $html .= "<tr class='active text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'>"
               . "<td align='center'><b>".$cont."</b></td>"
               . "<td align='center'><b>".strtoupper($array['nombre_programa'.$j])."</b></td>"                                
               . "<td align='center' >";
              foreach ($programa_creado as $fi) {
                  if($array['id_programa_pk'.$j] == $fi['id_programa_pk']){
                      $html .= "<li><b>".$fi['nombre_actividad']."</b></li>";
                  }
              }
              $html .= "<td class='actions'  align='center'>
               <a href='#' class='on-default edit-row' onclick='modificar_programa(" . $array['id_programa_pk'.$j] . ");' ><i class='fa fa-pencil'></i></a>
               <a href='#' class='on-default remove-row' onclick='eliminar_programa(" . $array['id_programa_pk'.$j] . ");'><i class='fa fa-trash-o'></i></a>
               </td>
               <td align='center'><div class='radio radio-success radio-inline'>
                <input type='radio' id='radiop" . $array['id_programa_pk'.$j] . "' value='' name='radioInline' onclick='mostrar_opc_programa_s(" . $array['id_programa_pk'.$j] . ")' >
                <label for='radiop" . $array['id_programa_pk'.$j] . "'></label>
            </div></td></tr>";
       $cont+=1;
    }    
    $html .= "</tbody>";
    $html1 = traducirstring($html, "../idiomas/".$_SESSION["idioma"]."/".$_SESSION["idioma"].".php");
    echo $html1;
}