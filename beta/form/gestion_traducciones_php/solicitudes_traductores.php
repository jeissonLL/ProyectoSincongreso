<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/solicitudes_traductores.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
