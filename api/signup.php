<?php
require_once 'db.php';

function CreateUser($conn) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("
    INSERT INTO users (username, password)
    VALUES (:username, :password)
    ");

    $stmt->execute([
        'username' => $username,
        'password' => $password
        ]);
}

try {
    CreateUser($conn);
    header("location: login.html");
} catch (PDOException $e) {
    header("location: signup.html?error=1");
}

?>