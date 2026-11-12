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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
    @theme {
      --font-f1: "Formula1";
      --font-digits: "Formula1Digits";
    }
  </style>
</head>
<body class="flex flex-col items-center bg-[#26262b] text-slate-200 font-f1 min-h-screen">
    <header class="h-12 w-full border-b-black border-b-2 flex items-center px-4">
        <a href="index.html" class="text-red-500 text-shadow-black text-lg md:text-2xl text-shadow-lg p-1">F1 PREDICTIONS</a>
    </header>
    <main class="flex flex-col items-center px-4 w-full max-w-xl">
      <div class="text-center mt-15 mb-10">
            <h1 class="text-4xl">
                F1 PREDICTIONS
            </h1>
            <p class="text-slate-400 text-2xl">Brazil GP</p>
        </div>

        <!-- Clean flat 2-column grid form -->
        <form action="prediction_process.php" method="post" class="bg-[#15151e] border-red-600 border-2 shadow-black shadow-lg p-8 rounded-xl shadow-xl w-full grid grid-cols-[auto_1fr] items-center gap-x-6 gap-y-5">
          
          <!-- Pole Position -->
          <label for="pole-position" class="justify-self-end font-medium">Pole Position:</label>
          <div>
            <select class="cursor-pointer bg-[#000] text-slate-200 p-2 rounded-md w-full border border-slate-700 focus:outline-none focus:border-red-500" name="pole-position" id="pole-position">
                <?php renderDriverOptions($drivers); ?>
            </select>
          </div>

          <!-- Podium Label (Spans 3 rows) -->
           <div class="row-span-3 flex flex-col gap-y-6">
            <label for="podium-1" class="text-right font-medium cursor-pointer">Podium: <span class="font-digits ml-2">1</span></label>
            <label for="podium-2" class="text-right font-digits cursor-pointer">2</label>
            <label for="podium-3" class="text-right font-digits cursor-pointer">3</label>
          </div>
          
          <!-- Podium Selects Container (MUST ALSO span 3 rows so grid tracks align correctly) -->
          <div class="flex flex-col gap-y-2 row-span-3">
            <select class="cursor-pointer bg-[#000] text-slate-200 p-2 rounded-md w-full border border-slate-700 focus:outline-none focus:border-red-500" name="podium_1" id="podium-1">
                <?php renderDriverOptions($drivers); ?>
            </select>
            <select class="cursor-pointer bg-[#000] text-slate-200 p-2 rounded-md w-full border border-slate-700 focus:outline-none focus:border-red-500" name="podium_2" id="podium-2">
                <?php renderDriverOptions($drivers); ?>
            </select>
            <select class="cursor-pointer bg-[#000] text-slate-200 p-2 rounded-md w-full border border-slate-700 focus:outline-none focus:border-red-500" name="podium_3" id="podium-3">
                <?php renderDriverOptions($drivers); ?>
            </select>
          </div>

          <!-- Fastest Lap -->
          <label for="fastest-lap" class="justify-self-end font-medium">Fastest Lap:</label>
          <div>
            <select class="cursor-pointer bg-[#000] text-slate-200 p-2 rounded-md w-full border border-slate-700 focus:outline-none focus:border-red-500" name="fastest-lap" id="fastest-lap">
                <?php renderDriverOptions($drivers); ?>
            </select>
          </div>

        </form>
    </main>
</body>
</html>