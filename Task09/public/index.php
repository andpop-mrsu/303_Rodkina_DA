<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Автомобильная мойка</title>
</head>

<body>

    <?php
    require_once "repo.php";
    $repo = new Repo("../data/car_washing.db");

    $masters = $repo->getMasters();
    ?>

    <h3>Сотрудники</h3>

    <table class="masters-table" cellpadding="7" cellspacing="0" border="1" width="100%">
        <tr class="table-header">

            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Редактирование</th>
            <th>Удаление</th>
            <th>График</th>
            <th>Выполненные работы</th>

        </tr>
        <?php foreach ($masters as $master) : ?>
            <tr>

                <td><?= $master['first_name'] ?></td>
                <td><?= $master['last_name'] ?></td>
                <td><?= $master['middle_name'] ?></td>
                <td><a href="edit_master.php?master_id=<?= $master['id'] ?>">Редактировать</a></td>
                <td><a href="delete_master.php?master_id=<?= $master['id'] ?>">Удалить</a></td>
                <td><a href="schedule.php?master_id=<?= $master['id'] ?>">График</a></td>
                <td><a href="completed_services.php?master_id=<?= $master['id'] ?>">Выполненные работы</a></td>
            </tr>
        <?php endforeach; ?>

    </table>
    <H1></H1>

    <form action="masters.php" method="POST">
        <button type="submit">Добавить</button>
    </form>

    <?php
