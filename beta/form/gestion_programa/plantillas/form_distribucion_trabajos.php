<?php

/* 
 * Archivo distribucion de trabajos
 * Autor:  @Obed
 * fecha: 18/07/17
 */


?>
<!-- DataTables -->
<link href="../plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

      <form enctype="multipart/form-data" method='POST' name='form_distribucion_trabajos'  id='form_distribucion_trabajos' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
         <div class="row"> 
          <div class="col-sm-12" >
                    <div class="col-lg-12" >                            
                        <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title"><b>@@distribucion_trabajos@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p> 
                                        <div class="form-group">
                                        <label class='col-md-5 control-label' for='fullname'>@@tematica_distribucion@@</label>
                                             <div class="col-md-4">
                                                 <select id="tematicas_trabajo" name="tematicas_trabajo" class="form-control" placeholder="@@tematica@@" onchange="buscatrab(this.value);buscaactividad(this.value);"></select>
                                             </div>
                                        </div>  
                                        <div class="form-group" align="center">
                                            <label class='col-md-2 control-label' for='fullname'></label>
                                            <div class="col-md-10" align="center"><tr>
                                                    <td><label class='col-md-4 alert alert-success' for='fullname'><strong>@@numero_trabajos_encontrados@@</strong></label>
                                                        <div  id="divtrabajos_encontrados" class="col-md-1 alert alert-success"><a><strong>0</strong></a></div>
                                                    </td>
                                                    <td><label class='col-md-4 alert alert-success' for='fullname'><strong>@@numero_actividades_encontradas@@</strong></label>
                                                        <div  id="divact_encontradas" class="col-md-1 alert alert-success"><a><strong>0</strong></a></div>
                                                    </td>
                                                </tr>
                                        </div> 
                                        <div class="form-group" align="center" >
                                            <label class='col-md-2 control-label' for='fullname'></label>
                                            <div class="col-md-10" align="center" id="cont_sesiones" style="display:none;">
                                                    <h5>@@sesiones_necesarias@@: <span class="badge badge-danger" style="font-size: 14px;" id="sesiones_necesarias">0</span></h5>
                                            </div>    
                                        </div> 
                                        <div class="form-group">
                                            <div class="panel">
                                                    <div class="panel-body">
                                                        <div class="">
                                                            <table class="table table-striped" id="tbl_distribucion" name="tbl_distribucion">
                                                                <thead>
                                                                    <tr class='alert alert-success'>
                                                                        <th width="5%" style="text-align: justify;">N.</th>
                                                                        <th width="75%" style="text-align: center;">@@opciones_disponibles@@</th>
                                                                        <th width="20%" style="text-align: center;">@@seleccione@@</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="font-size: 12px; text-align: justify;">1</th>
                                                                        <th style="font-size: 12px; text-align: center;">@@sesion_4_trabajos_hora@@</th>
                                                                        <th style="font-size: 12px; text-align: center;" >
                                                                                <div class="checkbox checkbox-success" >
                                                                                    <input id="4hora" type="checkbox" onclick="hora4();" >
                                                                                        <label for="4hora"></label>
                                                                                </div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style=" font-size: 12px; text-align: justify;">2</th>
                                                                        <th style=" font-size: 12px;  text-align: center;">@@sesion_3_trabajos_hora@@</th>
                                                                        <th style="font-size: 12px; text-align: center;">
                                                                                <div class="checkbox checkbox-success"  >
                                                                                    <input id="3hora" type="checkbox" onclick="hora3();" >
                                                                                        <label for="3hora"></label>
                                                                                </div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="font-size: 12px; text-align: justify;">3</th>
                                                                        <th style="font-size: 12px; text-align: center;">@@sesion_2_trabajos_hora@@</th>
                                                                        <th style="font-size: 12px; text-align: center;" >
                                                                                <div class="checkbox checkbox-success" >
                                                                                    <input id="2hora" type="checkbox" onclick="hora2();" >
                                                                                        <label for="2hora"></label>
                                                                                </div>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="font-size: 12px; text-align: justify;">4</th>
                                                                        <th style="font-size: 12px; text-align: center;">@@sesion_1_trabajos_hora@@</th>
                                                                        <th style="font-size: 12px; text-align: center;">
                                                                                <div class="checkbox checkbox-success" >
                                                                                    <input id="1hora" type="checkbox" onclick="hora1();" >
                                                                                        <label for="1hora"></label>
                                                                                </div>
                                                                        </th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>   
                                            </div>
                                        </div>
                                        <div class="form-group" align="center">
                                            <button type="button" onclick="distribucion_automatica();" id="btn_distribucion_automatica" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">@@btn_distribucion_automatica@@</button>
                                            <button type="button" disabled="true" onclick="guardar_distribucion();" id="btn_guardar_distribucion" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5">@@btn_guardar_distribucion@@</button>
                                            <input type='hidden' name='caso' id='caso' value='insertar_distribucion_trabajos'/>
                                            <input type='hidden' name='iddistribucion' id='iddistribucion' value='0'/>
                                            <input type='hidden' name='cant_act' id='cant_act' value='0'/>
                                            <input type='hidden' name='cant_trab' id='cant_trab' value='0'/>
                                       </div>
                                    <!--</form>-->
                                </div>
                        </div>
                  </div>                        
              </div>          
              </div>
             <div class="col-sm-12">
                 <!--tabla de la derecha-->
              <div class="col-lg-12">
                  <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title"><b>@@distribucion_ya_realizada@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p> 
                                        
                                        <div class="form-group">
                                            <div class="panel">
                                                    <div class="panel-body">
                                                        <div class="">
                                                            <table class="table table-striped" id="tbl_distribuciontematica" name="tbl_distribuciontematica">
                                                                <thead>
                                                                    <tr class='alert alert-success'>
                                                                        <th width="5%" style="text-align: justify;">N.</th>
                                                                        <th width="75%" style="text-align: center;">@@tematicadistribuida@@</th>
                                                                        <th width="20%" style="text-align: center;">@@distribuciontem@@</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>   
                                            </div>
                                        </div>                                       
                                </div>
                        </div>
                  </div>
             </div>
             </div>
          <!--Tabla lado derecho-->
          <div class="row" id="vista_programa" style=""> 
              <div class="col-sm-12" >
                  
                  <div class="col-lg-12" >
                       <div class="card-box p-b-0" >
                        <div class="card-box" style="background-color: #dae6ec;">
                               <h4 class="m-t-0 header-title"><b>@@distribucion_seleccionada@@</b></h4><!---->
                               <div id="preview_programa" name="preview_programa" >
                                   <div class='row'>
                                        <div class='col-sm-12'>
                                            <div class='card-box'>
                                                <h4 class='m-t-0 header-title'><b>@@sesiones_paralelas@@</b></h4>
                                                <p class='text-muted font-13 m-b-30'>
                                                    @@leyenda_programa@@
                                                </p>
<!--                                                <div class="form-group">
                                                    <label class='col-md-2 control-label' for='fullname'>@@linea_i@@:</label>
                                                         <div class="col-md-10 text-success">
                                                             <label class='control-label ' for='fullname'  id="linea_i" name="linea_i"></label>
                                                         </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class='col-md-2 control-label' for='fullname'>@@tematica_trab@@:</label>
                                                         <div class="col-md-10 text-success">
                                                              <label class='control-label' for='fullname'  id="tematica_trab" name="tematica_trab"></label>
                                                         </div>
                                                </div> -->
<!--                                                <div class="form-group">
                                                    <label class='col-md-2 control-label' for='fullname'>@@numsesion@@:</label>
                                                         <div class="col-md-10 text-success">
                                                             <label class='control-label' for='fullname' id="numsesion" name="numsesion"></label>
                                                         </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label class='col-md-2 control-label' for='fullname'>@@encargado_sesion@@:</label>
                                                         <div class="col-md-10 text-success">
                                                             <label class='control-label' for='fullname' id="nomencargado" name="nomencargado"></label>
                                                         </div>
                                                </div> -->
                                                <table id='tbl_distribucion_trabajos' class="table" cellspacing="0" width="100%">                                        
                                                    <thead>
                                                        <tr class='alert alert-success'>
                                                            <th width="10%">@@fecha_trabajo@@</th>
                                                            <th width="8%">@@hora_inicial@@</th>
                                                            <th width="8%">@@hora_final@@</th>                                                                                                      
                                                            <th width="15%">@@nombre_trabajo@@</th>  
                                                            <th width="15%">@@resumen_trabajo@@</th>  
                                                            <th width="8%">@@tipo_trabajo@@</th>
                                                            <th width="5%">@@idioma@@</th>                                                           
                                                            <th width="15%">@@coautores@@</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                                    
                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                               </div>
                           </div>          
                        </div>
                    </div>
             </div>
           </div>
       </form>    


<script src="./js/fnc_slc.js" type="text/javascript"></script>
<!--<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="./assets/css/jquery-ui.css">
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/angular.min.js"></script>-->
<script src="./js/gestion_programa/gestion_programa.js"></script>

<!--FooTable-->
<script src="../plugins/footable/js/footable.all.min.js"></script>
<!--FooTable Example-->
<script src="assets/pages/jquery.footable.js"></script>
<script>
            function aviso(){
                alert('@@nodisponible@@');
            }
            function avisoarchivo(){
                alert('@@trabajonoenviadoarevision@@');
            }
            function avisonoexiste(){
                 alert('@@archivonoexiste@@');
            }
            function radios_opciones(id, valor){
                $("#"+id).prop('checked', true);
                for(var i=1; i<=4;i++){
                    if(i != valor){
                        $("#"+i+"hora").prop('checked', false);
                    }
                }
            }
             /*funciones para validar el numero de trab por hora*/
            function hora4(){
                var cant_trab = $("#cant_trab").val();
                var cant_act = $("#cant_act").val();                
                if(cant_act != 0 && cant_trab != 0){
                    if(cant_trab >= cant_act){ 
                        radios_opciones('4hora',4); 
                        /*llamada a sesiones necesarias*/
                        sesiones_necesarias(4);
                    }else{
                         alert("@@mj_trabajos_insuficientes_para_la_distribucion@@");
                            $("#4hora").prop("checked", false);
                            $("#3hora").prop("checked", false);
                            $("#2hora").prop("checked", false);
                            $("#1hora").prop("checked", false);
                            $("#cont_sesiones").css('display','none');
                    }
                }else if(cant_act != 0 || cant_trab != 0){
                    if(cant_act != 0){
                        alert("@@no_exiten_trabajos@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }else{
                        alert("@@no_exiten_sesiones@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }
                }else{
                    alert("@@no_existen_trabajos_ni_sesiones@@");
                    $("#4hora").prop("checked", false);
                    $("#3hora").prop("checked", false);
                    $("#2hora").prop("checked", false);
                    $("#1hora").prop("checked", false);
                    $("#cont_sesiones").css('display','none');
                }
                
                $("#btn_guardar_distribucion").attr('disabled',true);
                $("#iddistribucion").val(4);
            }
            function hora3(){
                var cant_trab = $("#cant_trab").val();
                var cant_act = $("#cant_act").val();                
                if(cant_act != 0 && cant_trab != 0){
                    if(cant_trab >= cant_act){ 
                        radios_opciones('3hora',3);  
                        /*llamada a sesiones necesarias*/
                        sesiones_necesarias(3);
                    }else{
                         alert("@@mj_trabajos_insuficientes_para_la_distribucion@@");
                            $("#4hora").prop("checked", false);
                            $("#3hora").prop("checked", false);
                            $("#2hora").prop("checked", false);
                            $("#1hora").prop("checked", false);
                            $("#cont_sesiones").css('display','none');
                    }
                }else if(cant_act != 0 || cant_trab != 0){
                    if(cant_act != 0){
                        alert("@@no_exiten_trabajos@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }else{
                        alert("@@no_exiten_sesiones@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }
                }else{
                    alert("@@no_existen_trabajos_ni_sesiones@@");
                    $("#4hora").prop("checked", false);
                    $("#3hora").prop("checked", false);
                    $("#2hora").prop("checked", false);
                    $("#1hora").prop("checked", false);
                    $("#cont_sesiones").css('display','none');
                }
                $("#btn_guardar_distribucion").attr('disabled',true);
                $("#iddistribucion").val(3);
            }
            function hora2(){
                var cant_trab = $("#cant_trab").val();
                var cant_act = $("#cant_act").val();                
                if(cant_act != 0 && cant_trab != 0){
                    if(cant_trab >= cant_act){ 
                        radios_opciones('2hora',2);  
                        /*llamada a sesiones necesarias*/
                        sesiones_necesarias(2);
                    }else{
                         alert("@@mj_trabajos_insuficientes_para_la_distribucion@@");
                            $("#4hora").prop("checked", false);
                            $("#3hora").prop("checked", false);
                            $("#2hora").prop("checked", false);
                            $("#1hora").prop("checked", false);
                            $("#cont_sesiones").css('display','none');
                    }
                }else if(cant_act != 0 || cant_trab != 0){
                    if(cant_act != 0){
                        alert("@@no_exiten_trabajos@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }else{
                        alert("@@no_exiten_sesiones@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }
                }else{
                    alert("@@no_existen_trabajos_ni_sesiones@@");
                    $("#4hora").prop("checked", false);
                    $("#3hora").prop("checked", false);
                    $("#2hora").prop("checked", false);
                    $("#1hora").prop("checked", false);
                    $("#cont_sesiones").css('display','none');
                } 
                $("#btn_guardar_distribucion").attr('disabled',true);
                $("#iddistribucion").val(2);
            }
            function hora1(){
//                $("#cont_sesiones").Attr('display','none');
//                $("#sesiones_necesarias").text("0"); 
                var cant_trab = $("#cant_trab").val();
                var cant_act = $("#cant_act").val();                
                if(cant_act != 0 && cant_trab != 0){
                    if(cant_trab >= cant_act){ 
                        radios_opciones('1hora',1);
                         /*llamada a sesiones necesarias*/
                          sesiones_necesarias(1);
                    }else{
                         alert("@@mj_trabajos_insuficientes_para_la_distribucion@@");
                            $("#4hora").prop("checked", false);
                            $("#3hora").prop("checked", false);
                            $("#2hora").prop("checked", false);
                            $("#1hora").prop("checked", false);
                            $("#cont_sesiones").css('display','none');
                    }
                }else if(cant_act != 0 || cant_trab != 0){
                    if(cant_act != 0){
                        alert("@@no_exiten_trabajos@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }else{
                        alert("@@no_exiten_sesiones@@");
                        $("#4hora").prop("checked", false);
                        $("#3hora").prop("checked", false);
                        $("#2hora").prop("checked", false);
                        $("#1hora").prop("checked", false);
                        $("#cont_sesiones").css('display','none');
                    }
                }else{
                    alert("@@no_existen_trabajos_ni_sesiones@@");
                    $("#4hora").prop("checked", false);
                    $("#3hora").prop("checked", false);
                    $("#2hora").prop("checked", false);
                    $("#1hora").prop("checked", false);
                    $("#cont_sesiones").css('display','none');
                }
                $("#btn_guardar_distribucion").attr('disabled',true);
                $("#iddistribucion").val(1);
            }
            function sesiones_necesarias(dist){ 
                var cant_trab = $("#cant_trab").val();
//                var cant_act = $("#cant_act").val();
                var sesiones = 0;
                if(dist == 1){                     
                    sesiones = cant_trab;
                }else if(dist == 2){
                    sesiones = Math.ceil(cant_trab / 2);
                }else if(dist == 3){
                    sesiones = Math.ceil(cant_trab / 3);
                }else if(dist == 4){
                    sesiones = Math.ceil(cant_trab / 4);
                }
                $("#cont_sesiones").removeAttr('style');                
                $("#sesiones_necesarias").text(sesiones); 
                 
            }
            
            
           
            
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

<!--<script type="text/javascript">
    $(document).ready(function() {
        var idioma_tabla= {
                "sProcessing": "@@sProcessing@@",
                "sLengthMenu": "@@sLengthMenu@@",
                "sZeroRecords": "@@sZeroRecords@@",
                "sEmptyTable": "@@sEmptyTable@@",
                "sInfo": "@@sInfo@@",
                "sInfoEmpty": "@@sInfoEmpty@@",
                "sInfoFiltered": "@@sInfoFiltered@@",
                "sInfoPostFix": "",
                "sSearch": "@@sSearch@@",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "@@sLoadingRecords@@",
                "oPaginate": {
                    "sFirst": "@@sFirst@@",
                    "sLast": "@@sLast@@",
                    "sNext": "@@sNext@@",
                    "sPrevious": "@@sPrevious@@"
                },
                "oAria": {
                    "sSortAscending": "@@sSortAscending@@",
                    "sSortDescending": "@@sSortDescending@@"
                }
            };
        $('#tbl_distribucion_trabajos').dataTable({
            dom: "<'row'<'form-inline' <'col-sm-offset-3'B>>>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'row'<'col-sm-6'l><'col-sm-6'f>>"
                    + "<'row'<'col-sm-12'tr>>"
                    + "<'row'<'col-sm-12'i>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'col-sm-12'p>>",
            buttons: [{
                extend: 'pdfHtml5',
                text: '@@pdf@@',
                className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                orientation: 'landscape',
                pageSize: 'LETTER'
                
            },{
                extend: 'excelHtml5',
                text: '@@excel@@',
                className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                orientation: 'landscape',
                pageSize: 'LETTER'                
            },{
                extend: 'csvHtml5',
                text: '@@csv@@',
                className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                orientation: 'landscape',
                pageSize: 'LETTER'               
            },{
                extend: 'print',
                text: '@@imprimir@@',
                className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                orientation: 'landscape',
                pageSize: 'LETTER',                 
            },{
                extend: 'copy',
                text: '@@copiar@@',
                className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                orientation: 'landscape',
                pageSize: 'LETTER'                
            }],
            language: idioma_tabla});
        $('#tbl_distribucion_trabajos-keytable').DataTable({keys: true});
        $('#tbl_distribucion_trabajos-responsive').DataTable();
        $('#tbl_distribucion_trabajos-scroller').DataTable( { ajax: "../plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#tbl_distribucion_trabajos-fixed-header').DataTable( { fixedHeader: true} );
        
    } );
   // TableManageButtons.init();

</script>-->
