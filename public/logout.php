<?php
session_start();
session_destroy();

$redirect = $_GET['redirect'] ?? '/';
header('Location: ' . $redirect);
exit;