<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_dictaminar_trabajos_eps.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
