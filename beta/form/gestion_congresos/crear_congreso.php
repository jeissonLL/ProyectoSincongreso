<?php


require '../../clases/class_base.php';
require '../../clases/clase_Congreso.php';


  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/crear_congreso.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>