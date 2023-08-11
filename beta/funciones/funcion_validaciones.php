<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//print_r($_POST);
$validar= filter_input(INPUT_GET,'validar');
switch ($validar) {
    case 'eusuario': //existe usuario
        eusuario();
        break;
    case 'ecorreo':
        ecorreo();
        break;  
    case 'veri_tiempo':
        veri_tiempo();
        break;   
    case 'form_perfil':
        update_perfil();
        break;     
    case 'form_img':
        img();
        break;    
    case 'form_recuperar':
        form_recuperar();
        break;         
}
function veri_tiempo(){

//    session_start();      
    $ahorita = new DateTime();  
    $hoy = $_SESSION['hoy'];
//    print_r($hoy);
//    print_r($ahorita);
    $ahora = $ahorita->diff($hoy);
//    print_r($ahora);
    $hora = ($ahora->h)*3600;
    $min = ($ahora->i)*60;
    $seg =  ($ahora->s);
    $diff = $hora+$min+$seg;
    if($diff<=300)
    {
        $_SESSION['hoy'] = $ahorita;
        return 1;
    }else{
        return 0;
    }
}
function eusuario()
{
//    sleep(1);
    include_once '../clases/class_persona.php';
    $nusuario= filter_input(INPUT_POST,'nusuario');
    $usuario = new usuario();
    $usuario ->uinicializar('', $nusuario, '','', '');
    $datos = $usuario ->get_nusuario();

    foreach ($datos as $fila) {
            if($fila['nombre_usuario'] == $nusuario)
            {
                echo '0';
            }else{
                echo '1';
            
                }    
        }
}

function ecorreo()
{
//    sleep(1);
        include_once '../clases/class_persona.php';
    $cprincipal = filter_input(INPUT_POST,'cprincipal');
    $usuario = new usuario();
    $usuario ->uinicializar('', '', '','', $cprincipal);
    $datos = $usuario ->get_ucorreo();

    foreach ($datos as $fila) {
            if($fila['correo'] == $cprincipal)
            {
                echo '0';
            }else{
                echo '1';
            
                }    
        }
}

