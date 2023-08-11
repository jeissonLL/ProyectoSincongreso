<?php

/*
 * Archivo formulario de subir trabajos
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
	<link href="../plugins/multiupload-om/css/jquery.filer.css" rel="stylesheet">
	<link href="../plugins/multiupload-om/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet">

	<!-- Jvascript -->
	<!--<script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>-->
	<script src="../plugins/multiupload-om/js/jquery.filer.min.js" type="text/javascript"></script>
        <script src="../plugins/multiupload-om/js/custom.js" type="text/javascript"></script>

    </HEADER>
    <BODY>

 
<div class="row">
    <div class="col-sm-12" align="center">
        <form enctype="multipart/form-data" method='POST' name='form_subir_trabajos'  id='form_subir_trabajos' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
        <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <h4 class="m-t-0 header-title"><b>@@subir_trabajos@@</b></h4><!---->
            <p class="text-muted m-b-30 font-13"></p> <!---->
            <style>
                                    .ui-autocomplete.ui-front
                                                {
                                                z-index: 1051;
                                                }
                                    </style>
            
            
                   <div class="col-md-12">
                       <!--<form  class="form-horizontal" role="form" id="form_certificados" name="form_certificados">-->   
<!--                       <div class="form-group">
                            <label class="col-md-5 control-label">@@congreso@@</label>
                            <div class="col-md-4">
                                <select class="form-control"  id="congreso" name="congreso" >   
                                    
                                </select>
                            </div>
                        </div> -->
                       <div class="form-group">
                            <label class="col-md-5 control-label">@@tipo_trabajo@@</label>
                            <div class="col-md-4">
                                <select class="form-control"  id="ttrabajo" name="ttrabajo" onchange="valida_tp(this.value);">   
                                    
                                </select>
                            </div>
                        </div>                       
                        <div class="form-group" >
                            <label class="col-md-5 control-label">@@titulo_trabajo@@</label>
                            <div class="col-md-4">
                                <textarea id="titulo_trabajo" name="titulo_trabajo" type="text" class="form-control" placeholder="@@PH_titulo_trabajo@@"></textarea>
                            </div>
                        </div>                      
                        <div class="form-group">
                            <label class="col-md-5 control-label">@@resumen_trabajo@@</label>
                            <div class="col-md-4">
                                <textarea id="resumen_trabajo" name="resumen_trabajo" type="text" class="form-control" placeholder="@@PH_resumen_trabajo@@" ></textarea>
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-md-5 control-label">@@resumen_abreviado_programa@@
                                <p class="text-danger"><label id="n_caracteres"></label>&nbsp;@@leyenda_resumen_abreviado@@</p></label>
                            <div class="col-md-4">
                                <textarea id="resumen_abreviado" name="resumen_abreviado" type="text" class="form-control" placeholder="@@PH_resumen_abreviado@@"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">@@palabras_clave@@
                            <p class="text-danger"><label id="n_palabras"></label>&nbsp;@@leyenda_palabras_clave@@</p></label>
                            <div class="col-md-4">
                                <textarea id="palabras_clave" name="palabras_clave" type="text" class="form-control" placeholder="@@PH_palabras_clave@@"></textarea>
                            </div>
                        </div>                       
                       <div class="form-group">
                            <label class="col-md-5 control-label">@@idioma_trabajo@@</label>
                            <div class="col-md-4" > 
                                 <select class="form-control"  id="idioma" name="idioma">   
                                   
                                </select>
                            </div>
                        </div>
<!--                       <div class="form-group">
                            <label class="col-md-5 control-label">@@tematicas@@
                                <p class="text-danger">@@leyenda_tematicas@@</p></label>                            
                            <div class="card-box col-md-7"   id="checkbox_tematicas" name="checkbox_tematicas">                               
                            </div>
                       </div>-->
                       <div class="form-group" align="center">
                           <label class="col-md-5 control-label" >@@tematicas@@<p class="text-danger">@@leyenda_tematicas@@</p></label>
                           <div class="col-md-4" align="right">
                                <label class="control-label" >@@tprincipal@@</label><br>
                                <select class="form-control"  id="tematicas_trabajo" name="tematicas_trabajo" onchange="tcarga(this.value);">   
                                   
                                </select>
                            </div> 
                        </div>
                        <div class="form-group" align="center">
                            <label class="col-md-5 control-label" ></label>   
                            <div class="col-md-4" id="div_tem2" name="div_tem2" style="display: none;" align="right"> 
                                <label class="control-label" >@@tsecundaria@@</label><br>
                                <select class="form-control"  id="tematicas_trabajo2"  name="tematicas_trabajo2" onchange="tcarga1(this.value);">   
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group" align="center">
                            <label class="col-md-5 control-label" ></label> 
                            <div class="col-md-4" id="div_tem3" name="div_tem3" style="display: none;" align="right"> 
                               <label class="control-label" >@@tterciaria@@</label><br>
                                 <select  class="form-control"  id="tematicas_trabajo3" name="tematicas_trabajo3">   
                                   
                                </select>
                            </div>
                       </div>
<div class="form-group" align="left" id="publipremio" name="publipremio" style="display: none;">
                            <label class="col-md-5 control-label">@@participar_premio@@</label>
                            <div class="col-md-4">
                               <div class="radio radio-primary">
                                        <input type="radio" name="premio_si" id="premio_si" value="1">
                                        <label for="premio_si">@@si@@</label></input>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" name="premio_no" id="premio_no" value="0" checked="true">
                                    <label for="premio_no">@@no@@</label></input>
                                </div>                               
                            </div>
                        </div>
<div class="form-group" align="left" id="publirevista" name="publirevista" style="display: none;">
                            <label class="col-md-5 control-label">@@publicacion_revista@@</label>
                            <div class="col-md-4">
                                    <div class="radio radio-primary">
                                        <input type="radio" name="revista_si" id="revista_si" value="1">
                                        <label for="revista_si">@@si@@</label></input>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" name="revista_no" id="revista_no" value="0" checked="true">
                                        <label for="revista_no">@@no@@</label></input>
                                    </div>                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">@@hora_sugerida@@</label>
                            <div class="col-md-4">
                                <input id="hora_sugerida" name="hora_sugerida" type="time" min="08:00" max="18:00"  class="form-control"></input>
                            </div>
                        </div>
<div class="form-group"  id="preguntaautores" name="preguntaautores">
                            <label class="col-md-5 control-label">@@tiene_autores@@</label>
                            <div class="col-md-4">
                                    <div class="radio radio-primary">
                                        <input type="radio" name="tautor_si" id="tautor_si" value="1">
                                        <label for="tautor_si">@@si@@</label></input>
                                    </div>
                                    <div class="radio radio-inline">
                                        <input type="radio" name="tautor_no" id="tautor_no" value="0" checked="true">
                                        <label for="tautor_no">@@no@@</label></input>
                                    </div>                               
                            </div>
                        </div>
<div class="form-group" id="tautores" name="tautores" style="display:none">
                             <label class="col-md-5 control-label">@@n_autores@@</label>
                             <div class="col-md-4">
                                 <input id="n_autores" name="n_autores" type="number"  class="form-control" placeholder="@@PH_n_autores@@" min="0" max="0" maxlength="0"></input>
                             </div>
                         </div>
                       <div class="form-group">
                           <label class="col-md-1 control-label" style="display: "></label>
                           <div class="col-md-8" id="coautores" name="coautores" align="center">
                                 
                            </div>
                        </div>
                       <div class="form-group">
                            <label class='col-md-5 control-label' for='fullname'>@@archivo_adjunto@@ <p class="text-danger">@@leyenda_archivo@@</p></label>
                            <div class="col-md-4">
                                <input type="file" id="archivo_trabajo" name="archivo_trabajo" class="btn-default btn-rounded" accept=".odt, .doc, .docx"></input>
                            </div>
                       </div>

                        <div class="form-group" align="center">
                            <button type="button" onclick="subir_trabajo();" id="btn_subir_trabajo" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5">@@btn_subir@@</button>
                            <input type='hidden' name='caso' id='caso' value='insertar_trabajo'/>
                            <input type='hidden' name='id' id='id' value='0'/>
                       </div>
                    <!--</form>-->
                </div>
            </div>
        </div>
        </form>
    </div>

 <!--Tabla lado derecho-->
<!--    <div class="col-sm-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>@@trabajos_subidos@@</b></h4>
            <p class="text-muted m-b-30 font-13"></p> 
            <div class="panel">

    <div class="panel-body">

        <div class="">
            <table class="table table-striped" id="tbl_certificados" name="tbl_certificados">
                <thead>
                <tr>
                    <th>@@titulo_trabajo@@</th>                    
                    <th>@@estado@@</th>
                    <th  style="text-align: right;">@@accion@@</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    

</div>
        </div>
    </div>-->
</div>
</BODY>

<script src="./js/fnc_slc.js" type="text/javascript"></script>
<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<!--<link rel="stylesheet" href="./assets/css/jquery-ui.css">
<script src="./assets/js/jquery-ui.js"></script>-->
<script src="./assets/js/angular.min.js"></script>


<script>
            //FUNCION AUTORES
            $('#coautores').keyup(function (){
                this.value = (this.value + '').replace(/[^0-9]/g, '');
            });  
            function autores(num,limite){
                $("#coautores").html("");               
                if(num != 0 && num <= limite){
                     $("#coautores").append('<p class="text-danger">@@leyenda_coautores@@</p>');
                   for(var i=1;i<=num;i++){
                        $("#coautores").append('<div class="card-box col-md-12" style="background-color: #E3F2E1;"><label class="form-control">@@autor@@'+' '+i+'</label><input autocomplete="false" type="text" name="correo_autor'+i+'" id="correo_autor'+i+'" placeholder="@@PH_correo_autor@@" class="form-control"  onkeypress="autocompletarusuariost(this.value,'+i+');" ></input><input type="text" name="primer_nombre'+i+'" id="primer_nombre'+i+'" placeholder="@@PH_pnombre@@" class="form-control"></input>     <input type="text" name="primer_apellido'+i+'" id="primer_apellido'+i+'" placeholder="@@PH_papellido@@" class="form-control"></input> <p class="text-muted font-13 m-b-15 m-t-20">@@autor_principal@@</p><div class="radio radio-info radio-inline"><input type="radio" id="rd_ap_si'+i+'" value="1" name="rd_ap_si'+i+'" onclick="radios_autores(this.value,'+i+','+num+');"><label for="rd_ap_si'+i+'"> @@si@@ </label></div><div class="radio radio-inline"><input type="radio" id="rd_ap_no'+i+'" value="0" name="rd_ap_no'+i+'" onclick="radios_autores(this.value,'+i+','+num+');" checked="true"><label for="rd_ap_no'+i+'"> @@no@@ </label></div></div>');
                   }    
                }
                
            } 
            //RADIOS DE TIENE AUTORES
            $('#tautor_si').click(function (){
                $(this).prop('checked', true);
                $("#tautor_no").prop('checked', false); 
                $("#tautores").removeAttr("style");
                $("#coautores").removeAttr("style");
            });
            $('#tautor_no').click(function (){
                $(this).prop('checked', true);
                $("#tautor_si").prop('checked', false); 
                $("#tautores").css("display", "none");
                $("#coautores").css("display", "none");
            });
            
            //RADIOS DE PREMIO
            $('#premio_si').click(function (){
                $(this).prop('checked', true);
                $("#premio_no").prop('checked', false);                
            });
            $('#premio_no').click(function (){
                $(this).prop('checked', true);
                $("#premio_si").prop('checked', false);                               
            });
            //RADIOS DE REVISTA
            $('#revista_si').click(function (){
                $(this).prop('checked', true);
                $("#revista_no").prop('checked', false);                
            });
            $('#revista_no').click(function (){
                $(this).prop('checked', true);
                $("#revista_si").prop('checked', false);                               
            });        
            function radios_autores(valor,fila, num){
                if(valor == 0){
                    $("#rd_ap_no"+fila).prop('checked', true);
                    $("#rd_ap_si"+fila).prop('checked', false);
                }else{ 
                    for(var i=1;i<=num;i++){                                                   
                        $("#rd_ap_si"+i).prop('checked', false);
                        $("#rd_ap_no"+i).prop('checked', true);
                    }
                    $("#rd_ap_si"+fila).prop('checked', true);
                    $("#rd_ap_no"+fila).prop('checked', false); 
                }
//                return true;
            }
          
</script>
</HTML>
