const cell = 20;
const width = 800;
const height = 800;

let foodImg;
let snakeImg;

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
        this.body = [{ x: 200, y: 200 }];
        this.VelocityX = 1;
        this.VelocityY = 0;
        alert("You died!");
        setup();
      }

      let body_part = {
        x: this.body[this.body.length - 1].x + this.VelocityX * cell,
        y: this.body[this.body.length - 1].y + this.VelocityY * cell,
      };

      this.body.push(body_part);

      if (body_part.x === this.foodX && body_part.y === this.foodY) {
        this.foodX = Math.floor(Math.random() * (width / cell)) * cell;
        this.foodY = Math.floor(Math.random() * (height / cell)) * cell;
      } else {
        this.body.shift();
      }
    };

    this.show = function () {
      snakeImg = createImg("assets/body.png");
      snakeImg.hide();
      foodImg = createImg("assets/food.png");
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
  createCanvas(width, height);
  snake = new Snake(200, 200, 1, 0);
  Controls(snake);
  frameRate(10);
}

function draw() {
  background("#45B649");
  snake.update();
  snake.show();
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
