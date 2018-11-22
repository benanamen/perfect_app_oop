<?php
/**
 * Collection of various functions
 *
 * Last Modified <!--%TimeStamp%-->2/23/2018 5:27 PM<!---->
 *
 * @version 2.0.0
 * @author Kevin Rubio
 * @copyright 2017 Galaxy Internet
 * @license Proprietary - No Licence Granted
 */

/**
 * Send Email & log error
 *
 * @param $to
 * @param $from
 * @param $subject
 * @param $email_body
 */
function send_email($to, $subject, $email_body, $from)
{
    if (!@mail($to, $subject, $email_body, "From: $from"))
    {
        $error = error_get_last();
        error_log(MYSQL_DATETIME_TODAY . "|{$error['message']}|File: {$error['file']}|Line: {$error['line']} \r\n", 3, ERROR_LOG_PATH);
    }
}

/**
 * Displays SQL Query & Parameters
 *
 * @param $stmt
 */

function show_debug_params(PDOStatement $stmt)
{
    echo '<div class="info">';
    echo $stmt->debugDumpParams();
    echo '</div>';
}

/**
 * Check error log file exists/writable
 */
function check_error_log()
{
    if (is_writable(ERROR_LOG_PATH))
    {
        echo "<div class='success'>The error log file exists and is writeable<br>" . ERROR_LOG_PATH . " </div>\n";
    }
    else
    {
        echo "<div class='error_custom'>The error log file does not exist or is not writable<br>" . ERROR_LOG_PATH . "</div>\n";
    }
}

/**
 * Display Add Record Button
 *
 * @param string $action_title Page title
 * @param string $file_name $_GET['p'] Filename
 * @param string $button_text Button Text
 *
 */

function add_record_button($action_title, $file_name, $button_text)
{
    ?>
    <p style="font-size:21px"><?= ucwords($action_title) ?></p>
    <p>
        <a href="<?= $_SERVER['SCRIPT_NAME'] ?>?p=<?= $file_name ?>" class="btn btn-primary" role="button">
            <span class="glyphicon glyphicon-plus-sign"></span> Add <?= ucwords($button_text) ?></a>
    </p>
    <?php
} //End Function

/**
 * Custom Exception Handler
 *
 * @param $exception Error data
 */

function custom_exception($exception)
{
    echo '<div class="error_custom col-md-12"><b>Fatal Error!</b>';

    $error_msg = "DATE: " . MYSQL_DATETIME_TODAY . "\nERROR: " . $exception->getMessage() . "\nFILE: " . $exception->getFile() . ' on line ' . $exception->getLine() . "\n\nSTACK TRACE\n" . $exception->getTraceAsString() . "\n";

    if (EMAIL_ERROR)
    {
        echo '<br>Admin has been notified';
        error_log("$error_msg", 1, ADMIN_EMAIL_TO, "From:" . ADMIN_EMAIL_FROM);
    }
    else
    {
        echo '<br>Admin has not been notified';
    }

    // Write error to log
    if (LOG_ERROR)
    {
        echo '<br>Error has been logged';
        error_log("$error_msg\r\n", 3, ERROR_LOG_PATH);
    }
    else
    {
        echo '<br>Error has not been logged';
    }

    echo '</div>';

    if (DEBUG)
    {
        echo '<div class="error_custom col-md-12"><b>Error Message:</b>';
        echo '<pre>';
        echo $exception->getMessage();
        echo '<br>FILE: ' . $exception->getFile();
        echo '<br>on line ' . $exception->getLine();
        echo '</pre>';
        echo '</div>';

        echo '<div class="error_custom"><b>Stack Trace:</b><br>';
        echo '<pre>';
        echo $exception->getTraceAsString();
        echo '</pre>';
        echo '</div>';
    }

    //https://rollbar.com/ Error reporting - https://sentry.io is better
    /*        $config = array('access_token' => '3980bdb53f084cdb998a4eebbb8145db');
            Rollbar::init($config);
            Rollbar::report_exception($exception);*/

}

/**
 * Delete Row Form - Deletes DB row by ID# any table.
 *
 * @param string $table_name DB table deleting from
 * @param string $redirect_filename Filename to redirect to
 * @param string $id_column_name ID Column name
 * @param int $row_id Row id #
 *
 */

function delete_row($table_name, $redirect_filename, $id_column_name, $row_id)
{
    ?>
    <td>
        <form class="form-horizontal" action="<?= $_SERVER['SCRIPT_NAME'] ?>?p=delete" method="post">
            <input type="hidden" name="table" value="<?= $table_name ?>">
            <input type="hidden" name="return" value="<?= $redirect_filename ?>">
            <input type="hidden" name="id_column" value="<?= $id_column_name ?>">
            <input type="hidden" name="id" value="<?= $row_id ?>">
            <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Delete
            </button>
        </form>
    </td>
    <?php
}

/**
 * Displays Edit Button
 *
 * @param string $table_name Table name
 * @param int $id Row id
 */

function edit_button($table_name, $id)
{
    ?>
    <td>
        <form class="form-horizontal" action="<?= $_SERVER['SCRIPT_NAME'] ?>?p=edit_<?= $table_name ?>" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit
            </button>
        </form>
    </td>
    <?php
} // End Function

/**
 * Change empty form string values to NULL for Database insert/updates
 *
 * @param $value
 * @return null
 */

function empty2null($value)
{
    return $value === '' ? null : $value;
}

/**
 * Displays logo
 *
 * @param int $img_width Image width
 * @param int $img_height Image height
 * @param string $alt_text Image Alt text
 */

function logo($img_width, $img_height, $alt_text)
{
    ?>
    <div class="d-flex p-2 justify-content-center mb-5">
        <a href="<?= APPLICATION_URL ?>">
            <img src="./images/<?= IMAGE_FILENAME ?>"
                 width="<?= $img_width ?>"
                 height="<?= $img_height ?>"
                 alt="<?= $alt_text ?>">
        </a>
    </div>
    <?php
}

/**
 * @param $error
 */
function show_form_errors($error)
{
    $error = implode("<br>\n", $error) . "\n";
    ?>
    <div class="col-md-6 offset-md-3">
        <div class="error_custom"><?= $error ?></div>
    </div>
    <?php
}

/**
 * Removes leading/trailing spaces from Array
 *
 * @param array | string $input
 * @return array|string
 */

function trim_array($input)
{
    if (!is_array($input))
    {
        return trim($input);
    }

    return array_map('trim_array', $input);
}
