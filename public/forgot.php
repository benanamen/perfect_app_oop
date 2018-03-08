<?php
/**
 * Last Modified <!--%TimeStamp%-->12/1/2017 8:36 PM<!---->
 */

require('../config.php');

$error = [];
$show_error = false;

if( $_SERVER['REQUEST_METHOD'] == 'POST')
{
    //------------------------------------------------------------------------
    // Trim $_POST Array
    //------------------------------------------------------------------------

    $_POST = trim_array($_POST);

    //------------------------------------------------------------------------
    // Validate Form Input
    //------------------------------------------------------------------------

    if (empty($_POST['forgot']))
    {
        $error['forgot'] = 'Email Address Required.';
    }
    else if (!filter_var($_POST['forgot'], FILTER_VALIDATE_EMAIL))
    {
        $error['forgot'] = 'Enter a valid Email';
    }

    //------------------------------------------------------------------------
    // Check for errors
    //------------------------------------------------------------------------

    if ($error)
    {
        $show_error = true;
    }
    else
    {
        // Check DB for matching username and password.
        $sql = "SELECT user_id, email FROM users WHERE email = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['forgot']
        ]);
        $row  = $stmt->fetch();

        //--------------------------------------------------------------------------------
        // No Results - Redirect
        //--------------------------------------------------------------------------------

        if (!$row)
        {
            die(header("Location: login.php?reset_sent"));
        }

        //--------------------------------------------------------------------------------
        // Check Reset table to see if there are multiple incomplete reset attempts
        // Block access if too many.
        //--------------------------------------------------------------------------------

        $user_id = $row['user_id'];
        /**
        $sql = "SELECT COUNT(*) from password_reset WHERE user_id = ? AND password_reset_key  <>'' " ;
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
        $user_id
        ]);

        $count = $stmt->fetchColumn();
        if ($count==3){
        echo '<div class="error_custom">Too Many Incomplete Password Resets. Contact Site Admin</div>';
        //echo $count;
        exit;
        }
         */
        //--------------------------------------------------------------------------------
        // Log Password Reset Data
        //--------------------------------------------------------------------------------

        // From http://forums.phpfreaks.com/topic/298729-forgotten-password/?hl=%2Bmcrypt_create_iv#entry1524084
        // generate 16 random bytes
        $raw_token = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

        // encode the random bytes and send the result to the user
        $encoded_token = bin2hex($raw_token);

        // hash the random bytes and store this hash in the database
        $token_hash = hash('sha256', $raw_token);

        /**
         * Interval specification.
         *
         * The format starts with the letter P, for "period." Each duration period is
         * represented by an integer value followed by a period designator. If the
         * duration contains time elements, that portion of the specification is
         * preceded by the letter T.
         *
         * @link http://www.php.net/manual/en/dateinterval.construct.php
         *
         * String to time option
         * $password_reset_expiration_datetime = date('Y-m-d H:i:s', strtotime("+5 min"));
         *
         */
        $period_designator = 'PT';
        $timespan          = 'M'; //Minutes
        $timespan_add      = 5; // Amount of days or minutes

        $time = new DateTime(date('Y-m-d H:i:s'));
        $time->add(new DateInterval($period_designator . $timespan_add . $timespan));

        $password_reset_expiration_datetime = $time->format('Y-m-d H:i:s');

        $sql  = "INSERT INTO password_reset (user_id, password_reset_username_email, password_reset_requesters_ip, password_reset_key,password_reset_expiration_datetime) values(?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
        $user_id,
        $_POST['forgot'],
        $_SERVER["REMOTE_ADDR"],
        $token_hash ,
        $password_reset_expiration_datetime
        ]);

        //--------------------------------------------------------------------------------
        // Email Reset Data
        //--------------------------------------------------------------------------------

        $subject    = APP_NAME . " - Forgot Password";
        $email_body = "We received a password reset request. If you did not request to reset your password just ignore this message.\r\n";
        $email_body .= "Click the link below to set reset password.\r\n\r\n";
        $email_body .= APPLICATION_URL . "/reset.php?k=$encoded_token";

        // Send mail
        send_email("{$row['email']}", $subject, $email_body, ADMIN_EMAIL_FROM);

        die(header("Location: login.php?reset_sent"));
    } // End else
}

//----------------------------------------------------------------------------------------
// Forgot Password Form
//----------------------------------------------------------------------------------------

include('../includes/header.php');
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
?>
    <form class="form-horizontal" action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="post" autocomplete="off">
        <div class="form-group <?= !empty($error['forgot']) ? 'has-error' : '' ?>">
            <label class="col-md-4 control-label" for="forgot">Enter Email</label>
            <div class="col-md-4">
                <input id="forgot" name="forgot" type="text" placeholder="Email Address" class="form-control input-md">
                <span class="help-block">Reset instructions will be emailed</span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4  col-sm-10">
                <button id="submit" type="submit" name="submit" class="btn btn-primary">Reset Password</button>  <a href="./login.php">Login</a>
            </div>
        </div>
    </form>
<?php
include('../includes/footer.php');
