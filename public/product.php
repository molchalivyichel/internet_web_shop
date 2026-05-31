<?php
require_once 'flash_error.php';
require_once __DIR__ . '/../system/connect.php';
require_once 'header.php';
global $pdo;

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($product_id <= 0) {
    echo '<div class="alert alert-danger m-4">Товар не найден.</div>';
    require_once 'footer.php';
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE products_id = :id");
$stmt->execute([':id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo '<div class="alert alert-danger m-4">Товар не найден.</div>';
    require_once 'footer.php';
    exit;
}

$colors = array_map('trim', explode(',', $product['products_color'] ?? ''));
$sizes  = array_map('trim', explode(',', $product['products_size'] ?? ''));

$catStmt = $pdo->prepare("
    SELECT c.categories_name, parent.categories_name as parent_name
    FROM categories c
    LEFT JOIN categories parent ON c.categories_parent_id = parent.categories_id
    WHERE c.categories_id = ?
");
$catStmt->execute([$product['category_id']]);
$category = $catStmt->fetch(PDO::FETCH_ASSOC);
$gender = ($category['parent_name'] ?? '') === 'Мужская' ? 'Мужское' : (($category['parent_name'] ?? '') === 'Женская' ? 'Женское' : '');
?>

<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        <?= htmlspecialchars($_SESSION['flash_success']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        <?= htmlspecialchars($_SESSION['flash_error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['flash_error']); ?>
<?php endif; ?>

<?php
$is_favorite = false;
if (isset($_SESSION['user_id'])) {
    $favStmt = $pdo->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND product_id = ?");
    $favStmt->execute([$_SESSION['user_id'], $product_id]);
    $is_favorite = (bool)$favStmt->fetch();
}
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
    <link rel="stylesheet" href="/css/product.css">
    <title><?= htmlspecialchars($product['products_name']) ?> | Магазин</title>
</head>
<body>

<main class="container my-5 pt-4">
    <div class="row g-5">
        <div class="col-md-6">
            <div class="product-image-wrapper">
                <img src="/<?= htmlspecialchars($product['products_image']) ?>" 
                     alt="<?= htmlspecialchars($product['products_name']) ?>" 
                     class="img-fluid rounded-4">
            </div>
        </div>

        <div class="col-md-6">
            <?php if ($gender): ?>
                <div class="product-gender mb-2"><?= htmlspecialchars($gender) ?></div>
            <?php endif; ?>

            <h1 class="product-title mb-3"><?= htmlspecialchars($product['products_name']) ?></h1>
            <div class="product-price mb-4"><?= number_format($product['products_price'], 0, '.', ' ') ?> ₽</div>

            <!-- ФОРМА – теперь включает все поля -->
            <form action="/cart/add" method="POST" id="addToCartForm">
                <input type="hidden" name="product_id" value="<?= $product['products_id'] ?>">
                <input type="hidden" name="quantity" value="1">

                <!-- Цвета (радиокнопки) -->
                <?php if (!empty($colors) && $colors[0] !== ''): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Цвет:</label>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach ($colors as $color): ?>
                            <div class="form-check">
                                <input class="form-check-input color-radio" type="radio" name="color" value="<?= htmlspecialchars($color) ?>" id="color_<?= htmlspecialchars($color) ?>">
                                <label class="form-check-label" for="color_<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($color) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Размеры (радиокнопки) -->
                <?php if (!empty($sizes) && $sizes[0] !== ''): ?>
                <div class="mb-4">
                    <label class="form-label fw-bold">Размер:</label>
                    <div class="d-flex flex-wrap gap-3">
                        <?php foreach ($sizes as $size): ?>
                            <div class="form-check">
                                <input class="form-check-input size-radio" type="radio" name="size" value="<?= htmlspecialchars($size) ?>" id="size_<?= htmlspecialchars($size) ?>">
                                <label class="form-check-label" for="size_<?= htmlspecialchars($size) ?>"><?= htmlspecialchars($size) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <button type="submit" class="btn-add-to-cart">Добавить в корзину</button>
                <button>
                <?php if ($is_favorite): ?>
    <a href="/favorite/remove?product_id=<?= $product_id ?>" class="btn-favorite active button-text" onclick="return confirm('Удалить из избранного?')">
        <img src="/upload/favorite_white.png" alt="in favorites"> В избранном
    </a>
<?php else: ?>
    <a href="/favorite/add?product_id=<?= $product_id ?>" class="btn-favorite button-text">
        <img src="/upload/favorite_white.png" alt="add to favorites"> В избранное
    </a>
<?php endif; ?>
    </button>
            </form>

            <!-- JavaScript-валидация остаётся корректной, так как ищет радиокнопки с name="size" и "color" внутри документа -->
            <script>
            document.getElementById('addToCartForm').addEventListener('submit', function(e) {
                <?php if (!empty($colors) && $colors[0] !== ''): ?>
                    var colorSelected = document.querySelector('input[name="color"]:checked');
                    if (!colorSelected) {
                        alert('Пожалуйста, выберите цвет.');
                        e.preventDefault();
                        return false;
                    }
                <?php endif; ?>
                
                <?php if (!empty($sizes) && $sizes[0] !== ''): ?>
                    var sizeSelected = document.querySelector('input[name="size"]:checked');
                    if (!sizeSelected) {
                        alert('Пожалуйста, выберите размер.');
                        e.preventDefault();
                        return false;
                    }
                <?php endif; ?>
            });
            </script>
        </div>
    </div>
</main>

<?php if (!empty($product['products_description'])): ?>
            <div class="container product-description">
                <h3 class="h5 mb-3">Описание товара:</h3>
                <p class="description"><?= nl2br(htmlspecialchars($product['products_description'])) ?></p>
            </div>
            <?php endif; ?>

<?php
require_once 'footer.php';
?>
</body>
</html>