<?php
require_once __DIR__ . '/../system/connect.php';
global $pdo;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы добавить товар в корзину.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

$user_id = (int)$_SESSION['user_id'];
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
$selected_size = trim($_POST['size'] ?? '');
$selected_color = trim($_POST['color'] ?? '');

if ($product_id <= 0) {
    $_SESSION['flash_error'] = 'Некорректный товар.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

// Получаем доступные размеры и цвета для валидации
$stmt = $pdo->prepare("SELECT products_size, products_color FROM products WHERE products_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    $_SESSION['flash_error'] = 'Товар не найден.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
    exit;
}

$available_sizes = array_map('trim', explode(',', $product['products_size'] ?? ''));
$available_colors = array_map('trim', explode(',', $product['products_color'] ?? ''));

// Валидация размера
if (!empty($available_sizes) && $available_sizes[0] !== '') {
    if ($selected_size === '' || !in_array($selected_size, $available_sizes)) {
        $_SESSION['flash_error'] = 'Пожалуйста, выберите размер.';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
        exit;
    }
}

// Валидация цвета
if (!empty($available_colors) && $available_colors[0] !== '') {
    if ($selected_color === '' || !in_array($selected_color, $available_colors)) {
        $_SESSION['flash_error'] = 'Пожалуйста, выберите цвет.';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
        exit;
    }
}

// Добавляем или обновляем товар в корзине
try {
    $sql = "INSERT INTO cart (user_id, product_id, size, color, quantity) 
            VALUES (:user_id, :product_id, :size, :color, :quantity)
            ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':product_id' => $product_id,
        ':size' => $selected_size ?: null,
        ':color' => $selected_color ?: null,
        ':quantity' => $quantity
    ]);
    $_SESSION['flash_success'] = 'Товар добавлен в корзину.';
} catch (PDOException $e) {
    $_SESSION['flash_error'] = 'Ошибка добавления товара.';
}
header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/cart'));
exit;