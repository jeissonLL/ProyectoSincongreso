/* 
 * Brayan Triminio
 * Gestion de los usuarios con el rol editor pricipal de seccion  
 * 06/07/2017
 */

$("#gtrabajos_ess").click(function (){
   $.post("./form/gestion_editor_secundario_seccion/gestion_trabajos_ess.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_trabajos_ess');
       b_sm('origen_todos_revisores');
    }); 
    
});


function modal_ess(){
    $('#destino_revisores_ess').html("");
   var revisores = " ";
    console.log(arguments);
    var valores = (arguments);
    var ids =(arguments.length); /*ids de los usuarios revisores*/
     for (var i=0; i<ids; i++){
         $("#trabajo_a_revisor").val(valores[0]);
         /*alert(valores[i])*/
         if(i>0){
             revisores  = revisores + valores[i] + ","  ;
         }
     }
    var fin = revisores.length - 1; /* calculo cantidad de caracteres menos 1 para eliminar la coma final*/
    revisores = revisores.substr(0, fin); /* elimino la coma final*/
    
    var funcion = 'origen_todos_revisores' ;
    $("#destino_revisores").html('');
    $.post("./includes/fnc_select_multiple.php", {funcion:funcion},function(resp) {dibuja_select(resp,funcion);})
    
    function dibuja_select(html, funcion){
        if (html == ''){
            $('#'+funcion+"_ess").html('origen_todos_revisores');
            $('#'+funcion+"_ess").append('<optgroup label="No hay revisores de para esta tematica ">    </optgroup> ');     
        }else{
            $('#'+funcion+"_ess").find('option').remove();
            $('#'+funcion+"_ess").append(html);     
        }
    }
    $('#asignar_revisores_trabajo').modal('toggle');    
}

$("#btn_asignar_revisoress").click( function(){
    var caso = $("#caso").val();
    var idtrabajo= $("#trabajo_a_revisor").val();
    var ids = '';
    $('#destino_revisores_ess option:selected').each(function(){
    ids += $(this).val() + ","; 
    });
   /* alert(idtrabajo)*/
    if(ids.length <= 0 ){
        alert("Debe seleccionar al menos un revisor")
    }else{
        var fin = ids.length - 1; /* calculo cantidad de caracteres menos 1 para eliminar la coma final*/
        ids = ids.substr(0, fin); /* elimino la coma final*/
        /*alert(ids)*/
        $.post("./includes/querys.php?caso="+caso,{revisores:ids,idtrabajo:idtrabajo,},function(resp){
          /*alert(resp)*/
            if(resp == 1){
                alert("Se ha asigando con éxito el trabajo a los revisores  ")
                $('#asignar_revisores_trabajo').modal('toggle');
                $('#buscar').val("");
                /*$("#lineas_investigacion").trigger("change");*/
                b_func('tbl_trabajos_ess');
                $('#destino_revisores_ess').html("");
            }else{
            
            }
        });
    }
});


function modalcancelarsolicitud_ess(){
    $.each($('#origen_todos_revisores  option'),function(){ 
        $(this).attr("onclick", "agregar1(this.value, this.id)");
    });
    
    var valores = (arguments);
    var ids =(arguments.length); /*ids de los usuarios revisores*/
   /*- */
    for (var i=1; i<ids; i++){
        $("#cancelar_a_revisor").val(valores[0]);
        /*var trabajo = $("#trabajo_a_revisor").val();*/
        if(valores[i] > 0 ){
            $.each($('#origen_todos_revisores  option'),function(){
               var valor = $(this).val();
              if (valor ==valores[i] ){
               var id = $(this).attr("id");
               $('#origen_todos_revisores').find('option[id='+id+']').prop('selected',true).trigger('click');
              }else{
               
              }
             });
        }
    }
    $("#origen_todos_revisores").html('');
    $('#cancelar_solicitud_revisor_ess').modal('toggle');
}

$("#btn_cancelar_revisor_ess").click(function(){
    var idtrabajo = $("#cancelar_a_revisor").val();
    var caso  = $("#caso1").val();
    var ids= "";
    $('#cancelar_revisores_ess option').each(function(){
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
            $('#cancelar_solicitud_revisor_ess').modal('toggle');
            $('#buscar').val("");
            b_func('tbl_trabajos_ess');
            $('#cancelar_revisores_ess').html("");
            
           
            }
        });
    }
});