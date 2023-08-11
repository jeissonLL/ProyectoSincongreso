<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>



<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <ol class="breadcrumb pull-right">
                <li><a href="#">Minton</a></li>
                <li><a href="#">Charts</a></li>
                <li class="active">Sparkline Charts</li>
            </ol>
            <h4 class="page-title">Sparkline Charts</h4>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Line Chart</b></h4>
            <div id="sparkline1"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Bar Chart</b></h4>
            <div id="sparkline2" class="text-center"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Pie Chart</b></h4>
            <div id="sparkline3" class="text-center"></div>
        </div>
    </div>
</div><!-- Row -->

<div class="row">
    <div class="col-md-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Custom Line Chart</b></h4>
            <div id="sparkline4" class="text-center"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Mouse Speed Chart Example</b></h4>
            <div id="sparkline5" class="text-center"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-20 header-title"><b>Composite bar Chart</b></h4>
            <div id="sparkline6" class="text-center"></div>
        </div>
    </div>
</div><!-- Row -->




<?php require 'includes/footer_start.php' ?>
<!-- Sparkline charts -->
<script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="assets/pages/jquery.charts-sparkline.js"></script>

<?php require 'includes/footer_end.php' ?>
