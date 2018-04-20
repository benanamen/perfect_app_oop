<form method="post" autocomplete="off">

    <div class="d-flex p-2 d-flex justify-content-center">
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-md-6 col-form-label">Username <span style="color: #FF0000;">*</span></label>
            <div class="col-sm-12 col-md-12">
                <input id="username"
                       type="text"
                       name="username"
                       class="form-control <?= !empty($error['username']) ? 'is-invalid' : '' ?>"
                       placeholder="Username"
                       value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';?>">

                <?php if (!empty($error['username'])): ?>
                    <span id="passwordHelpBlock"
                          class="form-text <?= !empty($error['username']) ? 'invalid-feedback' : '' ?>"><?= $error['username'] ?></span>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="d-flex p-2 d-flex justify-content-center">
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-md-6 col-form-label">Password <span style="color: #FF0000;">*</span></label>
            <div class="col-sm-12 col-md-12">
                <input id="password"
                       type="password"
                       name="password"
                       class="form-control <?= !empty($error['password']) ? 'is-invalid' : '' ?>"
                       placeholder="Password"
                       value="<?= !empty($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : '';?>">

                <?php if (!empty($error['password'])): ?>
                    <span id="passwordHelpBlock"
                          class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : '' ?>"><?= $error['password'] ?></span>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="d-flex p-2 d-flex justify-content-center">
        <div class="form-group row">
            <div class="col-sm-12 col-md-12">
                <button name="submit" type="submit" class="btn btn-primary">Sign In</button>&nbsp;
                <a href="./forgot.php">Forgot Password</a>
            </div>
        </div>
    </div>

</form>
