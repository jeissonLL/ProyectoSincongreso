<?php

/* 
 * Brayan Triminio
 * Validar Voluntario
 * 22/08/17
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
      <form enctype="multipart/form-data" method='POST' name='form_validar_voluntarios'  id='form_validar_voluntarios' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@validar_voluntariado@@</b></h4>
                                <p class="text-muted m-b-30 font-13" style="text-align: justify">@@info_vali_vol@@</p> 
                                <div class="panel">
                                    <div class="panel-body">
                                       <div id="tbl_form_tem_filter" style="float: left;margin-bottom: 15px;">
			                    <label>@@buscar@@:
			                        <input type="search" id="buscar" onkeyup="doSearch()" class="form-control input-sm" placeholder="" aria-controls="tbl_form_tem">
			                    </label>
			                </div><br>
                                            <table class="table table-striped" id="tbl_validacion_voluntario" name="tbl_validacion_voluntario">
                                                <thead>
                                                <tr class='alert alert-success'>
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="40%" >@@nombre_persona@@</th>
                                                    <th width="40%" >@@actividades@@</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                         <ul class="pager m-b-0 wizard">
                                            <li class="next"><a  id="btn_validar_voluntario" class="btn btn-primary waves-effect waves-light">@@validar_voluntariado@@</a></li>
                                        </ul>
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
<script src="./js/gestion_voluntarios/gestion_voluntarios.js"></script>


<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_validacion_voluntario');
    var searchText = document.getElementById('buscar').value.toLowerCase();
    for (var i = 1; i < tableReg.rows.length; i++) {
        var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var found = false;
        for (var j = 0; j < cellsOfRow.length && !found; j++) {
            var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                found = true;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            tableReg.rows[i].style.display = 'none';
        }
    }
}  
</script>
</HTML>

