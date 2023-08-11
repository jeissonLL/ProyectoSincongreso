<?php

/* 
 * Archivo Gestion de revisiones 
 * Autor:  @Obed
 * fecha: 06/07/17
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

 
  
      <form enctype="multipart/form-data" method='POST' name='form_espacios'  id='form_espacios' class='form-horizontal form-bord <forered' data-parsley-validate='true'> 
         <div class="row"> 
          <div class="col-sm-12" >
                    <div class="col-lg-12" >                            
                        <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title"align="center" ><b>@@admon_espacios@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p>                                      
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@nombre_espacio@@</label>
                                            <div class="col-md-4">
                                                <textarea id="nombre_espacio" name="nombre_espacio" type="text" class="form-control" placeholder="@@PH_nombre_espacio@@"></textarea>
                                            </div>
                                        </div>
                                       <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@nombre_alternativo@@</label>
                                            <div class="col-md-4">
                                                <textarea id="nombre_alternativo" name="nombre_alternativo" type="text" class="form-control" placeholder="@@PH_nombre_alternativo@@"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@descripcion@@</label>
                                            <div class="col-md-4">
                                                <textarea id="descripcion" name="descripcion" type="text" class="form-control" placeholder="@@PH_descripcion_espacio@@"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@cantidad_maxima_personas@@</label>
                                            <div class="col-md-4">
                                                <input id="cant_personas" name="cant_personas" type="number" class="form-control" placeholder="@@PH_cant_max_personas@@" min="0" max="9999"></input>
                                            </div>
                                        </div>
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@cantidad_tomas@@</label>
                                            <div class="col-md-4">
                                                <input id="cant_tomas" name="cant_tomas" type="number" class="form-control" placeholder="@@PH_cant_tomas@@" min="0" max="9999"></input>
                                            </div>
                                        </div>
                                        <div class="form-group" align="center" id="mapa_espacio">
                                            <label class='control-label' for='fullname'>@@mapa_espacio@@</label>
                                            <br>
                                            <input type="file" id="mapa_espacio" name="mapa_espacio" class="btn-default btn-rounded" accept="image/jpeg,image/jpg,image/png"></input>
                                        </div>
                                        <div class="form-group" align="center" id="mapa_espacio_preview"></div>
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@comentarios_adicionales@@</label>
                                            <div class="col-md-4">
                                                <textarea id="comentarios_adicionales" name="comentarios_adicionales" type="text" class="form-control" placeholder="@@PH_comentarios_adicionales@@"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group" align="center">
                                            <button type="button" onclick="guardar_espacio();" id="btn_guardar_espacio" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5">@@btn_guardar@@</button>
                                            <input type='hidden' name='caso' id='caso' value='insertar_espacio'/>
                                            <input type='hidden' name='idespacio' id='idespacio' value='0'/>
                                       </div>
                                    <!--</form>-->
                                </div>
                        </div>
                  </div>
              </div>
             </div>
          <!--Tabla lado derecho-->
             <div class="row"> 
              <div class="col-sm-12" >
                  
                  <div class="col-lg-12" >
                       <div class="card-box p-b-0" >
                        <div class="card-box" style="background-color: #dae6ec;">
                               <h4 class="m-t-0 header-title"><b>@@espacios_creados@@</b></h4><!---->
                               <p class="text-muted m-b-30 font-13"></p> <!---->
                               <div class="panel">
                                       <div class="panel-body">
                                           <div class="">
                                               <table class="table table-striped" id="tbl_espacios" name="tbl_espacios">
                                                   <thead>
                                                   <tr class='alert alert-success'>
                                                       <th width="20%" style="text-align: justify;">@@nombre_espacio@@</th>
                                                       <th width="20%" style="text-align: justify;">@@nombre_alternativo@@</th>
                                                       <th width="10%" style="text-align: center;">@@cantidad_personas@@</th>
                                                       <th width="10%" style="text-align: center;">@@cantidad_tomacorrientes@@</th>
                                                       <th width="20%" style="text-align: center;">@@mapa_espacio@@</th>
                                                       <th width="20%" style="text-align: center;">@@accion@@</th>
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
           </div>
       </form>     


 

</BODY>

<script src="./js/fnc_slc.js" type="text/javascript"></script>
<script src="../plugins/select2/select2.min.js" type="text/javascript"></script>
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<link rel="stylesheet" href="./assets/css/jquery-ui.css">
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/angular.min.js"></script>
<script src="./js/gestion_programa/gestion_programa.js"></script>


<script>
            function aviso(){
                alert('@@nodisponible@@');
            }
            function avisoarchivo(){
                alert('@@trabajonoenviadoarevision@@');
            }
            function avisonoexiste(){
                 alert('@@archivonoexiste@@');
            }
</script>
</HTML>
