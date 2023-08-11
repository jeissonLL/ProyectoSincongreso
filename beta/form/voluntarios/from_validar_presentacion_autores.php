<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/from_validar_presentacion_autores.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
