<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Steampixel\Route;

Route::add('/', function() {
  echo require_once 'home.php';
});

Route::add('/home', function() {
  echo require_once 'home.php';
});

Route::add('/faq', function() {
  echo require_once 'faq.php';
});

Route::add('/cart', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы просмотреть корзину.';
      header("Location: $redirect");
      exit;
  }
  require_once 'cart.php';
});

Route::add('/cart/add', function() {
  require_once 'cart_add.php';
}, 'post'); // явно указываем метод POST

Route::add('/cart/update', function() {
  require_once 'cart_update.php';
}, 'post');

Route::add('/cart/remove', function() {
  require_once 'cart_remove.php';
}, 'post');

Route::add('/favorite', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы просмотреть избранное.';
      header("Location: $redirect");
      exit;
  }
  require_once 'favorite.php';
});

Route::add('/favorite/add', function() {
  require_once 'favorite_add.php';
});

Route::add('/favorite/remove', function() {
  require_once 'favorite_remove.php';
});

Route::add('/categories', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы начать смотреть категории товаров.';
      header("Location: $redirect");
      exit;
  }
  require_once 'categories.php';
});

/*
Route::add('/categories/man', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы начать смотреть категории товаров.';
      header("Location: $redirect");
      exit;
  }
  echo require_once 'categories.php';
});

Route::add('/categories/woman', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы начать смотреть категории товаров.';
      header("Location: $redirect");
      exit;
  }
  echo require_once 'categories.php';
});

Route::add('/categories/all', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы начать смотреть категории товаров.';
      header("Location: $redirect");
      exit;
  }
  echo require_once 'categories.php';
});
*/

Route::add('/categories/([a-z-0-9-_]+)', function($param1) {
  $redirect = $_POST['redirect'] ?? '/';
  $_GET['gender'] = $param1;
  $_GET['category'] = 'all';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы начать смотреть категории товаров.';
      header("Location: $redirect");
      exit;
  }
  require_once 'categories.php';
});

Route::add('/categories/([a-z0-9-_]+)/([a-z0-9-_]+)', function($param1, $param2) {
  $redirect = $_SERVER['REQUEST_URI'];
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь...';
      header("Location: /login?redirect=" . urlencode($redirect));
      exit;
  }
  $_GET['gender'] = $param1;
  $_GET['category'] = $param2;
  require_once 'categories.php';
});

Route::add('/product/([0-9]+)', function($id) {
  $redirect = $_SERVER['REQUEST_URI'];
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь...';
      header("Location: /login?redirect=" . urlencode($redirect));
      exit;
  }
  $_GET['id'] = $id; // передаём ID в глобальный массив или в require
  require_once 'product.php';
});

Route::add('/checkout', function() {
  require_once 'checkout.php';
}, 'get');

// Обработка ошибок
Route::pathNotFound(function() {
  http_response_code(404);
  echo include '404.php';
});

Route::methodNotAllowed(function() {
  http_response_code(405);
  echo include '405.php';
});

// Run the router
Route::run('/');

