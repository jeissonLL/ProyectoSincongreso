<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_crear_actividades_voluntarios.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>
