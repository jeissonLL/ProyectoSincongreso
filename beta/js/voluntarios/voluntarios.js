/* 
 * Brayan Triminio 
 * 28/08/17
 * Gestión de los voluntarios 
 */

function retorno(resp) {  
    $('#contenedor').html("");
    $('#contenedor').html(resp);
}

$("#actividades_voluntario").click( function(){
    $('#contenedor').html("");
    $.post("form/voluntarios/form_actividades_asignadas.php", {}, function (resp) {
       // alert(resp);
       $("#contenedor").html("");
       retorno(resp);
        b_func('tbl_act_asignada_voluntarios');
       
    });
});

function info_tarea_voluntario(idactividad){
    var caso = "info_actividad" ;
    
    
    $.get("form/voluntarios/plantillas/funciones.php",{caso:caso, idactividad:idactividad},function(resp){
       // alert(resp);
        var dataJson = JSON.parse(resp);
        $("#ntarea").text("  " + dataJson.nombre_tarea.toUpperCase() + "  ");
        $("#desc_tarea_vol").text("  " + dataJson.descripcion.toUpperCase() + "  ");
        $("#horas_vol_sumar").text("  " + dataJson.hora_tarea.toUpperCase() + "  ");
        $("#persona_apoyo").text("  " + dataJson.persona_apoyo.toUpperCase() + "  ");
        if(dataJson.archivo_complementario == ""){
            $("#doc_vol_comple").text("Sin documento complementario");
        }else{
            $("#doc_vol_comple").html("<a class='on-default edit-row' download="+dataJson.archivo_complementario+"  href='form/gestion_voluntario/archivos1/"+dataJson.archivo_complementario+"' ><i class='md-file-download'></i></a>");/*URL*/
        }
        
    });
    
    $('#modal_info_actividad_voluntario').modal({
                     show: 'true'         
                }); 
    
}

/********************************************************************************************************/
/****************************Mensajes a Voluntarios********************************************/
/********************************************************************************************************/

$("#mensajes_voluntario").click(function (){
    $('#contenedor').html("");
    $.post("form/gestion_voluntario/form_mensajes_voluntarios.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
       incluirdiv('bandeja_mensajes_voluntario');
    });
});

/****************************************************************************************************************************************************************/
/*********************************************Asistencia Personas************************************************************************************************/
/****************************************************************************************************************************************************************/

$("#asistencia_voluntario").click(function (){
    $('#contenedor').html("");
    $.post("form/voluntarios/form_asistencia_persona.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
        b_func("tbl_asis_persona");
    });
});

function info_persona_itinerario(idpersona, idusuario){
    $("#persona").val(idpersona);
    $("#usuario").val(idusuario);
    var funcion="tbl_itinerario_persona";
    $.post("./includes/fnc_tbl.php", {funcion:funcion, idpersona:idpersona},function(resp){dibuja_tbl(resp,funcion);})
    $('#asistencia_pesona').modal({
        show: 'true'         
    }); 

}


function dibuja_tbl(html, funcion){
    $('#'+funcion).find('tbody').remove();
    $('#'+funcion).append(html); 
}
   


$("#btn_cancelar_asistencia_persona").click(function(){
    $("#asistencia_pesona").modal('toggle');
});

$("#btn_guardar_asistencia_persona").click(function(){
    var actividades = '' ;
    
    $("#tbl_itinerario_persona input[type=checkbox]").each(function (){
         var select = (this.checked);
            if(select == true){
                actividades += $(this).val() + "," ;
            }
    });
    
    var fin = actividades.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
    actividades = actividades.substr(0, fin); // elimino la coma final
    
    if(actividades == ""){
        alert("Debe seleccionar al menos una actividad")
    }else{
        var caso = 'validar_asistencia_persona';
        var idusuario = $("#usuario").val();
        $.get("form/voluntarios/plantillas/funciones.php",{caso:caso, actividades:actividades, idusuario:idusuario},function(resp){
            alert(resp)
            if(resp == 1){
                var idpersona = $("#persona").val();
                var funcion="tbl_itinerario_persona";
                $.post("./includes/fnc_tbl.php", {funcion:funcion, idpersona:idpersona},function(resp){dibuja_tbl(resp,funcion);})
                $('#asistencia_pesona').modal({
                    show: 'true'         
                });
                alert("Se ha validado la asistencia con éxito")
            }else{
                alert("Ha ocurrido un error, contacte al administrador del sistema")
            }
        });
    }
});

/****************************************************************************************************************************************************************/
/*********************************************Asistencia Autores*************************************************************************************************/
/****************************************************************************************************************************************************************/

$("#validar_pres_autores").click(function (){
    $('#contenedor').html("");
    $.post("form/voluntarios/from_validar_presentacion_autores.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
        b_func("tbl_asis_autores");
    });
});

$("#validar_asis_autores").click(function (){
    var trabajo = "" ;
    $("#tbl_asis_autores input[type=radio]").each(function (){
         var select = (this.checked);
            if(select == true){
                trabajo += $(this).val() + "," + $(this).attr("id");
            }
    });
    if(trabajo != ""){
        var caso = "validar_asistencia_autor";
        
        $.get("form/voluntarios/plantillas/funciones.php",{caso:caso, trabajo:trabajo},function(resp){
            if(resp == 1){
                b_func("tbl_asis_autores");
                alert("La validación se ha realizado con éxito")
            }else if(resp==0){
                alert("Ha ocurrido un error, por favor contate al administrador del sistema")
            }else if(resp==3){
                alert("ERROR, PETICIÓN NO ENCONTRADA")
            }
        });
        
    }else{
        alert("Debe seleccionar al menos un trabajo")
    }
});

/****************************************************************************************************************************************************************/
/*********************************************Validar Pagos******************************************************************************************************/
/****************************************************************************************************************************************************************/

$("#pagos_voluntarios").click(function(){
    $('#contenedor').html("");
    $.post("form/voluntarios/form_validar_pagos.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
        
        var aja=$('#rol').val();
        
        var se =  aja.split(",");
        var contar = se.length ;
        var id = []; 
        for(var i= 0; i<contar; i++){
        // alert(id[i])
            if (i == 0){
                id[i] = se[i].substring(2,4);
                
                if(isNaN(id[i])){
                id[i]= id[i].substr(0, 1);
                }
                if(id[i]==1){
                    
                    var funcion='tbl_validar_pagos';
                    var parametro = 1;
                    $.post("./includes/fnc_tbl.php", {funcion:funcion, parametro:parametro},function(resp){dibuja_tbl(resp,funcion);})
                }
            }else{
                id[i]  =  se[i].substring(1,3) ;
                if(isNaN(id[i])){
                id[i]= id[i].substr(0, 1);
                }
                if(id[i]==13){
                    
                    var funcion='tbl_validar_pagos';
                    var parametro = 0;
                    $.post("./includes/fnc_tbl.php", {funcion:funcion, parametro:parametro},function(resp){dibuja_tbl(resp,funcion);})
                }
            }
        }
        
    });
});

function validar_pago_persona(idpersona){
    $("#num").val(1)
    $("#persona").val(idpersona);
    $("#pagos_pesona").modal("toggle");
    $('#slc_tipo_pago').val(0).change();
    $('#slc_tipo_tour').val(0).change();
    $("#tours").removeAttr("style");
    $("#tours").attr("style","display:none");
    $("#tipo_pago").removeAttr("style");
    $("#ingreso_clave").removeAttr("style");
    $("#clave_desc").val("");
    $("#descuento_aplicar").html("");
    $("#btn_aplicar_descuento").attr("style","display:none");
}

function datos_pago(id){
    var funcion = $("#funcion").val();
    $('#'+funcion).find('tfoot').remove();
    
    var tipo_tour = $('#slc_tipo_tour').val();
    var tipo_costo = $('#slc_tipo_pago').val();
    
    if(tipo_costo != "tour"){
        $("#tours").removeAttr("style");
        $("#tours").attr("style","display:none");
        $("#dato").val(0);
        
    }
    
    if(tipo_tour !=0){
        $("#tours").removeAttr("style");
        $("#tours").attr("style","margin-top: 75px;");
    }else{
        
    }
    
    if(id==0){
        $("#datos_factura").attr("style","display:none");
        $("#btn_validar_pago").attr("style","display:none");
    }else if (id=="tour"){
        $("#datos_factura").attr("style","display:none");
        $("#btn_validar_pago").attr("style","display:none");
        $("#tours").removeAttr("style");
        $("#tours").attr("style","margin-top: 75px;"); 
        $("#dato").val(1);
    }else{
        var tabla_a_mostrar =$("#dato").val();
        if(tabla_a_mostrar == 1){
            $.post("./includes/fnc_tbl.php", {funcion:funcion,id:id, dato:tabla_a_mostrar,tour:tipo_tour},function(resp){ dibuja_tbl1(resp,funcion);})
        }else{
            $.post("./includes/fnc_tbl.php", {funcion:funcion,id:id, dato:tabla_a_mostrar},function(resp){ dibuja_tbl1(resp,funcion);})
        }
        
        $("#datos_factura").removeAttr("style");
        $("#btn_validar_pago").removeAttr("style");
        $("#datos_factura").attr("style","margin-top: 15px;"); 
    }
    
}

function dibuja_tbl1(html, funcion){
    $('#'+funcion).find('tbody').remove();
    $('#'+funcion).append(html); 
    
    $('#'+funcion+' tfoot ' ).each(function(){
         var text = $(this).find('td:first').attr("id");
         $("#total_a_pagar_persona").val(text);
         
    });
    
}

function agregar_articulo(){
    var funcion = $("#funcion").val();
    var numero = parseInt($("#num").val());
    var tipo_pagos=$('#agregar_producto option:selected').text();
    var valor=$('#agregar_producto option:selected').val();
    
    $("#bracho1").removeAttr("style");
    
    if(valor==0){
        alert("Debe Seleccionar un Articulo")
    }else{
        $('#'+funcion+' tbody tr[id^=otro_producto'+numero+'] td:eq(1)').append("<td>"+tipo_pagos+"</td>");
        $("#agregar_producto").remove();

        $("#num").val(numero+1);
        var correlativo =$("#num").val();
        $("#tours").attr("style","display:none");
        $("#tipo_pago").attr("style","display:none");

        var id ="slc_costo_tour";

        $.post("./includes/fnc_slc.php?id="+id,function(resp){ 

        $('#'+funcion).find("tbody").append("<tr id=otro_producto"+correlativo+" ><td>"+correlativo+" </td><td><select class='form-control'id='agregar_producto'  onchange='agregar_producto_a(this.value, "+correlativo+")' >"+resp+"</select></td>")
        });
    }
    
    
}

function agregar_producto_a(id, correlativo){
    var funcion = $("#funcion").val();
    var tipo_pago=$('#agregar_producto option:selected').attr('id');
    var caso = 'inf_costo';
        
    $('#'+funcion+' tbody tr[id^=otro_producto'+correlativo+'] td:gt(1)').remove();
    
    if(tipo_pago =="costo"){
        $.get("form/voluntarios/plantillas/funciones.php",{caso:caso, idcosto:id, tipo_pago:tipo_pago, numero:correlativo},function(resp){
            var val = resp.substr(-15);
            var re = /<[^>]*>?/g ;
            var vlaor_a_sumar = val.replace(re, "");
            var a = $("#total_pagar").text();
            var sumar = a.replace("Total a pagar", "");
            var total_a_pagar = (parseFloat(sumar)+parseFloat(vlaor_a_sumar));
            $("#total_pagar").html("<strong >Total a pagar " +total_a_pagar+"</strong >");
            $("#total_a_pagar_persona").val(total_a_pagar);
            $('#'+funcion).find('tr[id^=otro_producto'+correlativo+']').append(resp);
            
        });
        
        
    }else if(tipo_pago =="tour"){
        $.get("form/voluntarios/plantillas/funciones.php",{caso:caso, idcosto:id, tipo_pago:tipo_pago, numero:correlativo},function(resp){
            var val = resp.substr(-15);
            var re = /<[^>]*>?/g ;
            var vlaor_a_sumar = val.replace(re, "");
            var a = $("#total_pagar").text();
            var sumar = a.replace("Total a pagar", "");
            var total_a_pagar = (parseFloat(sumar)+parseFloat(vlaor_a_sumar));
            
            $("#total_pagar").html("<strong >Total a pagar " +total_a_pagar+"</strong >");
            $("#total_a_pagar_persona").val(total_a_pagar);
            $('#'+funcion).find('tr[id^=otro_producto'+correlativo+']').append(resp);
        });
        
    }
    
     
}

function eliminar_articulo(){
    var determinante= 0;
    var funcion = $("#funcion").val();
    var numero = parseInt($("#num").val());
    var descuento =$('#'+funcion).find('td[id=descuento_pago'+numero+']').text();
    var total = parseFloat($('#'+funcion).find('td[id=descuento_pago'+numero+']').next().next().text());
    
    var final = descuento.length ;
    var decuento_aplicado = descuento.substring(0, final-1);
    decuento_aplicado = parseFloat(decuento_aplicado);
    
    if(isNaN(decuento_aplicado)){
        
    }else{
        var original = total / (1-(decuento_aplicado/100));
        determinante++;
    }
    
    $('#'+funcion+' tbody tr[id^=otro_producto'+numero ).each(function(){
        var text = $(this).find('td:last').text();
        var valor = parseFloat(text);
        if(isNaN(valor)){
            
        }else{
            if(determinante>0){
                var total = $("#total_a_pagar_persona").val();
                var total_a_pagar = (parseFloat(total) - parseFloat(original));
                $("#total_pagar").html("<strong >Total a pagar " +total_a_pagar+"</strong >");
                $("#total_a_pagar_persona").val(total_a_pagar);
              
            }else{
                var descuento_fila = parseFloat($('#'+funcion).find('td[id=descuento_pago'+(numero-1)+']').text());
                if(!isNaN(descuento_fila)){
                    var con_des = parseFloat($('#'+funcion).find('td[id=descuento_pago'+(numero-1)+']').next().next().text());
                    $("#total_pagar").html("<strong >Total a pagar " +con_des+"</strong >");
                    $("#total_a_pagar_persona").val(con_des);
                }else{
                    var total = $("#total_a_pagar_persona").val();
                    var total_a_pagar = (parseFloat(total) - parseFloat(text));
                    $("#total_pagar").html("<strong >Total a pagar " +total_a_pagar+"</strong >");
                    $("#total_a_pagar_persona").val(total_a_pagar);
                }
            }
        }
    });
    $("#num").val(numero-1)
    $('#'+funcion+' tbody tr[id^=otro_producto'+numero+']').remove();
    
}

$("#btn_validar_pagos").click(function(){
    var funcion = $("#funcion").val();
    var tipo_pagos=$('#agregar_producto option:selected').text();
    var valor=$('#agregar_producto option:selected').val();
    var numero = parseInt($("#num").val());
    
    if(valor==0){
        $("#num").val(numero-1)
        $('#'+funcion+' tbody tr[id^=otro_producto'+numero+']').remove();
    }else{
        $('#'+funcion+' tbody tr[id^=otro_producto'+numero+'] td:eq(1)').append("<td>"+tipo_pagos+"</td>");
        $("#agregar_producto").remove();
    }
    
    var costos = "";
    var tours = "";
    
   $('#'+funcion+' td').each(function(){ 
       var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){ 
        }else{
            if(id =="costo"){
                var valorc = $(this).attr("name");
                costos += valorc + ",";
            }else if(id=="tour"){
               var valort = $(this).attr("name");
               tours += valort + ",";
            }
        }
   }); 
   
    var fin = costos.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
    costos = costos.substr(0, fin); // elimino la coma final
    var fin1 = tours.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
    tours = tours.substr(0, fin1); // elimino la coma final
    var idpersona=$("#persona").val();
    var total_a_pagar=$("#total_a_pagar_persona").val();
    var total_articulos =$("#num").val();
    var caso ='validar_pago';
    
    $.get("form/voluntarios/plantillas/funciones.php",{caso:caso, costos:costos, tours:tours, idpersona:idpersona, total_a_pagar:total_a_pagar, total_articulos:total_articulos},function(resp){
        alert(resp);
        if(resp == 1){
             var detalle='';
            $('#'+funcion+' td').each(function(){ 
                var valor = $(this).text();
                var id = $(this).attr("id");
                if(id!="total_pagar"){
                    if((valor!="")){
                        detalle+=valor + ",";
                    }
                }else{
                }
                if(valor=="Inscripción"){
                    var funct= "enviar_correo_pago_inscripcion";
                  $.get("form/voluntarios/plantillas/funciones.php",{caso:funct, idpersona:idpersona});  
                }
            });
            
            var fin = detalle.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
            detalle = detalle.substr(0, fin); // elimino la coma final
            var func= 'enviar_detalle_factura';
            $.get("form/voluntarios/plantillas/funciones.php",{caso:func, detalle:detalle, total_articulos:total_articulos,idpersona:idpersona, total_a_pagar:total_a_pagar});
           
            $("#tipo_pago").removeAttr("style");
            $("#slc_tipo_pago").val(0).change();
            $("#slc_tipo_tour").val(0).change();
            $('#'+funcion).find('tbody').remove();
             b_func("tbl_validar_pagos");
            alert("El pago se ha realizado con éxito");
        }else{
            alert("Ha ocurrido un error, contacte al administrador del sistema");
        }
    });
    
});

function mymodal(id){
    $("#id_tr_descuento").val(id);
    $("#ingreso_clave").removeAttr("style");
    $("#clave_desc").val("");
    $("#descuento_aplicar").html("");
    $("#btn_aplicar_descuento").attr("style","display:none");
    $("#pagos_decuento").modal('toggle')
}

$(document).keypress(function(e){
    if(e.which == 13) {
        var clave = $("#clave_desc").val();
        if(clave == ""){
            $("#error").removeAttr("style");
            $("#error").attr("style","color:red;");
        }else if(clave != "Iies-Admin@"){
            $("#error1").removeAttr("style");
            $("#error1").attr("style","color:red;");
        }else if(clave == "Iies-Admin@"){
            $("#ingreso_clave").attr("style", "display:none");
            $("#descuento_aplicar").html("");
            $("#descuento_aplicar").append(" <label class='col-md-2 control-label'>Descuento</label><div class='col-md-5' align='right' id=''><input type='text ' id = 'valor_descuento' name = 'valor_descuento' maxlength='4' class='form-control' required placeholder='Descuento en porcentaje ej. 25%'/></div><label style='display: none' id='error2' class='col-md-2 control-label'  >Debe estar en porcentaje</label><label style='display: none' id='error3' class='col-md-2 control-label'  >Debe ser un Número</label >");
            $("#btn_aplicar_descuento").removeAttr("style");
        }else{
            $("#error1").attr("style", "display:none");
            $("#error").attr("style", "display:none");
        }
    }
    
});


$(document).keyup(function(e){
     if(e.which==8) {
        $("#error1").attr("style", "display:none");
        $("#error").attr("style", "display:none");
        $("#error3").attr("Style", "display:none");
        $("#error2").attr("Style", "display:none");
    }
})

$("#aplicar_descuento").click(function(){
    var valor_des = $("#valor_descuento").val();
    var id_tr = $("#id_tr_descuento").val();
    var final = valor_des.length ;
    var porce = valor_des.substring(final-1, final);
    var numero = valor_des.substring(0, final-1);
    if(porce == "%"){
        if(isNaN(numero)){
          $("#error2").attr("Style", "display:none");
          $("#error3").removeAttr("Style");
          $("#error3").attr("style","color:red;");
        }else{
           $("#error3").attr("Style", "display:none");
           $("#error2").attr("Style", "display:none");
           var funcion = $("#funcion").val();
            //.find('option[value='+valores[i]+']')
           var antes_descu= $('#'+funcion).find('td[id='+id_tr+']').next().next().text();
           $("#val_antes_des").val(antes_descu);
           var total_desc = parseFloat(antes_descu) - (parseFloat(numero/100)*antes_descu);
           var antes_descu= $('#'+funcion).find('td[id='+id_tr+']').html("").append(valor_des);
           var antes_descu= $('#'+funcion).find('td[id='+id_tr+']').next().next().html("").append(total_desc);
           var total_a_pagar_persona = $("#total_a_pagar_persona").val();
           var antes = parseFloat($("#val_antes_des").val());
           var total_a_pagar = (parseFloat(total_a_pagar_persona)-antes +total_desc);
           $("#total_pagar").html("<strong >Total a pagar " +total_a_pagar+"</strong >");
           $("#total_a_pagar_persona").val(total_a_pagar_persona);
           $("#pagos_decuento").modal("toggle");
        }
    }else{
        $("#error3").attr("Style", "display:none");
        $("#error2").removeAttr("Style");
        $("#error2").attr("style","color:red;");
    }
});