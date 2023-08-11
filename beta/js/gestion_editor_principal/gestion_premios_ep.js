/* 
 * Brayan Triminio 
 * 28/09/17
 * Gestión de Premios Editor principal 
 */

$("#gpremios_ep").click(function (){
   $('#contenedor').html("");
    $.post("form/gestion_editor_principal/form_gestion_premios_ep.php", {}, function (resp) {
       $("#contenedor").html("");
       retorno(resp);
       b_func('tbl_premio_a_trabajo');
       
    });
});

function asig_premio_trabajo(){
    var caso = "";
    var idpremios = "" ;
    console.log(arguments);
    
    var valores = (arguments);
    var idtematica = valores[valores.length-1];
    
    for(var i = 0; i<valores.length-1;i++){
        idpremios +=(valores[i])+ ",";
    }
    var fin = idpremios.length -1 ;
    idpremios = idpremios.substr(0, fin); 
        
    
    $("#destino_premio").html("");
    var caso = 'origen_premios';
    $.post("./includes/fnc_select_multiple.php", {funcion:caso, idtematica:idtematica, idpremios:idpremios},function(resp){dibuja_select1(resp,caso);})
    trabajos(idtematica);
        
    $('#premio_trabajo').modal({
        show: 'true'         
    }); 
}

function dibuja_select1(html, funcion)
{
    $('#'+funcion).find('option').remove();
    $('#'+funcion).append(html);    
}

function trabajos(idtematica){
    var caso = 'tabajos_tematica';
    $.post("./includes/fnc_div.php", {funcion:caso, idtematica:idtematica},function(resp){dibuja_div(resp,caso);})
}

function agregar_premio(valor,nombre){
    mover_premio("origen_premios", "destino_premio", valor, nombre);
}
function quitar_premio(valor,nombre){
    mover_premio1("destino_premio","origen_premios", valor, nombre);
}
function mover_premio(origen, destino)
{
    $("#" + origen + " option:selected" ).removeAttr('onclick');
    $("#" + origen + " option:selected" ).attr('onclick','quitar_premio(this.value,this.id)');
    $("#" + origen + " option:selected" ).remove().appendTo("#" + destino);                      

}
function mover_premio1(destino, origen)
{
    $("#" + destino + " option:selected" ).removeAttr('onclick');
    $("#" + destino + " option:selected" ).attr('onclick','agregar_premio(this.value,this.id);');
    $("#" + destino + " option:selected").remove().appendTo("#" + origen);

}


$("#btn_asociar_premio_trabajo").click(function(){
    var idspremios = "";
    var idstrabajos = "";
    
    $("#destino_premio option").each(function(){
        idspremios += $(this).val() + ",";
    });
    
    $("#tabajos_tematica input[type=radio]").each(function(){
        var select = (this.checked);
        if(select==true){
            idstrabajos = ($(this).val())
        }else{
            idstrabajos = "";
        }
    });
    
    var fin = idspremios.length -1 ;
    idspremios = idspremios.substr(0, fin); 
    
    if(idstrabajos == ""){
        alert("Debe seleccionar un trabajo")
    }else if(idspremios == ""){
        alert("Debe seleccionar al menos un premio")   
    }else{
        var caso = 'asignar_premio_trabajo';
        $.post("form/gestion_editor_principal/plantillas/funciones.php", {caso:caso, premios:idspremios, trabajo:idstrabajos}, function (resp) {
           if(resp == 1){
               alert("El premio se ha asignado con éxito ")
               b_func('tbl_premio_a_trabajo');
                $('#premio_trabajo').modal("toggle");
           }else{
                alert('Ha ocurrido un error y no se pudo realizar su petición, por favor inténtelo nuevamente!');
           }
        });
    }
    
});

$("#cancelar_asociar_pre_trab").click(function(){
    $('#premio_trabajo').modal('toggle');
});

$("#cancelar_pre_auto").click(function(){
    $('#premio_automatico').modal('toggle');
});

/**********************************************************Asignación Automática******************************************************************************/
function asignacion_automatica(){
    $("#tabajos_tematica_auto").html("");
    var valores = (arguments);
    var idpremios = "" ;
    console.log(arguments);
    
    var valores = (arguments);
    var idtematica = valores[valores.length-1];
    
    for(var i = 0; i<valores.length-1;i++){
        idpremios +=(valores[i])+ ",";
    }
    var fin = idpremios.length -1 ;
    idpremios = idpremios.substr(0, fin); 
    
    var caso1 = 'premios_tematica_auto';
    $.post("./includes/fnc_div.php", {funcion:caso1, idtematica:idtematica, idpremios:idpremios},function(resp){dibuja_div(resp,caso1);})
    
    var caso = "premios_automaticos";
    $.post("form/gestion_editor_principal/plantillas/funciones.php", {caso:caso, idtematica:idtematica}, function (resp) {
            $("#tabajos_tematica_auto").append(resp);
        });
    
    $('#premio_automatico').modal({
        show: 'true'         
    }); 
}

$("#btn_asociar_premio_auto").click(function(){
    var seleccionados = "";
    $("#premios_tematica_auto input[type=checkbox]").each( function (){
        var select = (this.checked);
        if(select == true){
            seleccionados += $(this).val() + ",";
        }
    });
    
    var idtrabajo = $("#trabajo_auto").val();
    
    var fin = seleccionados.length -1 ;
    seleccionados = seleccionados.substr(0, fin);
    
    if (seleccionados == ""){
        alert("Debe seleccionar al menos un premio")   
    }else{
        var caso = 'asignar_premio_trabajo';
        $.post("form/gestion_editor_principal/plantillas/funciones.php", {caso:caso, premios:seleccionados, trabajo:idtrabajo}, function (resp) {
           if(resp == 1){
               alert("El premio se ha asignado con éxito ")
               b_func('tbl_premio_a_trabajo');
                $('#premio_automatico').modal("toggle");
           }else{
                alert('Ha ocurrido un error y no se pudo realizar su petición, por favor inténtelo nuevamente!');
           }
        });
    }
       
});