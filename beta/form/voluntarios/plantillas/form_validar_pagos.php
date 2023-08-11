<?php

/*
 * Archivo Validar Pagos 
 * Autor: brayan triminio
 * fecha: 01/09/17
 */

?>
<HTML>
    <HEADER>
    <link rel="stylesheet" href="../plugins/magnific-popup/dist/magnific-popup.css" />
    <link rel="stylesheet" href="../plugins/jquery-datatables-editable/datatables.css" />
    <link href="../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
    </HEADER>
    <BODY>

<div class="row" id="tabla_modifivacio">   
        <form enctype="multipart/form-data" method='POST' name='m_itineario'  id='m_itineario' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <!--<h4 class="m-t-0 header-title"><b>@@mis_trabajos@@</b></h4>-->
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@validar_pago@@</b></h4>
                                <p class="text-muted m-b-30 font-13" style="text-align: justify">@@info_pagos@@ </p> 
                                <div class="panel">
                                    <div class="col-sm-3">
                                    <div id="tbl_form_tem_filter" class="dataTables_filter">
                                        <label>@@buscar@@:
                                            <input type="search" id="buscar" onkeyup="doSearch()" class="form-control input-sm" placeholder="" aria-controls="tbl_form_tem">
                                        </label>
                                        </div><br>
                                    </div>
                                    <div class="panel-body" >
                                             <table class="table table-striped" id="tbl_validar_pagos" >
                                                <thead>
                                                <tr class="alert alert-success">
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="25%">@@titulo@@ </th>
                                                    <th width="15%">@@personas_registradas@@ </th>
                                                    <th width="3%">@@correo@@</th>
                                                    <th colspan="2" width="3%">@@accion@@</th>
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
       
        <div class='modal fade' id='pagos_pesona' tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">                                    
            <div class='modal-dialog modal-full'  >
                        <div class='modal-content'>
                            <button type="button" class="close" data-dismiss="modal" >
                                <span>×</span><span class="sr-only">Close</span>
                            </button>
                            <div class='modal-header'>
                                    <h4 class='modal-title'>@@validar_pagos@@</h4>
                            </div>
                            <div class='modal-body'>
                                <div class="row">
                                   <div class='form-group' align="center">
                                        <p class="text-muted m-b-25 font-13" style="text-align: justify">
                                            @@info_validar_pagos@@
                                        </p>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" >@@tipo_pago@@</label>
                                            <div class="col-md-7" align="right" id="tipo_pago">                                             
                                                <select  class="form-control"  id="slc_tipo_pago" name="slc_tipo_pago" onchange="datos_pago(this.value)" >

                                                 </select>
                                             </div> 
                                        </div>
                                        <div id="tours" class="form-group" style="display: none">
                                            <label class="col-md-3 control-label" >@@tipo_tour@@</label>
                                            <div class="col-md-7" align="right">                                             
                                                <select class="form-control"  id="slc_tipo_tour" name="slc_tipo_tour" onchange="datos_pago(this.value)" >

                                                </select>
                                             </div> 
                                        </div>

                                        <div style=" display: none" class="col-sm-12" id="datos_factura">
                                        <div class="card-box"> 
                                            <div class="form-control" align="center">
                                                <label align="center" class="text-success">@@detalle_factura@@</label>
                                            </div>
                                            <div> 
                                            <p class="text-muted m-b-30 font-13" style="text-align: justify; width: 90%; margin-left: 3%;">                                                            
                                            </p>
                                            </div>
                                                                                                    <div class="table-responsive">
                                                <table id="tbl_info_factura" name="tabla" class="table table-striped m-b-0">
                                                    <thead>
                                                    <tr>
                                                        <th width='3'>@@num@@</th>
                                                        <th width='25%'>@@producto@@</th>
                                                        <th width='15%'>@@precio_unitario@@</th>
                                                        <th width='3%'>@@tipo_impuesto@@</th>
                                                        <th width='15%'>@@descripcion@@</th>
                                                        <th width='3%'>@@impuesto@@</th>
                                                        <th width='3%'>@@descuento@@</th>
                                                        <th width='8%'>@@total_antes_isv@@</th>
                                                        <th width='8%'>@@total_con_isv@@</th>
                                                        <th colspan="2">@@accion@@</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="datos_factura_mostrar">

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                    </tr>
                                                    <thead>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                   </div>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <input type="hidden" id="voluntario" value="1">
                                <ul class="pager m-b-0 wizard" id="btn_validar_pago" style="display: none">
                                    <li class="next"><a id="btn_validar_pagos" class="btn btn-primary waves-effect waves-light">@@validar_pago@@</a></li>
                                </ul>
                            </div>
                        </div>
            </div> 
           <input type="hidden" id="persona" value="">
           <input type="hidden" id="usuario" value="">
           <input type="hidden" id="funcion" value="tbl_info_factura">
           <input type="hidden" id="dato" value="0">
           <input type="hidden" id="num" value="1">
           <input type="hidden" id="val_antes_des" value="">
           <input type="hidden" id="val_despues_des" value="">
           <input type="hidden" id="total_a_pagar_persona" value="">
           <input type="hidden" id="id_tr_descuento" value="">
        </div>
        
    </div>

        <div class="modal fade" id='pagos_decuento' tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" style="margin-top: 200px;">
            <div class='modal-dialog modal-lg' style="background-color: white;border-style: solid;border-color: #3bafda;">
                <button type="button" class="close" data-dismiss="modal" >
                        <span>×</span><span class="sr-only">Close</span>
                </button>
                <h4 class="custom-modal-title">@@descuento@@</h4>
                <p class="text-muted m-b-25 font-13" style="text-align: justify;margin-left: 50px;margin-right: 50px;margin-top: 15px;">
                                            @@info_descuento@@
                                        </p>
                <div class="custom-modal-text">
                    <div class='modal-body'>
                        <div class="row">
                            <div class="form-group" id="ingreso_clave">
                                <label class="col-md-2 control-label" >@@clave_descuento@@</label>
                                <div class="col-md-5" align="right" id="">                                             
                                    <input type="password"  id = "clave_desc" name = "clave_desc" maxlength="11" class="form-control" required placeholder="@@clave_descuento@@" />
                                 </div> <br>
                                <label style="display: none" id="error" class="col-md-2 control-label"  >@@error@@</label>
                                <label style="display: none" id="error1" class="col-md-2 control-label"  >@@error1@@</label >
                            </div>
                            <div class="form-group" id="descuento_aplicar">
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <ul style="display: none" class="pager m-b-0 wizard" id="btn_aplicar_descuento">
                            <li  class="next"><a id="aplicar_descuento" class="btn btn-primary waves-effect waves-light">@@aplicar@@</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</BODY>

<!--<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="../plugins/moment/moment.js"></script>
<script type="text/javascript" src="../plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="assets/pages/jquery.xeditable.js"></script>-->

<script src="../plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="../plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.js"></script>
<script src="../plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="../plugins/tiny-editable/numeric-input-example.js"></script>

<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="./js/fnc_select_multiple.js" type="text/javascript"></script>
<script src="assets/pages/datatables.editable.init.js"></script>
<script src="./js/voluntarios/voluntarios.js"></script>
<script src="./js/fnc_slc.js" type="text/javascript"></script>

<script src="../plugins/custombox/dist/custombox.min.js"></script>
<script src="../plugins/custombox/dist/legacy.min.js"></script>

<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_validar_pagos');
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
$('#tbl_info_factura').editableTableWidget().numericInputExample().find('td:first').focus();

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