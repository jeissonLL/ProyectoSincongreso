<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/solicitudes_de_revision.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
