

function congresos_activos() {
    $('#congresos').html("");
    $.post("./includes/funciones.php?funcion=congresos_activos",{}, function (resp){
    $("#congresos").html(resp);  
//        alert(resp)
    });
    
}
function info_congreso (idcongreso){
//    alert("perra")
    $.post("./includes/funciones.php?funcion=info_congreso",{idcongreso:idcongreso},
    function(resp){
                         alert(resp)
      // console.log(resp);
       var datos = JSON.parse(resp);
//                           alert(datos.nombre_congreso)
        $("#nombre_congreso").val(datos.nombre_congreso).attr('readonly', true);
        $("#descripcion_congreso").val(datos.descripcion_congreso).attr('readonly', true);
        $("#siglas").val(datos.siglas).attr('readonly', true);
        $("#nombre_estado").val(datos.nombre_estado).attr('readonly', true);
        $("#pais").val(datos.pais).attr('readonly', true);
        $("#fecha").val(datos.fecha).attr('readonly', true);
        $("#nombre_estado").val(datos.nombre_estado).attr('readonly', true);
        $("#lugar").val(datos.lugar).attr('readonly', true);
        $("#idcongreso").val(idcongreso);
        $("#idusuario").val(datos.idusuario);
//        $("#").html(datos.);
//        $("#").html(datos.);

   
    })
}
