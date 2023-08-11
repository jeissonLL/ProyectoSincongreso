<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/traducciones.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

