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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/categories.css">
    <title>Магазин</title>
</head>
<body>

<?php
require_once 'header.php';
require_once __DIR__ . '/../system/connect.php';
require_once 'card.php';
global $pdo;
$sql = "SELECT products_name, products_price, products_image FROM products WHERE";
// Получаем параметры из URL
$gender = $_GET['gender'] ?? 'all';        // men, women, all
$category = $_GET['category'] ?? 'all';    // skirts, pants, t-shirts и т.д.
$subcategory = $_GET['sub'] ?? 'all';
$filters = $_GET;


// Строим запрос динамически
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

// Сначала фильтр по полу (самый важный)
if ($gender !== 'all') {
    $sql .= " AND gender = :gender";
    $params['gender'] = $gender;
}
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
card_view($array);

?>


<?php
require_once 'footer.php';
?>

</body>
</html>