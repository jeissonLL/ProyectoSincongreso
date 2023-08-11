<?php

/*
Alex Siboney Vargas Osorto
27-2-2017
alexv7142@gmail.com
Manejo de menú traduccione
*/
//Esta función será usada de forma global a través del proyecto traduciendo en el
//idioma indicado cada página, la función recibe como parámetros el URL o ubicación
//del archivo a traducir y el idioma en el cual se realizará la traducción, la función
//retorna un string con la página ya traducida.

function traducir($URL, $idioma) { //Se recibe la ubicación de la página a traducir en $URL y el idioma en $idioma
	require $idioma; //Se realiza el llamado a la ubicación donde se encuentra el arreglo de etiquetas traducidas en el idioma solicitado
	$archivo = $URL; //A la variable archivo se le asigna la ubicación de la página a traducir
	$pagina = file_get_contents($archivo); //Se introduce dentro de la variable $pagina todo el contenido del archivo php.
	foreach ($leng as $clave=>$valor) { //Por cada arreglo llamado leng que es el que contiene las etiquetas y su respectiva traducción...
		$pagina = str_replace('@@'.$clave.'@@', $valor, $pagina); //A página se asigna la sustitución de cada etiqueta encontrada por su valor de significado
	}
	return $pagina; //Se retorna la página ya traducida.
}

//Esta función será usada de forma global a través del proyecto traduciendo en el
//idioma indicado cada cadena (string), la función recibe como parámetros una cadena
// a traducir y el idioma en el cual se realizará la traducción, la función
//retorna un string con la cadena ya traducida.

    function traducirstring($string, $idioma) {
        require $idioma;
        $pagina = $string;
        foreach ($leng as $clave=>$valor) { //Por cada arreglo llamado leng que es el que contiene las etiquetas y su respectiva traducción...
                $pagina = str_replace('@@'.$clave.'@@', $valor, $pagina); //A página se asigna la sustitución de cada etiqueta encontrada por su valor de significado
        }
        return $pagina;
    }

?>
