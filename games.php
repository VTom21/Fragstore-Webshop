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
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1️⃣ Fetch all games with genre name aliased as 'genre'
    $stmt = $pdo->query("
        SELECT d.*, g.genre_name AS genre
        FROM datas d
        LEFT JOIN genres g ON d.genre_id = g.genre_id
    ");
    $gamesRaw = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2️⃣ Fetch all platforms per game (via junction table)
    $gameIds = array_column($gamesRaw, 'id'); // collect all game IDs
    if (count($gameIds) > 0) {
        $placeholders = implode(',', array_fill(0, count($gameIds), '?'));

        $stmtPlatforms = $pdo->prepare("
            SELECT gp.game_id, p.platform_name AS platform
            FROM game_platforms gp
            INNER JOIN platforms p ON gp.platform_id = p.platform_id
            WHERE gp.game_id IN ($placeholders)
        ");
        $stmtPlatforms->execute($gameIds);
        $platformsRaw = $stmtPlatforms->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $platformsRaw = [];
    }

    // Map platforms by game_id
    $platformMap = [];
    foreach ($platformsRaw as $row) {
        $platformMap[$row['game_id']][] = $row['platform'];
    }

    // 3️⃣ Combine platform data into each game
    $games = [];
    foreach ($gamesRaw as $game) {
        $game['platforms'] = $platformMap[$game['id']] ?? [];
        $games[] = $game;
    }

    // 4️⃣ Count totals
    $countStmt = $pdo->query("SELECT COUNT(*) AS total FROM datas");
    $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);

    $genreCountStmt = $pdo->query("SELECT COUNT(*) AS totalGenres FROM genres");
    $genreCount = $genreCountStmt->fetch(PDO::FETCH_ASSOC);

    $platformCountStmt = $pdo->query("SELECT COUNT(*) AS totalPlatforms FROM platforms");
    $platformCount = $platformCountStmt->fetch(PDO::FETCH_ASSOC);

    // 5️⃣ Genre stats (number of games per genre)
    $genreStatsStmt = $pdo->query("
        SELECT g.genre_name AS genre, COUNT(d.id) AS count
        FROM datas d
        LEFT JOIN genres g ON d.genre_id = g.genre_id
        GROUP BY g.genre_name
    ");
    $genreStats = [];
    while ($row = $genreStatsStmt->fetch(PDO::FETCH_ASSOC)) {
        $genreStats[$row['genre']] = (int)$row['count'];
    }

    // 6️⃣ Unique platforms
    $uniquePlatformsStmt = $pdo->query("SELECT platform_name AS platform FROM platforms");
    $uniquePlatforms = $uniquePlatformsStmt->fetchAll(PDO::FETCH_COLUMN);

    // 7️⃣ Return JSON
    echo json_encode([
        'games' => $games,
        'total' => $countResult['total'],
        'totalGenres' => $genreCount['totalGenres'],
        'totalPlatforms' => $platformCount['totalPlatforms'],
        'uniquePlatforms' => $uniquePlatforms,
        'genreStats' => $genreStats
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'error' => 'Database error',
        'message' => $e->getMessage()
    ]);
}
