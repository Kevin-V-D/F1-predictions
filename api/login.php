<?php
require_once 'db.php';

function checkUser($conn) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['password'] === $password) {
        echo "username and password are correct";
    }
    else {
        throw new Exception("Wrong username or password", 1);
    }
}

try {
    checkUser($conn);
    header("location: make_prediction.php");
    exit();
} catch (\Throwable $th) {
    // echo $th->getMessage();
    header("location: login.html");
    exit();
}

?>