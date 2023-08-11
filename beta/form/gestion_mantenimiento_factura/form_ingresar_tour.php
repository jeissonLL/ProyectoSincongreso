<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_ingresar_tour.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
