<?php

$url = "https://leaderboard-20b10-default-rtdb.europe-west1.firebasedatabase.app/leaderboard.json";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

// Check if data is not empty
if ($data) {
    // Sort the leaderboard by score (highest first)
    usort($data, function($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    // Display
    foreach ($data as $entry) {
        echo "<li>" . htmlspecialchars($entry["name"]) . " - " . htmlspecialchars($entry["score"]) . "</li>";  
    }
}
