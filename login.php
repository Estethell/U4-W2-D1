<?php
include_once __DIR__ . '/includes/init.php';

$user = [];
$user['username'] = $_POST['username'] ?? '';
$user['password'] = $_POST['password'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $stmt = $pdo->prepare("
        SELECT * FROM users
        WHERE username = :username;
    ");

    $stmt->execute([
        'username' => $_POST['username'],
    ]);

    $user_from_db = $stmt->fetch();
   
    if ($user_from_db) {
        if (password_verify($_POST['password'], $user_from_db["password"])) {
            
            $_SESSION['user_id'] = $user_from_db['id'];
            header('Location: http://localhost:8080/U4-W2-D1/enter_page.php');
         
        };
    }


    $errors['credentials'] = 'Credenziali non valide';
}

include_once __DIR__ . '/includes/initial.php'; 
include_once __DIR__ . '/includes/navbar.php';
?>


    <h1 class="w-50 m-auto mt-5 mb-3">Login</h1>
    <form class="w-50 m-auto my-3" action="" method="POST" novalidate>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

<?php
include __DIR__ . '/includes/end.php';