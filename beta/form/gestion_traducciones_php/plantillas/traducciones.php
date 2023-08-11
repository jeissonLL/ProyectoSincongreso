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


<div class="row">
    
    <!--    <div class="row">-->
    <div class="col-md-12">
        <div class="card-box table-responsive">
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
    <!-- Custom Modal -->
    
    <!--    </div>-->
</div>
<!-- Parsleyjs -->
<script src="./js/gestion_traducciones_js/traducciones.js"></script>
<!--<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
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
 Datatable init js 
<script src="assets/pages/datatables.init.js"></script>

<script src="../plugins/custombox/dist/custombox.min.js"></script>
<script src="../plugins/custombox/dist/legacy.min.js"></script>-->
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
    var traduccion_habilitada = "@@traduccion_habilitada@@";
    var menor90 = "@@menor90@@";
    var idioma_activado = "@@idioma_activado@@";
    var idioma_inactivado = "@@idioma_inactivado@@";
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
        listar_idiomas();
    });

    function listar_idiomas() {
        var tabla = $('#datatable-buttons').DataTable({
            "destroy": true,
            "ajax": {
                "method": "POST",
                "url": "./includes/fnc_datatbl.php?caso=datatbl_idiomas_traducciones"
            },
            "columns": [
                {"data": "nombre_idioma"},
                {"data": "bandera"},
                {"data": "nombre_estado"},
                {"data": "porcentaje_traduccion"},
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
            buttons: []
        });
        acceder_traduccion("#datatable-buttons tbody", tabla);
    }
</script>
