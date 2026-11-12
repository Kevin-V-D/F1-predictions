<?php
$host = $_ENV['POSTGRES_HOST'];
$port = "6543";
$dbname = $_ENV['POSTGRES_DATABASE'];
$user = $_ENV['POSTGRES_USER'];
$password = $_ENV['POSTGRES_PASSWORD'];

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "Connected to Supabase PostgreSQL successfully via PHP!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>