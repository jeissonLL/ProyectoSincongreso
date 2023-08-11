<?php

  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_gestion_premios_ep.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
