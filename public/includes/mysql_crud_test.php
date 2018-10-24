<?php declare(strict_types=1);

use PerfectApp\Database\MysqlCrud;

$db = new MysqlCrud($pdo, 'crud_test', 'user_id');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    isset($_POST['data']['id']) ? $db->update($_POST['data']) : $db->insert($_POST['data']);
}

if (isset($_GET['id']))
{
    $form_data = (array)$db->findById($_GET['id']);
}
?>

<form method="post">
    First <input title="First"
                 name="data[first_name]"
                 value="<?= !empty($form_data['first_name']) ? $form_data['first_name'] : ''; ?>"><br>

    Last <input title="Last"
                name="data[last_name]"
                value="<?= !empty($form_data['last_name']) ? $form_data['last_name'] : ''; ?>"><br>

    <?= !empty($_GET['id']) ? "<input type='hidden' name='data[id]' value='{$_GET['id']}'>" : ''; ?>
    <button type="submit">Submit</button>
</form>
