<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}
?>

<div class="row justify-content-center">
    <div class="col-6">
        <form class="form-horizontal" method="post" autocomplete="off">

            <div class="form-group row">
                <label class="col-3 col-form-label" for="first_name">First Name <span
                            class="text-danger">*</span></label>
                <div class="col-6">
                    <input id="first_name" name="first_name" placeholder="First Name"
                           class="form-control <?= !empty($error['first_name']) ? 'is-invalid' : '' ?>"
                           aria-describedby="first_nameHelpBlock" type="text"
                           value="<?= !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>"
                           autofocus>

                    <?php if (!empty($error['first_name'])): ?>
                        <span id="first_nameHelpBlock"
                              class="form-text <?= !empty($error['first_name']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['first_name'] ?></span>
                    <?php endif; ?>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-3 col-form-label" for="last_name">Last Name <span
                            class="text-danger">*</span></label>
                <div class="col-6">
                    <input id="last_name" name="last_name" placeholder="Last Name"
                           class="form-control <?= !empty($error['last_name']) ? 'is-invalid' : '' ?>"
                           aria-describedby="last_nameHelpBlock" type="text"
                           value="<?= !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>">

                    <?php if (!empty($error['last_name'])): ?>
                        <span id="last_nameHelpBlock"
                              class="form-text <?= !empty($error['last_name']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['last_name'] ?></span>
                    <?php endif; ?>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-3 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                <div class="col-6">
                    <input id="email" name="email" placeholder="Email"
                           class="form-control <?= !empty($error['email']) ? 'is-invalid' : '' ?>"
                           aria-describedby="emailHelpBlock" type="text"
                           value="<?= !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

                    <?php if (!empty($error['email'])): ?>
                        <span id="emailHelpBlock"
                              class="form-text <?= !empty($error['email']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['email'] ?></span>
                    <?php endif; ?>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-3 col-form-label" for="username">Username <span class="text-danger">*</span></label>
                <div class="col-6">
                    <input id="username" name="username" placeholder="Username"
                           class="form-control <?= !empty($error['username']) ? 'is-invalid' : '' ?>"
                           aria-describedby="usernameHelpBlock" type="text"
                           value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">

                    <?php if (!empty($error['username'])): ?>
                        <span id="usernameHelpBlock"
                              class="form-text <?= !empty($error['username']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['username'] ?></span>
                    <?php endif; ?>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-3 col-form-label" for="password">Password <span class="text-danger">*</span></label>
                <div class="col-6">
                    <input id="password" name="password" placeholder="Password"
                           class="form-control <?= !empty($error['password']) ? 'is-invalid' : '' ?>"
                           aria-describedby="passwordHelpBlock" type="text"
                           value="<?= !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">

                    <?php if (!empty($error['password'])): ?>
                        <span id="passwordHelpBlock"
                              class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['password'] ?></span>
                    <?php endif; ?>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-3 col-form-label" for="password_confirm">Confirm Password <span
                            class="text-danger">*</span></label>
                <div class="col-6">
                    <input id="password_confirm" name="password_confirm" placeholder="Confirm Password"
                           class="form-control <?= !empty($error['password_confirm']) ? 'is-invalid' : '' ?>"
                           aria-describedby="password_confirmHelpBlock" type="text"
                           value="<?= !empty($_POST['password_confirm']) ? htmlspecialchars($_POST['password_confirm']) : '' ?>">

                    <?php if (!empty($error['password_confirm'])): ?>
                        <span id="password_confirmHelpBlock"
                              class="form-text <?= !empty($error['password_confirm']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['password_confirm'] ?></span>
                    <?php endif; ?>

                </div>
            </div>

            <div class="form-group row">
                <div class="offset-3 col-1">
                    <button name="submit" type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>

        </form>
    </div>
</div>