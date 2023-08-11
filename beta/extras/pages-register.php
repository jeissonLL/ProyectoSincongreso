<?php require 'includes/header_account.php'; ?>

<div class="wrapper-page">

    <div class="text-center">
        <a href="index.php" class="logo-lg"><i class="md md-equalizer"></i> <span>@@titulo@@</span> </a>
    </div>

    <form class="form-horizontal m-t-20" action="index.php">
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="email" required="" placeholder="@@correo@@" id="email" name="email">
                <i class="md md-email form-control-feedback l-h-34"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="@@n_usuario@@" id="n_usuario" name="n_usuario">
                <i class="md md-account-circle form-control-feedback l-h-34"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" required="" placeholder="@@contrase@@" id="contrase" name="contrase">
                <i class="md md-vpn-key form-control-feedback l-h-34"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox" checked="checked">
                    <label for="checkbox-signup">
                        @@yo_acepto@@ <a href="#">@@terminos_condiciones@@</a>
                    </label>
                </div>

            </div>
        </div>

        <div class="form-group text-right m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-custom waves-effect waves-light w-md" type="submit">@@registrar@@</button>
            </div>
        </div>

        <div class="form-group m-t-30">
            <div class="col-sm-12 text-center">
                <a href="pages-login.php" class="text-muted">@@cuento_cuenta@@?</a>
            </div>
        </div>
    </form>

</div>



<?php require 'includes/footer_account.php'; ?>


<!--
@@correo@@ : correo
@@n_usuario@@ : Nombre de Usuario
@@contrase@@ : Contraseña
@@yo_acepto@@ : Acepto 
@@terminos_condiciones@@ : los Términos y Condiciones
@@registrar@@
@@cuento_cuenta@@
-->