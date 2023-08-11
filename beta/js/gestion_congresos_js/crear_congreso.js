/*
 Alex Siboney Vargas Osorto
 23-3-2017
 alexv7142@gmail.com
 Manejo de menú traduccione
 */

function retorno(resp) {
    $('#contenedor').html(resp);
}
var tr;

function crear_modificar_congreso(tabla) {
    $("#cr_c").click(function() {
        
        validarformulario();
        if(   $("#form_congresos").valid()   ) {
            var caso   =    $("#caso_congreso").val();
            var formData = new FormData($("#form_congresos")[0]);
           
            var ruta = "./includes/querys.php?caso="+caso;
            var respuesta;
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (resp) {
                    //alert(resp);
                    respuesta = resp.split("<>");
                    var parse_json = JSON.parse(respuesta[1]);
                    var json = parse_json['data'][0];
                   // console.log(parse_json);
                    if(resp) {
                        if($("#caso_congreso").val() == "crear_congreso") {
                            swal(congreso_creado, "", "success");
                            tabla.row.add(json).draw(false);
                            limpiar_formulario();
                            
                            
                        }
                        else {
                            swal(congreso_editado, "", "success");
                            tabla.row(tr).remove().draw(false);
                            tabla.row.add(json).draw(false);
                            limpiar_formulario();
                        }
                    }
                    else {
                        swal(error_envio);
                        
                    }
                }
            });
        }
    });
}


function activar_congreso(tbody, tabla) {
    $(tbody).on("click", "button.activarcongreso", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var idcongreso = data.id_congreso_pk;
        console.log(data);
 
        $.ajax({
            cache: false,
            async:false,
            method:"POST",
            url:"./includes/querys.php?caso=activar_congreso",
            data: {"id_congreso_pk":idcongreso},
            success: function(resp) {
                alert(resp);
                console.log(resp);
                var respuesta = parseInt(resp);
                if(respuesta == 1) {
                    data.id_estado_congreso_fk = "1";
                    data.nombre_estado = "Activo";
                    data.botones= "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='inactivarcongreso btn btn-icon waves-effect waves-light btn-warning m-b-5' title='@@inactivar@@'><i class=' md-visibility-off'></i></button><button class='cerrarcongreso btn btn-icon waves-effect waves-light btn-purple m-b-5' title='@@cerrar@@'><i class='md-view-agenda'></i></button>";
                    tabla.row(tr).remove().draw();
                    swal(congreso_activado, "", "success");
                    tabla.row.add(data).draw();
                }
                else {
                    if(respuesta == 0) {
                        modal();
                    }
                }
            }
        });
       //console.log(data.id_congreso_pk);
    });
}

function inactivar_congreso(tbody, tabla) {
    $(tbody).on("click", "button.inactivarcongreso", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var idcongreso = data.id_congreso_pk;
        console.log(data);
        $.ajax({
            cache: false,
            async:false,
            method:"POST",
            url:"./includes/querys.php?caso=inactivar_congreso",
            data: {"id_congreso_pk":idcongreso},
            success: function(resp) {
                alert(resp);
                var respuesta = parseInt(resp);
                if(respuesta == 1) {
                    data.id_estado_congreso_fk = "2";
                    data.nombre_estado = "Inactivo";
                    data.botones= "<button class='editarcongreso btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button><button class='eliminarcongreso btn btn-icon waves-effect waves-light btn-danger m-b-5 ' title='@@eliminar_congreso@@'><i class='fa fa-trash-o'></i></button>";
                    tabla.row(tr).remove().draw();
                    swal(congreso_inactivo, "", "success");
                    tabla.row.add(data).draw();
                }
                else {
                    //alert(resp);
                }
            }
        });
       //console.log(data.id_congreso_pk);
    });
}

function modal() {
   $('#congreso_nopuede_activarsel').removeAttr('style');
        $('#congreso_nopuede_activarse').modal({
            show: 'true'         
    });
}

function cerrar_congreso(tbody, tabla) {
    $(tbody).on("click", "button.cerrarcongreso", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var idcongreso = data.id_congreso_pk;
        console.log(data);
        $.ajax({
            cache: false,
            async:false,
            method:"POST",
            url:"./includes/querys.php?caso=cerrar_congreso",
            data: {"id_congreso_pk":idcongreso},
            success: function(resp) {
                alert(resp);
                console.log(resp);
                var respuesta = parseInt(resp);
                if(respuesta == 1) {
                    data.id_estado_congreso_fk = "3";
                    data.nombre_estado = "Cerrado";
                    data.botones= "<button class='activarcongreso btn btn-icon waves-effect waves-light btn-success m-b-5' title='@@activar@@'><i class=' md-settings-power' ></i></button>";
                    tabla.row(tr).remove().draw();
                    swal(congreso_cerrado, "", "success");
                    tabla.row.add(data).draw();
                }
                else {
                    //alert(resp);
                }
            }
        });
    });
}

function editar_congreso(tbody, table) {
    $(tbody).on("click", "button.editarcongreso", function () {
        tr = $(this).parents("tr");
        var data = table.row(tr).data();
        limpiar_formulario(); alert(data.roles);
        $("#caso_congreso").val("modificar_congreso");
        $("#id_congreso_pk").val(data.id_congreso_pk);
        $("#nombre_congreso").val(data.nombre);
        $("#siglas").val(data.siglas);
        $("#descripcion_congreso").val(data.descripcion_congreso);
        $("#lugar").val(data.lugar);
        $("#coordenadas").val(data.coordenadas);
        $("#pais").val(data.id_pais_fk);
        $("#lema").val(data.lema);
        $("#numero_cai").val(data.numero_cai);
        $("#agregar_roles_congreso").html(html_roles);
        $("#roles_congreso_agregados").html(data.roles);
        $("#anio").val(data.anio);
        $("#fecha_inicio").val(data.fecha_inicio);
        $("#fecha_finalizacion").val(data.fecha_finalizacion);
        $("#fecha_i_recepcion").val(data.fecha_i_recepcion);
        $("#fecha_f_recepcion").val(data.fecha_f_recepcion);
        $("#fecha_i_revision").val(data.fecha_i_revision);
        $("#fecha_f_revision").val(data.fecha_f_revision);
        $("#fecha_p_programa").val(data.fecha_p_programa);
        $("#fecha_cambio_costo_inscripcion").val(data.fecha_cambio_costo_inscripcion);
        console.log(data);
    });
}

function eliminar_congreso(tbody, tabla) {
    $(tbody).on("click", "button.eliminarcongreso", function () {
        var data = tabla.row($(this).parents("tr")).data();
        var idcongreso = data.id_congreso_pk;
        var tr = $(this).parents("tr");
        console.log(data);
        swal({
            title: "¿Estás seguro de querer eliminar este Congreso?",
            text: "Se perderá todos los datos asociados a este congreso",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: 'btn-warning',
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                cache: false,
                async: false,
                method: "POST",
                url: "./includes/querys.php?caso=eliminar_congreso",
                data: {"id_congreso_pk": idcongreso},
                success: function (resp) {
                    var respuesta = parseInt(resp);
                    if (respuesta == 1) {
                        tabla.row(tr).remove().draw();
                        swal("¡Borrado!", "El Congreso ha sido eliminado junto con toda la información asociada a él.", "success");
                        
                    } else {
                        //alert(resp);
                    }
                }
            });
            swal("¡Borrado!", "El Congreso ha sido eliminado junto con toda la información asociada a él.", "success");
            
        });

    });
}

$("#reset_form_congreso").click(function() {
    limpiar_formulario();
});

function limpiar_formulario() {
    
    $("#caso_congreso").val("crear_congreso");
    $("#id_congreso_pk").val("");
    $("#nombre_congreso-error").text("");
    $("#siglas-error").text("");
    $("#descripcion_congreso-error").text("");
    $("#lugar-error").text("");
    $("#coordenadas-error").text("");
    $("#pais-error").text("");
    $("#logo_congreso-error").text("");
    $("#lema-error").text("");
    $("#numero_cai-error").text("");
    $("#anio-error").text("");
    $("#fecha_inicio-error").text("");
    $("#fecha_finalizacion-error").text("");
    $("#fecha_i_recepcion-error").text("");
    $("#fecha_f_recepcion-error").text("");
    $("#fecha_i_revision-error").text("");
    $("#fecha_f_revision-error").text("");
    $("#fecha_p_programa-error").text("");
    $("#fecha_cambio_costo_inscripcion-error").text(""); 
    $("#form_congresos")[0].reset();
}

$("#agregar_roles_congreso").click(function () {
    $('#agregar_roles_congreso :selected').each(function (i, sel) {
        var html = $("#roles_congreso_agregados").html();
        var id = $(sel).val();
        var texto = $(sel).text();
        var nuevo_html = '<option value="' + id + '" id="' + id + '">' + texto + '</option>';
        if (html.indexOf(nuevo_html) == -1) {
            $("#agregar_roles_congreso option:selected").remove();
            html += nuevo_html; 
            $("#roles_congreso_agregados").html(html);
        }

    });
});

$("#roles_congreso_agregados").click(function () {
    $('#roles_congreso_agregados :selected').each(function (i, sel) {
        var html = $("#agregar_roles_congreso").html();
        var id = $(sel).val();
        var texto = $(sel).text();
        var nuevo_html = '<option value="' + id + '" id="' + id + '">' + texto + '</option>';
        if (html.indexOf(nuevo_html) == -1) {
            $("#roles_congreso_agregados option:selected").remove();
            html += nuevo_html;
            $("#agregar_roles_congreso").html(html);
        }

    });
});

function validarformulario() {
    $("#form_congresos").validate({
        rules: {
            nombre_congreso: {
                required: true,
                remote: {
                    url: "./form/gestion_congresos/comprobaciones/comprobacion.php",
                    type: "POST",
                    data: {"caso": "nombre_congreso",
                        "valor": function () {
                            return $("#nombre_congreso").val();
                        },
                        "caso_congreso": function () {
                            return $("#caso_congreso").val();
                        }
                    }
                }
            },
            siglas: {
                required: true,
                remote: {
                    url: "./form/gestion_congresos/comprobaciones/comprobacion.php",
                    type: "POST",
                    data: {"caso": "siglas", "valor": function () {
                            return $("#siglas").val();
                        }, "caso_congreso": function () {
                            return $("#caso_congreso").val();
                        }
                    }
                },
                maxlength: 10
            },
            descripcion_congreso: true,
            lugar: true,
            coordenadas: true,
            pais: true,
            logo_congreso: true,
            lema: true,
            numero_cai: false,
            anio: true,
            fecha_inicio: true,
            fecha_finalizacion: true,
            fecha_i_recepcion: true,
            fecha_f_recepcion: true,
            fecha_i_revision: true,
            fecha_f_revision: true,
            fecha_p_programa: true,
            fecha_cambio_costo_inscripcion: true
        },
        messages: {
            nombre_congreso: {
                required: "@@required_nombre_congreso@@",
                remote: "@@remote_nombre_congreso@@"
            },
            siglas: {
                required: "@@required_siglas@@",
                remote: "@@remote_siglas@@",
                maxlength: "@@maxlenghth_siglas@@"
            },
            descripcion_congreso: "@@required_descripcion_congreso@@",
            lugar: "@@required_lugar@@",
            coordenadas: "@@required_coordenadas@@",
            pais: "@@required_pais@@",
            logo_congreso: {
                required: "@@required_logo_congreso@@",
                accept: "@@accept_congreso@@"
            },
            lema: "@@required_lema_congreso@@",
            numero_cai: "@@required_numero_cai@@",
            anio: "@@required_año@@",
            fecha_inicio: "@@required_fecha_inicio@@",
            fecha_finalizacion: "@@required_fecha_finalizacion@@",
            fecha_i_recepcion: "@@required_fecha_i_recepcion@@",
            fecha_f_recepcion: "@@required_fecha_f_recepcion@@",
            fecha_i_revision: "@@required_fecha_i_revision@@",
            fecha_f_revision: "@@required_fecha_f_revision@@",
            fecha_p_programa: "@@required_fecha_p_programa@@",
            fecha_cambio_costo_inscripcion: "@@required_fecha_cambio_costo_inscripcion@@"
        },
        submitHandler: function () {

        }
    });
}





