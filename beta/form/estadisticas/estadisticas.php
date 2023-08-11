<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/estadisticas.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
