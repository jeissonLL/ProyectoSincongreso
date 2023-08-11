<?php

/* 
 * Autor: Obed Martínez
 * 09/06/2017.
 */

  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_trabajos_revision.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
