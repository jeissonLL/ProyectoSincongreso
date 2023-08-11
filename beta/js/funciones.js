/**----ARCHIVO CON FUNCIONES GENERALES ----
 * @copyright 2017
 * @version 1
 */

function inicializar_var_session(valor)
{
    var variable = $("#var").val();
//    alert(variable);
    $.post("./includes/funciones.php?funcion=select_idioma", {variable:variable, valor:valor},function(resp){dibuja_var_session(resp);})

}
function dibuja_var_session(resp)
{
    if(resp == 0)
    {
        $(location).attr('href','./login.php');
    }
}
