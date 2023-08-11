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
        <form enctype="multipart/form-data" method='POST' name='form_a_tematica'  id='form_a_tematica' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <!--<h4 class="m-t-0 header-title"><b>@@mis_trabajos@@</b></h4>-->
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@asociar_for_tematica@@</b></h4>
                                <p class="text-muted m-b-30 font-13"></p> 
                                <div class="panel">
                                    <div class="col-sm-3">
                                    <div id="tbl_form_tem_filter" class="dataTables_filter">
                                        <label>@@buscar@@:
                                            <input type="search" id="buscar" onkeyup="doSearch()" class="form-control input-sm" placeholder="" aria-controls="tbl_form_tem">
                                        </label>
                                        </div><br>
                                    </div>
                                    <div class="panel-body">
                                             <table class="table table-striped" id="tbl_form_tem">
                                                <thead>
                                                <tr class="alert alert-success">
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="15%">@@formulario@@ </th>
                                                    <th width="15%">@@descripcion@@</th>
                                                    <th width="15%">@@tematica@@</th>
                                                    <th width="10%">@@asociar@@</th>
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
                <div class='modal fade' id='tematica_form'  >                                    
                        <div class='modal-dialog' >
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                <h4 class='modal-title'>@@asociar_for_tematica@@</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <div class="row">
                                               <div class='form-group' align="center">
                                                    <div class='col-md-11'>
                                                        <label class='control-label' for='fullname'>@@tematicas@@</label>
                                                        <select style="height: 95px;" multiple='' id='origen_tematica' name='origen_tematica' class='form-control'>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-11">
                                                        <label class='control-label' for='fullname'>@@asociar@@</label>
                                                        <select style="height: 95px;" multiple='' id='destino_tematica' name='destino_tematica[]' class='form-control'>
                                                         </select>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="formulario" value="">
                                        <input type="hidden" id="caso" value="asoc_form_tematica">
                                        <div class='modal-footer'>
                                            <a href='javascript:;'  class='btn btn-sm btn-danger btn-rounded' id="cancelar_asociar_form_tematica">@@btn_cancelar@@</a>
                                            <a type='button' onclick="guardar()" class='btn btn-sm btn-success btn-rounded'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
                </div>

               <!-- /modal-dialog1 -->
        </form>
        
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

<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_form_tem');
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

 $('#cancelar_asociar_form_tematica').click(function() {
     $('#tematica_form').modal('toggle');
     b_sm('origen_tematica');
     $('#destino_tematica').find('option').remove().end();    
       
     });

function agregar(valor,nombre){
    mover("origen_tematica", "destino_tematica", valor, nombre);
}
function quitar(valor,nombre){

    mover1("destino_tematica","origen_tematica", valor, nombre);
}
function mover(origen, destino)
{
      $("#" + origen + " option:selected" ).removeAttr('onclick');
      $("#" + origen + " option:selected" ).attr('onclick','quitar(this.value,this.id)');
      $("#" + origen + " option:selected" ).remove().appendTo("#" + destino);                      

}
function mover1(destino, origen)
{
    $("#" + destino + " option:selected" ).removeAttr('onclick');
    $("#" + destino + " option:selected" ).attr('onclick','agregar(this.value,this.id);');
    $("#" + destino + " option:selected").remove().appendTo("#" + origen);

}
                

</script>




