/* 
 * Crear formularios .
 * autor: brayan Triminio
 * 07/06/2017.
 */

//CONTRUCCION DEL FORMULARIO
function retorno(resp){ 
    $('#contenedor').html(resp);
}
//FUNCION PARA CARGAR EL FORMULARIO DE CERTIFICADOS EN EL MENU PRINCIPAL (PAGINA DE INICIO)
$("#gtrabajos_ep").click(function (){
    
   $.post("./form/gestion_editor_principal/gestion_trabajos_ep.php", {}, function (resp) {     
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_trabajos_ep');
       b_sm('origen_todos_revisores');
    });   
});
function muestra_tematica(){
    b_func('tematicas_trabajo');
    $("#trabajos_filtrados0").attr("style","display: none")
    $('#tematicas_filtradas0').html("");
    var $div = $('div[id^="temataticas"]:last');
     var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
     var $klon = $div.clone().prop('id', 'temataticas'+num );
     $klon.find("select").attr("onchange", "trabajosa_mostrar()");
     $klon.removeAttr("style");
     
     $('#tematicas_filtradas0').append($klon);
    
    var lineas = $("#lineas_investigacion").val();
    $("#linea_invest").val(lineas);
    var eliminar = $("#linea_invest").val();
    var tematicas = $('#tematicas_trabajo option') ;
    
    tematicas.each(function(){ 
    var variable =($(this).val());
   if(variable == eliminar ){
      // alert("si son iguales")
   }else{
     $('#tematicas_filtradas0').find('option[name="'+variable+'"]').remove().end();   
   }
    
    });
      
}

function trabajosa_mostrar(){
    var tematica = $("#tematicas_trabajo").val();
    //alert(tematica)
    $("#tematica").val(tematica);
    var contar = 0;
    var eliminar = $("#tematicas_trabajo").val(); 
    var numero = $('#tbl_trabajos_ep > tbody');
    var totaltrabos = 0 ;
    var trabajos1 = $('#trabajos1 table') ;
    
   $.each($('#tbl_trabajos_ep > tbody :input[type=hidden]'),function(){
     var valor = $(this).val();
     if (valor == eliminar){
         contar = contar + 1 ;
         var ocu = trabajos1.find('tr[name=tematica'+valor+']');
         totaltrabos++;
         if(ocu.css('display') == 'none')
        {
            ocu.removeAttr("style")
        }
     }else{
        trabajos1.find('tr[name=tematica'+valor+']').attr("style", "display:none");    
     }          
   });
    var tot = $("#totaltrab").val();
    if (tot == ""){
        
        var etiqueta = $("#numeros").find("strong").text();
        $("#totaltrab").val(etiqueta);
        var cadena = $("#totaltrab").val();   
        cadena = cadena.substring(0, cadena.length - 3);
        cadena +=totaltrabos;
    //alert(etiqueta)
    numero.find("strong").html("").append(cadena);  
    }else{
    var cadena = $("#totaltrab").val();   
    cadena = cadena.substring(0, cadena.length - 3);
    cadena +=totaltrabos;
    //alert(etiqueta)
    numero.find("strong").html("").append(cadena);  
    }
   
    
}

function asignarrevisores(){
    var revisore =$("#origen_todos_revisores").text();

    $("#revisor").html("");
    var $div = $('div[id^="usuariorolrevisor"]:last');
     var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
     var $klon = $div.clone().prop('id', 'usuariorolrevisor'+num );
     $klon.removeAttr("style");
     $klon.find("select").attr("id", "origen_todos_revisores1");
     $('#revisor').append($klon);
    
    
    console.log(arguments);
    var valores = (arguments); 
    var ids =(arguments.length-1); //ids de los usuarios revisores    
    var idtematica = valores[valores.length-1];
    $("#usuariorolrevisor").val(valores);
    //$('#origen_todos_revisores1').append('<option>HOLA</option>');
    for (var i=0; i<ids; i++){
        $("#trabajo_a_revisor").val(valores[0])
        //var trabajo = $("#trabajo_a_revisor").val();       
        if(valores[i] > 0 ){
            if(valores[i] != 9999){              
               $('#origen_todos_revisores1').find('option[value='+valores[i]+']').remove().end();   
            }
        }
    }
    
     $('#origen_todos_revisores1 option').each(function(){
        var valor =$(this).attr("name") ;
        
        if(valor == idtematica){
            $('#origen_todos_revisores1').append("<option label='Revisores de la temática del trabajo'></option>")
        }else{
            $('#origen_todos_revisores1').find('option[name='+valor+']').remove().end();   
        }
     });
     $('#asignar_revisores_trabajo').modal('toggle');    
}

function asignar_revisor_trabajo(){  
    var caso = $("#caso").val();
    var idtrabajo= $("#trabajo_a_revisor").val();
    var ids = '';
    $('#destino_revisores option:selected').each(function(){
    ids += $(this).val() + ","; 
    });
    
    if(ids.length <= 0 ){
        alert("Debe seleccionar al menos un revisor")
    }else{
        var fin = ids.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
        ids = ids.substr(0, fin); // elimino la coma final
        //alert(ids)
        $.post("./includes/querys.php?caso="+caso,{revisores:ids,idtrabajo:idtrabajo,},function(resp){
         console.log("HHHHHHHHHHH"+resp);
            if(isNaN(resp)){
                
            }else if(resp==1){
            alert("Se ha asigando con éxito el trabajo a los revisores  ")
            $('#asignar_revisores_trabajo').modal('toggle');
            $('#buscar').val("");
            //$("#lineas_investigacion").trigger("change");
            b_func('tbl_trabajos_ep');
            $('#destino_revisores').html("");
            
            $("#lineas_investigacion").trigger("change");
           
            }
        });
    }
    
}

function cancelarsolicitud(){
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
     //cloanr el slect
    
    
    var $div = $('div[id^="modal_revisores"]:last');
    var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
    var $klon = $div.clone().prop('id', 'modal_cancelar_revisores');
    //clonar el modal 
    
    $klon.find("div[id=revisor]").prop("id", "revisor"+num).html("").append($clon); 
    $klon.find("a[id=cancelar_asuignar_form_revisor]").prop("id", "cancelar_asuignar_form_revisor1").attr("onclick", "cancelar_revisor_trabajo1()");; 
    $klon.find("a[id=btn_asignar_revisor]").attr("onclick", "cancelar_solicitu_revisor()"); 
    //al modal clonado hacele el append del select clonado y se cambian los id de y funciones de los botones
    $klon.find("select[id=destino_revisores]").prop("id", "destino_revisores"+num);
    $('#cancelar_revisores_trabajo').append($klon);
    
    $('#origen_todos_revisores2 > option').each(function(){ //agregamos la funcion de movimiento para los revisores
    $(this).attr("onclick", "agregar2(this.value, this.id)");
    
    });
    
    var valores = (arguments);
    var ids =(arguments.length); //ids de los usuarios revisores
    $("#cancelar_a_revisor").val(valores[0]);
    for (var i=1; i<ids; i++){
        //var trabajo = $("#trabajo_a_revisor").val();
        if(valores[i] > 0 ){
            $.each($('#origen_todos_revisores2  option'),function(){
               var valor = $(this).val();
              if (valor ==valores[i] ){
               var id = $(this).attr("id");
               //               var id = $(this).attr("onclick").true;
               $('#origen_todos_revisores2').find('option[id='+id+']').prop('selected',true).trigger('click');
              }else{

              }
             });
            
        }
    }
    $('#origen_todos_revisores2').html("");
   
    $('#cancelar_revisores_trabajo').modal('toggle'); //abrimos el modal 
        

}

function cancelar_revisor_trabajo1(){
     $('#cancelar_revisores_trabajo').modal('toggle');
     b_sm('origen_todos_revisores');
     $('#destino_revisores2').find('option').remove().end();    
}

function cancelar_solicitu_revisor(){
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
            b_func('tbl_trabajos_ep');
            $('#destino_revisores2').html("");
            
            $("#lineas_investigacion").trigger("change");
           
            }
        });
    }
    
}

/*OBED 
 * 
 * INICIO
 * 
 * DICTAMINAR TRABAJO*/
$("#dictaminar_resultado_trabajos").click(function (){
    $.post("./form/gestion_editor_principal/form_dictaminar_trabajos_ep.php", {}, function (resp) {     
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_dictaminar_trabajos_ep');
    }); 
});
/*mostrar modal de info de trabajo*/
function inftrabajo(idt){
    $("#idt").val(idt);
    $("#caso").val('mostrarinfotrabajo');
   $.ajax({
        url: "form/gestion_editor_principal/plantillas/funciones.php",
        type: "POST",
        data: $('#form_dictaminar_trabajos').serialize(),
        success: function (resp) { 
            /*alert(resp);*/
            console.log(resp);
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
               // $("#estadtrab").text("  " + dataJson.estado + "  ");
                
                $('#modal-dialog-infot').removeAttr('style');
                $('#modal-dialog-infot').modal({
                     show: 'true'         
                }); 
        }
    });
}


function dictaminartrabajo(idtrabajo, idtem){
    $("#idt").val(idtrabajo);
    
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
                      /*alert(valores[i]);*/
                      var revisores = "" ;
                        var ponderacion = 0;
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
                                            if (isNaN(opnciones[a])){
                                                
                                            }else{
                                                ponderacion = ponderacion + parseFloat(opnciones[a]) ;
                                            }
                                        }
                                            elementos = elementos.substr(0, elementos.length-3 )
                                            $kloncuantitativo.append("<tbody><tr><td  style='font-weight:bold; text-align:jutify; font-size:11px;'>"+dataJson['nombre_pregunta_cuantitativa'+i].toUpperCase()+"?</td><td>"+elementos.toUpperCase()+"</td><tr><tbody>");
                                    }
                                    var nota = ((ponderacion / (parseInt(dataJson.numcuanti))) )
                                    revisores = revisores + "<li><p style='font-weight: bold;text-indent: 1cm; '> "+ "Observación del revisor " +dataJson['observaciones']+  "</p></li>";
                                    $("#obs").html(revisores);
                                    $("#pond").html("<p style='font-weight: bold;text-indent: 1cm; '> "+ "Ponderación de los revisores " + nota + "</p>");
                                    $("#ttrabd").html("  " +  $("#titulo"+idtrabajo).val().toUpperCase() + " ");
                                    $('#numero_cuanti').append($kloncuantitativo);
                                    for (var i=0; i<dataJson.numcuali; i++){
                                            $kloncualitativo.append("<tr><td  style='font-weight:bold; text-align:jutify; font-size:11px;'>"+dataJson['nombre_pregunta_cualitativa'+i].toUpperCase()+"?</td><td>"+dataJson['respuesta_cualitativa'+i].toUpperCase()+"</td><tr>");
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
$("#btn_guardar").click(function(){
    var caso = 'dictaminar_trabajo' ;
    var idtrabajo = $("#idt").val();
    var nombre = $("#titulo"+idtrabajo).val();
    var tipo = $("#tipo"+idtrabajo).val();
    var ubicacion = $("#ubicacion"+idtrabajo).val();
    var dicatamen = $("#tipo_dictamen").val();
    if(dicatamen == 0){
        alert("Debe seleccionar una decisión")
    }else{
        $.post("./includes/querys.php?caso="+caso, {idt:idtrabajo,dictamen:dicatamen, nombre:nombre, tipo:tipo, ubicacion:ubicacion}, function(resp){
            /*alert(resp)*/
            if(resp == 1){
                alert("El dictamen se ha realizado con éxito")
                b_func('tbl_dictaminar_trabajos_ep');
                $('#modal-dialog-dictaminat').modal('toggle');
            }
        });
    }
});
/*
function dictaminartrabajo(idt, idtem){
    $("#idt").val(idt);
    $("#idtem").val(idtem);
    $("#caso").val('dictaminartrabinvest');
    $.ajax({
        url: "form/gestion_editor_principal/plantillas/funciones.php",
        type: "POST",
        data: $('#form_dictaminar_trabajos').serialize(),
        success: function (resp) { 
            //alert(resp);
            console.log(resp);
            var dataJson = JSON.parse(resp);
                //$("#idtrabd").text("  " + dataJson.id_trabajo_pk + "  ");
                //$("#ttrabd").text("  " + dataJson.titulo_trabajo.toUpperCase() + "  ");
                var numerorevisores = dataJson.nummeroreviso ;
                var preguntascuantitativas = dataJson.numcuanti;
                var ciclos =(preguntascuantitativas/numerorevisores)
                $('#numero_tablas').html("");
                var siguiente = 0
                preguntas cuantitativas
                for(var i=0; i<numerorevisores; i++){
                    var cantidad = dataJson["cuantitativas"+i];
                    var $tabla = $('table[id^="pcuanti"]:last');
                    var num = parseInt( $tabla.prop("id").match(/\d+/g), 10 ) +1;
                    var $kloncuantitativo = $tabla.clone().prop('id', 'pcuanti'+num );
                    $kloncuantitativo.removeAttr("style");
                    if(num % 2 == 0) {
                        if( siguiente == 0){
                        $kloncuantitativo.find('tbody').remove(); 
                        $kloncuantitativo.attr("style" ,"float: left; width: 49%;");
                            for(var siguiente; siguiente<ciclos; siguiente++){
                                var opcion = dataJson['respuesta_cuantitativa'+siguiente] ;
                                var opnciones = opcion.split("<>")
                                var elementos = "" ;
                                for(var a=0;a<opnciones.length;a++){
                                 elementos +=  opnciones[a] +"-->"
                                }
                                elementos = elementos.substr(3, elementos.length-6 )
                                $kloncuantitativo.append("<tbody><tr><td style='font-weight:bold; text-align:right; font-size:12px;'>¿ "+dataJson['nombre_pregunta_cuantitativa'+siguiente].toUpperCase()+" ?</td><td style='font-weight:bold; text-align:left; font-size:10px;'> "+elementos.toUpperCase()+"</td><tr></tbody>")
                            }
                        siguiente = siguiente; 
                        }else{
                            $kloncuantitativo.find('tbody').remove(); 
                            $kloncuantitativo.attr("style" ,"float: left; width: 49%;")
                            
                                for(var siguiente; siguiente<ciclos+cantidad+cantidad; siguiente++){
                                    var opcion = dataJson['respuesta_cuantitativa'+siguiente] ;
                                    var opnciones = opcion.split("<>")
                                    var elementos = "" ;
                                    for(var a=0;a<opnciones.length;a++){
                                        elementos +=  opnciones[a] +"-->"
                                    }
                                    elementos = elementos.substr(3, elementos.length-6 )
                                    $kloncuantitativo.append("<tbody><tr><td style='font-weight:bold; text-align:right; font-size:12px;'>¿ "+dataJson['nombre_pregunta_cuantitativa'+siguiente].toUpperCase()+" ?</td><td style='font-weight:bold; text-align:left; font-size:10px;'> "+elementos.toUpperCase()+"</td><tr></tbody>")
                                }
                            siguiente = siguiente; 
                        }
                    }else{
                        $kloncuantitativo.find('tbody').remove(); 
                        $kloncuantitativo.attr("style" ,"float: right; width: 49%;");
                            for(siguiente; siguiente<ciclos+cantidad; siguiente++){
                                 var opcion = dataJson['respuesta_cuantitativa'+siguiente] ;
                                    var opnciones = opcion.split("<>")
                                    var elementos = "" ;
                                    for(var a=0;a<opnciones.length;a++){
                                        elementos +=  opnciones[a] +"-->"
                                    }
                                    elementos = elementos.substr(3, elementos.length-6 )
                                $kloncuantitativo.append("<tbody><tr><td style='font-weight:bold; text-align:right; font-size:12px;'>¿ "+dataJson['nombre_pregunta_cuantitativa'+siguiente].toUpperCase()+" ?</td><td style='font-weight:bold; text-align:left; font-size:10px;'> "+elementos.toUpperCase()+"</td><tr></tbody>")
                            }
                         siguiente = siguiente; 
                    }
                    $('#numero_cuanti').append($kloncuantitativo);
                }
                /*preguntas cualitativas
                
                
                for(var i=0; i<numerorevisores; i++){
                    var cantidad = dataJson["caulitativas0"+i];
                    var $tabla = $('table[id^="pcuali"]:last');
                    var num = parseInt( $tabla.prop("id").match(/\d+/g), 10 ) +1;
                    var $kloncualitativo = $tabla.clone().prop('id', 'pcuanti'+num );
                    $kloncuantitativo.removeAttr("style");
                    if(num % 2 == 0) {
                        if( siguiente == 0){
                        $kloncuantitativo.find('tbody').remove(); 
                        $kloncuantitativo.attr("style" ,"float: left; width: 49%;");
                            for(var siguiente; siguiente<ciclos; siguiente++){
                                var opcion =  ;
                                
                                elementos = elementos.substr(3, elementos.length-6 )
                                $kloncuantitativo.append("<tbody><tr><td style='font-weight:bold; text-align:right; font-size:12px;'>¿ "+dataJson['nombre_pregunta_cuantitativa'+siguiente].toUpperCase()+" ?</td><td style='font-weight:bold; text-align:left; font-size:10px;'> "+elementos.toUpperCase()+"</td><tr></tbody>")
                            }
                        siguiente = siguiente; 
                        }else{
                            $kloncuantitativo.find('tbody').remove(); 
                            $kloncuantitativo.attr("style" ,"float: left; width: 49%;")
                            
                                for(var siguiente; siguiente<ciclos+cantidad+cantidad; siguiente++){
                                    var opcion = dataJson['respuesta_cuantitativa'+siguiente] ;
                                    var opnciones = opcion.split("<>")
                                    var elementos = "" ;
                                    for(var a=0;a<opnciones.length;a++){
                                        elementos +=  opnciones[a] +"-->"
                                    }
                                    elementos = elementos.substr(3, elementos.length-6 )
                                    $kloncuantitativo.append("<tbody><tr><td style='font-weight:bold; text-align:right; font-size:12px;'>¿ "+dataJson['nombre_pregunta_cuantitativa'+siguiente].toUpperCase()+" ?</td><td style='font-weight:bold; text-align:left; font-size:10px;'> "+elementos.toUpperCase()+"</td><tr></tbody>")
                                }
                            siguiente = siguiente; 
                        }
                    }else{
                        $kloncuantitativo.find('tbody').remove(); 
                        $kloncuantitativo.attr("style" ,"float: right; width: 49%;");
                            for(siguiente; siguiente<ciclos+cantidad; siguiente++){
                                 var opcion = dataJson['respuesta_cuantitativa'+siguiente] ;
                                    var opnciones = opcion.split("<>")
                                    var elementos = "" ;
                                    for(var a=0;a<opnciones.length;a++){
                                        elementos +=  opnciones[a] +"-->"
                                    }
                                    elementos = elementos.substr(3, elementos.length-6 )
                                $kloncuantitativo.append("<tbody><tr><td style='font-weight:bold; text-align:right; font-size:12px;'>¿ "+dataJson['nombre_pregunta_cuantitativa'+siguiente].toUpperCase()+" ?</td><td style='font-weight:bold; text-align:left; font-size:10px;'> "+elementos.toUpperCase()+"</td><tr></tbody>")
                            }
                         siguiente = siguiente; 
                    }
                    $('#numero_cuanti').append($kloncuantitativo);
                }
                
                
                
                
                
                
                $("#pcuali").find('tbody').remove();
                for (var i=0; i<dataJson.numcuali; i++){
                        $("#pcuali").append("<tbody><tr><td  style='font-weight:bold; text-align:right; font-size:12px;'>"+dataJson['nombre_pregunta_cualitativa'+i].toUpperCase()+"?</td><td>"+dataJson['respuesta_cualitativa'+i].toUpperCase()+"</td><tr></tbody>");
                }
                    $('#modal-dialog-dictaminat').removeAttr('style');
                    $('#modal-dialog-dictaminat').modal({
                         show: 'true'         
                    }); 

        }
    });
    
}
/*OBED 
 * 
 * FINAL
 * 
 * DICTAMINAR TRABAJO*/
