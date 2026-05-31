<?php
require_once 'header.php';
require_once __DIR__ . '/../system/connect.php';
require_once 'card.php';
global $pdo;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы просмотреть избранное.';
    header('Location: /');
    exit;
}
$user_id = $_SESSION['user_id'];
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

$sql = "SELECT p.* 
        FROM favorites f
        JOIN products p ON f.product_id = p.products_id
        WHERE f.user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container my-5 pt-4">
    <h1>Избранное</h1>
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash_success']) ?></div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['flash_error']) ?></div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>
    
    <?php if (empty($favorites)): ?>
        <p>Вы ещё не добавили ни одного товара в избранное.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($favorites as $item): ?>
                <div class="col">
                    <div class="card product-card h-100">
                        <a href="/product/<?= $item['products_id'] ?>">
                            <div class="product-image-wrapper">
                                <img src="/<?= htmlspecialchars($item['products_image']) ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($item['products_name']) ?>">
                            </div>
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title product-name">
                                <a href="/product/<?= $item['products_id'] ?>" class="product-link"><?= htmlspecialchars($item['products_name']) ?></a>
                            </h5>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="product-price"><?= number_format($item['products_price'], 0, '.', ' ') ?> ₽</span>
                                <div class="product-actions">
                                    <!-- Только кнопка удаления из избранного -->
                                    <a href="/favorite/remove?product_id=<?= $item['products_id'] ?>" class="btn-icon" title="Удалить из избранного" onclick="event.stopPropagation(); return confirm('Удалить товар из избранного?');">
                                        <img src="/upload/basket.png" alt="remove">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php require_once 'footer.php'; ?>