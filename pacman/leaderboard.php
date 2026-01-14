<?php

$url = "https://leaderboard-20b10-default-rtdb.europe-west1.firebasedatabase.app/leaderboard.json";

$ch = curl_init($url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$data = json_decode($response, true);

foreach($data as $key => $entry){
  echo "<li>" . htmlspecialchars($entry["name"]) . " - " . htmlspecialchars($entry["score"]) . "</li>";  
}

