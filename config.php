<?php

//users database for storing user data when logging or signing in

$dsn = "mysql:host=localhost;dbname=users;charset=utf8mb4";
$db_user = "root";
$db_pass = "";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $db_user, $db_pass, $options);
