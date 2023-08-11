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
        <!--<link href="../plugins/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />-->

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
            <style>
                .ui-autocomplete.ui-front
                            {
                            z-index: 1051;
                            }
            </style>
 
  
      <form method='POST' name='form_actividades'  id='form_actividades' class='form-horizontal form-bord' data-parsley-validate='true'> 
         <div class="row"> 
          <div class="col-sm-12" >
                    <div class="col-lg-12" >                            
                        <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title" align="center" ><b>@@admon_actividades@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p>                                      
                                        <div class="form-group" align="center" >
                                            <label class="col-md-5 control-label">@@nombre_actividad@@</label>
                                            <div class="col-md-4">
                                                <textarea id="nombre_actividad" name="nombre_actividad" type="text" class="form-control" placeholder="@@nombre_actividad@@"></textarea>
                                            </div>
                                        </div>
                                       <div class="form-group"align="center" >
                                            <label class="col-md-5 control-label">@@responsable@@</label>
                                            <div class="ui-widget col-md-4">
                                                <input type="text" id="responsable" name="responsable" type="text" class="form-control" placeholder="@@responsable@@" onkeypress="autocompletar(this.value);">
                                            </div>
                                        </div>    
                                       <div class="form-group"align="center" >
                                            <label class="col-md-5 control-label">@@fecha@@</label>
                                            <div class="col-md-4">
                                                <input id="fecha" name="fecha" type="date" class="form-control" placeholder="@@fecha@@" />
                                            </div>
                                        </div>                                            
                                       <div class="form-group"align="center" >
                                            <label class="col-md-5 control-label">@@hora_inicio@@</label>
                                            <div class="col-md-4">
                                                <input id="hora_inicio" name="hora_inicio" type="time" class="form-control" placeholder="@@hora_inicio@@" />
                                            </div>
                                        </div>
                                       <div class="form-group"align="center" >
                                            <label class="col-md-5 control-label">@@hora_fin@@</label>
                                            <div class="col-md-4">
                                                <input id="hora_fin" name="hora_fin" type="time" class="form-control" placeholder="@@hora_fin@@" />
                                            </div>
                                        </div>                                        

                                        <div class="form-group"align="center" >
                                            <label class="col-md-5 control-label">@@comentarios@@</label>
                                            <div class="col-md-4">
                                                <textarea id="comentarios" name="comentarios" type="text" class="form-control" placeholder="@@comentarios@@"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group"align="center" >
                                            <label class="col-md-5 control-label">@@espacio_actividad@@</label>
                                            <div class="col-md-4">
                                                 <select id="espacio_actividad" name="espacio_actividad" class="form-control" placeholder="@@espacio_actividad@@" ></select>
                                            </div>
                                        </div>
                                        <div class="form-group"align="center" >
                                            <label class='col-md-5 control-label' for='fullname'>@@tipo_actividad@@</label>
                                             <div class="col-md-4">
                                                <select id="tactividad" name="tactividad" class="form-control" placeholder="@@tipo_actividad@@"></select>
                                             </div>
                                        </div>
                                        <div class="form-group"align="center" >
                                            <label class='col-md-5 control-label' for='fullname'>@@tematica@@</label>
                                             <div class="col-md-4">
                                                <select id="tematicas_trabajo" name="tematicas_trabajo" class="form-control" placeholder="@@tematica@@"></select>
                                             </div>
                                        </div>                                        
                                        <div class="form-group" align="center">
                                            <button type="button" onclick="guardar_actividad();" id="btn_guardar_actividad" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5">@@btn_guardar@@</button>
                                           <input type='hidden' name='caso' id='caso' value='insertar_actividad'/>
                                              <input type='hidden' name='id' id='id' value='0'/>
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
                               <h4 class="m-t-0 header-title"><b>@@actividades_creadas@@</b></h4><!---->
                               <p class="text-muted m-b-30 font-13"></p> <!---->
                               <div class="panel">
                                       <div class="panel-body">
                                           <div class="">
                                               <table class="table table-striped" id="tbl_actividades" name="tbl_actividades">
                                                   <thead>
                                                   <tr class='alert alert-success'>
                                                       <th width="20%" style="text-align: center">@@nombre_actividad@@</th>
                                                       <th width="20%" style="text-align: center">@@responsable@@</th>
                                                       <th width="20%" style="text-align: center">@@descripcion@@</th>
                                                       <th width="20%" style="text-align: center">@@hora_inicio_fin@@</th>
                                                       <th width="20%" style="text-align: center">@@accion@@</th>
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
<script src="./js/gestion_programa/gestion_programa.js"></script>
<!--<script src="./assets/js/jquery-ui.js"></script>-->
<!--<script src="./assets/js/angular.min.js"></script>-->
<script src="./assets/js/jquery-3.2.1.min.js"></script>
<script src="./assets/js/jquery-migrate-3.0.0.js"></script>
  <script src="./assets/js/jquery-ui.js"></script>

<script>
function autocompletar(responsable){ 
    var caso = 'autocompletarresponsable';
    $.post("./form/gestion_programa/plantillas/funciones.php",
    {caso:caso,responsable:responsable}, function (resp) { 

            var json = JSON.parse(resp);

            
            var element = $("#responsable");
            element.autocomplete({
                minLength: 1,
                delay: 100,
                source: json
              });
    }); 
}
</script>
<script>
    /*
ALEXIS ESCOTO 01/02/2023
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
 var myDate = $('#fecha');
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
if(dd < 10)
  dd = '0' + dd;

if(mm < 10)
  mm = '0' + mm;

today = yyyy + '-' + mm + '-' + dd;
myDate.attr("min", today);

function myFunction(){
  var date = myDate.val();
  if(Date.parse(date)){
    if(date < today){
      alert('La fecha no puede ser menor a la actual');
      myDate.val("");
    }
  }
}
    </script>
</HTML>
