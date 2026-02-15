<?php
include '../test.php';
$host = 'localhost';
$db = 'videogames';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get genres and their counts
    $genreStatsStmt = $pdo->query("SELECT genre_name, COUNT(*) AS count FROM genres GROUP BY genre_name");
    $genreStats = [];
    while ($row = $genreStatsStmt->fetch(PDO::FETCH_ASSOC)) {
        $genreStats[$row['genre_name']] = (int)$row['count'];
    }

} catch (PDOException $e) {
    echo $twig->render('error.twig', [
        'title' => 'Unexpected Error',
        'message' => 'Something went wrong.',
        'details' => $e->getMessage(),
        'redirectUrl' => 'home.php'
    ]);
    $genreStats = [];
    exit;
}
