const cell = 20;
const hitbox = cell * 1.5;
const width = 800;
const height = 700;

let foodImg;
let snakeImg;
let gameOverDiv;
let gamePanelDiv;
let scoreDiv;
let HighScoreDiv;
let score = 0;
let high_score = parseInt(localStorage.getItem("high_score")) || 0;


document.addEventListener("DOMContentLoaded", () => {
  HighScoreDiv = document.querySelector(".high_score");
  HighScoreDiv.innerHTML = `High Score: ${high_score}`;
});



//Creating Snake class for storing its positions and Velocity
class Snake {
  constructor(x, y, VelocityX, VelocityY) {
    this.body = [];
    this.x = x;
    this.y = y;
    this.VelocityX = VelocityX;
    this.VelocityY = VelocityY;

    for (let i = 4; i >= 0; i--) {
      this.body.push({ x: x - 1 * cell, y: y });
    }

    // Fix: Use cell size for proper grid alignment

    this.foodX = Math.floor(Math.random() * ((width - hitbox) / cell)) * cell;
    this.foodY = Math.floor(Math.random() * ((height - hitbox) / cell)) * cell;

    this.update = function () {
      let body_part = {
        x: this.body[this.body.length - 1].x + this.VelocityX * cell,
        y: this.body[this.body.length - 1].y + this.VelocityY * cell,
      };

      this.body.push(body_part);

      //Constrain Logic
      if (body_part.x >= width || body_part.y >= height || body_part.x < 0 || body_part.y < 0) {
        this.x = 200;
        this.y = 200;
        this.body = [{ x: 200, y: 200 }];
        this.VelocityX = 1;
        this.VelocityY = 0;
        Freeze();
        return;
      }

      for (let i = 0; i < this.body.length - 1; i++) {
        if (this.body[i].x == body_part.x && this.body[i].y == body_part.y) {
          Freeze();
          return;
        }
      }

      if (body_part.x >= this.foodX - (hitbox - cell) / 2 && body_part.x < this.foodX + hitbox - (hitbox - cell) / 2 && body_part.y >= this.foodY - (hitbox - cell) / 2 && body_part.y < this.foodY + hitbox - (hitbox - cell) / 2) {
        this.foodX = Math.floor(Math.random() * (width / cell)) * cell;
        this.foodY = Math.floor(Math.random() * (height / cell)) * cell;
        score++;
        scoreDiv = document.querySelector(".score_heading");
        scoreDiv.innerHTML = `Score: ${score}`;

            if (score > high_score) {
      high_score = score;  // update variable
      localStorage.setItem("high_score", high_score); // store in localStorage
      HighScoreDiv.innerHTML = `High Score: ${high_score}`; // update display
    }

      } else {
        this.body.shift();
      }
    };

    this.show = function () {
      snakeImg = createImg("assets/body.png");
      snakeImg.hide();
      foodImg = createImg("assets/apple.png");
      foodImg.hide();

      for (let part of this.body) {
        image(foodImg, snake.foodX, snake.foodY);
        image(snakeImg, part.x, part.y);
      }
    };
  }
}

let snake;

function setup() {
  gamePanelDiv = document.querySelector(".start-div");
  gamePanelDiv.classList.add("show");
  createCanvas(width, height);
  Controls();
  frameRate(10);
}

function draw() {
  background("#45B649");
  if (snake) {
    snake.update();
    snake.show();
  }
}

function Controls() {
  document.addEventListener("keydown", function (e) {
    if (!snake) {
      return;
    }
    switch (e.key) {
      case "ArrowUp":
        if (snake.VelocityY !== 1) {
          snake.VelocityX = 0;
          snake.VelocityY = -1;
        }
        break;

      case "ArrowDown":
        if (snake.VelocityY !== -1) {
          snake.VelocityX = 0;
          snake.VelocityY = 1;
        }
        break;

      case "ArrowLeft":
        if (snake.VelocityX !== 1) {
          snake.VelocityY = 0;
          snake.VelocityX = -1;
        }
        break;

      case "ArrowRight":
        if (snake.VelocityX !== -1) {
          snake.VelocityY = 0;
          snake.VelocityX = 1;
        }
        break;
    }
  });
}

function Freeze() {
  gameOverDiv = document.querySelector(".menu-div");
  gameOverDiv.style.display = "block";
  snake = null;
  noLoop();
}

function Restart() {
  score = 0;
  scoreDiv.innerHTML = `Score: ${score}`;
  HighScoreDiv.innerHTML = `High Score: ${high_score}`;
  document.querySelector(".score_heading").innerHTML = `Score: ${score}`;
  gameOverDiv = document.querySelector(".menu-div");
  gameOverDiv.style.display = "none";
  snake = new Snake(200, 200, 1, 0);
  loop();
}

function Start() {
  gamePanelDiv = document.querySelector(".start-div");
  gamePanelDiv.classList.remove("show");
  document.querySelector(".score_heading").innerHTML = `Score: ${score}`;
  snake = new Snake(200, 200, 1, 0);
  loop();
}
