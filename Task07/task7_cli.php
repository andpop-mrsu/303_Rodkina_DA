<?php
$pdo = new PDO('sqlite:car_washing.db');

$queryStart = "
SELECT m.id, m.last_name, m.first_name, m.middle_name from masters m
";

$statement = $pdo->query($queryStart);
$rows = $statement->fetchAll();

echo "Список оказанных услуг:\n";
echo "-------------------------------------\n";
echo "id | ФИО \n";
foreach ($rows as $row) {
    echo $row['id'] . ' ' . $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['middle_name'] . "\n";
}
$workers = $rows;
$statement->closeCursor();

echo "-------------------------------------\n";

$number = readline("Введите номер сотрудника: ");

if ($number == "") {
    $query = "
    SELECT m.id, m.last_name, m.first_name, m.middle_name, cs.date as date_start, sacc.duration , s.title, cc.title as class ,sacc.price 
    FROM masters m JOIN completed_services cs on m.id = cs.master_id JOIN services s on cs.service_id = s.id 
    JOIN services_and_class_car sacc on (sacc.class_car_id = cs.class_car_id AND sacc.service_id = cs.service_id ) join class_car cc on cc.id = cs.class_car_id
    ORDER by m.last_name, m.first_name, m.middle_name, cs.date";
    $statement = $pdo->query($query);
    $rows = $statement->fetchAll();

    echo "id | ФИО | Дата начала | Длительность | Название | Класс автомобиля | Стоимость\n";
    foreach ($rows as $row) {
        echo $row['id'] . ' ' . $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['date_start'] . ' ' . $row['duration'] . ' ' . $row['title'] . ' ' . $row['class'] . ' ' . $row['price'] . "\n";
    }
    exit(0);
}

$checkNumber = 0;
foreach ($workers as $row) {
    if ($row['id'] == $number) {
        $checkNumber = 1;
    }
}
if ($checkNumber == 0) echo "Введен некорректный номер сотрудника\n";
else {
    $query = "
    SELECT m.id, m.last_name, m.first_name, m.middle_name, cs.date as date_start, sacc.duration , s.title, cc.title as class ,sacc.price 
    FROM masters m JOIN completed_services cs on m.id = cs.master_id JOIN services s on cs.service_id = s.id 
    JOIN services_and_class_car sacc on (sacc.class_car_id = cs.class_car_id AND sacc.service_id = cs.service_id ) join class_car cc on cc.id = cs.class_car_id WHERE m.id = $number
    ORDER by m.last_name, m.first_name, m.middle_name, cs.date
    ";
    $statement = $pdo->query($query);
    $rows = $statement->fetchAll();

    if (count($rows) != 0) {
        echo "id | ФИО | Дата начала | Длительность | Название | Класс автомобиля | Стоимость\n";
        foreach ($rows as $row) {
            echo $row['id'] . ' ' . $row['last_name'] . ' ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['date_start'] . ' ' . $row['duration'] . ' ' . $row['title'] . ' ' . $row['class'] . ' ' . $row['price'] . "\n";
        }
    } else {
        echo 'У сотрудника с номером ' . $number . ' нет выполненных заявок.' . "\n";
    }
}
?>