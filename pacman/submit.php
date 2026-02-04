<?php

$name = $_POST["name"] ?? 'Guest';
$score = (int) ($_POST["score"] ?? 0);
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
        $currentScore = (int) $entry['score'];
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
    <link rel="stylesheet" href="submit.css">
    <title>Pac-Man – Game Over</title>
    <link rel="icon" type="image/x-icon" href="./assets/ghosts/scaredGhost.png">
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