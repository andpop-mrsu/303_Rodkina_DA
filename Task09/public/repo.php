<?php

declare(strict_types=1);
class Repo
{

    private PDO $pdo;

    public function __construct(String $path)
    {
        $this->pdo = new PDO('sqlite:' . $path);
    }

    public function getMasters()
    {
        $query = "select * from masters order by first_name;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getMasterByID(String $id)
    {
        $query = "select * from masters where id = " . $id . ";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        if (count($rows) == 0) return;
        return $rows[0];
    }

    public function getDaySchedules()
    {
        $query = "select * from day_schedule;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    // public function dleSchedule(String $day, int $id)
    // {
    //     $t = "select * from master_schedule where master_id = '" . $id . "' and day_of_week = '" . $day . "'";
    //     $statement = $this->pdo->query($t);
    //     $rows = $statement->fetchAll();
    //     $statement->closeCursor();
    //     return count($rows) == 0;
    // }

    public function getServices()
    {
        $query = "select * from services;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getServiceById(int $id)
    {
        $query = "select * from services where id='" . $id . "';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows[0];
    }

    public function getCarClasses()
    {
        $query = "select * from class_car;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getCarClassById(int $id)
    {
        $query = "select * from class_car where id='" . $id . "';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows[0];
    }

    public function getBoxes()
    {
        $query = "select * from boxes;";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }
    public function getReservationServicesByBox(int $box_id)
    {
        $query = "select * from service_reservation sr where sr.box_number = '" . $box_id . "';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    public function getReservationServicesByMaster(int $master_id)
    {
        $query = "select * from service_reservation sr where sr.master_id = '" . $master_id . "';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }
    public function getServiceDuration(int $service_id, int $car_class_id)
    {
        $query = "select duration from services_and_class_car where service_id='" . $service_id . "' and class_car_id='" . $car_class_id . "';";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows[0][0];
    }

    public function getScheduleForMaster(int $master_id, String $day)
    {
        $query = "select (ds.start_time) ,ds.end_time from day_schedule ds inner JOIN master_schedule ms on ms.day_schedule_id = ds.id  where ds.id = ms.day_schedule_id and day_of_week = '" . $day . "' and master_id ='" . $master_id . "';";
        // print($query);
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        if (count($rows) == 0) return;
        return $rows[0];
    }

    function deleteSchedule(int $master_id, String $day)
    {
        $query = "DELETE from master_schedule WHERE master_id = " . $master_id . " and day_of_week = '" . $day . "';";
        $statement = $this->pdo->query($query);
        $statement->closeCursor();
    }
    public function insertSchedule(int $master_id, String $day, int $sch_id)
    {
        $query = "insert into master_schedule (day_schedule_id, master_id, day_of_week) values (" . $sch_id . "," . $master_id . ", '" . $day . "');";
        $statement = $this->pdo->query($query);
        $statement->closeCursor();
    }
    public function deleteMaster(int $id)
    {
        $query = "DELETE from masters WHERE id = " . $id . ";";
        $statement = $this->pdo->query($query);
        $statement->closeCursor();
    }
    public function deleteMasterSchedule(int $id)
    {
        $query = "DELETE from master_schedule WHERE master_id = " . $id . ";";
        $statement = $this->pdo->query($query);
        $statement->closeCursor();
    }
    public function deleteComplitedServices(int $id)
    {
        $query = "DELETE from completed_services WHERE master_id = " . $id . ";";
        $statement = $this->pdo->query($query);
        $statement->closeCursor();
    }
    public function deleteServiceReservations(int $id)
    {
        $query = "DELETE from service_reservation WHERE master_id = " . $id . ";";
        $statement = $this->pdo->query($query);
        $statement->closeCursor();
    }
    public function getCompletedServices(int $master_id)
    {
        $query = "SELECT (SELECT title from services s WHERE s.id = cs.service_id) as service, (SELECT title from class_car cc WHERE cc.id = cs.class_car_id) as class_car, (SELECT price from services_and_class_car sacc WHERE sacc.service_id=cs.service_id and sacc.class_car_id=cs.class_car_id) as price, date from completed_services cs WHERE master_id = " . $master_id . ";";
        $statement = $this->pdo->query($query);
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }
}
