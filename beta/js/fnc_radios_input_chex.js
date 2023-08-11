/**----ARCHIVO CON FUNCION DE LLENADO DE TODAS LOS SELECT MULTIPLES QUE ACOMPAÑAN LOS FORMULARIOS DE INGRESOS----*/
function b_ric(funcion)
{
   // alert('xvbxcb,bxcmvbm,xcbvmbxcmvbmnxcbmnxvm');
    $.post("./includes/fnc_radios_input_chex.php", {funcion:funcion},function(resp){dibuja_select(resp,funcion);})
}

function dibuja_select(html, funcion)
{
    //alert(html);
    $('#'+funcion).find('input').remove();
    $('#'+funcion).append(html);    
}
