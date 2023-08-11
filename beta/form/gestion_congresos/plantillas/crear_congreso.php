<!-- Alex Siboney Vargas Osorto
     23/3/2017
     alexv7142@gmail.com / avargas@iies-unah.org
     Formulario de Mensajer铆a (Bandeja General)
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     Formulario de creaci贸n inicial de congresos para su posterior activaci贸n.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 -->
<!--<style>
    .valid {
        color:green;
    }
</style>-->
<?php


?>
<script src="./js/fnc_slc.js"></script>
<script src="./js/fnc_select_multiple.js"></script>
<div class="row">
   
        <div class="card-box">
            <h4>@@crear_congreso@@</h4>
            <h5><b>@@datos_generales_congreso@@</b></h5>
            <p class="text-muted font-13 m-b-30">
                @@introduce_datos_generales_congreso@@
            </p>
          

            <form class="form-horizontal"   id="form_congresos" method="post" name = "form_congresos" role="form" data-parsley-validate novalidate>
            
            <div class="row">
                <div class="col">
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@nombre_congreso@@</label>
                    <div class="col-sm-9">
                        <input type="text" id = "nombre_congreso"  onkeypress="return  SoloLetras_Espacio_uno(event)" name = "nombre_congreso" class="form-control" placeholder="@@nombre_congreso@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@siglas@@</label>
                    <div class="col-sm-9">
                        <input type="text" id = "siglas" name = "siglas"  class="form-control" required placeholder="@@siglas@@"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@descripcion@@</label>
                    <div class="col-sm-9">
                        <textarea  id = "descripcion_congreso" name = "descripcion_congreso"  onkeypress="return  SoloLetras_Espacio_uno(event)" class="form-control" rows="7"  placeholder="@@descripcion@@" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@lugar@@</label>
                    <div class="col-sm-9">
                        <input type="text" id = "lugar" name = "lugar"  class="form-control"  required placeholder="@@lugar@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@coordenadas@@</label>
                    <div class="col-sm-9">
                        <input type="text" id = "coordenadas" name = "coordenadas" class="form-control"  required placeholder="@@coordenadas@@" />
                    </div>
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@pais@@</label>
                    <div class="col-sm-9">
                        <select id="pais" name="pais" class="form-control input-sm" required placeholder="@@pais_procedencia@@">
                        </select>             
                        <i class="md md-flag form-control-feedback l-h-34"></i>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="col-sm-3 control-label">@@logo_congreso@@</label>
                    <div class="col-sm-9">
                        <input type="file" accept="image/*" id = "logo_congreso" name = "logo_congreso" class="form-control btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5"  placeholder="@@logo_congreso@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@lema_congreso@@</label>
                    <div class="col-sm-9">
                        <input type="text" id = "lema" name = "lema" class="form-control " required placeholder="@@lema_congreso@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@numero_cai@@</label>
                    <div class="col-sm-9">
                        <input type="text" id = "numero_cai" name = "numero_cai" class="form-control " required placeholder="@@numero_cai@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@agregar_roles_congreso@@</label>
                    <div class="col-sm-9">
                        <select  multiple="" id="agregar_roles_congreso" name="agregar_roles_congreso" class="form-control multi-select">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@roles_congreso_agregados@@</label>
                    <div class="col-sm-9">
                        <select multiple="" id="roles_congreso_agregados" name="roles_congreso_agregados" class="form-control multi-select">
                        </select>
                    </div>
                </div>
                <br>
                </div>
                <h5><b>@@periodo_congreso@@</b></h5>
                <p class="text-muted font-13 m-b-30">
                    @@introduce_datos_periodo_congreso@@
                </p>
                <div class="col">
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@ano@@</label>
                    <div class="col-sm-9">
                        <select id="anio" name="anio" class="form-control input-sm" required placeholder="@@anio@@">
                        </select>  
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_inicio@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_inicio" name = "fecha_inicio" class="form-control" required placeholder="@@fecha_inicio@@" />
                      
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_final@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_finalizacion" name = "fecha_finalizacion" class="form-control" required placeholder="@@fecha_final@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_inicio_recibir_trabajo@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_i_recepcion" name = "fecha_i_recepcion" class="form-control" required placeholder="@@fecha_inicio_recibir_trabajo@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_final_recibir_trabajo@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_f_recepcion" name = "fecha_f_recepcion" class="form-control" required placeholder="@@fecha_final_recibir_trabajo@@" />
                    </div>
                </div>
                </div>
                <div class="col">
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_inicio_revision_trabajo@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_i_revision" name = "fecha_i_revision" class="form-control"  required placeholder="@@fecha_inicio_revision_trabajo@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_final_revision_trabajo@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_f_revision" name = "fecha_f_revision" class="form-control" required placeholder="@@fecha_final_revision_trabajo@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_publicacion_programa@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_p_programa" name = "fecha_p_programa"  class="form-control" required  placeholder="@@fecha_publicacion_programa@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@fecha_cambio_costo_inscripcion@@</label>
                    <div class="col-sm-9">
                        <input type="date" id = "fecha_cambio_costo_inscripcion" name = "fecha_cambio_costo_inscripcion"  class="form-control" required  placeholder="@@fecha_cambio_costo_inscripcion@@" />
                    </div>
                </div>
                </div>
               
            </div>

                
                <div class="row" align="center">
                    <div class="form-group">
                        <button id ="cr_c"  class="crear_linea btn btn-primary waves-effect waves-light">
                            @@enviar@@
                           </button>
                           
                        <button id = "reset_form_congreso" type="reset" class="btn btn-default waves-effect m-l-5">
                            @@cancelar@@
                        </button>
                        <input type='hidden' name='caso_congreso' id='caso_congreso' value='crear_congreso'/>
                        <input type='hidden' name='id_congreso_pk' id='id_congreso_pk' value=''/>
                    </div>
                </div>
            </form>
        </div>                
    <br>
    <!--    <div class="row">-->
    <div class="col-md-7">
        <div class="card-box table-responsive">
            <h4>@@centro_acciones_congresos@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@instrucciones_centro_acciones@@
            </p>

            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>@@nombre_congreso@@</th>
                        <th>@@anio@@</th>
                        <th>@@estado_congreso@@</th>
                        <th>@@acciones@@</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- Custom Modal -->
    <div id="congreso_nopuede_activarse" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading">
                        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="panel-title">El Congreso no puede ser activado</h3>
                    </div>
                    <div class="panel-body">
                        <p>Aún falta asociar ciertos datos básicos para que este congreso pueda ser acivado, como Organizadores, Lineas, Temáticas, Tipos de Trabajo o Costo por tipo de persona. Asegúrate de asociar esta información e intenta nuevamente.</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!--    </div>-->
</div>
<!-- Parsleyjs -->
<script src="./js/gestion_congresos_js/crear_congreso.js"></script>

<!--<script>
    $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
</script>-->
<!--
<script type="text/javascript">
                            $(document).ready(function () {
                                $('form').parsley();
                            });
</script>-->
<script type="text/javascript">
    var html_roles = "";
    var congreso_activado = "@@congreso_activado@@";
    var congreso_inactivo = "@@congreso_inactivo@@";
    var congreso_cerrado = "@@congreso_cerrado@@";
    var congreso_creado = "@@congreso_creado@@";
    var congreso_editado = "@@congreso_editado@@";
    var error_envio = "@@fallo_enviar@@";
    var idioma_datatable = {
        "sProcessing": "@@sProcessing@@",
        "sLengthMenu": "@@sLengthMenu@@",
        "sZeroRecords": "@@sZeroRecords@@",
        "sEmptyTable": "@@sEmptyTable@@",
        "sInfo": "@@sInfo@@",
        "sInfoEmpty": "@@sInfoEmpty@@",
        "sInfoFiltered": "@@sInfoFiltered@@",
        "sInfoPostFix": "",
        "sSearch": "@@sSearch@@",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "@@sLoadingRecords@@",
        "oPaginate": {
            "sFirst": "@@sFirst@@",
            "sLast": "@@sLast@@",
            "sNext": "@@sNext@@",
            "sPrevious": "@@sPrevious@@"
        },
        "oAria": {
            "sSortAscending": "@@sSortAscending@@",
            "sSortDescending": "@@sSortDescending@@"
        }
    }

    $(document).ready(function () {
        listar_congresos();
        //Validación del formulario ********************************************************************************************
        
    });

    function listar_congresos() {        
        var tabla = $('#datatable-buttons').DataTable({
            //"destroy": true,
            "ajax": {
                "method": "POST",
                "url": "./includes/fnc_datatbl.php?caso=datatbl_congresos",
//                "success": function (data) { 
//                         alert(data);
//                          console.log(data);
//                          $("#datatable-buttons").html(data);
//                      }
            },
            "columns": [
                {"data": "nombre_congreso", "sWidth": "42%"},
                {"data": "anio"},
                {"data": "nombre_estado"},
                {"data": "botones"}
            ],
            "language": idioma_datatable,
            dom: "<'row'<'form-inline' <'col-sm-offset-3'B>>>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'row'<'col-sm-6'l><'col-sm-6'f>>"
                    + "<'row'<'col-sm-12'tr>>"
                    + "<'row'<'col-sm-12'i>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'col-sm-12'p>>",
            buttons: [{
                    extend: "copy",
                    className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                    text: '<i class="fa  fa-copy (alias)"></i>',
                    titleAttr: '@@copiar@@',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }, {
                    extend: 'excelHtml5',
                    className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: '@@excel@@',
                    exportOptions: {
                        columns: [0, 1]
                    }
                }, {
                    extend: "pdfHtml5",
                    className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: [0, 1]
                    }
                }, {
                    extend: "print",
                    className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                    text: '<i class="fa  fa-print"></i>',
                    titleAttr: '@@imprimir@@',
                    exportOptions: {
                        columns: [0, 1]
                    }
                }]
        });
        editar_congreso("#datatable-buttons tbody", tabla);
        eliminar_congreso("#datatable-buttons tbody", tabla);
        activar_congreso("#datatable-buttons tbody", tabla);
        inactivar_congreso("#datatable-buttons tbody", tabla);
        cerrar_congreso("#datatable-buttons tbody", tabla);
        crear_modificar_congreso(tabla);
    }

    //Validacio solo Letras y Numeros **************************************************************************************************
    function SoloLetras_Espacio_uno(e)
            {
                key=e.keyCode || e.which;
                tecla=String.fromCharCode(key).toString();
                letras ="{ABCDEFGHIJKLMNÑOPQRSTUVWXYZáabcdéefghíijklmnñóopqrstúuvwxyz123456789.,}";

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
                    alert("No se Permiten Caracteres Especiales");
                    return false
                }

            }

        
</script>
<script>
    /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
 var myDate = $('#fecha_inicio');
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
<script>
        /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_finalizacion');
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
    <script>
            /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_i_recepcion');
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
    <script>
            /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_f_recepcion');
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
    <script>
            /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_i_revision');
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
    <script>
            /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_f_revision');
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
    <script>
            /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_p_programa');
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
    <script>
            /*
ALEXIS ESCOTO 20/12/2022
VALIDACION EN LOS CAMPOS FECHAS, NO SE PUEDE INGRESAR UNA FECHA MENOR A LA ACTUAL*/ 
var myDate = $('#fecha_cambio_costo_inscripcion');
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
    
      