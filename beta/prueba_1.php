<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
require './clases/class_base.php';
require './funciones/funcion_traducir.php';


global $bdd;

    $bdd = new basedatos();
    $datos = $bdd->select("SELECT * FROM `tbl_tipo_alimentacion` WHERE 1");
    $datos2 = mysqli_fetch_assoc($datos); echo var_dump($datos);
    echo $datos->num_rows;
    echo $datos->lengths;
    foreach ($datos as $key => $value) {
    echo var_dump($key)." => ".var_dump($value)."<br>";
}
//    echo var_dump($datos2);
//    $html = "<option value='0' >@@seleccionar_congreso@@</option>";
//    foreach ($datos as $valor) {
//        $html .= "<option value='" . $valor['id_congreso_pk'] . "'>" . $valor['id_congreso_pk'] . " - " . $valor['nombre_congreso'] . "</option>";
//    }
//    $html = traducirstring($html, './idiomas/' . $_SESSION['idioma'] . '/' . $_SESSION['idioma'] . '.php');
//    echo $html;




//require 'clases/clase_Idioma.php';
//$obj = new Idioma();
//$arreglo = $obj->arreglo_respaldos_idioma("es");
//foreach ($arreglo as $key => $value) {
//    echo $arreglo[$key]["nombre_archivo"]." => ".$arreglo[$key]["fecha"]."<br>";
//}

//$array = scandir("idiomas/es/");
//unset($array[0], $array[1]);
//echo count($array)."<br>";
//foreach ($array as $key => $value) {
//    echo $key." => ".$value." <br> ";
//}
//descargar();
//function descargar() {
//
//
////Utilizamos basename por seguridad, devuelve el 
////nombre del archivo eliminando cualquier ruta. 
//
//$ruta = './idiomas/es/repositorio/es_1.txt';
//
//if (is_file($ruta))
//{
//   header('Content-Type: application/force-download');
//   header('Content-Disposition: attachment; filename=es_1.txt');
//   header('Content-Transfer-Encoding: binary');
//   header('Content-Length: '.filesize($ruta));
//
//   readfile($ruta);
//    
//}
//else
//   echo "no llegué";
//}




//$archivo = fopen('idioma.php', 'a+');
//fwrite($archivo, "<?php");
//fwrite($archivo, "leng = array(");
//for($i = 0; $i < 20; $i++) {
//    fwrite($archivo, "'$i' => 'patest$i, ");
//}

//require '../../clases/clase_Idioma.php';
//$obj = new Idioma();
//$array = $obj->arreglo_traducciones("en");
//$count = 0;
//foreach ($array as $key => $value) {
//    echo $key.") * ".$count." *  ".$array[$key]["clave"]."    =>    ".$array[$key]["valor"]."     =>    ".$array[$key]["v_original"]."<br>";
//    $count++;
//}

//$idioma_raiz = "../../idiomas/es/es.php";
//        $idioma_en_traduccion = "../../idiomas/en/en.php";
//        $contenido_idioma_raiz = file_get_contents($idioma_raiz);
//        
//         $array_raiz = array();
//            $array_traduccion = array();
//            //Llenando el arreglo que contiene los valores del Iidoma raíz del sistema
//            require $idioma_raiz;
//            foreach ($leng as $clave => $valor) { //Por cada arreglo llamado leng que es el que contiene las etiquetas y su respectiva traducción...
//                $array_raiz[$clave]["clave"] = $clave;
//                $array_raiz[$clave]["valor"] = $valor;
//             }
//            //Llenando el arreglo que contiene los valores del Iidoma en traducción
//            require $idioma_en_traduccion;
//            foreach ($leng as $clave => $valor) { //Por cada arreglo llamado leng que es el que contiene las etiquetas y su respectiva traducción...
//                $array_traduccion[$clave]["clave"] = $clave;
//                $array_traduccion[$clave]["valor"] = $valor;
//            }
//            
//            foreach ($array_raiz as $key => $value) {
//                $contador = 0;
//                    foreach ($array_raiz as $key2 => $value2) {
//                       if($array_raiz[$key]["clave"] == $array_raiz[$key2]["clave"]  ) {
//                           $contador++;
//                           if($contador > 0) { echo $contador." hola <br>";
//                               echo $array_raiz[$key2]["clave"]." => ".$array_raiz[$key2]["valor"]."<br>";
//                           }
//                       }
//                    }
//                }
                
//$b = implode("=>", $arreglo); echo $b;
//print_r($arreglo);
//$i = 0;
//$variable = "'<?php\n leng = array(\n ?'>";
//        echo $variable;


//$idioma_en_traduccion = "../../idiomas/en/en.php";
//$idioma_raiz = "../../idiomas/es/es.php";
//$porcentaje = "";
//$array_raiz = array();
//$array_traduccion = array();
//if (file_exists($idioma_en_traduccion)) {
//    $archivo_idioma_traduccion = fopen($idioma_en_traduccion, 'r');
//    while ($linea = fgets($archivo_idioma_traduccion)) {
//        $array_traduccion[] = $linea;
//    }
//    $archivo_idioma_raiz = fopen($idioma_raiz, 'r');
//    while ($line = fgets($archivo_idioma_raiz)) {
//        $array_raiz[] = $line;
//    }
//    $contador_etiquetas = 0;
//    $contador_traducciones = 0;
//    foreach ($array_raiz as $valor) {
//        if (strpos($valor, "=>")) {
//            $contador_etiquetas++;
//            $linea_raiz = explode("=>", $valor);
//            foreach ($array_traduccion as $valor2) {
//                if (strpos($valor2, "=>")) {
//                    $linea_traducida = explode("=>", $valor2);
//                    if ($linea_raiz[0] == $linea_traducida[0] && $linea_raiz[1] != $linea_traducida[1] && $linea_traducida[1] != "") {
//
//                        $contador_traducciones++;
//                    }
//                }
//            }
//        }
//    }
//    echo (round($contador_traducciones / $contador_etiquetas * 100, 1, PHP_ROUND_HALF_ODD)) . "%";
//} else {
//    echo "0%";
//}
?>
