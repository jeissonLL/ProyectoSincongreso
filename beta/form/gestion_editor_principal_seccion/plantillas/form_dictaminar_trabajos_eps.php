<?php

/*
 * Dictaminar trabajos editor secundario de seccion
 * Autor: Brayan Triminio
 * fecha: 20/06/17
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

    </HEADER>
    <BODY>

 
<div class="row">   
        <form enctype="multipart/form-data" method='POST' name='form_dictaminar_trabajos_eps'  id='form_dictaminar_trabajos_eps' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <!--<h4 class="m-t-0 header-title"><b>@@mis_trabajos@@</b></h4>-->
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@eg_trabajos@@</b></h4>
                                <p class="text-muted m-b-30 font-13"></p> 
                                <div class="panel">
                                    
                                    <div class="panel-body">                                       
                                            <table class="table table-striped" id="tbl_dictaminar_trabajos_eps" name="tbl_dictaminar_trabajos_eps">
                                                <thead>
                                                <tr class='alert alert-success'>
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="25%"  >@@titulo_trabajo@@</th> 
                                                    <th width="10%" style="text-align: center;">@@tipo_trabajo@@</th>
                                                    <th width="9%" style="text-align: center;">@@idioma@@</th>
                                                    <th width="23%" style="text-align: center;">@@estado@@</th>                                                    
                                                    <th colspan="6" style="text-align: center;margin: auto;vertical-align: bottom;">@@acciones@@</th>
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
             <input type="hidden" id="caso" name="caso" value=""/>
        </div>
            
            
            
            
            
                <!-- #modal-dialog-infot--> 
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
                                                    <h4 class="text-success">@@resumentrab@@</h4>
                                                    <p id="resutrab" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@fechatrab@@</h4>
                                                    <p id="fechtrab" style="font-weight: bold;text-indent: 1cm;"></p>                                                        
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@descargartrabajo@@</h4>
                                                    <div id="urlmodalinfo" style="text-indent: 0.5cm;"></div>
                                                    </div><!--<div class="modal-header">
                                                    <h4 class="text-success">@@estadotrab@@</h4>
                                                    <p id="estadtrab" class="text-danger" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div>-->
                                        </div>
                                        <div class='modal-footer'>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@btn_cerrar@@</button>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
               <!-- /modal-dialog -->
            
                <!-- #modal-dialog-dictaminat -->                                    
                <div id='modal-dialog-dictaminat' class='modal fade bs-example-modal-lg' tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"  style='display:none;' >                                    
                        <div class='modal-dialog modal-lg' >
                                   <div class='modal-content'>
                                        <div class='modal-header' align="center">
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@formevaluaciontrab@@ <a id="idtrabd"></a></h4>
                                        </div>
                                        <div class='modal-body'>
                                                    <div class="modal-header">
                                                    <h4 class="text-success">@@titulotrab@@</h4>
                                                    <p id="ttrabd" style="font-weight: bold;text-indent: 1cm;"></p>
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
                                            
                                            <div class="modal-header">
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
                                             <div class="modal-header">
                                                <h4 class="text-success">@@decisiontrab@@</h4>
                                                <div id="desiciontrabajo" style="font-weight: bold;text-indent: 1cm;">
                                                     <div class="col-md-4">
                                                        <select class="form-control" id="tipo_dictamen"  >
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
<!--                                             <div class="modal-header">
                                                <h4 class="text-success">@@observaciones@@</h4>
                                                <div id="obstrabajo" style="font-weight: bold;text-indent: 1cm;"></div>
                                            </div>-->
                                        </div>
                                        <div class='modal-footer'>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@btn_cerrar@@</button>
                                                <button type="button" class="btn btn-success waves-effect" id="btn_dictaminar_eps" >@@btn_guardar@@</button>
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
<script src="./js/gestion_editor_principal_seccion/gestion_trabajos_eps.js"></script>


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
            
</script>
</HTML>
