<?php
require_once 'header.php';
require_once __DIR__ . '/../system/connect.php';
require_once 'flash_error.php';
global $pdo;



if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы просмотреть корзину.';
    header('Location: /');
    exit;
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT c.cart_id, c.product_id, c.size, c.color, c.quantity,
               p.products_name, p.products_price, p.products_image
        FROM cart c
        JOIN products p ON c.product_id = p.products_id
        WHERE c.user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = 0;
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
    <title>Магазин</title>
</head>
<div class="container my-5 pt-4">
    <h1>Корзина</h1>
    <?php if (isset($_SESSION['flash_success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash_success']) ?></div>
        <?php unset($_SESSION['flash_success']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['flash_error']) ?></div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>

    <?php if (empty($cart_items)): ?>
        <p>Ваша корзина пуста.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($cart_items as $item): 
                $subtotal = $item['products_price'] * $item['quantity'];
                $total += $subtotal;
            ?>
                <div class="col">
                    <div class="card h-100 product-card">
                        <a href="/product/<?= $item['product_id'] ?>">
                            <img src="/<?= htmlspecialchars($item['products_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($item['products_name']) ?>">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="/product/<?= $item['product_id'] ?>" class="product-link"><?= htmlspecialchars($item['products_name']) ?></a>
                            </h5>
                            <?php if (!empty($item['size'])): ?>
                                <p class="card-text mb-1"><small>Размер: <?= htmlspecialchars($item['size']) ?></small></p>
                            <?php endif; ?>
                            <?php if (!empty($item['color'])): ?>
                                <p class="card-text mb-1"><small>Цвет: <?= htmlspecialchars($item['color']) ?></small></p>
                            <?php endif; ?>
                            <p class="card-text"><strong>Цена: <?= number_format($item['products_price'], 0, '.', ' ') ?> ₽</strong></p>
                            
                            <div class="mt-auto">
                                <form action="/cart/update" method="POST" class="d-flex gap-2 mb-2">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                    <div class="input-group input-group-sm" style="width: 130px;">
                                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" max="99" class="form-control text-center">
                                        <button type="submit" class="btn btn-outline-secondary">Обновить</button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><strong>Сумма:</strong> <?= number_format($subtotal, 0, '.', ' ') ?> ₽</span>
                                    <form action="/cart/remove" method="POST" onsubmit="return confirm('Удалить товар?')">
                                        <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                        <button type="submit" class="button-backet"><img src="/upload/basket_black.png" alt="remove"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4 p-3 bg-dark text-white rounded d-flex justify-content-between align-items-center cart-summary">
    <h4 class="mb-0">Общая сумма: <?= number_format($total, 0, '.', ' ') ?> ₽</h4>
    <a href="/checkout" class="btn btn-success btn-lg">Оформить заказ</a>
</div>
    <?php endif; ?>
</div>
<?php require_once 'footer.php'; ?>