<?php

$name = $_POST["name"] ?? 'Guest';
$score = (int)($_POST["score"] ?? 0);
$usermes;

$url = "https://leaderboard-20b10-default-rtdb.europe-west1.firebasedatabase.app/leaderboard.json";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);


$leaderboard = json_decode($response, true) ?? [];


$userKey = null;
$currentScore = 0;

foreach ($leaderboard as $key => $entry) {
    if ($entry['name'] === $name) {
        $userKey = $key;
        $currentScore = (int)$entry['score'];
        break;
    }
}

if ($userKey !== null) {

    if ($score > $currentScore) {
        $updateData = json_encode(["score" => $score]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://leaderboard-20b10-default-rtdb.europe-west1.firebasedatabase.app/leaderboard/$userKey.json");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH"); // PATCH updates existing node
        curl_setopt($ch, CURLOPT_POSTFIELDS, $updateData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $usermes = "Score updated!";
    } else {
        $usermes = "Existing score is higher or equal. No update.";
    }
} else {

    $newData = json_encode([
        "name" => $name,
        "score" => $score
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $newData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $usermes = "New user added!";
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Pac-Man – Game Over</title>

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: black;
      color: white;
    }

    main {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* "Frame" / középső panel */
    .frame {
      width: 20vw;
      min-width: 260px;
      max-width: 360px;
      max-height: 70vh;
      padding-bottom: 25vh;
      padding-top: 25vh;
      background-color: #000;
      border: 3px solid #ffd800;
      border-radius: 16px;
      padding: 24px;
      text-align: center;
    }

    .logo {
      width: 100%;
      margin-bottom: 20px;
    }

    .logo img {
      width: 100%;
      height: auto;
    }

    .message {
      font-size: 18px;
      margin-bottom: 24px;
      color: #ffd800;
    }

    .play-again {
      display: inline-block;
      padding: 14px 24px;
      font-size: 18px;
      font-weight: bold;
      color: black;
      background-color: #ffd800;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .play-again:hover {
      transform: scale(1.05);
      box-shadow: 0 0 12px #ffd800;
    }
  </style>
</head>

<body>
  <main>
  <div class="frame">
    <div class="logo">
      <img src="assets/ghosts/orangeGhost.png" alt="Pac-Man Logo">
    </div>

    <div class="message">
      <h1>Thanks for playing!</h1>
    </div>

    <div class="message">
      <?php echo $usermes; ?>
    </div>

    <a href="pacman.php" class="play-again">
      ▶ Play Again
    </a>
  </div>
  </main>

</body>
</html>
