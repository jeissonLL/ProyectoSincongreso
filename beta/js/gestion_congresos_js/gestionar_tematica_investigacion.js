/* Alex Siboney Vargas Osorto
 * 7/5/2017
 * alexv7142@gmail.com / avargas@iies-unah.org
 * Manejo de las acciones para la pantalla de creación/gestión de Líneas de Investigación
 */



var tr; //Esta variable identifica la fila en la que se está ejecutando una acción, por ejemplo, en el momento de
//editar una línea de investigación, esta variable guarda referencia hacia esa línea en cuestión, para luego
//editarla con los datos ingresados dentro de el datatable.

//Crear/Modificar lineas de investigación
function crear_modificar_tematica(tabla) {
    $("#crear_tematica").click(function () {
        if ($("#form_tematica").valid()) {
            bloquear_envio();
            var caso = $("#caso_tematica").val();
            var tematica_a_modificar;
            $.ajax({
                cache:false,
                url: "./includes/querys.php?caso="+caso,
                type: "POST",
                data: $('#form_tematica').serialize(),
                success: function (resp) {
                   
                        $('#form_tematica')[0].reset();//Limpiar Formulario
                        swal(envio_correcto_datos, exito_tematica, "success");
                          //var i = parseInt(resp);
                    //console.log(i);
                   
                  
                  
                 
                    
                    if (caso == 'modificar_tematica') {
                        var id_tematica_modificar = $("#id_tematica").val();
                        $.ajax({
                            cache:false,
                            async: false,
                            method: "POST",
                            url: "./includes/fnc_datatbl.php?caso=tematica_modificar",
                            data: {"id": id_tematica_modificar},
                            success: function (resp) {
                                console.log(resp);
                                var tematica = JSON.parse(resp);
                                tematica_a_modificar = tematica['data'][0];
                            }
                        });
                        if (i == 1) {
                            tabla.row(tr).remove().draw(false);
                            tabla.row.add(tematica_a_modificar).draw(false);
                            limpiar_formulario();
                            swal(exito_modificacion_tematica, "", "success");
                            habilitar_envio();

                            console.log(tr);
                        } else {
                            if ($("#nombretematica").val() == tematica_a_modificar.nombre_tematica, $("#abreviacion").val() == tematica_a_modificar.abreviacion, $("#descripcion_tematica").val() == tematica_a_modificar.descripcion_tematica, $("#comentarios_tematica").val() == tematica_a_modificar.comentarios) {
                                alert("No se está realizando ningún cambio en los datos de ésta línea");
                                habilitar_envio();
                            } else {
                                swal(error_envio_tematica);
                                habilitar_envio();
                            }
                        }

                    } else {
                        if (i > 0) {
                            $.ajax({
                                cache:false,
                                method: "POST",
                                url: "./includes/fnc_datatbl.php?caso=ultima_tematica",
                                success: function (resp) {
                                    var a = JSON.parse(resp);
                                    console.log(a['data'][0]);
                                    tabla.row.add(a['data'][0]).draw();
                                    swal(envio_correcto_datos, exito_tematica, "success");
                                    limpiar_formulario();
                                    habilitar_envio();
                                }
                            });
                        } else {
                            swal(error_envio_tematica);
                            habilitar_envio();
                        }
                    }
                }
            });
        }
        //habilitar_envio();
    });
}

function editar_tematica(tbody, table) {
    $(tbody).on("click", "button.editartematica", function () {
        tr = table.row($(this).parents('tr'));
        var dato = table.row(tr).data();
        $("#caso_tematica").val("modificar_tematica");
        $("#id_tematica").val(dato.id_tematica_pk);
        $("select").val(dato.id_linea_investigacion_pk);
        //$("#lineas_investigacion> option[value='"+ dato.id_linea_investigacion_pk+"']").attr("selected",true);
        //$("#lineas_investigacion").val(dato.id_linea_investigacion_pk);
        $("#nombretematica").val(dato.nombre_tematica);
        $("#abreviacion").val(dato.abreviacion);
        $("#descripcion_tematica").val(dato.descripcion_tematica);
        $("#comentarios_tematica").val(dato.comentarios);
        console.log(dato);
    });

}

function eliminar_tematica(tbody, table) {
    $(tbody).on("click", "button.eliminartematica", function () {
        var data = table.row($(this).parents('tr')).data();
        var tr = table.row($(this).parents('tr'));
        var id_tematica = data.id_tematica_pk;
        //console.log(data);
        swal({
            title: desea_eliminar_tematica,
            text: advertencia_eliminar_tematica,
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
                    url: "./form/gestion_congresos/comprobaciones/comprobacion.php",
                    method: "POST",
                    data: {"caso": "comprobar_eliminacion_tematica", "valor": id_tematica},
                    success: function (resp) {
                        if (resp == 'false') {
                            $.ajax({
                                method: "POST",
                                url: "./includes/querys.php?caso=eliminar_tematica",
                                data: {"id_tematica": id_tematica},
                                success: function (resp) {

                                    var i = parseInt(resp);
                                    if (i > 0) {
                                        swal(eliminada, tematica_eliminada, "success");
                                        table.row(tr).remove().draw(false);
                                    } else {
                                        swal(error_envio_tematica);
                                    }
                                }

                            });
                        } else {
                            swal("Error", tematica_contiene);
                        }
                    }
                });
            } else {
                swal(cancelado, tematica_investigacion_conservada, "error");
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
    $('#form_tematica')[0].reset();
    $("#caso_tematica").val('crear_tematica');
    $("#id_tematica").val("");
}

function bloquear_envio() {
    document.getElementById("crear_tematica").disabled = true;
    document.getElementById("reset_tematica").disabled = true;
}

function habilitar_envio() {
    document.getElementById("crear_tematica").disabled = false;
    document.getElementById("reset_tematica").disabled = false;
}

$("#reset_tematica").click(function () {
    $("#abreviacion-error").text("");
    $('#form_tematica')[0].reset();
    $("#caso_tematica").val('crear_tematica');
    $("#id_tematica").val("");
});

