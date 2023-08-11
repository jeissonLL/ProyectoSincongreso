<?php

/*
 * Archivo formulario de trabajos revision
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

    </HEADER>
    <BODY>

 
<div class="row">   
        <form enctype="multipart/form-data" method='POST' name='form_trabajos_revision'  id='form_trabajos_revision' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
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
                                    <div class="form-group" align="center">
                                        <label class="col-md-5 control-label" >@@tematicas@@</label>
                                        <div class="col-md-4" align="right">                                             
                                             <select class="form-control"  id="tematicas_trabajo" name="tematicas_trabajo" onchange="construyetrabajos(this.value);">   

                                             </select>
                                         </div> 
                                     </div>
                                    <div class="panel-body">
                                       
                                            <table class="table table-striped" id="tbl_trabajos_subidos_eg" name="tbl_trabajos_subidos_eg">
                                                <thead>
                                                <tr class='alert alert-success'>
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="40%" >@@titulo_trabajo@@</th>                             
                                                    <th width="15%" style="text-align: center;">@@tipo_trabajo@@</th>
                                                    <th width="5%" style="text-align: center;">@@idioma@@</th>
                                                    <th width="10%" style="text-align: center;">@@estado@@</th>
                                                    <th width="15%" style="text-align: center;">@@cautoria@@</th>
<!--                                                    <th width="15%" style="text-align: center;">@@confautoria@@</th>-->
                                                    <th colspan="6" style="text-align: center;">@@acciones@@</th>
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
             <input type="hidden" id="caso" name="caso" value=""/>
        </div>
                <!-- #modal-dialog1 -->                                    
                <div class='modal fade' id='modal-dialog1' style='display:none;' >                                    
                        <div class='modal-dialog' >
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@docinvesteg@@</h4>
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
<script src="./js/gestion_editor_gestor/form_trabajos_revision.js"></script>


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
