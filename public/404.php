<?php
require_once 'flash_error.php'
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="js/entrance.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/404.css">
    <title>Магазин</title>
</head>
<body>

<?php
require_once 'header.php';
?>

<h1>Ошибка 404 - Страница не найдена.</h1>
<p class="error-p">К сожалению, такой страницы нет на нашем сайте. Возможно, вы ввели неправильный адрес или страница была удалена с сервера.</p>

<?php
require_once 'footer.php';
?>

</body>
</html>