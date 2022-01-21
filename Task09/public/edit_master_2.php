<?php
$pdo = new PDO('sqlite:../data/car_washing.db');

$query = "UPDATE masters set first_name = '" . $_POST['lastname']
    . "', last_name = '" . $_POST['firstname'] . "', middle_name = '" . $_POST['middlename']
    . "', gender = '" . $_POST['gender'] . "', birthdate = '" . $_POST['birthdate']
    . "', salary_coef = '" . $_POST['salary_coef'] / 100 . "', hiring_date = '"
    . $_POST['hiring_date'] . "'  WHERE id = " . $_POST['master_id'] . ";";
$statement = $pdo->query($query);
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>

<body>
    <form method="post" enctype="application/x-www-form-urlencoded" action="../index.php">
        <p>
            <button>Вернуться к списку сотрудников</button>
        </p>
    </form>
</body>

</html>