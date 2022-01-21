<?php
require_once 'repo.php';
$repo = new Repo('../data/car_washing.db');
$master_id = $_POST['id'];
// $repo->getMasterByID($master_id);
$repo->deleteMaster($master_id);
$repo->deleteMasterSchedule($master_id);
$repo->deleteServiceReservations($master_id);
?>

<html>
<form action="index.php" method="POST">
        <title>Успешно!</title>
        <button type="submit">К списку сотрудников</button>

</html>