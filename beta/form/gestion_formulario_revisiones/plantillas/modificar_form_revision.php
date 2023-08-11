<?php

/* 
 * Modificacion de formularios de revisión 
 * Brayan Triminio 
 * 12/01/2017
 */
?>
<?php

/*
 * Archivo formulario de creación formularios 
 * Autor: brayan triminio
 * fecha: 08/06/17
 */

?>
<HTML>
    <HEADER>
    <link rel="stylesheet" href="../plugins/magnific-popup/dist/magnific-popup.css" />
    <link rel="stylesheet" href="../plugins/jquery-datatables-editable/datatables.css" />
    <link href="../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
    </HEADER>
    <BODY>

<div class="row">   
        <form enctype="multipart/form-data" method='POST' name='form_a_tematica'  id='editar_formulario_tematica' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <!--<h4 class="m-t-0 header-title"><b>@@mis_trabajos@@</b></h4>-->
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@modificar_form_revision@@</b></h4>
                                <p class="text-muted m-b-25 font-13" style="text-align: justify">
                                    @@info_modificar@@
                                </p>
                                <div class="panel">
                                    <div class="col-sm-3">
                                    <div id="tbl_form_tem_filter" class="dataTables_filter">
                                        <label>@@buscar@@:
                                            <input type="search" id="buscar" onkeyup="doSearch()" class="form-control input-sm" placeholder="" aria-controls="tbl_form_tem">
                                        </label>
                                        </div><br>
                                    </div>
                                    <div class="panel-body">
                                             <table class="table table-striped" id="tbl_editar_form">
                                                <thead>
                                                <tr class="alert alert-success">
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="15%">@@formulario@@ </th>
                                                    <th width="15%">@@descripcion@@</th>
                                                    <th width="15%" >@@tematica@@</th>
                                                    <th colspan="3" width="6%" >@@acciones@@</th>
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
                <!-- #modal-dialog1 -->                                    
                <div class='modal fade' id=''  >                                    
                    <div class='modal-dialog' >
                        <div class='modal-content'>
                            
                            <table class="table table-striped" id="tbl_preguntas_cualitativas">
                                <thead>
                                <tr class="alert alert-success">
                                    <th width="3%%" >@@num@@</th>
                                    <th width="15%">@@pregunta@@ </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>                                    
                </div>
                <div id='preguntas_cualitativas' class='modal fade bs-example-modal-lg' tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"  style='display:none;' >                                    
                        <div class='modal-dialog modal-lg' >
                                   <div class='modal-content'>
                                        <div class='modal-header' align="center">
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                                <h4 class='modal-title'>@@editarform@@ <a id=""></a></h4>
                                        </div>
                                        <div class='modal-body'>
                                                    <div class="modal-header">
                                                    <h4 class="text-success">@@nomb_formulario@@</h4>
                                                    <p id="nform" style="font-weight: bold;text-indent: 1cm;"></p>
                                                    </div>
                                            <br>
                                               <div class="row" style="float: right; width: 102%">
                                                <div class="col-sm-12">
                                                    <div class="card-box"> 
                                                        <div class="form-control" align="center">
                                                            <label align="center" class="text-success">@@preguntascuantitativas@@</label>
                                                        </div>
                                                        
                                                        <p class="text-muted m-b-30 font-13" style="text-align: justify; width: 90%; margin-left: 3%;">
                                                            @@info_modificar_pcuantis@@
                                                        </p>
                                                        <div> 
                                                            <span><a href='#' class="btn btn-primary waves-effect waves-teal m-b-5" id="agregar_pregunta" title='@@agregar_pregunta@@'  > <i class='ion ion-plus'></i> @@agregar_pregunta@@</a> </span>
                                                            <span><a href='#' style="display: none" class="btn btn-success waves-effect waves-teal m-b-5" id="guardar_pregunta" title='@@btn_guardar@@'  > @@agregar_pregunta@@</a> </span>
                                                        </div><br>
                                                        <div id="p_cuanti1" style="display: none">
                                                            <div class="form-group clearfix">
                                                                <label class="col-md-2 control-label " for="pregunta">@@pre@@</label>
                                                                <div class="col-md-7">
                                                                    <input class="form-control required" id="pregunta" name="pregunta" type="text"  >
                                                                </div>
                                                            </div>

                                                            <div class="form-group clearfix"  >
                                                                <label class="col-md-2 control-label " >@@tipopregunta@@</label>
                                                                    <div class="col-md-5">
                                                                        <select class="form-control" id="sel1">
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div id="opciones_ponderaciones1">
                                                            
                                                        </div>
                                                        <div class="form-group clearfix" id="opcionespeso1" style="display: none">
                                                            <label class="col-md-2 control-label " for="pregunta">@@opcion@@</label>
                                                            <div class="col-md-2">
                                                                <input class="form-control required " placeholder="@@opcion@@" id="pregunta" name="pregunta" type="text"  >
                                                            </div>

                                                            <div class="col-md-2"  >
                                                                <input id="peso" class="form-control required" placeholder="@@peso@@" type="text" maxlength="6" onkeypress="return valida(event,this)" >
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div id="nuevas_pcuantis"> 
                                                        
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table id="tblpreguntascuantitativas" name="tabla" class="table table-striped m-b-0">
                                                                <thead>
                                                                <tr>
                                                                    <th width='25%'>@@pregunta@@</th>
                                                                    <th width='15%'>@@opciones@@</th>
                                                                    <th width='15%'>@@peso@@</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="preg_cuanti">

                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="ponderaciones" value="">
                                            <input type="hidden" id="opciones" value="">
                                            <input type="hidden" id="idnumero" value="">
                                            <input type="hidden" id="idform" value="">
                                            <input type="hidden" id="tipo" value="">
                                            <br>
                                            <div class="row" style="float: right; width: 102%">
                                                <div class="col-sm-12">
                                                    <div class="card-box"> 
                                                        <div class="form-control" align="center">
                                                            <label align="center" class="text-success">@@preguntascualitativas@@</label>
                                                        </div>
                                                        <div> 
                                                        <p class="text-muted m-b-30 font-13" style="text-align: justify; width: 90%; margin-left: 3%;">                                                            
                                                        </p>
                                                            <span><a href='#' class="btn btn-primary waves-effect waves-teal m-b-5" id="agregar_pregunta_cualitativa" title='@@agregar_pregunta@@'  > <i class='ion ion-plus'></i> @@agregar_pregunta@@</a> </span>
                                                            <span><a href='#' style="display: none" class="btn btn-success waves-effect waves-teal m-b-5" id="guardar_pregunta_cualitativa" title='@@btn_guardar@@'  > @@agregar_pregunta@@</a> </span>
                                                        </div><br>
                                                        <div class="form-group clearfix" id="hijo1" style="display: none">
                                                            <label class="col-md-2 control-label " for="pregunta">@@pre@@</label>
                                                            <div class="col-md-7">
                                                                <input class="form-control required" id="pregunta" name="pregunta" type="text"  >
                                                            </div>
                                                        </div>
                                                        <div id="nuevas_pcualis">
                                                            
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table id="tblpregunrascualitativas" name="tabla" class="table table-striped m-b-0">
                                                                <thead>
                                                                <tr>
                                                                    <th width='50%'>@@tipo_pregunta@@</th>
                                                                    <th width='50%'>@@pregunta@@</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="datos">

                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div  class="modal-header" >
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@btn_cerrar@@</button>
                                                <button type="button" class="btn btn-success waves-effect" id="btn_modificar_form" >@@btn_guardar@@</button>
                                        </div>
                                    </div>
                        </div>                                    
                </div>
                
               <!-- /modal-dialog1 -->
        </form>
    </div>
</BODY>

<script src="../plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="../plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.js"></script>
<script src="../plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="../plugins/tiny-editable/numeric-input-example.js"></script>
<script src="assets/pages/datatables.editable.init.js"></script>
<script src="./js/gestion_formulario_revisiones/modificar_form_revision.js"></script>

<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_editar_form');
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

$('#tblpregunrascualitativas').editableTableWidget().numericInputExample().find('td:first').focus();
$('#tblpreguntascuantitativas').editableTableWidget().numericInputExample().find('td:first').focus();


 function valida(e, field) {
  var key = e.keyCode ? e.keyCode : e.which
  // backspace
  if (key == 8) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    regexp = /.[0-9]{2}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false
 
}
</script>
<script src="./js/fnc_slc.js" type="text/javascript"></script>



