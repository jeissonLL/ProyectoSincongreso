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
    <div class="col-sm-12">
        <form enctype="multipart/form-data" target="_blank" action="form/gestion_certificados_php/plantillas/pdfcertificados.php" method='POST' name='form_genera_certificados'  id='form_genera_certificados' class='form-horizontal form-bord ' data-parsley-validate='true'> 
        <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <h4 class="m-t-0 header-title"><b>@@genera_certificado@@</b></h4><!--Generar CERTIFICADO-->
            <p class="text-muted m-b-30 font-13"></p> <!--Administración de Certificados-->
                   <div class="col-md-12">
                                           
                        <div class="form-group">
                            <label class="col-md-5 control-label">@@tipo_certificado@@</label>                            
                            <div class="card-box col-md-5"   id="checkbox_certificado" name="checkbox_certificado">                               
                            </div>
                        </div>
                        
                       <div class="form-group" id="nombre_invitado" name="nombre_invitado"></div>
                        <div class="form-group" align="center">
                            <button type="submit"  id="btn_generar_certificados" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5">@@btn_generar@@</button>
                            <input type='hidden' name='caso' id='caso' value='generar_certificados'/>
                            <input type='hidden' name='idcert' id='idcert' value='0'/>
                            <input type='hidden' name='idtrab' id='idtrab' value='0'/>
                       </div>
                    <!--</form>-->
                </div>
            </div>
        </div>
        </form>
    </div>

 <!--Tabla lado derecho-->
   <!-- <div class="col-sm-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>@@certificados_existentes@@</b></h4>
            <p class="text-muted m-b-30 font-13"></p> 
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
   

</div> 
        </div>
    </div>-->
</div>
</BODY>


<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script type="text/javascript">
     function checkval(val,idcer){
         $('input[type=checkbox]').each(function(){
                $(this).prop("checked", false);
         });
         $("#idcertificado"+val).prop("checked", true);
         $("#idtrab").val(0);
         $("#idcert").val(idcer);
     }  
     function checkval1(val,idtrab,nombretrab){
         $('input[type=checkbox]').each(function(){
                $(this).prop("checked", false);
         });
         $("#idtrabajo"+val).prop("checked", true);
         $("#idcert").val(0);
         $("#idtrab").val(idtrab);
     } 
</script>    

</HTML>
