<?php
require_once __DIR__ . '/../system/connect.php';
require_once __DIR__ . '/../system/auth.php';
require_once __DIR__ . '/../system/router.php';

use Steampixel\Route;

Route::add('/', function() {
    $error = $_SESSION['flash_error'] ?? '';
    unset($_SESSION['flash_error']); 
    render('home', ['error' => $error]);
});
