#!/bin/bash
chcp 65001

sqlite3 movies_rating.db < db_init.sql

echo 1. Найти все пары пользователей, оценивших один и тот же фильм. Устранить дубликаты, проверить отсутствие пар с самим собой. Для каждой пары должны быть указаны имена пользователей и название фильма, который они ценили.
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "select (u1.name || ' - ' || u2.name) as names, movies.title from ratings r1 join ratings r2 on r1.movie_id = r2.movie_id and r1.id > r2.id join users u1 on u1.id = r1.user_id join users u2 on u2.id = r2.user_id join movies on r1.movie_id = movies.id;"
echo " "

echo 2. Найти 10 самых старых оценок от разных пользователей, вывести названия фильмов, имена пользователей, оценку, дату отзыва в формате ГГГГ-ММ-ДД.
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "select movies.title, users.name, ratings.rating, date(ratings.timestamp, 'unixepoch') as date from users join ratings on ratings.user_id = users.id join movies on ratings.movie_id = movies.id group by users.name order by date limit 10;"
echo " "

echo 3. Вывести в одном списке все фильмы с максимальным средним рейтингом и все фильмы с минимальным средним рейтингом. Общий список отсортировать по году выпуска и названию фильма. В зависимости от рейтинга в колонке "Рекомендуем" для фильмов должно быть написано "Да" или "Нет".
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "select title, year, rating, case when max_rating = rating then 'Yes' else 'No' end as recomendation from (select *, max(rating) over () as max_rating, min(rating) over () as min_rating from (select movies.title, movies.year, rating from movies join (select ratings.movie_id, avg(ratings.rating) as rating from ratings group by ratings.movie_id) ratings on ratings.movie_id = movies.id)) as avg_ratings where rating = max_rating or rating = min_rating order by year, title;"
echo " "

echo 4. Вычислить количество оценок и среднюю оценку, которую дали фильмам пользователи-мужчины в период с 2011 по 2014 год.
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "select count(*) as count, avg(rating) as average from ratings join users on users.id = ratings.user_id where users.gender = 'male' and date(timestamp, 'unixepoch') >= '2011-01-01' and date(timestamp, 'unixepoch') <= '2013-12-31';"
echo " "

echo 5. Составить список фильмов с указанием средней оценки и количества пользователей, которые их оценили. Полученный список отсортировать по году выпуска и названиям фильмов. В списке оставить первые 20 записей.
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "select movies.title, movies.year, avg(ratings.rating) as average_rating, count(ratings.user_id) as count_ratings from movies join ratings on movies.id = ratings.movie_id group by movies.title order by movies.year, movies.title limit 20;"
echo " "

echo 6. Определить самый распространенный жанр фильма и количество фильмов в этом жанре. Отдельную таблицу для жанров не использовать, жанры нужно извлекать из таблицы movies.
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "select genre, max(number_of_movies) as number_of_movies from (with divided_genres(genre, combined_genres) as (select null, genres from movies union all select case when instr(combined_genres, '|') = 0 then combined_genres else substr(combined_genres, 1, instr(combined_genres, '|') - 1) end, case when instr(combined_genres, '|') = 0 then null else substr(combined_genres, instr(combined_genres, '|') + 1) end from divided_genres where combined_genres is not null) select genre, count(*) as number_of_movies from divided_genres where genre is not null group by genre);"
echo " "

echo 7. Вывести список из 10 последних зарегистрированных пользователей в формате "Фамилия Имя|Дата регистрации" (сначала фамилия, потом имя).
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "select substr(name, instr(name, ' ') + 1) || ' ' || substr(name, 1, instr(name, ' ')  - 1) as name, register_date from users order by register_date desc limit 10;"
echo " "

echo 8. С помощью рекурсивного CTE определить, на какие дни недели приходился ваш день рождения в каждом году.
echo --------------------------------------------------
sqlite3 movies_rating.db -box -echo "with recursive birthday(date, day) as (select '2001-05-23', strftime('%%w', '2001-05-23') union all select date(date, '+1 years'), strftime('%%w', date(date, '+1 years')) from birthday where date < '2021-05-23') select date, case day when '0' then 'sunday' when '1' then 'monday' when '2' then 'tuesday' when '3' then 'wednesday' when '4' then 'thursday' when '5' then 'friday' else 'saturday' end 'day_of_week' from birthday;"

