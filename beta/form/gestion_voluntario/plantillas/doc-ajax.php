<?php
//print_r($_FILES);
/* 
 * Subida de trabajos 
 * Autor: Obed Martínez
 * 17/03/17
 */
//require '../../../clases/class_base.php';
session_start();
//print_r($_POST);
//print_r($_SESSION);

                        
$funcion= filter_input(INPUT_POST,'caso');
switch ($funcion) {
    case 'insertar_doc':
        insertar_doc();
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

//FUNCION PARA SUBIR IMAGENES CUANDO INSERTE REGISTRO DE UN CERTIFICADO
function insertar_doc(){
//    session_start();
    $idusuario = $_SESSION['idusuario'];  
    $nusuario = $_SESSION['nusuario'];   
    $idpersona = $_SESSION['idpersona']; 
    $idioma = $_SESSION['idioma']; 
    $idcongreso = $_SESSION['idcongreso']; 
    $fecha = date("Y-m-d_h-i-s");
    if (isset($_FILES["nombredoc"])){ 
        include '../../../clases/class_trabajos.php';
        $tu = new trabajo();
            $documento = $_FILES["nombredoc"];
            $nombredocumento = $documento["name"];
            $tipo = $documento["type"];
            $rutaprovisional = $documento["tmp_name"];
            $size = $documento["size"];
//            $dimensiones = ($rutaprovisional);//retorna un array para visualizar hacer un vardump
//            $width = $dimensiones[0];
//            $height = $dimensiones[1];
            //verifico que tipo de trabajo es para darle formato al nombre del archivo
                $tipotrabajo = 1;
                $carpeta = "../archivos/".'congreso'.$idcongreso;
                $carpeta2 = "../archivos/congreso$idcongreso".'/tipotrabajo'.$tipotrabajo;
                //Carpetas para almacenar las versiones de los trabajos de acuerdo a estados de los mismos 
                $carpeta3 = "../archivos/congreso$idcongreso".'/tipotrabajo'.$tipotrabajo.'/Revisiones';
                $carpeta4 = "../archivos/congreso$idcongreso".'/tipotrabajo'.$tipotrabajo.'/Aceptados';
                //eliminamos caracteres especiales en el nombre del doc
                $nombrearch = limpiacadena($nombredocumento);
                //agregamos el identificador de la persona que lo subio, en el nombre del trabajo 
                $nombrearchivo = $idpersona.'_'.$idioma.'_'.$fecha.'_'.$nombrearch;
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO CON EL ID DEL CONGRESO
                if (!file_exists($carpeta)){
                    mkdir($carpeta, 0777, true);
                }                
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO CON EL ID DEL TIPO DE TRABAJO
                if (!file_exists($carpeta2)) {
                    mkdir($carpeta2, 0777, true);
                }
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO PARA USO POSTERIOR 
                if (!file_exists($carpeta3)) {
                    mkdir($carpeta3, 0777, true);
                }
                //CREO O VERIFICO SI EXISTE EL DIRECTORIO PARA USO POSTERIOR 
                if (!file_exists($carpeta4)) {
                    mkdir($carpeta4, 0777, true);
                }
                //RUTA COMPLETA DEL ARCHIVO
                $src = $carpeta2.'/'.$nombrearchivo;
                
                //verificamos que el archivo no existe
                $datos = $tu ->selectmaxid();//extraigo el id del trabajo
                $result = "";
                if (!file_exists($src)){  
                    foreach ($datos as $val) {
                        if(move_uploaded_file($rutaprovisional, $src)){
                            $tu -> inicializarmodificarubicacion($nombrearchivo, $val['id_trabajo_pk']);
                            $result = $tu ->modificarubicacion();
                        }
                    }
                    if($result != 0){
                        echo 1;
                    }else{
                        echo 2;
                    }
                }else{
                    foreach ($datos as $val) {                        
                        $tu -> inicializarmodificarubicacion($nombrearchivo, $val['id_trabajo_pk']);
                        $result = $tu ->modificarubicacion();                       
                    }
                    if($result != 0){
                        echo 1;
                    }else{
                        echo 2;
                    }
                } 
//            }
           // return false;
        }
}
       
function eliminardoc($rutaarchivo){  
    if (!empty($rutaarchivo)) {
        unlink($rutaarchivo); 
        return true;
    }
    return false;
}

