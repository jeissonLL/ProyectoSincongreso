<?php

/* 
 * Bryan Triminio.
 * funciones especificas de la creacion de formularios
 * 30/05/2017
 */

require '../../../clases/class_base.php';
require '../../../funciones/funcion_traducir.php';
session_start();

switch ($_POST['caso']) {
    
    case 'agregarpregunta':   
        agregarpregunta();
        break;
    case 'preguntas_cualitativas':
        preguntas_cualitativas();
        break;
    
    case 'eliminar_pregunta':
        eliminar_pregunta();
        break;
    
    case 'agregar_preguntas_form_edicion':
        agregar_preguntas_form_edicion();
        break;
    
    case 'guardar_preguntas_modificadas':
        guardar_preguntas_modificadas();
        break;
    
    case 'agregar_pregunta_cuali_form_edicion':
        agregar_pregunta_cuali_form_edicion();
        break;
    
    case 'insert_pre_revista_premio':
        insert_pre_revista_premio();
        break;
}

function  agregarpregunta(){
     global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("SELECT * FROM tbl_tipo_pregunta WHERE 1=1");
    
    $html = '' ;
    $html .= "  <div id ='hijo'>
                        <div class='form-group clearfix'  >
                                    <label class='col-md-3 control-label ' >@@pre@@</label>
                                    <div class='col-md-7'>
                                        <input id='password' name='password' type='text' class='required form-control'>

                                    </div>
                           </div>" ;

                            $html .= " <div class='form-group clearfix'  >
                            <label class='col-md-3 control-label ' >@@tipopregunta@@</label>
                            <div class='col-md-7'>
                                <SELECT class='form-control' ><option value=''>@Seleccione@</option>";
                                foreach ($datos as $valor) {
                                $html .= "<option value='" . $valor['id_tipo_pregunta_pk'] . "'>"  . $valor['nombre_tipo_pregunta'] . "</option>";
                                }
                                $html.="</select>
                            </div>
                        </div>
                        
                </div>        " ;
    //$html = traducirstring($html, '..../idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
    echo $html;
}
/**ALEXIS ESCOTO
 * 02-20-2023
 * INSTANCIACION DE FUNCIONES
 */
function preguntas_cualitativas(){
    require "../../../clases/class_formulario.php";
    $obj = new formulario();
    $idformulario = filter_input(INPUT_POST, 'idformulario'); 
    $arraypregcuali =  array();
    $arraypregcuanti =  array();
    $numerocuali =  array();
    $numerocuanti =  array();
    $i = 0;
    $j = 0;
    $datos = $obj->pregunta_cualitativa($idformulario);
    
    $datos1 = $obj->pregunta_cualitativa_2($idformulario);
    
   
    foreach ($datos as $fila) {
        $arraypregcuali['id_pregunta_cualitativa_pk'.$i]   = $fila["id_pregunta_cualitativa_pk"];
        $arraypregcuali['nombre_pregunta_cualitativa'.$i]   = $fila["nombre_pregunta_cualitativa"];
        $arraypregcuali['nombre_tipo_pregunta'.$i]   = $fila["nombre_tipo_pregunta"];
        $arraypregcuali['nombre_formulario']   = $fila["nombre_formulario"];
        $i+=1;
    }
    
    foreach ($datos1 as $fila1) {
        $arraypregcuanti['nombre_formulario']                   = $fila1["nombre_formulario"];
        $arraypregcuanti['id_pregunta_cuantitativa_pk'.$j]      = $fila1["id_pregunta_cuantitativa_pk"];
        $arraypregcuanti['nombre_pregunta_cuantitativa'.$j]     = $fila1["nombre_pregunta_cuantitativa"];
        $arraypregcuanti['id_tipo_pregunta_fk'.$j]              = $fila1["id_tipo_pregunta_fk"];
        $arraypregcuanti['nombre_tipo_pregunta_cuanti'.$j]      = $fila1["nombre_tipo_pregunta"];
        $arraypregcuanti['opciones'.$j]                         = $fila1["opciones"];
        $arraypregcuanti['ponderacion'.$j]                      = $fila1["ponderacion"];
        $j+=1;
    }
    
    
   $numerocuali['numero'] = $i ;
   $numerocuanti['numerocuanti'] = $j;
   
   $arrayfinal =array_merge($numerocuali, $arraypregcuali, $numerocuanti,$arraypregcuanti);  
   echo '' . json_encode($arrayfinal) . ''; 
}

function eliminar_pregunta(){
    global $bdd;
    $bdd = new basedatos();
    $eliminar = "";
    $idpregunta = filter_input(INPUT_POST, 'idpregunta'); 
    $idform = filter_input(INPUT_POST, 'idfromulario');
    $tabla = filter_input(INPUT_POST, 'tabla');
    
    if($tabla == 1){
       $eliminar = 'tbl_pregunta_cualitativa';
       $id = 'id_pregunta_cualitativa_pk';
    }else{
       $eliminar = 'tbl_pregunta_cuantitativa';
       $id = 'id_pregunta_cuantitativa_pk';
    }
    
    echo $bdd->delete('delete from '.$eliminar.' where '.$id.'= "'.$idpregunta.'" and id_formulario_fk="'.$idform.'" ');
            
    
}

function agregar_preguntas_form_edicion(){
    include '../../../clases/class_formulario.php';
    
    $nombre  = filter_input(INPUT_POST, 'nombrepregunta'); 
    $idformulario  = filter_input(INPUT_POST, 'idformulario'); 
    $opciones   =filter_input(INPUT_POST, 'opciones'); 
    $ponderaciones =filter_input(INPUT_POST, 'ponderaciones'); 
    $tipo        =filter_input(INPUT_POST, 'tipo'); 
    
    $preguntacuant = new formulario();
    $preguntacuant->inipregcuanti(null, $nombre, $opciones, $ponderaciones, $idformulario, $tipo);
    $respuesta = $preguntacuant->insertpregcuanti() ;
     if($respuesta != 0){
            echo 1;
        }else{
            echo 0;
        }
    
}

function guardar_preguntas_modificadas(){
    include '../../../clases/class_formulario.php';
    $modifica_pregunta = new formulario();
    
    $arreglocuantitativo  =  (filter_input(INPUT_POST, 'arraycuanti'));
    $arr = json_decode($arreglocuantitativo, true);
    $repeticiones  =  (filter_input(INPUT_POST, 'numerocuanti'));
   
    $arreglocualitativo  =  (filter_input(INPUT_POST, 'arraycuali'));
    $array = json_decode($arreglocualitativo, true);
    $numerocuali =(filter_input(INPUT_POST, 'numerocuali'));
    
    
    for($i=0;$i<$numerocuali;$i++){
        $modifica_pregunta->inicia_modificar_pregunta_cuali($array['idpregunta'.$i], $array['pregunta'.$i]);
        $respuesta = $modifica_pregunta->modifica_preguntas_cuali();
        if($respuesta!=0){
            echo 1;
        }else{
             echo '0';
        }
    }
   
     
    for($a=0;$a<$repeticiones;$a++){
        $modifica_pregunta->inicia_modificar_pregunta_cuanti($arr['idpregunta'.$a], $arr['pregunta'.$a], $arr['opciones'.$a], $arr['ponderacion'.$a]);
        $respuesta = $modifica_pregunta->modifica_preguntas_cuanti();
        if($respuesta!=0){
            echo 1;
        }else{
             echo '0';
        }
    }
    
  
}

function agregar_pregunta_cuali_form_edicion(){
    include '../../../clases/class_formulario.php';
    
    $idform = filter_input(INPUT_POST, 'idformulario');
    $nombre_pregunta = filter_input(INPUT_POST, 'nombrepregunta');
    
    $insert_pcuali = new formulario();
    $insert_pcuali->inipregcuali(null, $nombre_pregunta, $idform, 1);
    $respuesta = $insert_pcuali->insertpregcuali();
    if($respuesta !=0){
        echo 1;
    }else{
        echo 0;
    }
    
}

function insert_pre_revista_premio(){
    include '../../../clases/class_formulario.php';
    $idformulario = filter_input(INPUT_POST, 'id');
    $tipo_pregunta = filter_input(INPUT_POST, 'tipo');
    $opcion = filter_input(INPUT_POST, 'opc');
    $ponderacion = filter_input(INPUT_POST, 'ponde');
    
    $preguntas_revista = new formulario();
    
    for($i=0; $i<2; $i++){
       $nombre_pregunta = "Debería considerarse éste trabajo para publicarse en Revista Científica" ;
        if($i== 1){
            $nombre_pregunta = "Debería considerarse éste trabajo para Otorgarle un premio" ;
        }
        
        $preguntas_revista->inicia_insert_preguntas_revista(null, $nombre_pregunta, $opcion, $ponderacion, $idformulario, $tipo_pregunta);
        $preguntas_revista->insert_preguntas_revista();
    }
    
}

?>

