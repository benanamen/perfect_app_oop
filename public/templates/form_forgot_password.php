<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}
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
                    <form role="form" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="inputResetPasswordEmail">Email</label>
                            <input id="inputResetPasswordEmail"
                                   name="email"
                                   type="email"
                                   class="form-control <?= !empty($error['email']) ? 'is-invalid' : '' ?>"
                                   autofocus
                            >

                            <?php if (!empty($error['email'])): ?>
                                <span class="form-text <?= !empty($error['email']) ? 'invalid-feedback' : '' ?>"><?= $error['email'] ?></span>
                            <?php endif; ?>

                            <span id="helpResetPasswordEmail" class="form-text small text-muted">Password reset instructions will be sent to this email address.</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
