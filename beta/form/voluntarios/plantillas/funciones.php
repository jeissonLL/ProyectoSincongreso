<?php

session_start();
require '../../../funciones/funcion_traducir.php';
switch ($_GET['caso']){
    
    case 'info_actividad':   //Brayan
        info_actividad();
        break;  
    
    case 'validar_asistencia_persona':
        validar_asistencia_persona();
        break;
    
    case 'validar_asistencia_autor' :
        validar_asistencia_autor();
        break;
    
    case 'inf_costo':
        inf_costo();
        break;
    
    case 'validar_pago':
        validar_pago();
        break;
    
    case 'enviar_correo_pago_inscripcion':
        enviar_correo_pago_inscripcion();
        break;
    
    case 'enviar_detalle_factura':
        enviar_detalle_factura();
        break;
}

function info_actividad(){
    require '../../../clases/class_usuario.php';
    $actividad = new voluntario();
    $id_actividad = filter_input(INPUT_GET, 'idactividad');
    $idcongreso= $_SESSION['idcongreso'];
    
    $info= $actividad->info_actividad_voluntario($id_actividad) ;
    $arraydatos = array();
    
    foreach ($info as $valor){
        $arraydatos['nombre_tarea'] = $valor['nombre_tarea'];
        $arraydatos['descripcion'] = $valor['descripcion'];
        $arraydatos['persona_apoyo'] = $valor['persona_apoyo'];
        $arraydatos['hora_tarea'] = $valor['hora_tarea'];
        $arraydatos['archivo_complementario'] = $valor['archivo_complementario'];
    }
    
    echo '' . json_encode($arraydatos) . ''; 
}

function validar_asistencia_persona(){
    require '../../../clases/class_usuario.php';
    
    $actividades = explode(",", filter_input(INPUT_GET, 'actividades'));
    $idusuario =  filter_input(INPUT_GET, 'idusuario');
    $respuesta = 0 ;
    
    $validar_asistencia = new voluntario();
    $idcongreso = $_SESSION['idcongreso'];
    
    for($i=0; $i<count($actividades);$i++){
        $resp = $validar_asistencia->validar_asistencia_persona($actividades[$i], $idcongreso,$idusuario);
        if($resp != 0){
            $respuesta = 1;
        }else{
            $respuesta = 0;
        }
    }
    if($respuesta == 1){
        echo 1 ;
    }else{
        echo 0 ;
    }
}

function validar_asistencia_autor(){
    require '../../../clases/class_usuario.php';
    $asitencia_autor = new voluntario();
    $idcongreso = $_SESSION['idcongreso'];
    $trabajo = explode(",", filter_input(INPUT_GET, 'trabajo'));
    
    if ($trabajo[0] == "P"){
            $respues = $asitencia_autor->validar_asistencia_autor($trabajo[1], 8, $idcongreso) ; 
            if($respues !=0){
                echo 1;
            }else{
                echo 0;
            }
    }else if ($trabajo[0] == "A"){ 
            $respues =$asitencia_autor->validar_asistencia_autor($trabajo[1], 9, $idcongreso) ; 
            if($respues !=0){
                echo 1;
            }else{
                echo 0;
            }
    }else{
        echo 3 ;
    }
}

function inf_costo(){
    require '../../../clases/class_usuario.php';
    $info_costo = new voluntario();
   
    $id = filter_input(INPUT_GET, 'idcosto');
    $tabla = filter_input(INPUT_GET, 'tipo_pago');
    $num= filter_input(INPUT_GET, 'numero');
    
    $factura =$info_costo->info_factura();
    $isv = 0 ;
     
    foreach ($factura as $value){
        $isv = $value['impuesto'];
    }
    
    $html = "";
    
    if($tabla == "costo"){
        $datos = $info_costo->info_costo($id);
        
        foreach ($datos as $fila){
            $grabado_exento =$fila['grabado_exento'] ;
            if($grabado_exento == 2){
                $impuesto = "E";
                $isv = "N/A";
                $valor_a_impuesto = $fila['precio_unitario'] ;
            }else{
                $impuesto = "G";
                $valor_a_impuesto = round(($fila['precio_unitario']/($isv/100)), 4);
            }
            
             $html .= "<td id=costo name=$id>".$fila['precio_unitario']."</td>
                        <td >".$impuesto."</td>
                        <td>".$fila['descripcion']."</td>
                        <td>".$isv."</td>
                        <td  id='descuento_pago$num' name=".$fila['precio_unitario']." onclick='mymodal(this.id)'>@@en_porcentaje@@</td>
                        <td>".$valor_a_impuesto."</td>
                        <td >".$fila['precio_unitario']."</td>" ;
        }
        
    }else if($tabla == "tour"){
        $datos1 = $info_costo->info_tour($id);
        
        foreach ($datos1 as $val){
            $graba_exento =$val['Impuesto'] ;
            if($graba_exento == 2){
                $impuesto = "E";
                $isv = "N/A";
                $valor_a_impuesto = $val['costo'] ;
            }else{
                $impuesto = "G";
                $valor_a_impuesto = round(($val['costo']/($isv/100)), 4);
            }
             $html .= "<td id=tour name=$id>".$val['costo']."</td>
                        <td  >".$impuesto."</td>
                        <td>".$val['descripcion']."</td>
                        <td>".$isv."</td>
                        <td  id='descuento_pago$num' name=".$val['costo']." onclick='mymodal(this.id)'>@@en_porcentaje@@</td>
                        <td>".$valor_a_impuesto."</td>
                        <td >".$val['costo']."</td>";
        }
    }
   
    $html1 = traducirstring($html, '../../../idiomas/es/es.php');
    echo $html1;
    
    
}
/**ALEXIS ESCOTO
 * 18-01-2023
 */
function validar_pago(){
    require_once '../../../clases/class_usuario.php';
    require_once '../../../clases/class_factura.php';
    
    $imprimir = 0;
    $detalle_factura = new voluntario();
    $guardar_detalle_factura = new factura();
    
    $costos =  filter_input(INPUT_GET, 'costos');
    $tours = filter_input(INPUT_GET, 'tours');
    $idpersona = filter_input(INPUT_GET, 'idpersona');
    $total_pagar = filter_input(INPUT_GET, 'total_a_pagar');
    $total_articulos = filter_input(INPUT_GET, 'total_articulos');
    $fecha = date('Y-m-d');
    /*echo $costos . " ". $tours . " ". $idpersona . " ". $total_pagar . " ";*/
    
    /*echo print_r($_GET);*/
   
    $guardar_detalle_factura->inicia_guardar_detalle_factura(null, 2, $total_articulos, $fecha, $total_pagar);
    
    $respuesta = $guardar_detalle_factura->guardar_detalle_factura();/* */
    
    if($respuesta != 0){
        $ultimo = $guardar_detalle_factura->ultimo_detalle_fact();/* */
        
        foreach ($ultimo as $iddetalle){
            $id_detalle_factura = $iddetalle['id_factura_detalle_pk'];
        }
        
        $iduser = $detalle_factura->id_usuario($idpersona);
    
        foreach ($iduser as $fila){
            $idusuario = $fila['id_usuario_pk'];
        }

        if(empty($costos)){
        }else{
            $costo = explode(",", $costos);

            for($i=0;$i<count($costo);$i++){
                $guardar_detalle_factura->inicia_guardar_costo_x_usuario($costo[$i], $idusuario, $id_detalle_factura);
                $respuesta = $guardar_detalle_factura->gauardar_costo_usuario();
                
                if($respuesta != 1){
                    $imprimir = 1 ;
                }
            }
            
        }

        if(empty($tours) ){
        }else{
            $tour = explode(",", $tours);

            for($a=0;$a<count($tour);$a++){
                $guardar_detalle_factura->inicia_guardar_tour_x_usuario(null, $tour[$i], $idusuario, $id_detalle_factura);
                $resp = $guardar_detalle_factura->gauardar_tour_usuario();
              
                if($resp != 1){
                    $imprimir = 1 ;
                }
            }
        }
        
    }else{
        echo 0;
    }
    if ($imprimir == 1){
        
    }
    echo $imprimir ;
    
}

function enviar_correo_pago_inscripcion(){
    require_once '../../../clases/class_factura.php';
    require_once '../../../clases/class_usuario.php';
    $factura = new factura();
    
    $persona =  filter_input(INPUT_GET, 'idpersona');
    $idcongeso = $_SESSION['idcongreso'];
    
    $iduser = $detalle_factura->id_usuario($persona);
    
    foreach ($iduser as $fila){
        $idusuario = $fila['id_usuario_pk'];
    }
    
    $respuesta = $factura->enviar_correo_usuario($idusuario, $idcongeso);
}

function enviar_detalle_factura(){
    require_once '../../../clases/class_factura.php';
    $idcongeso = $_SESSION['idcongreso'];
    $correo = new factura();
    
    $detalle =  filter_input(INPUT_GET, 'detalle');
    $persona =  filter_input(INPUT_GET, 'idpersona');
    $cantidad =  filter_input(INPUT_GET, 'total_articulos');
    $total_a_pagar =  filter_input(INPUT_GET, 'total_a_pagar');
    $respuesta = $correo->enviar_detalle_factura($detalle, $persona, $cantidad, $total_a_pagar, $idcongeso);
}