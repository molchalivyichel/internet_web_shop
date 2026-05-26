<?php
require_once 'flash_error.php';
require_once 'header.php';
require_once __DIR__ . '/../system/connect.php';
require_once 'card.php';

global $pdo;


$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = strtok($request_uri, '?'); 
$segments = explode('/', trim($request_uri, '/'));
$filtered = array_values(array_filter($segments, fn($v) => $v !== ''));

$slug1 = $filtered[1] ?? 'all';      // пол или 'all'
$slug2 = $filtered[2] ?? 'all';      // подкатегория или 'all'

$sql = "SELECT p.* 
        FROM products p
        INNER JOIN categories c ON p.category_id = c.categories_id";

$params = [];

if ($slug1 !== 'all') {
    $sql .= " INNER JOIN categories parent ON c.categories_parent_id = parent.categories_id
              WHERE parent.categories_slug = :gender_slug";
    $params['gender_slug'] = $slug1;
} else {
    $sql .= " WHERE 1=1";
}

if ($slug2 !== 'all') {
    $sql .= " AND c.categories_slug = :category_slug";
    $params['category_slug'] = $slug2;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/entrance.js" defer></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/categories.css">
    <title>Каталог</title>
</head>
<body>

<?php
// Вывод карточек
if (!empty($products)) {
    echo '<div class="card-view-container">';
    card_view($products);
    echo '</div>';
} else {
    echo '<div class="alert alert-warning m-4">Нет товаров, соответствующих фильтрам.</div>';
}

require_once 'footer.php';
?>
</body>
</html>