<?php

/* 
 * Funciones propias del asistenete 
 * Brayan Triminio
 * 23/07/2017
 */

require '../../../funciones/funcion_traducir.php';
session_start();

switch ($_POST['caso']) {
    case 'crear_itinerario':
        crear_itinerario();
        break;
    
    case 'modificar_itinerario':
        modificar_itinerario();
        break;
    
    case 'sin_itinerario':
        sin_itinerario();
        break;
    
    case 'eliminar_itinerario' :
        eliminar_itinerario();
        break;
}

function crear_itinerario(){
    include '../../../clases/class_programa.php';
    
    $arractividades  =  (filter_input(INPUT_POST, 'actividades'));
    $arreglodeactividades = json_decode($arractividades, true);
    $repeticiones  =  (filter_input(INPUT_POST, 'numeroactividades'));
    $idusuario = $_SESSION['idusuario'];
    $idcongreso = $_SESSION['idcongreso'];
    
    $itinerario = new itinerario();
    
    for($i=0;$i<$repeticiones;$i++){
        $itinerario->inicia_crear_itinerario($idusuario, $arreglodeactividades['idactividad'.$i], $idcongreso, 0);
        $respuesta = $itinerario->crear_itinerario();
        
        if($respuesta !=1){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    
}

function modificar_itinerario(){
    include '../../../clases/class_programa.php';
    
    $idusuario = $_SESSION['idusuario'];
    $idcongreso =$_SESSION['idcongreso'];
    
    $actividadesxusuario = new itinerario();
    
    $idold = array();
    $respuesta  = 0;
    $respuesta1 = 0;
    
    $idactividad = explode(",", filter_input(INPUT_POST, 'actividades'));
    
    $datos = $actividadesxusuario->actividades_usuario($idusuario,$idcongreso);
    $contar = $datos->num_rows;
    $a= 1 ;
    unset($idactividad[0]) ;/*Elimino el primer indice porque esta vacio*/
    
    foreach ($datos as $val) {
                $idold[$a] = $val['id_actividad_fk'];
           $a++;
    }
    
    
      
    foreach ($idactividad as $valor){
        if((in_array($valor, $idold))){
         
        }else{
         /*Llamamos al metodo insertar actividad*/ 
            $actividadesxusuario->inicia_crear_itinerario($idusuario, $valor, $idcongreso, 0);
            $resultado = $actividadesxusuario->crear_itinerario() ;
            if($resultado != 0){
                $respuesta =  0 ;
            }else{
                $respuesta = 1 ;
            }
        }

    }
    
    foreach ($idold as $dato){
        if((in_array($dato, $idactividad))){
             
        }else{
            /*Llamamos al metedo de eliminar actividad */
            $actividadesxusuario->inicia_eliminar_actividad_itineario($dato, $idusuario, $idcongreso);
            $resultado = $actividadesxusuario->eliminar_actividad_itinerario();
            if($resultado != 0){
                $respuesta1 =  1 ;
            }else{
                $respuesta1 = 0;
            }
        }
    }
    if(($respuesta1 == 1 ) || ($respuesta == 1 )){
        echo 1 ;
    }else{
        echo 0 ;
    }

} 

function sin_itinerario(){
    $idioma = $_SESSION['idioma'];
    $html = "<HTML>
        <HEADER>
        </HEADER>
        <BODY> 
            <div class='row'>      
                     <div class='col-sm-12' align='center'>
                        <div class='card-box' style='background-color: #dae6ec;'>               
                                <div class='row' align='center'>                    
                                    <h4 class='m-t-0 header-title'><b>@@modificar_itinerario@@</b></h4><br><br>
                                    <h1 class='text-primary' id='mensajeautoria' >@@msj_no_hay_itinerario@@</h1>
                                    
                                </div>                
                        </div>            
                    </div>  
            </div>
        </BODY>
    </HTML>" ;
    $html1 = traducirstring($html, '../../../idiomas/'.$idioma.'/'.$idioma.'.php');
   
    echo $html1 ;
}

function eliminar_itinerario(){
    include '../../../clases/class_programa.php';
    
    $idusuario = $_SESSION['idusuario'];
    $idcongreso =$_SESSION['idcongreso'];
    
    $eliminar_itinerario = new itinerario();
    $resp = 0;
    
    $valores = $eliminar_itinerario->actividades_usuario($idusuario, $idcongreso) ;
    
    foreach ($valores as $valor){
        /*echo $valor['id_actividad_fk'] ;*/
        $eliminar_itinerario->inicia_eliminar_itinerario_usuario($idusuario, $idcongreso,  $valor['id_actividad_fk']);
        $respuesta = $eliminar_itinerario->eliminar_itinerario_usuario();
            if($respuesta!=0){
                $resp =  1 ;
            }else{
                $resp =  0 ;
            } 
    }
    if($resp==1){
        echo 1 ;
    }
}