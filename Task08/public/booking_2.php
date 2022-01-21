<?php
    require_once 'repo.php';
    $repo = new Repo('../data/car_washing.db');
    
    if(isset($_POST['reservation_date']) && isset($_POST['reservation_time']) && isset($_POST['service_id']) && isset( $_POST['class_car_id'])){
        $boxes = $repo->getBoxes();
        $res_date = $_POST['reservation_date'];
        $res_time =$_POST['reservation_time'];
        $service_id = $_POST['service_id'];
        $class_car_id = $_POST['class_car_id'];
        $res_timestamp = strtotime($res_time);
    
        $res_duration = $repo->getServiceDuration($service_id, $class_car_id);
        
        $box_id = 0;
        $available_boxes = [];
        foreach($boxes as $box){
            $flag = 1;
            foreach($repo->getReservationServicesByBox($box[0]) as $res_service){
                $timestamp = strtotime($res_service['datetime']);
                $dur = $repo->getServiceDuration($res_service['service_id'], $res_service['class_car_id']);
                if($timestamp < $res_timestamp + $res_duration && $res_timestamp + $res_duration < $timestamp + $dur) $flag = 0;
                if($timestamp < $res_timestamp && $res_timestamp < $timestamp + $dur) $flag = 0;
            }
            if($flag == 1){
                $available_boxes[] = $box[0];
            }
        }
        $master_id = 0;
        $masters = $repo->getMasters();
        $day_of_week = date('w', $res_timestamp);
        $days = [ 'Вс', 'Пн', 'Вт', 'Ср','Чт', 'Пт', 'Сб'];
        $day_of_week = $days[$day_of_week];
        

        foreach($masters as $master) {
            

            $schedule = $repo->getScheduleForMaster($master['id'], $day_of_week);
            if($schedule == null) continue;
            $start = strtotime($schedule['start_time']);
            $end = strtotime($schedule['end_time']);
            if($res_timestamp < $start) {
                continue;
            }
            if($res_timestamp + $res_duration > $end) {
                continue;
            }
            
            $res_services = $repo->getReservationServicesByMaster($master['id']);

            if($res_services == null){
                $master_id = $master['id'];
                break;
            }

            foreach($res_services as $res_service){
                $timestamp = strtotime($res_service['datetime']);
                $dur = $repo->getServiceDuration($res_service['service_id'], $res_service['class_car_id']);
                if($timestamp < $res_timestamp + $res_duration && $res_timestamp + $res_duration < $timestamp + $dur) {
                    continue;
                }
                if($timestamp < $res_timestamp && $res_timestamp < $timestamp + $dur) {
                    continue;
                }
            }

            
            $master_id = $master['id'];
            break;
        
        }

    }

?>

<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <title>Предварительная запись</title>
 </head>
 <body>
   
 <form method="post" enctype="application/x-www-form-urlencoded" action='booking_3.php' >
        <label>
        <fieldset>
            <legend>Выбор бокса</legend>
            <p><label> Мастер: 
                <?php $master = $repo-> getMasterForID($master_id);
                    if($master == null) echo "Свободного мастера не нашлось";
                    else
                    echo $master['last_name'].' '.$master['middle_name'].' '. $master['first_name'];
            ?> </label></p>
            <p><label> Выберите доступный бокс
            <select style="width: 200px;" name="box_number">
                </option>
                
                <?php foreach ($available_boxes as $box): ?>
                    <option value=<?= $box?>>
                        <?= $box ?>
                    </option>
                <?php endforeach;?>


            </select></label></p>
                <button type="submit">Подтвердить</button>

        <p><input type="hidden" name="service_id" value= <?php echo $service_id ?> /></p>
        <p><input type="hidden" name="class_car_id" value= <?php echo $class_car_id ?> /></p>
        <p><input type="hidden" name="master_id" value= <?php echo $master_id ?> /></p>
        <p><input type="hidden" name="datetime" value= <?php echo gmdate("Y-m-d\TH:i:s", $res_timestamp);?> /></p>
        </fieldset>
        </label>
       
       
        
    </form>



 </body>
 </html> 