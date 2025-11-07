<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "leaderboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, score FROM datas ORDER BY score DESC LIMIT 100";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $i = 1;
  while($row = $result->fetch_assoc()) {
    echo "<li>$i. " . htmlspecialchars($row["name"]) . " — " . $row["score"] . "</li>";
    $i++;
  }
} else {
  echo "<li>No scores yet!</li>";
}

$conn->close();

