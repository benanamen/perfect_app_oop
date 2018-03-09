<?php
/**
 * Last Modified <!--%TimeStamp%-->1/14/2017 9:01 PM<!---->
 */

require ('../config.php');
$show_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    // -----------------------------------------------------------------------------------
    // Trim Data, Sanitize Input, Check Missing Fields
    // -----------------------------------------------------------------------------------

    include ('../includes/validation/validate_registration.php');

    // -----------------------------------------------------------------------------------
    // Check for errors
    // -----------------------------------------------------------------------------------

    if ($error)
        {
        $show_error = true;
        }
      else
        {
        // From http://forums.phpfreaks.com/topic/298729-forgotten-password/?hl=%2Bmcrypt_create_iv#entry1524084
        // generate 16 random bytes

        $raw_token = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

        // encode the random bytes and send the result to the user

        $encoded_token = bin2hex($raw_token);

        // hash the random bytes and store this hash in the database

        $token_hash = hash('sha256', $raw_token);
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try
            {
            $sql = 'INSERT INTO users (first_name, last_name, email, username, password, confirmation_key) VALUES(?,?,?,?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['email'],
            $_POST['username'],
            $hashed_password,
            $token_hash]
            );

            $subject = 'Confirm Email';
            $email_body = "Click to activate account\r\n" . APPLICATION_URL . "/activate.php?k=$encoded_token";
            send_email("{$_POST['email']}", $subject, $email_body, ADMIN_EMAIL_FROM);

            header("Location: ./login.php?confirm");
            die;
            }
        catch(PDOException $e)
            {
            if ($e->getCode() == '23000')
                {
                $error[] = "Registration Failed";
                $error[] = "Invalid Username or Email";
                show_form_errors($error);
                }
              else
                {
                throw new Exception($e);
                }
            } // End Catch

        } // End Else
    } // End POST

require ('../includes/header.php');
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
    <div class="form-group <?= !empty($error['first_name']) ? 'has-error' : '' ?>">
        <label class="col-md-4 control-label" for="first_name">First Name <span style="color: #FF0000;">*</span></label>
        <div class="col-md-4">
            <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control input-md" value="<?= !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>">
        </div>
    </div>
    <div class="form-group <?= !empty($error['last_name']) ? 'has-error' : '' ?>">
        <label class="col-md-4 control-label" for="last_name">Last Name <span style="color: #FF0000;">*</span></label>
        <div class="col-md-4">
            <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control input-md" value="<?= !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>">
        </div>
    </div>
   <div class="form-group <?= !empty($error['email']) ? 'has-error' : '' ?>">
      <label class="col-md-4 control-label" for="email">Email <span style="color: #FF0000;">*</span></label>
      <div class="col-md-4">
         <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" value="<?= !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
      </div>
   </div>
    <div class="form-group <?= !empty($error['username']) ? 'has-error' : '' ?>">
        <label class="col-md-4 control-label" for="username">Username <span style="color: #FF0000;">*</span></label>
        <div class="col-md-4">
            <input id="username" name="username" type="text" placeholder="username" class="form-control input-md" value="<?= !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>
    </div>
   <div class="form-group <?= !empty($error['password']) || !empty($error['password_confirm']) ? 'has-error' : '' ?>">
      <label class="col-md-4 control-label" for="password">Password <span style="color: #FF0000;">*</span></label>
      <div class="col-md-4">
         <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" value="<?= !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>">
      </div>
   </div>
   <div class="form-group <?= !empty($error['password_confirm']) ? 'has-error' : '' ?>">
      <label class="col-md-4 control-label" for="password_confirm">Confirm Password <span style="color: #FF0000;">*</span></label>
      <div class="col-md-4">
         <input id="password_confirm" name="password_confirm" type="password" placeholder="Confirm Password" class="form-control input-md" value="<?= !empty($_POST['password_confirm']) ? htmlspecialchars($_POST['password_confirm']) : '' ?>">
      </div>
   </div>
   <div class="form-group">
      <div class="col-md-offset-4 col-md-4">
         <input type="submit" name="submit" value="Register" class="btn btn-primary">
      </div>
   </div>
</form>
<?php
include('../includes/footer.php');
