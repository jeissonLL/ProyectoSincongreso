/*
  Certificados
 autor: Obed Martinez
  20/02/2017.
 */
//CONTRUCCION DEL FORMULARIO
function retorno(resp){ 
    $('#contenedor').html(resp);
}
//FUNCION PARA CARGAR EL FORMULARIO DE CERTIFICADOS EN EL MENU PRINCIPAL (PAGINA DE INICIO)
$("#c_certificados").click(function (){
   $.post("form/gestion_certificados_php/c_certificados.php", {}, function (resp) {        
       $('#contenedor').html("");
       retorno(resp);
       b_sm('origen_certificados');//llenado de select multiple de personas en form certificados
       b_func('tbl_certificados');//llenado de tabla certificados
    });   
});
//FUNCION PARA GUARDAR CERTIFICADOS
function guardar_certificado(){
     var caso = $("#caso").val();     
     var contador =0;
        if($("#nombre_c").val() != "" && $("#encabezado_c").val() != "" && $("#motivo_c").val() != "" && $("#pie_c").val() != ""){              
            $("input[type=file]").each(function(){ //validamos que no vayan vacios los typo file
                var files = $(this).val(); 
            if(files == ''){
                alert("Debe llenar todos los campos");

            }else{
                contador++;
            }
        });
        if(contador>1){


       
            $.ajax({
                    url: "./includes/querys.php?caso="+caso,
                    type: "POST",
                    data: $('#form_certificados').serialize(),
                    success: function (resp) {
                        alert(resp);
                       if(resp==1){   
                                     
                           //SUBIMOS LAS IMAGENES 
                           var contador = 0;
                           var i = 0;
                           $("input[type=file]").each(function(){ //validamos que no vayan vacios los typo file
                                var files = $(this).val(); 
                              
                                if(files != ''){
                                     var formData = new FormData($("#form_certificados")[i]);
                                    var ruta = "form/gestion_certificados_php/plantillas/imagen-ajax.php";
                                    $.ajax({
                                        url: ruta,
                                        type: "POST",
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success: function(datos)
                                        {
                                        alert(datos);
                                          i++;

                                        }
                                    });
                                    
                                }else{
                                   // alert("hola");
                                    contador += 1;
                                } 
                            });                           
                            if(i > 0){
                                swal("Datos guardados exitosamente", "success");
                               // alert('Datos guardados exitosamente.');
                                $('#form_certificados').trigger("reset");//limpiar formulario                    
                                    //funcion para actualizar tabla donde se visualizan los campos ingresados
                                $.post("form/gestion_certificados_php/c_certificados.php", {}, function (resp) { 
                               
                                     $('#form_certificados').html("");         
                                     retorno(resp);
                                     b_sm('origen_certificados');//llenado de select multiple de personas en form certificados
                                     b_func('tbl_certificados');
                                }); 
                            }
                          // FIN DE SUBIDA DE IMAGENES                   
                       }else if(resp==2){                   
                           alert('Error, no se guardaron los datos.');
                        }
                    }
                }); 
            }
        }
    
        return false;
}
//FUNCION PARA MODIFICAR CERTIFICADOS
function modificar_certificado(id_certificado){
//    alert('modificarDFGDFG ->>' + id_certificado);
        $('#form_certificados').trigger("reset");//limpiar formulario 
        $('#destino_certificados').html("");//limpiar formulario 
        $('#r_firmas').html("");//limpiar formulario 
        $('#imagen').html("");//limpiar formulario
        var caso = "modificar_certificados";
        $("#caso").val("modificar_certificados");//cambiamos el caso para poder almacenar los cambios realizados 
        $("#id").val(id_certificado);//envio del id del certificado para actualizarlo en la BD
        b_sm('origen_certificados');//llenado de select multiple de personas en form certificados   
        $.post("./form/gestion_certificados_php/plantillas/funciones.php?caso="+caso, {id_certificado:id_certificado}, function (resp) {
         
           // console.log(resp);
             var dataJson = JSON.parse(resp);
             alert(resp);
             $("#nombre_c").val(dataJson.nombre_certificado);
             $("#encabezado_c").val(dataJson.encabezado_certificado);
             $("#motivo_c").val(dataJson.motivo_certificado);
             $("#pie_c").val(dataJson.pie_certificado);
             $("#slcrolescongreso option[value="+dataJson.idrol_congreso+"]").prop('selected',true);
            if(dataJson['certificado_especial']==0){                
                $("#rd_no").attr('checked', true);
                $("#rd_si").attr('checked', false);
                $("#eti_n_persona").css("display","none");
                $("#nombre_persona").html("");
            }else if(dataJson['certificado_especial']==1){
                $("#rd_si").attr('checked', true);
                $("#rd_no").attr('checked', false);
                $("#eti_n_persona").removeAttr("style");
                $("#nombre_persona").html("");
                $("#nombre_persona").append('<textarea id="n_persona" name="n_persona" type="text" class="form-control" placeholder="@@PH_n_persona@@">'+dataJson['nombre_persona']+'</textarea>');
            }
             for (var j=0; j <= dataJson.n_firmas - 1; j++ ){ 
                    //quitando valores null
                   if(dataJson['segundo_nombre'+j] == null){
                       dataJson['segundo_nombre'+j] = "";
                   }else if(dataJson['segundo_apellido'+j]==null){
                       dataJson['segundo_apellido'+j] = "";
                   }
                    //ert(dataJson['segundo_nombre'+j]);
                     $("#origen_certificados option[value="+dataJson['identificacion'+j]+"]").remove();
                     $("#destino_certificados").append("<option selected value="+dataJson['identificacion'+j]+" id='"+dataJson['primer_nombre'+j]+' '+dataJson['segundo_nombre'+j]+' '+dataJson['primer_apellido'+j]+' '+dataJson['segundo_apellido'+j]+"' onclick='quitar(this.value,this.id);'>"+dataJson['primer_nombre'+j]+' '+dataJson['segundo_nombre'+j]+' '+dataJson['primer_apellido'+j]+' '+dataJson['segundo_apellido'+j]+"</option>");
                   
                    $("#r_firmas").append('<div id="div_'+dataJson['identificacion'+j]+'"><label>'+dataJson['primer_nombre'+j]+' '+dataJson['segundo_nombre'+j]+' '+dataJson['primer_apellido'+j]+' '+dataJson['segundo_apellido'+j]+'</label><input id="'+dataJson['identificacion'+j]+'" class="btn-default btn-rounded" name="'+dataJson['identificacion'+j]+'" type="file" accept="image/png,image/jpg,image/jpeg"></input></div>');
            } 
             $("#imagen").append('<label>'+dataJson.nombre_certificado+'</label><br><div ><img  src="./img/certificados/'+dataJson.url_arte+'" id="foto_persona" name="foto_persona" width="100px" height="80px"></div>');
             for(var i = 0; i<dataJson.n_firmas;i++){                
                 $("#imagen").append('<label>'+dataJson['primer_nombre'+i]+' '+dataJson['segundo_nombre'+i]+' '+dataJson['primer_apellido'+i]+' '+dataJson['segundo_apellido'+i]+'</label><br><div ><img  src="./img/certificados/'+dataJson['url_firma'+i]+'" id="foto_persona" name="foto_persona" width="100px" height="80px"></div>');
             }
           
        });  
}




//FUNCION PARA ELIMINAR CERTIFICADOS
function eliminar_certificado(id_certificado){
   // alert('eliminarDFGDFG->>' + id_certificado);
    var caso = 'eliminar_certificado';
    $.ajax({
        url: "./includes/querys.php?caso="+caso,
        type: "POST",
        data: {id_certificado:id_certificado},
        success: function (resp) {
         //  alert(resp);
            if(resp==1){
               // alert('Datos eliminados exitosamente.');
                swal("¡Borrado!", "El Certificado ha sido eliminado junto con toda la información asociada a él.", "success");
                $('#form_certificados').trigger("reset");//limpiar formulario                    
                    //funcion para actualizar tabla donde se visualizan los campos ingresados
                $.post("form/gestion_certificados_php/c_certificados.php", {}, function (resp) { 
                   // alert(resp);     
                     $('#form_certificados').html("");         
                     retorno(resp);
                     b_sm('origen_certificados');//llenado de select multiple de personas en form certificados
                     b_func('tbl_certificados');
                }); 
            }else{
               // alert('Ha ocurrido un problema, No se eliminaron los datos.');
               swal("¡Ha ocurrido un problema!", "El Certificado No se  elimino.", "success");
            }
        }
    });    
}

//==================================================================================================================================

//FUNCION PARA GENERAR LOS CERTIFICADOS
$("#generar_certificados").click(function (){
  
   $.post("form/gestion_certificados_php/genera_certificados.php", {}, function (resp) {   
    
       $('#contenedor').html("");
       retorno(resp);      
        b_ric('checkbox_certificado');
    }); 
});

