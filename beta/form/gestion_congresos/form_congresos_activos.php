<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/congresos_activos.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

