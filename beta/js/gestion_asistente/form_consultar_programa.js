/* 
 * Crear formularios .
 * autor: brayan Triminio
 * 26/06/2017.
 */

//CONTRUCCION DEL FORMULARIO
function retorno(resp){ 
    $('#contenedor').html(resp);
}

$("#consultar_programa_congreso").click(function (){
   $.post("./form/gestion_asistente/form_consultar_programa.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_asis_programa');
    });   
});


$("#crear_itinerario").click(function (){
   $.post("./form/gestion_asistente/form_crear_itinerario.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_asis_c_itineraio');
    });   
});

$("#crear_itinerario_asistente").click(function(){
   var a = 0;
   var actividades = {};
    $('input[type=checkbox]').each(function () {
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            var select = (this.checked);
            if(select == true){
                actividades['idactividad'+a] =  $(this).attr("id");
                a++;
            }
        }
        
    });
    
    var acti = (JSON.stringify(actividades));
    if(a == 0){
        alert("Debe seleccionar al menos una actividad")
    }else{
        var caso = 'crear_itinerario';
        $.post("form/gestion_asistente/plantillas/funciones.php", {caso:caso,actividades:acti, numeroactividades:a}, function (resp) { 
        /*alert(resp)*/
            if((resp>0)){
            alert("El itinerario ha sido creado con éxito")
            b_func('tbl_asis_c_itineraio');
        }else{
            alert("Contacte al administrador del sistema")
        }

    });
    }
});

$("#modificar_itinerario").click(function(){
    $('#contenedor').html("");
    var funcion = 'tbl_asis_modifcar_itineraio';
    $.post("./includes/fnc_tbl.php", {funcion:funcion},function(resp){
        $('#contenedor').html("");
        /*alert(resp)*/
        if(resp == 0){
            $('#contenedor').html("");
            $.post("form/gestion_asistente/plantillas/funciones.php", {caso:'sin_itinerario'}, function (resp) { 
                retorno(resp);
            });
        }else{
            $.post("./form/gestion_asistente/form_modificar_itinerario.php", {}, function (resp) {     
            console.log(resp);
            $('#contenedor').html("");
            retorno(resp);
            b_func('tbl_asis_modifcar_itineraio');
            });   
            
        }
        
    });

});

$("#modificar_itinerario_asistente").click(function(){
    var a = 0 ;
    var actividades = ""
    $('input[type=checkbox]').each(function () {
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            var select = (this.checked);
            if(select == true){
                actividades =  actividades +","+ $(this).attr("id");
                a++;
            }
        }
        
    });
    
    var caso = 'modificar_itinerario';
        $.post("form/gestion_asistente/plantillas/funciones.php", {caso:caso,actividades:actividades, numeroactividades:a}, function (resp) { 
            if((resp==1)){
            alert("El itinerario ha sido modificado con éxito")
            b_func('tbl_asis_modifcar_itineraio');
        }else{
            alert("Contacte al administrador del sistema")
        }
    });
});

$("#eliminar_itinerario_asistente").click(function(){
    var caso = 'eliminar_itinerario';
        $.post("form/gestion_asistente/plantillas/funciones.php", {caso:caso}, function (resp) { 
            /*alert(resp)*/
        if((resp==1)){
            alert("El itinerario ha sido eliminado con éxito")
            $('#contenedor').html("");
            $.post("form/gestion_asistente/plantillas/funciones.php", {caso:'sin_itinerario'}, function (resp) { 
                $('#contenedor').append(resp);
            });
        }else{
            alert("Contacte al administrador del sistema")
        }
    });
});