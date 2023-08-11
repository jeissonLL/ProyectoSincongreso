<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/asociar_administrador_congreso.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

