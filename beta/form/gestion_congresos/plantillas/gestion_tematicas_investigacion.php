<!-- Alex Siboney Vargas Osorto
     23/3/2017
     alexv7142@gmail.com / avargas@iies-unah.org
     Formulario de Mensajer铆a (Bandeja General)
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     Formulario de creaci贸n inicial de congresos para su posterior activaci贸n.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 -->
<style>
    .valid {
        color:green;
    }
</style>
<?php
require '../../../clases/class_base.php';
require_once '../../../clases/autoload.php';

?>
<script src="./js/fnc_slc.js"></script>  
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4>@@gestionar_tematica_investigacion@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@introduce_datos_generales_tematica_investigacion@@
            </p>

            <form class="form-horizontal" id = "form_tematica" name = "form_tematica" role="form"  data-parsley-validate novalidate>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@seleccione_linea@@</label>
                    <div class="col-sm-7">
                        <select class="form-control select2" id="lineas_investigacion" required name = "lineas_investigacion">
                            <option>@@seleccionar_linea@@</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@nombre_tematica@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "nombretematica" name = "nombretematica" class="form-control" required placeholder="@@nombre_tematica@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@abreviacion@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "abreviacion" name = "abreviacion"  class="form-control" required placeholder="@@abreviacion@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@descripcion_tematica@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "descripcion_tematica" name = "descripcion_tematica" class="form-control"   placeholder="@@descripcion_tematica@@" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@comentarios@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "comentarios_tematica" name = "comentarios_tematica" class="form-control"   placeholder="@@comentarios@@" required/>
                    </div>
                </div>

                <div class="row" align="center">
                    <div class="form-group">
                        <button id = "crear_tematica" class="btn btn-primary waves-effect waves-light">
                            @@enviar@@
                        </button>
                        <button id="reset_tematica" type="reset" class="btn btn-default waves-effect m-l-5">
                            @@cancelar@@
                        </button>
                        <input type='hidden' name='id_congreso' id='id_congreso' value=""/>
                        <input type='hidden' name='caso_tematica' id='caso_tematica' value='crear_tematica'/>
                        <input type='hidden' name='id_tematica' id='id_tematica' value=""/>
                    </div>
                </div>
            </form>
        </div>                
    </div><br>
    <div class="col-lg-6">
        <div class="card-box table-responsive" >
                <h4>@@listado_tematicas@@</h4>
                <p class="text-muted font-13 m-b-30">
                    @@instrucciones_lineas@@
                </p>

                <table id="datatable-buttons" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>@@nombre_tematica@@</th>
                            <th>@@linea@@</th>
                            <th>@@descripcion@@</th>
                            <th>@@acciones@@</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Parsleyjs -->
<script src="./js/gestion_congresos_js/gestionar_tematica_investigacion.js"></script>


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
    var table;
    
    var desea_eliminar_tematica = "@@desea_eliminar_tematica@@";
    var advertencia_eliminar_tematica = "@@advertencia_eliminar_tematica@@";
    var confirmacion_eliminarla = "@@confirmacion_eliminarla@@";
    var negacion_eliminarla = "@@negacion_eliminarla@@";
    var error_envio_tematica = "@@fallo_enviar@@";
    var exito_tematica = "@@exito_creacion_tematica@@";
    var envio_correcto_datos = "@@envio_correcto_datos@@";
    var exito_modificacion_tematica = "@@exito_modificacion_tematica@@";
    var tematica_contiene = "@@tematica_contiene_trabajos@@";
    var tematica_eliminada = "@@tematica_eliminada_exito@@";
    var solicitud_eliminacion = "@@solicitud_eliminacion@@";
    var eliminada = "@@eliminada@@";
    var cancelado = "@@cancelado@@";
    var tematica_investigacion_conservada = "@@tematica_investigacion_conservada@@";
    
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
        listar_tematicas();
        //Validación del formulario ********************************************************************************************
        $("#form_tematica").validate({
            rules: {
                nombretematica: {
                    required: true,
                    remote: {
                        url: "./form/gestion_congresos/comprobaciones/comprobacion.php",
                        type: "POST",
                        data: {"caso": "nombre_tematica",
                            "valor": function () {
                                return $("#nombretematica").val();
                            },
                            "id": function () {
                                return $("#id_tematica").val();
                            },
                            "caso_tematica": function () {
                                return $("#caso_tematica").val();
                            }
                        }
                    }
                },
                abreviacion: {
                    required: true,
                    remote: {
                        url: "./form/gestion_congresos/comprobaciones/comprobacion.php",
                        type: "POST",
                        data: {"caso": "abreviacion_tematica",
                            "valor": function () {
                                return $("#abreviacion").val();
                            },
                            "id": function () {
                                return $("#id_tematica").val();
                            },
                            "caso_tematica": function () {
                                return $("#caso_tematica").val();
                            }
                        }
                    },
                    maxlength: 15
                },
                descripcion_tematica: {required: false},
                comentarios_tematica: {required: false}
            },
            messages: {
                nombretematica: {
                    required:"@@ingrese_nombre@@",
                    remote: "@@nombre_en_uso@@"
                },
                abreviacion: {
                    required: "@@ingrese_abreviacion@@",
                    remote: "@@abreviacion_en_uso@@"
                }
            }
        });

        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    });

    function listar_tematicas() {
        table = $('#datatable-buttons').DataTable({
            "destroy": true,
            "fnDestroy": true,
            "ajax": {
                "method": "POST",
                "dataType": "json",
                "url": "./includes/fnc_datatbl.php?caso=datatbl_tematicas_investigacion"
            },
            "columns": [
                {"data": "nombre_tematica"},
                {"data": "nombre_linea_investigacion"},
                {"data": "descripcion_tematica"},
                {"defaultContent": "<button class='editartematica btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='eliminartematica btn btn-icon waves-effect waves-light btn-danger m-b-5 ' title='@@eliminar@@'><i class='fa fa-trash-o'></i></button>"}
            ],
            "language": idioma_datatable,
            dom: "<'row'<'form-inline' <'col-sm-offset-3'B>>>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'row'<'col-sm-6'l><'col-sm-6'f>>"
                    + "<'row'<'col-sm-12'tr>>"
                    + "<'row'<'col-sm-12'i>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'col-sm-12'p>>", //'Bfrtip',,
            buttons: [{
                    extend: "copy",
                    className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                    text: '<i class="fa  fa-copy (alias)"></i>',
                    titleAttr: '@@copiar@@',
                    exportOptions: {
                        columns: [0, 1]
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
        editar_tematica("#datatable-buttons tbody", table);
        eliminar_tematica("#datatable-buttons", table);
        crear_modificar_tematica(table);
    }

</script>
