<?php

/* 
 * funciones formularios involucrados en Programa
 * @OBED
 */

require '../../../funciones/funcion_traducir.php';
session_start();
switch ($_POST['caso']) {
    
    case 'modificar_espacio':   //OBED
        modificar_espacio();
        break; 
    case 'modificar_actividad':   //JOSÉ
        modificar_actividad();
        break; 
    case 'divtrabajos_encontrados':   //Obed
        trabajos_encontrados();
        break;
    case 'divact_encontradas':   //Obed
        divact_encontradas();
        break;
    case 'distribucion_automatica_trabajos': //Obed
        distribucion_automatica_trabajos();
        break;
    case 'cambiartrabajos_de_actividadxtematica':
        cambiartrabajos_de_actividadxtematica();
        break;
    
    case 'mostrar_trabajos_sistema':
        mostrar_trabajos_sistema();
        break;
    case 'modificar_programa':
        modificar_programa();
        break;
    
    case 'autocompletarresponsable':
        autocompletarresponsable();
        break;
    case 'excel_indice_autores':
        excel_indice_autores();
        break;
    case 'excel_trabajos_sp':
        excel_trabajos_sp();
        break;
        
}
/*ALEXIS ESCOTO
12-01-2023
 */
function autocompletarresponsable(){
    require "../clases/class_programa.php";
    $obj = new programa();
    $responsable = filter_input(INPUT_POST, 'responsable');
  
    $data = [];
//    echo "select * from tbl_usuario a
//        join tbl_persona b on a.id_persona_fk=b.id_persona_pk
//        join tbl_correo c on c.id_persona_fk=a.id_persona_fk
//        where 1=1 and (a.nombre_usuario like '".$responsable."%') or (b.primer_nombre like '".$responsable."%') or (c.correo like '".$responsable."%')";
    
    $datos=$obj->auto_completar($responsable);
        $i=0;
        foreach ($datos as $fila) { 
            $data[$i]= $fila['primer_nombre']." ".$fila['segundo_nombre']." ".$fila['primer_apellido']." ".$fila['segundo_apellido']."/".$fila['correo']."/".$fila['nombre_usuario'];
            $i += 1;
        }
         echo '' . json_encode($data) . ''; 
}
/*ALEXIS ESCOTO
12-01-2023
 */
function modificar_espacio(){
    //print_r($_POST);

    require "../clases/class_programa.php";
    $obj = new programa();
    $idespacio = filter_input(INPUT_POST, 'idespacio');
    $valor = $obj->modificar_espacio();
    $datos=$obj->tbl_espacio($idespacio); 
       print_r($datos);
    foreach ($datos as $fila) { 
        $array=array('id_espacio_pk' => $fila['id_espacio_pk'],
            'nombre_espacio' => $fila['nombre_espacio'],
            'nombre_alternativo' => $fila['nombre_alternativo'],
            'descripcion_espacio' => $fila['descripcion_espacio'],
            'capacidad_personas' => $fila['capacidad_personas'], 
            'numero_tomacorriente' => $fila['numero_tomacorriente'], 
            'mapa_espacio' => $fila['mapa_espacio'], 
            'comentarios' => $fila['comentarios'], 
         );
    }
     echo '' . json_encode($array) . '';
}
function modificar_actividad(){
    
    $idactividad = filter_input(INPUT_POST, 'idactividad');
    global $bdd;
    $bdd = new basedatos();   
    $datos=$bdd->select("select a.id_actividad_pk, a.nombre_actividad,a.responsable,concat_ws(' ', f.primer_nombre, f.segundo_nombre, f.primer_apellido, f.segundo_apellido) as nombre, e.correo, d.nombre_usuario, a.fecha_actividad, a.hora_inicio, a.hora_final, a.comentarios, a.id_espacio_pk, a.id_tipo_actividad_fk, b.id_tematica_fk from tbl_actividad a
                        join tbl_actividad_tematica b on a.id_actividad_pk=b.id_actividad_fk
                        join tbl_tematica c on c.id_tematica_pk=b.id_tematica_fk
                        join tbl_usuario d on d.id_usuario_pk=a.responsable
                        join tbl_correo e on e.id_persona_fk=d.id_persona_fk and e.principal='1'
                        join tbl_persona f on f.id_persona_pk=e.id_persona_fk                        
                        where a.id_actividad_pk='".$idactividad."' "); 
    foreach ($datos as $fila) { 
        $array=array('id_actividad_pk' => $fila['id_actividad_pk'],
            'nombre_actividad' => $fila['nombre_actividad'],
            'responsable' => $fila['nombre']."/".$fila['correo']."/".$fila['nombre_usuario'],
            'comentarios' => $fila['comentarios'],
            'hora_inicio' => $fila['hora_inicio'], 
            'hora_final' => $fila['hora_final'], 
            'fecha_actividad' => $fila['fecha_actividad'], 
            'id_tematica_fk' => $fila['id_tematica_fk'], 
            'id_espacio_pk' => $fila['id_espacio_pk'],             
            'id_tipo_actividad_fk' => $fila['id_tipo_actividad_fk'],
            
         );
    }
     echo '' . json_encode($array) . '';
}


/*Trabajos encontrados*/
 /*ALEXIS ESCOTO
      INSTANCIACION DE METODO trabajos_encontrados
       */
  function trabajos_encontrados(){
    require '../../../clases/class_programa.php';
    $obj = new programa();
    $trabajos   =   $obj->tbr_encotrados(); 
    $filas = $trabajos;
    
   
    if($filas > 0){
        echo $filas;
    }else{
         echo 0;
    }
  }

  /*Trabajos encontrados*/
 /*ALEXIS ESCOTO
      INSTANCIACION DE METODO divact_encontradas
       */
function divact_encontradas(){
    require '../../../clases/class_programa.php';
    $obj = new programa();
    $trabajos   =   $obj->divact_encontradas(); 
  
    
    $filas = $trabajos;
   
    if($filas > 0){
        echo $filas;
    }else{
         echo 0;
    }
  }

  //Falta
function distribucion_automatica_trabajos(){ 
    $cantidad = filter_input(INPUT_POST, 'cantidad');
    $idcongreso = $_SESSION['idcongreso'];
    $idtematica = filter_input(INPUT_POST, 'idtematica');
    $cant_trab = filter_input(INPUT_POST, 'cant_trab');
    $cant_act = filter_input(INPUT_POST, 'cant_act');   
    /*print_r($_POST);*/
    global $bdd;
    $bdd = new basedatos();
    $html="";
    /*validamos que el numero de trabajos que existen sea mayor que la distribucion escogida*/
    if($cant_trab >= $cantidad){
        /*traemos los trabajos de este congreso por la tematica seleccionada*/
        /*Trabajos*/
        $datos = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.* from tbl_trabajo a  
                                    join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                    join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                    join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                    join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                    join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                    join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                    join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                    where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."' and b.id_tematica_pk='".$idtematica."' and f.autor_principal = '1' 
                                    group by a.titulo_trabajo order by a.titulo_trabajo asc"); 
        $filas = $datos->num_rows;
        /*Extraemos las actividades (sesiones paralelas) creadas para esta tematica*/
        /*Actividades*/
        $datos1 = $bdd->select("select a.*, b.*, c.*, d.*, e.* from tbl_actividad a 
                                    join tbl_actividad_tematica b on a.id_actividad_pk = b.id_actividad_fk
                                    join tbl_congreso_actividad c on a.id_actividad_pk = c.id_actividad_fk
                                    join tbl_tipo_actividad d on a.id_tipo_actividad_fk = d.id_tipo_actividad_pk
                                    join tbl_espacio e on a.id_espacio_pk = e.id_espacio_pk 
                                    where b.id_tematica_fk='".$idtematica."' and c.id_congreso_fk='".$idcongreso."' and d.id_tipo_actividad_pk='3'
                                    group by a.fecha_actividad , a.hora_inicio order by a.fecha_actividad , a.hora_inicio asc");
         $filas1 = $datos1->num_rows;
                     $i = 0;
                    $j = 0;
                    $array=array(); 
                    $array1=array();
                    $array_final=array(); 
                    $html = "";
                    /*Extraemos los datos de la BD*/
                    foreach ($datos as $fi) {                                       
                        $array['id_trabajo_pk'.$i] = $fi['id_trabajo_pk'];
                        $array['titulo_trabajo'.$i] = $fi['titulo_trabajo'];
                        $array['fecha_subida'.$i] = $fi['fecha_subida'];
                        $array['ubicacion_archivo'.$i] = $fi['ubicacion_archivo'];
                        $array['resumen'.$i] = $fi['resumen'];
                        $array['id_estado_fk'.$i] = $fi['id_estado_fk'];
                        $array['id_tematica_fk'.$i] = $fi['id_tematica_fk'];
                        $array['premio'.$i] = $fi['premio'];
                        $array['revista'.$i] = $fi['revista'];
                        $array['horario_sugerido'.$i] = $fi['horario_sugerido'];
                        $array['id_tipo_trabajo_fk'.$i] = $fi['id_tipo_trabajo_fk'];
                        $array['id_idioma_fk'.$i] = $fi['id_idioma_fk'];
                        $array['palabrasclave'.$i] = $fi['palabrasclave'];
                        $array['resumenprograma'.$i] = $fi['resumenprograma'];
                        $array['nombre_tematica'.$i] = $fi['nombre_tematica'];
                        $array['nombre_tipo_trabajo'.$i] = $fi['nombre_tipo_trabajo'];
                        $array['nombre_linea_investigacion'.$i] = $fi['nombre_linea_investigacion'];  
                        $array['primer_nombre'.$i] = $fi['primer_nombre']; 
                        $array['primer_apellido'.$i] = $fi['primer_apellido']; 
                        $i++;
                    }
                    foreach ($datos1 as $fila) {
                        $array1['id_actividad_pk'.$j] = $fila['id_actividad_pk'];
                        $array1['nombre_actividad'.$j] = $fila['nombre_actividad'];
                        $array1['hora_inicio'.$j] = $fila['hora_inicio'];
                        $array1['hora_final'.$j] = $fila['hora_final'];
                        $array1['presento'.$j] = $fila['presento'];
                        $array1['id_tipo_actividad_fk'.$j] = $fila['id_tipo_actividad_fk'];
                        $array1['id_espacio_pk'.$j] = $fila['id_espacio_pk'];
                        $array1['nombre_espacio'.$j] = $fila['nombre_espacio'];
                        $array1['fecha_actividad'.$j] = $fila['fecha_actividad'];
                        $array1['comentarios'.$j] = $fila['comentarios'];
                        $array1['responsable'.$j] = $fila['responsable'];
                        $array1['id_tematica_fk'.$j] = $fila['id_tematica_fk'];
                        $array1['id_linea_investigacion_pk'.$j] = $fila['id_linea_investigacion_pk'];
                        $array1['nombre_tipo_actividad'.$j] = $fila['nombre_tipo_actividad'];  
                        $j++;
                    }
                    $array['numtrabajos'] = $i; 
                    $array1['numactividades'] = $j;
                    $array_final = array_merge($array,$array1);
        
        /*contruimos las sesiones de acuerdo a la distribucion seleccionada*/
        
         if($filas > 0 && $filas1 > 0){ 
                if($cantidad == 4){                  
                   
                    /*contruyo la distribucion de acuerdo al arreglo con toda la info*/                  
                    /*contadores de trabajos*/
                    $r = 0;
                    for($p = 0; $p < $j; $p++){ /*actividades*/
                        if(isset($array_final['id_trabajo_pk'.$r])){
                        $html.="<tbody>";
                            /*contrucción de la estructura del programa*/
                            $html.="<tr><tr class='text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='3'><b>@@linea_i@@:</b><br> ".$array_final['nombre_linea_investigacion'.$p]."</td><td colspan='5'><b>@@tematica_trab@@:</b><br> ".$array_final['nombre_tematica'.$p]."</td></tr>
                             <tr class='m-b-0 text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='2'><b>@@numsesion@@:</b> ".($p + 1)."</td><td colspan='3'><b>@@encargado_sesion@@:</b> ".$array_final['primer_nombre'.$r]." ".$array_final['primer_apellido'.$r]."</td><td colspan='3'><b>@@espacio@@:</b>";
                            if(isset($array_final['nombre_espacio'.$r])){
                                $html.="'".$array_final['nombre_espacio'.$r]."'";                                        
                            }else{
                                $html.="'".$array_final['nombre_espacio'.$p]."'";
                            }
                             $html.="</td></tr></tr>";
                            /*contruyo la distribucion de acuerdo al arreglo con toda la info*/
                            /*recorro el array*/
                               
                            $horainicialdelostrabajos = $array_final['hora_inicio'.$p];
                            for($t = 0; $t < 4; $t++){
                                
                                 if(isset($array_final['id_trabajo_pk'.$r])){
                                  /*autores de cada trabajo*/
                                    $idtrabajo = $array_final['id_trabajo_pk'.$r];
                                    /*autores del trabajo*/
                                    $datos2 = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.* from tbl_trabajo a 
                                            join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                            join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                            join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                            join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                            join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                            join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                            join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                            where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."' and b.id_tematica_pk='".$idtematica."' and a.id_trabajo_pk='".$idtrabajo."'");
                                    $filas2 = $datos2->num_rows;
                                    /*contrucción de la estructura del programa*/
                                    $var = 0; /*variable contador para fechas de actividad*/
                                    if(isset($array_final['id_actividad_pk'.$p])){
                                        $fecha = $array_final['fecha_actividad'.$p];
                                        setlocale(LC_ALL,'Spanish_Honduras');
                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));
                                        
                                                                                
                                        $horai = $horainicialdelostrabajos;
                                        
                                        $newhorai = date("g:i A",strtotime($horai));
                                        $segundos_horaInicial=strtotime($horai);
                                        $segundos_minutoAnadir=15*60;
                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                        
//                                        $horaf = $array_final['hora_final'.$p];
//                                        $newhoraf = date("g:i A",strtotime($horaf));
                                        $horainicialdelostrabajos = $newhoraf;
                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                        <td>".$newhorai."</td>
                                        <td>".$newhoraf."</td>                                                        
                                        <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                        <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                        <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                        <td>".$array_final['id_idioma_fk'.$r]."</td>
                                        <td>";
                                        foreach ($datos2 as $val) {
               //                             if($val['autor_principal'] != 1){
                                                  $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
               //                             }
                                        }
                                        $html.="</td></tr>";
                                        $r += 1;
                                        $var = $p;
                                    }else{
                                        $fecha = $array_final['fecha_actividad'.$var];
                                        setlocale(LC_ALL,'Spanish_Honduras');
                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));
                                        
                                                                                
                                        $horai = $horainicialdelostrabajos;
                                        
                                        $newhorai = date("g:i A",strtotime($horai));
                                        $segundos_horaInicial=strtotime($horai);
                                        $segundos_minutoAnadir=15*60;
                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                        $horainicialdelostrabajos = $newhoraf;
                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                        <td>".$newhorai."</td>
                                        <td>".$newhoraf."</td>                                                        
                                        <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                        <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                        <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                        <td>".$array_final['id_idioma_fk'.$r]."</td>
                                        <td>";
                                        foreach ($datos2 as $val) {
                                            $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                        }
                                        $html.="</td></tr>";
                                        $r += 1;
                                    }
                                 }                              
                            }
                            
                        }
                    }
                    
                    if($r < $i){/*construyo las secciones con trabajos sobrantes*/     
                         $html.="<tr><td  colspan='8' style='text-align: center; font-size: 16px;'><div class='alert alert-danger'>
                        <strong>@@importante@@! </strong> @@cree_mas_sesiones@@ !!!</div></td></tr>";
                    }
                    $html.="</tbody>";
                    $html1 = traducirstring($html, '../../../idiomas/es/es.php');
                    echo $html1;
                    
                /*
                 * 
                 * 
                 * final 4 trabajos por hora
                 * Inicio 3 trabajo por hora
                 * 
                 * 
                 */   
                }else if($cantidad == 3){                    
                    /*contruyo la distribucion de acuerdo al arreglo con toda la info*/                  
                    /*contadores de trabajos*/
                    $r = 0;
                    for($p = 0; $p < $j; $p++){ /*actividades*/
                        if(isset($array_final['id_trabajo_pk'.$r])){
                        $html.="<tbody>";
                            /*contrucción de la estructura del programa*/
                            $html.="<tr><tr class='text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='3'><b>@@linea_i@@:</b><br> ".$array_final['nombre_linea_investigacion'.$p]."</td><td colspan='5'><b>@@tematica_trab@@:</b><br> ".$array_final['nombre_tematica'.$p]."</td></tr>
                             <tr class='m-b-0 text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='2'><b>@@numsesion@@:</b> ".($p + 1)."</td><td colspan='3'><b>@@encargado_sesion@@:</b> ".$array_final['primer_nombre'.$r]." ".$array_final['primer_apellido'.$r]."</td><td colspan='3'><b>@@espacio@@:</b>";
                            if(isset($array_final['nombre_espacio'.$r])){
                                $html.="'".$array_final['nombre_espacio'.$r]."'";                                        
                            }else{
                                $html.="'".$array_final['nombre_espacio'.$p]."'";
                            }
                             $html.="</td></tr></tr>";
                            /*contruyo la distribucion de acuerdo al arreglo con toda la info*/
                            /*recorro el array*/
                               
                            $horainicialdelostrabajos = $array_final['hora_inicio'.$p];
                            for($t = 0; $t < 3; $t++){
                                
                                 if(isset($array_final['id_trabajo_pk'.$r])){
                                  /*autores de cada trabajo*/
                                    $idtrabajo = $array_final['id_trabajo_pk'.$r];
                                    /*autores del trabajo*/
                                    $datos2 = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.* from tbl_trabajo a 
                                            join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                            join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                            join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                            join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                            join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                            join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                            join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                            where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."' and b.id_tematica_pk='".$idtematica."' and a.id_trabajo_pk='".$idtrabajo."'");
                                    $filas2 = $datos2->num_rows;
                                    /*contrucción de la estructura del programa*/
                                    $var = 0; /*variable contador para fechas de actividad*/
                                    if(isset($array_final['id_actividad_pk'.$p])){
                                        $fecha = $array_final['fecha_actividad'.$p];
                                        setlocale(LC_ALL,'Spanish_Honduras');
                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));
                                        
                                                                                
                                        $horai = $horainicialdelostrabajos;
                                        
                                        $newhorai = date("g:i A",strtotime($horai));
                                        $segundos_horaInicial=strtotime($horai);
                                        $segundos_minutoAnadir=20*60;
                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                        
                                        $horainicialdelostrabajos = $newhoraf;
                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                        <td>".$newhorai."</td>
                                        <td>".$newhoraf."</td>                                                        
                                        <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                        <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                        <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                        <td>".$array_final['id_idioma_fk'.$r]."</td>
                                        <td>";
                                        foreach ($datos2 as $val) {
                                            $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                        }
                                        $html.="</td></tr>";
                                        $r += 1;
                                        $var = $p;
                                    }else{
                                        $fecha = $array_final['fecha_actividad'.$var];
                                        setlocale(LC_ALL,'Spanish_Honduras');
                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));                                        
                                                                                
                                        $horai = $horainicialdelostrabajos;
                                        
                                        $newhorai = date("g:i A",strtotime($horai));
                                        $segundos_horaInicial=strtotime($horai);
                                        $segundos_minutoAnadir=20*60;
                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                        $horainicialdelostrabajos = $newhoraf;
                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                        <td>".$newhorai."</td>
                                        <td>".$newhoraf."</td>                                                        
                                        <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                        <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                        <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                        <td>".$array_final['id_idioma_fk'.$r]."</td>
                                        <td>";
                                        foreach ($datos2 as $val) {
                                                  $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                        }
                                        $html.="</td></tr>";
                                        $r += 1;
                                    }
                                 }                              
                            }
                            
                        }
                    }
                    if($r < $i){/*construyo las secciones con trabajos sobrantes*/     
                         $html.="<tr><td  colspan='8' style='text-align: center; font-size: 16px;'><div class='alert alert-danger'>
                        <strong>@@importante@@! </strong> @@cree_mas_sesiones@@ !!!</div></td></tr>";
                    }
                    $html.="</tbody>";
                    $html1 = traducirstring($html, '../../../idiomas/es/es.php');
                    echo $html1;
                    
                /*
                 * 
                 * 
                 * final 3 trabajos por hora
                 * Inicio 2 trabajo por hora
                 * 
                 * 
                 */   
                        
                }else if($cantidad == 2){                   
                    /*contruyo la distribucion de acuerdo al arreglo con toda la info*/                  
                    /*contadores de trabajos*/
                    $r = 0;
                    for($p = 0; $p < $j; $p++){ /*actividades*/  
                        if(isset($array_final['id_trabajo_pk'.$r])){
                        $html.="<tbody>";
                            /*contrucción de la estructura del programa*/
                            $html.="<tr><tr class='text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='3'><b>@@linea_i@@:</b><br> ".$array_final['nombre_linea_investigacion'.$p]."</td><td colspan='5'><b>@@tematica_trab@@:</b><br> ".$array_final['nombre_tematica'.$p]."</td></tr>
                             <tr class='m-b-0 text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='2'><b>@@numsesion@@:</b> ".($p + 1)."</td><td colspan='3'><b>@@encargado_sesion@@:</b> ".$array_final['primer_nombre'.$r]." ".$array_final['primer_apellido'.$r]."</td><td colspan='3'><b>@@espacio@@:</b>";
                            if(isset($array_final['nombre_espacio'.$r])){
                                $html.="'".$array_final['nombre_espacio'.$r]."'";                                        
                            }else{
                                $html.="'".$array_final['nombre_espacio'.$p]."'";
                            }
                             $html.="</td></tr></tr>";
                            /*contruyo la distribucion de acuerdo al arreglo con toda la info*/
                            /*recorro el array*/
                               
                            $horainicialdelostrabajos = $array_final['hora_inicio'.$p];
                            for($t = 0; $t < 2; $t++){
                                 if(isset($array_final['id_trabajo_pk'.$r])){
                                  /*autores de cada trabajo*/
                                    $idtrabajo = $array_final['id_trabajo_pk'.$r];
                                    /*autores del trabajo*/
                                    $datos2 = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.* from tbl_trabajo a 
                                            join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                            join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                            join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                            join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                            join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                            join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                            join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                            where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."' and b.id_tematica_pk='".$idtematica."' and a.id_trabajo_pk='".$idtrabajo."'");
                                    $filas2 = $datos2->num_rows;
                                    /*contrucción de la estructura del programa*/
                                    $var = 0; /*variable contador para fechas de actividad*/
                                    if(isset($array_final['id_actividad_pk'.$p])){
                                        $fecha = $array_final['fecha_actividad'.$p];
                                        setlocale(LC_ALL,'Spanish_Honduras');
                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));                                        
                                                                                
                                        $horai = $horainicialdelostrabajos;
                                        
                                        $newhorai = date("g:i A",strtotime($horai));
                                        $segundos_horaInicial=strtotime($horai);
                                        $segundos_minutoAnadir=30*60;
                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                        
                                        $horainicialdelostrabajos = $newhoraf;
                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                        <td>".$newhorai."</td>
                                        <td>".$newhoraf."</td>                                                        
                                        <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                        <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                        <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                        <td>".$array_final['id_idioma_fk'.$r]."</td>
                                        <td>";
                                        foreach ($datos2 as $val) {
                                            $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                        }
                                        $html.="</td></tr>";
                                        $r += 1;
                                        $var = $p;
                                    }else{
                                        $fecha = $array_final['fecha_actividad'.$var];
                                        setlocale(LC_ALL,'Spanish_Honduras');
                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));                                        
                                                                                
                                        $horai = $horainicialdelostrabajos;
                                        
                                        $newhorai = date("g:i A",strtotime($horai));
                                        $segundos_horaInicial=strtotime($horai);
                                        $segundos_minutoAnadir=30*60;
                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                        $horainicialdelostrabajos = $newhoraf;
                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                        <td>".$newhorai."</td>
                                        <td>".$newhoraf."</td>                                                        
                                        <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                        <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                        <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                        <td>".$array_final['id_idioma_fk'.$r]."</td>
                                        <td>";
                                        foreach ($datos2 as $val) {
                                            $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                        }
                                        $html.="</td></tr>";
                                        $r += 1;
                                    }
                                }                             
                            }
                            
                        }
                    }
                    if($r < $i){/*construyo las secciones con trabajos sobrantes*/     
                         $html.="<tr><td  colspan='8' style='text-align: center; font-size: 16px;'><div class='alert alert-danger'>
                        <strong>@@importante@@! </strong> @@cree_mas_sesiones@@ !!!</div></td></tr>";
                    }
                    $html.="</tbody>";
                    $html1 = traducirstring($html, '../../../idiomas/es/es.php');
                    echo $html1;
                    
                /*
                 * 
                 * 
                 * final 2 trabajos por hora
                 * Inicio 1 trabajo por hora
                 * 
                 * 
                 */                 
                }else if($cantidad == 1){ 
//                    if($cant_trab == $cant_act){                                        
                            /*contruyo la distribucion de acuerdo al arreglo con toda la info*/
                            /*recorro el array*/
                            $html.="<tbody>"; 
//                            $horainicialdelostrabajos = $array_final['hora_inicio0']; /*hora inicial de la ultima actividad*/
//                            $fechafinal = $array_final['fecha_actividad'.($j-1)]; /*fecha de la ultima actividad*/
                            $t = 0;
                            for($r=0;$r < $i; $r++){/*autores de cada trabajo*/
                                 if(isset($array_final['id_trabajo_pk'.$r])){
                                        $idtrabajo = $array_final['id_trabajo_pk'.$r];                               
                                        /*autores del trabajo*/
                                            $datos2 = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.* from tbl_trabajo a 
                                                    join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                                    join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                                    join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                                    join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                                    join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                                    join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                                    join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                                    where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."' and b.id_tematica_pk='".$idtematica."' and a.id_trabajo_pk='".$idtrabajo."'");
                                            $filas2 = $datos2->num_rows;
                                        /*contrucción de la estructura del programa*/
                                        /*verifico si esta definida la act sino igual me las contruira sumando fechas y horas*/ 
                                        //$var = 0;/*ULTIMO VALOR EXISTENTE DE ACT*/   

                                         if(isset($array_final['id_actividad_pk'.$r])){
                                                $html.="<tr><tr class='text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;' ><td colspan='3'><b>@@linea_i@@:</b><br> ".$array_final['nombre_linea_investigacion'.$r]."</td><td colspan='5'><b>@@tematica_trab@@:</b><br> ".$array_final['nombre_tematica'.$r]."</td></tr>
                                                <tr class='m-b-0 text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='2'><b>@@numsesion@@:</b> ".($r + 1)."</td><td colspan='3'><b>@@encargado_sesion@@:</b> ".$array_final['primer_nombre'.$r]." ".$array_final['primer_apellido'.$r]."</td><td colspan='3'><b>@@espacio@@:</b>".$array_final['nombre_espacio'.$r]."</td></tr></tr>";
                                                $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$array_final['fecha_actividad'.$r]."</td>
                                                <td>".$array_final['hora_inicio'.$r]."</td>
                                                <td>".$array_final['hora_final'.$r]."</td>                                                        
                                                <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                                <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                                <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                                <td>".$array_final['id_idioma_fk'.$r]."</td>
                                                <td>";
                                                foreach ($datos2 as $val) {
                                                          $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                                }
                                                $html.="</td></tr>";
                                                            /*$var = $r;
                                                            $ult = $r;*/
                                         }else{
                                             $t+=1;
                                         }
                                         /*else{
                                             
                                                $html.="<tr><tr class='text-purple' style='background-color: #dae6ec;'><td colspan='3'><b>@@linea_i@@:</b><br> ".$array_final['nombre_linea_investigacion'.$ult]."</td><td colspan='5'><b>@@tematica_trab@@:</b><br> ".$array_final['nombre_tematica'.$ult]."</td></tr>
                                                <tr class='m-b-0 text-purple' style='background-color: #dae6ec;'><td colspan='2'><b>@@numsesion@@:</b> ".($r + 1)."</td><td colspan='3'><b>@@encargado_sesion@@:</b> ".$array_final['primer_nombre'.$r]." ".$array_final['primer_apellido'.$r]."</td><td colspan='3'><b>@@espacio@@:</b>".$array_final['nombre_espacio'.$ult]."</td></tr></tr>";

                                                $fecha = $fechafinal;
                                                setlocale(LC_ALL,'Spanish_Honduras');
                                                $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                                $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));                                        

                                                $horai = $horainicialdelostrabajos;

                                                $newhorai = date("g:i A",strtotime($horai));
                                                $segundos_horaInicial=strtotime($horai);
                                                $segundos_minutoAnadir=60*60;
                                                $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                                $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                                $horainicialdelostrabajos = $newhoraf;
                                                $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                                <td>".$newhorai."</td>
                                                <td>".$newhoraf."</td>                                                         
                                                <td align='justify'>".$array_final['titulo_trabajo'.$r]."</td>
                                                <td align='justify'>".$array_final['resumenprograma'.$r]."</td>
                                                <td>".$array_final['nombre_tipo_trabajo'.$r]."</td>
                                                <td>".$array_final['id_idioma_fk'.$r]."</td>
                                                <td>";
                                                foreach ($datos2 as $val) {
                                                    $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                                }
                                                $html.="</td></tr>";
                                                $var +=1;
                                         }*/

                                }
                            }
                            if($t > 0){/*construyo las secciones con trabajos sobrantes*/     
                                $html.="<tr><td  colspan='8' style='text-align: center; font-size: 16px;'><div class='alert alert-danger'>
                               <strong>@@importante@@! </strong> @@cree_mas_sesiones@@ !!!</div></td></tr>";
                            }                                               
                            $html.="</tbody>";
                            $html1 = traducirstring($html, '../../../idiomas/es/es.php');
                            echo $html1;
                    
                    
//                    }else{                            
//                            echo '2';
//                    }
                }
                /*
                * 
                *final 1 trabajo por hora
                * 
                */
         }else{
             echo '3'; /*ERROR*/
         }
    }else{
        echo '1';
    }
    
}

function cambiartrabajos_de_actividadxtematica(){   
    $idtem = filter_input(INPUT_POST, "idtem");
    
    global $bdd;
    $bdd = new basedatos();
    $act = $bdd->select("select * from tbl_actividad a                 
                join tbl_actividad_trabajo b on a.id_actividad_pk = b.id_actividad_fk
                join tbl_actividad_tematica c on a.id_actividad_pk = c.id_actividad_fk
                where 1=1 and c.id_tematica_fk=".$idtem." group by a.fecha_actividad , a.hora_inicio
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
    $html1 = traducirstring($html, '../../../idiomas/es/es.php');
    echo $html1;
}

function mostrar_trabajos_sistema(){
    global $bdd;
    $bdd = new basedatos(); 
    $idcongreso = $_SESSION['idcongreso'];
    $idprograma = filter_input(INPUT_POST, 'idprograma');
    $array_tipo = array();
    $a = 0;
    $total_trabajos=0;
    $html ="";
    $linea = $bdd->select("select * from tbl_linea_investigacion a 
        join tbl_congreso_linea_investigacion b on b.id_linea_investigacion_pk = a.id_linea_investigacion_pk
        where b.id_congreso_pk = $idcongreso
        order by a.nombre_linea_investigacion");
    
    $html.="<table class='table2excel' data-tableName='Test Table 1' >
            <thead>
                <tr>
                    <th><b>@@linea_investigacion@@</b></th>
                    <th><b>@@ntematica@@</b></th>";    
                    $tipo_trabajo = $bdd->select("select * from tbl_tipo_trabajo a 
                        join tbl_congreso_tipo_trabajo b on b.id_tipo_trabajo_fk = a.id_tipo_trabajo_pk
                        where b.id_congreso_fk =  $idcongreso");
                    foreach ($tipo_trabajo as $t_tra){
                        $t_trabajo = $t_tra['nombre_tipo_trabajo'];
                        $array_tipo[$a] = $t_tra['id_tipo_trabajo_pk'];
                        $html .= "<th><b>".$t_trabajo."</b></th>"; 
                        $a++;
                    }
    $html .= "<th><b>@@total_tematica@@</b></th>
              <th><b>@@total_linea@@</b></th>
            </tr></thead><tbody>";
                    
    foreach ($linea as $value) {
        $tema_lin ="";$tra_tem = "";$tipo1= "";$tipo2= "";$tipo3= "";$tipo4= "";$tipo5= "";$sumar_linea= 0;$total_tematica = 0;
        $nombre_linea = $value['nombre_linea_investigacion'];
        $idlinea = $value['id_linea_investigacion_pk'];
        
        $tematica = $bdd->select("select * from tbl_tematica where id_linea_investigacion_fk = $idlinea order by  nombre_tematica ASC");
        
        $html .= "<tr><td><b>$nombre_linea</b></td>";
            foreach ($tematica as $tem) {
                $suma = 0 ;
                $idtematica = $tem['id_tematica_pk'];
                $nombre_tematica = $tem['nombre_tematica'];
                
                foreach ($tipo_trabajo as $val){
                    $tipos = $val['id_tipo_trabajo_pk'];
                    $tra_tem = $bdd->select("Select count(*) as contar from tbl_trabajo a
                        join tbl_actividad_trabajo g on g.id_trabajo_fk = a.id_trabajo_pk
                        join tbl_programa_actividad h on  g.id_actividad_fk = h.id_actividad_fk
                        join tbl_tematica b on b.id_tematica_pk = a.id_tematica_fk
                        join tbl_linea_investigacion  c on c.id_linea_investigacion_pk = b.id_linea_investigacion_fk
                        where c.id_linea_investigacion_pk = $idlinea and a.id_tipo_trabajo_fk =$tipos  "
                            . "and b.id_tematica_pk = $idtematica and a.id_estado_fk !=2 and h.id_programa_fk=$idprograma");
                        foreach($tra_tem as $tra_tema){
                            $sumar_linea +=  intval($tra_tema['contar']) . "";
                            $suma +=  intval($tra_tema['contar']);
                            if($tipos == 1){
                                $tipo1 .=  "<b>" . $tra_tema['contar']."</b></br>" ;
                            }else if($tipos == 2){
                                $tipo2 .=  "<b>". $tra_tema['contar']."</b></br>" ;
                            }else if($tipos == 3){
                                $tipo3 .=  "<b>" . $tra_tema['contar']."</b></br>" ;
                            }else if($tipos == 4){
                                $tipo4 .=  "<b>" . $tra_tema['contar']."</b></br>" ;
                            }else if($tipos == 5){
                                $tipo5 .=  "<b>" . $tra_tema['contar']."</b></br>" ;
                            }
                        }
                }
                $total_tematica .="<b>". $suma . "</b></br>";
                $tema_lin .="<b>". $nombre_tematica  . "</b></br>";
            }
            $html .= "<td>$tema_lin</td>
                       <td>$tipo1</td>
                       <td>$tipo2</td>
                       <td>$tipo3</td>
                       <td>$tipo4</td>
                       <td>$tipo5</td>
                       <td>$total_tematica</td>
                       <td>$sumar_linea</td>
                    </tr>";
    }
    
    $total_t = $bdd->select("select count(*) as contar from tbl_trabajo a
                            join tbl_actividad_trabajo g on g.id_trabajo_fk = a.id_trabajo_pk
                            join tbl_programa_actividad h on  g.id_actividad_fk = h.id_actividad_fk
                            join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk                
                            join tbl_congreso_linea_investigacion c on b.id_linea_investigacion_fk=c.id_linea_investigacion_pk and c.id_congreso_pk = ".$idcongreso."
                            where a.id_estado_fk !=2 and h.id_programa_fk=$idprograma");
    foreach ($total_t as $tt) {
        $total_trabajos = $tt['contar'];
    }
        $html .= "
           <tbody>
           <tfoot>
            <tr><td><b>@@total_trabajos@@</b></td>
                <td><b>$total_trabajos</b></td></tr><tfoot></table>";
   
    $html1 = traducirstring($html, '../../../idiomas/es/es.php');
    echo ($html1);
}
/*Alexis Escoto 08/12/2022
    Cuenta:20161000817
   de instancia de clase programa,  modificar_programa
 
    */
function modificar_programa(){
//    print_r($_POST);

require '../../../clases/class_programa.php';
$obj = new programa();

$datos   =   $obj->modificar_programa(); 



   
    $i = 0;
    foreach ($datos as $fila) { 
            $array['id_programa_pk'.$i] = $fila['id_programa_pk'];
            $array['nombre_programa'.$i] = $fila['nombre_programa'];
            $array['descripcion'.$i] = $fila['descripcion'];
            $array['estado_programa'.$i] = $fila['estado_programa']; 
            $array['id_actividad_pk'.$i] = $fila['id_actividad_pk'];
            $array['nombre_actividad'.$i] = $fila['nombre_actividad'];
            $array['responsable'.$i] = $fila['responsable'];
            $array['comentarios'.$i] = $fila['comentarios'];
            $array['hora_inicio'.$i] = $fila['hora_inicio']; 
            $array['hora_final'.$i] = $fila['hora_final'];
            $array['fecha_actividad'.$i] = $fila['fecha_actividad']; 
            $array['id_tematica_fk'.$i] = $fila['id_tematica_fk']; 
            $array['id_espacio_pk'.$i] = $fila['id_espacio_pk'];             
            $array['id_tipo_actividad_fk'.$i] = $fila['id_tipo_actividad_fk'];
            $i++;
    }
    $array['num_act'] = $i;
     echo '' . json_encode($array) . '';
    
}

function excel_indice_autores(){
    global $bdd;
    $bdd = new basedatos(); 
    $idcongreso = $_SESSION['idcongreso'];
    $autor = array();
    $act_autor = array();
    $i = 0;$filas = 1;
    
    $html ="";
    $autorest = $bdd->select("Select distinct * from tbl_trabajo a             
            join tbl_usuario_trabajo b on b.id_trabajo_fk = a.id_trabajo_pk
            join tbl_usuario c on c.id_usuario_pk = b.id_usuario_fk
            join tbl_persona d on d.id_persona_pk = c.id_persona_fk
            join tbl_tematica e on a.id_tematica_fk = e.id_tematica_pk                
            join tbl_congreso_linea_investigacion f on e.id_linea_investigacion_fk=f.id_linea_investigacion_pk 
            join tbl_actividad_trabajo g on g.id_trabajo_fk = a.id_trabajo_pk
            join tbl_actividad h on h.id_actividad_pk = g.id_actividad_fk
            where f.id_congreso_pk = ".$idcongreso." 
            group by d.primer_apellido, h.fecha_actividad,  h.hora_inicio
            order by d.primer_apellido, h.fecha_actividad, h.hora_inicio asc");
    
    foreach ($autorest as $val) {
        $autor['id_persona_pk'.$i]  = $val['id_persona_pk'];
        $autor['primer_apellido'.$i]  = $val['primer_apellido'];
        $autor['primer_nombre'.$i]  = $val['primer_nombre'];
        $autor['id_actividad_pk'.$i]  = $val['id_actividad_pk'];
        $autor['nombre_actividad'.$i]  = $val['nombre_actividad'];
        $autor['fecha_actividad'.$i]  = $val['fecha_actividad'];
        $autor['hora_inicio'.$i]  = $val['hora_inicio']; 
        
        if($i==0){
            $act_autor['id_persona_pk'.$i] = $val['id_persona_pk'];                
        }else{
            if(!in_array($val['id_persona_pk'], $act_autor)){
                $act_autor['id_persona_pk'.$i] = $val['id_persona_pk']; 
            }
        }
        $i++;
    }
    $html.="<table class='table2excel' data-tableName='Test Table 1' >
            <thead>
                <tr>
                    <th><b>N.</b></th>                    
                    <th><b>@@primer_apellido@@</b></th>
                    <th><b>@@primer_nombre@@</b></th>
                    <th><b>@@idactividad@@</b></th>                    
                    <th><b>@@nombreactividad@@</b></th>
                    <th><b>@@fechaactividad@@</b></th>
                    <th><b>@@horaactividad@@</b></th> 
                </tr>
            </thead>
            <tbody>";
        for($j = 0; $j < $i; $j++){
            $html.="<tr>
                        <td>".$filas."</td>
                        <td>".$autor['primer_apellido'.$j]."</td>
                        <td>".$autor['primer_nombre'.$j]."</td>
                        <td>".$autor['id_actividad_pk'.$j]."</td>
                        <td>".$autor['nombre_actividad'.$j]."</td>
                        <td>".$autor['fecha_actividad'.$j]."</td>
                        <td>".$autor['hora_inicio'.$j]."</td>                                            
                    </tr>";            
            $filas+=1;
            
        }
    $html.="</tbody>
           <tfoot>
            <tr><td><b>@@total_autores@@</b></td>
                <td><b>".  count($act_autor) ."</b></td></tr><tfoot></table>";   
            $html1 = traducirstring($html, '../../../idiomas/es/es.php');
            echo ($html1);
}



function excel_trabajos_sp(){
    $cantidad = filter_input(INPUT_POST, 'cantidad');
    $idcongreso = $_SESSION['idcongreso'];
    $idprograma = filter_input(INPUT_POST, 'idprograma');
    global $bdd;
    $bdd = new basedatos();
    $html="";
   
        
        /*Extraemos las actividades (sesiones paralelas) creadas para esta tematica*/
        /*Actividades*/
        $datos1 = $bdd->select("select a.*, b.*, c.*, d.*, e.*,f.*,g.*  from tbl_actividad a 
                                    join tbl_actividad_tematica b on a.id_actividad_pk = b.id_actividad_fk
                                    join tbl_congreso_actividad c on a.id_actividad_pk = c.id_actividad_fk
                                    join tbl_tipo_actividad d on a.id_tipo_actividad_fk = d.id_tipo_actividad_pk
                                    join tbl_espacio e on a.id_espacio_pk = e.id_espacio_pk 
                                    join tbl_tematica f on b.id_tematica_fk = f.id_tematica_pk 
                                    join tbl_linea_investigacion g on f.id_linea_investigacion_fk = g.id_linea_investigacion_pk 
                                    where c.id_congreso_fk='".$idcongreso."' and d.id_tipo_actividad_pk='3'
                                    group by a.fecha_actividad , a.hora_inicio order by a.fecha_actividad , a.hora_inicio asc");
         $filas1 = $datos1->num_rows;
                     $i = 0;
                    $j = 0;
                    $arraytrabajos=array(); 
                    $arrayactividades=array();
                    $array_final=array(); 
                    $html = "";
                    /*Extraemos los datos de la BD*/
                   
                    foreach ($datos1 as $fila) {
                        $arrayactividades['id_actividad_pk'.$j] = $fila['id_actividad_pk'];
                        $arrayactividades['nombre_actividad'.$j] = $fila['nombre_actividad'];
                        $arrayactividades['hora_inicio'.$j] = $fila['hora_inicio'];
                        $arrayactividades['hora_final'.$j] = $fila['hora_final'];
                        $arrayactividades['presento'.$j] = $fila['presento'];
                        $arrayactividades['id_tipo_actividad_fk'.$j] = $fila['id_tipo_actividad_fk'];
                        $arrayactividades['id_espacio_pk'.$j] = $fila['id_espacio_pk'];
                        $arrayactividades['nombre_espacio'.$j] = $fila['nombre_espacio'];
                        $arrayactividades['fecha_actividad'.$j] = $fila['fecha_actividad'];
                        $arrayactividades['comentarios'.$j] = $fila['comentarios'];
                        $arrayactividades['responsable'.$j] = $fila['responsable'];
                        $arrayactividades['id_tematica_fk'.$j] = $fila['id_tematica_fk'];
                        $arrayactividades['nombre_tematica'.$j] = $fila['nombre_tematica'];
                        $arrayactividades['id_linea_investigacion_pk'.$j] = $fila['id_linea_investigacion_pk'];
                        $arrayactividades['nombre_linea_investigacion'.$j] = $fila['nombre_linea_investigacion'];
                        $arrayactividades['nombre_tipo_actividad'.$j] = $fila['nombre_tipo_actividad']; 
                        $arrayactividades['distribucion_sesiones_paralelas'.$j] = $fila['distribucion_sesiones_paralelas']; 
                        $j++;
                    }                    
                    $arrayactividades['numactividades'] = $j;
        
        /*contruimos las sesiones de acuerdo a la distribucion seleccionada*/
        
         $html.="<table class='table2excel' data-tableName='Test Table 1' >
            <thead>
                <tr class='alert alert-success'>
                    <th><b>@@dia_fecha@@</b></th>                    
                    <th><b>@@hinicio@@</b></th>
                    <th><b>@@hfinal@@</b></th>
                    <th><b>@@titulotrabajo@@</b></th>                    
                    <th><b>@@resumentrabajo@@</b></th>
                    <th><b>@@tipotrabajo@@</b></th>
                    <th><b>@@idiomatrabajo@@</b></th> 
                    <th><b>@@autores@@</b></th>
                </tr>
            </thead>"; 
         if($filas1 > 0){
                 $r = 0;
                 for($p = 0; $p < $j; $p++){ /*actividades*/
                     /*extraigo la distribucion de la tematica a la que pertenece esta actividad*/
                    $distribucion = $arrayactividades['distribucion_sesiones_paralelas'.$p];   
                    
                    /*TRAER LOS TRABAJOS QUE PERTENECEN A LA TEMATICA Y A ESTA ACTIVIDAD*/
                    $data = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.*, h.* from tbl_trabajo a  
                                    join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                    join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                    join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                    join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                    join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                    join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                    join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                    join tbl_actividad_trabajo h on a.id_trabajo_pk = h.id_trabajo_fk  
                                    where  f.autor_principal = '1' and a.id_tematica_fk='".$arrayactividades['id_tematica_fk'.$p]."' and h.id_actividad_fk='".$arrayactividades['id_actividad_pk'.$p]."' 
                                    group by a.titulo_trabajo order by a.titulo_trabajo asc");
                    $rows = $data->num_rows;
                     foreach ($data as $fi) {                                       
                        $arraytrabajos['id_trabajo_pk'.$i] = $fi['id_trabajo_pk'];
                        $arraytrabajos['titulo_trabajo'.$i] = $fi['titulo_trabajo'];
                        $arraytrabajos['fecha_subida'.$i] = $fi['fecha_subida'];
                        $arraytrabajos['ubicacion_archivo'.$i] = $fi['ubicacion_archivo'];
                        $arraytrabajos['resumen'.$i] = $fi['resumen'];
                        $arraytrabajos['id_estado_fk'.$i] = $fi['id_estado_fk'];
                        $arraytrabajos['id_tematica_fk'.$i] = $fi['id_tematica_fk'];
                        $arraytrabajos['premio'.$i] = $fi['premio'];
                        $arraytrabajos['revista'.$i] = $fi['revista'];
                        $arraytrabajos['horario_sugerido'.$i] = $fi['horario_sugerido'];
                        $arraytrabajos['id_tipo_trabajo_fk'.$i] = $fi['id_tipo_trabajo_fk'];
                        $arraytrabajos['id_idioma_fk'.$i] = $fi['id_idioma_fk'];
                        $arraytrabajos['palabrasclave'.$i] = $fi['palabrasclave'];
                        $arraytrabajos['resumenprograma'.$i] = $fi['resumenprograma'];
                        $arraytrabajos['nombre_tematica'.$i] = $fi['nombre_tematica'];
                        $arraytrabajos['nombre_tipo_trabajo'.$i] = $fi['nombre_tipo_trabajo'];
                        $arraytrabajos['nombre_linea_investigacion'.$i] = $fi['nombre_linea_investigacion'];  
                        $arraytrabajos['primer_nombre'.$i] = $fi['primer_nombre']; 
                        $arraytrabajos['primer_apellido'.$i] = $fi['primer_apellido']; 
                        $i++;
                    }
                    $arraytrabajos['numtrabajos'] = $i; 
                    $e = 0; /*variable que almacena la posicion delos trabajos pertenecientes a
//                     * esta tematica para continuar con la distribucion al cambiar de actividad */
                    if($distribucion > 0){
                        if($rows > 0){/*existen trabajos*/
                            /*
                             * Constuimos html cuerpo de la tabla
                             */
                            $res = $rows / $distribucion;
                            if(isset($res)){
                                if(is_float($res)){
                                    $redon = round($res,0);
                                }else{
                                    $redon = $res;
                                }
                                $s = 0;
                                /*ASignación de tiempo de duración por cada trabajo*/
                                $horainicialdelostrabajos = $arrayactividades['hora_inicio'.$p]; 
                                while ($s < $redon) {
                                        $html.="<tbody>";
                                        /*contrucción de la estructura del programa*/
                                        $html.="<tr><tr class='text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='3'><b>@@linea_i@@:</b><br> ".$arrayactividades['nombre_linea_investigacion'.$p]."</td><td colspan='5'><b>@@tematica_trab@@:</b><br> ".$arrayactividades['nombre_tematica'.$p]."</td></tr>
                                        <tr class='m-b-0 text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='2'><b>@@numsesion@@:</b> ".($s + 1)."</td><td colspan='3'><b>@@encargado_sesion@@:</b> ".$arraytrabajos['primer_nombre'.$r]." ".$arraytrabajos['primer_apellido'.$r]."</td><td colspan='3'><b>@@espacio@@:</b>";
                                        $html.="'".$arrayactividades['nombre_espacio'.$p]."'";                                        
                                        $html.="</td></tr></tr>";
                                        
                                          for($t = 0; $t < $distribucion; $t++){
                                                if(isset($arraytrabajos['id_trabajo_pk'.$r])){
                                                  /*autores de cada trabajo*/
                                                    $idtrabajo = $arraytrabajos['id_trabajo_pk'.$r];
                                                    /*
                                                     * consulta para extraer los autores del trabajo
                                                     */
                                                    $datos2 = $bdd->select("select a.*, b.*, c.*, d.*, f.*, k.*, l.* from tbl_trabajo a 
                                                            join tbl_tematica b on a.id_tematica_fk = b.id_tematica_pk 
                                                            join tbl_tipo_trabajo c on a.id_tipo_trabajo_fk = c.id_tipo_trabajo_pk 
                                                            join tbl_linea_investigacion d on b.id_linea_investigacion_fk = d.id_linea_investigacion_pk 
                                                            join tbl_congreso_linea_investigacion e on d.id_linea_investigacion_pk = e.id_linea_investigacion_pk 
                                                            join tbl_usuario_trabajo f on a.id_trabajo_pk = f.id_trabajo_fk
                                                            join tbl_usuario k on f.id_usuario_fk = k.id_usuario_pk
                                                            join tbl_persona l on k.id_persona_fk = l.id_persona_pk
                                                            where a.id_estado_fk='6' and e.id_congreso_pk='".$idcongreso."' and a.id_trabajo_pk='".$idtrabajo."'");
                                                    $filas2 = $datos2->num_rows;
                                                    /*contrucción de la estructura del programa*/
                                                    $var = 0; /*variable contador para fechas de actividad*/
                                                    if(isset($arrayactividades['id_actividad_pk'.$p])){
                                                        $fecha = $arrayactividades['fecha_actividad'.$p];
                                                        setlocale(LC_ALL,'Spanish_Honduras');
                                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));


                                                        $horai = $horainicialdelostrabajos;

                                                        $newhorai = date("g:i A",strtotime($horai));
                                                        $segundos_horaInicial=strtotime($horai);
                                                        $segundos_minutoAnadir=15*60;
                                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                                        $horainicialdelostrabajos = $newhoraf;
                                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                                        <td>".$newhorai."</td>
                                                        <td>".$newhoraf."</td>                                                        
                                                        <td align='justify'>".$arraytrabajos['titulo_trabajo'.$r]."</td>
                                                        <td align='justify'>".$arraytrabajos['resumenprograma'.$r]."</td>
                                                        <td>".$arraytrabajos['nombre_tipo_trabajo'.$r]."</td>
                                                        <td>".$arraytrabajos['id_idioma_fk'.$r]."</td>
                                                        <td>";
                                                        foreach ($datos2 as $val) {
                                                                  $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                                        }
                                                        $html.="</td></tr><tr></tr>";
                                                        $r += 1;
                                                        $var = $p;
                                                    }else{
                                                        $fecha = $arrayactividades['fecha_actividad'.$var];
                                                        setlocale(LC_ALL,'Spanish_Honduras');
                                                        $newfecha = strtoupper(strftime('%A %d de %B del %Y',strtotime($fecha)));
                                                        $newfecha = ucfirst(iconv("ISO-8859-1","UTF-8",$newfecha));


                                                        $horai = $horainicialdelostrabajos;

                                                        $newhorai = date("g:i A",strtotime($horai));
                                                        $segundos_horaInicial=strtotime($horai);
                                                        $segundos_minutoAnadir=15*60;
                                                        $nuevaHorai=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
                                                        $newhoraf = date("g:i A",strtotime($nuevaHorai));
                                                        $horainicialdelostrabajos = $newhoraf;
                                                        $html.="<tr style='border: 2px solid #F5BCA9;'><td>".$newfecha."</td>
                                                        <td>".$newhorai."</td>
                                                        <td>".$newhoraf."</td>                                                        
                                                        <td align='justify'>".$arraytrabajos['titulo_trabajo'.$r]."</td>
                                                        <td align='justify'>".$arraytrabajos['resumenprograma'.$r]."</td>
                                                        <td>".$arraytrabajos['nombre_tipo_trabajo'.$r]."</td>
                                                        <td>".$arraytrabajos['id_idioma_fk'.$r]."</td>
                                                        <td>";
                                                        foreach ($datos2 as $val) {
                                                            $html.="<li><a>".$val['primer_nombre']." ".$val['primer_apellido']."</li>";
                                                        }
                                                        $html.="</td></tr><tr></tr>";
                                                        $r += 1;
                                                    }
                                                 } /*trabajo esta definido*/
                                                 $e += 1;
                                            }/*for de distribucion*/
                                $s+=1;
                                }                                
                            }/*fin de verificar valor res*/
                        }else{
                            $html.="<tr><tr class='text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='3'><b>@@linea_i@@:</b><br> ".$arrayactividades['nombre_linea_investigacion'.$p]."</td><td colspan='5'><b>@@tematica_trab@@:</b><br> ".$arrayactividades['nombre_tematica'.$p]."</td></tr>
                            <tr class='m-b-0 text-purple' style='background-color: #dae6ec; border: 2px solid #F5BCA9;'><td colspan='2'><b>@@numsesion@@:</b> 0 </td><td colspan='3'><b>@@encargado_sesion@@:</b> @@no_disponible@@ </td><td colspan='3'><b>@@espacio@@:</b>";
                            $html.="'".$arrayactividades['nombre_espacio'.$p]."'";                                        
                            $html.="</td></tr></tr>";
                            $html.="<tr><td><b>@@trabajos_disponibles@@:  </b></td><td><b>0</b></td></tr><tr></tr>";
//                            echo 'No hay trabajos en esta tematica';
                        }
                    }                 
                 }/*for actividades*/
         }
        if($r < $i){/*construyo las secciones con trabajos sobrantes*/     
            $html.="<tr><td  colspan='8' style='text-align: center; font-size: 16px;'><div class='alert alert-danger'>
           <strong>@@importante@@! </strong> @@cree_mas_sesiones@@ !!!</div></td></tr>";
       }                                   
       $html.="</tbody></table>";
       $html1 = traducirstring($html, '../../../idiomas/es/es.php');
       echo $html1;
       
    
}