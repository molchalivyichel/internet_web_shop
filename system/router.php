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
  echo require_once 'cart.php';
});

Route::add('/favorite', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы просмотреть избранное.';
      header("Location: $redirect");
      exit;
  }
  echo require_once 'favorite.php';
});

Route::add('/categories', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы начать смотреть категории товаров.';
      header("Location: $redirect");
      exit;
  }
  echo require_once 'categories.php';
});

Route::add('/categories/([a-z-0-9-]*)', function() {
  echo require_once 'categories.php';
});

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

