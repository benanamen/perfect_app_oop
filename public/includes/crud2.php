<?php declare(strict_types=1);

use PerfectApp\Database\PdoCrud;

// Testing to update last logon time.

$db = new PdoCrud($pdo, 'users', 'user_id');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    $now = date("Y-m-d H:i:s");
    $data = [
    'last_login' => $now,
    'id' => 1
        ];

    $v = $db->update($data);

var_dump($v);

    //isset($_POST['data']['id']) ? $db->update($_POST['data']) : $db->insert($_POST['data']);
}


?>

<form method="post">
     <button type="submit">Submit</button>
</form>
