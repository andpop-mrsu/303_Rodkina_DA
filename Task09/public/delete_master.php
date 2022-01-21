<?php
require_once 'repo.php';
$repo = new Repo('../data/car_washing.db');
$master_id = $_GET['master_id'];
$master = $repo->getMasterByID($master_id);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Удалить сотрудника из базы?</title>
</head>

<body>
    <H3>Вы действительно хотите удалить сотрудника из базы?</H3>
    <?= $master['first_name'] . " " . $master['last_name'] . " " . $master['middle_name'] ?>

    <h1></h1>
    <form action="index.php" method="POST">
        <button type="submit">Нет. Вернуться к списку сотрудников</button>
    </form>

    <form action="delete_master_2.php" method="POST">
        <p><input type="hidden" name="id" value=<?= $master_id ?> /></p>

        <button type="submit">Да. Продолжить</button>

</body>