<?php
// all_data.php
$host = 'localhost';
$db = 'videogames';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $awardStmt = $pdo->query("SELECT * FROM awards ORDER BY award_year DESC, award_name ASC");
    $awardNames = $pdo->query("SELECT DISTINCT(award_name) AS award_name FROM awards");
    $awards = $awardStmt->fetchAll(PDO::FETCH_ASSOC);
    $awardsUnique = $awardNames->fetchAll(PDO::FETCH_ASSOC);

    $publisherStmt = $pdo->query("SELECT * FROM publishers ORDER BY publisher_id ASC");
    $publishers = $publisherStmt->fetchAll(PDO::FETCH_ASSOC);

    $developerStmt = $pdo->query("SELECT * FROM developers ORDER BY developer_id ASC");
    $developers = $developerStmt->fetchAll(PDO::FETCH_ASSOC);

    $publisherAwardsStmt = $pdo->query("SELECT * FROM publisher_awards ORDER BY award_id ASC");
    $publisherAwards = $publisherAwardsStmt->fetchAll(PDO::FETCH_ASSOC);

    $developerAwardsStmt = $pdo->query("SELECT * FROM developer_awards ORDER BY award_id ASC");
    $developerAwards = $developerAwardsStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // In case of error, set all arrays to empty
    $awards = [];
    $publishers = [];
    $developers = [];
    $publisherAwards = [];
    $developerAwards = [];
}

