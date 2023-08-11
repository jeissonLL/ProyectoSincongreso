<?php
  include '../funciones/funcion_traducir.php';
  session_start();
//print_r($_SESSION);

  $formulario = traducir('./extras-profile.php', '../idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
  echo $formulario;
 ?>