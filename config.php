<?php
include '../test.php';
$dsn = "mysql:host=localhost;dbname=users;charset=utf8mb4";
$db_user = "root";
$db_pass = "";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    $stmt = $pdo->query("SELECT username FROM users");
    $usernames = $stmt->fetchAll();

} catch (PDOException $e) {
    echo $twig->render('error.twig', [
        'title' => 'Unexpected Error',
        'message' => 'Something went wrong.',
        'details' => $e->getMessage(),
        'redirectUrl' => '/home/home.php'
      ]);
    $usernames = [];
    exit;

}
