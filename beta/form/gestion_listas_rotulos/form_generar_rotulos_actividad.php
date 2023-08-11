<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/from_generar_rotulos_actividad.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
