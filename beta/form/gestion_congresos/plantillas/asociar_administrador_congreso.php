<script src="./js/fnc_slc.js"></script>
<div class="col-lg-12">
    <div class="card-box">
        <h4 class="m-t-0 m-b-30 header-title"><b>@@seleccionar_congreso@@</b></h4>

        <h5>@@instrucciones_seleccionar_congreso@@</h5>

        <select class="form-control select2" id="congresos">
            <option>@@seleccionar_congreso@@</option>
        </select>
        <br><br>
    </div>

</div>

<div class="col-lg-12" id = "mostrar_div_congresos" style = "display:none">

</div>

<script src="./js/gestion_congresos_js/asociar_administrador_congreso.js"></script>

<script>

    jQuery(document).ready(function () {
        $("#congresos").change(function () {
            if ($("#congresos").val() > 0) {
                $("#mostrar_div_congresos").css({display: 'block'});
                $("#mostrar_div_congresos").html('');
                $("#mostrar_div_congresos").html('<div class="card-box">'
                        + '<table id="datatable-keytable" class="table table-striped table-bordered">'
                        + '<thead>'
                        + '<tr>'
                        + '<th>@@nombre_usuario@@</th>'
                        + '<th>@@correo_principal@@</th>'
                        + '<th>@@acciones@@</th>'
                        + '</tr>'
                        + '</thead></table></div>');
                listar_usuarios();
            }
        });

        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });

    });
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
    var s_quitar_administrador = "@@s_quitar_administrador@@";
    var s_agregar_administrador = "@@s_agregar_administrador@@";
    var tabla;

    function listar_usuarios() {
        tabla = $('#datatable-keytable').DataTable({
            "destroy": true,
            "ajax": {
                "method": "POST",
                "url": "./includes/fnc_datatbl.php?caso=datatbl_usuarios_para_administrador",
                "data": {"id_congreso_pk": function () {
                        return $("#congresos").val()
                    }}
            },
            "columns": [
                {"data": "nombre_usuario", "sWidth": "42%"},
                {"data": "correo"},
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
        quitar_administrador("#datatable-keytable tbody", tabla);
        agregar_administrador("#datatable-keytable tbody", tabla);
    }


</script>
