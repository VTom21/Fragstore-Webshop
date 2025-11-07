<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leaderboard";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$score = $_POST['score'] ?? 0;

if (!empty($name) && is_numeric($score)) {
  // check if name already exists
  $check = $conn->prepare("SELECT score FROM datas WHERE name = ?");
  $check->bind_param("s", $name);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    // player already exists
    $row = $result->fetch_assoc();
    if ($score > $row['score']) {
      // update only if the new score is higher
      $update = $conn->prepare("UPDATE datas SET score = ? WHERE name = ?");
      $update->bind_param("is", $score, $name);
      $update->execute();
      $update->close();
      echo "data refreshed!";
    }
  } else {
    // insert new player
    $insert = $conn->prepare("INSERT INTO datas (name, score) VALUES (?, ?)");
    $insert->bind_param("si", $name, $score);
    $insert->execute();
    $insert->close();
    echo "data added!";
  }

  $check->close();
}

$conn->close();

