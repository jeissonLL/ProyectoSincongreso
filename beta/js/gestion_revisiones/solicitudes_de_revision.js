/* 
 * Certificado de Asistente.
 * autor: Brayan Triminio
 * 21/06/2017.
 */

//CONTRUCCION DEL FORMULARIO
function retorno(resp){ 
    $('#contenedor').html(resp);
}
//FUNCION PARA CARGAR EL FORMULARIO DE CERTIFICADOS EN EL MENU PRINCIPAL (PAGINA DE INICIO)
$("#solicitud_revisiones_pendientes_r").click(function (){
   $.post("./form/gestion_revisiones/form_solicitudes_revisiones.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
        b_func('tbl_revisiones');
        b_func('info_trabajo');
        b_func('tabajos_aceptados');
        
    });   
});

function aceptar_revisar_trabajo(idtrabajo , idtabla){
    var caso = $("#caso").val();//caso para aceptar los trabajos
    var accion = "aceptar";
    var resp = confirm("Desea realmente aceptar este trabajo")
    if(resp== true){
        $.post("./includes/querys.php?caso="+caso,{idtrabjo:idtrabajo,idtabla:idtabla, accion:accion},function(resp){
          // alert(resp)
            if(resp == 1){
                alert("Se ha aceptado el trabajo puede proceder a su revisión")
                b_func('tbl_revisiones');
                b_func('tabajos_aceptados');
            }else{
            alert("Actualmete presentamos errores ")
            
            }
        });
    }else{
        //
    }
   
}

function rechazar_revisar_trabajo(idtrabajo , idtabla){
   var caso = $("#caso").val();//caso para rechaar los trabajos
    var accion = "rechazar";
    var resp = confirm("Desea realmente rechazar este trabajo")
    if(resp== true){
        $.post("./includes/querys.php?caso="+caso,{idtrabjo:idtrabajo,idtabla:idtabla,accion:accion},function(resp){
          // alert(resp)
            if(resp == 1){
                alert("Se ha rechazado el trabajo para su revisión")
                b_func('tbl_revisiones');
            }else{
            alert("Actualmete presentamos errores ")
            
            }
        });
    }else{
      //  alert("no aceopt")
    }
}

function infotrabajo(idt, btn){
  //  $("#modalyolo").modal('toggle');
    var caso = "mostrarinfotrabajo";

    $.post("form/gestion_revisiones/plantillas/funciones.php", {idt:idt, caso:caso}, function (resp) {     
      //alert(resp)
        if (btn == 0){
        var dataJson = JSON.parse(resp);
                $("#idtrab").text("  " + dataJson.id_trabajo_pk + "  ");
                $("#ttrab").text("  " + dataJson.titulo_trabajo.toUpperCase() + "  ");
                $("#palabrastrab").html("");
                var data = dataJson.palabras_clave;
                var myarr = data.split(",");               
                for(var i = 0; i < myarr.length; i++){
                    $("#palabrastrab").append("<li>"+myarr[i]+"</li>").text();
                }
                $("#tematrab").text("  " + dataJson.tematica.toUpperCase() + "  ");
                $("#resutrab").text("  " + dataJson.resumen + "  ");
                $("#fechtrab").text("  " + dataJson.fecha_subida + "  ");
               // $("#urlmodalinfo").html("<a class='on-default edit-row' download="+dataJson.ubicacion_archivo+"  href='form/gestion_trabajos/trabajos/congreso"+dataJson.idcongreso+"/tipotrabajo"+dataJson.tipo_trabajo+"/"+dataJson.ubicacion_archivo+"' ><i class='glyphicon glyphicon-download-alt'></i></a>");//URL
                $("#descargar").attr("style","display: none");
                
                $('#modal-dialog-infot').removeAttr('style');
                $('#modal-dialog-infot').modal({
                     show: 'true'         
                });
        }else if(btn == 1) {
            var dataJson = JSON.parse(resp);
                $("#idtrab").text("  " + dataJson.id_trabajo_pk + "  ");
                $("#ttrab").text("  " + dataJson.titulo_trabajo.toUpperCase() + "  ");
                $("#palabrastrab").html("");
                var data = dataJson.palabras_clave;
                var myarr = data.split(",");               
                for(var i = 0; i < myarr.length; i++){
                    $("#palabrastrab").append("<li>"+myarr[i]+"</li>").text();
                }
                $("#tematrab").text("  " + dataJson.tematica.toUpperCase() + "  ");
                $("#resutrab").text("  " + dataJson.resumen + "  ");
                $("#fechtrab").text("  " + dataJson.fecha_subida + "  ");
                $("#urlmodalinfo").html("<a class='on-default edit-row' download="+dataJson.ubicacion_archivo+"  href='form/gestion_trabajos/trabajos/congreso"+dataJson.idcongreso+"/tipotrabajo"+dataJson.tipo_trabajo+"/"+dataJson.ubicacion_archivo+"' ><i class='glyphicon glyphicon-download-alt' onclick='descargo_archivo();'></i></a>");//URL
                
                
               $('#modal-dialog-infot').removeAttr('style');
                $('#modal-dialog-infot').modal({
                     show: 'true'         
                });
        }
       
    });
    
     
}

/*OBED REVISIONES DE TRABAJOS */

/*OBED 
 * 
 * INICIO
 * 
 * revisar TRABAJO*/
function revisartrabajo_gr(idt, idtem){    
    $("#idt").val(idt);
    $("#idtem").val(idtem);
    var caso = 'revisartrabinvest';
    $("#caso").val(caso);
   $.ajax({
        url: "form/gestion_revisiones/plantillas/funciones.php",
        type: "POST",
        data: {idt:idt, idtem:idtem, caso:caso},
        success: function (resp) { 
            //alert(resp);
            console.log(resp);
            var dataJson = JSON.parse(resp);
                $("#idtrabd").text("  " + dataJson.id_trabajo_pk + "  ");
                $("#ttrabd").text("  " + dataJson.titulo_trabajo.toUpperCase() + "  ");
                /*preguntas cuantitativas*/  
                $("#pcuanti").find('tbody').remove();
                for (var i=0; i<dataJson.numcuanti; i++){
                    $("#pcuanti").append("<tr><td style='font-weight:bold; text-align:right; font-size:12px;'>"+dataJson['nombre_pregunta_cuantitativa'+i].toUpperCase()+"?</td><td id='idresp"+i+"' name='"+dataJson['id_pregunta_cuantitativa_pk'+i]+"'></td>");
                    if(dataJson['id_tipo_pregunta_pk'+i] >= 2 && dataJson['id_tipo_pregunta_pk'+i] <= 10){
                        var data = dataJson['opciones'+i];
                        var data1 = dataJson['ponderacion'+i];
                        var myarr = data.split("<>"); 
                        var myarr1 = data1.split("<>"); 
                        $("#idresp"+i).html("");
                        for(var f = 1; f < myarr.length; f++){                            
                            $("#idresp"+i).append("<div class='checkbox checkbox-success checkbox-circle'><input type='checkbox' onclick='radiosrevtrab(this.id, "+myarr.length+","+dataJson['id_pregunta_cuantitativa_pk'+i]+","+f+")' id='preg_"+dataJson['id_pregunta_cuantitativa_pk'+i]+"_"+f+"' value='"+myarr[f]+"' name='"+myarr1[f]+"'><label style='font-weight: bold;' for='preg_"+dataJson['id_pregunta_cuantitativa_pk'+i]+"_"+f+"'>"+myarr[f]+"</label></div>");
                        }
                    }else if(dataJson['id_tipo_pregunta_pk'+i] == 11){
                        var data = dataJson['opciones'+i];
                        var data1 = dataJson['ponderacion'+i];
                        var myarr = data.split("<>"); 
                        var myarr1 = data1.split("<>"); 
                        $("#idresp"+i).html("");
                        for(var f = 1; f < myarr.length; f++){                            
                            $("#idresp"+i).append("<div class='checkbox checkbox-success'><input type='checkbox'   id='preg_"+dataJson['id_pregunta_cuantitativa_pk'+i]+"_"+f+"' value='"+myarr[f]+"' name='"+myarr1[f]+"'><label style='font-weight: bold;' for='preg_"+dataJson['id_pregunta_cuantitativa_pk'+i]+"_"+f+"'>"+myarr[f]+"</label></div>");
                        }
                    }
                }               
                /*preguntas cualitativas*/
                $("#pcuali").find('tbody').remove();
                for (var j=0; j<dataJson.numcuali; j++){
                    if(dataJson['id_tipo_pregunta_fk'+j] == '1'){
                        $("#pcuali").append("<tbody><tr><td  style='font-weight:bold; text-align:right; font-size:12px;'>"+dataJson['nombre_pregunta_cualitativa'+j].toUpperCase()+"?</td><td><textarea class='form-control' rows='4' id='pcuali"+j+"' name='"+dataJson['id_pregunta_cualitativa_pk'+j]+"' style='border: 1px solid #00B19D; font-weight: bold;'></textarea></td><tr></tbody>");
                    }
                }
                $("#desiciontrabajo").html("<select class='form-control' id='selectdesicion'><option value='0'>Seleccione</option></select>");
                $("#selectdesicion").html("");
                for(var k = 0; k < dataJson.numtiposdict; k++ ){                    
                    $("#selectdesicion").append("<option value='"+dataJson['id_tipo_dictamen_pk'+k]+"'>"+dataJson['nombre_tipo_dictamen'+k]+"</option>");
                }
                
                $("#obstrabajo").html("<textarea id='observacionestrabajo' class='form-control' rows='4' id='obs"+dataJson.id_trabajo_pk+"' style='border: 1px solid #00B19D;'></textarea>");
                
                /*hidden pcuanti y pcuali*/
                $("#nfilapcuanti").val(dataJson.numcuanti);
                $("#nfilapcuali").val(dataJson.numcuali);
                
                $('#modal-dialog-revisatrab').removeAttr('style');
                $('#modal-dialog-revisatrab').modal({
                     show: 'true'         
                }); 

        }
    });
    
}


/*ALMACENO EL FORMULARIO DE REVISION*/
$("#guardarrevisiontrabajo").click(function (){
    var caso = 'guardarformulariorevision';
    $("#caso").val(caso);
    
    /*captura de datos para almacenar*/
    var desicion = $("#selectdesicion").val();
    var observacionestrabajo = $("#observacionestrabajo").val();
    var idt = $("#idt").val();
    var idtem = $("#idtem").val();
    var descargo_archivo = $("#descargo_archivo").val();
    /*Capturo el numero de preguntas cuantitativas y cualitativas*/
    var numcuanti = $("#nfilapcuanti").val();
    var numcuali = $("#nfilapcuali").val();
    
    /*capturo los elementos chequedos por pregunta y creo un arreglo*/
    var opcion = 0;
    var ponderacion = 0;
    var array_pcuanti  = [];
    for(var i=0; i<numcuanti;i++){        
        var idpreg = $("#idresp"+i).attr("name");/*ID PREGUNTA*/        
        $("#idresp"+i+"  input:checkbox:checked").each(function() {
            opcion = $(this).val();
            ponderacion = $(this).attr("name");
            array_pcuanti.push(idpreg+','+opcion+'<>'+ponderacion);
        });
    }
    /*capturo las preguntas cualitativas*/
    var array_pcuali = [];
    for (var j=0; j < numcuali; j++){
        var idpregc = $("#pcuali"+j).attr("name");
        array_pcuali.push(idpregc+","+$("#pcuali"+j).val());
    }
    
     //imprimir objetos contridos;
//     $.each(array_pcuali, function( index, value ) {
//        alert( index + ": " + value );
//      });
    
    $.ajax({
       url: "includes/querys.php?caso="+caso,
       type: "POST",
       data: {desicion:desicion, observacionestrabajo:observacionestrabajo,idt:idt,idtem:idtem,descargo_archivo:descargo_archivo,numcuanti:numcuanti,numcuali:numcuali,array_pcuanti:array_pcuanti,array_pcuali:array_pcuali},
       success: function (resp) { 
           //alert(resp);
           console.log(resp);
           if(resp == 1){
               alert("Formulario de revisión almacenado exitosamente.!!!");
                $('#modal-dialog-infot').modal('hide');     //oculta el modal
                $('body').removeClass('modal-open');  //quita la clase que mantiene activo el modal
                $('.modal-backdrop').remove();        //habilita en formulario contenedor  
                $('#form_revisar_trabajos').trigger("reset");//limpiar formulario                                                 
                    //funcion para actualizar tabla donde se visualizan los campos ingresados
                $.post("./form/gestion_revisiones/form_solicitudes_revisiones.php", {}, function (resp) {     
                    console.log(resp);
                    $('#contenedor').html("");
                     retorno(resp);
                     b_func('tbl_revisiones');
                     b_func('info_trabajo');
                     b_func('tabajos_aceptados');
                 });   
//               $('#form_revisar_trabajos').trigger("reset");//limpiar formulario
           }else{
               alert("ERROR, al almacenar el formulario, inténtelo nuevamente.!!!");
           }
       }
   });
});


/*OBED 
 * 
 * FINAL
 * 
 * DICTAMINAR TRABAJO*/