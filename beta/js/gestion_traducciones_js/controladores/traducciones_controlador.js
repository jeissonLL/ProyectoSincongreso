function acceder_traduccion(tbody, tabla) {
    $(tbody).on("click", "button.acceder_traduccion", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        var id = data.id_idioma_pk;
        console.log(data.nombre_idioma);
        $('#contenedor').html("");
        $.post("form/gestion_traducciones_php/traducir_idioma.php", {}, function (resp) {
            $("#contenedor").html("");
            retorno(resp);
            $("#titulo_idioma").html("<h4>"+data.nombre_idioma+"</h4>");
        });
        cargar_tabla_traducciones(id);

    });
}

$("#regresar").click(function() {
    $('#contenedor').html("");
    $.post("form/gestion_traducciones_php/traducciones.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
    });
});
var veces = 0;
var id_global = 0;
var caso_global;

function traducir(id) {
    if($("#caso_"+id).val() != "editar_traduccion_"+id && veces == 2) {
        veces = 0;
    }
    veces++; 
    if($("#caso_"+id).val() == "editar_traduccion_"+id) {
        document.getElementById("tex_traduccion_"+id).disabled = false;
        $("#enviar_"+id).text($("#traducir_"+id).val());
        if(id_global != id  ) {
            document.getElementById("tex_traduccion_"+id_global).disabled = true;
            $("#enviar_"+id_global).text($("#editar_"+id_global).val());
            id_global = id;
            veces = 2;
        }
        else {
            veces++;
        }
        
    }
    if(veces == 4 || veces == 1) {
        $.ajax({
            async: true,
            method: "POST",
            url: "./includes/querys.php?caso=traducir_idioma",
            data: $("#form_traduccion_"+id).serialize(),
            success: function(resp) {
                if(resp == 1) {
                    cargar_tabla_traducciones($("#idioma").val());
                    swal(traduccion_correcta, "", "success");
                }
                else {
                    swal(error_envio);
                }
                
            }
        });
         veces = 0;
    }
   
    
}

function cargar_tabla_traducciones(idioma) {
    $.ajax({
        async: true,
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


