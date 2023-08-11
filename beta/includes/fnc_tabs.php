<?php

/* * ----Archivo con funciones para llenar dinamicamente los tabs de un formulario----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */

header("Content-Type: text/html;charset=utf-8");

require '../funciones/funcion_traducir.php';
session_start();


switch ($_POST['href']) {

    case '#s_revision':
        tabs_srevision();
        break;     
    case '#irevisores':
        tabs_gestion_roles(6);
        break; 
    case '#ieditores_gestores':
        tabs_gestion_roles(7);
        break; 
    case '#ieditores_principales':
        tabs_gestion_roles(10);
        break; 
    case '#ieditores_pseccion':
        tabs_gestion_roles(8);
        break; 
    case '#ieditores_sseccion':
        tabs_gestion_roles(9);
        break; 
    case '#iencargado_programa':
        tabs_gestion_roles(11);
        break; 
    case '#iencargado_vol':
        tabs_gestion_roles(12);
        break;     
    case 'interes':
        interes();
        break;     
    case 'intereses_revisor':
        intereses_revisor();
        break;         
}
function intereses_revisor() {
    require '../clases/class_base.php';
    require '../clases/class_usuario.php';
    $obj= new usuario();
    $idrevisor = filter_input(INPUT_POST, 'idrevisor');
   
    $datos = $obj->mostrar_intereses_revisor($idsol);
    $html="";
    foreach ($datos as $valor) {
        $html .= "<tr>
                    <td align='center'>" . $valor['nombre_tematica'] . "</td>            
                 </tr>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}
/**ALEXIS ESCOTO */
function tabs_gestion_roles($rol){ 
    require '../clases/class_usuario.php';    
    include_once '../clases/class_base.php';            
    echo "rol:".$rol;
   // $bdd = new basedatos();
   $base = new basedatos();  
   $pdo = $base->abrir_conexion();  
    $html="";
    $datos_ver = $pdo->query("select * from tbl_solicitud_roles_congreso");
    //$num_row = $pdo->rowCount();
    $num_row = $datos_ver->rowCount();
    $sql = "select distinct a.id_usuario_pk, a.nombre_usuario, CONCAT_WS(' ',b.primer_nombre, b.segundo_nombre,b.primer_apellido,b.segundo_apellido) as nombres from tbl_usuario a
                                join tbl_persona b on b.id_persona_pk=a.id_persona_fk
                                join tbl_usuario_congreso_roles c on c.id_usuario_fk=a.id_usuario_pk
                                join tbl_roles_congreso d on d.tbl_rol_congreso_pk=c.id_rol_congreso_fk  
                                join tbl_roles e on e.id_rol_pk=d.id_rol_fk 
                                join tbl_solicitud f on f.id_usuario_pk!=a.id_usuario_pk";    
    if($num_row==0){
        $sql.= " where 1=1 and d.id_congreso_fk='".$_SESSION['idcongreso']."' and e.id_rol_pk!='".$rol."' and c.asistira='1' order by nombres ASC";
    }else{
        $sql.=" join tbl_solicitud_roles_congreso g on g.id_rol_congreso_pk!=d.tbl_rol_congreso_pk "
                . "where 1=1 and d.id_congreso_fk='".$_SESSION['idcongreso']."' and e.id_rol_pk!='".$rol."' and c.asistira='1' order by nombres ASC";
    }

        $datos=$pdo->query($sql);
        foreach ($datos as $valor) {

            $usuario = new usuario();    
            $usuario ->uinicializar($valor['id_usuario_pk'], NULL, NULL, NULL, NULL, $rol, NULL);
            $usuario ->get_rol_congreso();
            $tiene_rol = $usuario -> get_usuarioxrolxcongreso(); 
            $a=8;
            $b=9;
            $c=6;
            if($tiene_rol == 0)
            {
            $html .= "<tr>
                        <td align='center' >" . $valor['nombre_usuario'] . "</td>            
                        <td align='center'>" . $valor['nombres'] . "</td>";
                        
                if(($rol != $a) && ($rol != $b) && ($rol != $c))
                {
                    $html.="<td align='center' id= 'usuario".$valor['id_usuario_pk']."'><a  href='#'  class='on-default edit-row' title='@@interesesd@@' onclick='inscribir_rol(".$valor['id_usuario_pk'].",".$rol.");' ><i class='fa-regular fa-circle-check fa-beat'></i></a></td>";
                } else{
                    $html.="<td align='center'><a  href='#'  class='on-default edit-row' title='@@interesesd@@' onclick='gestion_rol(".$valor['id_usuario_pk'].",".$rol.");' ><i class='fa-solid fa-circle-info fa-beat'></i></a></td> ";                    
                }
                $html.="</tr>";
            }
        }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    
    echo $html;    
}
/**SE DUPLICA */
function interes() {
require '../clases/class_base.php';
    global $bdd;
    $idsol = filter_input(INPUT_POST, 'idsol');
    $bdd = new basedatos();
    $datos = $bdd->select("select d.nombre_tematica from tbl_solicitud a
            join tbl_solicitud_tematica b on b.id_solicitud=a.id_solicitud
            join tbl_usuario c on c.id_usuario_pk=a.id_usuario_pk
            join tbl_tematica d on d.id_tematica_pk=b.id_tematica_pk
            join tbl_persona e on e.id_persona_pk=c.id_persona_fk
            join tbl_congreso_linea_investigacion g on g.id_linea_investigacion_pk=d.id_linea_investigacion_fk
            where a.id_tipo_solicitud='1' and a.status='0' and g.id_congreso_pk=1 and a.id_solicitud='$idsol'");
    $html="";
    foreach ($datos as $valor) {
        $html .= "<tr>
                    <td align='center'>" . $valor['nombre_tematica'] . "</td>            
                 </tr>";
    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}

function tabs_srevision() {//Solicitudes para ser revisor
require '../clases/class_usuario.php';
$obj= new usuario();
  

    $bdd = new basedatos();
    $datos = $obj->tabs_srevision();
    $html="";
    foreach ($datos as $valor) {
        
        $motivo=$valor['motivo_solicitud'];
        $html .= "<tr>
                    <td align='center'>" . $valor['nombre_usuario'] . "</td>            
                    <td align='center'>" . $valor['nombres'] . "</td>
                    <td align='center'>" . $motivo. "</td>
                    <td align='center'>" . $valor['fecha_solicitud'] . "</td>
                    <td ><a  href='#'  class='on-default edit-row' title='@@aceptar@@' onclick='aceptar_solicitud(".$valor['id_solicitud'].");' ><i class='glyphicon glyphicon-ok'></i></a> </td> 
                    <td style='background-color: #dae6ec;'><a  href='#'  class='on-default edit-row' title='@@rechazar@@' onclick='rechazar_solicitud(".$valor['id_solicitud'].");' ><i class='glyphicon glyphicon-remove'></i></a> </td>
                    <td ><a  href='#'  class='on-default edit-row' title='@@interesesd@@' onclick='intereses(".$valor['id_solicitud'].");' ><i class='glyphicon glyphicon-info-sign'></i></a> </td>     
                 </tr>";

        
        

    }
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}