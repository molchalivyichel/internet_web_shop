<?php
$error = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_error']);
if ($error) {
    echo '<script>alert("' . htmlspecialchars($error, ENT_QUOTES) . '");</script>';
}
?>