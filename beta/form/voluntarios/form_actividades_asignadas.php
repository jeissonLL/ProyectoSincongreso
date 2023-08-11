<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_actividades_asignadas.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
