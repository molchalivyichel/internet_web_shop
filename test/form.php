<!DOCTYPE html>
<html>
<head>
<title>METANIT.COM</title>
<meta charset="utf-8" />
</head>
<body>
<h3>Форма ввода данных</h3>
<form action="user.php" method="POST">
    <p>Имя: <input type="text" name="name" /></p>
    <p>Возраст: <input type="number" name="age" /></p>
    <input type="checkbox" name="remember" checked="checked" value="1"/>
    <input type="radio" name="course" value="ASP.NET" />ASP.NET <br>
    <input type="radio" name="course" value="PHP" />PHP <br>
    <input type="radio" name="course" value="Node.js" />Node.js <br>
    <select name="penis" size="1">
        <option value="ASP.NET">ASP.NET</option>
        <option value="PHP">PHP</option>
        <option value="Ruby">RUBY</option>
        <option value="Python">Python</option>
    </select>
    <input type="submit" value="Отправить">
</form>
</body>
</html>