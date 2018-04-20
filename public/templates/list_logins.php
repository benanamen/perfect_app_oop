<?php
if (!defined('SECURE_PAGE'))
{
    die('<h1>Direct File Access Prohibited</h1>');
}
?>

<div class="row">
    <h3>Login Attempts</h3>
</div>
<div class="row">
    <table id="myDataTable" class="table table-bordered table-striped table-hover table-condensed">
        <thead class="thead-dark">
        <tr>
            <th>Username</th>
            <th>IP</th>
            <th>Login Status</th>
            <th>Date</th>
        </tr>
        </thead>
        <tfoot class="thead-dark">
        <tr>
            <th>Username</th>
            <th>IP</th>
            <th>Login Status</th>
            <th>Date</th>
        </tr>
        </tfoot>
        <tbody class="searchable">
        <?php
        $sql = 'SELECT login_username, INET_NTOA( login_ip ) AS login_ip_inet_ntoa, login_status, login_datetime FROM user_login ORDER BY login_datetime DESC';
        $stmt = $loginAttempts->pdoQuery($sql);

        if (SHOW_DEBUG_PARAMS)
        {
            show_debug_params($stmt);
        }

        foreach ($stmt as $row)
        {
            $status = $row['login_status'] == 0 ? 'danger' : 'success';
            $message = $row['login_status'] == 0 ? 'Failed' : 'Success';
            ?>
            <tr>
                <td><?= $row['login_username'] ?></td>
                <td><?= $row['login_ip_inet_ntoa'] ?></td>
                <td><h6><span class='badge badge-<?= $status ?>'><?= $message ?></span></h6></td>
                <td><?= $row['login_datetime'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>