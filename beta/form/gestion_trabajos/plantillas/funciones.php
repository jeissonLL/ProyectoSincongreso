<?php

/* 
 * funciones formularios involucrados en la subida de trabajos
 * @OBED
 */
//print_r($_POST);
require '../../../clases/class_base.php';
require '../../../funciones/funcion_traducir.php';
session_start();
switch ($_POST['caso']) {
    
    case 'valida_tp':   //OBED
        valida_tp();
        break;  
    case 'tem2':   //OBED
        tem2();
        break;
    case 'tem3':   //OBED
        tem3();
        break;
    case 'autocompletarcorreo':
        autocompletarcorreo();
        break;
    case 'completarcorreo':
        completarcorreo();
        break;
    case 'autocompletarcorreo1':
        autocompletarcorreo1();
        break;
    case 'completarcorreo1':
        completarcorreo1();
        break;
    case 'agregarautor':
        mostrarautores();
        break;
    case 'aceptarhorario':
        aceptarhorario();
        break;
    case 'revisoresxtrabajo_revisiones' :
        revisoresxtrabajo_revisiones();
        break;
    
    case 'preguntasyrespuestas_revisiones':
        preguntasyrespuestas_revisiones();
        break;
}


function revisoresxtrabajo_revisiones(){
    $idtrabajo  = filter_input(INPUT_POST, 'idtrabajo');
    global $bdd;
    $bdd = new basedatos(); 
    $datos = $bdd->select('select * from tbl_asignacion_a_revisor where id_trabajo_fk="'.$idtrabajo.'"');
    $i=0;
   
    $arrayfinal = '';
    foreach ($datos as $fila){
        $arrayfinal .=$fila['id_usuario_que_recibe'] . "<>";
        $i++;
    }
    echo ($arrayfinal) ; 
    
}

function preguntasyrespuestas_revisiones(){
    global $bdd;
    $bdd = new basedatos() ;
    $idt  = filter_input(INPUT_POST, 'idt');
    $idrev =filter_input(INPUT_POST, 'idrevisor');
    $idtem  = filter_input(INPUT_POST, 'idtem');
    $arraypregcuali =  array();
    $arrayobs =  array();
    $arraypregcuanti=  array();
    $numcuanti=  array();
    $numcuali=  array();
    $datos1 = $bdd->select("select * from tbl_asignacion_a_revisor a
                    join tbl_revisiones_trabajo b on b.id_asignacion_a_revisor_fk = a.id_asignacion_a_revisor_pk
                    join tbl_respuestas_revisiones_trabajos_cualitativas c on c.id_revisiones_trabajo_fk = b.id_revisiones_trabajo_pk
                    join tbl_respuesta_cualitativa d on d.id_respuesta_cualitativa_pk = c.id_respuesta_cualitativa_fk
                    join tbl_pregunta_cualitativa e on e.id_pregunta_cualitativa_pk = d.id_pregunta_cualitativa_fk
                    join tbl_formulario_tematica f on f.id_formulario_fk = e.id_formulario_fk 
                    join tbl_trabajo g on a.id_trabajo_fk=g.id_trabajo_pk
                    where a.id_trabajo_fk='".$idt."' and a.id_usuario_que_recibe = '".$idrev."'  and  f.id_tematica_fk = '".$idtem."'
                    ");
                $i=0;
                foreach ($datos1 as $fila1) {
                    $arraypregcuali['nombre_pregunta_cualitativa'.$i]   = $fila1["nombre_pregunta_cualitativa"];  
                    $arrayobs['respuesta_cualitativa'.$i]         = $fila1["respuesta_cualitativa"];
                    $arrayobs['titulo_trabajo'] = $fila1['titulo_trabajo'];
                    $arrayobs['observaciones']      = $fila1["observaciones"];
                    $i+=1;
                }
                
                $datos2 = $bdd->select("select * from tbl_asignacion_a_revisor a
                    join tbl_revisiones_trabajo b on b.id_asignacion_a_revisor_fk = a.id_asignacion_a_revisor_pk
                    join tbl_respuestas_revisiones_trabajos_cuantitativas c on c.id_revisiones_trabajo_fk = b.id_revisiones_trabajo_pk
                    join tbl_respuesta_cuantitativa d on d.id_respuesta_cuantitativa_pk = c.id_respuesta_cuantitativa_fk
                    join tbl_pregunta_cuantitativa e on e.id_pregunta_cuantitativa_pk = d.id_pregunta_cuantitativa_fk
                    join tbl_formulario_tematica f on f.id_formulario_fk = e.id_formulario_fk 
                    where a.id_trabajo_fk='".$idt."' and a.id_usuario_que_recibe = '".$idrev."'  and  f.id_tematica_fk = '".$idtem."'
                    ");
                $j=0;
                foreach ($datos2 as $fila2){
                        $arraypregcuanti['nombre_pregunta_cuantitativa'.$j] = $fila2["nombre_pregunta_cuantitativa"];
                        $arraypregcuanti['respuesta_cuantitativa'.$j] = $fila2['respuesta_cuantitativa'];
                        $arrayobs['observaciones']      = $fila2["observaciones"];
                    $j+=1;
                }
    $numcuali['numcuali'] = $i;
    $numcuanti['numcuanti'] = $j;
    $arrayfinal =array_merge($numcuanti,$numcuali,$arraypregcuali, $arraypregcuanti, $arrayobs);  
    echo '' . json_encode($arrayfinal) . ''; 
}



function tem3(){
       $id_tem = filter_input(INPUT_POST, 'id_tem'); 
       $id_tem1 = filter_input(INPUT_POST, 'id_tem1');
        global $bdd;
        $bdd = new basedatos();   
        $datos=$bdd->select("select * from tbl_tematica"); 
        $i=0;
        $j = 1;
        $array=array();
        foreach ($datos as $fila) {            
            if($fila['id_tematica_pk'] != $id_tem && $fila['id_tematica_pk'] != $id_tem1){
                $array['id_tematica_pk'.$j] = $fila["id_tematica_pk"];
                $array['nombre_tematica'.$j] = $fila["nombre_tematica"]; 
                $j++;
            }                
            $i++;
        }       
        $array["n_tematicas"] = $j; 
        echo '' . json_encode($array) . '';  
   
}
function tem2(){
        $id_tem = filter_input(INPUT_POST, 'id_tem');
        global $bdd;
        $bdd = new basedatos();   
        $datos=$bdd->select("SELECT * FROM tbl_tematica order by nombre_tematica ASC");                 
        $i = 0;
        $j = 1;
        $array=array(); 
        foreach ($datos as $fila) {
            if($fila['id_tematica_pk'] != $id_tem){                
                $array['id_tematica_pk'.$j] = $fila['id_tematica_pk'];
                $array['nombre_tematica'.$j] = $fila['nombre_tematica']; 
                $j++;
            }
            $i++;
        }
//        print_r($datos);
       $array["n_tematicas"] = $j; 
       echo json_encode($array);
   
}
function valida_tp(){
    $id_tp = filter_input(INPUT_POST, 'tp');
    if(!empty($id_tp)){
         global $bdd;
        $bdd = new basedatos();   
        $datos=$bdd->select("select * from tbl_tipo_trabajo where id_tipo_trabajo_pk='".$id_tp."' "); 
        foreach ($datos as $fila) { 
            $array=array('id_tipo_trabajo_pk' => $fila['id_tipo_trabajo_pk'],
                'nombre_tipo_trabajo' => $fila['nombre_tipo_trabajo'],
                'numero_maximo_autores' => $fila['numero_maximo_autores'],
                'numero_maximo_palabras_clave' => $fila['numero_maximo_palabras_clave'],
                'numero_maximo_palabras_resumen' => $fila['numero_maximo_palabras_resumen'],            
             );
        }
         echo '' . json_encode($array) . '';  
    }
    
}
function autocompletarcorreo(){
    $correo = filter_input(INPUT_POST, 'correo');
    global $bdd;
    $bdd = new basedatos(); 
    $data = array();
    $datos=$bdd->select("select * from tbl_usuario a, tbl_persona b, tbl_correo c where a.id_persona_fk=b.id_persona_pk and b.id_persona_pk=c.id_persona_fk and c.correo='".$correo."' "); 
        foreach ($datos as $fila) { 
            $data=array('id_usuario_pk' => $fila['id_usuario_pk'],
                'id_persona_fk' => $fila['id_persona_fk'],
                'primer_nombre' => $fila['primer_nombre'],
                'segundo_nombre' => $fila['segundo_nombre'],
                'primer_apellido' => $fila['primer_apellido'], 
                'segundo_apellido' => $fila['segundo_apellido']
             );
        }
         echo '' . json_encode($data) . ''; 
}

function completarcorreo(){    
    global $bdd;
    $bdd = new basedatos();     
    $correo = $_SESSION['cprincipal'];
    $correopersona = filter_input(INPUT_POST, 'correo');
    $datos=$bdd->select("select correo, id_persona_fk from tbl_correo where 1=1 and correo not like '%$correo%' and correo like '%$correopersona%'");
    $data = array();
    $i = 0;
        foreach ($datos as $fila) { 
            $data[$i] = $fila['correo'];  
            $i += 1;
        }
        //echo $data;
         echo '' . json_encode($data) . '';
}

function autocompletarcorreo1(){
    $correo = filter_input(INPUT_POST, 'correo');
    global $bdd;
    $bdd = new basedatos(); 
    $data = array();
    $datos=$bdd->select("select * from tbl_usuario a, tbl_persona b, tbl_correo c where a.id_persona_fk=b.id_persona_pk and b.id_persona_pk=c.id_persona_fk and c.correo='".$correo."' "); 
        foreach ($datos as $fila) { 
            $data=array('id_usuario_pk' => $fila['id_usuario_pk'],
                'id_persona_fk' => $fila['id_persona_fk'],
                'primer_nombre' => $fila['primer_nombre'],
                'segundo_nombre' => $fila['segundo_nombre'],
                'primer_apellido' => $fila['primer_apellido'], 
                'segundo_apellido' => $fila['segundo_apellido'],
                'identificacion' => $fila['identificacion']
             );
        }
         echo '' . json_encode($data) . ''; 
}

function completarcorreo1(){
    global $bdd;
    $bdd = new basedatos();  
    $correo = $_SESSION['cprincipal'];
    $correopersona = filter_input(INPUT_POST, 'correo');
    $datos=$bdd->select("select correo, id_persona_fk from tbl_correo where 1=1 and correo not like '%$correo%' and correo like '%$correopersona%'");
    $data = array();
    $i = 0;
        foreach ($datos as $fila) { 
            $data[$i] = $fila['correo'];  
            $i += 1;
        }
        //echo $data;
         echo '' . json_encode($data) . '';
}


function mostrarautores(){   
    $idt = filter_input(INPUT_POST, 'idt');
     global $bdd;
    $bdd = new basedatos();     
    $datos=$bdd->select("select * from tbl_trabajo a, tbl_persona b, tbl_usuario c, tbl_usuario_trabajo d, tbl_correo e where d.id_usuario_fk=c.id_usuario_pk and c.id_persona_fk=b.id_persona_pk and d.id_trabajo_fk=a.id_trabajo_pk and b.id_persona_pk=e.id_persona_fk and  a.id_trabajo_pk='$idt'");
    $data = array();
    $data1 = array();
    $data2 = array();
    $i = 0; 
     $html = "";
    foreach ($datos as $fila) { 
        $data=array('titulo_trabajo' => $fila['titulo_trabajo']);
    }
    foreach ($datos as $fila) { 
         $html .= "<tr class='gradeX'  align='center'>
               <td>" . $fila['primer_nombre']." ".$fila['segundo_nombre']."</td>
               <td>" . $fila['primer_apellido']." ".$fila['segundo_apellido']."</td>
               <td>" . $fila['identificacion'] . "</td>
               <td>" . $fila['correo'] . "</td>
               <td>" . $fila['nombre_usuario'] . "</td>";
               if($fila['subio']== 1){
                   $html .= "<td><div >
                                 <input disabled type='checkbox' value='".$fila['subio']."' checked>
                             </div></td>";
               }else{
                   $html .= "<td><div >
                                 <input disabled type='checkbox' value='0'>
                             </div></td>";
               }
               if($fila['autor_principal']== 1){
                   $html .= "<td><div >
                                 <input disabled type='checkbox' value='".$fila['autor_principal']."'  checked>
                             </div></td>";
               }else{
                   $html .= "<td><div >
                                 <input disabled type='checkbox' value='0'>
                             </div></td>";
               }
               if($fila['coautor']== 1){
                   $html .= "<td><div >
                                 <input disabled type='checkbox' value='".$fila['coautor']."'  checked>
                             </div></td>";
               }else{
                   $html .= "<td><div >
                                 <input disabled type='checkbox' value='0'>
                             </div></td>";
               }
               if($fila['expositor']== 1){
                   $html .= "<td><div >
                                 <input type='checkbox' id='expo$i' value='".$fila['id_usuario_pk']."'  checked>
                             </div></td>";
               }else{
                   $html .= "<td><div >
                                 <input type='checkbox' id='expo$i' value='".$fila['id_usuario_pk']."'>
                             </div></td>";
               }
               if($fila['autoria']== 1){
                   $html .= "<td><div >
                                 <input disabled type='checkbox' value='".$fila['autoria']."'  checked>
                             </div></td>";
               }else{
                   $html .= "<td><div>
                                 <input disabled type='checkbox' value='0'>
                             </div></td>";
               }
               if($fila['autor_correspondencia']== 1){
                   $html .= "<td><div >
                                 <input type='checkbox' id='autor_corres$i' value='".$fila['id_usuario_pk']."'  checked>
                             </div></td>";
               }else{
                   $html .= "<td><div>
                                 <input type='checkbox' id='autor_corres$i' value='".$fila['id_usuario_pk']."'>
                             </div></td>";
               }
        $html.="<td align='center' style='background-color: #dae6ec;'><a  href='#' id='btneliminarautor' class='on-default edit-row'  onclick=eliminarautortrabajo('".$fila['id_usuario_pk']."','".$fila['id_trabajo_pk']."'); > <i class='glyphicon glyphicon-remove'></i></a> </td></tr>";
        $i+=1;
    }
    $html.="<input value='".$i."' id='totalautores' type='hidden'/>";
    
    echo $html;
}
/**
 * ALEXIS ESCOTO
 * 18-01-2023
 */
function aceptarhorario(){
//    print_r($_POST);
//    print_r($_SESSION);
include '../../../clases/class_trabajos.php';                
$obj = new trabajo();
    $idt = filter_input(INPUT_POST, 'idt');
    if(!empty($idt)){
        global $bdd;
        $array = array();
        $array1 = array();
        $array_final = array();
 
        $hora_sugerida = $obj->aceptar_horario($idt);
        foreach ($hora_sugerida as $val) {
            $array1 = array('id_trabajo_pk' => $val['id_trabajo_pk'],
                'horario_sugerido' => $val['horario_sugerido'],
            );
        }
        
        
        $datos=$obj->horario_tbl_presentacion_trabajos($idt); 
        foreach ($datos as $fila) { 
            $array=array(
                'fecha_presentacion' => $fila['fecha_presentacion'],
                'hora_presentacion' => $fila['hora_presentacion'],
                'horario_aceptado' => $fila['horario_aceptado'],
             );
        }
        $array_final = array_merge($array1, $array);
        //print_r($array);
         echo '' . json_encode($array_final) . '';  
    }
}