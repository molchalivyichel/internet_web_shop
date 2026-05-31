<?php
require_once 'flash_error.php';
require_once 'header.php';
require_once __DIR__ . '/../system/connect.php';
require_once 'card.php';

$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = strtok($request_uri, '?');
$segments = explode('/', trim($request_uri, '/'));
$filtered = array_values(array_filter($segments, fn($v) => $v !== ''));
global $pdo;

$slug1 = $filtered[1] ?? 'all';
$slug2 = $filtered[2] ?? 'all';

// Получение фильтров из GET
$price_min = isset($_GET['price_min']) && $_GET['price_min'] !== '' ? (int)$_GET['price_min'] : null;
$price_max = isset($_GET['price_max']) && $_GET['price_max'] !== '' ? (int)$_GET['price_max'] : null;
$selected_sizes   = isset($_GET['sizes']) ? (array)$_GET['sizes'] : [];
$selected_colors  = isset($_GET['colors']) ? (array)$_GET['colors'] : [];

// Функция получения уникальных значений из поля с запятыми
function getAvailableMultiValues($pdo, $slug1, $slug2, $column) {
    $sql = "SELECT $column
            FROM products p
            INNER JOIN categories c ON p.category_id = c.categories_id";
    $params = [];
    if ($slug1 !== 'all') {
        $sql .= " INNER JOIN categories parent ON c.categories_parent_id = parent.categories_id
                  WHERE parent.categories_slug = :gender_slug";
        $params[':gender_slug'] = $slug1;
    } else {
        $sql .= " WHERE 1=1";
    }
    if ($slug2 !== 'all') {
        $sql .= " AND c.categories_slug = :category_slug";
        $params[':category_slug'] = $slug2;
    }
    $sql .= " AND $column IS NOT NULL AND $column != ''";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $unique = [];
    foreach ($rows as $str) {
        $parts = array_map('trim', explode(',', $str));
        foreach ($parts as $val) {
            if ($val !== '') $unique[$val] = true;
        }
    }
    return array_keys($unique);
}

$available_sizes   = getAvailableMultiValues($pdo, $slug1, $slug2, 'products_size');
$available_colors  = getAvailableMultiValues($pdo, $slug1, $slug2, 'products_color');

// Основной запрос
$sql = "SELECT DISTINCT p.*
        FROM products p
        INNER JOIN categories c ON p.category_id = c.categories_id";
$params = [];

// Условия по категориям
if ($slug1 !== 'all') {
    $sql .= " INNER JOIN categories parent ON c.categories_parent_id = parent.categories_id
              WHERE parent.categories_slug = :gender_slug";
    $params[':gender_slug'] = $slug1;
} else {
    $sql .= " WHERE 1=1";
}
if ($slug2 !== 'all') {
    $sql .= " AND c.categories_slug = :category_slug";
    $params[':category_slug'] = $slug2;
}

if ($price_min !== null) {
    $sql .= " AND p.products_price >= :price_min";
    $params[':price_min'] = $price_min;
}
if ($price_max !== null) {
    $sql .= " AND p.products_price <= :price_max";
    $params[':price_max'] = $price_max;
}

// Для размеров
if (!empty($selected_sizes)) {
    $sizeConditions = [];
    $idx = 0;
    foreach ($selected_sizes as $size) {
        $param = ":size_$idx";
        // Удаляем все пробелы из поля перед поиском
        $sizeConditions[] = "FIND_IN_SET($param, REPLACE(p.products_size, ' ', ''))";
        $params[$param] = $size;
        $idx++;
    }
    $sql .= " AND (" . implode(' OR ', $sizeConditions) . ")";
}

// Аналогично для цветов
if (!empty($selected_colors)) {
    $colorConditions = [];
    $idx = 0;
    foreach ($selected_colors as $color) {
        $param = ":color_$idx";
        $colorConditions[] = "FIND_IN_SET($param, REPLACE(p.products_color, ' ', ''))";
        $params[$param] = $color;
        $idx++;
    }
    $sql .= " AND (" . implode(' OR ', $colorConditions) . ")";
}

// Цвета
if (!empty($selected_colors)) {
    $colorConditions = [];
    $idx = 0;
    foreach ($selected_colors as $color) {
        $param = ":color_$idx";
        $colorConditions[] = "FIND_IN_SET($param, p.products_color)";
        $params[$param] = $color;
        $idx++;
    }
    $sql .= " AND (" . implode(' OR ', $colorConditions) . ")";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
$base_url = strtok($_SERVER['REQUEST_URI'], '?');

$favorite_ids = [];
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT product_id FROM favorites WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $favorite_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/categories.css">
    <link rel="stylesheet" href="/css/faq.css">
    <title>Каталог</title>
</head>
<body>
<div class="catalog-layout">
<div class="mt-5 mb-5">
        <div class="accordion" id="routeAccordion">

          <!-- Ячейка 1-->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
              <button class="accordion-button collapsed text-button" type="button" data-bs-toggle="collapse" 
                      data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                Фильтры
              </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#routeAccordion">
              <div class="accordion-body">

    <!-- Боковая панель фильтров -->
    <aside class="filter-sidebar">
        <h3>Фильтры</h3>
        <form method="GET" action="">
            <!-- Цена -->
            <div class="filter-group">
                <label>Цена, ₽</label>
                <div class="price-inputs">
                    <input type="number" name="price_min" placeholder="от" value="<?= htmlspecialchars($price_min ?? '') ?>">
                    <input type="number" name="price_max" placeholder="до" value="<?= htmlspecialchars($price_max ?? '') ?>">
                </div>
            </div>

            <!-- Размеры -->
            <?php if (!empty($available_sizes)): ?>
                <div class="filter-group">
                    <label>Размеры</label>
                    <?php foreach ($available_sizes as $size): ?>
                        <label class="checkbox-label">
                            <input type="checkbox" name="sizes[]" value="<?= htmlspecialchars($size) ?>"
                                <?= in_array($size, $selected_sizes) ? 'checked' : '' ?>>
                            <?= htmlspecialchars($size) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Цвета -->
            <?php if (!empty($available_colors)): ?>
                <div class="filter-group">
                    <label>Цвета</label>
                    <?php foreach ($available_colors as $color): ?>
                        <label class="checkbox-label">
                            <input type="checkbox" name="colors[]" value="<?= htmlspecialchars($color) ?>"
                                <?= in_array($color, $selected_colors) ? 'checked' : '' ?>>
                            <?= htmlspecialchars($color) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="filter-actions">
                <button type="submit" class="btn-filter">Применить</button>
            </div>
            <div class="filter-actions">
                <button class="btn-reset"><a href="<?= htmlspecialchars($base_url) ?>">Сбросить</a></button>
            </div>
        </form>
    </aside>

    </div>
    </div>
              </div>
            </div>
          </div>

    <!-- Область с карточками товаров -->
    <main class="products-area">
        <?php
    if (!empty($products)) {
    echo '<div class="card-view-container">';
    card_view($products, $favorite_ids);
    echo '</div>';
} else {
    echo '<div class="alert alert-warning m-4">Нет товаров, соответствующих фильтрам.</div>';
}
?>
    </main>
</div>

<?php require_once 'footer.php'; ?>
</body>
</html>