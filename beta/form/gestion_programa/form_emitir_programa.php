<?php

/* 
 * @Obed
 */

  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_emitir_programa.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
