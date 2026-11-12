<?php
$url = parse_url(getenv('POSTGRES_URL'));

$host     = $url['host'];
$port     = $url['port'] ?? '6543';
$dbname   = ltrim($url['path'], '/');
$user     = $url['user'];
$password = $url['pass'];

function postPrediction($conn) {
    $stmt = $conn->prepare("INSERT INTO predictions (username, pole-position, podium, fastest_lap)
    VALUES (:username, :pole-position, :podium, :fastest-lap)");
    $stmt->execute(['username' => 'test-user',
                    'pole-position' => $_POST['pole-position'],
                    'podium' => $_POST['podium'],
                    'fastest-lap' => $_POST['fastest-lap']]);
}

try {
    if (!isset($_POST['username'])) {
        throw new Exception("username not set", 1);
        
    }

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $conn = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true
    ]);
    echo "success";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>