
<?php

session_start();
include  __DIR__ . '/db.php';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("
        SELECT * FROM users
        WHERE id = :user_id;
    ");

    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
    ]);

    $user_from_db = $stmt->fetch();
}
