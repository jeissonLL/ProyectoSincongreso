<?php
  include '../../funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('plantillas/form_consultar_programa.php', '../../'.$_SESSION['idm']);
  echo $formulario;
 ?>