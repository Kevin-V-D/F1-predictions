<?php
$url = parse_url(getenv('POSTGRES_URL'));

$host     = $url['host'];
$port     = $url['port'] ?? '6543';
$dbname   = ltrim($url['path'], '/');
$user     = $url['user'];
$password = $url['pass'];

echo implode(",", $_POST);

function postPrediction($conn) {
    // Only process if it's a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username     = $_POST['username'] ?? '';
        $polePosition = $_POST['pole_position'] ?? '';
        $fastestLap   = $_POST['fastest_lap'] ?? '';

        $podium = [
            $_POST['podium1'] ?? '',
            $_POST['podium2'] ?? '',
            $_POST['podium3'] ?? ''
        ];

        $escapedDrivers = array_map(function($driver) {
            return '"' . str_replace('"', '""', trim($driver)) . '"';
        }, $podium);
        
        $podiumString = '{' . implode(',', $escapedDrivers) . '}';

        try {
            // Everything database-related goes safely inside the POST block
            $stmt = $conn->prepare("INSERT INTO predictions (username, pole_position, podium, fastest_lap)
            VALUES (:username, :pole_position, :podium, :fastest_lap)");
            
            $stmt->execute([
                'username'      => "test-user",
                'pole_position' => $polePosition,
                'podium'        => $podiumString,
                'fastest_lap'   => $fastestLap
            ]);

            echo "Prediction saved successfully!";
        } catch (PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
        }
    }
}

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $conn = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true
    ]);
    
    // Call the function to handle submissions when the script is hit
    postPrediction($conn);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>