
<!--/* * ---- Archivo con formulario para la gestion de traductores----
 *
 * @author José L. Rodríguez
 * @copyright 2017
 * @version 1
 */-->
 
<link href="../plugins/jquery-ui/jquery-ui.css">

<link rel="stylesheet" href="../plugins/magnific-popup/dist/magnific-popup.css" />
<link rel="stylesheet" href="../plugins/jquery-datatables-editable/datatables.css" />
<link href="../plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="../plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<link href="../plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />

<script src="./js/fnc_tbl.js"></script> 
<script src="./js/funciones.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<!--<script src="./js/dinamica.js"></script>    -->
<script src="./js/fnc_slc.js"></script> 

<script src="../plugins/jquery-validation-1.16.0/dist/jquery.validate.js"></script>
<!--<script src="../plugins/jquery-validation-1.16.0/lib/jquery.js"></script>-->
<script src="../plugins/jquery-validation-1.16.0/dist/additional-methods.js"></script>
<div class="row">
    
    <!--    <div class="row">-->
    <div class="col-md-12">
        <div class="card-box table-responsive">
            <h4>@@gestion_traductor@@</h4>
            <p class="text-muted font-13 m-b-30">
                @@instrucciones_gestion_traductor@@
            </p>

            <table id="datatable-buttons" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>@@nusuario@@</th>
                        <th>@@nombre_completo@@</th>
                        <th>@@motivo@@</th>
                        <th>@@idioma@@</th>
                        <th>@@fecha_solicitud@@</th>                        
                        <th>@@acciones@@</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    

    <!-- end: page -->

</div> 

<!-- Parsleyjs -->
<script src="./js/gestion_solicitudes/traductores.js"></script>
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="../plugins/datatables/jszip.min.js"></script>
<script src="../plugins/datatables/pdfmake.min.js"></script>
<script src="../plugins/datatables/vfs_fonts.js"></script>
<script src="../plugins/datatables/buttons.html5.min.js"></script>
<script src="../plugins/datatables/buttons.print.min.js"></script>
<script src="../plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="../plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="../plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="../plugins/datatables/dataTables.scroller.min.js"></script>

<script src="../plugins/jquery-ui/jquery-ui.js"></script>
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="../plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>
<!-- Datatable init js -->
<script src="assets/pages/datatables.init.js"></script>

<script src="../plugins/custombox/dist/custombox.min.js"></script>
<script src="../plugins/custombox/dist/legacy.min.js"></script>

<script src="../plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="../plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.js"></script>
<script src="../plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="../plugins/tiny-editable/numeric-input-example.js"></script>

<script src="assets/pages/datatables.editable.init.js"></script>
<script>
    $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
</script>
<!--
<script type="text/javascript">
                            $(document).ready(function () {
                                $('form').parsley();
                            });
</script>-->
<script type="text/javascript">
    var traduccion_habilitada = "@@traduccion_habilitada@@";
    var menor90 = "@@menor90@@";
    var solicitud_rechazada = "@@solicitud_rechazada@@";
    var solicitud_aceptada = "@@solicitud_aceptada@@";
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
        $("#form_subir_respaldo_idioma").validate({
            rules: {
                archivo_respaldo_idioma: true
            },
            messages: {
                archivo_respaldo_idioma: {
                    required: "@@required_logo_congreso@@", 
                    accept: "@@accept_congreso@@"
                }
            },
            submit: {
                
            }
        });
    });

    function listar_idiomas() {
        var tabla = $('#datatable-buttons').DataTable({
            "destroy": true,
            "ajax": {
                "method": "POST",
                "url": "./includes/fnc_datatbl.php?caso=datatbl_solicitudes_traductores"
            },
            "columns": [
                {"data": "nombre_usuario", width: "15%"},
                {"data": "nombres", width: "10%"},
                {"data": "motivo_solicitud", width: "10%"},
                {"data": "nombre_idioma", width:"20%"},
                {"data": "fecha_solicitud", width: "20%"},
                {"data": "botones", widht: "25%"}
            ],
            "language": idioma_datatable,
            dom: "<'row'<'form-inline' <'col-sm-offset-3'B>>>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'row'<'col-sm-6'l><'col-sm-6'f>>"
                    + "<'row'<'col-sm-12'tr>>"
                    + "<'row'<'col-sm-12'i>"
                    + "<'row'<'col-sm-6'><'col-sm-6'>>"
            + "<'row'<'col-sm-6'><'col-sm-6'>>"
                    + "<'col-sm-12'p>>",
            buttons: []
        });
        aceptar_traductor("#datatable-buttons tbody", tabla);
        rechazar_traductor("#datatable-buttons tbody", tabla);
        
    }
</script>
 
 