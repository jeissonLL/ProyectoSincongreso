<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_subir_trabajo.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
