<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Автомобильная мойка</title>
</head>
<body>

<?php
$pdo = new PDO('sqlite:car_washing.db');

$queryStart = "
SELECT m.id, m.last_name, m.first_name, m.middle_name from masters m
";
$statement = $pdo->query($queryStart);
$rows = $statement->fetchAll();
$workers = $rows;
$statement->closeCursor();
?>

<h1>Сотрудники</h1>
<form action="" method="POST">
    <label>
        <select style="width: 200px;" name="id">
            <option value=<?= null ?>>
                Все
            </option>
            <?php foreach ($workers as $row) { ?>
                <option value= <?= $row['id'] ?>>
                    <?= $row['id'] ?>
                </option>
            <?php } ?>
        
        </select>
    </label>
    <button type="submit">Выбрать</button>
</form>

<?php
$id = 0;
if(isset($_POST['id'])){
    $id = (int)$_POST['id'];
}


if ($id == 0) {
    $query = "
    SELECT m.id, m.last_name, m.first_name, m.middle_name, cs.date as date_start, sacc.duration , s.title, cc.title as class ,sacc.price 
    FROM masters m JOIN completed_services cs on m.id = cs.master_id JOIN services s on cs.service_id = s.id 
    JOIN services_and_class_car sacc on (sacc.class_car_id = cs.class_car_id AND sacc.service_id = cs.service_id ) join class_car cc on cc.id = cs.class_car_id
    ORDER by m.last_name, m.first_name, m.middle_name, cs.date";
} else {
    $query = "
    SELECT m.id, m.last_name, m.first_name, m.middle_name, cs.date as date_start, sacc.duration , s.title, cc.title as class ,sacc.price 
    FROM masters m JOIN completed_services cs on m.id = cs.master_id JOIN services s on cs.service_id = s.id 
    JOIN services_and_class_car sacc on (sacc.class_car_id = cs.class_car_id AND sacc.service_id = cs.service_id ) join class_car cc on cc.id = cs.class_car_id WHERE m.id = {$id}
    ORDER by m.last_name, m.first_name, m.middle_name, cs.date";
}
$statement = $pdo->query($query);
$services = $statement->fetchAll();
?>
<H1></H1>
<table class="workers-table" cellpadding="7" cellspacing="0" border="1" width="100%">
    <tr class="table-header">
        <th>Id</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата начала услуги</th>
        <th>Длительность</th>
        <th>Название услуги</th>
        <th>Класс автомобиля</th>
        <th>Цена</th>
    </tr>
    <?php foreach ($services as $service): ?>
        <tr>
            <td><?= $service['id'] ?></td>
            <td><?= $service['last_name'] ?></td>
            <td><?= $service['first_name'] ?></td>
            <td><?= $service['middle_name'] ?></td>
            <td><?= $service['date_start'] ?></td>
            <td><?= $service['duration']. " мин." ?></td>
            <td><?= $service['title'] ?></td>
            <td><?= $service['class'] ?></td>
            <td><?= $service['price'] . " руб." ?></td>
        </tr>
    <?php endforeach; ?>

</table>
</body>
</html>