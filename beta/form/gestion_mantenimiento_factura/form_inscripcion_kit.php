<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_inscripcion_kit.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
