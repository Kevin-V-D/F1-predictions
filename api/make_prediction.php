<?php
$drivers = [
    "NOR" => "Lando Norris",
    "PIA" => "Oscar Piastri",
    "LEC" => "Charles Leclerc",
    "HAM" => "Lewis Hamilton",
    "VER" => "Max Verstappen",
    "HAD" => "Isack Hadjar",
    "RUS" => "George Russell",
    "ANT" => "Kimi Antonelli",
    "ALO" => "Fernando Alonso",
    "STR" => "Lance Stroll",
    "GAS" => "Pierre Gasly",
    "COL" => "Franco Colapinto",
    "BEA" => "Oliver Bearman",
    "CAM" => "Rafael Câmara",
    "LAW" => "Liam Lawson",
    "LIN" => "Arvid Lindblad",
    "ALB" => "Alexander Albon",
    "SAI" => "Carlos Sainz",
    "HUL" => "Nico Hülkenberg",
    "BOR" => "Gabriel Bortoleto",
    "PER" => "Sergio Pérez",
    "BOT" => "Valtteri Bottas"
];

function renderDriverOptions($drivers) {
    foreach ($drivers as $code => $name) {
        echo '<option value="' . $code . '">' . $name . '</option>' . "\n";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 predictions</title>
    <link rel="stylesheet" href="fonts.css">
    <!-- Link your local Tailwind output file -->
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="flex flex-col items-center bg-[#26262b] text-slate-200 font-f1 min-h-screen">
    <header class="nav">
        <a href="../index.html" class="text-red-500 text-shadow-black text-lg md:text-2xl text-shadow-lg p-1">F1 PREDICTIONS</a>
    </header>
    <main class="flex flex-col items-center px-4 w-full max-w-xl">
      <div class="text-center mt-15 mb-10">
            <h1 class="text-4xl">
                F1 PREDICTIONS
            </h1>
            <p class="text-slate-400 text-2xl">Brazil GP</p>
        </div>

        <!-- Prediction Form -->
        <form action="prediction_process.php" method="post" class="bg-[#15151e] border-red-600 border-2 shadow-black shadow-lg p-8 rounded-xl w-full grid grid-cols-[auto_1fr] items-center gap-x-6 gap-y-5">
         
          <!-- Pole Position -->
          <label for="pole-position" class="justify-self-end font-medium">Pole Position:</label>
          <div>
            <select class="f1-select" name="pole-position" id="pole-position">
                <?php renderDriverOptions($drivers); ?>
            </select>
          </div>

          <!-- Podium Label -->
           <div class="row-span-3 flex flex-col gap-y-6">
            <label for="podium-1" class="text-right font-medium cursor-pointer">Podium: <span class="font-digits ml-9">1</span></label>
            <label for="podium-2" class="text-right font-digits cursor-pointer">2</label>
            <label for="podium-3" class="text-right font-digits cursor-pointer">3</label>
          </div>
          
          <!-- Podium Selects Container -->
          <div class="flex flex-col gap-y-2 row-span-3">
            <select class="f1-select" name="podium_1" id="podium-1">
                <?php renderDriverOptions($drivers); ?>
            </select>
            <select class="f1-select" name="podium_2" id="podium-2">
                <?php renderDriverOptions($drivers); ?>
            </select>
            <select class="f1-select" name="podium_3" id="podium-3">
                <?php renderDriverOptions($drivers); ?>
            </select>
          </div>

          <!-- Fastest Lap -->
          <label for="fastest-lap" class="justify-self-end font-medium">Fastest Lap:</label>
          <div>
            <select class="f1-select" name="fastest-lap" id="fastest-lap">
                <?php renderDriverOptions($drivers); ?>
            </select>
          </div>

          <div class="btn-container">
            <button class="btn w-50" type="submit">SUBMIT</button>
          </div>

        </form>
    </main>
</body>
</html>