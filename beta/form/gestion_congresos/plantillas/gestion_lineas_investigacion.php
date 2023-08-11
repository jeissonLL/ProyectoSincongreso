<!-- Alex Siboney Vargas Osorto
     23/3/2017
     alexv7142@gmail.com / avargas@iies-unah.org
     Formulario de Mensajería (Bandeja General)
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     Formulario de creación inicial de congresos para su posterior activación.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 -->
<style>
    .valid {
        color:green;
    }
</style>

<div class="row" id="gestor_lineas">
    <div class="col-lg-6">
        <div class="card-box">
            <h4>@@gestionar_linea_investigacion@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@introduce_datos_generales_linea_investigacion@@
            </p>
            <form class="form-horizontal" id = "form_linea" name = "form_linea" role="form"  data-parsley-validate novalidate>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@nombre_linea@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "nombrelinea" name = "nombrelinea" class="form-control" required placeholder="@@nombre_linea@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@abreviacion@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "abreviacion" name = "abreviacion"  class="form-control" required placeholder="@@abreviacion@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@descripcion_linea@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "descripcion_linea" name = "descripcion_linea" class="form-control" required  placeholder="@@descripcion_linea@@" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">@@comentarios@@</label>
                    <div class="col-sm-7">
                        <input type="text" id = "comentarios_linea" name = "comentarios_linea" class="form-control" required  placeholder="@@comentarios@@" />
                    </div>
                </div>

                <div class="row" align="center">
                    <div class="form-group">
                        <button id = "crear_linea" class="crear_linea btn btn-primary waves-effect waves-light">
                            @@enviar@@
                        </button>
                        <button id = "reset_linea" type="reset" class="btn btn-default waves-effect m-l-5">
                            @@cancelar@@
                        </button>
                        <input type='hidden' name='id_congreso' id='id_congreso' value=""/>
                        <input type='hidden' name='caso_linea' id='caso_linea' value='crear_linea'/>
                        <input type='hidden' name='id_linea' id='id_linea' value=''/>
                    </div>
                </div>
            </form>
        </div>                
    </div><br>
    <div class="col-lg-6">
        <div class="card-box table-responsive" >
            <h4>@@listado_lineas@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@instrucciones_lineas@@
            </p>

            <table id="datatable-buttons" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>@@nombre_linea@@</th>
                        <th>@@descripcion@@</th>
                        <th>@@comentarios@@</th>
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
<script src="./js/gestion_congresos_js/gestionar_linea_investigacion.js"></script>

<script type="text/javascript">
    var abreviacionValidada; //Variable de bandera para determinar la validación o no del campo abreviación dentro del formulario.
    var table; //Esta variable contiene la datatable que se encarga de mostrar las diferentes líneas de investigación.
    var contador = 0; //Contador que sirve para determinar si es necesario hacer un reload al datatable o simplemente crearlo.
    //Variables que contienen las traducciones para los diferentes alerts que se emiten.
var desea_eliminar_linea = "@@desea_eliminar_linea@@";
    var advertencia_eliminar_linea = "@@advertencia_eliminar_linea@@";
    var confirmacion_eliminarla = "@@confirmacion_eliminarla@@";
    var negacion_eliminarla = "@@negacion_eliminarla@@";
    var error_envio_linea = "@@fallo_enviar@@";
    var exito_linea = "@@exito_creacion_linea@@";
    var envio_correcto_datos = "@@envio_correcto_datos@@";
    var exito_modificacion_linea = "@@exito_modificacion_linea@@";
    var linea_llena = "@@linea_contiene_tematicas@@";
    var linea_eliminada = "@@linea_eliminada_exito@@";
    var solicitud_eliminacion = "@@solicitud_eliminacion@@";
    var eliminada = "@@eliminada@@";
    var cancelado = "@@cancelado@@";
    var linea_investigacion_conservada = "@@linea_investigacion_conservada@@";
    var idioma_datatable = {
                            "sProcessing":     "@@sProcessing@@",
                            "sLengthMenu":     "@@sLengthMenu@@",
                            "sZeroRecords":    "@@sZeroRecords@@",
                            "sEmptyTable":     "@@sEmptyTable@@",
                            "sInfo":           "@@sInfo@@",
                            "sInfoEmpty":      "@@sInfoEmpty@@",
                            "sInfoFiltered":   "@@sInfoFiltered@@",
                            "sInfoPostFix":    "",
                            "sSearch":         "@@sSearch@@",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "@@sLoadingRecords@@",
                            "oPaginate": {
                                "sFirst":    "@@sFirst@@",
                                "sLast":     "@@sLast@@",
                                "sNext":     "@@sNext@@",
                                "sPrevious": "@@sPrevious@@"
                            },
                            "oAria": {
                                "sSortAscending":  "@@sSortAscending@@",
                                "sSortDescending": "@@sSortDescending@@"
                            }
                        }

    $(document).ready(function () {
        listar_lineas();
//Validación del formulario ********************************************************************************************
        $("#form_linea").validate({
            rules: {
                nombrelinea: {
                    required: true,
                    remote: {
                        url: "./form/gestion_congresos/comprobaciones/comprobacion.php",
                        type: "POST",
                        data: {"caso": "nombre_linea",
                            "valor": function () {
                                return $("#nombrelinea").val();
                            },
                            "id": function () {
                                return $("#id_linea").val();
                            },
                            "caso_linea": function () {
                                return $("#caso_linea").val();
                            }
                        }
                    }
                },
                abreviacion: {
                    required: true,
                    remote: {
                        url: "./form/gestion_congresos/comprobaciones/comprobacion.php",
                        type: "POST",
                        data: {"caso": "abreviacion_linea",
                            "valor": function () {
                                return $("#abreviacion").val();
                            },
                            "id": function () {
                                return $("#id_linea").val();
                            },
                            "caso_linea": function () {
                                return $("#caso_linea").val();
                            }
                        }
                    },
                    maxlength: 15
                },
                descripcion_linea: false,
                comentarios_linea: false
            },
            messages: {
                nombrelinea: {
                    required:"@@ingrese_nombre@@",
                    remote: "@@nombre_en_uso@@"
                },
                abreviacion: {
                    required: "Ingrese abreviacion",
                    remote: "Abreviación utilizada"
                },
                descripcion_linea: "Ingrese descripción",
                comentarios_linea: "Ingrese comentarios"
            }
        });
    });





//La función listar_lineas carga en un datatable las líneas de investigación correspondientes al congreso seleccionado
    function listar_lineas()   {
        table = $('#datatable-buttons').DataTable({
                "destroy": true,
                "fnDestroy": true,
                "ajax": {
                    "method": "POST",
                    "dataType": "json",
                    "url": "./includes/fnc_datatbl.php?caso=datatbl_lineas_investigacion"
                },
                "columns": [
                    {"data": "nombre_linea_investigacion"},
                    {"data": "descripcion_linea_investigacion"},
                    {"data": "comentarios"},
                    {"defaultContent": "<button class='editarlinea btn btn-icon waves-effect waves-light btn-primary m-b-5' title='@@editar@@'><i class=' md-mode-edit'></i></button><button class='eliminarlinea btn btn-icon waves-effect waves-light btn-danger m-b-5 ' title='@@eliminar@@'><i class='fa fa-trash-o'></i></button>"}
                ],
                "language": idioma_datatable,
                dom:  "<'row'<'form-inline' <'col-sm-offset-3'B>>>"
                        +"<'row'<'col-sm-6'><'col-sm-6'>>"
                        + "<'row'<'col-sm-6'l><'col-sm-6'f>>" 
                        +"<'row'<'col-sm-12'tr>>" 
                        +"<'row'<'col-sm-12'i>"
                        +"<'row'<'col-sm-6'><'col-sm-6'>>"
                        +"<'col-sm-12'p>>",//'Bfrtip',,
                buttons: [{
                        extend: "copy",
                        className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                        text:      '<i class="fa  fa-copy (alias)"></i>',
		        titleAttr: '@@copiar@@',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }, {
                        extend: 'excelHtml5',
                        className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                        text:      '<i class="fa fa-file-excel-o"></i>',
		        titleAttr: '@@excel@@',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }, {
                        extend: "pdfHtml5",
                        className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                        text:      '<i class="fa fa-file-pdf-o"></i>',
		        titleAttr: 'PDF',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }, {
                        extend: "print",
                        className: "btn btn-icon waves-effect waves-light btn-primary m-b-5",
                        text:      '<i class="fa  fa-print"></i>',
		        titleAttr: '@@imprimir@@',
                        exportOptions: {
                            columns: [0, 1]
                        }
                    }]
            });
        editar_linea("#datatable-buttons tbody", table);
        eliminar_linea("#datatable-buttons", table);
        crear_modificar_linea(table);
    }

</script>
