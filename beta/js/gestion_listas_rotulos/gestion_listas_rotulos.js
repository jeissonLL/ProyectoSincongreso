/* 
 * Gestion de listas y rotulos 
 * Brayan Triminio
 * 28/07/17
 */

function retorno(resp){ 
    $('#contenedor').html(resp);
}

$("#listados_actividad").click(function (){
    $.post("./form/gestion_listas_rotulos/form_generar_listas_actividad.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_listas_actividades');
    });   
});

  

$("#generar_lista").click(function(){
    var actividades = " " 
    $('input[type=radio]').each(function () {
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            var select = (this.checked);
            if(select == true){
                actividades +=  $(this).attr("id")+",";
            }
        }
        
    });
    
    if(actividades == " "){
        alert("Debe seleccinar al menos una actividad")
        return false;  
    }else{
        var fin = actividades.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
        actividades = actividades.substr(0, fin); // elimino la coma final
        $("#generar_lista").attr("href", "form/gestion_listas_rotulos/plantillas/listas_actividad.php?actividad="+actividades)
        
        var pdf_link = $(this).attr('href');
    
        /*alert(pdf_link)*/
        var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="500">No Support</object>'
        
        $.createModal({
            title:'Listas ',
            message: iframe,
            closeButton:true,
            scrollable:false
        });
        setTimeout(function(){
            $('#loader').remove();
        }, 5300);
    }
        return false;        
         
 
});

$("#rotulos_actividad").click(function(){
     $.post("./form/gestion_listas_rotulos/form_generar_rotulos_actividad.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_listas_actividades');
    });   
});

$("#generar_rotulo").click(function(){
    var actividades = " " 
    
    $('input[type=radio]').each(function () {
        var id = $(this).attr("id");
        if(typeof(id)  === "undefined"){
        }else{
            var select = (this.checked);
            if(select == true){
                actividades +=  $(this).attr("id")+",";
            }
        }
        
    });
    
    if(actividades == " "){
        alert("Debe seleccinar al menos una actividad")
        return false;  
    }else{
        var fin = actividades.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
        actividades = actividades.substr(0, fin); // elimino la coma final
        $("#generar_rotulo").attr("href", "form/gestion_listas_rotulos/plantillas/rotulos_actividad.php?actividad="+actividades)
        
        var pdf_link = $(this).attr('href');
    
        /*alert(pdf_link)*/
        var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="500">No Support</object>'
        
        $.createModal({
            title:'Rotulos por actividad ',
            message: iframe,
            closeButton:true,
            scrollable:false
        });
        return false;        
    
    }
});