<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_validar_pagos.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
