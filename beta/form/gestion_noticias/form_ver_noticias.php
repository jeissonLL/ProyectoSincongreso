<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_ver_noticias.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>

