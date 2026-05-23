<?php
// Database Connection

// $dsn  = 'mysql:host=localhost;dbname=shop'; // Data Source Name
// $dsn  = 'mysql:host=localhost;port=3306;dbname=shop'; // Data Source Name    // Specifying the MySQL Port Number


$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$db   = getenv('DB_DATABASE') ?: 'mydb';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
/*
$host = '127.0.0.1';   // важно: не localhost
$dbname = 'mydb';      // имя вашей базы данных (проверьте в MySQL Workbench)
$user = 'root';
$pass = '';            // по умолчанию пустой
*/
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Подключение успешно!";
} catch (PDOException $e) {
    //die("Ошибка подключения к БД: " . $e->getMessage());
}


/*
try {
    $sql = "SELECT categories_id FROM categories";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($results) > 0) {
        echo "<h3>Таблица 'users' работает. Найдено записей: " . count($results) . "</h3>";
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li>ID: " . htmlspecialchars($row['categories_id']);
        }
        echo "</ul>";
    } else {
        echo "Таблица 'users' пуста. Добавьте хотя бы одного пользователя через phpMyAdmin.";
    }
} catch (PDOException $e) {
    echo "Ошибка при запросе к таблице users: " . $e->getMessage();
}
*/