<?php
include '../test.php';
$host = 'localhost';
$db = 'giftcards';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtImg = $pdo->query("SELECT IMG, Name FROM giftcard");
    $Img = $stmtImg->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo $twig->render('error.twig', [
        'title' => 'Unexpected Error',
        'message' => 'Something went wrong.',
        'details' => $e->getMessage(),
        'redirectUrl' => 'home.php'
    ]);
    $Img = [];
    exit;
}
