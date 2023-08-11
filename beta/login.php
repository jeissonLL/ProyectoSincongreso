<?php
  include './funciones/funcion_traducir.php';
  session_start();

  if(isset($_SESSION['idioma']))
    {
        if(isset($_SESSION['nusuario']))
        {
            session_destroy();
            header('Location: index.php');      
        }else{
            $formulario = traducir('./form/login.php', './idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
            echo $formulario;         
        }

    }else{  
        header('Location: index.php');
    }
 ?>