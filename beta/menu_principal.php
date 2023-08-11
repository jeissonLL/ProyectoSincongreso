<?php
    session_start();
include_once './funciones/funcion_validaciones.php';
   $veri_tiempo = veri_tiempo();
//   print_r($_SESSION['hoy']);
if(!isset($_SESSION['nusuario']) || ($veri_tiempo == 0))
{
    header('Location: index.php');
}else{
    $_SESSION['idm'] = 'idiomas/'.$_SESSION["idioma"].'/'.$_SESSION["idioma"].'.php';
    require 'funciones/funcion_traducir.php';
    //Traduciendo las páginas a utilizar
    $header = traducir('includes/header_start.php', $_SESSION['idm']);
    $index = traducir('inicio.php', $_SESSION['idm']);
    $footer_start = traducir('includes/footer_start.php', $_SESSION['idm']);

    echo $header;

    require 'includes/header_end.php';

    echo $index;
    echo $footer_start;
?>
<!--   Script para Congresos  -->
<script src="./js/gestion_congresos_js/congresos_activos.js" type="text/javascript"></script>

<!-- Modal-Effect -->

<script src="../plugins/notifyjs/dist/notify.min.js"></script>
<script src="../plugins/notifications/notify-metro.js"></script>
<!--   Script para Certificados  -->
<script src="./js/gestion_certificados_js/c_certificados.js" type="text/javascript"></script>

<!--   Script para Perfil  -->
<script src="./js/perfil.js" type="text/javascript"></script>

<!--   Script para Gestión de Roles  -->
<script src="./js/gestion_roles/gestion_roles.js" type="text/javascript"></script>

<!--   script para subir trabajos  -->
<script src="./js/gestion_trabajos/form_subir_trabajos.js" type="text/javascript"></script>
<!--   script grales para llenado de elementos en el form  -->

<!--script de administracion de trabajos de editor gestor-->
<script src="./js/gestion_editor_gestor/form_trabajos_revision.js" type="text/javascript"></script>
<!--script de administracion de trabajos de editor gestor-->

<!--script de gestion de programa-->
<script src="./js/gestion_programa/gestion_programa.js" type="text/javascript"></script>
<!--script de gestion de programa-->

<!--   script  para la creación de formularios   -->
<script src="../plugins/bootstrap-wizard/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="../plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="./js/gestion_formulario_revisiones/form_crear_formulario.js" type="text/javascript"></script>
<script src="./js/gestion_formulario_revisiones/asoc_form_tematica.js" type="text/javascript"></script>
<script src="./js/gestion_formulario_revisiones/modificar_form_revision.js" type="text/javascript"></script>
<!--   fin script  para la creación de formularios   -->

<!--script de administracion del editor principal-->
<script src="./js/gestion_editor_principal/gestion_trabajos_ep.js" type="text/javascript"></script>
<script src="./js/gestion_editor_principal/gestion_premios_ep.js" type="text/javascript"></script>
<!--script de administracion del editor principalr-->

<!--script de administracion del editor principal de seccion -->
<script src="./js/gestion_editor_principal_seccion/gestion_trabajos_eps.js" type="text/javascript"></script>
<!--script de administracion del editor principal de seccion -->

<!--script de administracion del editor secundario de seccion -->
<script src="./js/gestion_editor_secundario_seccion/gestion_trabajos_ess.js" type="text/javascript"></script>
<!--script de administracion del editor secundario de seccion -->

<!--script gestion de revisiones  -->
<script src="./js/gestion_revisiones/solicitudes_de_revision.js" type="text/javascript"></script>
<!--script gestion de revisiones -->

<!--script gestion de asistente visualizar programa  -->
<script src="./js/gestion_asistente/form_consultar_programa.js" type="text/javascript"></script>
<!--script gestion de asistente visualizar programa  -->

<!--script gestion de programa  -->
<script src="./js/gestion_programa/gestion_programa.js" type="text/javascript"></script>
<script src="./js/gestion_programa/descargar_programa.js" type="text/javascript"></script>
<script src="./js/gestion_programa/jquery.table2excel.min.js" type="text/javascript"></script>
<!--script gestion de programa  -->

<!--script gestion de noticias  -->
<script src="./js/gestion_noticias/ver_noticias.js" type="text/javascript"></script>
<!--script gestion de noticias  -->

<!--script gestion de listas/rotulos  -->
<script src="./js/gestion_listas_rotulos/gestion_listas_rotulos.js" type="text/javascript"></script>
<!--script gestion de listas/rotulos  -->

<!-- Scripts de la sección de mensajería -->
<script src="./js/fnc_div.js" type="text/javascript"></script>
<!--<script src="./js/gestion_traducciones_js/mensajeria.js" type="text/javascript"></script>-->
<!--<script src="./js/gestion_traducciones_js/matriz_idiomas.js" type="text/javascript"></script>-->
<!--<script src="./js/gestion_traducciones_js/traducciones.js" type="text/javascript"></script>-->

<!-- Scripts de gestión de congresos -->


<!-- Scripts de la gestion  de voluntario-->
<script src="./js/gestion_voluntarios/gestion_voluntarios.js"></script>
<!-- Scripts de la gestion  de voluntario-->

<!-- Scripts de voluntarios-->
<script src="./js/voluntarios/voluntarios.js"></script>
<!-- Scripts de voluntarios-->

<!-- Scripts de factura-->
<script src="./js/gestion_mantenimiento_factura/mantenimiento_factura.js"></script>
<!-- Scripts de factura-->

<!-- Script de conexiones a funciones PHP -->
<script src="./js/fnc_select_multiple.js" type="text/javascript"></script>
<script src="./js/fnc_tbl.js" type="text/javascript"></script>
<script src="./js/fnc_radios_input_chex.js" type="text/javascript"></script>

<!-- Counter Up  -->
<script src="../plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="../plugins/counterup/jquery.counterup.min.js"></script>

<!-- circliful Chart -->
<script src="../plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
<script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- skycons -->
<script src="../plugins/skyicons/skycons.min.js" type="text/javascript"></script>

<!-- Estadísticas-->
<script src="./js/estadisticas/estadisticas.js"></script>
<!-- Scripts de la gestion  de voluntario-->


<!-- Page js  -->
<script src="assets/pages/jquery.dashboard.js"></script>
<!--<script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>-->

<form class="form-horizontal m-t-20" id="form_info_req" name="form_info_req" method="POST"> 
            <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
                            <h4 class="modal-title">@@informacion_requerida@@</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                
                                <div class="form-group">
                                    <div class="col-xs-12">
                                            <select id="tpersona" name="tpersona" class="form-control input-sm" >
                                                <option value="">@@tipo_persona@@</option>
                                             </select>             
                                        <i class="md md-accessibility form-control-feedback l-h-34"></i>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-xs-12" id="div_institucion" style="display:none;">
                                            <select id="institucion" name="institucion" class="form-control input-sm"  >
                                                <option value="">@@institucion@@</option>
                                             </select>             
                                        <i class="md md-accessibility form-control-feedback l-h-34"></i>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@cerrar@@</button>-->
                                 <button class="btn btn-primary btn-custom waves-effect waves-light w-md" type="submit" id="bt_update">@@guardar@@</button>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal -->
</form>







<script type="text/javascript">
    $(document).ready(function ($) {
        $.getScript("./js/fnc_slc.js");
        $.getScript("./js/dinamica.js");
//        
        $("#contenedor").html("");

        $.post("./includes/funciones.php?funcion=congresos",{}, function (resp){
        $("#contenedor").html(resp); 
        })


        $.post("./includes/funciones.php?funcion=veri_info",{}, function (resp){
         if(resp == '1' )
         {
             $('#con-close-modal').modal({backdrop: 'static', keyboard: false})
//           $("#con-close-modal").modal('show');    
         }
        })
    });
    
var img = $('#img').val();
var nusuario = $('#nusuario').val();
var anio = $('#copia').val();
$("#img_users").attr("src",img);
$("#user").html(nusuario);
$("#anio").html(anio);
    // BEGIN SVG WEATHER ICON
    if (typeof Skycons !== 'undefined') {
        var icons = new Skycons(
                {"color": "#3bafda"},
                {"resizeClear": true}
        ),
                list = [
                    "clear-day", "clear-night", "partly-cloudy-day",
                    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                    "fog"
                ],
                i;

        for (i = list.length; i--; )
            icons.set(list[i], list[i]);
        icons.play();
    }
$("#perfil").click(function (){
   $.post("form/perfil.php", {}, function (resp) {        
       $('#contenedor').html("");
       $('#contenedor').html(resp);
       $.getScript("./js/fnc_slc.js");  
       perfil();  
       congresos_perfil();
    });  
  
});

$("#tpersona").change(function(){
    var tpersona=$("#tpersona").val();
//a
    $("#div_institucion").removeAttr("style");
    $.post("./includes/funciones.php?funcion=tpersona",{tpersona:tpersona},function(resp){
        $("#institucion").html("");
        $("#institucion").html(resp);
     })
})

$("#gtraductores").click(function () {
    $('#contenedor').html("");
    $.post("./form/gestion_traducciones_php/solicitudes_traductores.php", {}, function (resp) {
       $("#contenedor").html("");
//       $.getScript("./js/gestion_solicitudes/traductores.js"); 
       retorno(resp);
    });
});
$("#solicitud").click(function (){
   $.post("form/solicitud.php", {}, function (resp) {    
       $('#contenedor').html("");
       $('#contenedor').html(resp);
    });  
  
});

function congresos_perfil(){
    $("#congresos").html("");
    $.post("./includes/funciones.php?funcion=congresos_perfil",{}, function (resp){
    $("#congresos").html(resp);
    });
//alert($("nusuario").val());
}
function ambiente(idcongreso){
    $("#congresos").html("");
    $.post("./includes/funciones.php?funcion=ambiente",{idcongreso:idcongreso}, function (resp){
    $("#menu_gtrabajos").show();
    $("#menu_congresos_actvos").show();    
    
    
    var datos = JSON.parse(resp);
    
    
    
    $("#congreso_nombre").html(datos.siglas);
    $(".page-title").html(datos.nombre_congreso);
    $("#contenedor").html();
    $("#contenedor").html(datos.lema);
    
    var rolesxusuario = datos.rol;
    var separacion = JSON.stringify(rolesxusuario);
    $('#rol').val(separacion);
    var se =  separacion.split(",");
    var contar = se.length ;
    var id = []; 
    for(var i= 0; i<contar; i++){
        // alert(id[i])
        if (i == 0){
            id[i] = se[i].substring(2,4);
            //alert(id[i])
            if(isNaN(id[i])){
               // alert("No es un numero")
            id[i]= id[i].substr(0, 1);
            }
            roles(id[i])
            
        }else{
            id[i]  =  se[i].substring(1,3) ;
            if(isNaN(id[i])){
              //  alert("No es un numero222")
            id[i]= id[i].substr(0, 1);
            }
            roles(id[i])
        }
    }
    
    });
}

function roles(id){
//alert(id)
 if(id == 1){//Administrador 
    $('#sidebar-menu li ').each(function() {
    $(this).removeAttr("style");
    });
    $("#asistencia_voluntario").removeAttr("style");
    $("#validar_pres_autores").removeAttr("style");
    $("#actividades_voluntario").removeAttr("style");
    $("#mensajes_voluntario").removeAttr("style");
    $("#menu_voluntarios").removeAttr("style");
    $("#pagos_voluntarios").removeAttr("style");
    $("#menu_groles").removeAttr("style");
    $("#congresos_activos").removeAttr("style");
    $("#gestionar_linea_investigacion").removeAttr("style");
    $("#gestionar_tematicas").removeAttr("style");
    $("#crear_congreso").removeAttr("style");
    $("#asociar_administrador_congreso").removeAttr("style");
    $("#c_certificados").removeAttr("style");
    $("#generar_certificados").removeAttr("style");
    $("#menu_traducciones").attr("style", "display:none");
    
 }else if(id == 2){// Participante
     /*Asistente*/
      $("#menu_gasistente").removeAttr("style");
      $("#menu_congresos").removeAttr("style");
      $("#congresos_activos").removeAttr("style");
      $("#menu_traducciones").attr("style", "display:none");
     /*Asistente*/
 }else if(id == 3){ //Ponente
     $("#menu_gtrabajos").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
 }else if(id == 4){//Autor
     $("#menu_gtrabajos").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     
 }else if(id == 5){//Voluntario 
     $("#menu_gtrabajos").attr("style", "display:none");
     $("#menu_voluntarios").removeAttr("style");
     $("#generar_certificados").removeAttr("style");
     $("#menu_gcertificados").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#asistencia_voluntario").removeAttr("style");
     $("#validar_pres_autores").removeAttr("style");
     $("#actividades_voluntario").removeAttr("style");
     $("#mensajes_voluntario").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
 }else if(id == 6){//Revisor
      /*Revisor*/ 
     $("#menu_grevisor").removeAttr("style");
     $("#generar_certificados").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     //$("#menu_gtrabajos").attr("style", "display:none");
     /*Revisor*/
     
 }else if(id == 7){//Editor Gestor 
      $("#menu_geditor_gestor").removeAttr("style");  
      $("#generar_certificados").removeAttr("style");
      $("#menu_gcertificados").removeAttr("style");
      $("#menu_congresos").removeAttr("style");
      $("#congresos_activos").removeAttr("style");
      $("#menu_traducciones").attr("style", "display:none");
      
 }else if(id == 8){// Editor principal de sección
     $("#menu_edicion").removeAttr("style");
     $("#submenu_menu_geditor_p_seccion").removeAttr("style");
     $("#menu_geditor_p_seccion").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     
 }else if(id == 9){//Editor secundario de sección 
     $("#menu_edicion").removeAttr("style");
     $("#submenu_menu_geditor_s_seccion").removeAttr("style");
     $("#geditor_s_seccion").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     
 }else if(id == 10){
     /*Edtor principal*/
     $("#menu_edicion").removeAttr("style");
     $("#submenu_menu_geditor_principal").removeAttr("style");
     $("#menu_geditor_principal").removeAttr("style");
     $("#generar_certificados").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     /*Editor princiapl  $("#menu_geditor_principal").removeAttr("style");
     $("#menu_congresomenu_geditor_principals").removeAttr("style");
     $("#congresos_activos").removeAttr("style");*/
            
 }else if(id == 11){// Encargado de programa
     $("#menu_gprograma").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     
 }else if(id == 12){//Encargado de voluntarios
     $("#menu_gvoluntarios").removeAttr("style");
     $("#menu_gtrabajos").attr("style", "display:none");
     $("#menu_traducciones").removeAttr("style");
     $("#menu_congresos").removeAttr("style");
     $("#congresos_activos").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     
 }else if(id == 13){//Cajero
     $("#menu_gtrabajos").attr("style", "display:none");
     $("#menu_voluntarios").removeAttr("style");
     $("#pagos_voluntarios").removeAttr("style");
     $("#menu_traducciones").attr("style", "display:none");
     
 }
 
 
}
 function perfil(){ 
//        $.getScript("./js/fnc_slc.js");  
        $.getScript( "./js/dinamica.js", function() {
                $.post("./includes/conductor_persona.php?formulario=perfil",{},
                        function(resp){
                           var datos = JSON.parse(resp);
                            $("#nombre_usuario").html(datos.nombre_usuario);
                            $("#nombre_user").val(datos.nombre_usuario);
                            $("#nombre_completo").html(datos.primer_nombre+' '+datos.primer_apellido)
                            $("#telefono_principal").html(datos.numero_telefono);
                            $("#correo_electronico").html(datos.correo.cprincipal);
                            $("#nombre_pais").html(datos.nombre_pais);
                            $("#nombres").val(datos.primer_nombre+' '+datos.segundo_nombre);
                            $("#apellidos").val(datos.primer_apellido+' '+datos.segundo_apellido);
                            $("#tprincipal").val(datos.numero_telefono);
                            $("#cprincipal").val(datos.correo.cprincipal);
                            $("#nusuario").val(datos.nombre_usuario);
                            $("#pais option[value="+datos.id_pais_pk+"]").attr("selected","selected");
                            $("#pais").val(datos.id_pais_pk);
                            $("#hpais").val(datos.id_pais_pk);
                            $("#idioma").val(datos.id_idioma_pk);
                            $("#idioma option[value="+datos.id_idioma_pk+"]").prop("selected","selected");
                            $("#hidioma").val(datos.id_idioma_pk);
                            $("#tidentificacion").val(datos.id_tipo_identificacion_pk);
                            $("#htidentificacion").val(datos.id_tipo_identificacion_pk);
                            $("#identificacion").val(datos.identificacion);
                            $("#talimentacion").val(datos.id_tipo_alimentacion_pk); 
                            $("#htalimentacion").val(datos.id_tipo_alimentacion_pk); 
                           if(($("#pais").val()== null) || ($("#idioma").val()== null) || ($("#tidentificacion").val()== null) || ($("#talimentacion").val()== null))
                            {
                                $("#pais").val(datos.id_pais_pk);
                                $("#talimentacion").val(datos.id_tipo_alimentacion_pk); 
                                $("#tidentificacion").val(datos.id_tipo_identificacion_pk);
                                $("#pais").val(datos.id_pais_pk);
                            }  
                            $("#img_user").attr("src",datos.img_usuario);  
                            $("#contrase").attr("src",datos.contrase);  
                            
                            
                        });      
        });
    }




</script>
<script src="../plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script>
  $(document).ready(function () {
      $('#tbl_congresos').DataTable();
  });
</script>


<!-- Datatables-->

<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="../plugins/datatables/jszip.min.js"></script>
<script src="../plugins/datatables/pdfmake.min.js"></script>
<script src="../plugins/datatables/vfs_fonts.js"></script>
<script src="../plugins/datatables/buttons.html5.min.js"></script>
<script src="../plugins/datatables/buttons.print.min.js"></script>
<script src="../plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="../plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="../plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="../plugins/datatables/dataTables.scroller.min.js"></script>

<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    } );
    TableManageButtons.init();

</script>






<?php require ('includes/footer_end.php'); 

}
