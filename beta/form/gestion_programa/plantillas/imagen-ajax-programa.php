<?php

session_start();
print_r($_POST);
print_r($_SESSION);
                        
$funcion= filter_input(INPUT_POST,'caso');
switch ($funcion) {
    case 'insertar_espacio':
        subirimagenespacio();
        break; 
    case 'modificar_espacio':
        subirmapa_modficado_espacio();
        break;
  
}

//FUNCION PARA ELIMINAR CARACTERES ESPECIALES EL NOMBRE DE LOS ARCHIVOS 
function limpiacadena($cadena) {
	$cadena = trim($cadena);
	$cadena = strtr($cadena,
"ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
"aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	$cadena = strtr($cadena,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz");
	$cadena = preg_replace('#([^.a-z0-9]+)#i', '-', $cadena);
        $cadena = preg_replace('#-{2,}#','-',$cadena);
        $cadena = preg_replace('#-$#','',$cadena);
        $cadena = preg_replace('#^-#','',$cadena);
	return $cadena;
}
//FUNCION PARA RENOMBRAR LOS ARCHIVOS DE FORMA ALEATORIA
 function  random_cadena($length=100,$n=TRUE,$sc=FALSE){
            $source = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';  
            $rstr = "";
            if($n==1){
                if($length>0){          
                    $source = str_split($source,1);
                    for($i=1; $i<=$length; $i++){
                            mt_srand((double)microtime() * 1000000);
                            $num = mt_rand(1,count($source));
                            $rstr .= $source[$num-1];
                    }
                }            
           }
           return $rstr;
 }
 
 /*Subir imagen de mapa del espacio creado para el programa*/
 function subirimagenespacio(){

        include '../../../clases/class_programa.php';
        $tu = new programa();
        $idesp = $tu->getid_espacio();
        $idespacio = 0;
        foreach ($idesp as $val) {
            $idespacio = $val['id_espacio_pk'];
        }
         print_r($_FILES);
         if (isset($_FILES["mapa_espacio"])){ 
                $mapa = $_FILES["mapa_espacio"];
                $nombreimagen = $mapa["name"];
                $rutaprovisional = $mapa["tmp_name"];
                $fecha = date("Y-m-d_h-i-s");
                $carpeta = "../mapas_espacio";
              
                $nombreimg = limpiacadena($nombreimagen);
                $nombimg = $idespacio.'_'.$fecha.'_'.$nombreimg;
                
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO
                if (!file_exists($carpeta)){
                    mkdir($carpeta, 0777, true);
                }
                //RUTA COMPLETA DE LA IMG
                $src = $carpeta.'/'.$nombimg;
                
                if (!file_exists($src)){
                    if(move_uploaded_file($rutaprovisional, $src)){
                        $tu ->inicializarmodificarmapa_espacio($nombimg, $idespacio);
                        $result = $tu ->modificarmapaespacio();
                    }
                    if($result != 0){
                        echo 1;
                    }else{
                        echo 2;
                    }
                }else{                                         
                    $tu ->inicializarmodificarmapa_espacio($nombimg, $idespacio);
                    $result = $tu ->modificarmapaespacio(); 
                    if($result != 0){
                        echo 1;
                    }else{
                        echo 2;
                    }
                }
         }
        
 }
 
 /*Subir mapa de espacio modificado*/
 function subirmapa_modficado_espacio(){
     include '../../../clases/class_programa.php';
     $tu = new programa();
     $idespacio = filter_input(INPUT_POST, 'idespacio');
     
     if (isset($_FILES["mapa_espacio"])){ 
                $mapa = $_FILES["mapa_espacio"];
         
                $nombreimagen = $mapa["name"];
       
                $rutaprovisional = $mapa["tmp_name"];
              
                $fecha = date("Y-m-d_h-i-s");
                $carpeta =  "../../../img/mapas_espacio";
                $nombreimg = limpiacadena($nombreimagen);
                $nombimg = $idespacio.'_'.$fecha.'_'.$nombreimg;
                
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO
                if (!file_exists($carpeta)){
                    mkdir($carpeta, 0777, true);
                }
                //RUTA COMPLETA DE LA IMG
                $src = $carpeta.'/'.$nombimg;

                /*EXTRAIGO EL NOMBRE DEL ARCHHIVO QUE ESTA ALMACENADO PARA ELIMINARLO Y SUSTITUIRLO POR EL NUEVO*/
                $datos = $tu->selectespacio($idespacio);
                foreach ($datos as $key) {
                    /*verifico si existe el archivo*/
                    if (!file_exists($carpeta.'/'.$key['mapa_espacio'])){
                        /*si no existe el archivo verifico si el que viene exite tambien*/
                            if (!file_exists($src)){
                                if(move_uploaded_file($rutaprovisional, $src)){
                                    $tu ->inicializarmodificarmapa_espacio($nombimg, $idespacio);
                                    $result = $tu ->modificarmapaespacio();
                                }
                                if($result != 0){
                                    echo 1;
                                }else{
                                    echo 0;
                                }
                            }else{                                         
                                $tu ->inicializarmodificarmapa_espacio($nombimg, $idespacio);
                                $result = $tu ->modificarmapaespacio(); 
                                if($result != 0){
                                    echo 1;
                                }else{
                                    echo 0;
                                }
                            }
                    }else{/*si el archivo existe lo eliminamos y sustituimos por el que queremos subir*/
                        /*verificamos si el archivo esta definido, 
                         * si lo esta elimino el anterior y subo el nuevo
                         * si No esta definido no hago nada */
                         if (isset($mapa)){
                                /*eliminamos el archivo actual*/
                                if (!empty($key['mapa_espacio'])) {
                                    unlink($carpeta.'/'.$key['mapa_espacio']);                         
                                }
                                if(move_uploaded_file($rutaprovisional, $src)){
                                    $tu ->inicializarmodificarmapa_espacio($nombimg, $idespacio);
                                    $result = $tu ->modificarmapaespacio();
                                }
                                if($result != 0){
                                    echo 1;
                                }else{
                                    echo 0;
                                }
                          }else{
                              /*imprimo 1 porque el proceso se realizo con exito*/
                              echo 1;
                          }
                    }                    
                }
         }
 }