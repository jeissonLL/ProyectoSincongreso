<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_asistencia_persona.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
