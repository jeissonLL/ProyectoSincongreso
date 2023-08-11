<?php

/* 
 * Crear y emitir programa
 * @Autor: OBED MR.
 */

?>
<form enctype="multipart/form-data" method='POST' onsubmit="" name='form_emitir_programa'  id='form_emitir_programa' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
         <div class="row"> 
          <div class="col-sm-12" >
                    <div class="col-lg-12" >                            
                        <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title"><b>@@crear_emitir_programa@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p> 
                                        <div class="form-group">
                                        <label class='col-md-5 control-label' for='fullname'>@@nombre_programa@@</label>
                                             <div class="col-md-4">
                                                 <textarea id="nombre_programa" name="nombre_programa" class="form-control" placeholder="@@nombre_programa@@" type="text"></textarea>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                        <label class='col-md-5 control-label' for='fullname'>@@descripcion_programa@@</label>
                                             <div class="col-md-4">
                                                 <textarea id="descripcion_programa" name="descripcion_programa" class="form-control" placeholder="@@nombre_programa@@" type="text"></textarea>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                        <label class='col-md-5 control-label' for='fullname'>@@estado@@</label>
                                             <div class="col-md-4">
                                                 <select id="estado_programa" name="estado_programa" class="form-control" placeholder="@@estado_programa@@" onchange="">
                                                     <option value="0">@@seleccione@@</option>
                                                     <option value="1">@@activo@@</option>
                                                     <option value="2">@@inactivo@@</option>
                                                 </select>
                                             </div>
                                        </div> 
                                        <div class="form-group" id="act_programa" style="display: none;" >
                                            <label class='col-md-3 control-label' for='fullname'></label>
                                            <div class="col-md-5 col-lg-6" aling="center">
                                                <table class="table table-bordered m-0" id="tbl_act_programa" name="tbl_act_programa">
                                                    <thead>
                                                        <tr class='alert alert-success'> 
                                                            <th width="100%" style="text-align: center;" colspan="2">@@acts_programa@@</th>                                                            
                                                          </tr>
                                                        <tr class='alert alert-success'> 
                                                            <th width="80%" style="text-align: center;">@@actividad@@</th>
                                                            <th width="20%" style="text-align: center;">@@opcion@@</th>
                                                          </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                           
                                        </div>
                                         <div class="form-group" align="center">
                                            <button type="button" onclick="guardar_asociar_act_programa();" id="btn_guardar_asociar_act_programa" class="btn btn-success btn-rounded w-md waves-effect waves-light m-b-5">@@btn_crear_programa@@</button>
                                            <input type='hidden' name='caso' id='caso' value='guardar_programa'/>  
                                            <input type='hidden' name='idprog' id='idprog' value='0'/> 
                                       </div>
                                        
                                </div>
                        </div>
                  </div>               
              </div>          
             </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-lg-12" >                            
                        <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title"><b>@@programas_creados@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p> 
                                        <div class="form-group">
                                            <div class="panel">
                                                    <div class="panel-body">
                                                        <div class="">
                                                            <table class="table table-striped" id="tbl_programa_creado" name="tbl_programa_creado">
                                                                <thead>
                                                                    <tr class='alert alert-success'> 
                                                                        <th width="5%" style="text-align: justify;">N.</th>
                                                                        <th width="40%" style="text-align: center;">@@nombre_programa@@</th>
                                                                        <th width="50%" style="text-align: center;">@@actividades@@</th>
                                                                        <th width="10%">@@opciones_programa@@</th>
                                                                        <th width="10%">@@exportar@@</th>
                                                                        <!--<th width="55%" style="text-align: center;" colspan="2">@@trabajos_sesion@@</th>-->
                                                                        <!--<th width="15%" style="text-align: center;">@@opciones@@</th>-->
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                </tbody>
                                                            </table>
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
    <div class="row" style="display: none;" id="exportacion_programa"> 
                  <div class="col-sm-12" >
                       <div class="col-lg-12" >                            
                                <div class="card-box p-b-0" >  
                                           <div class="card-box" style="background-color: #dae6ec;">
                                               <h4 class="m-t-0 header-title"><b>@@opciones_de_exportacion_programa@@</b></h4>
                                                <p class="text-muted m-b-30 font-13"></p> 
                                                <div class="form-group">
                                                    <div class="panel">
                                                            <div class="panel-body">
                                                                <div class="">
                                                                    <table class="table table-striped" id="tbl_opciones_exportacion_programa" name="tbl_opciones_exportacion_programa">
                                                                        <thead>
                                                                            <tr class='alert alert-success' >                                                                        
                                                                                <th width="100%" colspan="10" style="text-align: justify;">@@opciones_exportacion@@</th>                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody >
                                                                            <tr class="active"  style="background-color: #dae6ec; border: 2px solid #F5BCA9;">
                                                                                <!-- <td></td> -->
                                                                                <td style="border: 2px solid #F5BCA9;" align="center" id='btn_expor_excel'  align='left' width='5%'><a style="cursor: pointer;" class='btn btn-success waves-effect waves-light btn-lg m-b-5' title='@@total_t_excel@@'  ><i class='fa  fa fa-file-excel-o'></i></a><br><b>@@cant_trabajos@@</b></td>
                                                                                <td style="border: 2px solid #F5BCA9;" align="center" id='btn_expor_pdf'  align='left' width='5%'><a style="cursor: pointer;" class='btn btn-danger waves-effect waves-light btn-lg m-b-5' title='@@p_interna@@' target="_blank" ><i class='fa  fa fa-file-pdf-o'></i></a><br><b>@@ponentes_internacionales@@</b></td>                                                                                
                                                                                <td style="border: 2px solid #F5BCA9;" align="center" id='btn_expor_excel_indice_autores'  align='left' width='5%'><a style="cursor: pointer;"  class='btn btn-success waves-effect waves-light btn-lg m-b-5' title='@@total_t_excel@@'  ><i class='fa  fa fa-file-excel-o'></i></a><br><b>@@indice_autores@@ </td>
                                                                                <!--<td style="border: 2px solid #F5BCA9;" align="center" id='btn_expor_pdf_indice_presidentes_sesion'  align='left' width='5%'><a href="form/gestion_programa/plantillas/ponentes_internacionales.php"  class='btn btn-danger waves-effect waves-light btn-lg m-b-5' title='@@p_interna@@' target="_blank"  ><i class='fa  fa fa-file-pdf-o'></i></a><br><b>@@indice_moderadores@@</b></td>-->
                                                                                <td style="border: 2px solid #F5BCA9;" align="center" id='btn_expor_excel_trab_sp'  align='left' width='5%'><a style="cursor: pointer;"  class='btn btn-success waves-effect waves-light btn-lg m-b-5' title='@@total_t_excel@@'  ><i class='fa  fa fa-file-excel-o'></i></a><br><b>@@trab_sesiones_paralelas@@</b></td>                                                                                
                                                                                <td style="border: 2px solid #F5BCA9;" align="center" id='btn_expor_pdf_programa_resumido'  align='left' width='5%'><a style="cursor: pointer;"  class='btn btn-danger waves-effect waves-light btn-lg m-b-5' title='@@p_interna@@' target="_blank"  ><i class='fa  fa fa-file-pdf-o'></i></a><br><b>@@programa_resumido@@</b></td>
                                                                                <td style="border: 2px solid #F5BCA9;" align="center" id='btn_expor_excel_programa_completo'  align='left' width='5%'><a style="cursor: pointer;"  class='btn btn-success waves-effect waves-light btn-lg m-b-5' title='@@total_t_excel@@'  ><i class='fa  fa fa-file-excel-o'></i></a><br><b>@@programa_completo@@</b></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
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


<!--<script src="./js/fnc_slc.js" type="text/javascript"></script>-->
<!--<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="./assets/css/jquery-ui.css">
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/angular.min.js"></script>-->
<script src="./js/gestion_programa/gestion_programa.js"></script>
<script src="./js/gestion_programa/descargar_programa.js"></script>
<script src="./js/gestion_programa/jquery.table2excel.min.js"></script>

<!--FooTable-->
<script src="../plugins/footable/js/footable.all.min.js"></script>
<!--FooTable Example-->
<script src="assets/pages/jquery.footable.js"></script>
<script>
       
</script>
