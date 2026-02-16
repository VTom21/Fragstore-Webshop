<?php
require '../games_raw.php';

$message = '';
$type = '';

// Load genres
$genresStmt = $pdo->query("SELECT genre_id, genre_name FROM genres ORDER BY genre_name");
$genres = $genresStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $game_pic = $_POST['game_pic'] ?? '';
    $release_date = $_POST['release_date'] ?? '';
    $genre = $_POST['genre'] ?? null; // genre_id
    $platforms = $_POST['platforms'] ?? '';
    $prize = $_POST['prize'] ?? null;
    $isDiscount = $_POST['isDiscount'] ?? 0;
    $discountPerc = $_POST['discountPerc'] ?? 0;
    $action = $_POST['action'] ?? '';

    try {
        switch ($action) {

            case 'add':

                // Insert game first
                $stmt = $pdo->prepare("
        INSERT INTO datas (name, game_pic, release_date, genre_id, prize, isDiscount, discountPerc)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
                $stmt->execute([$name, $game_pic, $release_date, $genre, $prize, $isDiscount, $discountPerc]);

                // Get new game ID
                $game_id = $pdo->lastInsertId();

                // Platforms array from form (checkboxes)
                $platform_ids = $_POST['platforms'] ?? [];

                // Insert platforms into junction table
                $stmtPlat = $pdo->prepare("INSERT INTO game_platforms (game_id, platform_id) VALUES (?, ?)");

                foreach ($platform_ids as $pid) {
                    $stmtPlat->execute([$game_id, $pid]);
                }

                $message = "Game added!";
                $type = "success";
                break;


            case 'update':
                if (!$id) throw new Exception("ID required");

                $stmtCurrent = $pdo->prepare("SELECT * FROM datas WHERE id = ?");
                $stmtCurrent->execute([$id]);
                $currentGame = $stmtCurrent->fetch(PDO::FETCH_ASSOC);
                if (!$currentGame) throw new Exception("Game not found");

                $name = !empty($name) ? $name : $currentGame['name'];
                $game_pic = !empty($game_pic) ? $game_pic : $currentGame['game_pic'];
                $release_date = !empty($release_date) ? $release_date : $currentGame['release_date'];
                $genre = !empty($genre) ? $genre : $currentGame['genre_id'];
                $prize = !empty($prize) ? $prize : $currentGame['prize'];
                $isDiscount = isset($_POST['isDiscount']) ? $isDiscount : $currentGame['isDiscount'];
                $discountPerc = isset($_POST['discountPerc']) ? $discountPerc : $currentGame['discountPerc'];

                $stmt = $pdo->prepare("UPDATE datas SET name=?, game_pic=?, release_date=?, genre_id=?, prize=?, isDiscount=?, discountPerc=? WHERE id=?");
                $stmt->execute([$name, $game_pic, $release_date, $genre, $prize, $isDiscount, $discountPerc, $id]);

                $message = "Game updated!";
                $type = "info";
                break;



            case 'delete':
                if (!$id) throw new Exception("ID required");

                $stmt = $pdo->prepare("UPDATE datas SET available = 0 WHERE id=?");
                $stmt->execute([$id]);

                $message = "Game deleted!";
                $type = "danger";
                break;
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        $type = "danger";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/VTom21/butterfly@master/dist/styles/bundle.min.css">
    <link rel="stylesheet" href="admin.css">
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
        form>*:not(:last-child) {
            margin-bottom: 20px !important;
        }
    </style>
</head>

<body class="bg-dark">
    <form id="gameForm" method="POST" class="show-flex js-cent flx-dir-col w-perc-20 bg-dark p-5">
        <div @class="img-div show-flex jc-cent pb-5">
            <img @src="../icons/array.png" @alt="fragstore icon" @class="w-px-75 h-px-75">
        </div>

        <?php if (!empty($message)): ?>
            <div class="message_div show-flex jc-cent pt-3 mb-4 alert alert-<?php echo $type; ?>">
                <?php echo $message; ?>
                <div class="alert-close"></div>
            </div>
        <?php endif; ?>

        </div>
        <div class="inputcont">
            <label for="id" class="t-middle white-70">id:</label>
            <input type="number" id="id" name="id" placeholder="Enter ID for update/delete"
                class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

            <label for="name" class="t-middle white-70">Game Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter game title"
                class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

            <label for="game_pic" class="t-middle white-70">Game Image URL:</label>
            <input type="text" id="game_pic" name="game_pic" placeholder="https://example.com/image.jpg"
                class="show-flex vertical-self-cent secondary w-perc-100 bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

            <label for="release_date" class="t-middle white-70">Release Date:</label>
            <input type="date" id="release_date" name="release_date"
                class="show-flex vertical-self-cent w-perc-100 bg-text-10 secondary b b-info-40 br-2 p-3 fw-thick"><br><br>

            <label for="genre" class="t-middle white-70">Genre:</label>
            <select id="genre" name="genre"
                class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick">
                <option value="">-- Select Genre --</option>
                <?php foreach ($genres as $g): ?>
                    <option value="<?= $g['genre_id'] ?>">
                        <?= htmlspecialchars($g['genre_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label class="t-middle white-70">Platforms:</label>
            <div style="max-height: 200px; overflow-y: auto; border: 1px solid #444; padding: 10px; border-radius: 4px;">
                <?php
                $platformsStmt = $pdo->query("SELECT platform_id, platform_name FROM platforms ORDER BY platform_name");
                $platformsList = $platformsStmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($platformsList as $p):
                ?>
                    <label class="white-70" style="display: block; margin-bottom: 5px;">
                        <input type="checkbox" name="platforms[]" value="<?= $p['platform_id'] ?>">
                        <?= htmlspecialchars($p['platform_name']) ?>
                    </label>
                <?php endforeach; ?>
            </div><br><br>

            <label for="prize" class="t-middle white-70">Price ($):</label>
            <input type="number" step="0.01" id="prize" name="prize" placeholder="59.99"
                class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

            <label for="isDiscount" class="t-middle white-70">Discount (0/1):</label>
            <input type="number" id="isDiscount" name="isDiscount" min="0" max="1" placeholder="0 or 1"
                class="show-flex vertical-self-cent secondary w-perc-100 bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

            <label for="discountPerc" class="t-middle white-70">Discount %:</label>
            <input type="number" id="discountPerc" name="discountPerc" min="0" max="100" placeholder="0-100"
                class="show-flex vertical-self-cent w-perc-100 secondary bg-text-10 b b-info-40 br-2 p-3 fw-thick"><br><br>

            <div class="buttons show-flex space-50 py-4 jc-cent px-5">
                <button type="submit" name="action" value="add" class="btn btn-outline-info white br-2 add w-perc-100">Add
                    Game</button>
                <button type="submit" name="action" value="update"
                    class="btn btn-outline-success white br-2 update w-perc-100">Update Game</button>
                <button type="submit" name="action" value="delete"
                    class="btn btn-outline-danger white br-2 delete w-perc-100">Delete Game</button>
            </div>
        </div>
        <a href="../home/home.php" class="btn btn-info br-2 py-3 white w-perc-100 go_back">Go back</a>
</body>

<script>
    document.querySelector(".alert-close")?.addEventListener("click", () => {
        document.querySelector(".message_div").style.display = "none";
    });
</script>

</html>