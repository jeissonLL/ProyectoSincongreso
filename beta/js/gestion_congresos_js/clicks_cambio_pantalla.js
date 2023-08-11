/*
 Alex Siboney Vargas Osorto
 27-2-2017
 alexv7142@gmail.com
 Manejo de menú traducciones (Matriz de Idiomas)
 */

//Matriz Idiomas

$("#asociar_administrador_congreso").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_congresos/asociar_administrador_congreso.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                setTimeout(function () {
                    $('#cargando').modal("hide");
                }, 1000);
            }, 1000);
        });
    });
});

$("#congresos_activos").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_congresos/form_congresos_activos.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                congresos_activos();
                setTimeout(function () {
                    $('#cargando').modal("hide");
                }, 1000);
            }, 1000);
        });
    });
});

$("#mis_congresos").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_congresos/mis_congresos.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                congresos_activos();
                setTimeout(function () {
                    $('#cargando').modal("hide");
                }, 1000);
            }, 1000);
        });
    });
});

$("#crear_congreso").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_congresos/crear_congreso.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                b_sm('agregar_roles_congreso');
                setTimeout(function () {
                    $('#cargando').modal("hide");
                    html_roles = $("#agregar_roles_congreso").html();
                }, 1000);
            }, 1000);
        });
    });
});

$("#gestionar_linea_investigacion").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_congresos/gestion_lineas_investigacion.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                congresos_activos();
                setTimeout(function () {
                    $('#cargando').modal("hide");
                }, 1000);
            }, 1000);
        });
    });
});

$("#gestionar_tematicas").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_congresos/gestion_tematicas_investigacion.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                congresos_activos();
                setTimeout(function () {
                    $('#cargando').modal("hide");
                }, 1000);
            }, 1000);
        });
    });
});

function retorno(resp) {
    $('#contenedor').empty();
    $('#contenedor').append(resp);
}



