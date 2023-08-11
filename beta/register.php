<?php

  include './funciones/funcion_traducir.php';
  session_start();
  $formulario = traducir('./form/registro.php', './idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
  echo $formulario;
 ?>