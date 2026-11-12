<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../login.html");
}

require_once 'db.php';

function postPrediction($conn) {
    // Only process if it's a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username     = $_SESSION['username'] ?? '';
        $polePosition = $_POST['pole-position'] ?? '';
        $fastestLap   = $_POST['fastest-lap'] ?? '';

        $podium1 = $_POST['podium_1'] ?? '';
        $podium2 = $_POST['podium_2'] ?? '';
        $podium3 = $_POST['podium_3'] ?? '';

        $podium = $podium1 . ', ' . $podium2 . ', ' . $podium3;

        try {
            // Everything database-related goes safely inside the POST block
            $stmt = $conn->prepare("INSERT INTO predictions (username, pole_position, podium, fastest_lap)
            VALUES (:username, :pole_position, :podium, :fastest_lap)");
            
            $stmt->execute([
                'username'      => "test-user",
                'pole_position' => $polePosition,
                'podium'        => $podium,
                'fastest_lap'   => $fastestLap
            ]);
        } catch (PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
        }
    }
}

try { 
    // Call the function to handle submissions when the script is hit
    postPrediction($conn);
    header("location: ../index.html");
    exit();
} catch (PDOException $e) {
    echo implode(",", $_POST);
    die("Database connection failed: " . $e->getMessage());
}
?>