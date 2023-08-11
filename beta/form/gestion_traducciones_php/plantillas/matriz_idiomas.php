<!-- Alex Siboney Vargas Osorto
     23/3/2017
     alexv7142@gmail.com / avargas@iies-unah.org
     Formulario de Mensajer铆a (Bandeja General)
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     Formulario de creaci贸n inicial de congresos para su posterior activaci贸n.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 -->
<div class="row">
    <div class="col-md-12">
        <div id="tabla_idiomas" class="card-box table-responsive">
            <h4>@@matriz_idiomas@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@instrucciones_matriz_idiomas@@
            </p>
            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>@@nombre_idioma@@</th>
                        <th>@@bandera@@</th>
                        <th>@@estado@@</th>
                        <th>@@progreso@@</th>
                        <th>@@acciones@@</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
        
</div> 
    <!-- Custom Modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">@@respaldo_idioma_creado@@</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="descarga_respaldo_idioma" href="" download><button type="button" class="btn btn-info waves-effect waves-light">Descargar Archivo</button></a>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
     <div id="elegir_m_carga_r_idioma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">@@selecciona_opcion_respaldo_idioma@@</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="subir_archivo" type="button" class="btn btn-info waves-effect waves-light">@@subir_archivo@@</button>
                    <button id="elegir_d_existente"  type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">@@elegir_d_existente@@</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@@cerrar@@</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="elegir_m_carga_r_idioma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">@@selecciona_opcion_respaldo_idioma@@</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="subir_archivo" type="button" class="btn btn-info waves-effect waves-light">@@subir_archivo@@</button>
                    <button id="elegir_d_existente"  type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">@@elegir_d_existente@@</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="subir_respaldo_archivo_idioma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">@@selecciona_opcion_respaldo_idioma@@</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form-horizontal" id = "form_subir_respaldo_idioma" name = "form_subir_respaldo_idioma" role="form" data-parsley-validate novalidate>
                            <div class="form-group ">
                                <label class="col-sm-3 control-label">@@archivo@@</label>
                                <div class="col-sm-9">
                                    <input type="file" accept="text/*" id = "archivo_respaldo_idioma" name = "archivo_respaldo_idioma" class="form-control btn btn-primary btn-rounded w-md waves-effect waves-light m-b-5" required placeholder="@@logo_congreso@@" />
                                </div>
                            </div>
                            <div class="row" align="center">
                                <div class="form-group">
                                    <button type="button" id = "subir_ri" class="btn btn-primary waves-effect waves-light">
                                        @@enviar@@
                                    </button>
                                    <button id = "reset_form_congreso" type="reset" class="btn btn-default waves-effect m-l-5">
                                        @@cancelar@@
                                    </button>
                                    <input type='hidden' name='id_idioma_r' id='id_idioma_r' value=''/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="cargar_respaldo_archivo_idioma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">@@selecciona_opcion_respaldo_idioma@@</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>@@nombre_archivo@@</th>
                                            <th>@@fecha_creacion@@</th>
                                            <th>@@acciones@@</th>
                                        </tr>
                                    </thead>
                                    <tbody id="respaldo_idioma">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div id="congreso_nopuede_activarse" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading">
                        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">Descargar</button>
                        <h3 class="panel-title">El Congreso no puede ser activado</h3>
                        <a href="../../../../../../plantilla_completa/Admin/blue_PHP/ui-modals.php"></a>
                    </div>
                    <div class="panel-body">
                        <a href="../../../../../../plantilla_completa/Admin/blue_PHP/ui-modals.php"></a>
                        <p>Aún falta asociar ciertos datos básicos para que este congreso pueda ser acivado, como Organizadores, Lineas, Temáticas, Tipos de Trabajo o Costo por tipo de persona. Asegúrate de asociar esta información e intenta nuevamente.</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!--    </div>-->
</div>
<!-- Parsleyjs -->
<script src="./js/gestion_traducciones_js/matriz_idiomas.js"></script>

<script type="text/javascript">
    var traduccion_habilitada = "@@traduccion_habilitada@@";
var menor90 = "@@menor90@@";
var idioma_activado = "@@idioma_activado@@";
var idioma_inactivado = "@@idioma_inactivado@@";
var error_envio = "@@fallo_enviar@@";
var finalizacion_traduccion = "@@finalizacion_traduccion@@";
var menor100 = "@@menor100@@";
var subir_cargar_archivo_exito = "@@subir_cargar_archivo_exito@@";
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
        listar_idiomas();
    });
</script>
