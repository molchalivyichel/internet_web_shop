<?php

require_once __DIR__ . '/vendor/autoload.php';

use Steampixel\Route;

Route::add('/', function() {
  echo include 'home.php';
});

Route::add('/index', function() {
  echo include 'home.php';
});

Route::add('/faq', function() {
  echo include 'faq.php';
});

Route::add('/cart', function() {
  $redirect = $_POST['redirect'] ?? '/';
  
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы просмотреть корзину.';
      header("Location: $redirect");
      exit;
  }
});

Route::add('/favorite', function() {
  $redirect = $_POST['redirect'] ?? '/';
  if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Авторизуйтесь, чтобы просмотреть избранное.';
      header("Location: $redirect");
      exit;
  }
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

