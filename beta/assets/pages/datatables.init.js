/**
* Theme: Minton Admin Template
* Author: Coderthemes
* Component: Datatable
* 
*/

var handleDataTableButtons = function(tamanio) {
        "use strict";
        0 !== tamanio && $("#datatable-buttons").DataTable({
            dom: "Bfrtip",
            buttons: [{
                extend: "copy",
                className: "btn-sm"
            }, {
                extend: "csv",
                className: "btn-sm"
            }, {
                extend: "excel",
                className: "btn-sm"
            }, {
                extend: "pdf",
                className: "btn-sm"
            }, {
                extend: "print",
                className: "btn-sm"
            }],
            responsive: !0
        })
    },
    TableManageButtons = function() {
        "use strict";
        return {
            init: function(tamanio) {
                handleDataTableButtons(tamanio)
            }
        }
    }();