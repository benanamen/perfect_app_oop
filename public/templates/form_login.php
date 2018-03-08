<form class="form-horizontal" action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post" autocomplete="off">
    <div class="form-group <?= !empty($error['username']) ? 'has-error' : '' ?>">
        <label for="username" class="col-md-4 control-label">Username</label>
        <div class="col-md-4">
            <input name="username" type="text" class="form-control" id="username" placeholder="username" value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" autofocus >
            <?php if (!empty($error['username'])): ?>
                <span class="help-block"><?= $error['username'] ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group <?= !empty($error['password']) ? 'has-error' : '' ?>">
        <label for="password" class="col-md-4 control-label">Password</label>
        <div class="col-md-4">
            <input name="password" type="password" class="form-control" id="password" placeholder="Password" value="<?= !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
            <?php if (!empty($error['password'])): ?>
                <span class="help-block"><?= $error['password'] ?></span>
            <?php endif;?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
            <button type="submit" class="btn btn-primary">Sign In</button>  <a href="./forgot.php">Forgot Password</a> | <a href="./register.php">Register</a>
        </div>
    </div>
</form>