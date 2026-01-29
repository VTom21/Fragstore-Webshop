
//base variables
const cell = 20;
const hitbox = cell * 1.5;
const width = 800;
const height = 700;

//DOM Objects
let foodImg;
let snakeImg;
let gameOverDiv;
let gamePanelDiv;
let scoreDiv;
let HighScoreDiv;
let score = 0;
let high_score = parseInt(localStorage.getItem("high_score")) || 0;

//Set default high score value
document.addEventListener("DOMContentLoaded", () => {
  HighScoreDiv = document.querySelector(".high_score");
  HighScoreDiv.innerHTML = `High Score: ${high_score}`;
});



//Creating Snake class for storing its positions and Velocity.
class Snake {
  constructor(x, y, VelocityX, VelocityY) {
    this.body = []; //snake's body
    this.x = x;
    this.y = y;
    this.VelocityX = VelocityX;
    this.VelocityY = VelocityY;

    //starting length of the snake (5 => head + 4 body part blocks)
    for (let i = 4; i >= 0; i--) {
      this.body.push({ x: x - 1 * cell, y: y });
    }

    //generating random X and Y positions for the food
    // (width - hitbox) and (height - hitbox) makes sure the food or its hitbox doesnt go beyond the game canvas border

    this.foodX = Math.floor(Math.random() * (width - hitbox));
    this.foodY = Math.floor(Math.random() * (height - hitbox));

    //Update calculate the snakes new position based on where the head moves
    //exp.  60 + 1 * 20 => 60 + 20 = 80 (x), 40 + 0 * 20 = 40 (y)
    this.update = function () {
      let body_part = {
        x: this.body[this.body.length - 1].x + this.VelocityX * cell,
        y: this.body[this.body.length - 1].y + this.VelocityY * cell,
      };

      this.body.push(body_part); //new head appears at (80,40)

      //Constrain Logic
      if (body_part.x >= width || body_part.y >= height || body_part.x < 0 || body_part.y < 0) {
        this.x = 200;
        this.y = 200;
        this.body = [{ x: 200, y: 200 }]; //defaults back to starting position 
        this.VelocityX = 1;
        this.VelocityY = 0;
        Freeze(); //Game stops
        return;
      }

      //Self-Collision Check => if snake's head collides into any part of its own body (in any axis), the game stops & resets
      for (let i = 0; i < this.body.length - 1; i++) {
        if (this.body[i].x == body_part.x && this.body[i].y == body_part.y) {
          Freeze();
          return;
        }
      }

      //Food Collision logic => Checks if snake collides into the food in any axis
      // (hitbox - cell) => (30 - 20) = 1 decreases the hitbox, otherwise too easy to get food.

      if (body_part.x >= this.foodX - (hitbox - cell) / 2 && body_part.x < this.foodX + hitbox - (hitbox - cell) / 2 && body_part.y >= this.foodY - (hitbox - cell) / 2 && body_part.y < this.foodY + hitbox - (hitbox - cell) / 2) {
        //Random Food generation again
        this.foodX = Math.floor(Math.random() * (width - hitbox));
        this.foodY = Math.floor(Math.random() * (height - hitbox));
        score++; //increases current score
        scoreDiv = document.querySelector(".score_heading");
        scoreDiv.innerHTML = `Score: ${score}`;

        //High Score Checking
        if (score > high_score) {
        high_score = score; 
        localStorage.setItem("high_score", high_score);
        HighScoreDiv.innerHTML = `High Score: ${high_score}`;
    }

      } else {
        //if snake doesn't collide with any food or any other entity on the map, it removes it's tail as it moves every frame (represents snake moving)
        this.body.shift(); 
      }
    };

    //declaring and setting every sprite in the game
    this.show = function () {
      //createImg() built in p5.js function for image creation
      snakeImg = createImg("assets/body.png");
      snakeImg.hide(); //initial hide
      foodImg = createImg("assets/apple.png");
      foodImg.hide();

      //draws out all foods and snake blocks
      for (let part of this.body) {
        image(foodImg, snake.foodX, snake.foodY);
        image(snakeImg, part.x, part.y);
      }
    };
  }
}

let snake;

//setup() p5.js function => creating the canvas, setting frame rate, calling base controls => setup is only called once
function setup() {
  gamePanelDiv = document.querySelector(".start-div");
  gamePanelDiv.classList.add("show");
  createCanvas(width, height);
  Controls();
  frameRate(10);
}

//draw() p5.js function => sets background color, draws out snake image assets, updates snake's head position 

function draw() {
  background("#45B649");
  if (snake) {
    snake.update();
    snake.show();
  }
}

//Controls Function => handles logic based on which arrow the user presses
function Controls() {
  document.addEventListener("keydown", function (e) {
    if (!snake) {
      return; //if snake isnt rendered yet, return
    }
    switch (e.key) {
      case "ArrowUp":
        if (snake.VelocityY !== 1) { //makes sure snake isn't going down (down => up: self collision)
          snake.VelocityX = 0;
          snake.VelocityY = -1; //-Y => up
        }
        break;

      case "ArrowDown":
        if (snake.VelocityY !== -1) { //makes sure snake isn't going up (up => down: self collision)
          snake.VelocityX = 0;
          snake.VelocityY = 1; //+Y => down
        }
        break;

      case "ArrowLeft":
        if (snake.VelocityX !== 1) { //makes sure snake isn't going right (right => left: self collision)
          snake.VelocityY = 0;
          snake.VelocityX = -1; //-X => left
        }
        break;

      case "ArrowRight":
        if (snake.VelocityX !== -1) { //makes sure snake isn't going left (left => right: self collision)
          snake.VelocityY = 0;
          snake.VelocityX = 1; //+X => right
        }
        break;
    }
  });
}

//Freeze function is called when dying
function Freeze() {
  gameOverDiv = document.querySelector(".menu-div");
  gameOverDiv.style.display = "block";
  snake = null; //clears the snake off canvas
  noLoop(); ////noLoop() p5.js function => stops game loop => loop() breaks it
}

//Restart Function for scores, snake positions, velocity & restarting the game loop
//restart is called when clicking 'Play Again'
function Restart() {
  score = 0;

  const scoreDiv = document.querySelector(".score_heading");
  const highScoreDiv = document.querySelector(".high_score");

  if (scoreDiv) {
    scoreDiv.innerHTML = `Score: ${score}`;
  }

  if (highScoreDiv) {
    highScoreDiv.innerHTML = `High Score: ${high_score}`;
  }

  snake = new Snake(200, 200, 1, 0);
  gameOverDiv.style.display = "none";
  loop();
}


//Start is called when clicking 'Play' at the beginning
function Start() {
  gamePanelDiv = document.querySelector(".start-div");
  gamePanelDiv.classList.remove("show");
  document.querySelector(".score_heading").innerHTML = `Score: ${score}`;
  snake = new Snake(200, 200, 1, 0);
  loop();
}

//switch statements for handling Difficulties
//Higher Difficulty = Higher framerate resulting faster snake movement
function Difficulty(diff){
  switch(diff){
    case "easy":
      frameRate(10);
      break;

    case "medium":
      frameRate(20);
      break;

    case "hard":
      frameRate(26);
      break;
  }
}
