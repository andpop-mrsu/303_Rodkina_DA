import csv

with open('db_init.sql', 'w') as file:
    for table in ['movies', 'ratings', 'tags', 'users']:
        file.write(f'drop table if exists {table};\n')
    file.write('create table movies(\n'
               '\tid integer primary key,\n'
               '\ttitle text,\n'
               '\tyear integer,\n'
               '\tgenres text\n'
               ');\n')
    file.write('create table ratings(\n'
               '\tid integer primary key,\n'
               '\tuser_id integer,\n'
               '\tmovie_id integer,\n'
               '\trating real,\n'
               '\ttimestamp integer\n'
               ');\n')
    file.write('create table tags(\n'
               '\tid integer primary key,\n'
               '\tuser_id integer,\n'
               '\tmovie_id integer,\n'
               '\ttag text,\n'
               '\ttimestamp integer\n'
               ');\n')
    file.write('create table users(\n'
               '\tid integer primary key,\n'
               '\tname text,\n'
               '\temail text,\n'
               '\tgender text,\n'
               '\tregister_date text,\n'
               '\toccupation text\n'
               ');\n')

    file.write('\ninsert into movies(id, title,year,genres) values\n')
    with open('movies.csv', 'r') as movies_csv:
        movies_data = csv.DictReader(movies_csv)
        id = 1
        for line in movies_data:
            if id != 1:
                file.write(',\n')
            title = line['title']
            if (title[0] == '"'):
                title = title[1:-1]
            title = title.replace('"', '""')
            title = title.rstrip()
            year = title[-5:-1]
            try:
                year = int(year)
            except:
                year = 'null'
            else:
                title = title[:-7]
            genres = line['genres'].replace('"', '')
            file.write(f'({id}, "{title}", {year}, "{genres}")')
            id += 1
        file.write(';\n')

    file.write('insert into ratings(id, user_id, movie_id, rating, timestamp) values\n')
    with open('ratings.csv', 'r') as ratings_csv:
        ratings_data = csv.DictReader(ratings_csv)
        id = 1
        for line in ratings_data:
            if id !=1:
                file.write(',\n')
            file.write(f'({id}, {line["userId"]}, {line["movieId"]}, {line["rating"]}, {line["timestamp"]})')
            id+=1
        file.write(';')

    file.write('\ninsert into tags(id, user_id, movie_id, tag, timestamp) values\n')
    with open('tags.csv', 'r') as tags_csv:
        id = 1
        for line in tags_csv:
            if id > 2:
                file.write(',\n')
            if id != 1:
                item = line.split(',')
                user_id = item[0]
                movie_id = item[1]
                tag = '"' + item[2].replace('"', '') + '"'
                timestamp = item[3].rstrip()
                file.write(f'({id}, {user_id}, {movie_id}, {tag}, {timestamp})')
            id += 1
        file.write(';')

    file.write('\ninsert into users(id, name, email, gender, register_date, occupation) values\n')
    with open('users.txt', 'r') as users_txt:
        id = 1
        for line in users_txt:
            user = line.split('|')
            id = int(user[0])
            name = '"' + user[1] + '"'
            email = '"' + user[2] + '"'
            gender = '"' + user[3] + '"'
            register_date = '"' + user[4] + '"'
            occupation = '"' + user[5].rstrip() + '"'
            if id != 1:
                file.write(',\n')
            file.write(f'({id}, {name}, {email}, {gender}, {register_date}, {occupation})')
            id+=1
        file.write(';')