<?php
    $pdo = new PDO('sqlite:../data/car_washing.db');

    $query = "insert INTO service_reservation(service_id, class_car_id, master_id, box_number, datetime) values 
    ('" . $_POST['service_id']."' ,'". $_POST['class_car_id']."' ,'". $_POST['master_id']."' ,'".$_POST['box_number'] ."' ,'". $_POST['datetime'] . "');";
    $statement = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<body>
<form method="post" enctype="application/x-www-form-urlencoded" action="booking.php">
    <p>
        <button>Вернуться к предварительной записи</button>
    </p>
</form>

<form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
    <p>
        <button>Вернуться к выбору формы для ввода</button>
    </p>
</form>
</body>
</html>