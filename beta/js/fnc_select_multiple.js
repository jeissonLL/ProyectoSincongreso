/**----ARCHIVO CON FUNCION DE LLENADO DE TODAS LOS SELECT MULTIPLES QUE ACOMPAÑAN LOS FORMULARIOS DE INGRESOS----*/
function b_sm(funcion)
{
    //alert('xvbxcb,bxcmvbm,xcbvmbxcmvbmnxcbmnxvm');
    $.post("./includes/fnc_select_multiple.php", {funcion:funcion},function(resp){dibuja_select(resp,funcion);})
}

function dibuja_select(html, funcion)
{
    //alert(html);
    $('#'+funcion).find('option').remove();
    $('#'+funcion).append(html);    
}




