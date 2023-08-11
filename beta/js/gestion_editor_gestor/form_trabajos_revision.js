/* 
 * Autor: Obed Martínez
 * 09/06/2017.
 */
//FUNCION PARA CARGAR EL FORMULARIO
function retorno(resp){ 
    $('#contenedor').html(resp);
    
}
$("#enviar_rechazar_trabajo_eg").click(function (){
   $.post("./form/gestion_editor_gestor/form_trabajos_revision.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_trabajos_subidos_eg');
    }); 
});

//funcion construyen tematicas

function construyetrabajos(id_tem){
    var funcion = 'tbl_trabajos_subidos_egxtem';     
    if(id_tem != 0){
        $.post("./includes/fnc_tbl.php", {funcion:funcion,id_tem:id_tem}, function (resp) {
                    //  alert(resp);
                   console.log(resp);
                   if(resp == 2){
                      // alert("No hay trabajos asignados a esta temática.!!!");
                       $('#tbl_trabajos_subidos_eg').find('tbody').remove();
                   }else{
                       $('#tbl_trabajos_subidos_eg').find('tbody').remove();
                       $('#tbl_trabajos_subidos_eg').append(resp);                       
                   } 
            });   
    }
    
}

//mostrar modal de subir doc de trabajo con revisiones 
function cambiadocrev(idt){
    $("#idt").val(idt);
    $("#caso").val('cambiardocrev');

    $('#modal-dialog1').removeAttr('style');
    $('#modal-dialog1').modal({
         show: 'true'
    });             

}
//cargar nueva version del trabajo
//
//
function cargarnversion(){               
     var formData = new FormData($("#form_trabajos_revision")[0]);
           var ruta = "form/gestion_editor_gestor/plantillas/doc-ajax-eg.php";
           $.ajax({
               url: ruta,
               type: "POST",
               data: formData,
               contentType: false,
               processData: false,
               success: function(datos)
               {
                 console.log(datos);
//                            alert(datos);
                if(datos == 1){
                    alert('Datos guardados exitosamente.');
                    $('#modal-dialog').modal('hide');     //oculta el modal
                    $('body').removeClass('modal-open');  //quita la clase que mantiene activo el modal
                    $('.modal-backdrop').remove();        //habilita en formulario contenedor  
                    $('#form_trabajos_revision').trigger("reset");//limpiar formulario                                                 
                        //funcion para actualizar tabla donde se visualizan los campos ingresados
                     $.post("./form/gestion_editor_gestor/form_trabajos_revision.php", {}, function (resp) {     
                        console.log(resp);
                        $('#contenedor').html("");
                        retorno(resp);
                        b_func('tbl_trabajos_subidos_eg');
                     });   
                }else{
                    alert('Ha ocurrido un error y no se pudo subir su trabajo, por favor inténtelo nuevamente!');  
                }
               }
           });

}
            //
            
function rconfirmarautoria(idt){ 
    var caso = "recordar_autoria";
     if (confirm('Se enviará un correo electrónico a los autores de este trabajo, recordándoles que deben confirmar su autoría del trabajo. ¿Desea continuar?')) {                    
         $.ajax({
               url: "./form/gestion_editor_gestor/plantillas/funciones.php",
               type: "POST",
               data: {idt:idt, caso:caso},                           
               success: function(resp)
               {
                   console.log(resp);
                  if(resp == 1){
                      alert('EL autor o autores de este trabajo fueron notificados exitosamente!!!');
                  }else{
                      alert('Ha ocurrido un ERROR, mientras se notificaba a el o los autores de este trabajo, por favor inténtelo nuevamente!!!');
                  }
               }
        });
     }
}

//ACEPTAR TRABAJOS EDITOR GESTOR
function aceptartrabajo(idt,idtp,nombret){
    var caso = "enviar_trab_revision";
     if (confirm('¿Desea que este trabajo sea enviado a revisión?')) {                    
         $.ajax({
               url: "./form/gestion_editor_gestor/plantillas/funciones.php",
               type: "POST",
               data: {idt:idt, caso:caso, idtp:idtp, nombret:nombret},                           
               success: function(resp)
               {
                   console.log(resp);
                  // alert(resp)
                  if(resp == 1){
                      alert('El trabajo ha sido enviado a revisión exitosamente!!!');
                  }else if(resp == 2){
                      alert('El trabajo ya fue enviado a revisión.!!!');
                  }else if(resp == 3){
                      alert('Ha ocurrido un ERROR, al enviar a revisión el trabajo. Es posible que ya ha sido enviado a revisión, por favor verifique.!!!');
                  }else{
                      alert('ATENCIÓN.!!! Las autorías de este trabajo aun no están confirmadas.!!!');
                  }
                   
                   $.post("./form/gestion_editor_gestor/form_trabajos_revision.php", {}, function (resp) {     
                        console.log(resp);
                        $('#contenedor').html("");
                        retorno(resp);
                        b_func('tbl_trabajos_subidos_eg');
                     }); 
               }
        });
     }
}
function rechazartrabajo(idt,idtp,nombret){
    var caso = "rechazar_trab";
     if (confirm('¿Desea realmente rechazar este trabajo?')) {                    
         $.ajax({
               url: "./form/gestion_editor_gestor/plantillas/funciones.php",
               type: "POST",
               data: {idt:idt, caso:caso, idtp:idtp, nombret:nombret},                           
               success: function(resp)
               {
                   console.log(resp);
                 //alert(resp)
                  if(resp == 1){
                      alert('El trabajo ha sido rechazado exitosamente!!!');
                  }else if(resp == 2){
                      alert('El trabajo ya fue rechazado.!!!');
                  }else if(resp == 3){
                      alert('Ha ocurrido un ERROR, al rechazar el trabajo. Es posible que ya ha sido rechazado, por favor verifique.!!!');
                  }else if(resp == 4){
                      alert('El trabajo ya fue enviado a revisión. No puede ser rechazado.!!!');
                  }else{
                      alert('El trabajo fue rechazado.!!!');
                   }
                   $.post("./form/gestion_editor_gestor/form_trabajos_revision.php", {}, function (resp) {     
                        console.log(resp);
                        $('#contenedor').html("");
                        retorno(resp);
                        b_func('tbl_trabajos_subidos_eg');
                   }); 
               }
        });
     }
}

