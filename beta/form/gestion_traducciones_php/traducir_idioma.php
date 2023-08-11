<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/traducir_idioma.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

