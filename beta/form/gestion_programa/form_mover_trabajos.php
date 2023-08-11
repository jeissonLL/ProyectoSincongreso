<?php

/* 
 * @Obed
 */

  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_mover_trabajos.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

