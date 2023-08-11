/* 
 * Gestion de programa / espacios / actividades.
 * autor: @Obed
 * 06/07/2017.
 */

//CONTRUCCION DEL FORMULARIO
function retorno(resp){ 
    $('#contenedor').html("");
    $('#contenedor').html(resp);
}
//FUNCION PARA CARGAR EL FORMULARIO EN EL MENU PRINCIPAL (PAGINA DE INICIO)
$("#crear_espacio").click(function (){
   $.post("./form/gestion_programa/form_espacios.php", {}, function (resp) {     
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_espacios');
    });   
});

$("#crear_actividad").click(function (){
   $.post("./form/gestion_programa/form_actividades.php", {}, function (resp) {     
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_actividades');
    });   
});

$("#distribucion_trabajos_sp").click(function (){
   $.post("./form/gestion_programa/form_distribucion_trabajos.php", {}, function (resp) {     
       /*console.log(resp);*/
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_distribuciontematica');
    });   
});

$("#mover_trabajos_sp").click(function (){    
   $.post("./form/gestion_programa/form_mover_trabajos.php", {}, function (resp) {     
       /*console.log(resp);*/
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_movertrabajos_sp');
       
    });   
});

$("#emitir_programa").click(function (){    
   $.post("./form/gestion_programa/form_emitir_programa.php", {}, function (resp) { 
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_programa_creado');
       
    });   
});

function guardar_espacio(){
    var caso = $("#caso").val();
    $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: $('#form_espacios').serialize(),
           success: function (resp) {
            alert(resp);
            console.log(resp);
                 if(resp==1){                   
//                           //SUBIMOS mapa del espacio 
                       var formData = new FormData($("#form_espacios")[0]);
                       var ruta = "form/gestion_programa/plantillas/imagen-ajax-programa.php";
                       $.ajax({
                           url: ruta,
                           type: "POST",
                           data: formData,
                           contentType: false,
                           processData: false,
                           success: function(datos)
                           {
                                if(datos != 0){
                                    alert(datos);
                                    $.post("./form/gestion_programa/form_espacios.php", {}, function (resp) {     
                                        $('#contenedor').html("");
                                        retorno(resp);
                                        b_func('tbl_espacios');
                                     });   
                                }else{
                                    alert(resp);
                                }
                           }
                       });
//
//                      
//                          // FIN DE SUBIDA DE IMAGENES                   
                }else{
                    //alert('Ha ocurrido un error y no se pudo Guardar el espacio, por favor inténtelo nuevamente!');
                  alert(resp);
                }
           }
       });
}
/*función modificar espacios*/
function modificar_espacio(idespacio){    
    var caso = 'modificar_espacio';   
    if(idespacio != 0){
        $.post("./form/gestion_programa/plantillas/funciones.php", {caso:caso,idespacio:idespacio}, function (resp) {            
            var dataJson = JSON.parse(resp);
            $("#nombre_espacio").val(dataJson.nombre_espacio);
            $("#nombre_alternativo").val(dataJson.nombre_alternativo);
            $("#descripcion").val(dataJson.descripcion_espacio);
            $("#cant_personas").val(dataJson.capacidad_personas);
            $("#cant_tomas").val(dataJson.numero_tomacorriente);
            $("#mapa_espacio_preview").html("");
            $("#mapa_espacio_preview").html("<img style='border-radius: 20px 20px 20px 20px;-moz-border-radius: 20px 20px 20px 20px;-webkit-border-radius: 20px 20px 20px 20px;border: 4px; box-shadow: 0 0 3px 6px #fff, 0 0 25px;' src='form/gestion_programa/mapas_espacio/"+dataJson.mapa_espacio+"' width='100px' heght='80px'>");
            $("#comentarios_adicionales").val(dataJson.comentarios);
            $("#caso").val(caso);
            $("#idespacio").val(dataJson.id_espacio_pk);
        });
    }
      
}

/*función eliminar espacios*/
function eliminar_espacio(idespacio){
   var caso = 'eliminar_espacio';
   $("#caso").val(caso);
   $("#idespacio").val(idespacio);
   $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: $('#form_espacios').serialize(),
           success: function (resp) {
                if(resp != 0){
                    swal("¡Borrado!", "El Espacio ha sido eliminado Exitosamente.!!!.", "success");
                   // alert('Espacio eliminado exitosamente.!!!');
                    $.post("./form/gestion_programa/form_espacios.php", {}, function (resp) {     
                        $('#contenedor').html("");
                        retorno(resp);
                        b_func('tbl_espacios');
                     });   
                }else{
                    alert('Ha ocurrido un error y no se pudo Guardar el espacio, por favor inténtelo nuevamente!');
                }
           }
       });
   
}

/*función guarda nueva actividades*/
function guardar_actividad(){
     var caso = $("#caso").val();
     console.clear()
     $("#btn_guardar_actividad").prop('disabled', true);
    $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: $('#form_actividades').serialize(),
           success: function (resp) {
             alert(resp);
              console.log(resp);
             if(resp==1){            
                  
             alert('La actividad ha sido guardada exitosamente!');
             b_func('tbl_actividades');
             $("#form_actividades")[0].reset();
                }else{
              
                   
                   alert('Ha ocurrido un error y no se pudo guardar la actividad, por favor inténtelo nuevamente!');
                }
                $("#btn_guardar_actividad").prop('disabled', false);
           }
       });
}





/*función modificar actividades*/
function modificar_actividad(idactividad){    
    var caso = 'modificar_actividad';   
    if(idactividad != 0){
        $.post("./form/gestion_programa/plantillas/funciones.php", {caso:caso,idactividad:idactividad}, function (resp) {            
            var dataJson = JSON.parse(resp);
            $("#id").val(dataJson.id_actividad_pk);
            $("#nombre_actividad").html(dataJson.nombre_actividad);
            $("#responsable").val(dataJson.responsable);
            $("#fecha").val(dataJson.fecha_actividad);
            $("#hora_inicio").val(dataJson.hora_inicio);
            $("#hora_fin").val(dataJson.hora_final);
            $("#comentarios").html(dataJson.comentarios);
            $("#espacio_actividad").val(dataJson.id_espacio_pk);
            $("#tactividad").val(dataJson.id_tipo_actividad_fk);
            $("#tematicas_trabajo").val(dataJson.id_tematica_fk);  
            $("#caso").val(caso);  

        });
    }
      
}

/*función eliminar actividades*/
function eliminar_actividad(idactividad){
   var caso = 'eliminar_actividad';
   $("#caso").val(caso);
   $("#idactividad").val(idactividad);
   $.post("./includes/querys.php?caso="+caso, {idactividad:idactividad}, function (resp) {            
    if(resp != 0){
       // swal("¡Borrado!", "El Actividad ha sido eliminado Exitosamente.!!!.");
                        alert('Actividad eliminada exitosamente.!!!');
                        $.post("./form/gestion_programa/form_actividades.php", {}, function (resp) {     
                            $('#contenedor').html("");
                            retorno(resp);
                            b_func('tbl_actividades');
                         });   
                    }else{
                        alert('Ha ocurrido un error y no se ha eliminado la actividad, por favor inténtelo nuevamente!');
                    }
        });
}

/*distribucion de trabajos */

function buscatrab(idtematica){
    $("#cont_sesiones").css('display','none');
    var caso = 'divtrabajos_encontrados';//buscar los trabajos 
    $.ajax({
            url: "./form/gestion_programa/plantillas/funciones.php",
            type: "POST",
            data: {idtematica:idtematica, caso:caso},
            success: function (resp) {
                
                $("#"+caso).html("");
                $("#cant_trab").val(resp);
                $("#"+caso).html("<a><strong>"+resp+"</strong></a>");
                $("#4hora").prop("checked", false);
                $("#3hora").prop("checked", false);
                $("#2hora").prop("checked", false);
                $("#1hora").prop("checked", false);
                $("#btn_guardar_distribucion").attr('disabled',true);
            }
        });
}
function buscaactividad(idtematica){
    $("#cont_sesiones").css('display','none');
    var caso = 'divact_encontradas';//buscar los trabajos 
    $.ajax({
            url: "./form/gestion_programa/plantillas/funciones.php",
            type: "POST",
            data: {idtematica:idtematica, caso:caso},
            success: function (resp) {
               
                $("#"+caso).html("");
                $("#cant_act").val(resp);
                $("#"+caso).html("<a><strong>"+resp+"</strong></a>");
                $("#4hora").prop("checked", false);
                $("#3hora").prop("checked", false);
                $("#2hora").prop("checked", false);
                $("#1hora").prop("checked", false);
                $("#btn_guardar_distribucion").attr('disabled',true);
            }
        });
}

function distribucion_automatica(){   
    var caso = "distribucion_automatica_trabajos";
    var idtematica = $("#tematicas_trabajo").val();
    var cant_trab = $("#cant_trab").val();
    var cant_act = $("#cant_act").val();
        for(var i = 1; i <= 4; i++){
                $('#'+i+'hora:checked').each(function() {                       
                       $.ajax({
                            url: "./form/gestion_programa/plantillas/funciones.php",
                            type: "POST",
                            data: {cantidad:i, caso:caso, idtematica:idtematica, cant_trab:cant_trab, cant_act:cant_act},
                            success: function (resp) {
                                /*alert(resp);*/
                                console.log(resp);
                                if(resp != '1' && resp != '2' && resp != '3'){                                       
                                    $('#tbl_distribucion_trabajos').find('tbody').remove(); 
                                    $('#tbl_distribucion_trabajos').append(resp); 
                                    $("#btn_guardar_distribucion").attr('disabled',false);
                                }else if(resp == '2'){
                                    alert("Para realizar esta distribución deben haber igual número de trabajos como de sesiones.");
                                }else if(resp == '3'){
                                    alert("ERROR, No se puede proceder con la petición.");
                                }else{
                                    alert("Cantidad de trabajos insuficiente");
                                }
                            }
                        });
                });
            }
     
}

function guardar_distribucion(){
    var caso = $("#caso").val();
    $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: $('#form_distribucion_trabajos').serialize(),
           success: function (resp) {
             //  alert(resp);
                if(resp != 0){                   
                    alert('La distribución ha sido guardada exitosamente!');
                    $.post("./form/gestion_programa/form_distribucion_trabajos.php", {}, function (resp) { 
                        $('#contenedor').html("");
                        retorno(resp);
                     }); 
                     b_func('tbl_distribuciontematica');
                }else{
                    alert('Ha ocurrido un ERROR, por favor inténtelo nuevamente!');
                }
           }
       });
}

function guardartrabajomact(idtrab, val_slc){    
    var caso = $("#caso").val();  
    var id_act = $("#slc_actividades_creadas"+val_slc).val();
    if(id_act != 0){
       $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: {id_act:id_act, idtrab:idtrab},
           success: function (resp) {              
                if(resp != 0){                   
                    alert('El trabajo fue movido exitosamente!');
                    $.post("./form/gestion_programa/form_mover_trabajos.php", {}, function (resp) {     
                        /*console.log(resp);*/
                        $('#contenedor').html("");
                        retorno(resp);
                        b_func('tbl_movertrabajos_sp');
                    });  
                }else{
                    alert('Ha ocurrido un ERROR, por favor inténtelo nuevamente!');
                }
           }
       }); 
    }
    
       
}

function mostrartrab_en_act(idtem){
    var caso = "cambiartrabajos_de_actividadxtematica";
    $.ajax({
           url: "./form/gestion_programa/plantillas/funciones.php",
           type: "POST",
           data: {caso:caso,idtem:idtem},
           success: function (resp) {
                $('#tbl_movertrabajos_sp').find('tbody').remove();
                $('#tbl_movertrabajos_sp').append(resp); 
           }
       });
}


function guardar_asociar_act_programa(){
    var caso = $("#caso").val();  
    var nombre_programa = $("#nombre_programa").val();
    var descripcion_programa = $("#descripcion_programa").val();
    var estado_programa = $("#estado_programa").val();    
    
    $("#exportacion_programa").css("display", "none");
    
    var idprog = $("#idprog").val();
    if(nombre_programa != 0 && estado_programa != 0){
       $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: {nombre_programa:nombre_programa, descripcion_programa:descripcion_programa ,estado_programa:estado_programa, idprog:idprog},
           success: function (resp) {  
                if(resp != 0){                   
                    alert('Programa guardado exitosamente...!');
                     $.post("./form/gestion_programa/form_emitir_programa.php", {}, function (resp) { 
                        $('#contenedor').html("");
                        retorno(resp);
                        b_func('tbl_programa_creado');
                     });  
                }else{
                    alert('Ha ocurrido un ERROR, por favor inténtelo nuevamente!');
                }
           }
       }); 
    }
}

function modificar_programa(idprograma){
    var caso = "modificar_programa";
    $("#idprog").val(idprograma);
    $.ajax({
           url: "./form/gestion_programa/plantillas/funciones.php",
           type: "POST",
           data: {caso:caso,idprograma:idprograma},
           success: function (resp) {   
            alert(resp);            
                var dataJson = JSON.parse(resp);
                $("#nombre_programa").val(dataJson.nombre_programa0);
                $("#descripcion_programa").html(dataJson.descripcion0);
                $("#estado_programa option[value="+dataJson.estado_programa0+"]").prop('selected',true);
                $("#act_programa").removeAttr("style");
                $("#tbl_act_programa").find('tbody').remove();
                for (var j=0; j < dataJson.num_act ; j++ ){                   
                   $("#tbl_act_programa").append("<tr class='active'><td style='text-align: center;'><li><b>"+dataJson['nombre_actividad'+j]+"</b></li></td><td style='text-align: center;'><a href='#' class='on-default remove-row' onclick='eliminar_act_p("+dataJson['id_actividad_pk'+j]+", "+dataJson['id_programa_pk'+j]+");'><i class='fa fa-trash-o'></i></a></td></tr>"); 
                }
                $("#caso").val("modificar_programa");
                
           }
       });
}
/*eliminar actividades en modificar programa*/
function eliminar_act_p(idact, idprograma){   
    var caso = "eliminar_act_modificando_programa";
    if (confirm("¿Desea realmente eliminar esta actividad?")){
        $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: {idact:idact, idprograma:idprograma },
           success: function (resp) {  
//              alert(resp);
                if(resp != 0){                   
                    alert('Actividad eliminada exitosamente...!');
                    modificar_programa(idprograma);
                    b_func('tbl_programa_creado');
                }else{
                    alert('Ha ocurrido un ERROR, por favor inténtelo nuevamente!');
                }
           }
       }); 
    }
}

/*eliminar programa completo*/
function eliminar_programa(idprograma){
    var caso = "eliminar_programa";
    if (confirm("¿Desea realmente eliminar este Programa?")){
        $.ajax({
           url: "./includes/querys.php?caso="+caso,
           type: "POST",
           data: {idprograma:idprograma },
           success: function (resp) { 
                if(resp != 0){                   
                    alert('Programa eliminado exitosamente...!');
                    $.post("./form/gestion_programa/form_emitir_programa.php", {}, function (resp) { 
                        $('#contenedor').html("");
                        retorno(resp);
                        b_func('tbl_programa_creado');

                     });  
                }else{
                    alert('Ha ocurrido un ERROR, por favor inténtelo nuevamente!');
                }
           }
       }); 
    }
}

/*mostrar opciones de exportacion del programa seleccionado*/

function mostrar_opc_programa_s(idprograma){
     $("#idprog").val(idprograma);
     $("#exportacion_programa").removeAttr('style');
}