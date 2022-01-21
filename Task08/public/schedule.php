
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
?>

<form method="post" enctype="application/x-www-form-urlencoded" action="push_schedule.php">
    <label>
        <h2> Выбрать работника</h2>
        <select style="width: 200px;" name="id">
            <?php foreach ($repo->getMasters() as $master): ?>
                <option value=<?= $master['id'] ?>>
                    <?= $master['id'] . ". " . $master['last_name'] . " " . $master['middle_name'] . " " . $master['first_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <h4></h4>
    <fieldset>
        <legend> График работы мастера </legend>
       
            <p><label>Понедельник: 
                <select name="date1">
                    <option value=0>Выходной</option>
                <?php foreach ($repo->getDaySchedules() as $sch): ?>
                <option value=<?= $sch['id'] ?>>
                    <?= $sch['start_time'] . " - " . $sch['end_time'] ?>
                </option>
            <?php endforeach; ?>
                </select></label></p>

                <p><label>Вторник: 
                <select name="date2">
                <option value=0>Выходной</option>
                <?php foreach ($repo->getDaySchedules() as $sch): ?>
                <option value=<?= $sch['id'] ?>>
                    <?= $sch['start_time'] . " - " . $sch['end_time'] ?>
                </option>
            <?php endforeach; ?>
                </select></label></p>

                <p><label>Среда: 
                <select name="date3">
                <option value=0>Выходной</option>
                <?php foreach ($repo->getDaySchedules() as $sch): ?>
                <option value=<?= $sch['id'] ?>>
                    <?= $sch['start_time'] . " - " . $sch['end_time'] ?>
                </option>
            <?php endforeach; ?>
                </select></label></p>

                <p><label>Четверг: 
                <select name="date4">
                <option value=0>Выходной</option>
                <?php foreach ($repo->getDaySchedules() as $sch): ?>
                <option value=<?= $sch['id'] ?>>
                    <?= $sch['start_time'] . " - " . $sch['end_time'] ?>
                </option>
            <?php endforeach; ?>
                </select></label></p>

                <p><label>Пятница: 
                <select name="date5">
                <option value=0>Выходной</option>
                <?php foreach ($repo->getDaySchedules() as $sch): ?>
                <option value=<?= $sch['id'] ?>>
                    <?= $sch['start_time'] . " - " . $sch['end_time'] ?>
                </option>
            <?php endforeach; ?>
                </select></label></p>

                <p><label>Суббота: 
                <select name="date6">
                <option value=0>Выходной</option>
                <?php foreach ($repo->getDaySchedules() as $sch): ?>
                <option value=<?= $sch['id'] ?>>
                    <?= $sch['start_time'] . " - " . $sch['end_time'] ?>
                </option>
            <?php endforeach; ?>
                </select></label></p>

                <p><label>Воскресенье: 
                <select name="date7">
                <option value=0>Выходной</option>
                <?php foreach ($repo->getDaySchedules() as $sch): ?>
                <option value=<?= $sch['id'] ?>>
                    <?= $sch['start_time'] . " - " . $sch['end_time'] ?>
                </option>
            <?php endforeach; ?>
                </select></label></p>
                
    </fieldset>

    <p>
        <button>Отправить данные</button>
    </p>

</form>
</body>
</html>