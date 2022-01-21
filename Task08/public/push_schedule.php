<?php
    require_once 'repo.php'; 
    $pdo = new PDO('sqlite:../data/car_washing.db');
    $repo = new Repo('../data/car_washing.db');

    $query1 = "";  $query2 = "";  $query3 = "";  $query4 = "";  $query5 = "";  $query6 = "";   $query7 = "";
    $main_query = "";
    if($_POST['date1'] != '0') {
       if($repo->checkSchedule('Пн', $_POST['id'])) $query1 = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $_POST['date1'] . "," . $_POST['id'] . ", 'Пн');";
    }
    $main_query = $main_query . $query1;
    if($_POST['date2'] != '0') {
        if($repo->checkSchedule('Вт', $_POST['id'])) $query2 = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $_POST['date2'] . "," . $_POST['id'] . ", 'Вт');";
    }
    $main_query = $main_query . $query2;
    if($_POST['date3'] != '0') {
        if($repo->checkSchedule('Ср', $_POST['id'])) $query3 = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $_POST['date3'] . "," . $_POST['id'] . ",'Ср');";
    }
    $main_query = $main_query . $query3;
    if($_POST['date4'] != '0') {
        if($repo->checkSchedule('Чт', $_POST['id'])) $query4 = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $_POST['date4'] . "," . $_POST['id'] . " ,'Чт');";
    }
    $main_query = $main_query . $query4;
    if($_POST['date5'] != '0') {
        if($repo->checkSchedule('Пт', $_POST['id'])) $query5 = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $_POST['date5'] . "," . $_POST['id'] . " ,'Пт');";
    }
    $main_query = $main_query . $query5;
    if($_POST['date6'] != '0') {
        if($repo->checkSchedule('Сб', $_POST['id'])) $query6 = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $_POST['date6'] . "," . $_POST['id'] . " ,'Сб');";
    }
    $main_query = $main_query . $query6;
    if($_POST['date7'] != '0') {
        if($repo->checkSchedule('Вс', $_POST['id'])) $query7 = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $_POST['date7'] . "," . $_POST['id'] . ", 'Вс');";
    }
    $main_query = $main_query . $query7;
    if($main_query != "") $statement = $pdo->query($main_query);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<form method="post" enctype="application/x-www-form-urlencoded" action="schedule.php">
    <p>
        <button>Вернуться к вводу информации о графике работы</button>
    </p>
</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
    <p>
        <button>Вернуться к выбору формы для ввода</button>
    </p>
</form>
</body>
</html>