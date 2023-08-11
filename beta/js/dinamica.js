/**--------
 * 
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */
$(document).ready(function () {
    //$('#contenedor').html("");
    $('input[type=password]').keyup(function () {
        // set password variable
        var pswd = $(this).val();
        //validate the length
        if (pswd.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid');
        }

        //validate letter
        if (pswd.match(/[A-z]/)) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
        }

        //validate capital letter
        if (pswd.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
        }

        //validate number
        if (pswd.match(/\d/)) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
        }

    }).focus(function () {
        $('#contrasenia_info').show();
    }).blur(function () {
        $('#contrasenia_info').hide();
    });

    $("form").submit(function () {
        $("#btn_registro").prop('disabled', true);
        var form = this.form;
        var form_id = $(this).closest("form").attr('id');
        var url = './includes/conductor_persona.php?formulario=' + form_id;
        
         
        $.ajax({
            type: $('#' + form_id).attr('method'),
            url: url,
            data: $('#' + form_id).serialize(),
            success: function (data) {
                console.log(data);
                if (form_id == 'form_registro')
                {
                    if (data == 1){
                        alert("Usuario creado con éxito");
                        $(window).attr('location', './login.php');
                        $("#btn_registro").prop('disabled', false);
                    } else {
                        alert("Verifique sus datos por favor!");
                        $("#btn_registro").prop('disabled', false);
                    }
                } else {
                    if (form_id == 'form_login'){

                        if (data == 1){
                            $(window).attr('location', './menu_principal.php');
                        } else {
                            if (data == 2){
                                alert("Usuario no exite");
                            } else {
                                alert("Usuario y Contraseña no coinciden");
                            }
                        }
                    }else{
                        if(form_id == 'form_perfil'){
                            if(data == 1 || data == 3){
                                alert("Datos guardados exitosamente");
                                $("#perfil").trigger("click");
                            }else{
                                if (data == 0){ alert("Verifique sus datos por favor!");}
                                else{alert("Ups... Tenemos un problema comuniquese con el administrador");}
                            }
                        }else{
                            if(form_id == 'form_recuperar'){
                                if(data == 1){
                                    alert ("Se ha enviado a su correo un mensaje conteniendo su nueva contraseña");
                                    $("#custom-modal .close").click();
                                }else{
                                    alert("Verifique sus datos por favor...")
                                }
                                
                            }else
                                if(form_id == 'form_solicitud')
                                    {
                                        if(data == 1){
                                            alert ("Se ha enviado a su correo una copia del mensaje con su solicitud que fue enviado al administrador del congreso");
                                            window.location.href = "./menu_principal.php";
                                        }else{
                                            alert("Verifique sus datos por favor...");

                                        }
                                    }else
                                        if(form_id == 'form_info_req'){
                                            if(data==0){
                                                $("#con-close-modal").modal('hide'); 
                                            }else{
                                                alert("Verifique sus datos por favor...");
                                            }
                                        }
                        }
                    }
                }
            }
        });
        return false;
    });
});


