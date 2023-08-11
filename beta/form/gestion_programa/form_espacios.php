<?php

/* 
 * @Obed
 */

  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_espacios.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

