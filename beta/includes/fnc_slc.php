<?php

/* * ----Archivo con funciones para llenar dinamicamente los select de un formulario----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */

header("Content-Type: text/html;charset=utf-8");
require '../clases/class_base.php';
require '../funciones/funcion_traducir.php';
session_start();


switch ($_GET['id']) {

    case 'tpersona':   //Tipo Persona
        slc_tpersonas();
        break;
    case 'tidentificacion':
        slc_tidentificacion();
        break;
    case 'talimentacion':
        slc_talimentacion();
        break;
    case 'pais':
        slc_pais();
        break;
    case 'pais_uso_interno':
        slc_pais_uso_interno();
    case 'congreso': //OBED form subir trabajo
        slc_congreso();
        break;
    case 'ttrabajo':  //OBED form subir trabajo
        slc_ttrabajo();
        break;
    case 'idcongreso':  //OBED form subir trabajo
        slc_idcongreso();
        break;
    case 'idioma': //OBED form subir trabajo
        slc_idioma();
        break;
    case 'tematicas_trabajo': //OBED form subir trabajo
        slc_tematicas_trabajo();
        break;
    case 'congreso_administrador':
        slc_congreso_administrador();
        break;
    case 'congresos':
        slc_congresos();
        break;
    case 'anio':
        slc_anios();
        break;
    case 'tparticipacion':
        slc_tparticipacion();
        break;
    case 'lineas_investigacion':
        slc_lineas_investigacion();
        break;
    case 'tsolicitud':
        slc_tsolicitud();
        break;    
    
    /**********************Select BRAYAN **********************/  
    case 'sel1':
        scl_tipopregunta();
        break;
    
    case 'tipo_dictamen':
        tipo_dictamen();
        break;
    
    case 'slc_tipo_pago':
        slc_tipo_pago();
        break;
    
    case 'slc_tipo_tour':
        slc_tipo_tour();
        break;
    
    case 'slc_costo_tour';
        slc_costo_tour();
        break;
    /**********************Select Jose**********************/  
    case 'espacio_actividad':
        slc_actividad_congreso();
        break;
    case 'tactividad':
        slc_tactividad();
        break; 
    case 'slcrolescongreso':
        slcrolescongreso();
        break; 
    
        
        
     
}
/*ALEXIS ESCOTO  04/12/2022
Instancia que viene de la class_persona,funcion select_tipo_actividad */ 
function slc_tactividad() {
    require '../clases/class_programa.php';
    $actividad = new programa();
    $actividad = $actividad->select_tipo_actividad();
    
    $html = "<option value=''>@@@@seleccione@@@@</option>";
    foreach ($actividad as $valor) {
        $html .= "<option value='" . $valor['id_tipo_actividad_pk'] . "'>" . $valor['nombre_tipo_actividad'] . "</option>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}

/*ALEXIS ESCOTO  04/12/2022
Instancia que viene de la class_persona,funcion select_espacio_actividad */ 

function slc_actividad_congreso(){
    require '../clases/class_programa.php';
    $espacio = new programa();
    $espacio = $espacio->select_espacio_actividad();
    
    $html = "<option value=''>@@seleccione@@</option>";
    foreach ($espacio as $valor) {
        $html .= "<option value='" . $valor['id_espacio_pk'] . "'>" . $valor['nombre_espacio'] . "</option>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;    
}

function slc_tsolicitud() {

    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("SELECT * FROM tbl_tipo_solicitud WHERE 1=1");
    $html = "<option value=''>@@seleccionar_tipo_solicitud@@</option>";
    foreach ($datos as $valor) {
        $html .= "<option value='" . $valor['id_tipo_solicitud'] . "'>" . $valor['nombre_tipo_solicitud'] . "</option>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}
function slc_congresos() {

    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("SELECT * FROM tbl_congreso WHERE 1=1");
    $html = "<option value='0' >@@seleccionar_congreso@@</option>";
    foreach ($datos as $valor) {
        $html .= "<option value='" . $valor['id_congreso_pk'] . "'>" . $valor['id_congreso_pk'] . " - " . $valor['nombre_congreso'] . "</option>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}

function tematicas_trabajo3() {
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_tematica a                                
                                join tbl_congreso_linea_investigacion b on a.id_linea_investigacion_fk=b.id_linea_investigacion_pk 
                                and b.id_congreso_pk = '.$_SESSION['idcongreso'].'
                                where 1=1 group by nombre_tematica order by nombre_tematica ASC');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['id_tematica_pk'] . "' id='" . $fila['id_tematica_pk'] . "><a href='#'>" . $fila['nombre_tematica'] . "</a></option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function tematicas_trabajo2() {
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_tematica a                                
                                join tbl_congreso_linea_investigacion b on a.id_linea_investigacion_fk=b.id_linea_investigacion_pk 
                                and b.id_congreso_pk = '.$_SESSION['idcongreso'].'
                                where 1=1 group by nombre_tematica order by nombre_tematica ASC');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['id_tematica_pk'] . "' id='" . $fila['id_tematica_pk'] . "><a href='#'>" . $fila['nombre_tematica'] . "</a></option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}


/*ALEXIS ESCOTO  04/12/2022
Instancia que viene de la class_persona,funcion select_tematica_asociada */ 
function slc_tematicas_trabajo() {
    require '../clases/class_programa.php';
    $tematica = new programa();
    $tematica = $tematica->select_tematica_asociada();

    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($tematica as $fila) {
        $html .= "<option value='" . $fila['id_tematica_pk'] . "' id='" . $fila['id_tematica_pk'] . "' name='" . $fila['id_linea_investigacion_fk'] . "'><a href='#'>" . $fila['nombre_tematica'] . "</a></option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_ttrabajo() {
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_tipo_trabajo');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['id_tipo_trabajo_pk'] . "' id='" . $fila['id_tipo_trabajo_pk'] . "><a href='#'>" . $fila['nombre_tipo_trabajo'] . "</a></option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_idioma() {
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_idioma where id_estado_idioma_fk=1');
    $html = "<option value='0'>@@idioma@@</option>";
    foreach ($datos as $fila) {
        $idioma = explode(';', $fila['nombre_idioma']);
        $html .= " <option value='" . $fila['id_idioma_pk'] . "'><a href='#'>" . strtoupper($idioma[2]) . " (" . strtoupper($fila['id_idioma_pk']) . ")</a></option>";
//            <div class='radio radio-primary'>
//                <input type='radio' id='".$fila['id_idioma_pk']."' value='".$fila['id_idioma_pk']."' name='".$fila['id_idioma_pk']."' aria-label='Single radio One'>
//                <label>".utf8_encode( strtoupper($fila['nombre_idioma']))." (".strtoupper($fila['abreviatura']).")</label>
//            </div>";
    }

    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_tparticipacion() {

    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("select * from tbl_roles where 1=1 ORDER BY id_rol_pk ASC");
    $html = "<option value='0'>@@tipo_participacion@@</option>";

    foreach ($datos as $fila) {
        if ($fila['id_rol_pk'] != 1) {
            $html .= "<option value='" . $fila['id_rol_pk'] . "'>" . $fila['nombre_rol'] . "</option>";
        }
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_congreso() {

    global $bdd;

    $bdd = new basedatos();
    $datos=$bdd->select("select * from tbl_congreso where 1=1 and id_estado_congreso_fk > 0");
    $html="<option value='0'>@@congreso@@</option>";

    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['id_congreso_pk'] . "'>" . $fila['nombre_congreso'] . "</option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_pais() {
    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("select * from tbl_pais where 1=1");
    $html = "<option value='0'>@@pais_procedencia@@</option>";
    foreach ($datos as $fila) {
        $pais = explode(';', $fila['nombre_pais']);
        $html .= "<option value='" . $fila['id_pais_pk'] . "'>" . $pais[1] . "</option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_pais_uso_interno() {
    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("select * from tbl_pais where 1=1");
    $html = "<option value='0'>@@seleccione@@</option>";
    if ($_SESSION['idioma'] == 'es') {
        $id = 0;
    } else {
        $id = 1;
    }
    foreach ($datos as $fila) {
        $pais = explode(';', $fila['nombre_pais']);
        $html .= "<option value='" . $fila['id_pais_pk'] . "'>" . $pais[$id] . "</option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_tpersonas() {

    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("select * from tbl_tipo_persona where 1=1");
    $html = "<option value='0'>@@tipo_persona@@</option>";

    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['id_tipo_persona_pk'] . "'>" . $fila['nombre_tipo_persona'] . "</option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_tidentificacion() {
    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("select * from tbl_tipo_identificacion where 1=1");
    $html = "<option value='0'>@@tipo_identificacion@@</option>";

    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['id_tipo_identificacion_pk'] . "'>" . $fila['nombre_tipo_identificacion'] . "</option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

function slc_talimentacion() {

    global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("select * from tbl_tipo_alimentacion where 1=1");
    $html = "<option value='0'>@@tipo_alimentacion@@</option>";

    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['id_tipo_alimentacion_pk'] . "'>" . $fila['nombre_tipo_alimentacion'] . "</option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}
/*ALEXIS ESCOTO  05/12/2022
Instancia que viene de la classe_Congreso funcion select_congreso_administrador */
function slc_congreso_administrador() {
    require '../clases/clase_Congreso.php';
    $obj = new Congreso();
    $obj = $obj->select_congreso_administrador();

    $html = "<option value='default'>@@seleccionar_congreso@@</option>";
    foreach ($obj as $clave=>$valor) {
        $html .= "<option value='" . $valor['id_congreso_pk'] . "'>" . $valor['id_congreso_pk'] . " - " . $valor['nombre_congreso'] . "</option>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}
/*ALEXIS ESCOTO  05/12/2022
Instancia que viene de la class_tematica,funcion select_lineas_investigacion */
function slc_lineas_investigacion() {
    require '../clases/class_tematica.php';
    $obj = new Tematica();
    $obj = $obj->select_lineas_investigacion();
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($obj as $valor) {
        $html .= "<option value='" . $valor['id_linea_investigacion_pk'] . "'>" . $valor['nombre_linea_investigacion'] . "</option>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}

function scl_tipopregunta() {
   global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_tipo_pregunta where id_tipo_pregunta_pk != 1  order by id_tipo_pregunta_pk ');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $valor) {       
        $html .= "<option value='" . $valor['id_tipo_pregunta_pk'] . "'>" . $valor['nombre_tipo_pregunta'] . "</option>";
    }
    
    $html1 = traducirstring($html,'../idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
    echo $html1;
}

function tipo_dictamen(){
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_tipo_dictamen WHERE id_tipo_dictamen_pk !=2 order by nombre_tipo_dictamen ASC');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $valor) {       
        $html .= "<option value='" . $valor['id_tipo_dictamen_pk'] . "'>" . $valor['nombre_tipo_dictamen'] . "</option>";
    }
    
    $html1 = traducirstring($html,'../idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
    echo $html1;
}

function slc_anios() {
    $fecha_actual = date("Y-m-d");
    $distribucion = explode("-", $fecha_actual );
    $anio = (int)$distribucion[0];
    $html = "";
    for($i = $anio; $i<$anio + 100; $i++) {
        $html .= "<option value='".$i."'>".$i."</option>";
    }
    echo $html;
}
/*ALEXIS ESCOTO
17-01-2023
 */
function slc_tipo_pago(){
    require '../clases/class_usuario.php';
    $obj = new voluntario();
    $datos = $obj->slc_tipo_pago();
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $valor) {       
        $html .= "<option value='" . $valor['id_costo_pk'] . "'>" . $valor['producto'] . "</option>";
    }
    $html .= "<option value='tour'>Tour </option>";
    
    $html1 = traducirstring($html,'../idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
    echo $html1;
}

function slc_tipo_tour(){
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_tour order by id_tour_pk ');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $valor) {       
        $html .= "<option value='" . $valor['id_tour_pk'] . "'>" . $valor['nombre_tour'] . "</option>";
    }
    
    $html1 = traducirstring($html,'../idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
    echo $html1;
}

function slc_costo_tour(){
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select * from tbl_tour order by id_tour_pk ');
    $tours = $datos->num_rows;
    $datos1 = $bdd->select('select * from tbl_costo order by id_costo_pk ');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos1 as $valor) {       
        $html .= "<option id='costo' value='" . $valor['id_costo_pk'] . "'>" . $valor['producto'] . "</option>";
    }
    $html .= "<OPTGROUP label='@@tour@@'></OPTGROUP>";
    
    if($tours ==0){
        
    }else{
        foreach ($datos as $val){       
            $html .= "<option id='tour' value='" . $val['id_tour_pk'] . "'>" . $val['nombre_tour'] . "</option>";
        } 
    }
    
    $html1 = traducirstring($html,'../idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
    echo $html1;
}

function slcrolescongreso(){
    
    global $bdd;
    $bdd = new basedatos();
    $datos = $bdd->select('select  * from tbl_roles a 
                        join tbl_roles_congreso b on a.id_rol_pk=b.id_rol_fk
                        where b.id_congreso_fk="'.$_SESSION['idcongreso'].'"');
    $html = "<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $fila) {
        $html .= "<option value='" . $fila['tbl_rol_congreso_pk'] . "' id='" . $fila['tbl_rol_congreso_pk'] . "' name='" . $fila['tbl_rol_congreso_pk'] . "'><a href='#'>" . $fila['nombre_rol'] . "</a></option>";
    }
    $html1 = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html1;
}

