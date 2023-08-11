<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="@@descripcion_meta@@">
    <meta name="author" content="IIES">

    <link rel="shortcut icon" href="assets/images/ceat.ico">

    <title>@@nombre_sistema@@</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
       <link href="assets/css/custom.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-1.7.min.js"></script>

    <!-- Main  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <!-- Custom main Js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <!-- Countdown -->
    <script src="../plugins/countdown/dest/jquery.countdown.min.js"></script>
    <script src="../plugins/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>    
    <script src="../plugins/notifyjs/dist/notify.min.js"></script>
    <script src="../plugins/notifications/notify-metro.js"></script>    
    
    <script src="./js/fnc_tbl.js"></script> 
    <script src="./js/funciones.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="./js/dinamica.js"></script>    
    <script src="./js/fnc_slc.js"></script>   
    <script src="./js/validaciones.js"></script>     

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


</head>
<body>


<!--

@@descripcion_meta@@ : descripción del sistema en el meta del header
@@titulo@@ : título del sistema

-->

<div class="wrapper-page">

    <div class="text-center">
        <a href="index.php" class="logo-lg"><i class="md md-equalizer"></i> <span>@@nombre_sistema@@</span> </a>
    </div>

    <form class="form-horizontal m-t-20" id="form_registro" name="form_registro" method="POST">
        
        <span></span>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="@@nombres@@" id="nombres" name="nombres">
                <i class="md md-person form-control-feedback l-h-34"></i>
            </div>
        </div>        

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="@@apellidos@@" id="apellidos" name="apellidos">
                <i class="md md-account-child form-control-feedback l-h-34"></i>
            </div>
        </div>        

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="@@telefono_principal@@" id="tprincipal" name="tprincipal">
                <i class="md md-phone form-control-feedback l-h-34"></i>
            </div>
        </div>      

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="email" required="" placeholder="@@correo_principal@@" id="cprincipal" name="cprincipal">
                <i class="md md-email form-control-feedback l-h-34"></i>
            </div>
        </div>  
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="email" required="" placeholder="@@correo_alterno@@" id="calterno" name="calterno">
                <i class="md md-email form-control-feedback l-h-34"></i>
            </div>
        </div>          

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="@@nombre_usuario@@" id="nusuario" name="nusuario">
                <i class="md md-account-circle form-control-feedback l-h-34"></i>
                <div id="info"></div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" required="" placeholder="@@contrase@@" id="contrase" name="contrase">
                <i class="md md-vpn-key form-control-feedback l-h-34"></i>
              
            </div>
                    <div id="contrasenia_info">
                       <h4>La contraseña debería cumplir con los siguientes requerimientos:</h4>
                       <ul>
                          <li id="letter">Al menos debería tener <strong>una letra</strong></li>
                          <li id="capital">Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                          <li id="number">Al menos debería contener <strong>un número</strong></li>
                          <li id="length">Debería tener al menos<strong>8 carácteres</strong></li>
                       </ul>
                    </div>              
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="password" required="" placeholder="@@confirmar_contrase@@" id="c_contrase" name="c_contrase">
                <i class="md md-vpn-key form-control-feedback l-h-34"></i>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                    <select id="tpersona" name="tpersona" class="form-control input-sm" >
                        <option value="">@@tipo_persona@@</option>
                     </select>             
                <i class="md md-accessibility form-control-feedback l-h-34"></i>
            </div>
        </div>
        <div class="form-group" >
            <div class="col-xs-12" id="div_institucion" style="display:none;">
                    <select id="institucion" name="institucion" class="form-control input-sm"  >
                        <option value="">@@institucion@@</option>
                     </select>             
                <i class="md md-accessibility form-control-feedback l-h-34"></i>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-xs-12">
                    <select id="pais" name="pais" class="form-control input-sm" >
                        <option value="">@@pais_procedencia@@</option>
                     </select>             
                <i class="md   md-flag form-control-feedback l-h-34"></i>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-xs-12">
                    <select id="idioma" name="idioma" class="form-control input-sm" >
                        <option value="">@@idioma@@</option>
                     </select>             
                <i class="md   md-language form-control-feedback l-h-34"></i>
            </div>
        </div>         
        <div class="form-group">
            <div class="col-xs-12">
                    <select id="tidentificacion" name="tidentificacion" class="form-control input-sm" >
                        <option value="">@@tipo_identificacion@@</option>
                     </select>             
                <i class="md   md-contacts form-control-feedback l-h-34"></i>
            </div>
        </div>            
        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="@@identificacion@@" id="identificacion" name="identificacion">
                <i class="md md-picture-in-picture form-control-feedback l-h-34"></i>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                    <select id="talimentacion" name="talimentacion" class="form-control input-sm" >
                        <option value="">@@tipo_alimentacion@@</option>
                    </select>             
                <i class="md  md-local-restaurant form-control-feedback l-h-34"></i>
            </div>
        </div>          
        <div class="form-group">
            <div class="col-xs-12">
                    <select id="congreso" name="congreso" class="form-control input-sm" >
                        <option value="">@@congreso@@</option>
                    </select>             
                <i class="md  md-apps form-control-feedback l-h-34"></i>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                    <select id="tparticipacion" name="tparticipacion" class="form-control input-sm" >
                        <option value="">@@tipo_participacion@@</option>
                    </select>             
                <i class="md md  md-people-outline form-control-feedback l-h-34"></i>
            </div>
        </div>        
<!--        <div class="form-group">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox" checked="checked">
                    <label for="checkbox-signup">
                        @@yo_acepto@@ <a href="#">@@terminos_condiciones@@</a>
                    </label>
                </div>

            </div>
        </div>-->

        <div class="form-group text-right m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-custom waves-effect waves-light w-md" type="submit" id="btn_registro">@@crear_cuenta@@</button>
            </div>
        </div>

        <div class="form-group m-t-30">
            <div class="col-sm-12 text-center">
                <a href="login.php" class="text-muted">@@cuento_cuenta@@</a>
            </div>
        </div>
    </form>

</div>



<script>
    var resizefunc = [];
</script>




<script type="text/javascript">
    $(document).ready(function () {

        // Countdown
        // To change date, simply edit: var endDate = "January 17, 2017 20:39:00";
        $(function () {
            var endDate = "January 17, 2018 20:39:00";
            $('.app-countdown .row').countdown({
                date: endDate,
                render: function (data) {
                    $(this.el).html('<div><div><span class="text-primary">' + (parseInt(this.leadingZeros(data.years, 2) * 365) + parseInt(this.leadingZeros(data.days, 2))) + '</span><span><b>Days</b></span></div><div><span class="text-primary">' + this.leadingZeros(data.hours, 2) + '</span><span><b>Hours</b></span></div></div><div class=""><div><span class="text-primary">' + this.leadingZeros(data.min, 2) + '</span><span><b>Minutes</b></span></div><div><span class="text-primary">' + this.leadingZeros(data.sec, 2) + '</span><span><b>Seconds</b></span></div></div>');
                }
            });
        });

        // Text rotate
        $(".home-text .rotate").textrotator({
            animation: "fade",
            speed: 3000
        });
    });
$("#congreso").change(function(){
    var congreso=$("#congreso").val();
     $.post("./includes/funciones.php?funcion=roles_congreso",{congreso:congreso},function(resp){
     $("#tparticipacion").html("");
     $("#tparticipacion").html(resp);
     })
})

$("#tpersona").change(function(){
    var tpersona=$("#tpersona").val();


    $("#div_institucion").removeAttr("style");
//    $("#div_institucion").attr("style", "display:none");

    
        $.post("./includes/funciones.php?funcion=tpersona",{tpersona:tpersona},function(resp){
     $("#institucion").html("");
     $("#institucion").html(resp);
     })
})
</script>


</body>
</html>



<!--
@@correo@@ : correo
@@n_usuario@@ : Nombre de Usuario
@@contrase@@ : Contraseña
@@yo_acepto@@ : Acepto 
@@terminos_condiciones@@ : los Términos y Condiciones
@@registrar@@
@@cuento_cuenta@@
-->
