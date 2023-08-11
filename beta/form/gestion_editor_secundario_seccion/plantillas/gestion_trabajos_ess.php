<?php

/* 
 * Gestión de trabajos para el usuario con rol editor secundario de sección
 * Brayan Triminio
 * 06/07/2017
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

    <div class="col-sm-12" align="center">
            <div class="card-box" style="background-color: #dae6ec;">
            <div class="row">
            <p class="text-muted m-b-30 font-13"></p> <!---->
                    <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>@@gtrabajos_autor@@</b></h4>
                                <p class="text-muted m-b-30 font-13"></p> 
                                <div class="panel">
                                    <div class="panel-body">
					
			            
			            <div id="trabajos_filtrados0">
			                
			            </div>
			            
			            <div id="trabajos1" >
			            <div class="col-sm-3">
			                <div id="tbl_form_tem_filter" class="dataTables_filter">
			                    <label>@@buscar@@:
			                        <input type="search" id="buscar" onkeyup="doSearch()" class="form-control input-sm" placeholder="" aria-controls="tbl_form_tem">
			                    </label>
			                </div><br>
            				</div>                                       


                                            <table class="table table-striped" id="tbl_trabajos_ess" name="tbl_trabajos_ess">
                                                <thead>
                                                 <tr class="alert alert-success">
				                    <th width="3%">@@num@@ </th>
				                    <th width="25%">@@titulo_trabajo@@ </th>
				                    <th width="10%">@@palabrasclave@@</th>
				                    <th width="15%">@@tipo_trabajo@@</th>
				                    <th width="15%">@@revisores_aceptados@@</th>
				                    <th width="15%">@@revisores_pendientes@@</th>
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
        <input type="hidden" id="tematica" value="">
        <div class='modal fade' id='asignar_revisores_trabajo'  >                                    
                        <div class='modal-dialog' id="modal_revisores1" >
                                    <div class='modal-content'>
                                        <button type="button" class="close" data-dismiss="modal" >
                                            <span>×</span><span class="sr-only">Close</span>
                                        </button>
                                        <div class='modal-header'>
                                                
                                                <h4 class='modal-title'>@@asignar_revisor_trabajo@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row">
                                               <div class='form-group' align="center">
                                                   <div class="col-md-11">
                                                       <label class='control-label' for='fullname'>@@revisores@@</label>
                                                        <select style="height: 95px;" multiple='' id='origen_todos_revisores_ess' name='origen_todos_revisores_ess' class='form-control'>

                                                        </select>      
                                                    </div>

                                                    <div class="col-md-11">
                                                        <label class='control-label' for='fullname'>@@asignar_revisor@@</label>
                                                        <select style="height: 95px;" multiple='' id='destino_revisores_ess' name='destino_revisores_ess[]' class='form-control'>

                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" id="trabajo_a_revisor" value="">
                                        <input type="hidden" id="cancelar_a_revisor" value="">
                                        <input type="hidden" id="caso" value="trabajo_a_revisor">
                                        <input type="hidden" id="caso1" value="cancelar_a_revisor">

                                        <input type="hidden" id="totaltrab" value="">
                                        <input type="hidden" id="idtrabajo" value="">
                                        <div class='modal-footer'>
                                            <a href='javascript:;'  class='btn btn-sm btn-danger btn-rounded' data-dismiss="modal" id="cancelar_asuignar_form_revisor">@@btn_cancelar@@</a>
                                            <a type='button' id="btn_asignar_revisoress" class='btn btn-sm btn-success btn-rounded'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
        </div>
        
        
        <div class='modal fade' id='cancelar_solicitud_revisor_ess'  >                                    
                        <div class='modal-dialog' id="modal_revisores1" >
                                    <div class='modal-content'>
                                        <button type="button" class="close" data-dismiss="modal" >
                                            <span>×</span><span class="sr-only">Close</span>
                                        </button>
                                        <div class='modal-header'>
                                                
                                                <h4 class='modal-title'>@@cancelar_revisor_trabajo@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row">
                                               <div class='form-group' align="center">
                                                   <div class="col-md-11">
                                                       <label class='control-label' for='fullname'>@@revisores@@</label>
                                                        <select style="height: 95px;" multiple='' id='origen_todos_revisores' name='origen_todos_revisores' class='form-control'>

                                                        </select>      
                                                    </div>

                                                    <div class="col-md-11">
                                                        <label class='control-label' for='fullname'>@@cancelar_revisores@@</label>
                                                        <select style="height: 95px;" multiple='' id='cancelar_revisores_ess' name='cancelar_revisores_ess[]' class='form-control'>

                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        <div class='modal-footer'>
                                            <a href='javascript:;'  class='btn btn-sm btn-danger btn-rounded' data-dismiss="modal" id="cancelar_asuignar_form_revisor">@@btn_cancelar@@</a>
                                            <a type='button' id="btn_cancelar_revisor_ess" class='btn btn-sm btn-success btn-rounded'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
        </div>
        
        <div class='modal fade' id='cancelar_revisores_trabajo'  >                                    
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
<script src="./js/gestion_editor_secundario_seccion/gestion_trabajos_ess.js"></script>
<script src="./js/fnc_slc.js" type="text/javascript"></script>

<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_trabajos_ess');
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
     
function agregar(valor,nombre){
    mover("origen_todos_revisores_ess", "destino_revisores_ess", valor, nombre);
}
function quitar(valor,nombre){

    mover1("destino_revisores_ess","origen_todos_revisores_ess", valor, nombre);
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


function agregar1(valor,nombre){
    mover3("origen_todos_revisores", "cancelar_revisores_ess", valor, nombre);
}
function quitar1(valor,nombre){

    mover4("cancelar_revisores_ess","origen_todos_revisores", valor, nombre);
}
function mover3(origen, destino)
{
      $("#" + origen + " option:selected" ).removeAttr('onclick');
      $("#" + origen + " option:selected" ).attr('onclick','quitar1(this.value,this.id)');
      $("#" + origen + " option:selected" ).remove().appendTo("#" + destino);                      

}
function mover4(destino, origen)
{
    $("#" + destino + " option:selected" ).removeAttr('onclick');
    $("#" + destino + " option:selected" ).attr('onclick','agregar1(this.value,this.id);');
    $("#" + destino + " option:selected").remove().appendTo("#" + origen);

}

</script>



