<?php
ini_set('session.cookie_lifetime', 86400);
session_start();
require_once __DIR__ . '/../system/auth.php';

$redirect = $_POST['redirect'] ?? '/';

$email = check($_POST['email'] ?? '', 255);
$password = check($_POST['password'] ?? '',255);

$existing_user = check_email($email);
if ($existing_user !== 0) {
    $_SESSION['flash_error'] = 'Данная электронная почта существует';
    header("Location: $redirect");
    exit();
}

$new_user_id = add_user($email, $password);
if ($new_user_id === false) {
    $_SESSION['flash_error'] = 'Неизвестная ошибка';
    header("Location: $redirect");
    exit();
}
$_SESSION['user_id'] = $new_user_id;
header("Location: $redirect");
exit();
?>