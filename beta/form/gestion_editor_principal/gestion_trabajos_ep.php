<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/gestion_trabajos_ep.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>