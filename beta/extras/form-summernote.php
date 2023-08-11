<?php require 'includes/header_start.php'; ?>
<link href="../plugins/summernote/dist/summernote.css" rel="stylesheet" />

<?php require 'includes/header_end.php'; ?>



<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <ol class="breadcrumb pull-right">
                <li><a href="#">Minton</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Summernote Editor</li>
            </ol>
            <h4 class="page-title">Summernote Editor</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-b-30 m-t-0 header-title"><b>Default Editor</b></h4>
            <div class="summernote">
                <h3>Hello Summernote</h3>
            </div>
        </div>
    </div>
</div>

<!-- End row -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><b>Inline Editor</b></h4>
            <div class="inline-editor">

                <h3>This is an Air-mode editable area.</h3>
                <ul>
                    <li>
                        Select a text to reveal the toolbar.
                    </li>
                    <li>
                        Edit rich document on-the-fly, so elastic!
                    </li>
                </ul>
                <p>
                    End of air-mode area
                </p>
            </div>
        </div>
    </div>
</div>

<!-- End row -->



<?php require 'includes/footer_start.php' ?>
<!--form summernote-->
<script src="../plugins/summernote/dist/summernote.min.js"></script>

<script>

    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 350,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });
</script>

<?php require 'includes/footer_end.php' ?>
