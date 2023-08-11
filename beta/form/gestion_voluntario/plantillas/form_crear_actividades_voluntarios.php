<?php

/* 
 * Creacion de Actividades para Voluntarios
 * Brayan Triminio
 * 15/08/17
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

 
  
      <form enctype="multipart/form-data" method='POST' name='form_actividades_voluntarios'  id='form_actividades_voluntarios' class='form-horizontal form-bord forered' data-parsley-validate='true'> 
         <div class="row"> 
          <div class="col-sm-12" >
                    <div class="col-lg-12" >                            
                        <div class="card-box p-b-0" >  
                                   <div class="card-box" style="background-color: #dae6ec;">
                                       <h4 class="m-t-0 header-title"  align="center"><b>@@admon_actividades@@</b></h4>
                                        <p class="text-muted m-b-30 font-13"></p>                                      
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@nombre_actividad@@</label>
                                            <div class="col-md-4">
                                                <textarea id="nombre_actividad" name="nombre_actividad" type="text" class="form-control" onkeypress="return  SoloLetras_Espacio_uno(event)"  placeholder="@@nombre_actividad@@" required></textarea>
                                            </div>
                                        </div>
                                       <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@descripcion_actividad@@</label>
                                            <div class="col-md-4">
                                                <textarea id="desc_actividad" name="desc_actividad" type="text" class="form-control"  onkeypress="return  SoloLetras_Espacio_uno(event)" placeholder="@@descripcion_actividad@@" required></textarea>
                                            </div>
                                        </div>    
                                                                                 
                                       <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@cantidad_horas_sumar@@</label>
                                            <div class="col-md-4">
                                                <input id="horas_sumar" name="horas_sumar" type="number" min="0" class="form-control"  placeholder="@@cantidad_horas_sumar@@" required/>
                                            </div>
                                        </div>
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@persona_apoyo@@</label>
                                            <div class="col-md-4">
                                                <input id="persona_apoyo" name="persona_apoyo" type="text" class="form-control"  placeholder="@@persona_apoyo@@"required />
                                            </div>
                                        </div> 

                                        
                                        <div class="form-group" align="center">
                                            <label class="col-md-5 control-label">@@fecha@@</label>
                                            <div class="col-md-4">
                                                <input id="fecha_actividad_voluntario" name="fecha_actividad_voluntario" type="date" class="form-control"  placeholder="@@fecha@@" required />
                                            </div>
                                        </div>  
                                        
                                        <div class="form-group"  align="center">
                                            <label class="col-md-5 control-label">@@arhivo_complementario@@</label>
                                            <div class="col-md-4">
                                                <!-- <textarea id="archio_complementario" name="archio_complementario" type="text" class="form-control" placeholder="@@arhivo_complementario@@"></textarea> -->
                                                <div class="col-md-16">
                                                    <input style="background-color: lightblue;" type="file" id="archio_complementario" name="archio_complementario"  class="btn-default btn-rounded" accept=".odt, .doc, .docx" required /><br>
                                                </div>
                                            </div>
                                        </div>
                                              <br>                          
                                        <div class="form-group" align="center">
                                            <button type="button"  id="btn_guardar_actividad_voluntario" value="btn_guardar_actividad_voluntario" class="btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5">@@btn_guardar@@</button>
                                            
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
                               <h4 class="m-t-0 header-title"><b>@@voluntarios_actividades@@</b></h4><!---->
                               <p class="text-muted m-b-30 font-13"></p> <!---->
                               <div class="panel">
                                       <div class="panel-body">
                                           <div class="">
                                               <table class="table table-striped" id="tbl_actividades_voluntarios" name="tbl_actividades_voluntarios">
                                                   <thead>
                                                   <tr class='alert alert-success'>
                                                       <th width="3%" style="text-align: center">@@num@@</th>
                                                       <th width="20%" style="text-align: left">@@nombre_voluntario@@</th>
                                                       <th width="20%" style="text-align: left">@@actividades_asignadas@@</th>
                                                       <th width="3%" style="text-align: center">@@accion@@</th>
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
          
         <!--Modal para la asignacion de las actividades para los voluntarios -->
         <div class='modal fade' id='asignar_actividad_voluntario'  >                                    
                        <div class='modal-dialog' id="modal_revisores1" >
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                                
                                                <h4 class='modal-title'>@@asignar_actividad_voluntario@@</h4>
                                        </div>

                                        <div class='modal-body'>
                                            <div class="row">
                                               <div class='form-group' align="center">
                                                    <div class='col-md-11' id="">
                                                        <label class='control-label' for='fullname'>@@actividad_voluntario@@</label>
                                                       <select style="height: 175px;" multiple='' id='origen_actividades_voluntarios' name='origen_actividades_voluntarios' class='form-control'>

                                                        </select>   
                                                    </div>

                                                    <div class="col-md-11">
                                                        <label class='control-label' for='fullname'>@@asignar_actividad_voluntario@@</label>
                                                        <select style="height: 95px;" multiple='' id='destino_actividad_voluntarios' name='destino_actividad_voluntarios[]' class='form-control'>

                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <input type="hidden" id="voluntario" value="1">
                                            <a href='javascript:;'  class='btn btn-sm btn-danger btn-rounded' id="cancelar_asuignar_form_revisor">@@btn_cancelar@@</a>
                                            <a type='button' id="btn_asignar_actividad_voluntario" class='btn btn-sm btn-success btn-rounded'>@@btn_guardar@@</a>
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
<script src="./js/gestion_voluntarios/gestion_voluntarios.js"></script>


<script>
/*
ALEXIS ESCOTO 16/01/2023
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_actividad_voluntario');
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

 /*
 ALEXIS ESCOTO 16/01/2023Validacio solo Letras  */
 function SoloLetras_Espacio_uno(e)
            {
                key=e.keyCode || e.which;
                tecla=String.fromCharCode(key).toString();
                letras ="{ABCDEFGHIJKLMNÑOPQRSTUVWXYZáabcdéefghíijklmnñóopqrstúuvwxyz.,}";

                especiales = [8,13,32]
                tecla_especial =false
                for(var i in especiales){
                    if(key ==especiales[i]){
                        tecla_especial = true;
                        break;
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial)
                {
                    alert("No se Permiten Caracteres Especiales ni Numeros");
                    return false
                }

            }
</script>
</HTML>