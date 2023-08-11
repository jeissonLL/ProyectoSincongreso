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
<link href="../plugins/jquery-ui/jquery-ui.css">
<style>
    .rojo {
        background-color: rgb(230, 178, 157);
        font-family: Arial, Helvetica, sans-serif;
        color: black;
    }
    
    .verde {
        background-color: rgb(173, 244, 173);
        font-family: Arial, Helvetica, sans-serif;
        color: black;
    }
</style>


<script src="./js/fnc_tbl.js"></script> 

<div class="row">

    <!--    <div class="row">-->
    <div class="col-md-12">
        <div class="card-box table-responsive">
            <div id = "titulo_idioma"></div>
            <p class="text-muted font-13 m-b-30">
                @@instrucciones_traducir_idioma@@
                <br><br><button type="button" id="regresar" class="btn btn-primary waves-effect w-md waves-light m-b-5">Regresar</button>
            </p>


            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr  >
                            <th style="text-align:center" >@@texto_sin_traducir@@</th>
                            <th style="text-align:center">@@traduccion@@</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="sin_enviar_datos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-primary">
                    <div class="panel-heading">
                        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="panel-title">@@sin_enviar_datos@@</h3>
                    </div>
                    <div class="panel-body">
                        <p>@@instrucciones_datos_sin_enviar@@</p>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- Parsleyjs -->
<script src="./js/gestion_traducciones_js/traducciones.js"></script>

<script type="text/javascript">
    var traduccion_habilitada = "@@traduccion_habilitada@@";
    var menor90 = "@@menor90@@";
    var idioma_activado = "@@idioma_activado@@";
    var idioma_inactivado = "@@idioma_inactivado@@";
    var error_envio = "@@fallo_enviar@@";
    var traduccion_correcta = "@@traduccion_correcta@@";
</script>
