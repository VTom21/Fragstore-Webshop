const cell = 20;
const width = 800;
const height = 800;


//Images
let foodImg;
let snakeImg;

//Creating Snake class for storing its positions and Velocity
class Snake {
  constructor(x, y, VelocityX, VelocityY) {
    this.body = []; //Rest of the snake body except it's head = {x,y}
    this.x = x;
    this.y = y;
    this.VelocityX = VelocityX;
    this.VelocityY = VelocityY;


    //Starting length of snake => head + body
    for (let i = 3; i >= 0; i--) {
      this.body.push({ x: x - i * cell, y: y });
    }

    //generate random x,y positions for food
    this.foodX = Math.floor(Math.random() * (width / cell)) * cell;
    this.foodY = Math.floor(Math.random() * (height / cell)) * cell;

    this.update = function () {
      //Moving
      this.x = this.x + this.VelocityX * cell;
      this.y = this.y + this.VelocityY * cell;

      //Constrain Logic
      if (this.x >= width || this.y >= height || this.x < 0 || this.y < 0) {
        alert("You died!");
        this.VelocityX = 1;
        this.VelocityY = 0;
        return;
      }
      

      //We go through parts of body, if self collision => centers snake and resets body block count
      for (let i = 1; i < this.body.length; i++) {
        if (this.x === this.body[i].x && this.y === this.body[i].y) {
          alert("You died!");
          this.x = 200;
          this.y = 200;
          this.body = [{ x: 200, y: 200 }];

          for (let i = 3; i >= 0; i--) {
            this.body.push({ x: x - i * cell, y: y });
          }
          this.VelocityX = 1;
          this.VelocityY = 0;
          return;
        }
      }
      

      //generates body by stacking the body parts together
      let body_part = {
        x: this.body[this.body.length - 1].x + this.VelocityX * cell,
        y: this.body[this.body.length - 1].y + this.VelocityY * cell,
      };

      this.body.push(body_part);

      //snake & food collision logic => random food generation at collision
      if (body_part.x === this.foodX && body_part.y === this.foodY) {
        this.foodX = Math.floor(Math.random() * (width / cell)) * cell;
        this.foodY = Math.floor(Math.random() * (height / cell)) * cell;
      } else {
        this.body.shift();
      }
    };

    //Show function for loading game assets
    this.show = function () {
      snakeImg = createImg("assets/body.png");
      snakeImg.hide();
      foodImg = createImg("assets/food.png");
      foodImg.hide();

      //Iterates through every body part and applies same sprite
      for (let part of this.body) {
        image(foodImg, snake.foodX, snake.foodY);
        image(snakeImg, part.x, part.y);
      }
    };
  }
}

let snake;

//Setup function creates the canvas on fixed width, sets Framerate. basic controls and calls snake class 
function setup() {
  createCanvas(width, height);
  snake = new Snake(200, 200, 1, 0);
  Controls(snake);
  frameRate(10);
}

//gets called every frame => Updates image , movement & collision
function draw() {
  background("#45B649");
  snake.update();
  snake.show();
}


//Function for handling controls => -y, +y, -x, +x
function Controls(snake) {
  document.addEventListener("keydown", function (e) {
    switch (e.key) {
      case "ArrowUp":
        if(snake.VelocityY !== 1){
          snake.VelocityX = 0;
          snake.VelocityY = -1;
        }
        break;

      case "ArrowDown":
        if(snake.VelocityY !== -1){
          snake.VelocityX = 0;
          snake.VelocityY = 1;
        }
        break;

      case "ArrowLeft":
        if(snake.VelocityX !== 1){
          snake.VelocityY = 0;
          snake.VelocityX = -1;
        }
        break;

      case "ArrowRight":
        if(snake.VelocityX !== -1){
          snake.VelocityY = 0;
          snake.VelocityX = 1;
        }
        break;
    }
  });
}
