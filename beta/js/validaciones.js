/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {    
    $('#cprincipal').blur(function(){
        var cprincipal = 'cprincipal='+$(this).val();     
        $.ajax({
            type: "POST",
            url: "./funciones/funcion_validaciones.php?validar=ecorreo",
            data: cprincipal,
            success: function(data) {
                if(data === '0' )
                {
                    $.Notification.notify('error','bottom center','Correo no disponible', 'Ingrese un nuevo correo, este ya existente dentro de nuestra información')
                    $('#cprincipal').focus();
                }
            }
        });
    }); 
    $('#nusuario').blur(function(){
        var nusuario = 'nusuario='+$(this).val();     
        $.ajax({
            type: "POST",
            url: "./funciones/funcion_validaciones.php?validar=eusuario",
            data: nusuario,
            success: function(data) {
//                $('#info').fadeIn(1000).html(data);
                if(data === '0')
                {
                    $.Notification.notify('error','bottom center','Nombre de Usuario no disponible', 'Ingrese un nuevo nombre de usuario, este ya existente dentro de nuestra información')
                    $('#nusuario').focus();
                }
            }
        });
    });              
});    

