/**----ARCHIVO CON FUNCION DE LLENADO DE TODAS LAS TABLAS QUE ACOMPAÑAN LOS FORMULARIOS DE INGRESOS----
 * 
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */
$(document).ready(function(){
    $( "select" ).each(function() {
      var id=$(this).attr("id");       
      $("#"+id).load('./includes/fnc_slc.php?id='+id);
     });
});

