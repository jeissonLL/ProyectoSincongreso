<!-- Alex Siboney Vargas Osorto
     9/3/2017
     alexv7142@gmail.com / avargas@iies-unah.org
     Formulario de Mensajería (Bandeja General)
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     Sección de bienvenida al usuario de manera instructiva al envío de un mensaje a la
     comunidad.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 -->
<link href="../plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>@@envia_tu_msj@@</b></h4>
            <p class="text-muted font-13 m-b-30">
                    @@la_comunidad_estara@@
            </p>
                <!--
                ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                   Fin de la sección de bienvenida.
                ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                -->
                <!--
                ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                   Sección formulario de envío de mensajes.
                ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                -->
            <form enctype="multipart/form-data" method='POST' name='form_envio_mensajes'  id='form_envio_mensajes' class='form-horizontal form-bord <forered' data-parsley-validate='true'>
                <div class="form-group">
                    <label class="col-md-2 control-label">@@asunto@@</label>
                    <div class="col-md-10">
                        <textarea name = "asunto" id = "asunto" class="form-control" rows="1"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">@@mensajeM@@</label>
                    <div class="col-md-10">
                        <textarea name = "mensaje" id = "mensaje" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="button" id= "enviar" name = "enviar" onclick='guardar_mensajeria();'>
                        @@enviar@@
                    </button>
                    <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                        @@cancelar@@
                    </button>
                    <input type='hidden' name='caso' id='caso' value='insertar_mensajeria'/>
                    <input type='hidden' name='exito_msj' id='exito_msj' value='@@mensaje_enviado@@' />
                    <input type='hidden' name='error_msj' id='error_msj' value='@@fallo_enviar@@' />
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="timeline" name='bandeja_mensajes'  id='bandeja_mensajes'>

        </div>
    </div>
</div>
<script src="./js/gestion_traducciones_js/mensajeria.js"></script>
<script src="../plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>


<!--
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Fin sección de envío de mensajes
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
<!--
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   Sección de impresión de mensajes.
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-->

<!-- end row -->
