<?php
require_once __DIR__ . '/../system/connect.php';
global $pdo;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы управлять избранным.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : (isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0);

if ($product_id <= 0) {
    $_SESSION['flash_error'] = 'Неверный товар.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/favorite'));
    exit;
}

$stmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND product_id = ?");
$stmt->execute([$user_id, $product_id]);

$_SESSION['flash_success'] = 'Товар удалён из избранного.';
header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/favorite'));
exit;