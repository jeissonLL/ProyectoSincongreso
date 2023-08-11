<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_aceptar_autorias.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
