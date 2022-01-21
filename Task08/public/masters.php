
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавлениие мастера</title>
</head>
<body >


<form method="post" action="push_master.php" enctype="application/x-www-form-urlencoded">
    <H1>Добавление мастера</H1>
    <fieldset>
        <legend> Личная информация о мастере</legend>
        <p><label>Фамилия: <input name="lastname"></label></p>
        <p><label>Имя: <input name="firstname"></label></p>
        <p><label>Отчество: <input name="middlename"></label></p>
        <p><label>Дата рождения: <input type="date" name="birthdate"></label></p>
        <p><label>Пол: <select name="gender" > <option value="муж">Мужской</option> <option value="жен">Женский</option></select></label></p>
    </fieldset>

    <br>

    <fieldset>
        <legend>Рабочая информация </legend>
        <p><label>Коэффициент ЗП: <input type="number" min="1" max="299" name="salary_coef" value="100"></label></p>
        <p><label>Дата вступления в должность: <input type="date" name="hiring_date"></label></p>
    </fieldset>
    
    <p><button>Отправить данные</button></p>
</form>
</body>
</html>