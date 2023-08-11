<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/modificar_form_revision.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

