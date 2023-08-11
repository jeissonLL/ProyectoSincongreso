/* 
 * Brayan Triminio
 * Gestion de los usuarios con el rol editor pricipal de seccion  
 * 04/07/2017
 */

$("#gtrabajos_eps").click(function (){
    
   $.post("./form/gestion_editor_principal_seccion/gestion_trabajos_eps.php", {}, function (resp) {     

       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_trabajos_epseccion');
       b_sm('origen_todos_revisores');
      
    });   
});


function modaleps(){
    var revisore =$("#origen_todos_revisores").text();
    
    $("#revisor").html("");
    var $div = $('div[id^="usuariorolrevisor"]:last');
     var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
     var $klon = $div.clone().prop('id', 'usuariorolrevisor'+num );
     $klon.removeAttr("style");
     $klon.find("select").attr("id", "origen_todos_revisores1");
     $('#revisor').append($klon);
    
    console.log(revisore);
    console.log(arguments);
    var valores = (arguments);
    var ids =(arguments.length); /*ids de los usuarios revisores*/
    var idtematica = valores[valores.length-1];
    $("#usuariorolrevisor").val(valores)
    for (var i=0; i<ids; i++){
        $("#trabajo_a_revisor").val(valores[0])
        /*var trabajo = $("#trabajo_a_revisor").val();*/
        if(valores[i] > 0 ){
            if(valores[i] == 9999){
            }else{
                $('#origen_todos_revisores1').find('option[value='+valores[i]+']').attr("style", "display:none");   
            }
        }
    }
     $('#origen_todos_revisores1 option').each(function(){
        var valor =$(this).attr("name") ;
        
        if(valor == idtematica){
            $('#origen_todos_revisores1').append("<OPTGROUP label='Revisores de la temática del trabajo'></OPTGROUP>")
        }else{
            $('#origen_todos_revisores1').find('option[name='+valor+']').remove().end();   
        }
     });
     $('#asignar_revisores_trabajo').modal('toggle');    
}

$("#btn_asignar_revisoreps").click(function (){
  var caso = $("#caso").val();
    var idtrabajo= $("#trabajo_a_revisor").val();
    var ids = '';
    $('#destino_revisores option:selected').each(function(){
    ids += $(this).val() + ","; 
    });
    
    if(ids.length <= 0 ){
        alert("Debe seleccionar al menos un revisor")
    }else{
        var fin = ids.length - 1; /* calculo cantidad de caracteres menos 1 para eliminar la coma final*/
        ids = ids.substr(0, fin); /*- elimino la coma final*/
        /*alert(ids)*/
        $.post("./includes/querys.php?caso="+caso,{revisores:ids,idtrabajo:idtrabajo,},function(resp){
          /*alert(resp)*/
            if(isNaN(resp)){
                
            }else{
            alert("Se ha asigando con éxito el trabajo a los revisores  ")
            $('#asignar_revisores_trabajo').modal('toggle');
            $('#buscar').val("");
            /*$("#lineas_investigacion").trigger("change");*/
            b_func('tbl_trabajos_epseccion');
            $('#destino_revisores').html("");
            }
        });
    }
   
});


function modalcancelarsolicitud(){
    /*
     * 
     * Funcion para cancelar la solicitud al revisor de un determinado trabajo
     * primero se clona el select donde se encuentran todos los revisores para su filtracion 
     * posteriormente se clona el modal y al modal clonado se le cambia los ids para diferenciarlos 
     * 
     */
    $('#cancelar_revisores_trabajo').html("");
    
    $("#revisor2").html("");
    var $select = $('div[id^="usuariorolrevisor"]:last');
     var num = parseInt( $select.prop("id").match(/\d+/g), 10 ) +1;
     var $clon = $select.clone().prop('id', 'usuariorolrevisor'+num );
     $clon.removeAttr("style");
     $clon.find("select").attr("id", "origen_todos_revisores2");
     /*cloanr el slect*/
    
    
    var $div = $('div[id^="modal_revisores"]:last');
    var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
    var $klon = $div.clone().prop('id', 'modal_cancelar_revisores');
    /*clonar el modal */
    
    $klon.find("div[id=revisor]").prop("id", "revisor"+num).html("").append($clon); 
    $klon.find("a[id=cancelar_asuignar_form_revisor]").prop("id", "cancelar_asuignar_form_revisor1").attr("onclick", "cancelar_revisor_trabajo1()");
    $klon.find("a[id=btn_asignar_revisoreps]").prop("id", "btn_cancelar_revisoreps").attr("onclick", "cancelar_solicitud_revisor()"); 
    /*-al modal clonado hacele el append del select clonado y se cambian los id de y funciones de los botones cancelar_solicitud_revisor*/
    $klon.find("select[id=destino_revisores]").prop("id", "destino_revisores"+num);
    $('#cancelar_revisores_trabajo').append($klon);
    
    $('#origen_todos_revisores2 > option').each(function(){ /*agregamos la funcion de movimiento para los revisores*/
    $(this).attr("onclick", "agregar2(this.value, this.id)");
    
    });
    
    var valores = (arguments);
    var ids =(arguments.length); /*ids de los usuarios revisores*/
    $("#cancelar_a_revisor").val(valores[0]);
    for (var i=1; i<ids; i++){
        /*var trabajo = $("#trabajo_a_revisor").val*/
        if(valores[i] > 0 ){
            $.each($('#origen_todos_revisores2  option'),function(){
               var valor = $(this).val();
              if (valor ==valores[i] ){
               var id = $(this).attr("id");
               /*               var id = $(this).attr("onclick").true;*/
               $('#origen_todos_revisores2').find('option[id='+id+']').prop('selected',true).trigger('click');
              }else{

              }
             });
        }
    }
    $('#origen_todos_revisores2').html("");
    $('#cancelar_revisores_trabajo').modal('toggle'); /*abrimos el modal */
}

function cancelar_solicitud_revisor(){
    var idtrabajo = $("#cancelar_a_revisor").val();
    var caso  = $("#caso1").val();
    var ids= "";
    $('#destino_revisores2 option').each(function(){
    ids += $(this).val() + ","; 
    });
    
    if(ids.length <= 0 ){
        alert("Debe seleccionar al menos un revisor")
    }else{
        var fin = ids.length - 1; /* calculo cantidad de caracteres menos 1 para eliminar la coma final*/
        ids = ids.substr(0, fin); /* elimino la coma final*/
        
        $.post("./includes/querys.php?caso="+caso,{idusuario:ids,idtrabajo:idtrabajo},function(resp){
           
            if(isNaN(resp)){
                
            }else{
            alert("Se ha cancelado con éxito el trabajo a los revisores  ")
            $('#cancelar_revisores_trabajo').modal('toggle');
            $('#buscar').val("");
            /*$("#lineas_investigacion").trigger("change");*/
            b_func('tbl_trabajos_epseccion');
            $('#destino_revisores2').html("");
            }
        });
    }
    
}

function modal_ess(idtrabajo, idtematica){
    var funcion = 'origen_editores' ;
    $("#destino_editoes_ss").html('');
    $.post("./includes/fnc_select_multiple.php", {funcion:funcion, idtematica:idtematica},function(resp){dibuja_select(resp,funcion);})
    
    function dibuja_select(html, funcion)
    {
    if (html == ''){
        $('#'+funcion).html('origen_editores');
        $('#'+funcion).append('<optgroup label="No hay editores de para esta tematica ">    </optgroup> ');     
    }else{
    $('#'+funcion).find('option').remove();
    $('#'+funcion).append(html);     
    }
     
    }

    $('#asignar_editores_ss').modal('toggle');
    $('#idtrabajo').val(idtrabajo);
}

$('#btn_asignar_editoresss').click(function (){
    var caso2 = $("#caso2").val();
    var idtrabajo = $('#idtrabajo').val();
    var ids = '' ;
    
    $('#destino_editoes_ss option').each(function(){
    ids += $(this).val() + ","; 
    });
    
    var fin = ids.length - 1; /* calculo cantidad de caracteres menos 1 para eliminar la coma final*/
    ids = ids.substr(0, fin); /*- elimino la coma final*/
    if(ids == ''){
        alert('Debe seleccionar al menos un editor secundario ')
    }else{
      $.post("./includes/querys.php?caso="+caso2,{idusuario:ids,idtrabajo:idtrabajo},function(resp){
          /*alert(resp)*/
            if((resp==1)){
                alert('Se ha asignado el trabajo al editor secundario con éxito')
                b_func('tbl_trabajos_epseccion');
                $('#asignar_editores_ss').modal('toggle');
            }else{
                alert('En estos momentos estamos presentado problemas, contacte al administrador')
            }
        });  
    }
   
});

/*Dictaminar trabajo Editor secundario de seccion*/

$("#dictaminar_resultado_eps").click( function (){
    $.post("./form/gestion_editor_principal_seccion/form_dictaminar_trabajos_eps.php", {}, function (resp) {     
       
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_dictaminar_trabajos_eps');
    }); 
});

function inftrabajo_eps(idt){
    $("#idt").val(idt);
    $("#caso").val('mostrarinfotrabajo');
    $.ajax({
        url: "form/gestion_editor_principal/plantillas/funciones.php",
        type: "POST",
        data: $('#form_dictaminar_trabajos_eps').serialize(),
        success: function (resp) { 
           /* alert(resp)*/
           
            var dataJson = JSON.parse(resp);
                $("#idtrab").text("  " + dataJson.id_trabajo_pk + "  ");
                $("#ttrab").text("  " + dataJson.titulo_trabajo.toUpperCase() + "  ");
                $("#palabrastrab").html("");
                var data = dataJson.palabras_clave;
                var myarr = data.split(",");               
                for(var i = 0; i < myarr.length; i++){
                    $("#palabrastrab").append("<li>"+myarr[i]+"</li>").text();
                }
                $("#tematrab").text("  " + dataJson.nombre_tematica.toUpperCase() + "  ");
                $("#resutrab").text("  " + dataJson.resumen + "  ");
                $("#fechtrab").text("  " + dataJson.fecha_subida + "  ");
                $("#urlmodalinfo").html("<a class='on-default edit-row' download="+dataJson.ubicacion_archivo+"  href='form/gestion_trabajos/trabajos/congreso"+dataJson.idcongreso+"/tipotrabajo"+dataJson.tipo_trabajo+"/"+dataJson.ubicacion_archivo+"' ><i class='glyphicon glyphicon-download-alt'></i></a>");/*URL*/
                $('#modal-dialog-infot').removeAttr('style');
                $('#modal-dialog-infot').modal({
                     show: 'true'         
                }); 
        }
    });
}
function dictaminartrabajo_eps(idtrabajo, idtem){
    $("#idt").val(idtrabajo);
    $("#ttrabd").text("  " +  $("#titulo"+idtrabajo).val().toUpperCase() + "  ");
    $('#numero_cuanti').html("");  
    $('#numero_cuali').html("");  
    var caso = 'revisoresxtrabajo';
    $.post("form/gestion_editor_principal/plantillas/funciones.php", {caso:caso,idtrabajo:idtrabajo}, function (resp) {
                  if(resp ==""){
                      $('#numero_cuanti').append("<p style='font-weight:bold; text-align:jutify; font-size:12px;'> ESTE TRABAJO NO TIENE REVISORES ASIGNADOS </p>" );  
                      $('#numero_cuali').append("<p style='font-weight:bold; text-align:jutify; font-size:12px;'> ESTE TRABAJO NO TIENE REVISORES ASIGNADOS </p>" );  
                       $('#modal-dialog-dictaminat').removeAttr('style');
                       $('#modal-dialog-dictaminat').modal({
                         show: 'true'         
                    }); 
                  }else{ 
                  var valores = resp.split("<>");
                  $('#numero_cuanti').html("");  
                  $('#numero_cuali').html("");  
                   for(var i=0; i<valores.length-1 ; i++){
                       var caso1= 'preguntasyrespuestas';
                      // alert(valores[i]);
                            $.post("form/gestion_editor_principal/plantillas/funciones.php", {caso:caso1,idt:idtrabajo,idrevisor:valores[i],idtem:idtem}, function (resp) {
                                
                                var dataJson = JSON.parse(resp);
                                /*cuantitativas */
                                var $tabla = $('table[id^="pcuanti"]:last');
                                var num = parseInt( $tabla.prop("id").match(/\d+/g), 10 ) +1;
                                var $kloncuantitativo = $tabla.clone().prop('id', 'pcuanti'+num );
                                $kloncuantitativo.removeAttr("style");
                                
                                $kloncuantitativo.find('tbody').remove();
                                
                                /*Cualitativas */
                                var $tabla1 = $('table[id^="pcuali"]:last');
                                var num = parseInt( $tabla1.prop("id").match(/\d+/g), 10 ) +1;
                                var $kloncualitativo = $tabla1.clone().prop('id', 'pcuali'+num );
                                $kloncualitativo.removeAttr("style");
                                
                                $kloncualitativo.find('tbody').remove();
                                 
                                if(num%2 == 0) { 
                                $kloncuantitativo.attr("style" ,"float: left; width: 49%;");
                                $kloncualitativo.attr("style" ,"float: left; width: 49%;");
                                }else{
                                $kloncuantitativo.attr("style" ,"float: right; width: 49%;");
                                $kloncualitativo.attr("style" ,"float: right; width: 49%;"); 
                                }
                                    for (var i=0; i<dataJson.numcuanti; i++){
                                      var opcionpeso =  dataJson['respuesta_cuantitativa'+i];
                                      var opnciones = opcionpeso.split("<>")
                                      var elementos = "" ;
                                        for(var a=0;a<opnciones.length;a++){
                                            elementos +=  opnciones[a] +"-->"
                                        }
                                            elementos = elementos.substr(0, elementos.length-3 )
                                            $kloncuantitativo.append("<tbody><tr><td  style='font-weight:bold; text-align:jutify; font-size:11px;'>"+dataJson['nombre_pregunta_cuantitativa'+i].toUpperCase()+"?</td><td>"+elementos.toUpperCase()+"</td><tr><tbody>");
                                    }
                                    $('#numero_cuanti').append($kloncuantitativo);
                                    for (var i=0; i<dataJson.numcuali; i++){
                                            $kloncualitativo.append("<tbody><tr><td  style='font-weight:bold; text-align:jutify; font-size:11px;'>"+dataJson['nombre_pregunta_cualitativa'+i].toUpperCase()+"?</td><td>"+dataJson['respuesta_cualitativa'+i].toUpperCase()+"</td><tr><tbody>");
                                    }
                                    $('#numero_cuali').append($kloncualitativo);
                            });
                   }
                    $('#modal-dialog-dictaminat').removeAttr('style');
                    $('#modal-dialog-dictaminat').modal({
                         show: 'true'         
                    }); 
                }
            });   
            
}

$("#btn_dictaminar_eps").click( function (){
    var caso = 'dictaminar_trabajo' ;
    var idtrabajo = $("#idt").val();
    var nombre    = $("#titulo"+idtrabajo).val();
    var tipo      = $("#tipo"+idtrabajo).val();
    var ubicacion = $("#ubicacion"+idtrabajo).val();
    var dicatamen = $("#tipo_dictamen").val();
    if(dicatamen == 0){
        alert("Debe seleccionar una decisión")
    }else{
        $.post("./includes/querys.php?caso="+caso, {idt:idtrabajo,dictamen:dicatamen, nombre:nombre, tipo:tipo, ubicacion:ubicacion}, function(resp){
            /*alert(resp)*/
            if(resp == 1){
                alert("El dictamen se ha realizado con éxito")
                b_func('tbl_dictaminar_trabajos_eps');
                $('#modal-dialog-dictaminat').modal('toggle');
            }
        });
    }
});