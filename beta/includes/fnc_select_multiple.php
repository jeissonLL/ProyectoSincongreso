<?php

/**----ARCHIVO CON FUNCION DE LLENADO DE TODAS LOS SELECT MULTIPLES QUE ACOMPAÑAN LOS FORMULARIOS DE INGRESOS----**/

require '../clases/class_base.php';
require '../funciones/funcion_traducir.php';
session_start();
switch ($_POST['funcion']) {
    
    case 'origen_certificados':   //OBED
        origen_certificados();
        break; 
    case 'select_congreso':
        select_congreso();
        break;  
    
    case 'origen_tematica': //brayan
        origen_tematica();
        break;
    
    case 'origen_todos_revisores':
        origen_todos_revisores();
        break;
    
    case 'origen_editores':
        origen_editores();
        break;
    
    case'origen_actividades_voluntarios':
        origen_actividades_voluntarios();
        break;
    
    case 'origen_sol_tematica': //José
        origen_sol_tematica();
        break;

    case 'origen_premios': //José
        origen_premios();
        break;
    case 'agregar_roles_congreso':
        agregar_roles_congreso();
        break;
    
}

function origen_sol_tematica(){//brayan 
    global $bdd;
    $bdd = new basedatos();
    $datos=$bdd->select('select * from tbl_tematica order by nombre_tematica'); 
    $html="";
    foreach ($datos as $fila) {
        $html.="<option value='".$fila['id_tematica_pk']."' id='".$fila['nombre_tematica']."' title='".$fila['nombre_tematica'].' --> '.$fila['id_linea_investigacion_fk']."'  style='cursor:pointer;' >".$fila['nombre_tematica']." </option>";
    }
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
/*ALEXIS ESCOTO  05/12/2022
Instancia que viene de la class_certificados,funcion select_origen_certificados */
function origen_certificados(){  //OBED
    require '../clases/class_certificados.php';
    $obj = new certificados();
    $obj = $obj->select_origen_certificados();
  
    $html="";
    foreach ($obj as $fila) {
        $html.="<option value='".$fila['identificacion']."' id='".$fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido']."' onclick='agregar(this.value,this.id);seleccionar();' title='".$fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido'].' --> '.$fila['identificacion']."'  style='cursor:pointer;' >".$fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido']."</option>";
    }
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}
function select_congreso(){  //OBED 
    global $bdd;
    $bdd = new basedatos();
    //QUERY QUE DEBE LLEVAR
    //
    //$datos=$bdd->select('select * from tbl_congreso a, tbl_usuario_congreso_roles b, tbl_roles_congreso c where a.id_congreso_pk=c.id_congreso_fk and b.id_rol_congreso_fk=c.tbl_rol_congreso_pk and b.id_usuario_fk=""'); 
    //
    //NO BORRAR
    $datos=$bdd->select('select * from tbl_congreso'); 
    $html="<option value='0'>@@seleccione@@</option>";
    foreach ($datos as $fila) {        
        $html.="<option value='".$fila['id_congreso_pk']."' id='".$fila['id_congreso_pk']."><a href='#'>".$fila['siglas']."</a></option>";
    }
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function origen_tematica(){//brayan 
    global $bdd;
    $bdd = new basedatos();
    $datos=$bdd->select('select * from tbl_tematica order by nombre_tematica'); 
    $html="";
    foreach ($datos as $fila) {
        $html.="<option value='".$fila['id_tematica_pk']."' id='".$fila['nombre_tematica']."' onclick='agregar(this.value,this.id);' title='".$fila['nombre_tematica'].' --> '.$fila['id_linea_investigacion_fk']."'  style='cursor:pointer;' >".$fila['nombre_tematica']." </option>";
    }
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function origen_todos_revisores(){
    require '../clases/class_trabajos.php';
    $obj = new trabajo();
    $i = 0;
   
    $revisoresyaasigandos= explode(",",  filter_input(INPUT_POST, 'ids'));
   
    $datos=$obj->origen_todos_revisores(); /*and d.id_usuario_pk != "'.$_SESSION['idusuario'].'"*/
    //print_r($datos);
    $html="";
    
    foreach ($datos as $fila){
        $tematica = $fila['id_tematica_pk'];
        $idusuario = $fila['id_usuario_fk'] ;     
        $nombre = $fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido'] ;
        $nombrecorto = $fila['primer_nombre']." ".$fila['primer_apellido'] ;
        $rol = $fila['nombre_rol'] ;
        
        if(!empty($revisoresyaasigandos[$i])){
          if($idusuario == $revisoresyaasigandos[$i] ){
                $html.="<option style='display:none' value='".$idusuario."' id='".$idusuario."' name='".$tematica."' onclick='agregar(this.value,this.id);' title='".$nombrecorto.' --> '.$rol."'  style='cursor:pointer;' >".$nombre." </option>";
            }
        }else{
           $html.="<option  value='".$idusuario."' id='".$idusuario."' name='".$tematica."' onclick='agregar(this.value,this.id);' title='".$nombrecorto.' --> '.$rol."'  style='cursor:pointer;' >".$nombre." </option>";     
        }  
        $i++;
    }
    
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function origen_editores(){
    global $bdd;
    $bdd = new basedatos();
    $idtematica = filter_input(INPUT_POST, 'idtematica');
    
    $datos=$bdd->select('select  a.nombre_rol, c.id_usuario_fk , e.primer_nombre ,e.segundo_nombre , e.primer_apellido , e.segundo_apellido from tbl_roles a
            join tbl_roles_congreso b on b.id_rol_fk = a.id_rol_pk
            join tbl_usuario_congreso_roles c on c.id_rol_congreso_fk = b.tbl_rol_congreso_pk
            join tbl_usuario d on d.id_usuario_pk = c.id_usuario_fk
            join tbl_persona e on e.id_persona_pk = d.id_persona_fk
            join tbl_congreso_rol_tematicas f on f.id_usuario_congreso_roles_fk = c.tbl_usuario_congreso_rol_pk
            where a.nombre_rol = "Editor secundario de sección" and f.id_tematica_fk = "'.$idtematica.'" 
            order by e.primer_nombre
          '); 
    $html="";
    
    foreach ($datos as $fila) {
        $idusuario = $fila['id_usuario_fk'] ;
        $nombre = $fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido'] ;
        $nombrecorto = $fila['primer_nombre']." ".$fila['primer_apellido'] ;
        $rol = $fila['nombre_rol'] ;
        
        $html.="<option value='".$idusuario."' id='".$idusuario."' name='".$nombre."' onclick='agregar4(this.value,this.id);' title='".$nombrecorto.' --> '.$rol."'  style='cursor:pointer;' >".$nombre." </option>";
    }
    
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function origen_actividades_voluntarios(){
    global $bdd;
    $bdd = new basedatos();
    
    
    $datos=$bdd->select('select * from tbl_tarea_voluntario 
          '); 
    $html="";
    
    foreach ($datos as $fila) {
        $idtarea = $fila['id_tarea_voluntario_pk'] ;
        $nombre_actividad = $fila['nombre_tarea'];
        $nombrecorto = "Actividad";
        
        $html.="<option value='".$idtarea."' id='".$idtarea."' name='".$nombre_actividad."' onclick='mover_actividad(this.value,this.id);' title='".$nombrecorto.' --> '.$nombre_actividad."'  style='cursor:pointer;' >".$nombre_actividad." </option>";
    }
    
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1;
}

function origen_premios(){
    global $bdd;
    $bdd = new basedatos();
    
    $idtematica = filter_input(INPUT_POST, 'idtematica');
    $idpremios = explode("," , filter_input(INPUT_POST, 'idpremios')); 
    
    $html = "";
    $datos=$bdd->select('select * from tbl_premio where id_tematica_fk = "'.$idtematica.'" ');
    
    foreach ($datos as $fila) {
        $idpremio = $fila['id_premio_pk'] ;
        $nombre_premio = $fila['nombre_premio'];
        $nombre_corto = "";
        
        if (in_array($idpremio, $idpremios)) {
        }else{
            $html.="<option value='".$idpremio."' id='".$idpremio."' name='".$nombre_premio."' onclick='agregar_premio(this.value,this.id);' title='".$nombre_corto.' --> '.$nombre_premio."'  style='cursor:pointer;' >".$nombre_premio." </option>";
        }
    }
    
    $html1 = traducirstring($html, '../idiomas/es/es.php');
    echo $html1; 
}
/*ALEXIS ESCOTO  05/12/2022
Instancia que viene de la clase_Congreso,funcion select_roles_congreso */
function agregar_roles_congreso() {
    require '../clases/clase_Congreso.php';
    $obj = new Congreso();
    $obj = $obj->select_roles_congreso();
    $html = "";
    foreach ($obj as $value) {
        $html .= "<option value='".$value['id_rol_pk']."' id='".$value['id_rol_pk']."'>".$value['nombre_rol']."</option>";
    }
    echo $html;
}