<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_trabajos_subidos.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>