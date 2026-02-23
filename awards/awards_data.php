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

    $awardStmt = $pdo->query("
        SELECT a.award_id, g.game_name, g.game_img, a.award_name, a.award_year 
        FROM awards a
        JOIN award_games g ON a.game_id = g.game_id
        ORDER BY a.award_year DESC, a.award_name ASC
    ");
    $awardNames = $pdo->query("SELECT DISTINCT(award_name) AS award_name FROM awards");
    $awards = $awardStmt->fetchAll(PDO::FETCH_ASSOC);
    $awardsUnique = $awardNames->fetchAll(PDO::FETCH_ASSOC);

    $publisherStmt = $pdo->query("SELECT * FROM publishers ORDER BY publisher_id ASC");
    $publishers = $publisherStmt->fetchAll(PDO::FETCH_ASSOC);

$developerStmt = $pdo->query("
    SELECT 
        d.developer_id,
        d.person_name,
        GROUP_CONCAT(DISTINCT r.role_name ORDER BY r.role_name SEPARATOR ', ') AS role_names,
        p.publisher_id,
        p.company_name,
        dp.start_date AS pub_start_date,
        dp.end_date AS pub_end_date
    FROM developers d
    LEFT JOIN developer_roles dr ON d.developer_id = dr.developer_id
    LEFT JOIN roles r ON dr.role_id = r.role_id
    LEFT JOIN developer_publisher dp ON d.developer_id = dp.developer_id
    LEFT JOIN publishers p ON dp.publisher_id = p.publisher_id
    GROUP BY d.developer_id, d.person_name, p.publisher_id, p.company_name, dp.start_date, dp.end_date
    ORDER BY d.developer_id ASC
");
$developers = $developerStmt->fetchAll(PDO::FETCH_ASSOC);



    $publisherAwardsStmt = $pdo->query("SELECT * FROM publisher_awards ORDER BY award_id ASC");
    $publisherAwards = $publisherAwardsStmt->fetchAll(PDO::FETCH_ASSOC);

    $developerAwardsStmt = $pdo->query("SELECT * FROM developer_awards ORDER BY award_id ASC");
    $developerAwards = $developerAwardsStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    
    $awards = [];
    $publishers = [];
    $developers = [];
    $publisherAwards = [];
    $developerAwards = [];

    echo $twig->render('error.twig', [
        'title' => 'Unexpected Error',
        'message' => 'Something went wrong.',
        'details' => $e->getMessage(),
        'redirectUrl' => '../home/home.php'
    ]);
    exit;
}

