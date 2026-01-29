<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="./assets/icon.png">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/2.0.5/p5.min.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
  <link rel="stylesheet" href="snake.css">
  <title>Snake</title>
</head>
<body>

  <h1 class="title">Snake Game</h1>

  <div x-data="{ startVisible: true, gameOverVisible: false }" class="wrapper">
    <div class="scores">
      <h2 class="score_heading">Score: 0</h2>
      <h2 class="high_score">High Score: 0</h2>
    </div>

    <div class="start-div" x-show="startVisible">
      <h3>Start Game</h3><br>
      <div class="difficulty">
        <label>
          <input type="radio" name="difficulty" value="easy" @change="Difficulty('easy')"> Easy
        </label>
        <label>
          <input type="radio" name="difficulty" value="medium" @change="Difficulty('medium')"> Medium
        </label>
        <label>
          <input type="radio" name="difficulty" value="hard" @change="Difficulty('hard')"> Hard
        </label>
      </div>
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
