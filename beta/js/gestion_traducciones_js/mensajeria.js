
/*
Alex Siboney Vargas Osorto
27-2-2017
alexv7142@gmail.com
Manejo de menú traduccione
*/


//Función para guardar los mensajes enviados
function guardar_mensajeria() {
    document.getElementById("enviar").disabled = true;
    var caso = $("#caso").val();
    var exito = $("#exito_msj").val();
    var error = $("#error_msj").val();
    $.ajax({
        url: "./includes/querys.php?caso=" + caso,
        type: "POST",
        data: $('#form_envio_mensajes').serialize(),
        success: function (resp) {
            console.log(resp);
            $i = parseInt(resp);
            if($i) {
            incluirdiv('bandeja_mensajes');
            swal(exito, "", "success");
            $('#form_envio_mensajes')[0].reset();
            document.getElementById("enviar").disabled = false;
        }
        else {
            swal(error);
        }
        }
    });
    return false;
}
//Función para responder a un mensaje principal
function responder_mensaje($id_mensaje) {
    document.getElementById("boton_"+$id_mensaje).disabled = true;
    var caso_msj = $("#caso_msj").val();
    $.ajax({
        url: "./includes/querys.php?caso=" + caso_msj,
        type: "POST",
        data: $("#form_respuesta_mensaje_"+$id_mensaje).serialize(),
        success: function (resp) {
            console.log(resp);
            document.getElementById("respuesta_mensaje_"+$id_mensaje).disabled = true;
            incluirdiv('bandeja_mensajes');
            //incluirdiv('bandeja_mensajes_voluntario');
        }
    });
    return false;
}

//Función para guardar los mensajes que se responden a una connversación
function responder_en_conversacion($id) {
   document.getElementById("boton_"+$id).disabled = true;
   var caso_rc = $("#caso_rc").val();
    $.ajax({
        url: "./includes/querys.php?caso=" + caso_rc,
        type: "POST",
        data: $("#form_respuesta_conversacion_"+$id).serialize(),
        success: function (resp) {
            console.log(resp);
            document.getElementById("respuesta_cv_"+$id).disabled = true;
            incluirdiv('bandeja_mensajes');
            //incluirdiv('bandeja_mensajes_voluntario');
        }
    });
    return false;
}


