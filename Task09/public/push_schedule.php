<?php
require_once 'repo.php';
$repo = new Repo('../data/car_washing.db');

if ($_POST['date1'] != '0') {
    $repo->deleteSchedule($_POST['id'], 'Пн');
    $repo->insertSchedule($_POST['id'], "Пн", $_POST['date1']);
} else {
    $repo->deleteSchedule($_POST['id'], "Пн");
}

if ($_POST['date2'] != '0') {
    $repo->deleteSchedule($_POST['id'], 'Вт');
    $repo->insertSchedule($_POST['id'], "Вт", $_POST['date2']);
} else {
    $repo->deleteSchedule($_POST['id'], "Вт");
}

if ($_POST['date3'] != '0') {
    $repo->deleteSchedule($_POST['id'], 'Ср');
    $repo->insertSchedule($_POST['id'], "Ср", $_POST['date3']);
} else {
    $repo->deleteSchedule($_POST['id'], "Ср");
}

if ($_POST['date4'] != '0') {
    $repo->deleteSchedule($_POST['id'], 'Чт');
    $repo->insertSchedule($_POST['id'], "Чт", $_POST['date4']);
} else {
    $repo->deleteSchedule($_POST['id'], "Чт");
}

if ($_POST['date5'] != '0') {
    $repo->deleteSchedule($_POST['id'], 'Пт');
    $repo->insertSchedule($_POST['id'], "Пт", $_POST['date5']);
} else {
    $repo->deleteSchedule($_POST['id'], "Пт");
}

if ($_POST['date6'] != '0') {
    $repo->deleteSchedule($_POST['id'], 'Сб');
    $repo->insertSchedule($_POST['id'], "Сб", $_POST['date6']);
} else {
    $repo->deleteSchedule($_POST['id'], "Сб");
}

if ($_POST['date7'] != '0') {
    $repo->deleteSchedule($_POST['id'], 'Вс');
    $repo->insertSchedule($_POST['id'], "Вс", $_POST['date7']);
} else {
    $repo->deleteSchedule($_POST['id'], "Вс");
}

?>

<!DOCTYPE html>
<html lang="en">

<body>
    <form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
        <p>
            <button>Вернуться к списку сотрудников</button>
        </p>
    </form>
</body>

</html>