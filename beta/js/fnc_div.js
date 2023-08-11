function dibuja_div(html, funcion)
{
  //  alert(html)
    $("#bandeja_mensajes").html("");
    $('#'+funcion).find('article').remove();
    $('#'+funcion).html("");
    $('#'+funcion).append(html);
}
function incluirdiv(funcion)
{   
    $.post("./includes/fnc_div.php", {funcion:funcion},function(resp){ 
        dibuja_div(resp,funcion);
    });    
}



