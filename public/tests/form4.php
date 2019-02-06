<?php declare (strict_types=1);

define('SECURE_PAGE', true);

require './config.php';
include './includes/header.php';
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);
?>

<div class="row">
    <div class="col-md-12">

        <div class="col-md-6 offset-md-3">

            <!-- form card reset password -->
            <div class="card card-outline-secondary">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Password Reset</h3>
                </div>
                <div class="card-body">
                    <form class="form" role="form" autocomplete="off">
                        <div class="form-group">
                            <label for="inputResetPasswordEmail">Email</label>
                            <input type="email" class="form-control" id="inputResetPasswordEmail" required>
                            <span id="helpResetPasswordEmail" class="form-text small text-muted">Password reset instructions will be sent to this email address.</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md float-right">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /form card reset password -->

        </div>

    </div>
    <!--/row-->
</div>
<!--/container-->