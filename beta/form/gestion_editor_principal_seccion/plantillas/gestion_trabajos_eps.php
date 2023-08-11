<?php

/*
 * Archivo formulario de creación formularios 
 * Autor: brayan triminio
 * fecha: 12/06/17
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


                                            <table class="table table-striped" id="tbl_trabajos_epseccion" name="tbl_trabajos_epseccion">
                                                <thead>
                                                 <tr class="alert alert-success">
				                    <th width="3%">@@num@@ </th>
				                    <th width="25%">@@titulo_trabajo@@ </th>
				                    <th width="10%">@@palabrasclave@@</th>
                                                    <th width="15%">@@tematica@@</th>
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
                                        <div class='modal-header'>
                                                
                                                <h4 class='modal-title'>@@asignar_revisor_trabajo@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row">
                                               <div class='form-group' align="center">
                                                    <div class='col-md-11' id="revisor">
                                                       
                                                    </div>

                                                    <div class="col-md-11">
                                                        <label class='control-label' for='fullname'>@@asignar_revisor@@</label>
                                                        <select style="height: 95px;" multiple='' id='destino_revisores' name='destino_revisores[]' class='form-control'>

                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" id="trabajo_a_revisor" value="">
                                        <input type="hidden" id="cancelar_a_revisor" value="">
                                        <input type="hidden" id="caso" value="trabajo_a_revisor">
                                        <input type="hidden" id="caso1" value="cancelar_a_revisor">
                                        <input type="hidden" id="caso2" value="asignar_trabajo_ess">
                                        <input type="hidden" id="linea_invest" value="">
                                        <input type="hidden" id="totaltrab" value="">
                                        <input type="hidden" id="idtrabajo" value="">
                                        <div class='modal-footer'>
                                            <a href='javascript:;'  class='btn btn-sm btn-danger btn-rounded' id="cancelar_asuignar_form_revisor">@@btn_cancelar@@</a>
                                            <a type='button' id="btn_asignar_revisoreps" class='btn btn-sm btn-success btn-rounded'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
        </div>
        
        
        <div class='modal fade' id='asignar_editores_ss'  >                                    
                        <div class='modal-dialog' id="" >
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                
                                                <h4 class='modal-title'>@@asignar_editores_trabajo@@</h4>
                                        </div>
                                        <div class='modal-body'>
                                            <div class="row">
                                               <div class='form-group' align="center">
                                                   <div class="col-md-11"> 
                                                   <label class='control-label' for='fullname'>@@editores@@</label>
                                                        <select style="height: 95px;" multiple='' id='origen_editores' name='origen_editores[]' class='form-control'>

                                                        </select>
                                                   </div>
                                                    <div class="col-md-11">
                                                        <label class='control-label' for='fullname'>@@asignar_editores@@</label>
                                                        <select style="height: 95px;" multiple='' id='destino_editoes_ss' name='destino_editoes_ss[]' class='form-control'>

                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <a href='javascript:;'  class='btn btn-sm btn-danger btn-rounded' data-dismiss="modal" id="btn_cancelar_editoresss">@@btn_cancelar@@</a>
                                            <a type='button' id="btn_asignar_editoresss" class='btn btn-sm btn-success btn-rounded'>@@btn_guardar@@</a>
                                        </div>
                                    </div>
                        </div>                                    
        </div>
        
        
        <div class='modal fade' id='cancelar_revisores_trabajo'  >                                    
                                                            
        </div>
        <div  id="usuariorolrevisor1" style="visibility: hidden">
             <label class='control-label' for='fullname'>@@revisores@@</label>
            <select style="height: 95px;" multiple='' id='origen_todos_revisores' name='origen_todos_revisores' class='form-control'>

            </select>                                         
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
<script src="./js/gestion_editor_principal_seccion/gestion_trabajos_eps.js"></script>

<script>
function doSearch() {
    var tableReg = document.getElementById('tbl_trabajos_epseccion');
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

$('#cancelar_asuignar_form_revisor').click(function() {
     $('#asignar_revisores_trabajo').modal('toggle');
     b_sm('origen_todos_revisores');
     $('#destino_revisores').find('option').remove().end();    
       
     });
     
function agregar(valor,nombre){
    mover("origen_todos_revisores1", "destino_revisores", valor, nombre);
}
function quitar(valor,nombre){

    mover1("destino_revisores","origen_todos_revisores1", valor, nombre);
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

function agregar2(valor,nombre){
    mover2("origen_todos_revisores2", "destino_revisores2", valor, nombre);
}
function quitar2(valor,nombre){

    mover3("destino_revisores2","origen_todos_revisores2", valor, nombre);
}
function mover2(origen, destino)
{
      $("#" + origen + " option:selected" ).removeAttr('onclick');
      $("#" + origen + " option:selected" ).attr('onclick','quitar2(this.value,this.id)');
      $("#" + origen + " option:selected" ).remove().appendTo("#" + destino);                      

}
function mover3(destino, origen)
{
    $("#" + destino + " option:selected" ).removeAttr('onclick');
    $("#" + destino + " option:selected" ).attr('onclick','agregar2(this.value,this.id);');
    $("#" + destino + " option:selected").remove().appendTo("#" + origen);

}

/**/
function agregar4(valor,nombre){
    mover4("origen_editores", "destino_editoes_ss", valor, nombre);
}
function quitar3(valor,nombre){

    mover5("destino_editoes_ss","origen_editores", valor, nombre);
}
function mover4(origen, destino)
{
      $("#" + origen + " option:selected" ).removeAttr('onclick');
      $("#" + origen + " option:selected" ).attr('onclick','quitar3(this.value,this.id)');
      $("#" + origen + " option:selected" ).remove().appendTo("#" + destino);                      

}
function mover5(destino, origen){
    $("#" + destino + " option:selected" ).removeAttr('onclick');
    $("#" + destino + " option:selected" ).attr('onclick','agregar4(this.value,this.id);');
    $("#" + destino + " option:selected").remove().appendTo("#" + origen);

}



</script>

<script src="./js/fnc_slc.js" type="text/javascript"></script>

