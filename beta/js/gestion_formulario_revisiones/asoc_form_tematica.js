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
$("#asociar_formulario").click(function (){
   $.post("./form/gestion_formulario_revisiones/form_asoc_form_tematica.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       retorno(resp);
       b_func('tbl_form_tem');
       b_sm('origen_tematica');
    });   
});


function asociar_tematica(id){
    $("#formulario").val(id);
    var form = $("#formulario").val();
    $("#tematica_form").modal();
    var tem_ya_asociadas = $("#bracho"+form).val();
    var opciones = tem_ya_asociadas.split("<>");
    var contar= opciones.length -1  ; 
    if (contar == 0){
    }else{
        for (var i=0; i<contar; i++){
            $('#origen_tematica').find('option[value='+opciones[i]+']').remove().end();   
        }
    }
    
    
}

function guardar(){
    
    var caso = $("#caso").val();
    var idform= $("#formulario").val();
    var tematicas = '';
    $('select option:checked').each(function(){
    tematicas += $(this).val() + ','; 
    });
    var fin = tematicas.length - 1; // calculo cantidad de caracteres menos 1 para eliminar la coma final
    tematicas = tematicas.substr(0, fin); // elimino la coma final
    //alert(tematicas)
    if (tematicas == ""){
        alert("no puede estar vacio")
        
    }else{
        $.post("./includes/querys.php?caso="+caso,{tematicas:tematicas,idform:idform,},function(resp){
            if (isNaN(resp)){
                alert("Actualmente estamos presentado problemas contacte al administrador")
            }else{
                alert("Se ha asocidado con éxito")
             
            }
            $('#tematica_form').modal('toggle');
            $('#buscar').val("");
            b_func('tbl_form_tem');
            b_sm('origen_tematica');
            $('#destino_tematica').find('option').remove().end(); 
    
    });
    }
    
    
}