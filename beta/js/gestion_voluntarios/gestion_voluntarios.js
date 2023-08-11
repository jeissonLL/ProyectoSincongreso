/* 
 * Brayan Triminio
 * Gestion de voluntarios
 * 10/08/17
 */

function retorno(resp) {  
    $('#contenedor').html("");
    $('#contenedor').html(resp);
}
/************************************************************************************************************/
/****************************Aceptar/Rechazar Solicitudes  de Voluntarios************************************/
/************************************************************************************************************/
$("#solicitudes").click(function () {
    $('#contenedor').html("");
    $.post("form/gestion_voluntario/form_voluntarios_solicitudes.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
       b_func('tbl_solicitudes_voluntarios');
       
    });
});
/*Funcion para aceptar los usuarios que desean ser terner el rol voluntario*/
function aceptar_voluntario(idusuario, idsolicitud, dictamen){
    
    if (dictamen == 1){
        var resp = confirm("¿Desea realmente aceptar esta persona como voluntario?")
    }else if(dictamen == 2){
        resp = confirm("¿Desea realmente rechazar esta persona como voluntario?")
    }
    if(resp==true){
        var caso = 'aceptar_solicitud_voluntario'
        $.get("form/gestion_voluntario/plantillas/funciones.php" ,{caso:caso,idusuario:idusuario, idsolicitud:idsolicitud, dictamen:dictamen}, function(resp){
            /*alert(resp)*/
           if (resp==1){
               if (dictamen == 1){
                    alert('La solicitud ha sido aceptada con éxito') 
               }else{
                   alert('La solicitud ha sido cancelada con éxito') 
               }
               b_func('tbl_solicitudes_voluntarios');
           }else{
               alert('Contacte al administrador del sistema') 
           }
        });
    }else{
        
    }
}
/******************************************************************************************/
/****************************Inscripcion de Voluntarios************************************/
/******************************************************************************************/
$("#inscribir_voluntario").click(function () {
    $('#contenedor').html("");
    $.post("form/gestion_voluntario/form_inscribir_voluntario.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
       b_func('tbl_inscribir_voluntario');
    });
});

$("#btn_inscribir_voluntario").click(function(){
    var volutarios = '' ;
    $('input[type=radio]').each(function () {
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            var select = (this.checked);
            if(select == true){
                volutarios = volutarios + ($(this).val()) + "," ;
            }
        }
    });
   
    var fin = volutarios.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
    volutarios = volutarios.substr(0, fin); // elimino la coma final
   alert (volutarios);
   if (volutarios == ""){
       alert("Debe seleccionar al menos una persona")
   }else{
        var caso = "inscribir_voluntario";
        $.get("form/gestion_voluntario/plantillas/funciones.php", {caso:caso, volutarios:volutarios}, function(resp){
           alert(resp);
            //console.log(resp);
            if(resp==11){
                b_func('tbl_inscribir_voluntario');
                alert("La persona se ha inscrito como voluntario ")
                
            }else{
                alert("Contacte al administrador del sistema")
            }
   });
   }
   
});

/********************************************************************************************************/
/****************************Creacion de actividades para Voluntarios************************************/
/********************************************************************************************************/

$("#crear_actividad_vol").click(function(){
    $.post("form/gestion_voluntario/form_crear_actividades_voluntarios.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
        b_func("tbl_actividades_voluntarios")
    });
});

/*Evento para guardar las actividades */
$("#btn_guardar_actividad_voluntario").click(function (){
    var caso1 = "insertar_doc";
    var dato = "";
    $("#form_actividades_voluntarios :input").each( function(){
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            var valor = ($(this).val())
            if(id == "archio_complementario"){
            }
            if(valor == ""){
                dato = "vacio"
                if(id == "archio_complementario"){
                dato = "lleno";
                }
            }
        }
    });
   
    if(dato == "vacio"){
        alert("Debe llenar los campos")
    }else{
        
        
         var caso = "crear_actividad_voluntario" ;
        var formData = new FormData($("#form_actividades_voluntarios")[0]);
        /*alert(JSON.stringify(formData))*/
                       var ruta = "./form/gestion_voluntario/plantillas/funciones.php?caso=crear_actividad_voluntario";
                       $.ajax({
                           url: ruta,
                           type: "POST",
                           data: formData,
                           contentType: false,
                           processData: false,
                           success: function(datos)
                           {
                            if(datos){
                                swal("¡Datos guardados exitosamente!", ":D" , "success");
                               // alert('Datos guardados exitosamente.');
                                $('#form_actividades_voluntarios').trigger("reset");//limpiar formulario                    
                                    //funcion para actualizar tabla donde se visualizan los campos ingresados
                                
                            }else{
                                alert('Ha ocurrido un error y no se pudo realizar su petición, por favor inténtelo nuevamente!');
                            }
                           }
                       });
    }
});

function asignar_actividad_voluntario(idvoluntario){
    $("#voluntario").val(idvoluntario);
    $("#destino_actividad_voluntarios").html("");
    $("#origen_actividades_voluntarios").html("");
    b_sm("origen_actividades_voluntarios") ;
    $("#asignar_actividad_voluntario").modal('toggle');  
}

function mover_actividad(valor,nombre){
    mover("origen_actividades_voluntarios", "destino_actividad_voluntarios", valor, nombre);
}
function quitar(valor,nombre){

    mover1("destino_actividad_voluntarios","origen_actividades_voluntarios", valor, nombre);
}
function mover(origen, destino)
{
      $("#" + origen + " option:selected" ).removeAttr('onclick');
      $("#" + origen + " option:selected" ).attr('onclick','quitar(this.value,this.id)');
      $("#" + origen + " option:selected" ).remove().appendTo("#" + destino);                      

}
function mover1(destino, origen)
{
    $("#" + destino + " option:selected" ).removeAttr('onclick');
    $("#" + destino + " option:selected" ).attr('onclick','mover_actividad(this.value,this.id);');
    $("#" + destino + " option:selected").remove().appendTo("#" + origen);

}

$("#cancelar_asuignar_form_revisor").click(function (){
    $("#asignar_actividad_voluntario").modal('toggle');
    $("#destino_actividad_voluntarios").html("");
});

$("#btn_asignar_actividad_voluntario").click(function(){
    var ids = "" ;
    var voluntario = $("#voluntario").val();
    
    $('#destino_actividad_voluntarios option').each(function(){
    ids += $(this).val() + ","; 
    });
    var fin = ids.length -1 ;
    ids = ids.substr(0, fin); 
    
    if (ids != ""){
        var caso = "asociar_tarea_voluntario";
        $.get("form/gestion_voluntario/plantillas/funciones.php", {caso:caso, actividad:ids, idvoluntario:voluntario}, function(resp){
            /*alert(resp)*/
           if(resp == 1 ){
               b_func("tbl_actividades_voluntarios")
               alert("La actividad ha sido asignada con éxito")
               $("#asignar_actividad_voluntario").modal('toggle'); 
           }else{
               alert("Contacte al administrador del sistema ")
           }
        });
    }else{
        alert("Debe seleccionar al menos una actividad")
    }
    
});


/********************************************************************************************************/
/****************************Responder Mensajes a Voluntarios********************************************/
/********************************************************************************************************/

$("#mensajes_voluntarios").click(function (){
    
    $('#contenedor').html("");
    $.post("form/gestion_voluntario/form_mensajes_voluntarios.php", {}, function (resp) {
        alert(resp);
        console.log(resp);
       $("#contenedor").html("");
     
       retorno(resp);
       incluirdiv('bandeja_mensajes_voluntario');
       
    });
});


/********************************************************************************************************/
/****************************Validar  Voluntarios *******************************************************/
/********************************************************************************************************/

$("#validar_voluntariado").click(function (){
    $('#contenedor').html("");
    $.post("form/gestion_voluntario/form_validar_voluntario.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
        b_func("tbl_validacion_voluntario") ;
    });
});

$("#btn_validar_voluntario").click( function (){
    var ids = " ";
    var datos = 0 ;
    $('#form_validar_voluntarios input[type=checkbox]').each(function () {
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            var select = (this.checked);
            if(select == true){
                if(id == "select_all"){
                    datos = 1 ;
                }else{
                }
               ids += ($(this).val()) + "," ;
            }
        }
    });
    
    if (datos == 1){
        ids = ids.substr(4); 
        var fin = ids.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
        ids = ids.substr(0, fin); // elimino la coma final
    }else{
        var fin = ids.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
        ids = ids.substr(0, fin); // elimino la coma final
    }
    
    if(ids != ""){
        var caso = 'validar_voluntario' ;
        $.get("form/gestion_voluntario/plantillas/funciones.php", {caso:caso, voluntarios:ids}, function(resp){ 
            /*alert(resp)*/
            if(resp == 1 ){
                b_func("tbl_validacion_voluntario") ;
                alert('Se han validado los voluntarios con éxito');
            }else{
                alert('Ha ocurrido un error y no se pudo realizar su petición, por favor inténtelo nuevamente!');
            } 
        });
    }else{
        alert("Debe seleccionar un al menos un volunturaio")
    }
});


function cambia(){
    $('#form_validar_voluntarios input[type=checkbox]').each(function () {
        var c = this.checked;
        $(':checkbox').prop('checked',c);
    });
    
    
}
