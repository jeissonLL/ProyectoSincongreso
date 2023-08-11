<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/mensajeria.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>