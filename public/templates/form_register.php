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
            <div class="card card-outline-secondary">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Register</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" autocomplete="off">

                        <div class="form-group">
                            <label for="first_name">First Name <span style="color: #FF0000;">*</span></label>
                            <input id="first_name"
                                   name="first_name"
                                   type="text"
                                   class="form-control <?= !empty($error['first_name']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['first_name'])): ?>
                                <span class="form-text <?= !empty($error['first_name']) ? 'invalid-feedback' : '' ?>"><?= $error['first_name'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last Name <span style="color: #FF0000;">*</span></label>
                            <input id="last_name"
                                   name="last_name"
                                   type="text"
                                   class="form-control <?= !empty($error['last_name']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['last_name'])): ?>
                                <span class="form-text <?= !empty($error['last_name']) ? 'invalid-feedback' : '' ?>"><?= $error['last_name'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span style="color: #FF0000;">*</span></label>
                            <input id="email"
                                   name="email"
                                   type="text"
                                   class="form-control <?= !empty($error['email']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['email'])): ?>
                                <span class="form-text <?= !empty($error['email']) ? 'invalid-feedback' : '' ?>"><?= $error['email'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="username">Username <span style="color: #FF0000;">*</span></label>
                            <input id="username"
                                   name="username"
                                   type="text"
                                   class="form-control <?= !empty($error['username']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['username'])): ?>
                                <span class="form-text <?= !empty($error['username']) ? 'invalid-feedback' : '' ?>"><?= $error['username'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span style="color: #FF0000;">*</span></label>
                            <input id="password"
                                   name="password"
                                   type="password"
                                   class="form-control <?= !empty($error['password']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                            >

                            <?php if (!empty($error['password'])): ?>
                                <span class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : '' ?>"><?= $error['password'] ?></span>
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
                            <input type="hidden" name="update">
                            <?= !empty($_GET['id']) ? '<input type="hidden" name="id" value="' . htmlspecialchars($_GET['id'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">' : ''; ?>
                            <button type="submit" class="btn btn-primary btn-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
