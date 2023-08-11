<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_mensajes_voluntarios.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
