const cell = 20;
const width = 800;
const height = 800;

let foodImg;
let snakeImg;

//Creating Snake class for storing its positions and Velocity
class Snake {
  constructor(x, y, VelocityX, VelocityY) {
    this.x = x;
    this.y = y;
    this.VelocityX = VelocityX;
    this.VelocityY = VelocityY;

    // Fix: Use cell size for proper grid alignment
    
    this.foodX = Math.floor(Math.random() * (width / cell)) * cell;
    this.foodY = Math.floor(Math.random() * (height / cell)) * cell;

    this.update = function () {
      //Moving
      this.x = this.x + this.VelocityX * cell;
      this.y = this.y + this.VelocityY * cell;

      //Constrain Logic
      if (this.x >= width || this.y >= height || this.x < 0 || this.y < 0) {
        this.x = 200;
        this.y = 200;
      }

      if (this.x === this.foodX && this.y === this.foodY) {
        this.foodX = Math.floor(Math.random() * (width / cell)) * cell;
        this.foodY = Math.floor(Math.random() * (height / cell)) * cell;
      }
    };

    this.show = function () {
      snakeImg = createImg("assets/body.png");
      snakeImg.hide();
      foodImg = createImg("assets/food.png");
      foodImg.hide();
    };
  }
}

let snake;

function setup() {
  createCanvas(width, height);
  snake = new Snake(200, 200, 1, 0);
  Controls(snake);
  frameRate(10);
}

function draw() {
  background("#45B649");
  snake.update();
  snake.show();
  image(foodImg, snake.foodX, snake.foodY);
  image(snakeImg, snake.x, snake.y);
}

function Controls(snake) {
  document.addEventListener("keydown", function (e) {
    switch (e.key) {
      case "ArrowUp":
        snake.VelocityX = 0;
        snake.VelocityY = -1;
        break;

      case "ArrowDown":
        snake.VelocityX = 0;
        snake.VelocityY = 1;
        break;

      case "ArrowLeft":
        snake.VelocityY = 0;
        snake.VelocityX = -1;
        break;

      case "ArrowRight":
        snake.VelocityY = 0;
        snake.VelocityX = 1;
        break;
    }
  });
}
