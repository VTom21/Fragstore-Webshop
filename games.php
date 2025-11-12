<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'videogames';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);

    // Fetch all game data
    $stmt = $pdo->query("SELECT * FROM datas");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count total games (rows)
    $countStmt = $pdo->query("SELECT MAX(id) AS total FROM datas");
    $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);


    //Count total genres (DISTINCT -> no duplicates allowed)
    $genreCountStmt = $pdo->query("SELECT COUNT(DISTINCT genre) AS totalGenres FROM datas");
    $genreCount = $genreCountStmt->fetch(PDO::FETCH_ASSOC);


    //Count total platforms
    $platformsResult = $pdo->query("SELECT platforms FROM datas");
    $allPlatforms = [];

    //goes through each game's platforms, removes whitespaces, sets them to uppercase
    //stores the values to $allPlatforms

    while ($row = $platformsResult->fetch(PDO::FETCH_ASSOC)) {
        $platformList = explode(',', $row['platforms']);
        foreach ($platformList as $platform) {
            $platform = trim($platform);
            $platform = strtoupper($platform);
            if ($platform !== '') {
                $allPlatforms[] = $platform;
            }
        }
    }

    //removes duplicates values from the platforms and also counts them

    $uniquePlatforms = array_unique($allPlatforms);
    $totalPlatforms = count($uniquePlatforms);

    $genreStatsStmt = $pdo->query("SELECT genre, COUNT(*) AS count FROM datas GROUP BY genre");
    $genreStats = [];
    while ($row = $genreStatsStmt->fetch(PDO::FETCH_ASSOC)) {
        $genreStats[$row['genre']] = (int)$row['count'];
    }


    //converts the associative array to json format

    echo json_encode([
        'games' => $games,
        'total' => $countResult['total'],
        'totalGenres' => $genreCount['totalGenres'],
        'totalPlatforms' => $totalPlatforms,
        'Unique' => $uniquePlatforms,
        'genreStats' => $genreStats
    ]);
    
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]); //error handling
}
