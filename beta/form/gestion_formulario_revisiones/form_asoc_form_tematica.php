<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/asoc_form_tematica.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
