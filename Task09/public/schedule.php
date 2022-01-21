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
    ?>

    <h2> <?= $master['id'] . ". " . $master['last_name'] . " " . $master['middle_name'] . " " . $master['first_name'] ?> </h2>

    <h4></h4>
    <fieldset>
        <legend> График работы мастера </legend>
        <?php $sch = $repo->getScheduleForMaster($master_id, "Пн"); ?>
        <p><label>Понедельник: <?php
                                if (!isset($sch['start_time']) || !isset($sch['end_time'])) {
                                    echo 'Выходной';
                                } else echo $sch['start_time'] . " - " . $sch['end_time'] ?> </label></p>
        <?php $sch = $repo->getScheduleForMaster($master_id, "Вт"); ?>
        <p><label>Вторник: <?php
                            if (!isset($sch['start_time']) || !isset($sch['end_time'])) {
                                echo 'Выходной';
                            } else echo $sch['start_time'] . " - " . $sch['end_time'] ?> </label></p>
        <?php $sch = $repo->getScheduleForMaster($master_id, "Ср"); ?>
        <p><label>Среда: <?php
                            if (!isset($sch['start_time']) || !isset($sch['end_time'])) {
                                echo 'Выходной';
                            } else echo $sch['start_time'] . " - " . $sch['end_time'] ?></label></p>
        <?php $sch = $repo->getScheduleForMaster($master_id, "Чт"); ?>
        <p><label>Четверг: <?php
                            if (!isset($sch['start_time']) || !isset($sch['end_time'])) {
                                echo 'Выходной';
                            } else echo $sch['start_time'] . " - " . $sch['end_time'] ?> </label></p>
        <?php $sch = $repo->getScheduleForMaster($master_id, "Пт"); ?>
        <p><label>Пятница: <?php
                            if (!isset($sch['start_time']) || !isset($sch['end_time'])) {
                                echo 'Выходной';
                            } else echo $sch['start_time'] . " - " . $sch['end_time'] ?> </label></p>
        <?php $sch = $repo->getScheduleForMaster($master_id, "Сб"); ?>
        <p><label>Суббота:
                <?php
                if (!isset($sch['start_time']) || !isset($sch['end_time'])) {
                    echo 'Выходной';
                } else echo $sch['start_time'] . " - " . $sch['end_time'] ?>
            </label></p>
        <?php $sch = $repo->getScheduleForMaster($master_id, "Вс"); ?>
        <p><label>Воскресенье: <?php
                                if (!isset($sch['start_time']) || !isset($sch['end_time'])) {
                                    echo 'Выходной';
                                } else echo $sch['start_time'] . " - " . $sch['end_time'] ?> </label></p>

    </fieldset>

    <form method="post" enctype="application/x-www-form-urlencoded" action="edit_schedule.php?master_id=<?= $master['id'] ?>">
        <p>
            <button>Редактировать график работы</button>
        </p>

    </form>
</body>

</html>