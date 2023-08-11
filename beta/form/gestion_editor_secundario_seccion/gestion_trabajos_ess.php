<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/gestion_trabajos_ess.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

