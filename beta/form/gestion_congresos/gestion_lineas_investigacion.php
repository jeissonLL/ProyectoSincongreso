<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/gestion_lineas_investigacion.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>