<?php
require_once 'db.php';

function CreateUser($conn) {
    $conn->prepare("
    INSERT INTO users (username, password)
    VALUES (:username, :password)
    ");
}

try {
    CreateUser($conn);
    header("location: login.html");
} catch (\Throwable $th) {
    echo $th->getMessage();
}

?>