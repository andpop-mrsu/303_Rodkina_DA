<?php
$pdo = new PDO('sqlite:../data/car_washing.db');
$query = "insert into masters (first_name, middle_name, last_name, gender, birthdate, salary_coef, hiring_date, firing_date) values 
    ('" . $_POST['firstname'] . "' ,'" . $_POST['middlename'] . "' ,'" . $_POST['lastname'] . "' ,'" . $_POST['gender'] . "' ,'" . $_POST['birthdate'] . "' ,'" . $_POST['salary_coef'] / 100 . "' ,'" . $_POST['hiring_date'] . "' ,null);";
$statement = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <form method="post" enctype="application/x-www-form-urlencoded" action="masters.php">
        <p>
            <button>Добавить ещё сотрудника</button>
        </p>
    </form>

    <form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
        <p>
            <button>Вернуться к списку сотрудников</button>
        </p>
    </form>
</body>

</html>