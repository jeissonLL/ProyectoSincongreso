function acceder_traduccion(tbody, tabla) {
    $(tbody).on("click", "button.acceder_traduccion", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var id = data.id_idioma_pk;
        console.log(data.nombre_idioma);
        $('#cargando').modal({show: true});
        setTimeout(function () {
            $.post("form/gestion_traducciones_php/traducir_idioma.php", {cache: false, async: false}, function (resp) {
                setTimeout(function () {
                    setTimeout(function() {
                        retorno(resp);
                        setTimeout(function() {cargar_tabla_traducciones(id);},500);
                    }, 1000);
                   
                    $("#titulo_idioma").html("<h4>" + data.nombre_idioma + "</h4>");
                    setTimeout(function () {
                        $('#cargando').modal("hide");
                    }, 2000);
                }, 1000);
            });
        },500);
        

    });
}

$("#regresar").click(function() {
    $('#contenedor').html("");
    $.post("form/gestion_traducciones_php/traducciones.php", {}, function (resp) {
       $("#contenedor").html("");
       $("#contenedor").html(resp);
    });
});
var veces = 0;
var id_global = 0;
var caso_global;

function traducir(id) {
    if ($("#caso_" + id).val() != "editar_traduccion_" + id && veces == 2) {
        veces = 0;
    }
    veces++;
    if ($("#caso_" + id).val() == "editar_traduccion_" + id) {
        document.getElementById("tex_traduccion_" + id).disabled = false;
        $("#enviar_" + id).text($("#traducir_" + id).val());
        if (id_global != id) { 
            document.getElementById("tex_traduccion_" + id_global).disabled = true;
            $("#enviar_" + id_global).text($("#editar_" + id_global).val());
            id_global = id;
            veces = 2;
        } else {
            veces = 4;
        }
    }
    if (veces == 4 || veces == 1) {
        if ($("#tex_traduccion_" + id).val() != "") {
            if (truckearcadena($("#tex_traduccion_" + id).val()) == truckearcadena($("#valor_" + id).val())) {
                $("#sin_enviar_datos").modal({show: true});
            } 
            else {
                $('#cargando').modal({show: true});
                setTimeout(function () {
                    $.ajax({
                        cache: false,
                        async: false,
                        method: "POST",
                        url: "./includes/querys.php?caso=traducir_idioma",
                        data: $("#form_traduccion_" + id).serialize(),
                        success: function (resp) {
                            if (resp == 1) {
                                setTimeout(function () {
                                    cargar_tabla_traducciones($("#idioma").val());
                                    setTimeout(function () {
                                        $("#cargando").modal("hide");
                                        swal(traduccion_correcta, "", "success");
                                    }, 2000);

                                }, 1000);
                            } else {
                                setTimeout(function () {
                                    $("#cargando").modal("hide");
                                    swal(error_envio);
                                }, 1000);
                            }
                        }
                    });
                }, 1000);
            }
        }
        veces = 0;
    }
}

function cargar_tabla_traducciones(idioma) {
    $.ajax({
        async: false,
        cache: false,
        method: "POST",
        url: "./includes/fnc_tbl.php",
        data: {"funcion": 'tbl_idiomas_traduccion', "id": idioma},
        success: function (resp) {
            $("tbody").html("");
            $("tbody").html(resp);
        }
    });
}

function bloqueo(id) {
    if(document.getElementById("tex_traduccion_"+id).disabled) {
        document.getElementById("tex_traduccion_"+id).disabled = false;
    }
}


$("#gtraductores").click(function () {
    $('#contenedor').html("");
    $.post("form/gestion_traducciones_php/gestion_traductores.php", {}, function (resp) {
       $("#contenedor").html("");
       alert(resp)
       retorno(resp);
    });
});

function truckearcadena(cadena) {
    alert("llegué");
    var cadenatruckeada = "";
    var arreglo = cadena.split(" ");
    for(i = 0; i < arreglo.length; i++) {
        arreglo[i].trim();
        if(arreglo[i] != "") {
            cadenatruckeada += arreglo[i].toLowerCase();
        }
    }
    alert(cadenatruckeada);
    return cadenatruckeada
}


