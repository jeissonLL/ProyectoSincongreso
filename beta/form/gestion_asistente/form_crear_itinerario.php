<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_crear_itinerario.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
