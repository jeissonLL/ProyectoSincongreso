/* Alex Siboney Vargas Osorto
 * 7/5/2017
 * alexv7142@gmail.com / avargas@iies-unah.org
 * Manejo de las acciones para la pantalla de creación/gestión de Líneas de Investigación
 */

//Dibujo del formulario dentro de la pantalla principal.



var tr; //Esta variable identifica la fila en la que se está ejecutando una acción, por ejemplo, en el momento de
//editar una línea de investigación, esta variable guarda referencia hacia esa línea en cuestión, para luego
//editarla con los datos ingresados dentro de el datatable.

//Crear/Modificar lineas de investigación
function crear_modificar_linea(tabla) {
    $("#crear_linea").click(function () {
        if ($("#form_linea").valid()) {
            bloquear_envio();
            var caso = $("#caso_linea").val();
            var linea_a_modificar;
            $.ajax({
                cache:false,
                url: "./includes/querys.php?caso=" + caso,
                type: "POST",
                data: $('#form_linea').serialize(),
                success: function (resp) {
                    alert(resp);
                    //var i = parseInt(resp);
                    console.log(i);
                    if (caso == 'modificar_linea') {
                        var id_linea_modificar = $("#id_linea").val();
                        $.ajax({
                            cache:false,
                            async: false,
                            method: "POST",
                            url: "./includes/fnc_datatbl.php?caso=linea_modificar",
                            data: {"id": id_linea_modificar},
                            success: function (resp) {
                                console.log(resp);
                                var linea = JSON.parse(resp);
                                linea_a_modificar = linea['data'][0];
                                //console.log(linea_a_modificar);
                                //console.log(linea_a_modificar.nombre_linea_investigacion);
                                //swal(exito_modificacion, exito, "success" );
                                //$("#caso_linea").val('crear_linea');
                                //$("#id_linea").val("");
                            }
                        });
                        if (i == 1) {
                            tabla.row(tr).remove().draw(false);
                            tabla.row.add(linea_a_modificar).draw(false);
                            limpiar_formulario();
                            swal(exito_modificacion_linea, "", "success");
                            habilitar_envio();

                            //console.log(tr);
                        } else {
                            if ($("#nombrelinea").val() == linea_a_modificar.nombre_linea_investigacion, $("#abreviacion").val() == linea_a_modificar.abreviacion, $("#descripcion_linea").val() == linea_a_modificar.descripcion_linea_investigacion, $("#comentarios_linea").val() == linea_a_modificar.comentarios) {
                                alert("No se está realizando ningún cambio en los datos de ésta línea");
                                habilitar_envio();
                            } else {
                                swal(error_envio_linea);
                                habilitar_envio();
                            }
                        }

                    } else {
                        if (i > 0) {
                            $.ajax({
                                cache:false,
                                method: "POST",
                                url: "./includes/fnc_datatbl.php?caso=ultima_linea",
                                success: function (resp) {
                                    var a = JSON.parse(resp);
                                    console.log(a['data'][0]);
                                    tabla.row.add(a['data'][0]).draw();
                                    swal(envio_correcto_datos, exito_linea, "success");
                                    limpiar_formulario();
                                    habilitar_envio();
                                }
                            });
                        } else {
                            swal(error_envio_linea);
                            habilitar_envio();
                        }
                    }
                }
            });
        }
        //habilitar_envio();
    });
}

function editar_linea(tbody, table) {
    $(tbody).on("click", "button.editarlinea", function () {
        tr = table.row($(this).parents('tr'));
        var dato = table.row(tr).data();
        $("#caso_linea").val("modificar_linea");
        $("#id_linea").val(dato.id_linea_investigacion_pk);
        $("#nombrelinea").val(dato.nombre_linea_investigacion);
        $("#abreviacion").val(dato.abreviacion);
        $("#descripcion_linea").val(dato.descripcion_linea_investigacion);
        $("#comentarios_linea").val(dato.comentarios);
        console.log(dato);
    });

}

function eliminar_linea(tbody, table) {
    $(tbody).on("click", "button.eliminarlinea", function () {
        var data = table.row($(this).parents('tr')).data();
        var tr = table.row($(this).parents('tr'));
        var id_linea = data.id_linea_investigacion_pk;
        console.log(data);
        swal({
            title: desea_eliminar_linea,
            text: advertencia_eliminar_linea,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: confirmacion_eliminarla,
            cancelButtonText: negacion_eliminarla,
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            
            if (isConfirm) {
                swal(solicitud_eliminacion);
                $.ajax({
                    async: false,
                    url: "./form/gestion_congresos_activos/comprobaciones/comprobacion.php",
                    method: "POST",
                    data: {"caso": "comprobar_eliminacion_linea", "valor": id_linea},
                    success: function (resp) {
                        alert(resp);
                        if (resp == 'false') {
                            $.ajax({
                                method: "POST",
                                url: "./includes/querys.php?caso=eliminar_linea",
                                data: {"id_linea": id_linea},
                                success: function (resp) {
                                    alert(resp);
                                    var i = parseInt(resp);
                                    if (i > 0) {
                                        swal(eliminada, linea_eliminada, "success");
                                        table.row(tr).remove().draw(false);
                                        limpiar_formulario();
                                        habilitar_envio();
                                    } else {
                                        swal(error_envio_linea);
                                    }
                                }

                            });
                        } else {
                            swal("Error", linea_llena);
                        }
                    }
                });
            } else {
                swal(cancelado, linea_investigacion_conservada, "error");
            }
        });

    });

}

$("#congreso_administrador").on("change", function () {
    var id = $("#congreso_administrador").val();
    $("#gestor_lineas").css({"display": "block"});
    limpiar_formulario();
    $("#id_congreso").val(id);
    listar_lineas(id);
    
    
});

function limpiar_formulario() {
    $("#abreviacion-error").text("");
    $('#form_linea')[0].reset();
    $("#caso_linea").val('crear_linea');
    $("#id_linea").val("");
}

function bloquear_envio() {
    document.getElementById("crear_linea").disabled = true;
    document.getElementById("reset_linea").disabled = true;
}

function habilitar_envio() {
    document.getElementById("crear_linea").disabled = false;
    document.getElementById("reset_linea").disabled = false;
}

$("#reset_linea").click(function () {
    $("#abreviacion-error").text("");
    $('#form_linea')[0].reset();
    $("#caso_linea").val('crear_linea');
    $("#id_linea").val("");
});

