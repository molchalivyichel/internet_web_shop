<?php
require_once __DIR__ . '/../system/connect.php';
global $pdo;

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit('Неавторизован');
}

$cart_id = isset($_POST['cart_id']) ? (int)$_POST['cart_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

// Ограничиваем количество от 1 до 99
if ($quantity < 1) {
    $quantity = 1;
} elseif ($quantity > 99) {
    $_SESSION['flash_error'] = 'Нельзя заказать более 99 единиц товара.';
    header('Location: /cart');
    exit;
}

if ($cart_id <= 0) {
    $_SESSION['flash_error'] = 'Некорректный идентификатор корзины.';
    header('Location: /cart');
    exit;
}

$stmt = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE cart_id = :cart_id AND user_id = :user_id");
$stmt->execute([
    ':quantity' => $quantity,
    ':cart_id' => $cart_id,
    ':user_id' => $_SESSION['user_id']
]);

$_SESSION['flash_success'] = 'Количество обновлено.';
header('Location: /cart');
exit;