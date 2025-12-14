<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/icon.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/2.0.5/p5.min.js" integrity="sha512-jOTg6ikYiHx1LvbSOucnvZi4shXbaovZ91+rfViIiUFLgAJK+k1oQtGEaLvDB8rsZwEfUksTgmhrxdvEDykuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sketch.js/1.1/sketch.js" integrity="sha512-5t4lSiUS+fgaOiTm36s+DrDJc+rLx0zPHWrtbmnLsNOdjHyQLBg0mPpLoK2Qb6i5LpfRt6PdcG0FyiGmqVST0g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
    <link rel="stylesheet" href="snake.css">
    <title>Snake</title>
</head>

<body>

    <h1 class="title">Snake Game</h1>


    <div x-data="{ startVisible: true, gameOverVisible: false }" class="wrapper">
        <h2 class="score_heading">Score: <span id="score">0</span></h2>

        <div class="start-div" x-show="startVisible">
            <h3>Start Game</h3>
            <button class="start_btn" @click="Start(); startVisible = false">Play</button>
        </div>

        <div class="menu-div" x-show="gameOverVisible">
            <h3>Game Over</h3>
            <button class="restart_btn" @click="Restart(); gameOverVisible = false">Play Again</button>
        </div>

    </div>


    <script src="snake.js"></script>

</body>

</html>