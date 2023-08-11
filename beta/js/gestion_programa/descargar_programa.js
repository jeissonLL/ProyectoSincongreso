/* 
 * Gestion de programa / Exportar trabajos a Excel / etc.
 * autor: Brayan Triminio
 * 09/10/2017.
 */

$("#btn_expor_excel").click(function(){
    var caso = "mostrar_trabajos_sistema";
    var idprograma = $("#idprog").val();
    $.post("./form/gestion_programa/plantillas/funciones.php", {caso:caso,idprograma:idprograma}, function (resp) {
       $(resp).table2excel({
            name: "Trabajos_CEAT",
            sheetName: "Trabajos_Temática_TipoTrabajo",
            filename: "Trabajos_CEAT"
        });
    }); 
});

/*Ponentes Internacionales en PDF*/
$("#btn_expor_pdf").click(function (){
   event.preventDefault();
   var idtprograma = $("#idprog").val(); 
   window.open("form/gestion_programa/plantillas/ponentes_internacionales.php?idprog="+idtprograma, "_blank");
});
/*Obed*/
$("#btn_expor_excel_indice_autores").click(function(){
    var caso = "excel_indice_autores";
    var idprograma = $("#idprog").val();
    $.post("./form/gestion_programa/plantillas/funciones.php", {caso:caso,idprograma:idprograma}, function (resp) {
       console.log(resp);
       $(resp).table2excel({
            name: "Indice de Autores",
            sheetName: "Indice_Autores",
            filename: "Autores"
        });
    }); 
});


/*TRABAJOS EN SESIONES PARALELAS*/
$("#btn_expor_excel_trab_sp").click(function (){
    var caso = "excel_trabajos_sp";
    var idprograma = $("#idprog").val();
    $.post("./form/gestion_programa/plantillas/funciones.php", {caso:caso,idprograma:idprograma}, function (resp) {
       console.log(resp);
       $(resp).table2excel({
            name: "Indice de Autores",
            sheetName: "Indice_Autores",
            filename: "Autores"
        });
    });
});

/*PROGRAMA RESUMIDO*/
$("#btn_expor_pdf_programa_resumido").click(function (){  
   event.preventDefault();
   var idprog = $("#idprog").val(); 
   window.open("form/gestion_programa/plantillas/programa_resumen.php?idprog="+idprog, "_blank");
});