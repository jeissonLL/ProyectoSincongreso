<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="@@descripcion_meta@@">
    <meta name="author" content="IIES">

    <link rel="shortcut icon" href="assets/images/ceat.ico">

    <title>@@nombre_sistema@@</title>
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
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
    <script src="./js/fnc_tbl.js"></script> 
    <script src="./js/funciones.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="./js/dinamica.js"></script>      
    <link href="../plugins/custombox/dist/custombox.min.css" rel="stylesheet">
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


</head>
<body >


<!--

@@descripcion_meta@@ : descripción del sistema en el meta del header
@@titulo@@ : título del sistema

-->

<div class="wrapper-page">

    <div class="text-center">
   
        <a href="index.php" class="logo-lg"><i class="md md-equalizer"></i> <span>@@nombre_sistema@@</span> </a>
       
    </div>

    <form class="form-horizontal m-t-20" id="form_login" name="form_login" method="POST">

        <div class="form-group">
            <div class="col-xs-12">
                <input class="form-control" type="text" required=""  onkeypress="return  SoloLetras(event)" 
                placeholder="@@nombre_usuario@@" id="nusuario" name="nusuario">
                <i class="md md-account-circle form-control-feedback l-h-34"></i>
            </div>
        </div>

    


        <div class="form-group">
            <div class="col-xs-12">
         
                <input class="form-control" id="inputPassword" name="contrase" type="password" placeholder="@@contrase@@" 
                   onkeypress="return pulsar(event)"  maxlength="256" required />
                      <label for="inputPassword"></label>
               <span class="indicator2"></span>
                <button class="btn btn-primary" type="button" onclick="mostrarPassword()"><span class="fa fa-eye-slash icon"></span></button>
             
                <div class="form-check mb-4">   
                </div> 
            </div>
        </div>


<!--        <div class="form-group">
            <div class="col-xs-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox">
                    <label for="checkbox-signup">
                        @@recordarme@@
                    </label>
                </div>

            </div>
        </div>-->

        <div class="form-group text-right m-t-20">
            <div class="col-xs-12">
               <center> <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">@@iniciar_sesion@@
                </button></center>
            </div>
        </div>

        <center>   <div class="form-group m-t-30">
         <div class="col-sm-7">
                <a href="#custom-modal" class="text-muted" data-animation="contentscale" data-plugin="custommodal"
                           data-overlaySpeed="100" data-overlayColor="#36404a"><i class="fa fa-lock m-r-5"></i>@@olvida_contra@@</a>
            </div>
            <div class="col-sm-5 text-right">
                <a href="register.php" class="text-muted">@@crear_cuenta@@</a>
            </div></center>
        </div>
    </form>
</div>
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">@@recuperar_contraseña@@</h4>
    <div class="custom-modal-text" >
        <form class="form-horizontal m-t-20" id="form_recuperar" name="form_recuperar" method="POST">

        <div class="form-group m-t-30">
            <div class="col-xs-12" >
                <input class="form-control" type="text" required="" placeholder="@@correo_registro@@" id="cprincipal" name="cprincipal">
                <span>@@msj_correo@@</span>
            </div>
        </div>

        <div >
            <div>
                <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">@@solicitar@@
                </button>
            </div>
        </div>

    </form>
    </div>
</div>





<script>
    var resizefunc = [];
</script>

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
<script src="../plugins/custombox/dist/custombox.min.js"></script>
<script src="../plugins/custombox/dist/legacy.min.js"></script>

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

</script>


</body>
</html>


<script>
    b_func('tbl_idioma');
</script>
<script>
/*ALEXIS ESCOTO 19/12/2022

VALIDACIONES PARA LOS CAMPOS USUARIO Y CONTRASEÑA
*/
         
//MOSTRAR Y OCULTAR CONTRASEÑA
            function mostrarPassword(){
		var cambio = document.getElementById("inputPassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
    function pulsar(e) {
              tecla=(document.all) ? e.keyCode : e.which;
              if(tecla==32) return false;
              //valida3letras();
              //ValidarPassword('inputPassword');
              //console.log(e);
          
            }

                //FUNCION SOLO LETRAS
                function SoloLetras(e)
            {
                key=e.keyCode || e.which;
                tecla=String.fromCharCode(key).toString();
                letras ="{ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz}";

                especiales = [8,13]
                tecla_especial =false
                for(var i in especiales){
                    if(key ==especiales[i]){
                        tecla_especial = true;
                        
                        break;
                        
                    }
                }
                if(letras.indexOf(tecla) == -1 && !tecla_especial)
                {
                    alert("Por favor, Ingrese Solo Letras");
                    return false
                }
               
            
                

            }
    </script>    


<!--

<code>.table</code> to any <code>&lt;table&gt;</code>.

@@seleccione_idioma@@ : "Seleccione Idioma"
@@mensaje_seleccion_idioma@@ : "Mensaje de Selección de Idioma o de Bienvenida al sistema"
@@seleccionar@@ : "Seleccionar"
-->




<!--
@@o_contra@@ : olvido contraseña
@@c_cuenta@@ :  crear cuenta / registrar
@@recordarme@@ : Recordarme
@@sistema@@ : Nombre del sistema
@@i_sesion@@ : Iniciar Sesión
@@n_usuario@@ : Nombre de Usuario
@@contrase@@ : Contraseña
-->
