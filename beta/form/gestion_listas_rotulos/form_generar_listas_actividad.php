<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_generar_listas_actividad.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
