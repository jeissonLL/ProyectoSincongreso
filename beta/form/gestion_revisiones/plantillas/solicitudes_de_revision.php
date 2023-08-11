<?php

/*
 * Archivo Gestion de revisiones 
 * Autor: Brayan Triminio
 * fecha: 21/02/17
 */


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

    </HEADER>
    <BODY>

 
<div class="row">   
      <form enctype="multipart/form-data" method='POST' name='form_revisar_trabajos'  id='form_revisar_trabajos' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@rev_trabajos@@</b></h4>
                                <p class="text-muted m-b-30 font-13"></p> 
                                <div class="panel">
                                    <div class="panel-body">
                                       
                                            <table class="table table-striped" id="tbl_revisiones" name="tbl_revisiones">
                                                <thead>
                                                <tr class='alert alert-success'>
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="40%" >@@titulo_trabajo@@</th>                             
                                                    <th width="15%" style="text-align: center;">@@tipo_trabajo@@</th>
                                                    <th colspan="3" style="text-align: center;">@@acciones@@</th>
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
             <input type="hidden" id="idtem" name="idtem" value=""/>
            <input type="hidden" id="caso" value="aceptar_trabajo_revisar"> 
            <input type="hidden" id="nfilapcuanti" name="nfilapcuanti" value=""/> 
            <input type="hidden" id="nfilapcuali" name="nfilapcuali" value=""/> 
            <input type="hidden" id="descargo_archivo" name="descargo_archivo" value="0"/> 
            
        </div>
    
        
            <!-- Tabla para trabajos aceptados a revisar  -->
            <div class="col-sm-12" align="center">
                <div class="card-box" style="background-color: #dae6ec;">
                <div class="row">
                <p class="text-muted m-b-30 font-13"></p> <!---->
                        <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>@@trabajos_acep@@</b></h4>
                                    <p class="text-muted m-b-30 font-13"></p> 
                                    <div class="panel">
                                        <div class="panel-body">

                                                <table class="table table-striped" id="tabajos_aceptados" name="tabajos_aceptados">
                                                    <thead>
                                                    <tr class='alert alert-success'>
                                                        <th width="3%%" >@@num@@</th>
                                                        <th width="35%" >@@titulo_trabajo@@</th>                             
                                                        <th width="17%" >@@palabras@@</th>                             
                                                        <th width="25%" style="text-align: center;">@@tipo_trabajo@@</th>
                                                        <th width="35%" style="text-align: center;">@@tematica@@</th>
                                                        <th width="35%" style="text-align: center;">@@form_lleno@@</th>
                                                        <th colspan="3" style="text-align: center;">@@acciones@@</th>
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
            <!-- Tabla para trabajos aceptados a revisar  -->
             <!-- #modal-dialog--> 
                <div id='modal-dialog-infot' class='modal fade bs-example-modal-lg' tabindex="-1" role="dialog"  style='display:none;' >                                    
                        <div class='modal-dialog modal-lg' >
                                    <div class='modal-content'>
                                        <div class='modal-header' align="center">
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@infotrabajotitulo@@ :<a id="idtrab"></a></h4>
                                        </div>
                                        <div class='modal-body'>
                                                    <div class="modal-header">
                                                    <h4 class="text-success">@@titulotrab@@</h4>
                                                    <p id="ttrab" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@palabrasclave@@</h4>
                                                    <div id="palabrastrab" style="font-weight: bold;text-indent: 1cm;"></div>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@tematicatrab@@</h4>
                                                    <p id="tematrab" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success" >@@resumentrab@@</h4>
                                                    <p id="resutrab" style="font-weight: bold;text-indent: 1cm; text-align: justify" ></p>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@fechatrab@@</h4>
                                                    <p id="fechtrab" style="font-weight: bold;text-indent: 1cm;"></p>                                                        
                                                    </div><div class="modal-header" id="descargar">
                                                        <h4 class="text-success" >@@descargartrabajo@@</h4>
                                                    <div id="urlmodalinfo" style="text-indent: 0.5cm;"></div>
                                                    </div>
                                        </div>
                                        <div class='modal-footer'>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@btn_cerrar@@</button>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
               <!-- /modal-dialog -->
            
             <!-- #modal-dialog-revisatrab -->                                    
                <div id='modal-dialog-revisatrab' class='modal fade bs-example-modal-lg' tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"  style='display:none;' >                                    
                        <div class='modal-dialog modal-lg' >
                                   <div class='modal-content' >
                                        <div class='modal-header' align="center">
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@formevaluaciontrab@@ <a id="idtrabd"></a></h4>
                                        </div>
                                        <div class='modal-body'>
                                                    <div class="modal-header">
                                                    <h4 class="text-success">@@titulotrab@@</h4>
                                                    <p id="ttrabd" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div>
                                            
                                            <div class="form-control" align="center" style="background-color: #dae6ec;">
                                                <label align="center" class="text-success">@@preguntascuantitativas@@</label>
                                            </div>
                                            <div class="modal-header" style="background-color: #dae6ec;">
                                                <table id="pcuanti" class="table table-bordered m-0">
                                                    <thead>
                                                        <tr class='alert alert-success'>
                                                            <th  style="text-align: center;" width='35%'>@@pregunta@@</th>
                                                            <th  style="text-align: center;" width='65%'>@@respuesta@@</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-control" align="center" style="background-color: #dae6ec;">
                                                <label align="center" class="text-success">@@preguntascualitativas@@</label>
                                            </div>
                                            <div class="modal-header" style="background-color: #dae6ec;">
                                                <table id="pcuali" class="table table-bordered m-0">
                                                    <thead >
                                                        <tr class='alert alert-success'>
                                                            <th style="text-align: center;" width='35%'>@@pregunta@@</th>
                                                            <th style="text-align: center;" width='65%'>@@respuesta@@</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                             <div class="modal-header" style="background-color: #dae6ec;">
                                                <h4 class="text-success">@@decisiontrab@@</h4>
                                                <div id="desiciontrabajo" class="col-md-5" style="font-weight: bold;text-indent: 1cm;"></div>
                                            </div>
                                             <div class="modal-header" style="background-color: #dae6ec;">
                                                 
                                                <h4 class="text-success">@@observaciones@@</h4>
                                                <div id="obstrabajo" class="col-md-12" style="font-weight: bold;text-indent: 0.1cm;"></div>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@btn_cerrar@@</button>
                                                <button type="button" class="btn btn-success waves-effect" id="guardarrevisiontrabajo" >@@btn_guardar@@</button>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
               <!-- /modal-dialog1 -->
            
            
       </form>     
    </div>

 <!--Tabla lado derecho-->

</BODY>

<script src="./js/fnc_slc.js" type="text/javascript"></script>
<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<link rel="stylesheet" href="./assets/css/jquery-ui.css">
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/angular.min.js"></script>
<script src="./js/gestion_revisiones/solicitudes_de_revision.js"></script>


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
            function radiosrevtrab(idradio, opcionestot,idpregunta, fila){
                //alert(idradio)
               
               for(var i = 1; i <= opcionestot; i++){
                   //alert(fila)
                  if(i == fila){
                      $("#"+idradio).prop('checked', true); 
                  }else{
                      $("#preg_"+idpregunta+"_"+i).prop('checked', false);
                  }                   
               }
                 
            }
            function descargo_archivo(){                
                $("#descargo_archivo").val(1)
            }
</script>
</HTML>
