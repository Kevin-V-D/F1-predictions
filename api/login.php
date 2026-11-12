<?php
require_once 'db.php';

function checkUser($conn) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row || $row['password'] !== $password) {
        throw new Exception("Wrong username or password", 1);
    }

    // 1. Generate a secure random token
    $token = bin2hex(random_bytes(32));

    // 2. Save the token into the database for this user
    $updateStmt = $conn->prepare("UPDATE users SET session_token = :token WHERE id = :id");
    $updateStmt->execute(['token' => $token, 'id' => $row['id']]);

    // 3. Drop a secure cookie in the user's browser that expires in 1 day
    setcookie('f1_session', $token, [
        'expires' => time() + 86400,
        'path' => '/',
        'secure' => true,      // Requires HTTPS (Vercel uses HTTPS)
        'httponly' => true,    // JavaScript cannot steal this cookie
        'samesite' => 'Lax'
    ]);
}

try {
    checkUser($conn);
    header("Location: make_prediction.php");
    exit();
} catch (\Throwable $th) {
    header("Location: login.html?error=1");
    exit();
}
?>