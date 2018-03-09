<div class="row justify-content-center">
    <div class="col-6">

<form method="post" autocomplete="off">
    <div class="form-group row">
        <label class="col-3 col-form-label" for="username">Username <span class="text-danger">*</span></label>
        <div class="col-6">
            <input id="username" name="username" placeholder="Username" class="form-control <?= !empty($error['username']) ? 'is-invalid' : '' ?>" aria-describedby="usernameHelpBlock" type="text" value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" autofocus>

            <?php if (!empty($error['username'])): ?>
            <span id="usernameHelpBlock" class="form-text <?= !empty($error['username']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['username'] ?></span>
            <?php endif;?>

        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-3 col-form-label">Password <span class="text-danger">*</span></label>
        <div class="col-6">
            <input id="password" name="password" placeholder="Password" class="form-control <?= !empty($error['password']) ? 'is-invalid' : '' ?>" aria-describedby="passwordHelpBlock" type="text" value="<?= !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" >

            <?php if (!empty($error['password'])): ?>
            <span id="passwordHelpBlock" class="form-text <?= !empty($error['password']) ? 'invalid-feedback' : 'text-muted' ?>"><?= $error['password'] ?></span>
            <?php endif;?>

        </div>
    </div>

<!--    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>
            <label class="form-check-label" for="invalidCheck3">
                Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
        </div>
    </div>-->


    <div class="form-group row">
        <div class="offset-3 col-1">
            <button name="submit" type="submit" class="btn btn-primary">Sign In</button>
        </div>
    </div>
</form>

    </div>
</div>