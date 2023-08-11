<?php
//print_r($_FILES);
/* 
 * Subida de trabajos editor gestor 
 * Autor: Obed Martínez
 * 15/06/17
 */
//require '../../../clases/class_base.php';
session_start();
//print_r($_POST);
//print_r($_SESSION);
                
$funcion= filter_input(INPUT_POST,'caso');
switch ($funcion) {   
    case 'cambiardocrev':
        cambiardocrev();
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

       
function eliminardoc($rutaarchivo){  
    if (!empty($rutaarchivo)) {
        unlink($rutaarchivo); 
        return true;
    }
    return false;
}


function cambiardocrev(){
    //print_r($_POST);    
    $idtrabajo = filter_input(INPUT_POST, 'idt');
    $idusuario = $_SESSION['idusuario'];  
    $nusuario = $_SESSION['nusuario'];   
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso =  $_SESSION['idcongreso']; 
    $fecha = date("Y-m-d_h-i-s");
    if (isset($_FILES["nuevo_trabajo"])){ 
        include '../../../clases/class_trabajos.php';
        $tu = new trabajo();
            $documento = $_FILES["nuevo_trabajo"];
            $nombredocumento = $documento["name"];
            $tipo = $documento["type"];
            $rutaprovisional = $documento["tmp_name"];
            $size = $documento["size"];
            
            //comprobamos la ruta del nuevo archivo
            $carpeta = "../../gestion_trabajos/trabajos/".'congreso'.$idcongreso;            

            //eliminamos caracteres especiales en el nombre del doc
            $nombrearch = limpiacadena($nombredocumento);
            //agregamos el identificador de la persona que lo subio, en el nombre del trabajo 
            $nombrearchivo = $idpersona.'_'.$idioma.'_'.$fecha.'_'.$nombrearch;
            //CREO O VERIFICO SI EXISTE EL DIRECTORIO CON EL ID DEL CONGRESO
            if (!file_exists($carpeta)){
                mkdir($carpeta, 0777, true);
            }                
            
            
            
            $datos = $tu->selecttrabajo($idtrabajo);
            foreach ($datos as $key) {
                $carpeta2 = "../../gestion_trabajos/trabajos/congreso$idcongreso".'/tipotrabajo'.$key['id_tipo_trabajo_fk'];
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO CON EL ID DEL TIPO DE TRABAJO
                if (!file_exists($carpeta2)) {
                    mkdir($carpeta2, 0777, true);
                }
                //RUTA COMPLETA DEL ARCHIVO
                $src = $carpeta2.'/Revisiones/'.$nombrearchivo;
                
                if (!file_exists($carpeta2.'/Revisiones/'.$key['ubicacion_archivo'])){
                    if(move_uploaded_file($rutaprovisional, $src)){
                        $tu -> inicializarmodificarubicacion($nombrearchivo, $idtrabajo);
                        $result = $tu ->modificarubicacion();
                    }
                    if($result != 0){
                        echo 1;
                    }else{
                        echo 2;
                    }
                }else{
                    //eliminamos el archivo actual
                    //$elimina = eliminardoc($key['ubicacion_archivo']); 
                    if (!empty($carpeta2.'/Revisiones/'.$key['ubicacion_archivo'])) {
                        unlink($carpeta2.'/Revisiones/'.$key['ubicacion_archivo']);                         
                    }
                    if(move_uploaded_file($rutaprovisional, $src)){
                        $tu -> inicializarmodificarubicacion($nombrearchivo, $idtrabajo);
                        $result = $tu ->modificarubicacion();
                    }                                        
                    if($result != 0){
                        echo 1;
                    }else{
                        echo 2;
                    }
                }
            }
            
    }
}