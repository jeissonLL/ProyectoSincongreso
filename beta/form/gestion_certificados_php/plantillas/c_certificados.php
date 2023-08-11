<?php

/*
 * Archivo que genera diploma de asistentes
 * Autor: Obed Martínez
 * fecha: 20/02/17
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
	<link href="../plugins/multiupload-om/css/jquery.filer.css" rel="stylesheet">
	<link href="../plugins/multiupload-om/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet">

	<!-- Jvascript -->
	<!--<script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script>-->
	<script src="../plugins/multiupload-om/js/jquery.filer.min.js" type="text/javascript"></script>
        <script src="../plugins/multiupload-om/js/custom.js" type="text/javascript"></script>

    </HEADER>
    <BODY>

 
<div class="row">
    <div class="col-sm-6">
        <form enctype="multipart/form-data" method='POST' name='form_certificados'  id='form_certificados' class='form-horizontal form-bord ' data-parsley-validate='true'> 
        <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <h4 class="m-t-0 header-title"><b>@@crea_certificado@@</b></h4><!--CREAR NUEVOSCERFICADO-->
            <p class="text-muted m-b-30 font-13"></p> <!--Administración de Certificados-->
                   <div class="col-md-12">
                       <!--<form  class="form-horizontal" role="form" id="form_certificados" name="form_certificados">-->
                        <div class="form-group"  align="center">
                            <label class="col-md-5 control-label">@@nombre_certificado@@</label>
                            <div class="col-md-7">
                                <textarea id="nombre_c" name="nombre_c" type="text" class="form-control" placeholder="@@PH_nombre_certificado@@"></textarea>
                            </div>
                        </div>
                        <div class="form-group"  align="center">
                            <label class="col-md-5 control-label">@@certificado_especial@@</label>
                            <div class="col-md-7">
                                <div class="radio radio-primary">
                                    <input type="radio" name="rd_si" id="rd_si" value="1">
                                    <label for="rd_si">@@si@@</label></input>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="rd_no" id="rd_no" value="0" checked="true">
                                    <label for="rd_no">@@no@@</label></input>
                                </div>
                            </div>
                        </div>
                       <div class="form-group"  align="center">
                           <label class="col-md-5 control-label" style="display: none;" id="eti_n_persona" name="eti_n_persona">@@nombre_persona@@</label>
                           <div class="col-md-7" id="nombre_persona" name="nombre_persona"></div>
                       </div>
                        <div class="form-group"  align="center">
                            <label class="col-md-5 control-label">@@encabezado_certificado@@</label>
                            <div class="col-md-7">
                                <textarea id="encabezado_c" name="encabezado_c" type="text" class="form-control" placeholder="@@PH_titulo_certificado@@"></textarea>
                            </div>
                        </div>
                        <div class="form-group"  align="center">
                            <label class="col-md-5 control-label">@@motivo_certificado@@</label>
                            <div class="col-md-7">
                                <textarea id="motivo_c" name="motivo_c" type="text" class="form-control" placeholder="@@PH_motivo_certificado@@"></textarea>
                            </div>
                        </div>
                        <div class="form-group" align="center">
                            <label class="col-md-5 control-label">@@pie_certificado@@</label>
                            <div class="col-md-7">
                                <textarea id="pie_c" name="pie_c" type="text" class="form-control" placeholder="@@PH_pie_certificado@@"></textarea>
                            </div>
                        </div>
                       <div class="form-group"  align="center">
                            <label class="col-md-5 control-label">@@personas_va_dirigido@@</label>
                            <div class="col-md-7">
                                <select class="form-control"  id="slcrolescongreso" name="slcrolescongreso" >   
                                    <option value="0">@@seleccione@@</option>
                                </select>
                            </div>
                        </div> 
                       
                         <div class='form-group' align="center">
                                <div class='col-md-6'>
                                    <label class='control-label' for='fullname'>@@personas_registradas@@</label>
                                    <select multiple='' id='origen_certificados' name='origen_certificados' class='form-control'>

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class='control-label' for='fullname'>@@personas_firman@@</label>
                                     <select multiple='' id='destino_certificados' name='destino_certificados' class='form-control'>

                                     </select>
                                 </div>
                        </div>
                        <div class="form-group" id="titulo_firma" align="center" >
                            <label class='control-label' for='fullname'>@@firmas_certificado@@</label>
                        </div>
                        <div class="form-group" id="r_firmas" align="center"></div>
                        <div class="form-group" align="center" id="content_arte">
                            <label class='control-label' for='fullname'>@@arte_certificado@@</label>
                            <input type="file" id="arte" name="arte" class="btn-default btn-rounded"></input>
                        </div>
                        
                        <div class="form-group" id="imagen" align="center"></div>
                        <div class="form-group" align="center">
                            <button type="button" onclick="guardar_certificado();" id="btn_guardar_certificados" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5">@@btn_guardar@@</button>
                            <input type='hidden' name='caso' id='caso' value='insertar_certificados'/>
                            <input type='hidden' name='id' id='id' value='0'/>
                       </div>
                    <!--</form>-->
                </div>
            </div>
        </div>
        </form>
    </div>

 <!--Tabla lado derecho-->
    <div class="col-sm-6">
        <div class="card-box" style="background-color: #dae6ec;">
            <h4 class="m-t-0 header-title"><b>@@certificados_existentes@@</b></h4><!---->
            <p class="text-muted m-b-30 font-13"></p> <!---->
            <div class="panel">

    <div class="panel-body">

        <div class="">
            <table class="table table-striped" id="tbl_certificados" name="tbl_certificados">
                <thead>
                <tr>
                    <th>@@nombre@@</th>
                    <th>@@motivo@@</th>
                    <th  style="text-align: right;">@@accion@@</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <!-- end: page -->

</div> <!-- end Panel -->
        </div>
    </div>
</div>
</BODY>

<script src="./js/fnc_slc.js" type="text/javascript"></script>
<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>



<script>

 //*******FUNCIONES PARA AGREGAR Y QUITAR ELEMENTOS EN SELECT MULTIPLE EN FORM ACTIVIDADES**************************
                function agregar(valor,nombre){
                 //  alert(nombre);
                    mover("origen_certificados", "destino_certificados", valor, nombre);
                }
                function quitar(valor,nombre){

                    mover1("destino_certificados","origen_certificados", valor, nombre);
                }
                function mover(origen, destino, valor, nombre)
                {
                      $("#" + origen + " option:selected" ).removeAttr('onclick');
                      $("#" + origen + " option:selected" ).attr('onclick','quitar(this.value,this.id)');
                      $("#" + origen + " option:selected" ).remove().appendTo("#" + destino);                      
                    $("#r_firmas").append('<div id="div_'+valor+'" ><label>'+nombre+'</label><input id="'+valor+'" class="btn-default btn-rounded" name="'+valor+'" type="file" accept="image/png,image/jpg,image/jpeg"></input></div>');
                    $("#titulo_firma").removeAttr("style");
                }
                function mover1(destino, origen, valor, nombre)
                {
                    $("#" + destino + " option:selected" ).removeAttr('onclick');
                    $("#" + destino + " option:selected" ).attr('onclick','agregar(this.value,this.id);selecccionar();');
                    $("#" + destino + " option:selected").remove().appendTo("#" + origen);
                    $("#div_"+valor).remove();
                }
                function seleccionar(){
                        var d = $('#destino_certificados').val();
                        for(var i=0;i<d.length;i++) {
                            d.options[i].selected = "selected";
                        }
                        if(d==0){
                            $("#titulo_firma").attr("style","display:none");
                        }
                }
                $('#rd_si').click(function (){
                    $(this).attr('checked', true);
                    $("#rd_no").attr('checked', false);
                    $("#eti_n_persona").removeAttr('style');
                    $("#nombre_persona").html("");
                    $("#nombre_persona").append('<textarea id="n_persona" name="n_persona" type="text" class="form-control" placeholder="@@PH_n_persona@@"></textarea>');
                });
                $('#rd_no').click(function (){
                    $(this).attr('checked', true);
                    $("#rd_si").attr('checked', false);
                    $("#eti_n_persona").css("display","none");
                    $("#nombre_persona").html("");                    
                });

</script>
</HTML>
