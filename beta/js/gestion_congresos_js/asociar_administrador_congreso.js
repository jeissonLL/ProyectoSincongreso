function retorno(resp) {   
    $('#contenedor').html(resp);
}

//$("#asociar_administrador_congreso").click(function() {
//    $.post("form/gestion_congresos/asociar_administrador_congreso.php", {}, function (resp) {
//        $("#contenedor").html("");
//        retorno(resp);
//    });
//});

function quitar_administrador(tbody, tabla) {
    $(tbody).on("click", "button.quitar_administrador", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        console.log(data);
        $.ajax({
            cache: false,
            async:false,
            method:"POST",
            url:"./includes/querys.php?caso=quitar_administrador",
            data: {"id_congreso_pk":  $("#congresos").val(), "id_usuario_pk": data.id_usuario_pk},
            success: function(resp) {
                var respuesta = resp.split("<>");
                var parse_json = JSON.parse(respuesta[1]);
                var json = parse_json['data'][0];
                console.log(json);
                if(respuesta[0] == "1") {
                    tabla.row(tr).remove().draw();
                    swal(s_quitar_administrador, "", "success");
                    tabla.row.add(json).draw();
                }
                else {
                    if(respuesta == 0) {
                        modal();
                    }
                }
            }
        });
    });
}

function agregar_administrador(tbody, tabla) {
    $(tbody).on("click", "button.agregar_administrador", function () {
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        console.log(data);
        var tr = $(this).parents("tr");
        var data = tabla.row(tr).data();
        console.log(data);
        $.ajax({
            cache: false,
            async:false,
            method:"POST",
            url:"./includes/querys.php?caso=agregar_administrador",
            data: {"id_congreso_pk":  $("#congresos").val(), "id_usuario_pk": data.id_usuario_pk},
            success: function(resp) {
                var respuesta = resp.split("<>");
                var parse_json = JSON.parse(respuesta[1]);
                var json = parse_json['data'][0];
                console.log(json);
                if(respuesta[0] == "1") {
                    tabla.row(tr).remove().draw();
                    swal(s_agregar_administrador, "", "success");
                    tabla.row.add(json).draw();
                }
                else {
                    if(respuesta == 0) {
                        modal();
                    }
                }
            }
    });
});
}


