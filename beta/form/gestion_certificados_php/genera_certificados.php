<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/genera_certificados.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>