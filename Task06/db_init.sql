DROP TABLE IF exists services;
DROP TABLE IF exists class_car;
DROP TABLE IF exists services_and_class_car;
DROP TABLE IF exists masters;
DROP TABLE IF exists boxes;
DROP TABLE IF exists service_reservation;
DROP TABLE IF exists completed_services;
DROP TABLE IF exists day_schedule;
DROP TABLE IF exists master_schedule;

pragma foreign_keys = on;

CREATE TABLE services (
    id integer primary key autoincrement ,
    title text not null
);

INSERT INTO services (title) values
('Уборка салона'),
('Очистка дисков колес'),
('Ополаскивание'),
('Полировка кузова'),
('Химчистка салона'),
('Мойка двигателя'),
('Чистка стекол');

CREATE TABLE  class_car(
    id integer primary key autoincrement,
    title text not null
);

INSERT INTO class_car(title) values
('A-class'),
('B-class'),
('C-class'),
('D-class'),
('E-class'),
('F-class'),
('M-class');


CREATE TABLE  services_and_class_car(
    service_id integer not null,
    class_car_id integer not null,
    price real check(price > 0),
    duration integer check( duration > 0),
    foreign key (service_id) references services(id) on delete cascade,
    foreign key (class_car_id) references class_car(id) on delete cascade
);

INSERT INTO services_and_class_car ( service_id, class_car_id, duration, price) values
(1, 1, 20, 100.00),
(2, 1, 25, 120.00),
(3, 1, 10, 110.00),
(4, 1, 20, 150.00),
(5, 1, 30, 180.00),
(6, 1, 60, 140.00),

(1, 2, 20, 110.00),
(2, 2, 25, 130.00),
(3, 2,  10, 120.00),
(4, 2, 20, 160.00),
(5, 2, 30, 190.00),
(6, 2, 60, 150.00),

(1, 2, 20, 100.00),
(2, 3, 20, 120.00),
(3, 3, 10, 110.00),
(4, 3, 20, 150.00),
(5, 3, 30, 180.00),
(6, 3, 60, 140.00),

(1, 4, 40, 140.00),
(2, 4, 45, 160.00),
(3, 4, 30, 170.00),
(4, 4, 40, 210.00),
(5, 4, 50, 240.00),
(6, 4, 80, 200.00),

(1, 5, 40, 140.00),
(2, 5, 45, 160.00),
(3, 5, 30, 170.00),
(4, 5, 40, 210.00),
(5, 5, 50, 240.00),
(6, 5, 80, 200.00);


CREATE TABLE masters(
    id integer primary key autoincrement,
    first_name varchar(32)  not null,
    middle_name varchar(40),
    last_name varchar(40) not null,
    gender text check (gender = 'жен' or gender = 'муж'),
    birthdate date not null,
    salary_coef real default 1. check(salary_coef > 0.0 and salary_coef < 3.0),
    hiring_date date not null,
    firing_date date check(firing_date < hiring_date)
);

INSERT INTO masters (first_name, middle_name, last_name, gender, birthdate, salary_coef, hiring_date, firing_date)
values
('Степан', 'Васильевич', 'Иванов', 'муж', '1979-12-10', 1.5, '2021-11-23', null),
('Евгений', 'Дмитриевич', 'Комаров', 'муж', '1992-11-1', 2.5, '2021-11-23', null),
('Лев', 'Тимофеевич', 'Ефимов', 'муж', '2081-05-23', 2.0, '2021-11-23', null),
('Егор', 'Дмитриевич', 'Яковлев', 'муж', '2000-03-18', 1.25, '2021-11-23', null),
('Марк', 'Алексеевич', 'Семенов', 'муж', '1975-07-07', 1.9, '2021-11-23', null);


CREATE TABLE boxes(
    number integer primary key check (number > 0)
);

INSERT INTO boxes(number)
values
(1),
(2),
(3),
(4);

CREATE TABLE service_reservation(
    service_id integer not null,
    class_car_id integer not null,
    master_id integer not null,
    box_number integer not null,
    date date not null,
    time time not null,
    foreign key (service_id) references services(id),
    foreign key (class_car_id) references class_car(id),
    foreign key (master_id) references masters(id),
    foreign key (box_number) references boxes(number)
);

INSERT INTO service_reservation(service_id, class_car_id, master_id, box_number, date, time)
values
(1, 1, 1, 1, '2021-12-02', '11:00'),
(2, 1, 2, 2, '2021-12-02', '10:00'),
(1, 3, 3, 3, '2021-12-01', '15:00');


CREATE TABLE completed_services
(
    service_id integer,
    master_id integer,
    date datetime ,
    foreign key (service_id) references services(id),
    foreign key (master_id) references masters(id)
);

INSERT INTO completed_services (service_id, master_id, date)
values
(1, 1, '2021-11-17'),
(1, 2, '2021-11-14'),
(1, 3, '2021-11-15'),
(1, 4, '2021-11-19');


CREATE TABLE day_schedule
(
    id integer primary key autoincrement,
    start_time time default '08:00' check(start_time >= '08:00' and start_time <= '14:00'),
    end_time time default '16:00' check(end_time >= '16:00' and end_time <= '22:00')
);

INSERT INTO day_schedule (start_time, end_time)
values
('08:00', '16:00'),
('09:00', '17:00'),
('10:00', '18:00'),
('11:00', '19:00'),
('12:00', '20:00'),
('13:00', '21:00'),
('14:00', '22:00');

CREATE TABLE  master_schedule
(
    day_schedule_id integer,
    master_id integer,
    day_of_week varchar(2),
    foreign key (day_schedule_id) references day_schedule(id),
    foreign key (master_id) references masters(id),
    check (day_of_week = 'Понедельник'
         or day_of_week = 'Вторник'
         or day_of_week = 'Среда'
         or day_of_week = 'Четверг' 
         or day_of_week = 'Пятница' 
         or day_of_week = 'Суббота' 
         or day_of_week = 'Воскресение')
);


INSERT INTO master_schedule (day_schedule_id, master_id, day_of_week)
values
(1, 1, 'Понедельник'),
(2, 1, 'Вторник'),
(1, 1, 'Среда'),
(1, 1, 'Четверг'),
(1, 1, 'Пятница'),
(1, 1, 'Суббота'),
(1, 1, 'Воскресение'),
(1, 2, 'Понедельник'),
(1, 2, 'Вторник'),
(1, 2, 'Среда'),
(1, 2, 'Четверг'),
(1, 2, 'Пятница'),
(1, 2, 'Суббота'),
(1, 2, 'Воскресение'),
(2, 3, 'Понедельник'),
(2, 3, 'Вторник'),
(2, 3, 'Среда'),
(2, 3, 'Четверг'),
(3, 3, 'Пятница'),
(3, 4, 'Понедельник'),
(3, 4, 'Вторник'),
(3, 4, 'Среда'),
(3, 4, 'Четверг'),
(3, 4, 'Пятница'),
(2, 4, 'Суббота'),
(1, 4, 'Воскресение');
