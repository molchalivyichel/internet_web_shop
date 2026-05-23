<?php
ini_set('session.cookie_lifetime', 86400);
session_start();
require_once __DIR__ . '/../system/auth.php';

$redirect = $_POST['redirect'] ?? '/';

$email = check($_POST['email'] ?? '', 255);   
$password = $_POST['password'] ?? '';

$user_id = check_email($email);
if ($user_id === 0) {
    $_SESSION['flash_error'] = 'Вы ввели неверную электронную почту';
    header("Location: $redirect");
    exit();
}

if (!check_password($password, $user_id)) {
    $_SESSION['flash_error'] = 'Вы ввели неверный пароль';
    header("Location: $redirect");
    exit();
}

$_SESSION['user_id'] = $user_id;
header("Location: $redirect");
exit();
?>