<?php

/**----Archivo en el cual se conduce todas las transacciones de frontend respecto al usuario en todo el contexto del sistema----
 *
 * @author José L. Rodríguez 
 * @copyright 2017
 * @version 1
 */

require '../funciones/funcion_traducir.php';
include '../clases/class_base.php';
$solicitud= filter_input(INPUT_GET,'tipo_solicitud');

switch ($solicitud) {
    case '1':
        sol_rol();
        break;  
    case '2':
        sol_certificado();
        break;  
    case '3':
        sol_traductor();
        break;    
    case '8':
        sol_revisor();
        break;       
    case 'correo_sol':
        correo_sol();
        break;  
}
function sol_traductor()
{
    session_start();
//------------------------------------------------------Las solicitudes pueden ser enviadas dentro de un congreso o seleccionando uno --------------------------------------//    
    $html=exist_congreso();
//--------------------------------------------------------------------------------------------------------------------------------------- --------------------------------------//        
    
    $bdd = new basedatos();
    $datos = $bdd ->select("select * from tbl_idioma where 1=1 and id_estado_idioma_fk=2 or id_estado_idioma_fk=4");
    $html.="<div class='form-group'>
                <label class='col-sm-2 control-label' for='idiomas'>@@idioma@@</label>
                <div class='col-sm-10'>
                <select id='idioma' name='idioma' class='form-control'>"; 
    $html.="<option value='0'>@@seleccione@@</option>";     
    foreach ($datos as $fila)
    {
        $idioma = explode(';', $fila['nombre_idioma']);
        $html .= " <option value='" . $fila['id_idioma_pk'] . "'><a href='#'>" . strtoupper($idioma[2]) . " (" . strtoupper($fila['id_idioma_pk']) . ")</a></option>";        

    }
    $html.="</select></div></div>";
    $html.="<div class='form-group'>
                <label class='col-sm-2 control-label' for='motivo'>@@observacion@@</label>
                <div class='col-sm-10'><textarea class='form-control' rows='5' id='motivo' name='motivo'></textarea></div></div>";    
            
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;        
    
}
function sol_rol(){
    
    session_start();
//    print_r($_SESSION);
    $html="";
//------------------------------------------------------Las solicitudes pueden ser enviadas dentro de un congreso o seleccionando uno --------------------------------------//    
    $html.=exist_congreso();
//--------------------------------------------------------------------------------------------------------------------------------------- --------------------------------------//        
        $html.="<div class='form-group'>
                    <label class='col-sm-2 control-label' for='roles'>@@roles@@</label>
                    <div class='col-sm-10'>
                    <select id='tparticipacion' name='tparticipacion' class='form-control' onchange='tematicas();'>"; 
        $html.="<option value='0'>@@seleccione@@</option>";
        $idrol  = array();
        $nrol  = array();
        $idrol2  = array();
        $nrol2  = array();      
        $idrolresul = array();
        $nrolresul = array();
    if(isset($_SESSION['idcongreso']))
    {
        $bdd = new basedatos();
            $datos=$bdd->select("select a.nombre_rol, b.id_rol_fk from tbl_roles a, tbl_roles_congreso b, tbl_congreso c
                                where a.id_rol_pk=b.id_rol_fk and b.id_congreso_fk=c.id_congreso_pk and c.id_estado_congreso_fk=1 and b.id_congreso_fk=".$_SESSION['idcongreso']."");
//            $html.="<option value='0'>@@seleccione@@</option>";

            foreach ($datos as $fila)
            {
                if($fila['id_rol_fk']!=1){
                    array_push($idrol, $fila['id_rol_fk']);
                    array_push($nrol, $fila['nombre_rol']);
                    
                }
            }        
           $datos2 = $bdd->select("select a.id_rol_pk, a.nombre_rol from tbl_roles a join tbl_roles_congreso b on a.id_rol_pk = b.id_rol_fk 
                                    join tbl_usuario_congreso_roles c on c.id_rol_congreso_fk = b.tbl_rol_congreso_pk
                                    where b.id_congreso_fk = ".$_SESSION['idcongreso']." and c.id_usuario_fk=".$_SESSION['idusuario']."");
            foreach ($datos2 as $fila2)
            {
                if($fila2['id_rol_pk']!=1){
                    array_push($idrol2, $fila2['id_rol_pk']);
                    array_push($nrol2, $fila2['nombre_rol']);
                    
                }
            }   
            $idrolresul = array_diff($idrol, $idrol2); 
            $nrolresul = array_diff($nrol, $nrol2); 
            foreach($idrolresul as $clave=>$value)
                //expresion as clave=>$value
            {
                
                    $html.="<option value='".$value."'>$nrolresul[$clave]</option>";
                
            }                   
            
    }
        $html.="    </select>
                </div>
                </div>";
        $html.="<div class='form-group'>
                    <label class='col-sm-2 control-label' for='motivo'>@@motivo@@</label>
                    <div class='col-sm-10'><textarea class='form-control' rows='5' id='motivo' name='motivo'></textarea></div></div>";

    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}
function sol_certificado(){
    session_start();    

//------------------------------------------------------Las solicitudes pueden ser enviadas dentro de un congreso o seleccionando uno --------------------------------------//    
    $html=exist_congreso();
//--------------------------------------------------------------------------------------------------------------------------------------- --------------------------------------//            

        $html.="<div class='form-group'>
                    <label class='col-sm-2 control-label' for='tcertificado'>@@certificados@@</label>
                    <div class='col-sm-10'>
                    <select id='tcertificado' name='tcertificado' class='form-control'>"; 
        $html.="<option value='0'>@@seleccione@@</option>";

        $bdd = new basedatos();
            $datos=$bdd->select("select id_certificado_pk, nombre_certificado from tbl_certificados");
//            $html.="<option value='0'>@@seleccione@@</option>";

            foreach ($datos as $fila)
            {
                $html.="<option value='".$fila['id_certificado_pk']."'>".$fila['nombre_certificado']."</option>";
            }        
        

        $html.="    </select>
                </div>
                </div>";        
        $html.="<div class='form-group'>
                    <label class='col-sm-2 control-label' for='motivo'>@@observacion@@</label>
                    <div class='col-sm-10'><textarea class='form-control' rows='5' id='motivo' name='motivo'></textarea></div></div>";
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;    
}
function sol_revisor(){
    session_start();    

//------------------------------------------------------Las solicitudes pueden ser enviadas dentro de un congreso o seleccionando uno --------------------------------------//    
    $html=exist_congreso();
//--------------------------------------------------------------------------------------------------------------------------------------- --------------------------------------//            

        $html.="<div class='form-group'>
                    <label class='col-sm-2 control-label' for='tematica'>@@tematica@@</label>
                    <div class='col-sm-10'>
                    <select id='tematica' name='tematica' class='form-control'>"; 
        $html.="<table>"
                . "<thead><th colspan=''>@@tematicas@@<th></thead>";

        $bdd = new basedatos();
            $datos=$bdd->select("select id_tematica_pk, nombre_tematica from tbl_tematica");
            
            $html.="<option value='0'>@@seleccione@@</option>";
        $html1 = "";
            foreach ($datos as $fila)
            {
                $html.="<option value='".$fila['id_tematica_pk']."'>".$fila['nombre_tematica']."</option>";
            }        
        

        $html.="    </select>
                </div>
                </div>";        
        $html.="<div class='form-group'>
                    <label class='col-sm-2 control-label' for='motivo'>@@observacion@@</label>
                    <div class='col-sm-10'><textarea class='form-control' rows='5' id='motivo' name='motivo'></textarea></div></div>";
    $html = traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;    
}



function exist_congreso()
{
    $html = "";
    if(!isset($_SESSION['idcongreso']))
    {
        global $bdd;
        $bdd = new basedatos();
        $datos=$bdd->select("select distinct c.id_congreso_pk, c.nombre_congreso, c.siglas from tbl_usuario_congreso_roles a, tbl_roles_congreso b, tbl_congreso c
                         where a.id_rol_congreso_fk and b.tbl_rol_congreso_pk=a.id_rol_congreso_fk and c.id_congreso_pk=b.id_congreso_fk
                         and a.id_usuario_fk = ".$_SESSION['idusuario']."");        
        
        $html.="<div class='form-group'>
                    <label class='col-sm-2 control-label' for='congresos'>@@nombre_congreso@@</label>
                    <div class='col-sm-10'>
                        <select id='congreso' name='congreso' class='form-control'>
                        <option value=''>@@seleccionar@@</option>"; 
        
        foreach ($datos as $fila)
        {
            $html.="<option value='".$fila['id_congreso_pk']."'>".$fila["nombre_congreso"]."</option>";
        }    

        $html.="    </select>
                    </div>
                </div>";
        $html.='
        <script>                
            $("#congreso").change(function(){
            var congreso=$("#congreso").val();
             $.post("./includes/funciones.php?funcion=roles_congreso",{congreso:congreso},function(resp){
             $("#tparticipacion").html("");
             $("#tparticipacion").html(resp);
             })
            })
        </script>';   
        $html=traducirstring($html, '../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
       echo $html;
    }    
}