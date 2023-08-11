/* 
 * Brayan Triminio
 * Visualizaciòn de noticias por el asistente 
 * 27/07/2017
 */

$("#ver_noticias").click(function(){
    $.post("./form/gestion_noticias/form_ver_noticias.php", {}, function (resp) {     
       console.log(resp);
       $('#contenedor').html("");
       incluirdiv('ver_noticia');
       incluirdiv('congreso_noticia');
       retorno(resp);
        
    });   
});
