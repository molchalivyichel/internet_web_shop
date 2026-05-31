<?php
require_once __DIR__ . '/../system/connect.php';
global $pdo;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы добавить в избранное.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : (isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0);

if ($product_id <= 0) {
    $_SESSION['flash_error'] = 'Неверный товар.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

// Проверяем, существует ли товар
$stmt = $pdo->prepare("SELECT products_id FROM products WHERE products_id = ?");
$stmt->execute([$product_id]);
if (!$stmt->fetch()) {
    $_SESSION['flash_error'] = 'Товар не найден.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

// Добавляем (игнорируем дубликаты)
$stmt = $pdo->prepare("INSERT IGNORE INTO favorites (user_id, product_id) VALUES (?, ?)");
$stmt->execute([$user_id, $product_id]);

$_SESSION['flash_success'] = 'Товар добавлен в избранное.';
header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/favorite'));
exit;