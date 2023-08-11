<?php

/*
 * Archivo Asistencia Autores  
 * Autor: brayan triminio
 * fecha: 31/08/17
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
                                <h4 class="m-t-0 header-title"><b>@@asistencia_autores@@</b></h4>
                                <p class="text-muted m-b-30 font-13" style="text-align: justify">@@info_asist_autor@@</p> 
                                <div class="panel">
                                    <div class="col-sm-3">
                                    <div id="tbl_form_tem_filter" class="dataTables_filter">
                                        <label>@@buscar@@:
                                            <input type="search" id="buscar" onkeyup="doSearch()" class="form-control input-sm" placeholder="" aria-controls="tbl_form_tem">
                                        </label>
                                        </div><br>
                                    </div>
                                    <div class="panel-body" >
                                             <table class="table table-striped" id="tbl_asis_autores" >
                                                <thead>
                                                <tr class="alert alert-success">
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="15%">@@titulo_trabajo@@ </th>
                                                    <th width="3%">@@aprincipal@@</th>
                                                    <th colspan="2" width="3%">@@accion@@</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        <ul class="pager m-b-0 wizard">
                                            <li class="next"><a  id="validar_asis_autores" class="btn btn-primary waves-effect waves-light">@@validar_asistencia_autor@@</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
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
<script src="./js/voluntarios/voluntarios.js"></script>
<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_asis_autores');
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