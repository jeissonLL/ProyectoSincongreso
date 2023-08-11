<?php
  require '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/gestion_tematicas_investigacion.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>