<?php
// games_raw.php - prepares game data, does NOT echo or json_encode

$host = 'localhost';
$db = 'videogames';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all games with their genres
    $stmt = $pdo->query("
        SELECT d.*, g.genre_name AS genre
        FROM datas d
        LEFT JOIN genres g ON d.genre_id = g.genre_id
    ");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all platforms for each game from the junction table
    $platformStmt = $pdo->query("
        SELECT gp.game_id, p.platform_name
        FROM game_platforms gp
        JOIN platforms p ON gp.platform_id = p.platform_id
        ORDER BY gp.game_id, p.platform_name
    ");
    $platformData = $platformStmt->fetchAll(PDO::FETCH_ASSOC);

    // Map platforms to games
    $gamePlatforms = [];
    foreach ($platformData as $row) {
        $gamePlatforms[$row['game_id']][] = $row['platform_name'];
    }

    // Attach platforms array to each game
    foreach ($games as &$game) {
        $game['platforms'] = $gamePlatforms[$game['id']] ?? [];
    }

    // Count total games
    $countStmt = $pdo->query("SELECT COUNT(*) AS total FROM datas");
    $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);

    // Fetch first game name as example
    $nameCountStmt = $pdo->query("SELECT name FROM datas LIMIT 1");
    $nameResult = $nameCountStmt->fetch(PDO::FETCH_ASSOC);

    // Count total genres
    $genreCountStmt = $pdo->query("SELECT COUNT(DISTINCT genre_id) AS totalGenres FROM datas WHERE genre_id IS NOT NULL");
    $genreCount = $genreCountStmt->fetch(PDO::FETCH_ASSOC);

    // Get all unique platforms from platforms table
    $uniquePlatformsStmt = $pdo->query("
        SELECT platform_name 
        FROM platforms 
        ORDER BY platform_name
    ");
    $uniquePlatformsData = $uniquePlatformsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    $uniquePlatforms = [];
    foreach ($uniquePlatformsData as $p) {
        $uniquePlatforms[] = strtoupper($p['platform_name']);
    }
    $totalPlatforms = count($uniquePlatforms);

    // Genre stats
    $genreStatsStmt = $pdo->query("
        SELECT g.genre_name AS genre, COUNT(d.id) AS count
        FROM datas d
        LEFT JOIN genres g ON d.genre_id = g.genre_id
        WHERE g.genre_name IS NOT NULL
        GROUP BY g.genre_name
    ");
    $genreStats = [];
    while ($row = $genreStatsStmt->fetch(PDO::FETCH_ASSOC)) {
        $genreStats[$row['genre']] = (int)$row['count'];
    }

    // Data is now stored in these variables:
    // $games, $nameResult, $countResult, $genreCount, $uniquePlatforms, $totalPlatforms, $genreStats

} catch (PDOException $e) {
    // Handle error however you want, e.g., throw exception or log
    die("Database error: " . $e->getMessage());
}