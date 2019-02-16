<?php
/**
 * Displays Login Attempt Data
 */

define('SECURE_PAGE', true);
require '../config.php';

use PerfectApp\Database\MysqlQuery;

$loginAttempts = new MysqlQuery($pdo);

include '../includes/header.php';
?>
    <div class="row">
        <h3>Login Attempts</h3>
    </div>
    <div class="row">
        <table id="table_id" class="table table-bordered table-striped table-hover table-condensed">
            <thead>
            <tr>
                <th>Username</th>
                <th>IP</th>
                <th>Login Status</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody class="searchable">
            <?php
            $sql = 'SELECT login_username, INET_NTOA( login_ip ) AS login_ip_inet_ntoa, login_status, login_datetime FROM user_login ORDER BY login_datetime DESC';
            foreach ($loginAttempts->pdoQuery($sql) as $row)
            {
                if ($row['login_status'] == 0)
                {
                    $status = 'danger';
                    $message = 'Failed';
                }

                if ($row['login_status'] == 1)
                {
                    $status = 'success';
                    $message = 'Success';
                }
                ?>
                <tr>
                    <td><?= $row['login_username'] ?></td>
                    <td><?= $row['login_ip_inet_ntoa'] ?></td>
                    <td><span class='label label-<?= $status ?>'><?= $message ?></span></td>
                    <td><?= $row['login_datetime'] ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div><!-- /.row -->
<?php
include '../includes/footer.php';
