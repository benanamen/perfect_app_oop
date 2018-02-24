<?php
/**
 * Last Modified <!--%TimeStamp%-->1/14/2017 9:00 PM<!---->
 */

//----------------------------------------------------------------------------------------
// Clear Error Log File
//----------------------------------------------------------------------------------------

$show_how_many_errors = 10;
$error_log_filesize = filesize(ERROR_LOG_PATH);

if (isset($_GET['deleted']))
    {
    if ($error_log_filesize > 0)
        {
        $file = fopen(ERROR_LOG_PATH, 'w');
        fclose($file);
        header("Location: {$_SERVER['SCRIPT_NAME']}?p={$_GET['p']}");
        die;
        }
    }
?>
<h1>Error Log</h1>

<div class="well">
   <table class="table table-bordered table-striped table-hover">
      <caption></caption>
      <thead class="thead-dark">
         <tr>
            <th>Last <?= $show_how_many_errors ?> Errors  - <a href="<?= $_SERVER['SCRIPT_NAME'] ?>?p=errors&amp;deleted" title="Delete Errors">Delete Errors</a></th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <textarea rows="15" disabled style="width:100%" title="Errors"><?= trim(implode("\n", array_slice(file(ERROR_LOG_PATH), -$show_how_many_errors))); //Show last X line of error log?></textarea>
            </td>
         </tr>
      </tbody>
   </table>
</div>
