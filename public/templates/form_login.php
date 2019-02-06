<?php declare (strict_types=1);

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
                    <h3 class="mb-0">Login</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" autocomplete="off">

                        <div class="form-group">
                            <label for="username">Username <span style="color: #FF0000;">*</span></label>
                            <input id="username"
                                   name="username"
                                   type="text"
                                   class="form-control <?= !empty($error['username']) ? 'is-invalid' : '' ?>"
                                   value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>"
                                   autofocus
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
                            <input type="hidden" name="update">
                            <?= !empty($_GET['id']) ? '<input type="hidden" name="id" value="' . htmlspecialchars($_GET['id'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '">' : ''; ?>

                            <button type="submit" class="btn btn-primary btn-md">Login</button>
                            <a href="forgot.php" class="btn btn-outline-dark float-right">Forgot Password</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
