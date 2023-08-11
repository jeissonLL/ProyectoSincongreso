<?php

/*
 * Archivo crear listas de las actividades
 * Autor: brayan triminio
 * fecha: 28/07/17
 */

?>
<HTML>
    <HEADER>
    <link rel="stylesheet" href="../plugins/magnific-popup/dist/magnific-popup.css" />
    <link rel="stylesheet" href="../plugins/jquery-datatables-editable/datatables.css" />
    <link href="assets/css/spiner.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/select2/select2.css" rel="stylesheet" type="text/css" />
    </HEADER>
    <BODY>

<div class="row">   
        <form enctype="multipart/form-data" method='POST' name='g_listas'  id='g_listas' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <!--<h4 class="m-t-0 header-title"><b>@@mis_trabajos@@</b></h4>-->
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@listados_actividad@@</b></h4>
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
                                             <table class="table table-striped" id="tbl_listas_actividades" >
                                                <thead>
                                                <tr class="alert alert-success">
                                                    <th width="3%%" >@@num@@</th>
                                                    <th width="15%">@@actividades@@</th>
                                                    <th width="15%">@@fechatrab@@</th>
                                                    <th width="15%">@@espacio@@</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        <ul class="pager m-b-0 wizard">
                                           
                                            <li class="next"><a  id="generar_lista"  href="form/gestion_listas_rotulos/plantillas/listas_actividad.php?actividad=" class="btn btn-primary waves-effect waves-light">@@generar_listas_actividad@@</a></li>
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



<script src="./js/gestion_listas_rotulos/gestion_listas_rotulos.js"></script>
<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_listas_actividades');
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




