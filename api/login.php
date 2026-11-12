<?php
session_start();
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

    // Prevent session fixation attacks
    session_regenerate_id(true);

    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
}

try {
    checkUser($conn);
    header("Location: make_prediction.php");
    exit();
} catch (\Throwable $th) {
    echo $th->getMessage();
    // Pass ?error=1 so the JS error banner shows up on failure
    // header("Location: login.html?error=1");
    // exit();
}
?>