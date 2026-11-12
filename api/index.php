<?php
require_once 'db.php';

// Fetch all predictions from the database 
// (Assuming you have a table named 'predictions' joined with 'users')
try {
    $stmt = $conn->prepare("SELECT * FROM predictions");
    $stmt->execute();
    $predictions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    $predictions = []; // Fallback if table doesn't exist yet
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 predictions</title>
    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="src/output.css">
</head>
<body>
    <header class="nav">
        <a href="index.php" class="text-red-500 text-shadow-black text-lg md:text-2xl text-shadow-lg p-1">F1 PREDICTIONS</a>
        <a href="make_prediction.php" class="btn">Make Prediction</a>
    </header>
    <main>
        <div class="text-center mt-15 mb-20">
            <h1 class="text-4xl">F1 PREDICTIONS</h1>
            <p class="text-slate-400 text-2xl">Brazil GP</p>
        </div>
        
        <div class="prediction-card-container flex flex-col gap-5 justify-center">
            <?php if (empty($predictions)): ?>
                <p class="text-center text-slate-500">No predictions submitted yet!</p>
            <?php else: ?>
                <!-- Loop through every prediction row from the database -->
                <?php foreach ($predictions as $pred): ?>
                    <div class="prediction-card">
                        <div class="row-span-1 text-slate-400 text-sm">
                            <p><?php echo htmlspecialchars($pred['username']); ?></p>
                        </div>
                        <div class="h-min grid grid-cols-2 gap-5 row-span-1">
                            <div class="col-1">
                                <p>Pole Position:</p>
                                <p>Podium:</p>
                                <p>Fastest Lap:</p>
                            </div>
                            <div class="col-2 text-slate-400 text-sm/6">
                                <p><?php echo htmlspecialchars($pred['pole_position']); ?></p>
                                <p><?php echo htmlspecialchars($pred['podium']); ?></p>
                                <p><?php echo htmlspecialchars($pred['fastest_lap']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>