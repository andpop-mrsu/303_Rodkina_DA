<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Предварительная запись</title>
</head>
<body>
    <?php
        require_once 'repo.php';
        $repo = new Repo('../data/car_washing.db');
    ?>
    <form method="post" enctype="application/x-www-form-urlencoded" action=booking_2.php>
        <label>
        <fieldset>
            <legend>Предварительная запись</legend>
            <p><label> Выберите услугу
            <select style="width: 200px;" name="service_id">
                </option>
                <?php foreach ($repo->getServices() as $service): ?>
                    <option value=<?= $service['id']?>>
                        <?= $service['title'] ?>
                    </option>
                <?php endforeach; ?>
            </select></label></p>

            <p><label> Выберите класс автомобиля
            <select style="width: 100px;" name="class_car_id">
                </option>
                <?php foreach ($repo->getCarClasses() as $class): ?>
                    <option value=<?= $class['id']?>>
                        <?= $class['title'] ?>
                    </option>
                <?php endforeach; ?>
                </select></label></p>
                <p><label>Дата <input type="date" name ='reservation_date'></input></label></p>
                <p><label>Время <input type="time" name ='reservation_time'></input></label></p>
                <button type="submit">Далее</button>
        </fieldset>
        </label>
        
    </form>

    
   








</body>
</html>