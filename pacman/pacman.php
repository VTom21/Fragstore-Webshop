<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/ghosts/redGhost.png">
    <link rel=" stylesheet" href="pacman.css">
    <title>Pac Man</title>
</head>

<body>
    <div class="stats">
        <div class="stat_item">
            <h1 class="score">Score: <span class="score_value">0</span></h1>
        </div>

        <div class="stat_item">
            <h1>Life: <span class="life_value">3</span></h1>
        </div>

        <div class="stat_item">
            <h1>Level <span class="level_value">1</span></h1>
        </div>

        <div class="hearts">
            <img id="heart1" src="../pacman/assets/pacman/pacmanRight.png" alt="">
            <img id="heart2"src="../pacman/assets/pacman/pacmanRight.png" alt="">
            <img id="heart3"src="../pacman/assets/pacman/pacmanRight.png" alt="">
        </div>
    </div>

    </div>

    <canvas class="game_canvas">
    </canvas>
    <div class="content">
        <p id="title">Pac Man</p>
        <h2 class="start_text">Press <span id="f">F</span> to start</h2>

    </div>
  
</body>

<script src="pacman.js" type="module"></script>

</html>