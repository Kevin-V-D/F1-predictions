<?php
$url = parse_url(getenv('POSTGRES_URL'));

$host     = $url['host'];
$port     = $url['port'] ?? '6543';
$dbname   = ltrim($url['path'], '/');
$user     = $url['user'];
$password = $url['pass'];

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>