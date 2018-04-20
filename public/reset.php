<?php
//----------------------------------------------------------------------------------------
// Allow direct access to this page
//----------------------------------------------------------------------------------------

define('SECURE_PAGE', true);

require('./config.php');

$error = [];
$show_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //------------------------------------------------------------------------------------
    // Trim $_POST Array
    //------------------------------------------------------------------------------------

    $_POST = trim_array($_POST);

    //------------------------------------------------------------------------------------
    // Validate Form Input
    //------------------------------------------------------------------------------------

    if (empty($_POST['reset_code']))
    {
        $error['reset_code'] = 'Reset Code Required';
    }

    if (empty($_POST['new_password']))
    {
        $error['new_password'] = 'New Password Required';
    }

    if (empty($_POST['new_password_confirm']))
    {
        $error['new_password_confirm'] = ' Confirm Password Required';
    }
    elseif ($_POST['new_password'] != $_POST['new_password_confirm'])
    {
        $error['new_password_confirm'] = 'Passwords do not match';
    }

    if (strlen($_POST['reset_code']) != 32)
    {
        $error['invalid_token'] = 'Invalid Token';
    }

    // Decode Token. Rare instance to use @ error suppression
    if (!$raw_token = @hex2bin($_POST['reset_code']))
    {
        $error['invalid_token'] = 'Invalid Token';
    }

    //------------------------------------------------------------------------------------
    // Check for errors
    //------------------------------------------------------------------------------------

    if ($error)
    {
        $show_error = true;
    }
    else
    {
        // From http://forums.phpfreaks.com/topic/298729-forgotten-password/?hl=%2Bmcrypt_create_iv#entry1524084

        // Hash raw token
        $token_hash = hash('sha256', $raw_token);

        // Check DB for matching reset key.
        $sql = "SELECT user_id, email, pasword_reset_hash FROM users WHERE pasword_reset_hash=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$token_hash]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //--------------------------------------------------------------------------------
        // No Results - Redirect
        //--------------------------------------------------------------------------------

        if (!$row)
        {
            header("Location: {$_SERVER['SCRIPT_NAME']}?failed_reset");
            die();
        }

        //--------------------------------------------------------------------------------
        // Update Password
        //--------------------------------------------------------------------------------

        $hashed_new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ?, pasword_reset_hash = ?, password_reset_expires = ? WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$hashed_new_password, NULL, NULL, $row['user_id']]);

        //--------------------------------------------------------------------------------
        // Send Reset Email
        //--------------------------------------------------------------------------------

        $to = $row['email'];
        $subject = "Password has been reset";
        $email_body = "Password has been reset";
        send_email($to, $subject, $email_body, ADMIN_EMAIL_FROM);

        header("Location: login.php?reset");
        die();

    } // End else
} // End !empty POST

//----------------------------------------------------------------------------------------
// Reset Code Form
//----------------------------------------------------------------------------------------

include('./includes/header.php');
logo(IMAGE_WIDTH, IMAGE_HEIGHT, IMAGE_ALT);

// ---------------------------------------------------------------------------------------
// Display Form Errors
// ---------------------------------------------------------------------------------------

if ($show_error)
{
    show_form_errors($error);
}

// ---------------------------------------------------------------------------------------
// Display Form
// ---------------------------------------------------------------------------------------

$reset_code = isset($_GET['k']) ? $_GET['k'] : $reset_code = isset($_POST['reset_code']) ? $_POST['reset_code'] : '';
?>
    <form class="form-horizontal" action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post" autocomplete="off">

        <div class="form-group <?= !empty($error['reset_code']) ? 'has-error' : '' ?>">
            <label class="col-md-4 control-label" for="reset_code">Reset Code</label>
            <div class="col-md-5">
                <input id="reset_code" name="reset_code" type="text" placeholder="Reset Code"
                       class="form-control input-md"
                       value="<?= !empty($reset_code) ? htmlspecialchars($reset_code, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>">
            </div>
        </div>

        <div class="form-group <?= !empty($error['new_password']) ? 'has-error' : '' ?>">
            <label class="col-md-4 control-label" for="new_password">Enter New Password</label>
            <div class="col-md-5">
                <input id="new_password" name="new_password" type="password" placeholder="Enter New Password"
                       class="form-control input-md"
                       value="<?= !empty($_POST['new_password']) ? htmlspecialchars($_POST['new_password'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>">
            </div>
        </div>

        <div class="form-group <?= !empty($error['new_password_confirm']) ? 'has-error' : '' ?>">
            <label class="col-md-4 control-label" for="new_password_confirm">Confirm New Password</label>
            <div class="col-md-5">
                <input id="new_password_confirm" name="new_password_confirm" type="password"
                       placeholder="Confirm New Password" class="form-control input-md"
                       value="<?= !empty($_POST['new_password_confirm']) ? htmlspecialchars($_POST['new_password_confirm'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : ''; ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-4 col-sm-10">
                <button id="submit" type="submit" name="submit" class="btn btn-primary">Reset Password</button>
                <a href="./login.php">Login</a>
            </div>
        </div>

    </form>
<?php
include('./includes/footer.php');
