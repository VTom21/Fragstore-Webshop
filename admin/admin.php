<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "videogames";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"] ?? "";
$name = $_POST["name"] ?? "";
$game_pic = $_POST["game_pic"] ?? "";
$release_date = $_POST["release_date"] ?? "";
$genre = $_POST["genre"] ?? "";
$platforms = $_POST["platforms"] ?? "";
$prize = $_POST["prize"] ?? null;
$isDiscount = $_POST["isDiscount"] ?? null;
$discountPerc = $_POST["discountPerc"] ?? null;

$action = $_POST["action"] ?? "";

switch ($action) {
    case 'add':
        $stmt = $conn->prepare("INSERT INTO datas (name, game_pic, release_date, genre, platforms, prize, isDiscount, discountPerc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("sssssdii", $name, $game_pic, $release_date, $genre, $platforms, $prize, $isDiscount, $discountPerc);
    
        if ($stmt->execute()) {
            echo "Game added successfully!";
        } else {
            die("Execute failed: " . $stmt->error);
        }
        break;

    case 'update':
        if (empty($id)) {
            die("ID is required for updating a game.");
        }
    
        $id = intval($id);
    
        // Create an associative array of column => value
        $data = [
            'name'        => $name,
            'game_pic'    => $game_pic,
            'release_date'=> $release_date,
            'genre'       => $genre,
            'platforms'   => $platforms,
            'prize'       => $prize,
            'isDiscount'  => $isDiscount,
            'discountPerc'=> $discountPerc
        ];
    
        // Remove empty values
        foreach ($data as $key => $value) {
            if ($value === "" || $value === null) {
                
                if (!is_numeric($value)) {
                    unset($data[$key]);
                }
            }
        }
    
        if (!empty($data)) {
            $sql_parts = [];
            foreach ($data as $key => $value) {
                // If numeric, no quotes; else escape string
                if (is_numeric($value)) {
                    $sql_parts[] = "$key=$value";
                } else {
                    $sql_parts[] = "$key='" . $conn->real_escape_string($value) . "'";
                }
            }
    
            $sql = "UPDATE datas SET " . implode(", ", $sql_parts) . " WHERE id=$id";
            $conn->query($sql);
            echo "Game updated!";
        } else {
            echo "Nothing to update!";
        }
        break;

    case 'delete':
        if (empty($id)) {
            die("ID is required to delete a game.");
        }
        $stmt = $conn->prepare("UPDATE datas SET available = 0 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo $stmt->affected_rows > 0 ? "Game deleted successfully!" : "No game found with that ID.";
        break;

    default:
        if ($action !== '') {
            echo "Invalid Action";
        }
        break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>

<body>
    <form id="gameForm" method="POST">
        <label for="id">id:</label>
        <input type="number" id="id" name="id"><br><br>

        <label for="name">Game Name:</label>
        <input type="text" id="name" name="name"><br><br>

        <label for="game_pic">Game Image URL:</label>
        <input type="text" id="game_pic" name="game_pic"><br><br>

        <label for="release_date">Release Date:</label>
        <input type="date" id="release_date" name="release_date"><br><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre"><br><br>

        <label for="platforms">Platforms:</label>
        <input type="text" id="platforms" name="platforms" placeholder="PC, PS5, Xbox"><br><br>

        <label for="prize">Price:</label>
        <input type="number" step="0.01" id="prize" name="prize"><br><br>

        <label for="isDiscount">Discount (0/1):</label>
        <input type="number" id="isDiscount" name="isDiscount" min="0" max="1"><br><br>

        <label for="discountPerc">Discount %:</label>
        <input type="number" id="discountPerc" name="discountPerc" min="0" max="100"><br><br>

        <!-- Buttons now submit the form directly -->
        <button type="submit" name="action" value="add">Add Game</button>
        <button type="submit" name="action" value="update">Update Game</button>
        <button type="submit" name="action" value="delete">Delete Game</button>
    </form>

</body>

</html>