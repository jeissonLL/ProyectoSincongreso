/**--------
 * 
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */
function retorno(resp){ 
    $('#contenedor').html(resp);
$(document).ready(function () {
   $.post("./form/estadisticas/funciones.php", {}, function (resp) {
       var data = JSON.parse(resp);
//       alert(data.total_trabajos)
       $('#div_total_trabajos').html(data.total_trabajos);
       $('#div_total_registrados').html(data.total_usuarios);
       $('#div_total_taceptados').html(data.total_aceptados);
       $('#div_total_trechazados').html(data.total_rechazados);       
               $('#total_trabajos').circliful();
               $('#total_resgistros').circliful();
               $('#total_taceptados').circliful();
               $('#total_trechazados').circliful();
    });  
});   
}

$("#submenu_gestadisticas_trabajos").click(function (){
   $.post("./form/estadisticas/estadisticas.php", {}, function (resp) {   
       $('#contenedor').html("");
       retorno(resp);
    });   

    
});
