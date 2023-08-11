<?php

/* 
 * Autor:  Obed
 * Fecha: 20-06-17
 */

  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_dictaminar_trabajos_ep.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
