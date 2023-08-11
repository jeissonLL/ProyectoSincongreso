<?php

/* 
 * funciones revisores 
 * @Brayan 
 */
//print_r($_POST);
require '../../../clases/class_base.php';
require '../../../funciones/funcion_traducir.php';
session_start();
switch ($_POST['caso']) {
    
    case 'mostrarinfotrabajo':   //Brayan
        mostrarinfotrabajo();
        break;  
//    case 'mostrarinfotrabajo':   //OBED
//        mostrarinfotrabajo1();
//        break; 
    case 'revisartrabinvest':
        revisartrabinvest();
        break;
    
    
}
function mostrarinfotrabajo(){
//    print_r($_POST);
//    print_r($_SESSION);
    $idt = filter_input(INPUT_POST, 'idt');

    $idcongreso = $_SESSION['idcongreso'];
    global $bdd;
    $bdd = new basedatos(); 
    $datos = $bdd->select('select a.*, b.nombre_tematica, c.id_tipo_trabajo_pk from tbl_trabajo a
            join tbl_tematica b on b.id_tematica_pk = a.id_tematica_fk
            join tbl_tipo_trabajo c on c.id_tipo_trabajo_pk = a.id_tipo_trabajo_fk 
            where a.id_trabajo_pk = "'.$idt.'"');
    $array=array();
    foreach ($datos as $fila) {
        $idtrabajo      = $fila['id_trabajo_pk'];    
        $titulo         = $fila['titulo_trabajo'];
        $resumen        = $fila['resumen'];
        $palabrasclave  = $fila['palabrasclave'];
        $tematica       = $fila['nombre_tematica'];
        
        $array=array('id_trabajo_pk' => $idtrabajo,
            'titulo_trabajo' => $titulo, 
            'fecha_subida' => $fila["fecha_subida"],
            'palabras_clave' => $palabrasclave,
            'resumen' => $resumen,
            'tematica'=> $tematica,
            'ubicacion_archivo' => $fila["ubicacion_archivo"],
            'idcongreso' => $idcongreso,
            'tipo_trabajo' => $fila["id_tipo_trabajo_fk"],  
            );
    }
    echo '' . json_encode($array) . '';  
   
}

/*Obed revisar trabajos*/

function revisartrabinvest(){
   //print_r($_POST);
    $idt = filter_input(INPUT_POST, 'idt');
    $idtem = filter_input(INPUT_POST, 'idtem');
    $idcongreso = $_SESSION['idcongreso'];
    global $bdd;
    $bdd = new basedatos(); 
    $datos = $bdd->select('select id_trabajo_pk,titulo_trabajo,ubicacion_archivo,fecha_subida,palabrasclave,resumen,nombre_tipo_trabajo,estado,id_tipo_trabajo_fk, id_congreso_pk, id_linea_investigacion_pk, id_tematica_pk, nombre_tematica  from tbl_trabajo a, tbl_tipo_trabajo b, tbl_estado c, tbl_congreso_linea_investigacion d, tbl_tematica e  where a.id_tipo_trabajo_fk=b.id_tipo_trabajo_pk and a.id_estado_fk=c.id_estado_pk and  d.id_linea_investigacion_pk=e.id_linea_investigacion_fk and a.id_tematica_fk=e.id_tematica_pk and c.id_estado_pk = 3 and  d.id_congreso_pk="'.$idcongreso.'" and a.id_trabajo_pk="'.$idt.'"');
    $arraytrab=array();
    $arraypregcuali = array();
    $arraypregcuanti = array();
    $arraytiposdictamen = array();
    $arrayfinal = array();
    $numcuali = array();
    $numcuanti = array();
    $numtiposdic= array();
    foreach ($datos as $fila) {
        $arraytrab=array('id_trabajo_pk' => $fila["id_trabajo_pk"],
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
    $datos1 = $bdd->select("select * from tbl_formulario_tematica a, tbl_pregunta_cualitativa b, tbl_tipo_pregunta c where a.id_formulario_fk=b.id_formulario_fk and b.id_tipo_pregunta_fk=c.id_tipo_pregunta_pk and a.id_tematica_fk='".$idtem."'");
    $i=0;
    foreach ($datos1 as $fila1) {
        $arraypregcuali['id_formulario_fk'.$i] = $fila1["id_formulario_fk"];
        $arraypregcuali['id_pregunta_cualitativa_pk'.$i] = $fila1["id_pregunta_cualitativa_pk"];
        $arraypregcuali['nombre_pregunta_cualitativa'.$i] = $fila1["nombre_pregunta_cualitativa"];  
        $arraypregcuali['id_tipo_pregunta_fk'.$i] = $fila1["id_tipo_pregunta_fk"];
        $arraypregcuali['nombre_tipo_pregunta'.$i] = $fila1["nombre_tipo_pregunta"];         
        $i+=1;
    }
    $datos2 = $bdd->select("select * from tbl_formulario_tematica a, tbl_pregunta_cuantitativa b, tbl_tipo_pregunta c where a.id_formulario_fk=b.id_formulario_fk and b.id_tipo_pregunta_fk=c.id_tipo_pregunta_pk and a.id_tematica_fk='".$idtem."'");
    $j=0;
    foreach ($datos2 as $fila2) {
        $arraypregcuanti['id_formulario_fk'.$j] = $fila2["id_formulario_fk"]; 
            $arraypregcuanti['id_pregunta_cuantitativa_pk'.$j] = $fila2["id_pregunta_cuantitativa_pk"];
            $arraypregcuanti['nombre_pregunta_cuantitativa'.$j] = $fila2["nombre_pregunta_cuantitativa"];
            $arraypregcuanti['opciones'.$j] = $fila2['opciones'];
            $arraypregcuanti['ponderacion'.$j] = $fila2['ponderacion'];
            $arraypregcuanti['id_tipo_pregunta_pk'.$j] = $fila2["id_tipo_pregunta_pk"];
            $arraypregcuanti['nombre_tipo_pregunta'.$j] = $fila2["nombre_tipo_pregunta"];                   
            
        $j+=1;
    }
    $datos3 = $bdd->select("select * from tbl_tipo_dictamen order by nombre_tipo_dictamen ASC");
    $k = 0;
    foreach ($datos3 as $fila3) {
        $arraytiposdictamen['id_tipo_dictamen_pk'.$k]  = $fila3["id_tipo_dictamen_pk"];
        $arraytiposdictamen['nombre_tipo_dictamen'.$k] = $fila3["nombre_tipo_dictamen"];
            
        $k += 1;
    }
    
    
    
    $numcuali['numcuali'] = $i;
    $numcuanti['numcuanti'] = $j;
    $numtiposdic['numtiposdict'] = $k;
    $arrayfinal = array_merge($arraytrab, $arraypregcuali, $arraypregcuanti, $numcuali, $numcuanti, $arraytiposdictamen, $numtiposdic);    
    
    echo '' . json_encode($arrayfinal) . ''; 
    
}