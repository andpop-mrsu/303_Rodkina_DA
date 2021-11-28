INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Daria", "Rodkina", "dasha.rodkina@bk.ru", "female", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Alina", "Ruzaeva", "alinaruzaeva@gmail.com", "female", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Danila", "Svetilnikov", "danila.svetilnikov@mail.ru", "male", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Sasha", "Taynov", "alexandr.taynov@mail.ru", "male", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));
INSERT INTO users(name, surname, email, gender, register_date, occupation_id) VALUES
("Nikita", "Utkin", "nikita.utkin@mail.ru", "male", DATE("now"), (SELECT id FROM occupations WHERE occupations.title = "student"));


INSERT INTO movies(title, year) VALUES
("Going Vertical", 2021);
INSERT INTO movies(title, year) VALUES
("Kholop", 2021);
INSERT INTO movies(title, year) VALUES
("Gentlemen", 2021);


INSERT INTO ratings(user_id, movie_id, rating, "timestamp") VALUES(
(SELECT id FROM users WHERE users.email = "dasha.rodkina@bk.ru"), 
(SELECT id FROM movies WHERE movies.title = "Going Vertical" and movies.year = 2021),
4.4, strftime('%s','now'));
INSERT INTO ratings(user_id, movie_id, rating, "timestamp") VALUES(
(SELECT id FROM users WHERE users.email = "dasha.rodkina@bk.ru"), 
(SELECT id FROM movies WHERE movies.title = "Kholop" and movies.year = 2021),
4, strftime('%s','now'));
INSERT INTO ratings(user_id, movie_id, rating, "timestamp") VALUES(
(SELECT id FROM users WHERE users.email = "dasha.rodkina@bk.ru"), 
(SELECT id FROM movies WHERE movies.title = "Gentlemen" and movies.year = 2021),
4, strftime('%s','now'));