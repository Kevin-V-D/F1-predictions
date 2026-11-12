<?php
$databaseUrl = $_ENV['POSTGRES_URL'];

if (!$databaseUrl) {
    die("Error: POSTGRES_URL environment variable is not set.");
}

$url = parse_url($databaseUrl);

$host     = $url['host'] ?? '';
$port     = $url['port'] ?? '6543';
$dbname   = ltrim($url['path'] ?? '', '/');
$user     = $url['user'] ?? '';
$password = $url['pass'] ?? '';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    
    // Establishing the $conn connection variable used across your scripts
    $conn = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>