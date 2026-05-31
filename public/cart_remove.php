<?php
require_once __DIR__ . '/../system/connect.php';
global $pdo;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы управлять корзиной.';
    header('Location: /');
    exit;
}

$cart_id = isset($_POST['cart_id']) ? (int)$_POST['cart_id'] : 0;

if ($cart_id <= 0) {
    $_SESSION['flash_error'] = 'Неверный идентификатор товара.';
    header('Location: cart.php');
    exit;
}

// Удаляем только если запись принадлежит текущему пользователю
$stmt = $pdo->prepare("DELETE FROM cart WHERE cart_id = ? AND user_id = ?");
$stmt->execute([$cart_id, $_SESSION['user_id']]);

if ($stmt->rowCount() > 0) {
    $_SESSION['flash_success'] = 'Товар удалён из корзины.';
} else {
    $_SESSION['flash_error'] = 'Товар не найден или уже удалён.';
}

header('Location: /cart');
exit;