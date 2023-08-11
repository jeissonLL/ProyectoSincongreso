<?php require 'includes/header_account.php'; ?>

<div class="wrapper-page">

    <div class="text-center">
        <a href="index.php" class="logo-lg"><i class="md md-equalizer"></i> <span>Minton</span> </a>
    </div>

    <form method="post" action="index.php" role="form" class="text-center m-t-20">
        <div class="user-thumb">
            <img src="assets/images/users/avatar-2.jpg" class="img-responsive img-circle img-thumbnail"
                 alt="thumbnail">
        </div>
        <div class="form-group">
            <h3>John Deo</h3>
            <p class="text-muted">Enter your password to access the admin.</p>
            <div class="input-group m-t-30">
                <input type="password" class="form-control" placeholder="Password">
                <i class="md md-vpn-key form-control-feedback l-h-34" style="left:6px;z-index: 99;"></i>
                        <span class="input-group-btn"> <button type="submit"
                                                               class="btn btn-email btn-primary waves-effect waves-light">
                            Log In
                        </button> </span>
            </div>
        </div>
        <div class="text-right">
            <a href="pages-login.php" class="text-muted">Not John Deo ?</a>
        </div>
    </form>
</div>



<?php require 'includes/footer_account.php'; ?>
