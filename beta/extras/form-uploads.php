<?php require 'includes/header_start.php'; ?>
<link href="../plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />

<?php require 'includes/header_end.php'; ?>



<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <ol class="breadcrumb pull-right">
                <li><a href="#">Minton</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Multiple File Upload</li>
            </ol>
            <h4 class="page-title">Multiple File Upload</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 portlets">
        <!-- Your awesome content goes here -->
        <div class="m-b-30">
            <form action="#" class="dropzone" id="dropzone">
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>

            </form>
            <div class="clearfix pull-right m-t-15">
                <button type="button" class="btn btn-pink btn-rounded waves-effect waves-light">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- end row -->





<?php require 'includes/footer_start.php' ?>
<!-- Dropzone js -->
<script src="../plugins/dropzone/dist/dropzone.js"></script>

<?php require 'includes/footer_end.php' ?>
