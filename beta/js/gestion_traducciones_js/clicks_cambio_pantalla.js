/*
 Alex Siboney Vargas Osorto
 27-2-2017
 alexv7142@gmail.com
 Manejo de menú traducciones (Matriz de Idiomas)
 */

//Matriz Idiomas
$("#matriz_idiomas").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_traducciones_php/matriz_idiomas.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                setTimeout(function () {
                    $('#cargando').modal("hide");
                }, 1000);
            }, 1000);
        });
    });
});
//Mensajería
$("#mensajeria").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_traducciones_php/mensajeria.php", {cache: false, async: false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
                incluirdiv('bandeja_mensajes');
                setTimeout(function () {
                    $('#cargando').modal("hide");
                }, 1000);
            }, 1000);
        });
    });
});
//Traducciones
$("#traducciones").click(function () {
    $('#cargando').modal({show: true});
    setTimeout(function () {
        $.post("form/gestion_traducciones_php/traducciones.php", {cache:false,async:false}, function (resp) {
            setTimeout(function () {
                retorno(resp);
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


