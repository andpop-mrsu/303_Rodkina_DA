<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>График работы</title>
</head>

<body>

    <?php
    require_once "repo.php";
    $repo = new Repo("../data/car_washing.db");

    $master_id = $_GET['master_id'];
    $master = $repo->getMasterById($master_id);
    $completed_services = $repo->getCompletedServices($master_id);

    ?>
    <h1></h1>
    <a> Услуги оказанные сотрудником: <?php echo ($master['last_name'] . " " . $master['middle_name'] . " " . $master['first_name']); ?></a>
    <h1></h1>
    <table class="services-table" cellpadding="7" cellspacing="0" border="1" width="100%">
        <tr class="table-header">

            <th>Название услуги</th>
            <th>Класс автомобиля</th>
            <th>Стоимость</th>
            <th>Дата оказания услуги</th>


        </tr>
        <?php foreach ($completed_services as $completed_service) : ?>
            <tr>

                <td><?= $completed_service['service'] ?></td>
                <td><?= $completed_service['class_car'] ?></td>
                <td><?= $completed_service['price'] ?></td>
                <td><?= $completed_service['date'] ?></td>

            </tr>
        <?php endforeach; ?>

    </table>

</body>

</html>