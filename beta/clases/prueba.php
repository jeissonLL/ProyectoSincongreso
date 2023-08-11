<?php
require './class_base.php';
global $bdd;
    $bdd = new basedatos();
    $datos=$bdd->select('select * from tbl_idioma'); 
    foreach ($datos as $key => $value) {
     
    echo $value['id_idioma_pk']." ".html_entity_decode(utf8_decode($value['nombre_idioma']))."<br>";
   //$a = $bdd->update("update tbl_idioma set nombre_idioma =". $b. "where id_idioma_pk = ".$value['id_idioma_pk']."", TRUE);

    
//    $bdd = new basedatos();
//    $datos=$bdd->select('select * from tbl_pais'); 
//    foreach ($datos as $key => $value) {
//    echo $value['id_pais_pk']." ".utf8_decode($value['nombre_pais'])."<br>";
}
?>

