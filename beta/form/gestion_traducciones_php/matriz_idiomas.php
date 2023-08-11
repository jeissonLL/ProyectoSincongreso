<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/matriz_idiomas.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
