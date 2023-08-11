<?php

/* 
 * Funciones para editar certificados.
 * Autor: Obed Martínez
 * 28/02/17
 */
require_once "../../../clases/class_base.php";
session_start();	
$caso = $_GET["caso"];
switch ($caso) {   
     case "modificar_certificados":
        modificar_certificados();
        break;
}
function modificar_certificados(){
     global $bdd;
    $bdd = new basedatos();
    $id_certificado=filter_input(INPUT_POST, "id_certificado");
    $datos=$bdd->select("select * from tbl_certificados where id_certificado_pk='".$id_certificado."' "); 
    $array_c = array();   
    $array_d = array(); 
    $array_e = array(); 
    foreach ($datos as $fila) {        
    $array_c=array("id_certificado_pk" => $fila["id_certificado_pk"],
                    "nombre_certificado" => $fila["nombre_certificado"],
                    "encabezado_certificado" => $fila["encabezado_certificado"],
                    "motivo_certificado" => $fila["motivo_certificado"],
                    "pie_certificado" => $fila["pie_certificado"],
                    "url_arte" => $fila["url_arte"],
                    "certificado_especial" => $fila["certificado_especial"],
                    "nombre_persona" => $fila["nombre_persona"],
                    "idrol_congreso" => $fila["idrol_congreso"]
                ); 
   
    }
    $datos1=$bdd->select("select * from tbl_usuario_firma_certificado a, tbl_persona b where a.id_certificado_pk='".$id_certificado."' and a.id_persona_pk=b.id_persona_pk "); 
    $array_d = array();
    $i=0;
    foreach ($datos1 as $fila1) {        
            $array_d["id_persona_pk".$i] = $fila1["identificacion"];
            $array_d["identificacion".$i] = $fila1["identificacion"];
            $array_d["primer_nombre".$i] = $fila1["primer_nombre"];
            $array_d["segundo_nombre".$i] = $fila1["segundo_nombre"];
            $array_d["primer_apellido".$i] = $fila1["primer_apellido"];
            $array_d["segundo_apellido".$i] = $fila1["segundo_apellido"];
            $array_d["url_firma".$i] = $fila1["url_firma"];  
            $i++;
    } 
    $n_firmas = array();
    $n_firmas["n_firmas"] = $i;
    $array_e = array_merge($array_c,$array_d,$n_firmas);    
    echo "" . json_encode($array_e) . "";   
}

