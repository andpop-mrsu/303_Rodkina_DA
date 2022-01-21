<?php
require_once 'repo.php';
$repo = new Repo('../data/car_washing.db');
$master_id = $_GET["master_id"];
$master = $repo->getMasterByID($master_id);

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Редактирование</title>
</head>

<body>


    <form method="post" action="edit_master_2.php" enctype="application/x-www-form-urlencoded">
        <H1>Редактирование информации о мастера</H1>
        <fieldset>
            <legend> Личная информация о мастере</legend>
            <p><label>Фамилия: <input name="lastname" value=<?= $master['first_name'] ?>> </label></p>
            <p><label>Имя: <input name="firstname" value=<?= $master['last_name'] ?>></label></p>
            <p><label>Отчество: <input name="middlename" value=<?= $master['middle_name'] ?>></label></p>
            <p><label>Дата рождения: <input type="date" name="birthdate" value=<?= $master['birthdate'] ?>></label></p>
            <p><label>Пол: <select name="gender">
                        <option <?php if ($master['gender'] == "муж") echo 'selected'; ?> value="муж">Мужской</option>
                        <option <?php if ($master['gender'] == "жен") echo 'selected'; ?> value="жен">Женский</option>
                    </select></label></p>
        </fieldset>

        <br>

        <fieldset>
            <legend>Рабочая информация </legend>
            <p><label>Коэффициент ЗП: <input type="number" min="1" max="299" name="salary_coef" value=<?= $master['salary_coef'] * 100 ?>></label></p>
            <p><label>Дата вступления в должность: <input type="date" name="hiring_date" value=<?= $master['hiring_date'] ?>></label></p>
        </fieldset>
        <p><input type="hidden" name="master_id" value=<?= $master_id ?> /></p>
        <p><button>Сохранить данные</button></p>
    </form>
</body>

</html>