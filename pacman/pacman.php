<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/ghosts/redGhost.png">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-firestore-compat.js"></script>
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
    <div class="gameoverbox">
            <h1 class="display_value"></h1>
            <img src="custom_assets\level.png" width="100px" height="100px" alt="star">
    </div>
    <div class="content">
        <p id="title">Pac Man</p>
        <h2 class="start_text">Press <span id="f">F</span> to start</h2>
        <div class="flex">
        <h4 id="high_score"></h4>
        <h4 id="leaderboard_ui">Press <span id="x">X</span> for Leaderboard</h4>
        <h4 id="achievement_ui">Press <span id="x">Z</span> for Achievements</h4>
        </div>
    </div>


<div id="leaderboard_modal" class="modal">
  <div class="modal_content">
    <span id="close_modal" class="close_btn">&times;</span>
    <h2>Best Scores</h2>
    <ul id="leaderboard_list">
        <?php include 'leaderboard.php'; ?>
    </ul>
  </div>
</div>

<div id="achievement_modal" class="modal" ng-app="pacmanApp" ng-controller="AchievementsController">
  <div class="modal_content">
    <span id="close_achievement_modal" class="close_btn">&times;</span>
    <h2>Achievements</h2> 
    <ul id="achievement_list">
      <li ng-repeat="achievement in datas"  class="{{achievement.id}}" ng-class="{'gold': achievement.obtained}">
        <img ng-src="{{achievement.img}}" alt="{{achievement.name}}" width="40" style="vertical-align: middle; margin-right: 10px;">
        <strong>{{achievement.name}}</strong> <p>{{achievement.description}}</p>
      </li>
    </ul>
  </div>
</div>




    
<form id="scoreForm" method="POST" action="submit.php" style="display:none;">
  <input type="hidden" name="name" id="playerName" />
  <input type="hidden" name="score" id="playerScore" />
</form>


  
</body>

<script src="pacman.js" type="module"></script>
<script type="module" src="leaderboard.js"></script>
<script src="achievement.js" type="module"></script>



</html>