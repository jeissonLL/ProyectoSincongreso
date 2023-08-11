<?php
//print_r($_FILES);
/* 
 * Subida de Imagenes (firmas digitales para los certificados de las personas).
 * Autor: Obed Martínez
 * 28/02/17
 */
require '../../../clases/class_base.php';
//print_r($_POST);


$funcion= filter_input(INPUT_POST,'caso');
switch ($funcion) {
    case 'insertar_certificados':
        ic_img();
        break;
    case 'modificar_certificados':
        mc_img();
        break;   
}

//FUNCION PARA ELIMINAR CARACTERES ESPECIALES EL NOMBRE DE LAS IMAGENES 
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
//FUNCION PARA RENOMBRAR LA IMAGEN DE FORMA ALEATORIA
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
function ic_img(){
   // print_r($_FILES);
        $cont = 0;
        if($_FILES){
                foreach ($_FILES as $clave=>$valor){
                            //echo "El valor de $clave es: $valor";
                            $file = $_FILES[$clave];
                            $nombre = 0;
                            $nombre = $file["name"];
                          //  print_r($nombre);
                            $tipo = $file["type"];
                            $ruta_provisional = $file["tmp_name"];
                            $size = $file["size"];
                            $dimensiones = getimagesize($ruta_provisional);
                            $width = $dimensiones[0];
                            $height = $dimensiones[1];
                            $carpeta = "../../../img/certificados/";
                            $carpeta_firmas = "../../../img/firmas/";

                            if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
                            {
                              echo "Error, el archivo no es una imagen"; 
                            }
                        //    else if ($size > 1024*1024)
                        //    {
                        //      echo "Error, el tamaño máximo permitido es un 1MB";
                        //    }
                        //    else if ($width > 500 || $height > 500)
                        //    {
                        //        echo "Error la anchura y la altura maxima permitida es 500px";
                        //    }
                        //    else if($width < 60 || $height < 60)
                        //    {
                        //        echo "Error la anchura y la altura mínima permitida es 60px";
                        //    }
                            else
                            {
                                //EXTRAEMOS EL ULTIMO ID INSERTADO EN CERTIFICADOS
        //                          
                             $base = new basedatos();  

                             $pdo = $base->abrir_conexion();  
                                $datos=$pdo->query("SELECT MAX(id_certificado_pk) AS id_certificado_pk FROM tbl_certificados");  
                                //echo $datos;
                                foreach ($datos as $val) {                           
                                    //limpiar nombre imagen
                                    $nombre_i = limpiacadena($nombre);
                                    //renombrando la imagen
                                   // $nombre_img = random_cadena($nombre_i);
                                    //asignamos ID DEL CERTIFICADO al nombre de la IMG (COMO IDENTIFICADOR)
                                    $nuevo_nombre = $val['id_certificado_pk']."_".$nombre_i;

                                    //verifico si es el arte o las firmas 
                                    if($clave == "arte"){
                                        //actualizamos nombre en la bd
                                        /*
                                        $upda = $bdd->update('UPDATE tbl_certificados set url_arte=? 
                                        where id_certificado_pk="'.$val['id_certificado_pk'].'"','s',[$nuevo_nombre]);
                                                                    */ 
                                      
                                        $datos =$pdo->prepare("UPDATE tbl_certificados 
                                        SET url_arte= ? WHERE id_certificado_pk= ?");
                                        $upda=$datos->execute([$val['id_certificado_pk'],
                                        $nuevo_nombre]);


 
                                        if($upda){
                                            $src = $carpeta.$nuevo_nombre;
                                            move_uploaded_file($ruta_provisional, $src);                                    
                                        }
                                    }else{
                                        //echo $clave;
                                   
                                        $persona = $pdo->query("SELECT * FROM tbl_persona where identificacion='$clave'");
                                       
                                        $id_persona = "";
                                        $id_certificado = "";
                                        $t = false;
                                        foreach ($persona as $id) {
                                            $id_persona = $id['id_persona_pk'];
                                            $id_certificado = $val['id_certificado_pk'];
                                         /*    //guardamos las firmas de las personas y subimos sus firmas
                                             print_r($id_persona.".-------HOLA".$id_certificado);
                                         
                                             print_r($resultado);
                                            $t = true;
                                            */
                                        } 
                                        $dt=$pdo->prepare("INSERT INTO tbl_usuario_firma_certificado(id_certificado_pk,
                                        id_persona_pk,url_firma)  values (?,?,?)");
                                           $resultado=$dt->execute([$id_certificado,$id_persona,$nuevo_nombre]);
                                        if($resultado){
                                            $src = $carpeta_firmas.$nuevo_nombre;
                                            move_uploaded_file($ruta_provisional, $src);
                                            $cont += 1;
                                        }
                                    }
//                                     echo "<img src='$src'>";
                                }                        
                            }
                }
        }
        echo $cont; 
}
function eliminar_imagen($carpeta,$img){  
    if (!empty($img)) {
        unlink($carpeta.$img); 
        return true;
    }
    return false;
}
//FUNCION PARA SUBIR LAS MODIFICACIONES EN UN CERTIFICADO
function mc_img(){
    //echo 'culo';
    $cont = 0;
    //global $bdd;
    //$bdd = new basedatos();
    $pdo = $this->base->abrir_conexion();  
    //eliminamos las firmas ingresadas
     $dat=$pdo->select("SELECT * FROM tbl_usuario_firma_certificado 
     where id_certificado_pk='".filter_input(INPUT_POST,'id')."'");  
    //echo $datos;
    foreach ($dat as $vl) {  
        $borra_img = $vl['url_firma'];
        eliminar_imagen("../../../img/certificados/", $borra_img);
        $bdd->delete('delete from tbl_usuario_firma_certificado where id_certificado_pk=? and url_firma=?','is',[filter_input(INPUT_POST,'id'),$borra_img]);
    }
    if($_FILES){
                foreach ($_FILES as $clave=>$valor){
                            //echo "El valor de $clave es: $valor";
                            $file = $_FILES[$clave];
                            $nombre = $file["name"];
                            $tipo = $file["type"];
                            $ruta_provisional = $file["tmp_name"];
                            $size = $file["size"];
                            $dimensiones = getimagesize($ruta_provisional);
                            $width = $dimensiones[0];
                            $height = $dimensiones[1];
                            $carpeta = "../../../img/certificados/";

                            if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
                            {
                              echo "Error, el archivo no es una imagen"; 
                            }
                        //    else if ($size > 1024*1024)
                        //    {
                        //      echo "Error, el tamaño máximo permitido es un 1MB";
                        //    }
                        //    else if ($width > 500 || $height > 500)
                        //    {
                        //        echo "Error la anchura y la altura maxima permitida es 500px";
                        //    }
                        //    else if($width < 60 || $height < 60)
                        //    {
                        //        echo "Error la anchura y la altura mínima permitida es 60px";
                        //    }
                            else{                               
                                
                                $datos=$bdd->select("SELECT * FROM tbl_certificados where id_certificado_pk='".filter_input(INPUT_POST,'id')."'");  
                                //echo $datos;
                                if($clave == "arte"){  
                                        foreach ($datos as $val) {  
                                            //limpiar nombre imagen                                    
                                            $nombre_i = limpiacadena($nombre);
                                            //renombrando la imagen
                                            //$nombre_img = random_cadena($nombre_i);
                                            //asignamos ID DEL CERTIFICADO al nombre de la IMG (COMO IDENTIFICADOR)
                                            $nuevo_nombre = $val['id_certificado_pk']."_".$nombre_i;
                                            //verifico si es el arte o las firmas 

                                            //eliminamos el arte actual                                       
                                            eliminar_imagen($carpeta, $val['url_arte']);                                        
                                           //actualizamos nombre en la bd
                                           $upda = $bdd->update('update tbl_certificados set url_arte=? where id_certificado_pk="'.filter_input(INPUT_POST,'id').'"','s',[$nuevo_nombre]);
                                           if($upda){
                                               $src = $carpeta.$nuevo_nombre;
                                               move_uploaded_file($ruta_provisional, $src);                                    
                                           }
                                           break;
                                        }
                                }else{ 
                                    
                                    $id_cert = filter_input(INPUT_POST,'id');
                                    $nombre_i = limpiacadena($nombre);                                           
                                    $nuevo_nombre = $id_cert."_".$nombre_i;
                                    
                                    $persona = $bdd->select("SELECT * FROM tbl_persona where identificacion='".$clave."'");
                                     foreach ($persona as $ident) {
                                        $id_persona = $ident['id_persona_pk'];
                                        $bdd->insert("insert into tbl_usuario_firma_certificado(id_certificado_pk,id_persona_pk,url_firma) values (?,?,?)","iis",[$id_cert,$id_persona,$nuevo_nombre],True);
                                        $src = $carpeta.$nuevo_nombre;
                                        move_uploaded_file($ruta_provisional, $src);  
                                        $cont += 1;                                        
                                     }
                                }                      
                            }
                }
    }
    echo $cont; 
}




