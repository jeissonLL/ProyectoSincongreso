<?php

/* 
 * Archivo Mover de trabajos en sesiones paralelas
 * Autor:  @Obed
 * fecha: 29/09/17
 */


?>

<form enctype="multipart/form-data" method='POST' onsubmit="" name='form_mover_trabajos'  id='form_mover_trabajos' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
         <div class="row"> 
          <div class="col-sm-12" >
                    <div class="col-lg-12" >                            
                        <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title"><b>@@mover_trabajos_sesiones_paralelas@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p> 
                                        <div class="form-group">
                                        <label class='col-md-5 control-label' for='fullname'>@@tematica_distribucion@@</label>
                                             <div class="col-md-4">
                                                 <select id="tematicas_trabajo" name="tematicas_trabajo" class="form-control" placeholder="@@tematica@@" onchange="mostrartrab_en_act(this.value);"></select>
                                             </div>
                                        </div>  
                                         
                                        <div class="form-group">
                                            <div class="panel">
                                                    <div class="panel-body">
                                                        <div class="">
                                                            <table class="table table-striped" id="tbl_movertrabajos_sp" name="tbl_movertrabajos_sp">
                                                                <thead>
                                                                    <tr class='alert alert-success'>                                                                        
                                                                        <th width="5%" style="text-align: justify;">N.</th>
                                                                        <th width="69%" style="text-align: center;">@@nombre_sesion@@</th>
                                                                        <th width="10%">@@fecha_trabajo@@</th>
                                                                        <th width="8%">@@hora_inicial@@</th>
                                                                        <th width="8%">@@hora_final@@</th>                                                                        
                                                                        
                                                                        <!--<th width="55%" style="text-align: center;" colspan="2">@@trabajos_sesion@@</th>-->
                                                                        <!--<th width="15%" style="text-align: center;">@@opciones@@</th>-->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                </tbody>
                                                            </table>
                                                            <input type="hidden" id="caso" name="caso" value="cambiartrabajos_de_actividad">
                                                        </div>
                                                    </div>   
                                            </div>
                                        </div>                                        
                                    <!--</form>-->
                                </div>
                        </div>
                  </div>                        
              </div>          
             </div>
             
       </form>    


<script src="./js/fnc_slc.js" type="text/javascript"></script>
<!--<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="./assets/css/jquery-ui.css">
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/angular.min.js"></script>-->
<script src="./js/gestion_programa/gestion_programa.js"></script>

<!--FooTable-->
<script src="../plugins/footable/js/footable.all.min.js"></script>
<!--FooTable Example-->
<script src="assets/pages/jquery.footable.js"></script>
<script>
       
</script>
