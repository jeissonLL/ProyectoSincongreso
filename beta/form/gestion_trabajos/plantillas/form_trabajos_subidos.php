<?php

/*
 * Archivo formulario de trabajos subidos
 * Autor: Obed MartÃ­nez
 * fecha: 20/02/17
 */

//session_start();
//print_r($_SESSION);
?>
<HTML>
    <HEADER>
      <!-- Plugins css-->
        <link href="../plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />

        <!--FILE UPLOADS MULTIPLE-->
        <!-- Google Fonts -->
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">-->

	<!-- Styles -->
	<link href="../plugins/multiupload-om/css/jquery.filer.css" rel="stylesheet"/>
	<link href="../plugins/multiupload-om/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet"/>

	<!-- Jvascript -->
	<!--<script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>-->
	<script src="../plugins/multiupload-om/js/jquery.filer.min.js" type="text/javascript"></script>
        <script src="../plugins/multiupload-om/js/custom.js" type="text/javascript"></script>
        <style>
            .ui-autocomplete{
                    z-index:1050;
            }
            </style>
    </HEADER>
    <BODY>

 
<div class="row">   
        <form enctype="multipart/form-data" method='POST' name='form_trabajos_subidos'  id='form_trabajos_subidos' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <!--<h4 class="m-t-0 header-title"><b>@@mis_trabajos@@</b></h4>-->
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@mis_trabajos@@</b></h4>
                                <p class="text-muted m-b-30 font-13"></p> 
                                <div class="panel">
                                    <div class="panel-body">
                                       
                                            <table class="table table-striped" id="tbl_trabajos_subidos" name="tbl_trabajos_subidos">
                                                <thead>
                                                <tr class='alert alert-success'>
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="30%" >@@titulo_trabajo@@</th>
                                                    <th width="30%" >@@resumenprograma@@</th>
                                                    <th width="8%" style="text-align: center;">@@fecha_subida@@</th>                                                                        
                                                    <th width="8%" style="text-align: center;">@@tipo_trabajo@@</th>
                                                    <th width="5%" style="text-align: center;">@@idioma@@</th>                    
                                                    <th width="10%" style="text-align: center;">@@estado@@</th>
                                                    <th colspan="9" width="9%" style="text-align: center;">@@acciones@@</th>
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
             <input type="hidden" id="idt" name="idt" value=""/>
             <input type="hidden" id="idtp" name="idtp" value=""/>
             <input type="hidden" id="nummaxautores" name="nummaxautores" value=""/>
             <input type="hidden" id="caso" name="caso" value=""/>
        </div>
            <!-- #modal-dialog -->                                    
                <div class='modal fade' id='modal-dialog' style='display:none;' >                                    
                        <div class='modal-dialog' >
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@titulo_cambia_doc@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin">
                                                        <label class='col-md-5 control-label' for='fullname'>@@archivo_adjunto@@ <p class="text-danger">@@leyenda_archivo@@</p></label>                                           
                                                        <div class="col-md-4">
                                                            <input type="file" id="archivo_trabajo" name="archivo_trabajo" class="btn-default btn-rounded" accept=".odt, .doc, .docx"/><br>
                                                        </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                                <a href='javascript:;'  class='btn btn-sm btn-white' data-dismiss='modal'>@@btn_cancelar@@</a>
                                                <a type='button' onclick='cargardoc();' class='btn btn-primary btn-success'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
               <!-- /modal-dialog -->
               
               
               
               
               <!-- #modal-dialog 1 AGREGAR AUTORES-->                                    
                <div class='modal fade bs-example-modal-lg' role="dialog" id='modal-dialog1' style='display:none;' >                                    
                        <div class='modal-dialog modal-full' >
                                    <style>
                                    .ui-autocomplete.ui-front
                                                {
                                                z-index: 1051;
                                                }
                                    </style>                                    
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@agregar_autores@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row" align="center">
                                                <div class="col-md-12"> 
                                                    <div class="form-group" id="correo" name="cautor" >
                                                            <label class="col-md-6 control-label">@@correo_autor@@</label>
                                                            <div class="col-md-4">                                                               
                                                                <input name="correo_autor" autocomplete="off" type="text" class="form-control" id="correo_autor" placeholder="@@PH_correo_autor@@"  onkeypress="autocompletarusuario(this.value);" />
                                                                <!--<div id="correos" style="position: sticky; z-index: 1;"></div>-->
                                                            </div>
                                                     </div>    
                                                    <div class="form-group"  name="pnautor" >
                                                            <label class="col-md-6 control-label">@@primer_nombre@@</label>
                                                            <div class="col-md-4">                                                               
                                                               <input type="text" name="primer_nombre" id="primer_nombre" placeholder="@@PH_pnombre@@" class="form-control">
                                                            </div>
                                                     </div>
                                                     <div class="form-group"  name="paautor" >
                                                            <label class="col-md-6 control-label">@@primer_apellido@@</label>
                                                            <div class="col-md-4">                                                               
                                                               <input type="text" name="primer_apellido" id="primer_apellido" placeholder="@@PH_papellido@@" class="form-control"> 
                                                            </div>
                                                     </div>
                                                    <div class="form-group"  name="idautor" >
                                                            <label class="col-md-6 control-label">@@identificacion@@</label>
                                                            <div class="col-md-4">                                                               
                                                               <input type="text" name="identificacion" id="identificacion" placeholder="@@PH_identificacion@@" class="form-control"> 
                                                            </div>
                                                     </div>
                                                    <div class="form-group"  align="center" >
                                                        <p class="text-muted font-13 m-b-15 m-t-20">@@autor_principal@@</p>
                                                        <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="rd_ap_si" value="1" name="rd_ap_si" onclick="radios_autores(this.value);">
                                                            <label for="rd_ap_si"> @@si@@ </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <input type="radio" id="rd_ap_no" value="0" name="rd_ap_no" onclick="radios_autores(this.value);" checked="true">
                                                            <label for="rd_ap_no"> @@no@@ </label>
                                                    </div>
                                                     
                                               </div>
                                            </div>
                                        </div>
                                            <div class='modal-footer' style="text-align: center;">                                                
                                                <a href='javascript:;'  class='btn btn-sm btn-white' title="@@btn_cancelar@@" data-dismiss='modal'>@@btn_cancelar@@</a>
                                                <a type='button' onclick='guardarautores();' title="@@btn_guardar@@" class='btn btn-primary btn-success'>@@btn_guardar@@</a>
                                        </div>
                                        <div class="form-group" align="left" >                                                
                                            <a style="cursor: pointer;" onclick="mostrarautores()"  class="text-danger" value="@@ver_coautores_trabajo@@" id="mostrarta" >@@ver_coautores_trabajo@@</a>
                                        </div>
                                        <div class="form-group" align="center" style="display: none;" id="ta" name="ta">
                                            <div class="form-group">    
                                                <table id="cautores" class="table table-rep-plugin" style="font-size: 10px;border-collapse: 0; padding-bottom: 5px; font-weight: bold;">
                                                           <thead>                                                           
                                                            <tr class="info">
                                                               <th width="15%" style="text-align: center;font-size: 10px;">@@nombres@@</th>
                                                               <th width="15%" style="text-align: center;font-size: 10px;">@@apellidos@@</th>                                                                        
                                                               <th width="12%" style="text-align: center;font-size: 10px;">@@identificacion@@</th>
                                                               <th width="8%" style="text-align: center;font-size: 10px;">@@correo@@</th>                    
                                                               <th width="10%" style="text-align: center;font-size: 10px;">@@nusuario@@</th>
                                                               <th width="5%" style="text-align: center;font-size: 10px;">@@subio@@</th>
                                                               <th width="5%" style="text-align: center;font-size: 10px;">@@aprincipal@@</th>
                                                               <th width="5%" style="text-align: center;font-size: 10px;">@@coautor@@</th>
                                                               <th width="5%" style="text-align: center;font-size: 10px;">@@expositor@@</th>
                                                               <th width="5%" style="text-align: center;font-size: 10px;">@@cautoria@@</th>
                                                               <th width="5%" style="text-align: center;font-size: 10px;">@@autor_correspondencia@@</th>
                                                               <th width="5%" style="text-align: center;font-size: 10px;">@@eliminar_autor@@</th>
                                                           </tr>
                                                           </thead>
                                                           <tbody>

                                                           </tbody>
                                                </table> 
                                            </div>
                                            <div class="form-group" align="left" style="padding-left: 10px;" >                                                
                                                    <a style="cursor: pointer;" onclick="ocultarta()"  class="text-danger" >@@ocultarta@@</a>
                                            </div>
                                            <div class="form-group" align="center" style="padding-right: 10px; cursor: pointer; color: white; font-size: 16px;" >                                                
                                                <span class="label label-success" onclick="guardarexpositores()"  >@@guardarexpositores@@</span>
                                            </div>
                                        </div>
                                    </div>
                        </div>                                    
                    </div>
              </div>
               <!-- /modal-dialog1 -->
               
               <!-- #modal-dialog 2 VER REVISIONES DEL TRABAJO-->                                    
                <div class='modal fade bs-example-modal-lg' tabindex="-1" role="dialog" id='modal-dialog2' data-keyboard="false" data-backdrop="static" style='display:none;' >                                    
                    <div class='modal-dialog modal-lg' >
                                   <div class='modal-content'>
                                        <div class='modal-header' align="center">
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@revisionesdoc@@ <a id="idtrabd"></a></h4>
                                        </div>
                                        <div class='modal-body'>
                                                    <div class="modal-header">
                                                    <h4 class="text-success">@@titulotrab@@</h4>
                                                    <p id="ttrabd" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    <h4 class="text-success">@@ponde@@</h4>
                                                    <p id="pond" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    <h4 class="text-success">@@obs@@</h4>
                                                    <p id="obs" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div>
                                            
                                            <br>
                                            <div class="form-control" align="center">
                                                <label align="center" class="text-success">@@preguntascuantitativas@@</label>
                                            </div><br>
                                            <div id="idrevisores1" class="form-control" align="center" style="float: left; width: 49%; display: none" >
                                                <label align="center" class="text-success" >@@revisor@@</label>
                                            </div>
                                            <div >
                                                
                                                <table id="pcuanti1" class="table table-bordered m-0" style="float: left; width: 49%; display: none" >
                                                    <thead>
                                                        <tr class="text-success"   >
                                                            <th  class="text-success"  id="nrevisor" colspan="2"  style="text-align: center;"  >@@revisor@@</th>
                                                        </tr>
                                                        <tr class='alert alert-success'>
                                                            <th  style="text-align: justify;" width='33%'>@@pregunta@@</th>
                                                            <th  style="text-align: justify;" width='46%'>@@respuesta@@</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                    
                                                </table>
                                                
                                            </div>
                                               
                                            <div  class="modal-header" id="numero_cuanti">
                                                     
                                            </div>
                                            
                                                 
                                            <div class="form-control" align="center">
                                                <label align="center" class="text-success">@@preguntascualitativas@@</label>
                                            </div><br>
                                            
                                            <div >
                                                <table id="pcuali1" class="table table-bordered m-0" style="float: left; width: 49%; display: none">
                                                    <thead >
                                                        <tr class="text-success"   >
                                                            <th  class="text-success"  id="nrevisor" colspan="2"  style="text-align: center;"  >@@revisor@@</th>
                                                        </tr>
                                                        <tr class='alert alert-success'>
                                                            <th style="text-align: center;" width='35%'>@@pregunta@@</th>
                                                            <th style="text-align: center;" width='65%'>@@respuesta@@</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div  class="modal-header" id="numero_cuali">
                                                     
                                            </div>
                                            <div  class="modal-header" id="numero_cuali">
                                                     
                                            </div> 
                                        </div>
                                        <div class='modal-footer'>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@btn_cerrar@@</button>
                                        </div>
                                    </div>
                        </div>                                    
               </div>
               <!-- /modal-dialog2 -->
               
               <!-- #modal-dialog3 -->                                    
                <div class='modal fade' id='modal-dialog3'  style='display:none;' >                                    
                        <div class='modal-dialog' >
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@docinvestrev@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group no-margin">
                                                        <label class='col-md-5 control-label' for='fullname'>@@archivo_adjunto@@ <p class="text-danger">@@leyenda_archivo@@</p></label>                                           
                                                        <div class="col-md-4">
                                                            <input type="file" id="nuevo_trabajo" name="nuevo_trabajo" class="btn-default btn-rounded" accept=".odt, .doc, .docx"/><br>
                                                        </div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                                <a href='javascript:;'  class='btn btn-sm btn-white' data-dismiss='modal'>@@btn_cancelar@@</a>
                                                <a type='button' onclick='cargarnversion();' class='btn btn-primary btn-success'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
               
               <!-- /modal-dialog3 -->
               <!-- #modal-dialog4 -->                                    
                <div class='modal fade' id='modal-dialog4' style='display:none;' >                                    
                        <div class='modal-dialog' >
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@aceptarhorario@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                            <label class="col-md-6 control-label">@@hsugirio@@</label>
                                                            <div class="col-md-4">                                                               
                                                                <input disabled type="time" name="horasugirio" id="horasugirio" class="form-control"> 
                                                            </div>
                                                     </div>
                                                    <hr class="hr">
                                                    <div class="form-group">
                                                            <label class="col-md-6 control-label">@@fsugerido@@</label>
                                                            <div class="col-md-4">                                                               
                                                                <input disabled type="date" name="fechapresentacion" id="fechapresentacion" class="form-control"> 
                                                            </div>
                                                     </div>
                                                     <div class="form-group">
                                                            <label class="col-md-6 control-label">@@hsugerido@@</label>
                                                            <div class="col-md-4">                                                               
                                                                <input disabled type="time" name="horapresentacion" id="horapresentacion" class="form-control"> 
                                                            </div>
                                                     </div>                                                   
                                                    <hr class="hr">
                                                    <div class="form-group"  align="center" >
                                                        <p class="text-muted font-13 m-b-15 m-t-20">@@confirmhorario@@?</p>
                                                        <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="rd_si" value="1" name="rd_si" onclick="radios_horario(this.value);">
                                                            <label for="rd_si"> @@si@@ </label>
                                                        </div>                                                        
                                                        <div class="radio radio-inline">
                                                            <input type="radio" id="rd_no" value="0" name="rd_no" onclick="radios_horario(this.value);">
                                                            <label for="rd_no"> @@no@@ </label>
                                                    </div>
                                                     
                                               </div>
                                               </div>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                                <a href='javascript:;'  class='btn btn-sm btn-white' data-dismiss='modal'>@@btn_cancelar@@</a>
                                                <a type='button' onclick='guardarhorario();' class='btn btn-primary btn-success'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
               <!-- /modal-dialog4 -->
               
        </form>
        
    </div>

 <!--Tabla lado derecho-->

</BODY>

<script src="./js/fnc_slc.js" type="text/javascript"></script>
<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<!--<link rel="stylesheet" href="./assets/css/jquery-ui.css">-->
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/angular.min.js"></script>
<!--<script src="./assets/js/jquery.min.js"></script>-->
<script src="./js/gestion_trabajos/form_subir_trabajos.js"></script>


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
           //Autor principal
            function radios_autores(valor){
                if(valor == 0){
                    $("#rd_ap_no").prop('checked', true);
                    $("#rd_ap_si").prop('checked', false);
                }else{                     
                    $("#rd_ap_si").prop('checked', true);
                    $("#rd_ap_no").prop('checked', false); 
                }
//                return true;
            }
            function radios_horario(valor){
                if(valor == 0){
                    $("#rd_no").prop('checked', true);
                    $("#rd_si").prop('checked', false);
                }else{                     
                    $("#rd_si").prop('checked', true);
                    $("#rd_no").prop('checked', false); 
                }
//                return true;
            }
           function autores(num,limite){
                $("#coautores").html(""); 
                if(num <= 10){
                     if(num != 0 && num <= limite){
                     $("#coautores").append('<p class="text-danger">@@leyenda_coautores@@</p>');
                        for(var i=1;i<=num;i++){
                             $("#coautores").append('<div class="card-box col-md-12" style="background-color: #E3F2E1;"><label class="form-control">@@autor@@'+' '+i+'</label><input autocomplete="false" type="text" name="correo_autor'+i+'" id="correo_autor'+i+'" placeholder="@@PH_correo_autor@@" class="form-control"  onkeypress="if(event.which==13){autocompletar(this.value,'+i+');}else{completar('+i+');}" ></input><input type="text" name="primer_nombre'+i+'" id="primer_nombre'+i+'" placeholder="@@PH_pnombre@@" class="form-control"></input>     <input type="text" name="primer_apellido'+i+'" id="primer_apellido'+i+'" placeholder="@@PH_papellido@@" class="form-control"></input> </div>');
                        }    
                     }
                }else{
                    alert('@@num_valido_autores@@');
                }
            }
          //mostrar modal de cambio de trabajo
            function cambiadoc(idt){
                $("#idt").val(idt);
                $("#caso").val('cambiardoc');
                if (confirm('@@pcambiadoc@@?')) {                                            
                        $('#modal-dialog').removeAttr('style');
                        $('#modal-dialog').modal({
                             show: 'true'
                        });             
                }
            }
            function cargardoc(){               
                 var formData = new FormData($("#form_trabajos_subidos")[0]);
                       var ruta = "form/gestion_trabajos/plantillas/doc-ajax.php";
                       $.ajax({
                           url: ruta,
                           type: "POST",
                           data: formData,
                           contentType: false,
                           processData: false,
                           success: function(datos)
                           {
                             console.log(datos);
//                            alert(datos);
                            if(datos == 1){
                                alert('Datos guardados exitosamente.');
                                $('#modal-dialog').modal('hide');     //oculta el modal
                                $('body').removeClass('modal-open');  //quita la clase que mantiene activo el modal
                                $('.modal-backdrop').remove();        //habilita en formulario contenedor  
                                $('#form_trabajos_subidos').trigger("reset");//limpiar formulario                                                 
                                    //funcion para actualizar tabla donde se visualizan los campos ingresados
                                 $.post("form/gestion_trabajos/form_trabajos_subidos.php", {}, function (resp) {                                       
//                                     alert(resp)
                                    console.log(resp);
                                    $('#contenedor').html("");
                                    $('#contenedor').html(resp);
                                    b_func('tbl_trabajos_subidos');
                                 });   
                            }else{
                                alert('Ha ocurrido un error y no se pudo subir su trabajo, por favor intentelo nuevamente!');  
                            }
                           }
                       });

            }
            
            //cargar nueva version del trabajo
            //
            //
            function cargarnversion(){               
                 var formData = new FormData($("#form_trabajos_subidos")[0]);
                       var ruta = "form/gestion_trabajos/plantillas/doc-ajax.php";
                       $.ajax({
                           url: ruta,
                           type: "POST",
                           data: formData,
                           contentType: false,
                           processData: false,
                           success: function(datos)
                           {
                             console.log(datos);
//                            alert(datos);
                            if(datos == 1){
                                alert('Datos guardados exitosamente.');
                                $('#modal-dialog').modal('hide');     //oculta el modal
                                $('body').removeClass('modal-open');  //quita la clase que mantiene activo el modal
                                $('.modal-backdrop').remove();        //habilita en formulario contenedor  
                                $('#form_trabajos_subidos').trigger("reset");//limpiar formulario                                                 
                                    //funcion para actualizar tabla donde se visualizan los campos ingresados
                                 $.post("form/gestion_trabajos/form_trabajos_subidos.php", {}, function (resp) {                                       
//                                     alert(resp)
                                    console.log(resp);
                                    $('#contenedor').html("");
                                    $('#contenedor').html(resp);
                                    b_func('tbl_trabajos_subidos');
                                 });   
                            }else{
                                alert('Ha ocurrido un error y no se pudo subir su trabajo, por favor intentelo nuevamente!');  
                            }
                           }
                       });

            }
            //
            //mostrar modal de agregar autores
            function agregarautor(idt, idtp, nma){
                $("#idt").val(idt);
                $("#idtp").val(idtp);
                $("#nummaxautores").val(nma);
                $("#caso").val('agregarautor');
                $("#ta").css('display','none');
                $("#mostrarta").removeAttr("style");
                $("#mostrarta").css('cursor','pointer'); 
                $("#correo_autor").val("");
                $("#primer_nombre").val("");
                $("#primer_apellido").val("");
                $("#identificacion").val("");
                $("#rd_ap_no").prop("checked", true);
                $("#rd_ap_si").prop("checked", false);
                $('#modal-dialog1').removeAttr('style');
                $('#modal-dialog1').modal({
                     show: 'true'
                });
                
            }
            
            //mostrar modal de revisiones
            function verrevisiones(idt, idtem){

                $("#idt").val(idt);    
                $('#numero_cuanti').html("");  
                $('#numero_cuali').html("");  
                var caso = 'revisoresxtrabajo_revisiones';

                $.post("form/gestion_trabajos/plantillas/funciones.php", {caso:caso,idtrabajo:idt}, function (resp) {
                   
                  if(resp ==""){
                      
                      $('#numero_cuanti').append("<p style='font-weight:bold; text-align:jutify; font-size:12px;'>@@revision_no_realizada@@</p>" );  
                      $('#numero_cuali').append("<p style='font-weight:bold; text-align:jutify; font-size:12px;'>@@revision_no_realizada@@</p>" );  
                       
                       $('#modal-dialog2').removeAttr('style');
                       $('#modal-dialog2').modal({
                         show: 'true'         
                    }); 
                  }else{ 
                  var valores = resp.split("<>");
                  
                  $('#numero_cuanti').html("");  
                  $('#numero_cuali').html("");  
                  
                   for(var i=0; i<valores.length-1 ; i++){
                       var caso1= 'preguntasyrespuestas_revisiones';                      
                        var ponderacion = 0;
                            $.post("form/gestion_trabajos/plantillas/funciones.php", {caso:caso1,idt:idt,idrevisor:valores[i],idtem:idtem}, function (resp) {
//                                alert(resp);
                                var dataJson = JSON.parse(resp);
                                /*cuantitativas */
                                var $tabla = $('table[id^="pcuanti"]:last');
                                var num = parseInt( $tabla.prop("id").match(/\d+/g), 10 ) +1;
                                var $kloncuantitativo = $tabla.clone().prop('id', 'pcuanti'+num );
                                $kloncuantitativo.removeAttr("style");
                                
                                $kloncuantitativo.find('tbody').remove();
                                
                                /*Cualitativas */
                                var $tabla1 = $('table[id^="pcuali"]:last');
                                var num = parseInt( $tabla1.prop("id").match(/\d+/g), 10 ) +1;
                                var $kloncualitativo = $tabla1.clone().prop('id', 'pcuali'+num );
                                $kloncualitativo.removeAttr("style");                                
                                $kloncualitativo.find('tbody').remove();                                 
                                if(num%2 == 0) { 
                                    $kloncuantitativo.attr("style" ,"float: left; width: 49%;");
                                    $kloncualitativo.attr("style" ,"float: left; width: 49%;");
                                }else{
                                    $kloncuantitativo.attr("style" ,"float: right; width: 49%;");
                                    $kloncualitativo.attr("style" ,"float: right; width: 49%;"); 
                                }
                                    for (var i=0; i<dataJson.numcuanti; i++){
                                      var opcionpeso =  dataJson['respuesta_cuantitativa'+i];
                                      var opciones = opcionpeso.split("<>");
                                      var elementos = "" ;
                                        for(var a=0;a<opciones.length;a++){
                                            elementos +=  opciones[a] +"-->";
                                            if (isNaN(opciones[a])){
                                                
                                            }else{
                                                ponderacion = ponderacion + parseFloat(opciones[a]) ;
                                            }
                                        }
                                            elementos = elementos.substr(0, elementos.length-3 );
                                            $kloncuantitativo.append("<tbody><tr><td  style='font-weight:bold; text-align:jutify; font-size:11px;'>"+dataJson['nombre_pregunta_cuantitativa'+i]+"?</td><td>"+elementos+"</td><tr><tbody>");
                                    }
                                    var nota = ((ponderacion / (parseInt(dataJson.numcuanti))) );                                     
                                    $("#obs").html("<p style='font-weight: bold;text-indent: 1cm; '>@@observacion_revisor@@:  -->" +dataJson['observaciones']+  "</p>");
                                    $("#pond").html("<p style='font-weight: bold;text-indent: 1cm; '>@@ponderacion_revisores@@:   " + Math.ceil(nota) + "%</p>");
                                    $("#ttrabd").html(" <b> " +  dataJson.titulo_trabajo + " </b> ");
                                    $('#numero_cuanti').append($kloncuantitativo);
                                    for (var i=0; i<dataJson.numcuali; i++){
                                            $kloncualitativo.append("<tr><td  style='font-weight:bold; text-align:jutify; font-size:11px;'>"+dataJson['nombre_pregunta_cualitativa'+i].toUpperCase()+"?</td><td>"+dataJson['respuesta_cualitativa'+i]+"</td><tr>");
                                    }
                                    $('#numero_cuali').append($kloncualitativo);
                            });
                   }
                    $('#modal-dialog2').removeAttr('style');
                    $('#modal-dialog2').modal({
                         show: 'true'         
                    }); 
                }
            }); 
                
                
                
            }
            //mostrar modal de subir doc de trabajo con revisiones 
            function cambiadocrev(idt){
                $("#idt").val(idt);
                $("#caso").val('cambiardocrev');
                if (confirm('@@pdocrev@@?')) {                                            
                        $('#modal-dialog3').removeAttr('style');
                        $('#modal-dialog3').modal({
                             show: 'true'
                        });             
                }
            }
            //mostrar modal de aceptar horario
            function aceptarhorario(idt){
                $("#idt").val(idt);
                $("#caso").val('aceptarhorario'); 
                $('#rd_si').prop("checked",false);
                $('#rd_no').prop("checked",false);
                $.ajax({
                        url: "form/gestion_trabajos/plantillas/funciones.php",
                        type: "POST",
                        data: $('#form_trabajos_subidos').serialize(),
                        success: function (resp) { 
                            //alert(resp)
                            console.log(resp);
                            if(typeof resp != 'NULL'){
                                var dataJson = JSON.parse(resp);
                                $('#horasugirio').val(dataJson.horario_sugerido);
                                $('#fechapresentacion').val(dataJson.fecha_presentacion);
                                $('#horapresentacion').val(dataJson.hora_presentacion);
                                if(dataJson.horario_aceptado == 1){
                                    $('#rd_si').prop("checked",true);                                  
                                }else{
                                    $('#rd_no').prop("checked",true);                                  
                                }
                                 $('#modal-dialog4').removeAttr('style');
                                  $('#modal-dialog4').modal({
                                       show: 'true'
                                  });
                            }else{
                                alert('Aun no se ha establecido un horario para este trabajo, Inténtelo luego.!!!');
                            }
                             
                        }
                    });
                           
               
            }
</script>
</HTML>
