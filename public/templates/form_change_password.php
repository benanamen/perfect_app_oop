<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 offset-md-3">

            <!-- form card -->
            <div class="card card-outline-secondary mt-5">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Change Password</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" autocomplete="off">

                        <div class="form-group">
                            <label for="password">Current Password <span style="color: #FF0000;">*</span></label>
                            <input id="password"
                                   name="password"
                                   type="password"
                                   class="form-control <?= !empty($error['password']) ? 'is-invalid' : '' ?>"

                                   value="<?= !empty($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['password'])): ?>
                                <span class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : '' ?>"><?= $error['password'] ?></span>
                            <?php endif; ?>
                            <span id="helpPassword" class="form-text small text-muted">You will be automatically logged out after password change. You will need to re-login.</span>
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password <span style="color: #FF0000;">*</span></label>
                            <input id="new_password"
                                   name="new_password"
                                   type="password"
                                   class="form-control <?= !empty($error['new_password']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['new_password']) ? htmlspecialchars($_POST['new_password'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['new_password'])): ?>
                                <span class="form-text <?= !empty($error['new_password']) ? 'invalid-feedback' : '' ?>"><?= $error['new_password'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Confirm Password <span
                                        style="color: #FF0000;">*</span></label>
                            <input id="password_confirm"
                                   name="password_confirm"
                                   type="password"
                                   class="form-control <?= !empty($error['password_confirm']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['password_confirm']) ? htmlspecialchars($_POST['password_confirm'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['password_confirm'])): ?>
                                <span class="form-text <?= !empty($error['password_confirm']) ? 'invalid-feedback' : '' ?>"><?= $error['password_confirm'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
