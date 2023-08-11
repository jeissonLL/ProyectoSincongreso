<?php

/* 
 * Brayan Triminio
 * Actividades asignadas a voluntarios
 * 28/08/17
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
      <form enctype="multipart/form-data" method='POST' name='form_revisar_trabajos'  id='form_revisar_trabajos' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@actividades_asignadas@@</b></h4>
                                <p class="text-muted m-b-30 font-13" style="text-align: justify">@@info_act_asig_vo@@</p> 
                                <div class="panel">
                                    <div class="panel-body">
                                       <div id="tbl_form_tem_filter" style="float: left;margin-bottom: 15px;">
			                    <label>@@buscar@@:
			                        <input type="search" id="buscar" onkeyup="doSearch()" class="form-control input-sm" placeholder="" aria-controls="tbl_form_tem">
			                    </label>
			                </div><br>
                                            <table class="table table-striped" id="tbl_act_asignada_voluntarios" name="tbl_act_asignada_voluntarios">
                                                <thead>
                                                <tr class='alert alert-success'>
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="40%" >@@nombre_actividad@@</th>
                                                    <th width="40%" >@@descripcion@@</th>
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
       </form>    
    <div id='modal_info_actividad_voluntario' class='modal fade bs-example-modal-lg' tabindex="-1" role="dialog"  style='display:none;' >                                    
                        <div class='modal-dialog modal-lg' >
                                    <div class='modal-content'>
                                        <div class='modal-header' align="center">
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@info_actividad_voluntario@@:<a id="idtrab"></a></h4>
                                        </div>
                                        <div class='modal-body'>
                                                    <div class="modal-header">
                                                    <h4 class="text-success">@@nombre_tarea@@</h4>
                                                    <p id="ntarea" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@descripcion@@</h4>
                                                    <div id="desc_tarea_vol" style="font-weight: bold;text-indent: 1cm;"></div>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@cantidad_horas_sumar@@</h4>
                                                    <p id="horas_vol_sumar" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@persona_apoyo@@</h4>
                                                    <p id="persona_apoyo" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div><div class="modal-header">
                                                    <h4 class="text-success">@@arhivo_complementario@@</h4>
                                                    <p id="doc_vol_comple" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div>
                                            
                                        </div>
                                        <div class='modal-footer'>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@btn_cerrar@@</button>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
    
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
    var tableReg = document.getElementById('tbl_act_asignada_voluntarios');
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

