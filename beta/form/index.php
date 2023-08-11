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
    <script src="./js/fnc_tbl.js"></script> 
    <script src="./js/funciones.js"></script>
    <script src="assets/js/modernizr.min.js"></script>

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
        <a href="./login.php" class="logo-lg"><i class="md md-equalizer"></i> <span>@@nombre_sistema@@</span> </a>
    </div>
    <div class="row" align="center">


        <!--<form action="login.php">-->

        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><i class="md md-language"></i><b>@@seleccion_idioma@@</b></h4>
                <p class="text-justify font-13 m-b-25">
                    <!--@@mensaje_seleccion_idioma@@-->
                </p>

                <table class="table m-0" id="tbl_idioma" name="tbl_idioma">

                </table>
                <input type="hidden" id="var" name="var" value="idioma"/>
            </div>
        </div>
        <!--        <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">@@seleccionar@@
                        </button>
                    </div>
                </div>-->


        <!--</form>-->
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



<!--

<code>.table</code> to any <code>&lt;table&gt;</code>.

@@seleccione_idioma@@ : "Seleccione Idioma"
@@mensaje_seleccion_idioma@@ : "Mensaje de Selección de Idioma o de Bienvenida al sistema"
@@seleccionar@@ : "Seleccionar"
-->
