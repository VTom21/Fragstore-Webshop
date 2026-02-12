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
$message = "";
$type = "";

switch ($action) {
    case 'add':
        $stmt = $conn->prepare("INSERT INTO datas (name, game_pic, release_date, genre, platforms, prize, isDiscount, discountPerc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) die("Prepare failed: " . $conn->error);
    
        $stmt->bind_param("sssssdii",  $name, $game_pic, $release_date, $genre, $platforms, $prize, $isDiscount, $discountPerc);
    
        if ($stmt->execute()) {
            $message =  "Game added successfully!";
            $type = "info";
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
            $message = "Game updated!";
            $type = "success";
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
        echo $stmt->affected_rows > 0 ? $message = "Game deleted successfully!" : $message = "No game found with that ID.";
        $type = "danger";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/VTom21/butterfly@master/dist/styles/bundle.min.css">
    <script type="module" src="https://cdn.jsdelivr.net/gh/VTom21/butterfly@master/dist/js/index.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/icons/array.png">
    <title>Admin Panel</title>

    <style>

        



        /* Date input calendar icon */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.5);
            cursor: pointer;
            opacity: 0.6;
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }


        /* Remove default spacing */
        br {
            display: none;
        }

        /* Form spacing */
        form > *:not(:last-child) {
            margin-bottom: 20px !important;
        }




        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Title styling */
        h2 {
            color: #2dd4bf !important;
            text-align: center !important;
            font-size: 20px !important;
            font-weight: 600 !important;
            margin-bottom: 30px !important;
        }
    </style>
</head>

<body class="bg-dark">
    <form id="gameForm" method="POST" class="show-flex js-cent flx-dir-col w-perc-20 bg-dark p-5">
        <div @class="img-div show-flex jc-cent pb-5">
            <img @src="../icons/array.png" @alt="fragstore icon" @class="w-px-75 h-px-75">
        </div>
        
        <?php if(!empty($message)): ?>
<div class="message_div show-flex jc-cent pt-3 mb-4 alert alert-<?php echo $type; ?>">
    <?php echo $message; ?>
    <div class="alert-close"></div>
</div>
<?php endif; ?>

</div>

        <label for="id" class="t-middle white-70">id:</label>
        <input type="number" id="id" name="id" placeholder="Enter ID for update/delete" class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="name" class="t-middle white-70">Game Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter game title" class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="game_pic" class="t-middle white-70">Game Image URL:</label>
        <input type="text" id="game_pic" name="game_pic" placeholder="https://example.com/image.jpg" class="show-flex vertical-self-cent secondary w-perc-100 bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="release_date" class="t-middle white-70">Release Date:</label>
        <input type="date" id="release_date" name="release_date" class="show-flex vertical-self-cent w-perc-100 bg-text-10 secondary b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="genre" class="t-middle white-70">Genre:</label>
        <input type="text" id="genre" name="genre" placeholder="Action, RPG, etc." class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="platforms" class="t-middle white-70">Platforms:</label>
        <input type="text" id="platforms" name="platforms" placeholder="PC, PS5, Xbox" class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="prize" class="t-middle white-70">Price ($):</label>
        <input type="number" step="0.01" id="prize" name="prize" placeholder="59.99" class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="isDiscount" class="t-middle white-70">Discount (0/1):</label>
        <input type="number" id="isDiscount" name="isDiscount" min="0" max="1" placeholder="0 or 1" class="show-flex vertical-self-cent secondary w-perc-100 bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <label for="discountPerc" class="t-middle white-70">Discount %:</label>
        <input type="number" id="discountPerc" name="discountPerc" min="0" max="100" placeholder="0-100" class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

        <div class="buttons show-flex space-16">
            <button type="submit" name="action" value="add" class="btn btn-outline-info white br-2 add">Add Game</button>
            <button type="submit" name="action" value="update" class="btn btn-outline-success white br-2 update">Update Game</button>
            <button type="submit" name="action" value="delete" class="btn btn-outline-danger white br-2 delete">Delete Game</button>
        </div>
    </form>

</body>

<script>
document.querySelector(".alert-close").addEventListener("click", () => {
    document.querySelector(".message_div").style.display = "none";
});

</script>

</html>