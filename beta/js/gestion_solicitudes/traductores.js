/**--------
 * 
 * @author José L. Rodríguez G.
 * @copyright 2017
 * @version 1
 */

function aceptar_traductor(tbody, tabla) {
    $(tbody).on("click", "button.aceptartraductor", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
            var funcion="aceptar_solicitud";
            $.ajax({
                cache: false,
                async: false,
                method: "POST",
                url: "./form/gestion_roles/plantillas/funciones.php",
                data: {"idsol": data.id_solicitud, "funcion":funcion},
                success: function (resp) {
                    if (resp == "1") {
                        swal(solicitud_aceptada, "", "success");
                    } else {
                        swal(error_envio);
                    }
                }
            });


    });
}

function rechazar_traductor(tbody, tabla) {
    $(tbody).on("click", "button.rechazartraductor", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var funcion="rechazar_solicitud";
        $.ajax({
            cache: false,
            async: false,
            method: "POST",
            url: "./form/gestion_roles/plantillas/funciones.php",
            data: {"idsol": data.id_solicitud, "funcion":funcion},
            success: function (resp) {
                 if (respuesta[0] == "1") {
                    swal(solicitud_rechazada, "", "success");

                } else {
                    swal(error_envio);
                }
            }
        });
    });
}