/**----ARCHIVO CON FUNCIONES ESPECIFICAS PARA LA GESTION DE ROLES EN CONGRESOS----
 * 
 * @author José L. Rodríguez G.
 * @copyright 2017
 * @version 1
 */

$("#sol_revision").click(function (){
   $.post("./form/gestion_roles/form_gestion_roles.php", {}, function (resp) {     
       $('#contenedor').html("");
       retorno(resp);
    });   
});

    function retorno(resp){ 
        $('#contenedor').html(resp);
    }

$(document).on("click", "a", function(){
    var href = ($(this).attr('href'));

    if ((href === '#s_revision')||(href === '#irevisores')||(href === '#ieditores_gestores')||(href === '#ieditores_principales')||(href === '#ieditores_pseccion')||(href === '#ieditores_sseccion')||(href === '#iencargado_programa')||(href === '#iencargado_vol'))
    {
        mostrar_tabs(href);
    }
});
    function mostrar_tabs(href){
            $('#tbl_intereses').hide();
            $('#tematica').hide();

        $.post("./includes/fnc_tabs.php", {href:href}, function (resp) {
                $(href).addClass("active");
//                alert(resp);
                $('#tbl_'+href.substr(1)).find('tbody').remove();
                $('#tbl_'+href.substr(1)).append(resp);      
            });    
    }
    function gestion_rol(idusuario,rol){
        $.post("./includes/fnc_tbl.php", {funcion:'tbl_tematica',idusuario:idusuario,rol:rol}, function (resp) {    
            $('#intereses_revisor').addClass("active");
            $('#tbl_intereses').show();
            $('#rowinscri').show();        
            $('#tbl_intereses').find('tbody').remove();
            $('#tbl_intereses').append(resp);   
//            if()
            exis_tematica(idusuario,rol);        
        });      
    }
    
    function inscribir_rol(idusuario,rol)
    {
        $.post("./form/gestion_roles/plantillas/funciones.php", {funcion:'inscribir_rol',idusuario:idusuario,rol:rol}, function (resp) {     
//            alert(resp)
            if(resp == "-1")
            {
                alert("Tenemos un problema, intentelo luego");
            }else{
                alert("Inscripción procesada con exito.");
                $('#usuario'+idusuario).closest('tr').remove();
// alert(('#usuario'+idusuario))              
            }
        });
    }

    function exis_tematica(idusuario,rol){

        $.post("./form/gestion_roles/plantillas/funciones.php", {funcion:'exis_tematica',idusuario:idusuario,rol:rol}, function (resp) {     
            if(resp !== "")
            {
                var arr =JSON.parse(resp);
                $.each(arr, function( index, value ) {
//                        alert( index + ": " + value );
                      $('#'+value).closest('tr').remove();  
                  });                      
            }
        });
    }

    function intereses(idsol){
        var href='interes';
            $('#tbl_intereses').show();
            $('#tematica').hide();    
        $.post("./includes/fnc_tabs.php", {href:href,idsol:idsol}, function (resp) {     
            $('#intereses_revisor').addClass("active");
            $('#tbl_intereses').find('tbody').remove();
            $('#tbl_intereses').append(resp);   

        });    
    }

    function aceptar_solicitud(idsol){
        var funcion='aceptar_solicitud';
        $.post("./form/gestion_roles/plantillas/funciones.php", {funcion:funcion,idsol:idsol}, function (resp) { 
    //        alert(resp)
//            console.log(resp)
            if(resp == "-1")
            {
                alert("Tenemos un problema, intentelo luego");
            }else{
                alert("Solicitud procesada con exito.");
                mostrar_tabs("#s_revision");
            }
        });    

    }
    function rechazar_solicitud(idsol){
        var funcion='rechazar_solicitud';
        $.post("./form/gestion_roles/plantillas/funciones.php", {funcion:funcion,idsol:idsol}, function (resp) { 
    //        alert(resp)
//            console.log(resp)
            if(resp == "-1")
            {
                alert("Tenemos un problema, intentelo luego");
            }else{
    //            $.Notification.notify('success','right middle','@@notificacion@@', '@@proceso_exitoso@@');
                alert("Solicitud procesada con exito.");
                mostrar_tabs("#s_revision");
            }
    });
    }

    function inscribir_tematica(tematica,idusuario,rol){
        var funcion = 'inscribir_rol_tematica';
        $.post("./form/gestion_roles/plantillas/funciones.php", {funcion:funcion,idusuario:idusuario,tematica:tematica,rol:rol}, function (resp) {
            if(resp == "-1")
            {
                alert("Tenemos un problema, intentelo luego");
            }else{
                alert("Solicitud procesada con exito.");
                $('#'+tematica).closest('tr').remove();
            }
        });        

    }