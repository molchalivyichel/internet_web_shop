<?php
require_once __DIR__ . '/connect.php';

function check($value, $max_length, $min_length = 7) {
    $value = trim($value ?? '');
    $len = strlen($value);
    if ($len >= $min_length && $len <= $max_length) {
        return $value;
    }
    $_SESSION['flash_error'] = 'Значение не соответствует требуемой длине (от 8 до 255).';
    header("Location: .");
    exit();
}

function check_email($email) {
    global $pdo;
    $sql = "SELECT users_id FROM users WHERE users_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        return $user['users_id'];
    }
    else {
        return 0;
    }
}

function check_password($password, $id_user) {
    global $pdo;
    $sql = "SELECT user_password_hash FROM users WHERE users_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row && password_verify($password, $row['user_password_hash']);
}

function check_user_id($id_user) {
    global $pdo;
    $sql = "SELECT users_id, users_email FROM users WHERE users_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id_user]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function add_user($email, $password) {
    global $pdo;
    try {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (users_email, user_password_hash) VALUES (:email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'password' => $password_hash]);
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log("DB error: " . $e->getMessage());
        return false;
    }
}

/*
$sql = "SELECT * FROM users";
$result = $con->query($sql);
$hash = "";

echo "<p>a: </p>";
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    check('maksiste2005@yandex.ru',155);
    check('hashdumsp',255);

    check_email('maksiste2005@yandex.ru');

    $hash = password_hash($row['user_password_hash'], PASSWORD_DEFAULT);

    echo "ID: " . $row['users_id'] . ", Email: " . $row['users_email'] . ", password: " . $row['user_password_hash'] . "<br>";

    echo "hash of 'test123': " . $hash . "<br><br>";

    echo "hashVerify of 'test123': " . password_verify($hash, PASSWORD_DEFAULT) . "<br><br>";
}

*/
?>