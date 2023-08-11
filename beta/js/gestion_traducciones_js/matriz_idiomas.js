/*   Alex Siboney Vargas Osorto
 23/3/2017
 alexv7142@gmail.com / avargas@iies-unah.org
 matriz_idiomas.js
 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Este es el controlador del submódulo Matriz Idiomas del módulo de traducciones.
 ---
 */

function listar_idiomas() {
    var tabla = $('#datatable-buttons').DataTable({
        "destroy": true,
        "ajax": {
            "async": true,
            "method": "POST",
            "url": "./includes/fnc_datatbl.php?caso=datatbl_idiomas",
            "cache": false
        },
        "columns": [
            {"data": "nombre_idioma", width: "25%"},
            {"data": "bandera", width: "10%"},
            {"data": "nombre_estado", width: "20%"},
            {"data": "porcentaje_traduccion", width: "20%"},
            {"data": "botones", widht: "25%"}
        ],
        "language": idioma_datatable,
        dom: "<'row'<'form-inline' <'col-sm-offset-3'B>>>"
                + "<'row'<'col-sm-6'><'col-sm-6'>>"
                + "<'row'<'col-sm-6'l><'col-sm-6'f>>"
                + "<'row'<'col-sm-12'tr>>"
                + "<'row'<'col-sm-12'i>"
                + "<'row'<'col-sm-6'><'col-sm-6'>>"
                + "<'col-sm-12'p>>",
        buttons: []
    });
    activar_idioma("#datatable-buttons tbody", tabla);
    inactivar_idioma("#datatable-buttons tbody", tabla);
    habilitar_traduccion("#datatable-buttons tbody", tabla);
    finalizar_traduccion("#datatable-buttons tbody", tabla);
    crear_respaldo("#datatable-buttons tbody", tabla);
    cargar_respaldo_idioma("#datatable-buttons", tabla);
}

function cargar_pagina() {
    $.ajax({
        async: false,
        method: "POST",
        url: "form/gestion_traducciones_php/matriz_idiomas.php",
        success: function (resp) {
            $('#contenedor').html("");
            $('#contenedor').html(resp);
            setTimeout("ocultarprecarga()", 1500);
        }
    });
}
function ocultarprecarga() {
    $('#cargando').modal("hide");
}
function activar_idioma(tbody, tabla) {
    $(tbody).on("click", "button.activaridioma", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var p_temp = data.porcentaje_traduccion;
        var p_temp2 = p_temp.split("%");
        var p_temp3 = parseInt(p_temp2[0]);
        if (p_temp3 < 90) {
            swal(menor90);
        } else {
            $.ajax({
                cache: false,
                async: false,
                method: "POST",
                url: "./includes/querys.php?caso=activar_idioma",
                data: {"id_idioma_pk": data.id_idioma_pk},
                success: function (resp) {
                    var respuesta = resp.split("<>");
                    var parse_json = JSON.parse(respuesta[1]);
                    var json = parse_json['data'][0];
                    if (respuesta[0] == "1") {
                        swal(idioma_activado, "", "success");
                        tabla.row(tr).remove().draw(false);
                        tabla.row.add(json).draw(false);
                    } else {
                        swal(error_envio);
                    }
                }
            });
        }

    });
}

function inactivar_idioma(tbody, tabla) {
    $(tbody).on("click", "button.incativaridioma", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        $.ajax({
            cache: false,
            async: false,
            method: "POST",
            url: "./includes/querys.php?caso=inactivar_idioma",
            data: {"id_idioma_pk": data.id_idioma_pk},
            success: function (resp) {
                var respuesta = resp.split("<>");
                var parse_json = JSON.parse(respuesta[1]);
                var json = parse_json['data'][0];
                if (respuesta[0] == "1") {
                    swal(idioma_inactivado, "", "success");
                    tabla.row(tr).remove().draw(false);
                    tabla.row.add(json).draw(false);
                } else {
                    swal(error_envio);
                }
            }
        });
    });
}

function habilitar_traduccion(tbody, tabla) {
    $(tbody).on("click", "button.habilitartraduccion", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        $.ajax({
            cache: false,
            async: false,
            method: "POST",
            url: "./includes/querys.php?caso=habilitar_traduccion",
            data: {"id_idioma_pk": data.id_idioma_pk},
            success: function (resp) {
                respuesta = resp.split("<>");
                var parse_json = JSON.parse(respuesta[1]);
                var json = parse_json['data'][0];
                if (respuesta[0] == "1") {
                    swal(traduccion_habilitada, "", "success");
                    tabla.row(tr).remove().draw(false);
                    tabla.row.add(json).draw(false);
                } else {
                    swal(error_envio);
                }
            }
        });
    });
}

function finalizar_traduccion(tbody, tabla) {
    $(tbody).on("click", "button.finalizartraduccion", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var p_temp = data.porcentaje_traduccion;
        var p_temp2 = p_temp.split("%");
        var p_temp3 = parseInt(p_temp2[0]);
        if (p_temp3 < 100) {
            swal(menor100);
        } else {
            $.ajax({
                cache: false,
                async: false,
                method: "POST",
                url: "./includes/querys.php?caso=activar_idioma",
                data: {"id_idioma_pk": data.id_idioma_pk},
                success: function (resp) {
                    var respuesta = resp.split("<>");
                    var parse_json = JSON.parse(respuesta[1]);
                    var json = parse_json['data'][0];
                    if (respuesta[0] == "1") {
                        swal(finalizacion_traduccion, "", "success");
                        tabla.row(tr).remove().draw(false);
                        tabla.row.add(json).draw(false);
                    } else {
                        swal(error_envio);
                    }
                }
            });
        }
    });
}

function crear_respaldo(tbody, tabla) {
    $(tbody).on("click", "button.crearrespaldo", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var id_idioma_pk = data.id_idioma_pk;
        $.ajax({
            cache: false,
            async: false,
            method: "POST",
            url: "./includes/querys.php?caso=crear_respaldo",
            data: {"id_idioma_pk": id_idioma_pk},
            success: function (resp) {
                var identificador = parseInt(resp);
                var ruta_descarga = "./idiomas/" + id_idioma_pk + "/repositorio/" + id_idioma_pk + "_" + identificador + ".txt";
                $("#descarga_respaldo_idioma").attr("href", ruta_descarga);
                modal();
            }
        });
    });
}

function modal() {
    // $('#con-close-modal').removeAttr('style');
    $('#con-close-modal').modal({
        show: 'true'
    });
}

function cargar_respaldos_idioma() {
    $.ajax({
        async: true,
        method: "POST",
        url: "./includes/fnc_tbl.php",
        data: {"funcion": 'tbl_respaldos_idioma', "id": global_id_idioma_pk},
        success: function (resp) {
            $("#respaldo_idioma").html("");
            $("#respaldo_idioma").html(resp);
        }
    });
}
var global_id_idioma_pk;
function cargar_respaldo_idioma(tbody, tabla) {
    $(tbody).on("click", "button.cargarrespaldo", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        global_id_idioma_pk = data.id_idioma_pk;
        $("#elegir_m_carga_r_idioma").modal({show: true});
    });
}

$("#subir_archivo").click(function () {
    $("#elegir_m_carga_r_idioma").modal("hide");
    $("#subir_respaldo_archivo_idioma").modal({show: true});
});

$("#elegir_d_existente").click(function () {
    cargar_respaldos_idioma();
    $("#elegir_m_carga_r_idioma").modal("hide");
    $("#cargar_respaldo_archivo_idioma").modal({show: true});
});

$("#subir_ri").click(function () {
    if ($("#form_subir_respaldo_idioma").valid()) {
        $("#id_idioma_r").val(global_id_idioma_pk);
        var formData = new FormData($("#form_subir_respaldo_idioma")[0]);
        var ruta = "./includes/querys.php?caso=subir_cargar_archivo_respaldo_idioma";
        $.ajax({
            url: ruta,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (resp) {
                var id = parseInt(resp);
                if (id > 0) {
                    $("#subir_respaldo_archivo_idioma").modal("hide");
                    swal(subir_cargar_archivo_exito, "", "success");
                } else {
                    $("#subir_respaldo_archivo_idioma").modal("hide");
                    swal(error_envio);
                }

            }
        });
    }
});

function cargar_respaldo_existente_idioma(archivo) {
    $.ajax({
        url: "./includes/querys.php?caso=cargar_respaldo_idioma",
        type: "POST",
        data: {"archivo": archivo},
        success: function (resp) {
            var id = parseInt(resp);
            if (id > 0) {
                $("#cargar_respaldo_archivo_idioma").modal("hide");
                swal(subir_cargar_archivo_exito, "", "success");
            } else {
                $("#cargar_respaldo_archivo_idioma").modal("hide");
                swal(error_envio);
            }

        }
    });
}

