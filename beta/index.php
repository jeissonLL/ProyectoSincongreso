<?php
    
    include './funciones/funcion_traducir.php';
    session_start();
    if(isset($_SESSION['idioma']))
    {
        session_destroy();    
        
    }
    $_SESSION['idioma'] =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);        
    $formulario = traducir('./form/index.php', './idiomas/'.$_SESSION['idioma'].'/'.$_SESSION['idioma'].'.php');
    echo $formulario;
 ?>