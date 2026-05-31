<?php
require_once __DIR__ . '/../system/connect.php';
require_once 'flash_error.php';
global $pdo;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы оформить заказ.';
    header('Location: /');
    exit;
}

$user_id = $_SESSION['user_id'];

// Получаем товары из корзины
$stmt = $pdo->prepare("SELECT c.product_id, c.size, c.color, c.quantity, p.products_price
                       FROM cart c
                       JOIN products p ON c.product_id = p.products_id
                       WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($cart_items)) {
    $_SESSION['flash_error'] = 'Корзина пуста.';
    header('Location: cart.php');
    exit;
}

// Вычисляем общую сумму
$total = array_sum(array_map(function($item) {
    return $item['products_price'] * $item['quantity'];
}, $cart_items));

// Начинаем транзакцию
try {
    $pdo->beginTransaction();

    // Создаём заказ
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, order_price) VALUES (?, ?)");
    $stmt->execute([$user_id, $total]);
    $order_id = $pdo->lastInsertId();

    // Добавляем товары в orders_products
    $stmt = $pdo->prepare("INSERT INTO orders_products (order_id, product_id, orders_products_counts, orders_products_size, orders_products_color) 
                           VALUES (?, ?, ?, ?, ?)");
    foreach ($cart_items as $item) {
        $stmt->execute([
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['size'],
            $item['color']
        ]);
    }

    // Очищаем корзину пользователя
    $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);

    $pdo->commit();

    $_SESSION['flash_success'] = 'Заказ успешно оформлен!';
    header('Location: /cart'); // или на страницу заказов
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['flash_error'] = 'Ошибка при оформлении заказа: ' . $e->getMessage();
    header('Location: /cart');
    exit;
}
?>