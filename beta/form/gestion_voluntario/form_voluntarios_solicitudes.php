<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_voluntarios_solicitudes.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
