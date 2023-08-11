<?php

/* 
 * funciones editor principal (dictaminar trabajo)
 * @OBED
 */
//print_r($_POST);
require  '../../../clases/class_base.php';
require_once '../../../funciones/funcion_traducir.php';
session_start();
switch ($_POST['caso']) {
    
    case 'mostrarinfotrabajo':   //OBED
        mostrarinfotrabajo();
        break; 
    case 'dictaminartrabinvest':
        dictaminartrabinvest();
        break;
    
    case 'revisoresxtrabajo' :
        revisoresxtrabajo();
        break;
    
    case 'preguntasyrespuestas':
        preguntasyrespuestas();
        break;
    
    case 'asignar_premio_trabajo';
        asignar_premio_trabajo();
        break;
    
    case 'premios_automaticos';
        premios_automaticos();
        break;
    
}
function mostrarinfotrabajo(){
    require_once '../../../clases/class_trabajos.php';
    $obj = new trabajo();
//    print_r($_POST);
//    print_r($_SESSION);
    $idt = filter_input(INPUT_POST, 'idt');
    $idcongreso = $_SESSION['idcongreso'];
 
    $datos = $obj->mostrarinfotrabajo($idcongreso,$idt);
    $array=array();
    foreach ($datos as $fila) {
        $array=array('id_trabajo_pk' => $fila["id_trabajo_pk"],
            'titulo_trabajo' => $fila["titulo_trabajo"], 
            'ubicacion_archivo' => $fila["ubicacion_archivo"],
            'fecha_subida' => $fila["fecha_subida"],
            'palabras_clave' => $fila["palabrasclave"],
            'resumen' => $fila["resumen"],
            'nombre_tipo_trabajo' => $fila["nombre_tipo_trabajo"],
            'estado' => $fila["estado"],
            'nombre_tematica' => $fila["nombre_tematica"],
            'idcongreso' => $idcongreso,
            'tipo_trabajo' => $fila["id_tipo_trabajo_fk"],            
            );
    }
    echo '' . json_encode($array) . '';  
   
}
function dictaminartrabinvest(){
//    print_r($_POST);
    $idt    = filter_input(INPUT_POST, 'idt');
    $idtem  = filter_input(INPUT_POST, 'idtem');
    global $bdd;
    $bdd = new basedatos(); 
    $datos = $bdd->select('select * from tbl_asignacion_a_revisor where id_trabajo_fk="'.$idt.'"');
    $arraytrab=array();
    $arraypregcualir1 = array();
    $arraypregcuantir1 = array();
    $arraypregcualir2 = array();
    $arraypregcuantir2 = array();
    $arrayfinal = array();
    $numcuali = array();
    $numcuanti = array();
    $nummeroreviso = array();
    $revisor = array();
   
    $contar = $datos->num_rows;
    $contador = 0;
    $i=0;
    $j=0;
    $k=0;
    
    foreach ($datos as $fila){
        $idasignacion = $fila['preguntasyrespuestas'];
              $datos1 = $bdd->select("select * from tbl_revisiones_trabajo a
                    join tbl_asignacion_a_revisor b on b.id_formulario_fk = a.id_formulario_fk
                    join tbl_tipo_pregunta c  on c.id_tipo_pregunta_pk = b.id_tipo_pregunta_fk
                    join tbl_respuesta_cualitativa d on d.id_pregunta_cualitativa_fk = b.id_pregunta_cualitativa_pk
                    where  a.id_tematica_fk='".$idtem."' and id_trabajo_fk='".$idt."'  and d.id_usuario_fk ='".$idrevisor."'");
                $totalcuantis = $datos1->num_rows ;
                $revisor["caulitativas".$k] = $totalcuantis;
                foreach ($datos1 as $fila1) {
                    $arraypregcuali['nombre_pregunta_cualitativa'.$i]   = $fila1["nombre_pregunta_cualitativa"];  
                    $arraypregcuali['respuesta_cualitativa'.$i]         = $fila1["respuesta_cualitativa"];
                    $i+=1;
                }
                $datos2 = $bdd->select("select * from tbl_formulario_tematica a
                    join tbl_pregunta_cuantitativa b on b.id_formulario_fk = a.id_formulario_fk
                    join tbl_tipo_pregunta c on c.id_tipo_pregunta_pk = b.id_tipo_pregunta_fk
                    join tbl_respuesta_cuantitativa d on d.id_pregunta_cuantitativa_fk = b.id_pregunta_cuantitativa_pk
                    where a.id_tematica_fk='".$idtem."' and id_trabajo_fk='".$idt."'  and d.tbl_usuario_id_usuario_fk ='".$idrevisor."'");
                $totalcualis = $datos2->num_rows ;
                $revisor["cuantitativas".$k] = $totalcualis;
                foreach ($datos2 as $fila2){
                        $arraypregcuanti['nombre_pregunta_cuantitativa'.$j] = $fila2["nombre_pregunta_cuantitativa"];
                        $arraypregcuanti['respuesta_cuantitativa'.$j] = $fila2['respuesta_cuantitativa'];
                    $j+=1;
                }
                 $k++;
       
    }
    
    $numcuali['numcuali'] = $i;
    $numcuanti['numcuanti'] = $j;
    $nummeroreviso['nummeroreviso'] = $contar;
    $arrayfinal = array_merge($arraytrab, $arraypregcuali, $arraypregcuanti, $numcuali, $numcuanti, $nummeroreviso, $revisor);    
    
    echo '' . json_encode($arrayfinal) . ''; 
}


function revisoresxtrabajo(){
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

function preguntasyrespuestas(){
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
                    where a.id_trabajo_fk='".$idt."' and a.id_usuario_que_recibe = '".$idrev."'  and  f.id_tematica_fk = '".$idtem."'
                    ");
                $i=0;
                foreach ($datos1 as $fila1) {
                    $arraypregcuali['nombre_pregunta_cualitativa'.$i]   = $fila1["nombre_pregunta_cualitativa"];  
                    $arrayobs['respuesta_cualitativa'.$i]         = $fila1["respuesta_cualitativa"];
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

function asignar_premio_trabajo(){
    global $bdd;
    $bdd = new basedatos() ;
    
    $premios = explode("," , filter_input(INPUT_POST, 'premios'));
    $trabajo = filter_input(INPUT_POST, 'trabajo');
    $resp = 0;
   
    for($i=0; $i< count($premios); $i++){
       $respuesta =  $bdd->insert("insert into tbl_premio_trabajo(id_premio_fk, id_trabajo_fk)values(?,?)", "ii",[$premios[$i], $trabajo]);
        if($respuesta !=0){
            $resp = 1;
        }else{
            $resp = 0;
        }
    }
    
    if($resp == 1){
        echo 1;
    }else{
        echo 0;
    }
}

function premios_automaticos(){
    global $bdd;
    $bdd = new basedatos();
    
    $idtematica = filter_input(INPUT_POST, 'idtematica');
    $idcongreso = $_SESSION['idcongreso'];
    
    $total = 0 ;
    $igual = "";
    $respuestas ="";
    $puntuaciones = array();
    $trabajos_env = array();
    $final = array();
    
    $trabajos = $bdd->select("select * from tbl_trabajo where id_tematica_fk = ".$idtematica."  ") ;
    foreach ($trabajos as $trabajo) {
        $total = 0 ;
        $idtrabajo = $trabajo['id_trabajo_pk'];
        $titulo = $trabajo['titulo_trabajo'];
        $respuestasxtrabajo = $bdd->select("select f.respuesta_cuantitativa from tbl_trabajo a 
            join tbl_tematica b on b.id_tematica_pk = a.id_tematica_fk
            join tbl_asignacion_a_revisor c on c.id_trabajo_fk = a.id_trabajo_pk
            join tbl_revisiones_trabajo d on d.id_asignacion_a_revisor_fk = c.id_asignacion_a_revisor_pk
            join tbl_respuestas_revisiones_trabajos_cuantitativas e on e.id_revisiones_trabajo_fk = d.id_revisiones_trabajo_pk
            join tbl_respuesta_cuantitativa f on f.id_respuesta_cuantitativa_pk = e.id_respuesta_cuantitativa_fk
            join tbl_linea_investigacion g on g.id_linea_investigacion_pk = b.id_linea_investigacion_fk
            join tbl_congreso_linea_investigacion h on h.id_linea_investigacion_pk = g.id_linea_investigacion_pk
            WHERE a.id_trabajo_pk = ".$idtrabajo." and a.id_estado_fk = 7  and h.id_linea_investigacion_pk = ".$idcongreso."
        ");
        
        $total_respuestas = $respuestasxtrabajo->num_rows;
        
        foreach ($respuestasxtrabajo as $respuesta) {
            $sumar = explode("<>", $respuesta['respuesta_cuantitativa']);
            
            $total = $total +  floatval($sumar[1]);
        }
                
        if(($total > 0) and ($total_respuestas >0)){
            $total= $total/$total_respuestas;
            if(in_array($total, $puntuaciones)){
                $resp_premio = $bdd->select("select d.respuesta_cuantitativa from tbl_asignacion_a_revisor a 
					join tbl_revisiones_trabajo b on b.id_asignacion_a_revisor_fk = a.id_asignacion_a_revisor_pk
					join tbl_respuestas_revisiones_trabajos_cuantitativas c on c.id_revisiones_trabajo_fk = b.id_revisiones_trabajo_pk
					join tbl_respuesta_cuantitativa d on d.id_respuesta_cuantitativa_pk = c.id_respuesta_cuantitativa_fk
					join tbl_pregunta_cuantitativa e on e.id_pregunta_cuantitativa_pk = d.id_pregunta_cuantitativa_fk
					where a.id_trabajo_fk = ".$idtrabajo." and e.nombre_pregunta_cuantitativa like '%premio%'
					");
                foreach ($resp_premio as $resp) {
                    array_push($puntuaciones, $resp['respuesta_cuantitativa']) ;   
                }
              
            }else{
                array_push($trabajos_env, $titulo);
                array_push($puntuaciones, $total) ;
            }
            
        }
    }
    
    for($i= 0; $i<count($trabajos_env); $i++){
        $final['trabajo_p'.$i] = $trabajos_env[$i] ." --> " .$puntuaciones[$i];
    }
    
    /*echo print_r($final);*/
    arsort($final);
    $dato = reset($final);
    if($dato == ""){
        $html =" <label class='control-label' for='fullname'>@@titulotrab@@</label><div class='card-box widget-user'>";
        $html .= "<div class='form-group' ><label   class='control-label' for='fullname'>@@no_data@@</label></div>";  
        $html .= "</div>";
    }else{
        $html =" <label class='control-label' for='fullname'>@@titulotrab@@</label><div class='card-box widget-user'>";
        $html .= "<div class='radio radio-success'><input id='trabajo_auto' name='trabajo_auto' value='$idtrabajo' type='radio' checked><label for='radios' >$dato</label></div>";  
        $html .= "</div>";
    }
    $html1 = traducirstring($html, '../../../idiomas/es/es.php');
    echo $html1;
   
}