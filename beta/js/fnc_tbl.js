/**----ARCHIVO CON FUNCION DE LLENADO DE TODAS LAS TABLAS QUE ACOMPAÑAN LOS FORMULARIOS DE INGRESOS----
 * 
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */
function b_func(funcion)
{
    $.post("./includes/fnc_tbl.php", {funcion:funcion},function(resp){dibuja_tbl(resp,funcion);})
}

function dibuja_tbl(html, funcion)
{
    
    $('#'+funcion).find('tbody').remove();
    $('#'+funcion).append(html); 
}




